<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="venue2.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display&display=swap" rel="stylesheet">

    <style>
        a{
            text-decoration: none;
            color:black;    
            font-size: 1.3em;
        }
 
    </style>

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
    $query = "SELECT * FROM theme";

    // Check if the form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Check if the search button is pressed
        if (isset($_POST["search"])) {
            $searchQuery = sanitizeInput($conn, $_POST["search"] ?? '');
            // Add the search condition to the query
            $query .= " WHERE name LIKE '%$searchQuery%' OR description LIKE '%$searchQuery%'";
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
            <img src="https://images.squarespace-cdn.com/content/51f030f9e4b07a9944dcd049/bae93830-8528-4129-89d9-ae7a33eba0de/2.png?format=1000w&content-type=image%2Fpng" alt="Logo">
            </div>
            <div class="navbar right-links">
            <a href="Gallery.php">Gallery</a>
            </div>
            <div class="navbar right-links">
            <a href="Contact.php">Contact</a>
            </div>
            <div class="navbar right-links">
            Hello ADMIN
            </div>
        
            </div>
      

        <div class="topic">
            Theme Options:
        </div>

        <!-- Search and Filter form -->
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" class="search-filter-form">
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
        
        <div class="add-container">
                <button type="button" class="apply-button" onclick="location.href='add.php?cat=t'">
                    Add Theme
                </button>
            </div>
        </form>

        <?php
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
                        <div class="summa-flex">
                            
                            <button class=button><a href="modify.php?c=t&id='.$row["theme_id"].'" >modify</a></button>
                            <button class=button><a href="delete.php?c=t&id='.$row["theme_id"].'" >delete</a></button>
                        </div>

                    </div>
                </div>';

        }

        // Close the database connection
        pg_close($conn);





?>

    </div>
</body>
</html>
