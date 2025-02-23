<?php
include 'conf.php';
include 'classPackage.php';
include 'classPre_define_package.php';

if (isset($_GET['packageID'])) {
    // Create a new Pre_define_package object
    $package = new Pre_define_package($conn);
    
    // Get packageID from URL
    $packageID = $_GET['packageID'];
    
    // Fetch package details
    $packageDetails = $package->getPackageDetails($packageID);
    $items = $package->getPackageItems($packageID);
}

if (isset($_POST['submit'])) {
    // Collect form data
    $name = $_POST['name'];
    $price = $_POST['price'];
    $type = $_POST['type'];

    // Collect updated items
    $updatedItems = [];
    for ($i = 1; $i <= 20; $i++) {
        if (!empty($_POST["item$i"])) {
            $updatedItems[] = $_POST["item$i"];
        }
    }

    // Create a new Pre_define_package object
    $package = new Pre_define_package($conn);

    // Call updatePackage method (with correct parameters)
    $message = $package->updatePackage($packageID, $name, $price, $type, $updatedItems);

    // Display success message and redirect
    echo "<script>alert('$message'); window.location='formAdd_P_Package.php';</script>";
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Package</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
    .form-container {
    background-color: #fdecf6;  /* Red background */
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
    }

    body{
    background-color: #fcf6ec;  
    }

    </style>
</head>
<body>
    <h2 class="text-center mt-4">Edit Package</h2>
    <form method="POST" action="" class="border rounded p-4 w-50 mx-auto form-container">
        <div class="mb-3">
            <label class="form-label fw-bold">Package Name</label>
            <input type="text" class="form-control" name="name" value="<?php echo $packageDetails['packageName']; ?>" required>
        </div>
        <div class="mb-3">
            <label class="form-label fw-bold">Package Price</label>
            <input type="number" class="form-control" name="price" value="<?php echo $packageDetails['price']; ?>" required>
        </div>
        <div class="mb-3">
            <label class="form-label fw-bold">Event Type</label>
            <select class="form-select" name="type">
                <option value="Wedding" <?php echo ($packageDetails['eventType'] == 'Wedding') ? 'selected' : ''; ?>>Wedding</option>
                <option value="Birthday" <?php echo ($packageDetails['eventType'] == 'Birthday') ? 'selected' : ''; ?>>Birthday</option>
                <option value="Award Ceramony " <?php echo ($packageDetails['eventType'] == 'Award Ceramony') ? 'selected' : ''; ?>>Award Ceramony</option>
            </select>
        </div>

        <?php
        for ($i = 1; $i <= 20; $i++) {
            $value = isset($items[$i - 1]) ? $items[$i - 1] : '';
            echo '
                <div class="mb-3">
                    <label class="form-label fw-bold">Item ' . $i . '</label>
                    <input type="text" class="form-control" name="item' . $i . '" value="' . $value . '">
                </div>';
        }
        ?>

        <button type="submit" class="btn btn-success" name="submit">Update Package</button>
    </form>
</body>
</html>
