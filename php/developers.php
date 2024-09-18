<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CareerMap - View Developers</title>
    <link rel="stylesheet" href="../css/developers.css">
</head>

<body>
    <?php
    include_once 'header.php';
    include_once './includes/config.php'; // Include your DB connection

    // Fetch all developers from the database
    $sql = "SELECT * FROM developers";
    $result = $con->query($sql);
    ?>

    <div class="container-442">
    <div class="header-section-442">
            <h1 class="header-title-442">Developers</h1>
            <a href="viewMyProfile.php" class="view-profile-btn-442">View My Developer Profile</a> <!-- Button to view the developer's profile -->
        </div>

        <!-- Search and Filter Section -->
        <div class="search-filter-section-442">
            <input type="text" placeholder="Search developers..." class="search-input-442">

            <div class="filters-442">
                <select name="filter-role-442" id="filter-role-442">
                    <option value="">Role</option>
                    <option value="developer">Developer</option>
                    <!-- Add more roles -->
                </select>

                <select name="filter-pay-442" id="filter-pay-442">
                    <option value="">Pay Range</option>
                    <option value="50000">$50K - $75K</option>
                    <option value="75000">$75K - $100K</option>
                    <!-- Add more pay ranges -->
                </select>

                <select name="filter-location-442" id="filter-location-442">
                    <option value="">Location</option>
                    <option value="New York">New York</option>
                    <!-- Add more locations -->
                </select>
            </div>
        </div>

        <!-- Developer Cards Section -->
        <div class="developer-cards-section-442" id="developers-list-442">
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo '
                    <div class="developer-card-442">
                        <div class="developer-image-442">
                            <img src="../uploads/' . $row['avatar'] . '" alt="Developer Avatar">
                        </div>
                        <div class="developer-info-442">
                            <h2>' . $row['fullname'] . '</h2>
                            <p class="developer-role-442">' . $row['skills'] . '</p>
                            <p class="developer-pay-442">$' . number_format($row['pay']) . '</p>
                            <p class="developer-bio-442">' . substr($row['bio'], 0, 100) . '...</p>
                            <div class="developer-links-442">
                                <a href="' . $row['github_link'] . '" target="_blank">GitHub</a> |
                                <a href="' . $row['linkedin_link'] . '" target="_blank">LinkedIn</a> |
                                <a href="' . $row['portfolio_link'] . '" target="_blank">Portfolio</a>
                            </div>
                        </div>
                    </div>';
                }
            } else {
                echo '<p>No developers found.</p>';
            }
            ?>
        </div>
    </div>

    <?php
    include_once 'footer.php';
    ?>
</body>

</html>
