<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <link rel="stylesheet" href="../css/navbar.css">
    
    <style>
        /* General Dropdown Styling */
        .dropdown-menu-custom {
            background: rgb(249, 244, 233);
            border: 1px solid black;
            min-width: 150px;
            text-align: left;
        }

        .dropdown-menu-custom a {
            display: block;
            padding: 8px 15px;
            text-decoration: none;
            color: black;
            transition: 0.3s;
        }

        .dropdown-menu-custom a:hover {
            background: #f8d775; /* Highlight color */
            color: black;
        }

        /* Orders Dropdown */
        .nav-item.dropdown:hover .dropdown-menu {
            display: block;
        }

        /* Calendar Icon */
        .calendar-img {
            width: 30px;
            height: auto;
            margin: 0 15px;
            cursor: pointer;
            transition: transform 0.2s;
        }

        .calendar-img:hover {
            transform: scale(1.1);
        }

        /* Profile Dropdown */
        .profile-container {
            position: relative;
        }

        .profile-img {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            cursor: pointer;
        }

        .nav-item.dropdown.profile-container:hover .dropdown-menu {
            display: block;
        }
       
        


    </style>
</head>
<body>
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
                <li class="nav-item"><a class="nav-link active" href="#">Customers</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Inventory</a></li>
                
                <!-- Orders Dropdown -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="ordersDropdown" role="button" data-bs-toggle="dropdown">
                        Orders
                    </a>
                    <ul class="dropdown-menu dropdown-menu-custom" aria-labelledby="ordersDropdown">
                        <li><a class="dropdown-item" href="#">All Orders</a></li>
                        <li><a class="dropdown-item" href="#">Pending Orders</a></li>
                        <li><a class="dropdown-item" href="#">Cancelled Orders</a></li>
                        <li><a class="dropdown-item" href="#">Rescheduled Orders</a></li>
                    </ul>
                </li>

                <li class="nav-item"><a class="nav-link" href="#">Suppliers</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Report</a></li>
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
                        <li><a class="dropdown-item" href="#">Profile</a></li>
                        <li><a class="dropdown-item" href="#">Orders</a></li>
                        <li><a class="dropdown-item" href="#">Logout</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
