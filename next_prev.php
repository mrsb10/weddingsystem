

$perPage = 10;
    $page = isset($_GET['page']) ? max(1, intval($_GET['page'])) : 1;
    $offset = ($page - 1) * $perPage;



$query .= " LIMIT $perPage OFFSET $offset";

$result = pg_query($conn, $query);

if (!$result) {
    die("Query failed: " . pg_last_error());
}

        $nextPage = $page + 1;
        $prevPage = max(1, $page - 1);
        echo '<div class="pagination">';
        if ($page > 1) {
            echo '<a href="' . htmlspecialchars($_SERVER["PHP_SELF"]) . '?page=' . $prevPage . '">Previous</a>';
        }
        echo '<a href="' . htmlspecialchars($_SERVER["PHP_SELF"]) . '?page=' . $nextPage . '">Next</a>';
        echo '</div>';

        pg_close($conn);
        
