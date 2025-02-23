<?php
include "conf.php";

// SQL query to get items
$sql = "SELECT * from item";

$result = mysqli_query($conn, $sql);

echo '
<html>
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

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

    <h1 class="text-center">Manage Items To Custom Package</h1>

    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <table class="table table-bordered table-striped">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Item Name</th>
                            <th>Item Type</th>
                            <th>Item Photo</th>
                            <th>Item Price</th>
                            <th>Item Stock</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>';

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        echo '
                        <tr>
                            <td>' . $row['itemID'] . '</td>
                            <td>' . $row['itemName'] . '</td>
                            <td>' . $row['itemEventType'] . '</td>
                            <td><img src="../uploads/' . $row['itemPhoto'] . '" width="100" height="100" alt="Item Image"></td>
                            <td>' . $row['itemPrice'] . '</td>
                            <td>' . $row['itemStock'] . '</td>
                            <td>
                                <a class="btn btn-info" href="addItemToWebsite.php?itemID=' . $row['itemID'] . '">Add</a>
                                <a class="btn btn-danger" href="removeItemsInWebsite.php?itemID=' . $row['itemID'] . '" onclick="return confirm(\'Are you sure you want to remove this item from custom package?\')">Delete</a>

                            </td>
                        </tr>';
    }
} else {
    echo '
                        <tr>
                            <td colspan="22" class="text-center">No packages found</td>
                        </tr>';
}

echo '
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</body>
</html>';
?>
