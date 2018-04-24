<?php

function drawTableReply()
{
    $reply = array(
        array('พัศชนันท์ เจียจิรโชติ', 'บริการดีมากค่ะ', 'ขอบคุณครับ ทางร้านเรายินดีให้บริการครับ'),
        array('Wallop Opasakhun', 'อาบน้ำให้น้องช้าจังครับ', 'ขออภัยในความไม่สะดวกนะครับ ทางเราจะดำเนินการแก้ไขให้เร็วที่สุดครับ'),
        array('Misaka Mikoto', 'Nice shop', 'Thanks'),
    );
    echo '<div class="card"><div class="card-header card-header-info">';
    echo '<h4 class="card-title">การตอบกลับ</h4>';
    echo '<p class="card-category">มีการตอบกลับ ' . count($reply) . ' การตอบกลับ</p></div>';
    echo '<div class="card-body table-responsive">';
    echo '<table class="table table-hover"><thead class="text-info">';
    echo '<th>ตอบกลับไปยัง</th><th>จากการรีวิว</th><th>การตอบกลับ</th></thead><tbody>';
    for ($i = 0; $i < count($reply); $i++) {
        echo '<tr><td>' . $reply[$i][0] . '</td>';
        echo '<td>' . $reply[$i][1] . '</td>';
        echo '<td>' . $reply[$i][2] . '</td></tr>';
    }
    echo ' </tbody></table></div></div>';
}