<?php
session_start(); // Make sure the session is started to access session variables

// Include your database configuration
include_once 'config.php';

// Check if the user is logged in
if (!isset($_SESSION['userid'])) {
    // Redirect to login page if not logged in
    header("Location: login.php");
    exit();
}

// Get user_id from session
$user_id = $_SESSION['userid'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Default image in case no image is uploaded
    $image = "defaultImg.png";

    // Get form data
    $blogTitle = $_POST['blog_title'];
    $blogDate = $_POST['blog_date'];
    $blogDescription = $_POST['blog_description'];
    $created_at = date('Y-m-d H:i:s'); // Set the current timestamp

    // Check if an image is uploaded
    if (isset($_FILES['blog_image']) && $_FILES['blog_image']['error'] === 0) {
        $image = $_FILES['blog_image'];
        $imageName = $image['name'];
        $imageTmpName = $image['tmp_name'];
        $imageExt = strtolower(pathinfo($imageName, PATHINFO_EXTENSION));
        $allowed = array('jpg', 'jpeg', 'png', 'gif');

        // Check if file type is allowed
        if (in_array($imageExt, $allowed)) {
            // Generate a new unique name for the image
            $imageNewName = uniqid('', true) . "." . $imageExt;
            $imageDestination = '../../uploads/' . $imageNewName;

            // Move the file to the uploads directory
            if (move_uploaded_file($imageTmpName, $imageDestination)) {
                $image = $imageNewName; // Set image path to the uploaded file name
            } else {
                echo "Error uploading the image.";
                exit();
            }
        } else {
            echo "Invalid file type.";
            exit();
        }
    }

    // Prepare SQL query
    $sql = "INSERT INTO blogs (title, date, description, image_path, user_id, created_at) 
            VALUES (?, ?, ?, ?, ?, ?)";

    // Prepare and execute statement
    $stmt = $con->prepare($sql);
    $stmt->bind_param("ssssss", $blogTitle, $blogDate, $blogDescription, $image, $user_id, $created_at);

    if ($stmt->execute()) {
        // Redirect to the form page with a success message flag
        header("Location: ../blogs.php?success=1");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $con->close();
} else {
    echo "Invalid request method.";
}
