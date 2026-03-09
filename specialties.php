<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <?php require('inc/links.php'); ?>
  <title><?php echo $settings_r['site_title'] ?> - <?php _e('specialties') ?></title>
  <style>
    .specialty-hero {
      background: linear-gradient(135deg, #7b3f00 0%, #c05e1b 50%, #e07b39 100%);
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
    .food-card {
      border-radius: 16px;
      overflow: hidden;
      transition: all 0.35s ease;
      border: none;
      box-shadow: 0 4px 15px rgba(0,0,0,0.08);
    }
    .food-card:hover {
      transform: translateY(-8px);
      box-shadow: 0 15px 35px rgba(192,94,27,0.2);
    }
    .food-card .card-img-top {
      height: 230px;
      object-fit: cover;
    }
    .food-tag {
      background: linear-gradient(135deg, #c05e1b, #e07b39);
      color: white;
      border-radius: 20px;
      padding: 4px 14px;
      font-size: 13px;
      display: inline-block;
      margin-bottom: 8px;
    }
    .food-img-placeholder {
      height: 230px;
      background: linear-gradient(135deg, #f5deb3, #ffe4b5);
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 80px;
    }
    .tip-box {
      background: linear-gradient(135deg, #fff8f0, #ffecd8);
      border-left: 4px solid #c05e1b;
      border-radius: 8px;
    }
    .where-to-eat-card {
      border-radius: 12px;
      border-left: 4px solid #c05e1b;
      transition: all 0.3s;
    }
    .where-to-eat-card:hover {
      transform: translateX(4px);
    }
    .category-tab {
      background: #fff;
      border: 2px solid #c05e1b;
      color: #c05e1b;
      border-radius: 30px;
      padding: 8px 20px;
      cursor: pointer;
      transition: all 0.2s;
      font-weight: 500;
    }
    .category-tab.active, .category-tab:hover {
      background: #c05e1b;
      color: white;
    }
  </style>
</head>
<body class="bg-light">

  <?php require('inc/header.php'); ?>

  <!-- Hero -->
  <div class="specialty-hero">
    <div class="container text-center">
      <span class="section-badge"><i class="bi bi-egg-fried me-1"></i> <?php _e('specialty_cuisine') ?></span>
      <h1 class="fw-bold display-5 mb-3"><?php _e('halong_specialties') ?></h1>
      <p class="lead mb-0 opacity-75"><?php _e('specialties_hero_sub') ?></p>
    </div>
  </div>

  <!-- Giới thiệu -->
  <div class="container my-5">
    <div class="row align-items-center g-4">
      <div class="col-lg-6">
        <h2 class="fw-bold h-font mb-3"><?php _e('ne_sea_flavors') ?></h2>
        <p class="text-muted lh-lg"><?php _e('spec_intro_p1') ?></p>
        <p class="text-muted lh-lg"><?php _e('spec_intro_p2') ?></p>
        <div class="row g-3 mt-2">
          <div class="col-6">
            <div class="d-flex align-items-center">
              <i class="bi bi-check-circle-fill text-warning me-2 fs-5"></i>
              <span class="fw-semibold"><?php _e('fresh_seafood') ?></span>
            </div>
          </div>
          <div class="col-6">
            <div class="d-flex align-items-center">
              <i class="bi bi-check-circle-fill text-warning me-2 fs-5"></i>
              <span class="fw-semibold"><?php _e('regional_specialties') ?></span>
            </div>
          </div>
          <div class="col-6">
            <div class="d-flex align-items-center">
              <i class="bi bi-check-circle-fill text-warning me-2 fs-5"></i>
              <span class="fw-semibold"><?php _e('diverse_rich') ?></span>
            </div>
          </div>
          <div class="col-6">
            <div class="d-flex align-items-center">
              <i class="bi bi-check-circle-fill text-warning me-2 fs-5"></i>
              <span class="fw-semibold"><?php _e('reasonable_price') ?></span>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-6">
        <div class="row g-3">
          <div class="col-6">
            <div class="bg-warning-subtle rounded-3 p-4 text-center">
              <div class="fs-1 mb-2">🦑</div>
              <h6 class="fw-bold"><?php _e('spec_squid_cake') ?></h6>
              <p class="small text-muted mb-0"><?php _e('spec_squid_cake_short') ?></p>
            </div>
          </div>
          <div class="col-6">
            <div class="bg-danger-subtle rounded-3 p-4 text-center">
              <div class="fs-1 mb-2">🦪</div>
              <h6 class="fw-bold"><?php _e('spec_milk_oyster') ?></h6>
              <p class="small text-muted mb-0"><?php _e('spec_milk_oyster_short') ?></p>
            </div>
          </div>
          <div class="col-6">
            <div class="bg-info-subtle rounded-3 p-4 text-center">
              <div class="fs-1 mb-2">🍜</div>
              <h6 class="fw-bold"><?php _e('spec_nodding_cake') ?></h6>
              <p class="small text-muted mb-0"><?php _e('spec_nodding_cake_short') ?></p>
            </div>
          </div>
          <div class="col-6">
            <div class="bg-success-subtle rounded-3 p-4 text-center">
              <div class="fs-1 mb-2">🦐</div>
              <h6 class="fw-bold"><?php _e('spec_mantis_shrimp') ?></h6>
              <p class="small text-muted mb-0"><?php _e('spec_mantis_shrimp_short') ?></p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Các đặc sản chính -->
  <div class="bg-white py-5">
    <div class="container">
      <h2 class="fw-bold h-font text-center mb-2"><?php _e('must_try') ?></h2>
      <div class="h-line mb-2" style="height:3px;width:80px;background:#c05e1b;margin:0 auto;"></div>
      <p class="text-center text-muted mb-5"><?php _e('must_try_sub') ?></p>

      <div class="row g-4">

        <!-- Cha Muc -->
        <div class="col-lg-4 col-md-6">
          <div class="card food-card h-100">
            <div class="food-img-placeholder">🦑</div>
            <div class="card-body p-4">
              <span class="food-tag"><?php _e('spec_tag_no1') ?></span>
              <h5 class="fw-bold"><?php _e('spec_squid_cake_title') ?></h5>
              <p class="text-muted"><?php _e('spec_squid_cake_desc') ?></p>
              <div class="d-flex align-items-center mt-3">
                <i class="bi bi-geo-alt-fill text-warning me-2"></i>
                <small class="text-muted"><?php _e('spec_squid_cake_where') ?></small>
              </div>
              <div class="d-flex align-items-center mt-1">
                <i class="bi bi-currency-dollar text-warning me-2"></i>
                <small class="text-muted"><?php _e('spec_squid_cake_price') ?></small>
              </div>
            </div>
          </div>
        </div>

        <!-- Hau Sua -->
        <div class="col-lg-4 col-md-6">
          <div class="card food-card h-100">
            <div class="food-img-placeholder">🦪</div>
            <div class="card-body p-4">
              <span class="food-tag"><?php _e('spec_tag_fresh') ?></span>
              <h5 class="fw-bold"><?php _e('spec_oyster_title') ?></h5>
              <p class="text-muted"><?php _e('spec_oyster_desc') ?></p>
              <div class="d-flex align-items-center mt-3">
                <i class="bi bi-geo-alt-fill text-warning me-2"></i>
                <small class="text-muted"><?php _e('spec_oyster_where') ?></small>
              </div>
              <div class="d-flex align-items-center mt-1">
                <i class="bi bi-currency-dollar text-warning me-2"></i>
                <small class="text-muted"><?php _e('spec_oyster_price') ?></small>
              </div>
            </div>
          </div>
        </div>

        <!-- Sa Sung -->
        <div class="col-lg-4 col-md-6">
          <div class="card food-card h-100">
            <div class="food-img-placeholder">🐛</div>
            <div class="card-body p-4">
              <span class="food-tag"><?php _e('spec_tag_special') ?></span>
              <h5 class="fw-bold"><?php _e('spec_sandworm_title') ?></h5>
              <p class="text-muted"><?php _e('spec_sandworm_desc') ?></p>
              <div class="d-flex align-items-center mt-3">
                <i class="bi bi-geo-alt-fill text-warning me-2"></i>
                <small class="text-muted"><?php _e('spec_sandworm_where') ?></small>
              </div>
              <div class="d-flex align-items-center mt-1">
                <i class="bi bi-currency-dollar text-warning me-2"></i>
                <small class="text-muted"><?php _e('spec_sandworm_price') ?></small>
              </div>
            </div>
          </div>
        </div>

        <!-- Be Be -->
        <div class="col-lg-4 col-md-6">
          <div class="card food-card h-100">
            <div class="food-img-placeholder">🦐</div>
            <div class="card-body p-4">
              <span class="food-tag"><?php _e('spec_tag_popular') ?></span>
              <h5 class="fw-bold"><?php _e('spec_mantis_title') ?></h5>
              <p class="text-muted"><?php _e('spec_mantis_desc') ?></p>
              <div class="d-flex align-items-center mt-3">
                <i class="bi bi-geo-alt-fill text-warning me-2"></i>
                <small class="text-muted"><?php _e('spec_mantis_where') ?></small>
              </div>
              <div class="d-flex align-items-center mt-1">
                <i class="bi bi-currency-dollar text-warning me-2"></i>
                <small class="text-muted"><?php _e('spec_mantis_price') ?></small>
              </div>
            </div>
          </div>
        </div>

        <!-- Ngan -->
        <div class="col-lg-4 col-md-6">
          <div class="card food-card h-100">
            <div class="food-img-placeholder">🐚</div>
            <div class="card-body p-4">
              <span class="food-tag"><?php _e('spec_tag_quangninh') ?></span>
              <h5 class="fw-bold"><?php _e('spec_ngan_title') ?></h5>
              <p class="text-muted"><?php _e('spec_ngan_desc') ?></p>
              <div class="d-flex align-items-center mt-3">
                <i class="bi bi-geo-alt-fill text-warning me-2"></i>
                <small class="text-muted"><?php _e('spec_ngan_where') ?></small>
              </div>
              <div class="d-flex align-items-center mt-1">
                <i class="bi bi-currency-dollar text-warning me-2"></i>
                <small class="text-muted"><?php _e('spec_ngan_price') ?></small>
              </div>
            </div>
          </div>
        </div>

        <!-- Banh Gat Gu -->
        <div class="col-lg-4 col-md-6">
          <div class="card food-card h-100">
            <div class="food-img-placeholder">🍜</div>
            <div class="card-body p-4">
              <span class="food-tag"><?php _e('spec_tag_rustic') ?></span>
              <h5 class="fw-bold"><?php _e('spec_nodding_title') ?></h5>
              <p class="text-muted"><?php _e('spec_nodding_desc') ?></p>
              <div class="d-flex align-items-center mt-3">
                <i class="bi bi-geo-alt-fill text-warning me-2"></i>
                <small class="text-muted"><?php _e('spec_nodding_where') ?></small>
              </div>
              <div class="d-flex align-items-center mt-1">
                <i class="bi bi-currency-dollar text-warning me-2"></i>
                <small class="text-muted"><?php _e('spec_nodding_price') ?></small>
              </div>
            </div>
          </div>
        </div>

        <!-- Ruoc Ha Long -->
        <div class="col-lg-4 col-md-6">
          <div class="card food-card h-100">
            <div class="food-img-placeholder">🧂</div>
            <div class="card-body p-4">
              <span class="food-tag"><?php _e('spec_tag_souvenir') ?></span>
              <h5 class="fw-bold"><?php _e('spec_shrimp_paste_title') ?></h5>
              <p class="text-muted"><?php _e('spec_shrimp_paste_desc') ?></p>
              <div class="d-flex align-items-center mt-3">
                <i class="bi bi-geo-alt-fill text-warning me-2"></i>
                <small class="text-muted"><?php _e('spec_shrimp_paste_where') ?></small>
              </div>
              <div class="d-flex align-items-center mt-1">
                <i class="bi bi-currency-dollar text-warning me-2"></i>
                <small class="text-muted"><?php _e('spec_shrimp_paste_price') ?></small>
              </div>
            </div>
          </div>
        </div>

        <!-- Sam Bien -->
        <div class="col-lg-4 col-md-6">
          <div class="card food-card h-100">
            <div class="food-img-placeholder">🦀</div>
            <div class="card-body p-4">
              <span class="food-tag"><?php _e('spec_tag_rare') ?></span>
              <h5 class="fw-bold"><?php _e('spec_horseshoe_title') ?></h5>
              <p class="text-muted"><?php _e('spec_horseshoe_desc') ?></p>
              <div class="d-flex align-items-center mt-3">
                <i class="bi bi-geo-alt-fill text-warning me-2"></i>
                <small class="text-muted"><?php _e('spec_horseshoe_where') ?></small>
              </div>
              <div class="d-flex align-items-center mt-1">
                <i class="bi bi-currency-dollar text-warning me-2"></i>
                <small class="text-muted"><?php _e('spec_horseshoe_price') ?></small>
              </div>
            </div>
          </div>
        </div>

        <!-- Nem Chua -->
        <div class="col-lg-4 col-md-6">
          <div class="card food-card h-100">
            <div class="food-img-placeholder">🥘</div>
            <div class="card-body p-4">
              <span class="food-tag"><?php _e('spec_tag_snack') ?></span>
              <h5 class="fw-bold"><?php _e('spec_nemchua_title') ?></h5>
              <p class="text-muted"><?php _e('spec_nemchua_desc') ?></p>
              <div class="d-flex align-items-center mt-3">
                <i class="bi bi-geo-alt-fill text-warning me-2"></i>
                <small class="text-muted"><?php _e('spec_nemchua_where') ?></small>
              </div>
              <div class="d-flex align-items-center mt-1">
                <i class="bi bi-currency-dollar text-warning me-2"></i>
                <small class="text-muted"><?php _e('spec_nemchua_price') ?></small>
              </div>
            </div>
          </div>
        </div>

      </div>
    </div>
  </div>

  <!-- Địa điểm ăn uống nổi tiếng -->
  <div class="container my-5">
    <h2 class="fw-bold h-font text-center mb-2"><?php _e('famous_places') ?></h2>
    <div class="h-line mb-2" style="height:3px;width:80px;background:#c05e1b;margin:0 auto;"></div>
    <p class="text-center text-muted mb-5"><?php _e('famous_places_sub') ?></p>

    <div class="row g-4">
      <div class="col-lg-6">
        <div class="card where-to-eat-card p-4 h-100">
          <div class="d-flex align-items-start">
            <div class="fs-2 me-3">🏪</div>
            <div>
              <h5 class="fw-bold mb-1"><?php _e('spec_place_market_title') ?></h5>
              <p class="text-muted mb-2"><?php _e('spec_place_market_desc') ?></p>
              <span class="badge bg-warning-subtle text-warning"><?php _e('spec_place_market_hours') ?></span>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-6">
        <div class="card where-to-eat-card p-4 h-100">
          <div class="d-flex align-items-start">
            <div class="fs-2 me-3">🌃</div>
            <div>
              <h5 class="fw-bold mb-1"><?php _e('spec_place_nightmarket_title') ?></h5>
              <p class="text-muted mb-2"><?php _e('spec_place_nightmarket_desc') ?></p>
              <span class="badge bg-warning-subtle text-warning"><?php _e('spec_place_nightmarket_hours') ?></span>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-6">
        <div class="card where-to-eat-card p-4 h-100">
          <div class="d-flex align-items-start">
            <div class="fs-2 me-3">🍽️</div>
            <div>
              <h5 class="fw-bold mb-1"><?php _e('spec_place_baichay_title') ?></h5>
              <p class="text-muted mb-2"><?php _e('spec_place_baichay_desc') ?></p>
              <span class="badge bg-warning-subtle text-warning"><?php _e('spec_place_baichay_badge') ?></span>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-6">
        <div class="card where-to-eat-card p-4 h-100">
          <div class="d-flex align-items-start">
            <div class="fs-2 me-3">⛵</div>
            <div>
              <h5 class="fw-bold mb-1"><?php _e('spec_place_cruise_title') ?></h5>
              <p class="text-muted mb-2"><?php _e('spec_place_cruise_desc') ?></p>
              <span class="badge bg-warning-subtle text-warning"><?php _e('spec_place_cruise_badge') ?></span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Mẹo khi mua đặc sản -->
  <div class="container mb-5">
    <div class="tip-box p-4">
      <h5 class="fw-bold mb-3"><i class="bi bi-lightbulb-fill text-warning me-2"></i><?php _e('buying_tips') ?></h5>
      <div class="row g-3">
        <div class="col-md-6">
          <div class="d-flex">
            <i class="bi bi-1-circle-fill text-warning me-3 mt-1 flex-shrink-0"></i>
            <p class="mb-0 text-muted"><?php _e('spec_tip_1') ?></p>
          </div>
        </div>
        <div class="col-md-6">
          <div class="d-flex">
            <i class="bi bi-2-circle-fill text-warning me-3 mt-1 flex-shrink-0"></i>
            <p class="mb-0 text-muted"><?php _e('spec_tip_2') ?></p>
          </div>
        </div>
        <div class="col-md-6">
          <div class="d-flex">
            <i class="bi bi-3-circle-fill text-warning me-3 mt-1 flex-shrink-0"></i>
            <p class="mb-0 text-muted"><?php _e('spec_tip_3') ?></p>
          </div>
        </div>
        <div class="col-md-6">
          <div class="d-flex">
            <i class="bi bi-4-circle-fill text-warning me-3 mt-1 flex-shrink-0"></i>
            <p class="mb-0 text-muted"><?php _e('spec_tip_4') ?></p>
          </div>
        </div>
      </div>
    </div>
  </div>

  <?php require('inc/footer.php'); ?>

</body>
</html>
