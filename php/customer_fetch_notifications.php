<?php
include 'conf.php';
include 'classNotification.php';

session_start();
$notification2 = new Notification($conn);
$notification2->viewCustomerNotification();
?>
