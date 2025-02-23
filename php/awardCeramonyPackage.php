<!DOCTYPE html>
<html>
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <style>

body {
    background-color: #ffffe6;
}

/* Card Hover Effects */
.card-hover {
    border-radius: 15px; /* Rounded corners */
    overflow: hidden; /* Ensures smooth hover effect */
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.card-hover:hover {
    transform: translateY(-10px); /* Slight lift effect */
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2); /* Stronger shadow */
    background-color:#ffe6e6; /* Light background on hover */
}

/* Button Hover Effect */
.btn-hover {
    transition: background-color 0.3s ease, transform 0.2s ease;
}

.btn-hover:hover {
    background-color: #0056b3 !important; /* Darker blue on hover */
    transform: scale(1.05); /* Slightly bigger on hover */
}

    </style>

</head>
<body>
    <h1 class="text-center">Our Ongoing Award ceramony Packages</h1>
    <h6 class="text-center mt-4">Select your package and celebrate your wedding. We can customize anything if you want. All are including best service and with well planed budget</h6>
    <div class="card-container">
        <?php include 'fetchAwardCeremonyDetails.php'; ?>
    </div>

</body>
</html>
