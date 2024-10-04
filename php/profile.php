<?php
session_start();
include_once 'includes/config.php';  // Include your database connection

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
$role = $_SESSION["role"] ?? '';

// Check for update success message
$updateMessage = '';
if (isset($_GET['update']) && $_GET['update'] == 'success') {
    $updateMessage = "Profile updated successfully!";
}

// Check if there is a company profile for the current user
$companyExists = false;
$companyId = '';  // Store the company ID for the current user

$sql = "SELECT id FROM companies WHERE userId = ?";
$stmt = $con->prepare($sql);
$stmt->bind_param("i", $userId);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    // Fetch the company ID for the logged-in user
    $company = $result->fetch_assoc();
    $companyId = $company['id'];
    $companyExists = true;
}

$stmt->close();
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
            padding: 40px 0 0 0;
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
            margin: 0; 
        }

        .view-company-button {
            display: block;
            width: 30%;
            height: 40px;
            background-color: #1d64c2;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            display: inline-block;
            margin-bottom: 20px;
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
            background-color: #1d64c2;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }

        .full-width-button:hover {
            background-color: #1555a7;
        }

        .application-section {
            text-align: center;
            background-color: white;
            padding: 0 20px 20px 20px;
            border-radius: 8px;
        }
        .application-section h3 {
            margin-top: 0;
            font-size: 15px;
        }
        .developer-section {
            text-align: center;
            margin: 40px 0;
            background-color: white;
            padding: 20px;
            border-radius: 8px;
        }
        .developer-section a {
            text-decoration: none;
        }
        .company-section {
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

            <?php if ($role == 'user'): ?>
            <div class="application-section">
                <h3>Your Applications</h3>
                <a href="applicationList.php"><button class="full-width-button">Applications</button></a>
            </div>
        <?php endif; ?>

        <?php if ($companyExists && $role === 'employer'): ?>
                <!-- View Company Profile button appears only if the user has a company profile and role is employer -->
                <a href="companyProfile.php?company_id=<?= $companyId ?>"><button class="view-company-button">View Company Profile</button></a>
            <?php endif; ?>

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
            
        <!-- Only display developer-section if role is 'user' -->
        <?php if ($role == 'user'): ?>
            <div class="developer-section">
                <h3>If You Want To Be A Developer</h3>
                <p>Upgrade your account to access developer features</p>
                <a href="viewMyDeveloper.php"><button class="full-width-button">Upgrade To Developer Account</button></a>
            </div>
        <?php endif; ?>

        <!-- Only display company-section if role is 'employer' -->
        <?php if ($role == 'employer'): ?>
            <div class="company-section">
                <h3>Create Or Edit Your Company Profile</h3>
                <p>Fill in all missing details about your company</p>
                <a href="createCompany.php"><button class="full-width-button">Create Or Edit Company Profile</button></a>
            </div>
        <?php endif; ?>
    </div>

    <?php include_once 'footer.php'; ?>

    <script>
        // You can add any necessary JavaScript here
    </script>
</body>
</html>
