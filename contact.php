<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <?php require('inc/links.php'); ?>
  <title><?php echo $settings_r['site_title'] ?> - <?php _e('contact') ?></title>
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
      <span class="section-badge"><i class="bi bi-headset me-1"></i> <?php _e('support_24_7') ?></span>
      <h1 class="fw-bold display-5 mb-3"><?php _e('contact_us') ?></h1>
      <p class="lead mb-0 opacity-75"><?php _e('contact_hero_sub') ?></p>
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
              <p class="fw-semibold mb-0 small text-muted"><?php _e('address') ?></p>
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
              <p class="fw-semibold mb-0 small text-muted"><?php _e('support_hotline') ?></p>
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
              <p class="fw-semibold mb-0 small text-muted"><?php _e('email') ?></p>
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
              <p class="fw-semibold mb-0 small text-muted"><?php _e('working_hours') ?></p>
              <span class="text-dark fw-medium"><?php _e('working_hours_value') ?></span>
            </div>
          </div>

          <!-- Mạng xã hội -->
          <div class="contact-info-item">
            <div class="contact-icon">
              <i class="bi bi-share-fill"></i>
            </div>
            <div>
              <p class="fw-semibold mb-1 small text-muted"><?php _e('follow_us') ?></p>
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
          <h4 class="fw-bold h-font mb-1"><?php _e('leave_message') ?></h4>
          <p class="text-muted small mb-4"><?php _e('message_form_sub') ?></p>

          <form method="POST">
            <div class="row g-3">
              <div class="col-md-6">
                <label class="form-label fw-medium"><?php _e('full_name') ?> <span class="text-danger">*</span></label>
                <input name="name" required type="text" class="form-control shadow-none rounded-3" placeholder="Nguyễn Văn A">
              </div>
              <div class="col-md-6">
                <label class="form-label fw-medium">Email <span class="text-danger">*</span></label>
                <input name="email" required type="email" class="form-control shadow-none rounded-3" placeholder="email@example.com">
              </div>
              <div class="col-12">
                <label class="form-label fw-medium"><?php _e('subject') ?> <span class="text-danger">*</span></label>
                <input name="subject" required type="text" class="form-control shadow-none rounded-3" placeholder="Tôi muốn hỏi về...">
              </div>
              <div class="col-12">
                <label class="form-label fw-medium"><?php _e('message') ?> <span class="text-danger">*</span></label>
                <textarea name="message" required class="form-control shadow-none rounded-3" rows="6" style="resize: none;" placeholder="Nhập nội dung tin nhắn của bạn tại đây..."></textarea>
              </div>
              <div class="col-12">
                <button type="submit" name="send" class="btn btn-submit">
                  <i class="bi bi-send-fill me-2"></i><?php _e('send_message') ?>
                </button>
              </div>
            </div>
          </form>
        </div>

        <!-- Câu hỏi thường gặp nhanh -->
        <div class="card form-card p-4 mt-4">
          <h6 class="fw-bold mb-3"><i class="bi bi-lightning-fill text-warning me-2"></i><?php _e('faq_title') ?></h6>
          <div class="row g-3">
            <div class="col-md-6">
              <div class="d-flex align-items-start">
                <i class="bi bi-check-circle-fill text-success me-2 mt-1 flex-shrink-0"></i>
                <div>
                  <p class="fw-semibold small mb-0"><?php _e('faq_checkin_q') ?></p>
                  <p class="text-muted small mb-0"><?php _e('faq_checkin_a') ?></p>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="d-flex align-items-start">
                <i class="bi bi-check-circle-fill text-success me-2 mt-1 flex-shrink-0"></i>
                <div>
                  <p class="fw-semibold small mb-0"><?php _e('faq_parking_q') ?></p>
                  <p class="text-muted small mb-0"><?php _e('faq_parking_a') ?></p>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="d-flex align-items-start">
                <i class="bi bi-check-circle-fill text-success me-2 mt-1 flex-shrink-0"></i>
                <div>
                  <p class="fw-semibold small mb-0"><?php _e('faq_shuttle_q') ?></p>
                  <p class="text-muted small mb-0"><?php _e('faq_shuttle_a') ?></p>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="d-flex align-items-start">
                <i class="bi bi-check-circle-fill text-success me-2 mt-1 flex-shrink-0"></i>
                <div>
                  <p class="fw-semibold small mb-0"><?php _e('faq_cancel_q') ?></p>
                  <p class="text-muted small mb-0"><?php _e('faq_cancel_a') ?></p>
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
        alert('success', __('msg_sent_success'));
      } else {
        alert('error', __('msg_sent_failed'));
      }
    }
  ?>

  <?php require('inc/footer.php'); ?>

</body>
</html>
