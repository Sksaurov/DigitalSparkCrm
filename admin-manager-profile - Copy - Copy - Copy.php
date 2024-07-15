<?php
    include 'config.php';
    include 'config.php';
    $message = "";
      session_start();
    if(isset($_SESSION['unique_id'])){
    $user_id = mysqli_real_escape_string($conn, $_GET['user_id']);
    $fetchQuery = mysqli_query($conn, "SELECT * FROM manager WHERE unique_id = '$user_id'");
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
    
     img {
  object-fit: cover;
  width: 50%;
  height: 80%;
  border-radius: 50%;
  border: 10px solid; /* Specify border style */
  margin-top: 5%;
  margin-left: 25%;
}
  
.ket::-webkit-scrollbar { 
        display: none; 
 }
</style>


</head>

<body class="ket">
<a href="admin-manager-chat.php?user_id=<?php echo $user_id ?>" style="text-decoration: none;"> <h6 class=" mx-3 text-warning" style="font-family: 'Salsa'; "><b>CRM</b></h6></a>
  <div class="row">
    <div class="col-lg-12">
    <div class="card ket" style="height: 600px; width: 988px; margin-left: 180px; border-radius: 20px; background-color: rgb(0,0,0,0.7); border: 4px solid rgb(254,190,16);  overflow-y: auto;">

      <form method="post" enctype="multipart/form-data">
      <div class="row">

      <div class="col-md-6">

      <img class="border-outline-primary " src="uploaded_img\<?php echo $arrayData['profile'] ?>" alt="">
  
     

     

 <!-- col-md-6 -->
      </div>

      <div class="col-md-6">
             
             <div class="text-light">
             <p class="mt-2 text-warning"><b>Manager</b></p>
             <h4><b><?php echo $arrayData['name'] ?></b></h4>
             <textarea class="form-control text-light ket" id="txt" type="text" name="text" style="width: 473px; height:150px; background-color: rgb(0,0,0,0.8); border-color: rgb(254,190,16);" readonly><?php echo $arrayData['bio'] ?></textarea>
             </div>
      </div>


      <div class="text-light mx-2 col-md-12 text-center mt-5" style="position: relative;">
                  <hr class="my-2 bg-light" style="">
                  <span style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);"><b>Basic Information & Project</b></span>
      </div>

      <div class="col-md-12 mt-5">
        <div class="row">

          <div class="col-md-6">
            <div class="card text-light mx-5" style="background-color: rgb(0,0,0,0.8); border-color: rgb(254,190,16); height: 150px; width: 400px; ">

            <div class="mx-5">
            <label class="text-warning mt-3"><b>Email</b> </label> 
            <p class=""><?php echo $arrayData['email'] ?></p>
            <label class="mt-1 text-warning"><b>Unique-ID</b> </label>     
            <p class=""><?php echo $arrayData['unique_id'] ?></p>
            </div>

          </div>
        </div>

        <div class="col-md-6">
            <div class="card text-light mx-2 ket" style="background-color: rgb(0,0,0,0.8); border-color: rgb(254,190,16);height: 150px; max-height: 250px; overflow-y: auto; width: 400px;">
            <p class="text-warning mx-2"><b>Projects</b></p>
            <?php  
                    $id = $_SESSION['unique_id'];
                    $sql = "SELECT * FROM project WHERE manager_id = '$user_id'";
                    $query = mysqli_query($conn, $sql);

                    $output = "";

                    if (mysqli_num_rows($query) == 0) {
                        $output .= '<div class="text-light">No Project Assign.</div>';
                    } elseif (mysqli_num_rows($query) > 0) {
                        while ($row = mysqli_fetch_assoc($query)) {
                           
                            $output .= '<label class="p-2 text-light mx-4"><b>'.$row['name'].'---'.$row['end'].'</b></label> ';
                        }
                        
                    } 
                    echo $output;    
                ?>
          </div>
        </div>

      </div>
      </div>

      <div class="text-light mx-2 col-md-12 text-center mt-5" style="position: relative;">
                  <hr class="my-2 bg-light" style="">
                  <span style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);"><b>What I DO</b></span>
      </div>

      <div class="col-md-6 mt-2">
             

             <div class="text-light mx-1 mt-2">
              <textarea class="form-control mt-4 text-light ket" id="txt" type="text" name="skill_1" style="height: 80px ; background-color: rgb(0,0,0,0.8); border-color: rgb(254,190,16);" readonly><?php echo $arrayData['skill_1'] ?></textarea>
             </div>

              <div class="text-light mx-1 mt-4">
              <textarea class="form-control mt-2 text-light ket" id="txt" type="text" name="skill_2" style="height: 80px ; background-color: rgb(0,0,0,0.8); border-color: rgb(254,190,16);" readonly><?php echo $arrayData['skill_2'] ?></textarea>
             </div>
            
      </div>
  
      <div class="col-md-6">
             
      <header class="text-light" style="text-decoration: underline; opacity: 0;"><h5> What I do </h5></header>

               <div class="text-light mx-1">
                <textarea class="form-control mt-2 text-light ket" id="txt" type="text" name="skill_3" style="height: 80px ; background-color: rgb(0,0,0,0.8); border-color: rgb(254,190,16);" readonly><?php echo $arrayData['skill_3'] ?></textarea>
               </div>

                <div class="text-light mx-1 mt-4">
                <textarea class="form-control mt-2 text-light ket" id="txt" type="text" name="skill_4" style="height: 80px ; background-color: rgb(0,0,0,0.8); border-color: rgb(254,190,16);" readonly><?php echo $arrayData['skill_4'] ?></textarea>
               </div>
        </div>

        <div class="text-light mx-2 col-md-12 text-center mt-5" style="position: relative;">
                  <hr class="my-2 bg-light" style="">
                  <span style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);"><b>Experience & skill</b></span>
      </div>

       <div class="col-md-12">
           <div class="text-light mx-1 mt-2 p-2" style="display:inline-block" >
              <textarea class="form-control mt-4 text-light ket" id="txt" type="text" name="skill" style="height: 80px ; width:470px; background-color: rgb(0,0,0,0.8); border-color: rgb(254,190,16);" readonly><?php echo $arrayData['skill'] ?></textarea>
             </div>

              <div class="text-light mx-1 mt-4" style="display:inline-block" >
              <textarea class="form-control mt-2 text-light ket" id="txt" type="text" name="experience" style="height: 80px ;width:470px; background-color: rgb(0,0,0,0.8); border-color: rgb(254,190,16);" readonly><?php echo $arrayData['experience'] ?></textarea>
             </div>
       </div>

        <div class="text-light mx-1 mt-5" style="opacity: 0;">
        </div>
      
     

 <!-- row -->

  

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