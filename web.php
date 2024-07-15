<?php 
include "config.php";
session_start();
if (!isset($_SESSION['unique_id'])) {
  header("Location: index.php");
  die();
}
$output ="";
$unique_id = $_SESSION['unique_id'];



$web =  mysqli_query($conn, "SELECT * FROM web WHERE 1");
$web1 = mysqli_fetch_assoc($web);

$admin =  mysqli_query($conn, "SELECT * FROM admin WHERE 1");
$admindata = mysqli_fetch_assoc($admin);

// if (isset($_POST['submit'])) {
//     $result= mysqli_query($conn,"SELECT * FROM `admin`");
//     $data = mysqli_fetch_assoc($result);
//     $outgoing_id = $data['unique_id'];
//     $text = mysqli_real_escape_string($conn, ($_POST['req']));
//     $price =mysqli_real_escape_string($conn,$_POST['price']);
//     $incoming_id = mysqli_real_escape_string($conn, $_POST['incoming_id']);

//     $message = mysqli_real_escape_string($conn, $text) .  '<br>Price: $' . mysqli_real_escape_string($conn, $price);

//     $sql =  mysqli_query($conn, "INSERT INTO messages (incoming_msg_id, outgoing_msg_id, msg)
//     VALUES ('{$incoming_id}', '{$outgoing_id}', '{$message}')") or die(mysqli_error($conn));

//     header("Location: client-admin-chat.php?user_id=$unique_id");

// }



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
        body{
            
            align-items: center;
            justify-content: center;
            background: url('img/crm-bg.jpg') no-repeat center center fixed;
            -webkit-background-size: cover;
            -moz-background-size: cover;
            -o-background-size: cover;
            background-size: cover; 
  
        }
        body::-webkit-scrollbar { 
        display: none; 
        }

        @keyframes flowWave {
            0% {
                transform: translateX(0);
            }

            100% {
                transform: translateX(-100%);
            }
        }
        .scrollable-content {
            overflow-y: auto;
            max-height: calc(100% - 40px); /* Adjust as needed */
        }
        .scrollable-content::-webkit-scrollbar {
            width: 6px; /* Adjust as needed */
        }

        .scrollable-content::-webkit-scrollbar-thumb {
            background-color: transparent; /* Adjust as needed */
        }

    
    </style>

</head>

<body>
    <div class="container-fluid d-flex" style="position: relative;">
        <div class="container">
            <div class="card mt-2 text-light" style="height: 630px; background-color: rgb(0,0,0, 0.7); border-color: rgb(254,190,16)">
                <!-- <div class="wave-layer"></div> -->
                <div class="row">
                    <div class="col-md-6 p-3">
                        <h3 class="mt-3 mx-2 w-100 text-warning">Website Development</h3>
                        <p class="mt-3 mx-2 w-100" style="font-size: 12px;">Website development is the process of creating and building a website for your business or personal use.
                         It involves a combination of design, coding, and content creation to produce a fully functional and visually appealing online presence
                        </p>
                    </div>
                    <div class="col-md-6 p-3 ">
                        <img src="images/Web_img1.png" class="" style="width: 90%; height: auto;">
                    </div>
                    <div class="col-md-6 p-3" style="margin-top: -30px;">
                        <img src="images/Web_img2.png" class="mx-1" style="width: 180px; height: 170px;">
                    </div>
                    <div class="col-md-6 p-3" style="margin-top: -110px;">
                        <h6 class="text-warning" style="margin-left: -20px;">Site Stucture Planing</h6>
                        <p class=" w-100" style="font-size: 13px; margin-left: -20px;">Establish a clear hierarchy for your content. Identify main categories or topics and subcategories that logically fall under them.
                        <h6 class="text-warning" style="margin-left: -20px;">Design Development</h6>
                        <p class=" w-100" style="font-size: 13px; margin-left: -20px;">Design development involves refining the visual elements based on the chosen concept. This includes selecting specific color schemes, typography, and layout details.
                    </div>
                    <div class="col-md-6 p-3">
                        <h6 class="text-warning mx-2 w-100" style="margin-top: -60px">Site Testing</h6>
                        <p class="mx-2 w-100" style="font-size: 13px;">Ensuring that all features and functionalities of the website work as expected. This includes testing forms, navigation, links, buttons, and interactive elements.
                        </p>
                    </div>
                    <div class="col-md-6 p-3">
                        <img src="images/Web_img3.png" class="" style="width: 90%; height: auto; margin-left: 5px; margin-top: -50px;">
                    </div>
                </div>
            </div>
        </div>
        
        <div class="container">
            <div class="card mt-2 text-light" style="height: 630px; background-color: rgb(0,0,0, 0.7); border-color: rgb(254,190,16)">
                <div class="row scrollable-content">
                <div class="row">
                    <div class="col-md-6">
                        <h3 class="mt-4 mx-2 w-100 text-warning">Site Details</h3>
                        <p class="mt-3 mx-2 w-100" style="font-size: 12px;">These details can vary based on the context and the purpose of the discussion.
                         Here are some common aspects that might be considered as "site details" in the context of web development, management, or analysis
                        </p>
                    </div>
                    <div class="col-md-6"> 
                        <img src="images/Web_img4.png" class="mt-5" style="width: 100%; height: auto;">
                    </div>
                    <div class="col-md-12"> 
                        <ul style="list-style-type: none; padding: 0;">
                            <li class="w-100" style="margin-left: 10px; border-bottom: 2px solid rgb(254,190,16); padding: 10px 0;">
                                <h4 class="text-warning" style="font-size: 13px;">Custom Web Development:</h4>
                                <ul style="list-style-type: none; padding-left: 20px;">
                                    <li style="font-size: 12px;">- Tailored solutions to meet specific business needs.</li>
                                    <li style="font-size: 12px;">- Responsive web design for optimal user experience across devices.</li>
                                </ul>
                            </li>
                        
                            <li class="w-100" style="margin-left: 10px; border-bottom: 2px solid rgb(254,190,16); padding: 10px 0;">
                                <h4 class="text-warning" style="font-size: 13px;">E-commerce Solutions:</h4>
                                <ul style="list-style-type: none; padding-left: 20px;">
                                    <li style="font-size: 12px;">- Building secure and scalable online stores.</li>
                                    <li style="font-size: 12px;">- Payment gateway integration for seamless transactions.</li>
                                </ul>
                            </li>
                        
                            <li class="w-100" style="margin-left: 10px; border-bottom: 2px solid rgb(254,190,16); padding: 10px 0;">
                                <h4 class="text-warning" style="font-size: 13px;">Content Management Systems (CMS):</h4>
                                <ul style="list-style-type: none; padding-left: 20px;">
                                    <li style="font-size: 12px;">- Developing websites on popular CMS platforms like WordPress, Joomla, or Drupal.</li>
                                    <li style="font-size: 12px;">- Customizing and extending CMS functionality.</li>
                                </ul>
                            </li>
                        
                            <li class="w-100" style="margin-left: 10px; border-bottom: 2px solid rgb(254,190,16); padding: 10px 0;">
                                <h4 class="text-warning" style="font-size: 13px;">Web Security:</h4>
                                <ul style="list-style-type: none; padding-left: 20px;">
                                    <li style="font-size: 12px;">- Implementing security best practices to protect against common threats.</li>
                                    <li style="font-size: 12px;">- SSL implementation for secure data transmission.</li>
                                </ul>
                            </li>
                        
                            <li class="w-100" style="margin-left: 10px; border-bottom: 2px solid rgb(254,190,16); padding: 10px 0;">
                                <h4 class="text-warning" style="font-size: 13px;">UI/UX Design:</h4>
                                <ul style="list-style-type: none; padding-left: 20px;">
                                    <li style="font-size: 12px;">- Designing user-friendly interfaces for a positive user experience.</li>
                                    <li style="font-size: 12px;">- Incorporating modern design trends and best practices.</li>
                                </ul>
                            </li>
                        
                            <li class="w-100" style="margin-left: 10px; border-bottom: 2px solid rgb(254,190,16); padding: 10px 0;">
                                <h4 class="text-warning" style="font-size: 13px;">Web Analytics:</h4>
                                <ul style="list-style-type: none; padding-left: 20px;">
                                    <li style="font-size: 12px;">- Implementing analytics tools to track and analyze website performance.</li>
                                    <li style="font-size: 12px;">- Providing insights to improve user engagement and conversions.</li>
                                </ul>
                            </li>
                        
                            <li class="w-100" style="margin-left: 10px; border-bottom: 2px solid rgb(254,190,16); padding: 10px 0;">
                                <h4 class="text-warning" style="font-size: 13px;">Social Media Integration:</h4>
                                <ul style="list-style-type: none; padding-left: 20px;">
                                    <li style="font-size: 12px;">- Integrating social media features for increased online presence.</li>
                                    <li style="font-size: 12px;">- Implementing social sharing and login functionality.</li>
                                </ul>
                            </li>
                        </ul>
                        
                    </div>
                </div>
            </div>
        </div>
      </div>

        <div class="container">
            <div class="card mt-2 text-light" style="height: 630px; background-color: rgb(0,0,0, 0.7); border-color: rgb(254,190,16)">
                <div class="row">
                    <div class="col-md-6">
                        <h3 class="mt-4 mx-2 w-100 text-warning">Price Details</h3>
                        <p class="mt-3 mx-2 w-100" style="font-size: 12px;">The cost or pricing structure associated with a product, service, or transaction. The details may vary depending on what is being discussed.
                        </p>
                    </div>
                    <div class="col-md-6">
                        <img src="images/Web_img5.svg" class="mt-2" style="width: 100%; height: auto; margin-left:-10px">
                    </div>
                    <div class="col-md-12">
                        <ul style="list-style-type: none; padding: 0;">
                            <li class="w-100" style="margin-left: 10px; padding: 10px 0;">
                                <h4 class="text-warning" style="font-size: 13px;">Custom Web Development:</h4>
                                <ul style="list-style-type: none; padding-left: 20px;">
                                    <li style="font-size: 12px;">- Tailored solutions to meet specific business needs.</li>
                                    <li style="font-size: 12px;">- Responsive web design for optimal user experience across devices.</li>
                                </ul>
                            </li>
                        
                            <li class="w-100" style="margin-left: 10px;padding: 10px 0;">
                                <h4 class="text-warning" style="font-size: 13px;">E-commerce Solutions:</h4>
                                <ul style="list-style-type: none; padding-left: 20px;">
                                    <li style="font-size: 12px;">- Building secure and scalable online stores.</li>
                                    <li style="font-size: 12px;">- Payment gateway integration for seamless transactions.</li>
                                </ul>
                            </li>
                        
                            <li class="w-100" style="margin-left: 10px;padding: 10px 0;">
                                <h4 class="text-warning" style="font-size: 13px;">Content Management Systems (CMS):</h4>
                                <ul style="list-style-type: none; padding-left: 20px;">
                                    <li style="font-size: 12px;">- Developing websites on popular CMS platforms like WordPress, Joomla, or Drupal.</li>
                                    <li style="font-size: 12px;">- Customizing and extending CMS functionality.</li>
                                </ul>
                            </li>
                            <li class="w-100" style="margin-left: 10px;padding: 10px 0;">
                                <h4 class="text-warning" style="font-size: 13px;">Content Management Systems (CMS):</h4>
                                <ul style="list-style-type: none; padding-left: 20px;">
                                    <li style="font-size: 12px;">- Developing websites on popular CMS platforms like WordPress, Joomla, or Drupal.</li>
                                    <li style="font-size: 12px;">- Customizing and extending CMS functionality.</li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                    <div class="col-md-6">
                    <?php 
                     echo '<a href="client-admin-chat.php?user_id='.$admindata['unique_id'].'"" class="mx-5 btn btn-outline-warning">Admin</a>';
                     ?>
                    </div>                    
                    <div class="col-md-6">
                        <?php

                        $unique_id_to_check = mysqli_real_escape_string($conn, $unique_id);
                        $query = mysqli_query($conn, "SELECT * FROM project WHERE client_id = '$unique_id' AND unique_id = '{$web1['unique_id']}'");
                        $result = mysqli_fetch_assoc($query);
                        $output8 = "";
                        
                        if (!empty($result['unique_id']) == 2224 && !empty($result['client_id']) == $unique_id_to_check) {
                            $output8 .= '<a href="payment.php?user_id='.$_SESSION['unique_id'].'&project_id='.$result['unique_id'].'" class="mx-5 btn btn-outline-warning" style="">Payment</a>';
                        } else {
                            $output8 .= '<a href="payment.php?user_id='.$_SESSION['unique_id'].'&project_id='.$web1['unique_id'].'" class="mx-5 btn btn-outline-warning" style="">Payment</a>';
                        }

                        echo $output8;
                
                       ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

                            <!-- <div class="modal" id="text" tabindex="-1" role="dialog">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Modal title</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form method="post">
                            <div class="modal-body">
                            
                        <div class="form-group">
                            <label for="exampleInputEmail1">Requirement</label>
                            <textarea type="text" class="form-control"  name="req" placeholder="Requirement"> </textarea>

                        </div>
                        <div class="form-group mt-2">
                            <label for="exampleInputPassword1">Price</label>
                            <input type="text" class="form-control"  name="price" placeholder="price">
                            <input type="text" class="form-control" name="incoming_id" value="<?php echo $unique_id;  ?>" style="display:none;">
                        </div>

                            </div>
                            <div class="modal-footer">

                            <?php
                            echo '<input class="mx-5 btn btn-outline-warning text-dark" name="submit" value="Submit" type="submit">';
                            ?>

                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            </div>
                            </form>
                            </div>
                          </div>
                        </div> -->


</body>

</html>
