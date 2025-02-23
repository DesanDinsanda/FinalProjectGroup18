<?php
include 'conf.php';
session_start(); // Ensure session is started

$email = $_SESSION['email'];

$sql = "SELECT 
    (SELECT COUNT(*) FROM orders o INNER JOIN user u ON o.customerID = u.ID WHERE o.status = 'accepted' AND u.email = '$email') AS accepted_count,
    (SELECT COUNT(*) FROM orders o INNER JOIN user u ON o.customerID = u.ID WHERE o.status = 'rejected' AND u.email = '$email') AS rejected_count,
    (SELECT COUNT(*) FROM orders o INNER JOIN user u ON o.customerID = u.ID WHERE o.status = 'rescheduleAccepted' AND u.email = '$email') AS rescheduleAccepted_count,
    (SELECT COUNT(*) FROM orders o INNER JOIN user u ON o.customerID = u.ID WHERE o.status = 'rescheduleRejected' AND u.email = '$email') AS rescheduleRejected_count";

$result = $conn->query($sql);
$data = $result->fetch_assoc();

$total_notifications = $data['accepted_count'] + $data['rejected_count'] + $data['rescheduleAccepted_count'] + $data['rescheduleRejected_count'];

echo json_encode(['count' => $total_notifications]);
?>
