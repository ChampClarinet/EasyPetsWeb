<?php
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

function getReplyById($reply_id){
    $con = connectDB();
    $sql = "SELECT * FROM " . $GLOBALS['table_reply'] . " where REPLY_ID = " . $reply_id;
    $result = $con->query($sql);
    $con->close();
    if ($result->num_rows > 0) {
        $reply = $result->fetch_assoc();
        $review = getAssociateReview($reply['review_id']);
        $reply['reviewer_name'] = $review['name'];
        $reply['review_text'] = $review['review_text'];
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