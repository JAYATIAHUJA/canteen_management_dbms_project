<?php

//include constants.php file here
include('../config/constants.php'); //including constants file

//1. get the id of admin to be deleted
echo $id = $_GET['id']; 
//2.create sql query to delete admin
$sql = "DELETE FROM tbl_admin WHERE id=$id"; //sql query to delete admin

$res = mysqli_query($conn, $sql); //execute the query

//check whether the query executed successfully or not
if($res==TRUE){
    //query executed successfully and admin deleted
    //create session variable to display message
    $_SESSION['delete'] = "<div class='success'>Admin deleted successfully</div>"; //creating session variable to display message
    header('location:'.SITEURL.'admin/manage-admin.php'); //redirecting to manage admin page with message
}
else{
    //failed to delete admin
    $_SESSION['delete'] = "<div class='error'>Failed to delete admin</div>"; //creating session variable to display message
    header('location:'.SITEURL.'admin/manage-admin.php'); //redirecting to manage admin page with message
}


//3.redirect to manage admin with session message
?>