<?php
require('db_config.php');
$service_id = $_POST['service_id'];
$component = $_POST['component'];
$con = connectDB();
$sql = "DELETE FROM ".$component." WHERE SERVICE_ID=".$service_id;

$result = $con->query($sql);
if($result){
    echo 'ลบบริการเรียบร้อย';
}else{
    echo 'เกิดข้อผิดพลาดในการลบ';
}
exit();