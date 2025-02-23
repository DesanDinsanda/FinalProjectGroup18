<?php
include 'conf.php';
include 'classFAQ.php';

if (isset($_GET['faqID'])) {
    $faqID = $_GET['faqID'];

    // Create a new faq object
    $faq = new FAQ($conn);  
    // Call deleteFAQ() method from the 
    $message = $faq->deleteFAQ($faqID);

    echo "<script>alert('$message'); window.location='formAddFAQ.php';</script>";
} else {
    echo "No FAQ ID received";
}
?>
