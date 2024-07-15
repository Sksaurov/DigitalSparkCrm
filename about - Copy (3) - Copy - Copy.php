<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <script src="https://kit.fontawesome.com/b356ad9dc8.js" crossorigin="anonymous"></script>
  <title>About Us</title>

  <style>
*{margin: 0; padding: 0; box-sizing: border-box;}
body{
  
}
.main{
    width: 50%;
    height: 30px;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-left: 250px;
    margin-top: 20px;
    
}
.icon{
    width: 50px;
    height: 50px;
    border-radius: 100px;
    background: #fff;
    margin: 20px;
    text-align: center;
    font-size: 20px;
    line-height: 50px;
    font-family: sans-serif;
    overflow: hidden;
    box-shadow: 5px 10px 20px rgba(150, 150, 150, .3);
    transition: all .3s ease-out;
}
.icon:hover{
    width: 150px;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: space-evenly;
    color: #fff;
}
.icon:hover i{
    color: #fff;
}
.icon .fa-facebook-f{
    color: #1A6ED8;
}
.fb:hover{
    background: #1A6ED8;
}
.icon .fa-github{
    color: #1A6ED8;
}
.git:hover{
    background: #1A6ED8;
}
.icon .fa-instagram{
    color: #1A6ED8;
}
.insta:hover{
    background: #1A6ED8;
}
.icon .fa-whatsapp{
    color: #1A6ED8;
}
.wp:hover{
    background: #1A6ED8;
}

/* responsive */
@media only screen and (min-width: 320px) and (max-width: 991px) {
    .main{
        flex-direction: column;
    }
}
    </style>
</head>

<body>
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand text-primary" href="manu.php" style="font-size:25px">Gaming Hub</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
      aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
</nav>
   

  <div class="container mt-5">
    <div class="row">
      <div class="col-md-6">
        <h2>About Us</h2>
        <p>Design by <h3 class="text-success">Mugdho Datta</h3></p>
        <p>Welcome to our gaming haven! At Gaming-Hub, we are passionate about creating a vibrant and immersive gaming community for
          players of all levels. Whether you're a seasoned gamer or just starting your journey, our platform is designed to provide you
           with the ultimate gaming experience. From the latest blockbuster releases to timeless classics, we curate a diverse collection of 
           games that cater to every genre and interest. Our team of dedicated enthusiasts is constantly on the lookout for the most exciting titles,
            ensuring that you'll always find something to satisfy your gaming cravings. Join us as we embark on this thrilling adventure together,
             where the love for gaming knows no boundaries. Let's dive into the virtual world and let the games begin!</p>
      </div>
      <div class="col-md-6">
        <h2>Contact Us</h2>
        <form action="#" method="POST">
          <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control" style="border-color:aqua" id="name" name="name" required>
          </div>
          <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" style="border-color:aqua" id="email" name="email" required>
          </div>
          <div class="form-group">
            <label for="message">Message</label>
            <textarea class="form-control" style="border-color:yellow" id="message" name="message" rows="5" required></textarea>
          </div>
          <button type="submit" class="btn btn-outline-primary">Send Message</button>
        </form>
      </div>
    </div>
    <div class="row mt-5">
      <div class="col text-center">
        <h3>Follow Us</h3>

        <div class="main">
        <div class="icon fb">
            <a href="https://www.facebook.com/mugdho.dattapriom"><i class="fa-brands fa-facebook-f"></i></a>
            <span>Facebook</span>
        </div>

         <div class="icon git">
           <a href="https://github.com/dattapro001"> <i class="fa-brands fa-github" ></i></a>
            <span src="https://github.com/dattapro001">GitHub</span>
        </div>

        <div class="icon insta">
            <i class="fa-brands fa-instagram"></i>
            <span>Instragram</span>
        </div>

        <div class="icon wp">
           <a href="www.facebook.com"> <i class="fa-brands fa-whatsapp"></i></a>
            <span>whatsapp</span></a>
        </div>
      </div>
    </div>
</div>
    </div>
  </div>

  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
</body>

</html>
