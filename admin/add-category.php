<?php include 'partials/menu.php'; ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Category</h1>
        <br><br>

        <?php
            if (isset($_SESSION['add'])) {
                echo $_SESSION['add'];
                unset($_SESSION['add']);
            }

            if (isset($_SESSION['upload'])) {
                echo $_SESSION['upload'];   
                unset($_SESSION['upload']);
            }
        ?>

        <br><br>

        <form action="" method="POST" enctype="multipart/form-data">    
            <table class="tbl-30">
                <tr>
                    <td>Title:</td>
                    <td><input type="text" name="title" placeholder="Category Title"></td>
                </tr>

                <tr>
                    <td>Select Image:</td>
                    <td><input type="file" name="image"></td>
                </tr>

                <tr>
                    <td>Featured:</td>
                    <td>
                        <input type="radio" name="featured" value="Yes">Yes
                        <input type="radio" name="featured" value="No">No
                    </td>
                </tr>
                <tr>
                    <td>Active:</td>
                    <td>
                        <input type="radio" name="active" value="Yes">Yes
                        <input type="radio" name="active" value="No">No
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Category" class="btn-secondary">
                    </td>
                </tr>

               
                
            </table>
        </form>
          
        <?php
            // Check whether the submit button is clicked or not
            if (isset($_POST['submit'])) {
                // 1. Get the value from the form
                $title = $_POST['title'];

                //for radio input, we need to check whether the button is selected or not
               if (isset($_POST['featured'])) {
                    // Get the value from the form
                    $featured = $_POST['featured'];
                } else {
                    // Set the default value
                    $featured = "No"; // Default value
                }

                if (isset($_POST['active'])) {
                    // Get the value from the form
                    $active = $_POST['active'];
                } else {
                    // Set the default value
                    $active = "No"; // Default value
                }

                // 2. Check whether the image is selected or not and set the value for image name accordingly
                //print_r($_FILES['image']);// print_r() function is used to print the array in a human-readable format
                
                //die(); // die() function is used to stop the execution of the script
                if (isset($_FILES['image']['name'])) {
                    // Upload the image
                    // 1. Get the details of the selected image
                    $Image_name = $_FILES['image']['name']; // Image name
                    
                    // Check whether the image is selected or not and upload only if selected
                    if ($Image_name != "") {
                        // Image is selected
                        // A. Rename the image
                        // Get the extension of the image (jpg, png, gif, etc.)

        

                    $ext = end(explode('.', $Image_name)); // end() function is used to get the last element of an array
                    // rename the image
                    $Image_name = "Food_Category_".rand(000, 999).'.'.$ext; // New image name
                    
                    $source_path = $_FILES['image']['tmp_name']; // Source path
                    $destination_path = "../images/category/".$Image_name; // Destination path
                     //auto rename our image
                    // get the extensuin of ut image

                    $upload = move_uploaded_file($source_path, $destination_path); // move_uploaded_file() function is used to move the uploaded file to a new location

                        // Check whether the image is uploaded or not
                        //and if the image is not uploaded, then we will stop the process and redirect with error message
                        if ($upload == false) {
                            // Failed to upload the image
                            $_SESSION['upload'] = "<div class='error'>Failed to Upload Image.</div>";
                            header('location:'.SITEURL.'admin/add-category.php');
                            die(); // Stop the process
                        }

                    }
                    
                    } else {
                         $Image_name = ""; // Default value as blank
                    }
                

                // 2. SQL query to insert category into database
                $sql = "INSERT INTO tbl_category SET 
                    title='$title',
                    Image_name='$Image_name',
                    featured='$featured',
                    active='$active'
                ";

                // 3. Execute the query and save in database
                $res = mysqli_query($conn, $sql) ;


                // 4. Check whether the query executed successfully or not
                if ($res == true) {
                    // Query executed successfully and category added
                    $_SESSION['add'] = "<div class='success'>Category Added Successfully.</div>";
                    header('location:'.SITEURL.'admin/manage-category.php');
                } else {
                    // Failed to add category
                    $_SESSION['add'] = "<div class='error'>Failed to Add Category.</div>";
                    header('location:'.SITEURL.'admin/add-category.php');
                }
            }
        

        ?>

    </div>
</div>
<?php include 'partials/footer.php'; ?>
