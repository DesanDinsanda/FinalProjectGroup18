<!DOCTYPE html>
<html>
<head>
    <title>Pre define package Interface</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <link rel="stylesheet" href="../css/customerHome.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

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
/* Comment Box Styling */
.comment-box {
    background: white;
    border-radius: 10px;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    padding: 20px;
}

/* User Profile Icon */
.user-icon {
    width: 40px;
    height: 40px;
    border-radius: 50%;
}

/* Comment Input */
#reviewText {
    flex-grow: 1;
    height: 40px;
    border-radius: 20px;
    padding: 10px;
    border: 1px solid #ccc;
    outline: none;
    transition: all 0.3s ease;
}

#reviewText:focus {
    border-color: #007bff;
}

/* Comment Button */
.comment-btn {
    display: block;
    margin-left: auto;
    background-color: #007bff;
    border-radius: 20px;
    padding: 8px 20px;
    font-weight: bold;
    transition: all 0.3s ease;
}

.comment-btn:hover {
    background-color: #0056b3;
}

/* Individual Comment */
.comment {
    background: #f8f9fa;
    border-radius: 10px;
    padding: 10px;
    margin-top: 10px;
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

    <?php
include 'conf.php';

$sql = "SELECT r.reviewID, r.reviewDiscription, r.reviewDate, u.firstName, u.lastName 
        FROM review r 
        JOIN user u ON r.customerID = u.ID 
        ORDER BY r.reviewDate DESC";
$result = $conn->query($sql);
?>

<div class="container mt-4">
    <div class="comment-box p-4">
        <h5><?php echo $result->num_rows; ?> Comments</h5>
        <div class="mb-3 d-flex align-items-center">
            <textarea id="reviewText" class="form-control" placeholder="Add a comment..."></textarea>
        </div>
        <?php if (isset($_SESSION['email'])): ?>
        <button type="submit" class="btn btn-primary comment-btn" id="addReviewBtn">Comment</button>
        <?php else: ?>
        <button type="button" class="btn btn-secondary comment-btn" id="addReviewBtn" disabled>Comment (Login Required)</button>
        <?php endif; ?>

        <div id="reviewSection" class="mt-4">
            <?php while ($row = $result->fetch_assoc()): ?>
                <div class="comment">
                    <div class="d-flex align-items-center">
                        <div>
                            <strong>@<?php echo htmlspecialchars($row['firstName'] . " " . $row['lastName']); ?></strong> 
                            <span class="text-muted small"> <?php echo date("Y-m-d", strtotime($row['reviewDate'])); ?> </span>
                        </div>
                    </div>
                    <p class="mt-2"><?php echo htmlspecialchars($row['reviewDiscription']); ?></p>
                </div>
            <?php endwhile; ?>
        </div>
    </div>
</div>


<script>
$(document).ready(function () {
    $("#addReviewBtn").click(function () {
        let reviewText = $("#reviewText").val().trim();
        if (reviewText === "") {
            alert("Please enter a review!");
            return;
        }

        $.post("addReview.php", { review: reviewText }, function (response) {
            alert(response);
            location.reload(); 
        });
    });
});
</script>

    <?php include 'footer.php'  ?>

</body>
</html>
