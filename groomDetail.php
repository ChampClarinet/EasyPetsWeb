<?php
require('core/libraries.php');
require('core/renderer/barsAndFooter.php');
require('core/model/Service.php');
require('core/db_config.php');
require('core/getService.php');
require('core/serviceComponentLoader.php');
include 'core/renderer/header_inc.php';
if(!isset($_SESSION['service_id'])){
    echo '<script>window.location.href = "login.php"</script>';
}
$page_title = 'อาบน้ำ แต่งขน';
setTitle($page_title);
loadMaterialDashboardLibraries();
loadJQuery();
$service_id = $_SESSION['service_id'];
$service = loadService($service_id);
$type = $_GET['new'];
$groom=null;
if ($type == 0){
    $groom = getComponent($GLOBALS['table_groom'], $service_id);
}
$selected = 'selected="selected"';
?>
</head>
<body>
<div class="wrapper">
    <?php drawSideBar('', $service) ?>
    <div class="main-panel">
        <?php drawNavBar('') ?>
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="card">
                        <div class="card-header card-header-success">
                            <div class="col-lg-10 col-md-10 col-sm-10">
                                <h4 class="card-title">บริการอาบน้ำ ตัดแต่งขน</h4>
                            </div>
                            <?php if(isset($groom)) echo '<button style="background-color: #207E26;" type="button" id="delete_groom" class="btn btn-info pull-right">ลบ</button>'; ?>
                        </div>
                        <div class="card-body table-responsive">
                            <form id="groom_form" action="core/update_groom.php" method="post">
                                <div class="row">
                                    <div class="col-md-12">
                                        <label class="bmd-label-floating">ราคาเริ่มต้น (บาท)</label>
                                        <input name="grooming_price_rate" class="form-control" type="number"
                                               value="<?php if(isset($groom)) echo $groom['grooming_price_rate']?>" id="rate">
                                    </div>
                                </div>
                                <input name="service_id" type="text" value="<?php echo $service_id; ?>" hidden/>
                                <input name="new" type="text" value="<?php echo $type; ?>" hidden/>
                                <button type="submit" class="btn btn-success pull-right">
                                    <?php
                                        if($groom != null) echo 'อัพเดท';
                                        else echo 'เพิ่ม';
                                    ?>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-3 col-md-3 col-sm-3">
                        <a href="service_detail.php">
                            <button id="back" type="button" class="btn btn-success">ย้อนกลับ</button>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <?php drawFooter(); ?>
    </div>
</body>
<script>
    $("#delete_groom").click(function deleteConfirm() {
        let data = {
            service_id:  <?php echo $service_id ?>,
            component: '<?php echo $GLOBALS['table_groom']; ?>'
        };
        if (confirm("คุณแน่ใจหรือไม่ที่จะลบบริการอาบน้ำ แต่งขน")) {
            $.post("core/delete_component.php", data, function (data, status) {
                console.log(data);
                if (status === "success") {
                    alert(data);
                    window.location.href = "service_detail.php";
                }
                else alert("error: " + data);
            })
        }
    });
</script>
</html>