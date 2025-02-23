<?php
include 'conf.php'; // Include database connection
include 'classItem.php';  // Include the Item class

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $item_name = $_POST['itemName'];
    $item_EventType = $_POST['itemEventType'];
    $item_price = $_POST['itemPrice'];
    $item_stock = $_POST['itemStock'];
    $item_source = $_POST['itemSource'];

    // Handle image upload
    $product_image = $_FILES['itemPhoto'];

    // Get supplier ID if the item source is 'Supplied'
    $supplier_id = null;
    if ($item_source == 'Supplied' && isset($_POST['supplierEmail'])) {
        $supplier_id = $_POST['supplierEmail'];
    }

    // Create an instance of the Item class and pass only the database connection
    $item = new Items($conn);

    // Add the item to the database using the addItem method
    $result = $item->addItem($item_name, $item_EventType, $item_price, $item_stock, $item_source, $product_image, $supplier_id);

    if ($result === "Item added successfully!") {
        echo '<script>
                alert("Item added successfully!");
                window.location.href = "formAddItems.php";
              </script>';
    } else {
        echo $result;
    }
}

mysqli_close($conn);
?>
