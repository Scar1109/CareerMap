<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CareerMap</title>
    <link rel="stylesheet" href="../css/viewMyDeveloper.css">

<body>
    <?php
    include_once 'header.php';
    // session_start();
    include_once './includes/config.php'; // Include DB connection

    // if (!isset($_SESSION['user_id'])) {
    //     header("Location: login.php"); // Redirect to login if not logged in
    //     exit();
    // }

    // $user_id = $_SESSION['user_id'];
    
    $user_id = 1; // Hardcoded user ID for testing purposes

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
        <div class="no-profile-container-452">
            <h2>You don\'t have a developer profile yet.</h2>
            <a href="createDeveloper.php" class="create-profile-btn-452">Create Developer Profile</a>
        </div>';
    } else {
        // Fetch profile details
        $developer = $result->fetch_assoc();
        ?>

        <div class="profile-container-452">
            <div class="profile-header-452">
                <div class="profile-avatar-452">
                    <img src="uploads/<?php echo $developer['avatar']; ?>" alt="Developer Avatar">
                </div>
                <div class="profile-info-452">
                    <input type="text" id="fullname-452" value="<?php echo $developer['fullname']; ?>" disabled class="input-field-452">
                    <input type="text" id="skills-452" value="<?php echo $developer['skills']; ?>" disabled class="input-field-452">
                    <textarea id="bio-452" disabled class="textarea-field-452"><?php echo $developer['bio']; ?></textarea>

                    <!-- Buttons for Edit, Save, Cancel, and Delete -->
                    <button id="edit-profile-btn-452" class="edit-profile-btn-452">Edit Profile</button>
                    <button id="save-changes-btn-452" class="save-changes-btn-452" style="display: none;">Save Changes</button>
                    <button id="cancel-edit-btn-452" class="cancel-edit-btn-452" style="display: none;">Cancel</button>
                    <button class="delete-profile-btn-452" onclick="confirmDelete(<?php echo $developer['id']; ?>)">Delete Profile</button>
                </div>
            </div>

            <div class="profile-details-452">
                <h2>Working Experience</h2>
                <p>Experience data can go here...</p> <!-- This can be replaced with real working experience -->
            </div>
        </div>

        <!-- Confirmation Script for Deleting Profile -->
        <script>
            function confirmDelete(developerId) {
                if (confirm("Are you sure you want to delete your developer profile? This action cannot be undone.")) {
                    window.location.href = "deleteDeveloper.php?id=" + developerId;
                }
            }

            // JavaScript for enabling and disabling fields
            const editButton = document.getElementById('edit-profile-btn-452');
            const saveButton = document.getElementById('save-changes-btn-452');
            const cancelButton = document.getElementById('cancel-edit-btn-452');
            const inputs = document.querySelectorAll('.input-field-452');
            const textarea = document.getElementById('bio-452');

            editButton.addEventListener('click', function() {
                inputs.forEach(input => input.disabled = false); // Enable input fields
                textarea.disabled = false; // Enable textarea
                editButton.style.display = 'none'; // Hide Edit button
                saveButton.style.display = 'inline-block'; // Show Save button
                cancelButton.style.display = 'inline-block'; // Show Cancel button
            });

            cancelButton.addEventListener('click', function() {
                inputs.forEach(input => input.disabled = true); // Disable input fields
                textarea.disabled = true; // Disable textarea
                editButton.style.display = 'inline-block'; // Show Edit button
                saveButton.style.display = 'none'; // Hide Save button
                cancelButton.style.display = 'none'; // Hide Cancel button
            });

            saveButton.addEventListener('click', function() {
                if (confirm("Are you sure you want to save changes?")) {
                    // Perform AJAX request to update the developer profile
                    const fullname = document.getElementById('fullname-452').value;
                    const skills = document.getElementById('skills-452').value;
                    const bio = document.getElementById('bio-452').value;

                    const xhr = new XMLHttpRequest();
                    xhr.open('POST', 'updateDeveloper.php', true);
                    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                    xhr.onload = function() {
                        if (xhr.status === 200) {
                            alert('Profile updated successfully!');
                            location.reload(); // Reload the page after successful update
                        } else {
                            alert('Error updating profile.');
                        }
                    };
                    xhr.send('id=<?php echo $developer['id']; ?>&fullname=' + fullname + '&skills=' + skills + '&bio=' + bio);
                }
            });
        </script>

        <?php
    }
    $stmt->close();
    $con->close();
    ?>

    <?php
    include_once 'footer.php';
    ?>
</body>

</html>
