<?php include('partials-front/menu.php'); ?>

<?php
    //check if id is set
    if(isset($_GET['category_id'])){
        //get id and assign it to variable
        $category_id = $_GET['category_id'];
        //get title based on category id
        $sql = "SELECT title FROM tbl_category WHERE id=$category_id";
        //execute query
        $res = mysqli_query($conn, $sql);
        //get the value from database
        $row = mysqli_fetch_assoc($res);
        //get the title
        $category_title = $row['title'];
    }else{
        //redirect to home page
        header('location:'.SITEURL);
    }

?>

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
            
            <h2>Foods on <a href="#" class="text-white">"<?php echo $category_title ;?> "</a></h2>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->



    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>
            <div class="food-menu-grid">
            <?php
                //sql query to get food based on category id
                $sql2 = "SELECT * FROM tbl_food WHERE category_id=$category_id AND active='Yes'";
                //execute the query
                $res2 = mysqli_query($conn, $sql2);
                //count rows
                $count2 = mysqli_num_rows($res2);
                //check if food available
                if($count2>0){
                    //food available
                    while($row2=mysqli_fetch_assoc($res2)){
                        //get values
                        $id = $row2['id'];
                        $title = $row2['title'];
                        $price = $row2['price'];
                        $description = $row2['description'];
                        $image_name = $row2['image_name'];
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