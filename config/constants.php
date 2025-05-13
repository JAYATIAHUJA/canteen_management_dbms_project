<?php 

//start session
session_start(); //start session

//create constants to store non-repeating values
define('LOCALHOST', 'localhost:3307'); //constant for site url
define('DB_USERNAME', 'root'); //constant for database username
define('DB_PASSWORD', '' ); //constant for database password
define('DB_NAME', 'canteen_management'); //constant for database name
define('SITEURL', 'http://localhost/canteen_management/'); //constant for site url

$conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD) or die(mysqli_error($conn)); //datebase connection
$db_select = mysqli_select_db($conn, DB_NAME) or die(mysqli_error($conn)); //selecting database

?>