<?php
include_once 'includes/config.php';

// Get the job ID from the URL
$job_id = isset($_GET['job_id']) ? (int)$_GET['job_id'] : 0;

if ($job_id > 0) {
    // Fetch job details to display the title on the application form
    $sql = "SELECT title FROM jobs WHERE id = ?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("i", $job_id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $job = $result->fetch_assoc();
    } else {
        echo "Job not found!";
        exit;
    }

    $stmt->close();
} else {
    echo "Invalid job ID!";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/applyJob.styles.css">
    <title>Apply for <?php echo htmlspecialchars($job['title']); ?></title>
</head>
<body class="AJ_body">
<?php include_once 'header.php'; ?>

<div class="AJ_container">
    <section class="AJ_apply-job">
        <h1 class="AJ_title">Apply for <?php echo htmlspecialchars($job['title']); ?></h1>
        <form action="includes/submitApplication.php" method="POST" enctype="multipart/form-data" class="AJ_form">
            <input type="hidden" name="job_id" value="<?php echo $job_id; ?>">

            <div class="AJ_form-group">
                <label for="name" class="AJ_label">Full Name</label>
                <input type="text" id="name" name="name" class="AJ_input" required>
            </div>

            <div class="AJ_form-group">
                <label for="email" class="AJ_label">Email Address</label>
                <input type="email" id="email" name="email" class="AJ_input" required>
            </div>

            <div class="AJ_form-group">
                <label for="resume" class="AJ_label">Upload your resume</label>
                <input type="file" id="resume" name="resume" class="AJ_input-file" accept=".pdf,.doc,.docx" required>
            </div>

            <div class="AJ_form-group">
                <button type="submit" class="AJ_submit-btn">Submit Application</button>
            </div>
        </form>
    </section>
</div>

<?php include_once 'footer.php'; ?>
</body>
</html>

<?php
// Close the database connection
$con->close();
?>
