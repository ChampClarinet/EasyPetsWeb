<?php
require('core/libraries.php');
require('core/renderer/barsAndFooter.php');
require('core/model/Service.php');
require('core/db_config.php');
require('core/serviceLoader.php');
include 'core/renderer/header_inc.php';
require('core/drawReviewsTable.php');
$review_id = $_GET['id'];
$review = getReviewById($review_id);
//if (!isset($review)) echo '<script>console.log("review=null")</script>';
//else foreach ($review as $key => $value) echo '<script>console.log("' . $key . ' = > ' . $value . '\n")</script>';
$page_title = $review['review_text'];
setTitle($page_title);
loadMaterialDashboardLibraries();
$service_id = $_SESSION['service_id'];
$service = loadService($service_id);
?>
</head>
<body>
    <div class="wrapper">
        <?php drawSideBar('review', $service) ?>
        <div class="main-panel">
            <?php drawNavBar('รีวิว') ?>
            <div class="content">
                <div class="container-fluid">
                    <div class="row">
                        <?php drawTableReview($review);?>
                    </div>
                    <div class="row">
                        <div class="col-lg-3 col-md-3 col-sm-3">
                            <a href="dashboard.php">
                                <button id="back" type="button" class="btn btn-info">ย้อนกลับ</button>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php drawFooter(); ?>
    </div>
</body>
</html>
