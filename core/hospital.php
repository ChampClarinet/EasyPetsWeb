<?php

function drawHospitalCard($hospital){
    echo '<div class="row">';
    echo '<div class="card">';
    echo '<div class="card-header card-header-danger">';
    echo '<div class="row">';
    echo '<div class="col-lg-10 col-md-10 col-sm-10"><h4 class="card-title">รายละเอียดการรักษาพยาบาล</h4></div>';
    echo '<button style="background-color: #AD1612;" type="button" class="btn btn-danger pull-right">';
    if(isset($hospital)) echo 'แก้ไข';
    else echo 'เพิ่ม';
    echo '</button></div></div>';
    echo '<div class="card-body">';
    if(isset($hospital)){
        echo '<div class="table-responsive">';
        echo '<table class="table"><thead><tr>';
        echo '<th style="width: 40%"></th>';
        echo '<th style="width: 60%"></th>';
        echo '</tr></thead>';
        echo '<tbody><tr>';
        echo '<td>รองรับการผ่าตัดใหญ่</td>';
        echo '<td>';
        if (!$hospital['is_accept_big_operation']) echo 'ไม่';
        echo 'รองรับการผ่าตัดใหญ่</td>';
        echo '</tr>';
        echo '<tr><td>ราคาตรวจรักษาโดยประมาณ</td><td>';
        $h = $hospital['checkup_price_rate'];
        if ($h == 1) $h = 50;
        else if ($h == 2) $h = 100;
        else if ($h == 3) $h = 200;
        else if ($h == 4) $h = 500;
        else $h = 1000;
        echo $h . ' บาท';
        echo '</td></tr>';
        echo '<tr><td>ราคาวัคซีนโดยประมาณ</td><td>';
        $h = $hospital['vaccine_price_rate'];
        if ($h == 1) $h = 50;
        else if ($h == 2) $h = 100;
        else if ($h == 3) $h = 200;
        else if ($h == 4) $h = 500;
        else $h = 1000;
        echo $h . ' บาท';
        echo '</td></tr>';
        echo '</tbody></table>';
    }else{
        echo '<h4>ไม่มีข้อมูล</h4>';
    }
    echo '</div></div></div></div>';
}
