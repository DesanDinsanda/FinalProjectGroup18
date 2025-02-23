<?php
session_start();
include "conf.php";
include 'classPackage.php';
include "classCustom_package.php";

$customPackage = new CustomPackage($conn);
$customPackage->deleteCustomPackage();

header("Location: viewItemsInCustomPackage.php");
exit();
?>
