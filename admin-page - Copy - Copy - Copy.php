<?php 
  include "config.php";
  $output="";
  session_start();
  if (!isset($_SESSION['unique_id'])) {
   
    header("Location: admin-login.php");
    die();
  }
  $per="";
 
  //client count
  $sql10 = "SELECT COUNT(*) as unique_id FROM details WHERE 1";
  $result1 = mysqli_query($conn, $sql10);
  $row20 = mysqli_fetch_assoc($result1);
  $total_client = $row20['unique_id'];

  //developer count
  $sql11 = "SELECT COUNT(*) as unique_id FROM developer WHERE 1";
  $result11 = mysqli_query($conn, $sql11);
  $row21 = mysqli_fetch_assoc($result11);
  $total_developer = $row21['unique_id'];

  //Revenue count
  $sql = "SELECT SUM(amount) AS amount FROM billing";
  $result = mysqli_query($conn, $sql);
  $row40 = mysqli_fetch_assoc($result);
  $total_revenue = $row40['amount'];


  //Sales count
  $sql13 = "SELECT COUNT(*) as project_id FROM billing WHERE 1";
  $result13 = mysqli_query($conn, $sql13);
  $row23 = mysqli_fetch_assoc($result13);
  $total_sales = $row23['project_id'];



  if (isset($_POST['create'])) {
    $name = explode(',',$_POST['name']);
    $status = $_POST['status'];
    $start = $_POST['start'];
    $end = $_POST['end'];
    $manager =  explode(',', $_POST['manager']);
    $developer =  explode(',', $_POST['developer']); // Split names by comma
    $client =  explode(',', $_POST['client']); // Split names by comma
    $text =  explode(',',$_POST['text']);
    $amount =  $_POST['amount'];
    $ran = rand(1111,9999);

    //project name and code
    $name1 = mysqli_real_escape_string($conn, trim($name[0]));
    $project_id = mysqli_real_escape_string($conn, trim($name[1]));

    //manager Area
    $manager1 = mysqli_real_escape_string($conn, trim($manager[0]));
    $manager_id = mysqli_real_escape_string($conn, trim($manager[1]));


    //developer area
    $dev1 = mysqli_real_escape_string($conn, trim($developer[0]));//1st name
    $dev_id1 = mysqli_real_escape_string($conn, trim($developer[1]));//1st id

    $dev2 = mysqli_real_escape_string($conn, trim($developer[2]));//2nd name
    $dev_id2 = mysqli_real_escape_string($conn, trim($developer[3]));//2nd id

    $dev3 = mysqli_real_escape_string($conn, trim($developer[4]));
    $dev_id3 = mysqli_real_escape_string($conn, trim($developer[5]));


    //client Area
    $client_name = mysqli_real_escape_string($conn, trim($client[0]));//1st name
    $client_id = mysqli_real_escape_string($conn, trim($client[1]));//1st id

    //text Area
    $txt1 = mysqli_real_escape_string($conn, trim($text[0]));//1st name
    $txt2 = mysqli_real_escape_string($conn, trim($text[1]));//1st id

    $txt3 = mysqli_real_escape_string($conn, trim($text[2]));//2nd name
    $txt4 = mysqli_real_escape_string($conn, trim($text[3]));//2nd id

    $txt5 = mysqli_real_escape_string($conn, trim($text[4]));
    $txt6 = mysqli_real_escape_string($conn, trim($text[5]));

    $txt7 = mysqli_real_escape_string($conn, trim($text[6]));


    $sql17 = "SELECT * FROM project WHERE manager_id = '{$manager_id}'";
    $result17 = mysqli_query($conn, $sql17);
    $row22 = mysqli_fetch_assoc($result17);
    
    if(mysqli_num_rows($result17) > 0){
        if($row22['unique_id'] == $project_id){
            echo '<script>alert("This Developer Already Assigned This Project!");</script>';
        }else {
        // Your code to insert the project details here
    
    


$sql2 = "INSERT INTO project (name, status, start, end, manager, manager_id, unique_id, amount, developer_1, developer_2, developer_3, developer_1_id, developer_2_id, developer_3_id,
des_1, des_2, des_3, des_4, des_5, des_6, des_7, client_name, client_id, sms_id) 
VALUES ('{$name1}', '{$status}', '{$start}', '{$end}', '{$manager1}', '{$manager_id}', '{$project_id}', '{$amount}', '{$dev1}', '{$dev2}', '{$dev3}', '{$dev_id1}', '{$dev_id2}', '{$dev_id3}',
 '{$txt1}', '{$txt2}', '{$txt3}', '{$txt4}', '{$txt5}', '{$txt6}', '{$txt7}', '{$client_name}', '{$client_id}', '{$ran}')";

$result2 = mysqli_query($conn, $sql2);

    // $query = mysqli_query($conn, "UPDATE details SET project_id='$code', amount = '$amount' WHERE unique_id='{$client_id}'");

    $sql2 = mysqli_query($conn, "INSERT INTO pay_info (name, project_id, project_name, start, end, des_1, des_2, des_3, des_4, des_5, des_6, des_7, unique_id) 
    VALUES ('{$client_name}', '{$project_id}', '{$name1}', '{$start}', '{$end}', '{$txt1}', '{$txt2}', '{$txt3}', '{$txt4}', '{$txt5}', '{$txt6}', '{$txt7}', '{$client_id}')");

    // $query = mysqli_query($conn, "UPDATE pay_info SET project_id='$code', project_name = '$name', des_1 = '$txt1', des_2 = '$txt2', des_3 = '$txt3',
    //  des_4 = '$txt4', des_5 = '$txt5', des_6 = '$txt6', des_7 = '$txt7', start = '$start', end = '$end', name = '$client_name', unique_id = '$client_id' WHERE 1");

  }

  }
}
 


  
 
 
 
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>DigitalSpark CRM</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> 
  <script src="bootstrap/js/bootstrap.bundle.min.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>  
  
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css"/>
  
  <!-- Bootstrap CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<link href='https://fonts.googleapis.com/css?family=Salsa' rel='stylesheet'>









  

  <!-- Chart link -->
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

  <style>
    :root {
  --bs-blue: #63B3ED;
  --bs-indigo: #596CFF;
  --bs-purple: #6f42c1;
  --bs-pink: #d63384;
  --bs-red: #F56565;
  --bs-orange: #fd7e14;
  --bs-yellow: #FBD38D;
  --bs-green: #81E6D9;
  --bs-teal: #20c997;
  --bs-cyan: #0dcaf0;
  --bs-white: #fff;
  --bs-gray: #6c757d;
  --bs-gray-dark: #343a40;
  --bs-gray-100: #f8f9fa;
  --bs-gray-200: #f0f2f5;
  --bs-gray-300: #dee2e6;
  --bs-gray-400: #ced4da;
  --bs-gray-500: #adb5bd;
  --bs-gray-600: #6c757d;
  --bs-gray-700: #495057;
  --bs-gray-800: #343a40;
  --bs-gray-900: #212529;
  --bs-primary: #e91e63;
  --bs-secondary: #7b809a;
  --bs-success: #4CAF50;
  --bs-info: #1A73E8;
  --bs-warning: #fb8c00;
  --bs-danger: #F44335;
  --bs-light: #f0f2f5;
  --bs-dark: #344767;
  --bs-white: #fff;
  --bs-dark-blue: #1A237E;
  --bs-primary-rgb: 233, 30, 99;
  --bs-secondary-rgb: , 128, 154;
  --bs-success-rgb: 76, 175, 80;
  --bs-info-rgb: 26, 115, 232;
  --bs-warning-rgb: 251, 140, 0;
  --bs-danger-rgb: 244, 67, 53;
  --bs-light-rgb: 240, 242, 245;
  --bs-dark-rgb: 52, 71, 103;
  --bs-white-rgb: 255, 255, 255;
  --bs-dark-blue-rgb: 26, 35, 126;
  --bs-white-rgb: 255, 255, 255;
  --bs-black-rgb: 0, 0, 0;
  --bs-body-color-rgb: , 128, 154;
  --bs-body-bg-rgb: 255, 255, 255;
  --bs-font-sans-serif: "Roboto", Helvetica, Arial, sans-serif;
  --bs-font-monospace: SFMono-Regular, Menlo, Monaco, Consolas, "Liberation Mono", "Courier New", monospace;
  --bs-gradient: linear-gradient(180deg, rgba(255, 255, 255, 0.15), rgba(255, 255, 255, 0));
  --bs-body-font-family: var(--bs-font-sans-serif);
  --bs-body-font-size: 1rem;
  --bs-body-font-weight: 400;
  --bs-body-line-height: 1.5;
  --bs-body-color: #7b809a;
  --bs-body-bg: #fff;
  --bs-border-width: 1px;
  --bs-border-style: solid;
  --bs-border-color: #dee2e6;
  --bs-border-color-translucent: rgba(0, 0, 0, 0.175);
  --bs-border-radius: 0.375rem;
  --bs-border-radius-sm: 0.125rem;
  --bs-border-radius-lg: 0.5rem;
  --bs-border-radius-xl: 0.75rem;
  --bs-border-radius-2xl: 1rem;
  --bs-border-radius-pill: 50rem;
  --bs-link-color: #e91e63;
  --bs-link-hover-color: #e91e63;
  --bs-code-color: #d63384;
  --bs-highlight-bg: #fcf8e3;
    }
    .nav {
      background-color: rgb(0,0,0,0.5); 
      margin-left: -10px;
      
    }

    .nav-link.active,
    .nav-link:active {
      background-color: rgb(254,190,16) !important;
      color: black !important;
      margin-left: 8px;
      width: 230px;
    }

body{
  display: flex;
  align-items: center;
  justify-content: center;
  min-height: 100vh;
  background: url('img/admin-bg1.jpg') no-repeat center center fixed;
            -webkit-background-size: cover;
            -moz-background-size: cover;
            -o-background-size: cover;
            background-size: cover; 
  padding: 0 10px;
}

.client-container .back-icon{
  color:white;
  font-size: 1.5rem;
  padding: 20px;
}

.users-list::-webkit-scrollbar { 
  display: none; 
 } 

 /* Manager Section */
.container-fluid .users .manager-search input{
  position: absolute;
  height: 42px;
  width: calc(100% - 50px);
  font-size: 16px;
  padding: 0 200px;
  margin-left: -540px;
  margin-top:-20px;
  border: 5px solid #646161;
  outline: none;
  border-radius: 5px 0 0 5px;
  opacity: 0;
  pointer-events: none;
  transition: all 0.2s ease;
}
.container-fluid .users .manager-search input.show{
  opacity: 1;
  pointer-events: auto;
}
.container-fluid .users .manager-search button{
  position: relative;
  z-index: 1;
  width: 47px;
  height: 42px;
  font-size: 17px;
  cursor: pointer;
  border: none;
  background: #fff;
  color: black;
  outline: none;
  border-radius: 0 5px 5px 0;
  transition: all 0.2s ease;
}
.container-fluid .users .manager-search button.active{
  background: black;
  color: #fff;
}
.container-fluid .manager-search button.active i::before{
  content: '\f00d';
}


/* Client Section */
.container-fluid .users .search input{
  position: absolute;
  height: 42px;
  width: calc(100% - 50px);
  font-size: 16px;
  padding: 0 200px;
  margin-left: -530px;
  margin-top:-20px;
  border: 5px solid #646161;
  outline: none;
  border-radius: 5px 0 0 5px;
  opacity: 0;
  pointer-events: none;
  transition: all 0.2s ease;
}
.container-fluid .users .search input.show{
  opacity: 1;
  pointer-events: auto;
}
.container-fluid .users .search button{
  position: relative;
  z-index: 1;
  width: 47px;
  height: 42px;
  font-size: 17px;
  cursor: pointer;
  border: none;
  background: #fff;
  color: black;
  outline: none;
  border-radius: 0 5px 5px 0;
  transition: all 0.2s ease;
}
.container-fluid .users .search button.active{
  background: black;
  color: #fff;
}
.container-fluid .search button.active i::before{
  content: '\f00d';
}

 .container-fluid .users-list  .status-dot .button{
  font-size: 14px;
  background-color: rgb(254,190,16);
}

.container-fluid .users-list .status-dot .button.offline{
   background-color: white;
} 


/* developer Section */
.container-fluid .users .dev-search input{
  position: absolute;
  height: 42px;
  width: calc(100% - 50px);
  font-size: 16px;
  padding: 0 200px;
  margin-left: -570px;
  margin-top:-20px;
  border: 5px solid #646161;
  outline: none;
  border-radius: 5px 0 0 5px;
  opacity: 0;
  pointer-events: none;
  transition: all 0.2s ease;
}
.container-fluid .users .dev-search input.show{
  opacity: 1;
  pointer-events: auto;
}
.container-fluid .users .dev-search button{
  position: relative;
  z-index: 1;
  width: 47px;
  height: 42px;
  font-size: 17px;
  cursor: pointer;
  border: none;
  background: #fff;
  color: black;
  outline: none;
  border-radius: 0 5px 5px 0;
  transition: all 0.2s ease;
}
.container-fluid .users .dev-search button.active{
  background: black;
  color: #fff;
}
.container-fluid .dev-search button.active i::before{
  content: '\f00d';
}

.container .dev-users-list  .status-dot .button{
  background-color: rgb(254,190,16);;

}

.container-fluid .dev-users-list .status-dot .button.offline{
   background-color: white;
} 

.dev-users-list::-webkit-scrollbar { 
  display: none; 
 }

.container .dev-users-list a .status-dot .button.offline{
   background-color: white;
} 

/* Suspend Section */
.container-fluid .users .suspend-search input{
  position: absolute;
  height: 42px;
  width: calc(80% - 68px);
  font-size: 16px;
  padding: 0 200px;
  margin-left: -545px;
  margin-top:-20px;
  border: 5px solid #646161;
  outline: none;
  border-radius: 5px 0 0 5px;
  opacity: 0;
  pointer-events: none;
  transition: all 0.2s ease;
}
.container-fluid .users .suspend-search input.show{
  opacity: 1;
  pointer-events: auto;
}
.container-fluid .users .suspend-search button{
  position: relative;
  z-index: 1;
  width: 47px;
  height: 42px;
  font-size: 17px;
  cursor: pointer;
  border: none;
  background: #fff;
  color: black;
  outline: none;
  border-radius: 0 5px 5px 0;
  transition: all 0.2s ease;
}
.container-fluid .users .suspend-search button.active{
  background: black;
  color: #fff;
}
.container-fluid .suspend-search button.active i::before{
  content: '\f00d';
}

.container .suspend-list a .status-dot .button{
  background-color: green;

}

.suspend-list::-webkit-scrollbar { 
  display: none; 
 }

.container .suspendlist a .status-dot .button.offline{
   background-color: white;
} 

@keyframes rotateAnimation {
        0% {
            transform: rotate(0deg);
        }
        100% {
            transform: rotate(360deg);
        }
    }

    .rotate-icon {
        animation: rotateAnimation 1s infinite linear; /* Adjust the duration and timing function as needed */
    }

    .billing-list::-webkit-scrollbar { 
      display: none; 
    }

 
  </style>
  
</head>
<body>

<div class="container-fluid">
  <div class="row">
    <!-- Nav pills -->
    <div class="" id="sidebar" style="height: 600px; width: 263px;">
      <ul class="nav card nav-pills flex-column h-100 mt-1 text-dark" style="border-radius: 10px; border-color: rgb(254,190,16); " role="tablist">
        <header class="d-flex justify-content-center align-items-center mt-5">
          <p class="text-warning" style="font-family: ‘Aclonica’;font-size: 22px; margin-top:-20px;"><b>CRM SYSTEM</b></p>
        </header>
        <li class="nav-item mt-1">
          <a class="nav-link active d-flex " style="color:white" data-bs-toggle="pill" href="#Deshboard"><i class="fa fa-bar-chart px-4" style="font-size:24px"></i><b>Dashboard</b></a>
        </li>
        <li class="nav-item mt-1">
          <a class="nav-link d-flex " style="color:white" data-bs-toggle="pill" href="#manager"><i class="fa fa-user-secret px-4" style="font-size:24px;"></i><b class="mx-2">Managers</b></a>
        </li>
        <li class="nav-item mt-1">
          <a class="nav-link d-flex" style="color:white" data-bs-toggle="pill" href="#Developers"><i class="fa fa-keyboard-o px-4" style="font-size:24px"></i><b>Developers</b></a>
        </li>
        <li class="nav-item mt-1">
          <a class="nav-link d-flex" style="color:white" data-bs-toggle="pill" href="#Clients"><i class="fa fa-user px-4" style="font-size:24px;"></i><b class="mx-2">Clients</b></a>
        </li>
        <li class="nav-item mt-1">
          <a class="nav-link d-flex" style="color:white" data-bs-toggle="pill" href="#billing"><i class="fa fa-file-invoice px-4" style="font-size:24px"></i><b class="mx-2">Billing</b></a>
        </li>
        <li class="nav-item mt-2">
          <header class="d-flex justify-content-center">
            <p class=" py-2 bg-light d-flex justify-content-center" style=" margin-left: -90px; width: 230px; height: 40px; border-radius: 5px;">
            <i class="fa fa-project-diagram" style="font-size:24px; margin-left: -140px;"></i><p style="margin-left: -140px; margin-top: 10px;"><b>Project</b></p></p>
          </header>
        </li>
        <li class="nav-item">
          <a class="nav-link d-flex " style="color:white" data-bs-toggle="pill" href="#approval"><i class="fa fa-hourglass-half px-4" style="font-size: 24px;"></i><b class="mx-2">Approval</b></a>
        </li>
        <li class="nav-item">
          <a class="nav-link d-flex " style="color:white" data-bs-toggle="pill" href="#view"><i class="fa fa-tasks px-4" style="font-size: 24px;"></i><b>List</b></a>
        </li>
        <li class="nav-item mt-3">
          <header class="d-flex justify-content-center">
            <p class=" py-2 bg-light d-flex justify-content-center" style=" margin-left: -80px; width: 230px; height: 40px; border-radius: 5px;">
            <i class="fa fa-cogs" style="font-size:24px; margin-left: -140px;"></i><p style="margin-left: -140px; margin-top: 10px;"><b>Settings</b></p></p>
          </header>
        </li>
        <li class="nav-item">
          <a class="nav-link d-flex " style="color:white" data-bs-toggle="pill" href="#suspend"><i class="fas fa-database px-4" style="font-size: 24px;"></i><b>Block-List</b></a>
        </li>
        <li class="nav-item">
          <a class="nav-link d-flex " data-bs-toggle="modal" data-bs-target="#logout" style="cursor:pointer; color:white">
          <i class="fas fa-sign-out-alt px-4" style="font-size: 24px;"></i><b>Logout</b></a>
        </li>
        
      </ul>
        
    </div>

    <!-- Tab panes -->
    <div class="col-md-9">
      <div class="tab-content">
        <div id="Deshboard" class="container tab-pane active">

             <div class="d-flex" style="margin-left: -15px;">

                <div class="mt-5">
            <div class="card mx-2" style="background-color: rgb(254,190,16); border-radius: 10px; width: 
            65px; height: 60px; z-index: 2;  margin-top: -20px; position: absolute;">
              <i class="fa fa-street-view d-flex justify-content-center mt-3" style="font-size:24px; color: black"></i>
              </div>
         <div class="card" style="width: 200px; height: 100px; background-color: rgb(0,0,0,0.8); z-index: 1;
              box-shadow: 0px 5px 5px 5px rgb(254,190,16); ">
              <p class="d-flex justify-content-end mx-2 text-light"
               style="font-family: Impact, Haettenschweiler, 'Arial Narrow Bold', sans-serif;">Total Clients</p>
              <span class="d-flex justify-content-end mx-3 text-light" style="font-family: Impact, Haettenschweiler, 'Arial Narrow Bold', sans-serif;"><?php echo $total_client; ?></span>
         </div>
         </div>

           <div class="mt-5 mx-5">
         <div class="card " style="background-color: rgb(254,190,16); margin-left: 9px; border-radius: 10px; width: 
         65px; height: 60px; z-index: 2;  margin-top: -20px; position: absolute;">
           <i class="fa fa-group d-flex justify-content-center mt-3" style="font-size:24px; color: black;"></i>
           </div>
      <div class="card" style="width: 200px; height: 100px; background-color: rgb(0,0,0,0.8); z-index: 1;
            box-shadow: 0px 5px 5px 5px rgb(254,190,16);">
           <p class="d-flex justify-content-end mx-1 text-light" 
           style="font-family: Impact, Haettenschweiler, 'Arial Narrow Bold', sans-serif;">Total Developers</p>
           <span class="d-flex justify-content-end mx-3 text-light" style="font-family: Impact, Haettenschweiler, 'Arial Narrow Bold', sans-serif;"><?php echo $total_developer; ?></span>
      </div>
      </div>

    <div class="mt-5 mx-2">
        <div class="card" style="background-color: rgb(254,190,16); margin-left: 7px; border-radius: 10px; width: 
        65px; height: 60px; z-index: 2;  margin-top: -20px; position: absolute;">
          <i class="fa fa-money d-flex justify-content-center mt-3" style="font-size:24px; color: black;"></i>
          </div>
     <div class="card " style="width: 200px; height: 100px; background-color: rgb(0,0,0,0.8); z-index: 1;
           box-shadow: 0px 5px 5px 5px rgb(254,190,16)">
          <p class="d-flex justify-content-end mx-1 text-light" 
          style="font-family: Impact, Haettenschweiler, 'Arial Narrow Bold', sans-serif;">Total Revenue</p>
          <span class="d-flex justify-content-end mx-3 text-light" style="font-family: Impact, Haettenschweiler, 'Arial Narrow Bold', sans-serif;"> $ <?php echo $total_revenue; ?></span>
     </div>
     </div>

   <div class="mt-5 mx-3">
    <div class="card" style="background-color: rgb(254,190,16); margin-left: 32px; border-radius: 10px; width: 
    65px; height: 60px; z-index: 2;  margin-top: -20px; position: absolute;">
      <i class="fa fa-handshake-o d-flex justify-content-center mt-3" style="font-size:24px; color: black;"></i>
      </div>
 <div class="card mx-4" style="width: 200px; height: 100px; background-color: rgb(0,0,0,0.8); z-index: 1;
       box-shadow: 0px 5px 5px 5px rgb(254,190,16)">
      <p class="d-flex justify-content-end mx-1 text-light" 
      style="font-family: Impact, Haettenschweiler, 'Arial Narrow Bold', sans-serif;">Total Sales</p>
      <span class="d-flex justify-content-end mx-3 text-light" style="font-family: Impact, Haettenschweiler, 'Arial Narrow Bold', sans-serif;"> <?php echo $total_sales; ?></span>
    </div>
    </div>

    <!-- d-flex div -->
    </div> 

         <!-- Graph Part -->
        <div class="d-flex" style="margin-left: -15px;">
            <div class="mt-5">
            <div class="card mt-3" style="background-color: rgb(0,0,0,0.6); border-radius: 10px; border-color: rgb(254,190,16); 
                      285px; height: 185px; z-index: 2;  margin-top: -20px; position: absolute; ">
                <!-- <div class="card mt-3" style="background-color: rgb(255,20,147,0.7); border-radius: 10px; width: 
                  285px; height: 170px; z-index: 2; margin-left: 12px;  margin-top: -20px; position: absolute; "> -->

                  <!-- Bar Chart -->
                  <?php 
                    
                    $sql130 = "SELECT COUNT(*) as project_id FROM billing WHERE project_id = 2224";
                    $result130 = mysqli_query($conn, $sql130);
                    $row230 = mysqli_fetch_assoc($result130);
                    $total_web = $row230['project_id'];

                    $sql131 = "SELECT COUNT(*) as project_id FROM billing WHERE project_id = 2225";
                    $result131 = mysqli_query($conn, $sql131);
                    $row231 = mysqli_fetch_assoc($result131);
                    $total_seo = $row231['project_id'];

                    $sql132 = "SELECT COUNT(*) as project_id FROM billing WHERE project_id = 2226";
                    $result132 = mysqli_query($conn, $sql132);
                    $row232 = mysqli_fetch_assoc($result132);
                    $total_ppc = $row232['project_id'];

                    $sql133 = "SELECT COUNT(*) as project_id FROM billing WHERE project_id = 2227";
                    $result133 = mysqli_query($conn, $sql133);
                    $row233 = mysqli_fetch_assoc($result133);
                    $total_sm = $row233['project_id'];

                    $sql134 = "SELECT COUNT(*) as project_id FROM billing WHERE project_id = 2228";
                    $result134 = mysqli_query($conn, $sql134);
                    $row234 = mysqli_fetch_assoc($result134);
                    $total_cm = $row234['project_id'];

                    $sql135 = "SELECT COUNT(*) as project_id FROM billing WHERE project_id = 2229";
                    $result135 = mysqli_query($conn, $sql135);
                    $row235 = mysqli_fetch_assoc($result135);
                    $total_em = $row235['project_id'];
                    
                  ?>
                   
                  <div style="width: 100%; height: 100%; margin-top: 30px;">
                    <canvas id="myChart"></canvas>
                  </div>

                  <script>
 
                        const labels = ['WEB', 'SEO', 'PPC', 'SM', 'CM', 'EM'];
                        const data = {
                          labels: labels,
                          datasets: [{
                            label: 'Project Database',
                            <?php 
                              $output_data = "";
                              $output_data .='data: ['.$total_web.', '.$total_seo.', '.$total_ppc.', '.$total_sm.', '.$total_cm.', '.$total_em.'],';

                              echo $output_data;
                            ?>
                                              
                            backgroundColor: [
                              'rgba(255, 99, 132, 0.5)',
                              'rgba(255, 159, 64, 0.7)',
                              'rgba(255, 205, 86, 0.7)',
                              'rgba(75, 192, 192, 0.7)',
                              'rgba(54, 162, 235, 0.7)',
                              'rgba(153, 102, 255, 0.7)',
                              'rgba(201, 203, 207, 0.7)'
                            ],
                            borderColor: [
                              'rgb(255, 99, 132)',
                              'rgb(255, 159, 64)',
                              'rgb(255, 205, 86)',
                              'rgb(75, 192, 192)',
                              'rgb(54, 162, 235)',
                              'rgb(153, 102, 255)',
                              'rgb(201, 203, 207)'
                            ],
                            borderWidth: 1
                          }]
                        };

                        const config = {
                          type: 'bar',
                          data: data,
                          options: {
                            scales: {
                              y: {
                                beginAtZero: true,
                                max: 5, // Set the maximum value for the y-axis
                                grid: {
                                  color: 'rgba(255, 255, 255, 0.2)' // Set the grid color to white with 20% opacity
                                },
                                ticks: {
                                  color: 'white', // Set the color of the y-axis labels to white
                                  stepSize: 1 // Set the step size for y-axis ticks
                                }
                              },
                              x: {
                                grid: {
                                  color: 'rgba(255, 255, 255, 0.2)' // Set the grid color to white with 20% opacity
                                },
                                ticks: {
                                  color: 'white' // Set the color of the x-axis labels to white
                                }
                              }
                            },
                            plugins: {
                              legend: {
                                labels: {
                                  color: 'white' // Set the color of the legend labels to white
                                }
                              }
                            }
                          }
                        };

                        var myChart = new Chart(
                          document.getElementById('myChart'),
                          config
                        );
                          </script>


                  </div>
             <div class="card mt-5" style="width: 305px; height: 350px; background-color: rgb(0,0,0,0.8); z-index: 1;
                   box-shadow: 0px 5px 5px 5px rgb(254,190,16)">
                  <p class="d-flex justify-content-center text-warning" 
                  style="font-family: Impact, Haettenschweiler, 'Arial Narrow Bold', sans-serif; margin-top: 200px;">
                    Project Demand
                  </p>
                   
                  <?php 
                   $totals = array(
                    'Website Design' => $total_web,
                    'SEO' => $total_seo,
                    'Pay Per Click' => $total_ppc,
                    'Social Media Marketing'  => $total_sm,
                    'Content Marketing'  => $total_cm,
                    'Email Marketing'  => $total_em
                );
                
                // Find the key (project name) with the maximum value
                $maxProject = array_keys($totals, max($totals))[0];
                
                  ?>
                  <div class="d-flex">
                    <i class="fa fa-clock-o text-warning mx-2 mt-1" aria-hidden="true"></i>
                  <p class="text-warning" style="margin-left: -5px;">Update Daily</p>
                  </div>

                  <p class="mx-3 text-light">
                  <?php
                  echo "$maxProject is trending in the market.";
                  ?>
                  </p>
                  <span class="d-flex justify-content-end mx-3 text-dark" style="font-family: Impact, Haettenschweiler, 'Arial Narrow Bold', sans-serif;"> </span>
                </div>
                </div>
                

                <div class="mt-5">
                <div class="card mt-3" style="background-color: rgb(0,0,0,0.6); border-radius: 10px; border-color: rgb(254,190,16); 
                      285px; height: 185px; z-index: 2;  margin-top: -20px; position: absolute; margin-left: 25px; ">
                    <!-- <div class="card mt-3" style="background-color: rgb(20,155,137,0.6); border-radius: 10px; width: 
                      285px; height: 170px; z-index: 2;  margin-top: -20px; position: absolute; margin-left: 35px; "> -->

                         <!-- Line Chart -->

                         <?php 
                    
                            $total_jan = 0;
                            $sql150 = "SELECT COUNT(*) as end FROM billing WHERE end BETWEEN '2024-01-01' AND '2024-01-31'";
                            $result150 = mysqli_query($conn, $sql150);
                            $row250 = mysqli_fetch_assoc($result150);
                            $total_jan = $row250['end'];
                            
                            $total_feb = 0;
                            $sql151 = "SELECT COUNT(*) as end FROM billing WHERE end BETWEEN '2024-02-01' AND '2024-02-28'";
                            $result151 = mysqli_query($conn, $sql151);
                            $row251 = mysqli_fetch_assoc($result151);
                            $total_feb = $row251['end'];
                            
                            $total_mar = 0;
                            $sql152 = "SELECT COUNT(*) as end FROM billing WHERE end BETWEEN '2024-03-01' AND '2024-03-31'";
                            $result152 = mysqli_query($conn, $sql152);
                            $row252 = mysqli_fetch_assoc($result152);
                            $total_mar = $row252['end'];
                            
                            $total_apr = 0;
                            $sql153 = "SELECT COUNT(*) as end FROM billing WHERE end BETWEEN '2024-04-01' AND '2024-04-30'";
                            $result153 = mysqli_query($conn, $sql153);
                            $row253 = mysqli_fetch_assoc($result153);
                            $total_apr = $row253['end'];
                            
                            $total_may = 0;
                            $sql154 = "SELECT COUNT(*) as end FROM billing WHERE end BETWEEN '2024-05-01' AND '2024-05-31'";
                            $result154 = mysqli_query($conn, $sql154);
                            $row254 = mysqli_fetch_assoc($result154);
                            $total_may = $row254['end'];
                            
                            $total_jun = 0;
                            $sql155 = "SELECT COUNT(*) as end FROM billing WHERE end BETWEEN '2024-06-01' AND '2024-06-30'";
                            $result155 = mysqli_query($conn, $sql155);
                            $row255 = mysqli_fetch_assoc($result155);
                            $total_jun = $row255['end'];
                            
                            $total_jul = 0;
                            $sql156 = "SELECT COUNT(*) as end FROM billing WHERE end BETWEEN '2024-07-01' AND '2024-07-31'";
                            $result156 = mysqli_query($conn, $sql156);
                            $row256 = mysqli_fetch_assoc($result156);
                            $total_jul = $row256['end'];
                            
                            $total_aug = 0;
                            $sql157 = "SELECT COUNT(*) as end FROM billing WHERE end BETWEEN '2024-08-01' AND '2024-08-31'";
                            $result157 = mysqli_query($conn, $sql157);
                            $row257 = mysqli_fetch_assoc($result157);
                            $total_aug = $row257['end'];
                            
                            $total_sep = 0;
                            $sql158 = "SELECT COUNT(*) as end FROM billing WHERE end BETWEEN '2024-09-01' AND '2024-09-30'";
                            $result158 = mysqli_query($conn, $sql158);
                            $row258 = mysqli_fetch_assoc($result158);
                            $total_sep = $row258['end'];
                            
                            $total_oct = 0;
                            $sql159 = "SELECT COUNT(*) as end FROM billing WHERE end BETWEEN '2024-10-01' AND '2024-10-31'";
                            $result159 = mysqli_query($conn, $sql159);
                            $row259 = mysqli_fetch_assoc($result159);
                            $total_oct = $row259['end'];
                            
                            $total_nov = 0;
                            $sql1510 = "SELECT COUNT(*) as end FROM billing WHERE end BETWEEN '2024-11-01' AND '2024-11-30'";
                            $result1510 = mysqli_query($conn, $sql1510);
                            $row2510 = mysqli_fetch_assoc($result1510);
                            $total_nov = $row2510['end'];
                            
                            $total_dec = 0;
                            $sql1511 = "SELECT COUNT(*) as end FROM billing WHERE end BETWEEN '2024-12-01' AND '2024-12-31'";
                            $result1511 = mysqli_query($conn, $sql1511);
                            $row2511 = mysqli_fetch_assoc($result1511);
                            $total_dec = $row2511['end'];
                    
                    
                        ?>

                     <div style="width: 100%; height: 100%; margin-top: 30px;">
                     <canvas id="myLineChart"></canvas>
                      </div>
                      
                      <script>
                        const Linelabels =['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
                         const Linedata = {
                        labels: Linelabels,
                        datasets: [{
                        label: 'Completed Project (2024)',
                        <?php 
                          $output_data = "";
                          $output_data .='data: ['.$total_jan.', '.$total_feb.', '.$total_mar.', '.$total_apr.', '.$total_may.', '.$total_jun.',
                           '.$total_jul.', '.$total_aug.', '.$total_sep.', '.$total_oct.', '.$total_nov.', '.$total_dec.'],';

                              echo $output_data;
                            ?>
                        fill: false,
                         borderColor: 'deeppink',
                         tension: 0.1
                          }]
                            };
                            const Lineconfig = {
                              type: 'line',
                              data: Linedata,
                              options: {
                                scales: {
                                  y: {
                                    beginAtZero: true,
                                    max: 15, // Set the maximum value for the y-axis
                                    grid: {
                                      color: 'rgba(255, 255, 255, 0.8)' // Set the grid color to white with 20% opacity
                                    },
                                    ticks: {
                                      color: 'white' // Set the color of the y-axis labels to white
                                    }
                                  },
                                  x: {
                                    grid: {
                                      color: 'rgba(255, 255, 255, 0.8)' // Set the grid color to white with 20% opacity
                                    },
                                    ticks: {
                                      color: 'white', // Set the color of the x-axis labels to white
                                      stepSize: 5 // Set the step size for y-axis ticks
                                    }
                                  }
                                },
                                plugins: {
                                  legend: {
                                    labels: {
                                      color: 'white' // Set the color of the legend labels to white
                                    }
                                  }
                                }
                              }
                            };

                                 var myChart = new Chart(
                                  document.getElementById('myLineChart'),
                                     Lineconfig
                                 );
                      </script>
                      
                      </div>
                 <div class="card mt-5 mx-4" style="width: 305px; height: 350px; background-color: rgb(0,0,0,0.8); z-index: 1;
                       box-shadow: 0px 5px 5px 5px rgb(254,190,16)">
                       <?php 
                        $smg="";
                        $totals = array(
                          'January' => $total_jan,
                          'February' => $total_feb,
                          'March' => $total_mar,
                          'April'  => $total_apr,
                          'May'  => $total_may,
                          'June'  => $total_jun,
                          'July' => $total_jul,
                          'August'  => $total_aug,
                          'September'  => $total_sep,
                          'October'  => $total_oct,
                          'November'  => $total_nov,
                          'December'  => $total_dec
                      );
                      
                     
                        if ($totals['January'] > $totals['February']) {
                          $smg = "Decrease from pervious month."; 
                        }elseif($totals['March'] > $totals['April']){
                          $smg = "Decrease from pervious month.";
                        }elseif($totals['May'] > $totals['June']){
                          $smg = "Decrease from pervious month.";
                        }elseif($totals['July'] > $totals['August']){
                          $smg = "Decrease from pervious month.";
                        }elseif($totals['September'] > $totals['October']){
                          $smg = "Decrease from pervious month.";
                        }elseif($totals['November'] > $totals['December']){
                          $smg = "Decrease from pervious month.";
                        }else {
                          $smg = "Increase from pervious month."; 
                        }
                      
                        ?>
                      <p class="d-flex justify-content-center mx-1 text-warning" 
                      style="font-family: Impact, Haettenschweiler, 'Arial Narrow Bold', sans-serif; margin-top: 200px;">
                      Sales This Year
                      </p>
                      <div class="d-flex">
                            <i class="fa fa-clock-o text-warning mx-2 mt-1" aria-hidden="true"></i>
                            <p class="text-warning" style="margin-left: -5px;">Update Monthly</p>
                      </div>
                       <p class="mx-3 text-light">
                      <?php
                      echo $smg;
                      ?>
                      </p>
                      <span class="d-flex justify-content-end mx-3 text-dark" style="font-family: Impact, Haettenschweiler, 'Arial Narrow Bold', sans-serif;"> </span>
                    </div>
                </div>
                    <div class="mt-5">
                      <div class="card mt-3" style="background-color: rgb(0,0,0,0.6); border-radius: 10px; border-color: rgb(254,190,16); 
                      285px; height: 185px; z-index: 2;  margin-top: -20px; position: absolute; margin-left: 2px; ">
                        <!-- <div class="card mt-3" style="background-color: rgb(0,0,0,0.5); border-radius: 10px; width: 
                          285px; height: 170px; z-index: 2;  margin-top: -20px; position: absolute; margin-left: 12px; "> -->

                            <!-- Horizontal Bar  Chart -->

                            <?php 
                    
                            $sql140 = "SELECT COUNT(*) as amount FROM billing WHERE amount BETWEEN 100 AND 199";
                            $result140 = mysqli_query($conn, $sql140);
                            $row240 = mysqli_fetch_assoc($result140);
                            $total_100 = $row240['amount'];

                            $sql141 = "SELECT COUNT(*) as amount FROM billing WHERE amount BETWEEN 200 AND 299";
                            $result141 = mysqli_query($conn, $sql141);
                            $row241 = mysqli_fetch_assoc($result141);
                            $total_200 = $row241['amount'];

                            $sql142 = "SELECT COUNT(*) as amount FROM billing WHERE amount BETWEEN 300 AND 999";
                            $result142 = mysqli_query($conn, $sql142);
                            $row242 = mysqli_fetch_assoc($result142);
                            $total_300plus = $row242['amount'];
 
                            ?>

                            <div style="width: 100%; height: 100%; margin-top: 30px; margin-left: 0px;">
                            <canvas id="myHorChart"></canvas>
                          </div>

                          <script>
                            const Horlabels = ['100', '200', '300'];
                            const Hordata = {
                              labels: Horlabels,
                              datasets: [{
                                axis: 'y',
                                label: 'Project Budget (Dollar)',
                                <?php 
                              $output_data = "";
                              $output_data .='data: ['.$total_100.', '.$total_200.', '.$total_300plus.'],';

                              echo $output_data;
                               ?>
                                fill: false,
                                backgroundColor: [
                                  'rgba(255, 99, 132, 0.5)',
                                  'rgba(255, 159, 64, 0.5)',
                                  'rgba(25, 215, 86, 0.5)',
                               
                                ],
                                borderColor: [
                                  'rgb(255, 99, 132)',
                                  'rgb(255, 159, 64)',
                                  'rgb(255, 205, 86)',
                                  'rgb(75, 192, 192)',
                                  'rgb(54, 162, 235)',
                                  'rgb(153, 102, 255)',
                                  'rgb(201, 203, 207)'
                                ],
                                borderWidth: 1
                              }]
                            };
                            
                            const Horconfig = {
                              type: 'bar',
                              data: Hordata, // Fix: Use the correct variable name Hordata here
                              options: {
                                indexAxis: 'y',
                                scales: {
                                  y: {
                                    beginAtZero: true,
                                    grid: {
                                      color: 'rgba(255, 255, 255, 0.8)' // Set the grid color to white with 20% opacity
                                    },
                                    ticks: {
                                      color: 'white' // Set the color of the y-axis labels to white
                                    }
                                  },
                                  x: {
                                    grid: {
                                      color: 'rgba(255, 255, 255, 0.8)' // Set the grid color to white with 20% opacity
                                    },
                                    ticks: {
                                      color: 'white' // Set the color of the x-axis labels to white
                                    }
                                  }
                                },
                                plugins: {
                                  legend: {
                                    labels: {
                                      color: 'white' // Set the color of the legend labels to white
                                    }
                                  }
                                }
                              }
                            };

                            var myHorChart = new Chart(
                              document.getElementById('myHorChart'),
                              Horconfig
                            );
                          </script>

                          </div>
                          
                     <div class="card mt-5" style="width: 305px; height: 350px; background-color: rgb(0,0,0,0.8); z-index: 1;
                           box-shadow: 0px 5px 5px 5px rgb(254,190,16)">
                              <?php 
                                $totals = array(
                                  '100-199' => $total_100,
                                  '200-299' => $total_200,
                                  '300+' => $total_300plus
                              );
                              
                              // Find the key (project name) with the maximum value
                              $maxProject = array_keys($totals, max($totals))[0];
                              
                                ?>
                            <p class="d-flex justify-content-center mx-1 text-warning" 
                            style="font-family: Impact, Haettenschweiler, 'Arial Narrow Bold', sans-serif; margin-top: 200px;">
                            Estimated Budget Demand
                            </p>
                            <div class="d-flex">
                            <i class="fa fa-clock-o text-warning mx-2 mt-1" aria-hidden="true"></i>
                            <p class="text-warning" style="margin-left: -5px;">Update Daily</p>
                            </div>

                            <p class="mx-3 text-light">
                            <?php
                            echo "$maxProject Dollar project is trending in the market.";
                            ?>
                            </p>
                          <span class="d-flex justify-content-end mx-3 text-dark" style="font-family: Impact, Haettenschweiler, 'Arial Narrow Bold', sans-serif;"> </span>
                        </div>
                    </div>

            </div>
        </div>



       <!-- Manager Part -->
         <div id="manager" class="container-fluid tab-pane fade" style="margin-left: 0px; margin-top: -60px"><br>
        <div class="card d-flex" style="margin-left: 15px; position: absolute; z-index: 3;
            background-color: rgb(254,190,16); width: 920px; height: 80px; border-radius: 10px; margin-top: 42px;">
            <a href="admin-page.php" class="back-icon text-dark mx-3 py-3" style="text-decoration: none;font-size: 25px;">Managers Table</a>
            </div>

  <div class="wrapper" style="width: 950px; margin-top:88px; margin-right:-200px;
  border-radius: 16px; box-shadow: 0px 5px 5px 5px rgb(254,190,16); background-color: rgb(0,0,0,0.5); z-index: 2;">
      
    <section class="users" style="padding: 0px 20px;">
      <header style=" display: flex; align-items: center; padding-bottom: 20px; border-bottom: 1px solid #e6e6e6; justify-content: space-between;">
      </header>
      <div class="manager-search" style="  margin: 20px 0; display: flex; position: relative; align-items: center; justify-content: space-between;">
        <span class="text-light">Select a Manager to start chat</span>
        <form>
        <input type="text" style="font-size: 18px; color: black;" name="search" id="manager_search" placeholder="Enter name to search...">
        </form>

        <button><i class="fas fa-search"></i></button>
      </div>
      <div class="d-flex mt-3"> 
              <p class="text-light" style="margin-left: 0px;"><b>Name</b></p>
              <p class="text-light px-5" style="margin-left: 350px;"><b>Status</b></p>
              <p class="text-light px-5" style="margin-left: 190px;"><b>Projects</b></p>
          </div>
      <div class="users-list" id="manager-search-results" style=" max-height: 440px; overflow-y: auto;">
        
        <?php  
        
            $outgoing_id = $_SESSION['unique_id'];

            $sql = "SELECT * FROM manager WHERE 1";
            $query = mysqli_query($conn, $sql);
          
            $output = "";
            if (mysqli_num_rows($query) == 0) {
            $output .= "No users are available to chat";
            } elseif (mysqli_num_rows($query) > 0) {

          while($row = mysqli_fetch_assoc($query)){
            $manager_id = $row['unique_id'];
            $sql1 = "SELECT COUNT(*) as project_count FROM project WHERE manager_id = '$manager_id'";
            $result = mysqli_query($conn, $sql1);
            $row2 = mysqli_fetch_assoc($result);
            $project_count = $row2['project_count'];

            $sql2 = "SELECT * FROM messages WHERE (incoming_msg_id = {$row['unique_id']}
                    OR outgoing_msg_id = {$row['unique_id']}) AND (outgoing_msg_id = {$outgoing_id} 
                    OR incoming_msg_id = {$outgoing_id}) ORDER BY msg_id DESC LIMIT 1";
            $query2 = mysqli_query($conn, $sql2);
            $row2 = mysqli_fetch_assoc($query2);
            (mysqli_num_rows($query2) > 0) ? $result = $row2['msg'] : $result ="No message ";
            (strlen($result) > 28) ? $msg =  substr($result, 0, 28) . '...' : $msg = $result;
            if(isset($row2['outgoing_msg_id'])){
                ($outgoing_id == $row2['outgoing_msg_id']) ? $you = "<b style='color: rgb(0,0,0)'>You:  </b>" : $you = "";
            }else{
                $you = "";
            }
            ($row['active_status'] == "offline") ? $offline = "offline" : $offline = "";
            ($outgoing_id == $row['unique_id']) ? $hid_me = "hide" : $hid_me = "";
      
            $output .= '<div style=" display: flex; position: relative;align-items: center; cursor: pointer;
            padding-bottom: 0px; border-bottom: 1px solid #e6e6e6; justify-content: space-between; margin-bottom: 15px;
            padding-right: 15px; border-bottom-color: #f1f1f1; text-decoration: none; margin-left: 0px; margin-top: 5px; ">

                        <div class="content" style="display: flex; align-items: center;">
                        <img src="uploaded_img/'. $row['profile'] .'" alt="" style="object-fit: cover; border-radius: 50%; height: 40px; width: 40px;">
                        <div class="details" style=" color: #fff; margin-left: 20px;">

                        <a href="admin-manager-chat.php?user_id='. $row['unique_id'] .'" style="text-decoration:none;"> 
                        <span class="" style="color: white; font-size: 15px; "><b>'. $row['name'].'</b></a></span>
                        <p style=" color: white; font-size: 14px;"><b>'. $you . $msg .'</b></p>
                        </div>
                        </div>
                        <div class="status-dot d-flex" style="position: relative; margin-right: -110px;">
                        <button class="button '. $offline .'" style="width: 55px; height:20px; border-radius: 10px; border: none;"><p class="justify-content-center align-item-center"
                         style="margin-left: -3px; margin-top: -2px;  "><b>'.$row['active_status'].'</b></p></button>
                        <p class="date text-warning" style=" padding: 0px 200px; font-size: 20px; margin-left: 100px;  "><b>'.$project_count.'</b>
                        </p>
                       
                        </div>
                    </div>';
        }

       
         echo $output;

      }
  ?>

      </div>
    </section>
  </div>

        </div>

         <!-- Client Part -->
        <div id="Clients" class="container-fluid tab-pane fade" style="margin-left: 0px; margin-top: -60px"><br>
        <div class="card d-flex bg-light" style="margin-left: 15px; position: absolute; z-index: 3;
            background-color: rgb(254,190,16); width: 920px; height: 80px; border-radius: 10px; margin-top: 42px;">
            <a href="admin-page.php" class="back-icon text-dark mx-3 py-3" style="text-decoration: none;font-size: 25px;">Client Table</a>
            </div>

  <div class="wrapper" style="width: 950px; margin-top:88px; margin-right:-200px;
  border-radius: 16px; box-shadow: 0px 5px 5px 5px ; background-color: rgb(0,0,0,0.5); z-index: 2;">
      
    <section class="users" style="padding: 0px 20px;">
      <header style=" display: flex; align-items: center; padding-bottom: 20px; border-bottom: 1px solid #e6e6e6; justify-content: space-between;">

      </header>
      <div class="search" style="  margin: 20px 0; display: flex; position: relative; align-items: center; justify-content: space-between;">
        <span class="text-light">Select a client to start chat</span>
        <form>
        <input type="text" style=" font-size: 18px; color:black;" name="search" id="client-search" placeholder="Enter name to search...">
        </form>
        <button><i class="fas fa-search"></i></button>
      </div>
      <div class="d-flex mt-3" style="font-family: Impact, Haettenschweiler, 'Arial Narrow Bold', sans-serif;"> 
              <p class="text-light" style="margin-left: 0px;">Name</p>
              <p class="text-light px-5" style="margin-left: 300px;">Status</p>
              <p class="text-light px-5" style="margin-left: 105px;">Joined</p>
          </div>
      <div class="users-list" id="client-search-results" style=" max-height: 440px; overflow-y: auto;">
        
        <?php  
        
            $outgoing_id = $_SESSION['unique_id'];
            $sql = "SELECT * FROM details 
            WHERE NOT unique_id = {$outgoing_id} 
            AND status <> 'suspend'
            ORDER BY id DESC";

            $query = mysqli_query($conn, $sql);
            $output = "";
            $function = "client";
            if (mysqli_num_rows($query) == 0) {
            $output .= "No users are available to chat";
            } elseif (mysqli_num_rows($query) > 0) {

          while($row = mysqli_fetch_assoc($query)){
            $sql2 = "SELECT * FROM messages WHERE (incoming_msg_id = {$row['unique_id']}
                    OR outgoing_msg_id = {$row['unique_id']}) AND (outgoing_msg_id = {$outgoing_id} 
                    OR incoming_msg_id = {$outgoing_id}) ORDER BY msg_id DESC LIMIT 1";
            $query2 = mysqli_query($conn, $sql2);
            $row2 = mysqli_fetch_assoc($query2);
            (mysqli_num_rows($query2) > 0) ? $result = $row2['msg'] : $result ="No message ";
            (strlen($result) > 28) ? $msg =  substr($result, 0, 28) . '...' : $msg = $result;
            if(isset($row2['incoming_msg_id'])){
                ($outgoing_id == $row2['outgoing_msg_id']) ? $you = "<b style='color: rgb(254,190,16);'>You:  </b>" : $you = "";
            }else{
                $you = "";
            }
            ($row['active_status'] == "Offline") ? $offline = "offline" : $offline = "";
            ($outgoing_id == $row['unique_id']) ? $hid_me = "hide" : $hid_me = "";
      
            $output .= '<div style=" display: flex; position: relative;align-items: center; cursor: pointer;
            padding-bottom: 0px; border-bottom: 1px solid #e6e6e6; justify-content: space-between; margin-bottom: 15px;
            padding-right: 15px; border-bottom-color: #f1f1f1; text-decoration: none; margin-left: 0px; margin-top: 5px; ">

                        <div class="content" style="display: flex; align-items: center;">
                        <img src="uploaded_img/'. $row['image'] .'" alt="" style="object-fit: cover; border-radius: 50%; height: 40px; width: 40px;">
                        <div class="details" style=" color: #fff; margin-left: 20px;">

                        <a href="admin-client-chat.php?user_id='. $row['unique_id'] .'" style="text-decoration:none;"> 
                        <span class="" style="color: white; font-size: 17px; font-family: bold;"><b>'. $row['name'].'</b></a></span>
                        <p style=" color: white; font-size: 14px;"><b>'. $you . $msg .'</b></p>
                        </div>
                        </div>
                        <div class="status-dot d-flex" style="position: relative; margin-right: -10px;">
                        <button class="button '. $offline .'" style="width: 55px; height:20px; border-radius: 10px; border: none;"><p class="justify-content-center align-item-center"
                         style="margin-left: -3px; margin-top: -2px;  "><b>'.$row['active_status'].'</b></p></button>
                        <p class="date " style=" padding: 0px 180px; color : white; font-size: 13px;  "><b>'. $row['join_date'] .'</b>
                        </p>
                        <div class="btn btn-outline-warning" style="">
                        <a href="ban-list.php?user_id='. $row['unique_id'] .'&action='.$function.'" class="delete-button"  type="submit" style="border:none; color: white; background:transparent; font-size: 14px;">
                        <i class="fa fa-trash"></i></a>
                        </div> 
                        </div>
                    </div>';
        }

       
         echo $output;

      }
  ?>

      </div>
    </section>
  </div>

        </div>


        
        <!-- Developer Part -->
        <div id="Developers" class="container tab-pane fade" style="margin-left: -10px; margin-top: -40px">
        <div class="card d-flex" style="margin-left: 15px; position: absolute; z-index: 3;
            background-color: rgb(254,190,16); width: 970px; height: 80px; border-radius: 10px; margin-top:-42px;">
            <a href="admin-page.php" class="back-icon text-dark mx-3 py-3" style="text-decoration: none;font-size: 25px;">Developers Table</a>
            </div>

  <div class="wrapper" style="width: 1000px; margin-top:88px; 
  border-radius: 16px; box-shadow: 0px 5px 5px 5px rgb(254,190,16);  background-color: rgb(0,0,0,0.5); z-index: 2;">
      
    <section class="users" style="padding: 0px 20px;">
      <header style=" display: flex; align-items: center; padding-bottom: 20px; border-bottom: 1px solid #e6e6e6; justify-content: space-between;">
        <div class="content" style="display: flex; align-items: center; color: #fff; margin-left: 20px;">
          <?php 
            $sql = mysqli_query($conn, "SELECT * FROM admin WHERE unique_id = {$_SESSION['unique_id']}");
            if(mysqli_num_rows($sql) > 0){
              $row = mysqli_fetch_assoc($sql);
            }
          ?>
        </div>

      </header>
      <div class="dev-search" style="  margin: 20px 0; display: flex; position: relative; align-items: center; justify-content: space-between;">
        <span class="text-light">Select a Developer to start chat</span>
        <form>
        <input type="text" style=" font-size: 18px; color:black;" name="dev_search" id="dev_search" placeholder="Enter name to search...">
          </form>
        <button><i class="fas fa-search"></i></button>
      </div>
      <div class="d-flex mt-3" style="font-family: Impact, Haettenschweiler, 'Arial Narrow Bold', sans-serif;"> 
              <p class="text-light" style="margin-left: 0px;">Name</p>
              <p class="text-light px-5" style="margin-left: 250px;">Function</p>
              <p class="text-light px-5" style="margin-left: 100px;">Status</p>
              <p class="text-light px-5" style="margin-left: 80px;">Joined</p>
          </div>
      <div class="dev-users-list" id="dev-search-results" style=" max-height: 440px; overflow-y: auto;">
        <?php    

        $outgoing_id = $_SESSION['unique_id'];
        $sql = "SELECT * FROM developer WHERE NOT unique_id = {$outgoing_id} AND status <> 'suspend'
        ORDER BY d_id DESC";
        $query = mysqli_query($conn, $sql);
        $output = "";
        $function2 = "developer";
        if(mysqli_num_rows($query) == 0){
        $output .= "No users are available to chat";
        }elseif(mysqli_num_rows($query) > 0){

          while($row = mysqli_fetch_assoc($query)){
            $sql2 = "SELECT * FROM messages WHERE (incoming_msg_id = {$row['unique_id']}
                    OR outgoing_msg_id = {$row['unique_id']}) AND (outgoing_msg_id = {$outgoing_id} 
                    OR incoming_msg_id = {$outgoing_id}) ORDER BY msg_id DESC LIMIT 1";
            $query2 = mysqli_query($conn, $sql2);
            $row2 = mysqli_fetch_assoc($query2);
            (mysqli_num_rows($query2) > 0) ? $result = $row2['msg'] : $result ="No message";
            (strlen($result) > 28) ? $msg =  substr($result, 0, 28) . '...' : $msg = $result;
            if(isset($row2['incoming_msg_id'])){
              ($outgoing_id == $row2['outgoing_msg_id']) ? $you = "<b style='color: rgb(254,190,16);'>You:  </b>" : $you = "";
            }else{
              $you = "";
              
            }
            ($row['active_status'] == "Offline") ? $offline = "offline" : $offline = "";
            ($outgoing_id == $row['unique_id']) ? $hid_me = "hide" : $hid_me = "";
      
            $output .= '<div href="admin-dev-chat.php?user_id='. $row['unique_id'] .'" style="display: flex; position: relative;align-items: center; padding-bottom: 0px; border-bottom: 1px solid #e6e6e6; justify-content: space-between; margin-bottom: 15px; padding-right: 15px; border-bottom-color: #f1f1f1; text-decoration: none; margin-left: px; margin-top: 5px; ">

            <div class="content" style="display: flex; align-items: center;">
                <img src="uploaded_img/'. $row['d_profile'] .'" alt="" style="object-fit: cover; border-radius: 50%; height: 40px; width: 40px;">
                <div class="details" style="color: #fff; margin-left: 20px;">
                   <a href="admin-dev-chat.php?user_id='. $row['unique_id'] .'" style="text-decoration:none;"> 
                    <span class="" style="color: white; font-size: 15px; font-family: bold;"><b>'. $row['name'].'</a></b>
                    </span>
                    <p style="color: white; font-size: 14px;"><b>'. $you . $msg .'</b></p>
                </div>
            </div>
            
            <div class="status-dot d-flex" style="position: relative; margin-right: -15px;">
               <div class="function" style="position: absolute; margin-left:-490px;">
                <p class="date" style="padding: 0px 50px; color: white; font-size: 13px;"><b>'. $row['d_skill'] .'</b></p>
                </div>
                <div class="">

                <button class="button '. $offline .'" style="width: 45px; height:20px; border-radius: 10px; border:none; margin-left:-185px; font-size: 12px;">
                    <p class="justify-content-center align-item-center" style="margin-left: -3px; margin-top: 0px;"><b>'. $row['active_status'].'</b></p>
                </button>
                </div>
                <div class="">
                <p class="date" style="padding: 0px 20px; color: white; font-size: 13px; margin-right: 40px;"><b>'. $row['date'] .'</b></p>
                </div>
                <div class="btn btn-outline-warning" style="">
                        <a href="ban-list.php?user_id='. $row['unique_id'] .'&action='.$function2.'" class=""  type="submit" style=" color:white; font-size: 14px;">
                        <i class="fa fa-trash"></i></a>
                        </div> 
                       </div>
        </div>';
        }

        }
       
         echo $output;

   
  ?>

      </div>
    </section>
  </div>

        </div>




                            <!-- Billing Part -->
                            <div id="billing" class="container tab-pane fade" style="margin-left: -30px; margin-top: -40px">
                    <div class="card d-flex" style="margin-left: 15px; position: absolute; z-index: 3;
                        background-color: rgb(254,190,16); width: 1000px; height: 80px; border-radius: 10px; margin-top:-42px;">
                        <a href="admin-page.php" class="back-icon text-dark mx-3 py-3" style="text-decoration: none;font-size: 25px;">Billing Table</a>
                        </div>

              <div class="wrapper" style="width: 1030px; margin-top:88px; 
              border-radius: 16px; box-shadow: 0px 5px 5px 5px rgb(254,190,16);  background-color: rgb(0,0,0,0.5); z-index: 2;">
                  
                <section class="users" style="padding: 0px 20px;">
                  <header style=" display: flex; align-items: center; padding-bottom: 20px; border-bottom: 1px solid #e6e6e6; justify-content: space-between;">
                    <div class="content" style="display: flex; align-items: center; color: #fff; margin-left: 20px;">
                      <?php 
                        $sql = mysqli_query($conn, "SELECT * FROM admin WHERE unique_id = {$_SESSION['unique_id']}");
                        if(mysqli_num_rows($sql) > 0){
                          $row = mysqli_fetch_assoc($sql);
                        }
                      ?>
                    </div>

                  </header>
                  <div class="dev-search" style="  margin: 20px 0; display: flex; position: relative; align-items: center; justify-content: space-between;">
                  </div>
                  <div class="d-flex mt-3" style="font-family: Impact, Haettenschweiler, 'Arial Narrow Bold', sans-serif;"> 
                          <p class="text-light" style="margin-left: 0px;">Name</p>
                          <p class="text-light px-5" style="margin-left: 145px;">Code</p>
                          <p class="text-light px-5" style="margin-left: 30px;">Delivery</p>
                          <p class="text-light px-5" style="margin-left: 40px;">Wallet</p>
                          <p class="text-light px-5" style="margin-left: 40px;">Amount</p>
                          <p class="text-light px-5" style="margin-left: 20px;">Client</p>
                      </div>
                  <div class="billing-list" id="dev-search-results" style=" max-height: 440px; overflow-y: auto;">
                    <?php    

                    $outgoing_id = $_SESSION['unique_id'];
                    $sql = "SELECT * FROM billing WHERE 1";
                    $query = mysqli_query($conn, $sql);
                    $output = "";
                    if(mysqli_num_rows($query) == 0){
                    $output .= "Empty Database....";
                    }elseif(mysqli_num_rows($query) > 0){

                      while($row = mysqli_fetch_assoc($query)){

                    
                        
                      
                        $output .= '<div class="project-card1" style="display: flex; position: relative; align-items: center; padding-bottom: 15px; border-bottom: 1px solid #e6e6e6; justify-content: space-between; margin-bottom: 15px; padding-right: 15px; border-bottom-color: #f1f1f1; text-decoration: none; margin-left: 0; margin-top: 5px;">

                        <div class="content1" style="width: 170px; display: flex; align-items: center;">
                            <div class="details" style="color: #fff; margin-left: 0;">
                                <span class="project-name" style="color: white; font-size: 15px; font-family: bold;"><b>'. $row['project_name'].'</b></span>
                            </div>
                        </div>
                    
                        <div class="project-info1" style="width: 10px; margin-left: -30px;  ">
                            <p class="project-id" style="color: white; font-size: 13px; margin-bottom: 5px;"><b>'. $row['project_id'] .'</b></p>
                            </div>

                            <div class="delivery" style="width: 90px; height: 20px; margin-left: 45px; border-radius: 10px; color: #fff; font-size: 12px;">
                            <p style="margin: 0; font-size: 15px;"><b>'. $row['end'] .'</b></p>
                            </div>

                            <div class="wallet-numbe1r" style="width: 120px; height: 20px; border-radius: 10px; color: #fff; font-size: 12px; padding: 0px 0px; ">
                                <p style="margin: 0; font-size: 15px;"><b>'. $row['wallet'] .'</b></p>
                            </div>
                            <p class="amount1" style="width: 50px; color: white; font-size: 13px; margin-bottom: 5px;"><b>$'. $row['amount'] .'</b></p>
                            <p class="unique-id" style=" color: white; font-size: 13px;"><b>'. $row['client_id'] .'</b></p>
                        </div>
                    ';
                    
                    }

                    }
                  
                    echo $output;

              
              ?>

                  </div>
                </section>
              </div>

                    </div>



        

          <!-- Suspend Part -->
        <div id="suspend" class="container tab-pane fade" style="margin-left: -10px; margin-top: -40px">
        <div class="card d-flex" style="margin-left: 15px; position: absolute; z-index: 3;
            background-color: rgb(254,190,16); width: 950px; height: 80px; border-radius: 10px; margin-top:-42px;">
            <a href="admin-page.php" class="back-icon text-dark mx-3 py-3" style="text-decoration: none;font-size: 25px;">Suspended Table</a>
            </div>

  <div class="wrapper" style="width: 980px; margin-top:88px; 
  border-radius: 16px; box-shadow: 0px 5px 5px 5px rgb(254,190,16);  background-color: rgb(0,0,0,0.5); z-index: 2;">
      
    <section class="users" style="padding: 0px 20px;">
      <header style=" display: flex; align-items: center; padding-bottom: 20px; border-bottom: 1px solid #e6e6e6; justify-content: space-between;">
        <div class="content" style="display: flex; align-items: center; color: #fff; margin-left: 20px;">
          <?php 
            $sql = mysqli_query($conn, "SELECT * FROM admin WHERE unique_id = {$_SESSION['unique_id']}");
            if(mysqli_num_rows($sql) > 0){
              $row = mysqli_fetch_assoc($sql);
            }
          ?>
        </div>

      </header>
      <div class="suspend-search" style="  margin: 20px 0; display: flex; position: relative; align-items: center; justify-content: space-between;">
        <span class="text-light"><b><?php echo "Today is: ". date("Y-m-d");?></b></span>
        <span class="text-light"><b>Search Current Date To Unsuspend Users </b></span>
        <form>
        <input type="text" style=" font-size: 18px; color:black;" name="suspend_search" id="suspend_search" placeholder="(YY-MM-DD)">
          </form>
        <button><i class="fas fa-search"></i></button>
      </div>
      <div class="d-flex mt-3" style="font-family: Impact, Haettenschweiler, 'Arial Narrow Bold', sans-serif;"> 
              <p class="text-light" style="margin-left: 0px;">Name</p>
              <p class="text-light px-5" style="margin-left: 130px;">Email</p>
              <p class="text-light px-5" style="margin-left: 50px;">Function</p>
              <p class="text-light px-5" style="margin-left: 50px;">Action</p>
              <p class="text-light px-5" style="margin-left: 50px;">Release</p>
          </div>
      <div class="suspend-list" id="suspend-results" style=" max-height: 440px; overflow-y: auto;">
        <?php    

        $outgoing_id = $_SESSION['unique_id'];
        $sql = "SELECT * FROM suspend WHERE 1";
        $query = mysqli_query($conn, $sql);
        $output = "";


        while($row = mysqli_fetch_assoc($query)){
      
            $output .= '<div style="display: flex; position: relative;align-items: center; padding-bottom: 0px; border-bottom: 1px solid #e6e6e6;
             justify-content: space-between; margin-bottom: 15px; padding-right: 15px; border-bottom-color: #f1f1f1; text-decoration: none; margin-left: px; margin-top: 5px;">

                <div class="" style="color: #fff; margin-left: 0px; margin-bottom: 20px;">
                    <span class=""style="color: white; font-size: 14px;"><b>'. $row['name'].'</b>
                    </span>
                 
                </div>

            
            <div class="status-dot d-flex" style="position: relative; margin-right: -5px;">
               <div class="function" style="position: absolute; margin-left:-650px;">
                <p class="date" style="padding: 0px 50px; color: white; font-size: 13px;"><b>'. $row['email'] .'</b></p>
                </div>
                <div class="">
                <p class="justify-content-center align-item-center text-light" style="font-size: 14px; margin-left: -370px;"><b>'. $row['function'].'</b></p>
                </div>
                <div class="">
                <div class="" style="  margin-left:-175px; font-size: 13px;">
                    <p class="justify-content-center align-item-center text-light" style=""><b>'. $row['date'].'</b></p>
                </div>
                </div>
                <div class="">
                <p class="date" style="padding: 0px 20px; color: white; font-size: 13px; margin-right: 40px;"><b>'. $row['suspend_date'] .'</b></p>
                </div>
                <div class="" style="">
                        <a href="unsuspend.php?user_id='. $row['unique_id'] .'" class="delete-button"  type="submit" style="border:none;
                         color: white; background:transparent; font-size: 16px;"><i class="fa fa-history"></i></a>
                        </div> 
                       </div>
        </div>';
       
        }
        echo $output;
   
  ?>

      </div>
    </section>
  </div>

        </div>



                                  <!-- Approval Part -->
                                  <div id="approval" class="container-fluid tab-pane fade" style="margin-left: -10px; margin-top: -20px"><br>
                        <div class="card d-flex" style="margin-left: 15px; position: absolute; z-index: 3;
                            background-color: rgb(254,190,16); width: 950px; height: 80px; border-radius: 10px; margin-top: 0px;">
                            <a href="admin-page.php" class="back-icon text-dark mx-3 py-3" style="text-decoration: none;font-size: 25px;">Approval Table</a>
                            </div>

                  <div class="wrapper" style="width: 980px; margin-top:48px; margin-right:-200px; 
                  border-radius: 16px; box-shadow: 0px 5px 5px 5px rgb(254,190,16); background-color: rgb(0,0,0,0.5); z-index: 2;">
                      
                    <section class="users" style="padding: 0px 20px;">
                    <header>
                      <div class="" style="">
                    By Create Button You can Create Project
                      </div>
                      </hearder>
                  
                      <div class="d-flex mt-3" style="font-family: Impact, Haettenschweiler, 'Arial Narrow Bold', sans-serif;"> 
                    <p class="text-light" style="margin-left: 0px;">Project-Name</p>
                    <p class="text-light px-5" style="margin-left: 290px;">Project-ID</p>
                    <p class="text-light px-5" style="margin-left: 140px;">Client-ID</p>
                </div>

                <div class="users-list" id="search-results" style="max-height: 440px; overflow-y: auto;">
                    <?php  
                      
                        $sql = "SELECT * FROM approval WHERE 1";
                        $query = mysqli_query($conn, $sql);
                        $output = "";

                        if (mysqli_num_rows($query) == 0) {
                            $output .= "No Approval here..";
                        } elseif (mysqli_num_rows($query) > 0) {
                            while ($row = mysqli_fetch_assoc($query)) {
            
              
          

                // Display user information and progress bar
                $output .= '<div style="display: flex; position: relative; align-items: center; cursor: pointer;
                    padding-bottom: 0px; border-bottom: 1px solid #e6e6e6; justify-content: space-between; margin-bottom: 15px;
                    padding-right: 15px; border-bottom-color: #f1f1f1; text-decoration: none; margin-left: 0px; margin-top: 5px; ">
                    <div class="content" style="display: flex; align-items: center;">
                        <div class="details" style="color: #fff; margin-left: 0px;">
                            <a href="" style="text-decoration:none;"> 
                                <span class="" style="color: white; font-size: 17px; font-family: bold;"><b>' . $row['name'] . '</b></a></span>
                            </div>
                        </div>
                      
                            <div class="container d-flex" style="margin-right: 50px; width: 450px; position: relative; ">
                                <div class="">
                                    <div class=" text-light" style="">
                                      <b>' . $row['project_id'] . '</b>
                                    </div>
                                </div>
                          
                            <div class="container">
                                <p class="date text-light " style="margin-left: 220px; width: 65px;"><b>' . $row['client_id'] . '</b></p>
                            </div>
                            <div class="" style="margin-right: -70px; margin-bottom: 10px;">
                            <a href="admin-project-approval.php?user_id='.$row['client_id'].'&project_id='.$row['project_id'].'&id='.$row['id'].'" class="btn btn-outline-warning" style="font-size: 18px;">
                                <i class="fa fa-circle-o-notch rotate-icon"></i>
                            </a>
                        </div>
                        </div>
                    </div>';
            }
            echo $output;
        }     
    ?>


      </div>
    </section>
  </div>

        </div>

         <!--Project list Part -->
         <div id="view" class="container-fluid tab-pane fade" style="margin-left: 0px; margin-top: -20px"><br>
        <div class="card d-flex" style="margin-left: 15px; position: absolute; z-index: 3;
            background-color: rgb(254,190,16); width: 950px; height: 80px; border-radius: 10px; margin-top: 0px;">
            <a href="admin-page.php" class="back-icon text-dark mx-3 py-3" style="text-decoration: none;font-size: 25px;">Project Table</a>
            </div>

  <div class="wrapper" style="width: 980px; margin-top:48px; margin-right:-200px; 
  border-radius: 16px; box-shadow: 0px 5px 5px 5px rgb(254,190,16); background-color: rgb(0,0,0,0.5); z-index: 2;">
      
    <section class="users" style="padding: 0px 20px;">
    <header>
      <div class="" style="">
    By Create Button You can Create Project
      </div>
      </hearder>
  
      <div class="d-flex mt-3" style="font-family: Impact, Haettenschweiler, 'Arial Narrow Bold', sans-serif;"> 
    <p class="text-light" style="margin-left: 0px;">Project</p>
    <p class="text-light px-5" style="margin-left: 220px;">Progress</p>
    <p class="text-light px-5" style="margin-left: 90px;">Client</p>
    <p class="text-light px-5" style="margin-left: 70px;">Status</p>
    <input type="button" class="btn btn-warning" value="Create" style="margin-left: 5px;" data-bs-toggle="modal" data-bs-target="#project">
</div>

<div class="users-list" id="search-results" style="max-height: 440px; overflow-y: auto;">
    <?php  
        $outgoing_id = $_SESSION['unique_id'];
        $sql = "SELECT * FROM project WHERE 1";
        $query = mysqli_query($conn, $sql);
        $output = "";

        if (mysqli_num_rows($query) == 0) {
            $output .= "No developer here..";
        } elseif (mysqli_num_rows($query) > 0) {
            while ($row = mysqli_fetch_assoc($query)) {
                $sql2 = "SELECT * FROM project WHERE unique_id = " . $row['unique_id'] ;
                $query2 = mysqli_query($conn, $sql2);
                $row2 = mysqli_fetch_assoc($query2);
                $result = (mysqli_num_rows($query2) > 0) ? $row2['des_1'] : "";
                $msg = (strlen($result) > 28) ? substr($result, 0, 28) . '...' : $result;
                $dev_id1 = $row['developer_1_id'];
                $dev_id2 = $row['developer_2_id'];
                $dev_id3 = $row['developer_3_id'];
                $manager_id = $row['manager_id'];
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
                    padding-right: 15px; border-bottom-color: #f1f1f1; text-decoration: none; margin-left: 0px; margin-top: 5px; ">
                    <div class="content" style="display: flex; align-items: center;">
                        <div class="details" style="color: #fff; margin-left: 0px;">
                            <a href="" style="text-decoration:none;"> 
                                <span class="" style="color: white; font-size: 17px;"><b>' . $row['name'] . '</b></a></span>
                                <p style="color: white; font-size: 13px;"><b>' . $msg . '</b></p>
                            </div>
                        </div>
                        <div class="status-dot d-flex" style="position: relative; margin-right: -140px;">
                            <div class="container" style="margin-right: -160px; width: 340px;">
                                <div class="progress">
                                    <div class="progress-bar progress-bar-striped bg-warning text-dark" role="progressbar" aria-valuenow=' . $per . ' aria-valuemin="0" aria-valuemax="100" style="width:' . $per . '%">
                                        ' . $per . '%
                                    </div>
                                </div>
                            </div>

                            <div class="client" style="margin-right: -50px;">
                            <p class="date text-light " style="margin-left: 240px; width: 5px;"><b>' . $row['client_id'] . '</b></p>
                            </div>

                            <div class="container" style="margin-right: -60px">
                                <p class="date text-light " style="margin-left: 240px; width: 65px;"><b>' . $row['status'] . '</b></p>
                            </div>
                            <div class="dropend" style="margin-left: -35px;">
                                <button class="btn btn-outline-warning dropdown-toggle" type="button" data-bs-toggle="dropdown" style="margin-right: 140px;">
                                    <i class="fa fa-folder"></i>
                                    <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu bg-warning" style="font-size: 13px; ">
                                <li>
                                <a class="dropdown-item" href="admin-project-view.php?user_id='. $row['unique_id'] .'&dev1='.$dev_id1.'&dev2='.$dev_id2.'&dev3='.$dev_id3.'&manager='.$manager_id.'">
                                    <b>View</b>
                                </a>
                            </li>
                                <li><a class="dropdown-item" href="admin-project-edit.php?id='.$row['id'].'"><b>Edit</b></a></li>
                                <li><a class="dropdown-item" href="admin-project-file.php?project_id='.$row['unique_id'].'&manager='.$row['manager_id'].'"><b>File</b></a></li>
                                <li><a class="dropdown-item" href="admin-project-handover.php?id='.$row['id'].'"><b>Hand Over</b></a></li>
                                    <li><a class="dropdown-item" href="admin-project-delete.php?user_id='.$row['client_id'].'"><b>Delete</b></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>';
            }
            echo $output;
        }     
    ?>

      </div>
    </section>
  </div>

        </div>


        




        </div>

      </div>
    </div>
  </div>
</div>



    <!-- The Create Project Modal -->
<div class="modal" id="project">
    <div class="modal-dialog modal-lg">
    <div class="modal-content" style="background-color: rgb(0,0,0,0.8); border-color:rgb(254,190,16); border-radius: 20px; margin-top: 0px; ">
            <!-- Modal body -->
            <div class="modal-body text-light">
                <!-- Project Form -->
                <div class="container-fluid">
                <form method="post">
                    <div class="row">
                        <div class="col-md-6">
                            <label for="name"><b>Name</b></label>
                            <select class="form-select text-warning" name="name" style="background-color: rgb(0,0,0,0.8);border-color:rgb(254,190,16);" id="name">
                                <option>Web Development,2224</option>
                                <option>Search Engine Optimization,2225</option>
                                <option>Pay Per Click,2226</option>
                                <option>Socical Media Marketing,2227</option>
                                <option>Content Marketing,2228</option>
                                <option>Email Marketing,2229</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="status"><b>Status</b></label>
                            <select class="form-select text-warning" name="status" style="background-color: rgb(0,0,0,0.8);border-color:rgb(254,190,16);  id="status">
                                <option>Pending</option>
                                <option>On-Hold</option>
                                <option>Processing</option>
                                <option>Done</option>
                            </select>
                        </div>
                        <div class="col-md-6 ">
                            <label for="start"><b>Start-Date</b></label>
                            <input class="form-control text-warning" name="start" style="background-color: rgb(0,0,0,0.8);border-color:rgb(254,190,16);"  type="date" id="start">
                        </div>
                        <div class="col-md-6 ">
                            <label for="end"><b>End-Date</b></label>
                            <input class="form-control text-warning" name="end" style="background-color: rgb(0,0,0,0.8);border-color:rgb(254,190,16);"  type="date" id="end">
                        </div>
                        <div class="col-md-6 ">
                            <label for="manager"><b>Project-Manager</b></label>
                            <select class="form-select text-warning" name="manager" style="background-color: rgb(0,0,0,0.8);border-color:rgb(254,190,16);  id="manager">
                                <?php
                                $query = "SELECT * FROM `manager` WHERE 1";
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

                                 <label for="manager"><b>Client</b></label>
                            <select class="form-select text-warning" name="client" style="background-color: rgb(0,0,0,0.8);border-color:rgb(254,190,16);"  id="manager">
                                <?php
                                $query = "SELECT * FROM `details` WHERE 1";
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
                        <div class="col-md-6 ">
                            <label for="developer"><b>Project-Developer</b></label>
                            <textarea class="form-control select text-warning" name="developer" id="developer" style="width: 100%; height: 30px; background-color: rgb(0,0,0,0.8);border-color:rgb(254,190,16);"></textarea>
                          
                          <select class="names text-warning"  style="display:none; margin-top: 0px; margin-left: 0px; width: 93%; z-index: 2; position: absolute; background-color: rgb(0,0,0,0.8);border-color:rgb(254,190,16); " multiple id="option">
                            
                            <?php
                              $query = "SELECT * FROM `developer` WHERE 1";
                              $allData = mysqli_query($conn, $query);
                              $output2="";
                              if (mysqli_num_rows($allData) > 0) {
                                  while ($arrayData = mysqli_fetch_array($allData)) {
                                      $output2 .= ' 
                                      <option class="option" id="developer-select">
                                       <p>' . $arrayData['name'] . ' ,'. $arrayData['unique_id'] .'</p>
                                    
                                      </option> ';
                                  }
                              } else {
                                
                                  $output2 .= '<option>No project managers found</option>';
                              }
                              echo $output2;
                              ?>
                              </select>

                              <label for="name"><b>Project Amount</b></label>
                            <input type="text" name="amount" class="form-control text-warning" style="background-color: rgb(0,0,0,0.8);border-color:rgb(254,190,16);  id="name" placeholder="Amount in dollar...">
                        </div>
                        <div class="col-md-12 ">
                            <label for="text"><b>Description</b></label>
                            <textarea type="text" name="text" class="form-control text-warning" style="background-color: rgb(0,0,0,0.8);border-color:rgb(254,190,16);height: 200px;"></textarea>
                        </div>
                        <div class="col-md-12 mt-1">
                            <input type="submit" name="create" class="btn btn-outline-warning" value="Create">
                            <button type="button" class="btn bg-warning" data-bs-dismiss="modal">Cancel</button>
                         </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>



 





                  <!-- The Logout Modal -->
                  <div class="modal" id="logout">
                    <div class="modal-dialog w-25" style="margin-top: 250px;">
                      <div class="modal-content" style="background-color: rgb(0,0,0,0.8); border-color:rgb(254,190,16);  ; ">

                        <!-- Modal body -->
                        <div class="modal-body text-light">
                          <b>Are you sure to Logout?</b>
                        </div>

                        <!-- Modal footer -->
                        <div class="modal-footer">
                          <button type="button" class="btn"><a href="logout.php" class="btn btn-outline-warning" style="text-decoration:none;">Yes</a></button>
                          <button type="button" class="btn bg-warning" data-bs-dismiss="modal">No</button>
                        </div>

                      </div>
                    </div>
                  </div>




        <script>
            

             // Manager Search button
             const msearchBar = document.querySelector(".manager-search input"),
            msearchIcon = document.querySelector(".manager-search button"),
            musersList = document.querySelector(".users-list");

            msearchIcon.onclick = ()=>{
            msearchBar.classList.toggle("show");
            msearchIcon.classList.toggle("active");
            msearchBar.focus();
            if(msearchBar.classList.contains("active")){
                msearchBar.value = "";
                msearchBar.classList.remove("active");
            }
            }


            // Client Search button
            const searchBar = document.querySelector(".search input"),
            searchIcon = document.querySelector(".search button"),
            usersList = document.querySelector(".users-list");

            searchIcon.onclick = ()=>{
            searchBar.classList.toggle("show");
            searchIcon.classList.toggle("active");
            searchBar.focus();
            if(searchBar.classList.contains("active")){
                searchBar.value = "";
                searchBar.classList.remove("active");
            }
            }
             
            //Developer Search button
            const devsearchBar = document.querySelector(".dev-search input"),
            devsearchIcon = document.querySelector(".dev-search button"),
            devusersList = document.querySelector(".dev-users-list");

            devsearchIcon.onclick = ()=>{
            devsearchBar.classList.toggle("show");
            devsearchIcon.classList.toggle("active");
            devsearchBar.focus();
            if(devsearchBar.classList.contains("active")){
                devsearchBar.value = "";
                devsearchBar.classList.remove("active");
            }
            }

                //Suspend Search button
                const suspendsearchBar = document.querySelector(".suspend-search input"),
                suspendsearchIcon = document.querySelector(".suspend-search button"),
                suspendusersList = document.querySelector(".suspend-users-list");

                suspendsearchIcon.onclick = ()=>{
                suspendsearchBar.classList.toggle("show");
                suspendsearchIcon.classList.toggle("active");
                suspendsearchBar.focus();
                if(suspendsearchBar.classList.contains("active")){
                suspendsearchBar.value = "";
                suspendsearchBar.classList.remove("active");
            }
            }
             
            //Developer Handle
            const select = document.querySelector(".select");
            const dropdown = document.querySelector(".names");
            

            select.addEventListener("click", () => {
                if (dropdown.style.display === 'none') {
                    dropdown.style.display = 'block';
                } else {
                    dropdown.style.display = 'none';
                }
            });

            //create project -> developer 
            $(document).ready(function () {
        $("#option").on('change', function () {
            // Get all selected values
            var selectedValues = $(this).val();

            // Update the input field with all selected values
            $(".select").val(selectedValues.join(',\n'));
            });
        });
      

         //Manager Search
         $(document).ready(function() {
            $('#manager-search').on('input', function() {
                var query = $(this).val();

                if (typeof query !== 'undefined') {
                    $.ajax({
                        url: 'admin-manager-search.php',
                        method: 'GET',
                        data: { search: query },
                        success: function(data) {
                            $('#manager-search-results').html(data);
                        }
                    });
                } else {
                    // Handle the case when the input is empty or null
                    $('#managers-search-results').html('');
                }
            });
        });



           //Client Search
           $(document).ready(function() {
            $('#client-search').on('input', function() {
                var query = $(this).val();

                if (typeof query !== 'undefined') {
                    $.ajax({
                        url: 'admin-client-search.php',
                        method: 'GET',
                        data: { search: query },
                        success: function(data) {
                            $('#client-search-results').html(data);
                        }
                    });
                } else {
                    // Handle the case when the input is empty or null
                    $('#client-search-results').html('');
                }
            });
        });

      
            

            //Developer Search
            $(document).ready(function() {
                $('#dev_search').on('input', function() {
                    var dev_query = $(this).val();

                    if (typeof dev_query !== 'undefined') {
                        $.ajax({
                            url: 'admin-dev-search.php',
                            method: 'GET',
                            data: { search: dev_query },
                            success: function(data) {
                                $('#dev-search-results').html(data);
                            }
                        });
                    } else {
                        $('#dev-search-results').html('');
                    }
                });
            });

            //suspend Search
            $(document).ready(function() {
                $('#suspend_search').on('input', function() {
                    var dev_query = $(this).val();

                    if (dev_query != '') {
                        $.ajax({
                            url: 'admin-suspend-search.php',
                            method: 'GET',
                            data: { search: dev_query },
                            success: function(data) {
                                $('#suspend-results').html(data);
                            }
                        });
                    } else {
                        $('#suspend-results').html('');
                    }
                });
            });
     

    
    </script>
      <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
      <!-- Bootstrap JS and Popper.js -->

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
