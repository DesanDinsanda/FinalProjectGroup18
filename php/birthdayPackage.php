<!DOCTYPE html>
<html>
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <link rel="stylesheet" href="../css/customerHome.css">
    <style>

body {
    background-color: #ffffe6;
}

.card-hover {
    border-radius: 15px;
    overflow: hidden; 
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.card-hover:hover {
    transform: translateY(-10px); 
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2); 
    background-color:#ffe6e6;
}

.btn-hover {
    transition: background-color 0.3s ease, transform 0.2s ease;
}

.btn-hover:hover {
    background-color: #0056b3 !important;
    transform: scale(1.05); 
}
.btn-hover {
    transition: background-color 0.3s ease, transform 0.2s ease;
}

.btn-hover:hover {
    background-color: #0056b3 !important;
    transform: scale(1.05); 
}

.custom-btn {
            background: linear-gradient(135deg, #ff758c, #ff7eb3);
            border: none;
            padding: 12px 25px;
            border-radius: 30px;
            color: white;
            font-size: 18px;
            font-weight: bold;
            transition: all 0.3s ease;
            box-shadow: 0 4px 10px rgba(255, 118, 136, 0.3);
        }

        .custom-btn:hover {
            transform: scale(1.1);
            box-shadow: 0 6px 15px rgba(255, 118, 136, 0.5);
        }

    </style>
    <link rel="stylesheet" href="../css/customerHome.css">

</head>
<body>
    <?php include "customerNavbar.php"  ?>
    <br><br><br><br><br>
    

    <div class="container text-center my-5">
        <h1 class="fw-bold">Our Ongoing Birthday Packages</h1>
        <h6 class="mt-3">
            Select your package and celebrate your Birthday. We can customize anything if you want.
            All are including best service and with well-planned budget.
        </h6>

        <h2 class="mt-4">Want a Custom Package?</h2>
        <button type="button" class="custom-btn mt-3" onclick="window.location.href='fetchCartBirthdayPackageItems.php'">
            Create Custom Package
        </button>
    </div>

    <div class="card-container">
        <?php include 'fetchBirthdayDetails.php'; ?>
    </div>

    <?php include 'footer.php'  ?>

</body>
</html>
