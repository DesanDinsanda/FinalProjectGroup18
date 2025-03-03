<?php
include "conf.php";

$sql = "SELECT * FROM item WHERE itemSource IN ('Supplied', 'Company')";
$result = mysqli_query($conn, $sql);

// SQL query to get supplier emails
$supplier_sql = "SELECT supplierID, email FROM supplier";
$supplier_result = mysqli_query($conn, $supplier_sql);

include "adminNavbar.php";

echo '
<html>
<head>
<title>Manage item Interface</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <link rel="stylesheet" href="../css/navbar.css">
    <style>
        .form-container {
            background-color: #fdecf6; 
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
        }

        body{
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

    <br><br><br><br><br>
    <h2 class="mb-4 text-center">Manage Items</h2>
    <form action="addItem.php" method="POST" enctype="multipart/form-data" class="border rounded p-4 w-50 mx-auto form-container">
        <div class="mb-3">
            <label class="form-label fw-bold">Item Name</label>
            <input type="text" class="form-control" name="itemName" required>
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
            <input type="file" class="form-control" name="itemPhoto" accept="image/*" required>
        </div>
        <div class="mb-3">
            <label class="form-label fw-bold">Item Price</label>
            <input type="number" step="0.01" class="form-control" name="itemPrice" required>
        </div>
        <div class="mb-3">
            <label class="form-label fw-bold">Item Stock</label>
            <input type="number" class="form-control" name="itemStock" required>
        </div>
        <div class="mb-3">
            <label for="itemSource" class="form-label fw-bold">Item Source</label>
            <select class="form-select" id="itemSource" name="itemSource" onchange="toggleSupplierEmail()">
                <option value="Company">Company</option>
                <option value="Supplied">Supplied</option>
            </select>
        </div>

        <!-- Supplier email dropdown (only appears when Supplied is selected) -->
        <div class="mb-3" id="supplierEmailDiv" style="display: none;">
            <label for="supplierEmail" class="form-label fw-bold">Supplier Email</label>
            <select class="form-select" id="supplierEmail" name="supplierEmail">
                <option value="">Select Supplier</option>';
                while ($supplier_row = mysqli_fetch_assoc($supplier_result)) {
                    echo '<option value="' . $supplier_row['supplierID'] . '">' . $supplier_row['email'] . '</option>';
                }
echo '
            </select>
        </div>

        <button type="submit" class="btn btn-primary" name="submit">Add Item</button>
    </form>

    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <table class="table table-bordered table-striped">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Item Name</th>
                            <th>Item Event Type</th>
                            <th>Item Photo</th>
                            <th>Item Price</th>
                            <th>Item Stock</th>
                            <th>Item Source</th>
                            <th>Supplier Email</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>';

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        // Fetch supplier email if item source is "Supplied"
        $supplier_email = '';
        if ($row['itemSource'] == 'Supplied') {
            $supplier_sql = "SELECT s.email FROM supplier s 
                             JOIN item_supplier isup ON s.supplierID = isup.supplierID
                             WHERE isup.itemID = " . $row['itemID'];
            $supplier_result = mysqli_query($conn, $supplier_sql);
            
            if ($supplier_row = mysqli_fetch_assoc($supplier_result)) {
                $supplier_email = $supplier_row['email'];
            }
        }
        echo '
                        <tr>
                            <td>' . $row['itemID'] . '</td>
                            <td>' . $row['itemName'] . '</td>
                            <td>' . $row['itemEventType'] . '</td>
                            <td>' . $row['itemPhoto'] . '</td>
                            <td>' . $row['itemPrice'] . '</td>
                            <td>' . $row['itemStock'] . '</td>
                            <td>' . $row['itemSource'] . '</td>
                            <td>' . $supplier_email . '</td>
                            <td>
                                <a class="btn btn-info" href="editItem.php?itemID=' . $row['itemID'] . '">Edit</a>
                                <a class="btn btn-danger" href="deleteItem.php?itemID=' . $row['itemID'] . '" onclick="return confirm(\'Are you sure you want to delete this item?\')">Delete</a>

                            </td>
                        </tr>';
    }
} else {
    echo '
                        <tr>
                            <td colspan="8" class="text-center">No items found</td>
                        </tr>';
}

echo '
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</body>
</html>';
?>
