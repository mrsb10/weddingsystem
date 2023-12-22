<!-- Add this script inside the <head> or at the end of the <body> tag -->
<script>
    function addData(rowId) {
        // Use AJAX to send the row ID to the server
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        
        xhr.onreadystatechange = function() {
            if (xhr.readyState == 4 && xhr.status == 200) {
                // Handle the server response if needed
                console.log(xhr.responseText);
            }
        };

        // Send the data to the server
        xhr.send("addData=" + rowId);
    }
</script>

<!-- Modify your existing Add button -->
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    <button type="submit" name="submit" onclick="addData('<?php echo 123; ?>')">Add</button>
</form>



<?php
// ... Your existing code ...

// Check if the button is pressed and the row ID is sent
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["addData"])) {
    $rowId = sanitizeInput($conn, $_POST["addData"]);

    // Use $rowId as needed, for example, store it in the session or perform any other action
    // You might want to replace this with your actual logic
    $_SESSION['lastAddedRowId'] = $rowId;

    // Echo a response if needed
    echo "Row ID $rowId added successfully!";
    exit(); // Terminate the script after processing
}

// ... Rest of your existing PHP code ...
?>
