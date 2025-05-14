<?php 
include('partials/menu.php');
// Handle form submission BEFORE any HTML output
if(isset($_POST['submit'])){
    $id = $_POST['id'];
    $price = $_POST['price'];
    $qty = $_POST['qty'];
    $total = $price * $qty;
    $status = $_POST['status'];
    $customer_name = $_POST['customer_name'];
    $customer_contact = $_POST['customer_contact'];

    $sql2 = "UPDATE tbl_order SET 
        price = $price,
        quantity = $qty,
        total = $total,
        status = '$status',
        customer_name = '$customer_name',
        customer_contact = '$customer_contact'
        WHERE id = $id";

    $res2 = mysqli_query($conn, $sql2);

    if($res2==true){
        $_SESSION['update'] = "<div class='success'>Order updated successfully.</div>";
        header('location:'.SITEURL.'admin/manage-order.php');
        exit();
    }else{
        $_SESSION['update'] = "<div class='error'>Failed to update order.</div>";
        header('location:'.SITEURL.'admin/manage-order.php');
        exit();
    }
}
?>
<div class="main-content">
    <div class="wrapper">
        <h1>Update Order</h1>
        <br><br>
        <?php
            //check if id is set
            if(isset($_GET['id'])){
                //get the id
                $id = $_GET['id'];
                //create sql query to get the order details
                $sql = "SELECT * FROM tbl_order WHERE id=$id";
                //execute the query
                $res = mysqli_query($conn, $sql);
                //check if query executed successfully
                if($res==true){
                    //check if order available
                    $count = mysqli_num_rows($res);
                    if($count==1){
                        //order available
                        //get the details
                        $row = mysqli_fetch_assoc($res);
                        $food = $row['food'];
                        $price = $row['price'];
                        $qty = $row['quantity'];
                        $total = $row['total'];
                        $order_date = $row['order_date'];
                        $status = $row['status'];
                        $customer_name = $row['customer_name'];
                        $customer_contact = $row['customer_contact'];
                    }else{
                        //order not available
                        header('location:'.SITEURL.'admin/manage-order.php');
                        exit();
                    }
                }
            }else{
                //id not set
                header('location:'.SITEURL.'admin/manage-order.php');
                exit();
            }
        ?>
        <form action="" method="POST">
            <table class="tbl-30">
                <tr>
                    <td>Food Name</td>
                    <td><b><?php echo $food; ?></b></td>
                </tr>
                <tr>
                    <td>Price</td>
                    <td><b>$<?php echo $price; ?></b></td>
                </tr>   
                </tr>
                <tr>
                    <td>Qty</td>
                    <td>
                        <input type="number" name="qty" value="<?php echo $qty; ?>" required>
                    </td>
                </tr>
                <tr>
                    <td>Status</td>
                    <td>
                        <select name="status">
                            <option <?php if($status=="Ordered"){echo "selected";} ?> value="Ordered">Ordered</option>
                            <option <?php if($status=="Delivered"){echo "selected";} ?> value="Delivered">Delivered</option>
                            <option <?php if($status=="Cancelled"){echo "selected";} ?> value="Cancelled">Cancelled</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Customer Name</td>
                    <td>
                        <input type="text" name="customer_name" value="<?php echo $customer_name; ?>" required>
                    </td>
                </tr>
                <tr>
                    <td>Customer Contact</td>
                    <td>
                        <input type="text" name="customer_contact" value="<?php echo $customer_contact; ?>" required>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="hidden" name="price" value="<?php echo $price; ?>">
                        <input type="submit" name="submit" value="Update Order" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>
<?php include('partials/footer.php'); ?>