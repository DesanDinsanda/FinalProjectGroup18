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
    $adminQuery = "SELECT a.ID, u.ID, u.email, u.password  
                   FROM admin a 
                   INNER JOIN user u ON a.ID = u.ID  WHERE email = '$email'";
    $adminResult = mysqli_query($this->conn, $adminQuery);

    if (mysqli_num_rows($adminResult) == 1) {

        $row = mysqli_fetch_assoc($adminResult);
        $dbHashedPassword = $row['password'];
        

        if ($row['email'] === $email && password_verify($password, $dbHashedPassword)) {
            session_start();
            $_SESSION['email'] = $email;  // Store session for customer
            header("Location: adminHome.php");
        exit();
         } else {
            echo "<script>
             alert('Please enter correct login details');
             window.location.href = '../html/login.html';
             </script>";
         }
    }else {
        echo "<script>
         alert('Please enter correct login details');
         window.location.href = '../html/login.html';
         </script>";
     }

    // Check customer credentials if not admin
    $customerQuery = "SELECT c.ID, u.ID, u.email, u.password  
                    FROM customer c 
                        INNER JOIN user u ON c.ID = u.ID WHERE email = '$email'";
    $customerResult = mysqli_query($this->conn, $customerQuery);

    $bool = false;

    if (mysqli_num_rows($customerResult) == 1) {
        

         $row = mysqli_fetch_assoc($customerResult);
         $dbHashedPassword = $row['password'];
         //$bool = password_verify($password, $dbpassword);

         if ($row['email'] === $email && password_verify($password, $dbHashedPassword)) {
            session_start();
            $_SESSION['email'] = $email;  // Store session for customer
            header("Location: customerHome.php");
            exit();
         } else {
            echo "<script>
             alert('Please enter correct login details');
             window.location.href = '../html/login.html';
             </script>";
         }
         
    }else {
        // If email doesn't exist in database
        echo "<script>
             alert('Please enter correct login details');
             window.location.href = '../html/login.html';
             </script>";
    }

      // Check event manager credential
      $managerQuery = "SELECT e.ID, u.ID, u.email, u.password
      FROM eventmanager e 
      INNER JOIN user u ON e.ID = u.ID 
      WHERE u.email = '$email'"; 
  
  $managerResult = mysqli_query($this->conn, $managerQuery);
  
  if (mysqli_num_rows($managerResult) == 1) {
      $row = mysqli_fetch_assoc($managerResult);
      $dbHashedPassword = $row['password'];  // Get hashed password from DB
  
      // Ensure email exists before checking password
      if ($row['email'] === $email && password_verify($password, $dbHashedPassword)) {
          session_start();
          $_SESSION['email'] = $email;  
          header("Location: eventManagerHome.php");
          exit();
      } else {
          echo "<script>
               alert('Please enter correct login details');
               window.location.href = '../html/login.html';
               </script>";
      }
  } else {
      // If email doesn't exist in database
      echo "<script>
           alert('Please enter correct login details');
           window.location.href = '../html/login.html';
           </script>";
  }
  

//echo "<script>alert('Invalid email or password!'); window.location.href='../html/login.html';</script>";;

    }
    public function updateAccount($firstName, $lastName, $email, $number,$ID) {
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->email = $email;
        $this->number = $number;
        $this->id = $ID;
        $sql = "UPDATE user SET firstName = '$this->firstName', lastName = '$this->lastName', email = '$this->email'  WHERE email = '$this->email' ";
        $result = mysqli_query($this->conn, $sql);
    
    
        $sql2 = "UPDATE user_telno SET telNO = '$this->number' WHERE ID = '$this->id' ";
        $result2 = mysqli_query($this->conn, $sql2);
    
        if($result == true && $result2 == true) {
            return true;
        }else{
            return false;
        }
    
    }

    public function logOut() {
        session_start();
        session_unset();  // Unset all session variables
        session_destroy();  // Destroy the session

        // Redirect to login page


        header("Location: customerHome.php");
exit();
    }

    public function resetPassword() {}
    public function validateEmail() {}
    public function validatePassword() {}
    public function selectResetPassword() {}
    public function selectAccount() {}

    
}
?>
