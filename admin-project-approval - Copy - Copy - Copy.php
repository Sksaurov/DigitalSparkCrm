<?php
include "config.php";
$output="";
session_start();
if (!isset($_SESSION['unique_id'])) {
 
  header("Location: admin-login.php");
  die();
}

$user_id = mysqli_real_escape_string($conn, $_GET['user_id']);
$project_id = mysqli_real_escape_string($conn, $_GET['project_id']);
$id = mysqli_real_escape_string($conn, $_GET['id']);

$client_id =  mysqli_query($conn, "SELECT * FROM details WHERE unique_id = '{$user_id}'");
$name = mysqli_fetch_assoc($client_id);

$web =  mysqli_query($conn, "SELECT * FROM web WHERE 1");
$web1 = mysqli_fetch_assoc($web);
$seo =  mysqli_query($conn, "SELECT * FROM seo WHERE 1");
$seo1 = mysqli_fetch_assoc($seo);
$ppc =  mysqli_query($conn, "SELECT * FROM ppc WHERE 1");
$ppc1 = mysqli_fetch_assoc($ppc);
$sm =  mysqli_query($conn, "SELECT * FROM s_marketing WHERE 1");
$sm1 = mysqli_fetch_assoc($sm);
$cm =  mysqli_query($conn, "SELECT * FROM c_marketing WHERE 1");
$cm1 = mysqli_fetch_assoc($cm);
$em =  mysqli_query($conn, "SELECT * FROM e_marketing WHERE 1");
$em1 = mysqli_fetch_assoc($em);


if($project_id == $web1['unique_id']){
    $web =  mysqli_query($conn, "SELECT * FROM web WHERE 1");
    $row = mysqli_fetch_assoc($web);
}elseif($project_id == $seo1['unique_id']){
    $seo =  mysqli_query($conn, "SELECT * FROM seo WHERE 1");
    $row = mysqli_fetch_assoc($seo);
}elseif($project_id == $ppc1['unique_id']){
    $ppc =  mysqli_query($conn, "SELECT * FROM ppc WHERE 1");
    $row = mysqli_fetch_assoc($ppc);
}elseif($project_id == $sm1['unique_id']){
    $sm =  mysqli_query($conn, "SELECT * FROM s_marketing WHERE 1");
    $row = mysqli_fetch_assoc($sm);
}elseif($project_id == $cm1['unique_id']){
    $cm =  mysqli_query($conn, "SELECT * FROM c_marketing WHERE 1");
    $row = mysqli_fetch_assoc($cm);
}elseif($project_id == $em1['unique_id']){
    $em =  mysqli_query($conn, "SELECT * FROM e_marketing WHERE 1");
    $row = mysqli_fetch_assoc($em);
}

if (isset($_POST['create'])) {
    $name = $_POST['name'];
    $status = $_POST['status'];
    $start = $_POST['start'];
    $end = $_POST['end'];
    $manager = explode(',', $_POST['manager']);
    $developer = explode(',', $_POST['developer']); // Split names by comma
    $client = explode(',', $_POST['client']); // Split names by comma
    $text = explode(',', $_POST['text']);
    $amount = $_POST['amount'];
    $code = $project_id;

    // manager Area
    $manager1 = mysqli_real_escape_string($conn, trim($manager[0]));
    $manager_id = mysqli_real_escape_string($conn, trim($manager[1]));

    // developer area
    $dev1 = mysqli_real_escape_string($conn, trim($developer[0])); // 1st name
    $dev_id1 = mysqli_real_escape_string($conn, trim($developer[1])); // 1st id

    $dev2 = mysqli_real_escape_string($conn, trim($developer[2])); // 2nd name
    $dev_id2 = mysqli_real_escape_string($conn, trim($developer[3])); // 2nd id

    $dev3 = mysqli_real_escape_string($conn, trim($developer[4]));
    $dev_id3 = mysqli_real_escape_string($conn, trim($developer[5]));

    // client Area
    $client_name = mysqli_real_escape_string($conn, trim($client[0])); // 1st name
    $client_id = mysqli_real_escape_string($conn, trim($client[1])); // 1st id

    // text Area
    $txt1 = mysqli_real_escape_string($conn, trim($text[0])); // 1st name
    $txt2 = mysqli_real_escape_string($conn, trim($text[1])); // 1st id

    $txt3 = mysqli_real_escape_string($conn, trim($text[2])); // 2nd name
    $txt4 = mysqli_real_escape_string($conn, trim($text[3])); // 2nd id

    $txt5 = mysqli_real_escape_string($conn, trim($text[4]));
    $txt6 = mysqli_real_escape_string($conn, trim($text[5]));

    $txt7 = mysqli_real_escape_string($conn, trim($text[6]));

    $sql2 = "INSERT INTO project (name, status, start, end, manager, manager_id, unique_id, amount, developer_1, developer_2, developer_3, developer_1_id, developer_2_id, developer_3_id,
    des_1, des_2, des_3, des_4, des_5, des_6, des_7, client_name, client_id) 
    VALUES ('{$name}', '{$status}', '{$start}', '{$end}', '{$manager1}', '{$manager_id}', '{$code}', '{$amount}', '{$dev1}', '{$dev2}', '{$dev3}', '{$dev_id1}', '{$dev_id2}', '{$dev_id3}',
    '{$txt1}', '{$txt2}', '{$txt3}', '{$txt4}', '{$txt5}', '{$txt6}', '{$txt7}', '{$client_name}', '{$client_id}')";

    $result2 = mysqli_query($conn, $sql2);

    // $query = mysqli_query($conn, "UPDATE details SET project_id='$code', amount = '$amount' WHERE unique_id='{$client_id}'");
    // $sql2 = mysqli_query($conn, "INSERT INTO pay_info (name, project_id, project_name, start, end, des_1, des_2, des_3, des_4, des_5, des_6, des_7, unique_id) 
    // VALUES ('{$client_name}', '{$code}', '{$name}', '{$start}', '{$end}', '{$txt1}', '{$txt2}', '{$txt3}', '{$txt4}', '{$txt5}', '{$txt6}', '{$txt7}', '{$client_id}')");

   
   

    $deleteQuery = "DELETE FROM `approval` WHERE id = '$id'";
    $done = mysqli_query($conn, $deleteQuery);
    echo '<script>alert("Approval Done!");
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
    <div class="container-fluid">
        <header class="" style="width: 1300px; display: flex;background-color: rgb(0,0,0, 0.7); border-color:rgb(254,190,16); margin-left: -20px">
            <a href="admin-page.php" style="text-decoration: none;"> <h6 class="mx-3 mt-2 text-warning"
                    style="font-family: 'Salsa'; "><b>CRM</b></h6></a>
                    <h5 class="mx-5 text-light"><b>Project Approval</b></h5>
        </header>

        <div class="card mt-2 col-md-10 text-light" style="margin-left: 100px; height: 595px; margin-top: -27px; background-color: rgb(0,0,0, 0.7); border-color:rgb(254,190,16); border-radius: 20px;">
            <form method="post">
                <div class="row">
                    <div class="col-md-6">
                        <label for="name"><b>Name</b></label>
                        <input type="text" name="name" class="form-control text-warning" style="background-color: rgb(0,0,0, 0.7); border-color:rgb(254,190,16);" id="name" value="<?php echo $row['name'] ?>" readOnly>
                    </div>
                    <div class="col-md-6">
                        <label for="status"><b>Status</b></label>
                        <select class="form-select text-warning" name="status" style="background-color: rgb(0,0,0, 0.7); border-color:rgb(254,190,16);" id="status">
                            <option>Pending</option>
                            <option>On-Hold</option>
                            <option>Processing</option>
                            <option>Done</option>
                        </select>
                    </div>
                    <div class="col-md-6 mt-1">
                        <label for="start"><b>Start-Date</b></label>
                        <input class="form-control text-warning" name="start" style="background-color: rgb(0,0,0, 0.7); border-color:rgb(254,190,16);" type="date" id="start">
                    </div>
                    <div class="col-md-6 mt-1">
                        <label for="end"><b>End-Date</b></label>
                        <input class="form-control text-warning" name="end" style="background-color: rgb(0,0,0, 0.7); border-color:rgb(254,190,16);" type="date" id="end">
                    </div>
                    <div class="col-md-6 mt-1">
                        <label for="manager"><b>Project-Manager</b></label>
                        <select class="form-select text-warning" name="manager" style="background-color: rgb(0,0,0, 0.7); border-color:rgb(254,190,16);" id="manager">
                        <?php
                           $query = "SELECT * FROM `developer` WHERE 1";
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

                        <label for="client"><b>Client</b></label>
                        <?php 
                        $output2 = "";
                        $output2 .= '<input class="form-control text-warning" name="client" id="client" style="background-color: rgb(0,0,0, 0.7); border-color:rgb(254,190,16);" value="' . $name['name'] . ',' . $user_id. '" readOnly>';
                        echo $output2;
                    ?>

                    </div>
                    <div class="col-md-6 mt-1">
                        <label for="developer"><b>Project-Developer</b></label>
                        <textarea class="form-control select text-warning" name="developer" id="developer" style="width: 100%; height: 30px;background-color: rgb(0,0,0, 0.7); border-color:rgb(254,190,16);"></textarea>
                        <select class="names text-warning"  style="display:none; margin-top: 0px; margin-left: 0px; width: 93%; z-index: 2; position: absolute;background-color: rgb(0,0,0, 0.7); border-color:rgb(254,190,16);" multiple id="option">
                            
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
                        <input type="text" name="amount" class="form-control text-warning" style="background-color: rgb(0,0,0, 0.7); border-color:rgb(254,190,16);" id="name"
                            value="<?php echo $row['amount']?>" readOnly>
                    </div>
                    <div class="col-md-12 mt-1">
                        <label for="text"><b>Description</b></label>
                        <textarea type="text" name="text" class="form-control text-warning" style="height: 200px;background-color: rgb(0,0,0, 0.7); border-color:rgb(254,190,16);" readOnly>
<?php
              $output .= $row['des_1'] . "\n" .
                          $row['des_2'] . "\n" .
                          $row['des_3'] . "\n" .
                          $row['des_4'] . "\n" .
                          $row['des_5'] . "\n" .
                          $row['des_6'] . "\n" .
                          $row['des_7'];

          echo $output;
    ?>
                    
                    </textarea>
                    </div>
                    <div class="col-md-12 mt-3">
                        <input type="submit" name="create" class="btn btn-outline-warning" value="Create" readOnly>
                        <a href="admin-page.php" type="button" class="btn btn-warning" data-bs-dismiss="modal">Cancel</a>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script>

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
    </script>


</body>

</html>
