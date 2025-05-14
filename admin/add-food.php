<?php
ob_start();
include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Food</h1>

        <br><br>

        <?php
        if (isset($_SESSION['upload'])) {
            echo $_SESSION['upload'];
            unset($_SESSION['upload']);
        }
        ?>

        <form action="" method="POST" enctype="multipart/form-data">

            <table class="tbl-30">
                <tr>
                    <td>Title</td>
                    <td>
                        <input type="text" name="title" placeholder="Title of the Food" required>
                    </td>
                </tr>

                <tr>
                    <td>Description</td>
                    <td>
                        <textarea name="description" rows="5" cols="30" placeholder="Description of the Food"></textarea>
                    </td>
                </tr>

                <tr>
                    <td>Price</td>
                    <td>
                        <input type="number" name="price" placeholder="Price of the Food" required>
                    </td>
                </tr>

                <tr>
                    <td>Select Image</td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>

                <tr>
                    <td>Category</td>
                    <td>
                        <select name="category">

                        <?php
                           //create php code to display categories from database
                            //1. Create sql query to get all active categories from database
                            $sql = "SELECT * FROM tbl_category WHERE active='Yes'";
                            //2. Execute the query
                            $res = mysqli_query($conn, $sql);
                            //3. Count rows to check whether we have categories or not
                            $count = mysqli_num_rows($res);
                            //4. If count is greater than 0, we have categories
                            if ($count > 0) {
                                //5. Get the categories from database and display
                                while ($row = mysqli_fetch_assoc($res)) {
                                    //Get the details
                                    $id = $row['id'];
                                    $title = $row['title'];
                                    ?>
                                    <option value="<?php echo $id; ?>"><?php echo $title; ?></option>
                                    <?php
                                }
                            } else {
                                //We do not have categories, we will create category
                                ?>
                                <option value="0">Category not available</option>
                                <?php
                            }
                         ?>
                           
                        </select>
                    </td>
                </tr>

                <tr>
                    <td>Featured</td>
                    <td>
                        <input type="radio" name="featured" value="Yes"> Yes
                        <input type="radio" name="featured" value="No"> No
                    </td>
                </tr>

                <tr>
                    <td>Active</td>
                    <td>
                        <input type="radio" name="active" value="Yes"> Yes
                        <input type="radio" name="active" value="No"> No
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Food" class="btn-secondary">
                    </td>
                </tr>    
            </table>
        </form>


        <?php
        
        //Check whether the submit button is clicked or not
        if (isset($_POST['submit'])) {
            //1. Get the data from form
            $title = $_POST['title'];
            $description = $_POST['description'];
            $price = $_POST['price'];
            $category = $_POST['category'];

            if (isset($_POST['featured'])) {
                $featured = $_POST['featured'];
            } else {
                $featured = "No"; //Setting default value
            }

            if (isset($_POST['active'])) {
                $active = $_POST['active'];
            } else {
                $active = "No"; //Setting default value
            }

            //Check whether the image is selected or not
            if (isset($_FILES['image']['name'])) {
                //Upload the image
                $image_name = $_FILES['image']['name'];

                if ($image_name != "") {
                    //Image is selected

                    //Auto rename our image
                //Get the extension of our image (jpg, png, gif, etc.)
                $ext = end(explode('.', $image_name));

                //Rename the image
                $image_name = "Food-Name-" . rand(0000, 9999) . '.' . $ext; //e.g. Food-Name-1234.jpg

                //2. Upload the image only if selected
                //Upload the image to folder
                $source_path = $_FILES['image']['tmp_name'];
                $destination_path = "../images/food/" . $image_name;

                //Finally upload the image
                $upload = move_uploaded_file($source_path, $destination_path);

                //Check whether the image is uploaded or not
                if ($upload == false) {
                    //Set message
                    $_SESSION['upload'] = "<div class='error'>Failed to upload image.</div>";
                    header('location:' . SITEURL . 'admin/add-food.php');
                    die();
                }
           
            }

            } else {
                    //Image is not selected
                    //Set default image name as blank
                    $image_name = "";
                }

            //3. Create sql query to insert food into database
            //For numeric values we do not need to pass quotes
            //For string values we need to pass quotes
            $sql2 = "INSERT INTO tbl_food SET 
                        title='$title',
                        description='$description',
                        price=$price,
                        image_name='$image_name',
                        category_id=$category,
                        featured='$featured',
                        active='$active'
                    ";

            //4. Execute the query and save in database
            $res2 = mysqli_query($conn, $sql2);

            //5. Check whether data inserted or not
            if ($res2 == true) {
                //Data inserted successfully
                $_SESSION['add'] = "<div class='success'>Food added successfully.</div>";
                header('location:' . SITEURL . 'admin/manage-food.php');
            } else {
                //Failed to insert data
                $_SESSION['add'] = "<div class='error'>Failed to add food.</div>";  
                header('location:' . SITEURL . 'admin/add-food.php');
             }

        }
        ?>

    </div>
</div>



<?php include('partials/footer.php'); ?>
<?php ob_end_flush(); ?>