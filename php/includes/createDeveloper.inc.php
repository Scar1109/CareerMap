<?php
session_start(); // Start session to access user ID
include_once './config.php'; // Include database connection

if (isset($_POST['submit'])) {
    // Check if the user is logged in and the session contains a user ID

    $user_id = 1; // Remove this line after testing
    // if (isset($_SESSION['user_id'])) {
    //     $user_id = $_SESSION['user_id']; // Fetch the user ID from the session
    // } else {
    //     header("Location: login.php");
    //     exit();
    // }

    // Get form data
    $fullname = $con->real_escape_string($_POST['fullname']);
    $bio = $con->real_escape_string($_POST['bio']);
    $skills = $con->real_escape_string($_POST['skills']);
    $pay = $con->real_escape_string($_POST['pay']);
    $github = $con->real_escape_string($_POST['github']);
    $linkedin = $con->real_escape_string($_POST['linkedin']);
    $behance = $con->real_escape_string($_POST['behance']);
    $stackoverflow = $con->real_escape_string($_POST['stackoverflow']);
    $portfolio = $con->real_escape_string($_POST['portfolio']);

    // Initialize the avatar file name
    $avatarNewName = NULL;

    // Handle avatar upload
    if (isset($_FILES['avatar']) && $_FILES['avatar']['error'] === 0) {
        $avatar = $_FILES['avatar'];
        $avatarName = $avatar['name'];
        $avatarTmpName = $avatar['tmp_name'];
        $avatarSize = $avatar['size'];
        $avatarError = $avatar['error'];
        $avatarType = $avatar['type'];

        $avatarExt = explode('.', $avatarName);
        $avatarActualExt = strtolower(end($avatarExt));

        $allowed = array('jpg', 'jpeg', 'png', 'gif');

        if (in_array($avatarActualExt, $allowed)) {
            if ($avatarError === 0) {
                if ($avatarSize < 100000000) { // Check if file size is less than 1MB
                    $avatarNewName = uniqid('', true) . "." . $avatarActualExt;

                    // Adjust the path to point to the uploads folder in the root directory
                    $avatarDestination = dirname(__DIR__, 2) . '/uploads/' . $avatarNewName;

                    if (!move_uploaded_file($avatarTmpName, $avatarDestination)) {
                        echo "Error moving the uploaded file!";
                        exit();
                    }
                } else {
                    echo "Your file is too big! Maximum size is 1MB.";
                    exit();
                }
            } else {
                echo "There was an error uploading your file! Error code: " . $avatarError;
                exit();
            }
        } else {
            echo "You cannot upload files of this type! Allowed types: jpg, jpeg, png, gif.";
            exit();
        }
    }

    // Insert the data into the developers table including the user_id
    $sql = "INSERT INTO developers (fullname, bio, skills, pay, github_link, linkedin_link, behance_link, stackoverflow_link, portfolio_link, avatar, user_id) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = $con->prepare($sql);
    if ($stmt === false) {
        die("Error preparing the SQL statement: " . $con->error);
    }

    $stmt->bind_param(
        "sssdsddssss",
        $fullname,
        $bio,
        $skills,
        $pay,
        $github,
        $linkedin,
        $behance,
        $stackoverflow,
        $portfolio,
        $avatarNewName,
        $user_id // Add user_id to bind_param
    );

    if ($stmt->execute()) {
        echo "<script>
                alert('Profile created successfully!');
                window.location.href = '../developers.php';
            </script>";
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close the statement and connection
    $stmt->close();
    $con->close();
} else {
    // Redirect back to form if accessed without submission
    header("Location: createDeveloper.php");
    exit();
}
