<?php
include_once 'includes/config.php';

// Assuming the company ID is passed via URL
$company_id = isset($_GET['company_id']) ? (int)$_GET['company_id'] : 1;

if ($company_id > 0) {
    // Fetch company details
    $sql = "SELECT * FROM companies WHERE id = ?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("i", $company_id);
    $stmt->execute();
    $company_result = $stmt->get_result();

    if ($company_result->num_rows > 0) {
        $company = $company_result->fetch_assoc();
    } else {
        echo "Company not found!";
        exit;
    }
    $stmt->close();

    // Fetch company job applications
    $sql = "SELECT jobs.title, jobs.salary, jobs.location, applications.name, applications.email, applications.applied_at 
            FROM applications
            JOIN jobs ON applications.job_id = jobs.id
            WHERE jobs.company_id = ?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("i", $company_id);
    $stmt->execute();
    $applications_result = $stmt->get_result();
} else {
    echo "Invalid company ID!";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/companyProfile.styles.css">
    <title><?php echo htmlspecialchars($company['name']); ?> - Company Profile</title>
</head>
<body class="CP_body">

<?php include_once 'header.php'; ?>

<div class="CP_container">
    <section class="CP_profile-section">
        <div class="CP_profile-header">
            <div class="CP_company-logo">
                <img src="https://via.placeholder.com/100" alt="Company Logo">
            </div>
            <div class="CP_company-info">
                <h1><?php echo htmlspecialchars($company['name']); ?></h1>
                <p><?php echo htmlspecialchars($company['description']); ?></p>
                <div class="CP_company-details">
                    <span><i class="fas fa-globe"></i> <?php echo htmlspecialchars($company['website']); ?></span>
                    <span><i class="fas fa-map-marker-alt"></i> <?php echo htmlspecialchars($company['location']); ?></span>
                    <span><i class="fas fa-users"></i> <?php echo htmlspecialchars($company['employees']); ?> employees</span>
                </div>
            </div>
        </div>
        <div class="CP_social-actions">
            <button class="CP_follow-btn">Follow</button>
            <button class="CP_share-btn">Share</button>
        </div>
    </section>

    <section class="CP_about-us">
        <h2>About Us</h2>
        <p><?php echo nl2br(htmlspecialchars($company['about'])); ?></p>
        <h3>Why Choose Us</h3>
        <ul>
            <li>Reason 1</li>
            <li>Reason 2</li>
            <li>Reason 3</li>
        </ul>
    </section>

    <section class="CP_recent-jobs">
        <h2>Recent Job Applicant</h2>
        <div class="CP_jobs-list">
            <!-- Display job applications related to this company -->
            <?php if ($applications_result->num_rows > 0): ?>
                <?php while ($app = $applications_result->fetch_assoc()): ?>
                    <div class="CP_job-item">
                        <h3><?php echo htmlspecialchars($app['title']); ?></h3>
                        <p>Location: <?php echo htmlspecialchars($app['location']); ?></p>
                        <p>Applicant Name: <?php echo htmlspecialchars($app['name']); ?></p>
                        <p>Applicant Email: <?php echo htmlspecialchars($app['email']); ?></p>
                        <p>Applied on: <?php echo date("F j, Y", strtotime($app['applied_at'])); ?></p>
                    </div>
                <?php endwhile; ?>
            <?php else: ?>
                <p>No applications found for this company.</p>
            <?php endif; ?>
        </div>
    </section>
</div>

<?php include_once 'footer.php'; ?>

</body>
</html>

<?php
// Close the database connection
$con->close();
?>
