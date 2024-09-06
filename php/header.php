<?php
        $current_page = basename($_SERVER['PHP_SELF']);
        session_start();
?>

<link rel="stylesheet" href="../css/styles.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<div class="headSquare">
        <a href="index.php">
                <img class="logo" src="../images/logo_Main.png" alt="logo" >
        </a>

        <?php
        if (isset($_SESSION["userName"])) {
        echo '
        <div class="user-dropdown">
                <a href="userAcc.php" class="loggedInUser">
                <i class="fa fa-user-circle-o" style="font-size:36px"></i>
                </a>
                <a href="userAcc.php" class="loggedInUserText">
                <p>' . $_SESSION["userName"] . '</p>
                </a>
                <div class="user-dropdown-content">
                        <a href="userAcc.php">Account details</a>
                        <a href="includes/logout.inc.php">Log out</a>
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
        <li <?php if($current_page === 'index.php') echo ' class="active"'; ?>><a href="index.php">Home</a></li>
        <li <?php if($current_page === 'renew.php') echo ' class="active"'; ?>><a href="applications.php">Applications</a></li>
        <li <?php if($current_page === 'renew.php') echo ' class="active"'; ?>><a href="developers.php">Developers</a></li>
        <li <?php if($current_page === 'about.php') echo ' class="active"'; ?>><a href="blogs.php">Blogs</a></li>
        <li <?php if($current_page === 'about.php') echo ' class="active"'; ?>><a href="aboutUs.php">About Us</a></li>
        <li <?php if($current_page === 'contact.php') echo ' class="active"'; ?>><a href="contactUs.php">Contact Us</a></li>
        <div class="search-container">
                <form action="includes/search.inc.php">
                        <input type="text" placeholder="Search.." name="search">
                        <button type="submit"><i class="fa fa-search"></i></button>
                </form>
        </div>
</ul>


