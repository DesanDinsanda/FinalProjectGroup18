<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <link rel="stylesheet" href="../css/navbar.css">
    
   
</head>
<body>

<?php  include 'adminNavbar.php'?>
<br><br><br><br><br><br>
<h2 class="text-center text-primary"><b>Registered Users</b></h2>
<?php
include 'conf.php';
include 'classCustomer.php';

$users = new Customer($conn);
$users->viewRegisteredUsers();
?>

</body>
</html>
