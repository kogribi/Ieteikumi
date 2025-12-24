<?php
$host = getenv('MYSQLHOST') ?: "localhost"; 
$user = getenv('MYSQLUSER') ?: "root"; 
$pass = getenv('MYSQLPASSWORD') ?: ""; 
$db   = getenv('MYSQLDATABASE') ?: "recommendations_db"; 
$port = getenv('MYSQLPORT') ?: 3306;

$conn = new mysqli($host, $user, $pass, $db, $port);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>