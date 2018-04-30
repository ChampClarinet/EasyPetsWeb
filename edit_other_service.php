<?php
require('core/libraries.php');
require('core/renderer/barsAndFooter.php');
require('core/model/Service.php');
require('core/db_config.php');
require('core/getService.php');
include 'core/renderer/header_inc.php';
require('core/drawReviewsTable.php');
if (!isset($_SESSION['service_id'])) {
    echo '<script>window.location.href = "login.php"</script>';
}
loadMaterialDashboardLibraries();
loadJQuery();
$service_id = $_SESSION['service_id'];
$service = loadService($service_id);
$s = getOtherServiceById($_GET['oid']);
setTitle($s['service_details']);
?>
    </head>
    <body>
    <div class="wrapper">
        <?php drawSideBar('', $service) ?>
        <div class="main-panel">
            <?php drawNavBar('แก้ไขบริการ') ?>
            <div class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="card">
                            <div class="card-header card-header-info">
                                <div class="col-lg-10 col-md-10 col-sm-10">
                                    <h4 class="card-title">แก้ไขบริการ</h4>
                                </div>
                                <button style="background-color: #394F92;" type="button" id="delete_other"
                                        class="btn btn-info pull-right">ลบ
                                </button>
                            </div>
                            <div class="card-body table-responsive">
                                <form id="other_service_form" action="core/update_other_service.php" method="post"
                                      enctype="multipart/form-data">
                                    <input hidden name="other_service_id" value="<?php echo $s['other_service_id'] ?>"/>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="bmd-label-floating">ชื่อบริการ (required)</label>
                                                <input name="service_details" type="text"
                                                       value="<?php echo $s['service_details'] ?>" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="bmd-label-floating">ราคา</label>
                                                <input name="service_price" type="text"
                                                       value="<?php echo $s['service_price'] ?>" class="form-control"/>
                                            </div>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-info pull-right">เพิ่ม</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-3 col-md-3 col-sm-3">
                            <a href="service_detail.php">
                                <button id="back" type="button" class="btn btn-info">ย้อนกลับ</button>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <?php drawFooter(); ?>
        </div>
    </div>
    </body>
    <script>
        $("#delete_other").click(function deleteConfirm() {
            let data = {other_service_id:  <?php echo $s['other_service_id'] ?>};
            if (confirm("คุณแน่ใจหรือไม่ที่จะลบ " +"<?php echo $s['service_details'] ?>")) {
                $.post("core/delete_other_service.php", data, function (data, status) {
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

<?php
function getOtherServiceById($oid)
{
    $con = connectDB();
    $sql = "SELECT * FROM " . $GLOBALS['table_other'] . " WHERE OTHER_SERVICE_ID = " . $oid;
    $result = $con->query($sql);
    if ($result->num_rows > 0) {
        return $result->fetch_assoc();
    }
    return null;
}