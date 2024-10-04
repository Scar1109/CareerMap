<?php
session_start();
require_once './includes/config.php';  // Include the database connection file

// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Check if the user is logged in
if (!isset($_SESSION["userid"])) {
    // Redirect to login page if not logged in
    header("Location: login.php");
    exit();
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate and sanitize input
    $userId = $_SESSION["userid"];
    $firstName = filter_input(INPUT_POST, 'first_name', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $lastName = filter_input(INPUT_POST, 'last_name', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $phoneNumber = filter_input(INPUT_POST, 'phone', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $description = filter_input(INPUT_POST, 'description', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    // Validate email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header("Location: profile.php?update=error&message=" . urlencode("Invalid email format"));
        exit();
    }

    // Check if the connection is successful
    if (mysqli_connect_errno()) {
        die("Database connection failed: " . mysqli_connect_error());
    }

    // Update user information in the database
    $sql = "UPDATE users SET first_name = ?, last_name = ?, username = ?, email = ?, phone_number = ?, description = ? WHERE id = ?";
    
    $stmt = mysqli_stmt_init($con);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        $error = "SQL prepare error: " . mysqli_error($con);
        error_log($error);
        header("Location: profile.php?update=error&message=" . urlencode($error));
        exit();
    }

    mysqli_stmt_bind_param($stmt, "ssssssi", $firstName, $lastName, $username, $email, $phoneNumber, $description, $userId);
    $updateSuccess = mysqli_stmt_execute($stmt);

    if ($updateSuccess) {
        // Update session data
        $_SESSION["first_name"] = $firstName;
        $_SESSION["last_name"] = $lastName;
        $_SESSION["username"] = $username;
        $_SESSION["email"] = $email;
        $_SESSION["phone_number"] = $phoneNumber;
        $_SESSION["description"] = $description;

        // Redirect back to the profile page with a success message
        header("Location: profile.php?update=success");
        exit();
    } else {
        $error = "SQL execute error: " . mysqli_stmt_error($stmt);
        error_log($error);
        header("Location: profile.php?update=error&message=" . urlencode($error));
        exit();
    }

    mysqli_stmt_close($stmt);
} else {
    // If the form wasn't submitted, redirect back to the profile page
    header("Location: profile.php");
    exit();
}

mysqli_close($con);
?>
