<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CareerMap - View Developer Profile</title>
    <link rel="stylesheet" href="../css/viewMyDeveloper.css">
</head>

<body>

    <?php
    include_once 'header.php';
    // session_start();
    include_once 'includes/config.php'; // Include DB connection

    // Check if the user is logged in
    // if (!isset($_SESSION['user_id'])) {
    //     header("Location: login.php"); // Redirect to login if not logged in
    //     exit();
    // }

    // $user_id = $_SESSION['user_id'];

    $user_id = 1; // Hardcoded user ID for testing

    // Fetch the developer profile for the logged-in user
    $sql = "SELECT * FROM developers WHERE user_id = ?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if a developer profile exists
    if ($result->num_rows === 0) {
        // If no profile is found, display "Create Developer Profile" button
        echo '
        <div class="no-profile-container-456">
            <h2>You don\'t have a developer profile yet.</h2>
            <a href="createDeveloper.php" class="create-profile-btn-456">Create Developer Profile</a>
        </div>';
    } else {
        // Fetch profile details
        $developer = $result->fetch_assoc();
    ?>

        <h1 class="main-title-456">View Developer Profile</h1>

        <div class="profile-container-456">
            <!-- Left Section: Profile Info -->
            <div class="profile-header-456">
                <div class="profile-avatar-456">
                    <img src="../uploads/<?php echo $developer['avatar']; ?>" alt="Developer Avatar">
                </div>
                <div class="profile-info-456">
                    <input type="text" id="fullname-456" value="<?php echo $developer['fullname']; ?>" disabled class="input-field-456">
                    <textarea id="bio-456" disabled class="textarea-field-456"><?php echo $developer['bio']; ?></textarea>
                    <input type="text" id="skills-456" value="<?php echo $developer['skills']; ?>" disabled class="input-field-456">
                    <input type="number" id="pay-456" value="<?php echo $developer['pay']; ?>" disabled class="input-field-456">
                </div>
            </div>

            <!-- Social Links Section -->
            <div class="profile-details-456">
                <h2 class="section-title-456">Social Links</h2>
                <input type="url" id="github_link-456" value="<?php echo $developer['github_link']; ?>" disabled class="input-field-456" placeholder="GitHub Link">
                <input type="url" id="linkedin_link-456" value="<?php echo $developer['linkedin_link']; ?>" disabled class="input-field-456" placeholder="LinkedIn Link">
                <input type="url" id="behance_link-456" value="<?php echo $developer['behance_link']; ?>" disabled class="input-field-456" placeholder="Behance Link">
                <input type="url" id="stackoverflow_link-456" value="<?php echo $developer['stackoverflow_link']; ?>" disabled class="input-field-456" placeholder="StackOverflow Link">
                <input type="url" id="portfolio_link-456" value="<?php echo $developer['portfolio_link']; ?>" disabled class="input-field-456" placeholder="Portfolio Link">

                <!-- Edit, Save, and Delete Buttons -->
                <button id="edit-profile-btn-456" class="edit-profile-btn-456" onclick="enableEdit()">Edit Profile</button>
                <button id="save-changes-btn-456" class="save-changes-btn-456" style="display: none;" onclick="saveChanges()">Save Changes</button>
                <button id="cancel-edit-btn-456" class="cancel-edit-btn-456" style="display: none;" onclick="cancelEdit()">Cancel</button>
                <button id="delete-profile-btn-456" class="delete-profile-btn-456" onclick="confirmDelete(<?php echo $developer['id']; ?>)">Delete Profile</button>

            </div>
        </div>

    <?php
    }
    $stmt->close();
    $con->close();
    ?>

    <?php
    include_once 'footer.php';
    ?>

    <script src="../js/developers.js"></script>

</body>

</html>