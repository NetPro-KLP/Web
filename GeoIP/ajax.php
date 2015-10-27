<?php
	session_start();

	if(empty($_SESSION["idx"]))
		die();

	include_once '../db.php';
	$db = new DB;

	$operation = $_POST["oper"];
	$code = $_POST["code"];

	if($operation == "trafficall")
	{
        $sql = "SELECT packets.totalbytes,GeoIP.country_code FROM `packets`,`GeoIP` WHERE GeoIP.from_ip_int <= packets.destination_ip and GeoIP.to_ip_int >=     packets.destination_ip";
        $result = $db->mysqli->query($sql);

        while($row = $result->fetch_array(MYSQLI_ASSOC))
        {
            if(isset($json[$row["country_code"]]))
                $json[$row["country_code"]] += intval($row["totalbytes"]);
            else
                $json[$row["country_code"]] = intval($row["totalbytes"]);
        }
        echo json_encode($json);
  }
  else if($operation == "blacklist")
  {
      //$sql = "SELECT DISTINCT GeoIP.country,GeoIP.country_code, IFNULL((SELECT 'TRUE' FROM GeoIP_Blacklist WHERE GeoIP_Blacklist.country_code = GeoIP.country_code),'FALSE') AS Blocked FROM `GeoIP` WHERE 1 ORDER BY `Blocked` DESC";

        $sql = "SELECT `country_code` from `GeoIP_Blacklist` WHERE 1";
        $array = array();
        $result = $db->mysqli->query($sql);
        while($row = $result->fetch_array(MYSQLI_ASSOC))
        {
            array_push($array,$row["country_code"]);
        }
        echo join(',',$array);
  }
  else if($operation == "block")
  {
      $date = date("Y-m-d H:i:s");
      $sql = "INSERT INTO `GeoIP_Blacklist`(`country_code`,`createdAt`) VALUES ('{$code}','{$date}')";
      $db->mysqli->query($sql);
  }
  else if($operation == "unblock")
  {
        $sql = "DELETE FROM `GeoIP_Blacklist` where `country_code` = '{$code}'";
        $db->mysqli->query($sql);
  }
  else if($operation == "table")
  {
        $code*=10;

        $sql = "SELECT SUM(packets.totalbytes) as totalbytes,GeoIP.country,GeoIP.country_code FROM `packets`,`GeoIP` WHERE GeoIP.from_ip_int <= INET_ATON(packets.destination_ip) and GeoIP.to_ip_int >=INET_ATON(packets.destination_ip) GROUP BY GeoIP.country_code order by totalbytes desc";

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
            echo "<tr id='". $n ."'>";
            echo "<td>" . $n . "</td>";
            echo "<td>" . $row["country_code"] . "</td>";
            echo "<td>" . $row["country"] . "</td>";
            echo "<td>" . (int)($row["totalbytes"]/1024) . " /MB</td>";
            echo "</tr>";
        }
  }
?>