<?php
include_once '../includes/config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $job_id = $_POST['job_id'];
    $name = $_POST['name'];
    $email = $_POST['email'];

    // File upload handling
    $uploadDir = '../../uploads/';
    $fileName = basename($_FILES['resume']['name']);
    $uploadFilePath = $uploadDir . $fileName;
    $fileType = strtolower(pathinfo($uploadFilePath, PATHINFO_EXTENSION));

    // Allowed file types
    $allowedTypes = ['pdf', 'doc', 'docx'];

    // Check if the file is valid
    if (in_array($fileType, $allowedTypes)) {
        // Check file size (limit it to 2MB)
        if ($_FILES['resume']['size'] > 2000000) {
            echo "File is too large. Maximum file size is 2MB.";
            exit;
        }

        // Upload file to the server
        if (move_uploaded_file($_FILES['resume']['tmp_name'], $uploadFilePath)) {
            // Save application info into the database
            $sql = "INSERT INTO applications (job_id, name, email, resume) VALUES (?, ?, ?, ?)";
            $stmt = $con->prepare($sql);
            $stmt->bind_param("isss", $job_id, $name, $email, $uploadFilePath);

            if ($stmt->execute()) {
                echo "Application submitted successfully!";
            } else {
                echo "Error: " . $stmt->error;
            }

            $stmt->close();
        } else {
            echo "Error uploading the file.";
        }
    } else {
        echo "Invalid file type. Only PDF, DOC, and DOCX files are allowed.";
    }

    $con->close();
} else {
    echo "Invalid request!";
}
?>