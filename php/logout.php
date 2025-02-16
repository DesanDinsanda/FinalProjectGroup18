<?php
include 'conf.php';
include 'classUser.php';

$logout = new User($conn);
$logout->logout();
?>