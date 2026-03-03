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
  <title><?php echo $settings_r['site_title'] ?> - Trang chủ</title>
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
          Tiến hành đặt phòng
        </h5>
        <form action="rooms.php">
          <div class="row align-items-end">
            <div class="col-lg-3 col-md-6 mb-3">
              <div class="form-field-wrapper">
                <label class="form-label">
                  <i class="bi bi-calendar-event"></i>
                  Nhận phòng
                </label>
                <i class="bi bi-calendar3 form-field-icon"></i>
                <input type="date" class="form-control shadow-none" name="checkin" placeholder="dd/mm/yyyy" required>
              </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-3">
              <div class="form-field-wrapper">
                <label class="form-label">
                  <i class="bi bi-calendar-x"></i>
                  Trả phòng
                </label>
                <i class="bi bi-calendar3 form-field-icon"></i>
                <input type="date" class="form-control shadow-none" name="checkout" placeholder="dd/mm/yyyy" required>
              </div>
            </div>
            <div class="col-lg-2 col-md-6 mb-3">
              <div class="form-field-wrapper">
                <label class="form-label">
                  <i class="bi bi-people"></i>
                  Người lớn
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
                  Trẻ em
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
                  Tìm kiếm
                </label>
                <button type="submit" class="availability-search-btn text-white w-100">
                  <i class="bi bi-search"></i>
                  Tìm kiếm
                </button>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>

  <!-- Our Rooms -->
  <section class="rooms-section py-5" aria-label="Danh sách phòng">
    <div class="container">
      <header class="section-header text-center mb-5">
        <h2 class="mt-5 pt-4 mb-3 fw-bold h-font">Danh sách phòng</h2>
        <p class="text-muted mb-0">Khám phá các phòng nghỉ tiện nghi và thoải mái của chúng tôi</p>
        <div class="h-line bg-dark mx-auto mt-3"></div>
      </header>

      <div class="row g-4">
        <?php

        $room_res = select("SELECT * FROM `rooms` WHERE `status`=? AND `removed`=? ORDER BY `id` DESC LIMIT 3", [1, 0], 'ii');
        $rooms_data_json = [];

        while ($room_data = mysqli_fetch_assoc($room_res)) {
          // get features of room
          $fea_q = mysqli_query($con, "SELECT f.name FROM `features` f 
              INNER JOIN `room_features` rfea ON f.id = rfea.features_id 
              WHERE rfea.room_id = '$room_data[id]'");

          $features_data = "";
          $features_list = [];
          while ($fea_row = mysqli_fetch_assoc($fea_q)) {
            $features_list[] = $fea_row['name'];
            $features_data .= "<span class='room-badge' aria-label='Tính năng: {$fea_row['name']}'>
                <i class='bi bi-check-circle me-1'></i>{$fea_row['name']}
              </span>";
          }

          // get facilities of room
          $fac_q = mysqli_query($con, "SELECT f.name FROM `facilities` f 
              INNER JOIN `room_facilities` rfac ON f.id = rfac.facilities_id 
              WHERE rfac.room_id = '$room_data[id]'");

          $facilities_data = "";
          $facilities_list = [];
          while ($fac_row = mysqli_fetch_assoc($fac_q)) {
            $facilities_list[] = $fac_row['name'];
            $facilities_data .= "<span class='room-badge' aria-label='Tiện ích: {$fac_row['name']}'>
                <i class='bi bi-check-circle me-1'></i>{$fac_row['name']}
              </span>";
          }

          // get thumbnail of image
          $room_thumb = ROOMS_IMG_PATH . "thumbnail.jpg";
          $thumb_q = mysqli_query($con, "SELECT * FROM `room_images` 
              WHERE `room_id`='$room_data[id]' 
              AND `thumb`='1'");

          if (mysqli_num_rows($thumb_q) > 0) {
            $thumb_res = mysqli_fetch_assoc($thumb_q);
            $room_thumb = ROOMS_IMG_PATH . $thumb_res['image'];
          }

          // Format price
          $formatted_price = number_format($room_data['price'], 0, ',', '.');

          $book_btn = "";

          if (!$settings_r['shutdown']) {
            $login = 0;
            if (isset($_SESSION['login']) && $_SESSION['login'] == true) {
              $login = 1;
            }

            $book_btn = "<button onclick='checkLoginToBook($login,$room_data[id])' class='btn btn-primary room-book-btn' aria-label='Đặt phòng {$room_data['name']}'>
                <i class='bi bi-calendar-check me-2'></i>Đặt ngay
              </button>";
          }

          $rating_q = "SELECT AVG(rating) AS `avg_rating`, COUNT(*) AS `review_count` FROM `rating_review`
              WHERE `room_id`='$room_data[id]' ORDER BY `sr_no` DESC LIMIT 20";

          $rating_res = mysqli_query($con, $rating_q);
          $rating_fetch = mysqli_fetch_assoc($rating_res);

          $rating_data = "";
          $avg_rating = 0;
          $review_count = 0;

          if ($rating_fetch['avg_rating'] != NULL && $rating_fetch['avg_rating'] > 0) {
            $avg_rating = round($rating_fetch['avg_rating'], 1);
            $review_count = isset($rating_fetch['review_count']) ? (int)$rating_fetch['review_count'] : 0;
            $stars_html = "";

            for ($i = 0; $i < 5; $i++) {
              if ($i < floor($avg_rating)) {
                $stars_html .= "<i class='bi bi-star-fill text-warning' aria-hidden='true'></i>";
              } elseif ($i < $avg_rating) {
                $stars_html .= "<i class='bi bi-star-half text-warning' aria-hidden='true'></i>";
              } else {
                $stars_html .= "<i class='bi bi-star text-warning' aria-hidden='true'></i>";
              }
            }

            $rating_data = "<div class='room-rating' aria-label='Đánh giá: {$avg_rating} trên 5 sao'>
                <div class='rating-stars mb-1'>
                  $stars_html
                </div>
                <div class='rating-text'>
                  <span class='fw-bold'>{$avg_rating}</span>
                  <span class='text-muted small ms-1'>({$review_count} đánh giá)</span>
                </div>
              </div>";
          }

          // Prepare JSON-LD data for SEO
          $room_json = [
            "@type" => "HotelRoom",
            "name" => $room_data['name'],
            "description" => "Phòng nghỉ tại " . $settings_r['site_title'],
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

          // Add amenity features if available
          $amenity_features = [];
          foreach ($features_list as $feature) {
            $amenity_features[] = [
              "@type" => "LocationFeatureSpecification",
              "name" => $feature
            ];
          }
          foreach ($facilities_list as $facility) {
            $amenity_features[] = [
              "@type" => "LocationFeatureSpecification",
              "name" => $facility
            ];
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
            <article class="col-lg-4 col-md-6 room-card-wrapper" itemscope itemtype="https://schema.org/HotelRoom">
              <div class="room-card h-100">
                <div class="room-image-wrapper">
                  <img src="$room_thumb" 
                       alt="Hình ảnh phòng {$room_data['name']}" 
                       class="room-image" 
                       loading="lazy"
                       itemprop="image">
                  <div class="room-price-badge">
                    <span class="price-amount" itemprop="offers" itemscope itemtype="https://schema.org/Offer">
                      <meta itemprop="price" content="{$room_data['price']}">
                      <meta itemprop="priceCurrency" content="VND">
                      <span class="price-value">$formatted_price</span>
                      <span class="price-unit">VNĐ/đêm</span>
                    </span>
                  </div>
                </div>
                <div class="room-content">
                  <h3 class="room-title" itemprop="name">$room_data[name]</h3>
                  
                  $rating_data
                  
                  <div class="room-features">
                    <h4 class="feature-title">
                      <i class="bi bi-grid-3x3-gap me-2"></i>Không gian
                    </h4>
                    <div class="feature-badges">
                      $features_data
                    </div>
                  </div>
                  
                  <div class="room-facilities">
                    <h4 class="feature-title">
                      <i class="bi bi-star me-2"></i>Tiện ích
                    </h4>
                    <div class="feature-badges">
                      $facilities_data
                    </div>
                  </div>
                  
                  <div class="room-guests">
                    <div class="guest-info">
                      <i class="bi bi-people-fill me-2"></i>
                      <span itemprop="occupancy" itemscope itemtype="https://schema.org/QuantitativeValue">
                        <meta itemprop="value" content="{$room_data['adult']}">
                        <strong>{$room_data['adult']}</strong> Người lớn
                      </span>
                      <span class="mx-2">•</span>
                      <span itemprop="occupancy" itemscope itemtype="https://schema.org/QuantitativeValue">
                        <meta itemprop="value" content="{$room_data['children']}">
                        <strong>{$room_data['children']}</strong> Trẻ em
                      </span>
                    </div>
                  </div>
                  
                  <div class="room-actions">
                    $book_btn
                    <a href="room_details.php?id=$room_data[id]" 
                       class="btn btn-outline-primary room-detail-btn"
                       aria-label="Xem chi tiết phòng {$room_data['name']}">
                      <i class="bi bi-arrow-right me-2"></i>Chi tiết
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

        <div class="col-12 text-center mt-5">
          <a href="rooms.php"
            class="btn btn-outline-primary btn-lg rooms-view-more-btn"
            aria-label="Xem tất cả các phòng">
            <i class="bi bi-arrow-right-circle me-2"></i>Tìm hiểu thêm
          </a>
        </div>
      </div>
    </div>
  </section>

  <!-- Our Facilities -->
  <section class="facilities-section py-5" aria-label="Các tiện tích">
    <div class="container">
      <header class="section-header text-center mb-5">
        <h2 class="mt-5 pt-4 mb-3 fw-bold h-font">Các tiện tích</h2>
        <p class="text-muted mb-0">Trải nghiệm các tiện ích đẳng cấp tại khách sạn của chúng tôi</p>
        <div class="h-line bg-dark mx-auto mt-3"></div>
      </header>

      <div class="row g-4 justify-content-center">
        <?php
        $res = mysqli_query($con, "SELECT * FROM `facilities` ORDER BY `id` DESC LIMIT 5");
        $path = FACILITIES_IMG_PATH;
        $facilities_data_json = [];

        while ($row = mysqli_fetch_assoc($res)) {
          $facilities_data_json[] = [
            "@type" => "LocationFeatureSpecification",
            "name" => $row['name'],
            "value" => true
          ];

          echo <<<data
            <div class="col-lg-2 col-md-4 col-sm-6 facility-item" itemscope itemtype="https://schema.org/LocationFeatureSpecification">
              <div class="facility-card h-100">
                <div class="facility-icon-wrapper">
                  <img src="$path$row[icon]" 
                       alt="Icon $row[name]" 
                       class="facility-icon"
                       loading="lazy"
                       itemprop="image">
                </div>
                <h5 class="facility-name mt-3" itemprop="name">$row[name]</h5>
                <meta itemprop="value" content="true">
              </div>
            </div>
          data;
        }

        // Output JSON-LD structured data for facilities
        if (!empty($facilities_data_json)) {
          echo '<script type="application/ld+json">';
          echo json_encode([
            "@context" => "https://schema.org",
            "@type" => "ItemList",
            "name" => "Các tiện tích khách sạn",
            "itemListElement" => array_map(function ($facility, $index) {
              return [
                "@type" => "ListItem",
                "position" => $index + 1,
                "item" => $facility
              ];
            }, $facilities_data_json, array_keys($facilities_data_json))
          ], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
          echo '</script>';
        }
        ?>

        <div class="col-12 text-center mt-5">
          <a href="facilities.php"
            class="btn btn-outline-primary btn-lg facilities-view-more-btn"
            aria-label="Xem tất cả các tiện tích">
            <i class="bi bi-arrow-right-circle me-2"></i>Tìm hiểu thêm
          </a>
        </div>
      </div>
    </div>
  </section>

  <!-- Testimonials -->
  <section class="testimonials-section py-5" aria-label="Đánh giá dịch vụ">
    <div class="container">
      <header class="section-header text-center mb-5">
        <h2 class="mt-5 pt-4 mb-3 fw-bold h-font">Đánh giá dịch vụ</h2>
        <p class="text-muted mb-0">Những chia sẻ chân thực từ khách hàng đã trải nghiệm dịch vụ của chúng tôi</p>
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
                  <p class="text-muted">Chưa có đánh giá nào. Hãy là người đầu tiên đánh giá!</p>
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
                               alt="Ảnh đại diện của $row[uname]" 
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
                          <div class="rating-stars" aria-label="Đánh giá $rating trên 5 sao">
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
                  "name" => "Đánh giá dịch vụ khách sạn",
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
  <section class="contact-section py-5" aria-label="Liên hệ">
    <div class="container">
      <header class="section-header text-center mb-5">
        <h2 class="mt-5 pt-4 mb-3 fw-bold h-font">Liên hệ</h2>
        <p class="text-muted mb-0">Chúng tôi luôn sẵn sàng hỗ trợ và giải đáp mọi thắc mắc của bạn</p>
        <div class="h-line bg-dark mx-auto mt-3"></div>
      </header>

      <div class="row g-4">
        <div class="col-lg-8 col-md-7">
          <div class="contact-map-wrapper">
            <div class="map-container">
              <iframe
                class="contact-map"
                height="400px"
                src="<?php echo $contact_r['iframe'] ?>"
                loading="lazy"
                title="Bản đồ vị trí khách sạn"
                allowfullscreen
                aria-label="Bản đồ vị trí khách sạn">
              </iframe>
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
                <h5 class="contact-card-title">Tổng đài viên</h5>
              </div>
              <div class="contact-card-body">
                <a href="tel:+<?php echo str_replace(' ', '', $contact_r['pn1']) ?>"
                  class="contact-link phone-link"
                  itemprop="telephone"
                  aria-label="Gọi điện thoại đến tổng đài">
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
                <h5 class="contact-card-title">Theo dõi chúng tôi</h5>
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
                         aria-label="Theo dõi chúng tôi trên Twitter">
                        <div class="social-icon-wrapper">
                          <i class="bi bi-twitter"></i>
                        </div>
                        <span>Twitter</span>
                      </a>
                    data;
                  }
                  ?>

                  <a href="<?php echo $contact_r['fb'] ?>"
                    class="social-link facebook-link"
                    target="_blank"
                    rel="noopener noreferrer"
                    aria-label="Theo dõi chúng tôi trên Facebook">
                    <div class="social-icon-wrapper">
                      <i class="bi bi-facebook"></i>
                    </div>
                    <span>Facebook</span>
                  </a>

                  <a href="<?php echo $contact_r['zalo'] ?>"
                    class="social-link zalo-link"
                    target="_blank"
                    rel="noopener noreferrer"
                    aria-label="Liên hệ với chúng tôi qua Zalo">
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
              <i class="bi bi-shield-lock fs-3 me-2"></i> Tạo mật khẩu mới
            </h5>
          </div>
          <div class="modal-body">
            <div class="mb-4">
              <label class="form-label">Mật khẩu mới</label>
              <input type="password" name="pass" required class="form-control shadow-none">
              <input type="hidden" name="email">
              <input type="hidden" name="token">
            </div>
            <div class="mb-2 text-end">
              <button type="button" class="btn shadow-none me-2" data-bs-dismiss="modal">Huỷ</button>
              <button type="submit" class="btn btn-dark shadow-none">Tiếp tục</button>
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
      alert("error", "Liên kết không còn khả dụng!");
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
        el: ".swiper-pagination",
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
          alert('error', "Khôi phục tài khoản thất bại!");
        } else {
          alert('success', "Khôi phục tài khoản thành công!");
          recovery_form.reset();
        }
      }

      xhr.send(data);
    });

    // Vietnamese locale for Flatpickr
    flatpickr.localize({
      firstDayOfWeek: 1,
      weekdays: {
        shorthand: ["CN", "T2", "T3", "T4", "T5", "T6", "T7"],
        longhand: ["Chủ nhật", "Thứ hai", "Thứ ba", "Thứ tư", "Thứ năm", "Thứ sáu", "Thứ bảy"]
      },
      months: {
        shorthand: ["T1", "T2", "T3", "T4", "T5", "T6", "T7", "T8", "T9", "T10", "T11", "T12"],
        longhand: ["Tháng 1", "Tháng 2", "Tháng 3", "Tháng 4", "Tháng 5", "Tháng 6", "Tháng 7", "Tháng 8", "Tháng 9", "Tháng 10", "Tháng 11", "Tháng 12"]
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