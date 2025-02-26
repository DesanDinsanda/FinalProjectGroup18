<?php
include 'conf.php';
class Items {
    private $itemName;
    private $itemID;
    private $itemPrice;
    private $itemPhoto;
    private $itemAmount;

    public function __construct($db) {
        $this->conn = $db;
    }

    

    // Getters and Setters
    public function getItemName() { return $this->itemName; }
    public function setItemName($itemName) { $this->itemName = $itemName; }

    public function getItemID() { return $this->itemID; }
    public function setItemID($itemID) { $this->itemID = $itemID; }

    public function getItemPrice() { return $this->itemPrice; }
    public function setItemPrice($itemPrice) { $this->itemPrice = $itemPrice; }

    public function getItemPhoto() { return $this->itemPhoto; }
    public function setItemPhoto($itemPhoto) { $this->itemPhoto = $itemPhoto; }

    public function getItemAmount() { return $this->itemAmount; }
    public function setItemAmount($itemAmount) { $this->itemAmount = $itemAmount; }


    public function viewInventoryLevel() {
        $sql = "SELECT itemID, itemName, itemPrice, itemStock, itemSource FROM item WHERE itemSource IN ('Supplied', 'Company')";

        $result = mysqli_query($this->conn, $sql);
        echo <<<HTML

        <html>
        <head>
        <title>customers</title>
        </head>
        <body>
            <div class="container my-4">
        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th>Item ID</th>
                    <th>Item Name</th>
                    <th>Item Price</th>
                    <th>Item Stock</th>
                    <th>Item Source</th>
                   
                </tr>
            </thead>
            <tbody>
HTML;

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        echo <<<HTML
            <tr>
                <td>{$row['itemID']}</td>
                <td>{$row['itemName']}</td>
                <td>{$row['itemPrice']}</td>
                <td>{$row['itemStock']}</td>
                <td>{$row['itemSource']}</td>
               

                
            </tr>
HTML;
    }
}

echo <<<HTML
            </tbody>
        </table>
    </div> 
        </body>
        </html>
HTML;
    }


    public function addItem($item_name, $item_EventType, $item_price, $item_stock, $item_source, $image, $supplier_id = null) {
        // Set item details
        $this->item_name = $item_name;
        $this->item_EventType = $item_EventType;
        $this->item_price = $item_price;
        $this->item_stock = $item_stock;
        $this->item_source = $item_source;
        $this->image = $image;
        $this->supplier_id = !empty($supplier_id) ? $supplier_id : null;
    
        // Handle the image upload
        $upload_dir = "../uploads/";
        $image_name = basename($this->image["name"]);
        $image_path = $upload_dir . $image_name;
    
        if (!move_uploaded_file($this->image["tmp_name"], $image_path)) {
            return "Failed to upload the image.";
        }
    
        // Insert item into 'item' table
        $sql = "INSERT INTO item (itemName, itemEventType, itemPrice, itemPhoto, itemStock, itemSource) 
                VALUES ('$this->item_name', '$this->item_EventType', $this->item_price, '$image_path', $this->item_stock, '$this->item_source')";
    
        if (mysqli_query($this->conn, $sql)) {
            $item_id = mysqli_insert_id($this->conn);
    
            // If the source is 'Supplied' and supplierID is not empty, insert into item_supplier
            if ($this->item_source == 'Supplied' && !empty($this->supplier_id)) {
                $amount = $this->item_stock;
                $addedDate = date("Y-m-d"); // Get today's date

                $item_supplier_sql = "INSERT INTO item_supplier (itemID, supplierID, amount, addedDate) 
                                      VALUES ($item_id, $this->supplier_id, '$amount', '$addedDate')";
                if (!mysqli_query($this->conn, $item_supplier_sql)) {
                    return "Error inserting item supplier.";
                }
            }
    
            return "Item added successfully!";
        } else {
            return "Error: " . mysqli_error($this->conn);
        }
    }
    

    // Method to delete an item from the database
    public function deleteItem($item_id) {
        $this->item_id = $item_id;
    
        // Delete related records in pre_define_package_item first
        $delete_related_sql = "DELETE FROM pre_define_package_item WHERE itemID = '$this->item_id'";
        mysqli_query($this->conn, $delete_related_sql);
    
        // Delete related records in item_supplier
        $delete_supplier_sql = "DELETE FROM item_supplier WHERE itemID = '$this->item_id'";
        mysqli_query($this->conn, $delete_supplier_sql);
    
        // Now delete the item from item table
        $delete_item_sql = "DELETE FROM item WHERE itemID = '$this->item_id'";
    
        if (mysqli_query($this->conn, $delete_item_sql)) {
            return "Item deleted successfully!";
        } else {
            return "Error deleting item: " . mysqli_error($this->conn);
        }
    }


    public function getItemDetails($itemID) {
        $sql = "SELECT i.*, isup.supplierID, s.email AS supplierEmail 
                FROM item i 
                LEFT JOIN item_supplier isup ON i.itemID = isup.itemID 
                LEFT JOIN supplier s ON isup.supplierID = s.supplierID
                WHERE i.itemID = '$itemID'";
    
        $result = mysqli_query($this->conn, $sql);
        if ($result && mysqli_num_rows($result) > 0) {
            return mysqli_fetch_assoc($result);
        } else {
            return false;
        }
    }
    


    public function editItem($itemID, $itemName, $itemEventType, $itemPrice, $itemStock, $itemSource, $supplierID, $currentPhoto) {
        // Handle image upload
        if (!empty($_FILES['itemPhoto']['name'])) {
            $targetDir = "../uploads/";
            $targetFile = $targetDir . basename($_FILES["itemPhoto"]["name"]);
            move_uploaded_file($_FILES["itemPhoto"]["tmp_name"], $targetFile);
            $itemPhoto = $targetFile;
        } else {
            $itemPhoto = $currentPhoto; // Keep existing photo
        }
    
        // Update item table
        $updateSql = "UPDATE item 
                      SET itemName='$itemName', itemEventType='$itemEventType', itemPhoto='$itemPhoto', itemPrice='$itemPrice', 
                          itemStock='$itemStock', itemSource='$itemSource' 
                      WHERE itemID='$itemID'";
        mysqli_query($this->conn, $updateSql);

        $addedDate = date("Y-m-d"); // Get today's date
    
        // Handle supplier update only if source is "Supplied" and supplier is selected
        if ($itemSource == "Supplied" && !empty($supplierID)) {
            $checkSql = "SELECT * FROM item_supplier WHERE itemID = '$itemID'";
            $checkResult = mysqli_query($this->conn, $checkSql);
    
            if (mysqli_num_rows($checkResult) > 0) {
                // Update existing supplier
                $updateSupplierSql = "UPDATE item_supplier SET supplierID = '$supplierID', amount = '$itemStock' WHERE itemID = '$itemID'";
                mysqli_query($this->conn, $updateSupplierSql);
            } else {
                // Insert new supplier relationship
                $insertSupplierSql = "INSERT INTO item_supplier (itemID, supplierID, amount, addedDate) VALUES ('$itemID', '$supplierID', '$itemStock', '$addedDate')";
                mysqli_query($this->conn, $insertSupplierSql);
            }
        } elseif ($itemSource == "Company") {
            // Remove supplier entry if the item is no longer "Supplied"
            $deleteSupplierSql = "DELETE FROM item_supplier WHERE itemID = '$itemID'";
            mysqli_query($this->conn, $deleteSupplierSql);
        }
    
        return "Item updated successfully!";
    }
    

 
}
?>
