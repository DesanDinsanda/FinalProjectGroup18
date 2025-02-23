<?php
include 'conf.php';

class Notification {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function viewEventmanagerNotification() {
        $sql = "SELECT orderID, status, eventDate, eventLocation 
                FROM orders WHERE status IN ('pending', 'cancelled', 'reschedule') 
                ORDER BY orderDate DESC";

        $result = $this->conn->query($sql);
        $notifications = [];

        while ($row = $result->fetch_assoc()) {
            $link = "#";
            if ($row['status'] == "pending") {
                $link = "pendingOrders.php";
            } elseif ($row['status'] == "cancelled") {
                $link = "cancelledOrders.php";
            } elseif ($row['status'] == "reschedule") {
                $link = "rescheduledOrders.php";
            }

            $notifications[] = [
                'orderID' => $row['orderID'],
                'status' => ucfirst($row['status']),
                'eventDate' => $row['eventDate'],
                'link' => $link
            ];
        }

        echo json_encode($notifications);
    }


    public function viewCustomerNotification() {
        $email = $_SESSION['email'];
        $sql = "SELECT o.orderID, o.status, o.eventDate, o.eventLocation 
                FROM orders o 
                INNER JOIN user u ON o.customerID = u.ID
                WHERE o.status IN ('accepted', 'rejected', 'rescheduleAccepted', 'rescheduleRejected') 
                AND u.email = '$email'
                ORDER BY o.orderDate DESC";
    
        $result = $this->conn->query($sql);
        $notifications = [];
    
        while ($row = $result->fetch_assoc()) {
            $link = "customerOrders.php"; // All statuses go to the same page
    
            $notifications[] = [
                'orderID' => $row['orderID'],
                'status' => ucfirst($row['status']),
                'eventDate' => $row['eventDate'],
                'link' => $link
            ];
        }
    
        echo json_encode($notifications);
    }
    
}
?>
