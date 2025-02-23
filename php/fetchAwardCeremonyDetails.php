<?php
// Include database connection and Pre_define_package class
include 'conf.php';
include 'classPackage.php';
include 'classPre_define_package.php';

// Create Pre_define_package object
$prePackage = new Pre_define_package($conn);

// Fetch and display Wedding packages
$prePackage->viewPredefinePackages("Award Ceramony");
?>