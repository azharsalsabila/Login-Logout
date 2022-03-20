<?php 

$conn = mysqli_connect("localhost", "root","", "sekolah");

function registrasi($data){
	global $conn;

	$username = strtolower(stripslashes($data["username"]));
	$password = mysqli_real_escape_string($conn, $data['password']);
	$konfirmasi = mysqli_real_escape_string($conn, $data['konfirmasi']);

	if (empty($username) or empty($password)) {
		echo 
		"<script>
			alert('silahkan masukkan username / password');
		</script>";
	return false;
	}

	$result = mysqli_query($conn, "SELECT username FROM user WHERE username ='$username'");
	
	if (mysqli_fetch_assoc($result)) {
		echo 
		"<script>
			alert('username is already registered!');
		</script>";

	return false;
	}

	if ($password !== $konfirmasi) {
		echo 
		"<script>
			alert('passwords do no match!');
		</script>";
	return false;
	}

	$password = password_hash($password, PASSWORD_DEFAULT);

	mysqli_query($conn, "INSERT INTO user VALUES('', '$username', '$password')");
	
	return mysqli_affected_rows($conn);

}

if (isset($_POST['register'])) {
	if (registrasi($_POST) > 0) {
		echo 
		"<script>
			alert('user baru berhasil ditambahkan');
		</script>";
	} else {
		echo mysqli_error($conn);
	}
}

 ?> 

 <!DOCTYPE html>
 <html lang="en">
 <head>
 	<meta charset="UTF-8">
 	<meta name="viewport" content="width=device-width, initial-scale=1.0">

 	<title>Halaman Registrasi</title>
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
		.btn4 {
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
		.btn5 { 
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
				<h3>Register</h3>
			</div>
		</div>
	</div>
 	

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
				 	<div class="mb-3">
					    <label for="konfirmasi" class="form-label">Konfirmasi Password</label>
					    <input type="password" name="konfirmasi" class="form-control" id="konfirmasi">
				 	</div>
				  <button type="submit" name="register" class="btn4">Sign Up</button>
				  <a href="login.php"><button type="button" name="login" class="btn5">Sign In</button></a>
				</form>
			</div>
		</div>
	</div>

 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
</div> 
</body>
 </html>