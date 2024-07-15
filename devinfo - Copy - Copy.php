<?php
session_start();
include 'config.php';


$update = $_POST['name'];
$age = $_POST['age'];
$mobile=$_POST ['contact'];




$insertQuery = "UPDATE `developer` SET `d_name`= '$update' ,`age`='$age' , `d_mobile`='$mobile' where d_email = '{$_SESSION['SESSION_EMAIL']}'";

if (mysqli_query($conn, $insertQuery)) {
    // echo "<script>alert('inserted')</script>";
    echo "<script>location.href='dev-profile-1.php'</script>";
}




?>