<?php
session_start();
include "conf.php";
include 'classPackage.php';
include "classCustom_package.php"; 

$customPackage = new CustomPackage($conn);
$itemEventType = "Wedding"; // Change dynamically if needed
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Custom Package</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <style>
        body { background-color: #fcf6ec; }
        .card-hover { border-radius: 15px; transition: transform 0.3s ease, box-shadow 0.3s ease; }
        .card-hover:hover { transform: translateY(-10px); box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2); background-color: #ffe6e6; }
    </style>

    <script>
    function increaseQuantity(inputID) {
        let input = document.getElementById(inputID);
        input.value = parseInt(input.value) + 1;
    }

    function decreaseQuantity(inputID) {
        let input = document.getElementById(inputID);
        if (input.value > 1) {
            input.value = parseInt(input.value) - 1;
        }
    }
    </script>

        <script>
            function searchItems() {
                let input = document.getElementById("searchBar").value.toLowerCase();
                let cards = document.querySelectorAll(".item-card");
                cards.forEach(card => {
                    let title = card.querySelector(".card-title").innerText.toLowerCase();
                    card.style.display = title.includes(input) ? "block" : "none";
                });
            }

            function updateHiddenQuantity(itemID) {
                let inputQty = document.getElementById("qty_" + itemID).value;
                document.getElementById("hidden_qty_" + itemID).value = inputQty;
            }
        </script>


</head>
<body>
    <h2 class="text-center mt-4">Custom Package for <?php echo $itemEventType; ?></h2>

    <?php
    // Call the method to display items
    $customPackage->viewCustomPackage($itemEventType);
    ?>

    <div class="d-flex justify-content-center mt-4">
        <button type="button" class="btn btn-primary btn-hover" onclick="window.location.href='viewItemsInCustomPackage.php'">View Custom Package</button>
    </div>

</body>
</html>
