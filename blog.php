<?php require('inc/links.php'); ?>
<!DOCTYPE html>
<html lang="<?php echo current_lang() ?>">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php echo $settings_r['site_title'] ?> - <?php _e('blog_title') ?></title>
  <style>
    .blog-hero {
      background: linear-gradient(135deg, #0a2342 0%, #1a4480 50%, #2563b0 100%);
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
    .article-card {
      border-radius: 16px;
      overflow: hidden;
      border: none;
      box-shadow: 0 4px 15px rgba(0,0,0,0.08);
      transition: all 0.35s ease;
    }
    .article-card:hover {
      transform: translateY(-6px);
      box-shadow: 0 15px 35px rgba(26,68,128,0.15);
    }
    .article-img {
      height: 220px;
      object-fit: cover;
      background: linear-gradient(135deg, #c5d8f5, #a8c4e8);
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 70px;
    }
    .article-tag {
      display: inline-block;
      padding: 4px 12px;
      border-radius: 20px;
      font-size: 12px;
      font-weight: 600;
    }
    .tag-guide { background: #e8f4f8; color: #1a4480; }
    .tag-attraction { background: #e8f8e8; color: #1a6628; }
    .tag-food { background: #fff3e0; color: #b45309; }
    .tag-tip { background: #fce8e8; color: #c62828; }
    .tag-adventure { background: #ede8fd; color: #5c35b5; }
    .tag-culture { background: #fce8f5; color: #9c2780; }
    .featured-article {
      border-radius: 20px;
      overflow: hidden;
      box-shadow: 0 8px 30px rgba(0,0,0,0.12);
    }
    .featured-img {
      height: 420px;
      background: linear-gradient(135deg, #0a2342, #1a4480);
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 120px;
    }
    .sidebar-card {
      border-radius: 12px;
      border: none;
      box-shadow: 0 4px 15px rgba(0,0,0,0.06);
    }
    .sidebar-item {
      border-bottom: 1px solid #f0f0f0;
      transition: all 0.2s;
    }
    .sidebar-item:hover {
      background: #f8f9ff;
      padding-left: 8px !important;
    }
    .sidebar-item:last-child {
      border-bottom: none;
    }
    .article-full {
      display: none;
    }
    .article-full.show {
      display: block;
    }
    .read-more-btn {
      color: #1a4480;
      font-weight: 600;
      cursor: pointer;
      border: none;
      background: none;
      padding: 0;
      text-decoration: underline;
    }
    .article-detail-overlay {
      display: none;
      position: fixed;
      top: 0; left: 0; right: 0; bottom: 0;
      background: rgba(0,0,0,0.6);
      z-index: 9000;
      overflow-y: auto;
    }
    .article-detail-overlay.show {
      display: flex;
      align-items: flex-start;
      justify-content: center;
      padding: 40px 16px;
    }
    .article-detail-box {
      background: white;
      border-radius: 20px;
      max-width: 800px;
      width: 100%;
      padding: 40px;
      position: relative;
    }
    .close-detail {
      position: absolute;
      top: 20px;
      right: 20px;
      background: #f0f0f0;
      border: none;
      border-radius: 50%;
      width: 36px;
      height: 36px;
      cursor: pointer;
      font-size: 18px;
      display: flex;
      align-items: center;
      justify-content: center;
    }
    .season-badge {
      border-radius: 8px;
      padding: 12px 16px;
      margin-bottom: 8px;
    }
    .faq-item {
      border-radius: 12px;
      border: 1px solid #e9ecef;
      margin-bottom: 10px;
      overflow: hidden;
    }
    .faq-question {
      background: #f8f9ff;
      padding: 16px 20px;
      cursor: pointer;
      font-weight: 600;
      display: flex;
      justify-content: space-between;
      align-items: center;
    }
    .faq-answer {
      padding: 16px 20px;
      display: none;
      color: #666;
      line-height: 1.7;
    }
    .faq-answer.show {
      display: block;
    }
  </style>
</head>
<body class="bg-light">

  <?php require('inc/header.php'); ?>

  <!-- Hero -->
  <div class="blog-hero">
    <div class="container text-center">
      <span class="section-badge"><i class="bi bi-journal-richtext me-1"></i> <?php _e('blog_hero_badge') ?></span>
      <h1 class="fw-bold display-5 mb-3"><?php _e('blog_hero_title') ?></h1>
      <p class="lead mb-4 opacity-75"><?php _e('blog_hero_sub') ?></p>
      <div class="row justify-content-center g-3">
        <div class="col-auto">
          <span class="badge bg-white text-dark px-3 py-2 rounded-pill">
            <i class="bi bi-compass me-1 text-primary"></i> <?php _e('blog_tag_attractions') ?>
          </span>
        </div>
        <div class="col-auto">
          <span class="badge bg-white text-dark px-3 py-2 rounded-pill">
            <i class="bi bi-egg-fried me-1 text-warning"></i> <?php _e('blog_tag_cuisine') ?>
          </span>
        </div>
        <div class="col-auto">
          <span class="badge bg-white text-dark px-3 py-2 rounded-pill">
            <i class="bi bi-lightbulb me-1 text-danger"></i> <?php _e('blog_tag_tips') ?>
          </span>
        </div>
        <div class="col-auto">
          <span class="badge bg-white text-dark px-3 py-2 rounded-pill">
            <i class="bi bi-calendar-event me-1 text-success"></i> <?php _e('blog_tag_itinerary') ?>
          </span>
        </div>
      </div>
    </div>
  </div>

  <!-- Bài viết nổi bật -->
  <div class="container my-5">

    <div class="row g-4">

      <!-- Main content -->
      <div class="col-lg-8">

        <!-- Featured article 1 -->
        <div class="featured-article mb-5" id="article-1">
          <div class="featured-img">🌊</div>
          <div class="card border-0 rounded-0 rounded-bottom p-4">
            <div class="mb-2">
              <span class="article-tag tag-guide"><?php _e('blog_a1_tag') ?></span>
              <span class="text-muted small ms-2"><i class="bi bi-calendar3 me-1"></i><?php _e('blog_a1_updated') ?></span>
              <span class="text-muted small ms-2"><i class="bi bi-clock me-1"></i><?php _e('blog_a1_read_time') ?></span>
            </div>
            <h2 class="fw-bold h-font"><?php _e('blog_a1_title') ?></h2>
            <p class="text-muted lh-lg"><?php _e('blog_a1_desc') ?></p>

            <!-- Full content -->
            <div id="full-1" style="display:none">
              <hr>
              <h4 class="fw-bold mt-3">🗺️ <?php _e('blog_a1_overview') ?></h4>
              <p class="text-muted lh-lg"><?php _e('blog_a1_overview_desc') ?></p>

              <h4 class="fw-bold mt-4">📍 <?php _e('blog_a1_attractions') ?></h4>
              <div class="row g-3 mb-3">
                <div class="col-md-6">
                  <div class="bg-light rounded-3 p-3">
                    <h6 class="fw-bold"><i class="bi bi-geo-alt-fill text-primary me-2"></i><?php _e('blog_a1_sung_sot') ?></h6>
                    <p class="small text-muted mb-0"><?php _e('blog_a1_sung_sot_desc') ?></p>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="bg-light rounded-3 p-3">
                    <h6 class="fw-bold"><i class="bi bi-geo-alt-fill text-primary me-2"></i><?php _e('blog_a1_titop') ?></h6>
                    <p class="small text-muted mb-0"><?php _e('blog_a1_titop_desc') ?></p>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="bg-light rounded-3 p-3">
                    <h6 class="fw-bold"><i class="bi bi-geo-alt-fill text-primary me-2"></i><?php _e('blog_a1_cuavan') ?></h6>
                    <p class="small text-muted mb-0"><?php _e('blog_a1_cuavan_desc') ?></p>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="bg-light rounded-3 p-3">
                    <h6 class="fw-bold"><i class="bi bi-geo-alt-fill text-primary me-2"></i><?php _e('blog_a1_thiencung') ?></h6>
                    <p class="small text-muted mb-0"><?php _e('blog_a1_thiencung_desc') ?></p>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="bg-light rounded-3 p-3">
                    <h6 class="fw-bold"><i class="bi bi-geo-alt-fill text-primary me-2"></i><?php _e('blog_a1_quanlan') ?></h6>
                    <p class="small text-muted mb-0"><?php _e('blog_a1_quanlan_desc') ?></p>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="bg-light rounded-3 p-3">
                    <h6 class="fw-bold"><i class="bi bi-geo-alt-fill text-primary me-2"></i><?php _e('blog_a1_tuanchau') ?></h6>
                    <p class="small text-muted mb-0"><?php _e('blog_a1_tuanchau_desc') ?></p>
                  </div>
                </div>
              </div>

              <h4 class="fw-bold mt-4">🎯 <?php _e('blog_a1_experience') ?></h4>
              <ul class="text-muted lh-lg">
                <li class="mb-2"><?php _e('blog_a1_tip1') ?></li>
                <li class="mb-2"><?php _e('blog_a1_tip2') ?></li>
                <li class="mb-2"><?php _e('blog_a1_tip3') ?></li>
                <li class="mb-2"><?php _e('blog_a1_tip4') ?></li>
                <li><?php _e('blog_a1_tip5') ?></li>
              </ul>
            </div>

            <button class="read-more-btn mt-2" onclick="toggleArticle('full-1', this)">
              <?php _e('blog_read_full') ?> <i class="bi bi-chevron-down"></i>
            </button>
          </div>
        </div>

        <!-- Article grid -->
        <h3 class="fw-bold h-font mb-4"><?php _e('blog_latest') ?></h3>
        <div class="row g-4">

          <!-- Article 2 -->
          <div class="col-md-6">
            <div class="card article-card h-100">
              <div class="article-img">🗓️</div>
              <div class="card-body p-4">
                <span class="article-tag tag-tip"><?php _e('blog_a2_tag') ?></span>
                <h5 class="fw-bold mt-2"><?php _e('blog_a2_title') ?></h5>
                <p class="text-muted small"><?php _e('blog_a2_desc') ?></p>

                <div id="full-2" style="display:none">
                  <hr>
                  <div class="season-badge bg-success-subtle mb-2">
                    <strong class="text-success">🌸 <?php _e('blog_a2_spring') ?></strong>
                    <p class="small mb-0 mt-1 text-muted"><?php _e('blog_a2_spring_desc') ?></p>
                  </div>
                  <div class="season-badge bg-warning-subtle mb-2">
                    <strong class="text-warning">☀️ <?php _e('blog_a2_summer') ?></strong>
                    <p class="small mb-0 mt-1 text-muted"><?php _e('blog_a2_summer_desc') ?></p>
                  </div>
                  <div class="season-badge bg-info-subtle mb-2">
                    <strong class="text-info">🍂 <?php _e('blog_a2_autumn') ?></strong>
                    <p class="small mb-0 mt-1 text-muted"><?php _e('blog_a2_autumn_desc') ?></p>
                  </div>
                  <div class="season-badge bg-secondary-subtle">
                    <strong class="text-secondary">❄️ <?php _e('blog_a2_winter') ?></strong>
                    <p class="small mb-0 mt-1 text-muted"><?php _e('blog_a2_winter_desc') ?></p>
                  </div>
                  <p class="text-muted small mt-2">💡 <strong><?php _e('blog_a2_best_label') ?></strong> <?php _e('blog_a2_best_tip') ?></p>
                </div>

                <button class="read-more-btn mt-2" onclick="toggleArticle('full-2', this)">
                  <?php _e('blog_read_more') ?> <i class="bi bi-chevron-down"></i>
                </button>
              </div>
            </div>
          </div>

          <!-- Article 3 -->
          <div class="col-md-6">
            <div class="card article-card h-100">
              <div class="article-img">🗺️</div>
              <div class="card-body p-4">
                <span class="article-tag tag-guide"><?php _e('blog_a3_tag') ?></span>
                <h5 class="fw-bold mt-2"><?php _e('blog_a3_title') ?></h5>
                <p class="text-muted small"><?php _e('blog_a3_desc') ?></p>

                <div id="full-3" style="display:none">
                  <hr>
                  <h6 class="fw-bold text-primary">📅 <?php _e('blog_a3_2d1n') ?></h6>
                  <p class="small text-muted"><strong><?php _e('blog_a3_2d1n_day1') ?></strong> <?php _e('blog_a3_2d1n_day1_desc') ?></p>
                  <p class="small text-muted"><strong><?php _e('blog_a3_2d1n_day2') ?></strong> <?php _e('blog_a3_2d1n_day2_desc') ?></p>

                  <h6 class="fw-bold text-success mt-3">📅 <?php _e('blog_a3_3d2n') ?></h6>
                  <p class="small text-muted"><strong><?php _e('blog_a3_3d2n_day1') ?></strong> <?php _e('blog_a3_3d2n_day1_desc') ?></p>
                  <p class="small text-muted"><strong><?php _e('blog_a3_3d2n_day2') ?></strong> <?php _e('blog_a3_3d2n_day2_desc') ?></p>
                  <p class="small text-muted"><strong><?php _e('blog_a3_3d2n_day3') ?></strong> <?php _e('blog_a3_3d2n_day3_desc') ?></p>

                  <div class="bg-light rounded p-3 mt-2">
                    <p class="small mb-0"><strong>💰 <?php _e('blog_a3_cost') ?></strong><br>
                    <?php _e('blog_a3_cost_2d1n') ?><br>
                    <?php _e('blog_a3_cost_3d2n') ?><br>
                    <em><?php _e('blog_a3_cost_note') ?></em></p>
                  </div>
                </div>

                <button class="read-more-btn mt-2" onclick="toggleArticle('full-3', this)">
                  <?php _e('blog_read_more') ?> <i class="bi bi-chevron-down"></i>
                </button>
              </div>
            </div>
          </div>

          <!-- Article 4 -->
          <div class="col-md-6">
            <div class="card article-card h-100">
              <div class="article-img">🚌</div>
              <div class="card-body p-4">
                <span class="article-tag tag-tip"><?php _e('blog_a4_tag') ?></span>
                <h5 class="fw-bold mt-2"><?php _e('blog_a4_title') ?></h5>
                <p class="text-muted small"><?php _e('blog_a4_desc') ?></p>

                <div id="full-4" style="display:none">
                  <hr>
                  <div class="mb-3">
                    <h6 class="fw-bold"><i class="bi bi-bus-front-fill text-primary me-2"></i><?php _e('blog_a4_bus') ?></h6>
                    <p class="small text-muted mb-0"><?php _e('blog_a4_bus_desc') ?></p>
                  </div>
                  <div class="mb-3">
                    <h6 class="fw-bold"><i class="bi bi-airplane-fill text-success me-2"></i><?php _e('blog_a4_plane') ?></h6>
                    <p class="small text-muted mb-0"><?php _e('blog_a4_plane_desc') ?></p>
                  </div>
                  <div class="mb-3">
                    <h6 class="fw-bold"><i class="bi bi-train-front-fill text-warning me-2"></i><?php _e('blog_a4_boat') ?></h6>
                    <p class="small text-muted mb-0"><?php _e('blog_a4_boat_desc') ?></p>
                  </div>
                  <div>
                    <h6 class="fw-bold"><i class="bi bi-car-front-fill text-danger me-2"></i><?php _e('blog_a4_car') ?></h6>
                    <p class="small text-muted mb-0"><?php _e('blog_a4_car_desc') ?></p>
                  </div>
                </div>

                <button class="read-more-btn mt-2" onclick="toggleArticle('full-4', this)">
                  <?php _e('blog_read_more') ?> <i class="bi bi-chevron-down"></i>
                </button>
              </div>
            </div>
          </div>

          <!-- Article 5 -->
          <div class="col-md-6">
            <div class="card article-card h-100">
              <div class="article-img">🏨</div>
              <div class="card-body p-4">
                <span class="article-tag tag-guide"><?php _e('blog_a5_tag') ?></span>
                <h5 class="fw-bold mt-2"><?php _e('blog_a5_title') ?></h5>
                <p class="text-muted small"><?php _e('blog_a5_desc') ?></p>

                <div id="full-5" style="display:none">
                  <hr>
                  <div class="row g-3">
                    <div class="col-12">
                      <div class="bg-primary-subtle rounded-3 p-3">
                        <h6 class="fw-bold text-primary">🏖️ <?php _e('blog_a5_baichay') ?></h6>
                        <p class="small text-muted mb-1"><?php _e('blog_a5_baichay_desc') ?></p>
                        <p class="small mb-0"><strong><?php _e('blog_a5_highlight') ?></strong> <?php _e('blog_a5_baichay_hl') ?></p>
                      </div>
                    </div>
                    <div class="col-12">
                      <div class="bg-success-subtle rounded-3 p-3">
                        <h6 class="fw-bold text-success">🏙️ <?php _e('blog_a5_hongai') ?></h6>
                        <p class="small text-muted mb-1"><?php _e('blog_a5_hongai_desc') ?></p>
                        <p class="small mb-0"><strong><?php _e('blog_a5_highlight') ?></strong> <?php _e('blog_a5_hongai_hl') ?></p>
                      </div>
                    </div>
                  </div>
                  <p class="small text-muted mt-3 mb-0">💡 <strong><?php _e('blog_a5_suggest') ?></strong> <?php _e('blog_a5_suggest_desc') ?></p>
                </div>

                <button class="read-more-btn mt-2" onclick="toggleArticle('full-5', this)">
                  <?php _e('blog_read_more') ?> <i class="bi bi-chevron-down"></i>
                </button>
              </div>
            </div>
          </div>

          <!-- Article 6 -->
          <div class="col-md-6">
            <div class="card article-card h-100">
              <div class="article-img">🎭</div>
              <div class="card-body p-4">
                <span class="article-tag tag-culture"><?php _e('blog_a6_tag') ?></span>
                <h5 class="fw-bold mt-2"><?php _e('blog_a6_title') ?></h5>
                <p class="text-muted small"><?php _e('blog_a6_desc') ?></p>

                <div id="full-6" style="display:none">
                  <hr>
                  <div class="mb-3">
                    <h6 class="fw-bold"><i class="bi bi-stars text-warning me-2"></i><?php _e('blog_a6_carnival') ?></h6>
                    <p class="small text-muted mb-0"><?php _e('blog_a6_carnival_desc') ?></p>
                  </div>
                  <div class="mb-3">
                    <h6 class="fw-bold"><i class="bi bi-water text-primary me-2"></i><?php _e('blog_a6_boat_race') ?></h6>
                    <p class="small text-muted mb-0"><?php _e('blog_a6_boat_race_desc') ?></p>
                  </div>
                  <div class="mb-3">
                    <h6 class="fw-bold"><i class="bi bi-sunrise text-success me-2"></i><?php _e('blog_a6_festival') ?></h6>
                    <p class="small text-muted mb-0"><?php _e('blog_a6_festival_desc') ?></p>
                  </div>
                  <div>
                    <h6 class="fw-bold"><i class="bi bi-balloon-fill text-danger me-2"></i><?php _e('blog_a6_fireworks') ?></h6>
                    <p class="small text-muted mb-0"><?php _e('blog_a6_fireworks_desc') ?></p>
                  </div>
                </div>

                <button class="read-more-btn mt-2" onclick="toggleArticle('full-6', this)">
                  <?php _e('blog_read_more') ?> <i class="bi bi-chevron-down"></i>
                </button>
              </div>
            </div>
          </div>

          <!-- Article 7 -->
          <div class="col-md-6">
            <div class="card article-card h-100">
              <div class="article-img">🧗</div>
              <div class="card-body p-4">
                <span class="article-tag tag-adventure"><?php _e('blog_a7_tag') ?></span>
                <h5 class="fw-bold mt-2"><?php _e('blog_a7_title') ?></h5>
                <p class="text-muted small"><?php _e('blog_a7_desc') ?></p>

                <div id="full-7" style="display:none">
                  <hr>
                  <div class="row g-2">
                    <div class="col-6">
                      <div class="text-center bg-light rounded-3 p-3">
                        <div class="fs-3">🚣</div>
                        <h6 class="fw-bold small mt-1"><?php _e('blog_a7_kayak') ?></h6>
                        <p class="small text-muted mb-0"><?php _e('blog_a7_kayak_desc') ?></p>
                      </div>
                    </div>
                    <div class="col-6">
                      <div class="text-center bg-light rounded-3 p-3">
                        <div class="fs-3">🤿</div>
                        <h6 class="fw-bold small mt-1"><?php _e('blog_a7_diving') ?></h6>
                        <p class="small text-muted mb-0"><?php _e('blog_a7_diving_desc') ?></p>
                      </div>
                    </div>
                    <div class="col-6">
                      <div class="text-center bg-light rounded-3 p-3">
                        <div class="fs-3">🧗</div>
                        <h6 class="fw-bold small mt-1"><?php _e('blog_a7_climbing') ?></h6>
                        <p class="small text-muted mb-0"><?php _e('blog_a7_climbing_desc') ?></p>
                      </div>
                    </div>
                    <div class="col-6">
                      <div class="text-center bg-light rounded-3 p-3">
                        <div class="fs-3">🎣</div>
                        <h6 class="fw-bold small mt-1"><?php _e('blog_a7_fishing') ?></h6>
                        <p class="small text-muted mb-0"><?php _e('blog_a7_fishing_desc') ?></p>
                      </div>
                    </div>
                  </div>
                  <p class="small text-muted mt-3 mb-0">💡 <?php _e('blog_a7_note') ?></p>
                </div>

                <button class="read-more-btn mt-2" onclick="toggleArticle('full-7', this)">
                  <?php _e('blog_read_more') ?> <i class="bi bi-chevron-down"></i>
                </button>
              </div>
            </div>
          </div>

          <!-- Article 8 -->
          <div class="col-md-6">
            <div class="card article-card h-100">
              <div class="article-img">💰</div>
              <div class="card-body p-4">
                <span class="article-tag tag-tip"><?php _e('blog_a8_tag') ?></span>
                <h5 class="fw-bold mt-2"><?php _e('blog_a8_title') ?></h5>
                <p class="text-muted small"><?php _e('blog_a8_desc') ?></p>

                <div id="full-8" style="display:none">
                  <hr>
                  <ol class="text-muted small ps-3">
                    <li class="mb-2"><strong><?php _e('blog_a8_tip1') ?></strong> <?php _e('blog_a8_tip1_desc') ?></li>
                    <li class="mb-2"><strong><?php _e('blog_a8_tip2') ?></strong> <?php _e('blog_a8_tip2_desc') ?></li>
                    <li class="mb-2"><strong><?php _e('blog_a8_tip3') ?></strong> <?php _e('blog_a8_tip3_desc') ?></li>
                    <li class="mb-2"><strong><?php _e('blog_a8_tip4') ?></strong> <?php _e('blog_a8_tip4_desc') ?></li>
                    <li class="mb-2"><strong><?php _e('blog_a8_tip5') ?></strong> <?php _e('blog_a8_tip5_desc') ?></li>
                    <li class="mb-2"><strong><?php _e('blog_a8_tip6') ?></strong> <?php _e('blog_a8_tip6_desc') ?></li>
                    <li class="mb-2"><strong><?php _e('blog_a8_tip7') ?></strong> <?php _e('blog_a8_tip7_desc') ?></li>
                    <li class="mb-2"><strong><?php _e('blog_a8_tip8') ?></strong> <?php _e('blog_a8_tip8_desc') ?></li>
                    <li class="mb-2"><strong><?php _e('blog_a8_tip9') ?></strong> <?php _e('blog_a8_tip9_desc') ?></li>
                    <li><strong><?php _e('blog_a8_tip10') ?></strong> <?php _e('blog_a8_tip10_desc') ?></li>
                  </ol>
                </div>

                <button class="read-more-btn mt-2" onclick="toggleArticle('full-8', this)">
                  <?php _e('blog_read_more') ?> <i class="bi bi-chevron-down"></i>
                </button>
              </div>
            </div>
          </div>

          <!-- Article 9 -->
          <div class="col-md-6">
            <div class="card article-card h-100">
              <div class="article-img">🌿</div>
              <div class="card-body p-4">
                <span class="article-tag tag-culture"><?php _e('blog_a9_tag') ?></span>
                <h5 class="fw-bold mt-2"><?php _e('blog_a9_title') ?></h5>
                <p class="text-muted small"><?php _e('blog_a9_desc') ?></p>

                <div id="full-9" style="display:none">
                  <hr>
                  <h6 class="fw-bold"><?php _e('blog_a9_do') ?></h6>
                  <ul class="small text-muted">
                    <li><?php _e('blog_a9_do1') ?></li>
                    <li><?php _e('blog_a9_do2') ?></li>
                    <li><?php _e('blog_a9_do3') ?></li>
                    <li><?php _e('blog_a9_do4') ?></li>
                    <li><?php _e('blog_a9_do5') ?></li>
                  </ul>
                  <h6 class="fw-bold"><?php _e('blog_a9_dont') ?></h6>
                  <ul class="small text-muted mb-0">
                    <li><?php _e('blog_a9_dont1') ?></li>
                    <li><?php _e('blog_a9_dont2') ?></li>
                    <li><?php _e('blog_a9_dont3') ?></li>
                    <li><?php _e('blog_a9_dont4') ?></li>
                    <li><?php _e('blog_a9_dont5') ?></li>
                  </ul>
                </div>

                <button class="read-more-btn mt-2" onclick="toggleArticle('full-9', this)">
                  <?php _e('blog_read_more') ?> <i class="bi bi-chevron-down"></i>
                </button>
              </div>
            </div>
          </div>

        </div>
      </div>

      <!-- Sidebar -->
      <div class="col-lg-4">

        <!-- Thông tin nhanh -->
        <div class="card sidebar-card mb-4">
          <div class="card-header bg-primary text-white fw-bold rounded-top-3">
            <i class="bi bi-info-circle-fill me-2"></i><?php _e('blog_sidebar_title') ?>
          </div>
          <div class="card-body p-0">
            <div class="sidebar-item px-4 py-3 d-flex justify-content-between">
              <span class="text-muted small"><?php _e('blog_sidebar_province') ?></span>
              <span class="fw-semibold small"><?php _e('blog_sidebar_province_val') ?></span>
            </div>
            <div class="sidebar-item px-4 py-3 d-flex justify-content-between">
              <span class="text-muted small"><?php _e('blog_sidebar_distance') ?></span>
              <span class="fw-semibold small">~170 km</span>
            </div>
            <div class="sidebar-item px-4 py-3 d-flex justify-content-between">
              <span class="text-muted small"><?php _e('blog_sidebar_area') ?></span>
              <span class="fw-semibold small">1.553 km²</span>
            </div>
            <div class="sidebar-item px-4 py-3 d-flex justify-content-between">
              <span class="text-muted small"><?php _e('blog_sidebar_islands') ?></span>
              <span class="fw-semibold small"><?php _e('blog_sidebar_islands_val') ?></span>
            </div>
            <div class="sidebar-item px-4 py-3 d-flex justify-content-between">
              <span class="text-muted small"><?php _e('blog_sidebar_unesco') ?></span>
              <span class="fw-semibold small">1994 & 2000</span>
            </div>
            <div class="sidebar-item px-4 py-3 d-flex justify-content-between">
              <span class="text-muted small"><?php _e('blog_sidebar_airport') ?></span>
              <span class="fw-semibold small"><?php _e('blog_sidebar_airport_val') ?></span>
            </div>
            <div class="sidebar-item px-4 py-3 d-flex justify-content-between">
              <span class="text-muted small"><?php _e('blog_sidebar_best_time') ?></span>
              <span class="fw-semibold small"><?php _e('blog_sidebar_best_time_val') ?></span>
            </div>
            <div class="sidebar-item px-4 py-3 d-flex justify-content-between">
              <span class="text-muted small"><?php _e('blog_sidebar_timezone') ?></span>
              <span class="fw-semibold small"><?php _e('blog_sidebar_timezone_val') ?></span>
            </div>
          </div>
        </div>

        <!-- Mẹo du lịch nhanh -->
        <div class="card sidebar-card mb-4">
          <div class="card-header bg-warning text-dark fw-bold rounded-top-3">
            <i class="bi bi-lightbulb-fill me-2"></i><?php _e('blog_tips_title') ?>
          </div>
          <div class="card-body">
            <div class="d-flex mb-3">
              <i class="bi bi-telephone-fill text-warning me-3 mt-1 flex-shrink-0"></i>
              <div>
                <p class="fw-semibold small mb-0"><?php _e('blog_tips_hotline') ?></p>
                <p class="small text-muted mb-0"><?php _e('blog_tips_hotline_val') ?></p>
              </div>
            </div>
            <div class="d-flex mb-3">
              <i class="bi bi-currency-exchange text-warning me-3 mt-1 flex-shrink-0"></i>
              <div>
                <p class="fw-semibold small mb-0"><?php _e('blog_tips_currency') ?></p>
                <p class="small text-muted mb-0"><?php _e('blog_tips_currency_val') ?></p>
              </div>
            </div>
            <div class="d-flex mb-3">
              <i class="bi bi-sim-fill text-warning me-3 mt-1 flex-shrink-0"></i>
              <div>
                <p class="fw-semibold small mb-0"><?php _e('blog_tips_sim') ?></p>
                <p class="small text-muted mb-0"><?php _e('blog_tips_sim_val') ?></p>
              </div>
            </div>
            <div class="d-flex">
              <i class="bi bi-shield-plus-fill text-warning me-3 mt-1 flex-shrink-0"></i>
              <div>
                <p class="fw-semibold small mb-0"><?php _e('blog_tips_insurance') ?></p>
                <p class="small text-muted mb-0"><?php _e('blog_tips_insurance_val') ?></p>
              </div>
            </div>
          </div>
        </div>

        <!-- FAQ -->
        <div class="card sidebar-card mb-4">
          <div class="card-header bg-success text-white fw-bold rounded-top-3">
            <i class="bi bi-question-circle-fill me-2"></i><?php _e('blog_faq_title') ?>
          </div>
          <div class="card-body p-3">

            <div class="faq-item">
              <div class="faq-question" onclick="toggleFaq(this)">
                <?php _e('blog_faq_q1') ?>
                <i class="bi bi-plus-circle"></i>
              </div>
              <div class="faq-answer">
                <?php _e('blog_faq_a1') ?>
              </div>
            </div>

            <div class="faq-item">
              <div class="faq-question" onclick="toggleFaq(this)">
                <?php _e('blog_faq_q2') ?>
                <i class="bi bi-plus-circle"></i>
              </div>
              <div class="faq-answer">
                <?php _e('blog_faq_a2') ?>
              </div>
            </div>

            <div class="faq-item">
              <div class="faq-question" onclick="toggleFaq(this)">
                <?php _e('blog_faq_q3') ?>
                <i class="bi bi-plus-circle"></i>
              </div>
              <div class="faq-answer">
                <?php _e('blog_faq_a3') ?>
              </div>
            </div>

            <div class="faq-item">
              <div class="faq-question" onclick="toggleFaq(this)">
                <?php _e('blog_faq_q4') ?>
                <i class="bi bi-plus-circle"></i>
              </div>
              <div class="faq-answer">
                <?php _e('blog_faq_a4') ?>
              </div>
            </div>

          </div>
        </div>

        <!-- CTA đặt phòng -->
        <div class="card border-0 rounded-3 text-center p-4" style="background: linear-gradient(135deg, #1a3c34, #2D6A4F); color: white;">
          <i class="bi bi-house-heart-fill fs-1 mb-2"></i>
          <h5 class="fw-bold"><?php _e('blog_cta_title') ?></h5>
          <p class="small opacity-75 mb-3"><?php _e('blog_cta_desc') ?></p>
          <a href="rooms.php" class="btn btn-light fw-bold text-success rounded-pill px-4">
            <i class="bi bi-search me-1"></i> <?php _e('blog_cta_btn') ?>
          </a>
        </div>

      </div>
    </div>
  </div>

  <?php require('inc/footer.php'); ?>

  <script>
    function toggleArticle(id, btn) {
      const el = document.getElementById(id);
      if (el.style.display === 'none') {
        el.style.display = 'block';
        btn.innerHTML = '<?php echo __('blog_collapse') ?> <i class="bi bi-chevron-up"></i>';
      } else {
        el.style.display = 'none';
        btn.innerHTML = '<?php echo __('blog_read_more') ?> <i class="bi bi-chevron-down"></i>';
      }
    }

    function toggleFaq(el) {
      const answer = el.nextElementSibling;
      const icon = el.querySelector('i');
      if (answer.classList.contains('show')) {
        answer.classList.remove('show');
        icon.className = 'bi bi-plus-circle';
      } else {
        // Close all
        document.querySelectorAll('.faq-answer.show').forEach(a => a.classList.remove('show'));
        document.querySelectorAll('.faq-question i').forEach(i => i.className = 'bi bi-plus-circle');
        answer.classList.add('show');
        icon.className = 'bi bi-dash-circle';
      }
    }
  </script>

</body>
</html>