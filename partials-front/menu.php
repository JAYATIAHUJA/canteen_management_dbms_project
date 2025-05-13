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
</head>

<body>
    <!-- Navbar Section Starts Here -->
    <nav class="navbar">
        <div class="container">
            <div class="logo">
                <a href="<?php echo SITEURL; ?>">
                    <img src="<?php echo SITEURL; ?>images/logo.png" alt="Canteen Logo" class="img-responsive">
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
                    <?php
                    if(isset($_SESSION['user_id'])) {
                        ?>
                        <li>
                            <a href="<?php echo SITEURL; ?>orders.php">My Orders</a>
                        </li>
                        <li>
                            <a href="<?php echo SITEURL; ?>logout.php">Logout</a>
                        </li>
                        <?php
                    } else {
                        ?>
                        <li>
                            <a href="<?php echo SITEURL; ?>login.php">Login</a>
                        </li>
                        <?php
                    }
                    ?>
                </ul>
            </div>

            <div class="clearfix"></div>
        </div>
    </nav>
    <!-- Navbar Section Ends Here -->


    
    