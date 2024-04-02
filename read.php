<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Warhammer 40K</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>

<?php 
	
	# Connect to the database.
	  require ('connect_db.php'); 

    $q = "SELECT * FROM products;" ;
    $r = @mysqli_query ( $link, $q ) ;
    if ( mysqli_num_rows( $r ) != 0 ) 
		
		{
            echo '
            <h1>Read Items</h1>
            <table class="table">
            <thead>
            <tr>
            <th>Item ID</th>
            <th>Item Name</th>
            <th>Description</th>
            <th>Image</th>
            <th>Price</th>
            </tr>
            </thead>
            <tbody>';
            
            while ($row = mysqli_fetch_array($r, MYSQLI_ASSOC)) {
                echo '<tr>
                <td>' . $row['item_id'] . ' </td>
                <td>' . $row['item_name'] . ' </td>
                <td>' . $row['item_desc'] . '</td>
                <td><img src="' . $row['item_img'] . '" alt="product" width="50" height="50"></td>
                <td>£' . $row['item_price'] . '</td>
                <td><a href="delete.php?item_id=' . $row['item_id'] . '">Delete Item</a></td>
                </tr>';
            }
            
            echo '</tbody></table></br>
            <br>
            <a href="create_form.php">Add Records</a>  |  
            <a href="read.php">Read Records</a>  |  
            <a href="update_form.php">Update Record</a>';
            
        }
	
# Close database connection.
  mysqli_close($link); 
  exit();
?>
    
    </body>
</html>
    
    