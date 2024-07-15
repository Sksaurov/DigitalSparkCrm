<?php
include 'config.php';
$output="";
session_start();
if (!isset($_SESSION['unique_id'])) {
 
  header("Location: admin-login.php");
  die();
}
?> 



<!-- Contact Part -->
<div id="cont" class="container tab-pane fade" style="margin-left:8%" >
                    <div class="card d-flex" style="margin-left: 15px; position: absolute; z-index: 3;
                        background-color: rgb(254,190,16); width: 1000px; height: 80px; border-radius: 10px; margin-top:-42px;">
                        <a href="admin-page.php" class="back-icon text-dark mx-3 py-3" style="text-decoration: none;font-size: 25px;">Contact Table</a>
                        </div>

              <div class="wrapper" style="width: 1030px; margin-top:88px; 
              border-radius: 16px; box-shadow: 0px 5px 5px 5px rgb(254,190,16);  background-color: rgb(0,0,0,0.5); z-index: 2;">
                  
                <section class="users" style="padding: 0px 20px;">
                  <header style=" display: flex; align-items: center; padding-bottom: 20px; border-bottom: 1px solid #e6e6e6; justify-content: space-between;">
                    <div class="content" style="display: flex; align-items: center; color: #fff; margin-left: 20px;">
                      <?php 
                        $sql = mysqli_query($conn, "SELECT * FROM contact WHERE 1");
                        if(mysqli_num_rows($sql) > 0){
                          $row = mysqli_fetch_assoc($sql);
                        }
                      ?>
                    </div>

                  </header>
                  <div class="dev-search" style="  margin: 20px 0; display: flex; position: relative; align-items: center; justify-content: space-between;">
                  </div>
                  <div class="d-flex mt-3" style="font-family: Impact, Haettenschweiler, 'Arial Narrow Bold', sans-serif;"> 
                          <!-- <p class="text-light" style="margin-left: 0px;">Name</p>
                          <p class="text-light px-5" style="margin-left: 300px;">Email</p>
                          <p class="text-light px-5" style="margin-left: 250px;">Message</p> -->
                      </div>
                  <div class="contact-list" id="dev-search-results" style=" max-height: 440px; overflow-y: auto;">
                    <?php    
                    $outgoing_id = $_SESSION['unique_id'];
                    $sql = "SELECT * FROM contact WHERE 1";
                    $query = mysqli_query($conn, $sql);
                    $output = "";
                    if(mysqli_num_rows($query) == 0){
                    $output .= "Empty Database....";
                    }elseif(mysqli_num_rows($query) > 0){

                      while($row = mysqli_fetch_assoc($query)){

                        $output .= '<div class="project-card2" style="display: flex; position: relative; align-items: center; padding-bottom: 15px; border-bottom: 1px solid #e6e6e6; justify-content: space-between; margin-bottom: 15px; padding-right: 15px; border-bottom-color: #f1f1f1; text-decoration: none; margin-left: 0; margin-top: 5px;">

                        <div class="content2" style="width: 170px; display: flex; align-items: center;">
                            <div class="details" style="color: #fff; margin-left: 0;">
                                <span class="name" style="color: white; font-size: 15px; font-family: bold;"><b>'. $row['name'].'</b></span>
                            </div>
                        </div>

                        <div class="email style="width: 25px; margin-right: 30px; align-items: right;  ">
                            <p class="email" style="color: white; font-size: 13px; margin-bottom: 5px; margin-left: -200px;"><b>'. $row['email'] .'</b></p>
                            </div>

                            <p class="message" style="width: 300px; color: white; font-size: 13px; margin-bottom: 5px; margin-left: -200px; "><b>'. $row['message'] .'</b></p>
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
