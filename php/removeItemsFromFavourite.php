<?php
session_start();
include "conf.php";
include 'classPackage.php';
include "classCustom_package.php";

$customPackage = new CustomPackage($conn);
$userID = $_SESSION['userID']; // Assuming the user is logged in

// Check if the itemID is posted
if (isset($_POST['removeItemsFromFavourite'])) {
    $itemID = $_POST['itemID'];

    // Call the method to remove the item from favourites
    $customPackage->removeItemsFromFavourite($userID, $itemID);

    // Redirect to the favourite items page
    header("Location: viewItemsInFavourite.php");
}
?>
