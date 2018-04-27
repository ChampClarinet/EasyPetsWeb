<?php
require('db_config.php');
$other_service_id = $_POST['other_service_id'];
$con = connectDB();
$sql = "DELETE FROM ".$GLOBALS['table_other']." WHERE OTHER_SERVICE_ID = ".$other_service_id;
$result = $con->query($sql);
if($result){
    echo 'ลบบริการเรียบร้อย';
}else{
    echo 'เกิดข้อผิดพลาดในการลบ';
}
exit();