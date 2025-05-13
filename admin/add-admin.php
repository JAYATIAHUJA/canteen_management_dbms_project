<?php include ('partials/menu.php');?>

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

<?php 
// Process the value from form and save it in database

    //check whether the submit button is clicked or not

    if(isset($_POST['submit'])){
        // Button clicked
        // 1. Get the data from form
        $full_name = $_POST['full_name'];
        $username = $_POST['username'];
        $password = md5($_POST['password']); // password encryption with md5

        // 2. SQL query to save the data into database
        $sql = "INSERT INTO tbl_admin SET 
            full_name='$full_name',
            username='$username',
            password='$password'
        ";

        // 3. Execute the query and saving data in database
       $res = mysqli_query($conn, $sql) or die(mysqli_error($conn));

        // 4. Check whether the (query is executed) data is inserted or not and display appropriate message
        if($res==TRUE){
            // Data inserted
            // Create a session variable to display message
            $_SESSION['add']="Admin added successfully.";
            header('location:'.SITEURL.'admin/manage-admin.php');// Redirect to manage admin page
        }
        else{
            // Failed to insert data
            $_SESSION['add'] = "Failed to add admin.";
            //redirect to add admin page
            header('location:'.SITEURL.'admin/manage-admin.php');
        }
    }

?>