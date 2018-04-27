<?php

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

function getReviewById($review_id)
{
    $con = connectDB();
    $sql = "SELECT * FROM " . $GLOBALS['table_review'] . " where REVIEW_ID = " . $review_id;
    $result = $con->query($sql);
    $con->close();
    if ($result->num_rows > 0) {
        $review = $result->fetch_assoc();
        $review['reviewer_name'] = getReviewerName($review['reviewer_uid']);
        return $review;
    } else {
        return null;
    }
}

function getReviewerName($reviewer_uid)
{
    $con = connectDB();
    $sql = "SELECT * FROM " . $GLOBALS['table_user'] . " where UID = '" . $reviewer_uid . "'";
    $result = $con->query($sql);
    $con->close();
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        return $row['name'];
    } else {
        return 'reviewer_name';
    }
}