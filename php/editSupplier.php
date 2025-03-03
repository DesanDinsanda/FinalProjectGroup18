<?php
include 'conf.php';
include 'classSupplier.php';

if (isset($_GET['supplierID'])) {
    
    $supplier = new Supplier($conn);

    $supplierID = $_GET['supplierID'];

    $supplierDetails = $supplier->getSupplierDetails($supplierID);

    if (!$supplierDetails) {
        echo "Supplier not found!";
        exit;
    }
}

if (isset($_POST['submit'])) {
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $telNO = $_POST['telNO'];
    $email = $_POST['email'];
    $province = $_POST['province'];
    $city = $_POST['city'];
    $streetName = $_POST['streetName'];

    $supplier = new Supplier($conn);

    $message = $supplier->editSupplier($supplierID, $firstName, $lastName, $telNO, $email, $province, $city, $streetName);

    echo "<script>alert('$message'); window.location='formAddSuppliers.php';</script>";
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Supplier</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <link rel="stylesheet" href="../css/navbar.css">

    <style>
    .form-container {
    background-color: #fdecf6;  
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
    }

    body{
    background-color: #fcf6ec;  
    }

    </style>

</head>
<body>
<?php include "adminNavbar.php" ?>
<br><br><br><br><br>
    <h2 class="text-center mt-4">Edit Supplier</h2>
    <form method="POST" action="" class="border rounded p-4 w-50 mx-auto form-container">
        <div class="mb-3">
            <label class="form-label fw-bold">First Name</label>
            <input type="text" class="form-control" name="firstName" value="<?php echo $supplierDetails['firstName']; ?>" required>
        </div>
        <div class="mb-3">
            <label class="form-label fw-bold">Last Name</label>
            <input type="text" class="form-control" name="lastName" value="<?php echo $supplierDetails['lastName']; ?>" required>
        </div>
        <div class="mb-3">
            <label class="form-label fw-bold">Telephone Number</label>
            <input type="text" class="form-control" name="telNO" value="<?php echo $supplierDetails['telNO']; ?>" required>
        </div>
        <div class="mb-3">
            <label class="form-label fw-bold">Email</label>
            <input type="email" class="form-control" name="email" value="<?php echo $supplierDetails['email']; ?>" required>
        </div>
        <div class="mb-3">
            <label class="form-label fw-bold">Province</label>
            <input type="text" class="form-control" name="province" value="<?php echo $supplierDetails['province']; ?>" required>
        </div>
        <div class="mb-3">
            <label class="form-label fw-bold">City</label>
            <input type="text" class="form-control" name="city" value="<?php echo $supplierDetails['city']; ?>" required>
        </div>
        <div class="mb-3">
            <label class="form-label fw-bold">Street Name</label>
            <input type="text" class="form-control" name="streetName" value="<?php echo $supplierDetails['streetName']; ?>" required>
        </div>

        <button type="submit" class="btn btn-success" name="submit">Update Supplier</button>
    </form>
</body>
</html>
