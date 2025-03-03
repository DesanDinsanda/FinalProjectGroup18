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

    $hashedPwd = password_hash($password, PASSWORD_BCRYPT);
    $customer = new Customer($conn);

    if ($customer->createAccount($firstName,$lastName,$email,$hashedPwd,$number)) {
        header("Location: ../html/login.html"); 
        exit;
    } else {
        echo "Error: Unable to create account. Please try again.";
    }
}
?>

