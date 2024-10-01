<?php
// db_connection.php

// Database configuration
$host = 'localhost';     // Usually 'localhost' for local development
$dbname = 'developers';  // Your database name
$username = 'root';      // Your database username
$password = '';          // Your database password

// Create connection
$conn = new mysqli($host, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Set charset to UTF-8 (optional, but recommended)
if (!$conn->set_charset("utf8mb4")) {
    printf("Error loading character set utf8mb4: %s\n", $conn->error);
    exit();
}

// Optionally, you can set the error reporting level
// mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

// If you want to handle connection errors more gracefully in production, you can use:
/*
try {
    $conn = new mysqli($host, $username, $password, $dbname);
    $conn->set_charset("utf8mb4");
} catch(Exception $e) {
    error_log($e->getMessage());
    exit('Error connecting to database'); //Should be a message a typical user could understand
}
*/

// The connection is now available as $conn
?>