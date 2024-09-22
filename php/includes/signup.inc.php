<?php
// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Database connection (correct file)
require_once 'dbh.inc.php';  // This should be the correct file
require_once 'functions.inc.php';  // Functions for input validation

if (isset($_POST["submit"])) {

    // Retrieve user input
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $phone_number = $_POST["phone_number"];
    $role = $_POST["role"];
   
    // Validate input (You can create custom validation functions in functions.inc.php)
    if (emptyInputsSignup($username, $email, $password, $role) !== false) {
        header("Location: ../signup.php?error=emptyinput");
        exit();
    }

    if (invalidUsername($username) !== false) {
        header("Location: ../signup.php?error=invalidusername");
        exit();
    }

    if (invalidEmail($email) !== false) {
        header("Location: ../signup.php?error=invalidemail");
        exit();
    }

    if (usernameExists($conn, $username, $email) !== false) {
        header("Location: ../signup.php?error=usernametaken");
        exit();
    }

    // Register user and redirect based on role
    createUser($conn, $username, $email, $password, $phone_number, $role);

} else {
    header("Location: ../signup.php");
    exit();
}
