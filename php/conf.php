<?php 
$servername = "localhost:4306";
$username = "root";
$password = "";
$dbname = "finalproject";

$conn = mysqli_connect($servername,$username,$password,$dbname);
if(!$conn){
    die("Connection failed". mysqli_connect_error());
}

//echo "Successfully connected!";

?>