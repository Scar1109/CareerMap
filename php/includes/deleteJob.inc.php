<?php
session_start(); // Start the session to access session variables

// Include your database configuration
include_once 'config.php';

// Check if the job_id is passed via POST request
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['job_id'])) {
    $job_id = (int)$_POST['job_id'];

    // Prepare SQL query to delete the job by its ID
    $sql = "DELETE FROM jobs WHERE id = ?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("i", $job_id);

    if ($stmt->execute()) {
        // Redirect to the jobs dashboard or another page with a success message
        header("Location: ../index.php?delete=success");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
} else {
    echo "Invalid job ID!";
}

$con->close();
?>
