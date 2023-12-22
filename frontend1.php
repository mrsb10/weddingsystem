<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="summa.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display&display=swap" rel="stylesheet">
</head>
<body>



    <div class="main-container">
      <div class="topbar">
        <div class="navbar left-links">
          <a href="frontend1.php">Home</a>
        </div>
        <div class="navbar left-links">
          <a href="about.php">About</a>
        </div>
        <div class="navbar left-links">
          <a href="services.php">Service</a>
        </div>
        <div class="logo">
          <img src="https://images.squarespace-cdn.com/content/51f030f9e4b07a9944dcd049/bae93830-8528-4129-89d9-ae7a33eba0de/2.png?format=1000w&content-type=image%2Fpng" alt="Logo">
        </div>
        <div class="navbar right-links">
          <a href="Gallery.php">Gallery</a>
        </div>
        <div class="navbar right-links">
          <?php 
            
             session_start();
             if(isset($_SESSION['uname'])){
              $un=$_SESSION['uname'];
              echo "<a href='frontend.html'>Hello, ".htmlspecialchars($un) . "!";
             }
             else{
              echo "Hello user";
             }
          ?>
        </div>
        <div class="navbar right-links">
          <a href="register.php?un=<?php echo urlencode($un);?>"> Register</a>
        </div>
        
      </div>
      <div class="bottombar">
        <div class="image-container">
          <img src="Joe DBMS/image1.jpg" alt="Image 1" class="img">
        </div>
        <div class="image-container">
          <img src="Joe DBMS/image2.jpg" alt="Image 2" class="img">
        </div>
        <div class="image-container">
          <img src="Joe DBMS/image3.jpg" alt="Image 3" class="img">
        </div>
      </div>
      <div class="testimonial">
        <div class="testimonial-left">
          <div class="planner-image">
            <img src="Joe DBMS/wedding-planner.png" class="wedding-planner">
          </div>
          <div class="wedding-planner-text">
            "Heavenly Day Events is your go-to partner for creating magic in Indian weddings!<br><br>
             Our software is your secret weapon for stress-free wedding planning.<br><br>
              From crafting dreamy decor to managing guest lists with flair, we've got it all covered.<br><br>
               Picture this: seamless coordination, easy budget tracking, and a touch of tech-savvy elegance. Our platform is not just about planning; it's about turning your wedding into a heavenly affair. So, wave goodbye to wedding worries and say hello to hassle-free celebrations. Let's make your big day the talk of the town with Heavenly Day Events!"
          </div>
        </div>
        <div class="testimonial-right">
          <img class="testimonial-image" src="https://t4.ftcdn.net/jpg/02/55/57/61/240_F_255576168_SypKTTA3BPVwYf60r6GNeklZU3bNoX66.jpg">
        </div>
      </div>
      <div class="service-pop">
        
        <div class="pop-righ">
          <div class="pop-right-photo">
            <img src="https://t4.ftcdn.net/jpg/04/72/21/65/240_F_472216576_hHggR5qmPrIorp4x7SQIsaK7eOybYZdV.jpg" class="pop-right-photo">
          </div>
        </div>
        <div class="pop-left">
          <div class="pop-photo">
            <img src="joe dbms/serviceplanning.png" class="service-planning">
          </div>
          <div class="wedding-planner-text2">
            We specialize in full service event planning with an approach centered around the belief that weddings are more than just a party and planning should make you feel excited about what’s to come rather than overwhelmed by a task list.<br><br>
            Whether you already have specific ideas and a clear vision for your event or still need help developing them, we are here to provide expert advice and hands-on assistance to meet you exactly where you need us.
          </div>
          <button class="tell">
            <a href="registered data.php?un=<?php echo urlencode($un);?>" style="text-decoration: none;color:black;">Registered Details!</a>
          </button>
        </div>

      </div>
    </div>
  </body>     
  </html>