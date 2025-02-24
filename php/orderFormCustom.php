<?php
session_start();
if (!isset($_SESSION['isOrderingCustom'])) {
    die("Error: No package selected.");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fill Event Details</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <link rel="stylesheet" href="../css/cre.css">
    <link rel="stylesheet" href="../css/ser.css">
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
</head>
<body>

    <div class="Wrapper">
        <h1>Fill Event Details</h1>

        <form action="orderCustomPackage.php" method="POST">
            <div class="input-box">
                <input type="text" placeholder="Location" name="evntLocation" required>
            </div>

            <div class="input-box">
                <input type="date" placeholder="Event Date" name="eventDate" required>
            </div>

            <div class="input-box">
                <input type="time" placeholder="Event Time" name="eventTime" required>
            </div>

            <?php if (isset($_SESSION['email'])): ?>
            <button type="submit" class="btn btn-primary" name="btnOrderCustom">Order</button>
            <?php else: ?>
            <button type="button" class="btn btn-secondary" disabled>Order (Login Required)</button>
            <?php endif; ?>
        </form>
    </div>

</body>
</html>
