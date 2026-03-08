<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <?php require('inc/links.php'); ?>
  <title><?php echo $settings_r['site_title'] ?> - <?php _e('booking_history') ?></title>
  <style>
    /* ===== SHARED WITH PROFILE PAGE ===== */
    .profile-page { background: #f4f6f9; min-height: 100vh; }

    .profile-breadcrumb {
      padding: 18px 0 10px; font-size: 13px; color: #888;
    }
    .profile-breadcrumb a { color: #888; text-decoration: none; }
    .profile-breadcrumb a:hover { color: #2D6A4F; }
    .profile-breadcrumb .sep { margin: 0 8px; }

    /* Sidebar */
    .profile-sidebar-card {
      background: #fff; border-radius: 18px;
      box-shadow: 0 4px 20px rgba(0,0,0,0.07);
      overflow: hidden; margin-bottom: 20px;
    }
    .profile-cover {
      background: linear-gradient(135deg, #2D6A4F 0%, #40916C 60%, #52B788 100%);
      height: 90px;
    }
    .profile-avatar-wrap {
      display: flex; flex-direction: column; align-items: center;
      padding: 0 20px 24px; margin-top: -48px;
    }
    .profile-avatar-img {
      width: 96px; height: 96px; border-radius: 50%;
      object-fit: cover; border: 4px solid #fff;
      box-shadow: 0 4px 14px rgba(0,0,0,0.12); display: block;
    }
    .profile-avatar-icon {
      width: 96px; height: 96px; border-radius: 50%;
      background: linear-gradient(135deg, #2D6A4F, #52B788);
      display: flex; align-items: center; justify-content: center;
      color: #fff; font-size: 44px;
      border: 4px solid #fff; box-shadow: 0 4px 14px rgba(0,0,0,0.12);
    }
    .profile-name {
      font-size: 1.1rem; font-weight: 700; color: #222;
      margin: 12px 0 3px; text-align: center;
    }
    .profile-email {
      font-size: 0.82rem; color: #888; text-align: center; margin-bottom: 8px;
    }

    /* Sidebar stats */
    .sidebar-stats {
      display: grid; grid-template-columns: 1fr 1fr 1fr;
      gap: 1px; background: #f0f0f0;
      border-top: 1px solid #f0f0f0; border-bottom: 1px solid #f0f0f0;
    }
    .stat-cell {
      background: #fff; padding: 14px 8px; text-align: center;
    }
    .stat-cell .stat-num {
      font-size: 1.3rem; font-weight: 700; color: #222; line-height: 1;
    }
    .stat-cell .stat-label {
      font-size: 0.68rem; color: #999; margin-top: 4px;
    }
    .stat-cell.confirmed .stat-num { color: #2D6A4F; }
    .stat-cell.cancelled .stat-num { color: #e74c3c; }

    /* Sidebar nav */
    .profile-sidebar-nav { padding: 10px 0; }
    .profile-nav-item {
      display: flex; align-items: center; gap: 12px;
      padding: 12px 22px; font-size: 0.9rem; color: #555;
      cursor: pointer; transition: background 0.15s, color 0.15s;
      border: none; background: none; width: 100%; text-align: left;
      border-left: 3px solid transparent; text-decoration: none;
    }
    .profile-nav-item:hover { background: #f4f6f9; color: #2D6A4F; }
    .profile-nav-item.active {
      background: #eef7f2; color: #2D6A4F;
      font-weight: 600; border-left-color: #2D6A4F;
    }
    .profile-nav-item i { font-size: 17px; width: 20px; text-align: center; }
    .profile-nav-item.danger { color: #e74c3c; }
    .profile-nav-item.danger:hover { background: #fff5f5; color: #c0392b; }

    /* ===== BOOKINGS CONTENT ===== */
    .bk-header-card {
      background: linear-gradient(135deg, #2D6A4F 0%, #40916C 60%, #52B788 100%);
      border-radius: 18px; padding: 28px 30px;
      color: #fff; margin-bottom: 20px;
      box-shadow: 0 6px 24px rgba(45,106,79,0.25);
      display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 16px;
    }
    .bk-header-title { font-size: 1.4rem; font-weight: 700; margin: 0 0 4px; }
    .bk-header-sub { font-size: 0.85rem; opacity: 0.85; margin: 0; }
    .bk-header-icon { font-size: 52px; opacity: 0.25; }

    /* Filter tabs */
    .bk-filter-tabs {
      display: flex; gap: 8px; flex-wrap: wrap; margin-bottom: 20px;
    }
    .bk-filter-btn {
      padding: 7px 18px; border-radius: 30px; border: 1.5px solid #e0e0e0;
      background: #fff; color: #666; font-size: 0.83rem; cursor: pointer;
      transition: all 0.2s; font-weight: 500;
    }
    .bk-filter-btn.active {
      background: #2D6A4F; border-color: #2D6A4F; color: #fff;
    }
    .bk-filter-btn:hover:not(.active) { border-color: #2D6A4F; color: #2D6A4F; }

    /* Booking card */
    .bk-card {
      background: #fff; border-radius: 16px;
      box-shadow: 0 2px 14px rgba(0,0,0,0.06);
      overflow: hidden; margin-bottom: 16px;
      display: flex; transition: box-shadow 0.2s, transform 0.2s;
    }
    .bk-card:hover { box-shadow: 0 6px 24px rgba(0,0,0,0.1); transform: translateY(-2px); }
    .bk-card-img {
      width: 180px; flex-shrink: 0; object-fit: cover;
      background: #e8f5ee;
    }
    .bk-card-img-placeholder {
      width: 180px; flex-shrink: 0;
      background: linear-gradient(135deg, #e8f5ee, #d1f0e0);
      display: flex; align-items: center; justify-content: center;
      color: #52B788; font-size: 40px;
    }
    .bk-card-body {
      flex: 1; padding: 20px 24px; display: flex;
      flex-direction: column; justify-content: space-between;
    }
    .bk-card-top { display: flex; justify-content: space-between; align-items: flex-start; gap: 12px; }
    .bk-room-name { font-size: 1rem; font-weight: 700; color: #222; margin: 0 0 4px; }
    .bk-order-id { font-size: 0.75rem; color: #aaa; }
    .bk-status-badge {
      padding: 5px 14px; border-radius: 20px;
      font-size: 0.75rem; font-weight: 600;
      white-space: nowrap; flex-shrink: 0;
    }
    .bk-status-booked { background: #e8f5ee; color: #2D6A4F; }
    .bk-status-pending { background: #fff8e1; color: #f39c12; }
    .bk-status-cancelled { background: #fdecea; color: #e74c3c; }
    .bk-status-failed { background: #fff3e0; color: #e67e22; }

    .bk-dates {
      display: flex; gap: 24px; margin: 12px 0;
      flex-wrap: wrap;
    }
    .bk-date-item { display: flex; flex-direction: column; }
    .bk-date-label { font-size: 0.72rem; color: #aaa; text-transform: uppercase; letter-spacing: 0.5px; }
    .bk-date-val { font-size: 0.92rem; font-weight: 600; color: #333; margin-top: 2px; }

    .bk-card-bottom {
      display: flex; align-items: center; justify-content: space-between;
      border-top: 1px solid #f5f5f5; padding-top: 14px; flex-wrap: wrap; gap: 10px;
    }
    .bk-price-info { display: flex; align-items: baseline; gap: 6px; }
    .bk-total-label { font-size: 0.78rem; color: #aaa; }
    .bk-total-price { font-size: 1.1rem; font-weight: 700; color: #2D6A4F; }
    .bk-nights { font-size: 0.78rem; color: #aaa; }

    .bk-action-area { display: flex; gap: 8px; align-items: center; }
    .bk-btn-cancel {
      padding: 7px 18px; border-radius: 8px; border: 1.5px solid #e74c3c;
      background: transparent; color: #e74c3c; font-size: 0.82rem;
      font-weight: 600; cursor: pointer; transition: all 0.2s;
    }
    .bk-btn-cancel:hover { background: #e74c3c; color: #fff; }
    .bk-btn-review {
      padding: 7px 18px; border-radius: 8px; border: none;
      background: linear-gradient(135deg, #2D6A4F, #40916C);
      color: #fff; font-size: 0.82rem; font-weight: 600;
      cursor: pointer; transition: opacity 0.2s;
    }
    .bk-btn-review:hover { opacity: 0.88; }
    .bk-refund-badge {
      padding: 5px 14px; background: #e3f0fb; color: #2980b9;
      border-radius: 20px; font-size: 0.75rem; font-weight: 600;
    }
    .bk-nights-badge {
      padding: 3px 10px; background: #f4f6f9; border-radius: 20px;
      font-size: 0.75rem; color: #888;
    }

    /* Empty state */
    .bk-empty {
      text-align: center; padding: 60px 20px;
      background: #fff; border-radius: 18px;
      box-shadow: 0 2px 14px rgba(0,0,0,0.05);
    }
    .bk-empty-icon { font-size: 64px; color: #d0e8da; margin-bottom: 16px; }
    .bk-empty-title { font-size: 1.1rem; font-weight: 700; color: #333; margin-bottom: 8px; }
    .bk-empty-sub { color: #aaa; font-size: 0.88rem; margin-bottom: 24px; }
    .bk-empty-btn {
      display: inline-block; padding: 11px 28px;
      background: linear-gradient(135deg, #2D6A4F, #40916C);
      color: #fff; border-radius: 10px; text-decoration: none;
      font-weight: 600; font-size: 0.9rem; transition: opacity 0.2s;
    }
    .bk-empty-btn:hover { opacity: 0.88; color: #fff; }

    /* Review modal */
    .review-modal-content { border: none; border-radius: 18px; overflow: hidden; }
    .review-modal-header {
      background: linear-gradient(135deg, #2D6A4F, #52B788);
      color: #fff; border: none; padding: 22px 24px;
    }
    .review-modal-header .btn-close { filter: brightness(0) invert(1); opacity: 0.8; }
    .star-select { display: flex; gap: 6px; margin-bottom: 4px; }
    .star-select label {
      font-size: 28px; cursor: pointer; color: #ddd; transition: color 0.15s;
    }
    .star-select input { display: none; }
    .star-select input:checked ~ label,
    .star-select label:hover,
    .star-select label:hover ~ label { color: #f39c12; }
    .star-select { flex-direction: row-reverse; justify-content: flex-end; }

    @media (max-width: 768px) {
      .bk-card { flex-direction: column; }
      .bk-card-img, .bk-card-img-placeholder { width: 100%; height: 160px; }
    }
  </style>
</head>
<body class="profile-page">

  <?php
    require('inc/header.php');
    if (!(isset($_SESSION['login']) && $_SESSION['login'] == true)) {
      redirect('index.php');
    }

    // User info
    $u_res   = select("SELECT * FROM `user_cred` WHERE `id`=? LIMIT 1", [$_SESSION['uId']], 's');
    $u_fetch = mysqli_fetch_assoc($u_res);

    // Booking stats
    $stats_res = select(
      "SELECT
        COUNT(*) as total,
        SUM(booking_status='booked') as confirmed,
        SUM(booking_status='cancelled') as cancelled
       FROM `booking_order` WHERE `user_id`=?",
      [$_SESSION['uId']], 's'
    );
    $stats = mysqli_fetch_assoc($stats_res);

    // Bookings with room image
    $query = "SELECT bo.*, bd.*, ri.image as room_image
              FROM `booking_order` bo
              JOIN `booking_details` bd ON bo.booking_id = bd.booking_id
              LEFT JOIN (
                SELECT room_id, image FROM `room_images` WHERE `thumb`=1
              ) ri ON bo.room_id = ri.room_id
              WHERE bo.user_id=?
              ORDER BY bo.booking_id DESC";
    $bookings_res = select($query, [$_SESSION['uId']], 's');
    $all_bookings = [];
    while ($row = mysqli_fetch_assoc($bookings_res)) {
      $all_bookings[] = $row;
    }
  ?>

  <div class="container py-2 pb-5">

    <!-- Breadcrumb -->
    <div class="profile-breadcrumb">
      <a href="index.php"><?php _e('home') ?></a>
      <span class="sep">›</span>
      <a href="profile.php"><?php _e('user_profile') ?></a>
      <span class="sep">›</span>
      <span><?php _e('booking_history') ?></span>
    </div>

    <div class="row g-4">

      <!-- ===== SIDEBAR ===== -->
      <div class="col-lg-3">
        <div class="profile-sidebar-card">
          <div class="profile-cover"></div>
          <div class="profile-avatar-wrap">
            <?php if ($u_fetch['profile'] == 'avatar-default.png'): ?>
              <div class="profile-avatar-icon"><i class="bi bi-person-fill"></i></div>
            <?php else: ?>
              <img src="<?php echo USERS_IMG_PATH . $u_fetch['profile'] ?>" class="profile-avatar-img" alt="">
            <?php endif; ?>
            <div class="profile-name"><?php echo htmlspecialchars($u_fetch['name']) ?></div>
            <div class="profile-email"><?php echo htmlspecialchars($u_fetch['email']) ?></div>
          </div>

          <!-- Stats -->
          <div class="sidebar-stats">
            <div class="stat-cell">
              <div class="stat-num"><?php echo (int)$stats['total'] ?></div>
              <div class="stat-label"><?php _e('total') ?></div>
            </div>
            <div class="stat-cell confirmed">
              <div class="stat-num"><?php echo (int)$stats['confirmed'] ?></div>
              <div class="stat-label"><?php _e('confirmed') ?></div>
            </div>
            <div class="stat-cell cancelled">
              <div class="stat-num"><?php echo (int)$stats['cancelled'] ?></div>
              <div class="stat-label"><?php _e('cancelled') ?></div>
            </div>
          </div>

          <!-- Nav -->
          <nav class="profile-sidebar-nav">
            <a class="profile-nav-item" href="profile.php">
              <i class="bi bi-person-fill"></i> <?php _e('user_profile') ?>
            </a>
            <a class="profile-nav-item active" href="bookings.php">
              <i class="bi bi-calendar-check-fill"></i> <?php _e('booking_history') ?>
            </a>
            <a class="profile-nav-item danger" href="logout.php">
              <i class="bi bi-box-arrow-right"></i> <?php _e('logout') ?>
            </a>
          </nav>
        </div>
      </div>

      <!-- ===== MAIN CONTENT ===== -->
      <div class="col-lg-9">

        <!-- Header banner -->
        <div class="bk-header-card">
          <div>
            <p class="bk-header-title"><i class="bi bi-calendar-check-fill me-2"></i><?php _e('booking_history_title') ?></p>
            <p class="bk-header-sub"><?php _e('manage_bookings_sub') ?></p>
          </div>
          <i class="bi bi-building bk-header-icon"></i>
        </div>

        <!-- Filter tabs -->
        <div class="bk-filter-tabs">
          <button class="bk-filter-btn active" onclick="filterBookings('all', this)"><?php _e('all') ?> (<?php echo (int)$stats['total'] ?>)</button>
          <button class="bk-filter-btn" onclick="filterBookings('booked', this)"><?php _e('status_booked') ?></button>
          <button class="bk-filter-btn" onclick="filterBookings('pending', this)"><?php _e('status_pending') ?></button>
          <button class="bk-filter-btn" onclick="filterBookings('cancelled', this)"><?php _e('status_cancelled') ?></button>
        </div>

        <!-- Booking list -->
        <div id="bookings-list">
          <?php if (empty($all_bookings)): ?>
            <div class="bk-empty">
              <div class="bk-empty-icon"><i class="bi bi-calendar-x"></i></div>
              <div class="bk-empty-title"><?php _e('no_bookings') ?></div>
              <div class="bk-empty-sub"><?php _e('no_bookings_sub') ?></div>
              <a href="rooms.php" class="bk-empty-btn"><i class="bi bi-search me-2"></i><?php _e('explore_rooms') ?></a>
            </div>
          <?php else: ?>
            <?php foreach ($all_bookings as $data):
              $checkin  = date('d/m/Y', strtotime($data['check_in']));
              $checkout = date('d/m/Y', strtotime($data['check_out']));
              $book_date = date('d/m/Y H:i', strtotime($data['datentime']));
              $nights   = (strtotime($data['check_out']) - strtotime($data['check_in'])) / 86400;
              $nights   = max(1, (int)$nights);

              $status = $data['booking_status'];
              $status_map = [
                'booked'          => ['label' => __('status_booked'), 'class' => 'bk-status-booked'],
                'pending'         => ['label' => __('status_pending'), 'class' => 'bk-status-pending'],
                'cancelled'       => ['label' => __('status_cancelled'),      'class' => 'bk-status-cancelled'],
                'payment failed'  => ['label' => __('status_failed'), 'class' => 'bk-status-failed'],
              ];
              $sinfo = $status_map[$status] ?? ['label' => $status, 'class' => 'bk-status-pending'];
            ?>
            <div class="bk-card" data-status="<?php echo htmlspecialchars($status) ?>">

              <!-- Room image -->
              <?php if ($data['room_image']): ?>
                <img src="<?php echo ROOMS_IMG_PATH . $data['room_image'] ?>" class="bk-card-img" alt="">
              <?php else: ?>
                <div class="bk-card-img-placeholder"><i class="bi bi-building"></i></div>
              <?php endif; ?>

              <!-- Body -->
              <div class="bk-card-body">
                <div>
                  <div class="bk-card-top">
                    <div>
                      <div class="bk-room-name"><?php echo htmlspecialchars($data['room_name']) ?></div>
                      <div class="bk-order-id"><i class="bi bi-hash"></i><?php echo htmlspecialchars($data['order_id']) ?></div>
                    </div>
                    <span class="bk-status-badge <?php echo $sinfo['class'] ?>"><?php echo $sinfo['label'] ?></span>
                  </div>

                  <div class="bk-dates">
                    <div class="bk-date-item">
                      <span class="bk-date-label"><i class="bi bi-box-arrow-in-right me-1"></i>Check-in</span>
                      <span class="bk-date-val"><?php echo $checkin ?></span>
                    </div>
                    <div class="bk-date-item">
                      <span class="bk-date-label"><i class="bi bi-box-arrow-right me-1"></i>Check-out</span>
                      <span class="bk-date-val"><?php echo $checkout ?></span>
                    </div>
                    <div class="bk-date-item">
                      <span class="bk-date-label"><i class="bi bi-calendar3 me-1"></i><?php _e('booking_date') ?></span>
                      <span class="bk-date-val"><?php echo $book_date ?></span>
                    </div>
                  </div>
                </div>

                <div class="bk-card-bottom">
                  <div class="bk-price-info">
                    <span class="bk-total-label"><?php _e('total_price') ?>:</span>
                    <span class="bk-total-price"><?php echo number_format($data['total_pay']) ?> <?php _e('vnd') ?></span>
                    <span class="bk-nights-badge"><?php echo $nights ?> <?php _e('night') ?></span>
                  </div>

                  <div class="bk-action-area">
                    <?php if ($status === 'booked'): ?>
                      <?php if ($data['arrival'] == 0): ?>
                        <button type="button" class="bk-btn-cancel"
                          onclick="cancelBooking(<?php echo $data['booking_id'] ?>)">
                          <i class="bi bi-x-circle me-1"></i><?php _e('cancel_booking') ?>
                        </button>
                      <?php elseif ($data['rate_review'] == 0): ?>
                        <button type="button" class="bk-btn-review"
                          onclick="openReview(<?php echo $data['booking_id'] ?>, <?php echo $data['room_id'] ?>)"
                          data-bs-toggle="modal" data-bs-target="#reviewModal">
                          <i class="bi bi-star-fill me-1"></i><?php _e('review') ?>
                        </button>
                      <?php endif; ?>
                    <?php elseif ($status === 'cancelled' && $data['refund'] == 0): ?>
                      <span class="bk-refund-badge"><i class="bi bi-arrow-clockwise me-1"></i><?php _e('refunding') ?></span>
                    <?php endif; ?>
                  </div>
                </div>
              </div>
            </div>
            <?php endforeach; ?>
          <?php endif; ?>
        </div>

      </div><!-- /col-lg-9 -->
    </div>
  </div>

  <!-- ===== REVIEW MODAL ===== -->
  <div class="modal fade" id="reviewModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content review-modal-content">
        <form id="review-form">

          <div class="modal-header review-modal-header">
            <div>
              <h5 class="modal-title fw-bold mb-1"><i class="bi bi-star-fill me-2"></i><?php _e('review_room') ?></h5>
              <p style="font-size:0.82rem;opacity:0.85;margin:0"><?php _e('share_experience') ?></p>
            </div>
            <button type="reset" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>

          <div class="modal-body p-4">
            <div class="mb-4">
              <label class="form-label fw-semibold mb-2" style="font-size:0.88rem"><?php _e('your_rating') ?></label>
              <div class="star-select">
                <input type="radio" name="rating" id="s5" value="5"><label for="s5"><i class="bi bi-star-fill"></i></label>
                <input type="radio" name="rating" id="s4" value="4"><label for="s4"><i class="bi bi-star-fill"></i></label>
                <input type="radio" name="rating" id="s3" value="3" checked><label for="s3"><i class="bi bi-star-fill"></i></label>
                <input type="radio" name="rating" id="s2" value="2"><label for="s2"><i class="bi bi-star-fill"></i></label>
                <input type="radio" name="rating" id="s1" value="1"><label for="s1"><i class="bi bi-star-fill"></i></label>
              </div>
            </div>
            <div class="mb-4">
              <label class="form-label fw-semibold mb-2" style="font-size:0.88rem"><?php _e('your_comment') ?></label>
              <textarea name="review" rows="4" required class="form-control shadow-none"
                style="border-radius:10px;border-color:#e0e0e0;font-size:0.9rem"
                placeholder="<?php echo __('comment_placeholder') ?>"></textarea>
            </div>
            <input type="hidden" name="booking_id">
            <input type="hidden" name="room_id">
            <button type="submit" class="pf-save-btn w-100" style="background:linear-gradient(135deg,#2D6A4F,#40916C);border:none;color:#fff;padding:12px;border-radius:10px;font-weight:600;cursor:pointer;">
              <i class="bi bi-send-fill me-2"></i><?php _e('submit_review') ?>
            </button>
          </div>

        </form>
      </div>
    </div>
  </div>

  <?php
    if (isset($_GET['cancel_status'])) {
      echo "<script>document.addEventListener('DOMContentLoaded',()=>alert('success','" . __('cancel_success') . "'));</script>";
    }
    if (isset($_GET['review_status'])) {
      echo "<script>document.addEventListener('DOMContentLoaded',()=>alert('success','" . __('review_thanks') . "'));</script>";
    }
  ?>

  <?php require('inc/footer.php'); ?>

  <script>
    // ===== Filter =====
    function filterBookings(status, btn) {
      document.querySelectorAll('.bk-filter-btn').forEach(b => b.classList.remove('active'));
      btn.classList.add('active');
      document.querySelectorAll('.bk-card').forEach(card => {
        if (status === 'all' || card.dataset.status === status) {
          card.style.display = 'flex';
        } else {
          card.style.display = 'none';
        }
      });
    }

    // ===== Cancel booking =====
    function cancelBooking(id) {
      if (!confirm('<?php _e("cancel_confirm") ?>')) return;

      fetch('ajax/cancel_booking.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: 'cancel_booking&id=' + id
      }).then(r => r.text()).then(res => {
        if (res == 1) {
          window.location.href = 'bookings.php?cancel_status=true';
        } else {
          alert('error', '<?php _e("cancel_failed") ?>');
        }
      });
    }

    // ===== Review =====
    const reviewForm = document.getElementById('review-form');

    function openReview(bid, rid) {
      reviewForm.elements['booking_id'].value = bid;
      reviewForm.elements['room_id'].value    = rid;
    }

    reviewForm.addEventListener('submit', function (e) {
      e.preventDefault();
      let data = new FormData();
      data.append('review_form', '');
      data.append('rating',     reviewForm.elements['rating'].value);
      data.append('review',     reviewForm.elements['review'].value);
      data.append('booking_id', reviewForm.elements['booking_id'].value);
      data.append('room_id',    reviewForm.elements['room_id'].value);

      fetch('ajax/review_room.php', { method: 'POST', body: data })
        .then(r => r.text()).then(res => {
          if (res == 1) {
            window.location.href = 'bookings.php?review_status=true';
          } else {
            bootstrap.Modal.getInstance(document.getElementById('reviewModal')).hide();
            alert('error', '<?php _e("review_failed") ?>');
          }
        });
    });
  </script>

</body>
</html>
