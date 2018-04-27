<?php
include 'getReview.php';

function drawTableReviewSmall($service_id)
{
    $review = getReview($service_id);
    echo '<div class="card"><div class="card-header card-header-info"><h4 class="card-title">รีวิวจากผู้ใช้บริการ</h4>';
    if (count($review) > 0) {
        echo '<p class="card-category">มีการรีวิวทั้งหมด ' . count($review) . ' รีวิว</p></div>'; //close header div
        echo '<div class="card-body table-responsive"><table class="table table-hover">';
        echo '<thead class="text-info"><tr><th></th><th style="width: 5%;"></th></tr></thead><tbody>';
        for ($i = 0; $i < count($review); $i++) {
            echo '<tr>';
            echo '<td>' . $review[$i]['review_text'] . '</td>';
            echo '<td><a href="review.php?id=' . $review[$i]["review_id"] . '"><button type="button" class="btn btn-info">รายละเอียด</button></a></td>';
            echo '</tr>';
        }
        echo '</tbody></table></div>';
    } else {
        echo '</div>';//close header div
        echo '<div class="card-body table-responsive"><table class="table table-hover"><thead class="text-info">';
        echo '<tr><th></th><th style="width: 5%;"></th></tr>';
        echo '</thead><tbody><tr><td>ยังไม่มีรีวิว</td></tr></tbody></table></div>';
    }
    echo '</div>'; //close card div
}

?>

<?php
function drawTableReview($review)
{
    if (isset($review)) {
        echo '<div class="card"><div class="card-header card-header-info">';
        echo '<h4 class="card-title">' . $review['review_text'] . '</h4>';
        echo '</div>';
        echo '<div class="card-body table-responsive"><table class="table table-hover"><thead class="text-info">';
        echo '<th>รีวิวโดย</th><th>รีวิวเมื่อ</th><th>รูปภาพ</th><th style="width: 5%;"></th></thead><tbody>';
        echo '<tr><td>' . $review['reviewer_name'] . '</td>';
        echo '<td>' . $review['time_reviewed'] . '</td>';
        if(strlen($review['review_picture_path']) == 0){
            echo '<td>ไม่มีรูปภาพ</td>';
        }else{
            echo '<td><img src="bucket/reviewPictures/' . $review['review_picture_path'] . '" class="img-fluid" alt="review picture" style="max-width: 400px;max-height: 400px;"></td>';
        }
        echo '<td><a href="write_reply.php?review_id=' . $review["review_id"] . '"><button type="button" class="btn btn-info">ตอบกลับ</button></a></td></tr>';
        echo '</tbody></table></div>';
    } else {
        echo '<div class="card">';
        echo '<div class="card-body table-responsive"><table class="table table-hover">';
        echo '<tr><h4>ไม่พบรีวิวนี้</h4></tr>';
        echo '</tr>';
        echo '</table></div>';
    }
}