<?php
require('db_config.php');
$s = $_POST['service_id'];
$is_accept_big_operation = $_POST['is_accept_big_operation'];
$vaccine_price_rate = $_POST['vaccine_price_rate'];
$operation_price_rate = $_POST['operation_price_rate'];
$checkup_price_rate = $_POST['checkup_price_rate'];
$n = $_POST['new'];

if($n == 0) $sql = "UPDATE ".$GLOBALS['table_hospital']." SET is_accept_big_operation=".$is_accept_big_operation.", vaccine_price_rate=".$vaccine_price_rate.
    ", operation_price_rate=".$operation_price_rate.", checkup_price_rate=".$checkup_price_rate.
    " WHERE SERVICE_ID=".$s;
else $sql = "INSERT INTO ".$GLOBALS['table_hospital']." VALUES (".$s.", ".$is_accept_big_operation.", ".$vaccine_price_rate.", ".
    $operation_price_rate.", ".$checkup_price_rate.")";

$con = connectDB();
$result = $con->query($sql);
if($result){
    echo '<script>alert("แก้ไขข้อมูลสำเร็จ");';
    echo 'window.location.href="../service_detail.php";</script>';
}else{
    echo '<script>alert("แก้ไขข้อมูลล้มเหลว");';
    echo 'window.history.back()";</script>';
}