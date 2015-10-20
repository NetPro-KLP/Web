<?php include_once '../header.php'; ?>
<body class="skin-1">
  <div id="wrapper">
    <?php include_once '../nav_left.php'; ?>
    <div id="page-wrapper" class="gray-bg">
      <?php include_once '../nav_top.php'; ?>
      <div class="wrapper wrapper-content">
          <div class="row">
                <div class="col-lg-12">
                    <div class="ibox ">
                        <div class="ibox-title">
                            <h5>알람 설정</h5>
                        </div>
                        <?
                            $result = $db->mysqli->query("select content from alarm where type=0");
                            $row = $result->fetch_assoc();
                        ?>
                        <div class="ibox-content">
                            <textarea class="form-control diff-textarea" id="original" rows="6"><?=$row['content']?></textarea>
                            <button type="button" id="save" class="btn btn-block btn-outline btn-primary alarm" style="margin-top: 10px;">저장</button>
                        </div>
                        <div class="ibox-footer">
                            <span class="label">{{name}} : 탐지 패킷 명</span>
                            <span class="label">{{hazard}} : 위험도</span>
                            <span class="label">{{payload}} : 탐지 페이로드</span>
                            <span class="label">{{date}} : 탐지 날짜</span>
                        </div>
                    </div>
                </div>
          </div>
          <div class="row">
                <div class="col-lg-6">
                    <div class="ibox">
                        <div class="ibox-content">
                            <h3>SMS 알림</h3>
                            <p class="small"><i class="fa fa-hand-o-up"></i> 알람을 받으실 핸드폰 번호를 입력해주세요.</p>
                            <div class="input-group">
                                <input type="text" placeholder="핸드폰번호를 입력해주세요 " class="input input-sm form-control">
                                <span class="input-group-btn">
                                        <button type="button" class="btn btn-sm btn-white alarm" id="add_sms"> <i class="fa fa-plus"></i> 추가</button>
                                </span>
                            </div>
                            <ul class="sortable-list connectList agile-list ui-sortable">
                                <?
                                    $result = $db->mysqli->query("select idx,content from alarm where type=1");
                                    while($row = $result->fetch_array(MYSQL_ASSOC)){
                                ?>
                                <li class="success-element">
                                    <?=$row['content']?>
                                    <div class="pull-right"><button data-idx='<?=$row['idx']?>' class="btn btn-xs btn-danger remove" type="button"><i class="fa fa-times"></i></button></div>
                                </li>
                                <? } ?>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="ibox">
                        <div class="ibox-content">
                            <h3>Email 알림</h3>
                            <p class="small"><i class="fa fa-hand-o-up"></i> 알람 받으실 이메일 주소를 입력해주세요.</p>
                            <div class="input-group">
                                <input type="text" placeholder="이메일을 입력해주세요 " class="input input-sm form-control">
                                <span class="input-group-btn">
                                    <button type="button" class="btn btn-sm btn-white alarm" id="add_email"> <i class="fa fa-plus"></i> 추가</button>
                                </span>
                            </div>
                            <ul class="sortable-list connectList agile-list ui-sortable">
                                <?
                                    $result = $db->mysqli->query("select idx,content from alarm where type=2");
                                    while($row = $result->fetch_array(MYSQL_ASSOC)){
                                ?>
                                <li class="success-element">
                                    <?=$row['content']?>
                                    <div class="pull-right"><button data-idx='<?=$row['idx']?>' class="btn btn-xs btn-danger remove" type="button"><i class="fa fa-times"></i></button></div>
                                </li>
                                <? } ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
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
        function ajax(type,content)
        {
            $.ajax({
                type: 'POST',
                url: "./ajax.php",
                data: "type=" + type + "&content=" + content,
                success: function(res){
                    location.reload();
                },
                error:function(err){
                    alert("데이터를 가져오는데 실패하였습니다.");
                }
            });
        }
        $(".alarm").click(function(){

            if($(this).parent().parent().find("input[type=text]").length > 0)
                var text = $(this).parent().parent().find("input[type=text]").val();
            else
                var text = $(this).parent().find("textarea").val();
            ajax($(this).attr("id"),text);
        });
        $(".remove").click(function(){
            ajax("remove",$(this).data("idx"));
        });
    </script>
</body>