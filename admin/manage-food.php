<?php include('partials/menu.php');?>

   <div class="main-content">
    <div class="wrapper">
      <h1>Manage Food</h1>
            <br />
               
            <a href="<?php echo SITEURL;?>admin/add-food.php" class="btn-primary">Add Food</a>
            <br />

            <br />
            <br>

            <?php
                 if (isset($_SESSION['add'])) {
                    echo $_SESSION['add'];
                    unset($_SESSION['add']);
                }

                if (isset($_SESSION['delete'])) {
                    echo $_SESSION['delete'];
                    unset($_SESSION['delete']);
                }

                if (isset($_SESSION['update'])) {
                    echo $_SESSION['update'];
                    unset($_SESSION['update']);
                }
                
                if (isset($_SESSION['upload'])) {
                    echo $_SESSION['upload'];
                    unset($_SESSION['upload']);
                }

                if (isset($_SESSION['unauthorize'])) {
                    echo $_SESSION['unauthorize'];
                    unset($_SESSION['unauthorize']);
                }

            
            ?>
            
            <br />
            <table id="tbl-admin" class="tbl-full">
                <tr>
                    <th>s.no</th>
                    <th>Title</th>
                    <th>Price</th>
                    <th>Image</th>
                    <th>Featured</th>
                    <th>Active</th>
                    <th>Actions</th>


                </tr>

                <?php
                
                $sql = "SELECT * FROM tbl_food";
                $res = mysqli_query($conn, $sql);
                $count = mysqli_num_rows($res);
                $sn = 1; //create a variable to count the number of rows
                if ($count > 0) {
                    //we have data in database
                    while ($row = mysqli_fetch_assoc($res)) {
                        $id = $row['id'];
                        $title = $row['title'];
                        $price = $row['price'];
                        $image_name = $row['image_name'];
                        $featured = $row['featured'];
                        $active = $row['active'];

                        ?>
                            <tr>
                                <td><?php echo $sn++; ?></td>
                                <td><?php echo $title; ?></td>
                                <td><?php echo $price; ?></td>
                                <td>
                                    <?php
                                        //check whether image name is available or not
                                        if ($image_name == "") {
                                            //we do not have image, we will display message
                                            echo "<div class='error'>Image not added</div>";
                                        } else {
                                            //we have image, display it
                                            ?>
                                                <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>" width="100px">
                                            <?php
                                        }
                                    ?>
                                </td>
                                <td><?php echo $featured; ?></td>
                                <td><?php echo $active; ?></td>
                                <td>
                                    <a href="<?php echo SITEURL; ?>admin/update-food.php?id=<?php echo $id; ?>" class="btn-secondary">Update Food</a>
                                    <a href="<?php echo SITEURL; ?>admin/delete-food.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name; ?>" class="btn-danger">Delete Food</a>
                                </td>

                            </tr>
                        <?php
                    }
                } else {
                    //we do not have data in database
                    echo "<tr><td colspan='7' class='error'>Food not added yet.</td></tr>";
                }   
                
                ?>

            </table>
            
         
            <div class="clearfix"></div>
        </div>
    </div>
        <!-- main content section ends-->


<?php include('partials/footer.php');?>