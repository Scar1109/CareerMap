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
    <!--slide show -->
    <!--slide show -->

    <div class="slideshow">
        <div class="slideshow-container">
            <div class="mySlides fade">
                <img src="../images/1.svg" style="width:100%; height:auto;" >
            </div>
            <div class="mySlides fade">
                <img src="../images/2.svg" style="width:100%; height:auto;">
            </div>
            <div class="mySlides fade">
                <img src="../images/3.svg" style="width: 100%; height:auto;">
            </div>
            <div class="mySlides fade">
                <img src="../images/4.svg" style="width: 100%; height:auto;">
            </div>
            <div class="mySlides fade">
                <img src="../images/5.svg" style="width: 100%; height:auto;">
            </div>
        </div>
        <br>

        <div class="dots" style="text-align:center">
                <span class="dot" onclick="currentSlide(1)"></span> 
                <span class="dot" onclick="currentSlide(2)"></span> 
                <span class="dot" onclick="currentSlide(3)"></span> 
                <span class="dot" onclick="currentSlide(4)"></span> 
                <span class="dot" onclick="currentSlide(5)"></span> 
        </div>
        
    </div>

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
            <!-- Single Job Card -->
            <div class="job_card">
                <div class="job_image_container">
                    <img src="job_image_placeholder.jpg" alt="Job Image">
                </div>
                <div class="job_details_container">
                    <h3 class="job_title">UI/UX Designer</h3>
                    <p class="job_salary">$95K - $120K</p>
                    <p class="job_location">Tucson, AZ</p>
                    <p class="job_type">Onsite</p>
                </div>
                <div class="job_tags">
                        <span class="tag">Tag 1</span>
                        <span class="tag">Tag 2</span>
                        <span class="tag">Tag 3</span>
                    </div>
                    <button class="apply_button">Apply</button>
            </div>

            <!-- Add more job cards here -->
        </section>
    </div>

        <?php
        include_once 'footer.php';
        ?>
        <script src="../js/myscript.js"></script>
</body>

</html>