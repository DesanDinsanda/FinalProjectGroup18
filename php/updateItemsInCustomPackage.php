<?php
session_start();
include "conf.php";
include 'classPackage.php';
include "classCustom_package.php";

$customPackage = new CustomPackage($conn);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $itemID = $_POST['itemID'];
    $newQuantity = intval($_POST['quantity']);
    
    $customPackage->updateItemsInCustomPackage($itemID, $newQuantity);
}

header("Location: viewItemsInCustomPackage.php");
exit();
?>
