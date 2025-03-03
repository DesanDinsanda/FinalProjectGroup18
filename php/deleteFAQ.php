<?php
include 'conf.php';
include 'classFAQ.php';

if (isset($_GET['faqID'])) {
    $faqID = $_GET['faqID'];

    $faq = new FAQ($conn);  
     
    $message = $faq->deleteFAQ($faqID);

    echo "<script>alert('$message'); window.location='formAddFAQ.php';</script>";
} else {
    echo "No FAQ ID received";
}
?>
