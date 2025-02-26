<?php

class Pre_define_package extends Package {
    private $conn;

    // Constructor
    public function __construct($conn) {
        $this->conn = $conn;
    }

    
    // Method to add a new package
    public function addPackage($name, $price, $type, $items) {
        $this->packageName = $name;
        $this->price = $price;
        $this->eventType = $type;
    
        // Insert package details
        $sql = "INSERT INTO package (packageName, price, eventType) 
                VALUES ('$this->packageName', '$this->price', '$this->eventType')";
    
        if (mysqli_query($this->conn, $sql)) {
            // Get the last inserted package ID
            $this->packageID = mysqli_insert_id($this->conn);
    
            // Insert into pre_define_package table
            $sql4 = "INSERT INTO pre_define_package (packageID) VALUES ('$this->packageID')";
            mysqli_query($this->conn, $sql4);

            // Calculate total item count
            $itemCount = count($items);
            $updatedDate = date("Y-m-d"); // Get today's date
    
            // Insert package items
            foreach ($items as $itemName) {
                // Get or insert item and retrieve its ID
                $sql1 = "SELECT itemID FROM item WHERE itemName = '$itemName'";
                $result = mysqli_query($this->conn, $sql1);
    
                if ($row = mysqli_fetch_assoc($result)) {
                    $itemID = $row['itemID'];
                } else {
                    $sql2 = "INSERT INTO item (itemName) VALUES ('$itemName')";
                    mysqli_query($this->conn, $sql2);
                    $itemID = mysqli_insert_id($this->conn);
                }
    
                // Check if the item is already in pre_define_package_item
                $check_sql = "SELECT * FROM pre_define_package_item WHERE pre_define_packageID = '$this->packageID' AND itemID = '$itemID'";
                $check_result = mysqli_query($this->conn, $check_sql);
    
                if (mysqli_num_rows($check_result) == 0) {
                    // Insert only if the item is not already in the table
                    $sql3 = "INSERT INTO pre_define_package_item (pre_define_packageID, itemID, updatedDate, itemCount) VALUES ('$this->packageID', '$itemID',  '$updatedDate', '$itemCount')";
                    mysqli_query($this->conn, $sql3);
                }
            }
            return "Package added successfully!";
        } else {
            return "Error: " . mysqli_error($this->conn);
        }
    }
    

    // Method to delete a package
    public function deletePackage($packageID) {
        $this->packageID = $packageID;

        // Delete package items
        mysqli_query($this->conn, "DELETE FROM pre_define_package_item WHERE pre_define_packageID = '$this->packageID'");

        // Delete package from pre_define_package table
        mysqli_query($this->conn, "DELETE FROM pre_define_package WHERE packageID = '$this->packageID'");

        // Delete the package
        $sql = "DELETE FROM package WHERE packageID = '$this->packageID'";
        if (mysqli_query($this->conn, $sql)) {
            return "Package deleted successfully!";
        } else {
            return "Error deleting package!";
        }
    }

    // Method to fetch package details
public function getPackageDetails($packageID) {
    $this->packageID = $packageID;
    $sql = "SELECT * FROM package WHERE packageID = '$this->packageID'";
    $result = mysqli_query($this->conn, $sql);
    return mysqli_fetch_assoc($result);
}

// Method to fetch associated items for a package
public function getPackageItems($packageID) {
    $this->packageID = $packageID;
    $sql = "SELECT i.itemName FROM pre_define_package_item pi 
            JOIN item i ON pi.itemID = i.itemID 
            WHERE pi.pre_define_packageID = '$this->packageID'";

    $result = mysqli_query($this->conn, $sql);
    $items = [];

    while ($row = mysqli_fetch_assoc($result)) {
        $items[] = $row['itemName'];
    }
    return $items;
}

// Method to update a package
public function updatePackage($packageID, $name, $price, $type, $updatedItems) {
    $this->packageID = $packageID;
    $this->packageName = $name;
    $this->price = $price;
    $this->eventType = $type;

    // Update package details
    $sql = "UPDATE package SET packageName='$this->packageName', price='$this->price', eventType='$this->eventType' 
            WHERE packageID='$this->packageID'";
    mysqli_query($this->conn, $sql);

    // Remove old package items
    mysqli_query($this->conn, "DELETE FROM pre_define_package_item WHERE pre_define_packageID='$this->packageID'");

    // Delete pre_define_package table packageID
    mysqli_query($this->conn, "DELETE FROM pre_define_package WHERE packageID = '$this->packageID'");

    // Ensure the package exists in pre_define_package before inserting items
    $checkPackageSQL = "SELECT packageID FROM pre_define_package WHERE packageID = '$this->packageID'";
    $checkResult = mysqli_query($this->conn, $checkPackageSQL);

    if (mysqli_num_rows($checkResult) == 0) {
        $sql4 = "INSERT INTO pre_define_package (packageID) VALUES ('$this->packageID')";
        mysqli_query($this->conn, $sql4);
    }

    // Calculate total item count
    $itemCount = count($updatedItems);
    $updatedDate = date("Y-m-d"); // Get today's date

    // Insert updated items
    foreach ($updatedItems as $itemName) {
        // Check if item exists
        $sql1 = "SELECT itemID FROM item WHERE itemName = '$itemName'";
        $result = mysqli_query($this->conn, $sql1);
        
        if ($row = mysqli_fetch_assoc($result)) {
            $itemID = $row['itemID'];
        } else {
            // Insert new item and get ID
            $sql2 = "INSERT INTO item (itemName) VALUES ('$itemName')";
            mysqli_query($this->conn, $sql2);
            $itemID = mysqli_insert_id($this->conn);
        }

        // Check if item is already linked to the package before inserting
        $checkItemSQL = "SELECT * FROM pre_define_package_item 
                         WHERE pre_define_packageID = '$this->packageID' AND itemID = '$itemID'";
        $checkItemResult = mysqli_query($this->conn, $checkItemSQL);

        if (mysqli_num_rows($checkItemResult) == 0) {
            $sql3 = "INSERT INTO pre_define_package_item (pre_define_packageID, itemID, updatedDate, itemCount) 
                     VALUES ('$this->packageID', '$itemID',  '$updatedDate', '$itemCount')";
            mysqli_query($this->conn, $sql3);
        }
    }

    return "Package updated successfully!";
    }



    public function viewPredefinePackages($eventType) {
        $sql = "SELECT packageID, packageName, price, discount
                FROM package 
                WHERE eventType = '$eventType' 
                AND packageName != 'custom Package'"; // Exclude customPackage

        $result = mysqli_query($this->conn, $sql);

        // Start outputting the HTML for the packages
        echo '<div class="container mt-5">';
        echo '<div class="row">';

        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                // Assign values to private attributes
                $this->packageID = $row['packageID'];
                $this->packageName = $row['packageName'];
                $this->price = $row['price'];
                $this->eventType = $eventType;
                $discount = $row['discount'] ?? 0;  // Fetch discount from database or default to 0

                $discountedPrice = $this->price - ($this->price * ($discount / 100));

                // Output package details as HTML
                echo '<div class="col-md-4 mb-4">';
                echo '<div class="card h-100 shadow-sm card-hover">';
                echo '<div class="card-body">';
                echo '<h5 class="card-title text-start text-primary mt-4 fw-bold">' . htmlspecialchars($this->packageName) . '</h5>';
                // Display both original price and discounted price
                if ($discount > 0) {
                    // If discount is applied, show the discounted price
                    echo '<h6 class="card-subtitle text-muted text-decoration-line-through text-start fs-6">Rs ' . htmlspecialchars(number_format($this->price)) . '</h6>';
                    echo '<h6 class="card-subtitle text-danger text-start mt-2 fs-5 fw-bold">Discounted Price: Rs ' . htmlspecialchars(number_format($discountedPrice)) . '</h6>';
                } else {
                    // If no discount, show only the original price
                    echo '<h6 class="card-subtitle text-muted text-start fs-6">Rs ' . htmlspecialchars(number_format($this->price)) . '</h6>';
                }


                // Fetch associated items for this package
                $itemQuery = "SELECT i.itemName FROM pre_define_package_item pi
                              JOIN item i ON pi.itemID = i.itemID
                              WHERE pi.pre_define_packageID = $this->packageID";
                $itemResult = mysqli_query($this->conn, $itemQuery);

                if (mysqli_num_rows($itemResult) > 0) {
                    echo '<h6 class="mt-4 text-secondary">Included Items:</h6>';
                    echo '<ul class="list-unstyled">';
                    while ($itemRow = mysqli_fetch_assoc($itemResult)) {
                        echo '<li>✔ ' . htmlspecialchars($itemRow['itemName']) . '</li>';
                    }
                    echo '</ul>';
                } else {
                    echo '<p class="text-muted">No items included in this package.</p>';
                }

                echo '</div>'; // Close card-body

                // Add to Cart Button
                echo '<div class="card-footer text-center">';
                echo '<form action="orderP.php" method="post">
                        <input type="hidden" name="package_name" value="' . htmlspecialchars($this->packageName) . '">
                        <input type="hidden" name="package_price" value="' . htmlspecialchars($this->price) . '">
                        <input type="hidden" name="packageID" value="' . htmlspecialchars($this->packageID) . '">
                        <button type="submit" name="addCart" class="btn btn-primary btn-hover">Order</button>
                    </form>';
                echo '</div>'; // Close card-footer
                echo '</div>'; // Close card
                echo '</div>'; // Close col-md-4
            }
        } else {
            echo '<p class="text-center">No ' . htmlspecialchars($eventType) . ' packages available.</p>';
        }

        echo '</div>'; // Close row
        echo '</div>'; // Close container
    }



    // Add Discount Method 
    public function addDiscount($packageID, $discount) {
        if ($discount < 1 || $discount > 100) {
            return "Invalid discount value!";
        }

        $sql = "UPDATE package SET discount = $discount WHERE packageID = $packageID";

        if (mysqli_query($this->conn, $sql)) {
            return "Discount added successfully!";
        } else {
            return "Error updating discount: " . mysqli_error($this->conn);
        }
    }

    // Remove Discount Method
    public function removeDiscount($packageID) {
        $sql = "UPDATE package SET discount = NULL WHERE packageID = $packageID";

        if (mysqli_query($this->conn, $sql)) {
            return "Discount removed successfully!";
        } else {
            return "Error removing discount: " . mysqli_error($this->conn);
        }
    }
}
?>
