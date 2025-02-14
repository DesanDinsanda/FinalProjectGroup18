<?php
include 'conf.php'; // Include your database connection file
include 'classUser.php';

if (isset($_POST['loginBtn'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];


    $user = new user($conn);
    $user->logIn($email, $password);

}
?>