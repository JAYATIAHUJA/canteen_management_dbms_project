<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Category</h1>

        <br><br>

        <?php
        
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            // Create SQL Query to get the details
            $sql = "SELECT * FROM tbl_category WHERE id=$id";
            // Execute the query
            $res = mysqli_query($conn, $sql);
            // Count rows to check whether we have data in database
            $count = mysqli_num_rows($res);
            if ($count == 1) {
                // Get the details
                $row = mysqli_fetch_assoc($res);
                $title = $row['title'];
                $current_image = $row['Image_name'];
                $featured = $row['featured'];
                $active = $row['active'];
            } else {
                // Redirect to manage category with session message
                $_SESSION['no-category-found'] = "<div class='error'>Category not found.</div>";
                header('location:' . SITEURL . 'admin/manage-category.php');
            }
        } else {
            header('location:' . SITEURL . 'admin/manage-category.php');
        }
        
        ?>

        <form action="" method="POST" enctype="multipart/form-data">
         
        <table class="tbl-30">
            <tr>
                <td>Title</td>
                <td>
                    <input type="text" name="title" value="<?php echo $title; ?>">
                </td>
            </tr>

            <tr>
                <td>Current Image</td>
                <td>
                    <?php
                        if ($current_image != "") {
                            // Display the image
                            ?>
                            <img src="<?php echo SITEURL; ?>images/category/<?php echo $current_image; ?>" width="100px">
                            <?php
                        } else {
                            // Display message
                            echo "<div class='error'>Image not added.</div>";
                        }
                        ?>
                </td>
            </tr>

            <tr>
                <td>New Image</td>
                <td>
                    <input type="file" name="Image">
                </td>
            </tr>

            <tr>
                <td>Featured</td>
                <td>
                    <input  <?php if($featured=="Yes"){echo "checked" ;}?> type="radio" name="featured" value="Yes"> Yes

                    <input  <?php if($featured=="No"){echo "checked" ;}?> type="radio" name="featured" value="No"> No
                </td>
            </tr>
            
            <tr>
                <td>Active</td>
                <td>
                    <input  <?php if($active=="Yes"){echo "checked" ;}?> type="radio" name="active" value="Yes"> Yes

                    <input  <?php if($active=="No"){echo "checked" ;}?> type="radio" name="active" value="No"> No
                </td>
            </tr>
            
            <tr>
                <td colspan="2">
                    <input type="hidden" name="current_image" value="<?php echo $current_image;?>">
                    <input type="hidden" name="id" value="<?php echo $id;?>">
                    <input type="submit" name="submit" value="Update Category" class="btn-secondary">
                </td>
            </tr>



        </table>
        </form>

        <?php
          
          if (isset($_POST['submit'])) {
            // Get all the values from the form
            $id = $_POST['id'];
            $title = $_POST['title'];
            $current_image = $_POST['current_image'];
            $featured = $_POST['featured'];
            $active = $_POST['active'];

            // Check whether the image is selected or not
            if (isset($_FILES['Image']['name'])) {
                // Upload the image
                $Image_name = $_FILES['Image']['name'];

                // Check whether the image is available or not
                if ($Image_name != "") {
                    // Image is available
                    // A. Upload the new image
                    // Auto rename our image
                    $ext = end(explode('.', $Image_name));
                    $Image_name = "Category_" . rand(000, 999) . '.' . $ext; // e.g. Category_123.jpg

                    $source_path = $_FILES['Image']['tmp_name'];
                    $destination_path = "../images/category/" . $Image_name;

                    // Finally upload the image
                    $upload = move_uploaded_file($source_path, $destination_path);

                    // Check whether the image is uploaded or not
                    if ($upload == false) {
                        // Set message
                        $_SESSION['upload'] = "<div class='error'>Failed to upload new image.</div>";
                        header('location:' . SITEURL . 'admin/manage-category.php');
                        die();
                    }

                    // B. Remove the current image if available
                    if ($current_image != "") {
                        $remove_path = "../images/category/" . $current_image;
                        if (file_exists($remove_path)) {
                            $remove = unlink($remove_path);
                            // Check whether the image is removed or not
                            if ($remove == false) {
                                // Failed to remove current image
                                $_SESSION['failed-remove'] = "<div class='error'>Failed to remove current image.</div>";
                                header('location:' . SITEURL . 'admin/manage-category.php');
                                die();
                            }
                        }
                    }
                } else {
                    $Image_name = $current_image; // Default image when no new image is selected
                }
            } else {
                $Image_name = $current_image; // Default image when no new image is selected
            }

            // Update the database
            $sql2 = "UPDATE tbl_category SET 
                title='$title',
                Image_name='$Image_name',
                featured='$featured',
                active='$active'
                WHERE id=$id";

            // Execute the query
            $res2 = mysqli_query($conn, $sql2);
            
            //redirect to manage category with message
            if ($res2 == true) {
                // Category updated
                $_SESSION['update'] = "<div class='success'>Category updated successfully.</div>";
                header('location:' . SITEURL . 'admin/manage-category.php');
            } else {
                // Failed to update category
                $_SESSION['update'] = "<div class='error'>Failed to update category.</div>";
                header('location:' . SITEURL . 'admin/manage-category.php');
            }

        }
        ?>

    </div>
</div>

<?php include('partials/footer.php'); ?>