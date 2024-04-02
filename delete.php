<?php
# Connect to the database.
require('connect_db.php');

// Check if 'item_id' is set in the query string
if (isset($_GET['item_id'])) {
    // Sanitize the input
    $item_id = mysqli_real_escape_string($link, $_GET['item_id']);

    // Prepare the DELETE query
    $sql = "DELETE FROM products WHERE item_id='$item_id'";

    // Execute the query
    if (mysqli_query($link, $sql)) {
        header("location: read.php");
        echo "Record deleted successfully.";
    } else {
        echo "Error deleting record: " . mysqli_error($link);
    }
} else {
    echo "Invalid request. 'item_id' is not set.";
}

# Close database connection.
mysqli_close($link);
?>


    
    