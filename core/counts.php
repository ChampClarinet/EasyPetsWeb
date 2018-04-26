<?php
require('db_config.php');
function likeCount($service_id){
    $con = connectDB();
    $sql = "SELECT COUNT(*) as \"likes_count\" FROM " . $GLOBALS['table_like_condition'] . " where SERVICE_ID = " . $service_id;
    $result = $con->query($sql);
    $con->close();
    if ($result->num_rows > 0) {
        $row = mysqli_fetch_assoc($result);
        $like_count = $row['likes_count'];
        return $like_count;
    } else {
        echo '<script>console.log("load like count error")</script>';
        return 0;
    }
}

function reviewsCount($service_id){
    $con = connectDB();
    $sql = "SELECT COUNT(*) as \"reviews_count\" FROM " . $GLOBALS['table_review'] . " where SERVICE_ID = " . $service_id;
    $result = $con->query($sql);
    $con->close();
    if ($result->num_rows > 0) {
        $row = mysqli_fetch_assoc($result);
        $reviews_count = $row['reviews_count'];
        return $reviews_count;
    } else {
        echo '<script>console.log("load like count error")</script>';
        return 0;
    }
}

function repliesCount($service_id){
    $con = connectDB();
    $sql = "SELECT COUNT(*) as \"replies_count\" FROM " . $GLOBALS['table_reply'] .
        " INNER JOIN ".$GLOBALS['table_review']." ON ".$GLOBALS['table_reply'].".REVIEW_ID = ".$GLOBALS['table_review'].".REVIEW_ID".
        " where SERVICE_ID = " . $service_id;
    $result = $con->query($sql);
    $con->close();
    if ($result->num_rows > 0) {
        $row = mysqli_fetch_assoc($result);
        $replies_count = $row['replies_count'];
        return $replies_count;
    } else {
        echo '<script>console.log("load like count error")</script>';
        return 0;
    }
}