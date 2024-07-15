<?php
    include 'config.php';
    include 'config.php';
    $message = "";
      session_start();
    if(isset($_SESSION['unique_id'])){
    $user_id = mysqli_real_escape_string($conn, $_GET['user_id']);
    $fetchQuery = mysqli_query($conn, "SELECT * FROM developer WHERE unique_id = '$user_id'");
    $arrayData = mysqli_fetch_array($fetchQuery);
  
  }else{
    header("Location : index.php");
  }
  ?>
<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
  <script></script>
  <title>Hello, world!</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

  <style>

body {
            margin: 0;
            padding: 0;
            height: 300px;
            background: url('img/admin-log1.jpg') no-repeat center center fixed; 
            -webkit-background-size: cover;
            -moz-background-size: cover;
            -o-background-size: cover;
            background-size: cover;
        }
    
        .container {
  width: 70%; 
  height: 140%; 
  border-radius: 50%;
  overflow: hidden; 
  position: relative; 
  margin-top: 2%;
  margin-left: 15%;
}

img {
  object-fit: cover;
  width: 100%; 
  height: 100%; 
  position: absolute;
  left: 0;
  border: 2px solid; 
}

  
.ket::-webkit-scrollbar { 
        display: none; 
 }
</style>


</head>

<body class="ket">
<a href="admin-dev-chat.php?user_id=<?php echo $user_id ?>" style="text-decoration: none;"> <h6 class=" mx-3 text-warning" style="font-family: 'Salsa'; "><b>CRM</b></h6></a>
  <div class="row">
    <div class="col-lg-12 bg-light">
    <div class="card ket bg-dark" style="height: 600px; width: 988px; margin-left: 180px; border-radius: 20px; background-color: rgb(0,0,0,0.7); border: 4px solid rgb(254,190,16);  overflow-y: auto;">

      <form method="post" enctype="multipart/form-data">
      <div class="row">

      <div class="col-md-6">

      <div class="container">
      <img class="border-outline-primary " src="uploaded_img\<?php echo $arrayData['d_profile'] ?>" alt="">
      </div>
     

     

 <!-- col-md-6 -->
      </div>

      <div class="col-md-6">
             
             <div class="text-light">
             <p class="mt-2 text-warning"><b><?php echo $arrayData['d_skill'] ?></b></p>
             <h4><b><?php echo $arrayData['name'] ?></b></h4>
             <textarea class="form-control text-light ket" id="txt" type="text" name="text" style="width: 473px; height:150px; background-color: rgb(0,0,0,0.8); border-color: rgb(254,190,16);" readonly><?php echo $arrayData['d_bio'] ?></textarea>
             </div>
      </div>


      <div class="text-light mx-2 col-md-12 text-center" style="position: relative; margin-top: 120px;">
                  <hr class="my-2 bg-light" style="">
                  <span style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);"><b>Basic Information</b></span>
      </div>

      <div class="col-md-12 mt-4">
        <div class="card text-light" style="margin-left: 135px; height: 170px; width: 700px; background-color: rgb(0,0,0,0.8); border-color: rgb(254,190,16);" readonly>
          <div class="row">
          <div class="col-md-6 mt-4 mx-4 " style="width: 370px;">
            <label class="text-warning"><b>Email: </b> </label>     <?php echo $arrayData['email'] ?><br>
            <label class="mt-3 text-warning"><b>Phone: </b> </label>     <?php echo $arrayData['d_mobile'] ?><br>
            <label class="mt-3 text-warning"><b>Country: </b> </label>   <?php echo $arrayData['d_country'] ?>
          </div>

          <div class="col-md-6 mt-5 mx-5 " style="width:200px">
          <label class="text-warning"><b>Join Date : </b> </label>     <?php echo $arrayData['date'] ?><br>
            <label class="mt-3 text-warning"><b>Unique-ID: </b> </label>     <?php echo $arrayData['unique_id'] ?><br>
          </div>
          </div>
       </div>
      </div>



      <div class="text-light mx-2 col-md-12 text-center mt-5" style="position: relative;">
                  <hr class="my-2 bg-light" style="">
                  <span style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);"><b>What I DO</b></span>
      </div>

   

      <div class="col-md-6">
             
      <header class="text-light" style="text-decoration: underline; opacity: 0;"><h5> What I Do </h5></header>

               <div class="text-light mx-1">
                <textarea class="form-control mt-2 text-light ket" id="txt" type="text" name="skill_3" style="height: 80px ; background-color: rgb(0,0,0,0.8); border-color: rgb(254,190,16);" readonly><?php echo $arrayData['skill_3'] ?></textarea>
               </div>

                <div class="text-light mx-1 mt-4">
                <textarea class="form-control mt-2 text-light ket" id="txt" type="text" name="skill_4" style="height: 80px ; background-color: rgb(0,0,0,0.8); border-color: rgb(254,190,16);" readonly><?php echo $arrayData['skill_4'] ?></textarea>
               </div>
        </div>
        <div class="col-md-6 mt-2">
             

             <div class="text-light mx-1 mt-2">
              <textarea class="form-control mt-4 text-light ket" id="txt" type="text" name="skill_1" style="height: 80px ; background-color: rgb(0,0,0,0.8); border-color: rgb(254,190,16);" readonly><?php echo $arrayData['skill_1'] ?></textarea>
             </div>

              <div class="text-light mx-1 mt-4">
              <textarea class="form-control mt-2 text-light ket" id="txt" type="text" name="skill_2" style="height: 80px ; background-color: rgb(0,0,0,0.8); border-color: rgb(254,190,16);" readonly><?php echo $arrayData['skill_2'] ?></textarea>
             </div>
      </div>

      <div class="row">
        <div class="col-md-6">
        <div class="text-light mx-1 mt-2">
              <textarea class="form-control mt-4 text-light ket" id="txt" type="text" name="skill_1" style="height: 80px ; background-color: rgb(0,0,0,0.8); border-color: rgb(254,190,16);" readonly><?php echo $arrayData['skill_1'] ?></textarea>
             </div>
        </div>
      </div>
        <div class="text-light mx-1 mt-5" style="opacity: 0;">
        </div>


 <!-- row -->
 </div>

 </form>
<!-- card end -->
</div>
      
    </div>
  </div>


  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm"
    crossorigin="anonymous"></script>
</body>
</html>


  




















    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm"
      crossorigin="anonymous"></script>

</body>

</html>