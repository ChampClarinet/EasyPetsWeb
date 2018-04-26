<?php
require('core/libraries.php');
require('core/renderer/barsAndFooter.php');
require('core/model/Service.php');
require('core/db_config.php');
require('core/drawRepliesTable.php');
include 'core/renderer/header_inc.php';
$page_title = 'การตอบกลับ';
setTitle($page_title);
loadMaterialDashboardLibraries();
$service = unserialize($_SESSION['service']);
?>
</html>

    <body>
    <div class="wrapper">
        <?php drawSideBar('reply', $service); ?>
        <div class="main-panel">
            <?php drawNavBar($page_title); ?>
            <div class="content">
                <div class="container-fluid">
                    <div class="row">
                        <?php drawTableReply($service->service_id);?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php drawFooter(); ?>
    </body>
</html>