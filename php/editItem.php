<?php
include 'conf.php';
include 'classItem.php';

// Fetch supplier list for dropdown
$supplier_sql = "SELECT supplierID, email FROM supplier";
$supplier_result = mysqli_query($conn, $supplier_sql);

if (isset($_GET['itemID'])) {
    // Get item details
    $itemID = $_GET['itemID'];
    $item = new Item($conn);
    $itemDetails = $item->getItemDetails($itemID);

    if (!$itemDetails) {
        echo "Item not found!";
        exit;
    }
}

if (isset($_POST['submit'])) {
    // Collect form data
    $itemName = $_POST['itemName'];
    $itemEventType = $_POST['itemEventType'];
    $itemPrice = $_POST['itemPrice'];
    $itemStock = $_POST['itemStock'];
    $itemSource = $_POST['itemSource'];
    $supplierID = isset($_POST['supplierEmail']) ? $_POST['supplierEmail'] : null;

    // Handle photo upload
    if (!empty($_FILES['itemPhoto']['name'])) {
        $targetDir = "../uploads/";
        $itemPhoto = $targetDir . basename($_FILES["itemPhoto"]["name"]);
        move_uploaded_file($_FILES["itemPhoto"]["tmp_name"], $itemPhoto);
    } else {
        $itemPhoto = $itemDetails['itemPhoto']; // Keep old photo if not updated
    }

    // Update item
    $message = $item->editItem($itemID, $itemName, $itemEventType, $itemPrice, $itemStock, $itemSource, $supplierID, $itemPhoto);

    // Display success message and redirect
    echo "<script>alert('$message'); window.location='formAddItems.php';</script>";
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Item</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        .form-container {
            background-color: #fdecf6;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
        }
        body {
            background-color: #fcf6ec;
        }
    </style>

    <script>
        function toggleSupplierEmail() {
            var itemSource = document.getElementById("itemSource").value;
            var supplierEmailDiv = document.getElementById("supplierEmailDiv");
            if (itemSource === "Supplied") {
                supplierEmailDiv.style.display = "block";
            } else {
                supplierEmailDiv.style.display = "none";
            }
        }
    </script>
</head>
<body>
    <h2 class="text-center mt-4">Edit Item</h2>
    <form method="POST" action="" enctype="multipart/form-data" class="border rounded p-4 w-50 mx-auto form-container">
        <div class="mb-3">
            <label class="form-label fw-bold">Item Name</label>
            <input type="text" class="form-control" name="itemName" value="<?php echo $itemDetails['itemName']; ?>" required>
        </div>
        <div class="mb-3">
            <label for="item_EventType" class="form-label fw-bold">Item Event Type</label>
            <select class="form-select" id="item_EventType" name="itemEventType">
                <option value="Wedding">Wedding</option>
                <option value="Birthday">Birthday</option>
                <option value="AwardCeramony">AwardCeramony</option> 
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label fw-bold">Item Photo</label>
            <input type="file" class="form-control" name="itemPhoto">
            <p>Current Photo: <img src="<?php echo $itemDetails['itemPhoto']; ?>" width="100"></p>
        </div>
        <div class="mb-3">
            <label class="form-label fw-bold">Item Price</label>
            <input type="number" step="0.01" class="form-control" name="itemPrice" value="<?php echo $itemDetails['itemPrice']; ?>" required>
        </div>
        <div class="mb-3">
            <label class="form-label fw-bold">Item Stock</label>
            <input type="number" class="form-control" name="itemStock" value="<?php echo $itemDetails['itemStock']; ?>" required>
        </div>
        <div class="mb-3">
            <label class="form-label fw-bold">Item Source</label>
            <select class="form-select" id="itemSource" name="itemSource" onchange="toggleSupplierEmail()">
                <option value="Company" <?php if ($itemDetails['itemSource'] == "Company") echo "selected"; ?>>Company</option>
                <option value="Supplied" <?php if ($itemDetails['itemSource'] == "Supplied") echo "selected"; ?>>Supplied</option>
            </select>
        </div>

        <div class="mb-3" id="supplierEmailDiv" style="display: <?php echo ($itemDetails['itemSource'] == "Supplied") ? 'block' : 'none'; ?>;">
            <label class="form-label fw-bold">Supplier Email</label>
            <select class="form-select" name="supplierEmail">
                <option value="">Select Supplier</option>
                <?php while ($supplier_row = mysqli_fetch_assoc($supplier_result)) { ?>
                    <option value="<?php echo $supplier_row['supplierID']; ?>" 
                        <?php if (isset($itemDetails['supplierID']) && $supplier_row['supplierID'] == $itemDetails['supplierID']) echo "selected"; ?>>
                        <?php echo $supplier_row['email']; ?>
                    </option>
                <?php } ?>
            </select>
        </div>

        <button type="submit" class="btn btn-success" name="submit">Update Item</button>
    </form>
</body>
</html>
