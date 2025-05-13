<?php include dirname(__DIR__) . "/config/constants.php"; ?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <!-- Important to make website responsive -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Canteen Management System</title>

    <!-- Link our CSS file -->
    <link rel="stylesheet" href="<?php echo SITEURL; ?>css/style.css">
    <!-- GSAP CDN -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/gsap.min.js"></script>
</head>

<body>
    <!-- Navbar Section Starts Here -->
    <nav class="navbar">
        <div class="container">
            <div class="logo">
                <a href="<?php echo SITEURL; ?>">
                    <img src="<?php echo SITEURL; ?>images/bitebox-logo.png" alt="BiteBox Logo" class="img-responsive">
                </a>
            </div>

            <div class="menu">
                <ul>
                    <li>
                        <a href="<?php echo SITEURL; ?>">Home</a>
                    </li>
                    <li>
                        <a href="<?php echo SITEURL; ?>categories.php">Categories</a>
                    </li>
                    <li>
                        <a href="<?php echo SITEURL; ?>foods.php">Foods</a>
                    </li>

                        <li>
                            <a href="<?php echo SITEURL; ?>/admin/login.php">Admin Login</a>
                        </li>
                        <?php
                
                    ?>
                </ul>
            </div>

            <div class="clearfix"></div>
        </div>
    </nav>
    <!-- Navbar Section Ends Here -->

<script>
  window.addEventListener('DOMContentLoaded', function() {
    gsap.from('.logo', {y: -60, opacity: 0, duration: 1, ease: 'power2.out'});
    gsap.from('.menu ul li', {y: -40, opacity: 0, duration: 0.7, stagger: 0.1, delay: 0.3, ease: 'power2.out'});
  });
</script>


    
    