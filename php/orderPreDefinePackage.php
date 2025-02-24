<?php
session_start();
include 'conf.php';
include 'classOrders.php';

$orders = new Orders($conn);

// Get customer ID from session
$sql2 = "SELECT ID FROM user WHERE email = '".$_SESSION['email']."' ";
$result2 = mysqli_query($conn, $sql2);

if ($row = mysqli_fetch_assoc($result2)) {
    $customerID = $row['ID'];
} else {
    die("Customer not found.");
}

// Check if form is submitted
if (isset($_POST['btnOrder'])) {
    $location = mysqli_real_escape_string($conn, $_POST['evntLocation']);
    $eventDate = mysqli_real_escape_string($conn, $_POST['eventDate']);
    $eventTime = mysqli_real_escape_string($conn, $_POST['eventTime']);

    // Check if package ID is stored in session
    if (isset($_SESSION['packageID'])) {
        $packageID = $_SESSION['packageID'];
    } else {
        die("Package not selected.");
    }

    // Call the method
    $orders->orderPreDefinePackage($customerID, $location, $eventDate, $eventTime, $packageID);
}

mysqli_close($conn);
?>
