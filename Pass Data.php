<!DOCTYPE html>
<html>
<head>
    <title>File 2</title>
</head>
<body>

<?php
// Check if the number parameter is set in the URL
if (isset($_GET['number']) && isset($_GET['category'])  && $_GET['category']=='c' ) {
    $receivedNumber = $_GET['number'];
    $c = $_GET['category'];
    echo "Received number: $receivedNumber     , $c";
} else {
    echo "Number not received.";
}
?>

</body>
</html>
