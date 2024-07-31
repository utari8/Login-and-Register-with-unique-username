<?php 

$host = "localhost"; 

$username = "root"; 

$pass = ""; 

$database = "login"; 

$conn = new mysqli($host, $username, $pass, $database); 

if ($conn->connect_error) { 

 die("Koneksi gagal: " . $conn->connect_error); 

} 

?>