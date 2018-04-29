<?php
require('core/libraries.php');
require('core/renderer/barsAndFooter.php');
require('core/model/Service.php');
require('core/db_config.php');
require('core/serviceLoader.php');
require('core/serviceComponentLoader.php');
include 'core/renderer/header_inc.php';
//if (!isset($review)) echo '<script>console.log("review=null")</script>';
//else foreach ($review as $key => $value) echo '<script>console.log("' . $key . ' = > ' . $value . '\n")</script>';
$page_title = 'รักษาพยาบาล';
setTitle($page_title);
loadMaterialDashboardLibraries();
loadJQuery();
$service_id = $_SESSION['service_id'];
$service = loadService($service_id);
$type = $_GET['new'];
$hospital = null;
if ($type == 0) {
    $hospital = getComponent($GLOBALS['table_hospital'], $service_id);
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
                        <div class="card-header card-header-danger">
                            <h4 class="card-title">การรักษาพยาบาล</h4>
                        </div>
                        <div class="card-body table-responsive">
                            <form id="hospital_form" action="core/update_hospital.php" method="post">
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                        <input id="is_accept_big_operation" name="is_accept_big_operation" type="text"
                                               value="<?php if (isset($hospital)) echo $hospital['is_accept_big_operation']; else echo 0; ?>"
                                               hidden/>
                                        <div class="table-responsive">
                                            <table class="table">
                                                <tbody>
                                                <tr>
                                                    <td style="width: 20%;">รองรับการผ่าตัดใหญ่</td>
                                                    <td>
                                                        <div class="form-group">
                                                            <label class="form-check-label">
                                                                <input type="checkbox" id="checkbox-op"
                                                                       class="form-check-input" value="1"/>
                                                                รองรับการผ่าตัดใหญ่
                                                            </label>
                                                        </div>
                                                    </td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <label class="bmd-label-floating">ราคาตรวจรักษาโดยประมาณ</label>
                                        <input name="checkup_price_rate" class="form-control" type="number"
                                               value="<?php if(isset($hospital)) echo $hospital['checkup_price_rate']?>" id="rate">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <label class="bmd-label-floating">ราคาวัคซีนโดยประมาณ</label>
                                        <input name="vaccine_price_rate" class="form-control" type="number"
                                               value="<?php if(isset($hospital)) echo $hospital['vaccine_price_rate']?>" id="rate">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <label class="bmd-label-floating">ราคาผ่าตัดทั่วไปโดยประมาณ</label>
                                        <input name="operation_price_rate" class="form-control" type="number"
                                               value="<?php if(isset($hospital)) echo $hospital['operation_price_rate']?>" id="rate">
                                    </div>
                                </div>
                                <input name="service_id" type="text" value="<?php echo $service_id; ?>" hidden/>
                                <input name="new" type="text" value="<?php echo $type; ?>" hidden/>
                                <button type="submit" class="btn btn-danger pull-right">
                                    <?php
                                    if ($hospital != null) echo 'อัพเดท';
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
                            <button id="back" type="button" class="btn btn-danger">ย้อนกลับ</button>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <?php drawFooter(); ?>
    </div>
</body>
<script>
    $('#checkbox-op').change(function () {
        if (this.checked) $('#is_accept_big_operation').val(1);
        else $('#is_accept_big_operation').val(0);
    })
</script>
</html>