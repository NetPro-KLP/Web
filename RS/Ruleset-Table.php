<?php include_once '../header.php'; ?>
<link href="/assets/lib/css/plugins/jqGrid/ui.jqgrid.css" rel="stylesheet">
<body class="skin-1">
  <div id="wrapper">
    <?php include_once '../nav_left.php'; ?>
    <div id="page-wrapper" class="gray-bg">
      <?php include_once '../nav_top.php'; ?>
       <div class="wrapper wrapper-content  animated fadeInRight">
            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox ">
                        <div class="ibox-title">
                            <h5>룰셋 테이블</h5>
                        </div>
                        <div class="ibox-content">
                            <div class="jqGrid_wrapper">
                                <table id="table_list_2"></table>
                                <div id="pager_list_2"></div>
                            </div>
                        </div>
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

    <!-- Peity -->
    <script src="/assets/lib/js/plugins/peity/jquery.peity.min.js"></script>

    <!-- jqGrid -->
    <script src="/assets/lib/js/plugins/jqGrid/i18n/grid.locale-en.js"></script>
    <script src="/assets/lib/js/plugins/jqGrid/jquery.jqGrid.min.js"></script>
    
    <!-- Custom and plugin javascript -->
    <script src="/assets/lib/js/inspinia.js"></script>
    <script src="/assets/lib/js/plugins/pace/pace.min.js"></script>
		
		<script src="/assets/js/Control-Panel.js"></script>
		<script src="/assets/js/common.js"></script>
		<script>
        $(document).ready(function () {


            // Examle data for jqGrid
            var mydata = [
                {idx: '1', packet: '# alert tcp $EXTERNAL_NET $HTTP_PORTS -> $HOME_NET any (msg:"INDICATOR-COMPROMISE IP only webpage redirect attempt"; flow:to_client,established; file_data; content:"document.location="; pcre:"/^[^>]*\x2f\x2f\d{1,3}\x2e\d{1,3}\x2e\d{1,3}\x2e\d{1,3}/sR"; metadata:ruleset community, service http; classtype:bad-unknown; sid:24254; rev:6;)'},
                {idx: '2',packet: 'alert tcp $HOME_NET any -> $EXTERNAL_NET 84 (msg:"MALWARE-OTHER Malicious UA detected on non-standard port"; flow:to_server,established; content:"User-Agent|3A| Mozilla/5.0 |28|Windows|3B| U|3B| MSIE 9.0|3B| Windows NT 9.0|3B| en-US|29|"; detection_filter:track by_src, count 1, seconds 120; metadata:policy balanced-ips drop, policy security-ips drop, ruleset community; reference:url,anubis.iseclab.org/?action=result&task_id=1691c3b8835221fa4692960681f39c736&format=html; classtype:trojan-activity; sid:24265; rev:4;)'},
                {idx: '3',packet: 'alert tcp $HOME_NET any -> $EXTERNAL_NET 84 (msg:"MALWARE-OTHER Malicious UA detected on non-standard port"; flow:to_server,established; content:"User-Agent|3A| Mozilla/5.0 |28|Windows|3B| U|3B| MSIE 9.0|3B| Windows NT 9.0|3B| en-US|29|"; detection_filter:track by_src, count 1, seconds 120; metadata:policy balanced-ips drop, policy security-ips drop, ruleset community; reference:url,anubis.iseclab.org/?action=result&task_id=1691c3b8835221fa4692960681f39c736&format=html; classtype:trojan-activity; sid:24265; rev:4;)'},
                {idx: '4',packet: 'alert tcp $HOME_NET any -> $EXTERNAL_NET 84 (msg:"MALWARE-OTHER Malicious UA detected on non-standard port"; flow:to_server,established; content:"User-Agent|3A| Mozilla/5.0 |28|Windows|3B| U|3B| MSIE 9.0|3B| Windows NT 9.0|3B| en-US|29|"; detection_filter:track by_src, count 1, seconds 120; metadata:policy balanced-ips drop, policy security-ips drop, ruleset community; reference:url,anubis.iseclab.org/?action=result&task_id=1691c3b8835221fa4692960681f39c736&format=html; classtype:trojan-activity; sid:24265; rev:4;)'},
                {idx: '5',packet: 'alert tcp $HOME_NET any -> $EXTERNAL_NET 84 (msg:"MALWARE-OTHER Malicious UA detected on non-standard port"; flow:to_server,established; content:"User-Agent|3A| Mozilla/5.0 |28|Windows|3B| U|3B| MSIE 9.0|3B| Windows NT 9.0|3B| en-US|29|"; detection_filter:track by_src, count 1, seconds 120; metadata:policy balanced-ips drop, policy security-ips drop, ruleset community; reference:url,anubis.iseclab.org/?action=result&task_id=1691c3b8835221fa4692960681f39c736&format=html; classtype:trojan-activity; sid:24265; rev:4;)'},
                {idx: '6',packet: 'alert tcp $HOME_NET any -> $EXTERNAL_NET 84 (msg:"MALWARE-OTHER Malicious UA detected on non-standard port"; flow:to_server,established; content:"User-Agent|3A| Mozilla/5.0 |28|Windows|3B| U|3B| MSIE 9.0|3B| Windows NT 9.0|3B| en-US|29|"; detection_filter:track by_src, count 1, seconds 120; metadata:policy balanced-ips drop, policy security-ips drop, ruleset community; reference:url,anubis.iseclab.org/?action=result&task_id=1691c3b8835221fa4692960681f39c736&format=html; classtype:trojan-activity; sid:24265; rev:4;)'},
                {idx: '7',packet: 'alert tcp $HOME_NET any -> $EXTERNAL_NET 84 (msg:"MALWARE-OTHER Malicious UA detected on non-standard port"; flow:to_server,established; content:"User-Agent|3A| Mozilla/5.0 |28|Windows|3B| U|3B| MSIE 9.0|3B| Windows NT 9.0|3B| en-US|29|"; detection_filter:track by_src, count 1, seconds 120; metadata:policy balanced-ips drop, policy security-ips drop, ruleset community; reference:url,anubis.iseclab.org/?action=result&task_id=1691c3b8835221fa4692960681f39c736&format=html; classtype:trojan-activity; sid:24265; rev:4;)'},
                {idx: '8',packet: 'alert tcp $HOME_NET any -> $EXTERNAL_NET 84 (msg:"MALWARE-OTHER Malicious UA detected on non-standard port"; flow:to_server,established; content:"User-Agent|3A| Mozilla/5.0 |28|Windows|3B| U|3B| MSIE 9.0|3B| Windows NT 9.0|3B| en-US|29|"; detection_filter:track by_src, count 1, seconds 120; metadata:policy balanced-ips drop, policy security-ips drop, ruleset community; reference:url,anubis.iseclab.org/?action=result&task_id=1691c3b8835221fa4692960681f39c736&format=html; classtype:trojan-activity; sid:24265; rev:4;)'},
                {idx: '9',packet: 'alert tcp $HOME_NET any -> $EXTERNAL_NET 84 (msg:"MALWARE-OTHER Malicious UA detected on non-standard port"; flow:to_server,established; content:"User-Agent|3A| Mozilla/5.0 |28|Windows|3B| U|3B| MSIE 9.0|3B| Windows NT 9.0|3B| en-US|29|"; detection_filter:track by_src, count 1, seconds 120; metadata:policy balanced-ips drop, policy security-ips drop, ruleset community; reference:url,anubis.iseclab.org/?action=result&task_id=1691c3b8835221fa4692960681f39c736&format=html; classtype:trojan-activity; sid:24265; rev:4;)'},
                {idx: '10',packet: 'alert tcp $HOME_NET any -> $EXTERNAL_NET 84 (msg:"MALWARE-OTHER Malicious UA detected on non-standard port"; flow:to_server,established; content:"User-Agent|3A| Mozilla/5.0 |28|Windows|3B| U|3B| MSIE 9.0|3B| Windows NT 9.0|3B| en-US|29|"; detection_filter:track by_src, count 1, seconds 120; metadata:policy balanced-ips drop, policy security-ips drop, ruleset community; reference:url,anubis.iseclab.org/?action=result&task_id=1691c3b8835221fa4692960681f39c736&format=html; classtype:trojan-activity; sid:24265; rev:4;)'},
                {idx: '11',packet: 'alert tcp $HOME_NET any -> $EXTERNAL_NET 84 (msg:"MALWARE-OTHER Malicious UA detected on non-standard port"; flow:to_server,established; content:"User-Agent|3A| Mozilla/5.0 |28|Windows|3B| U|3B| MSIE 9.0|3B| Windows NT 9.0|3B| en-US|29|"; detection_filter:track by_src, count 1, seconds 120; metadata:policy balanced-ips drop, policy security-ips drop, ruleset community; reference:url,anubis.iseclab.org/?action=result&task_id=1691c3b8835221fa4692960681f39c736&format=html; classtype:trojan-activity; sid:24265; rev:4;)'},
                {idx: '12',packet: 'alert tcp $HOME_NET any -> $EXTERNAL_NET 84 (msg:"MALWARE-OTHER Malicious UA detected on non-standard port"; flow:to_server,established; content:"User-Agent|3A| Mozilla/5.0 |28|Windows|3B| U|3B| MSIE 9.0|3B| Windows NT 9.0|3B| en-US|29|"; detection_filter:track by_src, count 1, seconds 120; metadata:policy balanced-ips drop, policy security-ips drop, ruleset community; reference:url,anubis.iseclab.org/?action=result&task_id=1691c3b8835221fa4692960681f39c736&format=html; classtype:trojan-activity; sid:24265; rev:4;)'},
                {idx: '13',packet: 'alert tcp $HOME_NET any -> $EXTERNAL_NET 84 (msg:"MALWARE-OTHER Malicious UA detected on non-standard port"; flow:to_server,established; content:"User-Agent|3A| Mozilla/5.0 |28|Windows|3B| U|3B| MSIE 9.0|3B| Windows NT 9.0|3B| en-US|29|"; detection_filter:track by_src, count 1, seconds 120; metadata:policy balanced-ips drop, policy security-ips drop, ruleset community; reference:url,anubis.iseclab.org/?action=result&task_id=1691c3b8835221fa4692960681f39c736&format=html; classtype:trojan-activity; sid:24265; rev:4;)'},
                {idx: '14',packet: 'alert tcp $HOME_NET any -> $EXTERNAL_NET 84 (msg:"MALWARE-OTHER Malicious UA detected on non-standard port"; flow:to_server,established; content:"User-Agent|3A| Mozilla/5.0 |28|Windows|3B| U|3B| MSIE 9.0|3B| Windows NT 9.0|3B| en-US|29|"; detection_filter:track by_src, count 1, seconds 120; metadata:policy balanced-ips drop, policy security-ips drop, ruleset community; reference:url,anubis.iseclab.org/?action=result&task_id=1691c3b8835221fa4692960681f39c736&format=html; classtype:trojan-activity; sid:24265; rev:4;)'},
                {idx: '15',packet: 'alert tcp $HOME_NET any -> $EXTERNAL_NET 84 (msg:"MALWARE-OTHER Malicious UA detected on non-standard port"; flow:to_server,established; content:"User-Agent|3A| Mozilla/5.0 |28|Windows|3B| U|3B| MSIE 9.0|3B| Windows NT 9.0|3B| en-US|29|"; detection_filter:track by_src, count 1, seconds 120; metadata:policy balanced-ips drop, policy security-ips drop, ruleset community; reference:url,anubis.iseclab.org/?action=result&task_id=1691c3b8835221fa4692960681f39c736&format=html; classtype:trojan-activity; sid:24265; rev:4;)'},
                {idx: '16',packet: 'alert tcp $HOME_NET any -> $EXTERNAL_NET 84 (msg:"MALWARE-OTHER Malicious UA detected on non-standard port"; flow:to_server,established; content:"User-Agent|3A| Mozilla/5.0 |28|Windows|3B| U|3B| MSIE 9.0|3B| Windows NT 9.0|3B| en-US|29|"; detection_filter:track by_src, count 1, seconds 120; metadata:policy balanced-ips drop, policy security-ips drop, ruleset community; reference:url,anubis.iseclab.org/?action=result&task_id=1691c3b8835221fa4692960681f39c736&format=html; classtype:trojan-activity; sid:24265; rev:4;)'},
                {idx: '17',packet: 'alert tcp $HOME_NET any -> $EXTERNAL_NET 84 (msg:"MALWARE-OTHER Malicious UA detected on non-standard port"; flow:to_server,established; content:"User-Agent|3A| Mozilla/5.0 |28|Windows|3B| U|3B| MSIE 9.0|3B| Windows NT 9.0|3B| en-US|29|"; detection_filter:track by_src, count 1, seconds 120; metadata:policy balanced-ips drop, policy security-ips drop, ruleset community; reference:url,anubis.iseclab.org/?action=result&task_id=1691c3b8835221fa4692960681f39c736&format=html; classtype:trojan-activity; sid:24265; rev:4;)'},
                {idx: '18',packet: 'alert tcp $HOME_NET any -> $EXTERNAL_NET 84 (msg:"MALWARE-OTHER Malicious UA detected on non-standard port"; flow:to_server,established; content:"User-Agent|3A| Mozilla/5.0 |28|Windows|3B| U|3B| MSIE 9.0|3B| Windows NT 9.0|3B| en-US|29|"; detection_filter:track by_src, count 1, seconds 120; metadata:policy balanced-ips drop, policy security-ips drop, ruleset community; reference:url,anubis.iseclab.org/?action=result&task_id=1691c3b8835221fa4692960681f39c736&format=html; classtype:trojan-activity; sid:24265; rev:4;)'},
                {idx: '19',packet: 'alert tcp $HOME_NET any -> $EXTERNAL_NET 84 (msg:"MALWARE-OTHER Malicious UA detected on non-standard port"; flow:to_server,established; content:"User-Agent|3A| Mozilla/5.0 |28|Windows|3B| U|3B| MSIE 9.0|3B| Windows NT 9.0|3B| en-US|29|"; detection_filter:track by_src, count 1, seconds 120; metadata:policy balanced-ips drop, policy security-ips drop, ruleset community; reference:url,anubis.iseclab.org/?action=result&task_id=1691c3b8835221fa4692960681f39c736&format=html; classtype:trojan-activity; sid:24265; rev:4;)'},
                {idx: '20',packet: 'alert tcp $HOME_NET any -> $EXTERNAL_NET 84 (msg:"MALWARE-OTHER Malicious UA detected on non-standard port"; flow:to_server,established; content:"User-Agent|3A| Mozilla/5.0 |28|Windows|3B| U|3B| MSIE 9.0|3B| Windows NT 9.0|3B| en-US|29|"; detection_filter:track by_src, count 1, seconds 120; metadata:policy balanced-ips drop, policy security-ips drop, ruleset community; reference:url,anubis.iseclab.org/?action=result&task_id=1691c3b8835221fa4692960681f39c736&format=html; classtype:trojan-activity; sid:24265; rev:4;)'},
                {idx: '21',packet: 'alert tcp $HOME_NET any -> $EXTERNAL_NET 84 (msg:"MALWARE-OTHER Malicious UA detected on non-standard port"; flow:to_server,established; content:"User-Agent|3A| Mozilla/5.0 |28|Windows|3B| U|3B| MSIE 9.0|3B| Windows NT 9.0|3B| en-US|29|"; detection_filter:track by_src, count 1, seconds 120; metadata:policy balanced-ips drop, policy security-ips drop, ruleset community; reference:url,anubis.iseclab.org/?action=result&task_id=1691c3b8835221fa4692960681f39c736&format=html; classtype:trojan-activity; sid:24265; rev:4;)'},
                {idx: '22',packet: 'alert tcp $HOME_NET any -> $EXTERNAL_NET 84 (msg:"MALWARE-OTHER Malicious UA detected on non-standard port"; flow:to_server,established; content:"User-Agent|3A| Mozilla/5.0 |28|Windows|3B| U|3B| MSIE 9.0|3B| Windows NT 9.0|3B| en-US|29|"; detection_filter:track by_src, count 1, seconds 120; metadata:policy balanced-ips drop, policy security-ips drop, ruleset community; reference:url,anubis.iseclab.org/?action=result&task_id=1691c3b8835221fa4692960681f39c736&format=html; classtype:trojan-activity; sid:24265; rev:4;)'},
            ];

            // Configuration for jqGrid Example 2
            $("#table_list_2").jqGrid({
                data: mydata,
                datatype: "local",
                height: 450,
                autowidth: true,
                shrinkToFit: true,
                rowNum: 20,
                rowList: [10, 20, 30],
                colNames:['idx','packet'],
                colModel:[
	                	{name:'idx',index:'idx', editable: true, width:5, align:"center", sorttype:"int",search:true},
                    {name:'packet',index:'packet', width:90, editable: true, sorttype:"data",search:true}
                ],
                pager: "#pager_list_2",
                viewrecords: true,
                add: true,
                edit: true,
                addtext: 'Add',
                edittext: 'Edit',
                hidegrid: false
            });

            // Add selection
            $("#table_list_2").setSelection(4, true);


            // Setup buttons
            $("#table_list_2").jqGrid('navGrid', '#pager_list_2',
                    {edit: true, add: true, del: true, search: true},
                    {height: 200, reloadAfterSubmit: true}
            );

            // Add responsive to jqGrid
            $(window).bind('resize', function () {
                var width = $('.jqGrid_wrapper').width();
                $('#table_list_2').setGridWidth(width);
            });
        });

    </script>
</body>