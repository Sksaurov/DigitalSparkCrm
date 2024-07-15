<?php
include "config.php";
$output = "";
session_start();

if (!isset($_SESSION['unique_id'])) {
    header("Location: admin-login.php");
    die();
}

$project_id = mysqli_real_escape_string($conn, $_GET['project_id']);
$manager_id = mysqli_real_escape_string($conn, $_GET['manager']);

$project = mysqli_query($conn, "SELECT * FROM file WHERE project_id = '{$project_id}' and manager_id = '{$manager_id}'");
$project_data = mysqli_fetch_assoc($project);
$output = "";

if (isset($_POST['project_file'])) {
    $fileName = $_POST['file'];
    $filePath = "project_file/" . $fileName;
  
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="' . $fileName . '"'); // Set a standard filename here
        readfile($filePath);
        exit;
    
}

if (isset($_POST['pdf'])) {
  $manager =  $_POST['manager'];
  $project =  $_POST['project']; // Split names by comma
  $developer_1 =  $_POST['developer_1']; // Split names by comma
  $developer_2 =  $_POST['developer_2']; // Split names by comma
  $developer_3 =  $_POST['developer_3']; // Split names by comma
  $email =  $_POST['email']; // Split names by comma
  $text =  $_POST['details']; 

  require("fpdf/fpdf.php");
  $pdf = new FPDF();
  $pdf->AddPage();
  $pdf->SetFont("Arial","B",12);
  
  $pdf->Cell(0,10,"Project Details:",1,1,'C'); //weight,height,border,newline,center

  // $pdf->SetFillColor(144, 238, 144); // Light Green
  // $pdf->SetTextColor(144, 238, 144); // Light Green

  $pdf-> Cell(100,10,'Manager Name & ID',0,0,'C');
  $pdf-> Cell(90,10,'Project Name & ID',0,1,'C');
  $pdf-> Cell(100,10,$manager,1,0,'C');
  $pdf-> Cell(90,10,$project,1,1,'C');
  $pdf-> Cell(100,10,'Developer 1 Name & ID',0,0,'C');
  $pdf-> Cell(90,10,'Developer 2 Name & ID',0,1,'C');
  $pdf-> Cell(100,10,$developer_1,1,0,'C');
  $pdf-> Cell(90,10,$developer_2,1,1,'C');
  $pdf-> Cell(100,10,'Developer 3 Name & ID',0,0,'C');
  $pdf-> Cell(90,10,'Manager Email',0,1,'C');
  $pdf-> Cell(100,10,$developer_3,1,0,'C');
  $pdf-> Cell(90,10,$email,1,1,'C');
  $pdf-> Cell(0,10,'Details',0,1,'C');
  $pdf-> Cell(0,10,$text,1,0,'C');

  $pdf->output();
}


?>

 
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DigitalSpark CRM</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> 
    <script src="bootstrap/js/bootstrap.bundle.min.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>  
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css"/>
    

    
    <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

  <!-- Font Links -->
<link href='https://fonts.googleapis.com/css?family=Salsa' rel='stylesheet'>
<link href='https://fonts.googleapis.com/css?family=Spicy Rice' rel='stylesheet'>
<link href='https://fonts.googleapis.com/css?family=Squada One' rel='stylesheet'>
<link href='https://fonts.googleapis.com/css?family=Suez One' rel='stylesheet'>
<link href='https://fonts.googleapis.com/css?family=Timmana' rel='stylesheet'>


<style>
body{
            
            align-items: center;
            justify-content: center;
            background: url('images/view-bg.jpg') no-repeat center center fixed;
            -webkit-background-size: cover;
            -moz-background-size: cover;
            -o-background-size: cover;
            background-size: cover; 
  
        }
  </style>

</head>

<body>





   <div class="container-fluid" style="font-family: Salsa;">
    <div class="row">
      <header class="d-flex " style="background-color: rgb(0,0,0, 0.7);">
        <a href="admin-page.php" class="text-warning" style="text-decoration: none;"><b>CRM</b></a>
        <h5 class="mx-5 text-light"><b>Project File</b></h5>
      </header>
      <?php 
      if(mysqli_num_rows($project) > 0) {

        $output .='
      <div class="col-md-10 mt-2" style="margin-left: 110px;">
        <div class="card text-light" style="height: 580px;  background-color: rgb(0,0,0, 0.7); border-color:rgb(254,190,16); border-radius: 20px;">

          
          <div class="container">
            <form method="post">
            <div class="row">
            
              <div class="col-md-6">
                <label><b>Manager & Unique ID</b></label>
                <input type="text" class="form-control text-warning" style="background-color: rgb(0,0,0, 0.7); border-color:rgb(254,190,16);" name="manager" value="'.$project_data['manager_name'].', '.$project_data['manager_id'].'" readonly>
                </div>
    
              <div class="col-md-6">
                <label><b>Project Name & Unique ID</b></label>
                <input type="text" class="form-control text-warning" style="background-color: rgb(0,0,0, 0.7); border-color:rgb(254,190,16);"  name="project" value="'.$project_data['project_name'].', '.$project_data['project_id'].'" readonly>
              </div>

              <div class="col-md-6">
                <label><b>Developer 1 Name & Unique ID</b></label>
                <input type="text" class="form-control text-warning" style="background-color: rgb(0,0,0, 0.7); border-color:rgb(254,190,16);"  name="developer_1" value="'.$project_data['dev1_name'].', '.$project_data['dev1_id'].'" readonly>
              </div>

              <div class="col-md-6">
                <label><b>Developer 2 Name & Unique ID</b></label>
                <input type="text" class="form-control text-warning" style="background-color: rgb(0,0,0, 0.7); border-color:rgb(254,190,16);"  name="developer_2" value="'.$project_data['dev2_name'].', '.$project_data['dev2_id'].'" readonly>
              </div>

              <div class="col-md-6">
                <label><b>Developer 3 Name & Unique ID</b></label>
                <input type="text" class="form-control text-warning" style="background-color: rgb(0,0,0, 0.7); border-color:rgb(254,190,16);"  name="developer_3" value="'.$project_data['dev3_name'].', '.$project_data['dev3_id'].'" readonly>
              </div>

              <div class="col-md-6">
                <label><b>Manager Email</b></label>
                <input type="email" class="form-control text-warning" style="background-color: rgb(0,0,0, 0.7); border-color:rgb(254,190,16);"  name="email" value="'.$project_data['email'].'" readonly>
              </div>

              <div class="col-md-12">
                <label><b>project File</b></label>
                <input  class="form-control text-warning" style="background-color: rgb(0,0,0, 0.7); border-color:rgb(254,190,16);"  name="file" value="'.$project_data['file'].'" readonly>
              </div>

              <div class="col-md-12">
                <label><b>project Details</b></label>
                <textarea type="text" class="form-control text-warning" style="background-color: rgb(0,0,0, 0.7); border-color:rgb(254,190,16); height: 200px;"  name="details" readonly>'.$project_data['details'].'</textarea>
              </div>

              <div class="col-md-12 mt-2">
                <input type="submit" class="btn btn-outline-warning" value="Download PDF" name="pdf" >
                <input type="submit" class="btn btn-outline-warning mx-3" value="Download File" name="project_file" >
              </div>

             
            </div>
            </form>
          </div>
       

        </div>
      </div>';
    }
    else{
      $output .= '<div class="alert alert-danger w-75" style="margin-left: 160px; margin-top: 200px;">
      <p class="mt-1" style="margin-left: 130px;">
      The project Not Complete Yet.When Manager Submit The Project You Will Get Here.
      </p>
      </div>';
    }

     echo $output;

   ?>
    </div>
   </div>';

   




</body>
</html>



