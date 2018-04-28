<?php

function drawGroomCard($groom){
    echo '<div class="row">';
    echo '<div class="card">';
    echo '<div class="card-header card-header-success">';
    echo '<div class="row">';
    echo '<div class="col-lg-10 col-md-10 col-sm-10"><h4 class="card-title">รายละเอียดการอาบน้ำ ตัดขน</h4></div>';
    echo '<a href="groomDetail.php?new=';
    $btn = 'เพิ่ม';
    if(isset($groom)){
        echo 0;
        $btn='แก้ไข';
    }
    else echo 1;
    echo '"><button style="background-color: #207E26;" type="button" class="btn btn-success pull-right">';
    echo $btn;
    echo '</button></a></div></div>';
    echo '<div class="card-body">';
    if(isset($groom)){
        echo '<div class="table-responsive">';
        echo '<table class="table"><thead><tr>';
        echo '<th style="width: 40%"></th>';
        echo '<th style="width: 60%"></th>';
        echo '</tr></thead>';
        echo '<tbody><tr>';
        echo '<td>ราคาอาบน้ำ / ตัดขน เริ่มต้นที่</td>';
        echo '<td>';
        $g = $groom['grooming_price_rate'];
        if ($g == 1) $g = 200;
        else if ($g == 2) $g = 300;
        else if ($g == 3) $g = 500;
        else if ($g == 4) $g = 800;
        else $g = 1000;
        echo $g . ' บาท';
        echo '</td></tr></tbody></table>';
    }else{
        echo '<h4>ไม่มีข้อมูล</h4>';
    }
    echo '</div></div></div></div>';
}