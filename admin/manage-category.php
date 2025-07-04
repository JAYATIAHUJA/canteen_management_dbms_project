<?php include('partials/menu.php');?>

<div class="main-content">
<div class="wrapper">
<h1>Manage Category</h1>
            <br />
            <br />

            <?php
            if (isset($_SESSION['add'])) {
                echo $_SESSION['add'];
                unset($_SESSION['add']);
            }

            if (isset($_SESSION['remove'])) {
                echo $_SESSION['remove'];
                unset($_SESSION['remove']);
            }

            if (isset($_SESSION['delete'])) {
                echo $_SESSION['delete'];
                unset($_SESSION['delete']);
            }

            if (isset($_SESSION['no-category-found'])) {
                echo $_SESSION['no-category-found'];
                unset($_SESSION['no-category-found']);
            }

            if (isset($_SESSION['update'])) {
                echo $_SESSION['update'];
                unset($_SESSION['update']);
            }

            if (isset($_SESSION['upload'])) {
                echo $_SESSION['upload'];
                unset($_SESSION['upload']);
            }

            if (isset($_SESSION['failed-remove'])) {
                echo $_SESSION['failed-remove'];
                unset($_SESSION['failed-remove']);
            }
        ?>

        <br/>
        
               
            <a href="<?php echo SITEURL;?>admin/add-category.php" class="btn-primary">Add Category</a>
            <br />
            
            <br />
            <table id="tbl-admin" class="tbl-full">
                <tr>
                    <th>s.no</th>
                    <th>Title</th>
                    <th>Image</th>
                    <th>Featured</th>
                    <th>Active</th>
                    <th>Actions</th>
                </tr>

                <?php
                   
                   // Create SQL Query to get all category
                     $sql = "SELECT * FROM tbl_category";

                    // Execute the query
                    $res = mysqli_query($conn, $sql);

                    // Count rows to check whether we have data in database
                    $count = mysqli_num_rows($res);

                    // Create serial number variable
                    $sn = 1;

                    //CHECK WHETHER WE HAVE DATA IN DATABASE
                    if($count>0){
                        while($row = mysqli_fetch_assoc($res)){
                            $id = $row['id'];
                            $title = $row['title'];
                            $Image_name = $row['Image_name'];
                            $featured = $row['featured'];
                            $active = $row['active'];

                            ?>
                            <tr>
                                <td><?php echo $sn++;?></td>
                                <td><?php echo $title;?></td>

                                <td>
                                    <?php

                                     // Check whether image name is available or not
                                     if($Image_name!="")
                                     {
                                        // Display the image
                                        ?>
                                        <img src="<?php echo SITEURL;?>images/category/<?php echo $Image_name;?>" width="100px">
                                        <?php
                                     }
                                     else
                                     {
                                        // Display the message
                                        echo "<div class='error'>Image not Added.</div>";
                                     }
                                    
                                    ?>
                                
                                </td>

                                <td><?php echo $featured;?></td>
                                <td><?php echo $active;?></td>
                                <td>
                                    <a href="<?php echo SITEURL;?>admin/update-category.php?id=<?php echo $id;?>" class="btn-secondary">Update Category</a>
                                    <a href="<?php echo SITEURL;?>admin/delete-category.php?id=<?php echo $id;?>&Image_name=<?php echo $Image_name;?>" class="btn-danger">Delete Category</a>
                                </td>
                            </tr>
                            <?php

                        }

                    }else{
                        // We do not have data in database
                        // We will display message inside table
                    
                        ?>
                        <tr>
                            <td colspan="6">
                                <div class="error">No Category Added</div>
                            </td>
                        </tr>
                        <?php
                        
                    }

                ?>
            </table>
            
         
            <div class="clearfix"></div>
        
        </div>
       
       </div>
         <!-- main content section ends-->

</div>
<?php include('partials/footer.php');?>