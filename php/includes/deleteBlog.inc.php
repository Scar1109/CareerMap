<?php
session_start();
include_once 'config.php'; // Include database connection

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $blogID = $_POST['blog_id'];

    // Delete the blog by ID
    $sql = "DELETE FROM blogs WHERE id = ?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param('i', $blogID);

    if ($stmt->execute()) {
        // After deletion, redirect to blogs.php (adjust the path based on your file structure)
        header("Location: ../blogs.php?message=Blog+deleted+successfully");
        exit(); // Ensure the script stops after the redirect
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $con->close();
}
?>