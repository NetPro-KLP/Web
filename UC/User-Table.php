<?php include_once '../header.php'; ?>
<link href="../assets/lib/css/plugins/footable/footable.core.css" rel="stylesheet">
<body class="skin-1">
    <div id="wrapper">
        <?php include_once '../nav_left.php'; ?>
        <div id="page-wrapper" class="gray-bg">
            <?php include_once '../nav_top.php'; ?>
            <div class="wrapper wrapper-content animated fadeInRight">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="ibox float-e-margins">
                            <div class="ibox-title">
                                <h5> 유저테이블</h5>
                            </div>
                            <div class="ibox-content">
                                <input type="text" class="form-control input-sm m-b-xs" id="filter"
                                    placeholder="찾기">
                                <table class="footable table table-stripped" data-page-size="10" data-filter=#filter>
                                    <thead>
                                        <tr>
                                            <th>고유 번호</th>
                                            <th>아이피</th>
                                            <th>시작 시간</th>
                                            <th>마지막 시간</th>
                                            <th>총 트래픽 양</th>
                                            <th>상태</th>
                                            <th>기능</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td colspan="7">
                                                <div class="btn-group pull-right pagination">

                                                </div>
                                            </td>
                                        </tr>
                                    </tfoot>
                                </table>
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
            <!-- Page-Level Scripts -->
            <script>
                var ajaxcall = function(action,idx){
                    $.ajax({
                        type: 'POST',
                        url: "./ajax.php",
                        data: "oper=" + action + "&code=" + idx,
                        success: function(res){
                            if(action == "show")
                            {
                                $("#Packet-Modal").html(res);
                                $('.footable').footable();
                                $("#Packet-Modal").modal();
                            }
                            else
                                location.reload();

                        },
                        error:function(err){
                            alert("데이터를 가져오는데 실패하였습니다.");
                        }
                    });
                }
                $(".show-packet").on("click",function(){
                    ajaxcall("show",$(this).parents("tr").children("td").eq(1).text());
                });
                $(".block").on("click",function(){
                    ajaxcall("block",$(this).parents("tr").attr("id"));
                });
                $(".unblock").on("click",function(){
                    ajaxcall("unblock",$(this).parents("tr").attr("id"));
                });
                $(".remove").on("click",function(){
                    ajaxcall("remove",$(this).parents("tr").attr("id"));
                });
            </script>
            <script src="/assets/js/table.js"></script>
        </div>
    </div>
    <div class="modal inmodal fade" id="Packet-Modal" tabindex="-1" role="dialog"  aria-hidden="true">
    </div>
</body>