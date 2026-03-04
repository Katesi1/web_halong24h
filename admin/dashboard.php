<?php
  require('inc/essentials.php');
  require('inc/db_config.php');
  adminLogin();
  
  // Get total rooms count
  $total_rooms = mysqli_fetch_assoc(mysqli_query($con,"SELECT COUNT(id) AS `total` FROM `rooms` WHERE `removed`=0"));
  
  // Get total revenue (all time)
  $total_revenue = mysqli_fetch_assoc(mysqli_query($con,"SELECT 
    SUM(CASE WHEN booking_status!='pending' AND booking_status!='payment failed' AND booking_status!='cancelled' THEN `trans_amt` ELSE 0 END) AS `revenue`
    FROM `booking_order`"));
  
  // Get total bookings (all time)
  $total_bookings_all = mysqli_fetch_assoc(mysqli_query($con,"SELECT 
    COUNT(CASE WHEN booking_status!='pending' AND booking_status!='payment failed' THEN 1 END) AS `total`
    FROM `booking_order`"));
?>
<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="Trang quản lý hệ thống đặt phòng khách sạn HaLong24h - Dashboard quản trị hiện đại với thống kê và phân tích chi tiết">
  <meta name="keywords" content="admin dashboard, hotel booking, quản lý khách sạn, HaLong24h">
  <meta name="author" content="HaLong24h">
  <meta name="robots" content="noindex, nofollow">
  <title>Dashboard - Trang Quản Lý | HaLong24h</title>
  <?php require('inc/links.php'); ?>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
</head>
<body>

  <?php 
    require('inc/header.php'); 
    
    $is_shutdown = mysqli_fetch_assoc(mysqli_query($con,"SELECT `shutdown` FROM `settings`"));

    $current_bookings = mysqli_fetch_assoc(mysqli_query($con,"SELECT 
      COUNT(CASE WHEN booking_status='booked' AND arrival=0 THEN 1 END) AS `new_bookings`,
      COUNT(CASE WHEN booking_status='cancelled' AND refund=0 THEN 1 END) AS `refund_bookings`
      FROM `booking_order`"));

    $unread_queries = mysqli_fetch_assoc(mysqli_query($con,"SELECT COUNT(sr_no) AS `count`
      FROM `user_queries` WHERE `seen`=0"));

    $unread_reviews = mysqli_fetch_assoc(mysqli_query($con,"SELECT COUNT(sr_no) AS `count`
      FROM `rating_review` WHERE `seen`=0"));
    
    $current_users = mysqli_fetch_assoc(mysqli_query($con,"SELECT 
      COUNT(id) AS `total`,
      COUNT(CASE WHEN `status`=1 THEN 1 END) AS `active`,
      COUNT(CASE WHEN `status`=0 THEN 1 END) AS `inactive`,
      COUNT(CASE WHEN `is_verified`=0 THEN 1 END) AS `unverified`
      FROM `user_cred`"));  
  ?>

  <!-- Toast Notification Container -->
  <div class="toast-container" id="toastContainer"></div>

  <div class="container-fluid" id="main-content">
    <div class="content-wrapper">
      
      <!-- Page Header -->
      <div class="page-header">
        <div>
          <h1>Dashboard</h1>
          <p class="text-muted mb-0">Tổng quan hệ thống và thống kê</p>
        </div>
        <?php 
          if($is_shutdown['shutdown']){
            echo<<<data
              <span class="badge bg-danger py-2 px-3 rounded-lg">Shutdown Mode is Active!</span>
            data;
          }
        ?>
      </div>

      <!-- Main Statistics Cards -->
      <div class="row mb-4">
        <div class="col-lg-3 col-md-6 mb-4">
          <a href="rooms.php" class="stat-card-link">
            <div class="stat-card">
              <div class="stat-card-icon">
                <i class="bi bi-door-open"></i>
              </div>
              <div class="stat-card-title">Tổng số phòng</div>
              <div class="stat-card-value"><?php echo $total_rooms['total'] ?></div>
              <div class="stat-card-subvalue">Phòng đang hoạt động</div>
            </div>
          </a>
        </div>
        <div class="col-lg-3 col-md-6 mb-4">
          <a href="booking_records.php" class="stat-card-link">
            <div class="stat-card">
              <div class="stat-card-icon" style="background: rgba(16, 185, 129, 0.1); color: #10b981;">
                <i class="bi bi-calendar-check"></i>
              </div>
              <div class="stat-card-title">Tổng đặt phòng</div>
              <div class="stat-card-value"><?php echo $total_bookings_all['total'] ?></div>
              <div class="stat-card-subvalue">Tất cả đơn đặt phòng</div>
            </div>
          </a>
        </div>
        <div class="col-lg-3 col-md-6 mb-4">
          <a href="booking_records.php" class="stat-card-link">
            <div class="stat-card">
              <div class="stat-card-icon" style="background: rgba(245, 158, 11, 0.1); color: #f59e0b;">
                <i class="bi bi-cash-stack"></i>
              </div>
              <div class="stat-card-title">Tổng doanh thu</div>
              <div class="stat-card-value"><?php echo number_format($total_revenue['revenue'] ?? 0, 0, ',', '.') ?></div>
              <div class="stat-card-subvalue">VND</div>
            </div>
          </a>
        </div>
        <div class="col-lg-3 col-md-6 mb-4">
          <a href="new_bookings.php" class="stat-card-link">
            <div class="stat-card">
              <div class="stat-card-icon" style="background: rgba(239, 68, 68, 0.1); color: #ef4444;">
                <i class="bi bi-bell"></i>
              </div>
              <div class="stat-card-title">Đặt phòng mới</div>
              <div class="stat-card-value"><?php echo $current_bookings['new_bookings'] ?></div>
              <div class="stat-card-subvalue">Cần xử lý</div>
            </div>
          </a>
        </div>
      </div>

      <!-- Quick Stats Row -->
      <div class="row mb-4">
        <div class="col-lg-3 col-md-6 mb-4">
          <a href="refund_bookings.php" class="stat-card-link">
            <div class="stat-card">
              <div class="stat-card-icon" style="background: rgba(245, 158, 11, 0.1); color: #f59e0b;">
                <i class="bi bi-arrow-counterclockwise"></i>
              </div>
              <div class="stat-card-title">Yêu cầu hoàn tiền</div>
              <div class="stat-card-value"><?php echo $current_bookings['refund_bookings'] ?></div>
              <div class="stat-card-subvalue">Đang chờ xử lý</div>
            </div>
          </a>
        </div>
        <div class="col-lg-3 col-md-6 mb-4">
          <a href="user_queries.php" class="stat-card-link">
            <div class="stat-card">
              <div class="stat-card-icon" style="background: rgba(59, 130, 246, 0.1); color: #3b82f6;">
                <i class="bi bi-chat-dots"></i>
              </div>
              <div class="stat-card-title">Tin nhắn mới</div>
              <div class="stat-card-value"><?php echo $unread_queries['count'] ?></div>
              <div class="stat-card-subvalue">Chưa đọc</div>
            </div>
          </a>
        </div>
        <div class="col-lg-3 col-md-6 mb-4">
          <a href="rate_review.php" class="stat-card-link">
            <div class="stat-card">
              <div class="stat-card-icon" style="background: rgba(139, 92, 246, 0.1); color: #8b5cf6;">
                <i class="bi bi-star"></i>
              </div>
              <div class="stat-card-title">Đánh giá mới</div>
              <div class="stat-card-value"><?php echo $unread_reviews['count'] ?></div>
              <div class="stat-card-subvalue">Chưa xem</div>
            </div>
          </a>
        </div>
        <div class="col-lg-3 col-md-6 mb-4">
          <a href="users.php" class="stat-card-link">
            <div class="stat-card">
              <div class="stat-card-icon" style="background: rgba(16, 185, 129, 0.1); color: #10b981;">
                <i class="bi bi-people"></i>
              </div>
              <div class="stat-card-title">Tổng người dùng</div>
              <div class="stat-card-value"><?php echo $current_users['total'] ?></div>
              <div class="stat-card-subvalue"><?php echo $current_users['active'] ?> đang hoạt động</div>
            </div>
          </a>
        </div>
      </div>

      <!-- Chart Analytics Section -->
      <div class="chart-container mb-4">
        <div class="chart-header">
          <h3 class="chart-title">Phân tích đặt phòng</h3>
          <select class="form-select shadow-none w-auto" id="bookingPeriod" onchange="booking_analytics(this.value)">
            <option value="1">30 ngày qua</option>
            <option value="2">90 ngày qua</option>
            <option value="3">1 năm qua</option>
            <option value="4">Tất cả</option>
          </select>
        </div>
        <div class="row mb-4">
          <div class="col-md-4 mb-3">
            <div class="stat-card">
              <div class="stat-card-title">Tổng đặt phòng</div>
              <div class="stat-card-value" id="total_bookings">0</div>
              <div class="stat-card-subvalue" id="total_amt">0 VND</div>
            </div>
          </div>
          <div class="col-md-4 mb-3">
            <div class="stat-card">
              <div class="stat-card-title">Đặt phòng đang hoạt động</div>
              <div class="stat-card-value" id="active_bookings">0</div>
              <div class="stat-card-subvalue" id="active_amt">0 VND</div>
            </div>
          </div>
          <div class="col-md-4 mb-3">
            <div class="stat-card">
              <div class="stat-card-title">Đặt phòng đã hủy</div>
              <div class="stat-card-value" id="cancelled_bookings">0</div>
              <div class="stat-card-subvalue" id="cancelled_amt">0 VND</div>
            </div>
          </div>
        </div>
        <canvas id="bookingChart" height="80"></canvas>
      </div>

      <!-- User Analytics Chart -->
      <div class="chart-container mb-4">
        <div class="chart-header">
          <h3 class="chart-title">Phân tích người dùng, tin nhắn và đánh giá</h3>
          <select class="form-select shadow-none w-auto" id="userPeriod" onchange="user_analytics(this.value)">
            <option value="1">30 ngày qua</option>
            <option value="2">90 ngày qua</option>
            <option value="3">1 năm qua</option>
            <option value="4">Tất cả</option>
          </select>
        </div>
        <div class="row mb-4">
          <div class="col-md-4 mb-3">
            <div class="stat-card">
              <div class="stat-card-title">Đăng ký mới</div>
              <div class="stat-card-value" id="total_new_reg">0</div>
            </div>
          </div>
          <div class="col-md-4 mb-3">
            <div class="stat-card">
              <div class="stat-card-title">Tin nhắn</div>
              <div class="stat-card-value" id="total_queries">0</div>
            </div>
          </div>
          <div class="col-md-4 mb-3">
            <div class="stat-card">
              <div class="stat-card-title">Đánh giá</div>
              <div class="stat-card-value" id="total_reviews">0</div>
            </div>
          </div>
        </div>
        <canvas id="userChart" height="80"></canvas>
      </div>

      <!-- User Statistics -->
      <div class="chart-container">
        <h3 class="chart-title mb-4">Thống kê người dùng</h3>
        <div class="row">
          <div class="col-md-3 mb-3">
            <div class="stat-card">
              <div class="stat-card-title">Tổng số</div>
              <div class="stat-card-value"><?php echo $current_users['total'] ?></div>
            </div>
          </div>
          <div class="col-md-3 mb-3">
            <div class="stat-card">
              <div class="stat-card-title">Đang hoạt động</div>
              <div class="stat-card-value"><?php echo $current_users['active'] ?></div>
            </div>
          </div>
          <div class="col-md-3 mb-3">
            <div class="stat-card">
              <div class="stat-card-title">Không hoạt động</div>
              <div class="stat-card-value"><?php echo $current_users['inactive'] ?></div>
            </div>
          </div>
          <div class="col-md-3 mb-3">
            <div class="stat-card">
              <div class="stat-card-title">Chưa xác thực</div>
              <div class="stat-card-value"><?php echo $current_users['unverified'] ?></div>
            </div>
          </div>
        </div>
      </div>

    </div>
  </div>
  

  <?php require('inc/scripts.php'); ?>
  <script src="scripts/dashboard.js"></script>
</body>
</html>
