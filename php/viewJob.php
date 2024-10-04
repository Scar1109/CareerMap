<?php
session_start();
include_once 'includes/config.php';

// Get the job ID from the URL or default to 2 for testing purposes
$job_id = isset($_GET['job_id']) ? (int)$_GET['job_id'] : 12;

if ($job_id > 0) {
    // Fetch job details from the database
    $sql = "SELECT jobs.id, jobs.title, jobs.description, jobs.salary, jobs.location, jobs.created_at, jobs.image,
            jobs.user_id, companies.name AS company_name, companies.location AS company_location 
            FROM jobs 
            JOIN companies ON jobs.user_id = companies.id 
            WHERE jobs.id = ?";
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

// Helper function for time ago format (PHP)
function time_elapsed_string($datetime, $full = false) {
    $now = new DateTime;
    $ago = new DateTime($datetime);
    $diff = $now->diff($ago);

    $string = array(
        'y' => 'year',
        'm' => 'month',
        'd' => 'day',
        'h' => 'hour',
        'i' => 'minute',
        's' => 'second',
    );
    foreach ($string as $k => &$v) {
        if ($diff->$k) {
            $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
        } else {
            unset($string[$k]);
        }
    }

    if (!$full) $string = array_slice($string, 0, 1);
    return $string ? implode(', ', $string) . ' ago' : 'just now';
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/job.styles.css">
    <title><?php echo htmlspecialchars($job['title']); ?> - Job Details</title>
</head>
<body class="JB_body">
<?php include_once 'header.php'; ?>

<div class="JB_container">
    <section class="JB_job-details">
        <div class="JB_job-header">
            <img src="https://www.gloryassumptionspace.com/wp-content/uploads/2021/01/apply.jpg" class="JB_job-image">
            <div class="JB_job-title">
                <div><h2><?php echo htmlspecialchars($job['title']); ?></h2></div> 
                <div class="JB_job-buttons">
                    <?php if (isset($_SESSION['role']) && $_SESSION['role'] == 'employer' && $job['user_id'] == $_SESSION['userid']): ?>
                        <div><a href="editJob.php?job_id=<?php echo $job['id']; ?>" class="JB_apply-btn">Edit</a></div>
                        <form action="../php/includes/deleteJob.inc.php" method="POST">
                            <input type="hidden" name="job_id" value="<?php echo $job['id']; ?>">
                            <button type="submit" class="JB_delete-btn" onclick="return confirm('Are you sure you want to delete this job?');">Delete</button>
                        </form>

                    <?php endif; ?>
                    <?php if (isset($_SESSION['role']) && $_SESSION['role'] == 'user'): ?>
                        <div><a href="applyJob.php?job_id=<?php echo $job['id']; ?>" class="JB_apply-btn">Apply</a></div>
                    <?php endif; ?>
                </div>
            </div>
            <span class="JB_salary">RS: <?php echo htmlspecialchars(number_format($job['salary'])); ?> - RS: <?php echo htmlspecialchars(number_format($job['salary'] * 1.2)); ?></span>
            <span class="JB_location"><?php echo htmlspecialchars($job['location']); ?></span>
            <span class="JB_posted-time" data-datetime="<?php echo $job['created_at']; ?>">Posted <?php echo time_elapsed_string($job['created_at']); ?></span>
        </div>

        <div class="JB_job-middle">
            <div class="JB_job-description">
                <h3>Job Description</h3>
                <p><?php echo nl2br(htmlspecialchars($job['description'])); ?></p>
            </div>

            <div class="JB_responsibilities">
                <h3>Responsibilities</h3>
                <ul>
                    <li>Collaborate with cross-functional teams to define, design, and ship new features.</li>
                    <li>Maintain high code quality through regular testing and reviewing processes.</li>
                    <li>Analyze and optimize performance for scalability and stability of the system.</li>
                </ul>
            </div>
        </div>
    </section>
    <section class="JB_company-details">
    <h3>About Company</h3>
    <div class="JB_company-info">
        <div class="JB_company-name">
            <a href="companyProfile.php?company_id=<?php echo htmlspecialchars($job['user_id']); ?>">
                <?php echo htmlspecialchars($job['company_name']); ?>
            </a>
        </div>
        <p><?php echo htmlspecialchars($job['company_location']); ?></p>
    </div>
</section>

</div>

<?php include_once 'footer.php'; ?>

<script src="../js/job.js"></script>

</body>
</html>

<?php
// Close the database connection
$con->close();
?>
