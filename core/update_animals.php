<?php
require('db_config.php');
$service_id = $_POST['service_id'];
$lizard = $_POST['reptile'];
$birds = $_POST['birds'];
$marine = $_POST['marine'];
/*
echo $lizard.'<br>';
echo $pig.'<br>';
echo $snake.'<br>';;
*/
$con = connectDB();
$sql_add = "REPLACE INTO service_pet_available SET SERVICE_ID=".$service_id.", PET_ID=";
$sql_delete = "DELETE FROM service_pet_available WHERE SERVICE_ID=".$service_id." AND PET_ID=";
$sql = array();
if($lizard==1){
    $s = $sql_add.'1';
    array_push($sql, $s);
}else{
    $s = $sql_delete.'1';
    array_push($sql, $s);
}
if($birds==1){
    $s = $sql_add.'5';
    array_push($sql, $s);
}else{
    $s = $sql_delete.'5';
    array_push($sql, $s);
}
if($marine==1){
    $s = $sql_add.'6';
    array_push($sql, $s);
}else{
    $s = $sql_delete.'6';
    array_push($sql, $s);
}

foreach ($sql as $q){
    $result = $con->query($q);
}
echo '<script>alert("อัพเดทแล้ว");';
echo 'window.history.back();</script>';