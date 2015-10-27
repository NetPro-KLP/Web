<?php include_once '../header.php'; ?>
<link href="/assets/css/Control-Panel.css" rel="stylesheet">
<body class="skin-1">
    <div id="wrapper">
        <?php include_once '../nav_left.php'; ?>
        <div id="page-wrapper" class="gray-bg">
            <?php include_once '../nav_top.php'; ?>
            <div class="wrapper wrapper-content">
                <div class="row">
                    <?
                        $result = $db->mysqli->query("SELECT users.idx, users.ip,users.connectedAt,users.status,SUM(packets.totalbytes) as traffic,SUM(packets.danger) as danger,SUM(packets.warn) as warn FROM users JOIN packets ON users.ip = packets.source_ip or users.ip = packets.destination_ip GROUP BY users.idx LIMIT 10");
                        while($row = $result->fetch_array(MYSQL_ASSOC))
                        {
                            echo '<div class="col-xs-6 col-lg-2 user-box" id="' . $row["idx"] . '"><div class="ibox float-e-margins"><div class="ibox-title">';
                            echo '<span class="badge badge-danger error-sign">' . $row["danger"] . '</span>';
                            echo '<span class="badge badge-warning warn-sign">' . $row["warn"] . '</span>';
                            echo '<a class="dropdown-toggle tool-set" data-toggle="dropdown" href="#"><i class="fa fa-wrench"></i></a>';
                            echo '<ul class="dropdown-menu dropdown-user option">
                                    <li><a class="show-packet" href="#">패킷보기</a></li>
                                    <li><a class="block" href="#">차단하기</a></li>
                                    <li><a class="remove" href="#">지우기</a></li>
                                </ul>';
                            if($row["status"] == 0)
                                echo '<span class="label label-success pull-right">정상</span>';
                            else
                                echo '<span class="label label-danger pull-right">차단</span>';
                            echo '<h5 class="ip">' . $row["ip"] . '</h5>';
                            echo '<h7 class="date">' . $row["connectedAt"] . '</h7></div>';
                            echo '<div class="ibox-content"><h5 class="traffic-span">Traffic</h5>';
                            echo '<span><small>' . number_format($row["traffic"]) . '/kb</small></span>';
                            echo '<span data-diameter="10" class="updating-chart" data-chart="' . $row["idx"] .'"></span>';
                            echo '</div></div></div>';
                        }
                    ?>
                </div>
            </div>
        </div>
    </div>
    <!-- Mainly scripts -->
    <script src="/assets/lib/js/jquery-2.1.4.min.js"></script>
    <script src="/assets/lib/js/bootstrap.min.js"></script>
    <script src="/assets/lib/js/plugins/metisMenu/jquery.metisMenu.js"></script>
    <script src="/assets/lib/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>
    <!-- Peity -->
    <script src="/assets/lib/js/plugins/peity/jquery.peity.min.js"></script>
    <!-- Custom and plugin javascript -->
    <script src="/assets/lib/js/inspinia.js"></script>
    <script src="/assets/lib/js/plugins/pace/pace.min.js"></script>
    <script src="/assets/js/Control-Panel.js"></script>
    <script src="/assets/js/common.js"></script>
</body>