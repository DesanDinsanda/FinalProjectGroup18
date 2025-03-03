<?php
include 'conf.php';
include 'classPackage.php';
include 'classPre_define_package.php';

$package = new Pre_define_package($conn); 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $packageID = $_POST['packageID'];

    $message = $package->removeDiscount($packageID);
    echo $message;
}

header("Location: formAdd_P_Package.php");
exit();
?>
