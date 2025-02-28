<?php session_start(); ?>

<nav class="navbar fixed-top navbar-expand-lg bg-light shadow">
    <div class="container">
        <a class="navbar-brand" href="#">
        <img src="../images/dreamsFloraLogo.jpg" alt="Logo" width="85px" >
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item"><a class="nav-link active" href="customerHome.php">Home</a></li>
                <li class="nav-item"><a class="nav-link" href="aboutUs.php">About Us</a></li>
                <li class="nav-item"><a class="nav-link" href="service.php">Service</a></li>
                <li class="nav-item"><a class="nav-link" href="gallery.php">Gallery</a></li>
                <li class="nav-item"><a class="nav-link" href="mailto:dreamsevent@gmail.com">Contact Us</a></li>
                
                <!-- Cart Icon -->
                <li class="nav-item">
                    <a class="nav-link" href="viewItemsInCustomPackage.php">
                        <i class="fas fa-shopping-cart"></i>
                    </a>
                </li>
            </ul>

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

    <script src="../javascript/customerNotification.js"></script>


            <div class="ms-3">
                <?php if (!isset($_SESSION['email'])): ?>
                    <a href="../html/login.html" class="btn btn-dark me-2">Sign In</a>
                    <a href="../html/create.html" class="btn btn-outline-dark">Sign Up</a>
                <?php endif; ?>                    
            </div>

            <?php if(isset($_SESSION['email'])): ?>
                <!-- Profile Dropdown -->
                <li class="nav-item dropdown profile-container">
                    <a class="nav-link dropdown-toggle" href="#" id="profileDropdown" role="button" data-bs-toggle="dropdown">
                        <img src="../images/adminProfilePic.png" alt="Profile" class="profile-img">
                    </a>
                    <ul class="dropdown-menu dropdown-menu-custom" aria-labelledby="profileDropdown">
                        <li><a class="dropdown-item" href="customerProfile.php">Profile</a></li>
                        <li><a class="dropdown-item" href="customerOrders.php">My Orders</a></li>
                        <li><a class="dropdown-item" href="viewItemsInFavourite.php">Favorite</a></li>
                        <li><a class="dropdown-item" href="invoicePage.php">Invoice</a></li>
                        <li><a class="dropdown-item" href="logout.php">Logout</a></li>
                    </ul>
                </li>
            <?php endif; ?>
        </div>
    </div>
</nav>

<script src="https://kit.fontawesome.com/YOUR_KIT_CODE.js" crossorigin="anonymous"></script>
