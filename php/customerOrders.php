<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <link rel="stylesheet" href="../css/customerHome.css">

    <script>
        var orderID = '';

        function confirmAction(orderId, action) {
            orderID = orderId; // Store the order ID

            if (action === 'cancel') {
                document.getElementById("confirmMessage").textContent = "Are you sure you want to cancel this order?";
                document.getElementById("confirmActionBtn").setAttribute("data-action", "cancel");
            } else if (action === 'reject') {
                document.getElementById("confirmMessage").textContent = "Are you sure you want to reschedule this order?";
                document.getElementById("confirmActionBtn").setAttribute("data-action", "reject");
            }

            // Show the Bootstrap modal
            var confirmModal = new bootstrap.Modal(document.getElementById("confirmModal"));
            confirmModal.show();
        }

        function performAction() {
            var action = document.getElementById("confirmActionBtn").getAttribute("data-action");

            if (action === "cancel") {
                window.location.href = "customerCancellOrder.php?orderID=" + orderID;
            } else if (action === "reject") {
                window.location.href = "rescheduleOrderForm.php?orderID=" + orderID;
            }
        }
    </script>
</head>
<body>
    <?php include 'customerNavbar.php'; ?>
    
    <br><br><br><br><br><br>
    <h2 class="text-center text-primary"><b>All Orders</b></h2>

    <?php
    include 'conf.php';
    include 'classOrders.php';

    $orders = new Orders($conn);
    $orders->viewOrderStatus();
    ?>

    <!-- Modal -->
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
                    <button id="confirmActionBtn" class="btn btn-success" onclick="performAction()">Yes, Proceed</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
