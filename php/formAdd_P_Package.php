<?php
include "conf.php";

// SQL query to get package and associated items
$sql = "SELECT p.packageID, p.packageName, p.price, p.eventType, p.discount,
       GROUP_CONCAT(i.itemName ORDER BY i.itemID SEPARATOR ', ') AS items
        FROM package p 
        LEFT JOIN pre_define_package_item pi ON p.packageID = pi.pre_define_packageID
        LEFT JOIN item i ON pi.itemID = i.itemID
        WHERE p.packageName != 'custom Package' 
        GROUP BY p.packageID";

$result = mysqli_query($conn, $sql);

include "adminNavbar.php";

echo '
<html>
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <link rel="stylesheet" href="../css/navbar.css">

    <style>
    .form-container {
    background-color: #fdecf6;  /* Red background */
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
    }

    body{
    background-color: #fcf6ec;  
    }

    </style>
    
    
</head>
<body>

    <?php  include "adminNavbar.php"?>
    <br><br><br><br><br><br>


    <h2 class="mb-4 text-center">Manage Products</h2>
    <form action="add_P_Package.php" method="POST" class="border rounded p-4 w-50 mx-auto form-container">
        <div class="mb-3">
            <label for="package_name" class="form-label fw-bold">Package Name</label>
            <input type="text" class="form-control" id="package_name" name="name">
        </div>
        <div class="mb-3">
            <label for="package_price" class="form-label fw-bold">Package Price</label>
            <input type="number" class="form-control" id="package_price" name="price">
        </div>
        <div class="mb-3">
            <label for="event_type" class="form-label fw-bold">Event Type</label>
            <select class="form-select" id="event_type" name="type">
                <option value="Wedding">Wedding</option>
                <option value="Birthday">Birthday</option>
                <option value="Award Ceramony">Award Ceramony</option> 
            </select>
        </div>';

        // Loop to generate item input fields
        for ($i = 1; $i <= 20; $i++) {
            echo '
                <div class="mb-3">
                    <label for="item-' . $i . '" class="form-label fw-bold">Item ' . $i . '</label>
                    <input type="text" class="form-control" id="item-' . $i . '" name="item' . $i . '">
                </div>';
        }

        echo '
        <button type="submit" class="btn btn-primary" name="submit">Add Package</button>
    </form>

    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <table class="table table-bordered table-striped">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Package Name</th>
                            <th>Price</th>
                            <th>Discount</th>
                            <th>Price with Discount</th>
                            <th>Event Type</th>';
                            
                            
                            // Loop to display headers for items
                            for ($i = 1; $i <= 20; $i++) {
                                echo '<th>Item ' . $i . '</th>';
                            }
                            echo '<th>Manage Discount</th>';

                            echo '
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>';

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        // Split items by comma and handle each item dynamically
        $items = explode(',', $row['items']);
        $discount = isset($row['discount']) ? $row['discount'] : 0; // Default discount 0 if not set
        $price = $row['price'];

        // Calculate discounted price
        if ($discount > 0) {
            $discountedPrice = $price - ($price * ($discount / 100));
        } else {
            $discountedPrice = $price; // no discount
        }

        echo '
                        <tr>
                            <td>' . $row['packageID'] . '</td>
                            <td>' . $row['packageName'] . '</td>
                            <td>' . $row['price'] . '</td>
                            <td>' . $row['discount'] . '%</td>
                            <td>Rs ' . number_format($discountedPrice) . '</td>
                            <td>' . $row['eventType'] . '</td>';
                            
                            // Display item values dynamically
                            for ($i = 0; $i < 20; $i++) {
                                echo '<td>' . (isset($items[$i]) ? $items[$i] : '') . '</td>';
                            }

                            // Manage Discount Column
                            echo '<td>
                            <form action="addDiscount.php" method="post" style="display:inline;">
                                <input type="hidden" name="packageID" value="' . $row['packageID'] . '">
                                <input type="number" name="discount" class="form-control mb-2" placeholder="Enter %" value="' . $discount . '" required>
                                <button type="submit" name="addDiscount" class="btn btn-success btn-sm">Add Discount</button>
                            </form>';

                            // Remove Discount Button
                            
                                echo '<form action="removeDiscount.php" method="post" style="display:inline;">
                                    <input type="hidden" name="packageID" value="' . $row['packageID'] . '">
                                    <button type="submit" name="removeDiscount" class="btn btn-danger btn-sm">Remove Discount</button>
                                </form>';
                            

                            echo '</td>';

                            echo '
                            <td>
                                <a class="btn btn-info" href="edit_P_Package.php?packageID=' . $row['packageID'] . '">Edit</a>
                                <a class="btn btn-danger" href="delete_P_Package.php?packageID=' . $row['packageID'] . '">Delete</a>
                            </td>
                        </tr>';
    }
} else {
    echo '
                        <tr>
                            <td colspan="22" class="text-center">No packages found</td>
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
