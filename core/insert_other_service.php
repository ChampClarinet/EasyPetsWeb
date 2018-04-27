<?php
require('db_config.php');
$service_id = $_POST['service_id'];
$service_details = $_POST['service_details'];
$service_price = $_POST['service_price'];

if(empty($service_details)){
    echo '<script>alert("กรุณาใส่ชื่อบริการ");window.history.back();</script>';
}else{
    $con = connectDB();
    $sql = 'INSERT INTO '.$GLOBALS['table_other'].' (SERVICE_ID, SERVICE_DETAILS, SERVICE_PRICE) '.
        'VALUES ('.$service_id.', "'.$service_details.'", "'.$service_price.'")';
    $result = $con->query($sql);
    if($result){
        echo '<script>alert("เพิ่มบริการสำเร็จ");';
        echo 'window.location.href="../service_detail.php";</script>';
    }else{
        echo '<script>alert("เกิดข้อผิดพลาด กรุณาลองใหม่");';
        echo 'console.log("'.$sql.'")';
        echo 'window.history.back();</script>';
    }
}