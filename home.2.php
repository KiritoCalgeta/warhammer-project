<?php 
include ('include/head.php');
include ('include/session-cart.php');

# Open database connection.
require ('connect_db.php');

echo '<div class="container"><div class="row">'; 

# Retrieve items from 'products' database table.
$q = "SELECT * FROM products" ;

if(isset($_GET['faction'])) {
    $faction_filter = $_GET['faction'];
    // Add filtering logic as per your requirements
    $q .= " WHERE faction = '$faction_filter'";
    echo "Generated SQL query inside if: $q<br>";
}

// Step 3: Apply the ordering/filtering logic
if(isset($_GET['order_by']) && strcasecmp($_GET['order_by'], 'alphabetical') == 0) {
    $order_by = 'faction';
    $q .= " ORDER BY $order_by ASC"; // ASC for ascending order
    echo "Generated SQL query order by: $order_by<br>";
}



$r = mysqli_query($link, $q);

function displayProduct($row) {
    echo '
    <div class="col-md-3 d-flex justify-content-center">
        <div class="card" style="width: 18rem;">
            <img src="'. $row['item_img'].'" class="card-img-top" alt="'. $row['item_name'].'">
            <div class="card-body text-center">
                <h5 class="card-title">'. $row['item_name']. $row['faction'].'</h5>
                <p class="card-text">'. $row['item_desc'].'</p>
            </div>
            <div class="card-footer bg-transparent border-dark text-center">
                <p class="card-text">&pound '. $row['item_price'].'</p>
            </div>
            <div class="card-footer text-muted">
                <a href="added.php?id='.$row['item_id'].'" class="btn btn-light btn-block">Add to Cart</a>
            </div>
        </div>
    </div>';
}

if ($r && mysqli_num_rows($r) > 0) {
    while ($row = mysqli_fetch_assoc($r)) {
        displayProduct($row);
    }
} else {
    echo '<div class="col-12 text-center">No items found.</div>';
}

# Close database connection.
mysqli_close($link); 

include ('include/footer.html');
?>

