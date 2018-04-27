<?php
include 'getReply.php';
function drawTableReplySmall($service_id){
    $reply = getReply($service_id);
    echo '<div class="card"><div class="card-header card-header-info"><h4 class="card-title">การตอบกลับ</h4>';
    if (count($reply) > 0) {
        echo '<p class="card-category">มีการตอบกลับ ' . count($reply) . ' การตอบกลับ</p></div>'; //close header div
        echo '<div class="card-body table-responsive"><table class="table table-hover">';
        echo '<thead class="text-info"><tr><th></th><th style="width: 5%;"></th></tr></thead><tbody>';
        for ($i = 0; $i < count($reply); $i++) {
            echo '<tr>';
            echo '<td>' . $reply[$i]['reply_text'] . '</td>';
            echo '<td><a href="reply.php?id=' . $reply[$i]["reply_id"] . '"><button type="button" class="btn btn-info">รายละเอียด</button></a></td>';
            echo '</tr>';
        }
        echo '</tbody></table></div>';
    } else {
        echo '</div>';//close header div
        echo '<div class="card-body table-responsive"><table class="table table-hover"><thead class="text-info">';
        echo '<tr><th></th><th style="width: 5%;"></th></tr>';
        echo '</thead><tbody><tr><td>ยังไม่มีการตอบกลับ</td></tr></tbody></table></div>';
    }
    echo '</div>'; //close card div
}

function drawTableReply($reply)
{
    if (isset($reply)) {
        echo '<div class="card"><div class="card-header card-header-info">';
        echo '<h4 class="card-title">การตอบกลับ</h4>';
        echo '</div>';
        echo '<div class="card-body table-responsive"><table class="table table-hover"><thead class="text-info">';
        echo '<th>ตอบกลับไปยัง</th><th>จากการรีวิว</th><th>รูปภาพตอบกลับ</th><th style="width: 5%;"></th></thead><tbody>';
        echo '<tr><td>' . $reply['reviewer_name'] . '</td>';
        echo '<td>' . $reply['review_text'] . '</td>';
        echo '<td><img src="bucket/replyPictures/' . $reply['reply_picture_path'] . '" class="img-fluid" alt="reply picture"style="max-width: 400px;max-height: 400px;"></td>';
        echo '<td><a href="reply.php?id=' . $reply["reply_id"] . '"><button type="button" class="btn btn-info">ตอบกลับ</button></a></td></tr>';
        echo '</tbody></table></div>';
    } else {
        echo '<div class="card">';
        echo '<div class="card-body table-responsive"><table class="table table-hover">';
        echo '<tr><h4>ไม่พบการตอบกลับนี้</h4></tr>';
        echo '<td><a href="dashboard.php"><button type="button" class="btn btn-info">ย้อนกลับ</button></a></td></tr>';
        echo '</table></div>';
    }
    /*$reply = array(
        array('พัศชนันท์ เจียจิรโชติ', 'บริการดีมากค่ะ', 'ขอบคุณครับ ทางร้านเรายินดีให้บริการครับ'),
        array('Wallop Opasakhun', 'อาบน้ำให้น้องช้าจังครับ', 'ขออภัยในความไม่สะดวกนะครับ ทางเราจะดำเนินการแก้ไขให้เร็วที่สุดครับ'),
        array('Misaka Mikoto', 'Nice shop', 'Thanks'),
    );*/
}