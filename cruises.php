<!DOCTYPE html>
<html lang="vi">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <?php require('inc/links.php'); ?>
  <?php require('inc/cruises_data.php'); ?>
  <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css">
  <link rel="stylesheet" href="css/cruises.css">
  <title><?php echo $settings_r['site_title'] ?> - <?php _e('cruises_title') ?></title>
  <meta name="description" content="<?php _e('cruises_meta_desc') ?>">
</head>

<body class="bg-light">

  <?php require('inc/header.php'); ?>

  <!-- Hero Banner -->
  <div class="cruise-hero">
    <div class="cruise-hero-overlay"></div>
    <div class="container position-relative">
      <nav aria-label="breadcrumb" class="cruise-breadcrumb">
        <ol class="breadcrumb mb-0">
          <li class="breadcrumb-item"><a href="index.php"><?php _e('nav_home') ?></a></li>
          <li class="breadcrumb-item active" aria-current="page"><?php _e('cruises_title') ?></li>
        </ol>
      </nav>
      <h1 class="cruise-hero-title h-font"><?php _e('cruises_page_title') ?></h1>
      <p class="cruise-hero-subtitle"><?php _e('cruises_page_subtitle') ?></p>
    </div>
  </div>

  <!-- Cruise Listing -->
  <section class="cruise-listing py-5">
    <div class="container">

      <!-- Stats Bar -->
      <div class="cruise-stats-bar mb-5">
        <div class="row g-3 text-center">
          <div class="col-6 col-md-3">
            <div class="stat-item">
              <span class="stat-number"><?php echo count($cruises_data) ?></span>
              <span class="stat-label"><?php _e('cruise_stat_ships') ?></span>
            </div>
          </div>
          <div class="col-6 col-md-3">
            <div class="stat-item">
              <span class="stat-number">4-6</span>
              <span class="stat-label"><?php _e('cruise_stat_stars') ?></span>
            </div>
          </div>
          <div class="col-6 col-md-3">
            <div class="stat-item">
              <span class="stat-number">1.8M+</span>
              <span class="stat-label"><?php _e('cruise_stat_price') ?></span>
            </div>
          </div>
          <div class="col-6 col-md-3">
            <div class="stat-item">
              <span class="stat-number">10K+</span>
              <span class="stat-label"><?php _e('cruise_stat_reviews') ?></span>
            </div>
          </div>
        </div>
      </div>

      <!-- Cruise Cards -->
      <div class="swiper swiper-cruise-listing">
        <div class="swiper-wrapper">
        <?php
        $is_vi = current_lang() === 'vi';
        $cruises_json_ld = [];

        foreach ($cruises_data as $slug => $cruise) {
          $desc = $is_vi ? $cruise['desc_vi'] : $cruise['desc_en'];
          $route = $is_vi ? $cruise['route_vi'] : $cruise['route_en'];
          $highlights = $is_vi ? $cruise['highlights'] : $cruise['highlights_en'];

          // Star icons
          $star_icons = '';
          for ($s = 0; $s < $cruise['class']; $s++) {
            $star_icons .= '<i class="bi bi-star-fill"></i>';
          }

          // Rating stars
          $rating_stars = '';
          $r = $cruise['rating'];
          for ($s = 0; $s < 5; $s++) {
            if ($s < floor($r)) {
              $rating_stars .= '<i class="bi bi-star-fill text-warning"></i>';
            } elseif ($s < $r) {
              $rating_stars .= '<i class="bi bi-star-half text-warning"></i>';
            } else {
              $rating_stars .= '<i class="bi bi-star text-warning"></i>';
            }
          }

          // Highlights (max 5)
          $highlights_html = '';
          $show_count = min(5, count($highlights));
          for ($i = 0; $i < $show_count; $i++) {
            $highlights_html .= "<span class='cl-tag'><i class='bi bi-check2 me-1'></i>{$highlights[$i]}</span>";
          }
          if (count($highlights) > 5) {
            $rem = count($highlights) - 5;
            $highlights_html .= "<span class='cl-tag cl-tag-more'>+{$rem}</span>";
          }

          $detail_url = "cruise_details.php?id={$slug}";
          $from_text = __('cruise_from_price');
          $per_person = __('cruise_per_person');
          $stars_text = __('cruise_stars');
          $duration_text = __('cruise_2d1n');
          $review_text = __('cruise_rating');
          $detail_text = __('cruise_view_detail');
          $cabin_text = __('cruise_cabins');
          $year_text = __('cruise_launched');
          $route_label = __('cruise_route');

          // JSON-LD
          $cruises_json_ld[] = [
            "@type" => "TouristTrip",
            "name" => $cruise['name'],
            "description" => $desc,
            "touristType" => "Cruise",
            "image" => $cruise['image'],
            "offers" => [
              "@type" => "Offer",
              "price" => str_replace('.', '', $cruise['price_from']),
              "priceCurrency" => "VND",
            ],
            "aggregateRating" => [
              "@type" => "AggregateRating",
              "ratingValue" => $cruise['rating'],
              "reviewCount" => $cruise['reviews'],
              "bestRating" => 5,
            ],
          ];

          echo <<<CARD
            <article class="swiper-slide">
              <div class="cl-card">
                <div class="cl-card-image">
                  <img src="{$cruise['image']}" alt="{$cruise['name']} - Du thuyền Hạ Long" loading="lazy">
                  <div class="cl-card-image-overlay">
                    <div class="cl-badge-group">
                      <span class="cl-class-badge">{$star_icons} {$cruise['class']} {$stars_text}</span>
                      <span class="cl-route-badge"><i class="bi bi-geo-alt me-1"></i>{$route}</span>
                    </div>
                    <div class="cl-price-badge">
                      <small>{$from_text}</small>
                      <strong>{$cruise['price_from']}</strong>
                      <small>VNĐ{$per_person}</small>
                    </div>
                  </div>
                </div>
                <div class="cl-card-body">
                  <div class="cl-card-header">
                    <div>
                      <h2 class="cl-card-title h-font">{$cruise['name']}</h2>
                      <div class="cl-card-meta">
                        <span><i class="bi bi-door-closed me-1"></i>{$cruise['cabin_count']} {$cabin_text}</span>
                        <span><i class="bi bi-calendar3 me-1"></i>{$year_text} {$cruise['year_launched']}</span>
                        <span><i class="bi bi-clock me-1"></i>{$duration_text}</span>
                      </div>
                    </div>
                    <div class="cl-rating">
                      <span class="cl-rating-score">{$cruise['rating']}</span>
                      <div>
                        <div class="cl-rating-stars">{$rating_stars}</div>
                        <span class="cl-rating-count">{$cruise['reviews']} {$review_text}</span>
                      </div>
                    </div>
                  </div>
                  <p class="cl-card-desc">{$desc}</p>
                  <div class="cl-card-tags">
                    {$highlights_html}
                  </div>
                  <a href="{$detail_url}" class="btn cl-detail-btn">
                    <i class="bi bi-arrow-right me-2"></i>{$detail_text}
                  </a>
                </div>
              </div>
            </article>
          CARD;
        }

        // JSON-LD
        echo '<script type="application/ld+json">';
        echo json_encode([
          "@context" => "https://schema.org",
          "@type" => "ItemList",
          "name" => __('cruises_title'),
          "description" => __('cruises_page_subtitle'),
          "numberOfItems" => count($cruises_json_ld),
          "itemListElement" => array_map(function ($item, $idx) {
            return ["@type" => "ListItem", "position" => $idx + 1, "item" => $item];
          }, $cruises_json_ld, array_keys($cruises_json_ld)),
        ], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
        echo '</script>';
        ?>
        </div>
        <div class="swiper-pagination cruise-listing-pagination"></div>
      </div>
    </div>
  </section>

  <?php require('inc/footer.php'); ?>

  <script src="https://unpkg.com/swiper@7/swiper-bundle.min.js"></script>
  <script>
    var cruiseListSwiper = null;
    function initCruiseListSwiper() {
      if (window.innerWidth < 768) {
        if (!cruiseListSwiper) {
          cruiseListSwiper = new Swiper(".swiper-cruise-listing", {
            slidesPerView: 1.15,
            spaceBetween: 16,
            grabCursor: true,
            pagination: {
              el: ".cruise-listing-pagination",
              clickable: true,
              dynamicBullets: true
            },
            breakpoints: {
              480: { slidesPerView: 1.25, spaceBetween: 16 },
              576: { slidesPerView: 1.4, spaceBetween: 16 }
            }
          });
        }
      } else {
        if (cruiseListSwiper) {
          cruiseListSwiper.destroy(true, true);
          cruiseListSwiper = null;
        }
      }
    }
    initCruiseListSwiper();
    window.addEventListener('resize', initCruiseListSwiper);
  </script>

</body>

</html>
