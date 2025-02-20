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
                <li class="nav-item"><a class="nav-link" href="viewCustomerReviews.php">Review</a></li>

                <!-- Calendar Icon -->
                <li class="nav-item">
                    <a class="nav-link" href="calendar.php">
                        <img src="../images/calendar.png" alt="Calendar" class="calendar-img">
                    </a>
                </li>
               <!-- Bell icon -->
<li class="nav-item dropdown">
    <a class="nav-link" href="#" id="notification-bell" role="button" data-bs-toggle="dropdown">
        <img src="../images/bell.png" alt="bell" class="calendar-img">
        <span id="notification-count" class="badge bg-danger" style="position: absolute; top: 5px; right: 5px; display: none;"></span>
    </a>
    <ul class="dropdown-menu dropdown-menu-custom" id="notification-dropdown" aria-labelledby="notification-bell">
        <li class="dropdown-item">Loading...</li>
    </ul>
</li>

<script src="notifications.js"></script>




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