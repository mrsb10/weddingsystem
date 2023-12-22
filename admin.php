<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Page</title>
    <style>
    body {
        font-family: 'Arial', sans-serif;
        background-color: #f4f4f4;
        margin: 0;
        padding: 0;
        text-align: center;
    }

    .topbar {
        background-color: #333;
        overflow: hidden;
        padding: 15px 0;
        color: #fff;
    }

    .navbar {
        display: inline-block;
        margin: 0 10px;
    }

    .navbar a {
        text-decoration: none;
        color: #fff;
        padding: 10px 15px;
        display: inline-block;
        transition: background-color 0.3s, color 0.3s;
    }

    .navbar a:hover {
        background-color: #fff;
        color: #333;
    }

    h3 {
        color: #333;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin: 20px 0;
    }

    th, td {
        border: 1px solid #ddd;
        padding: 15px; /* Increased padding for better readability */
        text-align: left;
    }

    th {
        background-color: #333;
        color: #fff;
    }

    tr:nth-child(even) {
        background-color: #f2f2f2;
    }

    a {
        display: inline-block;
        text-decoration: none;
        color: #333;
        padding: 10px 20px;
        margin: 10px;
        border: 2px solid #333;
        border-radius: 5px;
        transition: background-color 0.3s, color 0.3s;
    }

    a:hover {
        background-color: #333;
        color: #fff;
    }
</style>

</head>
<body>
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
            <a href="gallery.php">Gallery</a>
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
    </div>
    
    <a href="venueadmin.php">Venue</a>
    <a href="themeadmin.php">Theme</a>
    <a href="cateradmin.php">Catering</a>
    <a href="musicadmin.php">Music</a>
    <a href="decoradmin.php">Decoration</a>
    <a href="photoadmin.php">Photography</a>
    <br>
    <br>
    <br>
    <br>

    <?php

    echo "<h1>Registered Users</h1>";
    $conn = pg_connect("host=localhost dbname=project user=postgres password=postgres");
    if (!$conn) {
        echo "error";
    }
    $query = "Select * from registration";

    $result = pg_query($conn, $query);
    if (pg_num_rows($result) >= 1) {
        while($row = pg_fetch_assoc($result)) {    
        
            echo "<table border='1'>
            <tr><th>Name</th><th>Groom Name</th><th>Bride Name</th><th>Date</th><th>Phone number</th></tr>";
    
            echo "<tr><td>" . $row["name"]. "</td><td>" . $row["groomname"]. "</td><td>". $row["bridename"]. "</td><td>" . $row["weddingdate"]. "</td><td>".$row["phoneno"]. "</td></tr>";
        
            echo "</table>";
            echo "<br><br><br>";
            

            $vid=$row["vid"];
            if($vid!=''){
            $query1="Select * from venue where venue_id='$vid'";
            $result1 = pg_query($conn, $query1);
            $row1 = pg_fetch_assoc($result1);
            $nm=$row1['name'];
            $pr=$row1['price'];
            
            echo '<table border="1" >
            <tr><th>Category</th><th>Your Selection id</th><th>Name</th><th>Price</th><tr>
            <tr><td>Venue</td><td>'.$row["vid"].'</td><td>'.$nm.'</td><td>'.number_format($pr, 2).'</td></tr>';
            }

            $pid=$row["photo_id"];
            if($pid!=''){
            $query1="Select * from photography where photo_id='$pid'";
            $result1 = pg_query($conn, $query1);
            $row1 = pg_fetch_assoc($result1);
            $nm=$row1['photographer_name'];
            $pr=$row1['price'];
            
            echo '
            <tr><td>Photography</td><td>'.$row["photo_id"].'</td><td>'.$nm.'</td><td>'.number_format($pr, 2).'</td></tr>';
            }


            $cid=$row["cid"];
            if($cid!=''){
            $query1="Select * from catering where cid='$cid'";
            $result1 = pg_query($conn, $query1);
            $row1 = pg_fetch_assoc($result1);
            $nm=$row1['name'];
            $pr=$row1['price'];
            
            echo '
            <tr><td>Catering</td><td>'.$row["cid"].'</td><td>'.$nm.'</td><td>'.number_format($pr, 2).'</td></tr>';
            }

            $did=$row["did"];
            if($did!=''){
            $query1="Select * from decoration where did='$did'";
            $result1 = pg_query($conn, $query1);
            $row1 = pg_fetch_assoc($result1);
            $nm=$row1['name'];
            $pr=$row1['price'];
            
            echo '
            <tr><td>Decoration</td><td>'.$row["did"].'</td><td>'.$nm.'</td><td>'.number_format($pr, 2).'</td></tr>';
            }

            $tid=$row["tid"];
            if($tid!=''){
            $query1="Select * from theme where theme_id='$tid'";
            $result1 = pg_query($conn, $query1);
            $row1 = pg_fetch_assoc($result1);
            $nm=$row1['name'];
            $pr=$row1['price'];
            
            echo '
            <tr><td>Theme</td><td>'.$tid.'</td><td>'.$nm.'</td><td>'.number_format($pr, 2).'</td></tr>';
            }

            $mid=$row["mid"];
            if($mid!=''){
            $query1="Select * from music where mid='$mid'";
            $result1 = pg_query($conn, $query1);
            $row1 = pg_fetch_assoc($result1);
            $nm=$row1['name'];
            $pr=$row1['price'];
            
            echo '
            <tr><td>Music</td><td>'.$row["mid"].'</td><td>'.$nm.'</td><td>'.$pr.'</td></tr>';

            echo '<tr><td colspan=3>Total Price</td><td>'.number_format($row["tot_price"], 2).'</td></tr>';
          
                }
        
                
        }
    }
    else{
       echo " <h>No Registration till now </h>";
    }
    pg_close($conn);



?>

</body>
</html>
