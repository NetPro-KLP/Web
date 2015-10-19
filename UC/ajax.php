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
                        echo '<td>' . $row["source_ip"] . ":" . $row["source_port"] . '</td>';
                        echo '<td>' . $row["destination_ip"] . ":" . $row["destination_port"] . '</td>';
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
?>