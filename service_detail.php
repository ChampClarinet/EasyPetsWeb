<?php
require('core/libraries.php');
require('core/renderer/barsAndFooter.php');
require('core/model/Service.php');
require('core/db_config.php');
require('core/serviceLoader.php');
require('core/serviceComponentLoader.php');
require('core/otherServiceTable.php');
require('core/groom.php');
require('core/hospital.php');
require('core/hotel.php');
include 'core/renderer/header_inc.php';
$page_title = 'ข้อมูลสถานบริการ';
setTitle($page_title);
loadJQuery();
loadMaterialDashboardLibraries();
$service_id = $_SESSION['service_id'];
$service = loadService($service_id);
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
                <!--main-->
                <div class="row">
                    <div class="card card-profile">
                        <div class="card-avatar">
                            <img src="bucket/logo/<?php echo $service->logo_path ?>" class="rounded-circle"
                                 style="width: 130px; height: 130px;" alt="service picture"/>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-3 col-md-3 col-sm-3">
                                    <a href="edit_service_detail.php">
                                        <button id="edit" type="button" class="btn btn-info">แก้ไขข้อมูล</button>
                                    </a>
                                </div>
                            </div>
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
                                        <td><?php echo $service->tel; ?></td>
                                    </tr>
                                    <tr>
                                        <td>ที่อยู่</td>
                                        <td><?php echo $service->address; ?></td>
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
                <?php drawGroomCard($groom) ?>
                <!--hospital-->
                <?php drawHospitalCard($hospital) ?>
                <!--hotel-->
                <?php drawHotelCard($hotel) ?>
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