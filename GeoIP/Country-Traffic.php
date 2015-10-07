<?php include_once '../header.php'; ?>
<body class="skin-1">
  <div id="wrapper">
    <?php include_once '../nav_left.php'; ?>
    <div id="page-wrapper" class="gray-bg">
      <?php include_once '../nav_top.php'; ?>
      <div class="wrapper wrapper-content">
	      <div class="row">
              <div class="col-lg-7">
                  <div class="ibox float-e-margins">
                      <div class="ibox-title">
                          <h5>국가별 트래픽</h5>
                      </div>
                      <div class="ibox-content">

                          <div class="row">
                              <div class="col-lg-12">
                                  <div id="world-map"></div>
                              </div>
                      </div>
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
	 	</script>
	 	
  	<script src="/assets/js/common.js"></script>
</body>