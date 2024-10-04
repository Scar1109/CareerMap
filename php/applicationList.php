<?php
// Start session and include required files
session_start();
require_once 'includes/config.php';
require_once 'includes/functions.inc.php';

// Check if user is logged in
if (!isset($_SESSION['userid'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['userid']; // Get the logged-in user's ID

// Handle Delete Request
if (isset($_GET['delete'])) {
    $application_id = $_GET['delete'];

    // Delete the application from the database
    $sql = "DELETE FROM applications WHERE id = ? AND user_id = ?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("ii", $application_id, $user_id);
    
    if ($stmt->execute()) {
        header("Location: applicationList.php?success=applicationdeleted");
    } else {
        header("Location: applicationList.php?error=deletionfailed");
    }
    exit();
}

// Handle Edit Request (Form submission)
if (isset($_POST['submit'])) {
    $application_id = $_POST['application_id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $resume = $_FILES['resume']['name'];

    // Resume file upload handling
    if (!empty($resume)) {
        $resumePath = 'uploads/' . basename($resume);
        move_uploaded_file($_FILES['resume']['tmp_name'], $resumePath);
    } else {
        $resumePath = $_POST['existing_resume'];
    }

    // Update the application in the database
    $sql = "UPDATE applications SET name = ?, email = ?, resume = ? WHERE id = ? AND user_id = ?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("sssii", $name, $email, $resumePath, $application_id, $user_id);
    
    if ($stmt->execute()) {
        header("Location: applicationList.php?success=applicationupdated");
    } else {
        header("Location: applicationList.php?error=updatefailed");
    }
    exit();
}

// Fetch all applications for the logged-in user
$sql = "SELECT * FROM applications WHERE user_id = ?";
$stmt = $con->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Applications</title>
    <link rel="stylesheet" href="../css/applicationlist.styles.css">
</head>
<body>

    <?php include_once 'header.php'; ?>

    <div class="container-app-789">
        <h1>Manage Applications</h1>

        <!-- Display success or error messages -->
        <?php if (isset($_GET['success'])) { ?>
            <p class="success-789"><?php echo $_GET['success']; ?></p>
        <?php } elseif (isset($_GET['error'])) { ?>
            <p class="error-789"><?php echo $_GET['error']; ?></p>
        <?php } ?>

        <?php while ($application = $result->fetch_assoc()) { ?>
            <div class="application-item-789">
                <div class="application-info-789">
                    <h3><?php echo $application['name']; ?></h3>
                    <p><?php echo $application['email']; ?></p>
                    <p>Resume: <a href="<?php echo $application['resume']; ?>" target="_blank">Download</a></p>
                </div>
                <div class="application-actions-789">
                    <!-- Edit Button triggers a modal -->
                    <button class="edit-btn-789" onclick="openEditForm(<?php echo $application['id']; ?>, '<?php echo $application['name']; ?>', '<?php echo $application['email']; ?>', '<?php echo $application['resume']; ?>')">Edit</button>
                    <!-- Delete Button -->
                    <a href="applicationList.php?delete=<?php echo $application['id']; ?>" class="cancel-btn-789" onclick="return confirm('Are you sure you want to cancel this application?')">Cancel</a>
                </div>
            </div>
        <?php } ?>
    </div>

    <!-- Edit Modal -->
    <div id="edit-modal-789" class="modal-789">
        <div class="modal-content-789">
            <span class="close-789" onclick="closeEditForm()">&times;</span>
            <h2>Edit Application</h2>
            <form action="applicationList.php" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="application_id" id="edit-application-id-789">
                <label for="name">Name</label>
                <input type="text" id="edit-name-789" name="name" required>

                <label for="email">Email</label>
                <input type="email" id="edit-email-789" name="email" required>

                <label for="resume">Resume</label>
                <input type="file" id="edit-resume-789" name="resume">
                <input type="hidden" name="existing_resume" id="existing-resume-789">

                <button type="submit" name="submit" class="save-btn-789">Save Changes</button>
            </form>
        </div>
    </div>

    <script>
        // Open the edit modal and populate the fields
        function openEditForm(id, name, email, resume) {
            document.getElementById('edit-modal-789').style.display = 'flex';
            document.getElementById('edit-application-id-789').value = id;
            document.getElementById('edit-name-789').value = name;
            document.getElementById('edit-email-789').value = email;
            document.getElementById('existing-resume-789').value = resume;
        }

        // Close the edit modal
        function closeEditForm() {
            document.getElementById('edit-modal-789').style.display = 'none';
        }
    </script>

    <?php include_once 'footer.php'; ?>

</body>
</html>

<?php
mysqli_stmt_close($stmt);
?>
