<?php
include "conf.php";

$sql = "SELECT s.supplierID, s.firstName, s.lastName, s.email, s.province, s.city, s.streetName, t.telNO 
        FROM supplier s 
        LEFT JOIN supplier_telno t ON s.supplierID = t.supplierID";

$result = mysqli_query($conn, $sql);
include "adminNavbar.php";

echo '
<html>
<head>
<title>Manage Supplier Interface</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <link rel="stylesheet" href="../css/navbar.css">

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

    <script>
    function confirmDelete() {
    const confirmation = confirm("Are you sure you want to Delete this Supplier?");
    if (confirmation) {
      window.location.href = "formAddSuppliers.php"; // Redirect to logout if  is clicked
      return true;
    }
      return false;
    // If  is clicked, nothing happens and the user stays on the page
   }
    </script>
    
    
</head>
<body>

    <br><br><br><br><br>

    <h2 class="mb-4 text-center">Manage Suppliers</h2>
    <form action="addSupplier.php" method="POST" enctype="multipart/form-data" class="border rounded p-4 w-50 mx-auto form-container">
        <div class="mb-3">
            <label class="form-label fw-bold">First Name</label>
            <input type="text" class="form-control" name="firstName" required>
        </div>
        <div class="mb-3">
            <label class="form-label fw-bold">Last Name</label>
            <input type="text" class="form-control" name="lastName" required>
        </div>
        <div class="mb-3">
            <label class="form-label fw-bold">Telephone Number</label>
            <input type="text" class="form-control" name="telNO" required>
        </div>
        <div class="mb-3">
            <label class="form-label fw-bold">Email</label>
            <input type="email" class="form-control" name="email" required>
        </div>
        <div class="mb-3">
            <label class="form-label fw-bold">Province</label>
            <input type="text" class="form-control" name="province" required>
        </div>
        <div class="mb-3">
            <label class="form-label fw-bold">city</label>
            <input type="text" class="form-control" name="city" required>
        </div>
        <div class="mb-3">
            <label class="form-label fw-bold">Street Name</label>
            <input type="text" class="form-control" name="streetName" required>
        </div>
        <button type="submit" class="btn btn-primary" name="submitSupplier">Add Supplier</button>
    </form>

    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <table class="table table-bordered table-striped">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Telephone Number</th>
                            <th>Email</th>
                            <th>Province</th>
                            <th>City</th>
                            <th>Street Name</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>';

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        echo '
                        <tr>
                            <td>' . $row['supplierID'] . '</td>
                            <td>' . $row['firstName'] . '</td>
                            <td>' . $row['lastName'] . '</td>
                            <td>' . $row['telNO'] . '</td>
                            <td>' . $row['email'] . '</td>
                            <td>' . $row['province'] . '</td>
                            <td>' . $row['city'] . '</td>
                            <td>' . $row['streetName'] . '</td>
                            <td>
                                <a class="btn btn-info" href="editSupplier.php?supplierID=' . $row['supplierID'] . '">Edit</a>
                                <a class="btn btn-danger" onclick="return confirmDelete()" href="deleteSupplier.php?supplierID=' . $row['supplierID'] . '">Delete</a>
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
