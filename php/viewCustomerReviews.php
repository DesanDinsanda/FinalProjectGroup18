<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Review Interface</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <link rel="stylesheet" href="../css/navbar.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    
</head>
<body>
<?php include 'navbar.php'; ?>
    <br><br><br><br><br><br>

<h2 class="text-center text-primary"><b>Customer Reviews</b></h2>
<?php
include 'conf.php';
include 'classReview.php';

$review = new Review($conn);
$review->viewCustomerReviews();

?>
</body>
</html>
