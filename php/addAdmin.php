<?php
include 'conf.php';  

include 'classAdmin.php';

if (isset($_POST['addAdminBtn'])) {
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $email = $_POST['email'];
    $number = $_POST['number'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirmPassword'];

    $hashedPwd = password_hash($password, PASSWORD_BCRYPT);

    $admin = new Admin($conn);

    if ($admin->createAccount($firstName,$lastName,$email,$hashedPwd,$number)) {
        header("Location: adminHome.php"); 
        exit;
    } else {
        echo "Error: Unable to create account. Please try again.";
    }
}
?>

