<?php
session_start();
include "conf.php";
include 'classPackage.php';
include "classCustom_package.php";

// Check if user is logged in
if (!isset($_SESSION['email'])) {
    header("Location: ../html/login.html"); // Redirect to login page
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


if (isset($_POST['removeFromFavourite'])) {
    $itemID = $_POST['itemID'];

    $customPackage = new CustomPackage($conn);
    $customPackage->removeItemsFromFavourite($itemID);

    header("Location: viewItemsInFavourite.php");
    exit();
}
?>
