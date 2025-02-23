<?php
session_start();
include 'conf.php';
include 'classPackage.php';
include "classCustom_package.php";

$customPackage = new CustomPackage($conn);

// Call the method to display the favourite items
$customPackage->viewItemsInFavourite();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    <style>
        body { background-color: #fcf6ec; }
        .card-hover { border-radius: 15px; transition: transform 0.3s ease, box-shadow 0.3s ease; }
        .card-hover:hover { transform: translateY(-10px); box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2); background-color: #ffe6e6; }
    </style>
</head>
<body>
    
</body>
</html>