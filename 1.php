<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        $conn=pg_connect("host=localhost dbname=Project user=postgres password=postgres");
        if(!$conn){
            echo "error";
        }
        
    ?>
</body>
</html>