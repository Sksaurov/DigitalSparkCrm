<?php
    //Import PHPMailer classes into the global namespace
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    session_start();
    if (isset($_SESSION['SESSION_EMAIL'])) {
        header("Location: welcome.php");
        die();
    }

    //Load Composer's autoloader
    require 'vendor/autoload.php';

    include 'config.php';
    $msg = "";
 

    if (isset($_POST['submit'])) {
        $name = $_POST['r_name'];
        $email = $_POST['r_email'];
        $password = $_POST['r_pass'];
        $confirm_password = $_POST['r_conpass'];
        $code = rand(1111,9999);
        $wallet_code = rand(1111,9999);
        $ran_id = rand(time(), 100000000);
        $status = "Active";
        $image = $_FILES['image']['name'];
        $image_tmp_name = $_FILES['image']['tmp_name'];
        $image_folder = "uploaded_img/".$image;  //concat 

        $query = mysqli_query($conn, "SELECT * FROM suspend WHERE email = '$email'");
        $row = mysqli_fetch_assoc($query);

        move_uploaded_file($image_tmp_name,$image_folder);

                    // Function to generate a random code with spaces
                    function generateRandomCode() {
                        $codeLength = 15;  // Adjust the total length of the code as needed
                        $numLength = 3;    // Length of each number
                        $spaceLength = 1;  // Length of space between numbers

                        // Generate random numbers
                        $randomNumbers = [];
                        for ($i = 0; $i < $codeLength / ($numLength + $spaceLength); $i++) {
                            $randomNumbers[] = str_pad(rand(1, 999), $numLength, '0', STR_PAD_LEFT);
                        }

                        // Combine numbers with spaces
                        $code = implode(str_repeat(' ', $spaceLength), $randomNumbers);

                        return $code;
                    }

                    // Example usage
                     $ran_code = generateRandomCode();

                    


        
        if (mysqli_num_rows(mysqli_query($conn, "SELECT * FROM details WHERE email='{$email}'")) > 0) {
            $msg = "<div class='alert alert-danger'>{$email} - This email address has been already exists.</div>";

            
        }elseif(mysqli_num_rows(mysqli_query($conn, "SELECT * FROM ban WHERE email='{$email}'")) > 0){
            $msg = "<div class='alert alert-danger'>{$email} - This email address has been Parmanently Benned From Our Website</div>";
 
        }elseif(mysqli_num_rows(mysqli_query($conn, "SELECT * FROM suspend WHERE email='{$email}'")) > 0){
            $msg = "<div class='alert alert-danger'>{$email} - This email address has been Suspended For next ".$row['suspend_date']."</div>";
        }else {
            if ($password === $confirm_password) {

                $wallet = "INSERT INTO crm_wallet (number, unique_id, password) VALUES ('{$ran_code}', '{$ran_id}', '{$wallet_code}')";
                $result1 = mysqli_query($conn, $wallet);

                

                $sql = "INSERT INTO details (name, email, password, unique_id, active_status, code, image, join_date) VALUES ('{$name}', '{$email}', '{$password}', '{$ran_id}', '{$status}', '{$code}', '{$image}', (DATE(CURRENT_TIMESTAMP)))";
                $result = mysqli_query($conn, $sql);
                

                if ($result) {
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
                        $mail->Password   = 'nbvj hies vxlt dxvx';                               //SMTP password
                        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
                        $mail->Port       = 465;                                    //TCP port to connect to; 

                        //Recipients
                        $mail->setFrom('rontheboss00797@gmail.com');
                        $mail->addAddress($email);

                        //Content
                        $mail->isHTML(true);                                  //Set email format to HTML
                        $mail->Subject = 'DigitalSpark CRM';
                        $mail->Body    = 'Your OTP Code is: '.$code.'
                                           Your Wallet Number is: '.$ran_code.'
                                           Your Wallet Passwrod is: '.$wallet_code.'';

                        $mail->send();
                        echo 'Message has been sent';
                    } catch (Exception $e) {
                        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                    }
                    header("Location: otp.php");
                } else {
                    $msg = "<div class='alert alert-danger'>Something wrong went.</div>";
                }
            } else {
                $msg = "<div class='alert alert-danger'>Password and Confirm Password do not match</div>";
            }
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
    <title>DigitalSpark CRM</title>
    <style>
        .card{
            background: #fff;
            padding : 15px;
            box-shadow: 0px 0px 20px 2px #7c7a7a;
            border-radius : 10px;
            width:800px;
            height: 400px;
            position: relative;
            display:flex;
            margin-left: -150px;
            margin-top: 150px;
            color: white;
        }
        label{
            font-family:'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
            color: black;
        }
        .input input{
            border:none;
            outline:none;
            border-bottom: 2px solid rgba(174, 255, 0, 0.94);
            width: 250px;
            background: transparent;
            color:black;
            }
          .stop{
        transition: 0.3s;
        }

       .move{
    
        transform: translateX(210%);
     
        }
        .aqua-bg{
            background-color: rgba(174, 255, 0, 0.73);
            height: 645px;
            margin-top: 1px;
            margin-left: -100px;
        }
        .Register a{
            text-decoration: solid;
        }
        .Register a:hover{
            color: rgb(0, 255, 217);
            text-decoration: solid;
            font-size: 1.2rem;
        }
    </style>

    <script>
          function showPassword() {
      var passwordInput = document.getElementById("r_pass");
      var confirmPasswordInput = document.getElementById("r_conpass");
      if (document.getElementById("showPasswordCheckbox").checked) {
        passwordInput.type = "text";
        confirmPasswordInput.type = "text";
      } else {
        passwordInput.type = "password";
        confirmPasswordInput.type = "password";
      }
    }
    </script>
</head>
<body>
    <div class="container-fluid" style="position: relative;">
        <div class="col-md-12">
            <div class="container col-md-12">
                <div class="row">
                    <!-- Blue background for the text side with rounded right border -->
                    <div class="col-md-6 aqua-bg">
                           <div class="card" style="margin-top: 70px; margin-left: 260px; width: 880px; height: 520px;">
                     <div class="row">
                    <div class="col-md-5" style="background-color: rgba(174, 255, 0, 0.73); margin-left: -4px; margin-top: -16px; height: 520px;
                     width: 298px;border-radius: 5px 0px 0px 5px;">
                            <h3 class="mt-2 text-dark" style="font-family: Impact, Haettenschweiler, 'Arial Narrow Bold', sans-serif;">Registration</h3>
                            <div class="egg" style="margin-top: 60px; margin-left: 30px;">
                             <img src="images/client-reg-3.png" class="" style=" height: 200px; width: 200px;">
                            </div>
                            <div class="text mt-3 mx-4">
                                <h3 class="text-dark" style="font-family:Verdana, Geneva, Tahoma, sans-serif;"><b>DigitalSpark</b></h3>
                            </div>
                    </div>
                    <div class="col-md-6" style="margin-top: 70px; margin-left: 30px;">
                    <div class="d-flex" style=" width: 530px; height:100px; margin-top:-75px;">
                       <p> 
                        <?php echo $msg; ?>
                       </p>
                       </div>
                        <form class="" method="post" enctype="multipart/form-data" style="position:fixed;">
                        <div class="input mt-3">
                         <label>Name:</label>
                        <input style="margin-left: 132px;" type="text" class=" name" id="r_name" name="r_name" placeholder="Enter Your Name"
                        title="Contain of lowercase and number minimum 5 characters" required>
                        </div>
                        <div class="input mt-3">
                        <label class="">Email:</label>
                        <input style="margin-left: 138px;" type="email" class="email" id="r_email"  name="r_email" placeholder="Enter Your Email" title="example 'mug007@gmail.com'" required>
                        </div>
                        <div class="input mt-3">
                         <label class="">Password:</label>
                         <input style="margin-left: 113px;" type="password" class="pass" id="r_pass" name="r_pass" placeholder="Enter Your Password"
                         title="contain 1 digit 1 uppercase 1 lowercase 1 special characters minimum 6 length" required>
                        </div>
                        <div class="input mt-3">
                        <label class="">Confirm-Password:</label>
                        <input style="margin-left: 53px;" type="password" class="con_pass"  id="r_conpass" name="r_conpass" placeholder="Confirm Your Password"
                         title="contain 1 digit 1 uppercase 1 lowercase 1 special characters minimum 6 length" type="password" required>
                        </div>
                        <div class="input mt-3">   
                        <label class="">Upload Your Image:</label>
                        <input style="margin-left: 52px;" type="file" class="box" name="image"  accept="image/jpg, image/jpeg, image/png">
                        </div>
                        <div class="input mt-3">
                        <div class="checkbox" style="margin-left: -120px;" >
                        <label for="showPasswordCheckbox">
                        <input type="checkbox"  id="showPasswordCheckbox" onclick="showPassword()">
                        <span class="checkmark"></span>
                         <b style="margin-left: -115px;">Show Password</b>
                        </label>
                        </div>
                        </div>

                        <div class="button mt-4">
                        <input name="submit" class="btn stop" style="background-color: rgba(174, 255, 0, 0.905); width: 140px;" id="submit" value="Register" type="submit"/>
                        </div>
                        <div class="Register mt-5" style="margin-left: 300px ;">
                            <p class="text-dark"><b>Have an account!</b> <a href="login.php" style="color: rgb(98, 255, 0);"><b>Login</b></a>.</p>
                           </div> 
                           </form>
                    </div>
                  </div>
                  </div>
                        
                    </div>

                    <!-- White background for the image side -->
                    <div class="col-md-8">
                      

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        const moveBtn = document.getElementById("submit");
        const button = document.querySelector("button");

        const emailInput = document.querySelector(".email");
        const passwordInput = document.querySelector(".pass");
        const conpassInput = document.querySelector(".con_pas");
        const nameInput = document.querySelector(".name");

        moveBtn.addEventListener('mouseover', (button) => {
            let name = nameInput.value;
            let email = emailInput.value;
            let password = passwordInput.value;
            let conpass = conpassInput.value;

            let nameRegex = /^[A-Za-z ]+$/;
            let emailRegex = /^[a-zA-Z0-9._%+-]+@gmail\.com$/;
            let passRegex = /^(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z])(?=.*[@#$%^&-+=()]).{6,20}/;

            let validate = emailRegex.test(email) && passRegex.test(password) && nameRegex.test(name);

            if (!validate || password !== conpass) {
            button.target.classList.add("move");
            moveBtn.style.background = "rgba(174, 255, 0, 0.4)";
            } else {
            button.target.classList.remove("move");
            moveBtn.classList.add("stop");
            moveBtn.style.background = "green";
            }
        });
        emailInput.addEventListener('input', updateStyles);
  passwordInput.addEventListener('input', updateStyles);
  conpassInput.addEventListener('input', updateStyles);
  nameInput.addEventListener('input', updateStyles);
        </script>

    
</body>
</html>




