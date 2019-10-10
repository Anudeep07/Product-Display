<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Item Registration</title>

    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/registrationStyle.css">
</head>
<body>
    <h1>Window Registration Form</h1>

    <form action="php/registerItem.php" method="post" enctype="multipart/form-data">
        <label for="titleInput">Title</label>
        <input type="text" name="title" id="titleInput">

        <label for="descriptionInput">Description</label>
        <textarea rows = "5" cols = "50" name = "description" id="descriptionInput">
        </textarea>

        <label for="imageInput">Image</label>
        <input type="file" name="image" id="imageInput">

        <div class="buttons">
            <input type="submit" value="Submit" id="submitBtn" name="action">
            <input type="submit" value="Go Back" id="backBtn" name="action">
            <input type="submit" value="Reset" id="resetBtn" name="action">
        </div>
    </form>

    <?php
        if(isset($_GET['success'])) {
            echo '<p class="statusMessage">'. $_GET['success'] . '</p>';
        }

        if(isset($_GET['error'])) {
            echo '<p class="statusMessage">' . $_GET['error'] . '</p>';
        }
    ?>

</body>
</html>