<?php
require('core/libraries.php');
require('core/renderer/barsAndFooter.php');
require('core/model/Service.php');
require('core/db_config.php');
require('core/serviceLoader.php');
include 'core/renderer/header_inc.php';
setTitle('สัตว์พิเศษ');
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
                                            <input name="service_id" type="text" value="<?php echo $service_id; ?>"hidden/>
                                            <input id="l" name="lizard" type="text" value=
                                            "<?php if (contains($animals, 'lizard')) echo 1; else echo 0; ?>" hidden/>
                                            <input id="p" name="pig" type="text" value=
                                            "<?php if (contains($animals, 'pig')) echo 1; else echo 0; ?>" hidden/>
                                            <input id="s" name="snake" type="text" value=
                                            "<?php if (contains($animals, 'snake')) echo 1; else echo 0; ?>" hidden/>
                                            <input id="f" name="fennec_fox" type="text" value=
                                            "<?php if (contains($animals, 'fennec fox')) echo 1; else echo 0; ?>" hidden/>
                                            <tr>
                                                <td>
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input id="lizard" class="form-check-input" type="checkbox" value=""
                                                                <?php if (contains($animals, 'lizard')) echo 'checked' ?>/>
                                                            <span class="form-check-sign">
                                                                        <span class="check"></span>
                                                                    </span>
                                                        </label>
                                                    </div>
                                                </td>
                                                <td>กิ้งก่า</td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input id="pig" class="form-check-input" type="checkbox" value=""
                                                                <?php if (contains($animals, 'pig')) echo 'checked' ?>/>
                                                            <span class="form-check-sign">
                                                                        <span class="check"></span>
                                                                    </span>
                                                        </label>
                                                    </div>
                                                </td>
                                                <td>หมูแคระ</td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input id="snake" class="form-check-input" type="checkbox" value=""
                                                                <?php if (contains($animals, 'snake')) echo 'checked' ?>/>
                                                            <span class="form-check-sign">
                                                                        <span class="check"></span>
                                                                    </span>
                                                        </label>
                                                    </div>
                                                </td>
                                                <td>งู</td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input id="fox" class="form-check-input" type="checkbox" value=""
                                                                <?php if (contains($animals, 'fennec fox')) echo 'checked' ?>/>
                                                            <span class="form-check-sign">
                                                                        <span class="check"></span>
                                                                    </span>
                                                        </label>
                                                    </div>
                                                </td>
                                                <td>fennec fox</td>
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
    $('#lizard').change(function () {
        if(this.checked){
            $('#l').val(1);
        }else $('#l').val(0);
    });
    $('#pig').change(function () {
        if(this.checked){
            $('#p').val(1);
        }else $('#p').val(0);
    });
    $('#snake').change(function () {
        if(this.checked){
            $('#s').val(1);
        }else $('#s').val(0);
    });
    $('#fox').change(function () {
        if(this.checked){
            $('#f').val(1);
        }else $('#f').val(0);
    });
</script>
</html>