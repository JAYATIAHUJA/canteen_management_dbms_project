<?php 
ob_start(); 
include('partials/menu.php'); 
?>

<?php
// Check whether id is set or not
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql2 = "SELECT * FROM tbl_food WHERE id=$id";
    $res2 = mysqli_query($conn, $sql2);
    $row2 = mysqli_fetch_assoc($res2);

    $title = $row2['title'];
    $description = $row2['description'];
    $price = $row2['price'];
    $current_image = $row2['image_name'];
    $current_category = $row2['category_id'];
    $featured = $row2['featured'];
    $active = $row2['active'];
} else {
    header('location:' . SITEURL . 'admin/manage-food.php');
}
?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Food</h1>
        <br><br>

        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Title</td>
                    <td><input type="text" name="title" value="<?php echo $title; ?>" required></td>
                </tr>

                <tr>
                    <td>Description</td>
                    <td><textarea name="description" cols="30" rows="5" required><?php echo $description; ?></textarea></td>
                </tr>

                <tr>
                    <td>Price</td>
                    <td><input type="number" name="price" value="<?php echo $price; ?>" required></td>
                </tr>

                <tr>
                    <td>Current Image:</td>
                    <td>
                        <?php
                        if ($current_image != "") {
                            echo "<img src='" . SITEURL . "images/food/$current_image' width='100px'>";
                        } else {
                            echo "<div class='error'>Image not added.</div>";
                        }
                        ?>
                    </td>
                </tr>

                <tr>
                    <td>New Image</td>
                    <td><input type="file" name="image"></td>
                </tr>

                <tr>
                    <td>Category:</td>
                    <td>
                        <select name="category">
                            <?php
                            $sql = "SELECT * FROM tbl_category WHERE active='Yes'";
                            $res = mysqli_query($conn, $sql);
                            $count = mysqli_num_rows($res);

                            if ($count > 0) {
                                while ($row = mysqli_fetch_assoc($res)) {
                                    $category_id = $row['id'];
                                    $category_title = $row['title'];
                                    $selected = $current_category == $category_id ? "selected" : "";
                                    echo "<option value='$category_id' $selected>$category_title</option>";
                                }
                            } else {
                                echo "<option value='0'>Category not available</option>";
                            }
                            ?>
                        </select>
                    </td>
                </tr>

                <tr>
                    <td>Featured</td>
                    <td>
                        <input <?php if ($featured == "Yes") echo "checked"; ?> type="radio" name="featured" value="Yes"> Yes
                        <input <?php if ($featured == "No") echo "checked"; ?> type="radio" name="featured" value="No"> No
                    </td>
                </tr>

                <tr>
                    <td>Active</td>
                    <td>
                        <input <?php if ($active == "Yes") echo "checked"; ?> type="radio" name="active" value="Yes"> Yes
                        <input <?php if ($active == "No") echo "checked"; ?> type="radio" name="active" value="No"> No
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="submit" name="submit" value="Update Category" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>

        <?php
        if (isset($_POST['submit'])) {
            $id = $_POST['id'];
            $title = $_POST['title'];
            $description = $_POST['description'];
            $price = $_POST['price'];
            $current_image = $_POST['current_image'];
            $category = $_POST['category'];
            $featured = $_POST['featured'];
            $active = $_POST['active'];

            // Image upload
            if (isset($_FILES['image']['name']) && $_FILES['image']['name'] != "") {
                $image_name = $_FILES['image']['name'];

                // Fix warning by assigning first
                $ext_arr = explode('.', $image_name);
                $ext = end($ext_arr);

                $image_name = "Food_Name_" . rand(000, 999) . '.' . $ext;
                $source_path = $_FILES['image']['tmp_name'];
                $destination_path = "../images/food/" . $image_name;

                $upload = move_uploaded_file($source_path, $destination_path);

                if (!$upload) {
                    $_SESSION['upload'] = "<div class='error'>Failed to upload new image.</div>";
                    header('location:' . SITEURL . 'admin/manage-food.php');
                    die();
                }

                // Remove current image
                if ($current_image != "") {
                    $remove_path = "../images/food/" . $current_image;
                    if (file_exists($remove_path)) {
                        $remove = unlink($remove_path);
                        if (!$remove) {
                            $_SESSION['failed-remove'] = "<div class='error'>Failed to remove current image.</div>";
                            header('location:' . SITEURL . 'admin/manage-food.php');
                            die();
                        }
                    }
                }
            } else {
                $image_name = $current_image;
            }

            // Update food
            $sql3 = "UPDATE tbl_food SET
                title = '$title',
                description = '$description',
                price = $price,
                image_name = '$image_name',
                category_id = $category,
                featured = '$featured',
                active = '$active'
                WHERE id=$id";

            $res3 = mysqli_query($conn, $sql3);

            if ($res3) {
                $_SESSION['update'] = "<div class='success'>Food updated successfully.</div>";
            } else {
                $_SESSION['update'] = "<div class='error'>Failed to update food.</div>";
            }

            header('location:' . SITEURL . 'admin/manage-food.php');
        }
        ?>
    </div>
</div>

<?php include('partials/footer.php'); ?>
<?php ob_end_flush(); ?>

