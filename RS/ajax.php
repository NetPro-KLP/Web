<?php
	session_start();

	if(empty($_SESSION["idx"]))
		die();

	include_once '../db.php';
	$db = new DB;

	$operation = $_POST['oper'];
	$search = $_POST['search'];
	$data = $_POST['data'];
	$id = $_POST['idx'];
	$page = $_POST['page'];
	$limit = $_POST['rows'];
	$sidx = $_POST['sidx'];
	$sord = $_POST['sord'];

	if($operation == "add")
	{
		$sql = "INSERT INTO `rules_data`(`data`) VALUES ('{$data}')";
		$db->mysqli->query($sql);
	}
	else if($operation == "edit")
	{
		$sql = "UPDATE `rules_data` SET `data`='{$data}' WHERE idx='{$id}'";
		$db->mysqli->query($sql);
	}
	else if($operation == "del")
	{
		$sql = "DELETE from `rules_data` WHERE idx='{$id}'";
		$db->mysqli->query($sql);
	}
	else if($operation == "delall")
	{
		$sql = "TRUNCATE rules_data";
		$db->mysqli->query($sql);
	}
	else
	{
		if(!$sidx) $sidx = 1;
		if(!$limit) $limit = 20;

		if($operation == "search")
			$result = $db->mysqli->query("SELECT COUNT(*) AS count FROM rules_data where data=%'{$search}'%");
		else
			$result = $db->mysqli->query("SELECT COUNT(*) AS count FROM rules_data");

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

		if($operation == "search")
			$SQL = "SELECT * FROM rules_data ORDER BY " . $sidx . " " . $sord . " LIMIT " . $start . " , " . $limit . "where data=%'" . $search . "'%";
		else
			$SQL = "SELECT * FROM rules_data ORDER BY " . $sidx . " " . $sord . " LIMIT " . $start . " , " . $limit . ";";
		$result = $db->mysqli->query($SQL);

		$i=0;

		$responce->total = $total_pages;
		while($row = $result->fetch_array(MYSQL_ASSOC)) {
			$responce->rows[$i]['idx']=$row['idx'];
			$responce->rows[$i]['data']= htmlentities($row['data']);
			$i++;
		}
		echo json_encode($responce);
	}
?>