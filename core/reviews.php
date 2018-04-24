<?php

function drawTableReview()
{
    $review = array(
        array('Oranich Kijprasong', '2018-02-05 16:56:48', 'ร้านสวยมากค่ะ'),
        array('Wallop Opasakhun', '2018-03-01 11:49:12', 'อาบน้ำให้น้องช้าจังครับ'),
        array('Misaka Mikoto', '2018-03-25 17:12:44', 'Nice shop'),
        array('พัศชนันท์ เจียจิรโชติ', '2018-04-15 12:42:59', 'บริการดีมากค่ะ')
    );
    echo '<div class="card"><div class="card-header card-header-info">';
    echo '<h4 class="card-title">รีวิวจากผู้ใช้บริการ</h4>';
    echo '<p class="card-category">มีการรีวิวทั้งหมด ' . count($review) . ' รีวิว</p></div>';
    echo '<div class="card-body table-responsive">';
    echo '<table class="table table-hover"><thead class="text-info">';
    echo '<th>ผู้รีวิว</th><th>รีวิวเมื่อ</th><th>รีวิว</th></thead><tbody>';
    for ($i = 0; $i < count($review); $i++) {
        echo '<tr><td>' . $review[$i][0] . '</td>';
        echo '<td>' . $review[$i][1] . '</td>';
        echo '<td>' . $review[$i][2] . '</td></tr>';
    }
    echo ' </tbody></table></div></div>';
}