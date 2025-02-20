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

    public function receiveRejectionNotification() {}
    public function receiveAcceptanceNotification() {}
    public function receiveRescheduleAcceptanceNotification() {}
    public function receiveRescheduleRejectionNotification() {}
}
?>
