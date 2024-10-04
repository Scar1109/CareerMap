<?php
// Start the session to access session variables
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Get the current page to highlight the active menu
$current_page = basename($_SERVER['PHP_SELF']);
?>

<link rel="stylesheet" href="../css/styles.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<div class="headSquare">
    <a href="index.php">
        <img class="logo" src="../images/logo_Main.png" alt="logo">
    </a>

    <?php
    // Check if the user is logged in
    if (isset($_SESSION["username"])) {
        echo '
        <div class="user-dropdown">
            <a href="profile.php" class="loggedInUser">
                <i class="fa fa-user-circle-o" style="font-size:36px"></i>
            </a>
            <a href="profile.php" class="loggedInUserText">
                <p>' . htmlspecialchars($_SESSION["username"]) . '</p> <!-- Display the username safely -->
            </a>          
            <div class="user-dropdown-content">
                <a href="profile.php">Account details</a>
                <a href="includes/logout.inc.php">Log out</a> <!-- Ensure this points to your logout script -->
            </div>
        </div>';
    } else {
        echo '
        <a href="login.php" class="logIn">
            <i class="fa fa-user-circle-o" style="font-size:36px"></i>
        </a>
        <a href="login.php" class="logInText">
            <p>Log in</p>
        </a>';
    }
    ?>
</div>

<ul class="headerNav">
    <li <?php if ($current_page === 'index.php') echo ' class="active"'; ?>><a href="index.php">Home</a></li>
    <li <?php if ($current_page === 'developers.php') echo ' class="active"'; ?>><a href="developers.php">Developers</a></li>
    <li <?php if ($current_page === 'blogs.php') echo ' class="active"'; ?>><a href="blogs.php">Blogs</a></li>
    <li <?php if ($current_page === 'aboutUs.php') echo ' class="active"'; ?>><a href="aboutUs.php">About Us</a></li>
    <li <?php if ($current_page === 'contactUs.php') echo ' class="active"'; ?>><a href="contactUs.php">Contact Us</a></li>
</ul>

