<?php

   //include constants.php
    include('../config/constants.php');

    //1. get the id of the category to be deleted
    //2. create sql query to delete
    //3. execute the query
    //4. redirect to manage category with message

    //session start
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
  
  //check whether the id and image name is set or not
    if(isset($_GET['id']) && isset($_GET['Image_name']))
    {
        //get the value and delete
        $id = $_GET['id'];
        $Image_name = $_GET['Image_name'];
    
        //remove the physical image file if available
        if($Image_name != "")
        {
            //get the image path
            $path = "../images/category/".$Image_name;
    
            //remove the image only if it exists
            if (file_exists($path)) {
                $remove = unlink($path);
    
                //if failed to remove image then add an error message and stop the process
                if($remove==false)
                {
                    //set the session message
                    $_SESSION['remove'] = "<div class='error'>Failed to remove category image.</div>";
                    //redirect to manage category page
                    header('location:'.SITEURL.'admin/manage-category.php');
                    //stop the process
                    die();
                }
            }
        }
    
        // Enable mysqli exceptions
        mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
    
        //delete data from database
        $sql = "DELETE FROM tbl_category WHERE id=$id";
    
        try {
            $res = mysqli_query($conn, $sql);
            if($res==true)
            {
                $_SESSION['delete'] = "<div class='success'>Category deleted successfully.</div>";
                header('location:'.SITEURL.'admin/manage-category.php');
                exit();
            }
        } catch (mysqli_sql_exception $e) {
            $error = $e->getMessage();
            if (strpos($error, 'Cannot delete category with assigned foods.') !== false) {
                $_SESSION['delete'] = "<div class='error'>You cannot delete this category because it still has foods assigned.</div>";
            } else {
                $_SESSION['delete'] = "<div class='error'>Failed to delete category. $error</div>";
            }
            header('location:'.SITEURL.'admin/manage-category.php');
            exit();
        }
    }
    else
    {
        //redirect to manage category page
        header('location:'.SITEURL.'admin/manage-category.php');
    }
   
?>