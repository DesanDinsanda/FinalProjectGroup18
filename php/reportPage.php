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
<nav class="navbar fixed-top navbar-expand-lg bg-light shadow">
    <div class="container">
        <a class="navbar-brand" href="#">
            <img src="../images/dreamsFloraLogo.jpg" alt="Logo" width="80px" >
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item"><a class="nav-link active" href="eventManagerHome.php">Customers</a></li>
                <li class="nav-item"><a class="nav-link" href="viewInventoryLevel.php">Inventory</a></li>
                
                <!-- Orders Dropdown -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="ordersDropdown" role="button" data-bs-toggle="dropdown">
                        Orders
                    </a>
                    <ul class="dropdown-menu dropdown-menu-custom" aria-labelledby="ordersDropdown">
                        <li><a class="dropdown-item" href="allOrders.php">All Orders</a></li>
                        <li><a class="dropdown-item" href="pendingOrders.php">Pending Orders</a></li>
                        <li><a class="dropdown-item" href="cancelledOrders.php">Cancelled Orders</a></li>
                        <li><a class="dropdown-item" href="rescheduledOrders.php">Rescheduled Orders</a></li>
                    </ul>
                </li>

                <li class="nav-item"><a class="nav-link" href="supplier.php">Suppliers</a></li>
                <li class="nav-item"><a class="nav-link" href="reportPage.php">Report</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Review</a></li>

                <!-- Calendar Icon -->
                <li class="nav-item">
                    <a class="nav-link" href="#">
                        <img src="../images/calendar.png" alt="Calendar" class="calendar-img">
                    </a>
                </li>
                <!-- Bell icon -->
                <li class="nav-item">
                    <a class="nav-link" href="#">
                        <img src="../images/bell.png" alt="bell" class="calendar-img">
                    </a>
                </li>

                <!-- Profile Dropdown -->
                <li class="nav-item dropdown profile-container">
                    <a class="nav-link dropdown-toggle" href="#" id="profileDropdown" role="button" data-bs-toggle="dropdown">
                        <img src="../images/adminProfilePic.png" alt="Profile" class="profile-img">
                    </a>
                    <ul class="dropdown-menu dropdown-menu-custom" aria-labelledby="profileDropdown">
                        <li><a class="dropdown-item" href="eventManagerProfile.php">Profile</a></li>
                        <li><a class="dropdown-item" href="favoriteSupplier.php">Favorite Suppliers</a></li>
                        <li><a class="dropdown-item" href="logout.php">Logout</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<br><br><br><br><br><br>
<!-- <div class="container mt-5 pt-5">
    <h2 class="text-center">Generate Report</h2>
    <form method="POST" action="generateReport.php">
        <div class="mb-3">
            <label for="reportType" class="form-label">Select Report Type</label>
            <select class="form-select" id="reportType" name="reportType" required>
                <option value="">-- Select --</option>
                <option value="customer">Customer Data</option>
                <option value="supplier">Supplier Data</option>
                <option value="item">Item Details</option>
                <option value="order">Order Details</option>
            </select>
        </div>
        <button type="submit" name="generate" class="btn btn-primary">Generate</button>
    </form>
</div> -->
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
