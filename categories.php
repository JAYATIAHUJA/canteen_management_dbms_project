<?php include('partials-front/menu.php'); ?>


    <!-- CAtegories Section Starts Here -->
    <section class="categories">
        <div class="container">
            <h2 class="text-center">Explore Foods</h2>


            <?php
                //display all the categories
                //create sql query to get all categories from database
                $sql = "SELECT * FROM tbl_category WHERE active='Yes'";
                //execute the query
                $res = mysqli_query($conn, $sql);
                //count rows
                $count = mysqli_num_rows($res);
                //check if categories available
            
                if($count>0){
                    //categories available
                    while($row=mysqli_fetch_assoc($res)){
                        //get values
                        $id = $row['id'];
                        $title = $row['title'];
                        $Image_name = $row['Image_name'];
                        ?>
                            <a href="category-foods.php?category_id=<?php echo $id; ?>">
                            <div class="box-3 float-container">
                                <?php
                                    //check if image name is available
                                    if($Image_name==""){
                                        //set message
                                        echo "<div class='error'>Image not available</div>";
                                    }else{
                                        //image available
                                        ?>
                                            <img src="<?php echo SITEURL; ?>images/category/<?php echo $Image_name; ?>" alt="PIZZA" class="img-responsive img-curve">
                                        <?php
                                    }
                                ?>

                                <h3 class="float-text text-white"><?php echo $title; ?></h3>
                            </div>
                            </a>
                        <?php
                    }
                }else{
                    //categories not available
                    echo "<div class='error'>Category not available</div>";
                }

            ?>

            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Categories Section Ends Here -->

<?php include('partials-front/footer.php');?>