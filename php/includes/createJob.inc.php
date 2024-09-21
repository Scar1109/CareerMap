<?php
// Include your database configuration
include_once 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $company_id = 1; // For now, we will hardcode the company ID

    // Get form data
    $title = $_POST['title'];
    $description = $_POST['description'];
    $location = $_POST['location'];
    $salary = $_POST['salary'];

    // Prepare SQL query
    $sql = "INSERT INTO jobs (title, description, company_id, location, salary) VALUES (?, ?, ?, ?, ?)";

    // Prepare and execute statement
    $stmt = $con->prepare($sql);
    $stmt->bind_param("ssisd", $title, $description, $company_id, $location, $salary);

    if ($stmt->execute()) {
        echo "Job created successfully!";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $con->close();
}
?>
