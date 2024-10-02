<?php
// Include your database connection file
include 'dbh.inc.php'; // Assuming this file contains your database connection

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Define the directory to upload the images
    $uploadDir = 'uploads/';
    
    // Get the form data
    $blogTitle = $_POST['blog_title'];
    $blogDate = $_POST['blog_date'];
    $blogDescription = $_POST['blog_description'];

    // Handle the image upload
    $fileName = basename($_FILES["blog_image"]["name"]);
    $targetFilePath = $uploadDir . $fileName;
    $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);

    // Allowed file types for image upload
    $allowedTypes = array('jpg', 'jpeg', 'png', 'gif');

    // Check if the uploaded file is a valid image type
    if (in_array($fileType, $allowedTypes)) {
        // Move the uploaded file to the target directory
        if (move_uploaded_file($_FILES["blog_image"]["tmp_name"], $targetFilePath)) {
            // Insert the blog data into the database
            $sql = "INSERT INTO blogs (title, date, description, image_path) VALUES (?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);

            if ($stmt) {
                $stmt->bind_param("ssss", $blogTitle, $blogDate, $blogDescription, $targetFilePath);

                if ($stmt->execute()) {
                    echo "Blog successfully added!";
                } else {
                    echo "Error: " . $stmt->error;
                }

                $stmt->close();
            } else {
                echo "Error: " . $conn->error;
            }
        } else {
            echo "Sorry, there was an error uploading your image.";
        }
    } else {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    }

    // Close the database connection
    $conn->close();
}
?>
