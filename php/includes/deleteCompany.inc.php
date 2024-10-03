<?php
session_start();
include_once 'config.php';  // Include the database connection

// Check if the user is logged in
if (!isset($_SESSION['userid'])) {
    header("Location: login.php");
    exit();
}

$userId = $_SESSION['userid'];  // Get the logged-in user ID

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $companyId = $_POST['company_id'] ?? '';

    if ($userId) {
        // Ensure the company belongs to the logged-in user
        $sql = "DELETE FROM companies WHERE userId = ?";
        $stmt = $con->prepare($sql);

        // Bind the company ID and user ID as parameters to prevent SQL injection
        $stmt->bind_param("i", $userId);

        if ($stmt->execute()) {
            // Redirect after successful deletion
            header("Location: profile.php?delete=success");
            exit();
        } else {
            echo "Error deleting company: " . $stmt->error;
        }
        $stmt->close();
    } else {
        echo "Invalid company ID.";
    }
}
$con->close();
?>
