<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>NetPro-KLP - 로그인</title>

    <link href="/assets/lib/css/bootstrap.min.css" rel="stylesheet">
    <link href="/assets/font/font-awesome/font-awesome.min.css" rel="stylesheet">

    <link href="/assets/lib/css/animate.css" rel="stylesheet">
    <link href="/assets/lib/css/style.css" rel="stylesheet">
    
    <link href="/assets/css/common.css" rel="stylesheet">
    
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
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
