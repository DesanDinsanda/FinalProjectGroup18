<?php session_start();?>
<?php
include "conf.php"; 

$email = $_SESSION['email'];

$sql = "SELECT u.firstName, u.lastName, u.email, u.password, u.ID, ut.telNO, c.dob, c.province, c.city, c.streetName
FROM user u
INNER JOIN user_telno ut ON u.ID = ut.ID
INNER JOIN customer c ON u.ID = c.ID
WHERE u.email = '$email'"; 

$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    $userData = mysqli_fetch_assoc($result);
} else {
    echo "No customer data found!";
    exit;
}

if (isset($_POST['updateProfile2'])) {
    $firstName = $_POST['firstName'];
    $passw = $_POST['password'];
    $lastName = $_POST['lastName'];
    $email = $_POST['email'];
    $number = $_POST['mobile'];
    $ID = $_POST['id'];
    $dob = $_POST['dob'];
    $provin = $_POST['province'];
    $cit = $_POST['city'];
    $streetN = $_POST['streetName'];

    include 'conf.php';
    include 'classCustomer.php';
    $customer2 = new Customer($conn);

    if($customer2->updateCustomerAccount($firstName, $lastName, $email, $passw, $number, $ID, $dob, $provin, $cit, $streetN)) {
        echo "<script>alert('Updated successfully!'); window.location='customerProfile.php';</script>";
    } else {
        echo "<script>alert('Error updating profile'); window.location='customerProfile.php';</script>";
    }
} else if (isset($_POST['deleteBtn'])) {
    $ID = $_POST['id'];
    include 'conf.php';
    include 'classCustomer.php';
    $customer = new Customer($conn);
    $customer->deleteAccount($ID);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Customer Edit Profile</title>
  <link rel="stylesheet" href="../css/profile.css">
  
  <style>
    * {
        box-sizing: border-box;
        margin: 0;
        padding: 0;
    }

    body {
        font-family: Arial, sans-serif;
        background-color: rgb(240, 230, 200);
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 100vh;
        padding: 20px;
    }

    .container {
        background: white;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        max-width: 1000px;
        width: 100%;
    }

    h2 {
        text-align: center;
        margin-bottom: 20px;
    }

    .form-group {
        margin-bottom: 15px;
        width: 48%;
    }

    label {
        display: block;
        font-weight: bold;
        margin-bottom: 5px;
    }

    input {
        width: 100%;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
    }

    .btn-group {
        display: flex;
        flex-direction: column;
        gap: 10px;
    }

    .btn {
        padding: 10px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        font-size: 16px;
        width: 100%;
    }

    .btn-save {
        background-color: #28a745;
        color: white;
    }

    .btn-cancel {
        background-color: #dc3545;
        color: white;
    }

    .btn-secondary {
        background-color: #6c757d;
        color: white;
    }

    .form-row {
        display: flex;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 10px;
    }

    @media (min-width: 600px) {
        .btn-group {
            flex-direction: row;
            justify-content: space-between;
        }

        .btn {
            width: 32%;
        }
    }
  </style>

  <script>
    function validateForm2() {
        var firstName = document.getElementById("first-name").value.trim();
        var lastName = document.getElementById("last-name").value.trim();
        var email2 = document.getElementById("email2").value.trim();
        var mobile = document.getElementById("mobile").value.trim();
        var password = document.getElementById("passwords").value.trim();

        if (firstName === "") { alert("Please enter your first name"); return false; }
        if (lastName === "") { alert("Please enter your last name"); return false; }

        var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (email2 === "") { alert("Please enter your email"); return false; }
        if (!emailRegex.test(email2)) { alert("Please enter a valid email address"); return false; }

        if (mobile === "") { alert("Please enter your mobile number"); return false; }
        if (isNaN(mobile)) { alert("Please enter a valid mobile number"); return false; }

        if (password === "") { alert("Please enter your password"); return false; }

        return true; 
    }
  </script>

</head>
<body>


  <br><br>
  <div class="container">
    <h2>Edit Customer Profile</h2>
    <form method="POST" action="" onsubmit="return validateForm2()">
      <div class="form-row">
        <div class="form-group">
          <label for="id">ID</label>
          <input type="text" id="id" name="id" readonly value="<?php echo $userData['ID']; ?>">
        </div>
        <div class="form-group">
          <label for="first-name">First Name</label>
          <input type="text" id="first-name" name="firstName" value="<?php echo $userData['firstName']; ?>">
        </div>
      </div>
      <div class="form-row">
        <div class="form-group">
          <label for="last-name">Last Name</label>
          <input type="text" id="last-name" name="lastName" value="<?php echo $userData['lastName']; ?>">
        </div>
        <div class="form-group">
          <label for="email">Email</label>
          <input type="email" id="email2" name="email" value="<?php echo $userData['email']; ?>" readonly>
        </div>
      </div>
      <div class="form-row">
        <div class="form-group">
          <label for="mobile">Mobile Number</label>
          <input type="tel" id="mobile" name="mobile" value="<?php echo $userData['telNO']; ?>">
        </div>
        <div class="form-group">
          <label for="passwords">Password</label>
          <input type="password" id="passwords" name="password" value="<?php echo $userData['password']; ?>" required>
        </div>
      </div>
      <div class="form-row">
        <div class="form-group">
          <label for="dob">DOB</label>
          <input type="text" id="dob" name="dob" value="<?php echo $userData['dob']; ?>">
        </div>
        <div class="form-group">
          <label for="province">Province</label>
          <input type="text" id="province" name="province" value="<?php echo $userData['province']; ?>">
        </div>
      </div>
      <div class="form-row">
        <div class="form-group">
          <label for="city">City</label>
          <input type="text" id="city" name="city" value="<?php echo $userData['city']; ?>">
        </div>
        <div class="form-group">
          <label for="streetName">Street Name</label>
          <input type="text" id="streetName" name="streetName" value="<?php echo $userData['streetName']; ?>">
        </div>
      </div>
      <div class="btn-group">
        <button type="submit" class="btn btn-save" name="updateProfile2">Update</button>
        <button type="submit" class="btn btn-cancel" name="deleteBtn" onclick="return confirm('Are you sure?')">Delete</button>
        <button type="button" class="btn btn-secondary" onclick="window.location.href='customerHome.php'">Cancel</button>
      </div>
    </form>
  </div>
</body>
</html>