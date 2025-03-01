


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart Interface</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="../css/customerHome.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">

    <style>
        body { background-color: #fcf6ec; }
    </style>
</head>
<body>
<?php include 'customerNavbar.php' ?>
<br><br><br><br><br>

<?php
// removed the session
// session_start();
include 'conf.php';
include 'classPackage.php';
include "classCustom_package.php";

$customPackage = new CustomPackage($conn);
$customPackage->viewItemsInCustomPackage();
echo "<br>";
?>

<?php include 'footer.php'  ?>
    
</body>
</html>