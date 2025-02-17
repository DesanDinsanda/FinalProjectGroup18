<?php
include 'conf.php';
include 'classSupplier.php';

if (isset($_POST['submitSupplier'])) {
    // Create a new Supplier object
    $supplier = new Supplier($conn);

    // Set supplier details 
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $telNO = $_POST['telNO'];
    $email = $_POST['email'];
    $province = $_POST['province'];
    $city = $_POST['city'];
    $streetName = $_POST['streetName'];

    // Use getters to pass correct values
    $message = $supplier->addSupplier($firstName, $lastName, $telNO, $email, $province, $city, $streetName);

    echo "<script>alert('$message'); window.location='formAddSuppliers.php';</script>";
} else {
    echo "No data received";
}
?>
