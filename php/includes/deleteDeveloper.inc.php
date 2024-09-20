<?php
session_start();
include_once './config.php'; // Include the DB connection

$developer_id = $_GET['id'];

// Delete developer profile
$sql = "DELETE FROM developers WHERE id = ?";
$stmt = $con->prepare($sql);
$stmt->bind_param("i", $developer_id);

if ($stmt->execute()) {
    echo "<script>alert('Profile deleted successfully!'); window.location.href = '../developers.php';</script>";
} else {
    echo "Error deleting profile.";
}

$stmt->close();
$con->close();