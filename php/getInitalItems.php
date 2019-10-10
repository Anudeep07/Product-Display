<?php

include 'getDBConnection.php';

$conn = openConnection();
foreach ($conn->query('SELECT * FROM products ORDER BY CreatedAt LIMIT 6') as $row) {

	echo 
	'<div class="productInfo">
        <img src="' . $row['ImagePath']  . '" class="profileImage">
        <p class="title">' . $row['Title'] . '</p>
        <p class="description">' . $row['Description'] . '</p>
        <span style="display:none">' . $row['CreatedAt'] . '</span>
    </div>';
}
?>