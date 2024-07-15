<?php 

    //Import PHPMailer classes into the global namespace
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

  include "config.php";
  session_start();
  if (!isset($_SESSION['unique_id'])) {
    header("Location: index.php");
    die();
  }

  require 'vendor/autoload.php';
  $msg = "";
  
  $unique_id = $_SESSION['unique_id'];

$output1 = "";
$output2 = "";

//Approval Database
$user_id = mysqli_real_escape_string($conn, $_GET['user_id']);
$project_id = mysqli_real_escape_string($conn, $_GET['project_id']);

$web =  mysqli_query($conn, "SELECT * FROM web WHERE unique_id = '$project_id'");
$web1= mysqli_fetch_assoc($web);

$seo =  mysqli_query($conn, "SELECT * FROM seo WHERE unique_id = '$project_id'");
$seo1= mysqli_fetch_assoc($seo);

$ppc =  mysqli_query($conn, "SELECT * FROM ppc WHERE unique_id = '$project_id'");
$ppc1= mysqli_fetch_assoc($ppc);

$sm =  mysqli_query($conn, "SELECT * FROM s_marketing WHERE unique_id = '$project_id'");
$sm1= mysqli_fetch_assoc($sm);

$cm =  mysqli_query($conn, "SELECT * FROM c_marketing WHERE unique_id = '$project_id'");
$cm1= mysqli_fetch_assoc($cm);

$em =  mysqli_query($conn, "SELECT * FROM e_marketing WHERE unique_id = '$project_id'");
$em1= mysqli_fetch_assoc($em);





$query1 =  mysqli_query($conn, "SELECT * FROM crm_wallet WHERE unique_id = '$user_id'");
$row2= mysqli_fetch_assoc($query1);
$query =  mysqli_query($conn, "SELECT * FROM pay_info WHERE unique_id = '$user_id'");
$row = mysqli_fetch_assoc($query);

$query3 =  mysqli_query($conn, "SELECT * FROM project WHERE client_id = '$user_id'");
$row3 = mysqli_fetch_assoc($query3);

$query4 =  mysqli_query($conn, "SELECT * FROM details WHERE unique_id = '$user_id'");
$row4 = mysqli_fetch_assoc($query4);
$query9 =  mysqli_query($conn, "SELECT * FROM approval WHERE client_id = '$user_id'");
$row9 = mysqli_fetch_assoc($query9);





  

  


$addressAdded = !empty("SELECT * FROM pay_info WHERE unique_id = '$user_id'");


if (isset($_POST['add_submit'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $city = $_POST['city'];
    $postal = $_POST['postal'];
    $country = $_POST['country'];


    $name_pattern = "/[A-Za-z .]{3,25}/";
    $email_pattern = "/^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$/";
    $address_pattern = "/[A-Za-z .]{3,25}/";
    $city_pattern = "/[A-Za-z .]{3,20}/";
    $postal_pattern = "/[0-9 .]{3,20}/";
    $country_pattern = "/[A-Za-z .]{3,20}/";
   
   


    if(!preg_match($name_pattern,$name)){
        echo '<script>alert("Only Characters 3-25 latters")</script>';
    
     }
     else if(!preg_match($email_pattern,$email)){
        echo '<script>alert("Email format Wrong!")</script>';

     } 
      else if(!preg_match($address_pattern,$address)){
        echo '<script>alert("Address Pattern Wrong!")</script>';

     }
     else if(!preg_match($city_pattern,$city)){
        echo '<script>alert("City Pattern Wrong!")</script>';

     }
     else if(!preg_match($postal_pattern,$postal)){
        echo '<script>alert("Postal Code Pattern Wrong!")</script>';

     }
     else if(!preg_match($country_pattern,$country)){
        echo '<script>alert("Country Pattern Wrong!")</script>';

     }
    else {
        $sql2 = "INSERT INTO `pay_info` (unique_id, name, email, country, address, city, postal) 
         VALUES ('$user_id', '$name', '$email', '$country', '$address', '$city', '$postal')";
        $result2 = mysqli_query($conn, $sql2);


    if ($result2) {
        $project_id = mysqli_real_escape_string($conn, $_GET['project_id']);
        $project_id = trim($project_id);
        $project_id = str_replace(' ', '', $project_id);
        $encoded_project_id = urlencode($project_id);

        echo '<script>
            alert("Successfully Added");
            window.location.href = "payment.php?user_id=' . $user_id . '&project_id=' . $encoded_project_id . '";
        </script>';
    } else {
        // Handle error, if necessary
        echo '<script>alert("Error adding payment information: ' . mysqli_error($conn) . '")</script>';
    }
}


     $addressAdded = true;
   
}


if (isset($_POST['edit_submit'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $city = $_POST['city'];
    $postal = $_POST['postal'];
    $country = $_POST['country'];


    $name_pattern = "/[A-Za-z .]{3,25}/";
    $email_pattern = "/^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$/";
    $address_pattern = "/[A-Za-z0-9 .]{3,25}/";
    $city_pattern = "/[A-Za-z .]{3,20}/";
    $postal_pattern = "/[0-9 .]{3,20}/";
    $country_pattern = "/[A-Za-z .]{3,20}/";
   

    if(!preg_match($name_pattern,$name)){
        echo '<script>alert("Only Characters 3-25 latters")</script>';
    
     }
     else if(!preg_match($email_pattern,$email)){
        echo '<script>alert("Email format Wrong!")</script>';

     } 
      else if(!preg_match($address_pattern,$address)){
        echo '<script>alert("Address Pattern Wrong!")</script>';

     }
     else if(!preg_match($city_pattern,$city)){
        echo '<script>alert("City Pattern Wrong!")</script>';

     }
     else if(!preg_match($postal_pattern,$postal)){
        echo '<script>alert("Postal Code Pattern Wrong!")</script>';

     }
     else if(!preg_match($country_pattern,$country)){
        echo '<script>alert("Country Pattern Wrong!")</script>';

     }
     else{
        $sql2 ="UPDATE `pay_info` SET name = '$name' , email = '$email' , country= '$country' ,
         address = '$address', city= '$city', postal = '$postal' WHERE unique_id='$user_id'";
        $result2 = mysqli_query($conn, $sql2);

        $project_id = mysqli_real_escape_string($conn, $_GET['project_id']);
        $project_id = trim($project_id);
        $project_id = str_replace(' ', '', $project_id);
        $encoded_project_id = urlencode($project_id);
        
        echo '<script>alert("Succesfully Edited");
        window.location.href = "payment.php?user_id=' . $user_id . '&project_id=' . $encoded_project_id . '";
        </script>';
     }

     $addressAdded = true;
   
}


  if (isset($_POST['admin-pay'])) {
  
    
    $wallet = $_POST['wallet'];
    $security = $_POST['security'];
    $amo = explode('$',($_POST['money']));
    $amount = mysqli_real_escape_string($conn, trim($amo[1]));
      
    $code = "/[0-9]{4,10}/";


    $query_alr =  mysqli_query($conn, "SELECT * FROM pay_info WHERE unique_id = '$user_id'");
    $fetch_pay = mysqli_fetch_assoc($query_alr);

    $query5 =  mysqli_query($conn, "SELECT * FROM crm_wallet WHERE unique_id = '$user_id'");
    $row6= mysqli_fetch_assoc($query5);
    $query7 =  mysqli_query($conn, "SELECT * FROM crm_wallet WHERE unique_id = '$user_id'");
    $row7 = mysqli_fetch_assoc($query7);
    $query8 =  mysqli_query($conn, "SELECT * FROM pay_info WHERE unique_id = '$user_id'");
    $row8 = mysqli_fetch_assoc($query8);
    $email = '';

    if($row8){
    $email = $row8['email'];
    }
    
    $query80 =  mysqli_query($conn, "SELECT * FROM project WHERE client_id = '$user_id'");
    $des_fetch = mysqli_fetch_assoc($query80);
     
    if(empty($row8['country']) || empty($row8['address']) || empty($row8['postal']) || empty($row8['city']) || empty($row8['email'])) {
        echo "<script>alert('Enter Your Billing Information First');</script>";

    }elseif ($security == "") {
        echo "<script>alert('You have Forget To Enter Security Code.');</script>";
    }
    elseif($row6['password'] != $security){
        echo "<script>alert('Security Code Not Matching');</script>";

    }elseif($row6['amount'] < $amount){
        echo "<script>alert('You Dont Have Enough Money In Your Wallet');</script>";

    }elseif($row8['amount'] > 0){
         echo "<script>alert('You Already Paid For a Project. Wait Untill Complete The Previous One.');</script>";

    }else{
        $sql2 ="UPDATE `pay_info` SET wallet_number = '$wallet' , amount = '$amount', project_id = '$project_id' WHERE unique_id='$user_id'";
       $result2 = mysqli_query($conn, $sql2);

       $query7 =  mysqli_query($conn, "SELECT * FROM crm_wallet WHERE unique_id = '$user_id'");
       $row7 = mysqli_fetch_assoc($query7);

       $newAmount = $amount - $row7['amount']; // $row['amount'] is the current amount in the database

       $sql2 = "UPDATE `crm_wallet` SET amount = amount - $amount WHERE unique_id = '$user_id'";
       $result2 = mysqli_query($conn, $sql2);
       
       $query30 =  mysqli_query($conn, "SELECT * FROM project WHERE client_id = '$user_id'");
       $row30 = mysqli_fetch_assoc($query30);

       $project_name = "";
       $delivery_date = "";
       $wallet = "";
       $bill_amount = "";

       if($row30){
        $project_name = $row30['name'];
        $delivery_date = $row30['end'];
        $bill_amount = $row30['amount'];
       }
       if($row7){
        $wallet = $row7['number'];
       }

       $sql200 = "INSERT INTO `billing` (project_name, project_id, delivery_date, wallet, amount, client_id) 
         VALUES ('$project_name', '$project_id', '$delivery_date', '$wallet', '$bill_amount', '$user_id')";
        $result200 = mysqli_query($conn, $sql200);

       



       if ($result2) {
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

            //https://myaccount.google.com/apppasswords

            //Recipients
            $mail->setFrom('rontheboss00797@gmail.com');
            $mail->addAddress($email);

            //Content
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = 'DigitalSpark CRM';
            $mail->Body = 'We Have received your Payment From Wallet: ' . $wallet. '
            You Product Details
            Name: ' . $des_fetch['name'] . ', ID: ' . $des_fetch['unique_id'] . '
            Requirements:
            ' . $des_fetch['des_1'] . ',
            ' . $des_fetch['des_2'] . ',
            ' . $des_fetch['des_3'] . ',
            ' . $des_fetch['des_4'] . ',
            ' . $des_fetch['des_5'] . ',
            ' . $des_fetch['des_6'] . ',
            ' . $des_fetch['des_7'] . '.
        
            Delivery Date: ' . $des_fetch['end'] . '
            ';
        

            $mail->send();
            echo 'Message has been sent';
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
        
    }
    $project_id = mysqli_real_escape_string($conn, $_GET['project_id']);
    $project_id = trim($project_id);
    $project_id = str_replace(' ', '', $project_id);
    $encoded_project_id = urlencode($project_id);

    echo '<script>alert("Payment Sucessfull. Check Your mail box");
    window.location.href = "payment.php?user_id=' . $user_id . '&project_id=' . $encoded_project_id . '";
    </script>';
    
  }
 


}



        if (isset($_POST['app'])) {
            
            $project_id = mysqli_real_escape_string($conn, $_GET['project_id']);
            $project_id = trim($project_id);
            $project_id = str_replace(' ', '', $project_id);
            $encoded_project_id = urlencode($project_id);

            $query10 =  mysqli_query($conn, "SELECT * FROM approval WHERE project_id = '$encoded_project_id'");
           

            if (mysqli_num_rows($query10) > 0){
            echo "<script>alert('Be patience Wait For Confirmation');</script>";

           }else{
            $query100 =  mysqli_query($conn, "SELECT * FROM approval WHERE client_id = '$user_id'");
            $app_fetch = mysqli_fetch_assoc($query100);

            $web = mysqli_query($conn, "SELECT * FROM web WHERE unique_id = '$project_id'");
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

            $query8 =  mysqli_query($conn, "SELECT * FROM pay_info WHERE unique_id = '$user_id'");
            $row8 = mysqli_fetch_assoc($query8);

            $query30 =  mysqli_query($conn, "SELECT * FROM project WHERE client_id = '$user_id'");
            $row30 = mysqli_fetch_assoc($query30);

            if ($app_fetch){
                if($app_fetch['client_id'] == $user_id){
                    echo '<script>alert("Cannot send multiple approval request.You can send or pay one item at a time.");
                    window.location.href = "payment.php?user_id=' . $user_id . '&project_id=' . $encoded_project_id . '";
                    </script>';
                }
            }else{
                if($row8){
                  if($row8['amount'] > 0){
                echo '<script>alert("You already odered a project. Wait untill finish pervious one.");
                window.location.href = "payment.php?user_id=' . $user_id . '&project_id=' . $encoded_project_id . '";
                </script>';
             } 
            }elseif($row30){
                echo '<script>alert("One order pending. Wait untill finish pervious one.");
                window.location.href = "payment.php?user_id=' . $user_id . '&project_id=' . $encoded_project_id . '";
                </script>';
                
            }else{
                if (!empty($web1) && $web1['unique_id'] == $project_id) {
                $name = $web1['name'];
                $sql10 = "INSERT INTO approval (name, client_id, project_id)  VALUES ('{$name}', '{$user_id}', '{$project_id}')";
                $result10 = mysqli_query($conn, $sql10);

                echo '<script>alert("Approval Sent. Wait For Confirmation!");
                window.location.href = "web.php";
                </script>';
            } elseif (!empty($seo1) && $seo1['unique_id'] == $project_id) {
                $name = $seo1['name'];
                $sql10 = "INSERT INTO approval (name, client_id, project_id)  VALUES ('{$name}', '{$user_id}', '{$project_id}')";
                $result10 = mysqli_query($conn, $sql10);

                echo '<script>alert("Approval Sent. Wait For Confirmation!");
                window.location.href = "seo.php";
                </script>';
            } elseif (!empty($ppc1) && $ppc1['unique_id'] == $project_id) {
                $name = $ppc1['name'];
                $sql10 = "INSERT INTO approval (name, client_id, project_id)  VALUES ('{$name}', '{$user_id}', '{$project_id}')";
                $result10 = mysqli_query($conn, $sql10);

                echo '<script>alert("Approval Sent. Wait For Confirmation!");
                window.location.href = "ppc.php";
                </script>';
            } elseif (!empty($sm1) && $sm1['unique_id'] == $project_id) {
                $name = $sm1['name'];
                $sql10 = "INSERT INTO approval (name, client_id, project_id)  VALUES ('{$name}', '{$user_id}', '{$project_id}')";
                $result10 = mysqli_query($conn, $sql10);

                echo '<script>alert("Approval Sent. Wait For Confirmation!");
                window.location.href = "social-marketing.php";
                </script>';
            } elseif (!empty($cm1) && $cm1['unique_id'] == $project_id) {
                $name = $cm1['name'];
                $sql10 = "INSERT INTO approval (name, client_id, project_id)  VALUES ('{$name}', '{$user_id}', '{$project_id}')";
                $result10 = mysqli_query($conn, $sql10);

                echo '<script>alert("Approval Sent. Wait For Confirmation!");
                window.location.href = "content-marketing.php";
                </script>';

            } elseif (!empty($em1) && $em1['unique_id'] == $project_id) { 
                $name = $em1['name'];
                $sql10 = "INSERT INTO approval (name, client_id, project_id)  VALUES ('{$name}', '{$user_id}', '{$project_id}')";
                $result10 = mysqli_query($conn, $sql10);
           
            
            echo '<script>alert("Approval Sent. Wait For Confirmation!");
             window.location.href = "email-marketing.php";
             </script>';
            
        }
    }

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
    <title>Payment</title>

    <style>
        body{
            
            align-items: center;
            justify-content: center;
            background: url('img/crm-bg.jpg') no-repeat center center fixed;
            -webkit-background-size: cover;
            -moz-background-size: cover;
            -o-background-size: cover;
            background-size: cover; 
  
        }

        .navbar{
        background-color: rgb(0,0,0, 0.7); 
        }
        .active {
            color: rgb(254,190,16);
        }

         /* Edit conten */
         .hide-content {
            display: none;
        }

        .show-conten {
            display: inline-block;
        }
        
        /* Edit Button */
        .hide-button {
            display: none;
        }

        .show-button {
            display: inline-block;
        }

    </style>
</head>

<body>
    

    <div class="navbar navbar-expand-sm ">
        <div class="container-fluid">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link text-warning" style="font-family: Impact, Haettenschweiler, 'Arial Narrow Bold', sans-serif;" href="client-page.php">CRM</a>
                </li>
                <li class="nav-item" style="margin-left: 50px; margin-top: 5px;">
                    <i class="fa fa-share" style="font-size:15px" style="font-family: Georgia, 'Times New Roman', Times, serif;"> 
                     <?php
                       $project_id_check = mysqli_real_escape_string($conn, $project_id);
                      
                        if($row3 == $project_id_check){
                            $output1 .= '<a href="CRM.php?user_id='.$_SESSION['unique_id'].'&project_id='.$project_id.'" class="text-light" style="text-decoration: none;"><b>CRM Wallet</b></a>';

                        }else{
                     $output1 .= '<a href="CRM.php?user_id='.$_SESSION['unique_id'].'&project_id='.$project_id.'" class="text-light" style="text-decoration: none;"><b>CRM Wallet</b></a>';
                        }
                     echo $output1;
                     ?>
                   </i>
                </li>
                <li class="nav-item active" style="margin-left: 50px; margin-top: 5px;">
                    <i class="fa fa-share" style="font-size:15px" style="font-family: Georgia, 'Times New Roman', Times, serif;">
                    <?php
                  
                     $output2 .= '<a href="" class="text-light" style="text-decoration: none;"><b>Confirm & Pay</b></a>';
                     echo $output2;
                     ?>
                  </i>
                </li>
            </ul>
        </div>
    </div>

    <div class="container-fluid">
    <form method="post">
        <div class="row">
            <div class="col-md-6">
                <div class="container mt-4 ml-4" style="z-index: 1;">
                    <div class="card mx-4 text-light" style="width: 100%; background-color: rgb(0,0,0, 0.8); border-color: rgb(254,190,16)">
                        <header class="">
                            <h4 class="mx-2 my-2" style="font-family: Impact, Haettenschweiler, 'Arial Narrow Bold', sans-serif;">Billing Information</h4>
                        </header>
                        <div class="p-3 d-flex">

                        <?php
                            if (empty($row['address'])) {
                                echo '<p>Your invoice will be issued according to the details listed here.</p>';
                                echo '<button type="button" class="btn btn-outline-warning w-25 h-25 ml-3"data-bs-toggle="modal" data-bs-target="#add-address"> 
                                Add Address </button>';
                            } else {
                            echo '<p class="w-75">' . $row['address'] . $row['postal'] . $row['city'] . '</p>';
                            echo '<button type="button" class="btn btn-outline-warning w-25 h-25 ml-3"data-bs-toggle="modal" data-bs-target="#edit-address"
                            style="margin-right: 30px; "> Edit</button>';
                             }
                            ?>

                        </div>
                        
                        <div class="p-3">
                              <?php
                              if (empty($row['name'])) {
                               
                            } else {
                                echo '<h4 style="font-size: 20px;">'.$row['name'].'</h4>';
                                echo '<h4 style="font-size: 17px;">'.$row['country'].'</h4>';
                             }
                              
                              ?>
                        </div>
                    </div>
                </div>

                <div class="card mt-4 mx-5 text-light " style="width: 92.5%; background-color: rgb(0,0,0, 0.8); border-color: rgb(254,190,16)">
                    <header class="" style="">
                        <h4 class="mx-2 my-2" style="font-family: Impact, Haettenschweiler, 'Arial Narrow Bold', sans-serif;">Payment</h4>
                    </header>
                    <div class="p-3 ">
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" id="cardSwitch">
                            <label class="form-check-label" style="font-family: ‘Aclonica’; font-size: 18px;" for="cardSwitch">Cards</label>
                        </div>
                        
                        <div id="cardDetailsContainer" style="display: none;">
                        <div id="cardDetailsForm">
                            <div class="form-group mt-3 d-flex">
                                <label style="font-family: Impact, Haettenschweiler, 'Arial Narrow', sans-serif;"">Card / Account Number</label>
                                <label style="margin-left: 110px; font-family: Impact, Haettenschweiler, 'Arial Narrow', sans-serif;"">Amount</label>
                            </div>

                            <div class="form-group mt-3 d-flex">
                                <input type="text" class="form-control" style="width:45%">
                                <input type="text" class="form-control" style="margin-left: 40px; width: 45%;">
                            </div>

                            <div class="form-group mt-3 d-flex">
                                <label style="font-family: Impact, Haettenschweiler, 'Arial Narrow', sans-serif;"">First Name</label>
                                <label style="margin-left: 200px; font-family: Impact, Haettenschweiler, 'Arial Narrow', sans-serif;"">Last Name</label>
                            </div>

                            <div class="form-group mt-3 d-flex">
                                <input type="text" class="form-control" style="width:45%">
                                <input type="text" class="form-control" style="margin-left: 40px; width: 45%;">
                            </div>

                            <div class="form-group mt-3 d-flex">
                                <label style="font-family: Impact, Haettenschweiler, 'Arial Narrow', sans-serif;"">Service Fee</label>
                                <i class="fa fa-question-circle" style="font-size:15px; margin-left: 10px; margin-top: 4px;"
                                    data-bs-toggle="tooltip" data-bs-placement="top" title="It helps us to operate our platform and offer 24/7 customer support for your order"></i>
                                <label style="margin-left: 170px; font-family: Impact, Haettenschweiler, 'Arial Narrow', sans-serif;"">Security Code</label>
                                <i class="fa fa-question-circle" style="font-size:15px; margin-left: 10px; margin-top: 4px;"
                                    data-bs-toggle="tooltip" data-bs-placement="top" title="The Three to Five Digit of Code back or front on your card."></i>
                            </div>

                            <div class="form-group mt-3 d-flex">
                                <input type="text" placeholder="$4.00" class="form-control" style="width:45%" readonly>
                                <input type="text" class="form-control" style="margin-left: 40px; width: 45%;">
                            </div>

                            </div>
                    </div>
                    </div>

                    <div class="p-3 ">
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" id="crmSwitch" checked>
                            <label class="form-check-label" style="font-family: ‘Aclonica’; font-size: 18px;" for="crmSwitch">CRM Wallet</label>
                            <i class="fa fa-question-circle" style="font-size:15px; margin-left: 5px; margin-top: 4px;"
                            data-bs-toggle="tooltip" data-bs-placement="top" title="Easiest Way to Make payment.Go to navbar and check your CRM Wallet"></i>
                        </div>
                        
                        <div id="crmDetailsContainer">
                        <div id="crmDetailsForm">
                            <div class="form-group mt-3 d-flex">
                                <label style="font-family: Impact, Haettenschweiler, 'Arial Narrow', sans-serif;"">Wallet Number</label>
                                <label style="margin-left: 180px; font-family: Impact, Haettenschweiler, 'Arial Narrow', sans-serif;"">Amount</label>
                            </div>

                            <div class="form-group mt-3 d-flex">
                                <input type="text" class="form-control" name="wallet" style="width:45%" value="<?php echo $row2['number']?>" readonly>
                                <?php 
                               $unique_id_to_check = mysqli_real_escape_string($conn, $user_id);
                               $project_id_to_check = mysqli_real_escape_string($conn, $project_id);

                              
                               $query90 = mysqli_query($conn, "SELECT * FROM project WHERE client_id = '$unique_id_to_check'");

                               $query21 = mysqli_query($conn, "SELECT * FROM project WHERE client_id = '$unique_id_to_check' and name = 'Web Development'");
                               $pro_web = mysqli_fetch_assoc($query21);

                               $query22 = mysqli_query($conn, "SELECT * FROM project WHERE client_id = '$unique_id_to_check' and name = 'Search Engine Optimization'");
                               $pro_seo = mysqli_fetch_assoc($query22);

                               $query22 = mysqli_query($conn, "SELECT * FROM project WHERE client_id = '$unique_id_to_check' and name = 'Pay Per Click'");
                               $pro_ppc = mysqli_fetch_assoc($query22);

                               $query23 = mysqli_query($conn, "SELECT * FROM project WHERE client_id = '$unique_id_to_check' and name = 'Social Media Marketing'");
                               $pro_sm = mysqli_fetch_assoc($query23);

                               $query24 = mysqli_query($conn, "SELECT * FROM project WHERE client_id = '$unique_id_to_check' and name = 'Content Marketing'");
                               $pro_cm = mysqli_fetch_assoc($query24);

                               $query25 = mysqli_query($conn, "SELECT * FROM project WHERE client_id = '$unique_id_to_check' and name = 'Email Marketing'");
                               $pro_em = mysqli_fetch_assoc($query25);

                               $output8 = "";

                               
   
                               if (!empty($pro_web) && $pro_web['unique_id'] == $project_id && $pro_web['client_id'] == $unique_id_to_check && $pro_web['name'] == 'Web Development') {
                                $output8 .= ' <input type="text" class="form-control" style="margin-left: 40px; width: 45%;" value="'. $pro_web['amount'].'" readonly>';                              
                               }elseif (!empty($pro_seo) && $pro_seo['unique_id'] == $project_id && $pro_seo['client_id'] == $unique_id_to_check && $pro_seo['name'] == 'Search Engine Optimization') {
                                $output8 .= ' <input type="text" class="form-control" style="margin-left: 40px; width: 45%;" value="'.$pro_seo['amount'].'" readonly>';
                              }elseif (!empty($pro_ppc) && $pro_ppc['unique_id'] == $project_id && $pro_ppc['client_id'] == $unique_id_to_check && $pro_ppc['name'] == 'Pay Per Click') {
                                $output8 .= ' <input type="text" class="form-control" style="margin-left: 40px; width: 45%;" value="'.$pro_ppc['amount'].'" readonly>';
                              }elseif (!empty($pro_sm) && $pro_sm['unique_id'] == $project_id && $pro_sm['client_id'] == $unique_id_to_check && $pro_sm['name'] == 'Social Media Marketing') {
                                $output8 .= ' <input type="text" class="form-control" style="margin-left: 40px; width: 45%;" value="'.$pro_sm['amount'].'" readonly>';
                              }elseif (!empty($pro_cm) && $pro_cm['unique_id'] == $project_id && $pro_cm['client_id'] == $unique_id_to_check && $pro_cm['name'] == 'Content Marketing') {
                                $output8 .= ' <input type="text" class="form-control" style="margin-left: 40px; width: 45%;" value="'.$pro_cm['amount'].'" readonly>';
                              }elseif (!empty($pro_em) && $pro_em['unique_id'] == $project_id && $pro_em['client_id'] == $unique_id_to_check && $pro_em['name'] == 'Email Marketing') {
                                $output8 .= ' <input type="text" class="form-control" style="margin-left: 40px; width: 45%;" value="'.$pro_em['amount'].'" readonly>';
                               }
                               
                               
                               else {
                               $web = mysqli_query($conn, "SELECT * FROM web WHERE unique_id = '$project_id'");
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
                                    $output8 .= ' <input type="text" class="form-control" style="margin-left: 40px; width: 45%;" value="'. $web1['amount'].'" readonly>'; 
                                } elseif (!empty($seo1) && $seo1['unique_id'] == $project_id) {
                                    $output8 .= ' <input type="text" class="form-control" style="margin-left: 40px; width: 45%;" value="'. $seo1['amount'].'" readonly>';
                                } elseif (!empty($ppc1) && $ppc1['unique_id'] == $project_id) {
                                    $output8 .= ' <input type="text" class="form-control" style="margin-left: 40px; width: 45%;" value="'. $ppc1['amount'].'" readonly>';
                                } elseif (!empty($sm1) && $sm1['unique_id'] == $project_id) {
                                    $output8 .= ' <input type="text" class="form-control" style="margin-left: 40px; width: 45%;" value="'. $sm1['amount'].'" readonly>';
                                } elseif (!empty($cm1) && $cm1['unique_id'] == $project_id) {
                                    $output8 .= ' <input type="text" class="form-control" style="margin-left: 40px; width: 45%;" value="'. $cm1['amount'].'" readonly>';
                                } elseif (!empty($em1) && $em1['unique_id'] == $project_id) {
                                    $output8 .= ' <input type="text" class="form-control" style="margin-left: 40px; width: 45%;" value="'. $em1['amount'].'" readonly>';
                                }
                            
                               
                            
                            
                        }
                    
                            echo $output8;
                             
                             ?>
                                
                            </div>

                            <div class="form-group mt-3 d-flex">
                                <label style="font-family: Impact, Haettenschweiler, 'Arial Narrow', sans-serif;"">Service Fee</label>
                                <i class="fa fa-question-circle" style="font-size:15px; margin-left: 10px; margin-top: 4px;"
                                    data-bs-toggle="tooltip" data-bs-placement="top" title="It helps us to operate our platform and offer 24/7 customer support for your order"></i>
                                <label style="margin-left: 180px; font-family: Impact, Haettenschweiler, 'Arial Narrow', sans-serif;"">Security Code</label>
                                <i class="fa fa-question-circle" style="font-size:15px; margin-left: 10px; margin-top: 4px;"
                                    data-bs-toggle="tooltip" data-bs-placement="top" title="The Three to Five Digit of Code back or front on your card."></i>
                            </div>

                            <div class="form-group mt-3 d-flex">
                                <input type="text" placeholder="$4.00" class="form-control" style="width:45%" readonly>
                                <input type="text" class="form-control" name="security" style="margin-left: 40px; width: 45%;">
                            </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="container-fluid d-flex">
                    <div class="card text-light" style="width: 70%; margin-left: 50px; margin-top: 20px; background-color: rgb(0,0,0, 0.8); border-color: rgb(254,190,16)">
                        <header>
                            <div class="p-3 d-flex">
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
                                         $output120 .= '<img src="images/'.$web1['image'].'" class=" w-25 h-25">';
                                     } elseif (!empty($seo1) && $seo1['unique_id'] == $project_id) {
                                        $output120 .= '<img src="images/'.$seo1['image'].'" class=" w-25 h-25">';
                                     } elseif (!empty($ppc1) && $ppc1['unique_id'] == $project_id) {
                                        $output120 .= '<img src="images/'.$ppc1['image'].'" class=" w-25 h-25">';                             
                                     } elseif (!empty($sm1) && $sm1['unique_id'] == $project_id) {
                                        $output120 .= '<img src="images/'.$sm1['image'].'" class=" w-25 h-25">';
                                    } elseif (!empty($cm1) && $cm1['unique_id'] == $project_id) {
                                        $output120 .= '<img src="images/'.$cm1['image'].'" class=" w-25 h-25">';
                                     } elseif (!empty($em1) && $em1['unique_id'] == $project_id) {
                                        $output120 .= '<img src="images/'.$em1['image'].'" class=" w-25 h-25">';      
                                     }

                                     echo $output120;
                                   
                                    ?> 
                                
                                <p class="p-2" style="margin-top: -15px;">
                                    <?php
                                    $output12 = "";
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
                                         $output12 .= ''.$web1['bio'].'';
                                     } elseif (!empty($seo1) && $seo1['unique_id'] == $project_id) {
                                        $output12 .= ''.$seo1['bio'].'';
                                     } elseif (!empty($ppc1) && $ppc1['unique_id'] == $project_id) {
                                        $output12 .= ''.$ppc1['bio'].'';                                
                                     } elseif (!empty($sm1) && $sm1['unique_id'] == $project_id) {
                                        $output12 .= ''.$sm1['bio'].'';
                                    } elseif (!empty($cm1) && $cm1['unique_id'] == $project_id) {
                                        $output12 .= ''.$cm1['bio'].'';
                                     } elseif (!empty($em1) && $em1['unique_id'] == $project_id) {
                                        $output12 .= ''.$em1['bio'].'';        
                                     }

                                     echo $output12;
                                   
                                    ?> 
                                </p>
                            </div>
                        </header>

                        <?php
                         
                         
                          $output3 ="";

                          $unique_id_to_check = mysqli_real_escape_string($conn, $user_id);
                          $query11 = mysqli_query($conn, "SELECT * FROM project WHERE client_id = '$unique_id_to_check'");

                          $query21 = mysqli_query($conn, "SELECT * FROM project WHERE client_id = '$unique_id_to_check' and name = 'Web Development'");
                               $pro_web = mysqli_fetch_assoc($query21);

                               $query22 = mysqli_query($conn, "SELECT * FROM project WHERE client_id = '$unique_id_to_check' AND name = 'Search Engine Optimization'");
                               $pro_seo = mysqli_fetch_assoc($query22);

                               $query23 = mysqli_query($conn, "SELECT * FROM project WHERE client_id = '$unique_id_to_check' and name = 'Pay Per Click'");
                               $pro_ppc = mysqli_fetch_assoc($query23);

                               $query24 = mysqli_query($conn, "SELECT * FROM project WHERE client_id = '$unique_id_to_check' and name = 'Social Media Marketing'");
                               $pro_sm = mysqli_fetch_assoc($query24);

                               $query25 = mysqli_query($conn, "SELECT * FROM project WHERE client_id = '$unique_id_to_check' and name = 'Content Marketing'");
                               $pro_cm = mysqli_fetch_assoc($query25);

                               $query26 = mysqli_query($conn, "SELECT * FROM project WHERE client_id = '$unique_id_to_check' and name = 'Email Marketing'");
                               $pro_em = mysqli_fetch_assoc($query26);


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
                        
                            if (mysqli_num_rows($query21) > 0) {
                            if (!empty($pro_web) && $pro_web['unique_id'] == $project_id && $pro_web['client_id'] == $unique_id_to_check && $pro_web['name'] == 'Web Development') {
                                $tip = 4 + $pro_web['amount'];
                              $output3 .= ' <div class="p-3 ">
                              <p class="" style="font-size: 20px; font-family: \'Lucida Sans\', \'Lucida Sans Regular\', \'Lucida Grande\', \'Lucida Sans Unicode\', Geneva, Verdana, sans-serif;">
                                  Product Details
                              </p>
  
                              <ul style="list-style-type: none;">
                                  <li class="mt-3 d-flex">
                                      <i class="fa fa-check" style="font-size:20px"></i>
                                      <p class="px-3">'.$pro_web['des_1'].'</p>
                                  </li>
                                  <li class="d-flex">
                                      <i class="fa fa-check" style="font-size:20px"></i>
                                      <p class="px-3">'.$pro_web['des_2'].'</p>
                                  </li>
                                  <li class="d-flex">
                                      <i class="fa fa-check" style="font-size:20px"></i>
                                      <p class="px-3">'.$pro_web['des_3'].'</p>
                                  </li>
                                  <li class="d-flex">
                                      <i class="fa fa-check" style="font-size:20px"></i>
                                      <p class="px-3">'.$pro_web['des_4'].'</p>
                                  </li>
                                  <li class="d-flex">
                                      <i class="fa fa-check" style="font-size:20px"></i>
                                      <p class="px-3">'.$pro_web['des_5'].'</p>
                                  </li>
                                  <li class=" d-flex">
                                      <i class="fa fa-check" style="font-size:20px"></i>
                                      <p class="px-3">'.$pro_web['des_6'].'</p>
                                  </li>
                                  <li class=" d-flex">
                                      <i class="fa fa-check" style="font-size:20px"></i>
                                      <p class="px-3">'.$pro_web['des_7'].'</p>
                                  </li>
                              </ul>
                          </div>
                            
                          <div class="p- d-flex ">
                          <label class="mx-2" style="font-size: 20px; font-family: Impact, Haettenschweiler, \'Arial Narrow Bold\', sans-serif;">Total Amount</label>
                          <a>
                          <input name="money" style="margin-left: 170px; font-family: Verdana, Geneva, Tahoma, sans-serif; font-size: 19px; width: 80px; border:none;" value="$'.$tip.'" readonly>
                        </a>
                          </div>
  
                      <div class="p-3 d-flex">
                          <label class="" style="font-size: 15px; margin-left: -7px; font-family: Impact, Haettenschweiler, \'Arial Narrow\', sans-serif;">Delivery Date</label>
                          <span style="margin-left: 170px; font-family: Verdana, Geneva, Tahoma, sans-serif; font-size: 15px;"><b>'.$pro_web['end'].'</b></span>
                      </div>
                          
                          ';
                                            
                            }}else{
                                if (!empty($web1) && $web1['unique_id'] == $project_id) {
                                    $tip1 = 4 + $web1['amount']; 
        
                                    $output3 .= '<div class="p-3 ">
                                    <p class="d-flex" style="font-size: 20px; ">
                                        Product Details
                                        <input name="id" type="text" value="'.$project_id.'" style="width:50px; height: 20px; font-size: 15px; margin-left: 150px;">
                                    </p>
        
                                    <ul style="list-style-type: none;">
                                        <li class="mt-3 d-flex">
                                            <i class="fa fa-check" style="font-size:20px"></i>
                                            <p class="px-3">'.$web1['des_1'].'</p>
                                        </li>
                                        <li class="d-flex">
                                            <i class="fa fa-check" style="font-size:20px"></i>
                                            <p class="px-3">'.$web1['des_2'].'</p>
                                        </li>
                                        <li class="d-flex">
                                            <i class="fa fa-check" style="font-size:20px"></i>
                                            <p class="px-3">'.$web1['des_3'].'</p>
                                        </li>
                                        <li class="d-flex">
                                            <i class="fa fa-check" style="font-size:20px"></i>
                                            <p class="px-3">'.$web1['des_4'].'</p>
                                        </li>
                                        <li class="d-flex">
                                            <i class="fa fa-check" style="font-size:20px"></i>
                                            <p class="px-3">'.$web1['des_5'].'</p>
                                        </li>
                                        <li class=" d-flex">
                                            <i class="fa fa-check" style="font-size:20px"></i>
                                            <p class="px-3">'.$web1['des_6'].'</p>
                                        </li>
                                        <li class=" d-flex">
                                            <i class="fa fa-check" style="font-size:20px"></i>
                                            <p class="px-3">'.$web1['des_7'].'</p>
                                        </li>
                                    </ul>
                                </div>
        
                                <div class="p- d-flex ">
                                <label class="mx-2" style="font-size: 20px; font-family: Impact, Haettenschweiler, \'Arial Narrow Bold\', sans-serif;">Total Amount</label>
                                <input name="money" style="margin-left: 170px; font-family: Verdana, Geneva, Tahoma, sans-serif; font-size: 19px; width: 80px; border:none;" value="$'.$tip1.'" readonly>
                                </div>
        
                            <div class="p-3 d-flex">
                                <label class="" style="font-size: 15px; margin-left: -7px; font-family: Impact, Haettenschweiler, \'Arial Narrow\', sans-serif;">Delivery Time</label>
                                <span style="margin-left: 170px; font-family: Verdana, Geneva, Tahoma, sans-serif; font-size: 15px;"><b>Upto 1 Month</b></span>
                            </div>
                                    ';
        
                                    
                                }

                            }
                            if (mysqli_num_rows($query22) > 0){
                            if (!empty($pro_seo) && $pro_seo['unique_id'] == $project_id && $pro_seo['client_id'] == $unique_id_to_check && $pro_seo['name'] == 'Search Engine Optimization') {
                                $tip = 4 + $pro_seo['amount'];
                              $output3 .= ' <div class="p-3 ">
                              <p class="" style="font-size: 20px; font-family: \'Lucida Sans\', \'Lucida Sans Regular\', \'Lucida Grande\', \'Lucida Sans Unicode\', Geneva, Verdana, sans-serif;">
                                  Product Details
                              </p>
  
                              <ul style="list-style-type: none;">
                                  <li class="mt-3 d-flex">
                                      <i class="fa fa-check" style="font-size:20px"></i>
                                      <p class="px-3">'.$pro_seo['des_1'].'</p>
                                  </li>
                                  <li class="d-flex">
                                      <i class="fa fa-check" style="font-size:20px"></i>
                                      <p class="px-3">'.$pro_seo['des_2'].'</p>
                                  </li>
                                  <li class="d-flex">
                                      <i class="fa fa-check" style="font-size:20px"></i>
                                      <p class="px-3">'.$pro_seo['des_3'].'</p>
                                  </li>
                                  <li class="d-flex">
                                      <i class="fa fa-check" style="font-size:20px"></i>
                                      <p class="px-3">'.$pro_seo['des_4'].'</p>
                                  </li>
                                  <li class="d-flex">
                                      <i class="fa fa-check" style="font-size:20px"></i>
                                      <p class="px-3">'.$pro_seo['des_5'].'</p>
                                  </li>
                                  <li class=" d-flex">
                                      <i class="fa fa-check" style="font-size:20px"></i>
                                      <p class="px-3">'.$pro_seo['des_6'].'</p>
                                  </li>
                                  <li class=" d-flex">
                                      <i class="fa fa-check" style="font-size:20px"></i>
                                      <p class="px-3">'.$pro_seo['des_7'].'</p>
                                  </li>
                              </ul>
                          </div>
                            
                          <div class="p- d-flex ">
                          <label class="mx-2" style="font-size: 20px; font-family: Impact, Haettenschweiler, \'Arial Narrow Bold\', sans-serif;">Total Amount</label>
                          <a>
                          <input name="money" style="margin-left: 170px; font-family: Verdana, Geneva, Tahoma, sans-serif; font-size: 19px; width: 80px; border:none;" value="$'.$tip.'" readonly>
                        </a>
                          </div>
  
                      <div class="p-3 d-flex">
                          <label class="" style="font-size: 15px; margin-left: -7px; font-family: Impact, Haettenschweiler, \'Arial Narrow\', sans-serif;">Delivery Date</label>
                          <span style="margin-left: 170px; font-family: Verdana, Geneva, Tahoma, sans-serif; font-size: 15px;"><b>'.$pro_seo['end'].'</b></span>
                      </div>
                          
                          ';
                         
                            }}else{
                                if (!empty($seo1) && $seo1['unique_id'] == $project_id) {
                                    $tip1 = 4 + $seo1['amount']; 
        
                                    $output3 .= '<div class="p-3 ">
                                    <p class="d-flex" style="font-size: 20px; ">
                                        Product Details
                                        <input name="id" type="text" value="'.$project_id.'" style="width:50px; height: 20px; font-size: 15px; margin-left: 150px;">
                                    </p>
        
                                    <ul style="list-style-type: none;">
                                        <li class="mt-3 d-flex">
                                            <i class="fa fa-check" style="font-size:20px"></i>
                                            <p class="px-3">'.$seo1['des_1'].'</p>
                                        </li>
                                        <li class="d-flex">
                                            <i class="fa fa-check" style="font-size:20px"></i>
                                            <p class="px-3">'.$seo1['des_2'].'</p>
                                        </li>
                                        <li class="d-flex">
                                            <i class="fa fa-check" style="font-size:20px"></i>
                                            <p class="px-3">'.$seo1['des_3'].'</p>
                                        </li>
                                        <li class="d-flex">
                                            <i class="fa fa-check" style="font-size:20px"></i>
                                            <p class="px-3">'.$seo1['des_4'].'</p>
                                        </li>
                                        <li class="d-flex">
                                            <i class="fa fa-check" style="font-size:20px"></i>
                                            <p class="px-3">'.$seo1['des_5'].'</p>
                                        </li>
                                        <li class=" d-flex">
                                            <i class="fa fa-check" style="font-size:20px"></i>
                                            <p class="px-3">'.$seo1['des_6'].'</p>
                                        </li>
                                        <li class=" d-flex">
                                            <i class="fa fa-check" style="font-size:20px"></i>
                                            <p class="px-3">'.$seo1['des_7'].'</p>
                                        </li>
                                    </ul>
                                </div>
        
                                <div class="p- d-flex ">
                                <label class="mx-2" style="font-size: 20px; font-family: Impact, Haettenschweiler, \'Arial Narrow Bold\', sans-serif;">Total Amount</label>
                                <input name="money" style="margin-left: 170px; font-family: Verdana, Geneva, Tahoma, sans-serif; font-size: 19px; width: 80px; border:none;" value="$'.$tip1.'" readonly>
                                </div>
        
                            <div class="p-3 d-flex">
                                <label class="" style="font-size: 15px; margin-left: -7px; font-family: Impact, Haettenschweiler, \'Arial Narrow\', sans-serif;">Delivery Time</label>
                                <span style="margin-left: 170px; font-family: Verdana, Geneva, Tahoma, sans-serif; font-size: 15px;"><b>15-30 days+</b></span>
                            </div>
                                    ';
                    
                        }
                            }

                            if (mysqli_num_rows($query23) > 0){
                            if (!empty($pro_ppc) && $pro_ppc['unique_id'] == $project_id && $pro_ppc['client_id'] == $unique_id_to_check && $pro_ppc['name'] == 'Pay Per Click') {
                                $tip = 4 + $pro_ppc['amount'];
                              $output3 .= ' <div class="p-3 ">
                              <p class="" style="font-size: 20px; font-family: \'Lucida Sans\', \'Lucida Sans Regular\', \'Lucida Grande\', \'Lucida Sans Unicode\', Geneva, Verdana, sans-serif;">
                                  Product Details
                              </p>
  
                              <ul style="list-style-type: none;">
                                  <li class="mt-3 d-flex">
                                      <i class="fa fa-check" style="font-size:20px"></i>
                                      <p class="px-3">'.$pro_ppc['des_1'].'</p>
                                  </li>
                                  <li class="d-flex">
                                      <i class="fa fa-check" style="font-size:20px"></i>
                                      <p class="px-3">'.$pro_ppc['des_2'].'</p>
                                  </li>
                                  <li class="d-flex">
                                      <i class="fa fa-check" style="font-size:20px"></i>
                                      <p class="px-3">'.$pro_ppc['des_3'].'</p>
                                  </li>
                                  <li class="d-flex">
                                      <i class="fa fa-check" style="font-size:20px"></i>
                                      <p class="px-3">'.$pro_ppc['des_4'].'</p>
                                  </li>
                                  <li class="d-flex">
                                      <i class="fa fa-check" style="font-size:20px"></i>
                                      <p class="px-3">'.$pro_ppc['des_5'].'</p>
                                  </li>
                                  <li class=" d-flex">
                                      <i class="fa fa-check" style="font-size:20px"></i>
                                      <p class="px-3">'.$pro_ppc['des_6'].'</p>
                                  </li>
                                  <li class=" d-flex">
                                      <i class="fa fa-check" style="font-size:20px"></i>
                                      <p class="px-3">'.$pro_ppc['des_7'].'</p>
                                  </li>
                              </ul>
                          </div>
                            
                          <div class="p- d-flex ">
                          <label class="mx-2" style="font-size: 20px; font-family: Impact, Haettenschweiler, \'Arial Narrow Bold\', sans-serif;">Total Amount</label>
                          <a>
                          <input name="money" style="margin-left: 170px; font-family: Verdana, Geneva, Tahoma, sans-serif; font-size: 19px; width: 80px; border:none;" value="$'.$tip.'" readonly>
                        </a>
                          </div>
  
                      <div class="p-3 d-flex">
                          <label class="" style="font-size: 15px; margin-left: -7px; font-family: Impact, Haettenschweiler, \'Arial Narrow\', sans-serif;">Delivery Date</label>
                          <span style="margin-left: 170px; font-family: Verdana, Geneva, Tahoma, sans-serif; font-size: 15px;"><b>'.$pro_ppc['end'].'</b></span>
                      </div>
                          
                          ';
                         
                            }
                        }else{
                            if (!empty($ppc1) && $ppc1['unique_id'] == $project_id) {
                                $tip1 = 4 + $ppc1['amount']; 
            
                                $output3 .= '<div class="p-3 ">
                                <p class="d-flex" style="font-size: 20px; ">
                                    Product Details
                                    <input name="id" type="text" value="'.$project_id.'" style="width:50px; height: 20px; font-size: 15px; margin-left: 150px;">
                                </p>
            
                                <ul style="list-style-type: none;">
                                    <li class="mt-3 d-flex">
                                        <i class="fa fa-check" style="font-size:20px"></i>
                                        <p class="px-3">'.$ppc1['des_1'].'</p>
                                    </li>
                                    <li class="d-flex">
                                        <i class="fa fa-check" style="font-size:20px"></i>
                                        <p class="px-3">'.$ppc1['des_2'].'</p>
                                    </li>
                                    <li class="d-flex">
                                        <i class="fa fa-check" style="font-size:20px"></i>
                                        <p class="px-3">'.$ppc1['des_3'].'</p>
                                    </li>
                                    <li class="d-flex">
                                        <i class="fa fa-check" style="font-size:20px"></i>
                                        <p class="px-3">'.$ppc1['des_4'].'</p>
                                    </li>
                                    <li class="d-flex">
                                        <i class="fa fa-check" style="font-size:20px"></i>
                                        <p class="px-3">'.$ppc1['des_5'].'</p>
                                    </li>
                                    <li class=" d-flex">
                                        <i class="fa fa-check" style="font-size:20px"></i>
                                        <p class="px-3">'.$ppc1['des_6'].'</p>
                                    </li>
                                    <li class=" d-flex">
                                        <i class="fa fa-check" style="font-size:20px"></i>
                                        <p class="px-3">'.$ppc1['des_7'].'</p>
                                    </li>
                                </ul>
                            </div>
            
                            <div class="p- d-flex ">
                            <label class="mx-2" style="font-size: 20px; font-family: Impact, Haettenschweiler, \'Arial Narrow Bold\', sans-serif;">Total Amount</label>
                            <input name="money" style="margin-left: 170px; font-family: Verdana, Geneva, Tahoma, sans-serif; font-size: 19px; width: 80px; border:none;" value="$'.$tip1.'" readonly>
                            </div>
            
                        <div class="p-3 d-flex">
                            <label class="" style="font-size: 15px; margin-left: -7px; font-family: Impact, Haettenschweiler, \'Arial Narrow\', sans-serif;">Delivery Time</label>
                            <span style="margin-left: 170px; font-family: Verdana, Geneva, Tahoma, sans-serif; font-size: 15px;"><b>7-14 Days</b></span>
                        </div>
                                ';
            
                                }
                        }
                        if (mysqli_num_rows($query24) > 0){
                            if (!empty($pro_sm) && $pro_sm['unique_id'] == $project_id && $pro_sm['client_id'] == $unique_id_to_check && $pro_sm['name'] == 'Social Media Marketing') {
                                $tip = 4 + $pro_sm['amount'];
                              $output3 .= ' <div class="p-3 ">
                              <p class="" style="font-size: 20px; font-family: \'Lucida Sans\', \'Lucida Sans Regular\', \'Lucida Grande\', \'Lucida Sans Unicode\', Geneva, Verdana, sans-serif;">
                                  Product Details
                              </p>
  
                              <ul style="list-style-type: none;">
                                  <li class="mt-3 d-flex">
                                      <i class="fa fa-check" style="font-size:20px"></i>
                                      <p class="px-3">'.$pro_sm['des_1'].'</p>
                                  </li>
                                  <li class="d-flex">
                                      <i class="fa fa-check" style="font-size:20px"></i>
                                      <p class="px-3">'.$pro_sm['des_2'].'</p>
                                  </li>
                                  <li class="d-flex">
                                      <i class="fa fa-check" style="font-size:20px"></i>
                                      <p class="px-3">'.$pro_sm['des_3'].'</p>
                                  </li>
                                  <li class="d-flex">
                                      <i class="fa fa-check" style="font-size:20px"></i>
                                      <p class="px-3">'.$pro_sm['des_4'].'</p>
                                  </li>
                                  <li class="d-flex">
                                      <i class="fa fa-check" style="font-size:20px"></i>
                                      <p class="px-3">'.$pro_sm['des_5'].'</p>
                                  </li>
                                  <li class=" d-flex">
                                      <i class="fa fa-check" style="font-size:20px"></i>
                                      <p class="px-3">'.$pro_sm['des_6'].'</p>
                                  </li>
                                  <li class=" d-flex">
                                      <i class="fa fa-check" style="font-size:20px"></i>
                                      <p class="px-3">'.$pro_sm['des_7'].'</p>
                                  </li>
                              </ul>
                          </div>
                            
                          <div class="p- d-flex ">
                          <label class="mx-2" style="font-size: 20px; font-family: Impact, Haettenschweiler, \'Arial Narrow Bold\', sans-serif;">Total Amount</label>
                          <a>
                          <input name="money" style="margin-left: 170px; font-family: Verdana, Geneva, Tahoma, sans-serif; font-size: 19px; width: 80px; border:none;" value="$'.$tip.'" readonly>
                        </a>
                          </div>
  
                      <div class="p-3 d-flex">
                          <label class="" style="font-size: 15px; margin-left: -7px; font-family: Impact, Haettenschweiler, \'Arial Narrow\', sans-serif;">Delivery Date</label>
                          <span style="margin-left: 170px; font-family: Verdana, Geneva, Tahoma, sans-serif; font-size: 15px;"><b>'.$pro_sm['end'].'</b></span>
                      </div>
                          
                          ';
                         
                            }
                        }else{
                           if (!empty($sm1) && $sm1['unique_id'] == $project_id) {
                                $tip1 = 4 + $sm1['amount']; 
        
                                $output3 .= '<div class="p-3 ">
                                <p class="d-flex" style="font-size: 20px; ">
                                    Product Details
                                    <input name="id" type="text" value="'.$project_id.'" style="width:50px; height: 20px; font-size: 15px; margin-left: 150px;">
                                </p>
        
                                <ul style="list-style-type: none;">
                                    <li class="mt-3 d-flex">
                                        <i class="fa fa-check" style="font-size:20px"></i>
                                        <p class="px-3">'.$sm1['des_1'].'</p>
                                    </li>
                                    <li class="d-flex">
                                        <i class="fa fa-check" style="font-size:20px"></i>
                                        <p class="px-3">'.$sm1['des_2'].'</p>
                                    </li>
                                    <li class="d-flex">
                                        <i class="fa fa-check" style="font-size:20px"></i>
                                        <p class="px-3">'.$sm1['des_3'].'</p>
                                    </li>
                                    <li class="d-flex">
                                        <i class="fa fa-check" style="font-size:20px"></i>
                                        <p class="px-3">'.$sm1['des_4'].'</p>
                                    </li>
                                    <li class="d-flex">
                                        <i class="fa fa-check" style="font-size:20px"></i>
                                        <p class="px-3">'.$sm1['des_5'].'</p>
                                    </li>
                                    <li class=" d-flex">
                                        <i class="fa fa-check" style="font-size:20px"></i>
                                        <p class="px-3">'.$sm1['des_6'].'</p>
                                    </li>
                                    <li class=" d-flex">
                                        <i class="fa fa-check" style="font-size:20px"></i>
                                        <p class="px-3">'.$sm1['des_7'].'</p>
                            </li>
                        </ul>
                    </div>
        
                    <div class="p- d-flex ">
                    <label class="mx-2" style="font-size: 20px; font-family: Impact, Haettenschweiler, \'Arial Narrow Bold\', sans-serif;">Total Amount</label>
                    <input name="money" style="margin-left: 170px; font-family: Verdana, Geneva, Tahoma, sans-serif; font-size: 19px; width: 80px; border:none;" value="$'.$tip1.'" readonly>
                    </div>
        
                <div class="p-3 d-flex">
                    <label class="" style="font-size: 15px; margin-left: -7px; font-family: Impact, Haettenschweiler, \'Arial Narrow\', sans-serif;">Delivery Time</label>
                    <span style="margin-left: 170px; font-family: Verdana, Geneva, Tahoma, sans-serif; font-size: 15px;"><b>6-9 Days</b></span>
                </div>
                        ';
        
                    }
                        }
                        if (mysqli_num_rows($query25) > 0){
                            if (!empty($pro_cm) && $pro_cm['unique_id'] == $project_id && $pro_cm['client_id'] == $unique_id_to_check && $pro_cm['name'] == 'Content Marketing') {
                                $tip = 4 + $pro_cm['amount'];
                              $output3 .= ' <div class="p-3 ">
                              <p class="" style="font-size: 20px; font-family: \'Lucida Sans\', \'Lucida Sans Regular\', \'Lucida Grande\', \'Lucida Sans Unicode\', Geneva, Verdana, sans-serif;">
                                  Product Details
                              </p>
  
                              <ul style="list-style-type: none;">
                                  <li class="mt-3 d-flex">
                                      <i class="fa fa-check" style="font-size:20px"></i>
                                      <p class="px-3">'.$pro_cm['des_1'].'</p>
                                  </li>
                                  <li class="d-flex">
                                      <i class="fa fa-check" style="font-size:20px"></i>
                                      <p class="px-3">'.$pro_cm['des_2'].'</p>
                                  </li>
                                  <li class="d-flex">
                                      <i class="fa fa-check" style="font-size:20px"></i>
                                      <p class="px-3">'.$pro_cm['des_3'].'</p>
                                  </li>
                                  <li class="d-flex">
                                      <i class="fa fa-check" style="font-size:20px"></i>
                                      <p class="px-3">'.$pro_cm['des_4'].'</p>
                                  </li>
                                  <li class="d-flex">
                                      <i class="fa fa-check" style="font-size:20px"></i>
                                      <p class="px-3">'.$pro_cm['des_5'].'</p>
                                  </li>
                                  <li class=" d-flex">
                                      <i class="fa fa-check" style="font-size:20px"></i>
                                      <p class="px-3">'.$pro_cm['des_6'].'</p>
                                  </li>
                                  <li class=" d-flex">
                                      <i class="fa fa-check" style="font-size:20px"></i>
                                      <p class="px-3">'.$pro_cm['des_7'].'</p>
                                  </li>
                              </ul>
                          </div>
                            
                          <div class="p- d-flex ">
                          <label class="mx-2" style="font-size: 20px; font-family: Impact, Haettenschweiler, \'Arial Narrow Bold\', sans-serif;">Total Amount</label>
                          <a>
                          <input name="money" style="margin-left: 170px; font-family: Verdana, Geneva, Tahoma, sans-serif; font-size: 19px; width: 80px; border:none;" value="$'.$tip.'" readonly>
                        </a>
                          </div>
  
                      <div class="p-3 d-flex">
                          <label class="" style="font-size: 15px; margin-left: -7px; font-family: Impact, Haettenschweiler, \'Arial Narrow\', sans-serif;">Delivery Date</label>
                          <span style="margin-left: 170px; font-family: Verdana, Geneva, Tahoma, sans-serif; font-size: 15px;"><b>'.$pro_cm['end'].'</b></span>
                      </div>
                          
                          ';
                         
                            }
                        }else{
                            if (!empty($cm1) && $cm1['unique_id'] == $project_id) {
                                $tip1 = 4 + $cm1['amount']; 
                
                                $output3 .= '<div class="p-3 ">
                                <p class="d-flex" style="font-size: 20px; ">
                                    Product Details
                                    <input name="id" type="text" value="'.$project_id.'" style="width:50px; height: 20px; font-size: 15px; margin-left: 150px;">
                                </p>
                
                                <ul style="list-style-type: none;">
                                    <li class="mt-3 d-flex">
                                        <i class="fa fa-check" style="font-size:20px"></i>
                                        <p class="px-3">'.$cm1['des_1'].'</p>
                                    </li>
                                    <li class="d-flex">
                                        <i class="fa fa-check" style="font-size:20px"></i>
                                        <p class="px-3">'.$cm1['des_2'].'</p>
                                    </li>
                                    <li class="d-flex">
                                        <i class="fa fa-check" style="font-size:20px"></i>
                                        <p class="px-3">'.$cm1['des_3'].'</p>
                                    </li>
                                    <li class="d-flex">
                                        <i class="fa fa-check" style="font-size:20px"></i>
                                        <p class="px-3">'.$cm1['des_4'].'</p>
                                    </li>
                                    <li class="d-flex">
                                        <i class="fa fa-check" style="font-size:20px"></i>
                                        <p class="px-3">'.$cm1['des_5'].'</p>
                                    </li>
                                    <li class=" d-flex">
                                        <i class="fa fa-check" style="font-size:20px"></i>
                                        <p class="px-3">'.$cm1['des_6'].'</p>
                                    </li>
                                    <li class=" d-flex">
                                        <i class="fa fa-check" style="font-size:20px"></i>
                                        <p class="px-3">'.$cm1['des_7'].'</p>
                                    </li>
                                </ul>
                            </div>
                
                        <div class="p- d-flex ">
                        <label class="mx-2" style="font-size: 20px; font-family: Impact, Haettenschweiler, \'Arial Narrow Bold\', sans-serif;">Total Amount</label>
                        <input name="money" style="margin-left: 170px; font-family: Verdana, Geneva, Tahoma, sans-serif; font-size: 19px; width: 80px; border:none;" value="$'.$tip1.'" readonly>
                        </div>
                
                    <div class="p-3 d-flex">
                        <label class="" style="font-size: 15px; margin-left: -7px; font-family: Impact, Haettenschweiler, \'Arial Narrow\', sans-serif;">Delivery Time</label>
                        <span style="margin-left: 170px; font-family: Verdana, Geneva, Tahoma, sans-serif; font-size: 15px;"><b>2-10 Days</b></span>
                    </div>
                            ';
                    
                    } 
                        }
                        if (mysqli_num_rows($query26) > 0){
                            if (!empty($pro_em) && $pro_em['unique_id'] == $project_id && $pro_em['client_id'] == $unique_id_to_check && $pro_em['name'] == 'Email Marketing') {
                                $tip = 4 + $pro_em['amount'];
                              $output3 .= ' <div class="p-3 ">
                              <p class="" style="font-size: 20px; font-family: \'Lucida Sans\', \'Lucida Sans Regular\', \'Lucida Grande\', \'Lucida Sans Unicode\', Geneva, Verdana, sans-serif;">
                                  Product Details
                              </p>
  
                              <ul style="list-style-type: none;">
                                  <li class="mt-3 d-flex">
                                      <i class="fa fa-check" style="font-size:20px"></i>
                                      <p class="px-3">'.$pro_em['des_1'].'</p>
                                  </li>
                                  <li class="d-flex">
                                      <i class="fa fa-check" style="font-size:20px"></i>
                                      <p class="px-3">'.$pro_em['des_2'].'</p>
                                  </li>
                                  <li class="d-flex">
                                      <i class="fa fa-check" style="font-size:20px"></i>
                                      <p class="px-3">'.$pro_em['des_3'].'</p>
                                  </li>
                                  <li class="d-flex">
                                      <i class="fa fa-check" style="font-size:20px"></i>
                                      <p class="px-3">'.$pro_em['des_4'].'</p>
                                  </li>
                                  <li class="d-flex">
                                      <i class="fa fa-check" style="font-size:20px"></i>
                                      <p class="px-3">'.$pro_em['des_5'].'</p>
                                  </li>
                                  <li class=" d-flex">
                                      <i class="fa fa-check" style="font-size:20px"></i>
                                      <p class="px-3">'.$pro_em['des_6'].'</p>
                                  </li>
                                  <li class=" d-flex">
                                      <i class="fa fa-check" style="font-size:20px"></i>
                                      <p class="px-3">'.$pro_em['des_7'].'</p>
                                  </li>
                              </ul>
                          </div>
                            
                          <div class="p- d-flex ">
                          <label class="mx-2" style="font-size: 20px; font-family: Impact, Haettenschweiler, \'Arial Narrow Bold\', sans-serif;">Total Amount</label>
                          <a>
                          <input name="money" style="margin-left: 170px; font-family: Verdana, Geneva, Tahoma, sans-serif; font-size: 19px; width: 80px; border:none;" value="$'.$tip.'" readonly>
                        </a>
                          </div>
  
                      <div class="p-3 d-flex">
                          <label class="" style="font-size: 15px; margin-left: -7px; font-family: Impact, Haettenschweiler, \'Arial Narrow\', sans-serif;">Delivery Date</label>
                          <span style="margin-left: 170px; font-family: Verdana, Geneva, Tahoma, sans-serif; font-size: 15px;"><b>'.$pro_em['end'].'</b></span>
                      </div>
                          
                          ';
                         
                            }
                        }else{
                            if (!empty($em1) && $em1['unique_id'] == $project_id) {
                                $tip1 = 4 + $em1['amount']; 
            
                                $output3 .= '<div class="p-3 ">
                                <p class="d-flex" style="font-size: 20px; ">
                                    Product Details
                                    <input name="id" type="text" value="'.$project_id.'" style="width:50px; height: 20px; font-size: 15px; margin-left: 150px;">
                                </p>
            
                                <ul style="list-style-type: none;">
                                    <li class="mt-3 d-flex">
                                        <i class="fa fa-check" style="font-size:20px"></i>
                                        <p class="px-3">'.$em1['des_1'].'</p>
                                    </li>
                                    <li class="d-flex">
                                        <i class="fa fa-check" style="font-size:20px"></i>
                                        <p class="px-3">'.$em1['des_2'].'</p>
                                    </li>
                                    <li class="d-flex">
                                        <i class="fa fa-check" style="font-size:20px"></i>
                                        <p class="px-3">'.$em1['des_3'].'</p>
                                    </li>
                                    <li class="d-flex">
                                        <i class="fa fa-check" style="font-size:20px"></i>
                                        <p class="px-3">'.$em1['des_4'].'</p>
                                    </li>
                                    <li class="d-flex">
                                        <i class="fa fa-check" style="font-size:20px"></i>
                                        <p class="px-3">'.$em1['des_5'].'</p>
                                    </li>
                                    <li class=" d-flex">
                                        <i class="fa fa-check" style="font-size:20px"></i>
                                        <p class="px-3">'.$em1['des_6'].'</p>
                                    </li>
                                    <li class=" d-flex">
                                        <i class="fa fa-check" style="font-size:20px"></i>
                                        <p class="px-3">'.$em1['des_7'].'</p>
                                    </li>
                                </ul>
                            </div>
            
                            <div class="p- d-flex ">
                            <label class="mx-2" style="font-size: 20px; font-family: Impact, Haettenschweiler, \'Arial Narrow Bold\', sans-serif;">Total Amount</label>
                            <input name="money" style="margin-left: 170px; font-family: Verdana, Geneva, Tahoma, sans-serif; font-size: 19px; width: 80px; border:none;" value="$'.$tip1.'" readonly>
                            </div>
            
                        <div class="p-3 d-flex">
                            <label class="" style="font-size: 15px; margin-left: -7px; font-family: Impact, Haettenschweiler, \'Arial Narrow\', sans-serif;">Delivery Time</label>
                            <span style="margin-left: 170px; font-family: Verdana, Geneva, Tahoma, sans-serif; font-size: 15px;"><b>5-12 Days</b></span>
                        </div>
                                ';
            
                        }
                        }
                          
        

        
                echo $output3;
            ?>

            <div class="p-3">
            <?php
                    $unique_id_to_check = mysqli_real_escape_string($conn, $user_id);
                    $project_id_to_check = mysqli_real_escape_string($conn, $project_id);

                    $query95 = mysqli_query($conn, "SELECT * FROM project WHERE client_id = '$unique_id_to_check'");

                    $query31 = mysqli_query($conn, "SELECT * FROM project WHERE client_id = '$unique_id_to_check' and name = 'Web Development'");
                    $pro_web1 = mysqli_fetch_assoc($query31);

                    $query32 = mysqli_query($conn, "SELECT * FROM project WHERE client_id = '$unique_id_to_check' and name = 'Search Engine Optimization'");
                    $pro_seo1 = mysqli_fetch_assoc($query32);

                    $query33 = mysqli_query($conn, "SELECT * FROM project WHERE client_id = '$unique_id_to_check' and name = 'Pay Per Click'");
                    $pro_ppc1 = mysqli_fetch_assoc($query33);

                    $query34 = mysqli_query($conn, "SELECT * FROM project WHERE client_id = '$unique_id_to_check' and name = 'Social Media Marketing'");
                    $pro_sm1 = mysqli_fetch_assoc($query34);

                    $query35 = mysqli_query($conn, "SELECT * FROM project WHERE client_id = '$unique_id_to_check' and name = 'Content Marketing'");
                    $pro_cm1 = mysqli_fetch_assoc($query35);

                    $query36 = mysqli_query($conn, "SELECT * FROM project WHERE client_id = '$unique_id_to_check' and unique_id = 'Email Marketing'");
                    $pro_em1 = mysqli_fetch_assoc($query36);

                    $output11 = "";

                    if(mysqli_num_rows($query95) > 0) {

                    }if (!empty($pro_web1) && $pro_web1['unique_id'] == $project_id_to_check && $pro_web1['client_id'] == $unique_id_to_check && $pro_web1['name'] == 'Web Development') {
                        $output11 .= '<input type="submit" name="admin-pay" class="btn-lg btn btn-outline-warning w-100" value="Confirm & Pay">';                              
                    }elseif (!empty($pro_seo1) && $pro_seo1['unique_id'] == $project_id_to_check && $pro_seo1['client_id'] == $unique_id_to_check && $pro_seo1['name'] == 'Search Engine Optimization') {
                    $output11 .= '<input type="submit" name="admin-pay" class="btn-lg btn btn-outline-warning w-100" value="Confirm & Pay">';
                }elseif (!empty($pro_ppc1) && $pro_ppc1['unique_id'] == $project_id_to_check && $pro_ppc1['client_id'] == $unique_id_to_check && $pro_ppc1['name'] == 'Pay Per Click') {
                    $output11 .= '<input type="submit" name="admin-pay" class="btn-lg btn btn-outline-warning w-100" value="Confirm & Pay">';
                }elseif (!empty($pro_sm1) && $pro_sm1['unique_id'] == $project_id_to_check && $pro_sm1['client_id'] == $unique_id_to_check && $pro_sm1['name'] == 'Social Media Marketing') {
                    $output11 .= '<input type="submit" name="admin-pay" class="btn-lg btn btn-outline-warning w-100" value="Confirm & Pay">';
                }elseif (!empty($pro_cm1) && $pro_cm1['unique_id'] == $project_id_to_check && $pro_cm1['client_id'] == $unique_id_to_check && $pro_cm1['name'] == 'Content Marketing') {
                    $output11 .= '<input type="submit" name="admin-pay" class="btn-lg btn btn-outline-warning w-100" value="Confirm & Pay">';;
                    }elseif (!empty($pro_em1) && $pro_em1['unique_id'] == $project_id_to_check && $pro_em1['client_id'] == $unique_id_to_check && $pro_em1['name'] == 'Search Engine Optimization') {

                    $output11 .= '<input type="submit" name="admin-pay" class="btn-lg btn btn-outline-warning w-100" value="Confirm & Pay">';
                    }else {
                    
                    $output11 .= '<input type="submit" name="app" class="btn-lg btn bg-warning text-dark w-100" value="Approval">';
                    
                }
            
                echo $output11;

                
                ?>

                
            </div>
            </form>
        </div>
    </div>
</div>
</div>
       
    </div>

    <!-- add-address Modal -->
    <div class="modal" id="add-address">
        <div class="modal-dialog">
            <div class="modal-content" style="margin-top: 50px;">
                <div class="modal-header">
                    <h4 class="modal-title">Billing Information</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form method="post">
                        <div class="form-group">
                            <label>Full Name</label>
                            <input type="text" name="name" class="form-control"
                            pattern="[A-Za-z ]{3,25}" placeholder="Enter Your Name"
                          title="Contain of lowercase or Uppercase minimum 3 characters" required>
                        </div>
                        <div class="form-group">
                            <label>Country</label>
                            <input type="text" name="country" class="form-control" 
                            pattern="[A-Za-z]{3,15}" placeholder="Enter Your Name"
                          title="Contain of lowercase and Uppercase minimum 3 characters" required>
                        </div>
                        <div class="form-group">
                            <label>Address</label>
                            <input type="text" name="address" class="form-control"
                             pattern="[A-Za-z0-9. = / >]{3,25}" placeholder="Enter Your Name"
                            title="Contain of lowercase and number minimum 5 characters" required>
                        </div>
                        <div class="form-group">
                            <label>City</label>
                            <input type="text" name="city" class="form-control"
                            pattern="[A-Za-z ]{3,15}" placeholder="Enter Your Name"
                            title="Contain of lowercase and Uppercase minimum 3 characters" required>
                        </div>
                        <div class="form-group">
                            <label>Postal Code</label>
                            <input type="text" name="postal" class="form-control"
                            pattern="[0-9 ]{3,15}" placeholder="Enter Your Name"
                          title="Contain only number minimum 3 characters" required>
                        </div>
                        <div class="form-group">
                           
                            <div class="form-group " >
                            <div class="form-group mt-2">
                                <label>Enter Your Email</label>
                                <input type="email" name="email" class="form-control"
                                pattern="^[a-z0-9]+@[a-z]+.[a-z]+$" placeholder="Enter Your Name"
                                title="name01@gmail.com">
                            </div>
                          </div>
                        </div>
                        <input class="btn btn-outline-primary btn-lg float-right mt-2" value="submit"  name="add_submit" type="submit">
                    </form>
                </div>
                
                <!-- data-bs-dismiss="modal" -->
            </div>
        </div>
    </div>


    <!-- edit-address Modal -->
    <div class="modal" id="edit-address">
        <div class="modal-dialog">
            <div class="modal-content" style="margin-top: 50px;">
                <div class="modal-header">
                    <h4 class="modal-title">Billing Information</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form method="post">
                        <div class="form-group">
                            <label>Full Name</label>
                            <input type="text" name="name" class="form-control"
                            pattern="[A-Za-z ]{3,25}" placeholder="Enter Your Name"
                          title="Contain of lowercase or Uppercase minimum 3 characters"
                          value="<?php echo $row['name']?>" required>
                        </div>
                        <div class="form-group">
                            <label>Country</label>
                            <input type="text" name="country" class="form-control" 
                            pattern="[A-Za-z]{3,15}" placeholder="Enter Your Name"
                          title="Contain of lowercase and Uppercase minimum 3 characters"
                          value="<?php echo $row['country']?>" required>
                        </div>
                        <div class="form-group">
                            <label>Address</label>
                            <input type="text" name="address" class="form-control"
                             pattern="[A-Za-z0-9. = / >]{3,25}" placeholder="Enter Your Name"
                            title="Contain of lowercase and number minimum 5 characters"
                            value="<?php echo $row['address']?>" required>
                        </div>
                        <div class="form-group">
                            <label>City</label>
                            <input type="text" name="city" class="form-control"
                            pattern="[A-Za-z ]{3,15}" placeholder="Enter Your Name"
                            title="Contain of lowercase and Uppercase minimum 3 characters"
                            value="<?php echo $row['city']?>" required>
                        </div>
                        <div class="form-group">
                            <label>Postal Code</label>
                            <input type="text" name="postal" class="form-control"
                            pattern="[0-9 ]{3,15}" placeholder="Enter Your Name"
                          title="Contain of lowercase and Uppercase minimum 3 characters"
                          value="<?php echo $row['postal']?>" required>
                        </div>
                        <div class="form-group ">
                            <div class="form-group ">
                            <div class="form-group ">
                                <label>Enter Your Email</label>
                                <input type="email" name="email" class="form-control"
                                pattern="^[a-z0-9]+@[a-z]+.[a-z]+$" placeholder="Enter Your Name"
                                title="name01@gmail.com"  value="<?php echo $row['email']?>">
                            </div>
                          </div>
                        </div>
                        <input class="btn btn-outline-primary btn-lg float-right mt-3" value="Update"  name="edit_submit" type="submit">
                    </form>
                </div>
                
                <!-- data-bs-dismiss="modal" -->
            </div>
        </div>
    </div>

    <script>

function validateSecurityCode() {
        var securityCode = document.getElementById('security-code').value;
        
        // Check if the security code is not empty
        if (securityCode.trim() !== "") {
            // Enable the "Confirm & Pay" button
            document.getElementById('confirm-pay-btn').disabled = false;
        } else {
            // Disable the "Confirm & Pay" button
            document.getElementById('confirm-pay-btn').disabled = true;
        }
    }

        //add-address Check box section
        function toggleEmailInput() {
      var emailInputSection = document.getElementById("emailInputSection");
      var checkbox = document.getElementById("flexCheckChecked");

      if (checkbox.checked) {
        emailInputSection.style.display = "block";
      } else {
        emailInputSection.style.display = "none";
      }
    }


      //edit-address Check box section
      function toggleEditEmailInput() {
      var EditemailInputSection = document.getElementById("EditemailInputSection");
      var Editcheckbox = document.getElementById("EditflexCheckChecked");

      if (Editcheckbox.checked) {
        EditemailInputSection.style.display = "block";
      } else {
        EditemailInputSection.style.display = "none";
      }
    }

        //checkbox Section


    document.getElementById('cardSwitch').addEventListener('change', function () {
    toggleVisibility(this, 'cardDetailsContainer', 'crmSwitch', 'crmDetailsContainer');
    });

     document.getElementById('crmSwitch').addEventListener('change', function () {
    toggleVisibility(this, 'crmDetailsContainer', 'cardSwitch', 'cardDetailsContainer');
    });

        // Tooltip Section
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        })
    </script>

</body>

</html>