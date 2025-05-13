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
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: #f9fafb;
            color: #222;
            font-family: 'Poppins', 'Inter', Arial, sans-serif;
        }
        .login-card {
            background: #fff;
            border-radius: 16px;
            box-shadow: 0 4px 24px rgba(44, 62, 80, 0.10);
            padding: 2.5rem 2rem 2rem 2rem;
            width: 100%;
            max-width: 350px;
            text-align: center;
        }
        .login-card h1 {
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 1.5rem;
            color: var(--primary-color);
        }
        .login-card .input-group {
            margin-bottom: 1.2rem;
            text-align: left;
        }
        .login-card label {
            font-size: 1rem;
            font-weight: 500;
            margin-bottom: 0.3rem;
            display: block;
            color: #333;
        }
        .login-card input[type="text"],
        .login-card input[type="password"] {
            width: 100%;
            padding: 0.9rem 1rem;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-size: 1rem;
            margin-top: 0.2rem;
            background: #f7f7f7;
            transition: border 0.2s;
        }
        .login-card input[type="text"]:focus,
        .login-card input[type="password"]:focus {
            border-color: var(--primary-color);
            outline: none;
        }
        .login-card .btn-primary {
            width: 100%;
            padding: 1rem;
            font-size: 1.1rem;
            border-radius: 8px;
            margin-top: 0.5rem;
        }
        .login-card .error, .login-card .success {
            margin-bottom: 1rem;
            padding: 0.8rem;
            border-radius: 8px;
            font-size: 1rem;
        }
        .login-card .error {
            background: #ff7675;
            color: #fff;
        }
        .login-card .success {
            background: #00b894;
            color: #fff;
        }
        .login-card .login-footer {
            margin-top: 2rem;
            color: #aaa;
            font-size: 0.95rem;
        }
    </style>
</head>
<body>
    <div class="login-card">
        <img src="../images/bitebox-logo.png" alt="BiteBox Logo" style="width:60px;margin-bottom:1rem;">
        <h1>Admin Login</h1>
        <?php
        if (isset($_SESSION['login'])) {
            echo '<div class="error">'.$_SESSION['login'].'</div>';
            unset($_SESSION['login']);
        }
        if (isset($_SESSION['no-login-message'])) {
            echo '<div class="error">'.$_SESSION['no-login-message'].'</div>';
            unset($_SESSION['no-login-message']);
        }
        ?>
        <form action="login.php" method="POST" autocomplete="off">
            <div class="input-group">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" placeholder="Enter your username" required>
            </div>
            <div class="input-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" placeholder="Enter your password" required>
            </div>
            <button type="submit" name="submit" class="btn btn-primary">Login</button>
        </form>
        <div class="login-footer">&copy; <?php echo date('Y'); ?> BiteBox Admin</div>
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
