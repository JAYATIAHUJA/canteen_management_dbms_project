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
            <div class="order-stepper">
                <div class="step active">
                    <div class="circle">1</div>
                    <div class="label">Food</div>
                </div>
                <div class="bar"></div>
                <div class="step">
                    <div class="circle">2</div>
                    <div class="label">Enter Details</div>
                </div>
                <div class="bar"></div>
                <div class="step">
                    <div class="circle">3</div>
                    <div class="label">Confirm</div>
                </div>
            </div>
            <div class="order-title">Fill this form to confirm your order.</div>
            <form action="" method="POST" class="order" style="margin-top:2rem;">
                <div class="food-card">
                    <div class="food-menu-img">
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
                    <div class="food-menu-desc">
                        <h3><?php echo $title;?></h3>
                        <input type="hidden" name="food" value="<?php echo $title; ?>">
                        <p class="food-price">₹<?php echo number_format($price,2); ?></p>
                        <input type="hidden" name="price" value="<?php echo $price; ?>" class="input-responsive" required>
                        <div class="order-label">Quantity</div>
                        <input type="number" name="qty" class="input-responsive" value="1" min="1" required style="max-width:120px;">
                    </div>
                </div>
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

<style>
body {
  background: #f9fafb;
}
.food-search {
  padding-top: 2rem;
  padding-bottom: 2rem;
  background: linear-gradient(120deg, #fff8f0 0%, #f9fafb 100%);
  min-height: 100vh;
}
.order-stepper {
  display: flex;
  justify-content: center;
  align-items: center;
  gap: 2.5rem;
  margin-bottom: 2.2rem;
}
.order-stepper .step {
  display: flex;
  flex-direction: column;
  align-items: center;
  font-size: 1.08rem;
  font-weight: 600;
  color: #bbb;
}
.order-stepper .circle {
  width: 32px;
  height: 32px;
  border-radius: 50%;
  background: #f7f7f7;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 1.1rem;
  font-weight: 700;
  margin-bottom: 0.3rem;
  border: 2px solid #eee;
  transition: background 0.2s, color 0.2s, border 0.2s;
}
.order-stepper .active .circle {
  background: #ffb300;
  color: #fff;
  border: 2px solid #ffb300;
}
.order-stepper .active {
  color: #ffb300;
}
.order-stepper .label {
  font-size: 0.98rem;
  font-weight: 500;
  margin-top: 0.1rem;
}
.order-stepper .bar {
  width: 40px;
  height: 4px;
  background: #eee;
  border-radius: 2px;
  margin: 0 0.2rem;
}
.food-search .order-title {
  text-align: center;
  font-size: 1.5rem;
  font-weight: 700;
  color: #222;
  margin-bottom: 2.2rem;
  margin-top: 0.5rem;
}
.food-card {
  display: flex;
  flex-direction: column;
  align-items: center;
  background: #fff;
  border-radius: 18px;
  box-shadow: 0 4px 24px rgba(44,62,80,0.10);
  padding: 2rem 1.2rem 1.5rem 1.2rem;
  margin-bottom: 2rem;
  max-width: 350px;
  margin-left: auto;
  margin-right: auto;
}
.food-card .food-menu-img {
  width: 120px;
  height: 120px;
  border-radius: 12px;
  overflow: hidden;
  background: #f7f7f7;
  display: flex;
  align-items: center;
  justify-content: center;
  margin-bottom: 1.2rem;
}
.food-card .food-menu-img img {
  width: 100%;
  height: 100%;
  object-fit: cover;
}
.food-card h3 {
  font-size: 1.25rem;
  font-weight: 700;
  margin-bottom: 0.4rem;
  color: #222;
  text-align: center;
}
.food-card .food-price {
  color: #ffb300;
  font-size: 1.1rem;
  font-weight: 600;
  margin-bottom: 0.7rem;
  text-align: center;
}
.food-card .order-label {
  margin-bottom: 0.2rem;
  text-align: center;
}
.food-card input[type="number"] {
  margin: 0 auto;
  display: block;
  text-align: center;
}
.food-search .order {
  background: #fff;
  border-radius: 18px;
  box-shadow: 0 4px 24px rgba(44,62,80,0.10);
  padding: 2.5rem 2rem 2rem 2rem;
  max-width: 480px;
  margin: 2rem auto 0 auto;
}
.order-label {
  font-weight: 600;
  color: #222;
  margin-bottom: 0.3rem;
}
.input-responsive {
  width: 100%;
  padding: 1rem;
  border: 1px solid #ddd;
  border-radius: 8px;
  font-size: 1rem;
  margin-bottom: 1.2rem;
  background: #f7f7f7;
  transition: border 0.2s;
}
.input-responsive:focus {
  border-color: #ffb300;
  outline: none;
}
.btn-primary {
  background: #ffb300;
  color: #fff;
  border: none;
  border-radius: 8px;
  padding: 1rem;
  font-size: 1.1rem;
  font-weight: 600;
  cursor: pointer;
  transition: background 0.2s, box-shadow 0.2s;
  box-shadow: 0 2px 8px rgba(255,179,0,0.08);
  width: 100%;
  margin-top: 0.5rem;
}
.btn-primary:hover {
  background: #43a07e;
  color: #fff;
  box-shadow: 0 4px 16px rgba(67,160,126,0.13);
}
@media (max-width: 600px) {
  .food-search .order { padding: 1.2rem 0.7rem; }
  .order-stepper { gap: 0.7rem; }
  .order-stepper .circle { width: 24px; height: 24px; font-size: 0.98rem; }
  .food-card { padding: 1rem 0.5rem; }
  .food-card .food-menu-img, .food-card .food-menu-img img { width: 80px; height: 80px; }
}
.success, .error {
  margin: 1.2rem auto 0 auto;
  padding: 1rem;
  border-radius: 8px;
  font-size: 1rem;
  max-width: 400px;
  text-align: center;
}
.success { background: #00b894; color: #fff; }
.error { background: #ff7675; color: #fff; }
</style>

<?php
// Handle order form submission
if (isset($_POST['submit'])) {
    $food = mysqli_real_escape_string($conn, $_POST['food']);
    $price = (float)$_POST['price'];
    $qty = (int)$_POST['qty'];
    $total = $price * $qty;
    $order_date = date('Y-m-d H:i:s');
    $status = 'Ordered';
    $customer_name = mysqli_real_escape_string($conn, $_POST['full-name']);
    $customer_contact = mysqli_real_escape_string($conn, $_POST['contact']);

    $sql_order = "INSERT INTO tbl_order (food, price, quantity, total, order_date, status, customer_name, customer_contact) VALUES ('$food', $price, $qty, $total, '$order_date', '$status', '$customer_name', '$customer_contact')";
    $res_order = mysqli_query($conn, $sql_order);
    if ($res_order) {
        $_SESSION['order'] = '<div class="success">Order confirmed! Thank you for ordering.</div>';
        header('Location: ' . SITEURL . 'index.php');
        exit();
    } else {
        echo '<div class="error">Order could not be confirmed. Error: ' . mysqli_error($conn) . '</div>';
    }
}
?>