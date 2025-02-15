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
        $sql = "SELECT itemID, itemName, itemPrice, itemStock, itemSource FROM item ";
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

    public function renewAllocatedItems() {}
    public function addItemsToInventory() {}
    public function deleteItemsInInventory() {}
    public function updateItemsInInventory() {}
    public function selectItem() {}

    public function checkAvailability() {}
}
?>
