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

                    <table class="footable table table-stripped" data-page-size="7" data-filter=#filter>
                        <thead>
                        <tr>
                            <th>idx</th>
                            <th>유저 닉네임</th>
														<th>아이피</th>
														<th>최근 날짜</th>
														<th>등록한 날짜</th>
														<th>상태</th>
														<th>기능</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>1</td>
                            <th>Computer 1</th>
                            <td>127.0.0.1</td>
                            <td class="center">2015-06-15 12:00:00</td>
                            <td class="center">2015-06-15 12:00:00</td>
                            <td class="center"><span class="label label-success">정상</span></td>
                            <td>
	                            <div class="btn-group">
                                <button class="btn-white btn btn-xs">패킷보기</button>
                                <button class="btn-white btn btn-xs">차단하기</button>
                                <button class="btn-white btn btn-xs">지우기</button>
                              </div>
                            </td>
                        </tr>
                        <tr>
                            <td>1</td>
                            <th>Computer 1</th>
                            <td>127.0.0.1</td>
                            <td class="center">2015-06-15 12:00:00</td>
                            <td class="center">2015-06-15 12:00:00</td>
                            <td class="center"><span class="label label-danger">차단</span></td>
                            <td class="center"><div class="btn-group">
                                    <button class="btn-white btn btn-xs">패킷보기</button>
                                    <button class="btn-white btn btn-xs">차단하기</button>
                                    <button class="btn-white btn btn-xs">지우기</button>
                                </div></td>
                        </tr>
                        <tr>
                            <td>1</td>
                            <th>Computer 1</th>
                            <td>127.0.0.1</td>
                            <td class="center">2015-06-15 12:00:00</td>
                            <td class="center">2015-06-15 12:00:00</td>
                            <td class="center"><span class="label label-danger">차단</span></td>
                            <td class="center"><div class="btn-group">
                                    <button class="btn-white btn btn-xs">패킷보기</button>
                                    <button class="btn-white btn btn-xs">차단하기</button>
                                    <button class="btn-white btn btn-xs">지우기</button>
                                </div></td>
                        </tr>
                        <tr>
                            <td>1</td>
                            <th>Computer 1</th>
                            <td>127.0.0.1</td>
                            <td class="center">2015-06-15 12:00:00</td>
                            <td class="center">2015-06-15 12:00:00</td>
                            <td class="center"><span class="label label-danger">차단</span></td>
                            <td class="center"><div class="btn-group">
                                    <button class="btn-white btn btn-xs">패킷보기</button>
                                    <button class="btn-white btn btn-xs">차단하기</button>
                                    <button class="btn-white btn btn-xs">지우기</button>
                                </div></td>
                        </tr>
                        <tr>
                            <td>1</td>
                            <th>Computer 1</th>
                            <td>127.0.0.1</td>
                            <td class="center">2015-06-15 12:00:00</td>
                            <td class="center">2015-06-15 12:00:00</td>
                            <td class="center"><span class="label label-danger">차단</span></td>
                            <td class="center"><div class="btn-group">
                                    <button class="btn-white btn btn-xs">패킷보기</button>
                                    <button class="btn-white btn btn-xs">차단하기</button>
                                    <button class="btn-white btn btn-xs">지우기</button>
                                </div></td>
                        </tr>
                        <tr>
                            <td>1</td>
                            <th>Computer 1</th>
                            <td>127.0.0.1</td>
                            <td class="center">2015-06-15 12:00:00</td>
                            <td class="center">2015-06-15 12:00:00</td>
                            <td class="center"><span class="label label-danger">차단</span></td>
                            <td class="center"><div class="btn-group">
                                    <button class="btn-white btn btn-xs">패킷보기</button>
                                    <button class="btn-white btn btn-xs">차단하기</button>
                                    <button class="btn-white btn btn-xs">지우기</button>
                                </div></td>
                        </tr>
                        <tr>
                            <td>1</td>
                            <th>Computer 1</th>
                            <td>127.0.0.1</td>
                            <td class="center">2015-06-15 12:00:00</td>
                            <td class="center">2015-06-15 12:00:00</td>
                            <td class="center"><span class="label label-danger">차단</span></td>
                            <td class="center"><div class="btn-group">
                                    <button class="btn-white btn btn-xs">패킷보기</button>
                                    <button class="btn-white btn btn-xs">차단하기</button>
                                    <button class="btn-white btn btn-xs">지우기</button>
                                </div></td>
                        </tr>
                        <tr>
                            <td>1</td>
                            <th>Computer 1</th>
                            <td>127.0.0.1</td>
                            <td class="center">2015-06-15 12:00:00</td>
                            <td class="center">2015-06-15 12:00:00</td>
                            <td class="center"><span class="label label-danger">차단</span></td>
                            <td class="center"><div class="btn-group">
                                    <button class="btn-white btn btn-xs">패킷보기</button>
                                    <button class="btn-white btn btn-xs">차단하기</button>
                                    <button class="btn-white btn btn-xs">지우기</button>
                                </div></td>
                        </tr>
												<tr>
                            <td>1</td>
                            <th>Computer 1</th>
                            <td>127.0.0.1</td>
                            <td class="center">2015-06-15 12:00:00</td>
                            <td class="center">2015-06-15 12:00:00</td>
                            <td class="center"><span class="label label-danger">차단</span></td>
                            <td class="center"><div class="btn-group">
                                    <button class="btn-white btn btn-xs">패킷보기</button>
                                    <button class="btn-white btn btn-xs">차단하기</button>
                                    <button class="btn-white btn btn-xs">지우기</button>
                                </div></td>
                        </tr>
                        <tr>
                            <td>1</td>
                            <th>Computer 1</th>
                            <td>127.0.0.1</td>
                            <td class="center">2015-06-15 12:00:00</td>
                            <td class="center">2015-06-15 12:00:00</td>
                            <td class="center"><span class="label label-danger">차단</span></td>
                            <td class="center"><div class="btn-group">
                                    <button class="btn-white btn btn-xs">패킷보기</button>
                                    <button class="btn-white btn btn-xs">차단하기</button>
                                    <button class="btn-white btn btn-xs">지우기</button>
                                </div></td>
                        </tr>
                        <tr>
                            <td>1</td>
                            <th>Computer 1</th>
                            <td>127.0.0.1</td>
                            <td class="center">2015-06-15 12:00:00</td>
                            <td class="center">2015-06-15 12:00:00</td>
                            <td class="center"><span class="label label-danger">차단</span></td>
                            <td class="center"><div class="btn-group">
                                    <button class="btn-white btn btn-xs">패킷보기</button>
                                    <button class="btn-white btn btn-xs">차단하기</button>
                                    <button class="btn-white btn btn-xs">지우기</button>
                                </div></td>
                        </tr>
                        
                        </tbody>
                        <tfoot>
                        <tr>
                            <td colspan="7">
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

