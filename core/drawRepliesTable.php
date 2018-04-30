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
        echo '<h4 class="card-title">'.$reply['reply_text'].'</h4>';
        echo '</div>';
        echo '<div class="card-body table-responsive"><table class="table table-hover"><thead class="text-info">';
        echo '<th>ตอบกลับไปยัง</th><th>จากการรีวิว</th><th>รูปภาพตอบกลับ</th><th style="width: 5%;"></th></thead><tbody>';
        echo '<tr><td>' . $reply['reviewer_name'] . '</td>';
        echo '<td>' . $reply['review_text'] . '</td>';
        if(strlen($reply['reply_picture_path'])==0){
            echo '<td>ไม่มีรูปภาพ</td>';
        }else{
            echo '<td><img src="bucket/replyPictures/' . $reply['reply_picture_path'] . '" class="img-fluid" alt="reply picture"style="max-width: 400px;max-height: 400px;"></td>';
        }
        echo '<td><button id="deleteButton" type="button" class="btn btn-danger">ลบ</button></td></tr>';
        echo '</tbody></table></div>';
    } else {
        echo '<div class="card">';
        echo '<div class="card-body table-responsive"><table class="table table-hover">';
        echo '<tr><h4>ไม่พบการตอบกลับนี้</h4></tr>';
        echo '</tr>';
        echo '</table></div>';
    }
    echo '<script>document.getElementById("deleteButton").onclick = function deleteConfirm(){let data = {reply_id: '.$reply['reply_id'].'};';
    echo 'if(confirm("คุณแน่ใจหรือไม่ที่จะลบการตอบกลับนี้")){';
    echo '$.post("core/delete_reply.php", data,function (data, status) {console.log(data);';
    echo 'if(status === "success") {alert(data);window.location.href = "index.php";}';
    echo 'else alert("error: "+data);})}};</script>';

}