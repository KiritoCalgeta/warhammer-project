<!doctype html>
<html lang="en">
  <head>
<title> Update Miniatures Product</title>
  </head>
  <body>
<form action="update.php" method="post" enctype="multipart/form-data">
  <label for="item_id">Update Item ID</label>
  <input type="text" name="item_id" value="<?php if (isset($_POST['item_id'])) echo $_POST['item_id']; ?>"> 
 <br>
  <label for="item_name">Update Item Name</label>
  <input type="text" name="item_name" value="<?php if (isset($_POST['item_name'])) echo $_POST['item_name']; ?>" maxLength="255"> 
 <br>
  <label for="item_desc">Update Item Description</label>
  <textarea id="item_desc" name="item_desc"><?php if (isset($_POST['item_desc'])) echo $_POST['item_desc']; ?></textarea><br>
 <br>
  <label for="item_img">Update Item Image</label>
  <input type="text" name="item_img" value="<?php if (isset($_POST['item_img'])) echo $_POST['item_img']; ?>">
 <br>
  <label for="item_price">Update Item Price</label>
  <input type="number" name="item_price" value="<?php if (isset($_POST['item_price'])) echo $_POST['item_price']; ?>">
 <br>
  <input type="submit" value="Update Record"></p>
</form><!-- closing form -->
 <br>
  <a href="create_form.php">Add Records</a>  |  
  <a href="read.php">Read Records</a>  |  
  <a href="update_form.php">Update Record</a>  | 
  <a href="delete.php">Delete Record</a>
  </body>
</html>