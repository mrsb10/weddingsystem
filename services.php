<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="service.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Playfair+Display&display=swap" rel="stylesheet">

    </head>
    <body>
        <div class="service-main">
            <div class="topbar">
                <div class="navbar left-links">
                    <a href="frontend1.php">Home</a>
                  </div>
                <div class="navbar left-links">
                  <a href="About.php">About</a>
                </div>
                <div class="navbar left-links">
                  <a href="Service.php">Service</a>
                </div>
                <div class="logo">
                  <img src="https://images.squarespace-cdn.com/content/51f030f9e4b07a9944dcd049/bae93830-8528-4129-89d9-ae7a33eba0de/2.png?format=1000w&content-type=image%2Fpng" alt="Logo">
                </div>
                <div class="navbar right-links">
                  <a href="Gallery.php">Gallery</a>
                </div>
                <div class="navbar right-links">
                  <a href="Contact.php">Contact</a>
                </div>
                <div class="navbar right-links">
                <?php 
            
                  session_start();
                  if(isset($_SESSION['uname'])){
                  $un=$_SESSION['uname'];
                  echo "<a href='frontend.html'>Hello, ".htmlspecialchars($un) . "!</a>";
                  }
                  else{
                  echo "Hello";
                  }
                ?>
                  </div>
              </div>
              <div class="service-top">
                <div class="top-left">
                    <a href="venue.php">
                    <img src="Joe DBMS/venues.jpg" class="service-photo">
                    </a>
                    <div class="text">Venues</div>
                </div>
                <div class="top-left">
                    <a href="theme.php">
                    <img src="Joe DBMS/dining.jpg" class="service-photo">
                    </a>
                    <div class="text">Themes</div>
                </div>
              </div>
              <div class="service-middle">
                <div class="top-left">
                    <a href="catering.php">
                    <img src="Joe DBMS/catering.jpg" class="service-photo">
                    </a>
                    <div class="text">Catering</div>

                </div>
                <div class="top-left">
                    <a href="music.php">
                    <img src="Joe DBMS/music.jpg" class="service-photo">
                    </a>
                    <div class="text">Music</div>
                </div>
              </div>
              <div class="service-bottom">
                <div class="top-left">
                    <a href="photography.php">
                    <img src="Joe DBMS/photo.jpg" class="service-photo">
                    </a>
                    <div class="text">Photography</div>
                </div>
                <div class="top-left">
                    <a href="decoration.php">
                    <img src="Joe DBMS/deco.jpg" class="service-photo">
                    </a>
                    <div class="text">Decoration</div>
                </div>  
              </div>
        </div>
    </body>
</html>