<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <?php require('inc/links.php'); ?>
  <script>document.documentElement.lang = '<?php echo current_lang(); ?>';</script>
  <title><?php echo $settings_r['site_title'] ?> - <?php _e('booking_success_title') ?></title>
  <meta name="robots" content="noindex, nofollow">
  <style>
    .bs-container { max-width: 680px; }
    .bs-success-icon {
      width: 80px; height: 80px;
      border-radius: 50%;
      background: linear-gradient(135deg, #28a745, #20c997);
      display: inline-flex; align-items: center; justify-content: center;
      font-size: 2.5rem; color: #fff;
      box-shadow: 0 8px 24px rgba(40,167,69,.25);
    }
    .bs-code-box {
      background: linear-gradient(135deg, #e8f4fd, #dbeafe);
      border: 2px dashed #0d6efd;
      border-radius: 14px;
      padding: 16px 24px;
      position: relative;
    }
    .bs-code-value {
      font-size: 28px; font-weight: 800;
      letter-spacing: 4px; color: #0d47a1;
      font-family: 'Courier New', monospace;
    }
    .bs-copy-btn {
      position: absolute; top: 10px; right: 10px;
      border: none; background: none;
      color: #0d6efd; font-size: 18px;
      cursor: pointer; padding: 4px 8px;
      border-radius: 6px; transition: background .2s;
    }
    .bs-copy-btn:hover { background: rgba(13,110,253,.1); }
    .bs-detail-table { width: 100%; }
    .bs-detail-table tr { border-bottom: 1px solid #f0f0f0; }
    .bs-detail-table tr:last-child { border-bottom: none; }
    .bs-detail-table td { padding: 10px 0; vertical-align: middle; }
    .bs-detail-table td:first-child {
      color: #888; font-size: 13px; font-weight: 600;
      width: 140px; white-space: nowrap;
    }
    .bs-detail-table td:last-child { font-weight: 500; color: #333; }
    .bs-total-row td { border-top: 2px solid #e9ecef !important; padding-top: 14px; }
    .bs-total-amount { font-size: 20px; font-weight: 700; color: #e74c3c; }
    .bs-zalo-btn {
      background: #0068FF; color: #fff;
      border: none; border-radius: 12px;
      padding: 14px 24px; font-size: 16px; font-weight: 600;
      display: flex; align-items: center; justify-content: center; gap: 10px;
      width: 100%; transition: background .2s, transform .1s;
    }
    .bs-zalo-btn:hover { background: #0055d4; color: #fff; transform: translateY(-1px); }
    .bs-card { border: none; border-radius: 16px; }
    .bs-step { display: flex; gap: 12px; align-items: flex-start; }
    .bs-step-num {
      width: 28px; height: 28px; min-width: 28px;
      border-radius: 50%; background: #0d6efd;
      color: #fff; font-size: 13px; font-weight: 700;
      display: flex; align-items: center; justify-content: center;
    }
    .bs-step-text { font-size: 14px; color: #555; padding-top: 3px; }
    .bs-toast {
      position: fixed; bottom: 24px; left: 50%; transform: translateX(-50%) translateY(80px);
      background: #333; color: #fff; padding: 12px 24px;
      border-radius: 10px; font-size: 14px; font-weight: 500;
      opacity: 0; transition: all .3s ease; z-index: 9999;
      pointer-events: none;
    }
    .bs-toast.show { opacity: 1; transform: translateX(-50%) translateY(0); }
  </style>
</head>
<body class="bg-light">

  <?php require('inc/header.php'); ?>

  <?php
    if(!isset($_SESSION['booking_success'])){
      redirect('index.php');
    }
    $bd = $_SESSION['booking_success'];
  ?>

  <main class="container bs-container">
    <div class="row justify-content-center">
      <div class="col-12 py-4 py-md-5 px-3">

        <!-- Success Header -->
        <div class="card bs-card shadow-sm mb-3">
          <div class="card-body text-center py-4 px-4">
            <div class="bs-success-icon mb-3">
              <i class="bi bi-check-lg"></i>
            </div>
            <h1 class="fw-bold h-font fs-4 text-success mb-2"><?php _e('booking_success_msg') ?></h1>
            <p class="text-muted mb-0" style="font-size:15px;"><?php _e('booking_success_desc') ?></p>
          </div>
        </div>

        <!-- Booking Code + Details -->
        <div class="card bs-card shadow-sm mb-3">
          <div class="card-body p-4">

            <!-- Code Box -->
            <div class="bs-code-box text-center mb-4">
              <div class="text-muted mb-1" style="font-size:12px; font-weight:600; text-transform:uppercase; letter-spacing:1px;">
                <?php _e('your_booking_code') ?>
              </div>
              <div class="bs-code-value"><?php echo $bd['booking_code']; ?></div>
              <div class="text-muted mt-1" style="font-size:12px;"><?php _e('save_code_note') ?></div>
              <button class="bs-copy-btn" onclick="copyCode()" title="<?php _e('copy_booking_code') ?>">
                <i class="bi bi-clipboard" id="copy_icon"></i>
              </button>
            </div>

            <!-- Details Table -->
            <table class="bs-detail-table">
              <tr>
                <td><i class="bi bi-person me-1"></i><?php _e('customer_name') ?></td>
                <td><?php echo htmlspecialchars($bd['customer_name']); ?></td>
              </tr>
              <tr>
                <td><i class="bi bi-telephone me-1"></i><?php _e('phone_label') ?></td>
                <td><?php echo htmlspecialchars($bd['customer_phone']); ?></td>
              </tr>
              <tr>
                <td><i class="bi bi-house-door me-1"></i><?php _e('room_name_label') ?></td>
                <td><?php echo htmlspecialchars($bd['room_name']); ?></td>
              </tr>
              <tr>
                <td><i class="bi bi-calendar-event me-1"></i><?php _e('checkin_date') ?></td>
                <td><?php echo $bd['checkin']; ?></td>
              </tr>
              <tr>
                <td><i class="bi bi-calendar-x me-1"></i><?php _e('checkout_date') ?></td>
                <td><?php echo $bd['checkout']; ?></td>
              </tr>
              <tr>
                <td><i class="bi bi-moon me-1"></i><?php _e('num_nights_label') ?></td>
                <td><?php echo $bd['days']; ?> <?php _e('night') ?></td>
              </tr>
              <tr class="bs-total-row">
                <td><i class="bi bi-cash-stack me-1"></i><?php _e('total_amount_label') ?></td>
                <td><span class="bs-total-amount"><?php echo number_format($bd['total_amount'], 0, ',', '.'); ?> VND</span></td>
              </tr>
            </table>
          </div>
        </div>

        <!-- Actions -->
        <div class="card bs-card shadow-sm mb-3">
          <div class="card-body p-4">
            <a href="<?php echo $bd['zalo_url']; ?>" target="_blank" class="bs-zalo-btn text-decoration-none mb-3">
              <i class="bi bi-chat-dots-fill fs-5"></i>
              <?php _e('send_zalo') ?>
            </a>
            <div class="d-flex gap-2">
              <a href="rooms.php" class="btn btn-outline-secondary flex-fill" style="border-radius:10px; padding:10px;">
                <i class="bi bi-grid me-1"></i><?php _e('room_list') ?>
              </a>
              <a href="index.php" class="btn btn-outline-secondary flex-fill" style="border-radius:10px; padding:10px;">
                <i class="bi bi-house me-1"></i><?php _e('back_home') ?>
              </a>
            </div>
          </div>
        </div>

        <!-- Instructions -->
        <div class="card bs-card shadow-sm mb-4">
          <div class="card-body p-4">
            <h6 class="fw-bold mb-3"><i class="bi bi-info-circle me-2 text-primary"></i><?php _e('instructions') ?></h6>
            <div class="d-flex flex-column gap-3">
              <div class="bs-step">
                <div class="bs-step-num">1</div>
                <div class="bs-step-text"><?php _e('instruction_1') ?></div>
              </div>
              <div class="bs-step">
                <div class="bs-step-num">2</div>
                <div class="bs-step-text"><?php _e('instruction_2') ?></div>
              </div>
              <div class="bs-step">
                <div class="bs-step-num">3</div>
                <div class="bs-step-text"><?php _e('instruction_3') ?></div>
              </div>
              <div class="bs-step">
                <div class="bs-step-num">4</div>
                <div class="bs-step-text"><?php _e('instruction_4') ?></div>
              </div>
            </div>
          </div>
        </div>

      </div>
    </div>
  </main>

  <?php require('inc/footer.php'); ?>

  <div class="bs-toast" id="toast_msg"></div>

  <script>
    function showToast(msg) {
      var t = document.getElementById('toast_msg');
      t.textContent = msg;
      t.classList.add('show');
      setTimeout(function(){ t.classList.remove('show'); }, 2000);
    }

    function copyCode() {
      var code = '<?php echo $bd['booking_code']; ?>';
      var icon = document.getElementById('copy_icon');
      navigator.clipboard.writeText(code).then(function() {
        icon.className = 'bi bi-clipboard-check';
        showToast('<?php _e("copied_code") ?>' + code);
        setTimeout(function(){ icon.className = 'bi bi-clipboard'; }, 2000);
      }).catch(function() {
        var ta = document.createElement('textarea');
        ta.value = code;
        document.body.appendChild(ta);
        ta.select();
        document.execCommand('copy');
        document.body.removeChild(ta);
        showToast('<?php _e("copied_code") ?>' + code);
      });
    }
  </script>

</body>
</html>
