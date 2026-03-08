<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <?php require('inc/links.php'); ?>
  <title><?php echo $settings_r['site_title'] ?> - Liên hệ</title>
  <style>
    .contact-hero {
      background: linear-gradient(135deg, #1a3c34 0%, #2D6A4F 50%, #40916C 100%);
      padding: 80px 0 60px;
      color: white;
    }
    .section-badge {
      display: inline-block;
      background: rgba(255,255,255,0.15);
      color: white;
      padding: 6px 20px;
      border-radius: 30px;
      font-size: 14px;
      margin-bottom: 16px;
      border: 1px solid rgba(255,255,255,0.3);
    }
    .contact-info-card {
      border-radius: 16px;
      border: none;
      box-shadow: 0 4px 20px rgba(0,0,0,0.08);
      overflow: hidden;
    }
    .contact-info-item {
      display: flex;
      align-items: flex-start;
      padding: 18px 24px;
      border-bottom: 1px solid #f0f0f0;
      transition: background 0.2s;
    }
    .contact-info-item:last-child {
      border-bottom: none;
    }
    .contact-info-item:hover {
      background: #f8fdf9;
    }
    .contact-icon {
      width: 44px;
      height: 44px;
      border-radius: 50%;
      background: linear-gradient(135deg, #2D6A4F, #40916C);
      display: flex;
      align-items: center;
      justify-content: center;
      flex-shrink: 0;
      margin-right: 16px;
    }
    .contact-icon i {
      color: white;
      font-size: 18px;
    }
    .form-card {
      border-radius: 16px;
      border: none;
      box-shadow: 0 4px 20px rgba(0,0,0,0.08);
    }
    .form-control:focus {
      border-color: #2D6A4F;
      box-shadow: 0 0 0 0.2rem rgba(45,106,79,0.15);
    }
    .btn-submit {
      background: linear-gradient(135deg, #2D6A4F, #40916C);
      color: white;
      border: none;
      border-radius: 30px;
      padding: 10px 32px;
      font-weight: 600;
      transition: all 0.3s;
    }
    .btn-submit:hover {
      background: linear-gradient(135deg, #1a3c34, #2D6A4F);
      color: white;
      transform: translateY(-1px);
      box-shadow: 0 4px 15px rgba(45,106,79,0.3);
    }
    .social-link {
      display: inline-flex;
      align-items: center;
      justify-content: center;
      width: 40px;
      height: 40px;
      border-radius: 50%;
      background: #f0f7f4;
      color: #2D6A4F;
      font-size: 18px;
      transition: all 0.2s;
      text-decoration: none;
    }
    .social-link:hover {
      background: #2D6A4F;
      color: white;
      transform: translateY(-2px);
    }
    .map-wrapper {
      border-radius: 12px;
      overflow: hidden;
      box-shadow: 0 2px 12px rgba(0,0,0,0.1);
    }
  </style>
</head>
<body class="bg-light">

  <?php require('inc/header.php'); ?>

  <!-- Hero -->
  <div class="contact-hero">
    <div class="container text-center">
      <span class="section-badge"><i class="bi bi-headset me-1"></i> Hỗ trợ 24/7</span>
      <h1 class="fw-bold display-5 mb-3">Liên Hệ Với Chúng Tôi</h1>
      <p class="lead mb-0 opacity-75">Chúng tôi luôn sẵn sàng hỗ trợ bạn — hãy liên hệ qua hotline, email hoặc để lại lời nhắn để được tư vấn nhanh nhất</p>
    </div>
  </div>

  <div class="container my-5">
    <div class="row g-4 align-items-start">

      <!-- Thông tin liên hệ -->
      <div class="col-lg-5">
        <div class="card contact-info-card mb-4">

          <!-- Map -->
          <div class="map-wrapper">
            <?php echo $contact_r['iframe'] ?? '' ?>
          </div>

          <!-- Địa chỉ -->
          <div class="contact-info-item">
            <div class="contact-icon">
              <i class="bi bi-geo-alt-fill"></i>
            </div>
            <div>
              <p class="fw-semibold mb-0 small text-muted">Địa chỉ</p>
              <a href="<?php echo $contact_r['gmap'] ?>" target="_blank" class="text-decoration-none text-dark fw-medium">
                <?php echo $contact_r['address'] ?>
              </a>
            </div>
          </div>

          <!-- Điện thoại -->
          <div class="contact-info-item">
            <div class="contact-icon">
              <i class="bi bi-telephone-fill"></i>
            </div>
            <div>
              <p class="fw-semibold mb-0 small text-muted">Hotline hỗ trợ</p>
              <a href="tel:+<?php echo $contact_r['pn1'] ?>" class="text-decoration-none text-dark fw-medium">
                +<?php echo $contact_r['pn1'] ?>
              </a>
            </div>
          </div>

          <!-- Email -->
          <div class="contact-info-item">
            <div class="contact-icon">
              <i class="bi bi-envelope-fill"></i>
            </div>
            <div>
              <p class="fw-semibold mb-0 small text-muted">Email</p>
              <a href="mailto:<?php echo $contact_r['email'] ?>" class="text-decoration-none text-dark fw-medium">
                <?php echo $contact_r['email'] ?>
              </a>
            </div>
          </div>

          <!-- Giờ làm việc -->
          <div class="contact-info-item">
            <div class="contact-icon">
              <i class="bi bi-clock-fill"></i>
            </div>
            <div>
              <p class="fw-semibold mb-0 small text-muted">Giờ làm việc</p>
              <span class="text-dark fw-medium">Thứ 2 – Chủ nhật: 7:00 – 22:00</span>
            </div>
          </div>

          <!-- Mạng xã hội -->
          <div class="contact-info-item">
            <div class="contact-icon">
              <i class="bi bi-share-fill"></i>
            </div>
            <div>
              <p class="fw-semibold mb-1 small text-muted">Theo dõi chúng tôi</p>
              <div class="d-flex gap-2">
                <?php if ($contact_r['tw'] != ''): ?>
                  <a href="<?php echo htmlspecialchars($contact_r['tw'] ?? '') ?>" class="social-link" title="Twitter">
                    <i class="bi bi-twitter"></i>
                  </a>
                <?php endif; ?>
                <a href="<?php echo htmlspecialchars($contact_r['fb'] ?? '') ?>" class="social-link" title="Facebook">
                  <i class="bi bi-facebook"></i>
                </a>
                <a href="<?php echo htmlspecialchars($contact_r['zalo'] ?? '') ?>" class="social-link" title="Zalo">
                  <i class="bi bi-chat-dots-fill"></i>
                </a>
              </div>
            </div>
          </div>

        </div>
      </div>

      <!-- Form liên hệ -->
      <div class="col-lg-7">
        <div class="card form-card p-4 p-lg-5">
          <h4 class="fw-bold h-font mb-1">Để Lại Lời Nhắn</h4>
          <p class="text-muted small mb-4">Điền thông tin bên dưới — chúng tôi sẽ phản hồi trong vòng 24 giờ</p>

          <form method="POST">
            <div class="row g-3">
              <div class="col-md-6">
                <label class="form-label fw-medium">Họ và tên <span class="text-danger">*</span></label>
                <input name="name" required type="text" class="form-control shadow-none rounded-3" placeholder="Nguyễn Văn A">
              </div>
              <div class="col-md-6">
                <label class="form-label fw-medium">Email <span class="text-danger">*</span></label>
                <input name="email" required type="email" class="form-control shadow-none rounded-3" placeholder="email@example.com">
              </div>
              <div class="col-12">
                <label class="form-label fw-medium">Tiêu đề <span class="text-danger">*</span></label>
                <input name="subject" required type="text" class="form-control shadow-none rounded-3" placeholder="Tôi muốn hỏi về...">
              </div>
              <div class="col-12">
                <label class="form-label fw-medium">Nội dung <span class="text-danger">*</span></label>
                <textarea name="message" required class="form-control shadow-none rounded-3" rows="6" style="resize: none;" placeholder="Nhập nội dung tin nhắn của bạn tại đây..."></textarea>
              </div>
              <div class="col-12">
                <button type="submit" name="send" class="btn btn-submit">
                  <i class="bi bi-send-fill me-2"></i>Gửi tin nhắn
                </button>
              </div>
            </div>
          </form>
        </div>

        <!-- Câu hỏi thường gặp nhanh -->
        <div class="card form-card p-4 mt-4">
          <h6 class="fw-bold mb-3"><i class="bi bi-lightning-fill text-warning me-2"></i>Câu hỏi thường gặp</h6>
          <div class="row g-3">
            <div class="col-md-6">
              <div class="d-flex align-items-start">
                <i class="bi bi-check-circle-fill text-success me-2 mt-1 flex-shrink-0"></i>
                <div>
                  <p class="fw-semibold small mb-0">Giờ nhận phòng là mấy giờ?</p>
                  <p class="text-muted small mb-0">Check-in: 14:00 | Check-out: 12:00</p>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="d-flex align-items-start">
                <i class="bi bi-check-circle-fill text-success me-2 mt-1 flex-shrink-0"></i>
                <div>
                  <p class="fw-semibold small mb-0">Có chỗ đậu xe không?</p>
                  <p class="text-muted small mb-0">Có bãi đậu xe miễn phí cho khách lưu trú</p>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="d-flex align-items-start">
                <i class="bi bi-check-circle-fill text-success me-2 mt-1 flex-shrink-0"></i>
                <div>
                  <p class="fw-semibold small mb-0">Có dịch vụ đưa đón không?</p>
                  <p class="text-muted small mb-0">Có, đặt trước ít nhất 24 giờ qua hotline</p>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="d-flex align-items-start">
                <i class="bi bi-check-circle-fill text-success me-2 mt-1 flex-shrink-0"></i>
                <div>
                  <p class="fw-semibold small mb-0">Có thể hủy phòng không?</p>
                  <p class="text-muted small mb-0">Miễn phí hủy trước 48 giờ khi nhận phòng</p>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>
    </div>
  </div>

  <?php
    if (isset($_POST['send'])) {
      $frm_data = filteration($_POST);
      $q = "INSERT INTO `user_queries`(`name`, `email`, `subject`, `message`) VALUES (?,?,?,?)";
      $values = [$frm_data['name'], $frm_data['email'], $frm_data['subject'], $frm_data['message']];
      $res = insert($q, $values, 'ssss');
      if ($res == 1) {
        alert('success', 'Tin nhắn đã được gửi thành công!');
      } else {
        alert('error', 'Hệ thống đang được bảo trì! Hãy thử lại sau ít phút.');
      }
    }
  ?>

  <?php require('inc/footer.php'); ?>

</body>
</html>
