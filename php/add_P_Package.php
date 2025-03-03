<?php
include 'conf.php';
include 'classPackage.php';
include 'classPre_define_package.php';

if (isset($_POST['submit'])) {

    $package = new Pre_define_package($conn);

    $package->setPackageName($_POST['name']);
    $package->setPrice($_POST['price']);
    $package->setEventType($_POST['type']);

    // Collect all items into an array
    $items = [];
    for ($i = 1; $i <= 20; $i++) {
        if (!empty($_POST["item$i"])) {
            $items[] = $_POST["item$i"];
        }
    }

    $message = $package->addPackage(
        $package->getPackageName(), 
        $package->getPrice(), 
        $package->getEventType(), 
        $items
    );

    echo "<script>alert('$message'); window.location='formAdd_P_Package.php';</script>";
} else {
    echo "No data received";
}
?>
