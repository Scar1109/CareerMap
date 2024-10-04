<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/contact.styles.css">
    <title>CareerMap</title>
</head>

<style>
        /* Styles for the contact section */
        body {
            font-family: Arial, sans-serif;
            background-color: #fff;
            margin: 0;
            padding: 0;
        }

        .contact-container {
            max-width: 1200px;
            margin: 50px auto;
            padding: 20px;
        }

        .contact-image {
            width: 600px;
            height: 500px;
            background-image: url('https://i.ibb.co/HCgXpFB/contact-us.png');
            background-size: cover;
            background-position: center;
            opacity: 0;
            transition: opacity 2s ease-in;
        }

        .contact-image.visible {
            opacity: 1;
        }

        .contact-form {
            flex-basis: 40%;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        /* Button styling */
        .send-button {
            background-color: #1d64c2;
            color: white;
            padding: 12px 25px;
            font-size: 16px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            width: 100%;
            margin-top: 10px;
            transition: background-color 0.3s ease;
        }

        .send-button:hover {
            background-color: #15509b;
        }
    </style>
</head>

<body>
<?php include_once 'header.php'; ?>
<div class="contact-container">
        <div style="text-align: center;">
            <h1 style="font-size: 36px; font-family: 'Cursive', serif; margin-bottom: 15px;">Contact US</h1>
            <p style="font-size: 18px; font-family: 'Cursive', serif; margin-bottom: 30px; padding-left: 20px; padding-right: 20px; line-height: 1.6;">
                We’d love to help! At Career Map, we value your feedback and are committed to providing you with the best user experience.
                Whether you have a question, need assistance, or just want to share your experiences, we’re all ears!
            </p>
            <div style="display: flex; justify-content: space-between; align-items: center; padding: 0 20px;">
                <!-- Contact Image Placeholder with Transition -->
                <div style="flex-basis: 50%;">
                    <div class="contact-image"></div>
                </div>

                <!-- Contact Form -->
                <form id="contactForm" class="contact-form" action="php/includes/sendEmail.inc.php" method="POST">
                    <div style="margin-bottom: 20px; text-align: left;">
                        <label for="name" style="font-size: 16px; margin-bottom: 5px; display: block;">Name</label>
                        <input type="text" id="name" name="name" placeholder="Your Name" style="width: 100%; padding: 10px; font-size: 16px; border: 1px solid #ccc; border-radius: 5px;" required>
                    </div>

                    <div style="margin-bottom: 20px; text-align: left;">
                        <label for="email" style="font-size: 16px; margin-bottom: 5px; display: block;">Email</label>
                        <input type="email" id="email" name="email" placeholder="youremail@example.com" style="width: 100%; padding: 10px; font-size: 16px; border: 1px solid #ccc; border-radius: 5px;" required>
                    </div>

                    <div style="margin-bottom: 20px; text-align: left;">
                        <label for="message" style="font-size: 16px; margin-bottom: 5px; display: block;">Message</label>
                        <textarea id="message" name="message" placeholder="Enter your message here" style="width: 100%; padding: 10px; font-size: 16px; border: 1px solid #ccc; border-radius: 5px; height: 150px; resize: none;" required></textarea>
                    </div>

                    <div style="margin-bottom: 20px; text-align: left;">
                        <button type="submit" class="send-button">Send Message</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- JavaScript for Image Fade-in Transition -->
    <!-- JavaScript for Image Fade-in Transition -->
    <script>
        // Image transition effect
        window.addEventListener('load', function () {
            var contactImage = document.querySelector('.contact-image');
            contactImage.classList.add('visible');  // Add the 'visible' class to fade in the image
        });

        // Form validation script
        document.getElementById('contactForm').addEventListener('submit', function (event) {
            var name = document.getElementById('name').value.trim();
            var email = document.getElementById('email').value.trim();
            var message = document.getElementById('message').value.trim();
            var emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;

            if (name === '') {
                alert('Please enter your name.');
                event.preventDefault(); // Stop form from submitting
                return;
            }

            if (!emailPattern.test(email)) {
                alert('Please enter a valid email address.');
                event.preventDefault();
                return;
            }

            if (message === '') {
                alert('Please enter your message.');
                event.preventDefault();
                return;
            }

            // If all fields are valid, the form will be submitted
        });
    </script>
    <?php include_once 'footer.php'; ?>
</body>



</html>