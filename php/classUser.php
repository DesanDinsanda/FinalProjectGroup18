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

    public function logIn($email,$password) {
        $this->email = $email;
        $this->password = $password;

        // Check admin credentials
    $adminQuery = "SELECT a.ID, u.ID, u.email 
                    FROM admin a 
                         INNER JOIN user u ON a.ID = u.ID  WHERE email = '$email' AND password = '$password'";
    $adminResult = mysqli_query($this->conn, $adminQuery);

    if (mysqli_num_rows($adminResult) == 1) {
        // Admin login successful
        session_start();
        $_SESSION['adminEmail'] = $email;  // Store session for admin
        header("Location: ../html/test.html");
        exit();
    }

    // Check customer credentials if not admin
    $customerQuery = "SELECT c.ID, u.ID, u.email  
                    FROM customer c 
                        INNER JOIN user u ON c.ID = u.ID WHERE email = '$email' AND password = '$password'";
    $customerResult = mysqli_query($this->conn, $customerQuery);

    if (mysqli_num_rows($customerResult) == 1) {
        // Customer login successful
        session_start();
        $_SESSION['customerEmail'] = $email;  // Store session for customer
        header("Location: ../html/create.html");
        exit();
    }

      // Check event manager credential
    $managerQuery = "SELECT e.ID, u.ID, u.email  
    FROM eventmanager e 
        INNER JOIN user u ON e.ID = u.ID WHERE email = '$email' AND password = '$password'";
    $managerResult = mysqli_query($this->conn, $managerQuery);

    if (mysqli_num_rows($managerResult) == 1) {
    // Manager login successful
    session_start();
    $_SESSION['managerEmail'] = $email;  // Store session for customer
    header("Location: ../html/test2.html");
    exit();
}

    // If neither matches, show error
    echo "<script>alert('Invalid email or password!'); window.location.href='../html/login.html';</script>";;

    }

    public function logOut() {}
    public function resetPassword() {}
    public function updateAccount() {}
    public function validateEmail() {}
    public function validatePassword() {}
    public function selectResetPassword() {}
    public function selectAccount() {}

    
}
?>
