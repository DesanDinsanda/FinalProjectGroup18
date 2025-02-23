<?php
include 'conf.php';
include 'classPackage.php';
include 'classPre_define_package.php';

$package = new Pre_define_package($conn); // Create an instance of Package

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $packageID = $_POST['packageID'];

    $message = $package->removeDiscount($packageID);
    echo $message;
}

// Redirect back to the package page
header("Location: formAdd_P_Package.php");
exit();
?>
