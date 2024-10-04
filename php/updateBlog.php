<?php
session_start();
include_once 'includes/config.php';  // Ensure you have a proper database connection

// Check if the blog ID is present in the POST data
if (isset($_POST['blog_id'])) {
    $blogID = $_POST['blog_id'];

    // Fetch the blog data by ID
    $sql = "SELECT * FROM blogs WHERE id = ?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param('i', $blogID);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $blog = $result->fetch_assoc();
    } else {
        echo "Blog not found.";
        exit();
    }

    // Close the connection
    $stmt->close();
    $con->close();
} else {
    echo "Invalid blog ID.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/blog.css">
    <title>Update Blog</title>
</head>

<body>

    <?php include_once 'header.php'; ?>

    <div class="add_blog_container_001">
        <!-- Update the form action to point to updateBlog.inc.php -->
        <form action="../php/includes/updateBlog.inc.php" method="POST" enctype="multipart/form-data">
            <h2 class="form_title_002">UPDATE BLOG</h2>

            <!-- Hidden blog ID -->
            <input type="hidden" name="blog_id" value="<?= $blogID ?>">

            <div class="image_upload_container_003">
                <div class="image_preview_005">
                    <!-- Existing image -->
                    <div id="existingImageContainer" style="display: block;">
                        <img src="../uploads/<?= htmlspecialchars($blog['image_path']) ?>" id="existingImage" alt="Blog Image" style="max-width: 100%; border-radius: 8px;">
                    </div>

                    <!-- New image preview (hidden by default) -->
                    <img id="imagePreview" style="display: none; max-width: 100%; border-radius: 8px; margin-top: 10px;" />

                    <!-- File input for new image -->
                    <input type="file" id="blogImage" name="blog_image" class="image_input_006" accept="image/*" onchange="previewImage(event)">
                    
                    <!-- Clear image button (hidden by default) -->
                    <button type="button" id="clearImageButton" class="clear_image_button_009" style="display: none;" onclick="clearImage()">Clear</button>
                </div>
            </div>

            <div class="form_group_008">
                <label for="blogTitle">Blog Title</label>
                <input type="text" id="blogTitle" name="blog_title" placeholder="Enter title" class="input_field_009" value="<?= htmlspecialchars($blog['title']) ?>" required>
            </div>

            <div class="form_group_008">
                <label for="blogDate">Date</label>
                <input type="date" id="blogDate" name="blog_date" class="input_field_009" value="<?= $blog['date'] ?>" required>
            </div>

            <div class="form_group_008">
                <label for="blogDescription">Description</label>
                <textarea id="blogDescription" name="blog_description" placeholder="Enter description" class="textarea_field_010" required><?= htmlspecialchars($blog['description']) ?></textarea>
            </div>

            <div class="form_buttons_011">
            <button type="button" class="cancel_button_012" id="cancelButton">Cancel</button>
                <button type="submit" class="edit_button_009">Update</button>
            </div>
        </form>
    </div>

    <script>
        // Get the button element by its ID or class
    document.getElementById("cancelButton").addEventListener("click", function() {
        // Redirect to the desired page when the button is clicked
        window.location.href = "../php/blogs.php";
    });

        // JavaScript for image preview
        function previewImage(event) {
            const imagePreview = document.getElementById('imagePreview');
            const existingImageContainer = document.getElementById('existingImageContainer');
            const clearButton = document.getElementById('clearImageButton');
            const file = event.target.files[0];

            if (file) {
                const reader = new FileReader();

                reader.onload = function (e) {
                    existingImageContainer.style.display = 'none'; // Hide existing image
                    imagePreview.src = e.target.result;
                    imagePreview.style.display = 'block'; // Show the new image preview
                    clearButton.style.display = 'inline'; // Show the clear button
                };

                reader.readAsDataURL(file); // Convert image to base64 string
            }
        }

        // Function to clear the image and reset the input
        function clearImage() {
            const imagePreview = document.getElementById('imagePreview');
            const fileInput = document.getElementById('blogImage');
            const existingImageContainer = document.getElementById('existingImageContainer');
            const clearButton = document.getElementById('clearImageButton');

            // Reset the file input and hide the new image preview
            fileInput.value = '';
            imagePreview.style.display = 'none'; // Hide new image preview
            existingImageContainer.style.display = 'block'; // Show the existing image
            clearButton.style.display = 'none'; // Hide the clear button
        }
    </script>

    <?php include_once 'footer.php'; ?>
    <script src="../js/blog.js"></script>
</body>

</html>
