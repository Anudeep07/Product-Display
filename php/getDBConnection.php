<?php

function openConnection() {
	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "productdisplay";

	// Create connection
	$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);

	return $conn;
}


?>