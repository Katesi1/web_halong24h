<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <?php require('inc/links.php'); ?>
  <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css">
  <link rel="stylesheet" href="css/services.css">
  <title><?php echo $settings_r['site_title'] ?> - <?php _e('services') ?></title>
  <meta name="description" content="<?php _e('svc_meta_desc') ?>">
</head>
<body class="bg-light">

  <?php require('inc/header.php'); ?>

  <!-- Hero Section -->
  <div class="svc-hero">
    <div class="svc-hero-overlay"></div>
    <div class="container position-relative">
      <div class="row align-items-center min-vh-40">
        <div class="col-lg-7 text-white py-5">
          <span class="svc-hero-badge"><i class="bi bi-stars me-1"></i> <?php _e('premium_experience') ?></span>
          <h1 class="fw-bold display-5 mb-3 h-font"><?php _e('our_services') ?></h1>
          <p class="lead mb-4 opacity-85"><?php _e('services_hero_sub') ?></p>
          <div class="d-flex gap-3 flex-wrap">
            <a href="#sunworld-tickets" class="btn btn-light btn-lg svc-hero-btn">
              <i class="bi bi-ticket-perforated me-2"></i><?php _e('svc_buy_tickets') ?>
            </a>
            <a href="#hotel-services" class="btn btn-outline-light btn-lg svc-hero-btn">
              <i class="bi bi-grid me-2"></i><?php _e('svc_hotel_services') ?>
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- ============================================
       Sun World Ha Long Tickets Section
       ============================================ -->
  <section class="sw-tickets-section py-5" id="sunworld-tickets">
    <div class="container">
      <header class="section-header text-center mb-5">
        <span class="sw-section-badge">
          <i class="bi bi-ticket-perforated me-1"></i> Sun World Hạ Long
        </span>
        <h2 class="mt-3 mb-3 fw-bold h-font"><?php _e('sw_tickets_title') ?></h2>
        <p class="text-muted mb-0 mx-auto" style="max-width:650px"><?php _e('sw_tickets_subtitle') ?></p>
        <div class="h-line bg-dark mx-auto mt-3"></div>
      </header>

      <!-- Service Detail Cards -->
      <?php
      require_once('inc/services_data.php');
      $is_vi = current_lang() === 'vi';
      $idx = 0;
      $phone_raw = str_replace(' ', '', $contact_r['pn1'] ?? '');
      $lang_adult = __('svc_adult');
      $lang_child = __('svc_child');
      $lang_free = __('svc_free_under_1m');
      $lang_book = __('svc_book_now');
      $lang_reviews = __('svc_reviews');
      ?>

      <div class="swiper swiper-sw-tickets">
        <div class="swiper-wrapper">
          <?php
          foreach ($services_data as $slug => $svc) {
            if (!empty($svc['is_combo'])) continue;
            $name = $is_vi ? $svc['name_vi'] : $svc['name_en'];
            $desc = $is_vi ? $svc['desc_vi'] : $svc['desc_en'];
            $highlights = $is_vi ? $svc['highlights_vi'] : $svc['highlights_en'];
            $category = $is_vi ? $svc['category_vi'] : $svc['category_en'];
            $is_reversed = ($idx % 2 === 1);
            $idx++;

            $stars = '';
            $r = $svc['rating'];
            for ($s = 0; $s < 5; $s++) {
              if ($s < floor($r)) $stars .= '<i class="bi bi-star-fill text-warning"></i>';
              elseif ($s < $r) $stars .= '<i class="bi bi-star-half text-warning"></i>';
              else $stars .= '<i class="bi bi-star text-warning"></i>';
            }

            $reverse_class = $is_reversed ? 'flex-row-reverse' : '';
            $highlights_html = '';
            foreach ($highlights as $hl) {
              $highlights_html .= "<li><i class='bi bi-check-circle-fill text-success me-2'></i>{$hl}</li>";
            }

            echo <<<DETAIL
              <div class="swiper-slide">
                <div class="sw-detail-card" id="{$slug}" itemscope itemtype="https://schema.org/TouristAttraction">
                  <div class="row g-0 {$reverse_class}">
                    <div class="col-lg-6">
                      <div class="sw-detail-img-wrapper">
                        <img src="{$svc['image']}"
                             alt="{$name} - Sun World Hạ Long"
                             class="sw-detail-img"
                             loading="lazy"
                             itemprop="image">
                        <div class="sw-detail-category">
                          <i class="{$svc['icon']} me-1"></i>{$category}
                        </div>
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="sw-detail-content">
                        <h3 class="sw-detail-name h-font" itemprop="name">{$name}</h3>
                        <div class="sw-detail-rating mb-3">
                          {$stars}
                          <span class="sw-rating-value">{$svc['rating']}</span>
                          <span class="sw-rating-count">({$svc['reviews']} {$lang_reviews})</span>
                        </div>
                        <p class="sw-detail-desc" itemprop="description">{$desc}</p>
                        <ul class="sw-highlights-list">
                          {$highlights_html}
                        </ul>
                        <div class="sw-detail-prices">
                          <div class="sw-price-box">
                            <span class="sw-price-label"><i class="bi bi-person-fill me-1"></i>{$lang_adult}</span>
                            <span class="sw-price-value">{$svc['price_adult']}đ</span>
                          </div>
                          <div class="sw-price-box sw-price-child">
                            <span class="sw-price-label"><i class="bi bi-emoji-smile me-1"></i>{$lang_child}</span>
                            <span class="sw-price-value">{$svc['price_child']}đ</span>
                          </div>
                        </div>
                        <p class="sw-free-note">
                          <i class="bi bi-info-circle me-1"></i>{$lang_free}
                        </p>
                        <div class="sw-book-actions">
                          <button type="button" class="btn sw-book-btn" data-bs-toggle="modal" data-bs-target="#bookingModal" data-service="{$name}" data-price="{$svc['price_adult']}">
                            <i class="bi bi-cart-check me-2"></i>{$lang_book}
                          </button>
                          <a href="https://zalo.me/0325992001" target="_blank" rel="noopener" class="btn sw-zalo-btn">
                            <i class="bi bi-chat-dots-fill me-2"></i>Zalo
                          </a>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            DETAIL;
          }
          ?>
        </div>
        <div class="swiper-pagination swiper-pagination-sw d-md-none"></div>
      </div>

      <!-- Combo Packages -->
      <div class="sw-combo-section mt-5">
        <div class="text-center mb-5">
          <span class="sw-combo-title-badge">
            <i class="bi bi-lightning-charge-fill me-1"></i> <?php _e('sw_combo_label') ?>
          </span>
          <h3 class="fw-bold h-font mt-3 mb-2"><?php _e('sw_combo_title') ?></h3>
          <p class="text-muted"><?php _e('sw_combo_subtitle') ?></p>
        </div>

        <div class="swiper swiper-sw-combos">
          <div class="swiper-wrapper">
            <?php
            foreach ($services_data as $slug => $svc) {
              if (empty($svc['is_combo'])) continue;
              $name = $is_vi ? $svc['name_vi'] : $svc['name_en'];
              $desc = $is_vi ? $svc['desc_vi'] : $svc['desc_en'];
              $highlights = $is_vi ? $svc['highlights_vi'] : $svc['highlights_en'];

              $highlights_html = '';
              foreach ($highlights as $hl) {
                $highlights_html .= "<li><i class='bi bi-check2-circle text-success me-2'></i>{$hl}</li>";
              }

              $is_vip = ($slug === 'combo-3-parks');
              $card_class = $is_vip ? 'sw-combo-card sw-combo-vip' : 'sw-combo-card';
              $badge_html = $is_vip ? "<div class='sw-vip-ribbon'>" . __('sw_most_popular') . "</div>" : '';

              echo <<<COMBO
                <div class="swiper-slide" id="{$slug}">
                  <div class="{$card_class}">
                    {$badge_html}
                    <div class="sw-combo-header">
                      <i class="{$svc['icon']} sw-combo-icon"></i>
                      <h4 class="sw-combo-name">{$name}</h4>
                      <p class="sw-combo-desc">{$desc}</p>
                    </div>
                    <div class="sw-combo-body">
                      <div class="sw-combo-price-row">
                        <div class="sw-combo-price">
                          <span class="sw-combo-price-label">{$lang_adult}</span>
                          <span class="sw-combo-price-amount">{$svc['price_adult']}đ</span>
                        </div>
                        <div class="sw-combo-price">
                          <span class="sw-combo-price-label">{$lang_child}</span>
                          <span class="sw-combo-price-amount">{$svc['price_child']}đ</span>
                        </div>
                      </div>
                      <ul class="sw-combo-features">
                        {$highlights_html}
                      </ul>
                      <div class="sw-combo-actions">
                        <button type="button" class="btn sw-combo-btn" data-bs-toggle="modal" data-bs-target="#bookingModal" data-service="{$name}" data-price="{$svc['price_adult']}">
                          <i class="bi bi-cart-check me-2"></i>{$lang_book}
                        </button>
                        <a href="https://zalo.me/0325992001" target="_blank" rel="noopener" class="btn sw-combo-zalo-btn">
                          <i class="bi bi-chat-dots-fill me-2"></i>Zalo
                        </a>
                      </div>
                    </div>
                  </div>
                </div>
              COMBO;
            }
            ?>
          </div>
          <div class="swiper-pagination swiper-pagination-combo d-md-none"></div>
        </div>
      </div>

      <!-- Price Comparison Table -->
      <div class="sw-price-table-section mt-5 pt-4">
        <div class="text-center mb-4">
          <h3 class="fw-bold h-font mb-2"><?php _e('sw_price_table_title') ?></h3>
          <p class="text-muted"><?php _e('sw_price_table_sub') ?></p>
        </div>

        <div class="table-responsive">
          <table class="table sw-price-table">
            <thead>
              <tr>
                <th><?php _e('sw_tbl_service') ?></th>
                <th class="text-center"><?php _e('svc_adult') ?></th>
                <th class="text-center"><?php _e('svc_child') ?></th>
                <th class="text-center"><?php _e('sw_tbl_validity') ?></th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($services_data as $slug => $svc):
                $name = $is_vi ? $svc['name_vi'] : $svc['name_en'];
                $validity = !empty($svc['is_combo']) && $slug === 'combo-3-parks'
                  ? __('sw_tbl_2days')
                  : __('sw_tbl_1day');
                $row_class = !empty($svc['is_combo']) ? 'sw-combo-row' : '';
              ?>
              <tr class="<?php echo $row_class ?>">
                <td>
                  <div class="d-flex align-items-center gap-2">
                    <i class="<?php echo $svc['icon'] ?> text-success"></i>
                    <strong><?php echo $name ?></strong>
                    <?php if (!empty($svc['is_combo'])): ?>
                      <span class="badge bg-warning text-dark ms-1"><?php _e('svc_best_value') ?></span>
                    <?php endif; ?>
                  </div>
                </td>
                <td class="text-center fw-bold text-success"><?php echo $svc['price_adult'] ?>đ</td>
                <td class="text-center"><?php echo $svc['price_child'] ?>đ</td>
                <td class="text-center"><small><?php echo $validity ?></small></td>
              </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
        <p class="text-muted small text-center mt-2">
          <i class="bi bi-info-circle me-1"></i><?php _e('svc_free_under_1m') ?> |
          <?php _e('sw_price_note') ?>
        </p>
      </div>

      <!-- CTA Contact -->
      <div class="sw-cta-section mt-5">
        <div class="sw-cta-card">
          <div class="row align-items-center">
            <div class="col-lg-7">
              <h3 class="sw-cta-title h-font"><?php _e('sw_cta_title') ?></h3>
              <p class="sw-cta-desc"><?php _e('sw_cta_desc') ?></p>
            </div>
            <div class="col-lg-5 text-lg-end mt-3 mt-lg-0">
              <button type="button" class="btn sw-cta-btn me-2 mb-2"
                      data-bs-toggle="modal" data-bs-target="#bookingModal">
                <i class="bi bi-pencil-square me-2"></i><?php _e('sw_cta_form') ?>
              </button>
              <a href="tel:0325992001" class="btn sw-cta-btn-outline me-2 mb-2">
                <i class="bi bi-telephone-fill me-2"></i>0325 992 001
              </a>
              <a href="https://zalo.me/0325992001"
                 target="_blank" rel="noopener"
                 class="btn sw-cta-btn-outline mb-2">
                <i class="bi bi-chat-dots-fill me-2"></i>Zalo
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- ============================================
       Hotel Services Section
       ============================================ -->
  <section class="hotel-services-section py-5" id="hotel-services">
    <div class="container">
      <header class="section-header text-center mb-5">
        <h2 class="mt-3 mb-3 fw-bold h-font"><?php _e('featured_services') ?></h2>
        <p class="text-muted mb-0"><?php _e('svc_hotel_services_sub') ?></p>
        <div class="h-line bg-dark mx-auto mt-3"></div>
      </header>

      <div class="swiper swiper-hotel-services">
        <div class="swiper-wrapper">

          <div class="swiper-slide">
            <div class="card hs-card h-100 text-center p-4">
              <div class="hs-icon-wrap">
                <i class="bi bi-flower2"></i>
              </div>
              <h5 class="fw-bold mb-2"><?php _e('svc_spa') ?></h5>
              <p class="text-muted"><?php _e('svc_spa_desc') ?></p>
              <div class="mt-auto pt-3">
                <span class="badge bg-success-subtle text-success rounded-pill px-3 py-2 mb-3">
                  <i class="bi bi-calendar-check me-1"></i> <?php _e('svc_spa_time') ?>
                </span>
                <div class="hs-card-actions">
                  <a href="https://zalo.me/0325992001" target="_blank" rel="noopener"
                     class="btn btn-sm hs-zalo-btn me-1">
                    <i class="bi bi-chat-dots-fill me-1"></i>Zalo
                  </a>
                  <button class="btn btn-sm hs-book-btn"
                          data-bs-toggle="modal" data-bs-target="#bookingModal"
                          data-service="<?php _e('svc_spa') ?>">
                    <i class="bi bi-pencil-square me-1"></i><?php _e('svc_book_service') ?>
                  </button>
                </div>
              </div>
            </div>
          </div>

          <div class="swiper-slide">
            <div class="card hs-card h-100 text-center p-4">
              <div class="hs-icon-wrap">
                <i class="bi bi-cup-hot-fill"></i>
              </div>
              <h5 class="fw-bold mb-2"><?php _e('svc_restaurant') ?></h5>
              <p class="text-muted"><?php _e('svc_restaurant_desc') ?></p>
              <div class="mt-auto pt-3">
                <span class="badge bg-success-subtle text-success rounded-pill px-3 py-2 mb-3">
                  <i class="bi bi-clock me-1"></i> <?php _e('svc_restaurant_time') ?>
                </span>
                <div class="hs-card-actions">
                  <a href="https://zalo.me/0325992001" target="_blank" rel="noopener"
                     class="btn btn-sm hs-zalo-btn me-1">
                    <i class="bi bi-chat-dots-fill me-1"></i>Zalo
                  </a>
                  <button class="btn btn-sm hs-book-btn"
                          data-bs-toggle="modal" data-bs-target="#bookingModal"
                          data-service="<?php _e('svc_restaurant') ?>">
                    <i class="bi bi-pencil-square me-1"></i><?php _e('svc_book_service') ?>
                  </button>
                </div>
              </div>
            </div>
          </div>

          <div class="swiper-slide">
            <div class="card hs-card h-100 text-center p-4">
              <div class="hs-icon-wrap">
                <i class="bi bi-car-front-fill"></i>
              </div>
              <h5 class="fw-bold mb-2"><?php _e('svc_transfer') ?></h5>
              <p class="text-muted"><?php _e('svc_transfer_desc') ?></p>
              <div class="mt-auto pt-3">
                <span class="badge bg-success-subtle text-success rounded-pill px-3 py-2 mb-3">
                  <i class="bi bi-telephone me-1"></i> <?php _e('svc_transfer_time') ?>
                </span>
                <div class="hs-card-actions">
                  <a href="https://zalo.me/0325992001" target="_blank" rel="noopener"
                     class="btn btn-sm hs-zalo-btn me-1">
                    <i class="bi bi-chat-dots-fill me-1"></i>Zalo
                  </a>
                  <button class="btn btn-sm hs-book-btn"
                          data-bs-toggle="modal" data-bs-target="#bookingModal"
                          data-service="<?php _e('svc_transfer') ?>">
                    <i class="bi bi-pencil-square me-1"></i><?php _e('svc_book_service') ?>
                  </button>
                </div>
              </div>
            </div>
          </div>

          <div class="swiper-slide">
            <div class="card hs-card h-100 text-center p-4">
              <div class="hs-icon-wrap">
                <i class="bi bi-bicycle"></i>
              </div>
              <h5 class="fw-bold mb-2"><?php _e('svc_rental') ?></h5>
              <p class="text-muted"><?php _e('svc_rental_desc') ?></p>
              <div class="mt-auto pt-3">
                <span class="badge bg-success-subtle text-success rounded-pill px-3 py-2 mb-3">
                  <i class="bi bi-calendar me-1"></i> <?php _e('svc_rental_time') ?>
                </span>
                <div class="hs-card-actions">
                  <a href="https://zalo.me/0325992001" target="_blank" rel="noopener"
                     class="btn btn-sm hs-zalo-btn me-1">
                    <i class="bi bi-chat-dots-fill me-1"></i>Zalo
                  </a>
                  <button class="btn btn-sm hs-book-btn"
                          data-bs-toggle="modal" data-bs-target="#bookingModal"
                          data-service="<?php _e('svc_rental') ?>">
                    <i class="bi bi-pencil-square me-1"></i><?php _e('svc_book_service') ?>
                  </button>
                </div>
              </div>
            </div>
          </div>

          <div class="swiper-slide">
            <div class="card hs-card h-100 text-center p-4">
              <div class="hs-icon-wrap">
                <i class="bi bi-droplet-fill"></i>
              </div>
              <h5 class="fw-bold mb-2"><?php _e('svc_pool') ?></h5>
              <p class="text-muted"><?php _e('svc_pool_desc') ?></p>
              <div class="mt-auto pt-3">
                <span class="badge bg-success-subtle text-success rounded-pill px-3 py-2 mb-3">
                  <i class="bi bi-sun me-1"></i> <?php _e('svc_pool_time') ?>
                </span>
                <div class="hs-card-actions">
                  <a href="https://zalo.me/0325992001" target="_blank" rel="noopener"
                     class="btn btn-sm hs-zalo-btn me-1">
                    <i class="bi bi-chat-dots-fill me-1"></i>Zalo
                  </a>
                  <button class="btn btn-sm hs-book-btn"
                          data-bs-toggle="modal" data-bs-target="#bookingModal"
                          data-service="<?php _e('svc_pool') ?>">
                    <i class="bi bi-pencil-square me-1"></i><?php _e('svc_book_service') ?>
                  </button>
                </div>
              </div>
            </div>
          </div>

          <div class="swiper-slide">
            <div class="card hs-card h-100 text-center p-4">
              <div class="hs-icon-wrap">
                <i class="bi bi-bag-heart-fill"></i>
              </div>
              <h5 class="fw-bold mb-2"><?php _e('svc_souvenir') ?></h5>
              <p class="text-muted"><?php _e('svc_souvenir_desc') ?></p>
              <div class="mt-auto pt-3">
                <span class="badge bg-success-subtle text-success rounded-pill px-3 py-2 mb-3">
                  <i class="bi bi-shop me-1"></i> <?php _e('svc_souvenir_time') ?>
                </span>
                <div class="hs-card-actions">
                  <a href="https://zalo.me/0325992001" target="_blank" rel="noopener"
                     class="btn btn-sm hs-zalo-btn me-1">
                    <i class="bi bi-chat-dots-fill me-1"></i>Zalo
                  </a>
                  <button class="btn btn-sm hs-book-btn"
                          data-bs-toggle="modal" data-bs-target="#bookingModal"
                          data-service="<?php _e('svc_souvenir') ?>">
                    <i class="bi bi-pencil-square me-1"></i><?php _e('svc_book_service') ?>
                  </button>
                </div>
              </div>
            </div>
          </div>

        </div>
        <div class="swiper-pagination swiper-pagination-hs d-md-none"></div>
      </div>
    </div>
  </section>

  <!-- Cam kết chất lượng -->
  <section class="commitment-section py-5">
    <div class="container">
      <div class="sw-commitment-card p-5 text-center">
        <i class="bi bi-patch-check-fill text-success fs-1 mb-3 d-block"></i>
        <h3 class="fw-bold h-font mb-3"><?php _e('our_commitment') ?></h3>
        <div class="row g-4 mt-2">
          <div class="col-md-3 col-6">
            <i class="bi bi-shield-check fs-2 text-success mb-2 d-block"></i>
            <h6 class="fw-bold"><?php _e('commit_safety') ?></h6>
            <p class="text-muted small"><?php _e('commit_safety_desc') ?></p>
          </div>
          <div class="col-md-3 col-6">
            <i class="bi bi-star-fill fs-2 text-success mb-2 d-block"></i>
            <h6 class="fw-bold"><?php _e('commit_quality') ?></h6>
            <p class="text-muted small"><?php _e('commit_quality_desc') ?></p>
          </div>
          <div class="col-md-3 col-6">
            <i class="bi bi-headset fs-2 text-success mb-2 d-block"></i>
            <h6 class="fw-bold"><?php _e('commit_support') ?></h6>
            <p class="text-muted small"><?php _e('commit_support_desc') ?></p>
          </div>
          <div class="col-md-3 col-6">
            <i class="bi bi-currency-dollar fs-2 text-success mb-2 d-block"></i>
            <h6 class="fw-bold"><?php _e('commit_price') ?></h6>
            <p class="text-muted small"><?php _e('commit_price_desc') ?></p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- JSON-LD Structured Data -->
  <?php
  $json_ld_items = [];
  foreach ($services_data as $slug => $svc) {
    $name = $is_vi ? $svc['name_vi'] : $svc['name_en'];
    $desc = $is_vi ? $svc['desc_vi'] : $svc['desc_en'];
    $json_ld_items[] = [
      "@type" => "TouristAttraction",
      "name" => $name,
      "description" => $desc,
      "image" => $svc['image'],
      "offers" => [
        "@type" => "Offer",
        "price" => $svc['price_adult_raw'],
        "priceCurrency" => "VND",
        "availability" => "https://schema.org/InStock"
      ],
      "aggregateRating" => [
        "@type" => "AggregateRating",
        "ratingValue" => $svc['rating'],
        "reviewCount" => $svc['reviews'],
        "bestRating" => 5
      ]
    ];
  }
  ?>
  <script type="application/ld+json">
  <?php echo json_encode([
    "@context" => "https://schema.org",
    "@type" => "ItemList",
    "name" => __('sw_tickets_title'),
    "numberOfItems" => count($json_ld_items),
    "itemListElement" => array_map(function($item, $idx) {
      return ["@type" => "ListItem", "position" => $idx + 1, "item" => $item];
    }, $json_ld_items, array_keys($json_ld_items))
  ], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT); ?>
  </script>

  <!-- Booking Modal -->
  <div class="modal fade" id="bookingModal" tabindex="-1" aria-labelledby="bookingModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
      <div class="modal-content sw-modal-content">
        <div class="modal-header sw-modal-header">
          <div>
            <h5 class="modal-title fw-bold" id="bookingModalLabel">
              <i class="bi bi-ticket-perforated me-2"></i><?php _e('sw_form_title') ?>
            </h5>
            <p class="mb-0 small opacity-75"><?php _e('sw_form_subtitle') ?></p>
          </div>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form id="svc-booking-form">
          <div class="modal-body p-4">
            <div class="row g-3">
              <!-- Họ tên -->
              <div class="col-md-6">
                <label class="form-label fw-semibold">
                  <i class="bi bi-person me-1 text-success"></i><?php _e('sw_form_name') ?> <span class="text-danger">*</span>
                </label>
                <input type="text" class="form-control shadow-none" name="fullname" required
                       placeholder="<?php _e('sw_form_name_ph') ?>">
              </div>
              <!-- Số điện thoại -->
              <div class="col-md-6">
                <label class="form-label fw-semibold">
                  <i class="bi bi-telephone me-1 text-success"></i><?php _e('sw_form_phone') ?> <span class="text-danger">*</span>
                </label>
                <input type="tel" class="form-control shadow-none" name="phone" required
                       placeholder="<?php _e('sw_form_phone_ph') ?>" pattern="[0-9]{9,11}">
              </div>
              <!-- Email -->
              <div class="col-md-6">
                <label class="form-label fw-semibold">
                  <i class="bi bi-envelope me-1 text-success"></i>Email
                </label>
                <input type="email" class="form-control shadow-none" name="email"
                       placeholder="email@example.com">
              </div>
              <!-- Dịch vụ -->
              <div class="col-md-6">
                <label class="form-label fw-semibold">
                  <i class="bi bi-grid me-1 text-success"></i><?php _e('sw_form_service') ?> <span class="text-danger">*</span>
                </label>
                <select class="form-select shadow-none" name="service" required id="svc-select">
                  <option value=""><?php _e('sw_form_select_service') ?></option>
                  <optgroup label="Sun World Ha Long">
                  <?php foreach ($services_data as $slug => $svc):
                    $svc_name = $is_vi ? $svc['name_vi'] : $svc['name_en'];
                  ?>
                  <option value="<?php echo htmlspecialchars($svc_name) ?>" data-price="<?php echo $svc['price_adult'] ?>">
                    <?php echo htmlspecialchars($svc_name) ?> - <?php echo $svc['price_adult'] ?>đ
                  </option>
                  <?php endforeach; ?>
                  </optgroup>
                  <optgroup label="<?php _e('featured_services') ?>">
                    <option value="<?php echo htmlspecialchars(__('svc_spa')) ?>"><?php _e('svc_spa') ?></option>
                    <option value="<?php echo htmlspecialchars(__('svc_restaurant')) ?>"><?php _e('svc_restaurant') ?></option>
                    <option value="<?php echo htmlspecialchars(__('svc_transfer')) ?>"><?php _e('svc_transfer') ?></option>
                    <option value="<?php echo htmlspecialchars(__('svc_rental')) ?>"><?php _e('svc_rental') ?></option>
                    <option value="<?php echo htmlspecialchars(__('svc_pool')) ?>"><?php _e('svc_pool') ?></option>
                    <option value="<?php echo htmlspecialchars(__('svc_souvenir')) ?>"><?php _e('svc_souvenir') ?></option>
                  </optgroup>
                </select>
              </div>
              <!-- Ngày tham quan -->
              <div class="col-md-4">
                <label class="form-label fw-semibold">
                  <i class="bi bi-calendar-event me-1 text-success"></i><?php _e('sw_form_date') ?> <span class="text-danger">*</span>
                </label>
                <input type="date" class="form-control shadow-none" name="visit_date" required
                       min="<?php echo date('Y-m-d') ?>">
              </div>
              <!-- Số lượng NL -->
              <div class="col-md-4">
                <label class="form-label fw-semibold">
                  <i class="bi bi-person-fill me-1 text-success"></i><?php _e('svc_adult') ?> <span class="text-danger">*</span>
                </label>
                <select class="form-select shadow-none" name="adults" required>
                  <?php for ($i = 1; $i <= 20; $i++): ?>
                  <option value="<?php echo $i ?>"><?php echo $i ?></option>
                  <?php endfor; ?>
                </select>
              </div>
              <!-- Số lượng TE -->
              <div class="col-md-4">
                <label class="form-label fw-semibold">
                  <i class="bi bi-emoji-smile me-1 text-success"></i><?php _e('svc_child') ?>
                </label>
                <select class="form-select shadow-none" name="children">
                  <?php for ($i = 0; $i <= 15; $i++): ?>
                  <option value="<?php echo $i ?>"><?php echo $i ?></option>
                  <?php endfor; ?>
                </select>
              </div>
              <!-- Ghi chú -->
              <div class="col-12">
                <label class="form-label fw-semibold">
                  <i class="bi bi-chat-left-text me-1 text-success"></i><?php _e('sw_form_note') ?>
                </label>
                <textarea class="form-control shadow-none" name="note" rows="3"
                          placeholder="<?php _e('sw_form_note_ph') ?>"></textarea>
              </div>
            </div>

            <!-- Thông tin liên hệ nhanh -->
            <div class="sw-form-contact-info mt-4">
              <p class="mb-2 fw-semibold"><i class="bi bi-headset me-1"></i> <?php _e('sw_form_or_contact') ?></p>
              <div class="d-flex gap-3 flex-wrap">
                <a href="tel:0325992001" class="sw-form-contact-link">
                  <i class="bi bi-telephone-fill me-1"></i>0325 992 001
                </a>
                <a href="https://zalo.me/0325992001" target="_blank" rel="noopener" class="sw-form-contact-link sw-form-zalo">
                  <i class="bi bi-chat-dots-fill me-1"></i>Chat Zalo
                </a>
              </div>
            </div>
          </div>
          <div class="modal-footer sw-modal-footer">
            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
              <i class="bi bi-x-lg me-1"></i><?php _e('cancel') ?>
            </button>
            <button type="submit" class="btn sw-submit-btn" id="svc-submit-btn">
              <i class="bi bi-send me-2"></i><?php _e('sw_form_submit') ?>
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <?php require('inc/footer.php'); ?>

  <script src="https://unpkg.com/swiper@7/swiper-bundle.min.js"></script>
  <script>
    // Auto-fill service name when clicking book button
    document.getElementById('bookingModal').addEventListener('show.bs.modal', function (event) {
      var button = event.relatedTarget;
      if (button && button.dataset.service) {
        var select = document.getElementById('svc-select');
        var options = select.options;
        for (var i = 0; i < options.length; i++) {
          if (options[i].value === button.dataset.service) {
            select.selectedIndex = i;
            break;
          }
        }
      }
    });

    // Handle form submit → send to Zalo with prefilled message
    document.getElementById('svc-booking-form').addEventListener('submit', function(e) {
      e.preventDefault();

      var form = this;
      var name = form.elements['fullname'].value.trim();
      var phone = form.elements['phone'].value.trim();
      var email = form.elements['email'].value.trim();
      var service = form.elements['service'].value;
      var date = form.elements['visit_date'].value;
      var adults = form.elements['adults'].value;
      var children = form.elements['children'].value;
      var note = form.elements['note'].value.trim();

      if (!name || !phone || !service || !date) {
        alert('<?php _e('sw_form_required') ?>');
        return;
      }

      // Build Zalo message
      var msg = '<?php _e('sw_form_zalo_greeting') ?>\n\n';
      msg += '👤 <?php _e('sw_form_name') ?>: ' + name + '\n';
      msg += '📞 <?php _e('sw_form_phone') ?>: ' + phone + '\n';
      if (email) msg += '📧 Email: ' + email + '\n';
      msg += '🎫 <?php _e('sw_form_service') ?>: ' + service + '\n';
      msg += '📅 <?php _e('sw_form_date') ?>: ' + date + '\n';
      msg += '👨 <?php _e('svc_adult') ?>: ' + adults + '\n';
      msg += '👶 <?php _e('svc_child') ?>: ' + children + '\n';
      if (note) msg += '📝 <?php _e('sw_form_note') ?>: ' + note + '\n';

      // Close modal
      var modal = bootstrap.Modal.getInstance(document.getElementById('bookingModal'));
      modal.hide();

      // Open Zalo with prefilled message
      var zaloUrl = 'https://zalo.me/0325992001';
      window.open(zaloUrl, '_blank');

      // Show success message
      alert('<?php _e('sw_form_success') ?>');
      form.reset();
    });

    // SW Tickets swiper (mobile only)
    var swTicketsSwiper = null;
    function initSwTicketsSwiper() {
      if (window.innerWidth < 768) {
        if (!swTicketsSwiper) {
          swTicketsSwiper = new Swiper(".swiper-sw-tickets", {
            slidesPerView: 1.05,
            spaceBetween: 16,
            grabCursor: true,
            pagination: {
              el: ".swiper-pagination-sw",
              clickable: true,
              dynamicBullets: true
            }
          });
        }
      } else {
        if (swTicketsSwiper) { swTicketsSwiper.destroy(true, true); swTicketsSwiper = null; }
      }
    }
    initSwTicketsSwiper();
    window.addEventListener('resize', initSwTicketsSwiper);

    // SW Combos swiper (mobile only)
    var swCombosSwiper = null;
    function initSwCombosSwiper() {
      if (window.innerWidth < 768) {
        if (!swCombosSwiper) {
          swCombosSwiper = new Swiper(".swiper-sw-combos", {
            slidesPerView: 1.1,
            spaceBetween: 16,
            grabCursor: true,
            pagination: {
              el: ".swiper-pagination-combo",
              clickable: true,
              dynamicBullets: true
            }
          });
        }
      } else {
        if (swCombosSwiper) { swCombosSwiper.destroy(true, true); swCombosSwiper = null; }
      }
    }
    initSwCombosSwiper();
    window.addEventListener('resize', initSwCombosSwiper);

    // Hotel Services swiper (mobile only)
    var hsSwiper = null;
    function initHsSwiper() {
      if (window.innerWidth < 768) {
        if (!hsSwiper) {
          hsSwiper = new Swiper(".swiper-hotel-services", {
            slidesPerView: 1.15,
            spaceBetween: 16,
            grabCursor: true,
            pagination: {
              el: ".swiper-pagination-hs",
              clickable: true,
              dynamicBullets: true
            },
            breakpoints: {
              480: { slidesPerView: 1.5, spaceBetween: 16 },
              576: { slidesPerView: 2.1, spaceBetween: 16 }
            }
          });
        }
      } else {
        if (hsSwiper) { hsSwiper.destroy(true, true); hsSwiper = null; }
      }
    }
    initHsSwiper();
    window.addEventListener('resize', initHsSwiper);
  </script>

</body>
</html>
