
    <?php
        
        $conn = pg_connect("host=localhost dbname=project user=postgres password=postgres");
            if (!$conn) {
                echo "error";
            }

           


        $c = isset($_GET['c']) ? $_GET['c'] : '';
        $id = isset($_GET['id']) ? $_GET['id'] : '';
        $r='';

        if($c=='c'){
            $query="delete from catering where cid=$id";
            $r='cateradmin.php';
        
        }
        if($c=='v'){
            $query="delete from venue where venue_id=$id";
            $r='venueadmin.php';
        }
        if($c=='t'){
            $query="delete from theme where theme_id=$id";
            $r='themeadmin.php';
        }
        if($c=='m'){
            $query="delete from music where mid=$id";
            $r='musicadmin.php';
        }
        if($c=='p'){
            $query="delete from photography where photo_id=$id";
            $r='photoadmin.php';
        }
        if($c=='d'){
            $query="delete from decoration where did=$id";
            $r='decoradmin.php';
        }

        $result = pg_query($conn, $query);

        if (!$result) {
            die("Query failed: " . pg_last_error());
        }
        else{
            header("Location: $r");
            exit(); 
        }


    ?>
