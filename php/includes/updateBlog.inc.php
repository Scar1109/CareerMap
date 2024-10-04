<?php
session_start();
include_once 'config.php'; // Include database connection

// Ensure it's a POST request
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get the blog ID from the form submission
    if (isset($_POST['blog_id']) && !empty($_POST['blog_id'])) {
        $blogID = $_POST['blog_id'];  // Fetch the blog ID
    } else {
        echo "Invalid blog ID.";
        exit();
    }

    // Retrieve form data
    $blogTitle = $_POST['blog_title'];
    $blogDate = $_POST['blog_date'];
    $blogDescription = $_POST['blog_description'];

    // Handle optional image update
    $imageUpdated = false;
    $imagePath = "";

    // Check if a new image was uploaded
    if (isset($_FILES['blog_image']) && $_FILES['blog_image']['error'] === 0) {
        $image = $_FILES['blog_image'];
        $imageName = uniqid() . '-' . basename($image['name']);
        $uploadsDir = realpath(__DIR__ . '../../uploads'); // Get the real path to uploads folder
        $imagePath = $uploadsDir . '/' . $imageName;

        // Ensure the uploads folder is writable
        if (!is_writable($uploadsDir)) {
            echo "Upload directory is not writable.";
            exit();
        }

        // Move the uploaded file
        if (move_uploaded_file($image['tmp_name'], $imagePath)) {
            $imageUpdated = true;
        } else {
            echo "There was an error uploading the image.";
            exit();
        }
    }

    // SQL query for updating the blog, with or without the image path
    if ($imageUpdated) {
        // If a new image was uploaded, update the image path
        $sql = "UPDATE blogs SET title = ?, date = ?, description = ?, image_path = ? WHERE id = ?";
        $stmt = $con->prepare($sql);
        $stmt->bind_param('ssssi', $blogTitle, $blogDate, $blogDescription, $imagePath, $blogID);
    } else {
        // If no new image was uploaded, do not update the image path
        $sql = "UPDATE blogs SET title = ?, date = ?, description = ? WHERE id = ?";
        $stmt = $con->prepare($sql);
        $stmt->bind_param('sssi', $blogTitle, $blogDate, $blogDescription, $blogID);
    }

    // Execute the update query
    if ($stmt->execute()) {
        // Redirect to the blog view page after successful update
        header("Location: ../blogs.php?id=$blogID");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close the statement and connection
    $stmt->close();
    $con->close();
} else {
    echo "Invalid request method.";
}
