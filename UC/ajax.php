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
            $row["traffic"] .= "/MB";
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

?>