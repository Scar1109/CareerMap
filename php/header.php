<?php
        $current_page = basename($_SERVER['PHP_SELF']);
?>

<link rel="stylesheet" href="../css/styles.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<div class="headSquare">
        <a href="index.php">
                <img class="logo" src="../images/logo_Main.png" alt="logo" >
        </a>
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


