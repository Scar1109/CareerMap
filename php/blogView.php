<?php
session_start();
include_once 'includes/config.php';  // Ensure you have a proper database connection

// Check if the blog ID is present in the URL
if (isset($_GET['id'])) {
    $blogID = $_GET['id'];

    // Prepare and execute the SQL query to fetch the blog by ID
    $sql = "SELECT * FROM blogs WHERE id = ?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param('i', $blogID);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if the blog exists
    if ($result->num_rows > 0) {
        // Fetch the blog data
        $blog = $result->fetch_assoc();
    } else {
        echo "Blog not found.";
        exit();
    }

    // Close the statement
    $stmt->close();
} else {
    echo "Invalid blog ID.";
    exit();
}

// Fetch the logged-in user ID
$currentUserId = $_SESSION['userid'] ?? null; // Fetch the logged-in user ID from the session

$con->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/blog.css">
    <title><?= htmlspecialchars($blog['title']) ?> - Blog</title>
</head>

<body>

    <?php include_once 'header.php'; ?>

    <div class="blog_view_container_001">
        <!-- Display the blog content -->
        
        <p class="blog_date_006"><?= date('d M Y', strtotime($blog['date'])) ?></p>
        
        <!-- Blog Image -->
        <div class="blog_image_container_007">
            <img src="../uploads/<?= htmlspecialchars($blog['image_path']) ?>" alt="<?= htmlspecialchars($blog['title']) ?>" class="blog_image_005">
        </div>
        <h1 class="blog_title_006"><?= htmlspecialchars($blog['title']) ?></h1>
        <!-- Blog Description -->
        <div class="blog_description_content_008">
            <p><?= nl2br(htmlspecialchars($blog['description'])) ?></p>
        </div>

        <!-- Edit and Delete Buttons (shown only if current user is the blog owner) -->
        <?php if ($currentUserId === $blog['user_id']): ?>
        <div class="blog_buttons_container_008">
            <!-- Edit Blog -->
            <form action="../php/updateBlog.php" method="POST" style="display:inline;">
                <input type="hidden" name="blog_id" value="<?= $blogID ?>">
                <button type="submit" class="edit_button_009">Edit</button>
            </form>
            
            <!-- Delete Blog -->
            <form action="../php/includes/deleteBlog.inc.php" method="POST" style="display:inline;">
                <input type="hidden" name="blog_id" value="<?= $blogID ?>">
                <button type="submit" class="delete_button_010" onclick="return confirm('Are you sure you want to delete this blog?');">Delete</button>
            </form>
        </div>
        <?php endif; ?>
    </div>

    <?php include_once 'footer.php'; ?>
</body>

</html>