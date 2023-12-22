<?php
// Your PHP sign-in logic here

function check($un,$em){
    $check=0;
    $conn= pg_connect("host=localhost dbname=project user=postgres password=postgres");
    if(!$conn){
        echo "error";
             }
    $query1="Select * from user_info where uname='$un'";
    $query2="Select * from user_info where email='$em'";

    $result1 = pg_query($conn, $query1);
    $result2 = pg_query($conn, $query2);

    if (!$result1 || !$result2) {
        die("Query failed: " . pg_last_error());
    }

    elseif (pg_num_rows($result1) == 1) {
        echo '<script>';
        echo 'alert("Username Already Exist!!!!");';
        echo '</script>';
        
        return $check;
    }
    elseif (pg_num_rows($result2) == 1) {
        echo '<script>';
        echo 'alert("Email Already Exist!!!!");';
        echo '</script>';
        
        return $check;
    }
    
    else{
        $check=1;
        return $check;
    }
    

}
function sanitizeInput($input) {
    return pg_escape_string(trim($input));
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Assuming you have a form with fields: name, username, password, address, and phone number
    $name = $_POST["name"];
    $username = $_POST["username"];
    $password = $_POST["password"];
    $email=$_POST["email"];
    $address = $_POST["address"];
    $phone_number = $_POST["phone_number"];

    // Validate the form fields and perform authentication (Add your authentication logic here)
    if (!empty($name) && !empty($username) && !empty($password) && !empty($address) && !empty($phone_number)) {
        // Authentication successful, redirect to a welcome page or dashboard
        
        $conn= pg_connect("host=localhost dbname=project user=postgres password=postgres");
        if(!$conn){
            echo "error";
                 }
        
        if(check($username,$email)){

        $query = "Insert into user_info(name,uname,email,psw,adds,pno) Values('$name','$username','$email','$password','$address','$phone_number')";
    
        $result = pg_query($conn, $query);

        if (!$result) {
            die("Query failed: " . pg_last_error());
        }
        else{
            echo '<script>';
            echo 'alert("Signup successful!");';
            echo '</script>';

            // Introduce a 2-second delay before redirecting to the login page
            echo '<script>';
            echo 'setTimeout(function() { window.location.href = "login.php"; }, 10);';
            echo '</script>';
                }
    }
        pg_close($conn);
        
        }
        
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign In</title>
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
    <h2>Sign In</h2>
    <br>


    <!-- Sign-in form -->
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label for="name">Name:</label>
        <input type="text" name="name" required><br>

        <label for="username">Username:</label>
        <input type="text" name="username" required><br>

        <label for="password">Password:</label>
        <input type="password" name="password" minlength="6" maxlength="12"  required><br>

        <label for="email">Email:</label>
        <input type="email" name="email" required><br>

        <label for="address">Address:</label>
        <input type="text" name="address" required><br>

        <label for="phone_number">Phone Number:</label>
        <input type="number" name="phone_number" minlength="10" maxlength="10" required><br>

        <input type="submit" value="Sign In">
    </form>
</body>
</html>
