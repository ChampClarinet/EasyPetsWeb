<?php
require('core/libraries.php');
require('core/renderer/barsAndFooter.php');
require('core/drawReviewsTable.php');
require('core/drawRepliesTable.php');
require('core/model/Service.php');
require('core/counts.php');
include 'core/renderer/header_inc.php';
setTitle('Dashboard');
loadMaterialDashboardLibraries();
$service = unserialize($_SESSION['service']);

?>
<style>
    tr {
        white-space: nowrap;
    }
</style>

</head>
<body>
<div class="wrapper">
    <?php drawSideBar('dashboard', $service); ?>
    <div class="main-panel">
        <!-- Navbar -->
        <?php drawNavBar('Dashboard'); ?>
        <!-- End Navbar -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <!--likes-->
                    <div class="col-lg-3 col-md-6 col-sm-6">
                        <div class="card card-stats">
                            <div class="card-header card-header-warning card-header-icon">
                                <div class="card-icon">
                                    <i class="material-icons">favorite</i>
                                </div>
                                <p class="card-category">ถูกใจ</p>
                                <h3 class="card-title"><?php echo likeCount($service->service_id); ?></h3>
                            </div>
                            <div class="card-footer"></div>
                        </div>
                    </div>
                    <!--review count-->
                    <div class="col-lg-3 col-md-6 col-sm-6">
                        <div class="card card-stats">
                            <div class="card-header card-header-success card-header-icon">
                                <div class="card-icon">
                                    <i class="material-icons">comment</i>
                                </div>
                                <p class="card-category">รีวิว</p>
                                <h3 class="card-title"><?php echo reviewsCount($service->service_id); ?></h3>
                            </div>
                            <div class="card-footer"></div>
                        </div>
                    </div>
                    <!--reply count-->
                    <div class="col-lg-3 col-md-6 col-sm-6">
                        <div class="card card-stats">
                            <div class="card-header card-header-danger card-header-icon">
                                <div class="card-icon">
                                    <i class="material-icons">reply</i>
                                </div>
                                <p class="card-category">การตอบกลับ</p>
                                <h3 class="card-title"><?php echo repliesCount($service->service_id); ?></h3>
                            </div>
                            <div class="card-footer"></div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <!--review-->
                    <div class="col-lg-6 col-md-12">
                        <?php drawTableReview($service->service_id); ?>
                    </div>
                    <!--reply-->
                    <div class="col-lg-6 col-md-12">
                        <?php drawTableReply($service->service_id); ?>
                    </div>
                </div>
            </div>
        </div>
        <?php drawFooter(); ?>
    </div>
</div>
</body>
<?php
loadFirebaseLibraries();
?>
</html>