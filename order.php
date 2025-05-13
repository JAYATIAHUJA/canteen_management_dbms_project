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
            
            <h2 class="text-center text-white">Fill this form to confirm your order.</h2>

            <form action="" method="POST" class="order">
                <fieldset>
                    <legend>Selected Food</legend>

                    <div class="food-menu-img">

                        <?php
                            // check if image is available
                            if($image_name==""){
                                // image not available
                                echo "<div class='error'>Image not Available</div>";
                            }else{
                                // image available
                                ?>
                                <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>" alt="Chicke Hawain Pizza" class="img-responsive img-curve">
                                <?php
                            }
                        ?>
                    </div>
                    
                        
    
                    <div class="food-menu-desc">
                        <h3><?php echo $title;?></h3>
                        <input type="hidden" name="food" value="<?php echo $title; ?>">

                          


                        <p class="food-price">$<?php echo $price; ?></p>
                        <input type="hidden" name="price" value="<?php echo $price; ?>" class="input-responsive" required>

                        <div class="order-label">Quantity</div>
                        <input type="number" name="qty" class="input-responsive" value="1" required>
                        
                    </div>

                </fieldset>
                
                <fieldset>
                    <legend>Delivery Details</legend>
                    <div class="order-label">Full Name</div>
                    <input type="text" name="full-name" placeholder="E.g. Vijay Thapa" class="input-responsive" required>

                    <div class="order-label">Phone Number</div>
                    <input type="tel" name="contact" placeholder="E.g. 9843xxxxxx" class="input-responsive" required>

                    <div class="order-label">Email</div>
                    <input type="email" name="email" placeholder="E.g. hi@vijaythapa.com" class="input-responsive" required>

                    <div class="order-label">Address</div>
                    <textarea name="address" rows="10" placeholder="E.g. Street, City, Country" class="input-responsive" required></textarea>

                    <input type="submit" name="submit" value="Confirm Order" class="btn btn-primary">
                </fieldset>

            </form>


            <?php

            // check if submit button is clicked
            if(isset($_POST['submit'])){
                // get the values from the form
                $food = $_POST['food']; // food name
                $price = $_POST['price']; // food price
                
                $qty = $_POST['qty'];
                $total = $price * $qty; // calculate total
                $order_date = date("Y-m-d h:i:sa"); // order date
                $status = "Ordered"; // ordered status
                $customer_name = $_POST['full-name'];
                $customer_contact = $_POST['contact'];
                $customer_email = $_POST['email'];
                $customer_address = $_POST['address'];

                // save the order in database
                // create sql query to save the data
                $sql2 = "INSERT INTO tbl_order SET 
                    food='$food',
                    price=$price,
                    quantity=$qty,
                    total=$total,
                    order_date='$order_date',
                    status='$status',
                    customer_name='$customer_name',
                    customer_contact='$customer_contact',
                    customer_email='$customer_email',
                    customer_address='$customer_address'
                ";

                // execute the query
                $res2 = mysqli_query($conn, $sql2);

                // check if query executed successfully
                if($res2==true){
                    // query executed successfully
                    $_SESSION['order'] = "<div class='success text-center'>Food Ordered Successfully.</div>";
                    header('location:'.SITEURL);
                }else{
                    // failed to save order
                    $_SESSION['order'] = "<div class='error text-center'>Failed to Order Food.</div>";
                    header('location:'.SITEURL);
                }
            }   


            
            
            
            ?>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->

    <?php include('partials-front/footer.php'); ?>