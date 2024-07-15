<?php
include 'config.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<style>
    .container input{
        border-radius:5px;
        background-color: rgb(209, 207, 215);
    }
    .container button{
        margin-top: 13px;
    }
    </style>
</head>
<body>
   <div class="container mt-5">
    <form method="post">
        <input type="text" placeholder="search data" name="search">
        <button class="btn btn-dark btn-sm"  name="submit"> search</button>

    </form>
    <div class="container">
        <table class="table">
         <?php
         if(isset($_POST['submit'])){
            $search=$_POST['search'];
            $sql="SELECT * FROM `developer` WHERE d_name='$search'";
            $result=mysqli_query($conn,$sql);
            if($result){
                if(mysqli_num_rows($result)>0){
                    echo '<thead>
                    <tr>
                    <th>Id</th>
                    <th>Name</th>
                    <th>Email</th>
                    </tr>
                    </thead>
                    ';
                    while($row= mysqli_fetch_assoc($result)){
                    echo '
                    <tbody>
                    <tr>
                    <td>'.$row['d_id'].'</td>
                    <td><a href="admin-dev-profile.php?id=' . $row['d_id'] . '">'.$row['d_name'].'</a></td>
                    <td>'.$row['d_email'].'</td>

                    </tr>
                    </tbody>';
                }
            }
                else{
                    echo'data not found';
                }
            }
        }
    ?>
      </div> 