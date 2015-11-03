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
                                <h5> 로그 리포트</h5>
                            </div>
                            <div class="ibox-content">
                                <input type="text" class="form-control input-sm m-b-xs" id="filter"
                                    placeholder="찾기">
                                <table class="footable table table-stripped toggle-arrow-tiny" data-page-size="8" data-filter=#filter>
                                    <thead>
                                        <tr>
                                            <th data-toggle="true">idx</th>
                                            <th>출발지 IP</th>
                                            <th>출발지 Port</th>
                                            <th>도착지 IP</th>
                                            <th>도착지 Port</th>
                                            <th>프로토컬</th>
                                            <th>탐지명</th>
                                            <th data-hide="all">탐지 페이로드</th>
                                            <th>위험도</th>
                                            <th>날짜</th>
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
            <script src="/assets/js/table.js"></script>
        </div>
    </div>
</body>