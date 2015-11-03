<?php
	session_start();

	if(empty($_SESSION["idx"]))
		die();

	include_once '../db.php';
	$db = new DB;

	$operation = $_POST['oper'];
	$search = $_POST['search'];

	$ip = $_POST['ip'];
	$port = $_POST['port'];
	$protocol = $_POST['protocol'];
    $date = date("Y-m-d H:i:s");

	$id = $_POST['idx'];
	$page = $_POST['page'];
	$limit = $_POST['rows'];
	$sidx = $_POST['sidx'];
	$sord = $_POST['sord'];

	if($operation == "add")
	{
    	if(strlen($ip) != 2)
    	    $sql = "INSERT INTO `IP_Blacklist`(`ip`, `port`, `protocol`, `createdAt`) VALUES ('{$ip}','{$port}','{$protocol}','{$date}')";
        else
            $sql = "INSERT INTO `GeoIP_Blacklist`(`country_code`, `createdAt`) VALUES ('{$ip}','{$date}')";

		$db->mysqli->query($sql);
	}
	else if($operation == "edit")
	{
        if(strlen($ip) != 2)
    	    $sql = "UPDATE `IP_Blacklist` SET `ip`='{$ip}',`port`='{$port}',`protocol`='{$protocol}' WHERE `idx` = '{$id}'";
        else
            $sql = "UPDATE `GeoIP_Blacklist` SET `country_code`='{$ip}' WHERE `idx` = '{$id}'";

        echo $sql;

		$db->mysqli->query($sql);
	}
	else if($operation == "del")
	{
    	if(strlen($ip) != 2)
    	    $sql = "DELETE FROM `IP_Blacklist`  WHERE `idx` = '{$id}'";
        else
            $sql = "DELETE FROM `GeoIP_Blacklist`  WHERE `idx` = '{$id}'";

		$db->mysqli->query($sql);
	}
	else
	{
		if(!$sidx) $sidx = 1;
		if(!$limit) $limit = 20;


        $result = $db->mysqli->query("SELECT count(IP_Blacklist.idx) + count(GeoIP_Blacklist.idx) as count FROM `IP_Blacklist`,`GeoIP_Blacklist`");

		$row = $result->fetch_array(MYSQL_ASSOC);

		$count = $row['count'];

		if( $count > 0 && $limit > 0) {
			$total_pages = ceil($count/$limit);
		} else {
			$total_pages = 0;
		}
		if ($page > $total_pages) $page=$total_pages;
		$start = $limit*$page - $limit;
		if($start <0) $start = 0;


        $SQL = "SELECT idx,ip,port,protocol,createdAt FROM `IP_Blacklist` UNION SELECT idx,country_code,'any','any',createdAt FROM `GeoIP_Blacklist` ORDER BY " . $sidx . " " . $sord . " LIMIT " . $start . " , " . $limit . ";";

		$result = $db->mysqli->query($SQL);

		$i=0;

		$responce->total = $total_pages;
		$n = 0;
		while($row = $result->fetch_array(MYSQL_ASSOC)) {
			$responce->rows[$i]['idx']=$i+1;
			$responce->rows[$i]['hontto-idx'] = $row["idx"];
			$responce->rows[$i]['ip']= $row["ip"];
			$responce->rows[$i]['port']= $row["port"];
			$responce->rows[$i]['protocol']= $row["protocol"];
			$responce->rows[$i]['createdAt']= $row["createdAt"];
			$i++;
		}
		echo json_encode($responce);
	}
?>