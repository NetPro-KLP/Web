<?php
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

        $sql = "SELECT packets.source_ip,packets.source_port,packets.destination_ip,packets.destination_port,packets.tcpudp, packet_log.name,packet_log.hazard,packet_log.payload,packet_log.createdAt FROM `packet_log` INNER JOIN packets ON packet_log.packet_idx = packets.idx";

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
            echo "<tr id='". $row["idx"] ."'>";
            echo "<td>" . $n . "</td>";
            echo "<td>" . long2ip($row["source_ip"]) . "</td>";
            echo "<td>" . $row["source_port"] . "</td>";
            echo "<td>" . long2ip($row["destination_ip"]) . "</td>";
            echo "<td>" . $row["destination_port"] . "</td>";
             if($row["tcpudp"] == 0)
                echo "<td>" . 'TCP' . "</td>";
            else
                echo "<td>" . 'UDP' . "</td>";
            echo "<td>" . $row["name"] . "</td>";
            echo "<td>" . $row["payload"] . "</td>";
            if($row["hazard"] == 0)
                echo "<td>" . '<span class="label label-warning">경고</span>' . "</td>";
            else
                echo "<td>" . '<span class="label label-danger">위험</span>' . "</td>";
            echo "<td>" . $row["createdAt"] . "</td>";
            echo "</tr>";
        }
    }
?>