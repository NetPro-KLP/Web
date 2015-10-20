<?php include_once 'header.php'; ?>
<link href="/assets/css/profile.css" rel="stylesheet">
<body class="skin-1">
    <div id="wrapper">
        <?php include_once 'nav_left.php'; ?>
        <div id="page-wrapper" class="gray-bg">
            <?php include_once 'nav_top.php'; ?>
            <div class="wrapper wrapper-content">
                <div class="ibox-content">
                    <form id="imgupload-form" action="profile_upload.php" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <input type="hidden" name="oper" value="imgupload">
                            <div class="text-center"><img alt="image" id="profileimg" name="profileimg" class="circle-border" src="<? if(empty($result['profileimg'])) echo '/assets/img/default.png'; else echo '/assets/img/' .$result['profileimg'];?>"></div>
                            <input id="profileupload" name="img" type="file" style="display: none;">
                        </div>
                    </form>
                    <form id="update-account" method="post" action="profile_upload.php" class="form-horizontal">
                        <div class="form-group">
                            <label class="col-sm-2 control-label">아이디</label>
                            <div class="col-sm-10"><input type="text" name="id" class="form-control" value="<?=$result["id"]?>"></div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">비밀번호</label>
                            <div class="col-sm-10"><input type="password" name="pw" class="form-control"></div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">비밀번호 확인</label>
                            <div class="col-sm-10"><input type="password" name="pw-again" class="form-control"></div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">이름</label>
                            <div class="col-sm-10"><input type="text" name="name" class="form-control" value="<?=$result["name"]?>"></div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">직위</label>
                            <div class="col-sm-10"><input type="text" name="position" class="form-control" value="<?=$result["position"]?>"></div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">이메일</label>
                            <div class="col-sm-10"><input type="text" name="email" class="form-control" value="<?=$result["email"]?>"></div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">전화 번호</label>
                            <div class="col-sm-10"><input type="text" name="phone" class="form-control" value="<?=$result["phone"]?>"></div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-12"><button type="submit" class="btn btn-primary pull-right">확인</button></div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Mainly scripts -->
    <script src="/assets/lib/js/jquery-2.1.4.min.js"></script>
    <script src="/assets/lib/js/bootstrap.min.js"></script>
    <script src="/assets/lib/js/plugins/metisMenu/jquery.metisMenu.js"></script>
    <script src="/assets/lib/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>
    <!-- Custom and plugin javascript -->
    <script src="/assets/lib/js/inspinia.js"></script>
    <script src="/assets/lib/js/plugins/pace/pace.min.js"></script>
    <script>
        $("#profileimg").click(function(){
           $("#profileupload").click();
        });
        $("#profileupload").change(function(){
            var preview = document.querySelector('#profileimg'); //selects the query named img
            var file    = document.querySelector('#profileupload').files[0]; //sames as here
            var reader  = new FileReader();

            reader.onloadend = function () {
               preview.src = reader.result;
            }
            if (file) {
               reader.readAsDataURL(file); //reads the data as a URL
            } else {
               preview.src = "";
            }
            $("#imgupload-form").submit();
        });
        $("#imgupload-form").on('submit',(function(e) {
            e.preventDefault();
            $.ajax({
                url: "profile_upload.php",
                type: "POST",
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData:false,
                success: function(data)
                {
                    alert(data);
                    location.reload();
                }
            });
        }));
         $("#update-account").on('submit',(function(e) {
            e.preventDefault();
            $.ajax({
                url: "profile_upload.php",
                type: "POST",
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData:false,
                success: function(data)
                {
                    alert(data);
                    location.reload();
                }
            });
        }));
    </script>
</body>