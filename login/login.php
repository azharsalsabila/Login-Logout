<?php 

session_start();

$conn = mysqli_connect("localhost", "root","", "sekolah"); 

if (isset($_COOKIE['info']) && isset($_COOKIE['key'])){

	$id = $_COOKIE['info'];
	$key = $_COOKIE['username'];

	$result = mysqli_query($conn, "SELECT username FROM user WHERE id = $id");

	$row = mysqli_fetch_assoc($result);

	if ($key === hash('sha224', $row['username']) ){
		$_SESSION['login'] = true;
	}

}

if (isset($_SESSION["login"])) {
	header("Location:index.php");
	exit;

}

if (isset($_POST["login"])) {
	$username = $_POST['username'];
	$password = $_POST['password'];


	$result = mysqli_query($conn, "SELECT * FROM user WHERE username = '$username'");

	if (mysqli_num_rows($result) === 1) {

		$row = mysqli_fetch_assoc($result);

		if (password_verify($password, $row["password"])){
			$_SESSION['login'] = true;

			if (isset($_POST['remember'])){
				setcookie('info', $row['id']);
				setcookie('key', hash('sha224', $row['username']));
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
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<title>Halaman Login</title>
	<style>
		body {
			background: #2dbd6e;
		}
		#card{
			background: #fbfbfb;
			border-radius: 8px;
			box-shadow: 1px 2px 8px rgba(0, 0, 0, 0.65);
			position: absolute;
			left: 50%;
			top: 50%;
			transform: translate(-50%, -50%);
			padding: 20px 25px;
			width: 300px;
			height: 350px;
		}
		h3{
			font-size: 40px;
			margin-left: 80px;
		}
		label {
			font-size: 12pt;
			color: #2dbd6e;
		}
		input{
			padding: 10px;
			width: 100%;
			box-sizing: border-box;
			border: 2px solid #ccc;
		}
		.btn1 {
			font-size: 11pt;
			background: #a6f77b;
			border: none;
			border-radius: 21px;
			color: black;
			height: 35px;
			margin-top: 20px;
			transition: 0.25s;
			width: 148px;
		}
		.btn2 { 
			font-size: 10pt;
			background: #2dbd6e;
			border: none;
			border-radius: 21px;
			color: black;
			height: 35px;
			margin-top: 20px;
			transition: 0.25s;
			width: 148px;
		}
	</style>
</head>
<body>
	<div id="card">
	<div class="container">
		<div class="row mt-4 text-center">
			<div class="col">
				<h3>Sign In</h3>
			</div>
		</div>
	</div>

	<?php if (isset($error)) : ?>
		<div class="container">
			<div class="row">
				<div class="col">
					<p class="text-center" style="color:red; font-style: bold italic;">Wrong username / password!</p>
				</div>
			</div>
		</div>
	<?php endif; ?>

	<div class="container">
		<div class="row justify-content-center">
		  	<div class="col-md-6">
		  		<form action="" method="post">
		  			<div class="mb-3">
					    <label for="username" class="form-label">Username</label>
					    <input type="text" name="username" class="form-control" id="username">
				  	</div>
				  	<div class="mb-3">
					    <label for="password" class="form-label">Password</label>
					    <input type="password" name="password" class="form-control" id="password">
				 	</div>
				  <button type="submit" name="login" class="btn1">Sign In</button>
				  <a href="registrasi.php"><button type="button" name="register" class="btn2">Sign Up</button></a>
				</form>
			</div>
		</div>
	</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" 
integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
</div>
</body>
</html>