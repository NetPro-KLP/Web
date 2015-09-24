<?php
  session_start();
  
  require_once 'db.php';
  
  $db = new DB;
  if(isset($_POST["id"]) && isset($_POST["pw"]))
  {
    $id = $_POST["id"];
    $pw = $_POST["pw"];
    $encrypt_pw = hash("sha256", $pw . $db->getSalt());
    
    $result = $db->mysqli->query("select * from accounts where id='{$id}' and pw ='{$encrypt_pw}'");
    
    if($result->num_rows == 1)
    {
      $result = $result->fetch_array(MYSQLI_ASSOC);
      $_SESSION["idx"] = $result["idx"];
    }
    else
    {
      echo "<script>
        alert('아이디 또는 비밀번호가 틀립니다.');
        history.back(-1);
      </script>";
      die();
    }
  }
  if(empty($_SESSION["idx"])){
    header("Location: /login");
    die();
  }
  else if(isset($_SESSION["idx"]) && empty($_POST["id"]) && empty($_POST["pw"]))
  {
    $idx = $_SESSION["idx"];
    $result = $db->mysqli->query("select * from accounts where idx='{$idx}'");
    $result = $result->fetch_array(MYSQLI_ASSOC);
  }
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>NetPro-KLP</title>

    <link href="/assets/lib/css/bootstrap.min.css" rel="stylesheet">
    <link href="/assets/font/font-awesome/font-awesome.min.css" rel="stylesheet">

    <!-- Toastr style -->
    <link href="/assets/lib/css/plugins/toastr/toastr.min.css" rel="stylesheet">

    <link href="/assets/lib/css/animate.css" rel="stylesheet">
    <link href="/assets/lib/css/style.css" rel="stylesheet">

    <link href="/assets/css/common.css" rel="stylesheet">
    
    <link rel="apple-touch-icon" sizes="57x57" href="/apple-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="/apple-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="/apple-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="/apple-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="/apple-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="/apple-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="/apple-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="/apple-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-icon-180x180.png">
    <link rel="icon" type="image/png" sizes="192x192"  href="/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="manifest" href="/manifest.json">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="/ms-icon-144x144.png">
</head>