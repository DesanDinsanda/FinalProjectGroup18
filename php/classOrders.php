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


    public function viewPlacedOrders() {}
    public function rejectOrder() {}
    public function acceptOrder() {}
    public function acceptRescheduleOrder() {}
    public function rejectRescheduleOrder() {}
    public function viewOrderStatus() {}
    public function cancelOrder() {}
    public function viewCancelOrder() {}
    public function reScheduleOrder() {}
    public function viewRescheduleOrders() {}
    public function addOrder() {}
    public function deleteOrder() {}
    public function updateOrder() {}
    public function selectEventType() {}
    public function selectOrder() {}
}
?>
