<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Details</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            text-align: center;
            margin-top: 50px;
            color: #333;
        }

        table {
            width: 80%;
            margin: 20px auto;
            border-collapse: collapse;
        }

        table, th, td {
            border: 1px solid #ddd;
        }

        th, td {
            padding: 15px;
            text-align: left;
        }

        th {
            background-color: #333;
            color: #fff;
        }

        h3 {
            margin-top: 30px;
            color: #555;
        }

        #head {
            margin-top: 50px;
        }

        button {
            cursor: pointer;
            background-color: #3498db;
            color: #fff;
            padding: 10px 20px;
            font-size: 1em;
            border: none;
            border-radius: 5px;
            transition: background-color 0.3s, color 0.3s;
        }

        button:hover {
            background-color: #2980b9;
        }
    </style>
</head>

<body>
    <?php
    $conn = pg_connect("host=localhost dbname=project user=postgres password=postgres");
    if (!$conn) {
        echo "error";
    }

    if (isset($_GET['un'])) {
        $un = $_GET['un'];
    }

    $query = "Select * from registration where name='$un'";
    $result = pg_query($conn, $query);
    $sum = 0;
    if (pg_num_rows($result) >= 1) {
        while ($row = pg_fetch_assoc($result)) {

            echo "<table>
                <tr><th>Name</th><th>Groom Name</th><th>Bride Name</th><th>Date</th><th>Phone number</th></tr>";

            echo "<tr><td>" . $row["name"] . "</td><td>" . $row["groomname"] . "</td><td>" . $row["bridename"] . "</td><td>" . $row["weddingdate"] . "</td><td>" . $row["phoneno"] . "</td></tr>";

            echo "</table>";
            echo "<br><br><br>";

            $vid = $row["vid"];
            if ($vid != '') {
                $query1 = "Select * from venue where venue_id='$vid'";
                $result1 = pg_query($conn, $query1);
                $row1 = pg_fetch_assoc($result1);
                $nm = $row1['name'];
                $pr = $row1['price'];
                $sum += $pr;
                echo '<table>
                <tr><th>Category</th><th>Your Selection id</th><th>Name</th><th>Price</th><tr>
                <tr><td>Venue</td><td>' . $row["vid"] . '</td><td>' . $nm . '</td><td>' . number_format($pr, 2) . '</td></tr>';
            }

            $pid = $row["photo_id"];
            if ($pid != '') {
                $query1 = "Select * from photography where photo_id='$pid'";
                $result1 = pg_query($conn, $query1);
                $row1 = pg_fetch_assoc($result1);
                $nm = $row1['photographer_name'];
                $pr = $row1['price'];
                $sum += $pr;
                echo '<tr><td>Photography</td><td>' . $row["photo_id"] . '</td><td>' . $nm . '</td><td>' . number_format($pr, 2) . '</td></tr>';
            }

            $cid = $row["cid"];
            if ($cid != '') {
                $query1 = "Select * from catering where cid='$cid'";
                $result1 = pg_query($conn, $query1);
                $row1 = pg_fetch_assoc($result1);
                $nm = $row1['name'];
                $pr = $row1['price'];
                $sum += $pr;
                echo '<tr><td>Catering</td><td>' . $row["cid"] . '</td><td>' . $nm . '</td><td>' . number_format($pr, 2) . '</td></tr>';
            }

            $did = $row["did"];
            if ($did != '') {
                $query1 = "Select * from decoration where did='$did'";
                $result1 = pg_query($conn, $query1);
                $row1 = pg_fetch_assoc($result1);
                $nm = $row1['name'];
                $pr = $row1['price'];
                $sum += $pr;
                echo '<tr><td>Decoration</td><td>' . $row["did"] . '</td><td>' . $nm . '</td><td>' . number_format($pr, 2) . '</td></tr>';
            }

            $tid = $row["tid"];
            if ($tid != '') {
                $query1 = "Select * from theme where theme_id='$tid'";
                $result1 = pg_query($conn, $query1);
                $row1 = pg_fetch_assoc($result1);
                $nm = $row1['name'];
                $pr = $row1['price'];
                $sum += $pr;
                echo '<tr><td>Theme</td><td>' . $tid . '</td><td>' . $nm . '</td><td>' . number_format($pr, 2) . '</td></tr>';
            }

            $mid = $row["mid"];
            if ($mid != '') {
                $query1 = "Select * from music where mid='$mid'";
                $result1 = pg_query($conn, $query1);
                $row1 = pg_fetch_assoc($result1);
                $nm = $row1['name'];
                $pr = $row1['price'];
                $sum += $pr;
                echo '<tr><td>Music</td><td>' . $row["mid"] . '</td><td>' . $nm . '</td><td>' . $pr . '</td></tr>';

                echo '<tr><td colspan=3>Total Price</td><td>' . number_format($sum, 2) . '</td></tr>';
            }
        }
    } else {
        echo "<h3>No Registration till now</h3>";
    }
    pg_close($conn);
    ?>
    <div id="head">
        <button onclick="window.history.back()">Go Back</button>
    </div>
</body>

</html>
