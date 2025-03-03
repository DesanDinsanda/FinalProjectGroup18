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
if (isset($_POST['btnOrderCustom'])) {
    $location = mysqli_real_escape_string($conn, $_POST['evntLocation']);
    $eventDate = mysqli_real_escape_string($conn, $_POST['eventDate']);
    $eventTime = mysqli_real_escape_string($conn, $_POST['eventTime']);

    // Check if cart exists
    if (!isset($_SESSION['cart']) || count($_SESSION['cart']) === 0) {
        die("Error: No items in the custom package.");
    }

    $orders->orderCustomPackage($customerID, $location, $eventDate, $eventTime, $_SESSION['cart']);
}

mysqli_close($conn);
?>
