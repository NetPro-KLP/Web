<?php include_once '../header.php'; ?>
<link href="/assets/lib/css/plugins/iCheck/custom.css" rel="stylesheet">
<link href="/assets/lib/css/plugins/awesome-bootstrap-checkbox/awesome-bootstrap-checkbox.css" rel="stylesheet">
<link href="/assets/lib/css/plugins/sweetalert/sweetalert.css" rel="stylesheet">
<link href="/assets/css/Ruleset-Backup-Recovery.css" rel="stylesheet">
<body class="skin-1">
    <div id="wrapper">
        <?php include_once '../nav_left.php'; ?>
        <div id="page-wrapper" class="gray-bg">
            <?php include_once '../nav_top.php'; ?>
            <div class="wrapper wrapper-content">
                <div class="col-lg-6">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>백업</h5>
                        </div>
                        <div class="ibox-content">
                            <form id="backup-form" action="mysqldump.php" method="POST">
                                <input type="hidden" value="backup" name="type">
                                <div class="i-checks"><label> <input type="radio" value="SQL" name="option-backup" checked="" > <i></i>SQL</label></div>
                                <div class="i-checks"><label> <input type="radio" value="GZSQL" name="option-backup"> <i></i>SQL with GZIP</label></div>
                                <div class="i-checks"><label> <input type="radio" value="CSV" name="option-backup"> <i></i>CSV</label></div>
                                <div class="i-checks"><label> <input type="radio" value="RULES" name="option-backup"> <i></i>RULES</label></div>
                                <button type="submit" class="btn btn-block btn-outline btn-primary">백업하기</button></a>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>복원</h5>
                        </div>
                        <div class="ibox-content">
                            <form id="recovery-form" enctype="multipart/form-data" action="mysqldump.php" method="POST">
                                <input type="hidden" value="recovery" name="type">
                                <div class="i-checks"><label> <input type="radio" value="SQL" name="option-recovery" checked="" > <i></i>SQL</label></div>
                                <div class="i-checks"><label> <input type="radio" value="CSV" name="option-recovery"> <i></i>CSV</label></div>
                                <div class="i-checks"><label> <input type="radio" value="RULES" name="option-recovery"> <i></i>RULES</label></div>
                                <button id="recovery-btn" type="button" class="btn btn-block btn-outline btn-primary">복원하기</button>
                                <input type="file" name="recovery-file" style="display: none;" id="recovery" accept=".SQL">
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <button id="delall" type="button" class="btn btn-block btn-danger">전체 데이터 삭제</button>
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
    <script src="/assets/js/common.js"></script>
    <script src="/assets/lib/js/plugins/sweetalert/sweetalert.min.js"></script>
    <!-- iCheck -->
    <script src="/assets/lib/js/plugins/iCheck/icheck.min.js"></script>
    <script>
        $(document).ready(function () {
            $('.i-checks').iCheck({
                radioClass: 'iradio_square-green',
            });
        });
        $("#recovery-btn").click(function(){
          $("#recovery").click();
        });
        $('#recovery').change(function() {
            $('#recovery-form').submit();
        });
        $('.i-checks').on('ifChecked', function(){
            $("#recovery").attr("accept", "." + $(this).text().trim());
        });
        $('#delall').click(function () {
              swal({
                 title: "정말 삭제 하시겠습니까?",
                 text: "삭제후 복구 할수 없습니다 데이터를 꼭 백업해주시기 바랍니다.",
                 type: "warning",
                 showCancelButton: true,
                 confirmButtonColor: "#DD6B55",
                 confirmButtonText: "네, 삭제하겠습니다!",
                 cancelButtonText: "아니요, 취소합니다.",
                 closeOnConfirm: false,
                 closeOnCancel: false },
             function (isConfirm) {
                 if (isConfirm) {
                  	var sucsex = function(data){
                   	swal("삭제되었습니다!", "룰셋 테이블을 확인하여주세요.", "success");
                  	}
                  	$.ajax({
        				  type: 'POST',
        				  url: "./ajax.php",
        				  data: "oper=delall",
        				  success: sucsex
        				});
                 } else {
                     swal("취소되었습니다.", "룰셋 테이블을 확인하여주세요.", "error");
                 }
             });
          });
    </script>
</body>