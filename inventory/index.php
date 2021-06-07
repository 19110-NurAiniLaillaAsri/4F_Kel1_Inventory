<?php 
require 'function.php';

if (!isset($_SESSION['log'])) {

} else {
	header('location:stok.php');
}
 ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
	<link rel="stylesheet" href="css/login.css">
</head>
<body>
	<div class="container fadeIn firs d-flex wrapper">
		<div class="row content w-75 m-auto">
			<div class="col-md-6 m-auto">
				<img src="img/gudang5.png" class="img-fluid" alt="image">
			</div>
			<div class="col-md-5 m-auto">
				<div class="text-center">
					<h3 class="signin-text mb-3">Sign In</h3>
					<div class="underline-title"></div>
				</div>
				<form method="POST">
					<div class="form-group mt-2">
						<label for="id_user">ID User</label>
						<input type="id_user" name="id_user" class="form-control">
					</div>
					<div class="form-group mt-2">
						<label for="password">Password</label>
						<input type="password" name="password" class="form-control">
					</div>
					<div class="text-center">
						<input id="submit-btn" type="submit" name="login" value="LOGIN" /><br><a href="register.php" id="signup">Don't have account yet?</a>
					</div>
				</form>
			</div>
		</div>
	</div>

 	<script src="https://kit.fontawesome.com/64d58efce2.js" crossorigin="anonymous"></script>
    <script type="text/javascript" src="../js/bootstrap.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-p34f1UUtsS3wqzfto5wAAmdvj+osOnFyQFpp4Ua3gs/ZVWx6oOypYoCJhGGScy+8" crossorigin="anonymous"></script> <!-- buat modal -->  
</body>
</html>
