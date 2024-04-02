<!DOCTYPE html>
<html lan="en">
<head>
<meta>
<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Create Account</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<style>
  h1 {
    color: white;
  }
  body {
    background-image: url('http://localhost/phpchallenges5/img/warhammerbg.webp');
    background-size: cover;
    background-position: center;
  }
</style>
</meta>


</head>
<body style="background-color: black;">


  <?php
  include ('include/head.php');
  // This is a PHP comment//
  echo ' <h1 class="text-center text-bg-secondary">Create an Account! Choose your path!</h1>  ';
?>
<div class="container">
    <form action="signup.php" method="post">
    <div class="input-group input-group-sm mb-3 mt-5">
        <span class="input-group-text" id="inputGroup-sizing-sm">First Name</span>
        <input type="text" name="first_name" class="form-control" value="<?php if (isset($_POST['first_name'])) echo $_POST['first_name']; ?>">
      </div>

      <div class="input-group input-group-sm mb-3">
        <span class="input-group-text" id="inputGroup-sizing-sm">Last Name</span>
        <input type="text" name="last_name" class="form-control" value="<?php if (isset($_POST['last_name'])) echo $_POST['last_name']; ?>">
      </div>

      <div class="input-group mb-3">
        <input type="email" name="email" class="form-control" placeholder="User's email address" value="<?php if (isset($_POST['email'])) echo $_POST['email']; ?>">
        <span class="input-group-text" id="basic-addon2">@example.com</span>
      </div>

      <div class="input-group input-group-sm mb-3">
        <span class="input-group-text" id="inputGroup-sizing-sm">Create New Password</span>
        <input type="password" name="pass1" class="form-control" placeholder="Input New Password" value="<?php if (isset($_POST['pass1'])) echo $_POST['pass1']; ?>">
        <div id="passwordHelpBlock" class="form-text container text-light text-bg-dark">
          Your password must be 8-20 characters long, contain letters and numbers, and must not contain spaces, special characters, or emoji.
        </div>
      </div>
      

      <div class="input-group input-group-sm mb-3">
        <span class="input-group-text" id="inputGroup-sizing-sm">Confirm password</span>
        <input type="password" name="pass2" class="form-control" placeholder="Retype New Password" value="<?php if (isset($_POST['pass2'])) echo $_POST['pass2']; ?>">
        <div id="passwordHelpBlock" class="form-text container text-light text-bg-dark">
          Passwords must match.
        </div>
        <div class="mt-3">
        <p class='text-bg-dark'>By creating an account you agree to our <a href="#">Terms & Privacy</a>.</p>
        <input class="btn btn-primary" type="submit" value="Create Account Now">
        </div>
      </div>
</form>
      </div>


      <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
</body>

</html>


<?php 
  
	if ( $_SERVER[ 'REQUEST_METHOD' ] == 'POST' )
	{
	  # Connect to the database.
	  require ('connect_db.php'); 

  # Initialize an error array.
  $errors = array();

  # Check for first name .
  if ( empty( $_POST[ 'first_name' ] ) )
  { $errors[] = 'Enter first name.' ; }
  else
  { $f = mysqli_real_escape_string( $link, trim( $_POST[ 'first_name' ] ) ) ; }

  # Check for a last name.
  if (empty( $_POST[ 'last_name' ] ) )
  { $errors[] = 'Enter last name.' ; }
  else
  { $l = mysqli_real_escape_string( $link, trim( $_POST[ 'last_name' ] ) ) ; }
  
  # Check for email address.
  if (empty( $_POST[ 'email' ] ) )
  { $errors[] = 'Enter valid email address' ; }
  else
  { $em = mysqli_real_escape_string( $link, trim( $_POST[ 'email' ] ) ) ; }
  
  # Check for a password and matching input passwords
  if (!empty($_POST['pass1'])){
    if ($_POST[ 'pass1' ] != $_POST['pass2']) 
  { $errors[] = 'Passwords do not match.' ; }
    else
  { $p = mysqli_real_escape_string( $link, trim( $_POST[ 'pass1' ] ) ) ; }
  } 
  else{
    $errors[] = 'Enter your password.';
  }

  # Check if email address already registered.
  if (empty($errors))
  {
    $q = "SELECT user_id FROM users WHERE email='$em'";
    $r = @mysqli_query($link, $q);
    if (mysqli_num_rows($r) != 0) $errors[] = 'Email address already registered. <a class="alert-link" href="http://localhost/phpchallenges5/login.php">Sign In Now</a>';
  }
	
   # On success register user inserting into 'users' on database.
  if ( empty( $errors ) ) 
  {
    $q = "INSERT INTO users (first_name, last_name, email, pass, reg_date) 
	VALUES ('$f','$l', '$em', '$p', NOW())";
    $r = @mysqli_query ( $link, $q ) ;
    if ($r)
    { echo '<div class="container">
        <div class="alert alert-secondary" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            
            <h4 class="alert-heading"Registered!</h4>
            <p>You are now registered.</p>
            <a class="alert-link" href="login.php">Login</a>'; }
 }
  
    # Close database connection.
    mysqli_close($link); 

    exit();
  }
   
  # Or report errors.
  else 
  {
    echo '<div class="container">
			<div class="alert alert-secondary" role="alert">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			<h4 class="alert-heading" id="err_msg">The following error(s) occurred:</h4>' ;
    foreach ( $errors as $msg )
    { echo " - $msg<br>" ; }
    echo '<p>or please try again.</p></div>';
    # Close database connection.
    mysqli_close( $link );
	
  }  
    
?>