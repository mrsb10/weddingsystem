<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Venue Data</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }

        form {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        label {
            display: block;
            margin-bottom: 10px;
        }

        input, select {
            width: 100%;
            padding: 8px;
            margin-bottom: 15px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        button {
            background-color: #4caf50;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        button:hover {
            background-color: #45a049;
        }
        .display {
            display : none;
        }
    </style>
</head>

<?php

$conn = pg_connect("host=localhost dbname=project user=postgres password=postgres");
            if (!$conn) {
                echo "error";
            }
    
$cat = isset($_GET['cat']) ? $_GET['cat'] : '';
$v=$t=$c=$m=$d=$p=true;
if($cat=='v'){
    $v=false;
}
else if($cat=='t'){
    $t=false;
}
else if($cat=='c'){
    $c=false;
}
else if($cat=='m'){
    $m=false;
}
else if($cat=='p'){
    $p=false;
}
else if($cat=='d'){
    $d=false;
}


if ($_SERVER["REQUEST_METHOD"] == "POST" ) {
    $cat= isset($_GET['cat']) ? $_GET['cat'] : '';
    if ($cat=='v'){
        $n=$_POST["nm"];
        $loc=$_POST["loc"];
        $pri=$_POST["pri"];
        $cap=$_POST["cap"];
        $url=$_POST["urlo"];
        $query="Insert into venue(name,price,location,capacity,image_url) values('$n','$pri','$loc','$cap','$url')";
        $result = pg_query($conn, $query);
        $r="venueadmin.php";

        if (!$result) {
            die("Query failed: " . pg_last_error());
        }
        else{
            header("Location: $r");
            exit(); 
        }
        }
    
        else if ($cat=='t') {
            $n=$_POST["name"];
            $des=$_POST["description"];
            $pri=$_POST["price"];
            $url=$_POST["urlo"];
            $query="Insert into theme(name,description,price,image_url) values('$n','$des','$pri','$url')";
            $result = pg_query($conn, $query);
            $r="themeadmin.php";

            if (!$result) {
                die("Query failed: " . pg_last_error());
            }
            else{
                header("Location: $r");
                exit(); 
            }
        }
        else if ($cat=='c') {
            $n=$_POST["name"];
            $des=$_POST["description"];
            $pri=$_POST["price"];
            $url=$_POST["urlo"];
            $query="Insert into catering(name,descr,price,image_url) values('$n','$des','$pri','$url')";
            $result = pg_query($conn, $query);
            $r="cateradmin.php";

            if (!$result) {
                die("Query failed: " . pg_last_error());
            }
            else{
                header("Location: $r");
                exit(); 
            }
        }
        else if ($cat=='m') {
            $n=$_POST["name"];
            $des=$_POST["description"];
            $pri=$_POST["price"];
            $url=$_POST["urlo"];
            $query="Insert into music(name,descr,price,image_url) values('$n','$des','$pri','$url')";
            $result = pg_query($conn, $query);
            $r="musicadmin.php";

            if (!$result) {
                die("Query failed: " . pg_last_error());
            }
            else{
                header("Location: $r");
                exit(); 
            }
        }
        else if ($cat=='d') {
            $n=$_POST["name"];
            $des=$_POST["description"];
            $pri=$_POST["price"];
            $url=$_POST["urlo"];
            $query="Insert into decoration(name,description,price,image_url) values('$n','$des','$pri','$url')";
            $result = pg_query($conn, $query);
            $r="decoradmin.php";

            if (!$result) {
                die("Query failed: " . pg_last_error());
            }
            else{
                header("Location: $r");
                exit(); 
            }
        }
        else if ($cat=='p') {
            $n=$_POST["name"];
            $des=$_POST["description"];
            $pri=$_POST["price"];
            $url=$_POST["urlo"];
            $query="Insert into photography(name,description,price,image_url) values('$n','$des','$pri','$url')";
            $result = pg_query($conn, $query);
            $r="photoadmin.php";

            if (!$result) {
                die("Query failed: " . pg_last_error());
            }
            else{
                header("Location: $r");
                exit(); 
            }
        }

}



?>




<body>
    <div id="v" <?php echo $v ? 'class="display"' : ''; ?>>
    <form action="add.php?cat=v" method="post">
        
        <label for="name">Venue Name:</label>
        <input type="text" id="name" name="nm" required>

        <label for="price">Price:</label>
        <input type="number" id="price" name="pri" required>

        <label for="capacity">Capacity:</label>
        <input type="number" id="capacity" name="cap" required>

        <label for="location">Location:</label>
        <input type="text" id="location" name="loc" required>

        <label for="url">Image-URL:</label>
        <input type="text" id="url" name="urlo" required>

        <button type="submit">Add Venue</button>
    </form>
    </div>
    <div id="t" <?php echo $t ? 'class="display"' : ''; ?>>
    <form action="add.php?cat=t" method="post">
        <label for="name">Theme Name:</label>
        <input type="text" id="name" name="name" required>

        <label for="description">Description:</label>
        <textarea id="description" name="description" rows="4" required></textarea>

        <label for="price">Price:</label>
        <input type="number" id="price" name="price" required>

        <label for="url">Image-URL:</label>
        <input type="text" id="url" name="urlo" required>

        <button type="submit">Add Theme</button>
    </form>
    </div>
    <div id="c" <?php echo $c ? 'class="display"' : ''; ?>>
    <form action="add.php?cat=c" method="post">
        <label for="name">Catering Name:</label>
        <input type="text" id="name" name="name" required>

        <label for="description">Description:</label>
        <textarea id="description" name="description" rows="4" required></textarea>

        <label for="price">Price:</label>
        <input type="number" id="price" name="price" required>
        <label for="url">Image-URL:</label>
        <input type="text" id="url" name="urlo" required>
        

        <button type="submit">Add Catering</button>
    </form>
    </div>
    <div id="m" <?php echo $m ? 'class="display"' : ''; ?>>
    <form action="add.php?cat=m" method="post">
        <label for="name">Music Name:</label>
        <input type="text" id="name" name="name" required>

        <label for="description">Description:</label>
        <textarea id="description" name="description" rows="4" required></textarea>

        <label for="price">Price:</label>
        <input type="number" id="price" name="price" required>

        <label for="url">Image-URL:</label>
        <input type="text" id="url" name="urlo" required>
        
        
        <button type="submit">Add Music</button>
    </form>
    </div>
    <div id="d" <?php echo $d ? 'class="display"' : ''; ?>>
    <form action="add.php?cat=d" method="post">
        <label for="name">Decoration Name:</label>
        <input type="text" id="name" name="name" required>

        <label for="description">Description:</label>
        <textarea id="description" name="description" rows="4" required></textarea>

        <label for="price">Price:</label>
        <input type="number" id="price" name="price" required>

        <label for="url">Image-URL:</label>
        <input type="text" id="url" name="urlo" required>
        
        
        <button type="submit">Add Decoration</button>
    </form>
    </div>
    <div id="p" <?php echo $p ? 'class="display"' : ''; ?>>
    <form action="add.php?cat=p" method="post">
        <label for="name">Photography Name:</label>
        <input type="text" id="name" name="name" required>

        <label for="description">Description:</label>
        <textarea id="description" name="description" rows="4" required></textarea>

        <label for="price">Price:</label>
        <input type="number" id="price" name="price" required>

        <label for="url">Image-URL:</label>
        <input type="text" id="url" name="urlo" required>
        
        
        <button type="submit">Add Photography</button>
    </form>
    </div>       

</body>
</html>
