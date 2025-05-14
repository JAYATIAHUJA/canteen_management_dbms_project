<?php include('partials-front/menu.php'); ?>

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
            
            <form action="<?php echo SITEURL; ?>food-search.php" method="POST">
                <input type="search" name="search" placeholder="Search for Food.." required>
                <input type="submit" name="submit" value="Search" class="btn btn-primary">
            </form>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->



    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>
            <div class="food-menu-grid">
            <?php
                //create sql query to get all food from database
                $sql = "SELECT * FROM tbl_food WHERE active='Yes' ";

                //execute the query
                $res = mysqli_query($conn, $sql);

                //count rows
                $count = mysqli_num_rows($res);

                //check if food available
                if($count>0){
                    //food available
                    while($row=mysqli_fetch_assoc($res)){
                        //get values
                        $id = $row['id'];
                        $title = $row['title'];
                        $price = $row['price'];
                        $description = $row['description'];
                        $image_name = $row['image_name'];
                        ?>
                            <div class="food-menu-box">
                                <div class="food-menu-img">
                                    <?php
                                        //check if image name is available
                                        if($image_name==""){
                                            //set message
                                            echo "<div class='error'>Image not available</div>";
                                        }else{
                                            //image available
                                            ?>
                                                <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>" alt="<?php echo htmlspecialchars($title); ?>" class="img-responsive img-curve">
                                            <?php
                                        }
                                    ?>
                                </div>

                                <div class="food-menu-desc">
                                    <h4><?php echo $title; ?></h4>
                                    <p class="food-price">Rs.<?php echo number_format($price,2); ?></p>
                                    <p class="food-detail">
                                        <?php echo $description; ?>
                                    </p>    
                                    <br>
                                    <a href="<?php echo SITEURL; ?>order.php?food_id=<?php echo $id; ?>" class="btn btn-primary">Order Now</a>
                                </div>
                            </div>
                        <?php
                    }
                }else{  
                    //food not available
                    echo "<div class='empty-state'><img src='images/empty-food.svg' alt='No food' style='width:120px;display:block;margin:2rem auto;'><p class='text-center' style='color:#888;font-size:1.2rem;'>No food available. Please check back later!</p></div>";
                }   
            
            
            ?>
            </div>

            <div class="clearfix"></div>

            

        </div>

    </section>
    <!-- fOOD Menu Section Ends Here -->

    <?php include('partials-front/footer.php'); ?>