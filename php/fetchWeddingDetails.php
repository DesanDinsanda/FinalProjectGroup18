<?php
include 'conf.php';
include 'classPackage.php';
include 'classPre_define_package.php';

$prePackage = new Pre_define_package($conn);

$prePackage->viewPredefinePackages("Wedding");
?>