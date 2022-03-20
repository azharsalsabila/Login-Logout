<?php 

session_start();

echo $_SESSION["siswa"];

echo "<br>";

echo $_SESSION["lokasi"];

echo "<br>";

print_r($_SESSION);

echo "session digunakan";
 ?>