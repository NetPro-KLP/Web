<?php include_once '../header.php'; ?>
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
                            <h5>트래픽 테이블</h5>
                        </div>
                        <div class="ibox-content">
                            <input type="text" class="form-control input-sm m-b-xs" id="filter"
                                placeholder="찾기">
                            <table class="footable table table-stripped" data-page-size="7" data-filter=#filter>
                                <thead>
                                    <tr>
                                        <th>idx</th>
                                        <th>국가 코드</th>
                                        <th>국가 이름</th>
                                        <th>총 트래픽 양</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?

                                        $result = $db->mysqli->query("SELECT SUM(packets.totalbytes) as totalbytes,GeoIP.country,GeoIP.country_code FROM `packets`,`GeoIP` WHERE GeoIP.from_ip_int <= INET_ATON(packets.destination_ip) and GeoIP.to_ip_int >=INET_ATON(packets.destination_ip) GROUP BY GeoIP.country_code order by totalbytes desc");
                                        $n=0;
                                        while($row = $result->fetch_array(MYSQL_ASSOC))
                                        {
                                            $n++;
                                            echo "<tr id='". $n ."'>";
                                            echo "<td>" . $n . "</td>";
                                            echo "<td>" . $row["country_code"] . "</td>";
                                            echo "<td>" . $row["country"] . "</td>";
                                            echo "<td>" . (int)($row["totalbytes"]/1024) . " /MB</td>";
                                            echo "</tr>";
                                        }
                                        ?>
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
    </div>
    <!-- Mainly scripts -->
    <script src="/assets/lib/js/jquery-2.1.4.min.js"></script>
    <script src="/assets/lib/js/bootstrap.min.js"></script>
    <script src="/assets/lib/js/plugins/metisMenu/jquery.metisMenu.js"></script>
    <script src="/assets/lib/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>
    <!-- Custom and plugin javascript -->
    <script src="/assets/lib/js/inspinia.js"></script>
    <script src="/assets/lib/js/plugins/pace/pace.min.js"></script>
    <!-- jQuery UI -->
    <script src="/assets/lib/js/plugins/jquery-ui/jquery-ui.min.js"></script>
    <!-- Jvectormap -->
    <script src="/assets/lib/js/plugins/jvectormap/jquery-jvectormap-2.0.2.min.js"></script>
    <script src="/assets/lib/js/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
    <!-- Toastr -->
    <script src="/assets/lib/js/plugins/toastr/toastr.min.js"></script>

    <script src="/assets/js/common.js"></script>
</body>