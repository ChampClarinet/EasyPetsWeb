<?php
require('db_config.php');
$s = $_POST['service_id'];
$p = $_POST['grooming_price_rate'];
$n = $_POST['new'];
if($n == 0) $sql = "UPDATE ".$GLOBALS['table_groom']." SET grooming_price_rate=".$p." WHERE SERVICE_ID=".$s;
else $sql = "INSERT INTO ".$GLOBALS['table_groom']." VALUES (".$s.", ".$p.")";

$con = connectDB();
$result = $con->query($sql);
if($result){
    echo '<script>alert("แก้ไขข้อมูลสำเร็จ");';
    echo 'window.location.href="../service_detail.php";</script>';
}else{
    echo '<script>alert("แก้ไขข้อมูลล้มเหลว");';
    echo 'window.history.back()";</script>';
}