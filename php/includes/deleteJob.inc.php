<?php
session_start();
include_once 'config.php'; // Include database connection

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_SESSION['user_id'])) {
    $blogID = $_POST['blog_id'];
    $loggedInUserID = $_SESSION['user_id'];

    // Check if the blog belongs to the logged-in user before deleting
    $sql = "SELECT * FROM blogs WHERE id = ? AND user_id = ?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param('ii', $blogID, $loggedInUserID);
    $stmt->execute();
    $result = $stmt->get_result();

    // If the blog exists and belongs to the logged-in user
    if ($result->num_rows > 0) {
        // Proceed with deleting the blog
        $sqlDelete = "DELETE FROM blogs WHERE id = ?";
        $stmtDelete = $con->prepare($sqlDelete);
        $stmtDelete->bind_param('i', $blogID);

        if ($stmtDelete->execute()) {
            header("Location: ../php/blogs.php?message=Blog deleted successfully");
            exit();
        } else {
            echo "Error: " . $stmtDelete->error;
        }

        $stmtDelete->close();
    } else {
        echo "You do not have permission to delete this blog.";
    }

    $stmt->close();
    $con->close();
} else {
    echo "Invalid blog ID or you are not logged in.";
}
?>
