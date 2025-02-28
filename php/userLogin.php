<?php
include 'conf.php'; 
include 'classUser.php';

if (isset($_POST['loginBtn'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];


    $user = new user($conn);
    $user->logIn($email, $password);

}
?>