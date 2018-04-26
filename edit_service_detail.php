<?php
require('core/libraries.php');
require('core/renderer/barsAndFooter.php');
require('core/model/Service.php');
include 'core/renderer/header_inc.php';
$page_title = 'แก้ไขข้อมูล';
setTitle($page_title);
loadMaterialDashboardLibraries();
$service = unserialize($_SESSION['service']);
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
                    <div class="card">
                        <!--<div class="card-avatar">
                            <img src="bucket/logo/<?php /*echo $service->logo_path */?>" class="rounded-circle" style="width: 130px; height: 130px;" alt="service picture"/>
                        </div>-->
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
                                        <td><?php echo $service->getOpenTime();?> น.</td>
                                    </tr>
                                    <tr>
                                        <td>เวลาปิดให้บริการ</td>
                                        <td><?php echo $service->getCloseTime();?> น.</td>
                                    </tr>
                                    <tr>
                                        <td>โทร</td>
                                        <td><?php echo $service->tel;?> น.</td>
                                    </tr>
                                    <tr>
                                        <td>ที่อยู่</td>
                                        <td><?php echo $service->address;?> น.</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <i class="fa fa-facebook-square" style="font-size:48px;color: #3b5998;"></i>
                                        </td>
                                        <td>
                                            <?php echo '<a href="'.$service->facebook_url.'">'.$service->facebook_url.'</a>'; ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>รูปภาพสถานบริการ</td>
                                        <td><img src="bucket/picture/<?php echo $service->picture_path ?>" class="img-fluid" alt="service picture"></td>
                                    </tr>
                                    <tr>
                                        <td>ตำแหน่งของร้าน</td>
                                        <td>
                                            <div id="map"></div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>คำอธิบายร้าน</td>
                                        <td><?php echo $service->description;?></td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php drawFooter(); ?>
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
