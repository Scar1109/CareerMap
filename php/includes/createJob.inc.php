<?php
session_start(); // Make sure the session is started to access session variables

// Include your database configuration
include_once 'config.php';

// Check if the user is logged in
if (!isset($_SESSION['userid'])) {
    // Redirect to login page if not logged in
    header("Location: login.php");
    exit();
}

// Get user_id from session
$user_id = $_SESSION['userid'];

// Check if the logged-in user has a company
$sql = "SELECT id FROM companies WHERE userId = ?";  // Updated to 'userId' instead of 'user_id'
$stmt = $con->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

// Ensure the company exists for the user
if ($result->num_rows === 0) {
    echo "No company found for the user. Please Before creating a job, create a company profile.";
    exit();
}

$company = $result->fetch_assoc();
$company_id = $company['id']; // Get the company ID

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Handle file upload for company image
    if (isset($_FILES['company_image']) && $_FILES['company_image']['error'] === 0) {
        $uploadDir = '../../uploads/'; // Directory to upload the image
        $fileName = basename($_FILES['company_image']['name']);
        $uploadFile = $uploadDir . $fileName;
        $fileType = strtolower(pathinfo($uploadFile, PATHINFO_EXTENSION));

        // Check if the uploaded file is an image
        $allowedTypes = ['jpg', 'jpeg', 'png', 'gif'];
        if (!in_array($fileType, $allowedTypes)) {
            echo "Error: Only JPG, JPEG, PNG, and GIF files are allowed.";
            exit();
        }

        // Move the uploaded file to the target directory
        if (move_uploaded_file($_FILES['company_image']['tmp_name'], $uploadFile)) {
            $image = $fileName; // Save the file name for the database
        } else {
            echo "Error: There was an error uploading the file.";
            exit();
        }
    } else {
        $image = "defaultImg.png"; // Default image if no file uploaded
    }

    // Get form data
    $title = $_POST['title'];
    $description = $_POST['description'];
    $location = $_POST['location'];
    $salary = $_POST['salary'];
    $created_at = date("Y-m-d H:i:s");

    // Prepare SQL query to insert the job with the company_id
    $sql = "INSERT INTO jobs (title, description, user_id, location, salary, created_at, image) 
            VALUES (?, ?, ?, ?, ?, ?, ?)";

    // Prepare and execute statement
    $stmt = $con->prepare($sql);
    $stmt->bind_param("ssisdss", $title, $description, $company_id, $location, $salary, $created_at, $image);

    if ($stmt->execute()) {
        // Redirect to the form page with a success message flag
        header("Location: ../createJob.php?success=1");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $con->close();
}
?>
