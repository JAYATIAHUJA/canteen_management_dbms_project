<?php

//include constants.php for SITEURL
include('../config/constants.php');
//destroy the session

session_destroy(); //unsetting $_SESSION['user'] will also destroy the session

//redirect to login page with message
header('location:'.SITEURL.'admin/login.php');
?>