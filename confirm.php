<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Display</title>
    
            <link rel="stylesheet" href="venue2.css">
            <link rel="preconnect" href="https://fonts.googleapis.com">
            <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
            <link href="https://fonts.googleapis.com/css2?family=Playfair+Display&display=swap" rel="stylesheet">
        
    <style>
        /* Add any additional styles as needed */
        body {
            text-align: center;
            margin-top: 50px;
        }

        h3 {
            margin-bottom: 10px;
        }
        a{
            text-decoration: none;
            color:black;
            font-size: 1.3em;
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
            <img src="https://images.squarespace-cdn.com/content/v1/51f030f9e4b07a9944dcd049/bae93830-8528-4129-89d9-ae7a33eba0de/2.png?format=1500w" alt="Logo">
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
                    echo "Hello, ".htmlspecialchars($un) . "!";
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

<?php

function sanitizeInput($conn, $input) {
        return pg_escape_string($conn, trim($input));
    }

$conn = pg_connect("host=localhost dbname=project user=postgres password=postgres");
    if (!$conn) {
        echo "error";
    }

// Sample data (replace with your actual data)
$un= isset($_GET['un']) ? $_GET['un'] : '';
$v1 = isset($_GET['v1']) ? $_GET['v1'] : '';
$v2 = isset($_GET['v2']) ? $_GET['v2'] : '';
$v3 = isset($_GET['v3']) ? $_GET['v3'] : '';
$v4 = isset($_GET['v4']) ? $_GET['v4'] : '';


$ve1 = isset($_GET['ve1']) ? $_GET['ve1'] : '';
$t1 = isset($_GET['t1']) ? $_GET['t1'] : '';
$c1 = isset($_GET['c1']) ? $_GET['c1'] : '';
$m1 = isset($_GET['m1']) ? $_GET['m1'] : '';
$d1 = isset($_GET['d1']) ? $_GET['d1'] : '';
$p1 = isset($_GET['p1']) ? $_GET['p1'] : '';
$price=isset($_GET['pri']) ? $_GET['pri'] : 0;
$pri=0;
$cap=0;

// Display the data using h3 tags
echo "<h3>Groom's Name: $v1</h3>";
echo "<h3>Bride's Name: $v2</h3>";
echo "<h3>Wedding Date: $v3</h3>";
echo "<h3>Number: $v4</h3>";

// Update session variables based on URL parameters
if ($ve1 != 0 && $t1 != 0 && $c1 != 0 && $p1 != 0 && $d1 != 0 && $m1 != 0) {
    $query = "INSERT INTO registration (name, groomname, bridename, weddingdate, phoneno, vid, tid, cid, mid, did, photo_id,tot_price) VALUES ('$un', '$v1', '$v2', '$v3', '$v4', '$ve1', '$t1', '$c1', '$m1', '$d1', '$p1','$price')";

    $result = pg_query($conn, $query);

    header("Location: frontend1.php?un=$un");
}

if (isset($_GET['number']) && isset($_GET['category'])  && $_GET['category']=='c' ) {
    $c1= $_GET['number'];
}
            if($c1!=0 && ($ve1==0 ||$t1==0 ||$m1==0 ||$p1==0 ||$d1==0 )){

                    $query = "SELECT * from catering where cid=$c1";
                    $result = pg_query($conn, $query);


                    while ($row = pg_fetch_assoc($result)) {

                        // Display the search results as you did before
                        echo '
                            <div class="divi">
                                <div class="photo">
                                    <img src="'.$row["image_url"].'" class="photo">
                                </div>   
                                
                                <div class="left">
                                    <div class="name">'.
                                        sanitizeInput($conn, $row["name"]).
                                    '</div>
                                    <div class="rating">'.
                                        sanitizeInput($conn, $row["price"]).
                                    '</div>
                                    <div class="rating">'.
                                        sanitizeInput($conn, $row["descr"]).
                                    '</div>
                                    <button><a href="confirm.php?un='.$un.'&v1='.$v1.'&v2='.$v2.'&v3='.$v3.'&v4='.$v4.'&ve1='.$ve1.'&t1='.$t1.'&c1=0&m1='.$m1.'&d1='.$d1.'&p1='.$p1.'"  >Remove</a></button>
                                </div>
                            </div>';
                            $pri=$row["price"];
                    }

}


if (isset($_GET['number']) && isset($_GET['category'])  && $_GET['category']=='v' ) {
     $ve1= $_GET['number'];

}
     if($ve1!=0 && ($c1==0 ||$t1==0 ||$m1==0 ||$p1==0 ||$d1==0 )){
    
     $query = "SELECT * FROM venue where venue_id=$ve1";
     $result = pg_query($conn, $query);
     
     while ($row = pg_fetch_assoc($result)) {
             // Display the search results as you did before
             echo '
                 <div class="divi">
                     <div class="photo">
                         <img src="' .$row["image_url"].'" class="photo">
                     </div>
                     <div class="left">
                         <div class="name">'.
                             sanitizeInput($conn, $row["name"]).
                         '</div>
                         <div class="rating">Location:   '.
                             sanitizeInput($conn, $row["location"]).
                         '</div>
                         <div class="rating">Capacity:   '.
                             sanitizeInput($conn, $row["capacity"]).
                         '</div>
                         <div class="rating">Price:   '.
                             sanitizeInput($conn, $row["price"]).
                         '</div>
                         <button><a href="confirm.php?un='.$un.'&v1='.$v1.'&v2='.$v2.'&v3='.$v3.'&v4='.$v4.'&ve1=0&t1='.$t1.'&c1='.$c1.'&m1='.$m1.'&d1='.$d1.'&p1='.$p1.'"  >Remove</a></button>
                         </div></div>';
                         $price+=$row["price"];
                         $cap=$row["capacity"];
                     
                     }
                     


    }
if (isset($_GET['number']) && isset($_GET['category'])  && $_GET['category']=='t' ) {
     $t1= $_GET['number'];
}
            if($t1!=0 && ($v1==0 ||$c1==0 ||$m1==0 ||$p1==0 ||$d1==0 )){

                $query = "SELECT * from theme where theme_id=$t1";
                $result = pg_query($conn, $query);
            
     
                while ($row = pg_fetch_assoc($result)) {

                    // Display the search results as you did before
                    echo '
                        <div class="divi">
                            <div class="photo">
                                <img src="'.$row["image_url"].'" class="photo">
                            </div>   
                            
                            <div class="left">
                                <div class="name">'.
                                    sanitizeInput($conn, $row["name"]).
                                '</div>
                                <div class="rating">'.
                                    sanitizeInput($conn, $row["price"]).
                                '</div>
                                <div class="rating">'.
                                    sanitizeInput($conn, $row["description"]).
                                '</div>
                                
                                <button><a href="confirm.php?un='.$un.'&v1='.$v1.'&v2='.$v2.'&v3='.$v3.'&v4='.$v4.'&ve1='.$ve1.'&t1=0&c1='.$c1.'&m1='.$m1.'&d1='.$d1.'&p1='.$p1.'"  >Remove</a></button>
                            </div>
                        </div>';
                        $price+=$row["price"];

                }

    }
if (isset($_GET['number']) && isset($_GET['category'])  && $_GET['category']=='m' ) {
     $m1= $_GET['number'];
}

    if($m1!=0 && ($v1==0 ||$t1==0 ||$c1==0 ||$p1==0 ||$d1==0 )){

        $query = "SELECT * from music where mid=$m1";
        $result = pg_query($conn, $query);


        while ($row = pg_fetch_assoc($result)) {

            // Display the search results as you did before
            echo '
                <div class="divi">
                    <div class="photo">
                        <img src="'.$row["image_url"].'" class="photo">
                    </div>   
                    
                    <div class="left">
                        <div class="name">'.
                            sanitizeInput($conn, $row["name"]).
                        '</div>
                        <div class="rating">'.
                            sanitizeInput($conn, $row["price"]).
                        '</div>
                        <div class="rating">'.
                            sanitizeInput($conn, $row["descr"]).
                        '</div>
                        <button><a href="confirm.php?un='.$un.'&v1='.$v1.'&v2='.$v2.'&v3='.$v3.'&v4='.$v4.'&ve1='.$ve1.'&t1='.$t1.'&c1='.$c1.'&m1=0&d1='.$d1.'&p1='.$p1.'" ">Remove</a>
                    </div>
                </div>';
                $price+=$row["price"];

        }

     
    }

if (isset($_GET['number']) && isset($_GET['category'])  && $_GET['category']=='p' ) {
     $p1= $_GET['number'];
}

            if($p1!=0 && ($v1==0 ||$t1==0 ||$m1==0 ||$c1==0 ||$d1==0 )){

            $query = "SELECT * from photography where photo_id=$p1";
            $result = pg_query($conn, $query);


            while ($row = pg_fetch_assoc($result)) {
                // Display the search results as you did before
                echo '
                    <div class="divi">
                        <div class="photo">
                            <img src="'.$row["image_url"].'" class="photo">
                        </div>
                        <div class="left">
                            <div class="name">'.
                                sanitizeInput($conn, $row["photographer_name"]).
                            '</div>
                            <div class="rating">'.
                                sanitizeInput($conn, $row["description"]).
                            '</div>
                            <div class="rating">'.
                                sanitizeInput($conn, $row["location"]).
                            '</div>
                            <div class="rating">'.
                                sanitizeInput($conn, $row["price"]).
                            '</div>
                        
                            <button><a href="confirm.php?un='.$un.'&v1='.$v1.'&v2='.$v2.'&v3='.$v3.'&v4='.$v4.'&ve1='.$ve1.'&t1='.$t1.'&c1='.$c1.'&m1='.$m1.'&d1='.$d1.'&p1=0"  >Remove</a></button>
                        </div>
                    </div>';
                            $price+=$row["price"];

            }
            
    }
if (isset($_GET['number']) && isset($_GET['category'])  && $_GET['category']=='d' ) {
     $d1= $_GET['number'];
}

    if($d1!=0 && ($v1==0 ||$t1==0 ||$m1==0 ||$p1==0 ||$c1==0 )){
     $query = "SELECT * from decoration where did=$d1";
     $result = pg_query($conn, $query);
 

     while ($row = pg_fetch_assoc($result)) {

         // Display the search results as you did before
         echo '
             <div class="divi">
                 <div class="photo">
                     <img src="'.$row["image_url"].'" class="photo">
                 </div>   
                 
                 <div class="left">
                     <div class="name">'.
                         sanitizeInput($conn, $row["name"]).
                     '</div>
                     <div class="rating">'.
                         sanitizeInput($conn, $row["price"]).
                     '</div>
                     <div class="rating">'.
                         sanitizeInput($conn, $row["description"]).
                     '</div>
                     <button><a href="confirm.php?un='.$un.'&v1='.$v1.'&v2='.$v2.'&v3='.$v3.'&v4='.$v4.'&ve1='.$ve1.'&t1='.$t1.'&c1='.$c1.'&m1='.$m1.'&d1=0&p1='.$p1.'"  >Remove</a></button>
                 </div>
             </div>';
             $price+=$row["price"];

     }



    }


    


?>

<script>
    function redirect1() {
        window.location.href = 'venue.php';
    }
    function redirect2() {
        window.location.href = 'theme.php';
    }
    function redirect3() {
        window.location.href = 'catering.php';
    }
    function redirect4() {
        window.location.href = 'photography.php';
    }
    function redirect5() {
        window.location.href = 'decoration.php';
    }
    function redirect6() {
        window.location.href = 'music.php';
    }
</script>

<div id=d1 <?php if ($ve1!=0) echo 'style="display: none;"'; ?>>
    <h3>Venues 
        
<button><a href='venue.php?v1=<?php echo $v1; ?>&v2=<?php echo $v2; ?>&v3=<?php echo $v3; ?>&v4=<?php echo $v4 ; ?>&ve1=<?php echo $ve1 ; ?>&t1=<?php echo $t1 ; ?>&c1=<?php echo $c1 ; ?>&m1=<?php echo $m1 ; ?>&d1=<?php echo $d1 ; ?>&p1=<?php echo $p1 ; ?>'>Add</a></button>
    </h3></div>

<div id=d2 <?php if ($t1!=0) echo 'style="display: none;"'; ?>>
    <h3>Theme 
        
<button><a href='theme.php?v1=<?php echo $v1; ?>&v2=<?php echo $v2; ?>&v3=<?php echo $v3; ?>&v4=<?php echo $v4; ?>&ve1=<?php echo $ve1 ; ?>&t1=<?php echo $t1 ; ?>&c1=<?php echo $c1 ; ?>&m1=<?php echo $m1 ; ?>&d1=<?php echo $d1 ; ?>&p1=<?php echo $p1 ; ?>'> Add</a></button>
    </h3></div>

<div id="d3" <?php if ($c1 != 0) echo 'style="display: none;"'; ?>>
    <h3>Catering 
        
<button><a href='catering.php?v1=<?php echo $v1; ?>&v2=<?php echo $v2; ?>&v3=<?php echo $v3; ?>&v4=<?php echo $v4; ?>&ve1=<?php echo $ve1 ; ?>&t1=<?php echo $t1 ; ?>&c1=<?php echo $c1 ; ?>&m1=<?php echo $m1 ; ?>&d1=<?php echo $d1 ; ?>&p1=<?php echo $p1 ; ?>'>Add</a></button>
    </h3></div>

<div id=d4 <?php if ($p1!=0) echo 'style="display: none;"'; ?>>
    <h3>Photography 
        
<button><a href='photography.php?v1=<?php echo $v1; ?>&v2=<?php echo $v2; ?>&v3=<?php echo $v3; ?>&v4=<?php echo $v4; ?>&ve1=<?php echo $ve1 ; ?>&t1=<?php echo $t1 ; ?>&c1=<?php echo $c1 ; ?>&m1=<?php echo $m1 ; ?>&d1=<?php echo $d1 ; ?>&p1=<?php echo $p1 ; ?>'>Add</a></button>
    </h3></div>

<div id=d5 <?php if ($d1!=0) echo 'style="display: none;"'; ?>>
    <h3>Decoration 
        
<button><a href='decoration.php?v1=<?php echo $v1; ?>&v2=<?php echo $v2; ?>&v3=<?php echo $v3; ?>&v4=<?php echo $v4; ?>&ve1=<?php echo $ve1 ; ?>&t1=<?php echo $t1 ; ?>&c1=<?php echo $c1 ; ?>&m1=<?php echo $m1 ; ?>&d1=<?php echo $d1 ; ?>&p1=<?php echo $p1 ; ?>'>Add</a></button>
    </h3></div>

<div id=d6 <?php if ($m1!=0) echo 'style="display: none;"'; ?>>
    <h3>Music 
        
<button><a href='music.php?v1=<?php echo $v1; ?>&v2=<?php echo $v2; ?>&v3=<?php echo $v3; ?>&v4=<?php echo $v4; ?>&ve1=<?php echo $ve1 ; ?>&t1=<?php echo $t1 ; ?>&c1=<?php echo $c1 ; ?>&m1=<?php echo $m1 ; ?>&d1=<?php echo $d1 ; ?>&p1=<?php echo $p1 ; ?>'>Add</a></button>
    </h3></div>

<h3>Total Amount to Pay is ₹ <?php $price+=$pri*$cap; echo "$price";?></h3>

<button><a href="confirm.php?un=<?php echo $un; ?>&v1=<?php echo $v1; ?>&v2=<?php echo $v2; ?>&v3=<?php echo $v3; ?>&v4=<?php echo $v4; ?>&ve1=<?php echo $ve1 ; ?>&t1=<?php echo $t1 ; ?>&c1=<?php echo $c1 ; ?>&m1=<?php echo $m1 ; ?>&d1=<?php echo $d1 ; ?>&p1=<?php echo $p1 ; ?>&pri=<?php echo $price;?>">Confirm </a>
</button>





</body>
</html>
