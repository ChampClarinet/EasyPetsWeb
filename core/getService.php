<?php

function loadService($service_id){
    $con = connectDB();
    $sql = "SELECT * FROM ".$GLOBALS['table_service']." WHERE SERVICE_ID=".$service_id;
    $result = $con->query($sql);
    $con->close();
    if($result->num_rows > 0) {
        $row = mysqli_fetch_assoc($result);
        $service = createService($row);
        return $service;
    }return null;
}

function createService($row){
    $service = new Service();
    $service->service_id = $row['service_id'];
    $service->owner_uid = $row['owner_uid'];
    $service->name = $row['name'];
    $service->logo_path = $row['logo_path'];
    $service->picture_path = $row['picture_path'];
    $service->facebook_url = $row['facebook_url'];
    $service->open_days = $row['open_days'];
    $service->open_time = $row['open_time'];
    $service->close_time = $row['close_time'];
    $service->tel = $row['tel'];
    $service->address = $row['address'];
    $service->latitude = $row['latitude'];
    $service->longitude = $row['longitude'];
    $service->description = $row['description'];
    return $service;
}