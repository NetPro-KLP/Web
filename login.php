<?php
    session_start();

    require_once 'db.php';

    $db = new DB;
    if(isset($_SESSION["idx"]))
    {
      $idx = $_SESSION["idx"];
      $result = $db->mysqli->real_escape_string("select * from accounts where idx='{$idx}'");
      if( $result->num_rows == 1 )
      	header("Location: /");
    }
    ?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>KLP-Firewall 로그인</title>
        <link href="/assets/lib/css/bootstrap.min.css" rel="stylesheet">
        <link href="/assets/font/font-awesome/font-awesome.min.css" rel="stylesheet">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
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
    <body class="gray-bg">
        <div class="middle-box text-center loginscreen animated fadeInDown">
            <div>
                <div>
                    <i class="material-icons logo-icon">security</i>
                    <h2 class="logo-name">NetPro-KLP</h2>
                </div>
                <form class="m-t" role="form" method="post" action="/">
                    <div class="form-group">
                        <input type="text" name="id" class="form-control" placeholder="아이디" required="">
                    </div>
                    <div class="form-group">
                        <input type="password" name="pw" class="form-control" placeholder="비밀번호" required="">
                    </div>
                    <button type="submit" class="btn btn-primary block full-width m-b">로그인</button>
                </form>
            </div>
        </div>
        <!-- Mainly scripts -->
        <script src="/assets/lib/js/jquery-2.1.4.min.js"></script>
        <script src="/assets/lib/js/bootstrap.min.js"></script>
    </body>
</html>