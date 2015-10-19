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
                                         <?
                                            $result = $db->mysqli->query("SELECT packets.source_ip,packets.source_port,packets.destination_ip,packets.destination_port,packets.tcpudp, packet_log.name,packet_log.hazard,packet_log.payload,packet_log.createdAt FROM `packet_log` INNER JOIN packets ON packet_log.packet_idx = packets.idx");
                                            $n=0;
                                            while($row = $result->fetch_array(MYSQL_ASSOC))
                                            {
                                                $n++;
                                                echo "<tr id='". $row["idx"] ."'>";
                                                echo "<td>" . $n . "</td>";
                                                echo "<td>" . $row["source_ip"] . "</td>";
                                                echo "<td>" . $row["source_port"] . "</td>";
                                                echo "<td>" . $row["destination_ip"] . "</td>";
                                                echo "<td>" . $row["destination_port"] . "</td>";
                                                 if($row["tcpudp"] == 0)
                                                    echo "<td>" . 'TCP' . "</td>";
                                                else
                                                    echo "<td>" . 'UDP' . "</td>";
                                                echo "<td>" . $row["name"] . "</td>";
                                                echo "<td>" . $row["payload"] . "</td>";
                                                if($row["hazard"] == 0)
                                                    echo "<td>" . '<span class="label label-warning">경고</span>' . "</td>";
                                                else
                                                    echo "<td>" . '<span class="label label-danger">위험</span>' . "</td>";
                                                echo "<td>" . $row["createdAt"] . "</td>";
                                                echo "</tr>";
                                            }
                                        ?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td colspan="11">
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
        </div>
    </div>
</body>