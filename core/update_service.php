<?php
require('db_config.php');
session_start();

$service_id = $_POST['service_id'];
$name = $_POST['name'];
$logo_path = null;
$picture_path = null;
$facebook_url = $_POST['facebook_url'];
$open_days = $_POST['open_days'];
$open_time = $_POST['open_time'];
$close_time = $_POST['close_time'];
$tel = $_POST['tel'];
$address = $_POST['address'];
$latitude = $_POST['latitude'];
$longitude = $_POST['longitude'];
$description = $_POST['description'];

if(empty($name) || empty($facebook_url) || empty($tel) || empty($address) || empty($description)){
    echo '<script>alert("กรุณากรอกข้อมูลให้ครบถ้วน");';
    echo 'window.location.href="../edit_service_detail.php";</script>';
    exit();
}

if(strcmp($open_time, $close_time) == 0){
    $open_time = null;
    $close_time = null;
}

//prepping file before upload
if(file_exists($_FILES['logo']['tmp_name']) && is_uploaded_file($_FILES['logo']['tmp_name'])) {
    echo 'logo upload!!!<br>';
    $ext = pathinfo(basename($_FILES['logo']['name']), PATHINFO_EXTENSION);
    $new_image_name = 'imgrpl' . uniqid() . '.' . $ext;
    $image_path = '../bucket/logo/';
    $upload_path = $image_path . $new_image_name;
//following code will upload the file
    $success = move_uploaded_file($_FILES['logo']['tmp_name'], $upload_path);
    $logo_path = $new_image_name;
}else{
    echo 'logo not upload!!!<br>';
}
if(file_exists($_FILES['picture']['tmp_name']) && is_uploaded_file($_FILES['picture']['tmp_name'])) {
    echo 'picture upload!!!<br>';
    $ext = pathinfo(basename($_FILES['picture']['name']), PATHINFO_EXTENSION);
    $new_image_name = 'imgrpl' . uniqid() . '.' . $ext;
    $image_path = '../bucket/picture/';
    $upload_path = $image_path . $new_image_name;
//following code will upload the file
    $success = move_uploaded_file($_FILES['picture']['tmp_name'], $upload_path);
    $picture_path = $new_image_name;
}else{
    echo 'picture not upload!!!<br>';
}

$s = unserialize($_SESSION['service']);
$s->name = $name;
if($logo_path!=null) $s->logo_path = $logo_path;
if($picture_path!=null) $s->picture_path = $picture_path;
$s->facebook_url = $facebook_url;
$s->open_days = $open_days;
$s->open_time = $open_time;
$s->close_time = $open_time;
$s->tel = $tel;
$s->address = $address;
$s->latitude = $latitude;
$s->longitude = $longitude;
$s->description = $description;
$_SESSION['service'] = serialize($s);

$con = connectDB();
$sql = "UPDATE ".$GLOBALS['table_service']." SET NAME='".$name."', ";
if($logo_path!=null) $sql .= "LOGO_PATH='".$logo_path."', ";
if($picture_path!=null) $sql .= "PICTURE_PATH='".$picture_path."', OPEN_DAYS='".$open_days."', ";
$sql .= "FACEBOOK_URL='".$facebook_url."', ";
if($open_time == null || $close_time == null) $sql.="OPEN_TIME=null, CLOSE_TIME=null, ";
else $sql.="OPEN_TIME='".$open_time."', CLOSE_TIME='".$close_time."', ";
$sql.="TEL='".$tel."', ADDRESS='".$address."', LATITUDE=".$latitude.", LONGITUDE=".$longitude.", DESCRIPTION='".$description."'".
" WHERE SERVICE_ID=".$service_id;

$result = $con->query($sql);
if($result){
    echo '<script>alert("แก้ไขข้อมูลสำเร็จ");';
    echo 'window.location.href="../service_detail.php";</script>';
}else{
    echo '<script>alert("แก้ไขข้อมูลล้มเหลว");';
    echo 'window.history.back()";</script>';
}