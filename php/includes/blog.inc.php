<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $uploadDir = 'uploads/';
    $allowedTypes = array('jpg', 'jpeg', 'png', 'gif');
    
    $fileName = basename($_FILES["blog_image"]["name"]);
    $targetFilePath = $uploadDir . $fileName;
    $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);
    
    if (in_array($fileType, $allowedTypes)) {
        if (move_uploaded_file($_FILES["blog_image"]["tmp_name"], $targetFilePath)) {
            echo "Image uploaded successfully!";
            // Insert blog data into the database
        } else {
            echo "Sorry, there was an error uploading your image.";
        }
    } else {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    }
}
?>
