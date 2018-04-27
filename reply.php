<?php
require('core/libraries.php');
require('core/renderer/barsAndFooter.php');
require('core/model/Service.php');
require('core/db_config.php');
include 'core/renderer/header_inc.php';
require('core/drawRepliesTable.php');
$reply_id = $_GET['id'];
$reply = getReplyById($reply_id);
if (!isset($reply)) echo '<script>console.log("reply=null")</script>';
else foreach ($reply as $key => $value) echo '<script>console.log("' . $key . ' = > ' . $value . '\n")</script>';
$page_title = 'การตอบกลับ';
setTitle($page_title);
loadMaterialDashboardLibraries();
$service = unserialize($_SESSION['service']);
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
            </div>
        </div>
    </div>
    <?php drawFooter(); ?>
</div>
</body>
</html>
