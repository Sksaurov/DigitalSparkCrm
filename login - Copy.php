<?php
    session_start();
    if (isset($_SESSION['SESSION_EMAIL'])) {
        header("Location: welcome.php");
        die();
    }

    include 'config.php';
    $msg="";
  
    
    if (isset($_POST['submit'])) {
        $email = $_POST['l_email'];
        $password = $_POST['l_password'];

        $query = mysqli_query($conn, "SELECT * FROM suspend WHERE email = '$email'");
        $row = mysqli_fetch_assoc($query);
        $sql = "SELECT * FROM details WHERE email='{$email}' AND password='{$password}'";
        $result = mysqli_query($conn, $sql);

            if(mysqli_num_rows(mysqli_query($conn, "SELECT * FROM ban WHERE email='{$email}'")) > 0){
                $msg = "<div class='alert alert-danger' style=' border-radius: 5px 100px 5px 5px;
                width: 300px; height:100px; margin-top:10px;'>{$email} - This email address has been Parmanently Benned From Our Website</div>";

            }elseif(mysqli_num_rows(mysqli_query($conn, "SELECT * FROM suspend WHERE email='{$email}'")) > 0){
                $msg = "<div class='alert alert-danger' style=' border-radius: 5px 100px 5px 5px;
                width: 350px; height: 100px; margin-top:10px;'>{$email} - This email address has been Suspended For next ".$row['suspend_date']."</div>";

            }elseif (mysqli_num_rows($result) === 1) {
            $row = mysqli_fetch_assoc($result);
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['unique_id'] = $row['unique_id'];
            $_SESSION['SESSION_EMAIL'] = $email;
            $status = "Active";
            $sql2 = mysqli_query($conn, "UPDATE details SET active_status = '{$status}' WHERE unique_id = {$row['unique_id']}");
            header("Location: client-page.php");
            } else {
            $msg = "<div class='alert alert-danger' style=' border-radius: 5px 100px 5px 5px;
             width: 300px; height:70px; margin-top:10px;'>Email or password do not match.</div>";
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
    <style>
        body {
            margin: 0;
            padding: 0;
            background: url('images/client-login-bg.jpg') no-repeat center center fixed; 
            -webkit-background-size: cover;
            -moz-background-size: cover;
            -o-background-size: cover;
            background-size: cover;
        }
        .card{
            margin-top: 160px;
            margin-left: 260px;
            width: 700px; 
            height: 340px; 
            background: rgba(255, 255, 255, 0);
            box-shadow: 0px 0px 15px 2px #7c7a7a;
            backdrop-filter: blur(10px);
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
            border-bottom: 2px solid rgb(251, 255, 0);
            width: 250px;
            background: transparent;
            color:white;
           
        }
        .login a{
            text-decoration: solid;
            color: white;
        }
        .login a:hover{
            color: rgb(235, 239, 18);
            text-decoration: solid;
            font-size: 1.2rem;
        }
        .stop{
        transition: 0.3s;
        }
       .move{
        transform: translateX(180%);
        } 
    </style>
    <title>DigitalSpark CRM</title>
</head>
<body>
    <!-- Your content goes here -->
    <div class="container-fluid">
        <div class="col-md-6">
            <div class="card">
                <div class="row">
                    <div class="col-md-6">
                    <h3 class="mx-3 text-light" style="font-family: Impact, Haettenschweiler, 'Arial Narrow Bold', sans-serif;">Login</h3>
                          <img src="images/login-bg-2.png" style="height: 350px; margin-top:-40px;" height="320px">
                    </div>
                    <div class="col-md-6">
                    <div class="d-flex" style="height: 70px;">
                       <p> 
                        <?php echo $msg; ?>
                       </p>
                       </div>
                        <form method="post" style="margin-top: -10px; position:fixed;">
                            <div class="input mt-5">
                                <label class="" style=""><b>Email</b></label><br>
                                <input type="email" class="email" id="l_email" name="l_email" placeholder="Enter Your Email" title="example 'mug007@gmail.com'">
                            </div>
                            <div class="input mt-2">
                                <label class=""><b>Password</b><br>
                                    <input type="password" class="pass" id="l_password" name="l_password" placeholder="Enter Your Password"
                                    title="contain 1 digit 1 uppercase 1 lowercase 1 special characters minimum 6 length" required>
                                </label>
                            </div>
                            <div class="input mt-2" style="">
                                <h6><b> <a href="forgot-password.php" style="text-decoration: none;">Forgot Password</a></b></h6>
                            </div>
                            <div class="button mt-3">
                                <input name="submit" class="btn btn-outline-primary text-dark stop" id="submit" value="Login" type="submit"
                                style="background-color: rgb(235, 239, 18); width: 90px;"/>
                            </div>
                            <div class="login mt-2">
                                <p class="text-light"><b>Don't Have Account? </b><a href="register.php" class=""><b>Register</b></a>.</p>
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
            const passwordInput = document.querySelector(".pass");
    
            moveBtn.addEventListener('mouseover',(button)=>{  
            let email = emailInput.value;
            let password = passwordInput.value;
    
            let emailRegex = /^[a-zA-Z0-9._%+-]+@gmail\.com$/;
            let passRegex  = /^(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z])(?=.*[@#$%^&-+=()]).{6,20}/;
    
             let validate = emailRegex.test(email) && passRegex.test(password)
    
            if(!validate){ 
          button.target.classList.toggle("move");
          moveBtn.style.background = "rgb(235, 239, 18,0.6)";
               }
           else{
          button.target.classList.add("stop");
          moveBtn.style.background = "green"
              }
          });
           </script>
</body>
</html>
