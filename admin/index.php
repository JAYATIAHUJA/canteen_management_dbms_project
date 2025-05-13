<!DOCTYPE html>
<html lang="en">
<head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>canteen order management website - home page</title>
        <link rel="stylesheet" href="../css/admin.css">
</head>
<body>
    
<?php include('partials/menu.php');?>
   
        
    </div>
      <!-- menu section ends-->
      <!-- main content section starts-->
       <div class="main-content">
        <div class="wrapper"> 
            <h1>DASHBOARD</h1>
            <div class="col-4">
                
              <?php
              $sql = "SELECT * FROM tbl_category";
              $res = mysqli_query($conn, $sql);
              $count = mysqli_num_rows($res);
                ?>
                
                <h1><?php echo $count?></h1>
                <br />
                <p>Categories</p>
            </div>


            <div class="col-4">

                <?php
              $sql2 = "SELECT * FROM tbl_food";
              $res2 = mysqli_query($conn, $sql2);
              $count2 = mysqli_num_rows($res2);
                ?>
                <h1><?php echo $count2?></h1>
              
                <br />
                <p>Foods</p>
            </div>
            <div class="col-4">

                <?php
              $sql3 = "SELECT * FROM tbl_order";
              $res3 = mysqli_query($conn, $sql3);
              $count3 = mysqli_num_rows($res3);
                ?>
                <h1><?php echo $count?></h1>
                
                <br />
                <p>Total Order</p>
            </div>


            <div class="col-4">
                <?php
              $sql4 = "SELECT SUM(total) AS Total FROM tbl_order where status='Delivered'";
                $res4 = mysqli_query($conn, $sql4);
                $row4 = mysqli_fetch_assoc($res4);
                $total = $row4['Total'];
                ?>
                <h1>Rs.<?php echo $total?></h1>
            
                <br />
                <p>Revenue Generated</p>
            </div>
         
            <div class="clearfix"></div>
        
        </div>
       
       </div>
      <!-- main content section ends-->

      <?php include('partials/footer.php');?>
</body>
</html>
