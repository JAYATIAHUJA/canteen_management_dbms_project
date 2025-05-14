<!DOCTYPE html>
<html lang="en">
<head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>canteen order management website - home page</title>
        <link rel="stylesheet" href="../css/admin.css">
        <style>
        .dashboard-grid {
          display: flex;
          flex-wrap: wrap;
          gap: 2rem;
          margin-bottom: 2.5rem;
        }
        .col-4 {
          background: #fff;
          border-radius: 18px;
          box-shadow: 0 4px 24px rgba(44,62,80,0.08);
          padding: 2.2rem 1.5rem 1.2rem 1.5rem;
          flex: 1 1 220px;
          min-width: 220px;
          max-width: 320px;
          text-align: center;
          margin-bottom: 1rem;
          position: relative;
        }
        .col-4 h1 {
          font-size: 2.2rem;
          color: #ffb300;
          margin-bottom: 0.5rem;
        }
        .col-4 p {
          color: #888;
          font-size: 1.1rem;
          margin-bottom: 0;
        }
        @media (max-width: 900px) {
          .dashboard-grid { flex-direction: column; gap: 1.2rem; }
          .col-4 { max-width: 100%; min-width: 0; }
        }
        .badge-status {
          display: inline-block;
          padding: 0.3em 1em;
          border-radius: 16px;
          font-size: 0.98em;
          font-weight: 600;
          color: #fff;
          margin-right: 0.2em;
        }
        .badge-ordered { background: #ffb300; }
        .badge-cancelled { background: #ff7675; }
        </style>
</head>
<body>
    
<?php include('partials/menu.php');?>
   
        
    </div>
      <!-- menu section ends-->
      <!-- main content section starts-->
       <div class="main-content">
        <div class="wrapper"> 
            <h1>DASHBOARD</h1>
            <?php 
            // Show logged-in admin's name
            if (isset($_SESSION['user'])) {
                $username = $_SESSION['user'];
                $sql_admin = "SELECT full_name FROM tbl_admin WHERE username='$username' LIMIT 1";
                $res_admin = mysqli_query($conn, $sql_admin);
                $row_admin = mysqli_fetch_assoc($res_admin);
                $admin_name = $row_admin ? $row_admin['full_name'] : $username;
                echo '<div style="font-size:1.2rem;margin-bottom:1.2rem;color:#333;font-weight:500;">Welcome, <span style="color:#ffb300;">' . htmlspecialchars($admin_name) . '</span>!</div>';
            }
            ?>
            <div class="dashboard-grid" style="display: flex; flex-wrap: wrap; gap: 2rem; margin-bottom: 2.5rem;">
              <!-- First row: 3 cards -->
              <div style="display: flex; flex: 1 1 100%; gap: 2rem; margin-bottom: 2rem;">
                <div class="col-4">
                  <?php
                  $sql = "SELECT * FROM tbl_category";
                  $res = mysqli_query($conn, $sql);
                  $count = mysqli_num_rows($res);
                  ?>
                  <h1><?php echo $count?></h1>
                  <br />
                  <p>Categories</p>
                </div>
                <div class="col-4">
                  <?php
                  $sql2 = "SELECT * FROM tbl_food";
                  $res2 = mysqli_query($conn, $sql2);
                  $count2 = mysqli_num_rows($res2);
                  ?>
                  <h1><?php echo $count2?></h1>
                  <br />
                  <p>Foods</p>
                </div>
                <div class="col-4">
                  <?php
                  $sql3 = "SELECT * FROM tbl_order";
                  $res3 = mysqli_query($conn, $sql3);
                  $count3 = mysqli_num_rows($res3);
                  ?>
                  <h1><?php echo $count3?></h1>
                  <br />
                  <p>Total Order</p>
                </div>
                <div class="col-4">
                  <?php
                  // Call the stored procedure for today's sales
                  $today = date('Y-m-d');
                  $sql_sales = "CALL get_daily_sales('$today')";
                  $res_sales = mysqli_query($conn, $sql_sales);
                  $row_sales = $res_sales ? mysqli_fetch_assoc($res_sales) : ['total_orders' => 0, 'total_revenue' => 0];
                  // Free result and reset connection for further queries after CALL
                  if ($res_sales) mysqli_next_result($conn);
                  ?>
                  <h1><?php echo $row_sales['total_orders']; ?></h1>
                  <br />
                  <p>Today's Orders</p>
                  <h1 style="font-size:1.3rem;margin-top:0.7rem;">Rs.<?php echo number_format($row_sales['total_revenue'],2); ?></h1>
                  <p>Today's Revenue</p>
                </div>
              </div>
              <!-- Second row: 2 cards -->
              <div style="display: flex; flex: 1 1 100%; gap: 2rem;">
                <div class="col-4">
                  <?php
                  $sql4 = "SELECT SUM(total) AS Total FROM tbl_order where status='Delivered'";
                  $res4 = mysqli_query($conn, $sql4);
                  $row4 = mysqli_fetch_assoc($res4);
                  $total = $row4['Total'];
                  ?>
                  <h1>Rs.<?php echo $total?></h1>
                  <br />
                  <p>Revenue Generated</p>
                </div>
                <div class="col-4">
                  <?php
                  // Most ordered food
                  $sql_most = "SELECT food, SUM(quantity) as total_qty FROM tbl_order GROUP BY food ORDER BY total_qty DESC LIMIT 1";
                  $res_most = mysqli_query($conn, $sql_most);
                  $most_food = mysqli_fetch_assoc($res_most);
                  ?>
                  <h1 style="font-size:2rem;"><span style="font-size:1.1rem;color:#888;">Most Ordered:</span><br><?php echo $most_food ? htmlspecialchars($most_food['food']) : 'N/A'; ?></h1>
                  <br />
                  <p>Total Ordered: <b><?php echo $most_food ? $most_food['total_qty'] : 0; ?></b></p>
                </div>
              </div>
            </div>
            <div class="clearfix"></div>

            <br>
        </br>
        
            <!-- Sales Trend Chart -->
            <div style="margin-top:2.5rem;">
                <h2 style="font-size:1.3rem;margin-bottom:1rem;color:#222;font-weight:600;">Sales Trend (Last 7 Days)</h2>
                <canvas id="salesTrendChart" height="80"></canvas>
                <?php
                // Prepare data for the last 7 days
                $labels = [];
                $data = [];
                for ($i = 6; $i >= 0; $i--) {
                    $date = date('Y-m-d', strtotime("-$i days"));
                    $labels[] = date('D', strtotime($date));
                    $sql = "SELECT COUNT(*) as order_count FROM tbl_order WHERE DATE(order_date) = '$date'";
                    $res = mysqli_query($conn, $sql);
                    $row = mysqli_fetch_assoc($res);
                    $data[] = $row ? (int)$row['order_count'] : 0;
                }
                ?>
                <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
                <script>
                const ctx = document.getElementById('salesTrendChart').getContext('2d');
                new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: <?php echo json_encode($labels); ?>,
                        datasets: [{
                            label: 'Orders',
                            data: <?php echo json_encode($data); ?>,
                            borderColor: '#ffb300',
                            backgroundColor: 'rgba(255,179,0,0.12)',
                            fill: true,
                            tension: 0.3,
                            pointRadius: 5,
                            pointBackgroundColor: '#ffb300',
                        }]
                    },
                    options: {
                        responsive: true,
                        plugins: {
                            legend: { display: false },
                        },
                        scales: {
                            y: { beginAtZero: true, ticks: { stepSize: 1 } }
                        }
                    }
                });
                </script>
            </div>

            <br>

            <!-- Pending Actions Section -->
            <div style="margin-top:2.5rem;">
                <h2 style="font-size:1.3rem;margin-bottom:1rem;color:#222;font-weight:600;">Pending Actions</h2>
                <div style="overflow-x:auto;">
                <table style="width:100%;border-collapse:collapse;background:#fff;border-radius:12px;box-shadow:0 2px 12px rgba(44,62,80,0.06);">
                    <thead>
                        <tr style="background:#f9fafb;">
                            <th style="padding:0.7rem 1rem;text-align:left;">Order ID</th>
                            <th style="padding:0.7rem 1rem;text-align:left;">Food</th>
                            <th style="padding:0.7rem 1rem;text-align:left;">Qty</th>
                            <th style="padding:0.7rem 1rem;text-align:left;">Status</th>
                            <th style="padding:0.7rem 1rem;text-align:left;">Customer</th>
                            <th style="padding:0.7rem 1rem;text-align:left;">Order Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql_pending = "SELECT id, food, quantity, status, customer_name, order_date FROM tbl_order WHERE status IN ('Ordered', 'Cancelled') ORDER BY id DESC LIMIT 5";
                        $res_pending = mysqli_query($conn, $sql_pending);
                        if ($res_pending && mysqli_num_rows($res_pending) > 0) {
                            while ($row = mysqli_fetch_assoc($res_pending)) {
                                echo '<tr>';
                                echo '<td style=\"padding:0.6rem 1rem;\">#' . (int)$row['id'] . '</td>';
                                echo '<td style=\"padding:0.6rem 1rem;\">' . htmlspecialchars($row['food']) . '</td>';
                                echo '<td style=\"padding:0.6rem 1rem;\">' . (int)$row['quantity'] . '</td>';
                                $status = htmlspecialchars($row['status']);
                                $badgeClass = $status === 'Ordered' ? 'badge-ordered' : ($status === 'Cancelled' ? 'badge-cancelled' : '');
                                echo '<td style="padding:0.6rem 1rem;"><span class="badge-status ' . $badgeClass . '">' . $status . '</span></td>';
                                echo '<td style=\"padding:0.6rem 1rem;\">' . htmlspecialchars($row['customer_name']) . '</td>';
                                echo '<td style=\"padding:0.6rem 1rem;\">' . htmlspecialchars($row['order_date']) . '</td>';
                                echo '</tr>';
                            }
                        } else {
                            echo '<tr><td colspan="6" style="padding:1rem;text-align:center;color:#888;">No pending actions found.</td></tr>';
                        }
                        ?>
                    </tbody>
                </table>
                </div>
            </div>
        
        </div>
       
       </div>
      <!-- main content section ends-->

      <?php include('partials/footer.php');?>
</body>
</html>
