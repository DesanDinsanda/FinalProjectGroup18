<?php
include 'conf.php';
include 'classSupplier.php';

if (isset($_GET['supplierID'])) {
    $supplierID = $_GET['supplierID'];

    $supplier = new Supplier($conn);  
    
    $message = $supplier->deleteSupplier($supplierID);

    echo "<script>alert('$message'); window.location='formAddSuppliers.php';</script>";
} else {
    echo "No supplier ID received";
}
?>
