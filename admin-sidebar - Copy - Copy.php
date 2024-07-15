<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <style>
     
       :root {
        --white-color: #fff;
        --blue-color: #4070f4;
        --grey-color: #707070;
        --grey-color-light: #aaa;
      }
      
      body {
        font-family:'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
        background-color: #e7f2fd;
        transition: all  0.5s ease;
      }  */

    
      
      .item{
        color: black;
      }
      </style>
  </style>
</head>
<body>
<aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3   bg-gradient-dark" id="sidenav-main">
    <div class="sidenav-header">
      <i class="fas fa-times p-3 cursor-pointer text-white opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
      <a class="navbar-brand m-0" >
      
        <span class="ms-1 font-weight-bold text-white">Admin Panel</span>
      </a>
    </div>
    <hr class="horizontal light mt-0 mb-2">
    <div id="mySidenav" class="sidenav">
 


  <div class=" max-height-vh-100" id="sidenav-collapse-main">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link text-white" href="admin-page.php">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">dashboard</i>
            </div>
            <span class="nav-link-text ms-1">Dashboard</span>
          </a>
        </li>
        <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link text-white  " href="admin-client.php">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
           

            </div>
            <span class="nav-link-text ms-1">Client</span>
          </a>
        </li>
        <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link text-white  " href="projects.php">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
    
            
            </div>
            <span class="nav-link-text ms-1">Project</span>
          </a>
        </li>
        <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link text-white  " href="admin-dev.php">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              
            </div>
            <span class="nav-link-text ms-1">Developer</span>
          </a>
        </li>
        <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link text-white  " href="admin-logout.php">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              
            </div>
            <span class="nav-link-text ms-1">logout</span>
          </a>
        </li>
       

       



</div>
  </aside>
</body>
</html>