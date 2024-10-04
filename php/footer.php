<footer class="footer">
    <div class="footer-container">
        <div class="row">
            <div class="footer-col">
                <h4>Company</h4>
                <ul>
                    <li><a href="about.php#">About us</a></li>
                    <li><a href="about.php#">Our services</a></li>
                    <li><a href="about.php#">Privacy policy</a></li>
                </ul>
            </div>
            <div class="footer-col">
                <h4>Get Help</h4>
                <ul>
                    <li><a href="contact.php#">FAQ</a></li>
                    <li><a href="contact.php">Contact us</a></li>
                    <li><a href="#">Applications</a></li>
                </ul>
            </div>
            <div class="footer-col">
                <h4>Our Services</h4>
                <ul>
                    <li><a href="#">Apply for a job</a></li>
                    
                    <?php if (isset($_SESSION['role']) && $_SESSION['role'] !== 'user') { ?>
                        <!-- Show Post a job link only if the role is not 'user' -->
                        <li><a href="createJob.php">Post a job</a></li>
                    <?php } else { ?>
                        <!-- Optionally, you can show a disabled link -->
                        <li><span style="color: gray; cursor: not-allowed;">Post a job (Restricted)</span></li>
                    <?php } ?>

                    <li><a href="#">Create job profile</a></li>
                    <li><a href="#">Blogs</a></li>
                </ul>
            </div>
            <div class="footer-col">
                <div class="follow-us">
                    <h4>Follow us</h4>
                    <div class="social-links">
                        <a href="https://wa.me/00000000" target="_blank"><i class="fa fa-whatsapp"></i></a>
                        <a href="https://www.facebook.com/" target="_blank"><i class="fa fa-facebook-f"></i></a>
                        <a href="https://www.instagram.com/" target="_blank"><i class="fa fa-instagram"></i></a>
                        <a href="https://twitter.com/" target="_blank"><i class="fa fa-twitter"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
