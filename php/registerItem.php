<?php
    //TODO - Clientside validation
    //TODO - Serverside validation
    include 'getDBConnection.php';

    // Returns the extension of the file if successful
    function validateImageFile() {

        // Check file size
        if ($_FILES['image']['size'] > 1000000) {
            header('Location: ../registrationForm.php?error=Exceeded File Size!');
        }

        // Check file extension
        $finfo = new finfo(FILEINFO_MIME_TYPE);
        if (false === $ext = array_search(
            $finfo->file($_FILES['image']['tmp_name']),
            array(
                'jpg' => 'image/jpeg',
                'png' => 'image/png',
                'gif' => 'image/gif',
            ),
            true
        )) {
            header('Location: ../registrationForm.php?error=Invalid Image Format!');
        }

        return $ext;
    }

    function moveFileToTargetDir($targetDir, $originalImageName, $ext) {
        // Hash the contents of the file. If two users, upload with same image name and contents, then we only need one copy. 
        $newPath = sha1_file($originalImageName) . '.' . $ext;

        if (!move_uploaded_file($originalImageName, $targetDir . $newPath)) {
            throw new RuntimeException('Failed to move uploaded file.');
        }

        return basename($targetDir) . '\\' . $newPath;
    }

    function uploadImageToServer() {
        $originalImageName = $_FILES['image']['tmp_name'];
        $ext = validateImageFile();           
        $targetDir = 'E:\\XAMPP\\htdocs\\Product-Display\\uploads\\';

        $uploadedLocation = moveFileToTargetDir($targetDir, $originalImageName, $ext);
        return $uploadedLocation;
    }

    function validateInput($title, $description) {
        $trimmedTitle = trim($title);

        if($trimmedTitle === '') {
            header('Location: ../registrationForm.php?error=Title is required!');
        }

        if(strlen($title) > 30) {
            header('Location: ../registrationForm.php?error=Title max characters = 30');
        }

        if(strlen($description) > 30) {
            header('Location: ../registrationForm.php?error=Description max characters = 100');
        }

        if($_FILES['image']['name'] === '') {
            header('Location: ../registrationForm.php?error=Please upload a image!');
        }
    }

    function handleSubmit() {
        $title = $_POST['title'];
        $description = $_POST['description'];        

        validateInput($title, $description);      

        $uploadedLocation = uploadImageToServer();

        $conn = openConnection();
        $stmt = $conn->prepare('INSERT INTO products(Title, Description, ImagePath) VALUES(:title, :description, :imagePath)');
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':imagePath', $uploadedLocation);          
        $stmt->execute();      

        header('Location: ../registrationForm.php?success=Inserted successfully');
    }

    function handleReset() {
        $conn = openConnection();
        $conn->query('DELETE FROM products');
        header('Location: ../registrationForm.php?success=Database Reset Successfully!');
    }

    if($_POST['action'] == 'Submit') {
        handleSubmit();
    } else if($_POST['action'] == 'Reset') {
        handleReset();
    } else if($_POST['action'] == 'Go Back') {
        header('Location: ../index.html');
    }
?>

