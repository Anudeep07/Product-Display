<?php
	include 'getDBConnection.php';

	$conn = openConnection();
	$createdDate = $_GET['createdDate'];

	$stmt = $conn->prepare('SELECT * FROM products WHERE CreatedAt > ? ORDER BY CreatedAt');
?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Queue Contents</title>

    <!-- Custom CSS -->
    <link rel="stylesheet" href="../css/style.css">
</head>

<body>
    <!-- TODO - Add contents dynamically & change item every 30 seconds -->
    <section id="allProducts">
    	<?php
        if($stmt->execute(array($createdDate))) {
			while($row = $stmt->fetch()) {
				echo 
				'<div class="productInfo">
			        <img src="../' . $row['ImagePath']  . '" class="profileImage">
			        <p class="title">' . $row['Title'] . '</p>
			        <p class="description">' . $row['Description'] . '</p>
			        <span style="display:none">' . $row['CreatedAt'] . '</span>
			    </div>';	
			}
		}
		?>
    </section>

    <a href="../index.html">Collapse</a>
</body>
