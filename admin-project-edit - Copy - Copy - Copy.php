<?php 
  include "config.php";
  $output="";
  session_start();
  if (!isset($_SESSION['unique_id'])) {
    header("Location: admin-login.php");
    die();
  }
  $id = mysqli_real_escape_string($conn, $_GET['id']);
  $query = mysqli_query($conn, "SELECT * FROM project WHERE id = '$id'");
  $projectData = mysqli_fetch_assoc($query); // Fetch the project data


   if(isset($_POST["update"])) {

    $end = $_POST['end'];
    $amount = $_POST['amount'];
    $text =  explode(',',$_POST['text']);
    $developer_1 =  explode(',', $_POST['developer_1']); // Split names by comma
    $developer_2 =  explode(',', $_POST['developer_2']); // Split names by comma
    $developer_3 =  explode(',', $_POST['developer_3']); // Split names by comma

    $dev1 = mysqli_real_escape_string($conn, trim($developer_1[0]));//1st name
    $dev_id1 = mysqli_real_escape_string($conn, trim($developer_1[1]));//1st id

    $dev2 = mysqli_real_escape_string($conn, trim($developer_2[0]));//1st name
    $dev_id2 = mysqli_real_escape_string($conn, trim($developer_2[1]));//1st id

    $dev3 = mysqli_real_escape_string($conn, trim($developer_3[0]));//1st name
    $dev_id3 = mysqli_real_escape_string($conn, trim($developer_3[1]));//1st id


    //text Area
    $txt1 = mysqli_real_escape_string($conn, trim($text[0]));//1st name
    $txt2 = mysqli_real_escape_string($conn, trim($text[1]));//1st id

    $txt3 = mysqli_real_escape_string($conn, trim($text[2]));//2nd name
    $txt4 = mysqli_real_escape_string($conn, trim($text[3]));//2nd id

    $txt5 = mysqli_real_escape_string($conn, trim($text[4]));
    $txt6 = mysqli_real_escape_string($conn, trim($text[5]));

    $txt7 = mysqli_real_escape_string($conn, trim($text[6]));


    $query = mysqli_query($conn, "UPDATE project SET end ='$end' , amount = '$amount' , developer_1 = '$dev1' , developer_1_id = '$dev_id1' , developer_2 = '$dev2' ,
    developer_2_id = '$dev_id2' , developer_3 = '$dev3' , developer_3_id = '$dev_id3' , des_1 = '$txt1' , des_2 = '$txt2' , des_3 = '$txt3' , des_4 = '$txt4' , des_5 = '$txt5' ,
    des_6 = '$txt6' , des_7 = '$txt7'  WHERE id='{$id}'");

        echo '<script> alert("Successfully Updated.");
        window.location.href = "admin-page.php";
        </script>';

   }
  

  

    ?>
    <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="bootstrap/js/bootstrap.bundle.min.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" />

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href='https://fonts.googleapis.com/css?family=Salsa' rel='stylesheet'>
</head>

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
</style>

<body>

    <!-- Project Form -->
    <header class="text-light" style=" display: flex; background-color: rgb(0,0,0, 0.7);">
      <a href="admin-page.php" style="text-decoration: none;"> <h6 class="mt-2 mx-2 text-warning"
              style="font-family: 'Salsa'; "><b>CRM</b></h6></a>
              <h5 class="mt-2 mx-5" style="font-family: 'Salsa'; "><b>Edit project</b></h5>
  </header>

    <div class="container-fluid" style="margin-top: 40px;">
        <div class="card col-md-10 text-light" style="height: 590px;margin-left: 100px; margin-top: -27px; border-radius: 10px; background-color: rgb(0,0,0, 0.7); border-color:rgb(254,190,16);">
            <form method="post">
                <div class="row">
                    <div class="col-md-6 mt-3">
                        <label for="name"><b>Name</b></label>
                        <input type="text" name="name" class="form-control text-warning" style="background-color: rgb(0,0,0, 0.7); border-color:rgb(254,190,16);" id="name" value="<?php echo $projectData['name'] ?>" readOnly>
                    </div>
                    
                    <div class="col-md-6 mt-3">
                        <label for="end"><b>End-Date</b></label>
                        <input class="form-control text-warning" name="end" type="date" style="background-color: rgb(0,0,0, 0.7); border-color:rgb(254,190,16);" id="end" value="<?php echo $projectData['end'] ?>" >
                    </div>
                    <div class="col-md-6 mt-3">
                      <label for="developer"><b>Project-Developer-1</b></label>
                      <textarea class="form-control text-warning select_1" name="developer_1" id="developer" style="width: 100%; height: 30px; background-color: rgb(0,0,0, 0.7); border-color:rgb(254,190,16);">
         <?php echo $projectData['developer_1'] ?>,
        <?php echo $projectData['developer_1_id'] ?>,
                    </textarea>
                      <select class="names_1 text-warning"  style="display:none; margin-top: 0px; margin-left: 0px; width: 93%; z-index: 2; position: absolute; background-color: rgb(0,0,0, 0.7); border-color:rgb(254,190,16);" multiple id="option_1">
                          
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

                    </div>
                    <div class="col-md-6 mt-3">
                        <label for="developer"><b>Project-Developer-2</b></label>
                        <textarea class="form-control text-warning select_2" name="developer_2" id="developer" style="width: 100%; height: 30px; background-color: rgb(0,0,0, 0.7); border-color:rgb(254,190,16);">
            <?php echo $projectData['developer_2'] ?>,
        <?php echo $projectData['developer_2_id'] ?>,  
                    </textarea>
                        <select class="names_2 text-warning"  style="display:none; margin-top: 0px; margin-left: 0px; width: 93%; z-index: 2; position: absolute; background-color: rgb(0,0,0, 0.7); border-color:rgb(254,190,16);" multiple id="option_2">
                            
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
                        <input type="text" name="amount" class="form-control text-warning" id="name" style="background-color: rgb(0,0,0, 0.7); border-color:rgb(254,190,16);"
                            value="<?php echo $projectData['amount']?>" >
                    </div>
                    <div class="col-md-6" style="margin-top: -70px;;">
                      <label for="developer"><b>Project-Developer-3</b></label>
                      <textarea class="form-control text-warning select_3" name="developer_3" id="developer" style="width: 100%; height: 30px; background-color: rgb(0,0,0, 0.7); border-color:rgb(254,190,16);">
        <?php echo $projectData['developer_3'] ?>,
        <?php echo $projectData['developer_3_id'] ?>,
                    
                    </textarea>
                      <select class="names_3 text-warning"  style="display:none; margin-top: 0px; margin-left: 0px; width: 93%; z-index: 2; position: absolute; background-color: rgb(0,0,0, 0.7); border-color:rgb(254,190,16);" multiple id="option_3">
                          
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
                       </div>


                    <div class="col-md-12 mt-3">
                        <label for="text"><b>Description</b></label>
                        <textarea type="text" name="text" class="form-control text-warning" style="height: 240px; background-color: rgb(0,0,0, 0.7); border-color:rgb(254,190,16);" >
<?php
              $output .= $projectData['des_1'] . ",\n" .
                          $projectData['des_2'] . ",\n" .
                          $projectData['des_3'] . ",\n" .
                          $projectData['des_4'] . ",\n" .
                          $projectData['des_5'] . ",\n" .
                          $projectData['des_6'] . ",\n" .
                          $projectData['des_7'];

          echo $output;
    ?>
                    
                    </textarea>
                    </div>
                    <div class="col-md-12 mt-3">
                        <input type="submit" name="update" class="btn btn-outline-warning" value="Update" readOnly>
                        <a href="admin-page.php" type="button" class="btn bg-warning" data-bs-dismiss="modal">Cancel</a>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script>

          //Developer Handle
          const select = document.querySelector(".select_1");
            const dropdown = document.querySelector(".names_1");
            

            select.addEventListener("click", () => {
                if (dropdown.style.display === 'none') {
                    dropdown.style.display = 'block';
                } else {
                    dropdown.style.display = 'none';
                }
            });

            const select_2 = document.querySelector(".select_2");
            const dropdown_2 = document.querySelector(".names_2");
            

            select_2.addEventListener("click", () => {
                if (dropdown_2.style.display === 'none') {
                    dropdown_2.style.display = 'block';
                } else {
                    dropdown_2.style.display = 'none';
                }
            });

            const select_3 = document.querySelector(".select_3");
            const dropdown_3 = document.querySelector(".names_3");
            

            select_3.addEventListener("click", () => {
                if (dropdown_3.style.display === 'none') {
                    dropdown_3.style.display = 'block';
                } else {
                    dropdown_3.style.display = 'none';
                }
            });

        //create project -> developer 
        $(document).ready(function () {
            $("#option_1").on('change', function () {
                // Get all selected values
                var selectedValues = $(this).val();

                // Update the input field with all selected values
                $(".select_1").val(selectedValues.join(',\n'));
            });
        });

          //create project -> developer 
          $(document).ready(function () {
            $("#option_2").on('change', function () {
                // Get all selected values
                var selectedValues = $(this).val();

                // Update the input field with all selected values
                $(".select_2").val(selectedValues.join(',\n'));
            });
        });

          //create project -> developer 
          $(document).ready(function () {
            $("#option_3").on('change', function () {
                // Get all selected values
                var selectedValues = $(this).val();

                // Update the input field with all selected values
                $(".select_3").val(selectedValues.join(',\n'));
            });
        });
    </script>


</body>

</html>