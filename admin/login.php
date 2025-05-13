<?php include('../config/constants.php') ?>


<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LOGIN - Canteen Order Management Website</title>
    <link rel="stylesheet" href="../css/style.css">
    
    <style>
        body {
    margin: 0;
    height: 100vh; /* full height */
    display: flex;
    justify-content: center; /* center horizontally */
    align-items: center;     /* center vertically */
    background-color: #222;
    color: white;
    font-family: Arial, sans-serif;
}

.login {
    text-align: center;
    border: 2px solid white;
    padding: 20px;
    width: 300px;
    background-color: #333;
    border-radius: 8px;
}


        h1 {
            font-size: 2em;
            margin-bottom: 20px;
            color: white;
        }
    </style>
</head>
<body>
    <div class="login">
        <h1>Login</h1>

        <br><br>
        <?php
        if (isset($_SESSION['login'])) {
            echo $_SESSION['login'];
            unset($_SESSION['login']);
        }
        if (isset($_SESSION['no-login-message'])) {
            echo $_SESSION['no-login-message'];
            unset($_SESSION['no-login-message']);
        }
        ?>
        <br><br>

        <form action="login.php" method="POST">
            userrname: <br> 
            <input type="text" name="username" placeholder="Username" required><br><br>
            password: <br>
            <input type="password" name="password" placeholder="Password" required><br><br>
            

            <input type="submit" name="submit" value="Login" class="btn-primary"><br><br>
        </form>
        <p>created by jayati</p>
    </div>
</body>
</html>


<?php
if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $password = md5($_POST['password']); // Note: use password_hash() in production

    $sql = "SELECT * FROM tbl_admin WHERE username='$username' AND password='$password'";
    $res = mysqli_query($conn, $sql);

    if ($res && mysqli_num_rows($res) == 1) {
        $_SESSION['login'] = "<div class='success'>Login Successful</div>";
        $_SESSION['user'] = $username;

        header('location:'.SITEURL.'admin/index.php');
    } else {
        $_SESSION['login'] = "<div class='error'>Username or Password did not match</div>";
        header('location:'.SITEURL.'admin/login.php');
    }
}




?>
