<?php
session_start(); // Start session to store packageID

if (isset($_POST['packageID'])) {
    $_SESSION['packageID'] = $_POST['packageID']; // Store packageID in session

    // Redirect to the order form
    header("Location: orderForm.php");
    exit();
} else {
    echo "Error: No package selected.";
}
?>
