<?php session_start();?>

<?php
include "conf.php"; // Include your database connection file


$email = $_SESSION['email'];


// Query to get the user details
$sql = "SELECT u.firstName, u.lastName, u.email, u.password, u.ID, ut.telNO
FROM user u
INNER JOIN user_telno ut ON u.ID = ut.ID
 WHERE u.email = '$email' "; // Assuming you have only one admin and using adminID to fetch
$result = mysqli_query($conn, $sql);

// Check if data exists
if (mysqli_num_rows($result) > 0) {
    // Fetch the data into an associative array
    $userData = mysqli_fetch_assoc($result);
} else {
    echo "No customer data found!";
    exit;
}


// code for updating admin details
if (isset($_POST['updateProfile'])) {
    $firstName = $_POST['firstName'];
    $pass = $_POST['password'] ;
    $lastName = $_POST['lastName'];
    $email = $_POST['email'];
    $number = $_POST['mobile'];
    $ID = $_POST['id'];

    include 'conf.php';
    include 'classUser.php';
    $user = new User($conn);

    // Call the update method
    $user->updateAccount($firstName, $lastName, $email, $pass, $number,$ID);
       

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Customer Edit Profile</title>

  <script>
    function validateForm() {
        var firstName = document.getElementById("first-name").value.trim();
        var lastName = document.getElementById("last-name").value.trim();
        var email = document.getElementById("email").value.trim();
        var mobile = document.getElementById("mobile").value.trim();
        var password = document.getElementById("password").value.trim();

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
        if (email === "") {
            alert("Please enter your email");
            return false;
        } else if (!emailRegex.test(email)) {
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

        // Password Validation
        if (password === "") {
            alert("Please enter your password");
            return false;
        }

        return true; // If all validations pass, form submission proceeds
    }
</script>
<link rel="stylesheet" href="../css/profile.css">

</head>
<body>
  <div class="container">
    <h2>Edit Customer Profile</h2>
    <form method="POST" action="eventManagerProfile.php" onsubmit="return validateForm()">
    <div class="form-group">
        <label for="id">ID</label>
        <input type="text" id="id" name="id" readonly value="<?php echo $userData['ID']; ?>" required>
      </div>
      <div class="form-group">
        <label for="first-name">First Name</label>
        <input type="text" id="first-name" name="firstName"  value="<?php echo $userData['firstName']; ?>" required>
      </div>
      <div class="form-group">
        <label for="last-name">Last Name</label>
        <input type="text" id="last-name" name="lastName" value="<?php echo $userData['lastName']; ?>" required>
      </div>
      <div class="form-group">
        <label for="email">Email</label>
        <input type="email" id="email" name="email" value="<?php echo $userData['email']; ?>" required readonly>
      </div>
      <div class="form-group">
        <label for="mobile">Mobile Number</label>
        <input type="tel" id="mobile" name="mobile" value="<?php echo $userData['telNO']; ?>" required>
      </div>
      
      <div class="form-group">
        <label for="passwords">Password</label>
        <input type="password" id="passwords" name="password" value="<?php echo $userData['password']; ?>" required>
      </div>
      <div class="btn-group">
        <button type="button" class="btn btn-cancel" onclick="window.location.href='eventManagerHome.php'">Cancel</button>
        <button type="submit" class="btn btn-save" name="updateProfile">Update</button>
      </div>
    </form>
  </div>
</body>
</html>
