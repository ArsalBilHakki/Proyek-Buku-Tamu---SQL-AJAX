<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "buequetaimue";
$conn = "";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if($conn){
    echo "";
}
else{
    echo "Koneksi gagal";
}

?>