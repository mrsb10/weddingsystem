<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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
            flex-direction: column; /* Center items vertically */
        }

        h2 {
            text-align: center;
            color: #333;
            margin-top: 20px; /* Adjust top margin */
        }

        form {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 300px;
        }

        label {
            display: block;
            margin: 10px 0;
            color: black;
        }

        input {
            width: 100%;
            padding: 8px;
            margin-bottom: 15px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;
            border-color: black;
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

        p {
            color: red;
            text-align: center;
        }
    </style>
    
</head>
<body>

<?php
    if (isset($_GET['un'])) {
        $un = $_GET['un'];
    }

    



if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Assuming you have a form with fields: name, username, password, address, and phone number
    
    $gname = $_POST["groomname"];
    $bname = $_POST["bridename"];
    $date = $_POST["weddingdate"];
    $number = $_POST["phoneno"];

    $conn = pg_connect("host=localhost dbname=project user=postgres password=postgres");

    if (!$conn) {
        echo "error";
    }

    
    $query = "INSERT INTO temp_regis(name, groomname, bridename, weddingdate, phoneno) VALUES ('$un', '$gname', '$bname', '$date', '$number')";

    $result = pg_query($conn, $query);

    if (!$result) {
        die("Query failed: " . pg_last_error());
    } else {
        
        echo '<script>';
        echo 'alert("Registered successfully!");';
        
        header("Location: confirm.php?un=$un&v1=$gname&v2=$bname&v3=$date&v4=$number&ve1=0&t1=0&c1=0&m1=0&d1=0&p1=0");

        echo '</script>';
    }

    pg_close($conn);
}
?>

<script>

        function isDateAfterToday(inputDate) {
            // Get the current date
            var currentDate = new Date();

            // Convert the input date string to a Date object
            var inputDateObject = new Date(inputDate);

            // Calculate the difference in milliseconds
            var timeDifference = inputDateObject.getTime() - currentDate.getTime();

            // Calculate the difference in days
            var daysDifference = timeDifference / (1000 * 3600 * 24);
    
            // Check if the difference is at least 10 days
            return daysDifference >= 10;
        }

    function checkdate(){
            // Get the input value from the user
            var userInput = document.getElementById("date").value;

            // Check if the date is not in the past
            var isValid = isDateAfterToday(userInput);

            // Display the result
            if(isValid==0){
            alert("Given Date is invalid.Please give a date that is atleast 10 from now");
            }
    }
</script>

<h2>Marriage Registration Form</h2>
<form method="post" action="register.php?un=<?php echo $un; ?>">
    <!-- Add your form fields here -->
    <!-- Name: <input type="text" name="name" required><br> -->

    username: <input type="text" name="name" value="<?php echo $un; ?> " disabled     required><br>

    Groom's Name: <input type="text" name="groomname" required><br>
    Bride's Name: <input type="text" name="bridename" required><br>
    Wedding Date: <input type="date" id="date" name="weddingdate" onblur="checkdate()"  required><br>
    Phone Number: <input type="number" name="phoneno" minlength="10" maxlength="10" required><br>

    <input type="submit" value="Register">
</form>
</body>
</html>
