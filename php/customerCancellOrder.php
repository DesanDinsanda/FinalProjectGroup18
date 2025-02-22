<?php 
include "conf.php";
include 'classOrders.php';

if (isset($_GET['orderID'])) {
    $orderID = $_GET['orderID'];
   
    $orders = new Orders($conn);
    $orders->cancelOrder($orderID);
}
?>
