<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <?php require('inc/links.php'); ?>
  <title><?php echo $settings_r['site_title'] ?> - <?php _e('services') ?></title>
  <style>
    .service-hero {
      background: linear-gradient(135deg, #1a3c34 0%, #2D6A4F 50%, #40916C 100%);
      padding: 80px 0 60px;
      color: white;
    }
    .service-card {
      border-radius: 16px;
      overflow: hidden;
      transition: all 0.3s ease;
      border: none;
      box-shadow: 0 4px 15px rgba(0,0,0,0.08);
    }
    .service-card:hover {
      transform: translateY(-8px);
      box-shadow: 0 12px 30px rgba(45,106,79,0.2);
    }
    .service-icon-wrap {
      width: 70px;
      height: 70px;
      border-radius: 50%;
      background: linear-gradient(135deg, #2D6A4F, #40916C);
      display: flex;
      align-items: center;
      justify-content: center;
      margin: 0 auto 16px;
    }
    .service-icon-wrap i {
      font-size: 28px;
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
    .facility-card {
      border-left: 4px solid #2D6A4F;
      transition: all 0.3s;
    }
    .facility-card:hover {
      border-left-color: #40916C;
      transform: scale(1.02);
    }
    .highlight-box {
      background: linear-gradient(135deg, #f0faf4, #e8f5e9);
      border-radius: 16px;
      border: 1px solid #b7dfc8;
    }
  </style>
</head>
<body class="bg-light">

  <?php require('inc/header.php'); ?>

  <!-- Hero Section -->
  <div class="service-hero">
    <div class="container text-center">
      <span class="section-badge"><i class="bi bi-stars me-1"></i> <?php _e('premium_experience') ?></span>
      <h1 class="fw-bold display-5 mb-3"><?php _e('our_services') ?></h1>
      <p class="lead mb-0 opacity-75"><?php _e('services_hero_sub') ?></p>
    </div>
  </div>

  <!-- Dịch vụ nổi bật -->
  <div class="container my-5">
    <h2 class="fw-bold h-font text-center mb-2"><?php _e('featured_services') ?></h2>
    <div class="h-line bg-dark mb-5"></div>

    <div class="row g-4">

      <div class="col-lg-4 col-md-6">
        <div class="card service-card h-100 text-center p-4">
          <div class="service-icon-wrap">
            <i class="bi bi-water"></i>
          </div>
          <h5 class="fw-bold mb-2"><?php _e('svc_cruise') ?></h5>
          <p class="text-muted"><?php _e('svc_cruise_desc') ?></p>
          <div class="mt-auto pt-3">
            <span class="badge bg-success-subtle text-success rounded-pill px-3 py-2">
              <i class="bi bi-clock me-1"></i> <?php _e('svc_cruise_time') ?>
            </span>
          </div>
        </div>
      </div>

      <div class="col-lg-4 col-md-6">
        <div class="card service-card h-100 text-center p-4">
          <div class="service-icon-wrap">
            <i class="bi bi-flower2"></i>
          </div>
          <h5 class="fw-bold mb-2"><?php _e('svc_spa') ?></h5>
          <p class="text-muted"><?php _e('svc_spa_desc') ?></p>
          <div class="mt-auto pt-3">
            <span class="badge bg-success-subtle text-success rounded-pill px-3 py-2">
              <i class="bi bi-calendar-check me-1"></i> <?php _e('svc_spa_time') ?>
            </span>
          </div>
        </div>
      </div>

      <div class="col-lg-4 col-md-6">
        <div class="card service-card h-100 text-center p-4">
          <div class="service-icon-wrap">
            <i class="bi bi-cup-hot-fill"></i>
          </div>
          <h5 class="fw-bold mb-2"><?php _e('svc_restaurant') ?></h5>
          <p class="text-muted"><?php _e('svc_restaurant_desc') ?></p>
          <div class="mt-auto pt-3">
            <span class="badge bg-success-subtle text-success rounded-pill px-3 py-2">
              <i class="bi bi-clock me-1"></i> <?php _e('svc_restaurant_time') ?>
            </span>
          </div>
        </div>
      </div>

      <div class="col-lg-4 col-md-6">
        <div class="card service-card h-100 text-center p-4">
          <div class="service-icon-wrap">
            <i class="bi bi-car-front-fill"></i>
          </div>
          <h5 class="fw-bold mb-2"><?php _e('svc_transfer') ?></h5>
          <p class="text-muted"><?php _e('svc_transfer_desc') ?></p>
          <div class="mt-auto pt-3">
            <span class="badge bg-success-subtle text-success rounded-pill px-3 py-2">
              <i class="bi bi-telephone me-1"></i> <?php _e('svc_transfer_time') ?>
            </span>
          </div>
        </div>
      </div>

      <div class="col-lg-4 col-md-6">
        <div class="card service-card h-100 text-center p-4">
          <div class="service-icon-wrap">
            <i class="bi bi-bicycle"></i>
          </div>
          <h5 class="fw-bold mb-2"><?php _e('svc_rental') ?></h5>
          <p class="text-muted"><?php _e('svc_rental_desc') ?></p>
          <div class="mt-auto pt-3">
            <span class="badge bg-success-subtle text-success rounded-pill px-3 py-2">
              <i class="bi bi-calendar me-1"></i> <?php _e('svc_rental_time') ?>
            </span>
          </div>
        </div>
      </div>

      <div class="col-lg-4 col-md-6">
        <div class="card service-card h-100 text-center p-4">
          <div class="service-icon-wrap">
            <i class="bi bi-people-fill"></i>
          </div>
          <h5 class="fw-bold mb-2"><?php _e('svc_guide') ?></h5>
          <p class="text-muted"><?php _e('svc_guide_desc') ?></p>
          <div class="mt-auto pt-3">
            <span class="badge bg-success-subtle text-success rounded-pill px-3 py-2">
              <i class="bi bi-translate me-1"></i> <?php _e('svc_guide_time') ?>
            </span>
          </div>
        </div>
      </div>

      <div class="col-lg-4 col-md-6">
        <div class="card service-card h-100 text-center p-4">
          <div class="service-icon-wrap">
            <i class="bi bi-laptop-fill"></i>
          </div>
          <h5 class="fw-bold mb-2"><?php _e('svc_meeting') ?></h5>
          <p class="text-muted"><?php _e('svc_meeting_desc') ?></p>
          <div class="mt-auto pt-3">
            <span class="badge bg-success-subtle text-success rounded-pill px-3 py-2">
              <i class="bi bi-headset me-1"></i> <?php _e('svc_meeting_time') ?>
            </span>
          </div>
        </div>
      </div>

      <div class="col-lg-4 col-md-6">
        <div class="card service-card h-100 text-center p-4">
          <div class="service-icon-wrap">
            <i class="bi bi-droplet-fill"></i>
          </div>
          <h5 class="fw-bold mb-2"><?php _e('svc_pool') ?></h5>
          <p class="text-muted"><?php _e('svc_pool_desc') ?></p>
          <div class="mt-auto pt-3">
            <span class="badge bg-success-subtle text-success rounded-pill px-3 py-2">
              <i class="bi bi-sun me-1"></i> <?php _e('svc_pool_time') ?>
            </span>
          </div>
        </div>
      </div>

      <div class="col-lg-4 col-md-6">
        <div class="card service-card h-100 text-center p-4">
          <div class="service-icon-wrap">
            <i class="bi bi-bag-heart-fill"></i>
          </div>
          <h5 class="fw-bold mb-2"><?php _e('svc_souvenir') ?></h5>
          <p class="text-muted"><?php _e('svc_souvenir_desc') ?></p>
          <div class="mt-auto pt-3">
            <span class="badge bg-success-subtle text-success rounded-pill px-3 py-2">
              <i class="bi bi-shop me-1"></i> <?php _e('svc_souvenir_time') ?>
            </span>
          </div>
        </div>
      </div>

    </div>
  </div>

  <!-- Cam kết chất lượng -->
  <div class="container my-5">
    <div class="highlight-box p-5 text-center">
      <i class="bi bi-patch-check-fill text-success fs-1 mb-3 d-block"></i>
      <h3 class="fw-bold h-font mb-3"><?php _e('our_commitment') ?></h3>
      <div class="row g-4 mt-2">
        <div class="col-md-3">
          <i class="bi bi-shield-check fs-2 text-success mb-2 d-block"></i>
          <h6 class="fw-bold"><?php _e('commit_safety') ?></h6>
          <p class="text-muted small"><?php _e('commit_safety_desc') ?></p>
        </div>
        <div class="col-md-3">
          <i class="bi bi-star-fill fs-2 text-success mb-2 d-block"></i>
          <h6 class="fw-bold"><?php _e('commit_quality') ?></h6>
          <p class="text-muted small"><?php _e('commit_quality_desc') ?></p>
        </div>
        <div class="col-md-3">
          <i class="bi bi-headset fs-2 text-success mb-2 d-block"></i>
          <h6 class="fw-bold"><?php _e('commit_support') ?></h6>
          <p class="text-muted small"><?php _e('commit_support_desc') ?></p>
        </div>
        <div class="col-md-3">
          <i class="bi bi-currency-dollar fs-2 text-success mb-2 d-block"></i>
          <h6 class="fw-bold"><?php _e('commit_price') ?></h6>
          <p class="text-muted small"><?php _e('commit_price_desc') ?></p>
        </div>
      </div>
    </div>
  </div>

  <?php require('inc/footer.php'); ?>

</body>
</html>
