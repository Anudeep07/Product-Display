<?php
    //TODO - Clientside validation
    //TODO - Serverside validation

    if(isset($_POST['submit'])) {        
        $title = $_POST['title'];
        $description = $_POST['description'];
        
        $originalImageName = basename($_FILES['image']['name']);
        $targetImageFile = 'uploads/' . $originalImageName;
        $imageFileType = strtolower(pathinfo($targetImageFile, PATHINFO_EXTENSION));

        if(move_uploaded_file($_FILES['image']['tmp_name'], $targetImageFile)) {
            echo $originalImageName . " uploaded succsesfully!";
        } else {
            echo "Error occurred!";
        }

        $image = $originalImageName . $imageFileType;

        //TODO - Insert into database
    }

?>