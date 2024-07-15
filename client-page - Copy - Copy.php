<?php
include 'config.php';
session_start();
if (!isset($_SESSION['SESSION_EMAIL'])) {
  header("Location: login.php");
  die();
}
$user_id = $_SESSION['user_id'];

$query ="SELECT * FROM `details` WHERE id='$user_id'";
$allData = mysqli_query($conn,$query);
$query1 ="SELECT * FROM `admin` WHERE 1";
$we = mysqli_query($conn,$query1);
$admin = mysqli_fetch_array($we);
$output = "";
$arrayData = mysqli_fetch_array($allData);

if(isset($_POST['contact_send'])){
    $contact_name = $_POST['contact_name'];
    $contact_email = $_POST['contact_email'];
    $contact_subject = $_POST['contact_subject'];
    $contact_message= $_POST['contact_message'];

    $name_pattern = "/[A-Za-z ]+$/";                                        
    $email_pattern = "/^[a-zA-Z0-9._%+-]+@gmail\.com$/";
    $subject_pattern = "/[A-Za-z ]+$/";
    $message_pattern = "/[A-Za-z 0-9 @#!$%^&**%*^!-_ ]/";


    if(!preg_match($name_pattern,$contact_name)){
      echo "<script> alert('Characters Only (Name Field)!!') </script>";
  }elseif(!preg_match($email_pattern,$contact_email)){
    echo "<script> alert('Invalid email!!') </script>";
  }elseif(!preg_match($subject_pattern,$contact_subject)){
    echo "<script> alert('Characters Only (Subject Field)!!') </script>";
  }elseif(!preg_match($message_pattern,$contact_message)){
    echo "<script> alert('Characters Only (Message Field)!!') </script>";
  }else{
    $sql = "INSERT INTO contact (name, email, subject, message) VALUES ('{$contact_name}', '{$contact_email}', '{$contact_subject}', '{$contact_message}')";
    $result = mysqli_query($conn, $sql);
  if($result){
    echo "<script> alert('Information Send Succesfully!!') </script>";
  }
  } 
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DigitalSpark CRM</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/typed.js/2.0.11/typed.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/waypoints/4.0.1/jquery.waypoints.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css"/>


    <!-- Bootstrap JS -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>

    <style>
        /* import google fonts */
@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&family=Ubuntu:wght@400;500;700&display=swap');

*{
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    text-decoration: none;
}
html{
    scroll-behavior: smooth;
}

/* custom scroll bar */
::-webkit-scrollbar {
    width: 10px;
}
::-webkit-scrollbar-track {
    background: #f1f1f1;
}
::-webkit-scrollbar-thumb {
    background: #888;
}

::-webkit-scrollbar-thumb:hover {
    background: #555;
}

/* all similar content styling codes */
section{
    padding: 100px 0;
}
.max-width{
    max-width: 1300px;
    padding: 0 80px;
    margin: auto;
}
.about, .services, .skills, .teams, .contact, footer{
    font-family: 'Poppins', sans-serif;
}
.about .about-content,
.services .serv-content,
.skills .skills-content,
.contact .contact-content{
    display: flex;
    flex-wrap: wrap;
    align-items: center;
    justify-content: space-between;
}
section .title{
    position: relative;
    text-align: center;
    font-size: 40px;
    font-weight: 500;
    margin-bottom: 60px;
    padding-bottom: 20px;
    font-family: 'Ubuntu', sans-serif;
}
section .title::before{
    content: "";
    position: absolute;
    bottom: 0px;
    left: 50%;
    width: 180px;
    height: 3px;
    background: #111;
    transform: translateX(-50%);
}
section .title::after{
    position: absolute;
    bottom: -8px;
    left: 50%;
    font-size: 20px;
    color: crimson;
    padding: 0 5px;
    background: #fff;
    transform: translateX(-50%);
}


/* navbar styling */
.navbar{
    position: fixed;
    width: 100%;
    z-index: 999;
    padding: 30px 0;
    font-family: 'Ubuntu', sans-serif;
    transition: all 0.3s ease;
}
.navbar.sticky{
    padding: 15px 0;
    background: #111;
}
.navbar .max-width{
    display: flex;
    align-items: center;
    justify-content: space-between;
}
.navbar .logo a{
    color: #fff;
    font-size: 35px;
    font-weight: 600;
}
.navbar .logo a span{
    color: #FFBF00;
    transition: all 0.3s ease;
}
.navbar.sticky .logo a span{
    color: #fff;
}
.navbar .menu li{
    list-style: none;
    display: inline-block;
}
.navbar .menu li a{
    display: block;
    color: #fff;
    font-size: 18px;
    font-weight: 500;
    margin-left: 25px;
    transition: color 0.3s ease;
}
.navbar .menu li a:hover{
    color: #000;
}
.navbar.sticky .menu li a:hover{
    color: #fff;
}


/* menu btn styling */
.menu-btn{
    color: #fff;
    font-size: 23px;
    cursor: pointer;
    display: none;
}
.scroll-up-btn{
    position: fixed;
    height: 45px;
    width: 42px;
    background: rgb(223, 172, 17);
    right: 30px;
    bottom: 10px;
    text-align: center;
    line-height: 45px;
    color: #fff;
    z-index: 9999;
    font-size: 30px;
    border-radius: 6px;
    border-bottom-width: 2px;
    cursor: pointer;
    opacity: 0;
    pointer-events: none;
    transition: all 0.3s ease;
}
.scroll-up-btn.show{
    bottom: 30px;
    opacity: 1;
    pointer-events: auto;
}
.scroll-up-btn:hover{
    filter: brightness(90%);
}


/* home section styling */
.home{
    display: flex;
    background: url("images/banner.jpg") no-repeat center;
    height: 100vh;
    color: #fff;
    min-height: 500px;
    background-size: cover;
    background-attachment: fixed;
    font-family: 'Ubuntu', sans-serif;
}
.home .max-width{
  width: 100%;
  display: flex;
}
.home .max-width .row{
  margin-right: 0;
}
.home .home-content .text-1{
    font-size: 27px;
}
.home .home-content .text-2{
    margin: 20px;
    font-size: 25px;
    font-weight: 600;
    margin-left: -3px;
    color: #FFBF00;
}
.home .home-content .text-3{
    font-size: 40px;
    margin: 5px 0;
}
.home .home-content .text-3 span{
    color: #FFBF00;    ;
    font-weight: 500;
}
.home .home-content a{
    display: inline-block;
    background: #000;
    color: #fff;
    font-size: 25px;
    padding: 12px 36px;
    margin-top: 20px;
    font-weight: 400;
    border-radius: 6px;
    border: 2px solid #000;
    transition: all 0.3s ease;
    margin-left: 0;
}
.home .home-content a:hover{
    color: #ddd;
    background: none;
}


/* about section styling */

.about .title::after{
    content: "";
}
.about .about-content .left{
    width: 45%;
}
.about .about-content .left img{
    height: 400px;
    width: 400px;
    object-fit: cover;
    border-radius: 6px;
}
.about .about-content .right{
    width: 55%;
}
.about .about-content .right .text{
    font-size: 25px;
    font-weight: 600;
    margin-bottom: 10px;
}
.about .about-content .right .text span{
    color: #08A0E9;
}
.about .about-content .right p{
    text-align: justify;
}
.about .about-content .right a{
    display: inline-block;
    background: #08A0E9;
    color: #fff;
    font-size: 20px;
    font-weight: 500;
    padding: 10px 30px;
    margin-top: 50px;
    margin-left: 0px;
    border-radius: 6px;
    border: 2px solid #111;
    transition: all 0.3s ease;
    text-align: right;
}
.about .about-content .right a:hover{
    color: #08A0E9;
    background: none;
}



/* Build Your Brand Section */

.build-section {
            text-align: center;
            padding: 0px;
            background-color: #08a0e9;
            background: #08a0e9;
            height: 300px;
            border: 0px;
            margin: 0px;
        }

.build-section .container{
    color: white;
    background: rgb(37, 171, 225);
        }


.build-section .container h1{
    border: 0px;
    padding-top: 50px;
    font-size: 50px;
}

.build-section .container h2{
    border: 0px;
    padding-top: 10px;
    font-size: 30px;
}

#buildButton{
  color: black;
  border: 1px;
  padding: 10px;
  border: 0px;
  margin-top: 35px;
  font-size: 20px;
  background-color: white;
}




/* Technology Section */

.technology-section h1{
    font-size: 40px;
    color: #000000;
    text-align: center;
}

.technology-section{
    padding-top: 50px; 
    margin-top: 50px; 
    border: none;
    background-color: #fff;
    height: 500px;
    width: 100%;
}


.technology-section .card-group {
    padding-top: 10px;
    display: flex;
    flex-wrap: wrap; 
    margin-left: 15px;
    
}

.technology-section .card-group .card {
    background-color: #08a0e9;
    border-radius: 10px;
    box-shadow: 5px 5px 10px rgba(0, 0, 0, 0.5); 
    opacity: 1;
    margin: 7px;
    padding: 10px;
    border: solid 1px gray;
    width: 200px; 
    height: 250px;
}

.technology-section .card-group .card .card-img-tops {
    width: 150px; 
    height: auto; 
    padding: 10px;
    border: 1px;
    margin: 5px;
    text-align: center;
    border-radius: 1px 1px 0 0; 
   
}

.technology-section .card-group .card .card-body h5{
    padding: 10px;
    margin: 5px;
    border: none;

}

.technology-section .card-group .card .card-body .card-title {
    text-align: center;
    margin-bottom: 20px; 
    font-size: 15px;
    padding-bottom: 10px;
}


@media (max-width: 690px) {
    .technology-section h1{
    font-size: 40px;
    color: #000000;
    text-align: center;
}

.technology-section{
    padding: 20px; 
    margin-top: 50px; 
    border: none;
    background-color: #fff;
    height: auto;
    width: 100%;
}


.card-group {
    display: flex;
    flex-wrap: wrap; 
    justify-content: center; 
}

.card {
    background-color: #08a0e9;
    border-radius: 10px;
    box-shadow: 5px 5px 10px rgba(0, 0, 0, 0.1); 
    margin: 20px;
    padding: 20px;
    width: 200px; 
}

.card-img-top {
    width: 100px; 

    padding: 20px;
    border-radius: 5px 5px 0 0; 
}

}

/* services section styling */

.services, .teams{
    color:#fff;
    background: #111;
}
.services .title::before,
.teams .title::before{
    background: #fff;
}
.services .title::after,
.teams .title::after{
    background: #111;
    content: "";
}
.services .serv-content .card{
    width: calc(33% - 20px);
    background: #222;
    text-align: center;
    border-radius: 6px;
    padding: 50px 25px;
    cursor: pointer;
    transition: all 0.3s ease;
}
.services .serv-content .card:hover{
    background: #08A0E9;
}
.services .serv-content .card .box{
    transition: all 0.3s ease;
}
.services .serv-content .card:hover .box{
    transform: scale(1.05);
}
.services .serv-content .card i{
    font-size: 50px;
    color: #08A0E9;
    transition: color 0.3s ease;
}
.services .serv-content .card:hover i{
    color: #fff;
}
.services .serv-content .card .text{
    font-size: 25px;
    font-weight: 500;
    margin: 10px 0 7px 0;
}



/* price section styling */

@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@100;300;400;500;600&display=swap');

*{
  font-family: 'Poppins', sans-serif;
  margin:0; padding:0; 
  box-sizing: border-box;
  text-transform: capitalize;
  outline: none; border:none;
  text-decoration: none;
}

.container .price h1{
    font-size: 50px;
    margin: 5px;
    padding: 5px;
    text-align: center;
}

.container{
  background: linear-gradient(#ddd 100%, rgb(20, 163, 220) 0.1%);
  min-height: 100vh;
  text-align: center;

}

.container .box-container{
  max-width: 1200px;
  margin:0 auto;
  padding:20px;
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
  gap:20px;
}

.container .box-container .box{
  background: #fff;
  box-shadow: 0 10px 15px rgba(0,0,0,.3);
}

.container .box-container .box:nth-child(2){
  border:2px solid #000;
}

.container .box-container .box:nth-child(2) .btn{
  background: #FFBF00;
}

.container .box-container .box:nth-child(2) .btn:hover{
  background: #444;
}

.container .box-container .box h3{
  font-size: 25px;
  padding:17px 0;
  color:#444;
}

.container .box-container .box .price{

  color:#fff;
  background: rgb(31, 172, 233);
  font-weight: bolder;
  font-size: 50px;
}

.container .box-container .box .prices{
  color:#fff;
  background: #FFBF00;
  font-weight: bolder;
  font-size: 50px;
}

.container .box-container .box .price.year{
  display: none;
}

.container .box-container .box .list{
  margin:20px 0;
}

.container .box-container .box .list p{
  padding:15px 0;
  font-size: 17px;
  color:#666;
}

.container .box-container .box .list p i{
  padding-right: 5px;
  color:crimson;
}

.container .box-container .box .btn{
  margin:20px;
  display: block;
  font-size: 17px;
  background: #444;
  color:#fff;
  padding:10px;
}

.container .box-container .box .btn:hover{
  background: crimson;
}

.container .price-toggler{
  margin-top: 50px;
  display: inline-block;
  padding:5px;
  border:2px solid #000;
  background: #fff;
}

.container .price-toggler span{
  padding:7px 30px;
  cursor: pointer;
  color:#444;
  font-size: 20px;
  display: inline-block;
}

.container .price-toggler span.active{
  background: #444;
  color:#fff;
}

@media (max-width:450px){
  .container .box-container{
    grid-template-columns: 1fr;
  }
}



/*project section styling*/

header {
    background-color: #333;
    color: #08A0E9;
    text-align: center;
    padding: 1rem 0;
}

.project-section {
    display: flex;
    justify-content: center;
    align-items: center;
    padding: 40px;
    background-color: #08a0e9;
}

.project-section h3{
    text-align: center;
}

.project {
    text-align: center;
    margin: 20px;
    padding: 20px;
    background-color: #fff;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

.project img {
    width: 100%;
    max-width: 300px;
    height: auto;
    margin-bottom: 10px;
}

.project h2 {
    margin: 0;
    font-size: 1.2rem;
    color: #333;
}

.project p {
    margin: 0;
    color: #777;
}



/* skills section styling */

.skills .title::after{
    content: "";
}
.skills .skills-content .column{
    width: calc(50% - 30px);
}
.skills .skills-content .left .text{
    font-size: 20px;
    font-weight: 600;
    margin-bottom: 10px;
}
.skills .skills-content .left p{
    text-align: justify;
}
.skills .skills-content .left a{
    display: inline-block;
    background: crimson;
    color: #fff;
    font-size: 18px;
    font-weight: 500;
    padding: 8px 16px;
    margin-top: 20px;
    border-radius: 6px;
    border: 2px solid crimson;
    transition: all 0.3s ease;
}
.skills .skills-content .left a:hover{
    color: #08A0E9;
    background: none;
}
.skills .skills-content .right .bars{
    margin-bottom: 15px;
}
.skills .skills-content .right .info{
    display: flex;
    margin-bottom: 5px;
    align-items: center;
    justify-content: space-between;
}
.skills .skills-content .right span{
    font-weight: 500;
    font-size: 18px;
}
.skills .skills-content .right .line{
    height: 5px;
    width: 100%;
    background: lightgrey;
    position: relative;
}

.skills .skills-content .right .line::before{
    content: "";
    position: absolute;
    height: 100%;
    left: 0;
    top: 0;
    background: #08A0E9;
}

.skills-content .right .html::before{
    width: 90%;
}
.skills-content .right .css::before{
    width: 60%;
}
.skills-content .right .js::before{
    width: 80%;
}
.skills-content .right .php::before{
    width: 50%;
}
.skills-content .right .mysql::before{
    width: 70%;
}




/*teams section styling*/

.team-section {
    display: flex;
    justify-content: center;
    align-items: center;
    padding: 40px;
    background-color: #08A0E9;
}

.team-member {
    text-align: center;
    margin: 20px;
    padding: 20px;
    background-color: #fff;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

.team-member img {
    width: 100px;
    height: 150px;
    border-radius: 0%;
    object-fit: cover;
    margin-bottom: 10px;
}

.team-member h2 {
    margin: 0;
    font-size: 1.2rem;
    color: #333;
}

.team-member p {
    margin: 0;
    color: #777;
}



/* contact section styling */

.contact .title::after{
    content: "";
}
.contact .contact-content .column{
    width: calc(50% - 30px);
}
.contact .contact-content .text{
    font-size: 20px;
    font-weight: 600;
    margin-bottom: 10px;
}
.contact .contact-content .left p{
    text-align: justify;
}
.contact .contact-content .left .icons{
    margin: 10px 0;
}
.contact .contact-content .row{
    display: flex;
    height: 65px;
    align-items: center;
}
.contact .contact-content .row .info{
    margin-left: 30px;
}
.contact .contact-content .row i{
    font-size: 25px;
    color: #08A0E9;
}
.contact .contact-content .info .head{
    font-weight: 500;
}
.contact .contact-content .info .sub-title{
    color: #333;
}
.contact .right form .fields{
    display: flex;
}
.contact .right form .field,
.contact .right form .fields .field{
    height: 45px;
    width: 100%;
    margin-bottom: 15px;
}
.contact .right form .textarea{
    height: 80px;
    width: 100%;
}
.contact .right form .name{
    margin-right: 10px;
}
.contact .right form .field input,
.contact .right form .textarea textarea{
    height: 100%;
    width: 100%;
    border: 1px solid lightgrey;
    border-radius: 6px;
    outline: none;
    padding: 0 15px;
    font-size: 17px;
    font-family: 'Poppins', sans-serif;
    transition: all 0.3s ease;
}
.contact .right form .field input:focus,
.contact .right form .textarea textarea:focus{
    border-color: #b3b3b3;
}
.contact .right form .textarea textarea{
  padding-top: 10px;
  resize: none;
}
.contact .right form .button-area{
  display: flex;
  align-items: center;
}
.right form .button-area button{
  color: #fff;
  display: block;
  width: 160px!important;
  height: 45px;
  outline: none;
  font-size: 18px;
  font-weight: 500;
  border-radius: 6px;
  cursor: pointer;
  flex-wrap: nowrap;
  background: #08a0e9;
  border: 2px solid #000;
  margin-left:400px;
  transition: all 0.3s ease;
}
.right form .button-area button:hover{
  color: #08A0E9;
  background: none;
}


/* footer section styling */
footer{
    background: #111;
    padding: 15px 23px;
    color: #fff;
    text-align: center;
}
footer span a{
    color: #08A0E9;
    text-decoration: none;
}
footer span a:hover{
    text-decoration: underline;
}


/* responsive media query start */
@media (max-width: 1104px) {
    .about .about-content .left img{
        height: 350px;
        width: 350px;
    }
}

@media (max-width: 991px) {
    .max-width{
        padding: 0 50px;
    }
}
@media (max-width: 947px){
    .menu-btn{
        display: block;
        z-index: 999;
    }
    .menu-btn i.active:before{
        content: "\f00d";
    }
    .navbar .menu{
        position: fixed;
        height: 100vh;
        width: 100%;
        left: -100%;
        top: 0;
        background: #111;
        text-align: center;
        padding-top: 80px;
        transition: all 0.3s ease;
    }
    .navbar .menu.active{
        left: 0;
    }
    .navbar .menu li{
        display: block;
    }
    .navbar .menu li a{
        display: inline-block;
        margin: 20px 0;
        font-size: 25px;
    }
    .home .home-content .text-2{
        font-size: 70px;
    }
    .home .home-content .text-3{
        font-size: 35px;
    }
    .home .home-content a{
        
        font-size: 23px;
        padding: 10px 30px;
    }
    .max-width{
        max-width: 930px;
    }
    .about .about-content .column{
        width: 100%;
    }
    .about .about-content .left{
        display: flex;
        justify-content: center;
        margin: 0 auto 60px;
    }
    .about .about-content .right{
        flex: 100%;
    }
    .services .serv-content .card{
        width: calc(50% - 10px);
        margin-bottom: 20px;
    }
    .skills .skills-content .column,
    .contact .contact-content .column{
        width: 100%;
        margin-bottom: 35px;
    }
}

@media (max-width: 690px) {
    .max-width{
        padding: 0 23px;
    }
    .home .home-content .text-2{
        font-size: 60px;
    }
    .home .home-content .text-3{
        font-size: 32px;
    }
    .home .home-content a{
        font-size: 20px;
    }
    .services .serv-content .card{
        width: 100%;
    }
}

@media (max-width: 500px) {
    .home .home-content .text-2{
        font-size: 50px;
    }
    .home .home-content .text-3{
        font-size: 27px;
    }
    .about .about-content .right .text,
    .skills .skills-content .left .text{
        font-size: 19px;
    }
    .contact .right form .fields{
        flex-direction: column;
    }
    .contact .right form .name,
    .contact .right form .email{
        margin: 0;
    }
    .right form .error-box{
       width: 150px;
    }
    .scroll-up-btn{
        right: 15px;
        bottom: 15px;
        height: 38px;
        width: 35px;
        font-size: 23px;
        line-height: 38px;
    }
}
@media (max-width: 690px) {
    .max-width{
        padding: 0 23px;
    }
    .home .home-content .text-2{
        font-size: 60px;
    }
    .home .home-content .text-3{
        font-size: 32px;
    }
    .home .home-content a{
        font-size: 20px;
    }
    .services .serv-content .card{
        width: 100%;
    }
}



@media (max-width: 690px) {
    .build-section {
            text-align: center;
            padding: 0px;
            height: 300px;
        }

.build-section .container{
    color: white;
    background: rgb(37, 171, 225);
        }


.build-section .container h1{
    border: 0px;
    padding-top: 25px;
    font-size: 25px;
}

.build-section .container h2{
    padding: 10px;
    font-size: 15px;

}

#buildButton{
  padding: 5px;
  margin-top: 5px;
  font-size: 10px;
}

}


/* nav Profile design */
.nav-profile img{
  width:40px;
  height: 40px;
  border-radius:50px
}

/* chat System */
#chatbot-container {
            position: fixed;
            bottom: 80px;
            right: 30px;
            background-color: #ffbe36;
            color: #fff;
            padding: 5px;
            border-radius: 10px 10px 0 10px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
            cursor: pointer;
            font-size: 30px;
        }

        #chatbot-container:hover {
            background-color: #193b56;
        }
        #chatbot-link {
            text-decoration: none;
            color: #fff;
        }

</style>

</head>



<body>
    <div class="scroll-up-btn">
        <i class="fas fa-angle-up"></i>
    </div>


<!--chat System-->
<div id="chatbot-container">
       <a href="client-admin-chat.php?user_id=<?php echo $admin['unique_id']; ?>" target="_blank" id="chatbot-link">  <i class="fas fa-comment-dots"></i> </a> 
</div>
    
    <nav class="navbar">
        <div class="max-width">
            <div class="logo"><a href="#">DigitalSpark CRM</a></div>
            <ul class="menu">
                <li><a href="#home" class="menu-btn">Home</a></li>
                <li><a href="#about" class="menu-btn">About</a></li>
                <li><a href="#services" class="menu-btn">Services</a></li>
                <li><a href="#price-section" class="menu-btn">Price</a></li>
                <li><a href="#project-section" class="menu-btn">Project</a></li>
                <li><a href="#skills" class="menu-btn">Skills</a></li>     
                <li><a href="#contact" class="menu-btn">Contact</a></li>

                <li>
                <a href="client-profile.php?user_id=<?php echo $arrayData['unique_id'] ?>" class="navbar-link">
              <div class="nav-profile">
              <?php
               echo '<img class="img-thumbnail" id="profile-image" src="uploaded_img/'.$arrayData['image'].'">'
                ?></div></a>

                </li>
            </ul>

            <div class="menu-btn">
                <i class="fas fa-bars"></i>
            </div>
        </div>
    </nav>


    <!-- home section start -->
    <section class="home" id="home">
        <div class="max-width">
            <div class="home-content">
                <div class="text-1">DigitalSpark CRM Is Customer Relationship Management Software</div>
                <div class="text-2">Grow Your Business With DigitalSpark CRM</div>
                <div class="text-3">Our Services <span class="typing"></span></div>
                <a href="#contact">Contact us</a>
            </div>
        </div>
    </section>


    <!-- about section start -->
    <section class="about" id="about">
        <div class="max-width">
            <h2 class="title">About us</h2>
            <div class="about-content">
                <div class="column left">
                    <img src="images/profile-1.jpg" alt="IMAGE">
                </div>
                <div class="column right">
                    <p>DigitalSpark CRM is customer relationship management software suitable for use by IT companies or freelancers. DigitalSpark CRM can help you appear more professional to your customers and improve business performance at the same time.</p>
                    <a href="#contact">Contact us</a>
                </div>
            </div>
        </div>
    </section>
    

    <!--Build Your Brand Section-->
    <section class="build-section">
        <div class="container">
            <h1>Ready To Build Your Brand?</h1>
            <h2>You are just one step away to experience the progress.</h2>
            <button id="buildButton" class="btn btn-primary">Let Us Build Your Business</button>
        </div>
    </section>

      <!--Technology Section-->
      <section class="technology-section">
        <h1>Technologies we work with</h1>

        <div class="card-group">

            <div class="card">
              <img src="images/HTML.jpg" class="card-img-tops" alt="HTML">
              <div class="card-body">
                <h5 class="card-title">HTML</h5>
              </div>
            </div>

            <div class="card">
              <img src="images/CSS.jpg" class="card-img-tops" alt="CSS">
              <div class="card-body">
                <h5 class="card-title">CSS</h5>
              </div>
            </div>

            <div class="card">
              <img src="images/Bootstrap.jpg" class="card-img-tops" alt="Bootstrap">
              <div class="card-body">
                <h5 class="card-title">Bootstrap</h5>
              </div>
            </div>

            <div class="card">
              <img src="images/JavaScrip.jpg" class="card-img-tops" alt="JavaScrip">
              <div class="card-body">
                <h5 class="card-title">JavaScrip</h5>
              </div>
            </div>

            <div class="card">
              <img src="images/PHP.jpg" class="card-img-tops" alt="PHP">
              <div class="card-body">
                <h5 class="card-title">PHP</h5>
              </div>
            </div>

            <div class="card">
              <img src="images/MySQL.jpg" class="card-img-tops" alt="MySQL">
              <div class="card-body">
                <h5 class="card-title">MySQL</h5>
              </div>
            </div>
          </div>
    </section>

    <!-- services section start -->

    <section class="services" id="services">
        <div class="max-width">
            <h2 class="title">Our services</h2>
            <div class="serv-content">
                <div class="card">
                    <div class="box">
                        <i class="fas fa-code "></i>
                        
                        <div class="text">Web Design</div>
                        <p>Web design is the supporting mechanism of your business that speaks emphatically about your services.</p>
                    </div>
                </div>
                <div class="card">
                    <div class="box">
                        <i class="fas fa-chart-line"></i>
                        <div class="text">SEO</div>
                        <p>Search engine optimization (SEO) is the procedure of facilitating your customers connect with your business online.</p>
                    </div>
                </div>
                <div class="card">
                    <div class="box">
                        <i class="fas fa-chart-line"></i>
                        <div class="text">PPC</div>
                        <p>Our PPC management services increase your ability to achieve your business goals.</p>
                    </div>
                </div>
                <div class="card">
                    <div class="box">
                        <i class="fas fa-bullhorn"></i>
                        
                        <div class="text">Social Media Marketing</div>
                        <p>Boost your brand with strategic social media marketing.</p>
                    </div>
                </div>
                <div class="card">
                    <div class="box">
                        <i class="fas fa-poll-h"></i>
                        <div class="text">Content Marketing</div>
                        <p>Elevate your brand with impactful content marketing. </p>
                    </div>
                </div>
                <div class="card">
                    <div class="box">
                        <i class="fas fa-envelope-open-text"></i>
                        <div class="text">Email Marketing</div>
                        <p>Powerful email marketing solutions to reach, engage, and convert your audience.</p>
                    </div>
                </div>
               </div>
            </div>
        </div>
    </section>


<!--price section start-->

<section class="price-section" id="price-section">
    <div class="container">
    
        <div class="price">
         
            <h1>Pricing Plan</h1>
       
        </div>
    
        <div class="box-container">
    

            <div class="box">
                <h3>Website Development</h3>
                <div class="price month"><span>$</span>450</div>
            
                <div class="list">
                    <p> <i class="fas fa-check"></i> Content 5-7 Pages </p>
                    <p> <i class="fas fa-check"></i> Responsive Design </p>
                    <p> <i class="fas fa-check"></i> Mobile Optimized </p>
                    <p> <i class="fas fa-check"></i> Content Management System </p>
                    <p> <i class="fas fa-check"></i> Support - 1 Month </p>
                </div>
                <?php 
                 echo '<a href=" web.php?user_id='. $arrayData['unique_id'] .'" class="btn">choose plan</a>';
                ?>
            </div>
    

            <div class="box">
                <h3>SEO</h3>
                <div class="prices month"><span>$</span>250</div>
     
                <div class="list">
                    <p> <i class="fas fa-check"></i> Keywords - 10 </p>
                    <p> <i class="fas fa-check"></i> Keyword Analysis </p>
                    <p> <i class="fas fa-check"></i> Unique Titles Tags </p>
                    <p> <i class="fas fa-check"></i> SEO Strategy </p>
                    <p> <i class="fas fa-check"></i> Monthly Report </p>
                </div>
                <?php 
                 echo '<a href=" seo.php?user_id='. $arrayData['unique_id'] .'" class="btn">choose plan</a>';
                ?>
            </div>
    

            <div class="box">
                <h3>PPC</h3>
                <div class="price month"><span>$</span>250</div>
              
                <div class="list">
                    <p> <i class="fas fa-check"></i> Keywords in Campaign – 15 </p>
                    <p> <i class="fas fa-check"></i> Target Audience </p>
                    <p> <i class="fas fa-check"></i> keyword Research & Selection </p>
                    <p> <i class="fas fa-check"></i> Ad Costing Optimization </p>
                    <p> <i class="fas fa-check"></i> Monthly Report </p>
                </div>
                <?php 
                 echo '<a href=" ppc.php?user_id='. $arrayData['unique_id'] .'" class="btn">choose plan</a>';
                ?>
            </div>


            <div class="box">
                <h3>Social Media Marketing</h3>
                <div class="price month"><span>$</span>175</div>
              
                <div class="list">
                    <p> <i class="fas fa-check"></i> Keywords in Campaign – 15 </p>
                    <p> <i class="fas fa-check"></i> Target Audience </p>
                    <p> <i class="fas fa-check"></i> keyword Research & Selection </p>
                    <p> <i class="fas fa-check"></i> Ad Costing Optimization </p>
                    <p> <i class="fas fa-check"></i> Monthly Report </p>
                </div>
                <?php 
                 echo '<a href=" social-marketing.php?user_id='. $arrayData['unique_id'] .'" class="btn">choose plan</a>';
                ?>
            </div>


            <div class="box">
                <h3>Content Marketing</h3>
                <div class="price month"><span>$</span>250</div>
              
                <div class="list">
                    <p> <i class="fas fa-check"></i> Keywords in Campaign – 15 </p>
                    <p> <i class="fas fa-check"></i> Target Audience </p>
                    <p> <i class="fas fa-check"></i> keyword Research & Selection </p>
                    <p> <i class="fas fa-check"></i> Ad Costing Optimization </p>
                    <p> <i class="fas fa-check"></i> Monthly Report </p>
                </div>
                <?php 
                 echo '<a href=" content-marketing.php?user_id='. $arrayData['unique_id'] .'" class="btn">choose plan</a>';
                ?>
            </div>

            <div class="box">
                <h3>Email Marketing</h3>
                <div class="price month"><span>$</span>250</div>
              
                <div class="list">
                    <p> <i class="fas fa-check"></i> Keywords in Campaign – 15 </p>
                    <p> <i class="fas fa-check"></i> Target Audience </p>
                    <p> <i class="fas fa-check"></i> keyword Research & Selection </p>
                    <p> <i class="fas fa-check"></i> Ad Costing Optimization </p>
                    <p> <i class="fas fa-check"></i> Monthly Report </p>
                </div>
                <?php 
                 echo '<a href=" email-marketing.php?user_id='. $arrayData['unique_id'] .'" class="btn">choose plan</a>';
                ?>
            </div>
    
        </div>
    
        </div>

    
        </div>
    
    </div>
    </section>



<!-- project section start-->

    <header>
        <h1>Project</h1>
    </header>

    <section class="project-section" id="project-section">

        <div class="project">
            <img src="images/lawfirm.jpg" alt="Law Firm">
            <h2><a href="https://myfamilymatter.co.uk/">Law Firm</a></h2>
        </div>

        <div class="project">
            <img src="images/realestate.jpg" alt="Real Estate">
            <h2><a href="https://www.premiumgroupre.com/">Real Estate</a></h2>
        </div>

        <div class="project">
            <img src="images/cleaningwebsite.jpg" alt="cleaning Service">
            <h2><a href="https://awesome-maids.com/">cleaning Business</a></h2>
        </div>
    </section>



    <!-- skills section start -->

    <section class="skills" id="skills">
        <div class="max-width">
            <h2 class="title">Our skills</h2>
            <div class="skills-content">
                <div class="column left">
                    <div class="text">Our creative skills & experiences.</div>
                    <p>At DigitalSpark, we are more than just a software development company – we are a passionate team of creative minds, tech enthusiasts, and problem solvers who thrive on turning ideas into reality. Our journey began with a simple yet powerful vision: to transform the digital landscape by crafting exceptional software solutions that not only meet our clients' needs but exceed their expectations.</p>
                </div>
                <div class="column right">
                    <div class="bars">
                        <div class="info">
                            <span>HTML</span>
                            <span>85%</span>
                        </div>
                        <div class="line html"></div>
                    </div>
                    <div class="bars">
                        <div class="info">
                            <span>CSS</span>
                            <span>60%</span>
                        </div>
                        <div class="line css"></div>
                    </div>
                    <div class="bars">
                        <div class="info">
                            <span>JavaScript</span>
                            <span>70%</span>
                        </div>
                        <div class="line js"></div>
                    </div>
                    <div class="bars">
                        <div class="info">
                            <span>PHP</span>
                            <span>60%</span>
                        </div>
                        <div class="line php"></div>
                    </div>
                    <div class="bars">
                        <div class="info">
                            <span>MySQL</span>
                            <span>75%</span>
                        </div>
                        <div class="line mysql"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>



    <!-- teams section start -->

    <header>
        <h1>Our Team</h1>
    </header>
    
    <section class="team-section" id="team-section">
        <div class="team-member">
            <img src="images/manna.jpeg" alt="Manna">
            <h2>Shahariar Masud (Manna)</h2>
            <p>Web Designer</p>
        </div>

        <div class="team-member">
            <img src="images/saurov.jpeg" alt="saurov">
            <h2>Saurov Karmokar</h2>
            <p>Web Developer</p>
        </div>

        <div class="team-member">
            <img src="images/mugdho.jpeg" alt="Mugdho Datta">
            <h2>Mugdho Datta</h2>
            <p>Web Developer</p>
        </div>
    </section>



    <!-- contact section start -->

    <section class="contact" id="contact">
        <div class="max-width">
            <h2 class="title">Contact us</h2>
            <div class="contact-content">
                <div class="column left">

                    <div class="text">Let’s Start a Project</div>
                    
                    <p>To get in touch with us directly, please use the contact form below. We value your time and will make every effort to respond promptly.</p>
                    
                    <div class="icons">
                        <div class="row">
                            <i class="fas fa-user"></i>
                            <div class="info">
                                <div class="head">Name</div>
                                <div class="sub-title">DigitalSpark</div>
                            </div>
                        </div>
                        <div class="row">
                            <i class="fas fa-map-marker-alt"></i>
                            <div class="info">
                                <div class="head">Address</div>
                                <div class="sub-title">Sylhet, Bangladesh</div>
                            </div>
                        </div>
                        <div class="row">
                            <i class="fas fa-envelope"></i>
                            <div class="info">
                                <div class="head">Email</div>
                                <div class="sub-title">digitalspark@gmail.com</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="column right">
                    <div class="text">Message us</div>


                    <form action="#" method="post">
                        <div class="fields">
                            <div class="field name">
                                <input type="text" name="contact_name" placeholder="Name" required>
                            </div>
                            <div class="field email">
                                <input type="email" name="contact_email" placeholder="Email" required>
                            </div>
                        </div>
                        <div class="field">
                            <input type="text" name="contact_subject" placeholder="Subject" required>
                        </div>
                        <div class="field textarea">
                            <textarea cols="30" rows="10" name="contact_message" placeholder="Message.." required></textarea>
                        </div>
                        <div class="button-area">
                            <button type="submit" name="contact_send">Send message</button>
                        </div>
                    </form>


                </div>
            </div>
        </div>
    </section>



    <!-- footer section start -->

    <footer>
        <span>Created By <a href="">Shahariar Masud (Manna)</a> | <span class="far fa-copyright"></span>All rights reserved.</span>
    </footer>


   <!-- JavaScript Code -->
<script>
    $(document).ready(function(){
        $(window).scroll(function(){

            // sticky navbar on scroll script
            if(this.scrollY > 20){
                $('.navbar').addClass("sticky");
            }else{
                $('.navbar').removeClass("sticky");
            }
            
            // scroll-up button show/hide script
            if(this.scrollY > 500){
                $('.scroll-up-btn').addClass("show");
            }else{
                $('.scroll-up-btn').removeClass("show");
            } // Add the closing parenthesis here
        });

        // slide-up script
        $('.scroll-up-btn').click(function(){
            $('html').animate({scrollTop: 0});
            
            // removing smooth scroll on slide-up button click
            $('html').css("scrollBehavior", "auto");
        });

        $('.navbar .menu li a').click(function(){
            // applying again smooth scroll on menu items click
            $('html').css("scrollBehavior", "smooth");
        });

        // toggle menu/navbar script
        $('.menu-btn').click(function(){
            $('.navbar .menu').toggleClass("active");
            $('.menu-btn i').toggleClass("active");
        });

        // typing text animation script
        var typed = new Typed(".typing", {
            strings: ["Website Design", " Website Developer", "SEO", "SMM", "PPC"],
            typeSpeed: 100,
            backSpeed: 60,
            loop: true
        });
    });
</script>



</body>
</html>
