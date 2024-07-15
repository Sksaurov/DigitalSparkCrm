<?php

session_start();
if (isset($_SESSION['SESSION_EMAIL'])) {
    header("Location: welcome.php");
    die();
}

//Import PHPMailer classes into the global namespace
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'vendor/autoload.php';

include 'config.php';
$msg = "";

if (isset($_POST['submit'])) {
    $email = $_POST['f_email'];
    $code = rand(1111,9999);

    if (mysqli_num_rows(mysqli_query($conn, "SELECT * FROM details WHERE email='{$email}'")) > 0) {
        $query = mysqli_query($conn, "UPDATE details SET code='{$code}' WHERE email='{$email}'");

        if ($query) {        
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
                $mail->Password   = 'nbvj hies vxlt dxvx';                              //SMTP password
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
                $mail->Port       = 465;                                    //TCP port to connect to; 

                //Recipients
                $mail->setFrom('rontheboss00797@gmail.com');
                $mail->addAddress($email);

                //Content
                $mail->isHTML(true);                                  //Set email format to HTML
                $mail->Subject = 'DigitalSpark CRM';
                $mail->Body    = 'Here is the verification link <b><a href="http://localhost/acc/change-password.php?reset='.$code.'">http://localhost/acc/change-password.php?reset='.$code.'</a></b>';

                $mail->send();
                echo 'Message has been sent';
            } catch (Exception $e) {
                echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            }
            echo "</div>";        
            $msg = "<div class='alert alert-info'>We've send a verification link on your email address.</div>";
        }
    } else {
        $msg = "<div class='alert alert-danger'>$email - This email address do not found.</div>";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <script src="bootstrap/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Forgot Password</title>
    <style>
           body {
            margin: 0;
            padding: 0;
            background: url('images/dev-reg-bg.jpg') no-repeat center center fixed; 
            -webkit-background-size: cover;
            -moz-background-size: cover;
            -o-background-size: cover;
            background-size: cover;
        }
        .card{
            margin-top: 160px;
            margin-left: 260px;
            width: 740px; 
            height: 340px; 
            background: rgba(255, 255, 255, 0);
            box-shadow: 0px 0px 15px 2px #7c7a7a;
            backdrop-filter: blur(40px);
            border-radius: 20px 98px 21px 94px;
        }
        label{
            font-family:'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
            color: white;
            font-size: 16px;
        }
        .input input{
            border:none;
            outline:none;
            border-bottom: 2px solid rgb(150, 150, 243);
            width: 290px;
            background: transparent;
            color:white;
           
        }
        .login a{
            text-decoration: solid;
        }
        .login a:hover{
            text-decoration: solid;
            font-size: 1.2rem;
        }
        .stop{
        transition: 0.2s;
        }

       .move{
    
        transform: translateX(120%);
     
        }
    </style>
</head>
<body>
      <!-- Your content goes here -->
      <div class="container-fluid">
        <div class="col-md-6">
            <div class="card">
                <div class="row">
                    <div class="col-md-6">
                    <h3 class="mx-2 text-light" style="font-family: Impact, Haettenschweiler, 'Arial Narrow Bold', sans-serif;">Forgot-password</h3>
                          <img src="images/client-forgot.png" style="height: 350px; width: 400px; margin-top:-40px; margin-left:-10px;">
                    </div>
                    <div class="col-md-6">
                    <div class="d-flex" style="height: 80px;">
                       <p> 
                        <?php echo $msg; ?>
                       </p>
                       </div>
                        <form method="post" style="margin-top: -10px; position:fixed;">
                            <div class="input mt-5">
                                <label class="" style=""><b>Email</b></label><br>
                                <input type="email" class="email" id="f_email" name="f_email" placeholder="Enter Your Email" title="example 'mug007@gmail.com'">
                            </div>
                            <div class="button mt-3">
                                <input name="submit" class="btn btn-outline-primary text-dark stop" id="submit"
                                style="background-color: rgb(255, 255, 255);" value="Send Resend Link" type="submit"/>
                            </div>
                            <div class="login mt-3">
                                <p class="text-light"><b>Back To! </b><a href="client-login.php" class="text-light" style="margin-left:px;
                                 text-decoration: none;"><b>login</b></a>.</p>
                            </div>
                        </form>
                     </div>
                  </div>
               </div>
            </div>
        </div>

        <script>
            const moveBtn = document.getElementById("submit");
            const button = document.querySelector("button");
    
            const emailInput= document.querySelector(".email");
    
            moveBtn.addEventListener('mouseover',(button)=>{  
            let email = emailInput.value;
    
            let emailRegex = /^[a-zA-Z0-9._%+-]+@gmail\.com$/;;
    
             let validate = emailRegex.test(email) 
    
            if(!validate){ 
          button.target.classList.toggle("move");
          moveBtn.style.background = "rgb(255, 255, 255,0.6)";
               }
           else{
          button.target.classList.add("stop");
          moveBtn.style.background = "green"
              }
          });
           </script>
</body>
</html>