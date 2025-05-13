<?php 

include ('../config/constants.php');
include('login-check.php');
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../css/admin.css">
    <!-- GSAP CDN -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/gsap.min.js"></script>
</head>
<body>
    <!-- menu section starts-->
   <div class="menu">
        <div class="wrapper" style="display: flex; align-items: center; gap: 2rem;">
            <div class="logo">
                <a href="index.php">
                    <img src="../images/bitebox-logo.png" alt="BiteBox Logo" style="height:48px; width:auto; display:block;">
                </a>
            </div>
            <ul style="flex:1; display:flex; align-items:center; gap:2rem; margin:0;">
                <li><a href="index.php">Home</a></li>
                <li><a href="manage-admin.php">Admin Manager</a></li>
                <li><a href="manage-category.php">Category</a></li>
                <li><a href="manage-food.php">Food</a></li>
                <li><a href="manage-order.php">Order</a></li>
                <li><a href="manage-order.php">logout</a></li>
            </ul>
        </div>
    </div>
    
</body>
</html>

<script>
  window.addEventListener('DOMContentLoaded', function() {
    gsap.from('.logo', {y: -60, opacity: 0, duration: 1, ease: 'power2.out'});
    gsap.from('.menu ul li', {y: -40, opacity: 0, duration: 0.7, stagger: 0.1, delay: 0.3, ease: 'power2.out'});
    gsap.from('.col-4', {y: 40, opacity: 0, duration: 0.8, stagger: 0.15, delay: 0.7, ease: 'power2.out'});
    gsap.from('.tbl-full', {y: 40, opacity: 0, duration: 0.8, delay: 1, ease: 'power2.out'});
  });
</script>   