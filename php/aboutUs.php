<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CareerMap</title>
</head>

<body>
    <?php
    include_once 'header.php';
    ?>


    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>About CareerMap - Guiding Your Professional Journey</title>
        <style>
            body {
                font-family: 'Arial', sans-serif;
                line-height: 1.6;
                color: #333;
                margin: 0;
                padding: 0;
                background-color: #f4f4f4;
            }

            .container {
                max-width: 1200px;
                margin: 0 auto;
                padding: 20px;
            }

            header {
                background-color: #2c3e50;
                color: #ecf0f1;
                text-align: center;
                padding: 1rem 0;
            }

            h1,
            h2 {
                color: #2c3e50;
            }

            .mission-vision {
                background-color: #3498db;
                color: #fff;
                padding: 2rem;
                margin: 2rem 0;
                border-radius: 8px;
            }

            .team-section {
                display: flex;
                flex-wrap: wrap;
                justify-content: space-around;
            }

            .team-member {
                background-color: #fff;
                border-radius: 8px;
                box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
                margin: 1rem;
                padding: 1rem;
                text-align: center;
                width: 200px;
                cursor: pointer;
            }

            .team-member img {
                width: 150px;
                height: 150px;
                border-radius: 50%;
                object-fit: cover;
            }

            .team-member-bio {
                display: none;
                margin-top: 1rem;
                font-size: 0.9em;
            }

            .bio-toggle {
                background-color: #3498db;
                color: white;
                border: none;
                padding: 5px 10px;
                margin-top: 10px;
                cursor: pointer;
                border-radius: 5px;
            }

            .cta-section {
                background-color: #27ae60;
                color: #fff;
                text-align: center;
                padding: 2rem;
                margin-top: 2rem;
                border-radius: 8px;
            }

            .cta-button {
                display: inline-block;
                background-color: #fff;
                color: #27ae60;
                padding: 10px 20px;
                text-decoration: none;
                border-radius: 5px;
                font-weight: bold;
                margin-top: 1rem;
            }

            #impact-list li {
                font-size: 1.2em;
                margin-bottom: 10px;
            }

            #impact-list span {
                font-weight: bold;
                color: #3498db;
            }
        </style>
    </head>

    <body>
        <header>
            <h1>About CareerMap</h1>
            <p>Guiding Your Professional Journey</p>
        </header>

        <div class="container">
            <section id="story">
                <h2>Our Story</h2>
                <p>Founded in 2020, CareerMap was born from a passion to revolutionize the way people navigate their professional lives. We recognized the challenges faced by job seekers and employers alike in an ever-evolving job market. Our platform bridges this gap, providing innovative solutions for career development and job matching.</p>
            </section>

            <section id="mission-vision" class="mission-vision">
                <h2>Our Mission</h2>
                <p>To empower individuals in their career journeys by providing personalized guidance, skill development opportunities, and connecting them with their ideal job matches.</p>
                <h2>Our Vision</h2>
                <p>A world where everyone can easily navigate their career path, continuously grow their skills, and find fulfilling work that aligns with their passions and abilities.</p>
            </section>

            <section id="team">
                <h2>Meet Our Team</h2>
                <div class="team-section">
                    <div class="team-member">
                        <img src="/api/placeholder/150/150" alt="Jane Doe">
                        <h3>Jane Doe</h3>
                        <p>CEO & Co-founder</p>
                        <div class="team-member-bio">
                            Jane has over 15 years of experience in HR and career counseling. She founded CareerMap with a vision to make career guidance accessible to everyone.
                        </div>
                        <button class="bio-toggle">Read Bio</button>
                    </div>
                    <div class="team-member">
                        <img src="/api/placeholder/150/150" alt="John Smith">
                        <h3>John Smith</h3>
                        <p>CTO</p>
                        <div class="team-member-bio">
                            John is a tech enthusiast with a background in AI and machine learning. He leads our development team in creating innovative career matching algorithms.
                        </div>
                        <button class="bio-toggle">Read Bio</button>
                    </div>
                    <div class="team-member">
                        <img src="/api/placeholder/150/150" alt="Emma Wilson">
                        <h3>Emma Wilson</h3>
                        <p>Head of Career Counseling</p>
                        <div class="team-member-bio">
                            Emma brings a wealth of knowledge from her years as a career coach. She ensures our guidance is personalized and effective for each user.
                        </div>
                        <button class="bio-toggle">Read Bio</button>
                    </div>
                </div>
            </section>

            <section id="impact">
                <h2>Our Impact</h2>
                <p>Since our inception, we've:</p>
                <ul id="impact-list">
                    <li data-value="100000">Helped <span>0</span> professionals find their ideal jobs</li>
                    <li data-value="1000">Partnered with <span>0</span>+ companies to streamline their hiring process</li>
                    <li data-value="50000">Provided personalized career guidance to <span>0</span>+ individuals</li>
                    <li data-value="200">Offered <span>0</span>+ skill development courses to enhance employability</li>
                    <li data-value="50">Organized <span>0</span> career fairs connecting job seekers with top employers</li>
                </ul>
            </section>

            <section id="cta" class="cta-section">
                <h2>Start Your Career Journey with CareerMap</h2>
                <p>Whether you're looking for your next career move or aiming to hire top talent, we're here to guide you.</p>
                <a href="#" class="cta-button">Explore CareerMap Today</a>
            </section>
        </div>

        <script src="../js/about-us.js"></script>
    </body>

    </html>


    <?php
    include_once 'footer.php';
    ?>
</body>

</html>