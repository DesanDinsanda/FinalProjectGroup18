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
<body >
<?php include 'navbar.php'; ?>

<br><br><br><br><br><br>

<div class="container mt-5 pt-5">
        <div class="card shadow p-4">
            <h3 class="text-center mb-4">Generate Reports</h3>
            <form method="POST" action="generateReport.php">
            
            <div class="mb-3">
                <label for="reportType" class="form-label">Select Report Type:</label>
                <select class="form-select" id="reportType" name = "reportType" >
                    <option value="customer">Customer Data</option>
                    <option value="supplier">Supplier Data</option>
                    <option value="item">Item Details</option>
                    <option value="order">Order Details</option>
                </select>
            </div>
            
            <div class="text-center">
                <button type="submit" name="generate" class="btn btn-primary" >
                    <i class="fas fa-file-alt"></i> Generate Report
                </button>
            </div>
        </div>

        <div class="mt-4" id="reportResult"></div>
    </div>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    </form>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
