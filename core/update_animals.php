<?php
require('db_config.php');
$service_id = $_POST['service_id'];
$lizard = $_POST['lizard'];
$pig = $_POST['pig'];
$snake = $_POST['snake'];
$fennec_fox = $_POST['fennec_fox'];

echo $lizard.'<br>';
echo $pig.'<br>';
echo $snake.'<br>';
echo $fennec_fox.'<br>';

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
if($pig==1){
    $s = $sql_add.'2';
    array_push($sql, $s);
}else{
    $s = $sql_delete.'2';
    array_push($sql, $s);
}
if($snake==1){
    $s = $sql_add.'3';
    array_push($sql, $s);
}else{
    $s = $sql_delete.'3';
    array_push($sql, $s);
}
if($fennec_fox==1){
    $s = $sql_add.'4';
    array_push($sql, $s);
}else{
    $s = $sql_delete.'4';
    array_push($sql, $s);
}

foreach ($sql as $q){
    $result = $con->query($q);
    /*echo $q.': ';
    if($result) echo 'ok<br>';
    else echo 'fail<br>';*/
}
echo '<script>alert("อัพเดทแล้ว");';
echo 'window.location.href = "../animal.php";</script>';