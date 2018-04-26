<?php
//require db_config.php before require this file
function getComponent($serviceType, $service_id){
    $con = connectDB();
    $sql = 'SELECT * FROM '.$serviceType.' WHERE SERVICE_ID = "'.$service_id.'"';
    $result = $con->query($sql);
    $con->close();
    if($result->num_rows > 0){
        $row = mysqli_fetch_assoc($result);
        return $row;
    }else{
        echo '<script>console.log("'.$sql.'")</script>';
        return null;
    }
}