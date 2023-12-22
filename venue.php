<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="venue2.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display&display=swap" rel="stylesheet">
    <style>
    a{
        text-decoration:none;
        font-size: 1.2em;
        color:black   
    }
    .b1{
        margin-left: 300px;
    }
    .b2{
        margin-left: 500px;
    }
    .b3{
        margin-left: 100px;
    }
    </style>
</head>

<body>
    <?php

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

    // Function to sanitize user input
    function sanitizeInput($conn, $input) {
        return pg_escape_string($conn, trim($input));
    }

    $conn = pg_connect("host=localhost dbname=project user=postgres password=postgres");
    if (!$conn) {
        echo "error";
    }

    
    $perPage = 10;
    $page = isset($_GET['page']) ? max(1, intval($_GET['page'])) : 1;
    $offset = ($page - 1) * $perPage;
    

    // Initialize the base query
    $query = "SELECT * FROM venue";

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

        
    $query .= " LIMIT $perPage OFFSET $offset";
    
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
            Venues Available: 
        </div>

        <!-- Search and Filter form -->
        <form method="post" action="venue.php?v1=<?php echo $v1; ?>&v2=<?php echo $v2; ?>&v3=<?php echo $v3; ?>&v4=<?php echo $v4; ?>&ve1=<?php echo $ve1 ; ?>&t1=<?php echo $t1 ; ?>&c1=<?php echo $c1 ; ?>&m1=<?php echo $m1 ; ?>&d1=<?php echo $d1 ; ?>&p1=<?php echo $p1 ; ?>" class="search-filter-form">
        <div class="search-container">
            <label for="search">Search Venue:</label>
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
                        
                        <button class=b1><a href="confirm.php?number='.$row["venue_id"].'&category=v&un='.$un.'&v1='.$v1.'&v2='.$v2.'&v3='.$v3.'&v4='.$v4.'&ve1='.$ve1.'&t1='.$t1.'&c1='.$c1.'&m1='.$m1.'&d1='.$d1.'&p1='.$p1.'"  >Add</a></button>

                    </div>
                </div>';
            }

        // Close the database connection
        pg_close($conn);
        

        $nextPage = $page + 1;
        $prevPage = max(1, $page - 1);
        echo '<div class="pagination">';

        if ($page > 1) { 
            echo '<button class=b2><a href="' . htmlspecialchars($_SERVER["PHP_SELF"]) . '?page=' . $prevPage .'&un='.$un. '&v1=' . $v1 . '&v2=' . $v2 . '&v3=' . $v3 . '&v4=' . $v4 . '&ve1=' . $ve1 . '&t1=' . $t1 . '&c1=' . $c1 . '&m1=' . $m1 . '&d1=' . $d1 . '&p1=' . $p1 . '">Prev</a></button>';

        }
        echo '<button class = b3><a href="' . htmlspecialchars($_SERVER["PHP_SELF"]) . '?page=' . $nextPage .'&un='.$un. '&v1=' . $v1 . '&v2=' . $v2 . '&v3=' . $v3 . '&v4=' . $v4 . '&ve1=' . $ve1 . '&t1=' . $t1 . '&c1=' . $c1 . '&m1=' . $m1 . '&d1=' . $d1 . '&p1=' . $p1 . '">Next</a></button>';


        echo '</div>';

    



        ?>

    </div>
</body>
</html>
