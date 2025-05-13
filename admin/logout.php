<?php

//include constants.php for SITEURL
include('../config/constants.php');
//start session if not already started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
//set logout message
$_SESSION['logout'] = "<div class='success' style='text-align:center;margin:1.5rem auto;max-width:400px;'>You have been logged out successfully.</div>";
session_write_close(); // Save session data before redirect

//redirect to main site index page
header('location:'.SITEURL.'index.php');
exit();
?>