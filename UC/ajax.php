<?php
	session_start();

	if(empty($_SESSION["idx"]))
		die();

	include_once '../db.php';
	$db = new DB;

	$operation = $_POST["oper"];
	$code = $_POST["code"];

    if($operation == "show")
    {
        echo '<div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                        <h4 class="modal-title">IP : ' . $code . '</h4>
                        <small class="font-bold"></small>
                    </div>
                    <div class="modal-body">
                        <table class="footable table table-stripped toggle-arrow-tiny" data-page-size="8">
                    <thead>
                    <tr>
                        <th>idx</th>
                        <th>출발지 IP:Port</th>
                        <th>도착지 IP:Port</th>
                        <th>프로토콜</th>
                        <th>패킷 수</th>
                        <th>총 바이트</th>
                        <th>시작 시간</th>
                        <th>종료 시간</th>
                        <th>위험 패킷</th>
                        <th>경고 패킷</th>
                    </tr>
                    </thead>
                    <tbody>
                    ';
                    $code = ip2long($code);

                    $result = $db->mysqli->query("SELECT * FROM `packets` WHERE source_ip ='{$code}' or destination_ip='{$code}'");
                    $n=0;
                    while($row = $result->fetch_array(MYSQL_ASSOC))
                    {
                        $n++;
                        echo '<tr>';
                        echo '<td>' . $n . '</td>';
                        echo '<td>' . long2ip($row["source_ip"]) . ":" . $row["source_port"] . '</td>';
                        echo '<td>' . long2ip($row["destination_ip"]) . ":" . $row["destination_port"] . '</td>';
                        if($row["tcporudp"] == 0)
                            echo '<td>TCP</td>';
                        else
                            echo '<td>UDP</td>';
                        echo '<td>' . $row["packet_count"] . '</td>';
                        echo '<td>' . $row["totalbytes"] . '</td>';
                        echo '<td>' . $row["starttime"] . '</td>';
                        echo '<td>' . $row["endtime"] . '</td>';
                        echo '<td>' . $row["danger"] . '개</td>';
                        echo '<td>' . $row["warn"] . '개</td>';
                        echo '</tr>';
                    }
                    echo '</tbody>
                    <tfoot>
                    <tr>
                        <td colspan="11">
                            <ul class="pagination pull-right"></ul>
                        </td>
                    </tr>
                    </tfoot>
                </table>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>';
    }
	else if($operation == "block")
	{
        $sql = "UPDATE `users` SET `status`=1 WHERE idx='{$code}'";
        $db->mysqli->query($sql);
    }
    else if($operation == "unblock")
    {
        $sql = "UPDATE `users` SET `status`=0 WHERE idx='{$code}'";
        $db->mysqli->query($sql);
    }
    else if($operation == "remove")
    {
        $sql = "DELETE FROM users where idx='{$code}'";
        $db->mysqli->query($sql);
    }
    else if($operation == "table")
    {

        $code*=10;

        $sql = "select users.idx,users.ip,users.createdAt,users.connectedAt,users.status, SUM(packets.totalbytes) as traffic from users left join packets on users.ip = packets.source_ip or users.ip = packets.destination_ip GROUP BY users.ip ORDER BY traffic DESC";

        $result = $db->mysqli->query($sql);


        $total["total"] = intval($result->num_rows/10);

        if($result->num_rows%10 != 0)
            $total["total"]++;

        $sql .= " LIMIT {$code},10";

        unset($result);

        $result = $db->mysqli->query($sql);

        echo json_encode($total);
        echo "&";

        while($row = $result->fetch_array(MYSQL_ASSOC))
        {
            echo "<tr id='". $row["idx"] ."'>";
            echo "<td>" . $row["idx"] . "</td>";
            echo "<td>" . long2ip($row["ip"]) . "</td>";
            echo "<td>" . $row["createdAt"] . "</td>";
            echo "<td>" . $row["connectedAt"] . "</td>";
            if ($row["traffic"] == "")
                $row["traffic"] = "0";
            $row["traffic"] = number_format($row["traffic"]);
            $row["traffic"] .= "/KB";
            echo "<td>" . $row["traffic"] . "</td>";
            if($row["status"] == 0)
                echo "<td>" . '<span class="label label-success">정상</span>' . "</td>";
            else
                echo "<td>" . '<span class="label label-danger">차단</span>' . "</td>";
            echo '<td class="center">
                        <div class="btn-group">
                            <button class="btn-white btn btn-xs show-packet" data-toggle="modal" data-target="Packet-Modal">패킷보기</button>
                            ';
                        if($row["status"] == 0)
                            echo '<button class="btn-white btn btn-xs block">차단하기</button>';
                        else
                            echo '<button class="btn-white btn btn-xs unblock">차단해체</button>';
                        echo '<button class="btn-white btn btn-xs remove">지우기</button>
                        </div>
                    </td>';
            echo "</tr>";
        }
    }
    else if($operation == "Usertable")
    {
        $code*=24;

        $sql = "SELECT users.idx, users.ip,users.connectedAt,users.status,SUM(packets.totalbytes) as traffic,SUM(packets.danger) as danger,SUM(packets.warn) as warn FROM users JOIN packets ON users.ip = packets.source_ip or users.ip = packets.destination_ip GROUP BY users.idx";

        $result = $db->mysqli->query($sql);

        $total["total"] = intval($result->num_rows/24);

        if($result->num_rows%24 != 0)
            $total["total"]++;

        $sql .= " LIMIT {$code},24";

        unset($result);

        $result = $db->mysqli->query($sql);

        echo json_encode($total);
        echo "&";

        $n=0;

        while($row = $result->fetch_array(MYSQL_ASSOC))
        {
            echo '<div class="col-xs-6 col-lg-2 user-box" id="' . $row["idx"] . '"><div class="ibox float-e-margins"><div class="ibox-title">';
            echo '<span class="badge badge-danger error-sign">' . $row["danger"] . '</span>';
            echo '<span class="badge badge-warning warn-sign">' . $row["warn"] . '</span>';
            if($row["status"] == 0)
            {
                echo '<span class="label label-success pull-right">정상</span>';
                $blockclass = "block";
                $blocktext = "차단하기";
            }
            else
            {
                echo '<span class="label label-danger pull-right">차단</span>';
                $blockclass = "unblock";
                $blocktext = "차단해체";
            }

            echo '<a class="dropdown-toggle tool-set" data-toggle="dropdown" href="#"><i class="fa fa-wrench"></i></a>';
            echo '<ul class="dropdown-menu dropdown-user option">
                    <li><a class="show-packet" href="#">패킷보기</a></li>
                    <li><a class="' . $blockclass . '" href="#">' . $blocktext . '</a></li>
                    <li><a class="remove" href="#">지우기</a></li>
                </ul>';

            echo '<h5 class="ip">' . long2ip($row["ip"]) . '</h5>';
            echo '<h7 class="date">' . $row["connectedAt"] . '</h7></div>';
            echo '<div class="ibox-content"><h5 class="traffic-span">Traffic</h5>';
            echo '<span><small>' . number_format(intval($row["traffic"]/1024)) . '/MB</small></span>';
            echo '<span data-diameter="10" class="updating-chart" data-chart="' . $row["idx"] .'"></span>';
            echo '</div></div></div>';
        }
    }

?>