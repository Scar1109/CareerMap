<?php
session_start();
include_once 'config.php'; // Ensure you have a proper database connection

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];

    // Form validation
    if (empty($name) || empty($email) || empty($message)) {
        echo "All fields are required!";
        exit;
    }

    // Send the email
    $to = "admin@yourwebsite.com"; // Replace with your admin email
    $subject = "New Contact Form Submission from $name";
    $body = "Name: $name\nEmail: $email\nMessage:\n$message";

    // Try sending the email
    if (mail($to, $subject, $body)) {
        echo "Email sent successfully!";
    } else {
        echo "Failed to send email.";
    }

    // Save the contact form submission in the database
    $sql = "INSERT INTO contact_messages (name, email, message) VALUES (?, ?, ?)";
    $stmt = $con->prepare($sql);
    if ($stmt) {
        $stmt->bind_param("sss", $name, $email, $message);
        $stmt->execute();
        $stmt->close();
    } else {
        echo "Database error: " . $con->error;
    }

    // Redirect back to the contact page with a success message
    header("Location: ../contactUs.php?message=success");
    exit;
} else {
    echo "Invalid request method.";
}
?>
