<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fill Event Details</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="../css/customerHome.css">
    <link rel="stylesheet" href="../css/cre.css">
    <link rel="stylesheet" href="../css/ser.css">
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">


</head>
<body>

<?php include 'customerNavbar.php'; ?>

    <br><br><br><br><br><br><br><br><br><br><br><br>

    <div class="Wrapper">

                    <br><br><br>

        <form action="customerRescheduleOrder.php" method="POST">
            <h1>Reschedule Order</h1>
            
            <?php
            $orderID = isset($_GET['orderID']) ? $_GET['orderID'] : '';
            ?>
            
            <div class="input-box">
            <input type="hidden" name="id" value="<?php echo ($orderID); ?>" readonly>
            </div>
            
            <div class="input-box">
                <input type="text" placeholder="Location" name="evntLocation" required>
            </div>
            <div class="input-box">
                <input type="date" placeholder="Event Date" name="eventDate" required>
            </div>
            <div class="input-box">
                <input type="time" placeholder="Event Time" name="eventTime" required>
            </div>
            
            <button type="submit" class="btn" name="btnOrder">Rescedule</button>
            
        </form>
    </div>


    
</body>
</html>



