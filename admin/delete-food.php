<?php

    //include constants.php for SITEURL
    include('../config/constants.php');

    // Check if the ID and image name are set
    
    if(isset($_GET['id']) && $_GET['image_name']){  
        // Get the ID of the food to be deleted
        $id = $_GET['id'];
        $image_name = $_GET['image_name'];

        // Remove the image if available
        if ($image_name != "") {
            $path = "../images/food/" . $image_name;
            $remove = unlink($path);

            // Check if the image is removed
            if ($remove == false) {
                $_SESSION['remove'] = "<div class='error'>Failed to remove image.</div>";
                header('location:' . SITEURL . 'admin/manage-food.php');
                die();
            }
        }

        // Delete food from database
        $sql = "DELETE FROM tbl_food WHERE id=$id";
        $res = mysqli_query($conn, $sql);

        // Check if the query executed successfully
        if ($res == true) {
            $_SESSION['delete'] = "<div class='success'>Food deleted successfully.</div>";
            header('location:' . SITEURL . 'admin/manage-food.php');
        } else {
            $_SESSION['delete'] = "<div class='error'>Failed to delete food.</div>";
            header('location:' . SITEURL . 'admin/manage-food.php');
        }

    } else {
        $_SESSION['unauthorize'] = "<div class='error'>Unauthorized access.</div>";
        header('location:' . SITEURL . 'admin/manage-food.php');
    }
        




?>