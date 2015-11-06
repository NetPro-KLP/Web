<?php include_once 'header.php'; ?>
<link href="/assets/css/Country-Traffic.css" rel="stylesheet">
<body class="skin-1">
    <div id="wrapper">
        <?php include_once 'nav_left.php'; ?>
        <div id="page-wrapper" class="gray-bg">
            <?php include_once 'nav_top.php'; ?>
            <?
                $sql1 = $db->mysqli->query("SELECT sum(packets.totalbytes) as sum FROM users JOIN packets ON users.ip = packets.destination_ip");
                $sql2 = $db->mysqli->query("SELECT sum(packets.totalbytes) as sum FROM users JOIN packets ON users.ip = packets.source_ip");
                $sql3 = $db->mysqli->query("SELECT count(idx) as count FROM packets");
                $sql4 = $db->mysqli->query("SELECT count(idx) as count FROM users");
                $sql5 = $db->mysqli->query("SELECT * from packet_log");
                $row1 = mysqli_fetch_assoc($sql1);
                $row2 = mysqli_fetch_assoc($sql2);
                $row3 = mysqli_fetch_assoc($sql3);
                $row4 = mysqli_fetch_assoc($sql4);
            ?>
            <div class="wrapper wrapper-content">
                <div class="row">
                    <div class="col-lg-3">
                        <div class="ibox float-e-margins">
                            <div class="ibox-title">
                                <span class="label label-primary pull-right">정상</span>
                                <h5>인바운드</h5>
                            </div>
                            <div class="ibox-content">
                                <h1 class="no-margins"><?=number_format($row1['sum']/1024)?></h1>
                                <small>/MB</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="ibox float-e-margins">
                            <div class="ibox-title">
                                <span class="label label-danger pull-right">위험</span>
                                <h5>아웃바운드</h5>
                            </div>
                            <div class="ibox-content">
                                <h1 class="no-margins"><?=number_format($row2['sum']/1024)?></h1>
                                <small>/MB</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="ibox float-e-margins">
                            <div class="ibox-title">
                                <span class="label label-warning pull-right">경고</span>
                                <h5>패킷</h5>
                            </div>
                            <div class="ibox-content">
                                <h1 class="no-margins"><?=number_format($row3['count'])?></h1>
                                <small>개</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="ibox float-e-margins">
                            <div class="ibox-title">
                                <h5>내부 유저</h5>
                            </div>
                            <div class="ibox-content">
                                <h1 class="no-margins"><?=number_format($row4['count'])?></h1>
                                <small>명</small>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="ibox float-e-margins">
                            <div class="ibox-title">
                                <h5>트래픽 양</h5>
                                <div class="pull-right">
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-xs btn-white active">어제</button>
                                        <button type="button" class="btn btn-xs btn-white">오늘</button>
                                        <button type="button" class="btn btn-xs btn-white">이번 달</button>
                                    </div>
                                </div>
                            </div>
                            <div class="ibox-content">
                                <div class="row">
                                    <div class="col-lg-9">
                                        <div class="flot-chart">
                                            <div class="flot-chart-content" id="flot-dashboard-chart"></div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <ul class="stat-list">
                                            <li>
                                                <h2 class="no-margins">2,346</h2>
                                                <small>TCP</small>
                                                <div class="stat-percent">48% <i class="fa fa-level-up text-navy"></i></div>
                                                <div class="progress progress-mini">
                                                    <div style="width: 48%;" class="progress-bar"></div>
                                                </div>
                                            </li>
                                            <li>
                                                <h2 class="no-margins ">4,422</h2>
                                                <small>UDP</small>
                                                <div class="stat-percent">60% <i class="fa fa-level-down text-navy"></i></div>
                                                <div class="progress progress-mini">
                                                    <div style="width: 60%;" class="progress-bar"></div>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-4">
                        <div class="ibox float-e-margins">
                            <div class="ibox-title">
                                <h5>차단 메세지</h5>
                                <div class="ibox-tools">
                                    <a class="collapse-link">
                                    <i class="fa fa-chevron-up"></i>
                                    </a>
                                    <a class="close-link">
                                    <i class="fa fa-times"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="ibox-content ibox-heading">
                                <h3><i class="fa fa-envelope-o"></i> 새로운 로그</h3>
                                <small><i class="fa fa-tim"></i>아직 읽지 않은 패킷 차단 로그가 <?=$sql5->num_rows?>개 있습니다.</small>
                            </div>
                            <div class="ibox-content">
                                <div class="feed-activity-list">
                                    <?
                                    while($row5 = $sql5->fetch_array(MYSQL_ASSOC)){
                                        if($row5["hazard"] == 0)
                                            $row5["hazard"] = "<i class=\"fa fa-circle text-warning\"></i>";
                                        else
                                            $row5["hazard"] = "<i class=\"fa fa-circle text-danger\"></i>";
                                    ?>
                                    <div class="feed-element">
                                        <div>
                                            <small class="pull-right text-navy">[ <?=$row5["payload"]?> ]</small>
                                            <?=$row5["hazard"]?> <strong><?=$row5["name"]?></strong>
                                            <small class="text-muted"><?=$row5["createdAt"]?></small>
                                        </div>
                                    </div>
                                    <?
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-8">
                        <div class="ibox float-e-margins">
                            <div class="ibox-title">
                                <h5>국가별 트래픽</h5>
                            </div>
                            <div class="ibox-content">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div id="world-map" style="height: 480px;"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="ibox-footer">
                                <div class="size-group">
                                    <span class="label">차단됨</span>
                                    <span class="label label-danger">30,000MB 이상</span>
                                    <span class="label label-warning">10,000MB 이상</span>
                                    <span class="label label-success">100MB 이상</span>
                                    <span class="label label-primary">0MB</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="right-sidebar">
        <div class="sidebar-container">
            <ul class="nav nav-tabs navs-3">
                <li class="active"><a data-toggle="tab" href="#tab-1">
                    Notes
                    </a>
                </li>
                <li><a data-toggle="tab" href="#tab-2">
                    Projects
                    </a>
                </li>
                <li class=""><a data-toggle="tab" href="#tab-3">
                    <i class="fa fa-gear"></i>
                    </a>
                </li>
            </ul>
            <div class="tab-content">
                <div id="tab-1" class="tab-pane active">
                    <div class="sidebar-title">
                        <h3> <i class="fa fa-comments-o"></i> Latest Notes</h3>
                        <small><i class="fa fa-tim"></i> You have 10 new message.</small>
                    </div>
                    <div>
                        <div class="sidebar-message">
                            <a href="#">
                                <div class="pull-left text-center">
                                    <img alt="image" class="img-circle message-avatar" src="img/a1.jpg">
                                    <div class="m-t-xs">
                                        <i class="fa fa-star text-warning"></i>
                                        <i class="fa fa-star text-warning"></i>
                                    </div>
                                </div>
                                <div class="media-body">
                                    There are many variations of passages of Lorem Ipsum available.
                                    <br>
                                    <small class="text-muted">Today 4:21 pm</small>
                                </div>
                            </a>
                        </div>
                        <div class="sidebar-message">
                            <a href="#">
                                <div class="pull-left text-center">
                                    <img alt="image" class="img-circle message-avatar" src="img/a2.jpg">
                                </div>
                                <div class="media-body">
                                    The point of using Lorem Ipsum is that it has a more-or-less normal.
                                    <br>
                                    <small class="text-muted">Yesterday 2:45 pm</small>
                                </div>
                            </a>
                        </div>
                        <div class="sidebar-message">
                            <a href="#">
                                <div class="pull-left text-center">
                                    <img alt="image" class="img-circle message-avatar" src="img/a3.jpg">
                                    <div class="m-t-xs">
                                        <i class="fa fa-star text-warning"></i>
                                        <i class="fa fa-star text-warning"></i>
                                        <i class="fa fa-star text-warning"></i>
                                    </div>
                                </div>
                                <div class="media-body">
                                    Mevolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).
                                    <br>
                                    <small class="text-muted">Yesterday 1:10 pm</small>
                                </div>
                            </a>
                        </div>
                        <div class="sidebar-message">
                            <a href="#">
                                <div class="pull-left text-center">
                                    <img alt="image" class="img-circle message-avatar" src="img/a4.jpg">
                                </div>
                                <div class="media-body">
                                    Lorem Ipsum, you need to be sure there isn't anything embarrassing hidden in the
                                    <br>
                                    <small class="text-muted">Monday 8:37 pm</small>
                                </div>
                            </a>
                        </div>
                        <div class="sidebar-message">
                            <a href="#">
                                <div class="pull-left text-center">
                                    <img alt="image" class="img-circle message-avatar" src="img/a8.jpg">
                                </div>
                                <div class="media-body">
                                    All the Lorem Ipsum generators on the Internet tend to repeat.
                                    <br>
                                    <small class="text-muted">Today 4:21 pm</small>
                                </div>
                            </a>
                        </div>
                        <div class="sidebar-message">
                            <a href="#">
                                <div class="pull-left text-center">
                                    <img alt="image" class="img-circle message-avatar" src="img/a7.jpg">
                                </div>
                                <div class="media-body">
                                    Renaissance. The first line of Lorem Ipsum, "Lorem ipsum dolor sit amet..", comes from a line in section 1.10.32.
                                    <br>
                                    <small class="text-muted">Yesterday 2:45 pm</small>
                                </div>
                            </a>
                        </div>
                        <div class="sidebar-message">
                            <a href="#">
                                <div class="pull-left text-center">
                                    <img alt="image" class="img-circle message-avatar" src="img/a3.jpg">
                                    <div class="m-t-xs">
                                        <i class="fa fa-star text-warning"></i>
                                        <i class="fa fa-star text-warning"></i>
                                        <i class="fa fa-star text-warning"></i>
                                    </div>
                                </div>
                                <div class="media-body">
                                    The standard chunk of Lorem Ipsum used since the 1500s is reproduced below.
                                    <br>
                                    <small class="text-muted">Yesterday 1:10 pm</small>
                                </div>
                            </a>
                        </div>
                        <div class="sidebar-message">
                            <a href="#">
                                <div class="pull-left text-center">
                                    <img alt="image" class="img-circle message-avatar" src="img/a4.jpg">
                                </div>
                                <div class="media-body">
                                    Uncover many web sites still in their infancy. Various versions have.
                                    <br>
                                    <small class="text-muted">Monday 8:37 pm</small>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                <div id="tab-2" class="tab-pane">
                    <div class="sidebar-title">
                        <h3> <i class="fa fa-cube"></i> Latest projects</h3>
                        <small><i class="fa fa-tim"></i> You have 14 projects. 10 not completed.</small>
                    </div>
                    <ul class="sidebar-list">
                        <li>
                            <a href="#">
                                <div class="small pull-right m-t-xs">9 hours ago</div>
                                <h4>Business valuation</h4>
                                It is a long established fact that a reader will be distracted.
                                <div class="small">Completion with: 22%</div>
                                <div class="progress progress-mini">
                                    <div style="width: 22%;" class="progress-bar progress-bar-warning"></div>
                                </div>
                                <div class="small text-muted m-t-xs">Project end: 4:00 pm - 12.06.2014</div>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <div class="small pull-right m-t-xs">9 hours ago</div>
                                <h4>Contract with Company </h4>
                                Many desktop publishing packages and web page editors.
                                <div class="small">Completion with: 48%</div>
                                <div class="progress progress-mini">
                                    <div style="width: 48%;" class="progress-bar"></div>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <div class="small pull-right m-t-xs">9 hours ago</div>
                                <h4>Meeting</h4>
                                By the readable content of a page when looking at its layout.
                                <div class="small">Completion with: 14%</div>
                                <div class="progress progress-mini">
                                    <div style="width: 14%;" class="progress-bar progress-bar-info"></div>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <span class="label label-primary pull-right">NEW</span>
                                <h4>The generated</h4>
                                There are many variations of passages of Lorem Ipsum available.
                                <div class="small">Completion with: 22%</div>
                                <div class="small text-muted m-t-xs">Project end: 4:00 pm - 12.06.2014</div>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <div class="small pull-right m-t-xs">9 hours ago</div>
                                <h4>Business valuation</h4>
                                It is a long established fact that a reader will be distracted.
                                <div class="small">Completion with: 22%</div>
                                <div class="progress progress-mini">
                                    <div style="width: 22%;" class="progress-bar progress-bar-warning"></div>
                                </div>
                                <div class="small text-muted m-t-xs">Project end: 4:00 pm - 12.06.2014</div>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <div class="small pull-right m-t-xs">9 hours ago</div>
                                <h4>Contract with Company </h4>
                                Many desktop publishing packages and web page editors.
                                <div class="small">Completion with: 48%</div>
                                <div class="progress progress-mini">
                                    <div style="width: 48%;" class="progress-bar"></div>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <div class="small pull-right m-t-xs">9 hours ago</div>
                                <h4>Meeting</h4>
                                By the readable content of a page when looking at its layout.
                                <div class="small">Completion with: 14%</div>
                                <div class="progress progress-mini">
                                    <div style="width: 14%;" class="progress-bar progress-bar-info"></div>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <span class="label label-primary pull-right">NEW</span>
                                <h4>The generated</h4>
                                There are many variations of passages of Lorem Ipsum available.
                                <div class="small">Completion with: 22%</div>
                                <div class="small text-muted m-t-xs">Project end: 4:00 pm - 12.06.2014</div>
                            </a>
                        </li>
                    </ul>
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
    <!-- Flot -->
    <script src="/assets/lib/js/plugins/flot/jquery.flot.js"></script>
    <script src="/assets/lib/js/plugins/flot/jquery.flot.tooltip.min.js"></script>
    <script src="/assets/lib/js/plugins/flot/jquery.flot.spline.js"></script>
    <script src="/assets/lib/js/plugins/flot/jquery.flot.resize.js"></script>
    <script src="/assets/lib/js/plugins/flot/jquery.flot.pie.js"></script>
    <script src="/assets/lib/js/plugins/flot/jquery.flot.symbol.js"></script>
    <script src="/assets/lib/js/plugins/flot/jquery.flot.time.js"></script>
    <!-- Peity -->
    <script src="/assets/lib/js/plugins/peity/jquery.peity.min.js"></script>
    <script src="/assets/lib/js/demo/peity-demo.js"></script>
    <!-- Custom and plugin javascript -->
    <script src="/assets/lib/js/inspinia.js"></script>
    <script src="/assets/lib/js/plugins/pace/pace.min.js"></script>
    <!-- jQuery UI -->
    <script src="/assets/lib/js/plugins/jquery-ui/jquery-ui.min.js"></script>
    <!-- Jvectormap -->
    <script src="/assets/lib/js/plugins/jvectormap/jquery-jvectormap-2.0.2.min.js"></script>
    <script src="/assets/lib/js/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
    <!-- EayPIE -->
    <script src="/assets/lib/js/plugins/easypiechart/jquery.easypiechart.js"></script>
    <!-- Sparkline -->
    <script src="/assets/lib/js/plugins/sparkline/jquery.sparkline.min.js"></script>
    <!-- Sparkline demo data  -->
    <script src="/assets/lib/js/demo/sparkline-demo.js"></script>
    <!-- Toastr -->
    <script src="/assets/lib/js/plugins/toastr/toastr.min.js"></script>
    <script src="/assets/js/main.js"></script>
    <script>
        setTimeout(function() {
         toastr.options = {
             closeButton: true,
             progressBar: true,
             showMethod: 'slideDown',
             timeOut: 1500
         };
         toastr.success('<?=$result["name"]?> 서버 관리자님 환영합니다.', 'KLP-Firewall');
        }, 1300);

        var mapData;
        var mapColor = {};
        var levelcolor = ['#ed5565','#f8ac59','#1c84c6'];

        function block(func,code)
        {
            $.ajax({
                type: 'POST',
                url: "/GeoIP/ajax.php",
                data: "oper=" + func + "&code=" + code,
                success: function(res){
                    if(func == "block")
                        mapColor[code] = "#d1dade";
                    else
                    {
                        if(!mapData[code])
                            mapColor[code] = "#1ab394";
                        else
                        {
                            var mbValue = mapData[code]/1024;
                            if(mbValue >= 30000)
                                mapColor[code] = levelcolor[0];
                            else if(mbValue >= 10000)
                                mapColor[code] = levelcolor[1];
                            else if(mbValue >= 100)
                                mapColor[code] = levelcolor[2];
                        }
                    }
                    var map = $('#world-map').vectorMap('get', 'mapObject');
                    map.series.regions[0].setValues(mapColor);
                },
                error:function(err){
                    alert("데이터를 가져오는데 실패하였습니다.");
                }
            });
        }
        $(document).ready(function(){
           $.ajax({
                type: 'POST',
                url: "/GeoIP/ajax.php",
                data: "oper=trafficall",
                success: function(res){
                    mapData = JSON.parse(res);
                    for(var Code in mapData){
                        var mbValue = mapData[Code]/1024;
                        if(mbValue >= 30000)
                            mapColor[Code] = levelcolor[0];
                        else if(mbValue >= 10000)
                            mapColor[Code] = levelcolor[1];
                        else if(mbValue >= 100)
                            mapColor[Code] = levelcolor[2];
                    }
                },
                async: false,
                error:function(err){
                    alert("데이터를 가져오는데 실패하였습니다.");
                }
            });
            $.ajax({
                type: 'POST',
                url: "/GeoIP/ajax.php",
                data: "oper=blacklist",
                success: function(res){
                    var temp = res.split(",");
                    for(var i=0;i<temp.length;i++)
                        mapColor[temp[i]] = '#d1dade';
                },
                async: false,
                error:function(err){
                    alert("데이터를 가져오는데 실패하였습니다.");
                }
            });
            var map = $('#world-map').vectorMap('get', 'mapObject');
            map.series.regions[0].setValues(mapColor);
        });
        $('#world-map').vectorMap({
               map: 'world_mill_en',
               backgroundColor: "transparent",
               regionStyle: {
                   initial: {
                       fill: '#1ab394',
                       "fill-opacity": 0.9,
                       stroke: 'none',
                       "stroke-width": 0,
                       "stroke-opacity": 0
                   }
               },
            onRegionClick: function(event, code) {
                if(mapColor[code] == "#d1dade")
                    block("unblock",code);
                else
                    block("block",code);
            },
            series: {
            regions: [{
                   values: mapData,
                   attribute: 'fill'
               }]
            },
            onRegionTipShow: function(e, el, code){
                if(mapData[code])
                    el.html(el.html() + "<br>Traffic - " + mapData[code].toLocaleString() + "KB");
            }
        });
    </script>

    <script src="/assets/js/common.js"></script>
</body>
</html>