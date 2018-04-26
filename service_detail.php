<?php
require('core/libraries.php');
require('core/renderer/barsAndFooter.php');
require('core/model/Service.php');
require('core/db_config.php');
require('core/serviceComponentLoader.php');
require('core/otherServiceTable.php');
include 'core/renderer/header_inc.php';
$page_title = 'ข้อมูลสถานบริการ';
setTitle($page_title);
loadMaterialDashboardLibraries();
$service = unserialize($_SESSION['service']);
$groom = getComponent($GLOBALS['table_groom'], $service->service_id);
$hospital = getComponent($GLOBALS['table_hospital'], $service->service_id);
$hotel = getComponent($GLOBALS['table_hotel'], $service->service_id);
?>
<style>
    #map {
        width: 100%;
        height: 400px;
        background-color: grey;
        margin-top: 0px;
    }

    .img-fluid {
        width: 100%;
        height: 400px;
    }
</style>
</head>
<body>
<div class="wrapper">
    <?php drawSideBar('detail', $service); ?>
    <div class="main-panel">
        <?php drawNavBar($page_title); ?>
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-3 col-md-6 col-sm-6">
                        <a href="edit_service_detail.php">
                            <button id="edit" type="button" class="btn btn-info">แก้ไขข้อมูล</button>
                        </a>
                    </div>
                </div>
                <!--main-->
                <div class="row">
                    <div class="card card-profile">
                        <div class="card-avatar">
                            <img src="bucket/logo/<?php echo $service->logo_path ?>" class="rounded-circle"
                                 style="width: 130px; height: 130px;" alt="service picture"/>
                        </div>
                        <div class="card-body">
                            <h4 class="card-title"><?php echo $service->name ?></h4>
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th style="width: 40%"></th>
                                        <th style="width: 60%"></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td>วันที่เปิดให้บริการ</td>
                                        <td><?php echo $service->getDaysOpen(); ?></td>
                                    </tr>
                                    <tr>
                                        <td>เวลาเปิดทำการ</td>
                                        <td><?php echo $service->getOpenTime(); ?> น.</td>
                                    </tr>
                                    <tr>
                                        <td>เวลาปิดให้บริการ</td>
                                        <td><?php echo $service->getCloseTime(); ?> น.</td>
                                    </tr>
                                    <tr>
                                        <td>โทร</td>
                                        <td><?php echo $service->tel; ?> น.</td>
                                    </tr>
                                    <tr>
                                        <td>ที่อยู่</td>
                                        <td><?php echo $service->address; ?> น.</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <i class="fa fa-facebook-square" style="font-size:48px;color: #3b5998;"></i>
                                        </td>
                                        <td>
                                            <?php echo '<a href="' . $service->facebook_url . '">' . $service->facebook_url . '</a>'; ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>รูปภาพสถานบริการ</td>
                                        <td><img src="bucket/picture/<?php echo $service->picture_path ?>"
                                                 class="img-fluid" alt="service picture"></td>
                                    </tr>
                                    <tr>
                                        <td>ตำแหน่งของร้าน</td>
                                        <td>
                                            <div id="map"></div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>คำอธิบายร้าน</td>
                                        <td><?php echo $service->description; ?></td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!--groom-->
                <div <?php if ($groom == null) echo 'hidden' ?> class="row">
                    <div class="card">
                        <div class="card-header card-header-success">
                            <h4 class="card-title">รายละเอียดการอาบน้ำ ตัดขน</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th style="width: 40%"></th>
                                        <th style="width: 60%"></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td>ราคาอาบน้ำ / ตัดขน เริ่มต้นที่</td>
                                        <td>
                                            <?php
                                            if (isset($groom)) {
                                                $g = $groom['grooming_price_rate'];
                                                if ($g == 1) $g = 200;
                                                else if ($g == 2) $g = 300;
                                                else if ($g == 3) $g = 500;
                                                else if ($g == 4) $g = 800;
                                                else $g = 1000;
                                                echo $g . ' บาท';
                                            }
                                            ?>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!--hospital-->
                <div <?php if ($hospital == null) echo 'hidden' ?> class="row">
                    <div class="card">
                        <div class="card-header card-header-danger">
                            <h4 class="card-title">รายละเอียดการรักษาพยาบาล</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th style="width: 40%"></th>
                                        <th style="width: 60%"></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td>รองรับการผ่าตัดใหญ่</td>
                                        <td><?php if (isset($hospital) && !$hospital['is_accept_big_operation']) echo 'ไม่'; ?>
                                            รองรับการผ่าตัดใหญ่
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>ราคาตรวจรักษาโดยประมาณ</td>
                                        <td><?php
                                            if (isset($hospital)) {
                                                $h = $hospital['checkup_price_rate'];
                                                if ($h == 1) $g = 50;
                                                else if ($h == 2) $h = 100;
                                                else if ($h == 3) $h = 200;
                                                else if ($h == 4) $h = 500;
                                                else $h = 1000;
                                                echo $h . ' บาท';
                                            } ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>ราคาวัคซีนโดยประมาณ</td>
                                        <td><?php
                                            if (isset($hospital)) {
                                                $h = $hospital['vaccine_price_rate'];
                                                if ($h == 1) $g = 50;
                                                else if ($h == 2) $h = 100;
                                                else if ($h == 3) $h = 200;
                                                else if ($h == 4) $h = 500;
                                                else $h = 1000;
                                                echo $h . ' บาท';
                                            } ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>ราคาผ่าตัดโดยประมาณ</td>
                                        <td><?php
                                            if (isset($hospital)) {
                                                $h = $hospital['operation_price_rate'];
                                                if ($h == 1) $g = 50;
                                                else if ($h == 2) $h = 100;
                                                else if ($h == 3) $h = 200;
                                                else if ($h == 4) $h = 500;
                                                else $h = 1000;
                                                echo $h . ' บาท';
                                            } ?>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!--hotel-->
                <div <?php if ($hotel == null) echo 'hidden' ?> class="row">
                    <div class="card">
                        <div class="card-header card-header-warning">
                            <h4 class="card-title">รายละเอียดการรับฝากสัตว์เลี้ยง</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th style="width: 40%"></th>
                                        <th style="width: 60%"></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td>รับฝากค้างคืน</td>
                                        <td><?php if (isset($hotel) && !$hotel['is_accept_overnight']) echo 'ไม่'; ?>
                                            รับฝากค้างคืน
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>ค่าบริการรับฝากโดยประมาณ</td>
                                        <td><?php
                                            if (isset($hotel)) {
                                                $h = $hotel['hotel_price'];
                                                if ($h == 1) $g = 100;
                                                else if ($h == 2) $h = 200;
                                                else if ($h == 3) $h = 300;
                                                else if ($h == 4) $h = 500;
                                                else $h = 1000;
                                                echo $h . ' บาท';
                                            } ?>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <?php drawOtherServiceTable($service->service_id); ?>
            </div>
        </div>
    </div>
    <?php drawFooter(); ?>
</div>
</body>
<?php
loadFirebaseLibraries();
?>
<script>
    var latitude = <?php echo $service->latitude ?>;
    var longitude = <?php echo $service->longitude ?>;

    function initMap() {
        console.log(latitude + ":" + longitude);
        let here = {lat: latitude, lng: longitude};
        var mapOptions = {
            zoom: 15,
            center: here
        };

        var map = new google.maps.Map(document.getElementById('map'), mapOptions);
        var marker = new google.maps.Marker({
            position: here,
            map: map,
            draggable: false
        });
    }
</script>
<script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBd4sDjq20vvBUIN2Yc4ANrbdxzp_TF-qs&callback=initMap">
</script>
</html>