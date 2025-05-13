<?php include('partials/menu.php');?>

<div class="main-content">
<div class="wrapper">
<h1>MANAGE ADMIN</h1>

            <br />

            <?php
                //check if session is set
        
                if(isset($_SESSION['update'])){
                    echo $_SESSION['update'];
                    unset($_SESSION['update']);
                }

            ?>

            <br />
            <br />
            <table id="tbl-admin" class="tbl-full">
                <tr>
                    <th>S.no.</th>
                    <th>Food</th>
                    <th>Price</th>
                    <th>Qty.</th>
                    <th>Total</th>
                    <th>Order Date</th>
                    <th>Status</th>
                    <th>Customer Name</th>
                    <th>Customer Contact</th>
                    <th>Customer Email</th>
                    <th>Customer Address</th>
                    <th>Actions</th>
                </tr>

                <?php
                //get all orders from database
                $sql = "SELECT * FROM tbl_order ORDER BY id DESC";
                //execute the query
                $res = mysqli_query($conn, $sql);
                //count rows
                $count = mysqli_num_rows($res);

                //create serial number variable and set it to 1
                $sn=1;
                
                //check if orders available
                if($count>0){
                    //orders available
                    while($row=mysqli_fetch_assoc($res)){
                        //get values
                        $id = $row['id'];
                        $food = $row['food'];
                        $price = $row['price'];
                        $qty = $row['quantity'];
                        $total = $row['total'];
                        $order_date = $row['order_date'];
                        $status = $row['status'];
                        $customer_name = $row['customer_name'];
                        $customer_contact = $row['customer_contact'];
                        $customer_email = $row['customer_email'];
                        $customer_address = $row['customer_address'];
                        ?>
                            <tr>
                                <td><?php echo $sn++; ?>.</td>
                                <td><?php echo $food; ?></td>
                                <td><?php echo $price; ?></td>
                                <td><?php echo $qty; ?></td>
                                <td><?php echo $total; ?></td>
                                <td><?php echo $order_date; ?></td>

                                <td>
                                    <?php
                                    //check if status is ordered
                                    if($status=="Ordered"){
                                        echo "<label style='color:orange;'>$status</label>";
                                    }elseif($status=="On Delivery"){
                                        echo "<label style='color:blue;'>$status</label>";
                                    }elseif($status=="Delivered"){
                                        echo "<label style='color:green;'>$status</label>";
                                    }elseif($status=="Cancelled"){
                                        echo "<label style='color:red;'>$status</label>";
                                    }
                                        
                                     ?>
                                </td>

                                <td><?php echo $customer_name; ?></td>
                                <td><?php echo $customer_contact; ?></td>
                                <td><?php echo $customer_email; ?></td>
                                <td><?php echo $customer_address; ?></td>
                                <td>
                                   <a href="<?php echo SITEURL; ?>admin/update-order.php?id=<?php echo $id; ?>" class="btn-secondary">Update Order</a>


                                    
                                </td>
                            </tr>
                        <?php
                    }
                }else{
                    //orders not available
                    echo "<tr><td colspan='12' class='error'>Orders not available</td></tr>";
                }
            

                        ?>
            

            </table>
            
         
            <div class="clearfix"></div>
        
        
       
    </div>
</div>

</div>
<?php include('partials/footer.php');?>