<?php include_once '../header.php'; ?>
<link href="/assets/css/Control-Panel.css" rel="stylesheet">
<body class="skin-1">
<div id="wrapper">
    <?php include_once '../nav_left.php'; ?>
    <div id="page-wrapper" class="gray-bg">
        <?php include_once '../nav_top.php'; ?>
        <div class="wrapper wrapper-content">
            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>
                                패킷 테이블
                            </h5>
                        </div>
                        <div class="ibox-content">
                            <input type="text" class="form-control input-sm m-b-xs" id="filter" placeholder="찾기">
                            <table class="footable table table-stripped toggle-arrow-tiny" data-page-size="10">
                                <thead>
                                    <tr>
                                        <th >idx</th>
                                        <th>출발지 IP:Port</th>
                                        <th>도착지 IP:Port</th>
                                        <th>프로토콜</th>
                                        <th>패킷 수</th>
                                        <th>총 바이트</th>
                                        <th>시작 시간</th>
                                        <th>종료 시간</th>
                                        <th>위험 패킷</th>
                                        <th>경고 패킷</th>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="11">
                                            <div class="btn-group pull-right pagination2">

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
    </div>
</div><!-- Mainly scripts -->
<script src="/assets/lib/js/jquery-2.1.4.min.js">
</script> <script src="/assets/lib/js/bootstrap.min.js">
</script> <script src="/assets/lib/js/plugins/metisMenu/jquery.metisMenu.js">
</script> <script src="/assets/lib/js/plugins/slimscroll/jquery.slimscroll.min.js">
</script> <!-- FooTable -->
<script src="/assets/lib/js/plugins/footable/footable.all.min.js">
</script> <!-- Custom and plugin javascript -->
<script src="/assets/lib/js/inspinia.js">
</script> <script src="/assets/lib/js/plugins/pace/pace.min.js">
</script> <script src="/assets/js/common.js">
</script>
<script src="/assets/js/table.js"></script>
