<?php
session_start();
include 'conf.php';
include 'classPackage.php';
include "classCustom_package.php";

// Check if user is logged in
if (!isset($_SESSION['email'])) {
    header("Location: ../html/login.html"); // Redirect to login page if not logged in
    exit();
}

// Get customer ID from session
$sql = "SELECT ID FROM user WHERE email = '".$_SESSION['email']."'";
$result = mysqli_query($conn, $sql);

if ($row = mysqli_fetch_assoc($result)) {
    $customerID = $row['ID'];
} else {
    die("Error: Customer not found.");
}


if (isset($_POST['addItemsToFavourite'])) {
    $itemID = $_POST['itemID'];
    $itemName = $_POST['itemName'];
    $itemPrice = $_POST['itemPrice'];
    $itemPhoto = $_POST['itemPhoto'];

    $customPackage = new CustomPackage($conn);
    $customPackage->addItemsToFavourite($itemID, $itemName, $itemPrice, $itemPhoto);

    // Redirect back to the favorites page
    header("Location: viewItemsInFavourite.php");
    exit();
}
?>
