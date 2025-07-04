
<?php include('partials/menu.php'); ?>


<div class="main-content">
    <div class="wrapper">
        <h1>Change Password</h1>

        <br /><br />
        
        <?php

        

        if (isset($_GET['id'])) {
            //1. Get the ID of selected admin
            $id = $_GET['id'];
        }
        ?>

        <form action="" method="POST">
            <table class="tbl-30">
                <tr>
                    <td>Current Password:</td>
                    <td>
                        <input type="password" name="current_password" placeholder="Current Password">
                    </td>
                </tr>

                <tr>
                    <td>New Password:</td>
                    <td>
                        <input type="password" name="new_password" placeholder="New Password">
                    </td>
                </tr>

                <tr>
                    <td>Confirm Password:</td>
                    <td>
                        <input type="password" name="confirm_password" placeholder="Confirm Password">
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="submit" name="submit" value="Update Password" class="btn-secondary">
                    </td>
                </tr>

            </table>
        </form>
    </div>
</div>


<?php

//check whether the submit button is clicked or not 
if (isset($_POST['submit'])) {
    //1. Get the data from form
    $id = $_POST['id'];
    $current_password = md5($_POST['current_password']); //password encryption with md5
    $new_password = md5($_POST['new_password']);
    $confirm_password = md5($_POST['confirm_password']);

    //2. Check whether the user with current id and current password exists or not
    $sql = "SELECT * FROM tbl_admin WHERE id=$id AND password='$current_password'";
    //execute the query
    $res = mysqli_query($conn, $sql);
    if ($res == true) {
        //check whether data is available or not
        $count = mysqli_num_rows($res);
        if ($count == 1) {
            //user exists and password can be changed
            //3. Check whether new password and confirm password match or not
            if ($new_password == $confirm_password) {
                //update the password
                $sql2 = "UPDATE tbl_admin SET 
                    password='$new_password' 
                    WHERE id=$id";
                //execute the query
                $res2 = mysqli_query($conn, $sql2);
                if ($res2 == true) {
                    //password updated
                    $_SESSION['change-pwd'] = "<div class='success'>Password Changed Successfully.</div>";
                    header('location:' . SITEURL . 'admin/manage-admin.php');
                } else {
                    //failed to update password
                    $_SESSION['change-pwd'] = "<div class='error'>Failed to Change Password.</div>";
                    header('location:' . SITEURL . 'admin/manage-admin.php');
                }
            } else {
                //redirect to manage admin page with error message
                $_SESSION['pwd-not-match'] = "<div class='error'>Password did not match.</div>";
                header('location:' . SITEURL . 'admin/manage-admin.php');
            }
        } else {
            //user does not exist set message and redirect
            $_SESSION['user-not-found'] = "<div class='error'>User Not Found.</div>";
            header('location:' . SITEURL . 'admin/manage-admin.php');
        }
    }
}
//4. Redirect to manage admin page with message (success/error)
else {}

?>

<?php include('partials/footer.php'); ?>