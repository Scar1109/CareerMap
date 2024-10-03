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
            }

            .team-member img {
                width: 150px;
                height: 150px;
                border-radius: 50%;
                object-fit: cover;
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
        </style>
    </head>

    <body>
        <header>
            <h1>About CareerMap</h1>
            <p>Guiding Your Professional Journey</p>
        </header>

        <div class="container">
            <section>
                <h2>Our Story</h2>
                <p>Founded in 2020, CareerMap was born from a passion to revolutionize the way people navigate their professional lives. We recognized the challenges faced by job seekers and employers alike in an ever-evolving job market. Our platform bridges this gap, providing innovative solutions for career development and job matching.</p>
            </section>

            <section class="mission-vision">
                <h2>Our Mission</h2>
                <p>To empower individuals in their career journeys by providing personalized guidance, skill development opportunities, and connecting them with their ideal job matches.</p>
                <h2>Our Vision</h2>
                <p>A world where everyone can easily navigate their career path, continuously grow their skills, and find fulfilling work that aligns with their passions and abilities.</p>
            </section>

            <section>
                <h2>Meet Our Team</h2>
                <div class="team-section">
                    <div class="team-member">
                        <img src="/api/placeholder/150/150" alt="Jane Doe">
                        <h3>Jane Doe</h3>
                        <p>CEO & Co-founder</p>
                    </div>
                    <div class="team-member">
                        <img src="/api/placeholder/150/150" alt="John Smith">
                        <h3>John Smith</h3>
                        <p>CTO</p>
                    </div>
                    <div class="team-member">
                        <img src="/api/placeholder/150/150" alt="Emma Wilson">
                        <h3>Emma Wilson</h3>
                        <p>Head of Career Counseling</p>
                    </div>
                </div>
            </section>

            <section>
                <h2>Our Impact</h2>
                <p>Since our inception, we've:</p>
                <ul>
                    <li>Helped over 100,000 professionals find their ideal jobs</li>
                    <li>Partnered with 1,000+ companies to streamline their hiring process</li>
                    <li>Provided personalized career guidance to 50,000+ individuals</li>
                    <li>Offered 200+ skill development courses to enhance employability</li>
                    <li>Organized 50 career fairs connecting job seekers with top employers</li>
                </ul>
            </section>

            <section class="cta-section">
                <h2>Start Your Career Journey with CareerMap</h2>
                <p>Whether you're looking for your next career move or aiming to hire top talent, we're here to guide you.</p>
                <a href="#" class="cta-button">Explore CareerMap Today</a>
            </section>
        </div>
    </body>

    </html>


    <?php
    include_once 'footer.php';
    ?>
</body>

</html>