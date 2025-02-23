<?php
include 'classReview.php';
include 'conf.php';

session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['review'])) {
    $reviewObj = new Review($conn);
    $response = $reviewObj->addReview($_POST['review']);
    echo $response;
}
?>
