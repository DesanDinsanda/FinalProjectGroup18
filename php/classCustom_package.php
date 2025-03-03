<?php
class CustomPackage extends Package {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function addItemToWebsite($itemID) {
        $sql = "UPDATE item SET itemPackageType = 'for custom package' WHERE itemID = '$itemID'";

        if (mysqli_query($this->conn, $sql)) {
            return true; // Success
        } else {
            return false; // Error
        }
    }

    public function removeItemsInWebsite($itemID) {
        $sql = "UPDATE item SET itemPackageType = 'for all packages' WHERE itemID = '$itemID'";

        if (mysqli_query($this->conn, $sql)) {
            return true; // Success
        } else {
            return false; // Error
        }
    }


    // Method to view custom packages based on event type
    public function viewCustomPackage($itemEventType) {
        $sql = "SELECT * FROM item WHERE itemEventType = '$itemEventType' AND itemPackageType = 'for custom package'";
        $result = mysqli_query($this->conn, $sql);
    
        echo '<div class="container mt-4">
                <input type="text" id="searchBar" class="form-control mb-3" placeholder="Search items..." onkeyup="searchItems()">
                <div class="row" id="itemContainer">';
    
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                echo '
                    <div class="col-md-4 item-card">
                        <div class="card card-hover mb-4">
                            <img src="../uploads/' . $row['itemPhoto'] . '" class="card-img-top" alt="Item Image" style="height: 300px; object-fit: cover;">
                            <div class="card-body">
                                <h5 class="card-title">' . $row['itemName'] . '</h5>
                                <p class="card-text"><strong>Price:</strong> RS ' . $row['itemPrice'] . '</p>
                                
                                <div class="d-flex align-items-center">
                                    <label class="me-2"><strong>Quantity:</strong></label>
                                    <button class="btn btn-sm btn-outline-secondary" onclick="decreaseQuantity(\'qty_' . $row['itemID'] . '\')">-</button>
                                    <input type="number" id="qty_' . $row['itemID'] . '" class="form-control text-center mx-2" value="1" min="1" style="width: 60px;">
                                    <button class="btn btn-sm btn-outline-secondary" onclick="increaseQuantity(\'qty_' . $row['itemID'] . '\')">+</button>
                                </div>
    
                                <form method="post" action="addItemsToCustomPackage.php">
                                    <input type="hidden" name="itemID" value="' . $row['itemID'] . '">
                                    <input type="hidden" name="quantity" id="hidden_qty_' . $row['itemID'] . '" value="1"> <!-- Fix: Ensure correct quantity is passed -->
                                    <input type="hidden" name="eventType" value="' . $itemEventType . '">
                                    <button type="submit" name="addItemsToCustomPackage" class="btn btn-primary btn-hover mt-2" onclick="updateHiddenQuantity(' . $row['itemID'] . ')">Add to Cart</button>
                                </form>
                                <br>
                                <!-- Add to Favourites Button -->
                            <form method="post" action="addItemsToFavourite.php">
                                <input type="hidden" name="itemID" value="' . $row['itemID'] . '">
                                <input type="hidden" name="itemName" value="' . $row['itemName'] . '">
                                <input type="hidden" name="itemPrice" value="' . $row['itemPrice'] . '">
                                <input type="hidden" name="itemPhoto" value="' . $row['itemPhoto'] . '">
                                <button type="submit" name="addItemsToFavourite" class="btn btn-danger fw-bold px-4 py-2 rounded-pill">
                                    <i class="fa fa-heart me-2"></i> Add to Favourites
                                </button>
                            </form>

                            </div>
                        </div>
                    </div>';
            }
        } else {
            echo '<h4 class="text-center">No custom package items found.</h4>';
        }
        echo '</div></div>';
    }
    


    
    public function addItemsToCustomPackage($itemID, $quantity, $eventType) {
        $sql = "SELECT * FROM item WHERE itemID = '$itemID'";
        $result = mysqli_query($this->conn, $sql);
        $item = mysqli_fetch_assoc($result);
    
        if ($item) {
            $cartItem = [
                'itemID' => $item['itemID'],
                'itemName' => $item['itemName'],
                'itemPhoto' => $item['itemPhoto'],
                'itemPrice' => $item['itemPrice'],
                'quantity' => $quantity
            ];
    
            if (!isset($_SESSION['cart'])) {
                $_SESSION['cart'] = [];
            }
    
            $found = false;
            foreach ($_SESSION['cart'] as &$existingItem) {
                if ($existingItem['itemID'] == $itemID) {
                    $existingItem['quantity'] = $quantity;
                    $found = true;
                    break;
                }
            }
    
            if (!$found) {
                $_SESSION['cart'][] = $cartItem;
            }
        }
    }




    public function viewItemsInCustomPackage() {
        $grandTotal = 0;
        echo '<div class="container mt-5">
                <h2 class="text-center">Your Custom Package</h2>
                <table class="table table-bordered mt-4">
                    <thead class="table-dark">
                        <tr>
                            <th>PRODUCT</th>
                            <th>PRICE</th>
                            <th>QUANTITY</th>
                            <th>TOTAL</th>
                            <th>REMOVE</th>
                        </tr>
                    </thead>
                    <tbody>';
    
        if (isset($_SESSION['cart']) && count($_SESSION['cart']) > 0) {
            foreach ($_SESSION['cart'] as $index => $item) {
                $totalPrice = $item['itemPrice'] * $item['quantity'];
                $grandTotal += $totalPrice;
                echo "<tr>
                        <td><img src='../uploads/{$item['itemPhoto']}' width='50' height='50'> {$item['itemName']}</td>
                        <td>RS {$item['itemPrice']}</td>
                        <td>
                            <form method='post' action='updateItemsInCustomPackage.php'>
                                <input type='hidden' name='itemID' value='{$item['itemID']}'>
                                <input type='number' name='quantity' value='{$item['quantity']}' min='1' class='form-control' style='width: 70px; display: inline-block;'>
                                <button type='submit' class='btn btn-sm btn-success'>Update</button>
                            </form>
                        </td>
                        <td>RS $totalPrice</td>
                        <td><a href='removeItemsInCustomPackage.php?itemID={$item['itemID']}' class='btn btn-danger btn-sm'>Remove</a></td>
                      </tr>";
            }
        } else {
            echo "<tr><td colspan='5' class='text-center'>Your cart is empty.</td></tr>";
        }
    
        echo "</tbody></table>";
        echo "<h4 class='text-end'>Grand Total: RS $grandTotal</h4>";
        
        if (isset($_SESSION['cart']) && count($_SESSION['cart']) > 0) {
            echo "<div class='text-center mt-4'>
                    <a href='orderC.php' class='btn btn-primary btn-lg'>Order Custom Package</a>
                    <a href='deleteCustomPackage.php' class='btn btn-danger btn-lg'>Delete Custom Package</a>
                  </div>";
        }
    
        echo "</div>";
    }
    


    public function updateItemsInCustomPackage($itemID, $newQuantity) {
        foreach ($_SESSION['cart'] as &$item) {
            if ($item['itemID'] == $itemID) {
                $item['quantity'] = $newQuantity;
                break;
            }
        }
    }



    public function removeItemsInCustomPackage($itemID) {
        if (isset($_SESSION['cart'])) {
            foreach ($_SESSION['cart'] as $key => $item) {
                if ($item['itemID'] == $itemID) {
                    unset($_SESSION['cart'][$key]); 
                    $_SESSION['cart'] = array_values($_SESSION['cart']); 
                    break;
                }
            }
        }
    }
    

    public function deleteCustomPackage() {
        unset($_SESSION['cart']);
    }


    
    
        // Add item to favourites (store in session)
        public function addItemsToFavourite($itemID, $itemName, $itemPrice, $itemPhoto) {
            // Initialize the favourites array if it doesn't exist
            if (!isset($_SESSION['favourites'])) {
                $_SESSION['favourites'] = [];
            }
    
            // Check if the item already exists in the favourites
            foreach ($_SESSION['favourites'] as $item) {
                if ($item['itemID'] == $itemID) {
                    // Item already exists in the favourites
                    return;
                }
            }
    
            // Add item to the favourites array
            $_SESSION['favourites'][] = [
                'itemID' => $itemID,
                'itemName' => $itemName,
                'itemPrice' => $itemPrice,
                'itemPhoto' => $itemPhoto
            ];
        }
    
        public function viewItemsInFavourite() {
            if (isset($_SESSION['favourites']) && !empty($_SESSION['favourites'])) {
                echo '<div class="container mt-4">
                        <h3 class="text-center">Your Favourite Items</h3>
                        <div class="row">';
        
                foreach ($_SESSION['favourites'] as $item) {
                    echo '<div class="col-md-4 item-card">
                            <div class="card card-hover mb-4">
                                <img src="../uploads/' . $item['itemPhoto'] . '" class="card-img-top"alt="Item Image" style="height: 200px; object-fit: cover' . $item['itemName'] . '">
                                <div class="card-body">
                                    <h5 class="card-title">' . $item['itemName'] . '</h5>
                                    <p class="card-text">Price: Rs ' . number_format($item['itemPrice']) . '</p>
                                    <form method="post" action="removeItemsFromFavourite.php">
                                        <input type="hidden" name="itemID" value="' . $item['itemID'] . '">
                                        <button type="submit" name="removeFromFavourite" class="btn btn-danger btn-sm">Remove from Favourites</button>
                                    </form>
                                </div>
                            </div>
                        </div>';

                }
        
                echo '</div></div>';
            } else {
                echo '<h4 class="text-center">No favourite items found.</h4>';
            }
        }
        
    
        public function removeItemsFromFavourite($itemID) {
            if (isset($_SESSION['favourites'])) {
                foreach ($_SESSION['favourites'] as $key => $item) {
                    if ($item['itemID'] == $itemID) {
                        unset($_SESSION['favourites'][$key]);
                        $_SESSION['favourites'] = array_values($_SESSION['favourites']); // Reindex the array
                        break;
                    }
                }
            }
        }
    
    
    
    


}
?>
