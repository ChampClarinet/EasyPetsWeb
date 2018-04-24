<?php
require('core/loader.php');
require('core/model/Service.php');
require('core/reviews.php');
include 'core/renderer/header_inc.php';
$page_title = 'รีวิว';
setTitle($page_title);
loadMaterialDashboardLibraries();
$service = unserialize($_SESSION['service']);
?>
</html>

<body>
<div class="wrapper">
    <?php drawSideBar('review', $service); ?>
    <div class="main-panel">
        <?php drawNavBar($page_title); ?>
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <?php drawTableReview();?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php drawFooter(); ?>
</body>
</html>