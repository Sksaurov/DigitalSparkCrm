
<?php 
  session_start();
  include "config.php";

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <style>
         .client-search a .status-dot .button{
        font-size: 12px;
        background-color: green;
        }

        .client-search a .status-dot .button.offline{
        background-color: white;
        } 
        </style>
</head>
<body>
   <div class="client-search">
   <?php
   // Search query
if (isset($_GET['search'])) {
    $search = $_GET['search'];

    $sql = "SELECT * FROM details WHERE name LIKE '%$search%' AND status <> 'suspend'
    ORDER BY id DESC";
    $output = "";
    $query = mysqli_query($conn, $sql);

    if(mysqli_num_rows($query) > 0){

        $outgoing_id = $_SESSION['unique_id'];
        $output = "";
        $function = "client";
        if(mysqli_num_rows($query) == 0){
        $output .= "No users are available to chat";
        }elseif(mysqli_num_rows($query) > 0){

          while($row = mysqli_fetch_assoc($query)){
            $sql2 = "SELECT * FROM messages WHERE (incoming_msg_id = {$row['unique_id']}
                    OR outgoing_msg_id = {$row['unique_id']}) AND (outgoing_msg_id = {$outgoing_id} 
                    OR incoming_msg_id = {$outgoing_id}) ORDER BY msg_id DESC LIMIT 1";
            $query2 = mysqli_query($conn, $sql2);
            $row2 = mysqli_fetch_assoc($query2);
            (mysqli_num_rows($query2) > 0) ? $result = $row2['msg'] : $result ="No message available";
            (strlen($result) > 28) ? $msg =  substr($result, 0, 28) . '...' : $msg = $result;
            if(isset($row2['outgoing_msg_id'])){
                ($outgoing_id == $row2['outgoing_msg_id']) ? $you = "<b style='color: rgb(254,190,16);'>You:  </b>" : $you = "";
            }else{
                $you = "";
            }
            ($row['active_status'] == "Offline") ? $offline = "offline" : $offline = "";
            ($outgoing_id == $row['unique_id']) ? $hid_me = "hide" : $hid_me = "";
      
           
            
            $output .= '<div style=" display: flex; position: relative;align-items: center; cursor: pointer;
            padding-bottom: 0px; border-bottom: 1px solid #e6e6e6; justify-content: space-between; margin-bottom: 15px;
            padding-right: 15px; border-bottom-color: #f1f1f1; text-decoration: none; margin-left: 0px; margin-top: 5px; ">

                        <div class="content" style="display: flex; align-items: center;">
                        <img src="uploaded_img/'. $row['image'] .'" alt="" style="object-fit: cover; border-radius: 50%; height: 40px; width: 40px;">
                        <div class="details" style=" color: #fff; margin-left: 20px;">

                        <a href="admin-client-chat.php?user_id='. $row['unique_id'] .'" style="text-decoration:none;"> 
                        <span class="" style="color: white; font-size: 17px; font-family: bold;"><b>'. $row['name'].'</b></a></span>
                        <p style=" color: white; font-size: 14px;"><b>'. $you . $msg .'</b></p>
                        </div>
                        </div>
                        <div class="status-dot d-flex" style="position: relative; margin-right: -5px;">
                        <button class="button '. $offline .'" style="width: 55px; height:20px; border-radius: 10px; border: none;"><p class="justify-content-center align-item-center"
                         style="margin-left: -3px; margin-top: -2px;  "><b>'.$row['active_status'].'</b></p></button>
                        <p class="date " style=" padding: 0px 200px; color : white; font-size: 13px;  "><b>'. $row['join_date'] .'</b>
                        </p>
                        <div class="" style="">
                        <a href="ban-list.php?user_id='. $row['unique_id'] .'&action='.$function.'" class="delete-button"  type="submit" style="border:none; color: white; background:transparent; font-size: 14px;">
                        <i class="fa fa-trash"></i></a>
                        </div> 
                        </div>
                    </div>';
        }

        }
       
         
        
    }else{
        $output .= '<a class="text-dark alert alert-danger" style="">No user found related to your search term</a>';
    }

    echo $output;
   
}
   
   
   
   ?>
  </div>  
</body>
</html>


