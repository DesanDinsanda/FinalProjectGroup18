<?php
include 'conf.php'; 
include 'classItem.php';  

if (isset($_GET['itemID'])) {
    // Get the item ID from the URL
    $item_id = $_GET['itemID'];

    $item = new Items($conn);

    $message = $item->deleteItem($item_id);

  
    echo "<script>alert('$message'); window.location='formAddItems.php';</script>";
} else {
    echo "No item ID received";
}

mysqli_close($conn);
?>
