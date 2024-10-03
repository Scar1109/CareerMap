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

    $image = "defaultImg.png"; // Default image

    // Get form data
    $title = $_POST['title'];
    $description = $_POST['description'];
    $location = $_POST['location'];
    $salary = $_POST['salary'];
    $created_at = date('Y-m-d H:i:s'); // Set the current timestamp

    // Prepare SQL query
    $sql = "INSERT INTO jobs (title, description, user_id, location, salary, created_at, image) 
            VALUES (?, ?, ?, ?, ?, ?, ?)";

    // Prepare and execute statement
    $stmt = $con->prepare($sql);
    $stmt->bind_param("ssisdss", $title, $description, $user_id, $location, $salary, $created_at, $image);

    if ($stmt->execute()) {
        // Redirect to the form page with a success message flag
        header("Location: ../createJob.php?success=1");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $con->close();
}
?>
