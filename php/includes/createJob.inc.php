<?php
// Include your database configuration
include_once 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $company_id = 1; // For now, we will hardcode the company ID
    $image = 'default_image.jpg'; // You can later replace this with actual image upload functionality

    // Get form data
    $title = $_POST['title'];
    $description = $_POST['description'];
    $location = $_POST['location'];
    $salary = $_POST['salary'];


    // Prepare SQL query
    $sql = "INSERT INTO jobs (title, description, company_id, location, salary, created_at, image) 
            VALUES (?, ?, ?, ?, ?, ?, ?)";

    // Prepare and execute statement
    $stmt = $con->prepare($sql);
    $stmt->bind_param("ssisdss", $title, $description, $company_id, $location, $salary, $created_at, $image);

    if ($stmt->execute()) {
        echo "Job created successfully!";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $con->close();
}
?>
