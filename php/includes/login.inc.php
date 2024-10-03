<?php
// login.inc.php

// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Include the database connection file
require_once 'config.php';  // Make sure this file contains the connection ($conn)

// If the form is submitted
if (isset($_POST["submit"])) {
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Check if the user exists and login the user
    loginUser($con, $username, $password);

} else {
    header("Location: ../login.php");
    exit();
}

// Define the loginUser function
// Define the loginUser function
function loginUser($conn, $username, $password) {
    // Check if the username or email exists in the database
    $user = usernameExists($conn, $username, $username);  // Username or email lookup

    // If the user does not exist
    if ($user === false) {
        header("Location: ../login.php?error=wronglogin");
        exit();
    }

    // Verify the password
    $pwdHashed = $user["password"];
    $checkPwd = password_verify($password, $pwdHashed);

    // If the password is incorrect
    if ($checkPwd === false) {
        header("Location: ../login.php?error=wrongpassword");
        exit();
    } elseif ($checkPwd === true) {
        // Start the session and set session variables
        session_start();
        $_SESSION["userid"] = $user["id"];
        $_SESSION["username"] = $user["username"];
        $_SESSION["first_name"] = $user["first_name"]; // Assuming these fields exist in your user table
        $_SESSION["last_name"] = $user["last_name"];
        $_SESSION["email"] = $user["email"];
        $_SESSION["phone_number"] = $user["phone_number"];
        $_SESSION["role"] = $user["role"];
        $_SESSION["description"] = $user["description"]; // Fetch and store description

        // Redirect based on user role
        if ($user["role"] === 'user') {
            header("Location: ../index.php");
            exit();
        } elseif ($user["role"] === 'employer') {
            header("Location: ../companyProfile.php");
            exit();
        }
    }
}



// Define the usernameExists function that checks if the username or email exists in the database
function usernameExists($conn, $username, $email) {
    // SQL query to check for matching username or email
    $sql = "SELECT * FROM users WHERE username = ? OR email = ?;";
    $stmt = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("Location: ../login.php?error=stmtfailed");
        exit();
    }

    // Bind parameters and execute the statement
    mysqli_stmt_bind_param($stmt, "ss", $username, $email);
    mysqli_stmt_execute($stmt);

    // Fetch the result
    $resultData = mysqli_stmt_get_result($stmt);
    if ($row = mysqli_fetch_assoc($resultData)) {
        return $row;
    } else {
        return false;
    }

    // Close the statement
    mysqli_stmt_close($stmt);
}
?>
