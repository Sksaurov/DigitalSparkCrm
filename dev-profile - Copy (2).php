<?php 
include 'config.php';
$message = "";
session_start();
$user_id = $_SESSION['user_id'];
$query ="SELECT * FROM `developer` WHERE d_id='$user_id'";
$allData = mysqli_query($conn,$query);

$arrayData = mysqli_fetch_array($allData);

if(isset($_POST['change_details'])){
    $update_name = $_POST['update_name'];
    $update_phone = $_POST['update_phone'];
    $update_country = $_POST['update_country'];
    $update_job = $_POST['update_job'];
    $update_bio = $_POST['bio'];
    
    $name_pattern = "/[A-Za-z ]+$/";
    $phone_pattern = "/(\+88)?-?01[3-9]\d{8}/";
    $country_pattern = "/[A-Za-z ]+$/";
    $job_pattern = "/[A-Za-z ]+$/";

    if(!preg_match($name_pattern,$update_name)){
      $message= "<div class='alert alert-danger'>Only Characters (Name Field)!</div>";
  }elseif(!preg_match($phone_pattern,$update_phone)){
      $message= "<div class='alert alert-danger'>Only Bangladeshi Phone Number!</div>";
  }elseif(!preg_match($country_pattern,$update_country)){
      $message= "<div class='alert alert-danger'>Only Characters (Country Field)!</div>";
  }elseif(!preg_match($job_pattern,$update_job)){
      $message= "<div class='alert alert-danger'>Only Characters (Profession Field)!</div>";  
  }else{
    mysqli_query($conn, "UPDATE `developer` SET d_name = '$update_name' , d_mobile ='$update_phone' , d_country= '$update_country' , d_skill= '$update_job' , d_bio = '$update_bio'
     WHERE d_id = '$user_id'") or die('query failed');
     header("Location: dev-profile.php");
  }


  $old_pass = $_POST['old_pass']; 
  $current_pass = $_POST['current_pass'];
  $new_pass = $_POST['new_pass'];
  $confirm_pass =$_POST['confirm_pass'];

  $pass_Pattern = "/((?=.*[0-9])(?=.*[a-z])(?=.*[A-Z])(?=.*[@#$%^&-+=()])).{6,20}/";

  if(!preg_match($pass_Pattern,$new_pass)){
      $message= "<div class='alert alert-danger'>Contain 1 Uppercase 1 Lowercase 1 Digit & 1 Special Characters!</div>";
  }elseif(!empty($current_pass) || !empty($new_pass) || !empty($confirm_pass)){
     if($current_pass != $old_pass){
        $message = "<div class='alert alert-danger'>old password not matched!</div>";
     }elseif($new_pass != $confirm_pass){
        $message = "<div class='alert alert-danger'>confirm password not matched!</div>";
     }else{
        mysqli_query($conn, "UPDATE `developer` SET d_pass = '$confirm_pass' WHERE d_id = '$user_id'") or die('query failed');
        echo "<script> alert('Password Updated Succesfully!!') </script>"; 
     }
  }

   
  $update_image = $_FILES['update_image']['name'];
  $update_image_size = $_FILES['update_image']['size'];
  $update_image_tmp_name = $_FILES['update_image']['tmp_name'];
  $update_image_folder = 'uploaded_img/'.$update_image;

  if(!empty($update_image)){
        $image_update_query = mysqli_query($conn, "UPDATE `developer` SET d_profile = '$update_image' WHERE d_id = '$user_id'") or die('query failed');
        if($image_update_query){
           move_uploaded_file($update_image_tmp_name, $update_image_folder);
        }
     //    $message= "<div class='alert alert-success'>Details Updated Successfully !</div>";
        header("Location: dev-profile.php");
     }



}


?>
<!DOCTYPE html>
<!-- Designined by CodingLab | www.youtube.com/codinglabyt -->
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
   <title>Developer Profile </title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css"/>
    <link rel="stylesheet" href="bootstrap/js/bootstrap.bundle.js">   
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> 
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <style>
*{
  margin: 0;
  padding: 0;
  box-sizing: border-box;
  font-family: 'Poppins',sans-serif;
}
form{
  height: 100vh;
  width: 100%;
  display: flex;
  justify-content: center;
  align-items: center;
  background: #092c3e;
}
.content{
  display: flex;
  width: 700px;
  height: 450px;
  padding: 15px;
  background: #092c3e;
  border-radius: 12px;
  position: relative;
  box-shadow: 0px 10px 10px 10px rgb(0, 255, 251);
}
.image-box {
  height: 232px;
  width: 250px;
  border-radius: 12px;
  padding: 3px;
  background: #092c3e;
}
.image-box img {
  height: 100%;
  width: 100%;
  object-fit: cover;
  border: 3px solid #fff;
  border-radius: 12px;
}
.image-box .file {
    position: relative;
    overflow: hidden;
    margin-top: -37px;
    margin-left: 0px;
    width: 100%;
    height: 30px;;
    border: none;
    padding: 10px 70px;
    color: #fff;
    border-radius: 0;
    font-size: 15px;
    background: #212529b8;
}
.image-box .file input {
    position: absolute;
    opacity: 0;
    right: 0;
    top: 0;
}
.content .details{
  width: 58%;
  margin: 10px 0 20px 20px;
  color: white;
}
.content .details .name input{
  border: none;
  outline: none;
  border-bottom: 1px solid aqua;
  background: transparent;
  color: #fff;
  width: 250px;
  font-size: 23px;
  font-weight: 600;
}
.content .details .job input{
  border: none;
  outline: none;
  border-bottom: 1px solid aqua;
  background: transparent;
  color: #fff;
  width: 180px;
  margin-top: 10px;
  font-size: 18px;
  font-weight: 500;
}
.content .details p{
 font-size: 15px;
 margin-top: 6px;
}
.input textarea {
  margin-top: 10px;
  width: 400px;
  height: 100px;
  outline: none;
  background: transparent;
  border: 1px solid #092c3e;
  padding: 10px;
  box-sizing: border-box;
  color: #fff;
  border-color:rgb(3, 125, 84);
}

.input textarea:hover {
  border-color: aqua;
}


.input input:hover{
  border-color: aqua;
}
.content .buttons input{
  display: block;
  margin-top: 50px;
  margin-left: 240px;
  font-size: 17px;
  padding: 6px 14px;
  border-color: blanchedalmond;
  border-radius: 6px;
  background: transparent;
  cursor: pointer;
  color: aqua;
  ;
}
.content .buttons input:hover{
  transform: scale(0.97);
}
.media-icons{
  position: absolute;
  bottom: 16px;
  right: 15px;
  margin-top: 12px;
  justify-content: flex-end;
}
.media-icons i{
  display: inline-flex;
  margin: 0 4px;
  font-size: 16px;
  color: white;
  opacity: 0.7;
  cursor: pointer;
}
.media-icons i:hover{
  opacity: 1;
}

.about{
 margin-top: 20px;
 color: #fff;
  margin-left: 90px; ;
}
.about label{
}
.design{
  margin-top: 10px;
  display: flex;
  color: #fff;
  padding: 10px;
  margin-left: -10px;
}
.design input{
  border:none;
  outline: none;
  background: transparent;
  border-bottom: 1px solid aqua;
  width: 160px;
  margin-left: 70px;
  position: absolute;
  color: aquamarine;
  
} 
.design .icon{
  margin-left:220px;
  position: absolute;
}
.password{
  margin-top: 10px;
  display: flex;
  color: #fff;
  padding: 5px;
  margin-left: -10px;
}
.password label{
  margin-left:20px;
  font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;
  font-size: 0.9rem;
}
.password input{
  border:none;
  outline: none;
  background: transparent;
  border-bottom: 1px solid aqua;
  width: 160px;
  margin-left: 180px;
  position: absolute;
  color: aquamarine;
}
.password .icon{
  margin-left:330px;
  position: absolute;
}
</style>
   <script>
// image upload
$(document).ready(function() {
         $('#icon').change(function() {
            var reader = new FileReader();
            reader.onload = function(e) {
               $('#profile-image').attr('src', e.target.result);
            };
            reader.readAsDataURL(this.files[0]);
         });
      });
  </script>
   </head>
<body>
 <div class="container">
  <form method="post" enctype="multipart/form-data">
  <?php echo $message;?>
    <div class="content">
      <div class="image-box">

   <div class="profile-img">
                        <?php
                         if($arrayData['d_profile'] == ''){
                           echo '<img src="img/user.jpeg">';
                           }else{
                              echo '<img class="img-thumbnail" id="profile-image" src="uploaded_img/'.$arrayData['d_profile'].'">';
                             }
                             ?>
                            <div class="file btn btn-lg btn-primary">
                                Change Photo
                                <input type="file" name="update_image" id="icon"/>
                            </div>
                         </div>

       <div class="about">
        <label><b>About</b></label>
       </div>
       <div class="design">
        Email:
        <input type="text" value="dattapro001@gmail.com" readonly> 
     </div>
        <div class="design">
          Mobile:
          <input type="text" name="update_phone" value="<?php echo $arrayData['d_mobile'];?>"> 
          <ion-icon class="icon" name="create-outline"></ion-icon>

       </div>
       <div class="design">
        Country:
        <input type="text" name="update_country" value="<?php echo $arrayData['d_country'];?>">
        <ion-icon class="icon" name="create-outline"></ion-icon> 
     </div>
      </div>
      <div class="details">
        <div class="name">
          <input type="text" name="update_name" value="<?php echo $arrayData['d_name'];?>">
          <ion-icon class="icon" name="create-outline"></ion-icon>
        </div>
        <div class="job">
          <input type="text" name="update_job" value="<?php echo $arrayData['d_skill'];?>">
          <ion-icon class="icon" name="create-outline"></ion-icon>
        </div>
        <div class="input">
          <textarea name="bio"><?php echo $arrayData['d_bio'];?></textarea>
        </div>  
        <div class="password">
          <label><b>Old Passoword:</b></label>
          <input type="password" name="old_pass" value="<?php echo $arrayData['d_pass'];?>">
        </div>
        <div class="password">
        <label><b>Current Passoword:</b></label>
          <input type="password" name="current_pass" value="">
          <ion-icon class="icon" name="create-outline"></ion-icon><br/>
        </div>
        <div class="password">
        <label><b>New Passoword:</b></label>
          <input type="password" name="new_pass" value="">
          <ion-icon class="icon" name="create-outline"></ion-icon>
        </div>
        <div class="password">
        <label><b>Confirm Passoword:</b></label>
          <input type="password" name="confirm_pass" value="">
          <ion-icon class="icon" name="create-outline"></ion-icon>
        </div>      
        <div class="buttons">
          <input type="submit" value="Change Details" name="change_details">
        </div>
      </div>
      <!-- <div class="media-icons">
        <i class="fab fa-facebook-f"></i>
        <i class="fab fa-twitter"></i>
        <i class="fab fa-linkedin-in"></i>
      </div> -->
    </div>
  <form>
 </div>

 <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>
</html>