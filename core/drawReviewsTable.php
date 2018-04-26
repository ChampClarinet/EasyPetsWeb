<?php
function drawTableReview($service_id)
{
    $review = getReview($service_id);
    echo '<div class="card"><div class="card-header card-header-info">';
    echo '<h4 class="card-title">รีวิวจากผู้ใช้บริการ</h4>';
    if(count($review) > 0){
        echo '<p class="card-category">มีการรีวิวทั้งหมด ' . count($review) . ' รีวิว</p>';
        echo '</div>';
        echo '<div class="card-body table-responsive"><table class="table table-hover"><thead class="text-info">';
        echo '<th>ตอบกลับไปยัง</th><th>จากการรีวิว</th><th>การตอบกลับ</th></thead><tbody>';
        for ($i = 0; $i < count($review); $i++) {
            echo '<tr id="'.$review[$i]['review_id'].'"><td>' . $review[$i]['reviewer_name'] . '</td>';
            echo '<td>' . $review[$i]['time_reviewed'] . '</td>';
            echo '<td>' . $review[$i]['review_text'] . '</td></tr>';
        }
        echo '</tbody></table></div>';
    }else echo '</div><div class="card-body table-responsive"><h5>ยังไม่มีรีวิว</h5></div>';
    echo '</div>';
}

function getReview($service_id)
{
    $con = connectDB();
    $sql = "SELECT * FROM " . $GLOBALS['table_review'] . " where SERVICE_ID = " . $service_id;
    $result = $con->query($sql);
    $con->close();
    if ($result->num_rows > 0) {
        $review = array();
        while ($row = $result->fetch_assoc()) {
            $row['reviewer_name'] = getReviewerName($row['reviewer_uid']);
            array_push($review, $row);
        }
        return $review;
    } else {
        return null;
    }
}

function getReviewerName($reviewer_uid)
{
    $con = connectDB();
    $sql = "SELECT * FROM " . $GLOBALS['table_user'] . " where UID = '" . $reviewer_uid."'";
    $result = $con->query($sql);
    $con->close();
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        return $row['name'];
    } else {
        return 'reviewer_name';
    }
}