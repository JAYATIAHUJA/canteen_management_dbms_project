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
       <!-- menu section ends-->
       <!-- main content section starts-->
       <div class="main-content">
        <div class="wrapper"> 
            <h1>Manage Admin</h1>
            <br />

            <?php
                if(isset($_SESSION['add'])) //checking whether the session is set or not
                {
                    echo $_SESSION['add']; //displaying session message if SET
                    unset($_SESSION['add']); //removing session message
                }

                if(isset($_SESSION['delete'])) //checking whether the session is set or not
                {
                    echo $_SESSION['delete']; //displaying session message if SET
                    unset($_SESSION['delete']); //removing session message
                }

                if(isset($_SESSION['update'])) //checking whether the session is set or not
                {
                    echo $_SESSION['update']; //displaying session message if SET
                    unset($_SESSION['update']); //removing session message
                }

                if(isset($_SESSION['user-not-found'])) //checking whether the session is set or not
                {
                    echo $_SESSION['user-not-found']; //displaying session message if SET
                    unset($_SESSION['user-not-found']); //removing session message
                }

                if(isset($_SESSION['pwd-not-match'])) //checking whether the session is set or not
                {
                    echo $_SESSION['pwd-not-match']; //displaying session message if SET
                    unset($_SESSION['pwd-not-match']); //removing session message
                }

                if(isset($_SESSION['change-pwd'])) //checking whether the session is set or not
                {
                    echo $_SESSION['change-pwd']; //displaying session message if SET
                    unset($_SESSION['change-pwd']); //removing session message
                }
            ?>

            <br ><br />
            <a href="add-admin.php" class="btn-primary">Add Admin</a>
            <br />
            
            <br />
            <table id="tbl-admin" class="tbl-full">
                <tr>
                    <th>s.no</th>
                    <th>Full Name</th>
                    <th>Username</th>
                    <th>Actions</th>
                </tr>

                <?php
                    //SQL query to get all admin
                    $sql = "SELECT * FROM tbl_admin"; //query to get all admin
                    $res = mysqli_query($conn, $sql); //execute the query
                    
                    
                    //check whether the query is executed or not
                    if($res==TRUE)
                    {

                        $count = mysqli_num_rows($res); //function to count rows in database
                        
                        $sn=1; //create a variable and assign value as 1
                      
                        //check the num of rows
                      if($count>0)  {
                       
                        //we have data in database
                        while($row=mysqli_fetch_assoc($res)) //fetching data from database
                        {
                            //using while loop to get all data from database
                            //and while loop will run as long as we have data in database
                            
                            //get individual data
                            $id = $row['id'];
                            $full_name = $row['full_name'];
                            $username = $row['username'];
                            
                            //creating a table to display data
                            ?>
                                
                                <tr>
                                    <td><?php echo $sn++; ?>.</td>
                                    <td><?php echo $full_name; ?></td>
                                    <td><?php echo $username; ?></td>
                                    <td>
                                        <a href="<?php echo SITEURL;?>admin/update-password.php?id=<?php echo $id;?>" class="btn-primary">Change Password</a>
                                        <a href="<?php echo SITEURL;?>admin/update-admin.php?id=<?php echo $id;?>" class="btn-secondary" >Update Admin</a>
                                        <a href="<?php echo SITEURL;?>admin/delete-admin.php?id=<?php echo $id;?>" class="btn-danger">Delete Admin</a>
                                    </td>
                                </tr>

                            <?php 
                        }
                    }
                    else
                    {
                        //we do not have data in database
                        ?>
                            <tr>
                                <td colspan="4"><div class="error">No Admin Added Yet</div></td>
                            </tr>
                        <?php
                    }
                    }


                    ?>
            </table>
            
         
            <div class="clearfix"></div>
        
        </div>
       
       </div>
      <!-- main content section ends-->
      <?php include('partials/footer.php');?>
</body>
</html>

