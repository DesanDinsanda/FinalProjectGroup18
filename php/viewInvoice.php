<?php
include 'conf.php';
include 'classInvoice.php';
if (isset($_GET['orderID'])) {
    $orderID = $_GET['orderID']; 
    
    $invoice = new Invoice($conn);
    $invoice->viewInvoice($orderID);

} 

?>