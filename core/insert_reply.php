<?php
require('db_config.php');

$review_id = $_POST['review_id'];
$reply_text = $_POST['reply_text'];
$reply_image = null;

if(empty($_POST['reply_text'])){
    echo '<script>alert("กรุณาใส่ข้อความตอบกลับ");';
    echo 'window.location.href="../write_reply.php?review_id='.$review_id.'";</script>';
    exit();
}

//foreach($_POST as $key => $value)echo '<script>console.log("'.$key.' : '.$value.'");</script>';

//prepping file before upload
if(file_exists($_FILES['reply_image']['tmp_name']) && is_uploaded_file($_FILES['reply_image']['tmp_name'])) {
    echo 'upload!!!';
    $ext = pathinfo(basename($_FILES['reply_image']['name']), PATHINFO_EXTENSION);
//$f = $_FILES['reply_image'];
//foreach($f as $key => $value)echo '<script>console.log("'.$key.' : '.$value.'");</script>';
    $new_image_name = 'imgrpl' . uniqid() . '.' . $ext;
    $image_path = '../bucket/replyPictures/';
    $upload_path = $image_path . $new_image_name;
//following code will upload the file
    $success = move_uploaded_file($_FILES['reply_image']['tmp_name'], $upload_path);
    $reply_image = $new_image_name;
}else{
    echo 'not upload!!!';
}
echo $reply_image;
$con = connectDB();
if($reply_image == null)$sql = 'INSERT INTO '.$GLOBALS['table_reply'].' (REVIEW_ID, REPLY_TEXT, REPLY_PICTURE_PATH) VALUES ('.$review_id.', "'.$reply_text.'", "'.$reply_image.'")';
else $sql = 'INSERT INTO '.$GLOBALS['table_reply'].' (REVIEW_ID, REPLY_TEXT) VALUES ('.$review_id.', "'.$reply_text.'")';
echo '<script>alert("'.$sql.'");</script>';
$result = $con->query($sql);
if($result){
    echo '<script>alert("เพิ่มการตอบกลับแล้ว");';
    echo 'window.location.href="../dashboard.php";</script>';
}else{
    echo '<script>alert("เพิ่มการตอบกลับล้มเหลว");';
    echo 'window.location.href="../write_reply.php?review_id='.$review_id.'";</script>';
}