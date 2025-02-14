<?php
include 'conf.php';

class User {
    protected $conn;
    protected $firstName;
    protected $lastName;
    protected $id;
    protected $email;
    protected $password;
    protected $telNO;


    
    public function __construct($db) {
        $this->conn = $db;
    }
    // Getters and Setters
    public function getFirstName() { return $this->firstName; }
    public function setFirstName($firstName) { $this->firstName = $firstName; }

    public function getLastName() { return $this->lastName; }
    public function setLastName($lastName) { $this->lastName = $lastName; }

    public function getId() { return $this->id; }
    public function setId($id) { $this->id = $id; }

    public function getEmail() { return $this->email; }
    public function setEmail($email) { $this->email = $email; }

    public function getPassword() { return $this->password; }
    public function setPassword($password) { $this->password = $password; }

    public function getTelNO() { return $this->telNO; }
    public function setTelNO($telNO) { $this->telNO = $telNO; }

    public function logIn() {}
    public function logOut() {}
    public function resetPassword() {}
    public function updateAccount() {}
    public function validateEmail() {}
    public function validatePassword() {}
    public function selectResetPassword() {}
    public function selectAccount() {}

    
}
?>
