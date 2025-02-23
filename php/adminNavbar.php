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
                <li class="nav-item"><a class="nav-link active" href="adminHome.php">Users</a></li>
                
                <!-- Package Dropdown -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="ordersDropdown" role="button" data-bs-toggle="dropdown">
                        Packages
                    </a>
                    <ul class="dropdown-menu dropdown-menu-custom" aria-labelledby="ordersDropdown">
                        <li><a class="dropdown-item" href="formAdd_P_Package.php">Predefine Package</a></li>
                        <li><a class="dropdown-item" href="cartItems.php">Custom Package</a></li>
                        
                    </ul>
                </li>

                <li class="nav-item"><a class="nav-link" href="formAddItems.php">Items</a></li>
                <li class="nav-item"><a class="nav-link" href="formAddSuppliers.php">Suppliers</a></li>
                <li class="nav-item"><a class="nav-link" href="#">FAQ</a></li>

               

                <!-- Profile Dropdown -->
                <li class="nav-item dropdown profile-container">
                    <a class="nav-link dropdown-toggle" href="#" id="profileDropdown" role="button" data-bs-toggle="dropdown">
                        <img src="../images/adminProfilePic.png" alt="Profile" class="profile-img">
                    </a>
                    <ul class="dropdown-menu dropdown-menu-custom" aria-labelledby="profileDropdown">
                        <li><a class="dropdown-item" href="adminProfile.php">Profile</a></li>
                        <li><a class="dropdown-item" href="../html/createAdminAccount.html">Create </a></li>
                        <li><a class="dropdown-item" href="logout.php">Logout</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>