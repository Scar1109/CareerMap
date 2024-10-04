<?php
session_start();
include_once 'includes/config.php';  // Ensure you have a proper session and connection setup

// Assuming the company ID is passed via URL
$company_id = isset($_GET['company_id']) ? (int)$_GET['company_id'] : 1;
$userId = $_SESSION['userid'] ?? '';  // Fetch logged-in user ID from session

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
            WHERE jobs.user_id = ?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("i", $company_id);
    $stmt->execute();
    $applications_result = $stmt->get_result();
} else {
    echo "Invalid company ID!";
    exit;
}

$role = $_SESSION['role'] ?? ''; // Fetch the user role from the session
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
                <img src="https://png.pngtree.com/png-vector/20221013/ourmid/pngtree-company-profile-iconflat-design-different-illustration-crowd-vector-png-image_20180366.png" alt="Company Logo">
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

        <?php if ($company['userId'] == $userId): // Show Edit/Delete buttons only if the logged-in user owns the company ?>
        <div class="CP_social-actions">
            <!-- Edit Button: Redirect to createCompany.php with the company_id as a query parameter -->
            <a href="createCompany.php?company_id=<?= $company_id ?>">
                <button type="button" class="CP_follow-button" >Edit</button>
            </a>

            <!-- Delete Button: Submitting a POST request to deleteCompany.inc.php -->
            <form action="../php/includes/deleteCompany.inc.php" method="POST" style="display:inline;">
                <input type="hidden" name="company_id" value="<?= htmlspecialchars($company_id) ?>">
                <button type="submit" class="CP_share-btn" onclick="return confirm('Are you sure you want to delete this company?');">Delete</button>
            </form>
        </div>
        <?php endif; ?>

    </section>

    <section class="CP_about-us">
        <h2>About Us</h2>
        <p><?php echo nl2br(htmlspecialchars($company['about'])); ?></p>
        <h3>Why Choose Us</h3>
            <ul>
                <li>Innovative solutions tailored to meet your business needs.</li>
                <li>Experienced team with a proven track record of success.</li>
                <li>Dedicated customer support ensuring seamless collaboration.</li>
            </ul>

    </section>

    <?php if ($role === 'employer'): // Show this section only to employer users ?>
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
    <?php endif;?>
</div>

<?php include_once 'footer.php'; ?>

</body>
</html>

<?php
// Close the database connection
$con->close();
?>
