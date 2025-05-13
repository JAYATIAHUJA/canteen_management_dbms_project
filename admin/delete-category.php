<?php

   //include constants.php
    include('../config/constants.php');

    //1. get the id of the category to be deleted
    //2. create sql query to delete
    //3. execute the query
    //4. redirect to manage category with message

    //session start
    session_start();
  
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
    
            //remove the image
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
    
        //delete data from database
        $sql = "DELETE FROM tbl_category WHERE id=$id";
    
        //execute query
        $res = mysqli_query($conn, $sql);
    
        //check whether the query executed successfully or not
        if($res==true)
        {
            //set success message and redirect
            $_SESSION['delete'] = "<div class='success'>Category deleted successfully.</div>";
            header('location:'.SITEURL.'admin/manage-category.php');
        }
        else
        {
            //set failure message and redirect
            $_SESSION['delete'] = "<div class='error'>Failed to delete category.</div>";
            header('location:'.SITEURL.'admin/manage-category.php');
        }
    }
    else
    {
        //redirect to manage category page
        header('location:'.SITEURL.'admin/manage-category.php');
    }
   
?>