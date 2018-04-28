<?php
require('db_config.php');
require('model/Service.php');
session_start();
$uid = $_POST['uid'];
$con = connectDB();
$sql = 'SELECT * FROM '.$GLOBALS['table_service'].' WHERE OWNER_UID = "'.$uid.'"';
$result = $con->query($sql);
$con->close();
if($result->num_rows > 0){
    $row = mysqli_fetch_assoc($result);
    $service_id = $row['service_id'];
    $_SESSION['service_id'] = $service_id;
    echo 'สวัสดี '.$row['name'];
}else echo $GLOBALS['login_error'];