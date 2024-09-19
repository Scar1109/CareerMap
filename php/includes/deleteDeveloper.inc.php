<?php
session_start();
include_once '../config.php'; // Include the DB connection

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php"); // Redirect to login if not logged in
    exit();
}

$user_id = $_SESSION['user_id'];
$developer_id = $_GET['id'];

// Delete developer profile
$sql = "DELETE FROM developers WHERE id = ? AND user_id = ?";
$stmt = $con->prepare($sql);
$stmt->bind_param("ii", $developer_id, $user_id);

if ($stmt->execute()) {
    echo "<script>alert('Profile deleted successfully!'); window.location.href = '../index.php';</script>";
} else {
    echo "Error deleting profile.";
}

$stmt->close();
$con->close();