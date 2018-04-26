<?php

function drawOtherServiceTable($service_id){
    $services = getOtherService($service_id);
    echo '<div class="row"';
    if($services == null){
        echo ' hidden>';
        return;
    }
    echo '>';
    for($i=0;$i<count($services);++$i){
        echo '<div class="col-lg-4 col-md-4 col-sm-4">';
        echo '<div class="card">';
        echo '<div class="card-header card-header-info">';
        echo '<h4 class="card-title">'.$services[$i]['service_details'].'</h4>';
        echo '</div>';
        echo '<div class="card-body"><div class="table-responsive"><table class="table"><tbody><tr>';
        echo '<td>ราคา</td>';
        echo '<td>'.$services[$i]['service_price'].'</td>';
        echo '</tr></tbody></table>';
        echo '</div></div></div></div>';
        if($i%3==2) echo '<script>console.log("end row");</script></div><div class="row">';
    }
}

function getOtherService($service_id){
    $con = connectDB();
    $sql = "SELECT * FROM ".$GLOBALS['table_other']." WHERE SERVICE_ID = ".$service_id;
    $result = $con->query($sql);
    if($result->num_rows > 0){
        $s = array();
        while ($row = $result->fetch_assoc()) {
            array_push($s, $row);
        }
        return $s;
    }
    echo '<script>console.log("'.$sql.'");</script>';
    return null;
}