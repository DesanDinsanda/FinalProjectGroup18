<?php
include 'conf.php';
class Customer {
    private $conn;
    private $firstName;
    private $lastName;
    private $email;
    private $number;
    private $password;
    private $confirmPassword;

    public function __construct($db) {
        $this->conn = $db;
    }

    // Getters and setters
    public function getFirstName() { return $this->firstName; }
    public function setFirstName($firstName) { $this->firstName = $firstName; }

    public function getLastName() { return $this->lastName; }
    public function setLastName($lastName) { $this->lastName = $lastName; }

    public function getEmail() { return $this->email; }
    public function setEmail($email) { $this->email = $email; }

    public function getNumber() { return $this->number; }
    public function setNumber($number) { $this->number = $number; }

    public function getPassword() { return $this->password; }
    public function setPassword($password) { $this->password = $password; }

    public function getConfirmPassword() { return $this->confirmPassword; }
    public function setConfirmPassword($confirmPassword) { $this->confirmPassword = $confirmPassword; }

    // Method to create an account
    public function createAccount($firstName, $lastName, $email, $password, $number) {
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->email = $email;
        $this->password = $password;
        $this->number = $number;
    
        // Insert into user table first
        $sql = "INSERT INTO user (firstName, lastName, email, password) VALUES ('$firstName','$lastName','$email','$password')";
    
        if (mysqli_query($this->conn, $sql)) {  // Use $this->conn
            // Get the last inserted ID
            $userID = mysqli_insert_id($this->conn);
            
            // Now insert into user_telno using the retrieved user ID
            $sql2 = "INSERT INTO user_telno (ID, telNO) VALUES ('$userID', '$number')";
    
            if (mysqli_query($this->conn, $sql2)) {  // Use $this->conn
                return true; // Both inserts succeeded
            } else {
                // Rollback the first insert if second fails (manual rollback)
                mysqli_query($this->conn, "DELETE FROM user WHERE ID = '$userID'");
                return false;
            }
        } else {
            return false; // First query failed
        }
    }
    
    
}
?>
