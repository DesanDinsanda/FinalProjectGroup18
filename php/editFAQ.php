<?php
include 'conf.php';
include 'classFAQ.php';

if (isset($_GET['faqID'])) {
    // Create a new FAQ object
    $faq = new FAQ($conn);

    // Get faqID from URL
    $faqID = $_GET['faqID'];

    // Fetch FAQ details
    $faqDetails = $faq->getFAQDetails($faqID);

    if (!$faqDetails) {
        echo "FAQ not found!";
        exit;
    }
}

if (isset($_POST['submit'])) {
    // Collect form data
    $question = $_POST['question'];
    $answer = $_POST['answer'];

    // Create a new FAQ object
    $faq = new FAQ($conn);

    // Call editFAQ method
    $message = $faq->editFAQ($faqID, $question, $answer);

    // Display success message and redirect
    echo "<script>alert('$message'); window.location='formAddFAQ.php';</script>";
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit FAQ</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <link rel="stylesheet" href="../css/navbar.css">

    <style>
    .form-container {
        background-color: #fdecf6;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
    }
    body {
        background-color: #fcf6ec;
    }
    </style>
</head>
<body>
<?php include "adminNavbar.php"?>
<br><br><br><br><br>
    <h2 class="text-center mt-4">Edit FAQ</h2>
    <form method="POST" action="" class="border rounded p-4 w-50 mx-auto form-container">
        <div class="mb-3">
            <label class="form-label fw-bold">Question</label>
            <textarea class="form-control" name="question" rows="2" required><?php echo ($faqDetails['question']); ?></textarea>
        </div>
        <div class="mb-3">
            <label class="form-label fw-bold">Answer</label>
            <textarea class="form-control" name="answer" rows="5" required><?php echo ($faqDetails['answer']); ?></textarea>
        </div>

        <button type="submit" class="btn btn-success" name="submit">Update FAQ</button>
    </form>
</body>
</html>
