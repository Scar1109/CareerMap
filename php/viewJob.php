<?php
include_once 'includes/config.php';

// Get the job ID from the URL or default to 2 for testing purposes
$job_id = isset($_GET['job_id']) ? (int)$_GET['job_id'] : 7;

if ($job_id > 0) {
    // Fetch job details from the database
    $sql = "SELECT jobs.id, jobs.title, jobs.description, jobs.salary, jobs.location, jobs.created_at, jobs.image,
            companies.name AS company_name, companies.location AS company_location 
            FROM jobs 
            JOIN companies ON jobs.company_id = companies.id 
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
            <!-- Uncomment the line below to use a dynamic image from the database -->
            <!-- <img src="../images/<?php echo htmlspecialchars($job['image']); ?>" alt="<?php echo htmlspecialchars($job['title']); ?>" class="JB_job-image"> -->
            <div class="JB_job-title">
                <div><h2><?php echo htmlspecialchars($job['title']); ?></h2></div> 
                <div><a href="applyJob.php?job_id=<?php echo $job['id']; ?>" class="JB_apply-btn">Apply</a></div>
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
                    <li>Responsibility 1</li>
                    <li>Responsibility 2</li>
                    <li>Responsibility 3</li>
                </ul>
            </div>
        </div>
    </section>

    <section class="JB_company-details">
        <h3>About Company</h3>
        <div class="JB_company-info">
            <div class="JB_company-name"><?php echo htmlspecialchars($job['company_name']); ?></div>
            <p><?php echo htmlspecialchars($job['company_location']); ?></p>
        </div>
    </section>
</div>

<?php include_once 'footer.php'; ?>

<script>
// Helper function for time ago format using JavaScript
function timeElapsedString(datetime) {
    const now = new Date();
    const past = new Date(datetime);
    const diffInSeconds = Math.floor((now - past) / 1000);

    const timeIntervals = {
        year: 31536000,  // 60 * 60 * 24 * 365
        month: 2592000,  // 60 * 60 * 24 * 30
        day: 86400,      // 60 * 60 * 24
        hour: 3600,      // 60 * 60
        minute: 60,
        second: 1
    };

    let timeAgo = '';

    for (const [key, seconds] of Object.entries(timeIntervals)) {
        const time = Math.floor(diffInSeconds / seconds);
        if (time >= 1) {
            timeAgo = `${time} ${key}${time > 1 ? 's' : ''} ago`;
            break;
        }
    }

    return timeAgo || 'just now';
}

// Use the JavaScript timeElapsedString function
document.addEventListener('DOMContentLoaded', function () {
    const postedTimeElement = document.querySelector('.JB_posted-time');
    const postedTime = postedTimeElement.getAttribute('data-datetime');

    // Call the timeElapsedString function
    const timeAgo = timeElapsedString(postedTime);

    // Update the content of the element
    postedTimeElement.textContent = `Posted ${timeAgo}`;
});
</script>

</body>
</html>

<?php
// Close the database connection
$con->close();
?>
