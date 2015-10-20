<?php

  require_once 'db.php';

  $db = new DB;

  $id = $_GET["id"];
  $pw = $_GET["pw"];
  $name = $_GET["name"];
  $position = $_GET["position"];
  $email = $_GET["email"];
  $phone = $_GET["phone"];

  $encrypt_pw = hash("sha256", $pw . $db->getSalt());

  $db->mysqli->query("INSERT INTO `accounts`(`id`, `pw`, `name`, `position`,`email`,`phone`) VALUES ('{$id}','{$encrypt_pw}','{$name}','{$position}','{$email}','{$phone}')");

  echo "Success";
?>