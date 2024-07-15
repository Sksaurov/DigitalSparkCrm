<?php 
session_start();
include "config.php";
$search = $_GET['search'];

$sql = "SELECT * FROM suspend WHERE suspend_date LIKE '%$search%' ORDER BY id DESC";
$output = "";
$query = mysqli_query($conn, $sql);

if(mysqli_num_rows($query) > 0){

    $outgoing_id = $_SESSION['unique_id'];
    $output = "";

    if(mysqli_num_rows($query) == 0){
        $output .= "No Unsuspend User.";

        }elseif(mysqli_num_rows($query) > 0){
            while($row = mysqli_fetch_assoc($query)){
      
                $output .= '<div style="display: flex; position: relative;align-items: center; padding-bottom: 0px; border-bottom: 1px solid #e6e6e6;
                 justify-content: space-between; margin-bottom: 15px; padding-right: 15px; border-bottom-color: #f1f1f1; text-decoration: none; margin-left: px; margin-top: 5px;">
    
                    <div class="" style="color: #fff; margin-left: 0px; margin-bottom: 20px;">
                        <span class=""style="color: white; font-size: 14px;"><b>'. $row['name'].'</b>
                        </span>
                     
                    </div>
    
                
                <div class="status-dot d-flex" style="position: relative; margin-right: -5px;">
                   <div class="function" style="position: absolute; margin-left:-650px;">
                    <p class="date" style="padding: 0px 50px; color: white; font-size: 13px;"><b>'. $row['email'] .'</b></p>
                    </div>
                    <div class="">
                    <p class="justify-content-center align-item-center text-light" style="font-size: 14px; margin-left: -370px;"><b>'. $row['function'].'</b></p>
                    </div>
                    <div class="">
                    <div class="" style="  margin-left:-175px; font-size: 13px;">
                        <p class="justify-content-center align-item-center text-light" style=""><b>'. $row['date'].'</b></p>
                    </div>
                    </div>
                    <div class="">
                    <p class="date" style="padding: 0px 20px; color: white; font-size: 13px; margin-right: 40px;"><b>'. $row['suspend_date'] .'</b></p>
                    </div>
                    <div class="" style="">
                            <a href="ban-list.php?user_id='. $row['unique_id'] .'" class="delete-button"  type="submit" style="border:none;
                             color: white; background:transparent; font-size: 16px;"><i class="fa fa-history"></i></a>
                            </div> 
                           </div>
            </div>';

        
            }
     
         
        }
        echo $output;
}else{
    $output .= '<a class="text-warning " style="text-decoration: none; margin-left:300px;">No user found related to your search term</a>';
    echo $output;
}



?>