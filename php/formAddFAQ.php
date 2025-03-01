<?php
include "conf.php";

// SQL query to get items
$sql = "SELECT * FROM faq";

$result = mysqli_query($conn, $sql);
include "adminNavbar.php";

echo '
<html>
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <link rel="stylesheet" href="../css/navbar.css">

    <style>
    .form-container {
    background-color: #fdecf6;  /* Red background */
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
    }

    body{
    background-color: #fcf6ec;  
    }

    </style>
    
    <script>
    function confirmDelete() {
    const confirmation = confirm("Are you sure you want to Delete this FAQ?");
    if (confirmation) {
      window.location.href = "formAddFAQ.php"; // Redirect to logout if  is clicked
      return true;
    }
      return false;
    // If  is clicked, nothing happens and the user stays on the page
   }
    </script>
    
    
</head>
<body>

<br><br><br><br><br>

    <h2 class="mb-4 text-center">Manage FAQ</h2>
    <form action="addFAQ.php" method="POST" enctype="multipart/form-data" class="border rounded p-4 w-50 mx-auto form-container">
        <div class="mb-3">
            <label class="form-label fw-bold">Question</label>
            <textarea class="form-control" name="question" rows="2" required></textarea>
        </div>
        <div class="mb-3">
            <label class="form-label fw-bold">Answer</label>
            <textarea class="form-control" name="answer" rows="5" required></textarea>
        </div>
        
        <button type="submit" class="btn btn-primary" name="submitFAQ">Add FAQ</button>
    </form>

    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <table class="table table-bordered table-striped">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Question</th>
                            <th>Answer</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>';

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        echo '
                        <tr>
                            <td>' . $row['faqID'] . '</td>
                            <td>' . $row['question'] . '</td>
                            <td>' . $row['answer'] . '</td>
                            <td>
                                <a class="btn btn-info" href="editFAQ.php?faqID=' . $row['faqID'] . '">Edit</a>
                                <a class="btn btn-danger" onclick="return confirmDelete()" href="deleteFAQ.php?faqID=' . $row['faqID'] . '">Delete</a>
                            </td>
                        </tr>';
    }
} else {
    echo '
                        <tr>
                            <td colspan="22" class="text-center">No packages found</td>
                        </tr>';
}

echo '
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</body>
</html>';
?>
