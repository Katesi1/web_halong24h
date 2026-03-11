<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
  <?php require('inc/links.php'); ?>
  <link rel="stylesheet" href="css/homepage.css">
  <title><?php echo $settings_r['site_title'] ?> - <?php _e('home') ?></title>
</head>

<body class="bg-light">

  <?php require('inc/header.php'); ?>

  <!-- Carousel -->

  <div class="container-fluid px-lg-4 mt-4">
    <div class="swiper swiper-container">
      <div class="swiper-wrapper">
        <?php
        $res = selectAll('carousel');
        while ($row = mysqli_fetch_assoc($res)) {
          $path = CAROUSEL_IMG_PATH;
          echo <<<data
              <div class="swiper-slide">
                <img src="$path$row[image]" class="w-100 d-block">
              </div>
            data;
        }
        ?>
      </div>
    </div>
  </div>

  <!-- check availability form -->

  <div class="container availability-form">
    <div class="row">
      <div class="col-lg-12 availability-form-card p-4 p-lg-5">
        <h5 class="availability-form-title h-font">
          <i class="bi bi-calendar-check"></i>
          <?php _e('check_booking') ?>
        </h5>
        <form action="rooms.php">
          <div class="row align-items-end">
            <div class="col-lg-3 col-md-6 mb-3">
              <div class="form-field-wrapper">
                <label class="form-label">
                  <i class="bi bi-calendar-event"></i>
                  <?php _e('checkin') ?>
                </label>
                <i class="bi bi-calendar3 form-field-icon"></i>
                <input type="date" class="form-control shadow-none" name="checkin" placeholder="dd/mm/yyyy" required>
              </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-3">
              <div class="form-field-wrapper">
                <label class="form-label">
                  <i class="bi bi-calendar-x"></i>
                  <?php _e('checkout') ?>
                </label>
                <i class="bi bi-calendar3 form-field-icon"></i>
                <input type="date" class="form-control shadow-none" name="checkout" placeholder="dd/mm/yyyy" required>
              </div>
            </div>
            <div class="col-lg-2 col-md-6 mb-3">
              <div class="form-field-wrapper">
                <label class="form-label">
                  <i class="bi bi-people"></i>
                  <?php _e('adults') ?>
                </label>
                <i class="bi bi-person form-field-icon"></i>
                <select class="form-select shadow-none" name="adult">
                  <?php
                  for ($i = 1; $i <= 20; $i++) {
                    echo "<option value='$i'>$i</option>";
                  }
                  ?>
                </select>
              </div>
            </div>
            <div class="col-lg-2 col-md-6 mb-3">
              <div class="form-field-wrapper">
                <label class="form-label">
                  <i class="bi bi-emoji-smile"></i>
                  <?php _e('children') ?>
                </label>
                <i class="bi bi-person-heart form-field-icon"></i>
                <select class="form-select shadow-none" name="children">
                  <?php
                  for ($i = 0; $i <= 15; $i++) {
                    echo "<option value='$i'>$i</option>";
                  }
                  ?>
                </select>
              </div>
            </div>
            <input type="hidden" name="check_availability">
            <div class="col-lg-2 col-md-12 mb-3">
              <div class="form-field-wrapper">
                <label class="form-label" style="opacity: 0; visibility: hidden;">
                  <i class="bi bi-search"></i>
                  <?php _e('search') ?>
                </label>
                <button type="submit" class="availability-search-btn text-white w-100">
                  <i class="bi bi-search"></i>
                  <?php _e('search') ?>
                </button>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>

  <!-- Our Rooms -->
  <section class="rooms-section py-5" aria-label="<?php _e('rooms_title') ?>">
    <div class="container">
      <header class="section-header text-center mb-5">
        <h2 class="mt-5 pt-4 mb-3 fw-bold h-font"><?php _e('rooms_title') ?></h2>
        <p class="text-muted mb-0"><?php _e('rooms_subtitle') ?></p>
        <div class="h-line bg-dark mx-auto mt-3"></div>
      </header>

      <div class="swiper swiper-rooms">
        <div class="swiper-wrapper">
        <?php

        $room_res = select(
          "SELECT r.*, pt.name AS prop_type_name, pt.slug AS prop_type_slug,
                  rt.name AS room_type_name, b.name AS building_name,
                  f.name AS view_name
           FROM `rooms` r
           LEFT JOIN `property_types` pt ON r.property_type_id = pt.id
           LEFT JOIN `room_types` rt ON r.room_type_id = rt.id
           LEFT JOIN `buildings` b ON r.building_id = b.id
           LEFT JOIN `features` f ON r.view_type_id = f.id
           WHERE r.`status`=? AND r.`removed`=?
           ORDER BY r.`id` DESC LIMIT 3",
          [1, 0], 'ii'
        );
        $rooms_data_json = [];

        while ($room_data = mysqli_fetch_assoc($room_res)) {
          // get facilities of room (for compact display)
          $fac_q = mysqli_query($con, "SELECT f.name FROM `facilities` f
              INNER JOIN `room_facilities` rfac ON f.id = rfac.facilities_id
              WHERE rfac.room_id = '{$room_data['id']}'");

          $facilities_list = [];
          while ($fac_row = mysqli_fetch_assoc($fac_q)) {
            $facilities_list[] = $fac_row['name'];
          }

          // Build truncated facilities (max 5 items)
          $max_show = 5;
          $total_fac = count($facilities_list);
          $facilities_html = "";
          for ($i = 0; $i < min($max_show, $total_fac); $i++) {
            $facilities_html .= "<span class='room-badge'><i class='bi bi-check-circle me-1'></i>{$facilities_list[$i]}</span>";
          }
          if ($total_fac > $max_show) {
            $remaining = $total_fac - $max_show;
            $facilities_html .= "<span class='room-badge room-badge-more'>+{$remaining} {$GLOBALS['_LANG']['more_amenities']}</span>";
          }

          // get features
          $fea_q = mysqli_query($con, "SELECT f.name FROM `features` f
              INNER JOIN `room_features` rfea ON f.id = rfea.features_id
              WHERE rfea.room_id = '{$room_data['id']}'");
          $features_list = [];
          while ($fea_row = mysqli_fetch_assoc($fea_q)) {
            $features_list[] = $fea_row['name'];
          }

          // get thumbnail of image
          $room_thumb = ROOMS_IMG_PATH . "thumbnail.jpg";
          $thumb_q = mysqli_query($con, "SELECT * FROM `room_images`
              WHERE `room_id`='{$room_data['id']}'
              AND `thumb`='1'");

          if (mysqli_num_rows($thumb_q) > 0) {
            $thumb_res = mysqli_fetch_assoc($thumb_q);
            $room_thumb = ROOMS_IMG_PATH . $thumb_res['image'];
          }

          // Format price
          $formatted_price = number_format($room_data['price'], 0, ',', '.');

          // Property type badge
          $prop_badge = "";
          if (!empty($room_data['prop_type_name'])) {
            $badge_class = ($room_data['prop_type_slug'] === 'villa') ? 'badge-villa' : 'badge-homestay';
            $prop_badge = "<span class='hp-prop-badge {$badge_class}'>{$room_data['prop_type_name']}</span>";
          }

          // View badge
          $view_badge = "";
          if (!empty($room_data['view_name'])) {
            $view_badge = "<span class='hp-view-badge'><i class='bi bi-eye me-1'></i>{$room_data['view_name']}</span>";
          }

          // Room specs
          $area_text = "";
          if (!empty($room_data['area'])) {
            $area_text = $room_data['area'];
            if (!empty($room_data['area_max']) && $room_data['area_max'] > $room_data['area']) {
              $area_text .= "-" . $room_data['area_max'];
            }
            $area_text .= "m²";
          }

          $bedroom_text = !empty($room_data['bedroom_count']) ? $room_data['bedroom_count'] . " " . $GLOBALS['_LANG']['bedroom_short'] : "";
          $bathroom_text = !empty($room_data['bathroom_count']) ? $room_data['bathroom_count'] . " " . $GLOBALS['_LANG']['bathroom_short'] : "";
          $guest_text = $room_data['adult'] . " " . $GLOBALS['_LANG']['adult_short'];
          if ($room_data['children'] > 0) {
            $guest_text .= ", " . $room_data['children'] . " " . $GLOBALS['_LANG']['children_short'];
          }

          // Rating
          $rating_q = "SELECT AVG(rating) AS `avg_rating`, COUNT(*) AS `review_count` FROM `rating_review`
              WHERE `room_id`='{$room_data['id']}' ORDER BY `sr_no` DESC LIMIT 20";
          $rating_res = mysqli_query($con, $rating_q);
          $rating_fetch = mysqli_fetch_assoc($rating_res);

          $rating_html = "";
          $avg_rating = 0;
          $review_count = 0;

          if ($rating_fetch['avg_rating'] != NULL && $rating_fetch['avg_rating'] > 0) {
            $avg_rating = round($rating_fetch['avg_rating'], 1);
            $review_count = (int)$rating_fetch['review_count'];
            $stars_html = "";
            for ($i = 0; $i < 5; $i++) {
              if ($i < floor($avg_rating)) {
                $stars_html .= "<i class='bi bi-star-fill text-warning'></i>";
              } elseif ($i < $avg_rating) {
                $stars_html .= "<i class='bi bi-star-half text-warning'></i>";
              } else {
                $stars_html .= "<i class='bi bi-star text-warning'></i>";
              }
            }
            $rating_html = "<div class='hp-rating'>
                {$stars_html}
                <span class='hp-rating-score'>{$avg_rating}</span>
                <span class='hp-rating-count'>({$review_count})</span>
              </div>";
          }

          // Building name
          $building_html = "";
          if (!empty($room_data['building_name'])) {
            $building_html = "<div class='hp-building'><i class='bi bi-building me-1'></i>{$room_data['building_name']}</div>";
          }

          // Prepare JSON-LD data for SEO
          $room_json = [
            "@type" => "HotelRoom",
            "name" => $room_data['name'],
            "description" => $GLOBALS['_LANG']['room_desc_at'] . " " . $settings_r['site_title'],
            "image" => $room_thumb,
            "offers" => [
              "@type" => "Offer",
              "price" => (int)$room_data['price'],
              "priceCurrency" => "VND",
              "availability" => "https://schema.org/InStock"
            ],
            "occupancy" => [
              "numberOfAdults" => (int)$room_data['adult'],
              "numberOfChildren" => (int)$room_data['children']
            ]
          ];

          $amenity_features = [];
          foreach ($features_list as $feature) {
            $amenity_features[] = ["@type" => "LocationFeatureSpecification", "name" => $feature];
          }
          foreach ($facilities_list as $facility) {
            $amenity_features[] = ["@type" => "LocationFeatureSpecification", "name" => $facility];
          }
          if (!empty($amenity_features)) {
            $room_json["amenityFeature"] = $amenity_features;
          }
          if ($avg_rating > 0 && $review_count > 0) {
            $room_json["aggregateRating"] = [
              "@type" => "AggregateRating",
              "ratingValue" => $avg_rating,
              "reviewCount" => $review_count
            ];
          }
          $rooms_data_json[] = $room_json;

          // print room card
          echo <<<data
            <article class="swiper-slide room-card-wrapper" itemscope itemtype="https://schema.org/HotelRoom">
              <div class="room-card h-100">
                <div class="room-image-wrapper">
                  <img src="$room_thumb"
                       alt="{$GLOBALS['_LANG']['image_of']} {$room_data['name']}"
                       class="room-image"
                       loading="lazy"
                       itemprop="image">
                  <div class="hp-image-overlay">
                    $prop_badge
                    $view_badge
                  </div>
                  <div class="room-price-badge">
                    <span class="price-amount" itemprop="offers" itemscope itemtype="https://schema.org/Offer">
                      <meta itemprop="price" content="{$room_data['price']}">
                      <meta itemprop="priceCurrency" content="VND">
                      <span class="price-value">$formatted_price</span>
                      <span class="price-unit">{$GLOBALS['_LANG']['vnd_per_night']}</span>
                    </span>
                  </div>
                </div>
                <div class="room-content">
                  <h3 class="room-title" itemprop="name">{$room_data['name']}</h3>

                  $building_html
                  $rating_html

                  <div class="hp-specs">
                    <span class="hp-spec" title="{$GLOBALS['_LANG']['area_label']}"><i class="bi bi-aspect-ratio"></i> $area_text</span>
                    <span class="hp-spec" title="{$GLOBALS['_LANG']['bedroom_label']}"><i class="bi bi-door-closed"></i> $bedroom_text</span>
                    <span class="hp-spec" title="{$GLOBALS['_LANG']['bathroom_label']}"><i class="bi bi-droplet"></i> $bathroom_text</span>
                    <span class="hp-spec" title="{$GLOBALS['_LANG']['capacity_label']}"><i class="bi bi-people"></i> $guest_text</span>
                  </div>

                  <div class="hp-facilities">
                    <div class="hp-facilities-list">
                      $facilities_html
                    </div>
                  </div>

                  <div class="room-actions">
                    <a href="room_details.php?id={$room_data['id']}"
                       class="btn btn-outline-primary room-detail-btn"
                       aria-label="{$GLOBALS['_LANG']['view_details']} {$room_data['name']}">
                      <i class="bi bi-arrow-right me-2"></i>{$GLOBALS['_LANG']['view_details']}
                    </a>
                  </div>
                </div>
              </div>
            </article>
          data;
        }

        // Output JSON-LD structured data
        if (!empty($rooms_data_json)) {
          echo '<script type="application/ld+json">';
          echo json_encode([
            "@context" => "https://schema.org",
            "@type" => "ItemList",
            "itemListElement" => array_map(function ($room, $index) {
              return [
                "@type" => "ListItem",
                "position" => $index + 1,
                "item" => $room
              ];
            }, $rooms_data_json, array_keys($rooms_data_json))
          ], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
          echo '</script>';
        }

        ?>
        </div>
        <div class="swiper-pagination rooms-pagination"></div>
      </div>

      <div class="text-center mt-5">
        <a href="rooms.php"
          class="btn btn-outline-primary btn-lg rooms-view-more-btn"
          aria-label="<?php echo __('view_details') . ' ' . __('rooms_title') ?>">
          <i class="bi bi-arrow-right-circle me-2"></i><?php _e('learn_more') ?>
        </a>
      </div>
    </div>
  </section>

  <!-- Du Thuyền Hạ Long -->
  <section class="cruises-section py-5" aria-label="<?php _e('cruises_title') ?>">
    <div class="container">
      <header class="section-header text-center mb-5">
        <h2 class="mt-5 pt-4 mb-3 fw-bold h-font"><?php _e('cruises_title') ?></h2>
        <p class="text-muted mb-0"><?php _e('cruises_subtitle') ?></p>
        <div class="h-line bg-dark mx-auto mt-3"></div>
      </header>

      <div class="swiper swiper-cruises">
        <div class="swiper-wrapper">
        <?php
        require_once('inc/cruises_data.php');
        $is_vi = current_lang() === 'vi';
        $hp_cruises = array_slice($cruises_data, 0, 6);
        $cruises_json_ld = [];
        $from_text = __('cruise_from_price');
        $per_person = __('cruise_per_person');
        $stars_text = __('cruise_stars');
        $detail_text = __('cruise_view_detail');
        $duration_text = __('cruise_2d1n');
        $review_text = __('cruise_rating');

        foreach ($hp_cruises as $slug => $cruise) {
          $desc = $is_vi ? $cruise['desc_vi'] : $cruise['desc_en'];
          $highlights = $is_vi ? $cruise['highlights'] : $cruise['highlights_en'];
          $detail_url = "cruise_details.php?id={$slug}";

          // Star icons
          $star_icons = '';
          for ($s = 0; $s < $cruise['class']; $s++) {
            $star_icons .= '<i class="bi bi-star-fill"></i>';
          }

          // Rating stars
          $rating_stars = '';
          $r = $cruise['rating'];
          for ($s = 0; $s < 5; $s++) {
            if ($s < floor($r)) $rating_stars .= '<i class="bi bi-star-fill text-warning"></i>';
            elseif ($s < $r) $rating_stars .= '<i class="bi bi-star-half text-warning"></i>';
            else $rating_stars .= '<i class="bi bi-star text-warning"></i>';
          }

          // Highlights (max 5)
          $highlights_html = '';
          $show_hl = min(5, count($highlights));
          for ($i = 0; $i < $show_hl; $i++) {
            $highlights_html .= "<span class='cruise-tag'><i class='bi bi-check2 me-1'></i>{$highlights[$i]}</span>";
          }

          // JSON-LD
          $cruises_json_ld[] = [
            "@type" => "TouristTrip",
            "name" => $cruise['name'],
            "description" => $desc,
            "touristType" => "Cruise",
            "offers" => ["@type" => "Offer", "price" => str_replace('.', '', $cruise['price_from']), "priceCurrency" => "VND"],
            "aggregateRating" => ["@type" => "AggregateRating", "ratingValue" => $cruise['rating'], "reviewCount" => $cruise['reviews'], "bestRating" => 5],
          ];

          $img = $cruise['image'];
          echo <<<CARD
            <article class="swiper-slide">
              <a href="{$detail_url}" class="cruise-card-link">
                <div class="cruise-card h-100">
                  <div class="cruise-image-wrapper">
                    <img src="{$img}" alt="{$cruise['name']} - Du thuyền Hạ Long" class="cruise-image" loading="lazy">
                    <div class="cruise-image-overlay">
                      <div class="cruise-class-badge">
                        <span class="cruise-star-icons">{$star_icons}</span>
                        <span class="cruise-class-text">{$cruise['class']} {$stars_text}</span>
                      </div>
                      <div class="cruise-price-badge">
                        <small>{$from_text}</small>
                        <strong>{$cruise['price_from']}</strong>
                        <small>VNĐ{$per_person}</small>
                      </div>
                    </div>
                  </div>
                  <div class="cruise-content">
                    <div class="cruise-title-row">
                      <h3 class="cruise-name">{$cruise['name']}</h3>
                      <span class="cruise-duration"><i class="bi bi-clock me-1"></i>{$duration_text}</span>
                    </div>
                    <p class="cruise-desc">{$desc}</p>
                    <div class="cruise-rating-row">
                      <div class="cruise-rating-stars">{$rating_stars}</div>
                      <span class="cruise-rating-score">{$cruise['rating']}</span>
                      <span class="cruise-rating-count">({$cruise['reviews']} {$review_text})</span>
                    </div>
                    <div class="cruise-tags">{$highlights_html}</div>
                    <span class="btn cruise-detail-btn">
                      <i class="bi bi-arrow-right me-2"></i>{$detail_text}
                    </span>
                  </div>
                </div>
              </a>
            </article>
          CARD;
        }

        // JSON-LD
        echo '<script type="application/ld+json">';
        echo json_encode([
          "@context" => "https://schema.org", "@type" => "ItemList",
          "name" => $GLOBALS['_LANG']['cruises_title'],
          "numberOfItems" => count($cruises_json_ld),
          "itemListElement" => array_map(function ($item, $idx) {
            return ["@type" => "ListItem", "position" => $idx + 1, "item" => $item];
          }, $cruises_json_ld, array_keys($cruises_json_ld)),
        ], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
        echo '</script>';
        ?>
        </div>
        <div class="swiper-pagination cruises-pagination"></div>
      </div>
    </div>
  </section>

  <!-- Testimonials -->
  <section class="testimonials-section py-5" aria-label="<?php _e('reviews_title') ?>">
    <div class="container">
      <header class="section-header text-center mb-5">
        <h2 class="mt-5 pt-4 mb-3 fw-bold h-font"><?php _e('reviews_title') ?></h2>
        <p class="text-muted mb-0"><?php _e('reviews_subtitle') ?></p>
        <div class="h-line bg-dark mx-auto mt-3"></div>
      </header>

      <div class="testimonials-container">
        <div class="swiper swiper-testimonials">
          <div class="swiper-wrapper">
            <?php

            $review_q = "SELECT rr.*,uc.name AS uname, uc.profile, r.name AS rname FROM `rating_review` rr
                INNER JOIN `user_cred` uc ON rr.user_id = uc.id
                INNER JOIN `rooms` r ON rr.room_id = r.id
                ORDER BY `sr_no` DESC LIMIT 6";

            $review_res = mysqli_query($con, $review_q);
            $img_path = USERS_IMG_PATH;
            $reviews_data_json = [];

            if (mysqli_num_rows($review_res) == 0) {
              echo '<div class="col-12 text-center py-5">
                <div class="no-reviews-message">
                  <i class="bi bi-chat-quote fs-1 text-muted mb-3 d-block"></i>
                  <p class="text-muted">' . __('no_reviews') . '</p>
                </div>
              </div>';
            } else {
              while ($row = mysqli_fetch_assoc($review_res)) {
                $stars_html = "";
                $rating = (int)$row['rating'];

                for ($i = 0; $i < 5; $i++) {
                  if ($i < $rating) {
                    $stars_html .= "<i class='bi bi-star-fill text-warning' aria-hidden='true'></i>";
                  } else {
                    $stars_html .= "<i class='bi bi-star text-warning' aria-hidden='true'></i>";
                  }
                }

                // Prepare JSON-LD data for reviews
                $reviews_data_json[] = [
                  "@type" => "Review",
                  "author" => [
                    "@type" => "Person",
                    "name" => $row['uname'],
                    "image" => $img_path . $row['profile']
                  ],
                  "reviewRating" => [
                    "@type" => "Rating",
                    "ratingValue" => $rating,
                    "bestRating" => 5
                  ],
                  "reviewBody" => $row['review'],
                  "itemReviewed" => [
                    "@type" => "HotelRoom",
                    "name" => $row['rname']
                  ]
                ];

                $review_date = isset($row['datentime']) && !empty($row['datentime']) ? date('d/m/Y', strtotime($row['datentime'])) : '';
                $review_date_html = '';

                if (!empty($review_date)) {
                  $review_date_html = "<div class='testimonial-date text-muted small mt-2'>
                    <i class='bi bi-calendar3 me-1'></i>$review_date
                  </div>";
                }

                echo <<<slides
                  <article class="swiper-slide testimonial-card" itemscope itemtype="https://schema.org/Review">
                    <div class="testimonial-content">
                      <div class="testimonial-header">
                        <div class="testimonial-profile">
                          <img src="$img_path$row[profile]" 
                               alt="{$GLOBALS['_LANG']['image_of']} $row[uname]" 
                               class="testimonial-avatar"
                               loading="lazy"
                               itemprop="author" itemscope itemtype="https://schema.org/Person">
                          <meta itemprop="name" content="$row[uname]">
                          <div class="testimonial-info">
                            <h6 class="testimonial-name" itemprop="name">$row[uname]</h6>
                            <p class="testimonial-room text-muted small mb-0">
                              <i class="bi bi-door-open me-1"></i>$row[rname]
                            </p>
                          </div>
                        </div>
                        <div class="testimonial-rating" itemprop="reviewRating" itemscope itemtype="https://schema.org/Rating">
                          <meta itemprop="ratingValue" content="$rating">
                          <meta itemprop="bestRating" content="5">
                          <div class="rating-stars" aria-label="$rating {$GLOBALS['_LANG']['rating_of_5']}">
                            $stars_html
                          </div>
                        </div>
                      </div>
                      <div class="testimonial-body">
                        <p class="testimonial-text" itemprop="reviewBody">
                          "$row[review]"
                        </p>
                        $review_date_html
                      </div>
                    </div>
                  </article>
                slides;
              }

              // Output JSON-LD structured data for reviews
              if (!empty($reviews_data_json)) {
                echo '<script type="application/ld+json">';
                echo json_encode([
                  "@context" => "https://schema.org",
                  "@type" => "ItemList",
                  "name" => $GLOBALS['_LANG']['reviews_title'],
                  "itemListElement" => array_map(function ($review, $index) {
                    return [
                      "@type" => "ListItem",
                      "position" => $index + 1,
                      "item" => $review
                    ];
                  }, $reviews_data_json, array_keys($reviews_data_json))
                ], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
                echo '</script>';
              }
            }

            ?>
          </div>
          <div class="swiper-pagination testimonials-pagination"></div>
        </div>
      </div>
    </div>
  </section>

  <!-- Reach us -->
  <section class="contact-section py-5" aria-label="<?php _e('contact_title') ?>">
    <div class="container">
      <header class="section-header text-center mb-5">
        <h2 class="mt-5 pt-4 mb-3 fw-bold h-font"><?php _e('contact_title') ?></h2>
        <p class="text-muted mb-0"><?php _e('contact_subtitle') ?></p>
        <div class="h-line bg-dark mx-auto mt-3"></div>
      </header>

      <div class="row g-4">
        <div class="col-lg-8 col-md-7">
          <div class="contact-map-wrapper">
            <div class="map-container">
              <?php echo $contact_r['iframe'] ?? '' ?>
            </div>
          </div>
        </div>

        <div class="col-lg-4 col-md-5">
          <div class="contact-info-wrapper">
            <!-- Contact Phone -->
            <div class="contact-card mb-4" itemscope itemtype="https://schema.org/ContactPoint">
              <div class="contact-card-header">
                <div class="contact-icon-wrapper phone-icon">
                  <i class="bi bi-telephone-fill"></i>
                </div>
                <h5 class="contact-card-title"><?php _e('hotline') ?></h5>
              </div>
              <div class="contact-card-body">
                <a href="tel:+<?php echo str_replace(' ', '', $contact_r['pn1']) ?>"
                  class="contact-link phone-link"
                  itemprop="telephone"
                  aria-label="<?php _e('support_hotline') ?>"
                  <i class="bi bi-telephone me-2"></i>
                  <span>+<?php echo $contact_r['pn1'] ?></span>
                </a>
                <meta itemprop="contactType" content="customer service">
                <meta itemprop="areaServed" content="VN">
              </div>
            </div>

            <!-- Social Media -->
            <div class="contact-card mb-4">
              <div class="contact-card-header">
                <div class="contact-icon-wrapper social-icon">
                  <i class="bi bi-share-fill"></i>
                </div>
                <h5 class="contact-card-title"><?php _e('follow_us') ?></h5>
              </div>
              <div class="contact-card-body">
                <div class="social-links">
                  <?php
                  if ($contact_r['tw'] != '') {
                    echo <<<data
                      <a href="$contact_r[tw]" 
                         class="social-link twitter-link"
                         target="_blank"
                         rel="noopener noreferrer"
                         aria-label="{$GLOBALS['_LANG']['follow_us']} Twitter">
                        <div class="social-icon-wrapper">
                          <i class="bi bi-twitter"></i>
                        </div>
                        <span>Twitter</span>
                      </a>
                    data;
                  }
                  ?>

                  <a href="<?php echo htmlspecialchars($contact_r['fb'] ?? '') ?>"
                    class="social-link facebook-link"
                    target="_blank"
                    rel="noopener noreferrer"
                    aria-label="<?php echo __('follow_us') ?> Facebook">
                    <div class="social-icon-wrapper">
                      <i class="bi bi-facebook"></i>
                    </div>
                    <span>Facebook</span>
                  </a>

                  <a href="<?php echo htmlspecialchars($contact_r['zalo'] ?? '') ?>"
                    class="social-link zalo-link"
                    target="_blank"
                    rel="noopener noreferrer"
                    aria-label="<?php echo __('follow_us') ?> Zalo">
                    <div class="social-icon-wrapper">
                      <i class="bi bi-chat-dots-fill"></i>
                    </div>
                    <span>Zalo</span>
                  </a>
                </div>
              </div>
            </div>

            <!-- About Link -->
            <!-- <div class="contact-card">
              <div class="contact-card-body text-center">
                <a href="about.php"
                  class="btn btn-outline-primary btn-lg w-100 contact-about-btn"
                  aria-label="Tìm hiểu thêm về chúng tôi">
                  <i class="bi bi-info-circle me-2"></i>Tìm hiểu thêm
                </a>
              </div>
            </div> -->
          </div>
        </div>
      </div>

      <!-- JSON-LD Structured Data for Contact -->
      <script type="application/ld+json">
        {
          "@context": "https://schema.org",
          "@type": "Hotel",
          "name": "<?php echo $settings_r['site_title'] ?>",
          "telephone": "+<?php echo str_replace(' ', '', $contact_r['pn1']) ?>",
          "contactPoint": {
            "@type": "ContactPoint",
            "telephone": "+<?php echo str_replace(' ', '', $contact_r['pn1']) ?>",
            "contactType": "customer service",
            "areaServed": "VN"
          }
          <?php
          $sameAs = [];
          if ($contact_r['fb'] != '') $sameAs[] = $contact_r['fb'];
          if ($contact_r['zalo'] != '') $sameAs[] = $contact_r['zalo'];
          if ($contact_r['tw'] != '') $sameAs[] = $contact_r['tw'];
          if (!empty($sameAs)) {
            echo ',
          "sameAs": ' . json_encode($sameAs);
          }
          ?>
        }
      </script>
    </div>
  </section>

  <!-- Password reset modal and code -->

  <div class="modal fade" id="recoveryModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <form id="recovery-form">
          <div class="modal-header">
            <h5 class="modal-title d-flex align-items-center">
              <i class="bi bi-shield-lock fs-3 me-2"></i> <?php _e('create_new_password') ?>
            </h5>
          </div>
          <div class="modal-body">
            <div class="mb-4">
              <label class="form-label"><?php _e('new_password') ?></label>
              <input type="password" name="pass" required class="form-control shadow-none">
              <input type="hidden" name="email">
              <input type="hidden" name="token">
            </div>
            <div class="mb-2 text-end">
              <button type="button" class="btn shadow-none me-2" data-bs-dismiss="modal"><?php _e('cancel') ?></button>
              <button type="submit" class="btn btn-dark shadow-none"><?php _e('continue') ?></button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>


  <?php require('inc/footer.php'); ?>

  <?php

  if (isset($_GET['account_recovery'])) {
    $data = filteration($_GET);

    $t_date = date("Y-m-d");

    $query = select(
      "SELECT * FROM `user_cred` WHERE `email`=? AND `token`=? AND `t_expire`=? LIMIT 1",
      [$data['email'], $data['token'], $t_date],
      'sss'
    );

    if (mysqli_num_rows($query) == 1) {
      echo <<<showModal
          <script>
            var myModal = document.getElementById('recoveryModal');

            myModal.querySelector("input[name='email']").value = '$data[email]';
            myModal.querySelector("input[name='token']").value = '$data[token]';

            var modal = bootstrap.Modal.getOrCreateInstance(myModal);
            modal.show();
          </script>
        showModal;
    } else {
      alert("error", __('link_expired'));
    }
  }

  ?>

  <script src="https://unpkg.com/swiper@7/swiper-bundle.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

  <script>
    var swiper = new Swiper(".swiper-container", {
      spaceBetween: 30,
      effect: "fade",
      loop: true,
      autoplay: {
        delay: 3500,
        disableOnInteraction: false,
      }
    });

    // Rooms swiper (mobile only)
    var roomsSwiper = null;
    var cruisesSwiper = null;

    function initMobileSwipers() {
      if (window.innerWidth < 768) {
        if (!roomsSwiper) {
          roomsSwiper = new Swiper(".swiper-rooms", {
            slidesPerView: 1.15,
            spaceBetween: 16,
            grabCursor: true,
            pagination: {
              el: ".rooms-pagination",
              clickable: true,
            },
          });
        }
        if (!cruisesSwiper) {
          cruisesSwiper = new Swiper(".swiper-cruises", {
            slidesPerView: 1.15,
            spaceBetween: 16,
            grabCursor: true,
            pagination: {
              el: ".cruises-pagination",
              clickable: true,
            },
          });
        }
      } else {
        if (roomsSwiper) {
          roomsSwiper.destroy(true, true);
          roomsSwiper = null;
        }
        if (cruisesSwiper) {
          cruisesSwiper.destroy(true, true);
          cruisesSwiper = null;
        }
      }
    }

    initMobileSwipers();
    window.addEventListener('resize', initMobileSwipers);

    var swiper = new Swiper(".swiper-testimonials", {
      effect: "coverflow",
      grabCursor: true,
      centeredSlides: true,
      slidesPerView: "auto",
      slidesPerView: "3",
      loop: true,
      coverflowEffect: {
        rotate: 50,
        stretch: 0,
        depth: 100,
        modifier: 1,
        slideShadows: false,
      },
      pagination: {
        el: ".testimonials-pagination",
      },
      breakpoints: {
        320: {
          slidesPerView: 1,
        },
        640: {
          slidesPerView: 1,
        },
        768: {
          slidesPerView: 2,
        },
        1024: {
          slidesPerView: 3,
        },
      }
    });

    // recover account

    let recovery_form = document.getElementById('recovery-form');

    recovery_form.addEventListener('submit', (e) => {
      e.preventDefault();

      let data = new FormData();

      data.append('email', recovery_form.elements['email'].value);
      data.append('token', recovery_form.elements['token'].value);
      data.append('pass', recovery_form.elements['pass'].value);
      data.append('recover_user', '');

      var myModal = document.getElementById('recoveryModal');
      var modal = bootstrap.Modal.getInstance(myModal);
      modal.hide();

      let xhr = new XMLHttpRequest();
      xhr.open("POST", "ajax/login_register.php", true);

      xhr.onload = function() {
        if (this.responseText == 'failed') {
          alert('error', "<?php _e('recovery_failed') ?>");
        } else {
          alert('success', "<?php _e('recovery_success') ?>");
          recovery_form.reset();
        }
      }

      xhr.send(data);
    });

    // Vietnamese locale for Flatpickr
    flatpickr.localize({
      firstDayOfWeek: 1,
      weekdays: {
        shorthand: <?php echo json_encode(explode(',', __('fp_weekdays_short'))); ?>,
        longhand: <?php echo json_encode(explode(',', __('fp_weekdays_long'))); ?>
      },
      months: {
        shorthand: <?php echo json_encode(explode(',', __('fp_months_short'))); ?>,
        longhand: <?php echo json_encode(explode(',', __('fp_months_long'))); ?>
      }
    });

    const checkinPicker = flatpickr("input[name='checkin']", {
      dateFormat: "Y-m-d",
      minDate: "today",
      onChange: function(selectedDates, dateStr, instance) {
        const checkoutPicker = flatpickr("input[name='checkout']");
        if (checkoutPicker && dateStr && selectedDates.length > 0) {
          const nextDay = new Date(selectedDates[0]);
          nextDay.setDate(nextDay.getDate() + 1);
          checkoutPicker.set('minDate', nextDay);
        }
      }
    });

    const checkoutPicker = flatpickr("input[name='checkout']", {
      dateFormat: "Y-m-d",
      minDate: "today"
    });
  </script>

</body>

</html>