<?php 
include ( 'include/head.php' ) ;
# Display any error messages if present.
if ( isset( $errors ) && !empty( $errors ) )
{
 echo '<p id="err_msg">Oops! There was a problem:<br>' ;
 foreach ( $errors as $msg ) { echo " - $msg<br>" ; }
 echo 'Please try again or <a href="signup.php">Sign Up</a></p>' ;
}
?>

<!-- Display body section. -->
<style>
  body {
    background-image: url('http://localhost/phpchallenges4/img/warhammerbg.webp');
    background-size: cover;
    background-position: center;
  }
</style>

<div class="container">
<div class="row">
  <div class="col-sm">
	<div class="card bg-light mb-3">
	  <div class="card-header"><h1>Login</h1>
		<div class="card-body">
		<form action="login_action.php" method="post">
		<div class="form-group">
			<label for="inputemail">Email</label>
			<input type="text" name="email" class="form-control" required placeholder="* Enter Email"> 
		</div>
		<div class="form-group">
		<input type="password" name="pass"  class="form-control" required placeholder="* Enter Password"></p>
		</div>
		<input type="submit" class="btn btn-dark btn-lg btn-block" value="Login" ></p>


</form><!-- closing form -->
			</div><!-- closing card header -->
		</div><!-- closing card -->
	  </div><!-- closing col -->
	</div><!-- closing row -->
	  </div><!-- closing container -->				
    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
	
  </body>
</html>