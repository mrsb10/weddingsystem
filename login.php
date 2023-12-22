<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <!-- Add your CSS styling here if needed -->
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            text-align: center;
            margin: 0;
            padding: 0;
        }

        .login-container {
            max-width: 400px;
            margin: 100px auto;
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
    </style>
</head>
<body>

    <div class="login-container">
        <h2>Login</h2>

        <?php
        // Check if the form is submitted
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Check if the login button is pressed
            if (isset($_POST["login"])) {
                loginFunction();
            }
            
            elseif(isset($_POST["loginadmin"])){
                loginadmin();
            }
            // Check if the sign-in button is pressed
            elseif (isset($_POST["signin"])) {
                signInFunction();
            }
        }
        function sanitizeInput($conn, $input)
        {
            return pg_escape_string($conn, trim($input));
        }
        function loginadmin(){
            $conn = pg_connect("host=localhost dbname=project user=postgres password=postgres");
            if (!$conn) {
                die("Connection failed: " . pg_last_error());
            }

            $username = sanitizeInput($conn, $_POST["username"]);
            $password = sanitizeInput($conn, $_POST["password"]);

            $query = "SELECT * FROM admin WHERE name = '$username' AND psw = '$password'";
            $result = pg_query($conn, $query);

            if (!$result) {
                die("Admin Query failed: " . pg_last_error($conn));
            }

            if (pg_num_rows($result) == 1) {
                echo '<script>';
                echo 'alert("Welcome Admin! Login successful!");';
                echo '</script>';
                redirectToPage('admin.php');
            }

            else{
                echo '<script>';
                echo 'alert("Invalid adminname or password");';
                echo '</script>';
            }
            
            pg_close($conn);
        }
        function loginFunction()
        {
            $conn = pg_connect("host=localhost dbname=project user=postgres password=postgres");
            if (!$conn) {
                die("Connection failed: " . pg_last_error());
            }

            $username = sanitizeInput($conn, $_POST["username"]);
            $password = sanitizeInput($conn, $_POST["password"]);

        
            $query = "SELECT * FROM user_info WHERE uname = '$username' AND psw = '$password'";
            $result = pg_query($conn, $query);

            if (!$result) {
                die("User Query failed: " . pg_last_error($conn));
            }

            if (pg_num_rows($result) >= 1) {
                echo '<script>';
                echo 'alert("Login successful!");';
                echo '</script>';
                redirectToPage('frontend1.php');
            } else {
                echo '<script>';
                echo 'alert("Invalid username or password");';
                echo '</script>';
            }

            pg_close($conn);
        }

        function redirectToPage($page)
        {
            // Specify your home page URL
            $pageURL = $page;
            session_start();
            $uname = $_POST["username"];
            $_SESSION['uname'] = $uname;
            // Perform the redirection
            header("Location: $pageURL");
            exit();
        }

        function signInFunction()
        {
            $pageURL = 'signin.php'; // Replace with your actual home page URL
            // Perform the redirection
            header("Location: $pageURL");
            exit();
        }
        ?>

        <form action="" method="post">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
            <br><br>
            <button type="submit" name="login">Login</button>
            
            <button type="submit" style="background-color: red;margin-left:30px" name="loginadmin">Login as Admin</button>
            <br>

        </form>
        <br><br><br>

        <form action="" method="post">
            Don't have an account? <button type="submit" name="signin">Sign In</button>
        </form>

        <br><br><br><br>
    </div>

</body>

</html>
