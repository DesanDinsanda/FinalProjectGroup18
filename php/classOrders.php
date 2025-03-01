<?php
include 'conf.php';

class Orders {
    private $orderID;
    private $orderDate;
    private $orderStatus;
    private $eventDate;
    private $eventTime;
    private $eventLocation;
    private $orderDiscount;
    private $orderAdvance;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function getOrderID() { return $this->orderID; }
    public function setOrderID($orderID) { $this->orderID = $orderID; }

    public function getOrderDate() { return $this->orderDate; }
    public function setOrderDate($orderDate) { $this->orderDate = $orderDate; }

    public function getOrderStatus() { return $this->orderStatus; }
    public function setOrderStatus($orderStatus) { $this->orderStatus = $orderStatus; }

    public function getEventDate() { return $this->eventDate; }
    public function setEventDate($eventDate) { $this->eventDate = $eventDate; }

    public function getEventTime() { return $this->eventTime; }
    public function setEventTime($eventTime) { $this->eventTime = $eventTime; }

    public function getEventLocation() { return $this->eventLocation; }
    public function setEventLocation($eventLocation) { $this->eventLocation = $eventLocation; }

    public function getOrderDiscount() { return $this->orderDiscount; }
    public function setOrderDiscount($orderDiscount) { $this->orderDiscount = $orderDiscount; }

    public function getOrderAdvance() { return $this->orderAdvance; }
    public function setOrderAdvance($orderAdvance) { $this->orderAdvance = $orderAdvance; }

    public function viewAllOrderDetails() {
        $sql = "SELECT 
    o.orderID, 
    o.orderDate, 
    o.status, 
    o.eventDate, 
    o.eventTime, 
    o.eventLocation,  
    p.eventType, 
    p.packageName, 
    p.price,   
    u.firstName, 
    ut.telNO, 
    GROUP_CONCAT(i.itemName SEPARATOR ', ') AS itemNames  -- Combine multiple items in one row
        FROM orders o 
        INNER JOIN user u ON o.customerID = u.ID
        INNER JOIN user_telno ut ON o.customerID = ut.ID
        LEFT JOIN package p ON o.pre_define_packageID = p.packageID OR o.custom_packageID = p.packageID
        LEFT JOIN custom_package_item cpi ON o.custom_packageID = cpi.custom_packageID OR o.pre_define_packageID = cpi.custom_packageID
        LEFT JOIN item i ON cpi.itemID = i.itemID
        GROUP BY o.orderID";


        $result = mysqli_query($this->conn, $sql);
        echo <<<HTML

        <html>
        <head>
        <title>AllOrders</title>
        </head>
        <body>
            <div class="container my-4">
        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th>Order ID</th>
                    <th>Order Date</th>
                    <th>Status</th>
                    <th>Event Date</th>
                    <th>Event Time</th>
                    <th>Event Location</th>
                    <th>Event Type</th>
                    <th>Package Name</th>
                    <th>Cost</th>
                    <th>First Name</th>
                    <th>Number</th>
                    <th>items</th>
                    
                </tr>
            </thead>
            <tbody>
HTML;

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        echo <<<HTML
            <tr>

                <td>{$row['orderID']}</td>
                <td>{$row['orderDate']}</td>
                <td>{$row['status']}</td>
                <td>{$row['eventDate']}</td>
                <td>{$row['eventTime']}</td>
                <td>{$row['eventLocation']}</td>
                <td>{$row['eventType']}</td>
                <td>{$row['packageName']}</td>
                <td>{$row['price']}</td>
                <td>{$row['firstName']}</td>
                <td>{$row['telNO']}</td>
                <td>{$row['itemNames']}</td>
                

                
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


    public function viewPlacedOrders() {
        $sql = "SELECT 
        o.orderID, 
        o.orderDate, 
        o.status, 
        o.eventDate, 
        o.eventTime, 
        o.eventLocation,  
        p.eventType, 
        p.packageName, 
        p.price,   
        u.firstName, 
        ut.telNO,
        GROUP_CONCAT(CONCAT(i.itemName, '-', cpi.amount) SEPARATOR ', ') AS itemNames  -- Combine items with amounts
    FROM orders o 
    INNER JOIN user u ON o.customerID = u.ID
    INNER JOIN user_telno ut ON o.customerID = ut.ID
    LEFT JOIN package p ON o.pre_define_packageID = p.packageID OR o.custom_packageID = p.packageID
    LEFT JOIN custom_package_item cpi ON o.custom_packageID = cpi.custom_packageID OR o.pre_define_packageID = cpi.custom_packageID
    LEFT JOIN item i ON cpi.itemID = i.itemID 
    WHERE o.status = 'pending'
    GROUP BY o.orderID";

    
    
            $result = mysqli_query($this->conn, $sql);
            
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            echo <<<HTML
                <tr>
    
                    <td>{$row['orderID']}</td>
                    <td>{$row['orderDate']}</td>
                    <td>{$row['status']}</td>
                    <td>{$row['eventDate']}</td>
                    <td>{$row['eventTime']}</td>
                    <td>{$row['eventLocation']}</td>
                    <td>{$row['eventType']}</td>
                    <td>{$row['packageName']}</td>
                    <td>{$row['price']}</td>
                    <td>{$row['firstName']}</td>
                    <td>{$row['telNO']}</td>
                    <td>{$row['itemNames']}</td>
                    <td>
                    <button class="btn btn-info" onclick="confirmAction({$row['orderID']}, 'accept')">Accept</button>&nbsp;
                    <button class="btn btn-danger" onclick="confirmAction({$row['orderID']}, 'reject')">Reject</button>
                    </td>
                    
    
                    
                </tr>
    HTML;
        }
    }
}
    

    public function rejectOrder($orderID) {
        $this->orderID = $orderID;
        $sql = "UPDATE orders SET status='rejected' WHERE orderID='$this->orderID'";
    
    if (mysqli_query($this->conn, $sql)) {
        echo "<script>alert('Order rejected!'); window.location='pendingOrders.php';</script>";
    } else {
        echo "<script>alert('Error rejecting order!'); window.location='pendingOrders.php';</script>";
    }
    }

    public function acceptOrder($orderID) {
        $this->orderID = $orderID;
    
        // Get custom_packageID from orders table
        $sql = "SELECT custom_packageID FROM orders WHERE orderID = '$this->orderID'";
        $result = mysqli_query($this->conn, $sql);
    
        if ($row = mysqli_fetch_assoc($result)) {
            $custom_packageID = $row['custom_packageID'];
    
            // Get all itemID and amount from custom_package_item table
            $sql = "SELECT itemID, amount FROM custom_package_item WHERE custom_packageID = '$custom_packageID'";
            $result = mysqli_query($this->conn, $sql);
    
            while ($row = mysqli_fetch_assoc($result)) {
                $itemID = $row['itemID'];
                $amount = $row['amount'];
    
                // Update itemStock in item table by reducing the amount
                $updateStockSql = "UPDATE item SET itemStock = itemStock - $amount WHERE itemID = '$itemID'";
                mysqli_query($this->conn, $updateStockSql);
            }
    
            // Finally, update the order status to 'accepted'
            $updateOrderSql = "UPDATE orders SET status='accepted' WHERE orderID= '$this->orderID'";
            if (mysqli_query($this->conn, $updateOrderSql)) {
                echo "<script>alert('Order Accepted! Stock updated successfully.'); window.location='pendingOrders.php';</script>";
            } else {
                echo "<script>alert('Error updating order status!'); window.location='pendingOrders.php';</script>";
            }
        } else {
            echo "<script>alert('Order not found!'); window.location='pendingOrders.php';</script>";
        }
    }
    

    public function viewCancelOrder() {
        $sql = "SELECT 
        o.orderID, 
        o.orderDate, 
        o.status, 
        o.eventDate, 
        o.eventTime, 
        o.eventLocation,  
        p.eventType, 
        p.packageName, 
        p.price,   
        u.firstName, 
        ut.telNO, 
        GROUP_CONCAT(i.itemName SEPARATOR ', ') AS itemNames  -- Combine multiple items in one row
            FROM orders o 
            INNER JOIN user u ON o.customerID = u.ID
            INNER JOIN user_telno ut ON o.customerID = ut.ID
            LEFT JOIN package p ON o.pre_define_packageID = p.packageID OR o.custom_packageID = p.packageID
            LEFT JOIN custom_package_item cpi ON o.custom_packageID = cpi.custom_packageID OR o.pre_define_packageID = cpi.custom_packageID
            LEFT JOIN item i ON cpi.itemID = i.itemID WHERE o.status = 'cancelled'
            GROUP BY o.orderID";
    
    
            $result = mysqli_query($this->conn, $sql);
            
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            echo <<<HTML
                <tr>
    
                    <td>{$row['orderID']}</td>
                    <td>{$row['orderDate']}</td>
                    <td>{$row['status']}</td>
                    <td>{$row['eventDate']}</td>
                    <td>{$row['eventTime']}</td>
                    <td>{$row['eventLocation']}</td>
                    <td>{$row['eventType']}</td>
                    <td>{$row['packageName']}</td>
                    <td>{$row['price']}</td>
                    <td>{$row['firstName']}</td>
                    <td>{$row['telNO']}</td>
                    <td>{$row['itemNames']}</td>
                   
                    
    
                    
                </tr>
    HTML;
        }
    }
    }

    public function viewRescheduleOrders() {
        $sql = "SELECT 
        o.orderID, 
        o.orderDate, 
        o.status, 
        o.eventDate, 
        o.eventTime, 
        o.eventLocation,  
        p.eventType, 
        p.packageName, 
        p.price,   
        u.firstName, 
        ut.telNO, 
        GROUP_CONCAT(i.itemName SEPARATOR ', ') AS itemNames  -- Combine multiple items in one row
            FROM orders o 
            INNER JOIN user u ON o.customerID = u.ID
            INNER JOIN user_telno ut ON o.customerID = ut.ID
            LEFT JOIN package p ON o.pre_define_packageID = p.packageID OR o.custom_packageID = p.packageID
            LEFT JOIN custom_package_item cpi ON o.custom_packageID = cpi.custom_packageID OR o.pre_define_packageID = cpi.custom_packageID
            LEFT JOIN item i ON cpi.itemID = i.itemID WHERE o.status = 'reschedule'
            GROUP BY o.orderID";
    
    
            $result = mysqli_query($this->conn, $sql);
            
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            echo <<<HTML
                <tr>
    
                    <td>{$row['orderID']}</td>
                    <td>{$row['orderDate']}</td>
                    <td>{$row['status']}</td>
                    <td>{$row['eventDate']}</td>
                    <td>{$row['eventTime']}</td>
                    <td>{$row['eventLocation']}</td>
                    <td>{$row['eventType']}</td>
                    <td>{$row['packageName']}</td>
                    <td>{$row['price']}</td>
                    <td>{$row['firstName']}</td>
                    <td>{$row['telNO']}</td>
                    <td>{$row['itemNames']}</td>
                    <td>
                    <button class="btn btn-info" onclick="confirmAction({$row['orderID']}, 'accept')">Accept</button>&nbsp;
                    <button class="btn btn-danger" onclick="confirmAction({$row['orderID']}, 'reject')">Reject</button>
                </td>
                    
    
                    
                </tr>
    HTML;
        }
    }
    }

    public function acceptRescheduleOrder($orderID) {
        $this->orderID = $orderID;
        $sql = "UPDATE orders SET status='RescheduleAccepted' WHERE orderID= '$this->orderID'";
    
        if (mysqli_query($this->conn, $sql)) {
            echo "<script>alert('Rechedule Accepted!'); window.location='rescheduledOrders.php';</script>";
        } else {
            echo "<script>alert('Error Rescheduling order!'); window.location='rescheduledOrders.php';</script>";
        }
    }

    public function rejectRescheduleOrder($orderID) {
        $this->orderID = $orderID;
        $sql = "UPDATE orders SET status='RescheduleRejected' WHERE orderID='$this->orderID'";
    
    if (mysqli_query($this->conn, $sql)) {
        echo "<script>alert('Reschedule rejected!'); window.location='rescheduledOrders.php';</script>";
    } else {
        echo "<script>alert('Error Reschedule order!'); window.location='rescheduledOrders.php';</script>";
    }
    }
    
    
    public function viewOrderStatus() {
        $email = $_SESSION['email'];
        $sql = "SELECT 
            o.orderID, 
            o.orderDate, 
            o.status, 
            o.eventDate, 
            o.eventTime, 
            o.eventLocation,  
            p.eventType, 
            p.packageName, 
            p.price,    
            GROUP_CONCAT(i.itemName SEPARATOR ', ') AS itemNames
        FROM orders o 
        INNER JOIN user u ON o.customerID = u.ID
        LEFT JOIN package p ON o.pre_define_packageID = p.packageID OR o.custom_packageID = p.packageID
        LEFT JOIN custom_package_item cpi ON o.custom_packageID = cpi.custom_packageID OR o.pre_define_packageID = cpi.custom_packageID
        LEFT JOIN item i ON cpi.itemID = i.itemID
        WHERE u.email = '$email'
        GROUP BY o.orderID";
    
        $result = mysqli_query($this->conn, $sql);
    
        echo '<div class="container my-4">
            <table class="table table-bordered table-striped">
                <thead class="table-dark">
                    <tr>
                        <th>Order ID</th>
                        <th>Order Date</th>
                        <th>Status</th>
                        <th>Event Date</th>
                        <th>Event Time</th>
                        <th>Event Location</th>
                        <th>Event Type</th>
                        <th>Package Name</th>
                        <th>Cost</th>
                        <th>Items</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>';
    
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                echo '<tr>
                    <td>' . $row['orderID'] . '</td>
                    <td>' . $row['orderDate'] . '</td>
                    <td>' . $row['status'] . '</td>
                    <td>' . $row['eventDate'] . '</td>
                    <td>' . $row['eventTime'] . '</td>
                    <td>' . $row['eventLocation'] . '</td>
                    <td>' . $row['eventType'] . '</td>
                    <td>' . $row['packageName'] . '</td>
                    <td>' . $row['price'] . '</td>
                    <td>' . $row['itemNames'] . '</td>
                    <td>
                        <button class="btn btn-info" onclick="confirmAction(' . $row['orderID'] . ', \'cancel\')">Cancel</button>&nbsp;
                        <button class="btn btn-danger" onclick="confirmAction(' . $row['orderID'] . ', \'reject\')">Reschedule</button>
                    </td>
                </tr>';
            }
        }
    
        echo '</tbody></table></div>';
    }
    
    public function cancelOrder($orderID) {
        $this->orderID = $orderID;
        $sql = "UPDATE orders SET status='cancelled' WHERE orderID= '$this->orderID'";
    
        if (mysqli_query($this->conn, $sql)) {
            echo "<script>alert('Order Cancelled!'); window.location='customerOrders.php';</script>";
        } else {
            echo "<script>alert('Error Rescheduling order!'); window.location='customerCancelOrder.php';</script>";
        }
    }
    
    public function reScheduleOrder($orderID,$eventLocation,$eventDate,$eventTime) {
        $this->orderID = $orderID;
        $this->eventLocation = $eventLocation;
        $this->eventDate = $eventDate;
        $this->eventTime = $eventTime;
        $sql = "UPDATE orders SET status='reschedule', eventLocation ='$this->eventLocation', eventDate = '$this->eventDate' , eventTime = '$this->eventTime'   WHERE orderID= $this->orderID";
    
        if (mysqli_query($this->conn, $sql)) {
            echo "<script>alert('Order Rescheduled!'); window.location='customerOrders.php';</script>";
        } else {
            echo "<script>alert('Error Rescheduling order!'); window.location='customerCancelOrder.php';</script>";
        }
    }
    
   
    public function orderPreDefinePackage($customerID, $location, $eventDate, $eventTime, $packageID) {
        $orderDate = date('Y-m-d'); // Get current date
        $status = 'pending'; // Default order status

        // SQL query to insert order details
        $sql = "INSERT INTO orders (orderDate, status, eventDate, eventTime, eventLocation, pre_define_packageID, customerID) 
                VALUES ('$orderDate', '$status', '$eventDate', '$eventTime', '$location', '$packageID', '$customerID')";

        if (mysqli_query($this->conn, $sql)) {
            echo "
            <script>
                window.onload = function() {
                    var confirmationModal = document.getElementById('confirmationModal');
                    confirmationModal.style.display = 'block';

                    document.getElementById('orderNowBtn').onclick = function() {
                        window.location.href = 'service.php';
                    };
                };
            </script>
            
            <!-- Custom Modal for Confirmation -->
            <div id='confirmationModal' style='display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background:ivory; display: flex; justify-content: center; align-items: center; z-index: 1000;'>
                <div style='background-color: white; padding: 20px; border-radius: 8px; text-align: center;'>
                    <h4>Order Placed Successfully!</h4>
                    <p>Thank you for choosing us </p>
                    <button id='orderNowBtn' style='padding: 10px 20px; margin: 10px; background-color: green; color: white; border: none; border-radius: 5px;'>Go to services</button>
                </div>
            </div>";

        } else {
            echo "Error: " . mysqli_error($this->conn);
        }
    }



    public function orderCustomPackage($customerID, $location, $eventDate, $eventTime, $cart) {
        if (!isset($cart) || count($cart) === 0) {
            die("Error: No items in the custom package.");
        }

        $orderDate = date('Y-m-d'); // Current date
        $status = 'pending';

        // Calculate the total price of the custom package
        $totalPrice = 0;
        foreach ($cart as $item) {
            $totalPrice += $item['itemPrice'] * $item['quantity'];
        }

        // Get the event type from the first item in the cart
        $firstItemID = $cart[0]['itemID']; // Get first item ID

        $sql = "SELECT itemEventType FROM item WHERE itemID = '$firstItemID'"; // Fetch event type
        $result = mysqli_query($this->conn, $sql);

        if ($row = mysqli_fetch_assoc($result)) {
            $eventType = $row['itemEventType']; 
        } else {
            die("Error: Event type not found.");
        }

        $packageName = 'Custom Package'; // Default name
        $discount = 0; // No discount for custom packages

        // Insert package details
        $sqlPackage = "INSERT INTO package (eventType, packageName, price, discount) 
                       VALUES ('$eventType', '$packageName', '$totalPrice', '$discount')";

        if (mysqli_query($this->conn, $sqlPackage)) {
            $packageID = mysqli_insert_id($this->conn); // Get the ID of the inserted package

            // Insert the packageID into `custom_package` table
            $sqlCustomPackage = "INSERT INTO custom_package (packageID) VALUES ('$packageID')";
            mysqli_query($this->conn, $sqlCustomPackage);

            // Insert order into `orders` table
            $sqlOrder = "INSERT INTO orders (orderDate, status, eventDate, eventTime, eventLocation, customerID, custom_packageID) 
                         VALUES ('$orderDate', '$status', '$eventDate', '$eventTime', '$location', '$customerID', '$packageID')";

            if (mysqli_query($this->conn, $sqlOrder)) {
                // Insert selected items into `custom_package_item` table
                foreach ($cart as $item) {
                    $itemID = $item['itemID'];
                    $quantity = $item['quantity'];
                    $orderedDate = date("Y-m-d"); // Get today's date

                    $sqlItem = "INSERT INTO custom_package_item (custom_packageID, itemID, amount, orderedDate)
                                VALUES ('$packageID', '$itemID', '$quantity', '$orderedDate')";
                    mysqli_query($this->conn, $sqlItem);
                }

                // Clear cart after successful order
                unset($_SESSION['cart']);

                // Order confirmation modal
                echo "<script>
                window.onload = function() {
                    var confirmationModal = document.getElementById('confirmationModal');
                    confirmationModal.style.display = 'block';

                    document.getElementById('orderNowBtn').onclick = function() {
                        window.location.href = 'service.php';
                    };
                };
            </script>
            
            <!-- Custom Modal for Confirmation -->
            <div id='confirmationModal' style='display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background:ivory; display: flex; justify-content: center; align-items: center; z-index: 1000;'>
                <div style='background-color: white; padding: 20px; border-radius: 8px; text-align: center;'>
                    <h4>Order Placed Successfully!</h4>
                    <p>Thank you for choosing us </p>
                    <button id='orderNowBtn' style='padding: 10px 20px; margin: 10px; background-color: green; color: white; border: none; border-radius: 5px;'>Go to services</button>
                </div>
            </div>";
            } else {
                echo "Error inserting into orders: " . mysqli_error($this->conn);
            }
        } else {
            echo "Error inserting into package: " . mysqli_error($this->conn);
        }
    }

}
?>
