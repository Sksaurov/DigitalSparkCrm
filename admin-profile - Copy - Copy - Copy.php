<?php
include 'config.php';
$message = "";
session_start();
$user_id = $_SESSION['user_id'];
$query ="SELECT * FROM `details` WHERE id='$user_id'";
$allData = mysqli_query($conn,$query);

$arrayData = mysqli_fetch_array($allData);
 
// update Profile
if(isset($_POST['update_details'])){
    $update_name = $_POST['update_name'];
    $update_phone = $_POST['update_phone'];
    $update_country = $_POST['update_country'];
    $update_profession = $_POST['update_profession'];
    $hobby1 = $_POST['hobby1'];
    $hobby2 = $_POST['hobby2'];
    $hobby3 = $_POST['hobby3'];
    $skill1 = $_POST['skill1'];
    $skill2 = $_POST['skill2'];
    $skill3 = $_POST['skill3'];

   // $email_pattern = "/(cse|eee|law)_\d{10}@lus\.ac\.bd/";

    $name_pattern = "/[A-Za-z ]+$/";
    $phone_pattern = "/(\+88)?-?01[3-9]\d{8}/";
    $country_pattern = "/[A-Za-z ]+$/";
    $profession_pattern = "/[A-Za-z ]+$/";
    $hobby1_pattern = "/[A-Za-z ]+$/";
    $hobby2_pattern = "/[A-Za-z ]+$/";
    $hobby3_pattern = "/[A-Za-z ]+$/";
    $skill1_pattern = "/[A-Za-z ]+$/";
    $skill2_pattern = "/[A-Za-z ]+$/";
    $skill3_pattern = "/[A-Za-z ]+$/";

    if(!preg_match($name_pattern,$update_name)){
        $message= "<div class='alert alert-danger'>Only Characters (Name Field)!</div>";
    }elseif(!preg_match($phone_pattern,$update_phone)){
        $message= "<div class='alert alert-danger'>Only Bangladeshi Phone Number!</div>";
    }elseif(!preg_match($country_pattern,$update_country)){
        $message= "<div class='alert alert-danger'>Only Characters (Country Field)!</div>";
    }elseif(!preg_match($profession_pattern,$update_profession)){
        $message= "<div class='alert alert-danger'>Only Characters (Profession Field)!</div>";  
    }elseif(!preg_match($hobby1_pattern,$hobby1)){
        $message= "<div class='alert alert-danger'>Only Characters (Hobby Field)!</div>";
    }elseif(!preg_match($hobby2_pattern,$hobby2)){
        $message= "<div class='alert alert-danger'>Only Characters (Hobby Field)!</div>";
    }elseif(!preg_match($hobby3_pattern,$hobby3)){
        $message= "<div class='alert alert-danger'>Only Characters (Hobby Field)!</div>";
    }elseif(!preg_match($skill1_pattern,$skill1)){
        $message= "<div class='alert alert-danger'>Only Characters (Skill Field)!</div>";
    }elseif(!preg_match($skill2_pattern,$skill2)){
        $message= "<div class='alert alert-danger'>Only Characters (Skill Field)!</div>";
    }elseif(!preg_match($skill3_pattern,$skill3)){
        $message= "<div class='alert alert-danger'>Only Characters (Skill Field)!</div>";
    }else{
        mysqli_query($conn, "UPDATE `details` SET name = '$update_name' , phone ='$update_phone' , country= '$update_country' , profession= '$update_profession',
     hobby1 = '$hobby1' , hobby2 = '$hobby2' , hobby3 = '$hobby3' , skill1 = '$skill1' , skill2 = '$skill2' , skill3 = '$skill3' WHERE id = '$user_id'") or die('query failed');
     echo "<script> alert('Details Updated Succesfully!!') </script>"; 
    }


     $update_image = $_FILES['update_image']['name'];
     $update_image_size = $_FILES['update_image']['size'];
     $update_image_tmp_name = $_FILES['update_image']['tmp_name'];
     $update_image_folder = 'uploaded_img/'.$update_image;
   
     if(!empty($update_image)){
           $image_update_query = mysqli_query($conn, "UPDATE `details` SET image = '$update_image' WHERE id = '$user_id'") or die('query failed');
           if($image_update_query){
              move_uploaded_file($update_image_tmp_name, $update_image_folder);
           }
           $message= "<div class='alert alert-success'>Details Updated Successfully !</div>";
        }
  }
  
//Update Password
if(isset($_POST['update_password'])){
    
    $old_pass = $_POST['old_pass'];
    $current_pass = $_POST['current_pass'];
    $new_pass = $_POST['new_pass'];
    $confirm_pass =$_POST['confirm_pass'];

    $pass_Pattern = "/((?=.*[0-9])(?=.*[a-z])(?=.*[A-Z])(?=.*[@#$%^&-+=()])).{6,20}/";

    if(!preg_match($pass_Pattern,$new_pass)){
        $message= "<div class='alert alert-danger'>Contain 1 Uppercase 1 Lowercase 1 Digit 1 Special Characters!</div>";
    }elseif(!empty($current_pass) || !empty($new_pass) || !empty($confirm_pass)){
       if($current_pass != $old_pass){
          $message = "<div class='alert alert-danger'>old password not matched!</div>";
       }elseif($new_pass != $confirm_pass){
          $message = "<div class='alert alert-danger'>confirm password not matched!</div>";
       }else{
          mysqli_query($conn, "UPDATE `details` SET password = '$confirm_pass' WHERE id = '$user_id'") or die('query failed');
          echo "<script> alert('Password Updated Succesfully!!') </script>"; 
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
  <link rel="stylesheet" href="bootstrap/js/bootstrap.bundle.js">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> 
  <title>Document</title>

  <style>
    body{
    background: -webkit-linear-gradient(left, #3931af, #00c6ff);
    font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
    background-color: #fff;
    color: #333;

      }
   
      .dark-mode{
          background-color: #333;
          color: white;
        }

:root{
  --white-color: #fff;
  --blue-color: #4070f4;
  --grey-color: #707070;
  --grey-color-light: #aaa;
}
.emp-profile{
    padding: 3%;
    margin-top: 3%;
    margin-bottom: 3%;
    border-radius: 0.5rem;
    background: #fff;
}
.profile-img{
    text-align: center;
}
.profile-img img{
    width: 70%;
    height: 100%;
}
.profile-img .file {
    position: relative;
    overflow: hidden;
    margin-top: -10%;
    width: 70%;
    border: none;
    border-radius: 0;
    font-size: 15px;
    background: #212529b8;
}
.profile-img .file input {
    position: absolute;
    opacity: 0;
    right: 0;
    top: 0;
}
.profile-head h5{
    color: #333;
}
.profile-head h6{
    color: #0062cc;
}
.profile-edit-btn{
    border: none;
    border-radius: 1.5rem;
    width: 70%;
    padding: 2%;
    font-weight: 600;
    color: #6c757d;
    cursor: pointer;
}
.proile-rating{
    font-size: 12px;
    color: #818182;
    margin-top: 5%;
}
.proile-rating span{
    color: #495057;
    font-size: 15px;
    font-weight: 600;
}
.profile-head .nav-tabs{
    margin-bottom:5%;
}
.profile-head .nav-tabs .nav-link{
    font-weight:600;
    border: none;
}
.profile-head input{
    border:none;
    outline:none;
    border-bottom: 2px solid gainsboro;
    color: var(--blue-color)
}
.profile-head .nav-tabs .nav-link.active{
    border: none;
    border-bottom:4px solid #0062cc;
}
.profile-work{
    padding: 14%;
    margin-top: -15%;
}
.profile-work p{
    font-size: 12px;
    color: #818182;
    font-weight: 600;
    margin-top: 10%;
}
.profile-tab label{
    font-weight: 600;
}
.profile-tab input{
    border: none;
    outline: none;
    border-bottom: 2px solid gainsboro;
    color: var(--blue-color);
    width: 200px;
}
.edit-btn{
  margin-left: 60%;
  margin-top: 5%;
}
.icon{
    margin-left:-15px;
}
  </style>

  <script>
        // Dark Mood
        function toggleDarkMode() {
       const body = document.body;
      const darkModeToggle = document.getElementById('sun');
      const darkModeEnabled = body.classList.toggle('dark-mode');

  if (darkModeEnabled) {
    darkModeToggle.innerHTML = '<ion-icon name="moon"></ion-icon>'; 
  } else {
    darkModeToggle.innerHTML = '<ion-icon name="sunny"></ion-icon>'; 
  }
}

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
  <div class="container emp-profile">
            <section>
            <form method="post" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-md-4">
                        <div class="profile-img">
                        <?php
                         if($arrayData['image'] == ''){
                           echo '<img src="img/user.jpeg">';
                           }else{
                              echo '<img class="img-thumbnail" id="profile-image" src="uploaded_img/'.$arrayData['image'].'">';
                             }
                             ?>
                            <div class="file btn btn-lg btn-primary">
                                Change Photo
                                <input type="file" name="update_image" id="icon"/>
                            </div>
                         </div>
       

                    </div>
                    <div class="col-md-6">
                        <div class="profile-head">
                                    <h5>Chinmoy Datta Priom</h5>
                                    <input type="text" value="<?php echo $arrayData['profession'];?>" readonly></ion-icon>
                            <ul class="nav nav-tabs mt-5">
                                <li class="nav-item">
                                    <a class="nav-link active" id="" data-toggle="tab" href="#home">About</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="" data-toggle="tab" href="#password">Password</a>
                                </li>
                                <li class="nav-item">
                                  <a class="nav-link" id="" data-toggle="tab" href="#settings">Settings</a>
                              </li>
                                <li class="nav-item">
                                  <a class="nav-link" id="" data-toggle="tab" href="#logout">Logout</a>
                              </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="profile-work">
                            <p>HOBBIES</p>
                            <input type="text" name="hobby1" class="file-control" value="<?php echo $arrayData['hobby1'];?>" style="border:none; outline:none; border-bottom: 2px solid gainsboro;">
                             <ion-icon class="icon" name="create-outline"></ion-icon></a><br/>
                             <input type="text" name="hobby2" class="file-control" value="<?php echo $arrayData['hobby2'];?>" style="border:none; outline:none; border-bottom: 2px solid gainsboro;">
                             <ion-icon class="icon" name="create-outline"></ion-icon></a><br/>
                             <input type="text" name="hobby3" class="file-control" value="<?php echo $arrayData['hobby3'];?>" style="border:none; outline:none; border-bottom: 2px solid gainsboro;">
                             <ion-icon class="icon" name="create-outline"></ion-icon></a><br/>
                            <p>SKILLS</p>
                            <input type="text" name="skill1" class="file-control" value="<?php echo $arrayData['skill1'];?>" style="border:none; outline:none; border-bottom: 2px solid gainsboro;">
                             <ion-icon class="icon" name="create-outline"></ion-icon></a><br/>
                             <input type="text" name="skill2" class="file-control" value="<?php echo $arrayData['skill2'];?>" style="border:none; outline:none; border-bottom: 2px solid gainsboro;">
                             <ion-icon class="icon" name="create-outline"></ion-icon></a><br/>
                             <input type="text" name="skill3" class="file-control" value="<?php echo $arrayData['skill3'];?>" style="border:none; outline:none; border-bottom: 2px solid gainsboro;">
                             <ion-icon class="icon" name="create-outline"></ion-icon></a><br/>
                             
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="tab-content profile-tab">
                            <div class="tab-pane fade show active" id="home">
                            <?php echo $message;?>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Name</label>
                                            </div>
                                            <div class="col-md-6">
                                              <input type="text" name="update_name" value="<?php echo $arrayData['name'];?>"><ion-icon class="icon" name="create-outline"></ion-icon>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Email</label>
                                            </div>
                                            <div class="col-md-6">
                                              <input type="fixed" value="<?php echo $arrayData['email'];?>" readonly>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Phone</label>
                                            </div>
                                            <div class="col-md-6">
                                              <input type="number" name="update_phone" value="<?php echo $arrayData['phone'];?>"><ion-icon class="icon" name="create-outline"></ion-icon>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Country</label>
                                            </div>
                                            <div class="col-md-6">
                                                <input type="text" name="update_country" value="<?php echo $arrayData['country'];?>"><ion-icon class="icon" name="create-outline"></ion-icon> 
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Profession</label>
                                            </div>
                                            <div class="col-md-6">
                                              <input type="text" name="update_profession" value="<?php echo $arrayData['profession'];?>"><ion-icon class="icon" name="create-outline"></ion-icon>
                                            </div>
                                        </div>
                                        <div class="col-md-2 edit-btn">
                                          <input type="submit" class="btn btn-outline-primary edit-btn" name="update_details" value="Update Details"/>
                                      </div>
                            </div>
                            <div class="tab-pane" id="password">
                            <?php echo $message;?>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Old Password</label>
                                            </div>
                                            <div class="col-md-6">
                                                <input type="text" name="old_pass" class="file-control" value="<?php echo $arrayData['password'];?>" readonly>
                                            </div>
                                        </div>
                                        <div class="row">
                                          <div class="col-md-6">
                                              <label>Current Password</label>
                                          </div>
                                          <div class="col-md-6">
                                              <input type="password" name="current_pass" class="file-control" pattern="^(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z])(?=.*[@#$%^&-+=()]).{6,20}" 
                                              title="contain 1 digit 1 uppercase 1 lowercase 1 special charecter minimum 6 length"><ion-icon class="icon" name="create-outline"></ion-icon>
                                          </div>
                                      </div>
                                      <div class="row">
                                        <div class="col-md-6">
                                            <label>New Password</label>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="password" name="new_pass" class="file-control" pattern="^(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z])(?=.*[@#$%^&-+=()]).{6,20}" 
                                            title="contain 1 digit 1 uppercase 1 lowercase 1 special charecter minimum 6 length"><ion-icon class="icon" name="create-outline"></ion-icon>
                                        </div>
                                    </div>
                                    <div class="row">
                                      <div class="col-md-6">
                                          <label>Confirm New Password</label>
                                      </div>
                                      <div class="col-md-6">
                                          <input type="password" name="confirm_pass" class="file-control"  pattern="^(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z])(?=.*[@#$%^&-+=()]).{6,20}" 
                                          title="contain 1 digit 1 uppercase 1 lowercase 1 special charecter minimum 6 length"><ion-icon class="icon" name="create-outline"></ion-icon>
                                      </div>
                                  </div>
                                  <div class="col-md-2 edit-btn">
                                    <input type="submit" class="btn btn-outline-primary" value="Update Password" name="update_password"/>
                                </div>
                                </form>
                                    </div>
                                    <div class="tab-pane" id="settings">
                                      <div class="row">
                                        <div class="col-md-6">
                                        <button id="sun" onclick="toggleDarkMode()"><ion-icon name="sunny"></ion-icon></button>
                                    </div>
                                    </div>
                                    </div>

                                    <div class="tab-pane" id="logout">
                                      <div class="row">
                                        <div class="col-md-6">
                                        <?php
                                        include 'config.php';

                                        $query = mysqli_query($conn, "SELECT * FROM details WHERE email='{$_SESSION['SESSION_EMAIL']}'");

                                         if (mysqli_num_rows($query) > 0) {
                                        $row = mysqli_fetch_assoc($query);

                                         echo " <a href='logout.php'>Logout</a> From "  . $row['name'] . "" ;
                                                  }
                                               ?>
                                      </div>
                                    </div>
                               </div>
                            </div>
                        </div>
                    </div>
                </div>
             </section>           
        </div>

        <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

        <!-- ICON -->
        <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
        <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>
</html>