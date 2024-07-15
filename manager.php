<?php 
  include "config.php";
  $output="";
  session_start();
  if (isset($_SESSION['unique_id'])) {
   
  $user_id = $_SESSION['unique_id'];

  $sql = mysqli_query($conn, "SELECT * FROM manager WHERE unique_id = {$user_id}");
  $data = mysqli_fetch_assoc($sql);

  $sql2 = mysqli_query($conn, "SELECT * FROM admin WHERE 1");
  $admin = mysqli_fetch_assoc($sql2);

  if (isset($_POST['submit'])) {
    $type = "manager";
    $name = explode(',', $_POST['name']);
    $project = explode(',', $_POST['project']);
    $dev1 = explode(',', $_POST['dev1']);
    $dev2 = explode(',', $_POST['dev2']);
    $dev3 = explode(',', $_POST['dev3']);
    $email = $_POST['email'];

    $file = $_FILES['file']['name'];
    $file_tmp_name = $_FILES['file']['tmp_name'];
    $file_folder = "project_file/" . $file;
    $txt = $_POST['txt'];
    move_uploaded_file($file_tmp_name, $file_folder);

    $manager_name = mysqli_real_escape_string($conn, trim($name[0]));
    $manager_id = mysqli_real_escape_string($conn, trim($name[1]));

    $project_name = mysqli_real_escape_string($conn, trim($project[0]));
    $project_id = mysqli_real_escape_string($conn, trim($project[1]));

    $dev1_name = mysqli_real_escape_string($conn, trim($dev1[0]));
    $dev1_id = mysqli_real_escape_string($conn, trim($dev1[1]));

    $dev2_name = mysqli_real_escape_string($conn, trim($dev2[0]));
    $dev2_id = mysqli_real_escape_string($conn, trim($dev2[1]));

    $dev3_name = mysqli_real_escape_string($conn, trim($dev3[0]));
    $dev3_id = mysqli_real_escape_string($conn, trim($dev3[1]));

    

    $sql2 = mysqli_query($conn, "INSERT INTO file (type, manager_name, manager_id, project_name, project_id, dev1_name, dev1_id, dev2_name, dev2_id, dev3_name, dev3_id, email, file, details) 
    VALUES ('$type','$manager_name', '$manager_id', '$project_name', '$project_id', '$dev1_name', '$dev1_id', '$dev2_name', '$dev2_id', '$dev3_name', '$dev3_id', '$email', '$file', '$txt')");


    
      $sql5 ="UPDATE `project` SET file = '$file' WHERE manager_id ='$manager_id' and unique_id = '$project_id'";      
        $result5 = mysqli_query($conn, $sql5);
    

      

      echo '<script>alert("Project Submission Done!");
           window.location.href = "manager.php";
           </script>';
  }


  if (isset($_POST['sk1'])) {
    $skill_1 = $_POST['skill_1'];
    $updateQuery = "UPDATE manager SET skill_1='$skill_1' WHERE unique_id='$user_id'";
    mysqli_query($conn, $updateQuery);

    echo '<script>alert("Updated!");
    window.location.href = "manager.php";
    </script>';
    
}


if (isset($_POST['sk2'])) {
    $skill_2 = $_POST['skill_2'];
    $updateQuery = "UPDATE manager SET skill_2='$skill_2' WHERE unique_id='$user_id'";
    mysqli_query($conn, $updateQuery);

    echo '<script>alert("Updated!");
  window.location.href = "manager.php";
  </script>';
    
}



if (isset($_POST['sk3'])) {
    $skill_3 = $_POST['skill_3'];
    $updateQuery = "UPDATE manager SET skill_3='$skill_3' WHERE unique_id='$user_id'";
    mysqli_query($conn, $updateQuery);

    echo '<script>alert("Updated!");
    window.location.href = "manager.php";
    </script>';
    
}

if (isset($_POST['sk4'])) {
    $skill_4 = $_POST['skill_4'];
    $updateQuery = "UPDATE manager SET skill_4='$skill_4' WHERE unique_id='$user_id'";
    mysqli_query($conn, $updateQuery);

    echo '<script>alert("Updated!");
    window.location.href = "manager.php";
    </script>';
    
}


if (isset($_POST['bio'])) {
    $aboutData = $_POST['text']; 
    $updateQuery = "UPDATE manager SET bio='$aboutData' WHERE unique_id='$user_id'";
    mysqli_query($conn, $updateQuery);

    echo '<script>alert("Updated!");
    window.location.href = "manager.php";
    </script>';
    
}

if (isset($_POST['image'])) {
  $update_image = $_FILES['image']['name'];
   $update_image_size = $_FILES['image']['size'];
   $update_image_tmp_name = $_FILES['image']['tmp_name'];
   $update_image_folder = 'uploaded_img/'.$update_image;
 
  
         $image_update_query = mysqli_query($conn, "UPDATE `manager` SET profile = '$update_image' WHERE unique_id = '$user_id'") or die('query failed');

            move_uploaded_file($update_image_tmp_name, $update_image_folder);
      
      //    $message= "<div class='alert alert-success'>Details Updated Successfully !</div>";
        
      

      echo '<script>alert("Updated!");
      window.location.href = "manager.php";
      </script>';
  
}

if (isset($_POST['sk'])) {
  $skill = $_POST['skill'];
  $updateQuery = "UPDATE manager SET skill='$skill' WHERE unique_id='$user_id'";
  mysqli_query($conn, $updateQuery);

  echo '<script>alert("Updated!");
  window.location.href = "manager.php";
  </script>';  
  
}

if (isset($_POST['ex'])) {
$ex = $_POST['ext'];
$updateQuery = "UPDATE manager SET experience='$ex' WHERE unique_id='$user_id'";
mysqli_query($conn, $updateQuery);

echo '<script>alert("Updated!");
window.location.href = "manager.php";
</script>';

}


  }else{
    header("Location: index.php");

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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    

    
    <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

  <!-- Font Links -->
<link href='https://fonts.googleapis.com/css?family=Salsa' rel='stylesheet'>
<link href='https://fonts.googleapis.com/css?family=Spicy Rice' rel='stylesheet'>
<link href='https://fonts.googleapis.com/css?family=Squada One' rel='stylesheet'>
<link href='https://fonts.googleapis.com/css?family=Suez One' rel='stylesheet'>
<link href='https://fonts.googleapis.com/css?family=Timmana' rel='stylesheet'>

    <!-- Your custom CSS variables -->

    <style>

    body{
  display: flex;
  align-items: center;
  justify-content: center;
  background: url('img/man-bggg.jpg') no-repeat center center fixed;
            -webkit-background-size: cover;
            -moz-background-size: cover;
            -o-background-size: cover;
            background-size: cover; 
  
        }

    .nav {
      background-color: rgb(0,0,0,0.7); 
    
    }

    .nav-link.active,
    .nav-link:active {
      background-color: rgb(255, 255, 255,0.9) !important;
      margin-left: 8px;
      width: 195px;
      height: 40px;
      color: black !important;
    }

        img {
            object-fit: cover;
            border-radius: 50%;
            height: 45px;
            width: 45px;
            margin-left: 30px;
        }

        #profile img {
        object-fit: cover;
        width: 70%;
        height: 90%;
        border-radius: 50%;
        border: 10px solid; /* Specify border style */
        margin-top: 5%;
        margin-left: 15%;
      }

        .progress-bar {
            width: 0;
            transition: width 0.3s ease;
        }

      
        .loader {
          border: 16px solid rgb(0,0,0,0.9);
          border-radius: 50%;
          border-top: 16px ;
          width: 80px;
          height: 80px;
          -webkit-animation: spin 2s linear infinite;
          animation: spin 2s linear infinite;
          margin-top: 30px;
          margin-left: 40px;
        }

        @-webkit-keyframes spin {
          0% { -webkit-transform: rotate(0deg); }
          100% { -webkit-transform: rotate(360deg); }
        }

        @keyframes spin {
          0% { transform: rotate(0deg); }
          100% { transform: rotate(360deg); }
        }

        .ket::-webkit-scrollbar { 
        display: none; 
 }
</style>


</head>
<body>
    <div class="container-fluid mt-1">
        <div class="row">

    <!-- Sidebar -->
    <div class="col-md-2" id="sidebar" style="margin-top: 90px;" >
    <ul class="nav nav-pills flex-column  mt-1 card" style="border-radius: 10px; width: 215px; height: 470px; position: fixed; border: 2px solid rgb(255, 255, 255,0.7) " role="tablist">
      <header class="justify-content-center align-items-center " style="background-color:rgb(255, 255, 255,0.9);border-radius: 10px 10px 0px 0px; width: 211px">
        <img src="uploaded_img\<?php echo $data['profile'] ?>" class="mt-3" style="object-fit: cover; border-radius: 50%; height: 60px; width: 60px; margin-left: 80px;">
        <p class="text-dark mt-2 " style="margin-left: 30px; font-family: Salsa;"><?php echo $data['name']; ?></p>
      </header>
      <li class="nav-item mt-3">
        <a class="nav-link d-flex active" data-bs-toggle="pill" style="color: #fff" href="#pogo"><i class="fa fa-keyboard-o px-4" style="font-size:20px;"></i><b>Project</b></a>
      </li>     
      <li class="nav-item mt-3">
        <?php 

          $sql0 = "SELECT * FROM messages WHERE msg_id = (SELECT MAX(msg_id)  FROM messages WHERE (incoming_msg_id = {$user_id} AND outgoing_msg_id = {$admin['unique_id']}))";
          $query2 = mysqli_query($conn, $sql0);
          $result1 = '';
          if ($query2) {
              if (mysqli_num_rows($query2) > 0) {
                  $row2 = mysqli_fetch_assoc($query2);
                  $result1 = $row2['msg_id'];
              }
          }


          $sql3 = "SELECT * FROM messages WHERE msg_id = (SELECT MAX(msg_id) FROM messages WHERE (incoming_msg_id = {$admin['unique_id']} AND outgoing_msg_id = {$user_id}))";
          $query3 = mysqli_query($conn, $sql3);

          $result2 = '';
          if ($query3) {
              if (mysqli_num_rows($query3) > 0) {
                  $row3 = mysqli_fetch_assoc($query3);
                  $result2 = $row3['msg_id'];
              }
          }
        $count = "";

    if($result2 < $result1) {
      $count .= '<div class="card bg-warning" style="border-radius: 20px; width: 15px; height: 15px;"></div>
      ';

       }else{
        
       }
        ?>
        <a class=" d-flex " href="manager-admin-chat.php?user_id=<?php echo $admin['unique_id'] ?>" style="color: #fff"  style="text-decoration: none;">
        <i class="fa fa-user px-4" style="font-size:20px; margin-left: 17px;"></i><b>Admin</b><b class="mx-5 text-warning"><?php echo $count; ?></b></a>
      </li>
      <li class="nav-item mt-3">
        <a class="nav-link  d-flex " data-bs-toggle="pill" href="#profile" style="color: #fff" ><i class="fa fa-bar-chart px-4" style="font-size:20px"></i><b>Profile</b></a>
      </li>  
      <li class="nav-item mt-3">
        <a class="nav-link d-flex t" data-bs-toggle="pill" href="#file" style="color: #fff" ><i class="fa fa-file-archive-o px-4" style="font-size:20px"></i><b>Files</b></a>
      </li>  
      <li class="nav-item mt-3">
        <a class="nav-link d-flex t" data-bs-toggle="pill" href="#contact" style="color: #fff" ><i class="fa fa-file-invoice px-4" style="font-size:20px"></i><b>Submission</b></a>
      </li>
      <li class="nav-item mt-3">
        <a class="nav-link d-flex " data-bs-toggle="modal" data-bs-target="#logout" style="cursor:pointer;color: #fff" >             
        <i class="fas fa-sign-out-alt px-4" style="font-size: 24px;"></i><b>Logout</b></a>
      </li>
    </ul>
     <!-- slider end -->
    </div>

        

  <!-- Tab panes -->
  <div class="col-md-8">
      <div class="tab-content" style="font-family: Salsa">
          <!-- Dashboard Tab -->
    
      <div id="pogo" class="container tab-pane">
                <div class="d-flex" style="margin-left: 20px; position: fixed">
                    <div class="card  mt-2 w-100" style="height: 620px; margin-left: -17px; border-radius: 20px; background-color: rgb(0,0,0,0.7);border: 4px solid rgb(255, 255, 255,0.9);">

                      <div class="container d-flex mx-4 mt-4" style="height: 200px; ">

                      <?php
                      $sql1 = "SELECT COUNT(*) as manager_id FROM project WHERE manager_id = '$user_id'";
                      $result1 = mysqli_query($conn, $sql1);
                      $row1 = mysqli_fetch_assoc($result1);
                      $project_count = $row1['manager_id']; 
                      $developer_count = 3 * $project_count;

                      // $sql = "SELECT COUNT(DISTINCT developer_id) as unique_developer_count FROM project WHERE manager_id = '$user_id'";
                      // $result = mysqli_query($conn, $sql);
                      // $row = mysqli_fetch_assoc($result);
                      // $unique_developer_count = $row['unique_developer_count'];
                      // $developer_count = 3 * $unique_developer_count;


                      $sql2 = "SELECT COUNT(*) as status FROM project
                      WHERE  manager_id = {$user_id} 
                      AND status <> 'Pending'";
                      $result2 = mysqli_query($conn, $sql2);
                      $row2 = mysqli_fetch_assoc($result2);
                      $working_project = $row2['status'];
                      
                      
                      
                      ?>

                        <div class="card col-md-3 mx-4" style="border-radius: 20px; background-color: rgb(255, 255, 255,0.9); border-color: rgb(255, 255, 255,0.9);">
                          <p class="mt-2 w-100 text-dark" style="margin-left: 30px;"><b>Total Project</b></p>
                          <span class="text-dark" style="margin-left: 65px; font-size: 24px; margin-top: -20px;"><b><?php echo $project_count ?></b></span>
                          <div class=" loader ""></div>
                          
                        </div>

                        <div class="card bg-worning col-md-3 mx-4" style="border-radius: 20px; background-color: rgb(255, 255, 255,0.9); border-color: rgb(255, 255, 255,0.9);">
                        <p class="mt-2  w-100 text-dark" style="margin-left: 25px;"><b>Total Developer</b></p>
                        <span class="text-dark" style="margin-left: 68px; font-size: 24px; margin-top: -20px;"><b><?php echo $developer_count ?></b></span>
                        <div class="loader"></div>
                        </div>

                        <div class="card bg-worning col-md-3 mx-4" style="border-radius: 20px; background-color: rgb(255, 255, 255,0.9); border-color: rgb(255, 255, 255,0.9);">
                        <p class="mt-2 w-100 text-dark" style="margin-left: 30px;"><b>Working On</b></p>
                        <span class="text-dark" style="margin-left: 60px; font-size: 24px; margin-top: -20px;"><b><?php echo $working_project ?></b></span>
                        <div class="loader"></div>
                        </div>

                    </div>

                    <div class="container">
                        <div class="card w-100   ket" style="height: 310px; border-radius: 20px; max-height: 430px; margin-top: 60px; overflow-y: auto; background-color: rgb(0,0,0,0.6); border: 4px solid rgb(255, 255, 255,0.9);">
                        <div class="d-flex mt-3" style="font-family: Impact, Haettenschweiler, 'Arial Narrow Bold', sans-serif;"> 
                        <p class="text-light" style="margin-left: 30px;">Project</p>
                        <p class="text-light px-5" style="margin-left: 240px;">Progress</p>
                        <p class="text-light px-5" style="margin-left: 130px; margin-right: 20px;">Status</p>
                      </div>
                      <?php  
                    $id = $_SESSION['unique_id'];
                    $sql = "SELECT * FROM project WHERE manager_id = '$id'";
                    $query = mysqli_query($conn, $sql);

                    $output = "";

                    if (mysqli_num_rows($query) == 0) {
                        $output .= '<div class="text-light"> You Have No Project Yet </div>';
                    } elseif (mysqli_num_rows($query) > 0) {
                        while ($row = mysqli_fetch_assoc($query)) {
                            $per = "";

                            // Check conditions using elseif
                            if ($row['status'] == "Pending") {
                                $per = "25";
                            } elseif ($row['status'] == "On-Hold") {
                                $per = "50";
                            } elseif ($row['status'] == "Processing") {
                                $per = "75";
                            } elseif ($row['status'] == "Done") {
                                $per = "100";
                            }

                            // Display user information and progress bar
                            $output .= '<div style="display: flex; position: relative; align-items: center; cursor: pointer; 
                                padding-bottom: 0px; border-bottom: 1px solid #e6e6e6; justify-content: space-between; margin-bottom: 15px;
                                padding-right: 15px; border-bottom-color: #f1f1f1; text-decoration: none; margin-top: 5px; ">
                                <div class="content" style="display: flex; align-items: center;">
                                    <div class="details" style="color: #fff; margin-left: 20px;">
                                        
                                            <span class="text-light" style=" font-size: 17px; font-family: bold;"><b>' . $row['name'] . '</b></span>
                                            
                                        </div>
                                    </div>
                                    <div class="status-dot d-flex" style="position: relative; margin-right: -90px;">
                                        <div class="container" style="margin-right: -140px; width: 300px;">
                                            <div class="progress" style="border: 2px solid rgb(255, 255, 255,0.7) ">
                                                <div class="progress-bar progress-bar-striped bg-warning text-dark" role="progressbar" aria-valuenow=' . $per . ' aria-valuemin="0" aria-valuemax="100" style="width:' . $per . '%">
                                                    ' . $per . '%
                                                </div>
                                            </div>
                                        </div>
                                        <div class="container">
                                            <p class="date text-light " style="margin-left: 240px; width: 100px;"><b>' . $row['status'] . '</b></p>
                                        </div>
                                    </div>
                                </div>';
                        }
                        
                    } 
                    echo $output;    
                ?>

                        </div>

                      </div>
                </div>
                </div>
            </div>


        <div id="profile" class="container tab-pane">
            <div class="d-flex" style="margin-left: 0px; position: fixed">
            <div class="card  mt-1 ket" style="height: 625px; width: 788px; margin-left: 0px; border-radius: 20px; max-height: 640px;
              margin-top: 60px; overflow-y: auto; background-color: rgb(0,0,0,0.6); border: 4px solid rgb(255, 255, 255,0.9);">                                     

    <form method="post" enctype="multipart/form-data">
        <div class="row">

              <div class="col-md-6">

              <img class="border-outline-primary " src="uploaded_img\<?php echo $data['profile'] ?>" alt="">
              <div class="div" style="z-index:1;margin-left:70% ">
              <a class="btn btn-outline-light border-2 p-2" href="#" id="cameraIcon2"
              style="border-radius: 50%; margin-top:-90%;"><i class="fa fa-camera"></i>
              </a>
              </div>
              <div class="dropdown-menu bg-light mx-5" id="imageDropdown">
              <input type="file" name="image" id="image">
              <button name="image" style="margin-left: 200px;margin-top: -20px;">Change Image</button>
              </div>


              <!-- col-md-6 -->
              </div>

              <div class="col-md-6">
                    
                    <div class="text-light">
                    <p class="mt-2 text-warning"><b>Manager</b></p>
                    <h4><b><?php echo $data['name'] ?></b></h4>
                    <textarea class="form-control text-light ket" id="txt" type="text" name="text" style="width: 370px; height:150px; background-color: rgb(0,0,0,0.8); border-color: rgb(255, 255, 255,0.9);"><?php echo $data['bio']  ?></textarea>
                    <button name="bio" class="btn btn-outline-light mt-2"><i style="" class="fa-solid fa-pen-to-square"></i></button>
                    </div>
              </div>

              <div class="text-light mx-2 col-md-12 text-center" style="position: relative;">
                  <hr class="my-2 bg-light" style="">
                  <span style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);"><b>What I Do</b></span>
              </div>

              <div class="col-md-6">
                    

                    <div class="text-light mx-1 mt-3">
                      <button name="sk1" class="btn btn-outline-light"><i style="" class="fa-solid fa-folder-open"></i></button>
                      <textarea class="form-control mt-2 text-light ket" id="txt" type="text" name="skill_1" style="height: 80px ; background-color: rgb(0,0,0,0.8); border-color: rgb(255, 255, 255,0.9);;"><?php echo $data['skill_1'] ?></textarea>
                    </div>

                      <div class="text-light mx-1 mt-2">
                      <button name="sk2" class="btn btn-outline-light"><i style="" class="fa-solid fa-share-from-square"></i></button>
                      <textarea class="form-control mt-2 text-light ket" id="txt" type="text" name="skill_2" style="height: 80px ; background-color: rgb(0,0,0,0.8); border-color: rgb(255, 255, 255,0.9);"><?php echo $data['skill_2']  ?></textarea>
                    </div>
              </div>

              <div class="col-md-6">
                    

                      <div class="text-light mx-1 mt-3">
                        <button name="sk3" class="btn btn-outline-light"><i style="" class="fa-solid fa-folder-open"></i></button>
                        <textarea class="form-control mt-2 text-light ket" id="txt" type="text" name="skill_3" style="height: 80px ; background-color: rgb(0,0,0,0.8); border-color: rgb(255, 255, 255,0.9);,190,16);"><?php echo $data['skill_3'] ?></textarea>
                      </div>

                        <div class="text-light mx-1 mt-2">
                        <button name="sk4" class="btn btn-outline-light"><i style="" class="fa-solid fa-print"></i></button>
                        <textarea class="form-control mt-2 text-light ket" id="txt" type="text" name="skill_4" style="height: 80px ; background-color: rgb(0,0,0,0.8); border-color: rgb(255, 255, 255,0.9);"><?php echo $data['skill_4'] ?></textarea>
                      </div>
                </div>

                <div class="text-light mx-2 col-md-12 text-center mt-5" style="position: relative;">
                  <hr class="my-2 bg-light" style="">
                  <span style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);"><b>Skill & Experience</b></span>
              </div>

                <div class="col-md-6">
                            <div class="text-light mx-1 mt-3">
                              <button name="sk" class="btn btn-outline-light"><i style="" class="fa-solid fa-folder-open"></i></button>
                              <textarea class="form-control mt-2 text-light ket" id="txt" type="text" name="skill" style="height: 120px ; background-color: rgb(0,0,0,0.8); border-color: rgb(255, 255, 255,0.9);"><?php echo $data['skill'] ?></textarea>
                            </div>
                </div>

                <div class="col-md-6">
                              <div class="text-light mx-1 mt-3">
                              <button name="ex" class="btn btn-outline-light"><i style="" class="fa-solid fa-print"></i></button>
                              <textarea class="form-control mt-2 text-light ket" id="txt" type="text" name="ext" style="height: 120px ; background-color: rgb(0,0,0,0.8); border-color: rgb(255, 255, 255,0.9);"><?php echo $data['experience'] ?></textarea>
                            </div>
                </div>

                <div class="col-md-6" style="opacity: 0;">
                              <div class="text-light mx-1 mt-3">
                            </div>
                </div>


        <!-- row -->
        </div>

        </form>

                  </div>
                  </div>
              </div>


    <div id="file" class="container tab-pane">
        <div class="d-flex" style="margin-left: 0px; position: fixed">

        <div class="card  mt-2 ket" style="height: 620px; width: 788px; margin-left: 0px; border-radius: 20px; max-height: 620px;
          margin-top: 60px; overflow-y: auto; background-color: rgb(0,0,0,0.6); border: 4px solid rgb(255, 255, 255,0.9);">
                
              
                <div class="d-flex mt-3" style="font-family: Impact, Haettenschweiler, 'Arial Narrow Bold', sans-serif;"> 
                <p class="text-light" style="margin-left: 30px;">Dev-Name</p>
                <p class="text-light px-5" style="margin-left: 180px;">Email</p>
                <p class="text-light px-5" style="margin-left: 90px;">Project-ID</p>
              </div>
              <?php  
            $id = $_SESSION['unique_id'];
            $sql = "SELECT * FROM file WHERE manager_id = '$id' AND type = 'developer'";
            $query = mysqli_query($conn, $sql);

            $output = "";

            if (mysqli_num_rows($query) == 0) {
                $output .= '<div class="text-light"> You Have No Project Yet </div>';
            } elseif (mysqli_num_rows($query) > 0) {
                while ($row = mysqli_fetch_assoc($query)) {
                  $id = $_SESSION['unique_id'];
                  $sql2 = "SELECT * FROM file WHERE manager_id = '$id' AND type = 'developer'";
                  $query2 = mysqli_query($conn, $sql2);
                  $row2 = mysqli_fetch_assoc($query2);
                  $result = (mysqli_num_rows($query2) > 0) ? $row2['dev_name'] : "";
                  $name = (strlen($result) > 20) ? substr($result, 0, 20) . '...' : $result;

                  $result2 = (mysqli_num_rows($query2) > 0) ? $row2['dev_email'] : "";
                  $email = (strlen($result2) > 25) ? substr($result2, 0, 25) . '...' : $result2;
                    

                    // Display user information and progress bar
                    $output .= '<div style="display: flex; position: relative; align-items: center; cursor: pointer; 
                        padding-bottom: 0px; border-bottom: 1px solid #e6e6e6; justify-content: space-between; margin-bottom: 15px;
                        padding-right: 15px; border-bottom-color: #f1f1f1; text-decoration: none;">
                        <div class="content" style="display: flex; align-items: center;">
                            <div class="details" style="color: #fff; margin-left: 20px;">
                                
                                    <span class="text-light" style=" font-size: 17px; font-family: bold; "><b>' . $name . '</b></span>
                                    
                                </div>
                            </div>
                            <div class="status-dot d-flex" style="position: relative; margin-right: -90px;">
                                <div class="container" style="margin-right: -50px; width: 300px;">
                                <span class="text-light" style=" font-size: 17px; font-family: bold;"><b>' . $email . '</b></span>
                                </div>

                                <div class="container">
                                    <p class="date text-light " style="margin-left: 140px; width: 40px;"><b>' . $row['project_id'] . '</b></p>
                                </div>

                            </div>

                            <form action="manager-download.php" method="post" enctype="multipart/form-data">
                              <input type="text" name="any" style="display: none" value="'.$row['file'].'">
                            <button type="submit" class="btn btn-outline-light" style="margin-bottom: 10px;">Download</button>
                            </form>

                        </div>';
                }
                
            } 
            echo $output;    
        ?>

                </div>



              </div>
        </div>
                        


                    
                      
      <div id="contact" class="container tab-pane">
            <div class="d-flex" style="margin-left: 0px; position: fixed">
                <div class="card  mt-2" style="height: 625px; width: 788px; margin-left: 0px; border-radius: 20px; background-color: rgb(0,0,0,0.6); border: 4px solid rgb(255, 255, 255,0.9);">
                  

          <div class="container mt-2 text-dark">
        <div class="row">

          <div class="col-md-6 mt-2">
            <h2 class="text-light">Project Submission</h2>
            <form action="#" method="POST" enctype="multipart/form-data">
                <label for="name" class="text-warning">Your Name & Unique ID</label>
                <input type="text" class="form-control btn btn-outline-light" style="" id="name" name="name" value="

<?php echo $data['name'] ?>,
<?php echo $data['unique_id'] ?>

                " required>
              </div>

            <div class="col-md-6" style="margin-top: 53px;">
              <label for="email" class="text-warning">Project Name & Unique ID</label>
              <select class="form-select btn btn-outline-light" name="project" id="manager">
            <?php
              $query = "SELECT * FROM `project` WHERE manager_id = {$user_id}";
              $allData = mysqli_query($conn, $query);
              $output3="";
              if (mysqli_num_rows($allData) > 0) {
                  while ($arrayData = mysqli_fetch_array($allData)) {
                      echo '<option>' . $arrayData['name'] . ','. $arrayData['unique_id'] .'</option>';
                  }
              } else {
                  echo '<option>No project managers found</option>';
              }
                ?>
            </select>

            </div>
            
            <div class="col-md-6 mt-2">
            <label for="manager" class="text-warning">Developer 1 Name & Unique ID</label>
            <select class="form-select btn btn-outline-light" name="dev1" id="manager">
            <?php
              $query = "SELECT * FROM `project` WHERE manager_id = {$user_id}";
              $allData = mysqli_query($conn, $query);
              $output3="";
              if (mysqli_num_rows($allData) > 0) {
                  while ($arrayData = mysqli_fetch_array($allData)) {
                    echo '<option>' . $arrayData['developer_1'] . ','. $arrayData['developer_1_id'] .'</option>';
                  }
              } else {
                  echo '<option>No project managers found</option>';
              }
                ?>
            </select>

        </div>

        <div class="col-md-6 mt-2">
            <label for="manager" class="text-warning">Developer 2 Name & Unique ID</label>
            <select class="form-select btn btn-outline-light" name="dev2" id="manager">
            <?php
              $query = "SELECT * FROM `project` WHERE manager_id = {$user_id}";
              $allData = mysqli_query($conn, $query);
              $output3="";
              if (mysqli_num_rows($allData) > 0) {
                  while ($arrayData = mysqli_fetch_array($allData)) {
                      echo '<option>' . $arrayData['developer_2'] . ','. $arrayData['developer_2_id'] .'</option>';
                  }
              } else {
                  echo '<option>No project managers found</option>';
              }
                ?>
            </select>

        </div>

        <div class="col-md-6 mt-2">
            <label for="manager" class="text-warning">Developer 3 Name & Unique ID</label>
            <select class="form-select btn btn-outline-light" name="dev3" id="manager">
            <?php
              $query = "SELECT * FROM `project` WHERE manager_id = {$user_id}";
              $allData = mysqli_query($conn, $query);
              $output3="";
              if (mysqli_num_rows($allData) > 0) {
                  while ($arrayData = mysqli_fetch_array($allData)) {
                    echo '<option>' . $arrayData['developer_3'] . ','. $arrayData['developer_3_id'] .'</option>';
                  }
              } else {
                  echo '<option>No project managers found</option>';
              }
                ?>
            </select>

        </div>

            <div class="col-md-6">
              <label for="email" class="mt-2 text-warning">Your Email</label>
              <input type="email" class="form-control btn btn-outline-light" style="" id="email" name="email"
              value="<?php echo $data['email'] ?>" required>
            </div>

            <div class="col-md-12">
              <label for="email" class="mt-2 text-warning">Upload Project Files (Zip)</label>
              <input type="file" class="form-control btn btn-outline-light" style="" id="email" name="file" required>
            </div>

            <div class="col-md-12">
              <label for="message" class="mt-2 text-warning">Project Details</label>
              <textarea class="form-control text-light" style="border-color:white; background-color: rgb(0,0,0,0.6);" id="message" name="txt" rows="6" required></textarea>
            </div>

            <input type="submit" name="submit" class="btn btn-outline-light w-75 mt-2" style="margin-left: 90px;" value="Submit Work">
          </form>
        </div>
      </div>
    
    


          </div>
          </div>
      </div>



<?php
  $query = mysqli_query($conn, "SELECT * FROM project WHERE manager_id = '{$user_id}'");

  while ($row = mysqli_fetch_assoc($query)) {
      echo '
      <div id="project' . $row['id']. '" class="container tab-pane">
          <div class="d-flex" style="margin-left: 0px; position: fixed">
              <!-- Content for each project will be dynamically loaded here using AJAX -->
          </div>
      </div>';
  }
  ?>



               

                         
                   
                  
                    


                    <!-- tab-content -->
                </div>
                <!-- col-md-8 -->
            </div>

            <?php
            
                $user_id = $_SESSION['unique_id'];
                $query =  mysqli_query($conn, "SELECT * FROM project WHERE manager_id = '{$user_id}'");
                  
                

                while($row = mysqli_fetch_assoc($query)){

                  $dev1_id = $row['developer_1_id'];
                  $dev2_id = $row['developer_2_id'];
                  $dev3_id = $row['developer_3_id'];

                  $sql2 = mysqli_query($conn, "SELECT * FROM developer WHERE unique_id = '$dev1_id'");
                  $dev1 = mysqli_fetch_assoc($sql2); 
                  $sql3 = mysqli_query($conn, "SELECT * FROM developer WHERE unique_id = '$dev2_id'");
                  $dev2 = mysqli_fetch_assoc($sql3); 
                  $sql4 = mysqli_query($conn, "SELECT * FROM developer WHERE unique_id = '$dev3_id'");
                  $dev3 = mysqli_fetch_assoc($sql4); 

                  $per = "";

        

                  // Check conditions using elseif
                  if ($row['status'] == "Pending") {
                      $per = "25";
                  } elseif ($row['status'] == "On-Hold") {
                      $per = "50";
                  } elseif ($row['status'] == "Processing") {
                      $per = "75";
                  } elseif ($row['status'] == "Done") {
                      $per = "100";
                  }


                  //Developer____1
                  $sql0 = "SELECT * FROM messages WHERE msg_id = (SELECT MAX(msg_id) FROM messages WHERE (incoming_msg_id = {$user_id} AND outgoing_msg_id = {$dev1_id}))";
                  $query2 = mysqli_query($conn, $sql0);
                  $result10 = '';
                if ($query2) {
                    if (mysqli_num_rows($query2) > 0) {
                        $row2 = mysqli_fetch_assoc($query2);
                        $result10 = $row2['msg_id'];
                    }
                }

                $sql3 = "SELECT * FROM messages WHERE msg_id = (SELECT MAX(msg_id) FROM messages WHERE incoming_msg_id = {$dev1_id} AND outgoing_msg_id = {$user_id})";
                $query3 = mysqli_query($conn, $sql3);                

                $result20 = '';
                if ($query3) {
                    if (mysqli_num_rows($query3) > 0) {
                        $row3 = mysqli_fetch_assoc($query3);
                        $result20 = $row3['msg_id'];
                    }
                }
              $count_dev1 = "";

          if($result20 < $result10) {
            $count_dev1 .= '<div class="card bg-warning mx-2" style="border-radius: 20px; width: 7px; height: 7px; margin-top: -40px;"></div>';

              }else{
              
              }

              //Developer ___2
              $sql4 = "SELECT * FROM messages WHERE msg_id = (SELECT MAX(msg_id) FROM messages WHERE (incoming_msg_id = {$user_id} AND outgoing_msg_id = {$dev2_id}))";
              $query4 = mysqli_query($conn, $sql4);
              $result4 = '';
            if ($query4) {
                if (mysqli_num_rows($query4) > 0) {
                    $row4 = mysqli_fetch_assoc($query4);
                    $result4 = $row4['msg_id'];
                }
            }

            $sql5 = "SELECT * FROM messages WHERE msg_id = (SELECT MAX(msg_id) FROM messages WHERE incoming_msg_id = {$dev2_id} AND outgoing_msg_id = {$user_id})";
            $query5 = mysqli_query($conn, $sql5);                

            $result5 = '';
            if ($query5) {
                if (mysqli_num_rows($query5) > 0) {
                    $row5 = mysqli_fetch_assoc($query5);
                    $result5 = $row5['msg_id'];
                }
            }
          $count_dev2 = "";

      if($result5 < $result4) {
        $count_dev2 .= '<div class="card bg-warning mx-4" style="border-radius: 20px; width: 7px; height: 7px; margin-top: -40px;"></div>';

          }else{
          
          }
       
        
          // Deceloper 3
          $sql6 = "SELECT * FROM messages WHERE msg_id = (SELECT MAX(msg_id) FROM messages WHERE (incoming_msg_id = {$user_id} AND outgoing_msg_id = {$dev3_id}))";
          $query6 = mysqli_query($conn, $sql6);
          $result6 = '';
        if ($query6) {
            if (mysqli_num_rows($query6) > 0) {
                $row6 = mysqli_fetch_assoc($query6);
                $result6 = $row6['msg_id'];
            }
        }

        $sql7 = "SELECT * FROM messages WHERE msg_id = (SELECT MAX(msg_id) FROM messages WHERE incoming_msg_id = {$dev3_id} AND outgoing_msg_id = {$user_id})";
        $query7 = mysqli_query($conn, $sql7);                

        $result7 = '';
        if ($query5) {
            if (mysqli_num_rows($query7) > 0) {
                $row7 = mysqli_fetch_assoc($query7);
                $result7 = $row7['msg_id'];
            }
        }
      $count_dev3 = "";

  if($result7 < $result6) {
    $count_dev3 .= '<div class="card bg-warning mx-4" style="border-radius: 20px; width: 7px; height: 7px; margin-top: -40px;"></div>';

      }else{
      
      }
               

                  echo ' 

                  <!-- 2nd side bar start -->
                  <div class="col-md-2 mt-3" id="sidebar" style="display: flex; position: relative;font-family: Salsa; ">
                  <div class="row">
                      <div class="" style="margin-left: -25px;">
                          <ul class="nav nav-pills flex-column mt-1 card" style="border-radius: 20px; height: 130px; width: 230px; margin-left: -20px; border: 4px solid rgb(255, 255, 255,0.9)" role="tablist">
                              <header class="justify-content-center align-items-center mt-2">
                              <a class="nav-link project-link" style="font-size: 17px; color:#fff" id="project-tab' . $row['id'] . '" href="#project' . $row['id'] . '">' . $row['name'] . '</a>
                              </header>

                              <div class="progress mx-3" style="width: 200px; height: 8px;">
                              <div class="progress-bar progress-bar-striped bg-warning" role="progressbar" aria-valuenow=' . $per . ' aria-valuemin="0" aria-valuemax="100" style="width:' . $per . '%">
                                 
                              </div>
                          </div>

                              <p class="mx-2" style="margin-top: -5px;"></p>
                              <div class="images d-flex">
                              <a href="manager-dev-chat.php?user_id='.$row['developer_1_id'].'&name='.$row['name'].'&sms_id='.$row['sms_id'].'">
                                <img src="uploaded_img/'.$dev1['d_profile'].'" class="" style="object-fit: cover; border-radius: 50%; height: 45px; width: 45px; margin-left: 17px;">'.$count_dev1.'
                                </a>
                                <a href="manager-dev-chat.php?user_id='.$row['developer_2_id'].'&name='.$row['name'].'&sms_id='.$row['sms_id'].'">
                                <img src="uploaded_img/'.$dev2['d_profile'].'" class="" style="object-fit: cover; border-radius: 50%; height: 45px; width: 45px; margin-left: 30px;">'.$count_dev2.'
                                </a>
                                <a href="manager-dev-chat.php?user_id='.$row['developer_3_id'].'&name='.$row['name'].'&sms_id='.$row['sms_id'].'">
                                <img src="uploaded_img/'.$dev3['d_profile'].'" class="" style="object-fit: cover; border-radius: 50%; height: 45px; width: 45px; margin-left: 30px;">'.$count_dev3.'
                                </a>
                              </div>
                          </ul>
                      </div> ';

                     
                  
                }
                

                ?>
  

      


            <!-- row -->
        </div>

   <!--COntainer  -->
    </div>

     <!-- The Logout Modal -->
     <div class="modal" id="logout">
                    <div class="modal-dialog w-25" style="margin-top: 250px;">
                      <div class="modal-content" style="background-color: rgb(0,0,0,0.8); border-color:rgb(255,255,255);">

                        <!-- Modal body -->
                        <div class="modal-body text-light">
                          <b>Are you sure to Logout?</b>
                        </div>

                        <!-- Modal footer -->
                        <div class="modal-footer">
                        <button type="button" class="btn btn-outline-light"><a href="manager-logout.php?logout_id=<?php echo $user_id; ?>" style="text-decoration:none; color: yellow;">Yes</a></button>
                          <button type="button" class="btn bg-light" data-bs-dismiss="modal">No</button>
                        </div>

                      </div>
                    </div>
                  </div>

    

    <!-- Initialize Tabs Using JavaScript -->
<script>
 
 $(document).ready(function () {
    // Show the first tab content by default
    $('#pogo').addClass('show active');

    $('.project-link, .nav-link').click(function (e) {
        // Prevent the default action of the link
        e.preventDefault();

        // Remove active class from all project links
        $('.project-link, .nav-link').removeClass('active');

        // Add active class to the clicked project link
        $(this).addClass('active');

        // Show the corresponding tab content
        var tabId = $(this).attr('href');
        $('.tab-pane').removeClass('show active');
        $(tabId).addClass('show active');
    });
});



document.addEventListener('DOMContentLoaded', function () {
            // Click event for navigation items
            var navLinks = document.querySelectorAll('a.nav-link');
        
            navLinks.forEach(function (link) {
                link.addEventListener('click', function (e) {
                    e.preventDefault();
        
                    var projectId = this.id.replace('project-tab', '');
        
                    // Create a new XMLHttpRequest object
                    var xhr = new XMLHttpRequest();
        
                    // Configure it to make a POST request to 'manager-details.php'
                    xhr.open('POST', 'manager-details.php', true);
                    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        
                    // Define the callback function to handle the response
                    xhr.onreadystatechange = function () {
                        if (xhr.readyState === 4) {
                            if (xhr.status === 200) {
                                // Update the content dynamically
                                var container = document.getElementById('project' + projectId);
                                if (container) {
                                    container.getElementsByClassName('d-flex')[0].innerHTML = xhr.responseText;
                                }
                            } else {
                                console.error('Error:', xhr.status, xhr.statusText);
                            }
                        }
                    };
        
                    // Send the AJAX request with the project ID
                    xhr.send('project_id=' + projectId);
                });
            });
        });


        // Camera
        $(document).ready(function () {
      $('#cameraIcon2').click(function (event) {
        event.preventDefault();
        $('#imageDropdown').toggleClass('show');
      });
    });
    $(document).ready(function () {
      $('#cameraIcon').click(function (event) {
        event.preventDefault();
        $('#coverimageDropdown').toggleClass('show');
      });
    })

 


   
</script>

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>


    <!-- Bootstrap JS and Popper.js -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
