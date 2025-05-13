<?php include('partials-front/menu.php'); ?>


<?php
  // check if food id is set
  if(isset($_GET['food_id'])){
      // get the food id
      $food_id = $_GET['food_id'];
      // get the food details based on the id
      $sql = "SELECT * FROM tbl_food WHERE id=$food_id";
      // execute the query
      $res = mysqli_query($conn, $sql);
      // check if the query executed successfully
      if($res==true){
          // check if food is available
          $count = mysqli_num_rows($res);
          if($count==1){
              // get the details
              $row = mysqli_fetch_assoc($res);
              $title = $row['title'];
              $price = $row['price'];
              $image_name = $row['image_name'];
          }else{
              // food not available
              header('location:'.SITEURL.'category-foods.php');
          }
      }
  }else{
      // food id not set
      header('location:'.SITEURL.'category-foods.php');
  }
?>

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search">
        <div class="container">
            <div class="order-steps" style="display:flex;justify-content:center;gap:2rem;margin-bottom:2rem;">
                <div class="step active" style="font-weight:600;color:var(--primary-color);">1. Select Food</div>
                <div class="step" style="color:#bbb;">2. Enter Details</div>
                <div class="step" style="color:#bbb;">3. Confirm</div>
            </div>
            <h2 class="text-center text-white">Fill this form to confirm your order.</h2>
            <form action="" method="POST" class="order" style="margin-top:2rem;">
                <fieldset style="border:none;padding:0;margin-bottom:2rem;">
                    <legend style="font-size:1.2rem;font-weight:600;margin-bottom:1rem;">Selected Food</legend>
                    <div style="display:flex;align-items:center;gap:2rem;flex-wrap:wrap;">
                        <div class="food-menu-img" style="min-width:120px;">
                            <?php
                                if($image_name==""){
                                    echo "<div class='error'>Image not Available</div>";
                                }else{
                                    ?>
                                    <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>" alt="<?php echo htmlspecialchars($title); ?>" class="img-responsive img-curve">
                                    <?php
                                }
                            ?>
                        </div>
                        <div class="food-menu-desc" style="flex:1;">
                            <h3 style="margin-bottom:0.5rem;"><?php echo $title;?></h3>
                            <input type="hidden" name="food" value="<?php echo $title; ?>">
                            <p class="food-price" style="margin-bottom:0.5rem;">₹<?php echo number_format($price,2); ?></p>
                            <input type="hidden" name="price" value="<?php echo $price; ?>" class="input-responsive" required>
                            <div class="order-label">Quantity</div>
                            <input type="number" name="qty" class="input-responsive" value="1" min="1" required style="max-width:120px;">
                        </div>
                    </div>
                </fieldset>
                <fieldset style="border:none;padding:0;">
                    <legend style="font-size:1.2rem;font-weight:600;margin-bottom:1rem;">Delivery Details</legend>
                    <div class="form-group">
                        <div class="order-label">Full Name</div>
                        <input type="text" name="full-name" placeholder="E.g. Vijay Thapa" class="input-responsive" required>
                    </div>
                    <div class="form-group">
                        <div class="order-label">Phone Number</div>
                        <input type="tel" name="contact" placeholder="E.g. 9843xxxxxx" class="input-responsive" required>
                    </div>
                    <div class="form-group">
                        <div class="order-label">Email</div>
                        <input type="email" name="email" placeholder="E.g. hi@vijaythapa.com" class="input-responsive" required>
                    </div>
                    <div class="form-group">
                        <div class="order-label">Address</div>
                        <textarea name="address" rows="4" placeholder="E.g. Street, City, Country" class="input-responsive" required></textarea>
                    </div>
                    <button type="submit" name="submit" class="btn btn-primary" style="width:100%;font-size:1.1rem;margin-top:1rem;">Confirm Order</button>
                </fieldset>
            </form>
            <?php
            if(isset($_SESSION['order'])){
                echo '<div class="container"><div class="success">' . $_SESSION['order'] . '</div></div>';
                unset($_SESSION['order']);
            }
            ?>
        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->

    <?php include('partials-front/footer.php'); ?>