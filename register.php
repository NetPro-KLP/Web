<?php
  
  require_once 'db.php';
  
  $db = new DB;
  
  $id = $_POST["id"];
  $pw = $_POST["pw"];
  $name = $_POST["name"];
  $position = $_POST["position"];
  
  $encrypt_pw = hash("sha256", $pw . $db->getSalt());
  
  $db->mysqli->query("INSERT INTO `accounts`(`id`, `pw`, `name`, `position`) VALUES ('{$id}','{$encrypt_pw}','{$name}','{$position}')");
  
  echo "Success";
?>