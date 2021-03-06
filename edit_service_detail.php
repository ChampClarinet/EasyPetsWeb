<?php
require('core/libraries.php');
require('core/renderer/barsAndFooter.php');
require('core/model/Service.php');
require('core/db_config.php');
require('core/getService.php');
include 'core/renderer/header_inc.php';
if(!isset($_SESSION['service_id'])){
    echo '<script>window.location.href = "login.php"</script>';
}
$page_title = 'แก้ไขข้อมูล';
setTitle($page_title);
loadMaterialDashboardLibraries();
loadJQuery();
$service_id = $_SESSION['service_id'];
$service = loadService($service_id);
?>
<style>
    #map {
        width: 100%;
        height: 400px;
        background-color: grey;
        margin-top: 0px;
    }

    .form-check-input {
        margin-right: 30px;
    }
</style>
</head>
<body>
<div class="wrapper">
    <?php drawSideBar('', $service); ?>
    <div class="main-panel">
        <?php drawNavBar($page_title); ?>
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="card">
                        <div class="card-header card-header-info">
                            <h4 class="card-title">ข้อมูลทั่วไป</h4>
                        </div>
                        <div class="card-body">
                            <form action="core/update_service.php" method="post" enctype="multipart/form-data">
                                <input hidden value="<?php echo $service->service_id ?>" name="service_id" />
                                <!--name and fb url-->
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="bmd-label-floating">ชื่อร้าน</label>
                                            <input name="name" type="text" class="form-control"
                                                   value="<?php echo $service->name ?>"/>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="bmd-label-floating">Facebook URL</label>
                                            <input name="facebook_url" type="text" class="form-control"
                                                   value="<?php echo $service->facebook_url ?>"/>
                                        </div>
                                    </div>
                                </div>
                                <!--tel and address-->
                                <div class="row">
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label class="bmd-label-floating">เบอร์โทรศัพท์</label>
                                            <input name="tel" type="text" class="form-control"
                                                   value="<?php echo $service->tel ?>"/>
                                        </div>
                                    </div>
                                    <div class="col-md-10">
                                        <div class="form-group">
                                            <label class="bmd-label-floating">ที่อยู่</label>
                                            <input name="address" type="text" class="form-control"
                                                   value="<?php echo $service->address ?>"/>
                                        </div>
                                    </div>
                                </div>
                                <!--logo-->
                                <div class="row">
                                    <div class="col-lg4 col-md-4 col-sm-4">
                                        <p>โลโก้ร้าน</p>
                                    </div>
                                    <div class="col-lg4 col-md-4 col-sm-4">
                                        <label class="form-check-label">
                                            <input id="logo-check" type="checkbox" class="form-check-input" value="1" checked/>
                                            ใช้รูปเดิม
                                        </label>
                                    </div>
                                    <div class="col-lg4 col-md-4 col-sm-4">
                                        <input name="logo" type="file" id="logo_file_button" disabled/>
                                    </div>
                                </div>
                                <!--picture-->
                                <div class="row">
                                    <div class="col-lg4 col-md-4 col-sm-4">
                                        <p>รูปภาพร้าน</p>
                                    </div>
                                    <div class="col-lg4 col-md-4 col-sm-4">
                                        <label class="form-check-label">
                                            <input id="picture-check" type="checkbox" class="form-check-input"
                                                   value="1" checked/>
                                            ใช้รูปเดิม
                                        </label>
                                    </div>
                                    <div class="col-lg4 col-md-4 col-sm-4">
                                        <input name="picture" type="file" id="picture_file_button" disabled/>
                                    </div>
                                </div>
                                <!--days-->
                                <div class="row">
                                    <div class="col-lg-10 col-md-10 col-sm-10">
                                        <input hidden value="<?php echo $service->open_days ?>" name="open_days" id="days" />
                                        <div class="table-responsive">
                                            <table class="table">
                                                <tbody>
                                                <tr>
                                                    <td>
                                                        วันทำการ
                                                    </td>
                                                    <td>
                                                        <label class="form-check-label">
                                                            <input type="checkbox" id="checkbox-0"
                                                                   class="form-check-input" value="1" checked>
                                                            ทุกวัน
                                                        </label>
                                                    </td>
                                                    <td>
                                                        <label class="form-check-label day-label">
                                                            <input type="checkbox" id="checkbox-1" name="open-days"
                                                                   class="form-check-input" value="1" onchange="refreshDays();" checked>
                                                            อาทิตย์
                                                        </label>
                                                    </td>
                                                    <td>
                                                        <label class="form-check-label day-label">
                                                            <input type="checkbox" id="checkbox-2" name="open-days"
                                                                   class="form-check-input" value="1" onchange="refreshDays();" checked>
                                                            จันทร์
                                                        </label>
                                                    </td>
                                                    <td>
                                                        <label class="form-check-label day-label">
                                                            <input type="checkbox" id="checkbox-3" name="open-days"
                                                                   class="form-check-input" value="1" onchange="refreshDays();" checked>
                                                            อังคาร
                                                        </label>
                                                    </td>
                                                    <td>
                                                        <label class="form-check-label day-label">
                                                            <input type="checkbox" id="checkbox-4" name="open-days"
                                                                   class="form-check-input" value="1" onchange="refreshDays();" checked>
                                                            พุธ
                                                        </label>
                                                    </td>
                                                    <td>
                                                        <label class="form-check-label day-label">
                                                            <input type="checkbox" id="checkbox-5" name="open-days"
                                                                   class="form-check-input" value="1" onchange="refreshDays();" checked>
                                                            พฤหัส
                                                        </label>
                                                    </td>
                                                    <td>
                                                        <label class="form-check-label day-label">
                                                            <input type="checkbox" id="checkbox-6" name="open-days"
                                                                   class="form-check-input" value="1" onchange="refreshDays();" checked>
                                                            ศุกร์
                                                        </label>
                                                    </td>
                                                    <td>
                                                        <label class="form-check-label day-label">
                                                            <input type="checkbox" id="checkbox-7" name="open-days"
                                                                   class="form-check-input" value="1" onchange="refreshDays();" checked>
                                                            เสาร์
                                                        </label>
                                                    </td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <!--hours-->
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                        <div class="table-responsive">
                                            <table class="table">
                                                <tbody>
                                                    <tr>
                                                        <td>เวลาทำการ</td>
                                                        <td>
                                                            <div class="form-group">
                                                                <label class="form-check-label">
                                                                    <input type="checkbox" id="checkbox-time"
                                                                           class="form-check-input" value="1">
                                                                    24 ชั่วโมง
                                                                </label>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="form-group open-time">
                                                                <label for="time_open" class="bmd-label-floating">เวลาเปิด</label>
                                                                <input class="form-control" type="time" name="open_time"
                                                                       value="<?php
                                                                       if($service->open_time!=null && strcasecmp($service->open_time, 'null')!=0)
                                                                           echo $service->open_time;
                                                                       else {
                                                                           echo '12:00:00';
                                                                           echo '<script>$(".open-time").hide();</script>';
                                                                           }?>" id="time_open">
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="form-group close-time">
                                                                <label for="time_open" class="bmd-label-floating">เวลาปิด</label>
                                                                <input class="form-control" type="time" name="close_time"
                                                                       value="<?php
                                                                       if($service->close_time !=null && strcasecmp($service->close_time, 'null')!=0)
                                                                           echo $service->close_time;
                                                                       else {
                                                                           echo '12:00:00';
                                                                           echo '<script>$(".open-time").hide();</script>';
                                                                       }?>" id="time_close">
                                                            </div>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <!--description-->
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="bmd-label-floating">คำอธิบายร้าน</label>
                                            <input name="description" type="text" class="form-control"
                                                   value="<?php echo $service->description ?>"/>
                                        </div>
                                    </div>
                                </div>
                                <!--map-->
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                        <label class="bmd-label-floating">ตำแหน่งบนแผนที่</label>
                                        <input hidden value="<?php echo $service->latitude ?>" name="latitude" id="lat" />
                                        <input hidden value="<?php echo $service->longitude ?>" name="longitude" id="lng"/>
                                        <div id="map"></div>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-info pull-right">อัพดทข้อมูล</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php drawFooter(); ?>
    </div>
</div>

</body>
<?php
loadFirebaseLibraries();
?>
<script>

    function initMap() {
        let latitude = parseFloat($('#lat').val());
        let longitude = parseFloat($('#lng').val());
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
            draggable: true
        });
        google.maps.event.addListener(marker, 'dragend', function (evt) {
            latitude = evt.latLng.lat();
            longitude = evt.latLng.lng();
            $('#lat').val(latitude);
            $('#lng').val(longitude);
        });
    }

    showHideDays(true);

    function refreshDays(){
        let openDaysCheckboxes = document.getElementsByName('open-days');
        let s = '';
        for(let i=0;i<openDaysCheckboxes.length;++i){
            if(openDaysCheckboxes[i].checked)s += openDaysCheckboxes[i].value;
            else s += 0;
        }
        $('#days').val(s);
    }

    function showHideDays(isHide){
        let openDaysCheckboxes = document.getElementsByName('open-days');
        let labels = $('.day-label');
        if(isHide){
            for(let i=0;i<openDaysCheckboxes.length;++i){
                openDaysCheckboxes[i].checked = true;
                openDaysCheckboxes[i].style.display = 'none';
                labels[i].style.display = 'none';
                $('#days').val('1111111');
            }
        }else{
            for(let i=0;i<openDaysCheckboxes.length;++i){
                openDaysCheckboxes[i].style.display = 'block';
                labels[i].style.display = 'block';
            }
        }
    }

    $('#logo-check').change(function () {
        if (this.checked) {
            $('#logo_file_button').prop('disabled', true);
        } else {
            $('#logo_file_button').prop('disabled', false);
        }
    });

    $('#picture-check').change(function () {
        if (this.checked) {
            $('#picture_file_button').prop('disabled', true);
        } else {
            $('#picture_file_button').prop('disabled', false);
        }
    });

    $('#checkbox-0').change(function () {
        if(this.checked) showHideDays(true);
        else showHideDays(false);
    });

    $('#checkbox-time').change(function () {
        let open = $('#time_open');
        let close = $('#time_close');
        if(this.checked){
            $('.open-time').hide();
            $('.close-time').hide();
            open.val("00:00:00");
            close.val("00:00:00");
        }else{
            $('.open-time').show();
            $('.close-time').show();
            open.val('<?php echo $service->open_time ?>');
            close.val('<?php echo $service->close_time ?>');
        }
    });

</script>
<script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBd4sDjq20vvBUIN2Yc4ANrbdxzp_TF-qs&callback=initMap">
</script>
</html>
