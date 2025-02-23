<?php
include 'conf.php';
include 'classPackage.php';
include 'classPre_define_package.php';

if (isset($_GET['packageID'])) {
    $packageID = $_GET['packageID'];

    // Create a new Pre_define_package object (child class)
    $package = new Pre_define_package($conn);  // You can use Pre_define_package if needed

    // Call deletePackage() method from the child class
    $message = $package->deletePackage($packageID);

    echo "<script>alert('$message'); window.location='formAdd_P_Package.php';</script>";
} else {
    echo "No package ID received";
}
?>
