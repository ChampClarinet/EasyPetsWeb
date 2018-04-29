<?php
require('db_config.php');
$s = $_POST['service_id'];
$is_accept_overnight = $_POST['is_accept_overnight'];
$hotel_price = $_POST['hotel_price'];
$n = $_POST['new'];

if($n == 0) $sql = "UPDATE ".$GLOBALS['table_hotel']." SET is_accept_overnight=".$is_accept_overnight.", hotel_price=".$hotel_price.
    " WHERE SERVICE_ID=".$s;
else $sql = "INSERT INTO ".$GLOBALS['table_hostable_hotelpital']." VALUES (".$s.", ".$is_accept_overnight.", ".$hotel_price.")";

$con = connectDB();
$result = $con->query($sql);
if($result){
    echo '<script>alert("แก้ไขข้อมูลสำเร็จ");';
    echo 'window.location.href="../service_detail.php";</script>';
}else{
    echo '<script>alert("แก้ไขข้อมูลล้มเหลว");';
    echo 'window.history.back()";</script>';
}