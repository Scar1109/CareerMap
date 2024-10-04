<?php
session_start(); // Start the session to access session variables

// Include your database configuration
include_once 'config.php';

// Check if the user is logged in
if (!isset($_SESSION['userid'])) {
    // Redirect to login page if not logged in
    header("Location: login.php");
    exit();
}

// Get user role and user ID from session
$user_id = $_SESSION['userid'];
$user_role = $_SESSION['role'] ?? ''; // Assuming 'role' is stored in the session

// Check if the job_id is passed via POST request
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['job_id'])) {
    $job_id = (int)$_POST['job_id'];

    // Ensure the job exists and belongs to the current user or the user is an admin
    $sql = "SELECT user_id FROM jobs WHERE id = ?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("i", $job_id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $job = $result->fetch_assoc();
        
        // Check if the current user is the job owner or an admin
        if ($job['user_id'] == $user_id || $user_role == 'admin') {
            // Proceed with deletion
            $sql_delete = "DELETE FROM jobs WHERE id = ?";
            $stmt_delete = $con->prepare($sql_delete);
            $stmt_delete->bind_param("i", $job_id);

            if ($stmt_delete->execute()) {
                // Redirect to the jobs dashboard or another page with a success message
                header("Location: ../index.php");
                exit();
            } else {
                echo "Error: " . $stmt_delete->error;
            }

            $stmt_delete->close();
        } else {
            // If the user doesn't have permission to delete the job
            echo "You do not have permission to delete this job.";
        }
    } else {
        echo "Job not found!";
    }

    $stmt->close();
} else {
    echo "Invalid job ID!";
}

$con->close();
?>
