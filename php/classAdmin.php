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
    
        // Check if email already exists
        $checkEmailSQL = "SELECT ID FROM user WHERE email = '$this->email'";
        $checkEmailResult = mysqli_query($this->conn, $checkEmailSQL);
    
        if (mysqli_num_rows($checkEmailResult) > 0) {
            // Email exists, show an alert and exit
            echo "<script>alert('Email already exists'); window.location='../html/createAdminAccount.html';</script>";
            return false;
        }
    
        // Insert into user table
        $sql = "INSERT INTO user (firstName, lastName, email, password) 
                VALUES ('$this->firstName','$this->lastName','$this->email','$this->password')";
    
        if (mysqli_query($this->conn, $sql)) { 
            // Get the last inserted ID
            $userID = mysqli_insert_id($this->conn);
            
            // Insert into user_telno table
            $sql2 = "INSERT INTO user_telno (ID, telNO) VALUES ('$userID', '$number')";
    
            // Insert into admin table
            $sql3 = "INSERT INTO admin (ID) VALUES ('$userID')";
    
            if (mysqli_query($this->conn, $sql2) && mysqli_query($this->conn, $sql3)) {  
                return true;
            } else {
                // Rollback the user insertion if any error occurs
                mysqli_query($this->conn, "DELETE FROM user WHERE ID = '$userID'");
                return false;
            }
        } else {
            return false; 
        }
    }
    

    public function deleteAdminAccount($id) {
       

        $user_telnoDeleteQuery = "DELETE FROM user_telno WHERE ID = $id ";
        $adminDeleteQuery = "DELETE FROM admin WHERE ID = $id ";
        $userDeleteQuery = "DELETE FROM user WHERE ID = $id ";

        if(mysqli_query($this->conn, $user_telnoDeleteQuery) && mysqli_query($this->conn, $adminDeleteQuery)){
            mysqli_query($this->conn, $userDeleteQuery);
        }else {
            echo "error";
        }
        

        session_unset();  
        session_destroy();

        header("Location: customerHome.php");

    }

    public function selectType() {}
    public function viewAccount() {}
}
?>
