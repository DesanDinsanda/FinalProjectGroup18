<?php
include 'conf.php';

require_once 'classUser.php';

class Customer extends User {
    private $age;
    private $dob;
    private $province;
    private $city;
    private $streetName;

    public function __construct($db) {
        parent::__construct($db);
    }

    // Getters and Setters
    public function getAge() { 
        return $this->age; 
    }
    public function setAge($age) { $this->age = $age; }

    public function getDob() { return $this->dob; }
    public function setDob($dob) { $this->dob = $dob; }

    public function getProvince() { return $this->province; }
    public function setProvince($province) { $this->province = $province; }

    public function getCity() { return $this->city; }
    public function setCity($city) { $this->city = $city; }

    public function getStreetName() { return $this->streetName; }
    public function setStreetName($streetName) { $this->streetName = $streetName; }

    // Method to create an account
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

            $sql3 = "INSERT INTO customer (ID) VALUES ('$userID')";
    
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


    //Method to View customers
    public function viewCustomer() {
        $sql = "SELECT u.ID, u.firstName, u.lastName, u.email, ut.telNO, MIN(o.orderID) AS orderID
                FROM user u
                INNER JOIN user_telno ut ON u.ID = ut.ID
                INNER JOIN customer c ON u.ID = c.ID
                INNER JOIN orders o ON u.ID = o.customerID
                GROUP BY u.ID, u.firstName, u.lastName, u.email, ut.telNO;";
        $result = mysqli_query($this->conn, $sql);
        echo <<<HTML

        <html>
        <head>
        <title>customers</title>
        </head>
        <body>
            <div class="container my-4">
        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th>User ID</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>email</th>
                    <th>Phone Number</th>
                    <th>Order ID</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
HTML;

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        echo <<<HTML
            <tr>
                <td>{$row['ID']}</td>
                <td>{$row['firstName']}</td>
                <td>{$row['lastName']}</td>
                <td>{$row['email']}</td>
                <td>{$row['telNO']}</td>
                <td>{$row['orderID']}</td>
                <td>
                    <a href='mailto:{$row['email']}' class='btn btn-success btn-sm'>Contact</a>
                </td>

                
            </tr>
HTML;
    }
}

echo <<<HTML
            </tbody>
        </table>
    </div> 
        </body>
        </html>
HTML;
    }


    public function viewRegisteredUsers() {
        $sql = "SELECT u.ID, u.firstName,u.lastName, u.email,   ut.telNO
        FROM user u INNER JOIN user_telno ut ON u.ID = ut.ID
                    INNER JOIN customer c ON u.ID = c.ID ";
        $result = mysqli_query($this->conn, $sql);
        echo <<<HTML

        <html>
        <head>
        <title>customers</title>
        </head>
        <body>
            <div class="container my-4">
        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th>User ID</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>email</th>
                    <th>Phone Number</th>
                    <th>Contact</th>
                </tr>
            </thead>
            <tbody>
HTML;

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        echo <<<HTML
            <tr>
                <td>{$row['ID']}</td>
                <td>{$row['firstName']}</td>
                <td>{$row['lastName']}</td>
                <td>{$row['email']}</td>
                <td>{$row['telNO']}</td>
                <td>
                    <a href='mailto:{$row['email']}' class='btn btn-success btn-sm'>Contact</a>
                </td>

                
            </tr>
HTML;
    }
}

echo <<<HTML
            </tbody>
        </table>
    </div> 
        </body>
        </html>
HTML;
    }

    public function deleteAccount($id) {
        session_start();

        $reviewDeleteQuery = "DELETE FROM review WHERE customerID = $id ";
        $user_telnoDeleteQuery = "DELETE FROM user_telno WHERE ID = $id ";
        $orderDeleteQuery = "DELETE FROM orders WHERE customerID = $id ";
        $customerDeleteQuery = "DELETE FROM customer WHERE ID = $id ";
        $userDeleteQuery = "DELETE FROM user WHERE ID = $id ";

        if(mysqli_query($this->conn, $reviewDeleteQuery)){

        }
        if(mysqli_query($this->conn, $orderDeleteQuery)){

        }

        if (mysqli_query($this->conn, $user_telnoDeleteQuery)) {

            if (mysqli_query($this->conn, $customerDeleteQuery)) {
        
                mysqli_query($this->conn, $userDeleteQuery);
                    
        
            } else {
                echo "Error deleting customer: " . mysqli_error($this->conn);
            }
        
        } else {
            echo "Error deleting user_telno (required): " . mysqli_error($this->conn);
        }

        session_unset();  // Unset all session variables
        session_destroy();

        header("Location: customerHome.php");

    }


    public function updateCustomerAccount($firstName, $lastName, $email, $number,$ID,$dob, $province, $city, $streetName) {
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->email = $email;
        $this->number = $number;
        $this->id = $ID;
        $this->dob = $dob;
        $this->province = $province;
        $this->city = $city;
        $this->streetName = $streetName;
        $sql = "UPDATE user SET firstName = '$this->firstName', lastName = '$this->lastName', email = '$this->email'  WHERE email = '$this->email' ";
        $result = mysqli_query($this->conn, $sql);
    
    
        $sql2 = "UPDATE user_telno SET telNO = '$this->number' WHERE ID = '$this->id' ";
        $result2 = mysqli_query($this->conn, $sql2);

        $sql3 = "UPDATE customer SET dob = '$this->dob', province = '$this->province', city = '$this->city', streetName = '$this->streetName'  WHERE ID = '$this->id' ";
        $result3 = mysqli_query($this->conn, $sql3);
    
        if($result == true && $result2 == true && $result3 == true ) {
            return true;
        }else{
            return false;
        }
    
    }

    public function contactCustomer() {}
    

    
}
?>
