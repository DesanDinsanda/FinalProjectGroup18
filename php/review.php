<?php
include 'conf.php';

$sql = "SELECT r.reviewID, r.reviewDiscription, r.reviewDate, u.firstName, u.lastName 
        FROM review r 
        JOIN user u ON r.customerID = u.ID 
        ORDER BY r.reviewDate DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Review Section</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
<div class="container mt-4">
    <h5><?php echo $result->num_rows; ?> Comments</h5>
    <div class="mb-3">
        <textarea id="reviewText" class="form-control" placeholder="Add a comment..."></textarea>
        <button class="btn btn-primary mt-2" id="addReviewBtn">Comment</button>
    </div>
    <div id="reviewSection">
        <?php while ($row = $result->fetch_assoc()): ?>
            <div class="border-bottom p-2">
                <strong>@<?php echo htmlspecialchars($row['firstName'] . $row['lastName']); ?></strong> 
                <span class="text-muted"> <?php echo date("Y-m-d", strtotime($row['reviewDate'])); ?> </span>
                <p><?php echo ($row['reviewDiscription']); ?></p>
            </div>
        <?php endwhile; ?>
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

</body>
</html>
