<?php
include 'conf.php';

require_once 'classUser.php';

class Admin extends User {

    public function __construct($db) {
        parent::__construct($db);
    }
    public function createAccount($firstName, $lastName, $email, $password, $number) {
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->email = $email;
        $this->password = $password;
        $this->number = $number;
    
        $sql = "INSERT INTO user (firstName, lastName, email, password) VALUES ('$this->firstName','$this->lastName','$this->email','$this->password')";
    
        if (mysqli_query($this->conn, $sql)) { 
            // Get the last inserted ID
            $userID = mysqli_insert_id($this->conn);
            
            $sql2 = "INSERT INTO user_telno (ID, telNO) VALUES ('$userID', '$number')";

            $sql3 = "INSERT INTO admin (ID) VALUES ('$userID')";
    
            if (mysqli_query($this->conn, $sql2) && mysqli_query($this->conn, $sql3)) {  
                return true;
            } else {
                mysqli_query($this->conn, "DELETE FROM user WHERE ID = '$userID'");
                return false;
            }
        } else {
            return false; 
        }
    }

    public function deleteAdminAccount() {}
    public function selectType() {}
    public function viewAccount() {}
}
?>
