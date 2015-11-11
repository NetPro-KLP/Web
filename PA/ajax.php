<?
    session_start();

	if(empty($_SESSION["idx"]))
		die();

	include_once '../db.php';
	$db = new DB;

	$operation = $_POST["oper"];
	$code = $_POST["code"];

    if($operation == "table")
    {

        $code*=10;

        $sql = "select * from packets where 1 ORDER BY idx DESC";

        $result = $db->mysqli->query($sql);

        $total["total"] = intval($result->num_rows/10);

        if($result->num_rows%10 != 0)
            $total["total"]++;

        $sql .= " LIMIT {$code},10";

        unset($result);

        $result = $db->mysqli->query($sql);

        echo json_encode($total);
        echo "&";

        $n=0;
        while($row = $result->fetch_array(MYSQL_ASSOC))
        {
            $n++;
            echo '<tr>';
            echo '<td>' . $n . '</td>';
            echo '<td>' . long2ip($row["source_ip"]) . ":" . $row["source_port"] . '</td>';
            echo '<td>' . long2ip($row["destination_ip"]) . ":" . $row["destination_port"] . '</td>';
            if($row["tcpudp"] == 0)
                echo '<td>TCP</td>';
            else
                echo '<td>UDP</td>';
            echo '<td>' . $row["packet_count"] . '</td>';
            echo '<td>' . number_format(intval($row["totalbytes"]/1024)) . '/MB</td>';
            echo '<td>' . $row["starttime"] . '</td>';
            echo '<td>' . $row["endtime"] . '</td>';
            echo '<td>' . $row["danger"] . '개</td>';
            echo '<td>' . $row["warn"] . '개</td>';
            echo '</tr>';
        }
    }
?>