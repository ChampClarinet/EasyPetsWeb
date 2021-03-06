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
$page_title = 'รับฝากสัตว์เลี้ยง';
setTitle($page_title);
loadMaterialDashboardLibraries();
loadJQuery();
$service_id = $_SESSION['service_id'];
$service = loadService($service_id);
$type = $_GET['new'];
$hotel=null;
if ($type == 0){
    $hotel = getComponent($GLOBALS['table_hotel'], $service_id);
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
                        <div class="card-header card-header-warning">
                            <div class="col-lg-10 col-md-10 col-sm-10">
                                <h4 class="card-title">การรับฝากสัตว์เลี้ยง</h4>
                            </div>
                            <?php if(isset($hotel)) echo '<button style="background-color: #AA6600;" type="button" id="delete_hotel" class="btn btn-info pull-right">ลบ</button>'; ?>
                        </div>
                        <div class="card-body table-responsive">
                            <form id="hotel_form" action="core/update_hotel.php" method="post">
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                        <input id="is_accept_overnight" name="is_accept_overnight" type="text"
                                               value="<?php if (isset($hotel)) echo $hotel['is_accept_overnight']; else echo 0; ?>"
                                               hidden/>
                                        <div class="table-responsive">
                                            <table class="table">
                                                <tbody>
                                                <tr>
                                                    <td style="width: 20%;">การรองรับสัตว์เลี้ยง</td>
                                                    <td>
                                                        <div class="form-group">
                                                            <label class="form-check-label">
                                                                <input type="checkbox" id="checkbox-ov"
                                                                    <?php if (isset($hotel) && $hotel['is_accept_overnight']) echo 'checked' ?>
                                                                       class="form-check-input" value="1"/>
                                                                รองรับการฝากสัตว์เลี้ยงค้างคืน
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
                                        <label class="bmd-label-floating">ราคาเริ่มต้น (บาท)</label>
                                        <input name="hotel_price" class="form-control" type="number"
                                               value="<?php if(isset($hotel)) echo $hotel['hotel_price']?>" id="rate">
                                    </div>
                                </div>
                                <input name="service_id" type="text" value="<?php echo $service_id; ?>" hidden/>
                                <input name="new" type="text" value="<?php echo $type; ?>" hidden/>
                                <button type="submit" class="btn btn-warning pull-right">
                                    <?php
                                        if($hotel != null) echo 'อัพเดท';
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
                            <button id="back" type="button" class="btn btn-warning">ย้อนกลับ</button>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <?php drawFooter(); ?>
    </div>
</body>
<script>

    $("#delete_hotel").click(function deleteConfirm() {
        let data = {
            service_id:  <?php echo $service_id ?>,
            component: '<?php echo $GLOBALS['table_hotel']; ?>'
        };
        if (confirm("คุณแน่ใจหรือไม่ที่จะลบบริการรับฝากสัตว์เลี้ยง")) {
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

    $('#checkbox-ov').change(function () {
        if (this.checked) $('#is_accept_overnight').val(1);
        else $('#is_accept_overnight').val(0);
    })
</script>
</html>