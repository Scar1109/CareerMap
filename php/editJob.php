<?php
session_start();
include_once 'includes/config.php';

// Check if the user is logged in
if (!isset($_SESSION['userid'])) {
    header("Location: login.php");
    exit();
}

// Get the job ID from the URL
$job_id = isset($_GET['job_id']) ? (int)$_GET['job_id'] : 0;
$user_id = $_SESSION['userid'];

// Initialize variables for job details
$title = '';
$description = '';
$location = '';
$salary = '';
$company_image = '';

if ($job_id > 0) {
    // Fetch job details if we are editing
    $sql = "SELECT * FROM jobs WHERE id = ? AND user_id = ?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("ii", $job_id, $user_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $job = $result->fetch_assoc();
        $title = $job['title'];
        $description = $job['description'];
        $location = $job['location'];
        $salary = $job['salary'];
        $company_image = $job['image'];
    } else {
        echo "Job not found!";
        exit;
    }

    $stmt->close();
}

// Handle form submission to update job
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $location = $_POST['location'];
    $salary = $_POST['salary'];
    $company_image = $_POST['company_image'];

    // Update job details in the database
    $sql = "UPDATE jobs SET title = ?, description = ?, location = ?, salary = ?, image = ? WHERE id = ? AND user_id = ?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("sssisii", $title, $description, $location, $salary, $company_image, $job_id, $user_id);

    if ($stmt->execute()) {
        // Redirect to a success page or job details page after update
        header("Location: viewJob.php?job_id=" . $job_id . "&update=success");
        exit();
    } else {
        echo "Error updating job: " . $stmt->error;
    }

    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/job.styles.css">
    <title>Edit Job</title>
</head>
<body class="JB_body">
<?php
    include_once 'header.php';
?>
    <div class="JB_form-container">
    <h1 class="JB_heading">Edit Job</h1>
    <form action="editJob.php?job_id=<?php echo $job_id; ?>" method="POST" class="JB_form" enctype="multipart/form-data">

        <label for="JB_title" class="JB_label">Job Title</label>
        <input type="text" id="JB_title" name="title" class="JB_input" placeholder="Enter the job title" value="<?php echo htmlspecialchars($title); ?>" required><br>

        <label for="JB_description" class="JB_label">Description</label>
        <textarea id="JB_description" name="description" class="JB_textarea" placeholder="Enter job description" required><?php echo htmlspecialchars($description); ?></textarea><br>

        <label for="JB_location" class="JB_label">Location</label>
        <input type="text" id="JB_location" name="location" class="JB_input" placeholder="Enter job location" value="<?php echo htmlspecialchars($location); ?>" required><br>

        <label for="JB_salary" class="JB_label">Salary</label>
        <input type="number" id="JB_salary" name="salary" class="JB_input" placeholder="Enter salary (e.g., 50000)" value="<?php echo htmlspecialchars($salary); ?>" required><br>

        <input type="submit" value="Save Job" class="JB_button">
    </form>
</div>
<?php
    include_once 'footer.php';
?>
</body>
</html>
