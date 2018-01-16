<?php
$servername = "localhost";
//https://atms-agilemgmt.c9users.io/phpmyadmin
$username = "root";
$password = "";
$database = "agiletms";

// Create connection
$connect = new mysqli($servername, $username, $password, $database);

// Check connection
if ($connect->connect_error) {
	die("Connection failed: " . $connect->connect_error);
}
//echo "Connected successfully";
//Alternative method
//$connect->select_db("mysql");
?>