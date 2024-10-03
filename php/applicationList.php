<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Applications</title>
    <link rel="stylesheet" href="styles/applicationList.css">
</head>
<body>
    <?php
    include_once 'header.php';
    include_once 'includes/config.php';

    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    $user_id = $_SESSION['userid'];

    // Fetch the user's applications from the database
    $sql = "SELECT * FROM applications WHERE user_id = ?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    ?>

    <div class="container-application">
        <h1>Manage Application</h1>

        <?php while ($application = $result->fetch_assoc()) { ?>
            <div class="application-item">
                <div class="application-info">
                    <img src="path/to/avatar.jpg" alt="User Avatar">
                    <div class="application-details">
                        <h3><?php echo $application['name']; ?> - Web Developer - Intern</h3>
                        <p><?php echo $application['email']; ?></p>
                        <p>Resume: <a href="<?php echo $application['resume']; ?>" target="_blank">Download</a></p>
                    </div>
                </div>
                <div class="application-actions">
                    <button class="edit-btn" onclick="openEditPopup(<?php echo $application['id']; ?>)">Edit Application</button>
                    <button class="cancel-btn" onclick="confirmDelete(<?php echo $application['id']; ?>)">Cancel</button>
                </div>
            </div>
        <?php } ?>

        <!-- Pagination here, you can add a pagination component -->
    </div>

    <!-- Popup for editing application details -->
    <div id="edit-popup" class="popup">
        <div class="popup-content">
            <span class="close-btn" onclick="closePopup()">&times;</span>
            <h2>Edit Application</h2>
            <form id="edit-application-form">
                <input type="hidden" id="application-id" name="application_id">
                <label for="name">Name</label>
                <input type="text" id="name" name="name" required>

                <label for="email">Email</label>
                <input type="email" id="email" name="email" required>

                <label for="resume">Resume</label>
                <input type="file" id="resume" name="resume">

                <button type="submit">Save Changes</button>
            </form>
        </div>
    </div>

    <script src="scripts/applicationList.js"></script>
    <?php
    include_once 'footer.php';
    ?>
</body>
</html>
