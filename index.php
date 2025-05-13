<?php include('partials-front/menu.php'); ?>

<!-- Hero Section with Search -->
<section class="food-search text-center">
    <div class="container">
        <h2>Discover Delicious Food</h2>
        <p class="text-white" style="margin-bottom: 2rem;">Order your favorite meals from our canteen</p>
        
        <form action="<?php echo SITEURL; ?>food-search.php" method="POST" class="search-form">
            <input type="search" name="search" placeholder="Search for Food.." required>
            <button type="submit" name="submit" class="btn btn-primary">
                <i class="fas fa-search"></i> Search
            </button>
        </form>
    </div>
</section>

<?php
if(isset($_SESSION['order'])){
    echo '<div class="container"><div class="success">' . $_SESSION['order'] . '</div></div>';
    unset($_SESSION['order']);
}
?>

<!-- Categories Section -->
<section class="categories">
    <div class="container">
        <h2 class="text-center">Explore Categories</h2>
        <p class="text-center" style="margin-bottom: 3rem;">Browse through our delicious food categories</p>

        <div class="categories-grid">
            <?php
            $sql = "SELECT * FROM tbl_category WHERE active='Yes' AND featured='Yes' LIMIT 3";
            $res = mysqli_query($conn, $sql);
            $count = mysqli_num_rows($res);
            
            if($count > 0){
                while($row = mysqli_fetch_assoc($res)){
                    $id = $row['id'];
                    $title = $row['title'];
                    $Image_name = $row['Image_name'];
                    ?>
                    <a href="<?php echo SITEURL; ?>category-foods.php?category_id=<?php echo $id; ?>" class="category-link">
                        <div class="box-3 float-container">
                            <?php
                            if($Image_name == ""){
                                echo "<div class='error'>Image not available</div>";
                            } else {
                                ?>
                                <img src="<?php echo SITEURL; ?>images/category/<?php echo $Image_name; ?>" 
                                     alt="<?php echo $title; ?>" 
                                     class="img-responsive img-curve">
                                <?php
                            }
                            ?>
                            <h3 class="float-text text-white"><?php echo $title; ?></h3>
                        </div>
                    </a>
                    <?php
                }
            } else {
                echo "<div class='error'>No categories available</div>";
            }
            ?>
        </div>
        <div class="clearfix"></div>
    </div>
</section>

<!-- Featured Foods Section -->
<section class="food-menu">
    <div class="container">
        <h2 class="text-center">Featured Foods</h2>
        <p class="text-center" style="margin-bottom: 3rem;">Our most popular dishes</p>

        <div class="food-menu-grid">
            <?php
            $sql2 = "SELECT * FROM tbl_food WHERE active='Yes' AND featured='Yes' LIMIT 6";
            $res2 = mysqli_query($conn, $sql2);
            $count2 = mysqli_num_rows($res2);
            
            if($count2 > 0){
                while($row = mysqli_fetch_assoc($res2)){
                    $id = $row['id'];
                    $title = $row['title'];
                    $price = $row['price'];
                    $description = $row['description'];
                    $image_name = $row['image_name'];
                    ?>
                    <div class="food-menu-box">
                        <div class="food-menu-img">
                            <?php
                            if($image_name == ""){
                                echo "<div class='error'>Image not available</div>";
                            } else {
                                ?>
                                <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>" 
                                     alt="<?php echo $title; ?>" 
                                     class="img-responsive img-curve">
                                <?php
                            }
                            ?>
                        </div>

                        <div class="food-menu-desc">
                            <h4><?php echo $title; ?></h4>
                            <p class="food-price">$<?php echo $price; ?></p>
                            <p class="food-detail">
                                <?php echo $description; ?>
                            </p>
                            <a href="<?php echo SITEURL; ?>order.php?food_id=<?php echo $id; ?>" class="btn btn-primary">Order Now</a>
                        </div>
                    </div>
                    <?php
                }
            } else {
                echo "<div class='error'>No foods available</div>";
            }
            ?>
        </div>
        <div class="clearfix"></div>

        <div class="text-center" style="margin-top: 3rem;">
            <a href="<?php echo SITEURL; ?>foods.php" class="btn btn-primary">View All Foods</a>
        </div>
    </div>
</section>

<?php include('partials-front/footer.php'); ?>