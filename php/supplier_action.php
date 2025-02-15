<?php
include 'conf.php';
include 'classSupplier.php';

$supplier = new Supplier($conn);

if ($_POST['action'] == "toggle_favorite") {
    echo $supplier->setSupplierToFavourite($_POST['supplierID']);
} elseif ($_POST['action'] == "remove_favorite") {
    $supplier->deleteSupplierFromFavourite($_POST['supplierID']);
}
?>

