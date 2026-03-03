<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <?php require('inc/links.php'); ?>
  <title><?php echo $settings_r['site_title'] ?> - Đặt phòng thành công</title>
</head>
<body class="bg-light">

  <?php require('inc/header.php'); ?>

  <?php 
    // Kiểm tra xem có thông tin booking success không
    if(!isset($_SESSION['booking_success'])){
      redirect('index.php');
    }
    
    $booking_data = $_SESSION['booking_success'];
  ?>
  
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-8 col-md-10 my-5 px-4">
        
        <!-- Success Card -->
        <div class="card border-0 shadow-sm rounded-3 mb-4">
          <div class="card-body text-center p-5">
            <div class="mb-4">
              <i class="bi bi-check-circle-fill text-success" style="font-size: 5rem;"></i>
            </div>
            <h2 class="fw-bold h-font mb-3 text-success">Đặt phòng thành công!</h2>
            <p class="text-muted mb-4">Cảm ơn bạn đã đặt phòng. Vui lòng gửi thông tin đặt phòng qua Zalo để chúng tôi xác nhận.</p>
            
            <!-- Booking Code -->
            <div class="alert alert-info mb-4">
              <h5 class="mb-2">Mã đặt phòng của bạn:</h5>
              <h3 class="fw-bold text-primary mb-0"><?php echo $booking_data['booking_code']; ?></h3>
              <small class="text-muted">Vui lòng lưu lại mã này để tra cứu</small>
            </div>

            <!-- Booking Details -->
            <div class="card bg-light mb-4">
              <div class="card-body text-start">
                <h6 class="fw-bold mb-3">Thông tin đặt phòng:</h6>
                <div class="row mb-2">
                  <div class="col-5"><strong>Tên khách hàng:</strong></div>
                  <div class="col-7"><?php echo htmlspecialchars($booking_data['customer_name']); ?></div>
                </div>
                <div class="row mb-2">
                  <div class="col-5"><strong>Số điện thoại:</strong></div>
                  <div class="col-7"><?php echo htmlspecialchars($booking_data['customer_phone']); ?></div>
                </div>
                <div class="row mb-2">
                  <div class="col-5"><strong>Tên phòng:</strong></div>
                  <div class="col-7"><?php echo htmlspecialchars($booking_data['room_name']); ?></div>
                </div>
                <div class="row mb-2">
                  <div class="col-5"><strong>Ngày nhận phòng:</strong></div>
                  <div class="col-7"><?php echo $booking_data['checkin']; ?></div>
                </div>
                <div class="row mb-2">
                  <div class="col-5"><strong>Ngày trả phòng:</strong></div>
                  <div class="col-7"><?php echo $booking_data['checkout']; ?></div>
                </div>
                <div class="row mb-2">
                  <div class="col-5"><strong>Số đêm:</strong></div>
                  <div class="col-7"><?php echo $booking_data['days']; ?> đêm</div>
                </div>
                <div class="row">
                  <div class="col-5"><strong>Tổng tiền:</strong></div>
                  <div class="col-7"><strong class="text-danger"><?php echo number_format($booking_data['total_amount'], 0, ',', '.'); ?> VND</strong></div>
                </div>
              </div>
            </div>

            <!-- Zalo Button -->
            <div class="d-grid gap-2">
              <a href="<?php echo $booking_data['zalo_url']; ?>" 
                 target="_blank" 
                 class="btn btn-lg text-white mb-3" 
                 style="background-color: #0068FF;"
                 onclick="copyBookingCode()">
                <i class="bi bi-chat-dots-fill me-2"></i>
                Gửi thông tin qua Zalo để xác nhận
              </a>
              <a href="index.php" class="btn btn-outline-secondary">
                <i class="bi bi-house me-2"></i>Về trang chủ
              </a>
            </div>

            <!-- Copy Code Button -->
            <div class="mt-4">
              <button onclick="copyBookingCode()" class="btn btn-outline-primary btn-sm">
                <i class="bi bi-clipboard me-2"></i>Sao chép mã đặt phòng
              </button>
            </div>
          </div>
        </div>

        <!-- Instructions -->
        <div class="card border-0 shadow-sm rounded-3">
          <div class="card-body">
            <h6 class="fw-bold mb-3"><i class="bi bi-info-circle me-2"></i>Hướng dẫn:</h6>
            <ol class="mb-0">
              <li>Nhấn nút "Gửi thông tin qua Zalo" để mở ứng dụng Zalo</li>
              <li>Tin nhắn đã được tự động điền sẵn với thông tin đặt phòng của bạn</li>
              <li>Gửi tin nhắn để chúng tôi xác nhận đặt phòng</li>
              <li>Lưu lại mã đặt phòng để tra cứu khi cần</li>
            </ol>
          </div>
        </div>

      </div>
    </div>
  </div>

  <?php require('inc/footer.php'); ?>

  <script>
    function copyBookingCode() {
      const bookingCode = '<?php echo $booking_data['booking_code']; ?>';
      navigator.clipboard.writeText(bookingCode).then(function() {
        alert('success', 'Đã sao chép mã đặt phòng: ' + bookingCode);
      }, function() {
        // Fallback for older browsers
        const textArea = document.createElement('textarea');
        textArea.value = bookingCode;
        document.body.appendChild(textArea);
        textArea.select();
        document.execCommand('copy');
        document.body.removeChild(textArea);
        alert('success', 'Đã sao chép mã đặt phòng: ' + bookingCode);
      });
    }

    // Xóa session sau khi hiển thị (tùy chọn)
    // Có thể giữ lại để người dùng có thể refresh trang
  </script>

</body>
</html>
