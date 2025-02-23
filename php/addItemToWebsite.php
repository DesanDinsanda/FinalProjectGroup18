<?php
include "conf.php";
include 'classPackage.php';
include "classCustom_package.php"; 

if (isset($_GET['itemID'])) {
    $itemID = $_GET['itemID'];
    
    // Create a CustomPackage object
    $customPackage = new CustomPackage($conn);

    // Call the method to update the database
    if ($customPackage->addItemToWebsite($itemID)) {
        echo "<script>
                alert('Item added to Custom Package successfully!');
                window.location.href = 'cartItems.php'; // Redirect back to items page
              </script>";
    } else {
        echo "Error updating record: " . mysqli_error($conn);
    }
}

mysqli_close($conn);
?>
