<?php
require('core/libraries.php');
require('core/renderer/barsAndFooter.php');
require('core/model/Service.php');
require('core/db_config.php');
require('core/getService.php');
include 'core/renderer/header_inc.php';
setTitle('สัตว์พิเศษ');
if(!isset($_SESSION['service_id'])){
    echo '<script>window.location.href = "login.php"</script>';
}
loadJQuery();
loadMaterialDashboardLibraries();
$service_id = $_SESSION['service_id'];
$service = loadService($service_id);
$sql = "SELECT pet_name FROM " . $GLOBALS['table_special_pets'] .
    " JOIN " . $GLOBALS['table_service_pet_available'] .
    " ON SERVICE_PET_AVAILABLE.PET_ID = SPECIAL_PETS.PET_ID" .
    " WHERE SERVICE_ID = " . $service_id;
$animals = array();
$con = connectDB();
$result = $con->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $a = $row['pet_name'];
        array_push($animals, $a);
    }
}

function contains($animals, $name)
{
    foreach ($animals as $a) {
        if (strcasecmp($a, $name) == 0) return true;
    }
    return false;
}

?>
<style>
    tr {
        white-space: nowrap;
    }
</style>

</head>
<body>
<div class="wrapper">
    <?php drawSideBar('animal', $service); ?>
    <div class="main-panel">
        <!-- Navbar -->
        <?php drawNavBar('การรองรับสัตว์พิเศษ'); ?>
        <!-- End Navbar -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="card">
                        <div class="card-header card-header-info">
                            <h4 class="card-title">สัตว์พิเศษที่รองรับ</h4>
                        </div>
                        <div class="card-body table-responsive">
                            <div class="tab-content">
                                <div class="tab-pane active" id="animal">
                                    <table class="table">
                                        <tbody>
                                        <form action="core/update_animals.php" method="post">
                                            <input name="service_id" type="text" value="<?php echo $service_id; ?>" hidden/>
                                            <input id="r" name="reptile" type="text" value=
                                            "<?php if (contains($animals, 'reptile')) echo 1; else echo 0; ?>" hidden/>
                                            <input id="b" name="birds" type="text" value=
                                            "<?php if (contains($animals, 'birds')) echo 1; else echo 0; ?>" hidden/>
                                            <input id="m" name="marine" type="text" value=
                                            "<?php if (contains($animals, 'marine')) echo 1; else echo 0; ?>" hidden/>
                                            <tr>
                                                <td>
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input id="reptile" class="form-check-input" type="checkbox" value=""
                                                                <?php if (contains($animals, 'reptile')) echo 'checked' ?>/>
                                                            <span class="form-check-sign">
                                                                        <span class="check"></span>
                                                                    </span>
                                                        </label>
                                                    </div>
                                                </td>
                                                <td>สัตว์เลื้อยคลาน</td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input id="birds" class="form-check-input" type="checkbox" value=""
                                                                <?php if (contains($animals, 'birds')) echo 'checked' ?>/>
                                                            <span class="form-check-sign">
                                                                        <span class="check"></span>
                                                                    </span>
                                                        </label>
                                                    </div>
                                                </td>
                                                <td>สัตว์ปีก</td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input id="marine" class="form-check-input" type="checkbox" value=""
                                                                <?php if (contains($animals, 'marine')) echo 'checked' ?>/>
                                                            <span class="form-check-sign">
                                                                        <span class="check"></span>
                                                                    </span>
                                                        </label>
                                                    </div>
                                                </td>
                                                <td>สัตว์น้ำ</td>
                                            </tr>
                                            <button type="submit" class="btn btn-info pull-right">อัพเดท</button>
                                        </form>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
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
    $('#reptile').change(function () {
        if(this.checked){
            $('#r').val(1);
        }else $('#r').val(0);
    });
    $('#birds').change(function () {
        if(this.checked){
            $('#b').val(1);
        }else $('#v').val(0);
    });
    $('#marine').change(function () {
        if(this.checked){
            $('#m').val(1);
        }else $('#m').val(0);
    });
</script>
</html>