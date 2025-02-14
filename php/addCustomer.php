<?php
include 'conf.php';  // Include database connection

// Include the Customer class
include 'classCustomer.php';

if (isset($_POST['addCustomerBtn'])) {
    // Get form values
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $email = $_POST['email'];
    $number = $_POST['number'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirmPassword'];

    // Create a new Customer object
    $customer = new Customer($conn);

    // Call the createAccount method
    if ($customer->createAccount($firstName,$lastName,$email,$password,$number)) {
        header("Location: ../html/login.html"); // Redirect to login page on success
        exit;
    } else {
        echo "Error: Unable to create account. Please try again.";
    }
}
?>

