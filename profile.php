<?php include_once 'header.php'; ?>
<link href="/assets/css/profile.css" rel="stylesheet">
<body class="skin-1">
  <div id="wrapper">
    <?php include_once 'nav_left.php'; ?>
    <div id="page-wrapper" class="gray-bg">
      <?php include_once 'nav_top.php'; ?>
      <div class="wrapper wrapper-content">
	      <div class="ibox-content">
          <form method="post" class="form-horizontal">
	          	<div class="form-group">
		          	<div class="text-center"><img alt="image" class="circle-border" src="/assets/img/default.png"></div>
	          	</div>
              <div class="form-group"><label class="col-sm-2 control-label">아이디</label>
                  <div class="col-sm-10"><input type="text" name="id" class="form-control" value="<?=$result["id"]?>"></div>
              </div>
              <div class="form-group"><label class="col-sm-2 control-label">비밀번호</label>
                  <div class="col-sm-10"><input type="password" name="password" class="form-control" name="password"></div>
              </div>
              <div class="form-group"><label class="col-sm-2 control-label">비밀번호 확인</label>
                  <div class="col-sm-10"><input type="password" name="password" class="form-control" name="password"></div>
              </div>
              <div class="form-group"><label class="col-sm-2 control-label">이름</label>
                  <div class="col-sm-10"><input type="text" name="id" class="form-control" value="<?=$result["name"]?>"></div>
              </div>
              <div class="form-group"><label class="col-sm-2 control-label">직위</label>
                  <div class="col-sm-10"><input type="text" name="id" class="form-control" value="<?=$result["position"]?>"></div>
              </div>
              <div class="form-group"><div class="col-sm-12"><button type="submit" class="btn btn-primary pull-right">확인</button></div></div>
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

    <!-- DROPZONE -->
    <script src="/assets/lib/js/plugins/dropzone/dropzone.js"></script>


    <script>
        $(document).ready(function(){

            Dropzone.options.myAwesomeDropzone = {

                autoProcessQueue: false,
                uploadMultiple: true,
                parallelUploads: 100,
                maxFiles: 100,

                // Dropzone settings
                init: function() {
                    var myDropzone = this;

                    this.element.querySelector("button[type=submit]").addEventListener("click", function(e) {
                        e.preventDefault();
                        e.stopPropagation();
                        myDropzone.processQueue();
                    });
                    this.on("sendingmultiple", function() {
                    });
                    this.on("successmultiple", function(files, response) {
                    });
                    this.on("errormultiple", function(files, response) {
                    });
                }

            }

       });
    </script>
</body>