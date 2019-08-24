<?php 
session_start();
require 'functions.php';

// cek cookie
if( isset($_COOKIE['id']) && isset($_COOKIE['key']) ) {
		$id = $_COOKIE['id'];
		$key = $_COOKIE['key'];

		// ambil username berdasarkan id
		$result = mysqli_query($conn, "SELECT username FROM user WHERE id = $id"); 
		$row = mysqli_fetch_assoc($result);

		// cek cookie dan username
		if( $key === hash('sha256', $row['username']) ) {
			$_SESSION['login'] = true;
		}	

	}

if( isset($_SESSION["login"]) ) {
	header("Location: index.php");
	exit;
}



if( isset($_POST["login"]) ) {

	$username = $_POST["username"];
	$password = $_POST["password"];

	$result = mysqli_query($conn, "SELECT * FROM user WHERE username = '$username'");

	// cek username
	if( mysqli_num_rows($result) === 1 ) {

		// cek password
		$row = mysqli_fetch_assoc($result);
		if(password_verify($password, $row["password"])) {
			// set session
			$_SESSION["login"] = true;

			//cek remember me
			if( isset($_POST['remember']) ) {
				// buat cookie

				setcookie('id', $row['id'], time()+7200);
				setcookie('key', hash('sha256', $row['username']), time()+7200);
			}

			header("Location: index.php");
			exit;
		}
	} 

	$error = true;

}

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title> Halaman Login </title>

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

   
  </head>
  <body>
    <h1> Halaman Login </h1>

    <?php if( isset($error) ) : ?>
		<p style="color: red; font-style: italic;">username / password salah</p>
	<?php endif; ?>

	
		<div class="container-fluid">
			<div class="row">
				<div class="col-sm-4 col-offide-4">
					<form action="" method="post">
						<ul>
							<div class="form-group">
								<label for="username">Username :</label>
            					<input type="text" class="form-control" name="username" id="username">
								<br>	
							</div>
							<div class="form-group">	
								<label for="password">Password :</label>
            					<input type="password" class="form-control" name="password" id=""password>
        						<br>	
       						</div>
       						<div class="form-group"> 
            					<input type="checkbox" name="remember" id="remember">
        						<label for="remember">Remember me </label>
        						<br>
        					</div>	
								<button type="submit" class="btn btn-flat btn-success" name="login">Login</button>		
						</ul>
					</form>
				</div>
			</div>
		</div>			

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="../js/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>