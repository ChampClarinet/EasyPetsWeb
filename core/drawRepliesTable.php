<?php
function drawTableReply($service_id)
{
    $reply = getReply($service_id);
    /*$reply = array(
        array('พัศชนันท์ เจียจิรโชติ', 'บริการดีมากค่ะ', 'ขอบคุณครับ ทางร้านเรายินดีให้บริการครับ'),
        array('Wallop Opasakhun', 'อาบน้ำให้น้องช้าจังครับ', 'ขออภัยในความไม่สะดวกนะครับ ทางเราจะดำเนินการแก้ไขให้เร็วที่สุดครับ'),
        array('Misaka Mikoto', 'Nice shop', 'Thanks'),
    );*/
    echo '<div class="card"><div class="card-header card-header-info">';
    echo '<h4 class="card-title">การตอบกลับ</h4>';
    if (count($reply) > 0) {
        echo '<p class="card-category">มีการตอบกลับ ' . count($reply) . ' การตอบกลับ</p>';
        echo '</div>';
        echo '<div class="card-body table-responsive"><table class="table table-hover"><thead class="text-info">';
        echo '<th>ตอบกลับไปยัง</th><th>จากการรีวิว</th><th>การตอบกลับ</th></thead><tbody>';
        for ($i = 0; $i < count($reply); $i++) {
            echo '<tr id="' . $reply[$i]['reply_id'] . '"><td>' . $reply[$i]['reviewer_name'] . '</td>';
            echo '<td>' . $reply[$i]['review_text'] . '</td>';
            echo '<td>' . $reply[$i]['reply_text'] . '</td></tr>';
        }
        echo '</tbody></table></div>';
    } else {
        echo '</div>'; //title
        echo '<div class="card-body"><h5>ยังไม่มีการตอบกลับ</h5></div>';
    }
    echo '</div>';//card
}

function getReply($service_id)
{
    $con = connectDB();
    $sql = "SELECT * FROM " . $GLOBALS['table_reply'] .
        " INNER JOIN " . $GLOBALS['table_review'] . " ON " . $GLOBALS['table_reply'] . ".REVIEW_ID = " . $GLOBALS['table_review'] . ".REVIEW_ID" .
        " where SERVICE_ID = " . $service_id;
    $result = $con->query($sql);
    $con->close();
    if ($result->num_rows > 0) {
        $reply = array();
        while ($row = $result->fetch_assoc()) {
            $review = getAssociateReview($row['review_id']);
            $row['reviewer_name'] = $review['name'];
            $row['review_text'] = $review['review_text'];
            array_push($reply, $row);
        }
        return $reply;
    } else {
        return null;
    }
}

function getAssociateReview($review_id)
{
    $con = connectDB();
    $sql = "SELECT " . $GLOBALS['table_review'] . ".review_text, " . $GLOBALS['table_user'] . ".name FROM " . $GLOBALS['table_review'] .
        " INNER JOIN " . $GLOBALS['table_user'] . " ON " . $GLOBALS['table_review'] . ".REVIEWER_UID = " . $GLOBALS['table_user'] . ".UID" .
        " WHERE " . $GLOBALS['table_review'] . ".REVIEW_ID = " . $review_id;
    $result = $con->query($sql);
    $con->close();
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        return $row;
    } else {
        echo '<script>console.log("' . $sql . '")</script>';
        $row = array(
            'review_text' => 'review_text',
            'name' => 'reviewer_name'
        );
        return $row;
    }
}