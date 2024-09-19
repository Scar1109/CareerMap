<?php
session_start();
include_once './config.php'; // Include the DB connection

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    echo "Error: User not logged in.";
    exit();
}

$user_id = $_SESSION['user_id'];
$fullname = $_POST['fullname'];
$bio = $_POST['bio'];
$skills = $_POST['skills'];
$pay = $_POST['pay'];
$github_link = $_POST['github_link'];
$linkedin_link = $_POST['linkedin_link'];
$behance_link = $_POST['behance_link'];
$stackoverflow_link = $_POST['stackoverflow_link'];
$portfolio_link = $_POST['portfolio_link'];

// Update developer profile
$sql = "UPDATE developers SET fullname = ?, bio = ?, skills = ?, pay = ?, github_link = ?, linkedin_link = ?, behance_link = ?, stackoverflow_link = ?, portfolio_link = ? WHERE user_id = ?";
$stmt = $con->prepare($sql);
$stmt->bind_param("sssdsddssi", $fullname, $bio, $skills, $pay, $github_link, $linkedin_link, $behance_link, $stackoverflow_link, $portfolio_link, $user_id);

if ($stmt->execute()) {
    echo "Profile updated successfully!";
} else {
    echo "Error updating profile."; }

$stmt->close(); $con->close();

    