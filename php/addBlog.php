<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/blog.css">
    <title>CareerMap</title>
</head>

<body>

    <?php
    include_once 'header.php';
    ?>


<div class="add_blog_container_001">
        <!-- Update the form action to point to addblog.inc.php in the /php/ folder -->
        <form action="../php/includes/blog.inc.php" method="POST" enctype="multipart/form-data">
            <h2 class="form_title_002">ADD BLOGS</h2>

            <div class="image_upload_container_003">
                <label for="blogImage" class="image_upload_label_004">Add Image</label>
                <div class="image_preview_005">
                    <input type="file" id="blogImage" name="blog_image" class="image_input_006" accept="image/*" onchange="previewImage(event)">
                    <div class="image_placeholder_007" id="imagePlaceholder">
                        <span>+</span>
                    </div>
                    <img id="imagePreview" class="image_preview_008" style="display: none;" />
                    <button type="button" id="clearImageButton" class="clear_image_button_009" style="display: none;" onclick="clearImage()">Clear</button>
                </div>
            </div>

            <div class="form_group_008">
                <label for="blogTitle">Blog Title</label>
                <input type="text" id="blogTitle" name="blog_title" placeholder="Enter title" class="input_field_009" required>
            </div>

            <div class="form_group_008">
                <label for="blogDate">Date</label>
                <input type="date" id="blogDate" name="blog_date" class="input_field_009" required>
            </div>

            <div class="form_group_008">
                <label for="blogDescription">Description</label>
                <textarea id="blogDescription" name="blog_description" placeholder="Enter description" class="textarea_field_010" required></textarea>
            </div>

            <div class="form_buttons_011">
            <button type="button" class="cancel_button_012" id="cancelButton">Cancel</button>
                <button type="submit" class="save_button_013">Save</button>
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
            const imagePlaceholder = document.getElementById('imagePlaceholder');
            const clearButton = document.getElementById('clearImageButton');
            const file = event.target.files[0];

            if (file) {
                const reader = new FileReader();

                reader.onload = function (e) {
                    imagePlaceholder.style.display = 'none'; // Hide placeholder
                    imagePreview.src = e.target.result;
                    imagePreview.style.display = 'block'; // Show the preview
                    clearButton.style.display = 'inline'; // Show clear button
                };

                reader.readAsDataURL(file); // Convert image to base64 string
            }
        }

        // Function to clear the image and reset the input
        function clearImage() {
            const imagePreview = document.getElementById('imagePreview');
            const imagePlaceholder = document.getElementById('imagePlaceholder');
            const clearButton = document.getElementById('clearImageButton');
            const fileInput = document.getElementById('blogImage');

            // Clear the input value
            fileInput.value = "";
            imagePreview.style.display = 'none'; // Hide the preview
            imagePlaceholder.style.display = 'flex'; // Show placeholder again
            clearButton.style.display = 'none'; // Hide clear button
        }
    </script>


    <?php
    include_once 'footer.php';
    ?>
    <script src="../js/blog.js"></script>
</body>

</html>