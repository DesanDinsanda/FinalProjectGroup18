<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>cancel order Interface</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <link rel="stylesheet" href="../css/navbar.css">
    
    
</head>
<body>
<?php include 'navbar.php'; ?>

<br><br><br><br><br><br>
<h2 class="text-center text-primary"><b>Cencelled Orders</b></h2>
<?php
include 'conf.php';
include 'classOrders.php';

echo <<<HTML
    
            <html>
            <head>
            <title>Cancelled Orders</title>
            </head>
            <body>
                <div class="container my-4">
            <table class="table table-bordered table-striped">
                <thead class="table-dark">
                    <tr>
                        <th>Order ID</th>
                        <th>Order Date</th>
                        <th>Status</th>
                        <th>Event Date</th>
                        <th>Event Time</th>
                        <th>Event Location</th>
                        <th>Event Type</th>
                        <th>Package Name</th>
                        <th>Cost</th>
                        <th>First Name</th>
                        <th>Number</th>
                        <th>items</th>
                        
                        
                    </tr>
                </thead>
                <tbody>
    HTML;
    

$orders = new Orders($conn);
$orders->viewCancelOrder();

echo <<<HTML
                </tbody>
            </table>
        </div> 
            </body>
            </html>
    HTML;


?>
</body>
</html>
