<?php
session_start();
include "conf.php";
include 'classPackage.php';
include "classCustom_package.php";

$customPackage = new CustomPackage($conn);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $itemID = $_POST['itemID'];
    $quantity = intval($_POST['quantity']);
    $eventType = $_POST['eventType'];

    $customPackage->addItemsToCustomPackage($itemID, $quantity, $eventType);
}

header("Location: fetchCart" . $eventType . "PackageItems.php");
exit();
?>
