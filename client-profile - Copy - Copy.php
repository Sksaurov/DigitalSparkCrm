<?php
include "config.php";
$output="";
session_start();
if (!isset($_SESSION['unique_id'])) {
 
  header("Location: admin-login.php");
  die();
}
$unique_id = $_SESSION['unique_id'];
$user_id = mysqli_real_escape_string($conn, $_GET['user_id']);

$query ="SELECT * FROM `details` WHERE unique_id ='$user_id'";
$allData = mysqli_query($conn,$query);

$query1 ="SELECT * FROM `crm_wallet` WHERE unique_id ='$user_id'";
$allData1 = mysqli_query($conn,$query1);

$wallet = mysqli_fetch_assoc($allData1);
$arrayData = mysqli_fetch_assoc($allData);
$message = "";

if(isset($_POST['password'])){
    
    $old_pass = $_POST['old_pass']; 
    $current_pass = $_POST['current_pass'];
    $new_pass = $_POST['new_pass'];
    $confirm_pass =$_POST['confirm_pass'];

    $pass_Pattern = "/((?=.*[0-9])(?=.*[a-z])(?=.*[A-Z])(?=.*[@#$%^&-+=()])).{6,20}/";

    if(!preg_match($pass_Pattern,$new_pass)){
        $message= "<div class='alert alert-warning' style='margin-top:-12px;'>Contain 1 Uppercase 1 Lowercase 1 Digit & 1 Special Characters!</div>";
    }elseif(!empty($current_pass) || !empty($new_pass) || !empty($confirm_pass)){
       if($current_pass != $old_pass){
          $message = "<div class='alert alert-warning' style='margin-top:-12px;'>old password not matched!</div>";
       }elseif($new_pass != $confirm_pass){
          $message = "<div class='alert alert-warning' style='margin-top:-12px;'>confirm password not matched!</div>";
       }else{
          mysqli_query($conn, "UPDATE `details` SET password = '$confirm_pass' WHERE id = '$user_id'") or die('query failed');
          echo "<script> alert('Password Updated Succesfully!!') </script>"; 
       }
    }
  
  }

  // update Profile
if(isset($_POST['details'])){
    $update_name = $_POST['update_name'];
    $update_phone = $_POST['update_phone'];
    $update_country = $_POST['update_country'];
    $update_profession = $_POST['update_profession'];
    $interest1 = $_POST['interest1'];
    $interest2 = $_POST['interest2'];
    $interest3 = $_POST['interest3'];
    $update_bio = $_POST['bio'];
    $Bio = mysqli_real_escape_string($conn, $update_bio);

   // $email_pattern = "/(cse|eee|law)_\d{10}@lus\.ac\.bd/";

    $name_pattern = "/[A-Za-z ]+$/";
    $phone_pattern = "/(\+88)?-?01[3-9]\d{8}/";
    $country_pattern = "/[A-Za-z ]+$/";
    $profession_pattern = "/[A-Za-z ]+$/";
    $interest1_pattern = "/[A-Za-z ]+$/";
    $interest2_pattern = "/[A-Za-z ]+$/";
    $interest3_pattern = "/[A-Za-z ]+$/";
    $bio_pattern = "/[A-Za-z 0-9,.-]+$/";


    if(!preg_match($name_pattern,$update_name)){
        $message= "<div class='alert alert-danger' style='margin-top:-20px;'>Only Characters (Name Field)!</div>";
    }elseif(!preg_match($phone_pattern,$update_phone)){
        $message= "<div class='alert alert-danger' style='margin-top:-20px;'>Only Bangladeshi Phone Number!</div>";
    }elseif(!preg_match($country_pattern,$update_country)){
        $message= "<div class='alert alert-danger' style='margin-top:-20px;'>Only Characters (Country Field)!</div>";
    }elseif(!preg_match($profession_pattern,$update_profession)){
        $message= "<div class='alert alert-danger' style='margin-top:-20px;'>Only Characters (Profession Field)!</div>";  
    }elseif(!preg_match($interest1_pattern,$interest1)){
        $message= "<div class='alert alert-danger' style='margin-top:-20px;'>Only Characters (Interest Field)!</div>";
    }elseif(!preg_match($interest2_pattern,$interest2)){
        $message= "<div class='alert alert-danger' style='margin-top:-20px;'>Only Characters (Interest Field)!</div>";
    }elseif(!preg_match($interest3_pattern,$interest3)){
        $message= "<div class='alert alert-danger' style='margin-top:-20px;'>Only Characters (Interest Field)!</div>";
    }elseif(!preg_match($bio_pattern,$update_bio)){
        $message= "<div class='alert alert-danger' style='margin-top:-20px;'>Only Characters (Bio Field)!</div>";
    }else{
        mysqli_query($conn, "UPDATE `details` SET name = '$update_name' , bio = '$Bio' , phone ='$update_phone' , country= '$update_country' , profession= '$update_profession',
         interest1 = '$interest1' , interest2 = '$interest2' , interest3 = '$interest3' WHERE unique_id = '$user_id'") or die('query failed');
    //  echo "<script> alert('Details Updated Succesfully!!') </script>"; 
   
    }


     $update_image = $_FILES['update_image']['name'];
     $update_image_size = $_FILES['update_image']['size'];
     $update_image_tmp_name = $_FILES['update_image']['tmp_name'];
     $update_image_folder = 'uploaded_img/'.$update_image;
   
     if(!empty($update_image)){
           $image_update_query = mysqli_query($conn, "UPDATE `details` SET image = '$update_image' WHERE unique_id = '$user_id'") or die('query failed');
           if($image_update_query){
              move_uploaded_file($update_image_tmp_name, $update_image_folder);
           }
        //    $message= "<div class='alert alert-success'>Details Updated Successfully !</div>";
          
        }

        echo '<script>alert("Details Successfully Changed.");
        window.location.href = "client-profile.php?user_id='.$unique_id.'";
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" />

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

     <!-- Font Links -->
    <link href='https://fonts.googleapis.com/css?family=Salsa' rel='stylesheet'>

    <style>
        body{
            display: flex;
            align-items: center;
            justify-content: center;
            background: url('img/clientbg.jpg') no-repeat center center fixed;
            -webkit-background-size: cover;
            -moz-background-size: cover;
            -o-background-size: cover;
            background-size: cover;
            background-color: #08a0e9;
  
        }
        
       .profile-work input {
            border: none;
            outline: none;
            border-bottom: 1px solid #fff;
            background: transparent;
            color: #000000;
            width: 210px;
            margin-top: 10px;
            font-size: 0.9rem;
            font-weight: 500;
        }

        .details input{
            border: none;
            outline: none;
            border-bottom: 1px solid #08a0e9;
            background: transparent;
            color: #fff;
            margin-top: 10px;
            font-size: 0.9rem;
            font-weight: 500; 
        }
        .icon{
            color: #08a0e9;
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
    <div class="container-fluid" style="font-family: Salsa">
        <header class="d-flex">
            <a href="client-page.php" style="text-decoration: none;" class="text-light"><b>CRM</b></a>
        </header>
        <div class="row mt-2">
            <div class="col-md-3">
                <form method="post" enctype="multipart/form-data">
                <div class="card" style="height: 600px; background-color: rgb(0,0,0, 0.7); border-color: #08a0e9;">
                    <!-- Profile Image Section -->
                    <div class="profile-img mt-4 text-center">
                        <img class="img-fluid img-thumbnail" id="profile-image" src="uploaded_img/<?php echo $arrayData['image'] ?>" style="width: 90%; height: 100%;">
                        <div class="btn btn-lg text-light" style="position: relative; overflow: hidden; width: 90%; border-bottom-color: #08a0e9; border-radius: 0; font-size: 15px; background: #212529b8; margin-top: -60px;">
                            Change Photo
                            <input type="file" name="update_image" id="icon" style="position: absolute; opacity: 0; right: 0;">
                        </div>
                    </div>
                    <!-- Interest Section -->
                    <div class="profile-work mt-5 text-center">
                        <p class="text-primary">INTEREST</p>
                        <input type="text" name="interest1" class="text-light" value="<?php echo $arrayData['interest1']; ?>">
                        <ion-icon class="icon" name="create-outline"></ion-icon>
                        <input type="text" name="interest2" class="text-light"  value="<?php echo $arrayData['interest2']; ?>">
                        <ion-icon class="icon" name="create-outline"></ion-icon>
                        <input type="text" name="interest3" class="text-light" value="<?php echo $arrayData['interest3']; ?>">
                        <ion-icon class="icon" name="create-outline"></ion-icon>
                    </div>
                </div>
            </div>
            <div class="col-md-9">
                <div class="card " style="height: 600px; background-color: #fff; border-color: #08a0e9;">
                    <!-- Profile Information and Tabs -->
                    <div class="container mt-3">
                        <div class="row">
                            <div class="col-md-12">
                            <div class="message d-flex text-Dark">
                            <h3><?php echo $arrayData['name'] ?></h3>
                            <p style="margin-left: 190px; height: 10px;"><?php echo $message; ?></p>
                            </div>
                                <div class="profile-head text-primary" style="margin-top: -8px;">
                                    <h5 class="">Wallet : <?php echo $wallet['number'] ?></h5>
                                    <textarea class="mt-2 w-100 text-light" style="height: 120px; border-color: #08a0e9; background-color: #000" placeholder="Set Your Bio..." name="bio"><?php echo $arrayData['bio'] ?></textarea>
                                </div>
                                <!-- Nav Tabs -->
                                <ul class="nav nav-tabs mt-2" id="myTabs">
                                    <li class="nav-item">
                                        <a class="nav-link active btn btn-outline-primary" id="home-tab" data-bs-toggle="tab" href="#home">About</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link btn btn-outline-primary" id="password-tab" data-bs-toggle="tab" href="#order">Orders</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link btn btn-outline-primary" id="logout-tab" data-bs-toggle="tab" href="#logout">Logout</a>
                                    </li>
                                </ul>
                                <!-- Tab Content -->
                                <div class="tab-content mt-3">

                                    <div class="tab-pane fade show active" id="home">

                                       <div class="row">
                                        
                                        <div class="col-md-6">
                                            <div class="card " style="height: 230px; background-color: #000; border: 3px solid #8cd3fd; border-color: #8cd3fd">

                                                <div class="details mx-3 mt-2">
                                                <label class="text-primary">Name:</label>
                                                <input type="text" name="update_name" class="w-75" value="<?php echo $arrayData['name'] ?>" style="margin-left: 30px;"><ion-icon class="icon" name="create-outline"></ion-icon>

                                                </div>

                                                <div class="details mx-3">
                                                <label class="text-primary">Email:</label>
                                                <input type="text" name="email" class="w-75" value="<?php echo $arrayData['email'] ?>" style="margin-left: 32px;" readonly>
                                                </div>

                                                <div class="details mx-3">
                                                <label class="text-primary">Phone:</label>
                                                <input type="text" name="update_phone" class="w-75" value="<?php echo $arrayData['phone'] ?>" style="margin-left: 28px;"><ion-icon class="icon" name="create-outline"></ion-icon>
                                                </div>

                                                <div class="details mx-3">
                                                <label class="text-primary">Country:</label>
                                                <input type="text" name="update_country" class="w-75" value="<?php echo $arrayData['country'] ?>" style="margin-left: 14px;"><ion-icon class="icon" name="create-outline"></ion-icon>
                                                </div>

                                                <div class="details mx-3">
                                                <label class="text-primary">Profession:</label>
                                                <input type="text" name="update_profession" class="w-75" value="<?php echo $arrayData['profession'] ?>" style="margin-left: -2px;"><ion-icon class="icon" name="create-outline"></ion-icon>
                                                </div>

                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="card" style="height: 230px; background-color: #000; border: 3px solid #8cd3fd; border-color: #8cd3fd;">
                                            
                                                    <div class="details mx-3 mt-4">
                                                    <label class="text-primary">New Password:</label>
                                                    <input type="text" name="old_pass" class="w-50" value="<?php echo $arrayData['password'] ?>" style="margin-left: 65px; display: none">
                                                    <input type="text" name="new_pass" class="w-50" style="margin-left: 65px;"><ion-icon class="icon" name="create-outline"></ion-icon>
                                                    </div>
    
                                                    <div class="details mx-3 mt-3">
                                                    <label class="text-primary">Confirm Password:</label>
                                                    <input type="text" name="confirm_pass" class="w-50" style="margin-left: 40px;"><ion-icon class="icon" name="create-outline"></ion-icon>
                                                    </div>
    
                                                    <div class="details mx-3 mt-3">
                                                    <label class="text-primary">Cureent Password:</label>
                                                    <input type="text" name="current_pass" class="w-50" style="margin-left: 43px;"><ion-icon class="icon" name="create-outline"></ion-icon>
                                                    </div>
    
                                            
    
                                            </div>
                                        </div>
                                       </div>
                                
                                       <div class="button mt-4" style="margin-left: 590px;">
                                          <input type="submit" class="btn btn-outline-primary" value="Change Details" name="details"> 
                                          <input type="submit" class="btn btn-outline-primary" value="Change Password" name="password"> 
                                       </div>
                                       </form>
                                    </div>

                                    <div class="tab-pane fade" id="order">
                                    <?php 
                                        $id = $_SESSION['unique_id'];
                                        $sql = "SELECT * FROM project WHERE client_id = '$user_id'";
                                        $query = mysqli_query($conn, $sql);

                                        $output = "";
                                        $per = "";
                                        $status ="";
                                        if (mysqli_num_rows($query) == 0) {
                                            $output .= "No Order! Order Something..";
                                        } elseif (mysqli_num_rows($query) > 0) {
                                            $output .= '<div class="row">';
                                            while ($row = mysqli_fetch_assoc($query)) {

                                                  // Check conditions using elseif
                                                if ($row['status'] == "Pending") {
                                                    $per = "25";
                                                    $status = "Checking Your Requriments....";
                                                } elseif ($row['status'] == "On-Hold") {
                                                    $per = "50";
                                                    $status = "Working On Your Project....";
                                                } elseif ($row['status'] == "Processing") {
                                                    $per = "75";
                                                    $status = "Your Project Almost Ready...";
                                                } elseif ($row['status'] == "Done") {
                                                    $per = "100";
                                                    $status = "Your Project Complete";
                                                }


                                                $output .= '
                                                <div class="col-md-4" style="margin-top: -10px; between; padding-bottom: 17px;"> <!-- Adjust the column size based on your design -->
                                                        <div class="card text-light w-100" style="height: 150px; background-color: rgb(0,0,0, 0.7); border-color: rgb(254,190,16);">
                                                            <label class="mx-2">'.$row['name'].'</label>
                                                            <div class="progress mx-4" role="progressbar" aria-label="Profile progress bar" aria-valuenow="'.$per.'%" aria-valuemin="0" aria-valuemax="100" style="width: 220px;">
                                                                <div id="progress-1" class="progress-bar progress-bar-striped bg-warning text-dark" style="width: '.$per.'%">'.$per.'%</div>
                                                            </div>
                                                            <div class="d-flex mt-1 mx-2">
                                                                <label class="text-primary">End Date:</label>
                                                                <p class="mx-2">'.$row['end'].'</p>
                                                            </div>
                                                            <p class="mx-2" style="margin-top: -18px;">'.$status.'</p>

                                                            <form method="post" action="client-download.php">
                                                            <div class="download">
                                                                <input type="text" name="any" value="'.$row['file'].'" style="display: none ;" readonly>
                                                                <input type="submit" class="btn btn-outline-primary" value="Download" name="order" style="border-radius: 20px; margin-left: 90px; margin-top: -10px;">
                                                            </div>
                                                            </form>
                                                            
                                                        </div>
                                                </div>';
                                            }
                                            $output .= '</div>'; // Close the row
                                           
                                        }
                                        echo $output;
                                    ?>


                                    </div>
                                    <div class="tab-pane fade" id="logout">
                                        <div class="logout" style="margin-left: 300px; margin-top: 100px;">
                                        <a href="client-logout.php?logout_id=<?php echo $user_id; ?>"class="btn btn-lg btn-outline-primary"> LogOut From <?php echo $arrayData['name'] ?> ?</a>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

     <!-- ICON -->
     <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
     <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>

</html>
