<?php session_start();?>

<?php
include "conf.php"; 


$email = $_SESSION['email'];


$sql = "SELECT u.firstName, u.lastName, u.email, u.password, u.ID, ut.telNO
FROM user u
INNER JOIN user_telno ut ON u.ID = ut.ID
 WHERE u.email = '$email' "; 
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    $userData = mysqli_fetch_assoc($result);
} else {
    echo "No customer data found!";
    exit;
}


if (isset($_POST['updateProfile2'])) {
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $email = $_POST['email'];
    $number = $_POST['mobile'];
    $ID = $_POST['id'];

    include 'conf.php';
    include 'classUser.php';
    $user2 = new User($conn);

    

    if($user2->updateAccount($firstName, $lastName, $email, $number,$ID)  ){
        echo "<script>alert('Updated succesfully!'); window.location='adminProfile.php';</script>";
      }else {
          echo "<script>alert('There is an Error'); window.location='adminProfile.php';</script>";
        }
       

}else if (isset($_POST['deleteBtn'])) {

  $ID = $_POST['id'];

  include 'conf.php';
  include 'classAdmin.php';
  $admin = new Admin($conn);

  

  $admin->deleteAdminAccount($ID);
     

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Customer Edit Profile</title>

  <script>
    function validateForm2() {
        var firstName = document.getElementById("first-name").value.trim();
        var lastName = document.getElementById("last-name").value.trim();
        var email2 = document.getElementById("email2").value.trim();
        var mobile = document.getElementById("mobile").value.trim();

        // First Name Validation
        if (firstName === "") {
            alert("Please enter your first name");
            return false;
        }

        // Last Name Validation
        if (lastName === "") {
            alert("Please enter your last name");
            return false;
        }

        // Email Validation
        var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (email2 === "") {
            alert("Please enter your email");
            return false;
        } else if (!emailRegex.test(email2)) {
            alert("Please enter a valid email address");
            return false;
        }

        // Mobile Number Validation
        if (mobile === "") {
            alert("Please enter your mobile number");
            return false;
        } else if (isNaN(mobile)) {
            alert("Please enter a valid mobile number");
            return false;
        }

        

        return true; 
    }
</script>
<link rel="stylesheet" href="../css/profile.css">

</head>
<body>
  
  <div class="container">
    <h2>Edit Admin Profile</h2>
    <form method="POST" action="adminProfile.php" onsubmit="return validateForm2()">
    <div class="form-group">
        <label for="id">ID</label>
        <input type="text" id="id" name="id" readonly value="<?php echo $userData['ID']; ?>" required>
      </div>
      <div class="form-group">
        <label for="first-name">First Name</label>
        <input type="text" id="first-name" name="firstName"  value="<?php echo $userData['firstName']; ?>" >
      </div>
      <div class="form-group">
        <label for="last-name">Last Name</label>
        <input type="text" id="last-name" name="lastName" value="<?php echo $userData['lastName']; ?>" >
      </div>
      <div class="form-group">
        <label for="email">Email</label>
        <input type="email" id="email2" name="email" value="<?php echo $userData['email']; ?>" required readonly>
      </div>
      <div class="form-group">
        <label for="mobile">Mobile Number</label>
        <input type="tel" id="mobile" name="mobile" value="<?php echo $userData['telNO']; ?>" >
      </div>
      
      

      <script>
      function confirmDelete() {
      return confirm("Are you sure you want to delete your account?");
      }
      </script>

       
      <button type="submit" class="btn btn-cancel" name="deleteBtn" onclick="return confirmDelete()">Delete Account</button>
        <button type="button" class="btn btn-cancel" onclick="window.location.href='adminHome.php'">Cancel</button>
        <button type="submit" class="btn btn-save" name="updateProfile2">Update</button>
      </div>
    </form>
  </div>
</body>
</html>
