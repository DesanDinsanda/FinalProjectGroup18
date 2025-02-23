<?php
session_start();
include 'conf.php';
include 'classPackage.php';
include "classCustom_package.php";

// Assuming item details are passed through POST
if (isset($_POST['addItemsToFavourite'])) {
    $itemID = $_POST['itemID'];
    $itemName = $_POST['itemName'];
    $itemPrice = $_POST['itemPrice'];
    $itemPhoto = $_POST['itemPhoto'];

    $customPackage = new CustomPackage($conn);
    $customPackage->addItemsToFavourite($itemID, $itemName, $itemPrice, $itemPhoto);

    // Redirect back to the page
    header("Location: viewItemsInFavourite.php");
    exit();
}
?>
