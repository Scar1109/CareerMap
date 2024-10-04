<?php
session_start();
include_once 'includes/config.php';  // Make sure the database connection is established

// Fetch jobs and corresponding company names from the database
$sql = "SELECT jobs.id, jobs.title, jobs.salary, jobs.location, jobs.image, companies.name AS company_name 
        FROM jobs 
        JOIN companies ON jobs.user_id = companies.userId
        ORDER BY jobs.id DESC"; // Fetch jobs in descending order by job ID
$result = $con->query($sql);


?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/index.styles.css">

    <!--change title icon-->
    <title>CareerMap</title>
    
</head>

<body>
    
    <?php
    include_once 'header.php';
    ?>
    
    <div class="home_page_main_container">
        <!-- Hero Section -->
        <section class="hero_section">
            <div class="hero_text_container">
                <h1 class="hero_title">16,780 Jobs For You</h1>
                <p class="hero_subtitle">Find your dream job that matches your passion and skills.</p>
                <a href="#" class="explore_button">Explore Now</a>
            </div>
            <div class="hero_image">
                <!-- Placeholder for image -->
                <img src="https://i.ibb.co/zfy7w97/job-image.png" alt="Jobs" >
            </div>
        </section>

        <!-- Jobs Search Section -->
        <div class="job_search_section">
    <h2 class="section_title">Explore more jobs</h2>
    <div class="search_filter_container">
        <input type="text" class="search_input" placeholder="Search for jobs...">
        <select class="location_filter">
            <option value="">Location</option>
            <!-- Add more locations as needed -->
        </select>
        <button class="search_button">Search</button>
    </div>
</div>

            <!-- Job Categories Carousel -->
            <div class="carousel_container_001">
            <button class="carousel_btn_002 carousel_btn_left_003">&#8249;</button>
                <div class="carousel_items_wrapper_008">
                    <div class="carousel_items_004">
                        <div class="carousel_item_005">
                            <span class="carousel_icon_006">$</span>
                            <h3>Finance</h3>
                            <p>1237 jobs</p>
                        </div>
                        <div class="carousel_item_005">
                            <span class="carousel_icon_006">👨‍🏫</span>
                            <h3>Education</h3>
                            <p>3546 jobs</p>
                        </div>
                        <div class="carousel_item_005">
                            <span class="carousel_icon_006">💻</span>
                            <h3>IT</h3>
                            <p>5768 jobs</p>
                        </div>
                        <div class="carousel_item_005">
                            <span class="carousel_icon_006">📊</span>
                            <h3>Marketing</h3>
                            <p>2473 jobs</p>
                        </div>
                        <div class="carousel_item_005">
                            <span class="carousel_icon_006">🎨</span>
                            <h3>Design</h3>
                            <p>1024 jobs</p>
                        </div>
                        <div class="carousel_item_005">
                            <span class="carousel_icon_006">⚖️</span>
                            <h3>Legal</h3>
                            <p>890 jobs</p>
                        </div>
                        <div class="carousel_item_005">
                            <span class="carousel_icon_006">🛠</span>
                            <h3>Engineering</h3>
                            <p>2219 jobs</p>
                        </div>
                    </div>
                </div>
                <button class="carousel_btn_002 carousel_btn_right_007">&#8250;</button>
            </div>
        </section>

              <!-- Job Listings Section -->
              <section class="job_listings_section">
            <?php if ($result->num_rows > 0): ?>
                <?php while ($job = $result->fetch_assoc()): ?>
                    <!-- Single Job Card -->
                    <div class="job_card">
                        <div class="job_image_container">
                            <img src="../uploads/<?= htmlspecialchars($job['image']) ?>" alt="Job Image">
                        </div>
                        <div class="job_details_container">
                            <h3 class="job_title"><?= htmlspecialchars($job['title']) ?></h3>
                            <p class="job_salary">Rs: <?= htmlspecialchars(number_format($job['salary'])) ?></p>
                            <p class="job_location"><?= htmlspecialchars($job['location']) ?></p>
                            <p class="job_type"><?= htmlspecialchars($job['company_name']) ?></p> <!-- Display company name -->
                        </div>
                        <div class="job_tags">
                            <span class="tag">Full Time</span>
                            <span class="tag">Remote</span>
                        </div>
                        <!-- Apply Button with link to jobView page -->
                        <a href="viewJob.php?job_id=<?= $job['id'] ?>">
                            <button class="apply_button">Apply</button>
                        </a>
                    </div>
                <?php endwhile; ?>
            <?php else: ?>
                <p>No jobs available at the moment.</p>
            <?php endif; ?>
        </section>

    </div>

        <?php
        include_once 'footer.php';
        ?>
        <script src="../js/myscript.js"></script>
</body>

</html>