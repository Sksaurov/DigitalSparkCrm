<?php
include "config.php";
$output="";
session_start();
if (!isset($_SESSION['unique_id'])) {
 
  header("Location: admin-login.php");
  die();
}
$unique_id = $_SESSION['unique_id'];

$fileName = $_POST['any'];
$filePath = "project_file/" . $fileName;
    
    if($fileName == ""){
        echo '<script>alert("Project Not Complete Yet!");
        window.location.href = "client-profile.php?user_id='.$unique_id.'";
        </script>';
    } else {
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="' . $fileName . '"'); // Set a standard filename here
        readfile($filePath);
        exit;
    }
?>
