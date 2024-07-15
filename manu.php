<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
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
      } 

      .navbar{
        position: fixed;
         top: 0;
         width: 100%;
         height: 4px;;
         left: 0;
         display: flex;
         background-color: var(--white-color);
         align-items: center;
        justify-content: space-between;
        padding: 20px 10px;
        z-index: 10;
        box-shadow: 0 0 2px var(--grey-color-light);
      }
      
      .sidenav {
        height: 100%;
        width: 0;
        position: fixed;
        z-index: 1;
        top: 30px;
        left: 0;
        background: var(--white-color);
        justify-content: space-between;
        overflow-x: hidden;
        transition: 0.5s;
        padding: 20px 0px;
        box-shadow: 0 0 2px var(--grey-color-light);
        white-space: nowrap;
      }
      .logo{
        font-size: 25px;
        color: #4070f4;
      }
    
      .searchbar input{
        font-size: 20px;
        border-radius: 20px;
        margin-right: 550px;
        border-color:bisque;
       
      }
      
      .sidenav a {
        padding: 8px 8px 8px 32px;
        text-decoration: none;
        font-size: 22px;
        color: #818181;
        display: block;
        transition: 0.3s;
      }
      
      .sidenav a:hover {
        color: #f1f1f1;
        background: var(--blue-color);
      }
      
      .sidenav .closebtn {
        position: absolute;
        top: 0;
        right: 25px;
        font-size: 36px;
        margin-left: 50px;
      }
      
      #main {
        transition: margin-left .5s;
        padding: 16px;
      }
      
      .manu_title{
        margin: 15px 0;
        padding: 0 20px;
        font-size: 10px;
      }
      .item{
        list-style: none;
      }
      
      .search_icon{
        font-size: 30px;
      }
      .nav_icon{
        line-height: 35px;
      }
      
      .nav_link{
        border-radius: 10px;
      }
      
      #log-out{
        font-size: 40px;
        margin-left: 170px;
      }
      </style>
</head>
<body>
    <div id="myNavbar" class="navbar">
      <div class="logo">
        <!-- Logo here -->
        <i></i>
       Project-Name
      </div>

      <div class="searchbar">
        <span class="search_icon">
        <ion-icon name="search"></ion-icon>
        </span>
        <input type="search" placeholder="search">
      </div>
    </div>



<div id="mySidenav" class="sidenav">
  <a href="javascript:void(0)" class="" onclick="closeNav()"><i class="bx bx-log-out" id="log-out"></i></a>

  <div class="manu_content">

  <ul class="manu_items"> 
    <div class="menu_title"></div>
          
    <li class="item">
  <a href="#" class="nav_link">
    <span class="nav_icon">
      <ion-icon name="cellular"></ion-icon>
        </span>
    <span class="navlink">Deshboard</span>
  </a>
</li>
  </ul>

  <ul class="manu_items"> 
    <div class="menu_title"></div>
    <li class="item">
  <a href="#" class="nav_link">
    <span class="nav_icon">
      <ion-icon name="people"></ion-icon>
    </span>
    <span class="navlink">Customer</span>
  </a>
</li>
  </ul>

  <ul class="manu_items"> 
    <div class="menu_title"></div>
    <li class="item">
  <a href="#" class="nav_link">
    <span class="nav_icon">
      <ion-icon name="document"></ion-icon>
        </span>
    <span class="navlink">Projects</span>
  </a>
</li>
  </ul>

  <ul class="manu_items"> 
    <div class="menu_title"></div>
    <li class="item">
  <a href="#" class="nav_link">
    <span class="nav_icon">
      <ion-icon name="wallet"></ion-icon>
        </span>
    <span class="navlink">Seles</span>
  </a>
</li>
  </ul>

  <ul class="manu_items"> 
    <div class="menu_title"></div>
    <li class="item">
  <a href="#" class="nav_link">
    <span class="nav_icon">
      <i class="bx bx-bookmarks"></i>
    </span>
    <span class="navlink">Proposal</span>
  </a>
</li>
  </ul>

  <ul class="manu_items"> 
    <div class="menu_title"></div>
    <li class="item">
  <a href="#" class="nav_link">
    <span class="nav_icon">
      <ion-icon name="create"></ion-icon>
        </span>
    <span class="navlink">Contacts</span>
  </a>
</li>
  </ul>

  <ul class="manu_items"> 
    <div class="menu_title"></div>
    <li class="item">
  <a href="#" class="nav_link">
    <span class="nav_icon">
      <ion-icon name="chatbubbles"></ion-icon>
        </span>
    <span class="navlink">Messages</span>
  </a>
</li>
  </ul>

  <ul class="manu_items"> 
    <div class="menu_title"></div>
    <li class="item">
  <a href="#" class="nav_link">
    <span class="nav_icon">
      <ion-icon name="chatbox"></ion-icon>
        </span>
    <span class="navlink">Support</span>
  </a>
</li>
  </ul>

  </div>
</div>

<div id="main">
  <h2>Admin Panel Slide Bar And Nav Bar</h2>
  <p>Click on the element below to open the side navigation menu, and push this content to the right.</p>
  
  <span style="font-size:50px;cursor:pointer" onclick="openNav()"><i class="bx bx-log-in"></i></span>
</div>

<script>
function openNav() {
  document.getElementById("mySidenav").style.width = "250px";
  document.getElementById("main").style.marginLeft = "250px";
}

function closeNav() {
  document.getElementById("mySidenav").style.width = "0";
  document.getElementById("main").style.marginLeft= "0";
}
</script>
   

<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>
</html>