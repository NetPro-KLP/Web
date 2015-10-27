<link href="/assets/css/ETC-Setting.css" rel="stylesheet">
<?php include_once '../header.php'; ?>
<body class="skin-1">
  <div id="wrapper">
    <?php include_once '../nav_left.php'; ?>
    <div id="page-wrapper" class="gray-bg">
      <?php include_once '../nav_top.php'; ?>
        <?
            $sql = "select * from system where 1";
            $result = $db->mysqli->query($sql);
            $row = $result->fetch_array(MYSQL_ASSOC);
            $hazard[$row["hazzard"]] = "active";
        ?>
      <div class="wrapper wrapper-content">
          <div class="row">
                <div class="col-lg-12">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>보안 설정</small></h5>
                        </div>
                        <div class="ibox-content">
                            <div class="center">
                                <div class="btn-group">
                                    <button class="btn btn-danger btn-lg <?=$hazard[0]?>" id="low" type="button"> 최하 </button>
                                    <button class="btn btn-warning btn-lg <?=$hazard[1]?>" id="normal" type="button"> 보통 </button>
                                    <button class="btn btn-primary btn-lg <?=$hazard[2]?>" id="high" type="button"> 최상 </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>유저 아이피 대역</small></h5>
                        </div>
                        <div class="ibox-content">
                            <div class="center">
                                <div class="input-daterange input-group">
                                    <input type="text" class="input-sm form-control" name="start" value="<?=$row["bandwidth_from_ip"]?>">
                                    <span class="input-group-addon to">to</span>
                                    <input type="text" class="input-sm form-control" name="end" value="<?=$row["bandwidth_to_ip"]?>">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>패킷 저장 주기</small></h5>
                        </div>
                        <div class="ibox-content">
                            <div class="center">
                                <input type="text" placeholder="초" id="save_packet" class="form-control m-b" value="<?=$row["save_packet"]?>">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>패킷 삭제 주기</small></h5>
                        </div>
                        <div class="ibox-content">
                            <div class="center">
                                <input type="text" placeholder="초" id="remove_packet" class="form-control m-b" value="<?=$row["remove_packet"]?>">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <button type="button" id="save" class="btn btn-block btn-primary">저장 하기</button>
      </div>
    </div>
  </div>
     <!-- Mainly scripts -->
    <script src="../assets/lib/js/jquery-2.1.4.min.js"></script>
    <script src="../assets/lib/js/bootstrap.min.js"></script>
    <script src="../assets/lib/js/plugins/metisMenu/jquery.metisMenu.js"></script>
    <script src="../assets/lib/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>
    <!-- FooTable -->
    <script src="../assets/lib/js/plugins/footable/footable.all.min.js"></script>
    <!-- Custom and plugin javascript -->
    <script src="../assets/lib/js/inspinia.js"></script>
    <script src="../assets/lib/js/plugins/pace/pace.min.js"></script>
    <script src="/assets/js/common.js"></script>

    <script>
        $("#save").click(function(){
            if($("#low").hasClass("active"))
                var hazard = 0;
            else if($("#normal").hasClass("active"))
                var hazard = 1;
            else if($("#high").hasClass("active"))
                var hazard = 2;

           $.ajax({
                type: 'POST',
                url: "./ajax.php",
                data: "type=save_settings" + "&hazard=" + hazard + "&bandwidth_from_ip=" + $("input[name=start]").val() + "&bandwidth_to_ip=" +  $("input[name=end]").val() + "&save_packet=" + $("#save_packet").val() + "&remove_packet=" + $("#remove_packet").val(),
                success: function(res){
                    alert("성공적으로 저장되었습니다.");
                    location.reload();
                },
                error:function(err){
                    alert("데이터를 가져오는데 실패하였습니다.");
                }
            });
        });
        $("#low").click(function(){
            $(this).addClass("active");
            $("#normal").removeClass("active");
            $("#high").removeClass("active");
        });
        $("#normal").click(function(){
            $(this).addClass("active");
            $("#low").removeClass("active");
            $("#high").removeClass("active");
        });
        $("#high").click(function(){
            $(this).addClass("active");
            $("#normal").removeClass("active");
            $("#low").removeClass("active");
        });
    </script>
</body>