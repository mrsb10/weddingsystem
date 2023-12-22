<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Marriage Registration Form</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            text-align: center;
            margin: 0;
            padding: 0;
        }

        h2 {
            color: #333;
        }

        form {
            max-width: 400px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        input {
            width: 100%;
            padding: 10px;
            margin: 8px 0;
            box-sizing: border-box;
        }

        input[type="submit"] {
            background-color: #4caf50;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
</head>

<body>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $name = $_POST["name"];
        $gname = $_POST["groomname"];
        $bname = $_POST["bridename"];
        $date = $_POST["weddingdate"];
        $number = $_POST["phoneno"];

        $conn = pg_connect("host=localhost dbname=project user=postgres password=postgres");

        if (!$conn) {
            echo "error";
        }

        $query = "INSERT INTO registration(name, groomname, bridename, weddingdate, phoneno) VALUES ('$name', '$gname', '$bname', '$date', '$number')";

        $result = pg_query($conn, $query);

        if (!$result) {
            die("Query failed: " . pg_last_error());
        } else {
            echo '<script>';
            echo 'alert("Registered successfully!");';
            echo '</script>';

            echo '<script>';
            echo 'setTimeout(function() { window.location.href = "services1.php"; }, 5);';
            echo '</script>';
        }

        pg_close($conn);
    }
    ?>

    <h2>Marriage Registration Form</h2>
    <form method="post" action="register.php">
        Name: <input type="text" name="name" required><br>
        Groom's Name: <input type="text" name="groomname" required><br>
        Bride's Name: <input type="text" name="bridename" required><br>
        Wedding Date: <input type="date" name="weddingdate" required><br>
        Phone Number: <input type="text" name="phoneno" required><br>

        <input type="submit" value="Register">
    </form>

</body>

</html>
