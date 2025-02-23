<?php
include 'conf.php';
include 'classFAQ.php';

if (isset($_POST['submitFAQ'])) {
    // Create a new FAQ object
    $faq = new FAQ($conn);

    // Set faq details 
    $question = $_POST['question'];
    $answer = $_POST['answer'];

    $message = $faq->addFAQ($question, $answer);

    echo "<script>alert('$message'); window.location='formAddFAQ.php';</script>";
} else {
    echo "No data received";
}
?>
