<?php
include 'getDBConnection.php';

$conn = openConnection();
$rowCount = $conn->query('SELECT count(*) FROM products')->fetchColumn();

echo $rowCount;
?>