<?php

function drawHotelCard($hotel)
{
    echo '<div class="row">';
    echo '<div class="card">';
    echo '<div class="card-header card-header-warning">';
    echo '<div class="row">';
    echo '<div class="col-lg-10 col-md-10 col-sm-10"><h4 class="card-title">รายละเอียดการรับฝากสัตว์เลี้ยง</h4></div>';
    echo '<a href="hotelDetail.php?new=';
    $btn = 'เพิ่ม';
    if(isset($hotel)){
        echo 0;
        $btn='แก้ไข';
    }
    else echo 1;
    echo '"><button style="background-color: #AA6600;" type="button" class="btn btn-warning pull-right">';
    echo $btn;
    echo '</button></a></div></div>';
    echo '<div class="card-body">';
    if (isset($hotel)) {
        echo '<div class="table-responsive">';
        echo '<table class="table"><thead><tr>';
        echo '<th style="width: 40%"></th>';
        echo '<th style="width: 60%"></th>';
        echo '</tr></thead>';
        echo '<tbody><tr>';
        echo '<td>รับฝากค้างคืน</td>';
        echo '<td>';
        if (!$hotel['is_accept_overnight']) echo 'ไม่';
        echo 'รับฝากค้างคืน</td>';
        echo '</tr>';
        echo '<tr><td>ค่าบริการรับฝากโดยประมาณ</td><td>';
        $h = $hotel['hotel_price'];
        if ($h == 1) $h = 100;
        else if ($h == 2) $h = 200;
        else if ($h == 3) $h = 300;
        else if ($h == 4) $h = 500;
        else $h = 1000;
        echo $h . ' บาท';
        echo '</td></tr>';
        echo '</tbody></table>';
    } else {
        echo '<h4>ไม่มีข้อมูล</h4>';
    }
    echo '</div></div></div></div>';
}