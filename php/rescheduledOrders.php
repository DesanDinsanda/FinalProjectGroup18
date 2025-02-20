<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rescheduled orders</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <link rel="stylesheet" href="../css/navbar.css">
    
    
</head>
<body>
<?php include 'navbar.php'; ?>

<br><br><br><br><br><br>
<h2 class="text-center text-primary"><b>Rescheduled Orders</b></h2>
<?php
include 'conf.php';
include 'classOrders.php';

echo <<<HTML
    
            <html>
            <head>
            <title>Rescheduled Orders</title>
            <script>
        var actionType = '';

        function confirmAction(orderId, action) {
            actionType = action; // Store the action (accept or reject)

            // Set the confirm button's href based on the action
            if (action === 'accept') {
                document.getElementById("confirmActionBtn").href = "acceptRescheduleOrder.php?orderID=" + orderId;
            } else if (action === 'reject') {
                document.getElementById("confirmActionBtn").href = "rejectRescheduleOrder.php?orderID=" + orderId;
            }

            // Show the Bootstrap modal
            var confirmModal = new bootstrap.Modal(document.getElementById("confirmModal"));
            confirmModal.show();
        }
    </script>
            </head>
            <body>
                <div class="container my-4">
            <table class="table table-bordered table-striped">
                <thead class="table-dark">
                    <tr>
                        <th>Order ID</th>
                        <th>Order Date</th>
                        <th>Status</th>
                        <th>Event Date</th>
                        <th>Event Time</th>
                        <th>Event Location</th>
                        <th>Event Type</th>
                        <th>Package Name</th>
                        <th>Cost</th>
                        <th>First Name</th>
                        <th>Number</th>
                        <th>items</th>
                        <th>Action</th>
                        
                    </tr>
                </thead>
                <tbody>
    HTML;
    

$orders = new Orders($conn);
$orders->viewRescheduleOrders();


echo <<<HTML
<!-- Bootstrap Modal for Confirming Action -->
    <div class="modal fade" id="confirmModal" tabindex="-1" aria-labelledby="confirmModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-warning">
                    <h5 class="modal-title" id="confirmModalLabel">Confirm Action</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center">
                    <p class="fs-5" id="confirmMessage">Are you sure you want to perform this action?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <a id="confirmActionBtn" class="btn btn-success">Yes, Proceed</a>
                </div>
            </div>
        </div>
    </div>
HTML;

echo <<<HTML
                </tbody>
            </table>
        </div> 
            </body>
            </html>
    HTML;


?>
</body>
</html>
