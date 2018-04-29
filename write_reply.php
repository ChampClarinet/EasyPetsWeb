<?php
require('core/libraries.php');
require('core/renderer/barsAndFooter.php');
require('core/model/Service.php');
require('core/db_config.php');
require('core/serviceLoader.php');
include 'core/renderer/header_inc.php';
require('core/drawReviewsTable.php');
$review_id = $_GET['review_id'];
$review = getReviewById($review_id);
$page_title = 'เขียนการตอบกลับ';
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
        <?php drawNavBar('รีวิว') ?>
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="card">
                        <div class="card-header card-header-info">
                            <h4 class="card-title">เขียนการตอบกลับ</h4>
                        </div>
                        <div class="card-body table-responsive">
                            <table class="table table-hover">
                                <tbody>
                                <tr>
                                    <td>ตอบกลับคุณ</td>
                                    <td><?php echo $review['reviewer_name'] ?></td>
                                </tr>
                                <tr>
                                    <td>รีวิว</td>
                                    <td><?php echo $review['review_text'] ?></td>
                                </tr>
                                </tbody>
                            </table>
                            <form id="reply_form" action="core/insert_reply.php" method="post" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="bmd-label-floating">เขียนการตอบกลับ (required)</label>
                                            <input name="reply_text" type="text" class="form-control" />
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg6 col-md-6 col-sm-6">
                                        <p>แนบไฟล์ภาพ</p>
                                    </div>
                                    <div class="col-lg6 col-md-6 col-sm-6">
                                        <input name="reply_image" type="file" id="reply_picture_button" />
                                    </div>
                                </div>
                                <input name="review_id" type="text" value="<?php echo $review['review_id']; ?>" hidden />
                                <button type="submit" class="btn btn-info pull-right">ตอบกลับ</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-3 col-md-3 col-sm-3">
                        <a href="review.php?id=<?php echo $review['review_id'] ?>">
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