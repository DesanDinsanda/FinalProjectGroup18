<?php
include 'conf.php';
include 'classFAQ.php';

if (isset($_POST['submitFAQ'])) {
    
    $faq = new FAQ($conn);

    
    $question = $_POST['question'];
    $answer = $_POST['answer'];

    $message = $faq->addFAQ($question, $answer);

    echo "<script>alert('$message'); window.location='formAddFAQ.php';</script>";
} else {
    echo "No data received";
}
?>
