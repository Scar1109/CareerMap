<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION["userid"])) {
    // Redirect to login page if not logged in
    header("Location: login.php");
    exit();
}

// Fetch user data from session with default values to avoid warnings
$userId = $_SESSION["userid"] ?? '';
$username = $_SESSION["username"] ?? '';
$firstName = $_SESSION["first_name"] ?? '';
$lastName = $_SESSION["last_name"] ?? '';
$email = $_SESSION["email"] ?? '';
$phoneNumber = $_SESSION["phone_number"] ?? '';
$description = $_SESSION["description"] ?? '';

// Check for update success message
$updateMessage = '';
if (isset($_GET['update']) && $_GET['update'] == 'success') {
    $updateMessage = "Profile updated successfully!";
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            color: #333;
            background-color: #f5f5f5;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }
        .profile-header {
            text-align: center;
            padding: 40px 0;
            background-color: white;
            border-radius: 8px;
            margin-bottom: 20px;
        }
        .profile-pic {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            background-color: #ccc;
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 0 auto 20px;
            overflow: hidden;
        }
        .profile-pic img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        .tag {
            display: inline-block;
            background-color: #eee;
            padding: 5px 10px;
            border-radius: 20px;
            margin: 0 5px;
        }
        .general-info {
            background-color: white;
            padding: 20px;
            border-radius: 8px;
        }
        .form-group {
            margin-bottom: 20px;
        }
        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }
        input, textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 16px;
        }
        .full-width-button {
            display: block;
            width: 100%;
            padding: 10px;
            background-color: #333;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }
        .developer-section {
            text-align: center;
            margin: 40px 0;
            background-color: white;
            padding: 20px;
            border-radius: 8px;
        }
        .developer-image {
            width: 200px;
            height: 150px;
            background-color: #eee;
            margin: 0 auto 20px;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .logo {
            height: 40px;
            width: 160px;
            display: block;
            margin-top: 15px;
            float: left;
        }
        .update-message {
            background-color: #4CAF50;
            color: white;
            padding: 10px;
            text-align: center;
            margin-bottom: 20px;
            border-radius: 4px;
        }
    </style>
</head>
<body>
    <?php include_once 'header.php'; ?>

    <div class="container">
        <?php if ($updateMessage): ?>
            <div class="update-message"><?= htmlspecialchars($updateMessage) ?></div>
        <?php endif; ?>

        <div class="profile-header">
            <div class="profile-pic">
                <img src="../images/profile.png" alt="Profile Picture">
            </div>
            <h1><?= htmlspecialchars($firstName . ' ' . $lastName) ?></h1>
            <p>User ID: <?= htmlspecialchars($userId) ?></p>
            <div>
                <span class="tag">Tag</span>
                <span class="tag">Tag</span>
                <span class="tag">Tag</span>
            </div>
        </div>

        <form class="general-info" action="update_profile.php" method="POST">
            <h2>GENERAL INFORMATION</h2>

            <div class="form-group">
                <label for="first-name">First Name</label>
                <input type="text" id="first-name" name="first_name" value="<?= htmlspecialchars($firstName) ?>" required>
            </div>
            <div class="form-group">
                <label for="last-name">Last Name</label>
                <input type="text" id="last-name" name="last_name" value="<?= htmlspecialchars($lastName) ?>" required>
            </div>
            <div class="form-group">
                <label for="username">User Name</label>
                <input type="text" id="username" name="username" value="<?= htmlspecialchars($username) ?>" required>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" value="<?= htmlspecialchars($email) ?>" required>
            </div>
            <div class="form-group">
                <label for="phone">Phone Number</label>
                <input type="tel" id="phone" name="phone" value="<?= htmlspecialchars($phoneNumber) ?>" required>
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea id="description" name="description" rows="4"><?= htmlspecialchars($description) ?></textarea>

            </div>
            <button type="submit" class="full-width-button">Update Profile</button>
        </form>
            
        <div class="developer-section">
            <div class="developer-image">Image</div>
            <h3>If You Want To Be A Developer</h3>
            <p>Upgrade your account to access developer features</p>
            <button class="full-width-button">Upgrade To Developer Account</button>
        </div>
    </div>

    <?php include_once 'footer.php'; ?>

    <script>
        // You can add any necessary JavaScript here
    </script>
</body>
</html>