<?php 
 include 'config.php';
 $message = "";
   session_start();
    if(isset($_SESSION['unique_id'])){
   $unique_id = $_SESSION['unique_id'];
   $user_id = mysqli_real_escape_string($conn, $_GET['user_id']);

    // Echo the user_id into a JavaScript variable
    echo '<script>let user_id = ' . json_encode($user_id) . ';</script>';

   $query1 ="SELECT * FROM `admin` WHERE 1";
   $allData1 = mysqli_query($conn,$query1);
   $arrayData1 = mysqli_fetch_array($allData1);

   $query2 ="SELECT * FROM `chat-bg` WHERE 1";
   $allData2 = mysqli_query($conn,$query2);
   $arrayData2 = mysqli_fetch_array($allData2);

   $query ="SELECT * FROM `messages` WHERE incoming_msg_id='$unique_id'";
   $allData = mysqli_query($conn,$query);
   $arrayData = mysqli_fetch_array($allData);


   if (isset($_POST['change1'])) {
    $img = mysqli_real_escape_string($conn, $_POST['img-1']);
    $sql5 ="UPDATE `chat-bg` SET image = '$img' WHERE 1";      
    $result5 = mysqli_query($conn, $sql5);
   

      echo '<script>alert("Background Changes");
           window.location.href = "dev-manager-chat.php?user_id='.$user_id.'";
           </script>';
  }

  if (isset($_POST['change2'])) {
    $img = mysqli_real_escape_string($conn, $_POST['img-2']);
    $sql5 ="UPDATE `chat-bg` SET image = '$img' WHERE 1";      
    $result5 = mysqli_query($conn, $sql5);
   

      echo '<script>alert("Background Changes");
      window.location.href = "dev-manager-chat.php?user_id='.$user_id.'";
      </script>';
  }

  if (isset($_POST['change3'])) {
    $img = mysqli_real_escape_string($conn, $_POST['img-3']);
    $sql5 ="UPDATE `chat-bg` SET image = '$img' WHERE 1";      
    $result5 = mysqli_query($conn, $sql5);
   

      echo '<script>alert("Background Changes");
      window.location.href = "dev-manager-chat.php?user_id='.$user_id.'";
      </script>';
  }

  if (isset($_POST['change4'])) {
    $img = mysqli_real_escape_string($conn, $_POST['img-4']);
    $sql5 ="UPDATE `chat-bg` SET image = '$img' WHERE 1";      
    $result5 = mysqli_query($conn, $sql5);
   

      echo '<script>alert("Background Changes");
      window.location.href = "dev-manager-chat.php?user_id='.$user_id.'";
      </script>';
  }

  if (isset($_POST['change5'])) {
    $img = mysqli_real_escape_string($conn, $_POST['img-5']);
    $sql5 ="UPDATE `chat-bg` SET image = '$img' WHERE 1";      
    $result5 = mysqli_query($conn, $sql5);
   

      echo '<script>alert("Background Changes");
      window.location.href = "dev-manager-chat.php?user_id='.$user_id.'";
      </script>';
  }
   

    }else{
    header("location: ../login.php");
  }


?>
<!DOCTYPE html>
<html lang="en">
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
<script src="bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<title>DigitalSpark CRM</title>
<head>
<style>
  *{
  margin: 0;
  padding: 0;
  box-sizing: border-box;
  text-decoration: none;
 
}
body {
            margin: 0;
            padding: 0;
            height: 300px;
            background: url('img/<?php echo $arrayData2['image'] ?>.jpg') no-repeat center center fixed; 
            -webkit-background-size: cover;
            -moz-background-size: cover;
            -o-background-size: cover;
            background-size: cover;
        }
.card{
    width: 900px;
    height:550px;
    padding: 3%;
    margin-top: 40px;
    margin-bottom: 3%;
    border-radius: 10px 10px 10px 10px;
    margin-left: 180px;
    background: rgb(0,0,0,0.7);
    /* background: rgba(255, 255, 255, 0);
            box-shadow: 0px 0px 15px 2px #7c7a7a;
            backdrop-filter: blur(60px); */
    
    
  }

    .chat-area{
      width:100%;
      height: 100%;
      margin-top:-40px; 
    }
.chat-area header{
  display: flex;
  align-items: center;
  margin-top:20px;
  border-bottom:2px solid #C0E8F5;
  
}
.chat-area header .back-icon{
  color: white;
  font-size: 25px;
  margin-left:-10px;
}
.chat-area header img{
  height: 45px;
  width: 45px;
  margin: 0 15px;
  border-radius:20px;
}
.chat-area header .details span{
  font-size: 17px;
  font-weight: 500;
  color:white;
  font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
  font-size:1.5rem;
}
.chat-area .status{
  color:white;
  font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
  font-size:1.1rem;
}
.chat-box{
  position: relative;
  height: 410px;
  width: 850px;
  border-color:blue;
  overflow-y: auto;

  box-shadow: inset 0 32px 32px -32px rgb(0 0 0 / 5%),
              inset 0 -32px 32px -32px rgb(0 0 0 / 5%);            
             
}
.chat-box::-webkit-scrollbar { 
  display: none; 
 } 
.chat-box .text{
  position: absolute;
  top: 45%;
  left: 50%;
  width: calc(100% - 50px);
  text-align: center;
  transform: translate(-50%, -50%);
 
}
.chat-box .chat{
  margin: 15px 0px -20px;
}
.chat-box .chat p{
  word-wrap: break-word;
  padding: 8px 16px;
  box-shadow: 0 0 32px rgb(0 0 0 / 8%),
              0rem 16px 16px -16px rgb(0 0 0 / 10%);
}
.chat-box .outgoing{
  display: flex;
  margin-left: 400px;
}
.chat-box .outgoing .details{
  margin-left: auto;
}
.outgoing .details p{
  background: rgb(255,255,255,0.5);
  color: white;
  font-weight:bold;
  font-size:1rem;
  border-radius: 18px 18px 0 18px;
  
}
.chat-box .incoming{
  display: flex;
  align-items: flex-end;
}
.chat-box .incoming img{
  height: 35px;
  width: 30px;
  border-radius: 20px;
}
.chat-box .incoming .details{
  margin-left: 10px;
}
.incoming .details p{
  background: rgb(255,255,255,0.5);
  color: white;
  font-weight:bold;
  font-size:1rem;
  border-radius: 18px 18px 18px 0;
 
}
.typing-area{
  padding: 18px 30px;
  display: flex;
  justify-content: space-between;
  z-index: 2;
}
.typing-area input{
  height: 35px;
  width: calc(100% - 40px);
  font-size: 16px;
  padding: 0 13px;
  border: 4px solid #e6e6e6;
  outline: none;
  margin-top:0px;
  border-radius: 5px 0 0 5px;
}
.typing-area button{
  width: 55px;
  height: 35px;
  margin-top: 0px;
  margin-left: 5px;
  font-size: 19px;
  cursor: pointer;
  pointer-events: none;
  border-radius: 0 5px 5px 0;
  transition: all 0.3s ease;
  z-index: 2;
}
.typing-area .btn.active{
  opacity: 1;
  pointer-events: auto;

}


.chat-area header .settings-button{
  color: black;
  font-size: 25px;
  margin-left: auto;
  cursor: pointer;
  position: absolute;
  top: 110px; /* Adjust the top position as needed */
  right: 320px; /* Adjust the right position as needed */
  border:none;
  color: red;
  z-index: 1;
}

.dropdown {
            position: absolute;
            top: 10px;
            right: 10px;
            
            padding: 10px;
            border-radius: 5px;
        }



  </style>
  </head>
  <body>
  <div class="container-fluid">
    <div class="col-md-6">
      <div class="card ">
    <section class="chat-area">
      <header>
          <?php
          $user_id = mysqli_real_escape_string($conn, $_GET['user_id']);
          $sql = mysqli_query($conn, "SELECT * FROM manager WHERE unique_id = '{$user_id}'");
          if(mysqli_num_rows($sql) > 0){
            $data = mysqli_fetch_assoc($sql);
          }
        ?>

        <a href="dev-profile-1.php" class="back-icon"><ion-icon class="btn btn-outline-warning" name="arrow-back"></ion-icon></a>
        <img src="uploaded_img/<?php echo $data['profile']; ?>" alt="">
        <div class="details">
          <span><?php echo $data['name']?></span>
          <p class="status"><?php echo $data['active_status']; ?></p>
         
          <div class="dropdown">
          <button type="button" class="btn btn-outline-warning" data-bs-toggle="dropdown">
          <ion-icon style="font-size: 20px;" name="settings-outline"></ion-icon>
          </button>
          <ul class="dropdown-menu" style="background-color: rgb(0,0,0,0.7); border-radius: 20px">
          <li><b class="text-light mx-4">Change Theme</b></li>
          <form method="post" enctype="multipart/form-data">
          <li>
          <input type="text" value="chat-1" name="img-1" style="display:none;"> 
          <input class="mt-2 mx-5 btn btn-outline-warning" type="submit" value="image-1" name="change1">
          </li>
          <li>
          <input type="text" value="chat-2" name="img-2" style="display:none;"> 
          <input class="mt-1 mx-5 btn btn-outline-warning"  type="submit" value="image-2" name="change2">
          </li>
          <li>
          <input type="text" value="chat-3" name="img-3" style="display:none;"> 
          <input class=" mt-1 mx-5 btn btn-outline-warning"  type="submit" value="image-3" name="change3">
          </li>
          <li>
          <input type="text" value="chat-4" name="img-4" style="display:none;"> 
          <input class="mt-1 mx-5 btn btn-outline-warning"  type="submit" value="image-4" name="change4">
          </li>
          <li>
          <input type="text" value="chat-5" name="img-5" style="display:none;"> 
          <input class="mt-1 mx-5 btn btn-outline-warning"  type="submit" value="image-5" name="change5">
          </li>
          
          </form>
          </ul>
          </div>


        </div>
      </header>
      <div class="chat-box">
          
      </div>
       </section>
       <form method="post" id="messageFrom" class="typing-area">
        <input type="text" class="incoming_id" name="incoming_id" value="<?php echo $user_id; ?>" hidden >
        <input type="text" name="message" class="input-field" placeholder="Type a message here..." autocomplete="off">
        <button type="submit" name="send_msg" value="" class="btn btn-outline-warning"><ion-icon name="send"></ion-icon></button>
      </form>
      </div>
    </div>
  </div>

  <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
  <script>




       
  


  
  </script>


<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
<script src="chat.js"></script>

</body>
</html>
