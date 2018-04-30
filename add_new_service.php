<?php
require('core/libraries.php');
require('core/renderer/barsAndFooter.php');
require('core/model/Service.php');
require('core/db_config.php');
require('core/getService.php');
include 'core/renderer/header_inc.php';
require('core/drawReviewsTable.php');
$page_title = 'เพิ่มบริการอื่นๆ';
if(!isset($_SESSION['service_id'])){
    echo '<script>window.location.href = "login.php"</script>';
}
setTitle($page_title);
loadMaterialDashboardLibraries();
loadJQuery();
$service_id = $_SESSION['service_id'];
$service = loadService($service_id);
?>
</head>
<body>
<div class="wrapper">
    <?php drawSideBar('', $service) ?>
    <div class="main-panel">
        <?php drawNavBar($page_title) ?>
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="card">
                        <div class="card-header card-header-info">
                            <h4 class="card-title">เพิ่มบริการใหม่</h4>
                        </div>
                        <div class="card-body table-responsive">
                            <form id="reply_form" action="core/insert_other_service.php" method="post"
                                  enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="bmd-label-floating">ชื่อบริการ (required)</label>
                                            <input name="service_details" type="text" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="bmd-label-floating">ราคา</label>
                                            <input name="service_price" type="text" class="form-control"/>
                                        </div>
                                    </div>
                                </div>
                                <input name="service_id" type="text" value="<?php echo $service->service_id; ?>"
                                       hidden/>
                                <button type="submit" class="btn btn-info pull-right">เพิ่ม</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-3 col-md-3 col-sm-3">
                        <a href="service_detail.php">
                            <button id="back" type="button" class="btn btn-info">ย้อนกลับ</button>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <?php drawFooter(); ?>
    </div>
</body>
</html>