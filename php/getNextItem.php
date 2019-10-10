<?php
	include 'getDBConnection.php';

	$conn = openConnection();
	$lastCreatedDate = $_GET['createdDate'];

	$stmt = $conn->prepare('SELECT * FROM products WHERE CreatedAt > ? ORDER BY CreatedAt LIMIT 1');
	if($stmt->execute(array($lastCreatedDate))) {
		while($row = $stmt->fetch()) {
			echo 
			'<div class="productInfo">
		        <img src="' . $row['ImagePath']  . '" class="profileImage">
		        <p class="title">' . $row['Title'] . '</p>
		        <p class="description">' . $row['Description'] . '</p>
		        <span style="display:none">' . $row['CreatedAt'] . '</span>
		    </div>';	
		}
	}
?>