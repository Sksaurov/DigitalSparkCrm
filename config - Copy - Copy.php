<?php
  $serverName = "localhost";
  $username = "root";
  $password = "";
  $dbName ="register";


  $conn = mysqli_connect($serverName,$username,$password,$dbName);

  if(!$conn){
    die("connnection faild".mysqli_connect_error());
  }
//   else{
  
//     echo "<script> alert('DB Connected!!') </script>";
//   }


?>