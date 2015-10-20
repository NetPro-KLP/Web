<?php include_once '../header.php'; ?>
<body class="skin-1">
  <div id="wrapper">
    <?php include_once '../nav_left.php'; ?>
    <div id="page-wrapper" class="gray-bg">
      <?php include_once '../nav_top.php'; ?>
      <div class="wrapper wrapper-content">
        <div class="row">
            <?
                $result = $db->mysqli->query("select id,name,position,profileimg,email,phone from accounts where 1");
                while($row = $result->fetch_array(MYSQL_ASSOC))
                {
            ?>
            <div class="col-lg-4">
                <div class="contact-box">
                    <div class="col-sm-4">
                        <div class="text-center">
                            <img alt="image" class="img-circle m-t-xs img-responsive profile-img" src="<? if(empty($row['profileimg'])) echo '/assets/img/default.png'; else echo '/assets/img/' .$row['profileimg']; ?>">
                            <div class="m-t-xs font-bold"><?=$row['position']?></div>
                        </div>
                    </div>
                    <div class="col-sm-8">
                        <h3><strong><?=$row['name']?></strong></h3>
                        <address>
                            <abbr title="Phone">Email</abbr> <?=$row["email"]?><br /><br />
                            <abbr title="Phone">Phone</abbr> <?=$row["phone"]?>
                        </address>
                    </div>
                    <div class="clearfix"></div>
                    </a>
                </div>
            </div>
            <? } ?>
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
</body>