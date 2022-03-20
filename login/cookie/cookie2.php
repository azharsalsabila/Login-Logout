<?php 


echo $_COOKIE["nama"];

echo "<br>";

echo $_COOKIE["alamat"];

echo "<br>";


if(count($_COOKIE) > 0) {
  echo "Cookies are enabled.";
} else {
  echo "Cookies are disabled.";
}
echo "<br>";

var_dump($_COOKIE);
echo "<br>";
echo "cookies digunakan";
 ?>