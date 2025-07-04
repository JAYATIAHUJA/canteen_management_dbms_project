<?php include('partials/menu.php'); ?>

<?php
    //1. Get the ID of selected admin
    $id = $_GET['id'];

    //2. Create SQL query to get the details
    $sql = "SELECT * FROM tbl_admin WHERE id=$id";

    //Execute the query
    $res = mysqli_query($conn, $sql);

    //Check whether the query is executed or not
    if($res==TRUE)
    {
        //Check whether we have data or not
        $count = mysqli_num_rows($res); //function to get all rows in database

        if($count==1) //check whether we have admin data or not
        {
            //Get the details
            $row = mysqli_fetch_assoc($res); //fetching data from database

            $full_name = $row['full_name'];
            $username = $row['username'];
        }
        else
        {
            //Redirect to manage admin page
            header('location:'.SITEURL.'admin/manage-admin.php');
            exit();
        }
    }
    else
    {
        //Redirect to manage admin page
        header('location:'.SITEURL.'admin/manage-admin.php');
        exit();
    }

    // Handle form submission BEFORE any HTML output
    if(isset($_POST['submit']))
    {
        //Get all the values from form to update
        $id = $_POST['id'];
        $full_name = $_POST['full_name'];
        $username = $_POST['username'];

        //Create SQL query to update admin
        $sql = "UPDATE tbl_admin SET 
            full_name = '$full_name',
            username = '$username'
            WHERE id=$id
        ";

        //Execute the query
        $res = mysqli_query($conn, $sql);

        //Check whether the query executed successfully or not
        if($res==TRUE)
        {
            //Query executed and admin updated
            $_SESSION['update'] = "<div class='success'>Admin Updated Successfully.</div>";
            header('location:'.SITEURL.'admin/manage-admin.php');
            exit();
        }
        else
        {
            //Failed to update admin
            $_SESSION['update'] = "<div class='error'>Failed to Update Admin.</div>";
            header('location:'.SITEURL.'admin/manage-admin.php');
            exit();
        }
    }
?>

<div class="main-content">
     <div class="wrapper">
        <h1>Update Admin</h1>

        <br /><br />

        <form action="" method="POST">
            <table class="tbl-30">
                <tr>
                    <td>Full Name:</td>
                    <td>
                        <input type="text" name="full_name" value="<?php echo $full_name; ?>">
                    </td>
                </tr>

                <tr>
                    <td>Username:</td>
                    <td>
                        <input type="text" name="username" value="<?php echo $username; ?>">
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id; ?>"> <!--hidden input to store id-->
                        <input type="submit" name="submit" value="Update Admin" class="btn-secondary">
                    </td>
                </tr>

        </form>
     </div>
</div>