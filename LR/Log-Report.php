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

                    <table class="footable table table-stripped" data-page-size="8" data-filter=#filter>
                        <thead>
                        <tr>
                            <th>idx</th>
                            <th>출발지 IP</th>
														<th>출발지 Port</th>
														<th>도착지 IP</th>
														<th>도착지 Port</th>
														<th>프로토컬</th>
                            <th>탐지명</th>
                            <th>탐지 페이로드</th>
                            <th>위험도</th>
                            <th>날짜</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>1</td>
                            <td>127.0.0.1</td>
                            <td>8080</td>
                            <td>127.0.0.1</td>
                            <td>80</td>
                            <td>HTTP</td>
                            <td>Ping Pong Virus</td>
                            <td>13|12|12|smtp</td>
                            <td class="center"><span class="label label-danger">위험</span></td>
                            <td class="center">2015-06-15 12:00:00</td>
                        </tr>
                        <tr>
                            <td>1</td>
                            <td>127.0.0.1</td>
                            <td>8080</td>
                            <td>127.0.0.1</td>
                            <td>80</td>
                            <td>HTTP</td>
                            <td>Ping Pong Virus</td>
                            <td>13|12|12|smtp</td>
                            <td class="center"><span class="label label-warning">보통</span></td>
                            <td class="center">2015-06-15 12:00:00</td>
                        </tr>
                        <tr>
                            <td>1</td>
                            <td>127.0.0.1</td>
                            <td>8080</td>
                            <td>127.0.0.1</td>
                            <td>80</td>
                            <td>HTTP</td>
                            <td>Ping Pong Virus</td>
                            <td>13|12|12|smtp</td>
                            <td class="center"><span class="label label-danger">위험</span></td>
                            <td class="center">2015-06-15 12:00:00</td>
                        </tr>
                        <tr>
                            <td>1</td>
                            <td>127.0.0.1</td>
                            <td>8080</td>
                            <td>127.0.0.1</td>
                            <td>80</td>
                            <td>HTTP</td>
                            <td>Ping Pong Virus</td>
                            <td>13|12|12|smtp</td>
                            <td class="center"><span class="label label-danger">위험</span></td>
                            <td class="center">2015-06-15 12:00:00</td>
                        </tr>
                        <tr>
                            <td>1</td>
                            <td>127.0.0.1</td>
                            <td>8080</td>
                            <td>127.0.0.1</td>
                            <td>80</td>
                            <td>HTTP</td>
                            <td>Ping Pong Virus</td>
                            <td>13|12|12|smtp</td>
                            <td class="center"><span class="label label-danger">위험</span></td>
                            <td class="center">2015-06-15 12:00:00</td>
                        </tr>
                        <tr>
                            <td>1</td>
                            <td>127.0.0.1</td>
                            <td>8080</td>
                            <td>127.0.0.1</td>
                            <td>80</td>
                            <td>HTTP</td>
                            <td>Ping Pong Virus</td>
                            <td>13|12|12|smtp</td>
                            <td class="center"><span class="label label-danger">위험</span></td>
                            <td class="center">2015-06-15 12:00:00</td>
                        </tr>
                        <tr>
                            <td>1</td>
                            <td>127.0.0.1</td>
                            <td>8080</td>
                            <td>127.0.0.1</td>
                            <td>80</td>
                            <td>HTTP</td>
                            <td>Ping Pong Virus</td>
                            <td>13|12|12|smtp</td>
                            <td class="center"><span class="label label-danger">위험</span></td>
                            <td class="center">2015-06-15 12:00:00</td>
                        </tr>
                        <tr>
                            <td>1</td>
                            <td>127.0.0.1</td>
                            <td>8080</td>
                            <td>127.0.0.1</td>
                            <td>80</td>
                            <td>HTTP</td>
                            <td>Ping Pong Virus</td>
                            <td>13|12|12|smtp</td>
                            <td class="center"><span class="label label-danger">위험</span></td>
                            <td class="center">2015-06-15 12:00:00</td>
                        </tr>
                        </tbody>
                        <tfoot>
                        <tr>
                            <td colspan="10">
                                <ul class="pagination pull-right"></ul>
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
        $(document).ready(function() {

            $('.footable').footable();

        });

    </script>

