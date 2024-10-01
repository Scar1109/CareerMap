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
    <title>About Us</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f5f5f5;
            color: #333;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }
        p {
            font-size: 18px;
            line-height: 1.6;
            margin-bottom: 20px;
        }
        .team-section {
            text-align: center;
        }
        .team-member {
            display: inline-block;
            margin: 10px;
        }
        .team-member img {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            object-fit: cover;
        }
        .team-member h3 {
            margin: 10px 0 5px;
            font-size: 18px;
            color: #333;
        }
        .team-member p {
            font-size: 16px;
            color: #666;
        }
    </style>
</head>
<body>

    <div class="container">
        <h1>About Us</h1>
        <p>Welcome to [Your Company Name]! We are dedicated to providing top-notch services to our clients, striving for excellence in everything we do. Our team consists of passionate and skilled professionals who are committed to helping you succeed.</p>
        
        <p>Founded in [Year], our mission is to deliver high-quality solutions that make a difference. We believe in innovation, teamwork, and a customer-centric approach. At [Your Company Name], we value transparency, integrity, and hard work, ensuring that every project we take on is a success story.</p>

        <div class="team-section">
            <h2>Meet Our Team</h2>
            <div class="team-member">
                <img src="https://via.placeholder.com/100" alt="Team Member 1">
                <h3>Jane Doe</h3>
                <p>CEO</p>
            </div>
            <div class="team-member">
                <img src="https://via.placeholder.com/100" alt="Team Member 2">
                <h3>John Smith</h3>
                <p>Lead Developer</p>
            </div>
            <div class="team-member">
                <img src="https://via.placeholder.com/100" alt="Team Member 3">
                <h3>Mary Johnson</h3>
                <p>Project Manager</p>
            </div>
        </div>
    </div>

</body>
</html>


    <?php
    include_once 'footer.php';
    ?>
</body>

</html>