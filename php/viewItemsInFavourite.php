
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="../css/customerHome.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <style>
        body { background-color: #fcf6ec; }
        .card-hover { border-radius: 15px; transition: transform 0.3s ease, box-shadow 0.3s ease; }
        .card-hover:hover { transform: translateY(-10px); box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2); background-color: #ffe6e6; }
        
    </style>
</head>
<body>
<?php include 'customerNavbar.php' ?>
<br><br><br><br><br>

<?php
include 'conf.php';
include 'classPackage.php';
include "classCustom_package.php";

// Check if user is logged in
if (!isset($_SESSION['email'])) {
    header("Location: ../html/login.html"); // Redirect to login page
    exit();
}

// Get customer ID
$sql = "SELECT ID FROM user WHERE email = '".$_SESSION['email']."'";
$result = mysqli_query($conn, $sql);

if ($row = mysqli_fetch_assoc($result)) {
    $customerID = $row['ID'];
} else {
    die("Error: Customer not found.");
}

$customPackage = new CustomPackage($conn);
$customPackage->viewItemsInFavourite();
?>

<?php include 'footer.php'  ?>
    
</body>
</html>