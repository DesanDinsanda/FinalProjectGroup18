<?php
include 'conf.php';

if (isset($_GET['eventDate'])) {
    $eventDate = $_GET['eventDate'];

    // Fetch event details for the clicked date
    $sql = "
        SELECT 
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
            GROUP_CONCAT(i.itemName SEPARATOR ', ') AS itemNames
        FROM orders o 
        INNER JOIN user u ON o.customerID = u.ID
        INNER JOIN user_telno ut ON o.customerID = ut.ID
        LEFT JOIN package p ON o.pre_define_packageID = p.packageID OR o.custom_packageID = p.packageID
        LEFT JOIN custom_package_item cpi ON o.custom_packageID = cpi.custom_packageID OR o.pre_define_packageID = cpi.custom_packageID
        LEFT JOIN item i ON cpi.itemID = i.itemID 
        WHERE o.status = 'accepted' AND o.eventDate = ?
        GROUP BY o.orderID
    ";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $eventDate);
    $stmt->execute();
    $result = $stmt->get_result();

    $events = [];
    while ($row = $result->fetch_assoc()) {
        $events[] = $row;
    }

    header('Content-Type: application/json');
    echo json_encode($events);
    exit;
}

// Fetch all event dates for the calendar
$sql = "SELECT DISTINCT eventDate FROM orders WHERE status = 'accepted'";
$result = $conn->query($sql);

$events = [];
while ($row = $result->fetch_assoc()) {
    $events[] = [
        'start' => $row['eventDate'] 
    ];
}

header('Content-Type: application/json');
echo json_encode($events);
$conn->close();
?>
