<?php 
  include "config.php";
  $output="";
  session_start();
  if (!isset($_SESSION['unique_id'])) {
    header("Location: admin-login.php");
    die();
  }
  $project_id = mysqli_real_escape_string($conn, $_GET['user_id']);
  $manager_id = mysqli_real_escape_string($conn, $_GET['manager']);
  $query = mysqli_query($conn, "SELECT * FROM project WHERE unique_id = '$project_id'");
  $projectData = mysqli_fetch_assoc($query); // Fetch the project data

  $sql1 = mysqli_query($conn, "SELECT * FROM file WHERE project_id = '$project_id' and manager_id = '$manager_id'");
  $fileData = mysqli_fetch_assoc($sql1); // Fetch the project data

  $sql = mysqli_query($conn, "SELECT * FROM project WHERE 1");
 
  

  while($row = mysqli_fetch_assoc($sql)){
    
  $dev1_id = mysqli_real_escape_string($conn, $_GET['dev1']);
  $dev2_id = mysqli_real_escape_string($conn, $_GET['dev2']);
  $dev3_id = mysqli_real_escape_string($conn, $_GET['dev3']);
  $manager_id = mysqli_real_escape_string($conn, $_GET['manager']);

  $sql2 = mysqli_query($conn, "SELECT * FROM developer WHERE unique_id = '$dev1_id'");
  $dev1 = mysqli_fetch_assoc($sql2); 
  $sql3 = mysqli_query($conn, "SELECT * FROM developer WHERE unique_id = '$dev2_id'");
  $dev2 = mysqli_fetch_assoc($sql3); 
  $sql4 = mysqli_query($conn, "SELECT * FROM developer WHERE unique_id = '$dev3_id'");
  $dev3 = mysqli_fetch_assoc($sql4); 
  $sql5 = mysqli_query($conn, "SELECT * FROM manager WHERE unique_id = '$manager_id'");
  $manager = mysqli_fetch_assoc($sql5); 
  }

    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
  <title>DigitalSpark CRM</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> 
  <script src="bootstrap/js/bootstrap.bundle.min.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>  
  
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css"/>
  
  
  <!-- Bootstrap CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<!-- Font Links -->
<link href='https://fonts.googleapis.com/css?family=Salsa' rel='stylesheet'>
<link href='https://fonts.googleapis.com/css?family=Spicy Rice' rel='stylesheet'>
<link href='https://fonts.googleapis.com/css?family=Squada One' rel='stylesheet'>
<link href='https://fonts.googleapis.com/css?family=Suez One' rel='stylesheet'>
<link href='https://fonts.googleapis.com/css?family=Timmana' rel='stylesheet'>

 <style>
      body{
            
            align-items: center;
            justify-content: center;
            background: url('images/view-bg.jpg') no-repeat center center fixed;
            -webkit-background-size: cover;
            -moz-background-size: cover;
            -o-background-size: cover;
            background-size: cover; 
  
        }

        body::-webkit-scrollbar { 
        display: none; 
        }
  </style>

   
  </head>
  
    <body>
      <!-- Your HTML content goes here -->

      <header class="text-light" style="height: 40px; display: flex; background-color: rgb(0,0,0, 0.9);">
       <a href="admin-page.php" style="text-decoration: none;"> <h6 class="mt-2 mx-1 text-warning" style="font-family: 'Salsa'; "><b>CRM</b></h6></a>
        <h4 class="mt-1" style="font-family: 'Salsa'; margin-left: 40px;">View Project</h4>
      </header>

      <div class="container-fluid text-light">
        <div class="card col-md-12 mt-2 text-light" style="height: 300px; border-radius: 10px; background-color: rgb(0,0,0, 0.7); border-color: rgb(254,190,16); ">
          <div class="row">
            <div class="col-md-7">
              <div class="container" style="font-family: 'Timmana'; font-size: 1.1rem;">
                <label class="mt-2 text-warning" style="text-decoration: underline;"><b>Project Name</b></label><br>
                <p class=""><?php echo $projectData['name']?></p>
                <div class="" style="margin-top: -10px;">
                  <label class="text-warning" style="text-decoration: underline;"><b>Description</b></label>
             <textarea class="form-control text-light" style="height: 190px; border-radius: 10px; margin-top: -10px; background-color: rgb(0,0,0, 0.7); border-color:rgb(254,190,16);" readonly>
<?php
              $output .= $projectData['des_1'] . "\n" .
                          $projectData['des_2'] . "\n" .
                          $projectData['des_3'] . "\n" .
                          $projectData['des_4'] . "\n" .
                          $projectData['des_5'] . "\n" .
                          $projectData['des_6'] . "\n" .
                          $projectData['des_7'];

          echo $output;
    ?>
</textarea>

                </div>
              </div>
            </div>
            <div class="col-md-5" style="font-family: 'Timmana'; font-size: 1.1rem;">
            <div class="container mt-1">
            
                  
            
              <div class="">
                <label class="text-warning" style="text-decoration:underline;"><b>Start Date</b></label>
                <p class="" style=""><?php echo $projectData['start']?></p>
              </div>
              <div class="">
                <label class="text-warning" style="text-decoration:underline;"><b>End Date</b></label>
                <p class="" style=""><?php echo $projectData['end']?></p>
              </div>
              <div class="">
                <label class="text-warning" style="text-decoration:underline;"><b>Status</b></label>
                <p class="" style=""><?php echo $projectData['status']?></p>
              </div>
              <div class="">
                <label class="text-warning" style="text-decoration:underline;"><b>Client-ID</b></label>
                <p class="" style=""><?php echo $projectData['client_id']?></p>
              </div>
             </div>
             <div class="container" style=" margin-top: -350px;">
              <div class="" style="margin-left: 220px;">
                <label class="text-warning" style="text-decoration:underline; margin-left: 40px;"><b>Project Manager</b></label>
                <img src="uploaded_img/<?php echo $manager['profile']; ?>" alt="" style="object-fit: cover; border-radius: 50%; height: 140px; width: 140px;
                margin-top: 160px; margin-left: -130px;">
                <p class="mt-1" style="margin-left: 30px;"><?php echo $projectData['manager']?></p>
              </div>
            </div>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-5">
          <div class="card mt-2 text-light" style="width: 550px; height: 265px; border-radius: 10px; margin-left: 15px; background-color: rgb(0,0,0, 0.8); border-color: rgb(254,190,16); ">
          <header>
          <h5 class="text-warning mx-1" style="width: 200px; font-family: 'Suez One';">Developers</h5>
         </hearder>
         <div class="container mt-3" style="display: flex; font-family: 'Timmana'; font-size: 1.1rem; ">
          <div class="" style="margin-left: 50px;" >
          <img src="uploaded_img/<?php echo $dev1['d_profile']; ?>" alt="" style="object-fit: cover; border-radius: 50%; height: 70px; width: 70px; margin-left: 20px;">
            <p style="margin-left: -20px;"><?php echo $projectData['developer_1']?></p>
            </div>
            <div class="" style="margin-left: 110px;" >
            <img src="uploaded_img/<?php echo $dev2['d_profile']; ?>" alt="" style="object-fit: cover; border-radius: 50%; height: 70px; width: 70px; margin-left: 35px;">
            <p><?php echo $projectData['developer_2']?></p>
            </div>
         </div>
         <div class="">
            <img src="uploaded_img/<?php echo $dev3['d_profile']; ?>" alt="" style="object-fit: cover; border-radius: 50%; height: 70px; width: 70px; margin-left: 215px;">
            <p style="margin-left: 190px; font-family: 'Timmana'; font-size: 1.1rem; "><?php echo $projectData['developer_3']?></p>
           </div> 
          </div>
        </div>
        <div class="col-5">
          <div class="card mt-2 text-light" style="width: 693px; height: 265px; border-radius: 10px; margin-left: 45px; background-color: rgb(0,0,0, 0.8); border-color:  rgb(254,190,16); ">
       
            <?php
            
              $per = "";
              $output = "";

              // Check conditions using elseif
              if ($projectData['status'] == "Pending") {
                  $per = "25";
              } elseif ($projectData['status'] == "On-Hold") {
                  $per = "50";
              } elseif ($projectData['status'] == "Processing") {
                  $per = "75";
              } elseif ($projectData['status'] == "Done") {
                  $per = "100";
              }
              ?>
                <div  style="display: flex;">
                <header>
                  <h5 class="text-warning mx-1" style="width: 200px; font-family: 'Suez One';">Working Activity</h5>
            </header>
                <div class="label" style="margin-top: 90px; margin-left: -100px; font-family: 'Suez One';">
                 <div class="card" style="width: 20px; height: 20px; border-radius: 20px; background-color: deeppink;">
                 <p class="text-light" style="width: 300px; margin-left: 25px; margin-top: -3px;"><?php echo $projectData['developer_1']?></p>
            </div>
            <div class="card mt-2" style="width: 20px; height: 20px; border-radius: 20px; background-color: blue;">
                 <p class="text-light" style="width: 280px; margin-left: 25px; margin-top: -3px;"><?php echo $projectData['developer_2']?></p>
            </div>
            <div class="card mt-2" style="width: 20px; height: 20px; border-radius: 20px; background-color: yellow;">
                 <p class="text-light" style="width: 300px; margin-left: 25px; margin-top: -3px;"><?php echo $projectData['developer_3']?></p>
            </div>
          </div>
          <div class="pie">
               <canvas id="myPieChart" style="margin-left: 200px; margin-top: 5px; height: 128px;"></canvas>
            </div>
               </div>
               <script>
    const data = {
        labels: [
            '<?php echo $projectData['developer_1']?>',
            '<?php echo $projectData['developer_2']?>',
            '<?php echo $projectData['developer_3']?>'
        ],
        datasets: [{
            label: '',
            data: [
              <?php echo $projectData['dev_1_pog']?>,
              <?php echo $projectData['dev_2_pog']?>,
              <?php echo $projectData['dev_3_pog']?>
            ],
            backgroundColor: [
                'rgb(255, 99, 132)',
                'rgb(54, 162, 235)',
                'rgb(255, 205, 86)'
            ],
            hoverOffset: 4
        }]
    };

    const config = {
        type: 'doughnut',
        data: data,
        options: {
            plugins: {
                legend: {
                    display: false // Hide the legend labels
                }
            }
        }
      
    };

    var myChart = new Chart(
        document.getElementById('myPieChart'),
        config
    );
</script>

       
         
          </div>
        </div>
      </div>
    </div>

    <!-- Include your additional HTML and JS here -->
  
    </body>
    </html>


