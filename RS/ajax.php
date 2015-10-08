<?php
	include_once '../db.php';
	$db = new DB;
	
	$type = $_POST['type'];
	$page = $_POST['page'];
	$limit = $_POST['rows'];
	$sidx = $_POST['sidx'];
	$sord = $_POST['sord'];
	
	if(!$sidx) $sidx = 1;
	if(!$limit) $limit = 20;
	
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
	
	$SQL = "SELECT * FROM rules_data ORDER BY " . $sidx . " " . $sord . " LIMIT " . $start . " , " . $limit . ";";
	$result = $db->mysqli->query($SQL);
	
	$i=0;
	
	$responce->total = $total_pages;
	while($row = $result->fetch_array(MYSQL_ASSOC)) {
		$responce->rows[$i]['idx']=$row['idx'];
		$responce->rows[$i]['data']=$row['data'];
		$i++;
	}
	echo json_encode($responce);
?>