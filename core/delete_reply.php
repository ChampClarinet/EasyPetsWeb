<?php
require('db_config.php');
$reply_id = $_POST['reply_id'];
$con = connectDB();
$sql = "DELETE FROM ".$GLOBALS['table_reply']." WHERE REPLY_ID = ".$reply_id;
$result = $con->query($sql);
if($result){
    echo 'ลบการตอบกลับเรียบร้อย';
}else{
    echo 'เกิดข้อผิดพลาดในการลบ';
}
exit();