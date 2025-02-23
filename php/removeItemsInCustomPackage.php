<?php
session_start();
include "conf.php";
include 'classPackage.php';
include "classCustom_package.php";

$customPackage = new CustomPackage($conn);

if (isset($_GET['itemID'])) {
    $itemID = $_GET['itemID'];
    $customPackage->removeItemsInCustomPackage($itemID);
}

header("Location: viewItemsInCustomPackage.php");
exit();
?>
