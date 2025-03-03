<?php
include 'conf.php';
include 'classFAQ.php';

$faq = new FAQ($conn);

// Fetch all FAQs
$faqs = $faq->viewFAQ();
?>

<!DOCTYPE html>
<html>
<head>
    <title>FAQ Interface</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <link rel="stylesheet" href="../css/navbar.css">
    <style>
        .accordion-item {
            background-color: #fdecf6;
            border-radius: 10px;
            margin-bottom: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
        }
        .accordion-button {
            background-color:rgb(252, 236, 237);
            font-weight: bold;
        }
        .accordion-button:focus {
            box-shadow: none;
        }
        body{
        background-color: #fcf6ec;  
        }
    </style>
</head>
<body>
<?php include "customerNavbar.php"?>
<br><br><br><br><br>

    <div class="container mt-5">
        <h2 class="text-center">Frequently Asked Questions</h2>

        <div class="accordion mt-4" id="faqAccordion">
            <?php if (!empty($faqs)): ?>
                <?php foreach ($faqs as $index => $faq): ?>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="heading<?php echo $index; ?>">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse<?php echo $index; ?>" aria-expanded="false" aria-controls="collapse<?php echo $index; ?>">
                                <?php echo htmlspecialchars($faq['question']); ?>
                            </button>
                        </h2>
                        <div id="collapse<?php echo $index; ?>" class="accordion-collapse collapse" aria-labelledby="heading<?php echo $index; ?>" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                <?php echo htmlspecialchars($faq['answer']); ?>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p class="text-center">No FAQs available.</p>
            <?php endif; ?>
        </div>
    </div>

    <?php include 'footer.php'  ?>

</body>
</html>
