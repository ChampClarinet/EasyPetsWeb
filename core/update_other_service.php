<?php
require('db_config.php');
$oid = $_POST['other_service_id'];
$s = $_POST['service_details'];
$p = $_POST['service_price'];
$sql = "UPDATE ".$GLOBALS['table_other']." SET service_details='".$s."', service_price='".$p."' WHERE other_service_id=".$oid;

$con = connectDB();
$result = $con->query($sql);
if($result){
    echo '<script>alert("แก้ไขข้อมูลสำเร็จ");';
    echo 'window.location.href="../service_detail.php";</script>';
}else{
    echo '<script>alert("แก้ไขข้อมูลล้มเหลว");';
    echo 'window.history.back()";</script>';
}