<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Developer Profile</title>
    <link rel="stylesheet" href="../css/createDeveloper.css">
</head>

<body>
    <?php
    include_once 'header.php';
    ?>
    
    <div class="container-234">
        <h1 class="header-234">Create a Developer Profile</h1>
        
        <form action="./includes/createDeveloper.inc.php" method="POST" enctype="multipart/form-data" id="developerForm-234">
            
            <!-- Avatar Section -->
            <div class="avatar-section-234">
                <label for="avatar-234">Avatar</label>
                <input type="file" name="avatar" id="avatar-234">
            </div>
            
            <!-- Full Name -->
            <label for="fullname-234">Full Name</label>
            <input type="text" name="fullname" id="fullname-234" placeholder="Your full name" required>
            
            <!-- Short Bio -->
            <label for="bio-234">Short Bio</label>
            <textarea name="bio" id="bio-234" rows="4" placeholder="Tell something about yourself..." required></textarea>

            <!-- Skills -->
            <label for="skills-234">Skills</label>
            <input type="text" name="skills" id="skills-234" placeholder="e.g. PHP, JavaScript, HTML" required>
            
            <!-- Monthly Pay -->
            <label for="pay-234">Preferred Monthly Pay</label>
            <input type="number" name="pay" id="pay-234" placeholder="Your expected salary" required>
            
            <!-- Links Section -->
            <label for="github-234">GitHub Link</label>
            <input type="url" name="github" id="github-234" placeholder="GitHub profile link">
            
            <label for="linkedin-234">LinkedIn Link</label>
            <input type="url" name="linkedin" id="linkedin-234" placeholder="LinkedIn profile link">
            
            <label for="behance-234">Behance Link</label>
            <input type="url" name="behance" id="behance-234" placeholder="Behance profile link">
            
            <label for="stackoverflow-234">Stack Overflow Link</label>
            <input type="url" name="stackoverflow" id="stackoverflow-234" placeholder="Stack Overflow profile link">
            
            <label for="portfolio-234">Portfolio Link</label>
            <input type="url" name="portfolio" id="portfolio-234" placeholder="Portfolio link">
            
            <!-- Submit Button -->
            <button type="submit" name="submit" class="submit-btn-234">Create Profile</button>
        </form>
    </div>

    <?php
    include_once 'footer.php';
    ?>
    <script src="createDeveloper.js"></script>
</body>

</html>
