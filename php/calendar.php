calendar.php

<?php
// Database connection
include 'conf.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calendar Interface</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <link rel="stylesheet" href="../css/navbar.css">
    <!-- FullCalendar CSS and JS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.js"></script>
    <style>
        #calendar {
    max-width: 700px; 
    margin: 20px auto;
    font-size: 0.9em; 
    
    }
    .fc-view-container {
    max-height: 400px; 
    overflow-y: auto;
    }

        #eventTable {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        #eventTable th, #eventTable td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        #eventTable th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <?php include 'navbar.php'; ?>
    <br><br><br><br>
    <?php
    include 'conf.php';
    include 'classCalendar.php';

    $calendar = new Calendar($conn);
    $calendar->viewCalendar();
    
    ?>
    
</body>
</html>
