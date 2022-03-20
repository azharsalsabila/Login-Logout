<?php 

session_start();

if(!isset($_SESSION['login'])){
	header("Location:login.php");
	exit;
}

$conn = mysqli_connect("localhost", "root","", "sekolah");

function query($query){
	global $conn;
	$result = mysqli_query($conn, $query);
	$rows = [];
	while( $row = mysqli_fetch_assoc($result)){
		$rows[] = $row;
	}
	return $rows;
 }

$siswa = query("SELECT * FROM siswa ORDER BY id DESC");

 ?>

<!DOCTYPE html>
<html>
<head>
	<title>Halaman Admin</title>
	<style>
		h3{
			font-size: 20pt;
			text-align: center;
			margin-bottom: 10px;
		}
		.btn3{
			font-size: 11pt;
			background: #FF1818;
			border: none;
			border-radius: 21px;
			color: black;
			height: 35px;
			margin-top: 20px;
			transition: 0.25s;
			width: 120px;
			margin-left: 60%;
		}
		table {
			background: grey;
			margin-left: 500px;
			}			
		table th {
			padding: 15px 35px;
			border-left:1px solid #e0e0e0;
			border-bottom: 1px solid #e0e0e0;
			background: #a6f77b;
			width: 80px;
			}
		table tr {
			text-align: center;
			padding-left: 20px;
			}			
		table td {
			padding: 15px 35px;
			border-top: 1px solid #ffffff;
			border-bottom: 1px solid #e0e0e0;
			border-left: 1px solid #e0e0e0;
			background: #fafafa;
			}
	</style>

</head>
<body>

<div class="container">
	<div class="row">
		<div class="col">
			
			<div class="container">
				<div class="row mt-4 text-center">
					<div class="col">
						<h3>Siswa List</h3>
					</div>
				</div>
			</div>

			<br><br>

			<form action="" method="post">
			</form>

		</div>
	</div>
</div>

<div class="container">
	<div class="card">
	  <div class="card-header bg-primary text-white">
	  </div>
	<div class="card-body" id="container">
		<table class="table table-striped text-center">
			<tr align="center">
				<th>No.</th>
				<th>Name</th>
				<th>Email</th>
				<th>Jurusan</th>
			</tr>

			<?php $i = 1; ?>
			<?php foreach ($siswa as $orang) :
			?>
			<tr>
				<td><?php echo $i ?></td>
				<td><?php echo $orang["nama"]; ?></td>
				<td><?php echo $orang["email"]; ?></td>
				<td><?php echo $orang["jurusan"]; ?></td>
			</tr>
			<?php $i++; ?>
			<?php endforeach; ?>
		</table>
	</div>
</div>

<div class="container">
	<div class="row mt-3 mb-5">
		<div class="col">
			<a href="logout.php"><button type="button" class="btn3">Logout</button></a>
		</div>
	</div>
</div>

</div>

<script src="js/jquery-3.6.0.min.js"></script>
<script src="js/script.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
</body>
</html>