<?php 
include ('partials/menu.php');
// Process the value from form and save it in database
if(isset($_POST['submit'])){
    $full_name = $_POST['full_name'];
    $username = $_POST['username'];
    $password = md5($_POST['password']); // password encryption with md5

    $sql = "INSERT INTO tbl_admin SET 
        full_name='$full_name',
        username='$username',
        password='$password'
    ";

    $res = mysqli_query($conn, $sql);

    if($res==TRUE){
        $_SESSION['add'] = "<div class='success'>Admin added successfully.</div>";
        header('location:'.SITEURL.'admin/manage-admin.php');
        exit();
    } else {
        $_SESSION['add'] = "<div class='error'>Failed to add admin.</div>";
        header('location:'.SITEURL.'admin/add-admin.php');
        exit();
    }
}
?>

<div class="main-content">
    <div class="wrapper"> 
        <h1>Add Admin</h1>
        <br />
        <?php
            if(isset($_SESSION['add'])) //checking whether the session is set or not
            {
                echo $_SESSION['add']; //displaying session message
                unset($_SESSION['add']); //removing session message
            }
        ?>
        <br />
        <form action="" method="POST">
            <table class="tbl-30">
                <tr>
                    <td>Full Name:</td>
                    <td>
                        <input type="text" name="full_name" placeholder="Enter your name" required>
                    </td>
                </tr>
                <tr>
                    <td>Username:</td>
                    <td>
                        <input type="text" name="username" placeholder="Enter your username" required>
                    </td>
                </tr>
                <tr>
                    <td>Password:</td>
                    <td>
                        <input type="password" name="password" placeholder="Enter your password" required>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Admin" class="btn-secondary">
                    </td>
                </tr>
            </table>
        <br><br>
    </div>
<?php include ('partials/footer.php');?>