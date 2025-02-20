<?php
include 'conf.php';

$sql = "SELECT 
    (SELECT COUNT(*) FROM orders WHERE status = 'pending') AS pending_count,
    (SELECT COUNT(*) FROM orders WHERE status = 'cancelled') AS cancelled_count,
    (SELECT COUNT(*) FROM orders WHERE status = 'reschedule') AS rescheduled_count";

$result = $conn->query($sql);
$data = $result->fetch_assoc();

$total_notifications = $data['pending_count'] + $data['cancelled_count'] + $data['rescheduled_count'];

echo json_encode(['count' => $total_notifications]);
?>
