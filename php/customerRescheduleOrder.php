<?php 
include "conf.php";
include 'classOrders.php';




    if (isset($_POST['btnOrder'])) {
        $orderID = mysqli_real_escape_string($conn, $_POST['id']);
        $location = mysqli_real_escape_string($conn, $_POST['evntLocation']);
        $eventDate = mysqli_real_escape_string($conn, $_POST['eventDate']);
        $eventTime = mysqli_real_escape_string($conn, $_POST['eventTime']);
        
   
    $orders = new Orders($conn);
    $orders-> reScheduleOrder($orderID,$location,$eventDate,$eventTime);
    } else {
        echo " NO ID ";
    }

?>



