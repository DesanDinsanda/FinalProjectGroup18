<?php
include 'conf.php'; // Include database connection
include 'classItem.php';  // Include the Item class

if (isset($_GET['itemID'])) {
    // Get the item ID from the URL
    $item_id = $_GET['itemID'];

    // Create an instance of the Item class
    $item = new Item($conn);

    // Call the deleteItem method to delete the item
    $message = $item->deleteItem($item_id);

    // Display an alert and redirect
    echo "<script>alert('$message'); window.location='formAddItems.php';</script>";
} else {
    echo "No item ID received";
}

mysqli_close($conn);
?>
