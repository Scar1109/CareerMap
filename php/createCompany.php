<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION["userid"])) {
    // Redirect to login page if not logged in
    header("Location: login.php");
    exit();
}

// Fetch user data from session with default values to avoid warnings
$userId = $_SESSION["userid"] ?? '';
$role = $_SESSION["role"] ?? ''; 

// Initialize variables for company profile editing
$companyId = $_GET['company_id'] ?? '';
$companyName = '';
$companyAbout = '';
$companyDescription = '';
$companyWebsite = '';
$companyLocation = '';
$companyEmployees = '';

if (  $userId) {  // Corrected the condition
    // Fetch company data if we are editing
    include_once 'includes/config.php'; // Database connection
    $sql = "SELECT * FROM companies WHERE userId = ?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("i", $userId); // Make sure the company belongs to the logged-in user
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $company = $result->fetch_assoc();
        $companyName = $company['name'];
        $companyAbout = $company['about'];
        $companyDescription = $company['description'];
        $companyWebsite = $company['website'];
        $companyLocation = $company['location'];
        $companyEmployees = $company['employees'];
    }
    $stmt->close();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $companyId ? 'Edit' : 'Create' ?> Company Profile</title>
    <style>
        /* Company Profile form styling */
        .CP_container {
            max-width: 760px;
            margin: 0 auto;
            padding: 20px;
            background-color: white;
            border-radius: 8px;
            margin-bottom: 20px;
            margin-top: 20px;
        }
        .CP_heading {
            text-align: center;
            font-size: 2rem;
            margin-bottom: 20px;
        }
        .CP_form {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }
        .CP_label {
            font-size: 1rem;
            font-weight: bold;
            margin-bottom: 5px;
        }
        .CP_input, .CP_textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 16px;
        }
        .CP_textarea {
            height: 150px;
            resize: none;
        }
        .CP_button {
            padding: 12px 20px;
            background-color: #333;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }
        .CP_button:hover {
            background-color: #444;
        }

    </style>
</head>
<body>
    <?php include_once 'header.php'; ?>

    <?php if ($role == 'employer'): ?>
        <div class="CP_container">
            <section class="CP_profile-section">
                <h1 class="CP_heading"><?= $companyId ? 'Edit' : 'Create' ?> Company Profile</h1>

                <!-- Company Profile Form -->
                <form action="../php/includes/createCompany.inc.php" method="POST" class="CP_form">
                    <input type="hidden" name="company_id" value="<?= htmlspecialchars($companyId) ?>">
                    <label for="CP_company_name" class="CP_label">Company Name</label>
                    <input type="text" id="CP_company_name" name="name" class="CP_input" placeholder="Enter company name" value="<?= htmlspecialchars($companyName) ?>" required>
                    
                    <label for="CP_company_about" class="CP_label">Company About</label>
                    <input type="text" id="CP_company_about" name="about" class="CP_input" placeholder="Enter company about" value="<?= htmlspecialchars($companyAbout) ?>" required>

                    <label for="CP_description" class="CP_label">Description</label>
                    <textarea id="CP_description" name="description" class="CP_textarea" placeholder="Enter company description" required><?= htmlspecialchars($companyDescription) ?></textarea>

                    <label for="CP_website" class="CP_label">Website</label>
                    <input type="url" id="CP_website" name="website" class="CP_input" placeholder="Enter company website" value="<?= htmlspecialchars($companyWebsite) ?>" required>

                    <label for="CP_location" class="CP_label">Location</label>
                    <input type="text" id="CP_location" name="location" class="CP_input" placeholder="Enter company location" value="<?= htmlspecialchars($companyLocation) ?>" required>

                    <label for="CP_employees" class="CP_label">Number of Employees</label>
                    <input type="number" id="CP_employees" name="employees" class="CP_input" placeholder="Enter number of employees" value="<?= htmlspecialchars($companyEmployees) ?>" required>

                    <input type="submit" value="Save Company Profile" class="CP_button">
                </form>
            </section>
        </div>
    <?php endif; ?>

    <?php include_once 'footer.php'; ?>

</body>
</html>
