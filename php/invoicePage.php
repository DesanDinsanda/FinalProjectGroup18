
<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <link rel="stylesheet" href="../css/customerHome.css">


</head>
<body>
    <?php include 'customerNavbar.php'; ?>
    
    <br><br><br><br><br><br>
    <h2 class="text-center text-primary"><b>Generate Invoices</b></h2>

<?php
include 'conf.php';
$email = $_SESSION['email'];
$sql = "SELECT 
    o.orderID, o.orderDate, p.eventType, p.packageName, p.price,    
    GROUP_CONCAT(i.itemName SEPARATOR ', ') AS itemNames
    FROM orders o 
    INNER JOIN user u ON o.customerID = u.ID
    LEFT JOIN package p ON o.pre_define_packageID = p.packageID OR o.custom_packageID = p.packageID
    LEFT JOIN custom_package_item cpi ON o.custom_packageID = cpi.custom_packageID OR o.pre_define_packageID = cpi.custom_packageID
    LEFT JOIN item i ON cpi.itemID = i.itemID
    WHERE u.email = '$email' AND o.status = 'accepted' OR o.status = 'rescheduleAccepted'
    GROUP BY o.orderID";

$result = mysqli_query($conn, $sql);

echo '<div class="container my-4">
    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>Order ID</th>
                <th>Order Date</th>
                <th>Event Type</th>
                <th>Package Name</th>
                <th>Cost</th>
                <th>Items</th>
                <th>Invoice</th>
            </tr>
        </thead>
        <tbody>';

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        echo '<tr>
            <td>' . $row['orderID'] . '</td>
            <td>' . $row['orderDate'] . '</td>
            <td>' . $row['eventType'] . '</td>
            <td>' . $row['packageName'] . '</td>
            <td>' . $row['price'] . '</td>
            <td>' . $row['itemNames'] . '</td>
            
           <td>
                <form action="viewInvoice.php" method="GET" style="display: inline;">
                    <input type="hidden" name="orderID" value="' . $row['orderID'] . '">
                    <button type="submit" class="btn btn-success">Invoice</button>
                </form>
            </td>
        </tr>';
    }
}

echo '</tbody></table></div>';

?>

</body>
</html>
