<?php
include "config.php";
session_start();
if (!isset($_SESSION['unique_id'])) {
    header("Location: admin-login.php");
    die();
}

$user_id = mysqli_real_escape_string($conn, $_GET['user_id']);

$deleteQuery = mysqli_query($conn, "DELETE FROM `suspend` WHERE unique_id = '$user_id'");
$query = mysqli_query($conn, "UPDATE details SET status='' , suspend_date='' WHERE unique_id='{$user_id}'");
$query2 = mysqli_query($conn, "UPDATE developer SET status='' , suspend_date='' WHERE unique_id='{$user_id}'");

echo '<script>
    alert("Unsuspended Successfully.");
    window.location.href = "admin-page.php";
</script>';
?>
