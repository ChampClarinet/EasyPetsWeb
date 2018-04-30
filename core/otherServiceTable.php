<?php

function drawOtherServiceTable($service_id)
{
    $services = getOtherService($service_id);
    echo '<div class="row">';
    if($services == null){
        echo '</div><div class="row">';
        echo '<div class="col-lg-4 col-md-4 col-sm-4">';
        echo '<a href="add_new_service.php"><div class="card">';
        echo '<div class="card-body">';
        echo '<div class="card-title">เพิ่มบริการอื่นๆ</div></div>';
        echo '</div></a></div></div>';
    }else {
        for ($i = 0; $i < count($services); ++$i) {
            echo '<div class="col-lg-6 col-md-6 col-sm-6">';
            echo '<div class="card">';
            echo '<div class="card-header card-header-info"><div class="row">';
            echo '<div class="col-lg-10 col-md-10 col-sm-10"><h4 class="card-title">' . $services[$i]['service_details'] . '</h4></div>';
            echo '<button onclick="deleteConfirm(\'' . $services[$i]['service_details'] . '\', ' . $services[$i]['other_service_id'] . ');" style="background-color: #394F92;" type="button" class="btn btn-info pull-right">ลบ</button>';
            echo '</div></div>';
            echo '<div class="card-body"><div class="table-responsive"><table class="table"><tbody><tr>';
            echo '<td>ราคา</td>';
            echo '<td>' . $services[$i]['service_price'] . '</td>';
            echo '</tr></tbody></table>';
            echo '</div></div></div></div>';
            if ($i % 2 == 1) echo '</div><div class="row">';
        }
        echo '</div><div class="row">';
        echo '<div class="col-lg-4 col-md-4 col-sm-4">';
        echo '<a href="add_new_service.php"><div class="card">';
        echo '<div class="card-body">';
        echo '<div class="card-title">เพิ่มบริการอื่นๆ</div></div>';
        echo '</div></a></div></div>';
    }

    echo '<script>function deleteConfirm(service_details, other_service_id){';
    echo 'let data = {other_service_id: other_service_id};';
    echo 'if(confirm("คุณแน่ใจหรือไม่ที่จะลบบริการ "+service_details)){';
    echo '$.post("core/delete_other_service.php", data,function (data, status) {console.log(data);';
    echo 'if(status === "success") {alert(data);location.reload();}';
    echo 'else alert("error: "+data);})}};</script>';
}

function getOtherService($service_id)
{
    $con = connectDB();
    $sql = "SELECT * FROM " . $GLOBALS['table_other'] . " WHERE SERVICE_ID = " . $service_id;
    $result = $con->query($sql);
    if ($result->num_rows > 0) {
        $s = array();
        while ($row = $result->fetch_assoc()) {
            array_push($s, $row);
        }
        return $s;
    }
    //echo '<script>console.log("' . $sql . '");</script>';
    return null;
}