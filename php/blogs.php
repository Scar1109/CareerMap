<?php
session_start();
include_once 'includes/config.php';  // Ensure you have a proper database connection

// Fetch all blogs from the database
$sql = "SELECT * FROM blogs ORDER BY created_at DESC"; // Fetch all blogs ordered by the latest
$result = $con->query($sql);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/blog.css">
    <title>CareerMap - Blogs</title>
</head>

<body>

    <?php include_once 'header.php'; ?>

    <div class="blog_page_container_001">
        <div class="blog_page_header_002">
            <h1>Blogs</h1>
            <a href="../php/addBlog.php">
                <button class="add_blog_button_003">Add Blogs</button>
            </a>
        </div>

        <div class="blog_grid_container_004">
            <!-- Loop through the blogs dynamically -->
            <?php if ($result->num_rows > 0): ?>
                <?php while ($blog = $result->fetch_assoc()): ?>
                    <a href="../php/blogView.php?id=<?= $blog['id'] ?>" class="blog_card_link_009" style="text-decoration: none; color: inherit;">
                        <div class="blog_card_005">
                            <!-- Blog Date -->
                            <div class="blog_date_006"><?= date('d M Y', strtotime($blog['date'])) ?></div>

                            <!-- Blog Image -->
                            <div class="blog_image_007">
                                <img src="../uploads/<?= htmlspecialchars($blog['image_path']) ?>" alt="Blog Image" class="blog_image_005">
                            </div>

                            <!-- Blog Description -->
                            <div class="blog_description_008">
                                <h3><?= htmlspecialchars($blog['title']) ?></h3>
                                <p>
                                    <?php
                                    // Limit description to 50 words
                                    $descriptionWords = explode(' ', $blog['description']);
                                    if (count($descriptionWords) > 50) {
                                        $shortDescription = implode(' ', array_slice($descriptionWords, 0, 50)) . '...';
                                    } else {
                                        $shortDescription = $blog['description'];
                                    }
                                    echo htmlspecialchars($shortDescription);
                                    ?>
                                </p>
                            </div>
                        </div>
                    </a>
                <?php endwhile; ?>
            <?php else: ?>
                <p>No blogs available at the moment.</p>
            <?php endif; ?>
        </div>

        <!-- Pagination container -->
        <div class="pagination_container_009">
            <button class="pagination_button_010" id="prevPage" disabled>&lt;</button> <!-- Left Arrow -->
            <span id="paginationInfo"></span>
            <button class="pagination_button_010" id="nextPage">&gt;</button> <!-- Right Arrow -->
        </div>
    </div>

    <?php include_once 'footer.php'; ?>

    <script src="../js/blog.js"></script>
</body>

</html>