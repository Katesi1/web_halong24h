<!DOCTYPE html>
<html lang="vi">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <?php require('inc/links.php'); ?>
  <?php require('inc/cruises_data.php'); ?>
  <?php
  $cruise_id = isset($_GET['id']) ? htmlspecialchars($_GET['id']) : '';
  if (!isset($cruises_data[$cruise_id])) {
    redirect('cruises.php');
    exit;
  }
  $cruise = $cruises_data[$cruise_id];
  $is_vi = current_lang() === 'vi';
  $desc = $is_vi ? $cruise['long_desc_vi'] : $cruise['long_desc_en'];
  $short_desc = $is_vi ? $cruise['desc_vi'] : $cruise['desc_en'];
  $route = $is_vi ? $cruise['route_vi'] : $cruise['route_en'];
  $highlights = $is_vi ? $cruise['highlights'] : $cruise['highlights_en'];
  $itinerary = $is_vi ? $cruise['itinerary_vi'] : $cruise['itinerary_en'];
  $cabins = $is_vi ? $cruise['cabins_vi'] : $cruise['cabins_en'];
  $amenities_list = $is_vi ? $cruise['amenities'] : $cruise['amenities_en'];
  ?>
  <link rel="stylesheet" href="css/cruises.css">
  <title><?php echo $settings_r['site_title'] ?> - <?php echo $cruise['name'] ?></title>
  <meta name="description" content="<?php echo htmlspecialchars($short_desc) ?>">
</head>

<body class="bg-light">

  <?php require('inc/header.php'); ?>

  <!-- Hero -->
  <div class="cd-hero" style="background-image: url('<?php echo $cruise['image'] ?>')">
    <div class="cd-hero-overlay"></div>
    <div class="container position-relative">
      <nav aria-label="breadcrumb" class="cruise-breadcrumb">
        <ol class="breadcrumb mb-0">
          <li class="breadcrumb-item"><a href="index.php"><?php _e('nav_home') ?></a></li>
          <li class="breadcrumb-item"><a href="cruises.php"><?php _e('cruises_title') ?></a></li>
          <li class="breadcrumb-item active" aria-current="page"><?php echo $cruise['name'] ?></li>
        </ol>
      </nav>
      <div class="cd-hero-content">
        <div class="cd-hero-stars">
          <?php for ($i = 0; $i < $cruise['class']; $i++) echo '<i class="bi bi-star-fill"></i>'; ?>
          <span><?php echo $cruise['class'] ?> <?php _e('cruise_stars') ?></span>
        </div>
        <h1 class="cd-hero-title h-font"><?php echo $cruise['name'] ?></h1>
        <div class="cd-hero-meta">
          <span><i class="bi bi-geo-alt me-1"></i><?php echo $route ?></span>
          <span><i class="bi bi-door-closed me-1"></i><?php echo $cruise['cabin_count'] ?> <?php _e('cruise_cabins') ?></span>
          <span><i class="bi bi-calendar3 me-1"></i><?php _e('cruise_launched') ?> <?php echo $cruise['year_launched'] ?></span>
          <span><i class="bi bi-clock me-1"></i><?php _e('cruise_2d1n') ?></span>
        </div>
        <div class="cd-hero-price">
          <span class="cd-price-label"><?php _e('cruise_from_price') ?></span>
          <span class="cd-price-value"><?php echo $cruise['price_from'] ?> <small>VNĐ<?php _e('cruise_per_person') ?></small></span>
        </div>
      </div>
    </div>
  </div>

  <!-- Tabs Navigation -->
  <div class="cd-tabs-nav sticky-top">
    <div class="container">
      <ul class="nav cd-nav-pills" id="cruiseTab" role="tablist">
        <li class="nav-item"><a class="nav-link active" href="#overview"><?php _e('cruise_tab_overview') ?></a></li>
        <li class="nav-item"><a class="nav-link" href="#itinerary"><?php _e('cruise_tab_itinerary') ?></a></li>
        <li class="nav-item"><a class="nav-link" href="#cabins"><?php _e('cruise_tab_cabins') ?></a></li>
        <li class="nav-item"><a class="nav-link" href="#amenities"><?php _e('cruise_tab_amenities') ?></a></li>
      </ul>
    </div>
  </div>

  <div class="container cd-content">

    <!-- Overview Section -->
    <section id="overview" class="cd-section">
      <div class="row g-4">
        <div class="col-lg-8">
          <h2 class="cd-section-title h-font">
            <i class="bi bi-info-circle me-2"></i><?php _e('cruise_tab_overview') ?>
          </h2>
          <p class="cd-overview-text"><?php echo $desc ?></p>

          <!-- Rating -->
          <div class="cd-rating-card">
            <div class="cd-rating-big">
              <span class="cd-rating-number"><?php echo $cruise['rating'] ?></span>
              <span class="cd-rating-max">/5</span>
            </div>
            <div class="cd-rating-detail">
              <div class="cd-rating-stars-big">
                <?php
                $r = $cruise['rating'];
                for ($s = 0; $s < 5; $s++) {
                  if ($s < floor($r)) echo '<i class="bi bi-star-fill text-warning"></i>';
                  elseif ($s < $r) echo '<i class="bi bi-star-half text-warning"></i>';
                  else echo '<i class="bi bi-star text-warning"></i>';
                }
                ?>
              </div>
              <span class="cd-rating-text"><?php echo number_format($cruise['reviews']) ?> <?php _e('cruise_rating') ?></span>
            </div>
          </div>
        </div>

        <div class="col-lg-4">
          <!-- Highlights Card -->
          <div class="cd-highlights-card">
            <h3 class="cd-card-title"><i class="bi bi-lightning me-2"></i><?php _e('cruise_highlight') ?></h3>
            <ul class="cd-highlight-list">
              <?php foreach ($highlights as $hl): ?>
                <li><i class="bi bi-check-circle-fill me-2"></i><?php echo $hl ?></li>
              <?php endforeach; ?>
            </ul>
          </div>
        </div>
      </div>
    </section>

    <!-- Itinerary Section -->
    <section id="itinerary" class="cd-section">
      <h2 class="cd-section-title h-font">
        <i class="bi bi-map me-2"></i><?php _e('cruise_tab_itinerary') ?>
      </h2>
      <div class="cd-itinerary">
        <?php foreach ($itinerary as $day_key => $day): ?>
          <div class="cd-day-card">
            <h3 class="cd-day-title"><?php echo $day['title'] ?></h3>
            <div class="cd-timeline">
              <?php foreach ($day['items'] as $item):
                $parts = explode(' — ', $item, 2);
                $time = $parts[0];
                $activity = isset($parts[1]) ? $parts[1] : $item;
              ?>
                <div class="cd-timeline-item">
                  <span class="cd-time"><?php echo $time ?></span>
                  <span class="cd-activity"><?php echo $activity ?></span>
                </div>
              <?php endforeach; ?>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
    </section>

    <!-- Cabins Section -->
    <section id="cabins" class="cd-section">
      <h2 class="cd-section-title h-font">
        <i class="bi bi-door-closed me-2"></i><?php _e('cruise_tab_cabins') ?>
      </h2>
      <div class="row g-4">
        <?php foreach ($cabins as $cabin): ?>
          <div class="col-lg-4 col-md-6">
            <div class="cd-cabin-card">
              <div class="cd-cabin-header">
                <h4 class="cd-cabin-name"><?php echo $cabin['name'] ?></h4>
                <span class="cd-cabin-size"><?php echo $cabin['size'] ?></span>
              </div>
              <div class="cd-cabin-body">
                <div class="cd-cabin-info">
                  <span><i class="bi bi-aspect-ratio me-1"></i><?php echo $cabin['size'] ?></span>
                  <span><i class="bi bi-lamp me-1"></i><?php echo $cabin['bed'] ?></span>
                </div>
                <p class="cd-cabin-desc"><?php echo $cabin['desc'] ?></p>
              </div>
              <div class="cd-cabin-footer">
                <div class="cd-cabin-price">
                  <small><?php _e('cruise_from_price') ?></small>
                  <strong><?php echo $cabin['price'] ?> <small>VNĐ<?php _e('cruise_per_person') ?></small></strong>
                </div>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
    </section>

    <!-- Amenities Section -->
    <section id="amenities" class="cd-section">
      <h2 class="cd-section-title h-font">
        <i class="bi bi-grid me-2"></i><?php _e('cruise_tab_amenities') ?>
      </h2>
      <div class="cd-amenities-grid">
        <?php
        $amenity_icons = [
          'Wi-Fi' => 'bi-wifi', 'Jacuzzi' => 'bi-water', 'Spa' => 'bi-heart-pulse',
          'Spa & Wellness' => 'bi-heart-pulse', 'Spa & Sauna' => 'bi-heart-pulse', 'Spa cao cấp' => 'bi-heart-pulse', 'Premium spa' => 'bi-heart-pulse',
          'Piano Lounge' => 'bi-music-note-beamed', 'Piano Bar' => 'bi-music-note-beamed',
          'Sky Walk' => 'bi-binoculars', 'Nhà hàng' => 'bi-egg-fried', 'Restaurant' => 'bi-egg-fried',
          'Bar' => 'bi-cup-straw', 'Bar 360°' => 'bi-cup-straw', '360° Bar' => 'bi-cup-straw',
          'Open Bar' => 'bi-cup-straw', 'Sundeck' => 'bi-sun', 'Sundeck 360°' => 'bi-sun', '360° Sundeck' => 'bi-sun',
          'Phòng Gym' => 'bi-bicycle', 'Gym' => 'bi-bicycle', 'Hồ bơi 50m²' => 'bi-water', '50m² Pool' => 'bi-water',
          'Mini Golf' => 'bi-flag', 'Hầm rượu' => 'bi-cup', 'Wine Cellar' => 'bi-cup',
          'Phòng xì gà' => 'bi-fire', 'Cigar Lounge' => 'bi-fire',
          'Butler' => 'bi-person-badge', 'Thư viện' => 'bi-book', 'Library' => 'bi-book',
          'Café Lounge' => 'bi-cup-hot', 'Karaoke' => 'bi-mic', 'Thuyền tre' => 'bi-tsunami', 'Bamboo boat' => 'bi-tsunami',
          'Kayak' => 'bi-tsunami', 'Fine dining' => 'bi-egg-fried',
          'Hầm rượu vang' => 'bi-cup',
        ];
        foreach ($amenities_list as $amenity):
          $icon = $amenity_icons[$amenity] ?? 'bi-check-circle';
        ?>
          <div class="cd-amenity-item">
            <i class="bi <?php echo $icon ?>"></i>
            <span><?php echo $amenity ?></span>
          </div>
        <?php endforeach; ?>
      </div>
    </section>

    <!-- CTA -->
    <section class="cd-cta-section">
      <div class="cd-cta-card">
        <div class="cd-cta-content">
          <h3><?php _e('cruise_cta_title') ?></h3>
          <p><?php _e('cruise_cta_desc') ?></p>
        </div>
        <div class="cd-cta-actions">
          <a href="tel:+<?php echo str_replace(' ', '', $contact_r['pn1']) ?>" class="btn cd-cta-btn-phone">
            <i class="bi bi-telephone me-2"></i><?php echo $contact_r['pn1'] ?>
          </a>
          <?php if (!empty($contact_r['zalo'])): ?>
            <a href="<?php echo htmlspecialchars($contact_r['zalo']) ?>" target="_blank" class="btn cd-cta-btn-zalo">
              <i class="bi bi-chat-dots me-2"></i>Zalo
            </a>
          <?php endif; ?>
        </div>
      </div>
    </section>
  </div>

  <!-- JSON-LD -->
  <script type="application/ld+json">
    <?php echo json_encode([
      "@context" => "https://schema.org",
      "@type" => "TouristTrip",
      "name" => $cruise['name'],
      "description" => $desc,
      "image" => $cruise['image'],
      "touristType" => "Cruise",
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
    ], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT); ?>
  </script>

  <?php require('inc/footer.php'); ?>

  <script>
    // Smooth scroll for tab navigation
    document.querySelectorAll('.cd-nav-pills .nav-link').forEach(link => {
      link.addEventListener('click', function(e) {
        e.preventDefault();
        const target = document.querySelector(this.getAttribute('href'));
        if (target) {
          const offset = document.querySelector('.cd-tabs-nav').offsetHeight + 10;
          window.scrollTo({
            top: target.offsetTop - offset,
            behavior: 'smooth'
          });
        }
      });
    });

    // Active tab on scroll
    window.addEventListener('scroll', function() {
      const sections = document.querySelectorAll('.cd-section');
      const navLinks = document.querySelectorAll('.cd-nav-pills .nav-link');
      const tabsHeight = document.querySelector('.cd-tabs-nav')?.offsetHeight || 0;

      let current = '';
      sections.forEach(section => {
        if (window.scrollY >= section.offsetTop - tabsHeight - 20) {
          current = '#' + section.id;
        }
      });

      navLinks.forEach(link => {
        link.classList.remove('active');
        if (link.getAttribute('href') === current) {
          link.classList.add('active');
        }
      });
    });
  </script>

</body>

</html>
