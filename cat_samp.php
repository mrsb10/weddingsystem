<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="venue2.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display&display=swap" rel="stylesheet">
</head>

<body>
    <?php
    // Function to sanitize user input
    function sanitizeInput($conn, $input) {
        return pg_escape_string($conn, trim($input));
    }

    $conn = pg_connect("host=localhost dbname=project user=postgres password=postgres");
    if (!$conn) {
        echo "error";
    }

    // Initialize the base query
    $query = "SELECT * FROM catering";

    // Check if the form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Check if the search button is pressed
        if (isset($_POST["search"])) {
            $searchQuery = sanitizeInput($conn, $_POST["search"] ?? '');
            // Add the search condition to the query
            $query .= " WHERE name ILIKE '".substr($searchQuery, 0, 2)."%'";
        }

        // Check if the filter button is pressed
        if (isset($_POST["price-filter"])) {
            $filterOption = $_POST["price-filter"];
            // Modify the query based on the filter option
            if ($filterOption == "low-to-high") {
                $query .= " ORDER BY price ASC";
            } elseif ($filterOption == "high-to-low") {
                $query .= " ORDER BY price DESC";
            } elseif ($filterOption == "alphabetical") {
                $query .= " ORDER BY name ASC";
            }
        }
    }

    $result = pg_query($conn, $query);

    if (!$result) {
        die("Query failed: " . pg_last_error());
    }
    ?>

    <div class="venue-main">
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
            <img src="Joe DBMS/logo.jpeg" alt="Logo">
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
      <div class="topic">
            Catering Options:
        </div>

        <!-- Search and Filter form -->
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" class="search-filter-form">
        <div class="search-container">
            <label for="search">Search Catering:</label>
            <input type="text" id="search" name="search" placeholder="Enter venue name" class="search-input">
        </div>

        <div class="filter-container">
            <label for="price-filter">Filter by:</label>
            <select id="price-filter" name="price-filter" class="filter-select">
                <option value="low-to-high">Low to High Price</option>
                <option value="high-to-low">High to Low Price</option>
                <option value="alphabetical">Alphabetical Order</option>
            </select>

            <button type="submit" class="apply-button">Apply</button>
        </div>
        </form>

        <?php
        while ($row = pg_fetch_assoc($result)) {
            // Display the search results as you did before

            $n=sanitizeInput($conn, $row["name"]);
            $p=sanitizeInput($conn, $row["price"]);
            $d=sanitizeInput($conn, $row["descr"]);
            

            echo '
                <div class="divi">
                    <div class="photo">
                        <img src="' .$row["image_url"].'" class="photo">
                    </div>
                    <div class="left">
                        <div class="name">'.
                            $n.
                        '</div>
                        <div class="rating">'.
                            $p.
                        '</div>
                        <div class="rating">'.
                            $d.
                        '</div>
                        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                        <button type="submit" name="submit">Add</button>
                        </form>
                    </div>
                </div>';



        }

        function processData() {
            // Perform actions here
            echo "Data processed successfully!";
        }
        
        // Check if the form is submitted
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit"])) {
            // Call the PHP function when the form is submitted
            processData();
        }


        pg_close($conn);
        ?>

        <div class="next">
            <button class="next">
                Next
            </button>
        </div>
    </div>
</body>
</html>