<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/job.styles.css">
    <title>Create Job</title>
</head>
<body class="JB_body">
<?php
    include_once 'header.php';
    ?>
    <div class="JB_form-container">
    <h1 class="JB_heading">Create a Job</h1>
    <form action="../php/includes/createJob.inc.php" method="POST" class="JB_form">
        <label for="JB_title" class="JB_label">Job Title</label>
        <input type="text" id="JB_title" name="title" class="JB_input" placeholder="Enter the job title" required><br>

        <label for="JB_description" class="JB_label">Description</label>
        <textarea id="JB_description" name="description" class="JB_textarea" placeholder="Enter job description" required></textarea><br>

        <label for="JB_location" class="JB_label">Location</label>
        <input type="text" id="JB_location" name="location" class="JB_input" placeholder="Enter job location" required><br>

        <label for="JB_salary" class="JB_label">Salary</label>
        <input type="text" id="JB_salary" name="salary" class="JB_input" placeholder="Enter salary (e.g., 50000)" required><br>

        <input type="submit" value="Create Job" class="JB_button">
    </form>
</div>
    <?php
    include_once 'footer.php';
    ?>
</body>
</html>
