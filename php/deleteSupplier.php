<?php
include 'conf.php';
include 'classSupplier.php';

if (isset($_GET['supplierID'])) {
    $supplierID = $_GET['supplierID'];

    // Create a new supplier object (child class)
    $supplier = new Supplier($conn);  
    // Call deleteSupplier() method from the child class
    $message = $supplier->deleteSupplier($supplierID);

    echo "<script>alert('$message'); window.location='formAddSuppliers.php';</script>";
} else {
    echo "No supplier ID received";
}
?>
