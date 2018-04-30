<?php
require('core/libraries.php');
require('core/renderer/barsAndFooter.php');
require('core/model/Service.php');
require('core/db_config.php');
require('core/getService.php');
include 'core/renderer/header_inc.php';
require('core/drawRepliesTable.php');
if(!isset($_SESSION['service_id'])){
    echo '<script>window.location.href = "login.php"</script>';
}
$reply_id = $_GET['id'];
$reply = getReplyById($reply_id);
$page_title = 'การตอบกลับ';
setTitle($page_title);
loadMaterialDashboardLibraries();
loadJQuery();
$service_id = $_SESSION['service_id'];
$service = loadService($service_id);
?>
</head>
<body>
<div class="wrapper">
    <?php drawSideBar('reply', $service) ?>
    <div class="main-panel">
        <?php drawNavBar($page_title) ?>
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <?php drawTableReply($reply);?>
                </div>
                <div class="row">
                    <div class="col-lg-3 col-md-3 col-sm-3">
                        <a href="index.php">
                            <button id="back" type="button" class="btn btn-info" data-toggle="modal" data-target="#myModal">ย้อนกลับ</button>
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
