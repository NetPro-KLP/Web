<?php
	session_start();

	if(empty($_SESSION["idx"]))
		die();

	include_once '../db.php';
	$db = new DB;

	$type = $_POST["type"];
	$content = $_POST["content"];


	if($type == "save")
	{
        $sql = "UPDATE `alarm` SET `content`='{$content}' WHERE type=0";
        $db->mysqli->query($sql);
    }
    else if($type == "add_sms")
    {
        $sql = "INSERT INTO `alarm`(`type`,`content`) VALUES ('1','{$content}')";
        $db->mysqli->query($sql);
    }
    else if($type == "add_email")
    {
        $sql = "INSERT INTO `alarm`(`type`,`content`) VALUES ('2','{$content}')";
        $db->mysqli->query($sql);
    }
    else if($type =="remove")
    {
        $sql = "DELETE FROM `alarm` where idx='{$content}'";
        $db->mysqli->query($sql);
    }
?>