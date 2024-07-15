<?php

    //Import PHPMailer classes into the global namespace
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

include "config.php";

require 'vendor/autoload.php';
$msg = "";

$output = "";
session_start();

if (!isset($_SESSION['unique_id'])) {
    header("Location: admin-login.php");
    die();
}

$id = mysqli_real_escape_string($conn, $_GET['id']);

$project = mysqli_query($conn, "SELECT * FROM project WHERE id = '{$id}'");
$project_data = mysqli_fetch_assoc($project);
$project_id = "";
if($project_data){
  $project_id = $project_data['unique_id'];
}
$output = "";


if(isset($_POST['submit'])){
 $file = $_POST['file'];
 $text = $_POST['text'];

 $sql5 ="UPDATE `project` SET file = '$file', description = '$text' WHERE id = '{$id}'";      
 $result5 = mysqli_query($conn, $sql5);

 $manager = $project_data['manager_id'];
 $man = mysqli_query($conn, "SELECT * FROM manager WHERE unique_id = '{$manager}'");
 $man_data = mysqli_fetch_assoc($man);
 
 $client_id = $project_data['client_id'];
 $client = mysqli_query($conn, "SELECT * FROM details WHERE unique_id = '{$client_id}'");
 $client_data = mysqli_fetch_assoc($client);

 
 

 if ($result5) {
  echo "<div style='display: none;'>";
  //Create an instance; passing `true` enables exceptions
  $mail = new PHPMailer(true);

  try {
      //Server settings
      $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
      $mail->isSMTP();                                            //Send using SMTP
      $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
      $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
      $mail->Username   = 'rontheboss00797@gmail.com';                     //SMTP username
      $mail->Password   = 'uxjumadnkqvsauvi';                               //SMTP password
      $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
      $mail->Port       = 465;                                    //TCP port to connect to; 

      //Recipients
      $mail->setFrom('rontheboss00797@gmail.com');
      $mail->addAddress($client_data['email']);

      //Content
      $mail->isHTML(true);                                  //Set email format to HTML
      $mail->Subject = 'DigitalSpark CRM';
      $mail->Body = 'Dear '.$client_data['name'].',
      Your '.$project_data['name'].' has been completed.You can download your project file from My Order Section.

      Thanks, For Chosen Us.

      Regards,
      Digital Spark CRM Team.
      ';
  

      $mail->send();
      echo 'Message has been sent';
  } catch (Exception $e) {
      echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
  }
  
}
echo '<script>alert("Project Hand Over Successfully Done.");
window.location.href = "admin-page.php";
</script>'; 

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
  input{
            border:none;
            outline:none;
            border-bottom: 2px solid rgb(254,190,16);
            width: 385px;
            background: transparent;
            color:black;
            }
</style>

</head>

<body>





   <div class="container-fluid" style="font-family: Salsa;">
    <div class="row">
      <header class="d-flex" style="background-color: rgb(0,0,0, 0.7);">
        <a href="admin-page.php" class="text-warning" style="text-decoration: none;"><b>CRM</b></a>
        <h5 class="mx-5 text-light"><b>Project Hand Over</b></h5>
      </header>
      <div class="col-md-8 mt-2" style="margin-left: 200px;">
        <div class="card text-light" style="height: 580px; background-color: rgb(0,0,0, 0.7); border-color:rgb(254,190,16); border-radius: 10px;">
           
          <p class="mt-1 mx-1 text-warning" style="font-size: 18px;"><b><?php echo $project_data['name'] ?></b></p>
          
          <div class="container">
            <form method="post">
              <div class="row">

                <div class="col-md-6">
                <?php
                                    $output120 = "";
                                     $web = mysqli_query($conn, "SELECT * FROM web WHERE 1");
                                     $web1 = mysqli_fetch_assoc($web);
                                 
                                     $seo = mysqli_query($conn, "SELECT * FROM seo WHERE unique_id = '$project_id'");
                                     $seo1 = mysqli_fetch_assoc($seo);
                                 
                                     $ppc = mysqli_query($conn, "SELECT * FROM ppc WHERE unique_id = '$project_id'");
                                     $ppc1 = mysqli_fetch_assoc($ppc);
                                 
                                     $sm = mysqli_query($conn, "SELECT * FROM s_marketing WHERE unique_id = '$project_id'");
                                     $sm1 = mysqli_fetch_assoc($sm);
                                 
                                     $cm = mysqli_query($conn, "SELECT * FROM c_marketing WHERE unique_id = '$project_id'");
                                     $cm1 = mysqli_fetch_assoc($cm);
                                 
                                     $em = mysqli_query($conn, "SELECT * FROM e_marketing WHERE unique_id = '$project_id'");
                                     $em1 = mysqli_fetch_assoc($em);
                                 
                                     if (!empty($web1) && $web1['unique_id'] == $project_id) {
                                         $output120 .= '<img src="images/'.$web1['image'].'" style="width: 340px; margin-top: 70px;">';
                                     } elseif (!empty($seo1) && $seo1['unique_id'] == $project_id) {
                                      $output120 .= '<img src="images/'.$seo1['image'].'" style="width: 340px; margin-top: 70px;">';
                                    } elseif (!empty($ppc1) && $ppc1['unique_id'] == $project_id) {
                                      $output120 .= '<img src="images/'.$ppc1['image'].'" style="width: 340px; margin-top: 70px;">';
                                    } elseif (!empty($sm1) && $sm1['unique_id'] == $project_id) {
                                      $output120 .= '<img src="images/'.$sm1['image'].'" style="width: 340px; margin-top: 70px;">';
                                    } elseif (!empty($cm1) && $cm1['unique_id'] == $project_id) {
                                      $output120 .= '<img src="images/'.$cm1['image'].'" style="width: 340px; margin-top: 70px;">';
                                    } elseif (!empty($em1) && $em1['unique_id'] == $project_id) {
                                      $output120 .= '<img src="images/'.$em1['image'].'" style="width: 340px; margin-top: 70px;">';
                                    }

                                     echo $output120;
                                   
                                    ?> 
                  
                </div>

                <div class="col-md-6 mt-5">
                  <label class="" ><b>Project File :</b></label>
                  <input style="margin-left: 2px;" type="file" class="" name="file">

                  <label class="mt-4"><b>Description :</b></label>
                  <textarea class="form-control h-100 text-warning" style="background-color: rgb(0,0,0, 0.7); border-color:rgb(254,190,16);"  name="text"></textarea>

                  <input type="submit" class="btn btn-outline-warning mt-4 w-100" name="submit" value="Hand Over">
                </div>


             
            </div>
            </form>
          </div>
       

        </div>
      </div>
    
   


    </div>
   </div>';

   




</body>
</html>