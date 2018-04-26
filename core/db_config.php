<?php
error_reporting(E_ERROR | E_PARSE); //disable warnings

$GLOBALS['servername'] = "localhost";
$GLOBALS['db_username'] = "root";
$GLOBALS['db_password'] = "";
$GLOBALS['db_name'] = "easypets";

$GLOBALS['table_user'] = "user";
$GLOBALS['table_service'] = "service";
$GLOBALS['table_groom'] = "grooming";
$GLOBALS['table_deposit'] = "deposit";
$GLOBALS['table_hotel'] = "hotel";
$GLOBALS['table_other'] = "other_service";
$GLOBALS['table_hospital'] = "hospital";
$GLOBALS['table_review'] = "review";
$GLOBALS['table_service_pet_available'] = "service_pet_available";
$GLOBALS['table_special_pets'] = "special_pets";
$GLOBALS['table_reply'] = "reply";
$GLOBALS['table_like_condition'] = "like_condition";

//header("content-type:text/javascript;charset=utf-8");

function connectDB(){
    $con = mysqli_connect($GLOBALS['servername'], $GLOBALS['db_username'], $GLOBALS['db_password'], $GLOBALS['db_name']) or die(mysqli_connect_error());
    $con->query("USE ".$GLOBALS['db_name']);
    $con->query("SET NAMES UTF8");
    return $con;
}
