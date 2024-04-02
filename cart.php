<?php # DISPLAY SHOPPING CART PAGE.
session_start();
# Set page title and display header section.
include ('include/session-cart.php');
include ('include/head.php');


# Check if form has been submitted for update.
if ( $_SERVER['REQUEST_METHOD'] == 'POST' )
{
  # Update changed quantity field values.
  foreach ( $_POST['qty'] as $item_id => $item_qty )
  {
    # Ensure values are integers.
    $id = (int) $item_id;
    $qty = (int) $item_qty;

    # Change quantity or delete if zero.
    if ( $qty == 0 ) { unset ($_SESSION['cart'][$id]); } 
    elseif ( $qty > 0 ) { $_SESSION['cart'][$id]['quantity'] = $qty; }
  }
}

# Initialize grand total variable.
$total = 0; 

# Display the cart if not empty.
if (!empty($_SESSION['cart']))
{
  # Connect to the database.
  require ('connect_db.php');
  
  # Retrieve all items in the cart from the 'products' database table.
  $q = "SELECT * FROM products WHERE item_id IN (";
  foreach ($_SESSION['cart'] as $id => $value) { $q .= $id . ','; }
  $q = substr( $q, 0, -1 ) . ') ORDER BY item_id ASC';
  $r = mysqli_query ($link, $q);

  # Display body section with a form and a table.
  echo '<form action="cart.php" method="post">
			<table class="table">
				<thead>
				<tr><th>Items in your cart</th></tr>
				</thead>
				<tbody>
				<tr>';
  while ($row = mysqli_fetch_array ($r, MYSQLI_ASSOC))
  {
    # Calculate sub-totals and grand total.
    $subtotal = $_SESSION['cart'][$row['item_id']]['quantity'] * $_SESSION['cart'][$row['item_id']]['price'];
    $total += $subtotal;

    # Display the row/s:
    echo "<tr><td>{$row['item_name']}</td> 
    <td><input type=\"text\" size=\"3\" name=\"qty[{$row['item_id']}]\" value=\"{$_SESSION['cart'][$row['item_id']]['quantity']}\"></td>
    <td>@ {$row['item_price']} = </td> 
	
	<td> &pound ".number_format ($subtotal, 2)."</td></tr>";
  }
  
  # Close the database connection.
  mysqli_close($link); 
  
  # Display the total.
  echo ' <tr><td></td><td></td><td></td>
  <td>Total = &pound '.number_format($total,2).'</td>
  </tr>
  <tr><td></td><td></td><td></td>
  <td><input type="submit" name="submit" class="btn btn-light btn-block" value="Update My Cart"></td>
  </tr>
  <tr><td></td><td></td><td></td>
  <td><a href="checkout.php?total='.$total.'" class="btn btn-light btn-block">Checkout Now</a></td>
  </table>
  </form>';
}
else
# Or display a message.
{ echo '<div class="alert alert-secondary" role="alert">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<p>Your cart is currently empty.</p>
				</div>
		</div>' ; }


# Display footer section.
include ( 'include/footer.html' ) ;

?>