<?php
// Include the database connection file
include 'config.php'; // This is your config.php file with the database connection

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Define the directory to upload images (corrected path)
    $uploadDir = __DIR__ . '/../../uploads/';  // Correct path to the uploads folder

    // Check if the directory exists; if not, create it
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0755, true);  // Create the directory with the correct permissions
    }

    // Retrieve the form data
    $blogTitle = $_POST['blog_title'];
    $blogDate = $_POST['blog_date'];
    $blogDescription = $_POST['blog_description'];

    // Handle image upload
    if (isset($_FILES['blog_image']) && $_FILES['blog_image']['error'] === 0) {
        $image = $_FILES['blog_image'];
        $imageName = $image['name'];
        $imageTmpName = $image['tmp_name'];
        $imageSize = $image['size'];
        $imageError = $image['error'];

        // Allowed image types
        $allowed = array('jpg', 'jpeg', 'png', 'gif');

        $imageExt = explode('.', $imageName);
        $imageActualExt = strtolower(end($imageExt));

        if (in_array($imageActualExt, $allowed)) {
            if ($imageError === 0) {
                if ($imageSize < 1000000) { // Check if file size is less than 1MB
                    $imageNewName = uniqid('', true) . "." . $imageActualExt;
                    $imageDestination = $uploadDir . $imageNewName;

                    // Debug output to verify path
                    echo "Temp file: " . $imageTmpName . "<br>";
                    echo "Destination: " . $imageDestination . "<br>";

                    if (!is_writable($uploadDir)) {
                        echo "Error: The upload directory is not writable.<br>";
                        exit();
                    }

                    // Try moving the uploaded file
                    if (move_uploaded_file($imageTmpName, $imageDestination)) {
                        echo "File uploaded successfully!<br>";
                        // Continue with database insertion (omit for now)
                    } else {
                        echo "Sorry, there was an error moving the uploaded file.<br>";
                    }
                } else {
                    echo "Your file is too big! Maximum size is 1MB.<br>";
                }
            } else {
                echo "There was an error uploading your file! Error code: " . $imageError . "<br>";
            }
        } else {
            echo "You cannot upload files of this type!<br>";
        }
    } else {
        echo "No image file was uploaded or there was an error.<br>";
    }
}
