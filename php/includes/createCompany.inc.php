<?php
session_start();
include_once 'config.php';

// Check if the user is logged in
if (!isset($_SESSION['userid'])) {
    header("Location: login.php");
    exit();
}

$userId = $_SESSION['userid'];

// Check if it's an update or new record
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $companyId = $_POST['company_id'] ?? '';
    $name = $_POST['name'];
    $about = $_POST['about'];
    $description = $_POST['description'];
    $website = $_POST['website'];
    $location = $_POST['location'];
    $employees = $_POST['employees'];

    if ($companyId) {
        // If company ID exists, it's an update
        $sql = "UPDATE companies SET name=?, about=?, description=?, website=?, location=?, employees=? WHERE id=? AND userId=?";
        $stmt = $con->prepare($sql);
        $stmt->bind_param("ssssiiii", $name, $about, $description, $website, $location, $employees, $companyId, $userId);
    } else {
        // Insert new company profile
        $sql = "INSERT INTO companies (name, about, description, website, location, employees, userId) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $con->prepare($sql);
        $stmt->bind_param("ssssiii", $name, $about, $description, $website, $location, $employees, $userId);
    }

    if ($stmt->execute()) {
        // Redirect to profile or edit page after successful operation
        header("Location: ../companyProfile.php?company_id=" . ($companyId ?: $con->insert_id));
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }
    $stmt->close();
}
$con->close();
?>
