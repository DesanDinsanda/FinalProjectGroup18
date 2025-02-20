<?php
include 'conf.php';
include 'classNotification.php';

$notification = new Notification($conn);
$notification->viewEventmanagerNotification();
?>
