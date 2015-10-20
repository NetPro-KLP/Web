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
        $sql = "SELECT packets.totalbytes,GeoIP.country_code FROM `packets`,`GeoIP` WHERE GeoIP.from_ip_int <= INET_ATON(packets.destination_ip) and GeoIP.to_ip_int >=     INET_ATON(packets.destination_ip)";
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
?>