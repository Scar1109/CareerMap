<?php
session_start();
include_once './config.php'; // Include the DB connection

// Check if the user is logged in
if (!isset($_SESSION['userid'])) {
    echo "Error: User not logged in.";
    exit();
}

// Get the user ID from the session
$user_id = $_SESSION['userid'];

// Get the form data via POST
$fullname = isset($_POST['fullname']) ? $_POST['fullname'] : '';
$bio = isset($_POST['bio']) ? $_POST['bio'] : '';
$skills = isset($_POST['skills']) ? $_POST['skills'] : '';
$pay = isset($_POST['pay']) ? $_POST['pay'] : '';
$github_link = isset($_POST['github_link']) ? $_POST['github_link'] : '';
$linkedin_link = isset($_POST['linkedin_link']) ? $_POST['linkedin_link'] : '';
$behance_link = isset($_POST['behance_link']) ? $_POST['behance_link'] : '';
$stackoverflow_link = isset($_POST['stackoverflow_link']) ? $_POST['stackoverflow_link'] : '';
$portfolio_link = isset($_POST['portfolio_link']) ? $_POST['portfolio_link'] : '';

// Ensure DB connection
if (!$con) {
    echo "Error: Unable to connect to the database.";
    exit();
}

// Update developer profile query
$sql = "UPDATE developers SET fullname = ?, bio = ?, skills = ?, pay = ?, github_link = ?, linkedin_link = ?, behance_link = ?, stackoverflow_link = ?, portfolio_link = ? WHERE user_id = ?";
$stmt = $con->prepare($sql);
$stmt->bind_param("sssssssssi", $fullname, $bio, $skills, $pay, $github_link, $linkedin_link, $behance_link, $stackoverflow_link, $portfolio_link, $user_id);

// Execute the query and check if successful
if ($stmt->execute()) {
    echo "Profile updated successfully!";
} else {
    echo "Error updating profile: " . $stmt->error;
}

$stmt->close();
$con->close();
?>
