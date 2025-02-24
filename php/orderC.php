<?php
session_start();

if (!isset($_SESSION['cart']) || count($_SESSION['cart']) === 0) {
    die("Error: No custom package selected.");
}

// Store a flag in session to indicate the user is ordering a custom package
$_SESSION['isOrderingCustom'] = true;

// Redirect to order form
header("Location: orderFormCustom.php");
exit();
?>
