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
    
$cat = isset($_GET['c']) ? $_GET['c'] : '';
$id=   isset($_GET['id']) ? $_GET['id'] : '';
$v=$t=$c=$m=$d=$p=true;
$query='';
if($cat=='v'){
    $v=false;
    $query="Select * from venue where venue_id='$id'";
}
else if($cat=='t'){
    $t=false;
    $query="Select * from theme where theme_id='$id'";
}
else if($cat=='c'){
    $c=false;
    $query="Select * from catering where cid='$id'";
}
else if($cat=='m'){
    $m=false;
    $query="Select * from music where mid='$id'";
}
else if($cat=='p'){
    $p=false;
    $query="Select * from photography where pid='$id'";
}
else if($cat=='d'){
    $d=false;
    $query="Select * from decoration where did='$id'";
}

$result=pg_query($conn, $query);

$result = pg_query($conn, $query);

if (!$result) {
    $errorMessage = "Query failed: " . pg_last_error();
    echo '<script type="text/javascript">alert("' . $errorMessage . '");</script>';
    // You might want to redirect the user or handle the error in some other way
    // Example: header("Location: error_page.php?message=" . urlencode($errorMessage));
} else {
    $row = pg_fetch_assoc($result);
}


if ($_SERVER["REQUEST_METHOD"] == "POST" ) {
    $cat= isset($_GET['cat']) ? $_GET['cat'] : '';
    $id=  isset($_GET['id']) ? $_GET['id'] : '';

    if ($cat=='v'){
        $n=$_POST["nm"];
        $loc=$_POST["loc"];
        $pri=$_POST["pri"];
        $cap=$_POST["cap"];
        $url=$_POST["urlo"];
        $query="update venue set name='$n',price='$pri',location='$loc',capacity='$cap',image_url='$url' where venue_id='$id'";
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
            $query="update theme set name='$n',price='$pri',description='$des',image_url='$url' where theme_id='$id'";
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
            $query="update catering set name='$n',price='$pri',descr='$des',image_url='$url' where cid='$id'";
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
            $query="update music set name='$n',price='$pri',descr='$des',image_url='$url' where mid='$id'";
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
            $query="update decoration set name='$n',price='$pri',description='$des',image_url='$url' where did='$id'";
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
            $query="update photography set name='$n',price='$pri',description='$des',image_url='$url' where pid='$id'";
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
    <form action="modify.php?cat=v&id=<?php echo $id; ?>" method="post">
        
        <label for="name">Venue Name:</label>
        <input type="text" id="name" name="nm" value="<?php echo $row['name'];?>" required>

        <label for="price">Price:</label>
        <input type="number" id="price" name="pri" value="<?php echo $row['price'];?>" required>

        <label for="capacity">Capacity:</label>
        <input type="number" id="capacity" name="cap" value="<?php echo $row['capacity'];?>" required>

        <label for="location">Location:</label>
        <input type="text" id="location" name="loc" value="<?php echo $row['location'];?>" required>

        <label for="url">Image-URL:</label>
        <input type="text" id="url" name="urlo" value="<?php echo $row['image_url'];?>" required>

        <button type="submit">Modify Venue</button>
    </form>
    </div>
    <div id="t" <?php echo $t ? 'class="display"' : ''; ?>>
    <form action="modify.php?cat=t&id=<?php echo $id ?>" method="post">
        <label for="name">Theme Name:</label>
        <input type="text" id="name" name="name" value="<?php echo $row['name'];?>" required>

        <label for="description">Description:</label>
        <textarea id="description" name="description" value="<?php echo $row['description'];?>" rows="4" required></textarea>

        <label for="price">Price:</label>
        <input type="number" id="price" name="price" value="<?php echo $row['price'];?>" required>

        <label for="url">Image-URL:</label>
        <input type="text" id="url" name="urlo" value="<?php echo $row['image_url'];?>" required>

        <button type="submit">Modify Theme</button>
    </form>
    </div>
    <div id="c" <?php echo $c ? 'class="display"' : ''; ?>>
    <form action="modify.php?cat=c&id=<?php echo $id ?>" method="post">
        <label for="name">Catering Name:</label>
        <input type="text" id="name" name="name" value="<?php echo $row['name'];?>" required>

        <label for="description">Description:</label>
        <textarea id="description" name="description" value="<?php echo $row['descr'];?>" rows="4" required></textarea>

        <label for="price">Price:</label>
        <input type="number" id="price" name="price " value="<?php echo $row['price'];?>" required>
        <label for="url">Image-URL:</label>
        <input type="text" id="url" name="urlo" value="<?php echo $row['image_url'];?>" required>
        

        <button type="submit">Modify Catering</button>
    </form>
    </div>
    <div id="m" <?php echo $m ? 'class="display"' : ''; ?>>
    <form action="modify.php?cat=m&id=<?php echo $id ?>" method="post">
        <label for="name">Music Name:</label>
        <input type="text" id="name" name="name" value="<?php echo $row['name'];?>" required>

        <label for="description">Description:</label>
        <textarea id="description" name="description" value="<?php echo $row['descr'];?>" rows="4" required></textarea>

        <label for="price">Price:</label>
        <input type="number" id="price" name="price" value="<?php echo $row['price'];?>" required>

        <label for="url">Image-URL:</label>
        <input type="text" id="url" name="urlo" value="<?php echo $row['image_url'];?>" required>
        
        
        <button type="submit">Modify Music</button>
    </form>
    </div>
    <div id="d" <?php echo $d ? 'class="display"' : ''; ?>>
    <form action="modify.php?cat=d&id=<?php echo $id ?>" method="post">
        <label for="name">Decoration Name:</label>
        <input type="text" id="name" name="name" value="<?php echo $row['name'];?>" required>

        <label for="description">Description:</label>
        <textarea id="description" name="description" value="<?php echo $row['description'];?>" rows="4" required></textarea>

        <label for="price">Price:</label>
        <input type="number" id="price" name="price" value="<?php echo $row['price'];?>" required>

        <label for="url">Image-URL:</label>
        <input type="text" id="url" name="urlo" value="<?php echo $row['image_url'];?>" required>
        
        
        <button type="submit">Modify Decoration</button>
    </form>
    </div>
    <div id="p" <?php echo $p ? 'class="display"' : ''; ?>>
    <form action="modify.php?cat=p&id=<?php echo $id ?>" method="post">
        <label for="name">Photography Name:</label>
        <input type="text" id="name" name="name" value="<?php echo $row['name'];?>" required>

        <label for="description">Description:</label>
        <textarea id="description" name="description" value="<?php echo $row['description'];?>" rows="4" required></textarea>

        <label for="price">Price:</label>
        <input type="number" id="price" name="price" value="<?php echo $row['price'];?>" required>

        <label for="url">Image-URL:</label>
        <input type="text" id="url" name="urlo" value="<?php echo $row['image_url'];?>" required>
        
        
        <button type="submit">Modify Photography</button>
    </form>
    </div>       

</body>
</html>
