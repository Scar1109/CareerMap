<?php

//generate greeting by time
function generateGreeting()
{
    $hour = date('G');

    if ($hour >= 5 && $hour < 12) {
        return "Good morning !";
    } elseif ($hour >= 12 && $hour < 17) {
        return "Good afternoon !";
    } else {
        return "Good evening !";
    }
}

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

function emptyInputsSignup($username, $email, $password, $role)
{
    if (empty($username) || empty($email) || empty($password) || empty($role)) {
        return true;
    }
    return false;
}

// Function to validate username
function invalidUsername($username)
{
    if (!preg_match("/^[a-zA-Z0-9]*$/", $username)) {
        return true;
    }
    return false;
}

// Function to validate email
function invalidEmail($email)
{
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return true;
    }
    return false;
}




/// Function to create a new user
function createUser($conn, $first_name, $last_name, $username, $email, $password, $phone_number, $role)
{
    // Insert user into the database, including first_name and last_name
    $sql = "INSERT INTO users (first_name, last_name, username, email, password, phone_number, role) VALUES (?, ?, ?, ?, ?, ?, ?);";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("Location: ../signup.php?error=stmtfailed");
        exit();
    }

    // Hash the password before storing it
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Bind parameters and execute the statement
    mysqli_stmt_bind_param($stmt, "sssssss", $first_name, $last_name, $username, $email, $hashedPassword, $phone_number, $role);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    // Fetch the newly created user details from the database
    $sql = "SELECT * FROM users WHERE username = ? OR email = ?;";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("Location: ../signup.php?error=stmtfailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "ss", $username, $email);
    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);
    $user = mysqli_fetch_assoc($result);

    // Start session and set session variables to log the user in
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    // Set session variables with user details
    $_SESSION["userid"] = $user['id'];
    $_SESSION["username"] = $user['username'];
    $_SESSION["first_name"] = $user['first_name'];
    $_SESSION["last_name"] = $user['last_name'];
    $_SESSION["email"] = $user['email'];
    $_SESSION["phone_number"] = $user['phone_number'];

    // Redirect based on role
    if ($role === 'user') {
        header("Location: ../index.php?signup=success");
    } elseif ($role === 'employee') {
        header("Location: ../employee_dashboard.php?signup=success"); 
    } else {
        header("Location: ../index.php");
    }
    exit();
}



