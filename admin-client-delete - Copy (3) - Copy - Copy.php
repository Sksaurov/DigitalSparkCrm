<?php 
include "config.php";
$user_id = mysqli_real_escape_string($conn, $_GET['user_id']);
$deleteQuery = "DELETE FROM `details` WHERE unique_id = '$user_id'";
mysqli_query($conn, $deleteQuery);
echo '<script>
            alert("Successfully Delete.");
            window.location.href = "admin-page.php";
            </script>';
?>