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
        $sql = "SELECT * FROM developer WHERE email='{$email}' AND d_pass='{$password}'";
        $result = mysqli_query($conn, $sql);

            if(mysqli_num_rows(mysqli_query($conn, "SELECT * FROM ban WHERE email='{$email}'")) > 0){
                $msg = "<div class='alert' style='background-color: rgb(0, 255, 128); width: 600px; margin-left: -200px;'>{$email} - This email address has been Parmanently Benned From Our Website.</div>";

            }elseif(mysqli_num_rows(mysqli_query($conn, "SELECT * FROM suspend WHERE email='{$email}'")) > 0){
                $msg = "<div class='alert' style='background-color: rgb(0, 255, 128); width: 665px; margin-left: -240px;'>{$email} - This email address has been Suspended For next ".$row['suspend_date']."</div>";

            }elseif (mysqli_num_rows($result) === 1) {
            $row = mysqli_fetch_assoc($result);
            $_SESSION['user_id'] = $row['d_id'];
            $_SESSION['unique_id'] = $row['unique_id'];
            $_SESSION['SESSION_EMAIL'] = $email;
            $status = "Active";
            $sql2 = mysqli_query($conn, "UPDATE developer SET active_status = '{$status}' WHERE unique_id = {$row['unique_id']}");
            header("Location: dev-profile-1.php");
            } else {
                $msg = "<div class='alert' style='background-color: rgb(0, 255, 128); width: 300px;'>Email or password do not match.</div>";

        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
    <title>CRM</title>

    <style>
        input {
            border: none;
            outline: none;
            border-bottom: 2px solid rgb(2, 169, 105);
            width: 250px;
            background: transparent;
            color: rgb(0, 0, 0);
        }
        
        .regi b:hover{
            color: rgb(6, 151, 79); 
        }

        .stop {
            transition: 0.3s;
        }

        .move {
            transform: translateX(180%);
        }
    </style>
</head>
<body>
    <img src="img/dev-bg.png" style="z-index: -1; position: fixed; height: 750px; width: 700px;">
    <header></header>
    
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6">
                <img src="img/dev.svg" class="" style="width: 500px; height: 400px; margin-left: 100px; z-index: 0; margin-top: 150px;">
            </div>
            
            <div class="col-md-6">
                <form method="post">
                    <div class="container-fluid">
                    <div class="msg mt-5" style="position: relative; margin-left: 200px;">
                        <?php echo $msg ?>
                        </div>
                        <img src="img/avatar.svg" style="width: 100px; height: 100px; margin-left: 300px; margin-top: 70px;">
                        <p class=" mt-3" style="margin-left: 240px; font-size: 18px;"><b>Developer </b> <b style="color: rgb(6, 151, 79);">Login</b> <b> / </b><a href="dev-register.php" class="regi text-dark" style="text-decoration: none; font-size: 18px;"><b>Register</b></a></p>
                        
                        <div class="input mt-5" style="margin-left: 220px;">
                            <div class="email">
                                <label><i class="fa fa-user d-flex " style="position: absolute; margin-top: -30px; color: rgb(0, 255, 128);"><b class="mx-2 text-dark">Email</b></i></label>
                                <input type="email" class="email" name="l_email" style="position: relative;">
                            </div>
                            <div class="pass mt-5">
                                <label><i class="fa fa-lock d-flex" style="position: absolute; margin-top: -30px; color: rgb(0, 255, 128);"><b class="mx-2 text-dark">Password</b></i></label>
                                <input type="password" class="pass" name="l_password" style="position: relative;"><br>
                                <a href="dev-forgot-password.php" class="text-dark" style="text-decoration: none; margin-left: 155px; font-size: 13px;"><b>Forget Password</b></a>
                            </div>

                            <div class="button">
                                <input type="submit" class="btn mt-3  mx-1 stop" name="submit" id="submit" value="Login" style="border-radius: 20px; width: 100px; background-color: rgb(0, 255, 128);">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        const moveBtn = document.getElementById("submit");
        const emailInput = document.querySelector(".email");
        const passwordInput = document.querySelector(".pass");

        moveBtn.addEventListener('mouseover', () => {  
            let email = emailInput.querySelector('input').value;
            let password = passwordInput.querySelector('input').value;

            let emailRegex = /^[a-zA-Z0-9._%+-]+@gmail\.com$/;
            let passRegex = /^(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z])(?=.*[@#$%^&-+=()]).{6,20}/;

            let validate = emailRegex.test(email) && passRegex.test(password);

            if (!validate) {
                moveBtn.classList.toggle("move");
                moveBtn.style.background = "rgb(73, 140, 107)";
            } else {
                moveBtn.classList.add("stop");
                moveBtn.style.background = "rgb(0, 208, 80);";
            }
        });
    </script>
</body>
</html>
