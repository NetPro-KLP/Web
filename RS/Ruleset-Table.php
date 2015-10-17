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
                                    <table id="table_list"></table>
                                    <div id="pager_list"></div>
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
            $("#table_list").jqGrid({
                url : "ajax.php",
                mtype: "POST",
                datatype: "json",
                height: 550,
                autowidth: true,
                shrinkToFit: true,
                rowNum: 25,
                colNames:['idx','data'],
                colModel:[
                 	{name:'idx',index:'idx', width:5, align:"center", sorttype:"int",search:true},
                    {name:'data',index:'data', width:90, editable: true, sorttype:"data",search:true}
                ],
                pager: "#pager_list",
                viewrecords: true,
                gridview: true,
                addtext: 'Add',
                edittext: 'Edit',
                hidegrid: false,
                sortname: "idx",
        sortorder: "asc"
            });
            $("#table_list").jqGrid('navGrid', '#pager_list',
                {edit: true, add: true, del: true, search: false},
                {
                  url: "ajax.php",
                  mtype: "POST",
               reloadAfterSubmit: true,
               jqModal: true,
               closeOnEscape: true,
               closeAfterEdit: true,
               editData: {
               idx: function () {
                   return $("#table_list").jqGrid('getCell', $("#table_list").jqGrid('getGridParam','selrow') , 'idx');
               }
           }
                },
                {
                   url: "ajax.php",
                   mtype: "POST",
                   reloadAfterSubmit: true,
                   jqModal: true,
                   closeOnEscape: true,
                   closeAfterEdit: true,
                },
                {
                  url: "ajax.php",
                  mtype: "POST",
               reloadAfterSubmit: true,
               jqModal: true,
               closeOnEscape: true,
               closeAfterEdit: true,
               delData: {
               idx: function () {
                   return $("#table_list").jqGrid('getCell', $("#table_list").jqGrid('getGridParam','selrow') , 'idx');
               }
            }
                }
            );

            // Add responsive to jqGrid
            $(window).bind('resize', function () {
                var width = $('.jqGrid_wrapper').width();
                $('#table_list').setGridWidth(width);
            });
        });

    </script>
</body>