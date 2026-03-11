<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <?php require('inc/links.php'); ?>
  <title><?php echo $settings_r['site_title'] ?> - <?php _e('room_details') ?></title>
</head>
<body class="bg-light">

  <?php require('inc/header.php'); ?>

  <?php 
    if(!isset($_GET['id'])){
      redirect('rooms.php');
    }

    $data = filteration($_GET);

    $room_res = select("SELECT * FROM `rooms` WHERE `id`=? AND `status`=? AND `removed`=?",[$data['id'],1,0],'iii');

    if(mysqli_num_rows($room_res)==0){
      redirect('rooms.php');
    }

    $room_data = mysqli_fetch_assoc($room_res);
  ?>

  <div class="container">
    <div class="row">

      <div class="col-12 my-5 mb-4 px-4">
        <h2 class="fw-bold"><?php echo $room_data['name'] ?></h2>
        <div style="font-size: 14px;">
          <a href="index.php" class="text-secondary text-decoration-none"><?php _e('home') ?></a>
          <span class="text-secondary"> > </span>
          <a href="rooms.php" class="text-secondary text-decoration-none"><?php _e('room_list') ?></a>
        </div>
      </div>

      <div class="col-lg-6 col-md-12 px-4">
        <?php
          $fallback_img = ROOMS_IMG_PATH."thumbnail.jpg";
          $img_q = mysqli_query($con,"SELECT * FROM `room_images` WHERE `room_id`='$room_data[id]' ORDER BY `thumb` DESC, `sort_order` ASC");
          $all_images = [];
          if(mysqli_num_rows($img_q) > 0){
            while($img_row = mysqli_fetch_assoc($img_q)){
              $all_images[] = $img_row;
            }
          }
          $main_img = count($all_images) > 0 ? ROOMS_IMG_PATH.$all_images[0]['image'] : $fallback_img;
          $total_images = count($all_images);
          $thumbs_per_page = 8; // 4 per row x 2 rows
        ?>

        <style>
          .img-gallery-main { position: relative; overflow: hidden; border-radius: 12px; cursor: pointer; }
          .img-gallery-main img { display: block; transition: transform .3s; }
          .img-gallery-main:hover img { transform: scale(1.02); }
          .img-gallery-main .gallery-icon {
            position: absolute; bottom: 12px; right: 12px;
            background: rgba(0,0,0,.6); color: #fff;
            padding: 6px 14px; border-radius: 8px;
            font-size: 13px; display: flex; align-items: center; gap: 6px;
            pointer-events: none;
          }

          .thumb-carousel { position: relative; }
          .thumb-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 8px;
          }
          .thumb-grid img {
            width: 100%; aspect-ratio: 4/3;
            object-fit: cover;
            border-radius: 8px;
            cursor: pointer;
            border: 2px solid transparent;
            opacity: .6;
            transition: opacity .2s, border-color .2s, transform .15s;
          }
          .thumb-grid img:hover { opacity: .85; transform: scale(1.03); }
          .thumb-grid img.active { opacity: 1; border-color: var(--teal); }
          .thumb-nav {
            position: absolute;
            top: 50%; transform: translateY(-50%);
            width: 30px; height: 30px;
            border-radius: 50%;
            border: none;
            background: rgba(0,0,0,.5);
            color: #fff;
            display: flex; align-items: center; justify-content: center;
            cursor: pointer;
            z-index: 10;
            transition: background .2s;
            font-size: 14px;
            padding: 0;
          }
          .thumb-nav:hover { background: rgba(0,0,0,.75); }
          .thumb-nav.prev { left: -14px; }
          .thumb-nav.next { right: -14px; }
          .thumb-nav:disabled { opacity: .3; cursor: default; }
          .thumb-counter {
            text-align: center;
            font-size: 13px;
            color: #888;
            margin-top: 6px;
          }

          /* Lightbox */
          .lightbox-overlay {
            display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%;
            background: rgba(0,0,0,.92); z-index: 9999;
            align-items: center; justify-content: center; flex-direction: column;
          }
          .lightbox-overlay.active { display: flex; }
          .lightbox-close {
            position: absolute; top: 16px; right: 20px;
            background: none; border: none; color: #fff; font-size: 32px;
            cursor: pointer; z-index: 10001; opacity: .7; transition: opacity .2s;
            width: 44px; height: 44px; display: flex; align-items: center; justify-content: center;
          }
          .lightbox-close:hover { opacity: 1; }
          .lightbox-img-wrapper {
            position: relative; max-width: 90vw; max-height: 80vh;
            display: flex; align-items: center; justify-content: center;
          }
          .lightbox-img-wrapper img {
            max-width: 90vw; max-height: 80vh; object-fit: contain;
            border-radius: 8px; user-select: none;
            animation: lbFadeIn .25s ease;
          }
          @keyframes lbFadeIn { from { opacity: 0; transform: scale(.95); } to { opacity: 1; transform: scale(1); } }
          .lightbox-nav {
            position: absolute; top: 50%; transform: translateY(-50%);
            width: 48px; height: 48px; border-radius: 50%;
            border: none; background: rgba(255,255,255,.15); color: #fff;
            font-size: 22px; cursor: pointer; z-index: 10001;
            display: flex; align-items: center; justify-content: center;
            transition: background .2s;
            backdrop-filter: blur(4px);
          }
          .lightbox-nav:hover { background: rgba(255,255,255,.3); }
          .lightbox-nav.lb-prev { left: max(12px, calc(50% - 45vw - 36px)); }
          .lightbox-nav.lb-next { right: max(12px, calc(50% - 45vw - 36px)); }
          .lightbox-counter {
            color: rgba(255,255,255,.7); font-size: 14px; margin-top: 14px;
            user-select: none;
          }
          .lightbox-thumbs {
            display: flex; gap: 8px; margin-top: 12px;
            max-width: 90vw; overflow-x: auto;
            padding: 4px 0;
            scrollbar-width: thin;
            scrollbar-color: rgba(255,255,255,.3) transparent;
          }
          .lightbox-thumbs img {
            width: 60px; height: 45px; object-fit: cover;
            border-radius: 6px; cursor: pointer;
            opacity: .4; border: 2px solid transparent;
            transition: opacity .2s, border-color .2s;
            flex-shrink: 0;
          }
          .lightbox-thumbs img:hover { opacity: .7; }
          .lightbox-thumbs img.active { opacity: 1; border-color: var(--teal); }
          @media (max-width: 576px) {
            .lightbox-nav { width: 40px; height: 40px; font-size: 18px; }
            .lightbox-nav.lb-prev { left: 8px; }
            .lightbox-nav.lb-next { right: 8px; }
            .lightbox-thumbs img { width: 48px; height: 36px; }
          }

          .room-info-card {
            border: none;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 2px 20px rgba(0,0,0,.07);
          }
          .room-price-header {
            background: linear-gradient(135deg, var(--teal), #1B4332);
            color: #fff;
            padding: 20px 24px;
          }
          .room-price-header .price-amount {
            font-size: 26px;
            font-weight: 700;
            letter-spacing: -.5px;
          }
          .room-price-header .price-unit {
            font-size: 14px;
            opacity: .8;
            font-weight: 400;
          }
          .room-price-header .rating-stars {
            margin-top: 6px;
          }
          .room-info-body { padding: 20px 24px; }
          .info-section {
            padding: 14px 0;
            border-bottom: 1px solid #f0f0f0;
          }
          .info-section:last-child { border-bottom: none; }
          .info-section-title {
            font-size: 13px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: .5px;
            color: #888;
            margin-bottom: 8px;
            display: flex;
            align-items: center;
            gap: 6px;
          }
          .info-section-title i { font-size: 14px; color: var(--teal); }
          .info-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: #f8f9fa;
            border: 1px solid #eee;
            border-radius: 8px;
            padding: 6px 12px;
            font-size: 13px;
            color: #333;
            margin: 0 6px 6px 0;
            transition: background .15s;
          }
          .info-badge i { color: var(--teal); font-size: 13px; }
          .info-badge:hover { background: #f0f1f2; }
          .info-stat {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 8px 14px;
            background: #f8f9fa;
            border-radius: 10px;
            margin-bottom: 6px;
          }
          .info-stat-icon {
            width: 36px; height: 36px;
            border-radius: 8px;
            background: rgba(45,106,79,.1);
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--teal);
            font-size: 16px;
            flex-shrink: 0;
          }
          .info-stat-text { font-size: 14px; color: #333; }
          .info-stat-text span { font-weight: 600; }
          .btn-book {
            display: block;
            width: 100%;
            padding: 14px;
            border: none;
            border-radius: 12px;
            background: linear-gradient(135deg, var(--teal), #1B4332);
            color: #fff;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: transform .15s, box-shadow .15s;
            margin-top: 6px;
          }
          .btn-book:hover {
            transform: translateY(-1px);
            box-shadow: 0 6px 20px rgba(45,106,79,.3);
            color: #fff;
          }
          .btn-book i { margin-right: 6px; }
        </style>

        <div class="img-gallery-main mb-3" onclick="openLightbox(currentLightboxIndex)">
          <img id="mainRoomImage" src="<?php echo $main_img; ?>" class="w-100" style="aspect-ratio:4/3;object-fit:cover;" alt="<?php echo $room_data['name']; ?>">
          <?php if($total_images > 1): ?>
          <div class="gallery-icon"><i class="bi bi-images"></i> <?php echo $total_images; ?> <?php _e('photos') ?></div>
          <?php endif; ?>
        </div>

        <?php if($total_images > 1): ?>
        <div class="thumb-carousel">
          <?php if($total_images > $thumbs_per_page): ?>
          <button class="thumb-nav prev" id="thumbPrev" disabled onclick="changeThumbPage(-1)">
            <i class="bi bi-chevron-left"></i>
          </button>
          <button class="thumb-nav next" id="thumbNext" onclick="changeThumbPage(1)">
            <i class="bi bi-chevron-right"></i>
          </button>
          <?php endif; ?>

          <div class="thumb-grid" id="thumbGrid">
            <?php foreach($all_images as $idx => $img):
              $src = ROOMS_IMG_PATH.$img['image'];
            ?>
            <img src="<?php echo $src; ?>"
                 class="thumb-preview <?php echo $idx === 0 ? 'active' : ''; ?>"
                 data-src="<?php echo $src; ?>"
                 onclick="switchMainImage(this)"
                 alt="">
            <?php endforeach; ?>
          </div>

          <?php if($total_images > $thumbs_per_page): ?>
          <div class="thumb-counter">
            <span id="thumbPageInfo">1 / <?php echo ceil($total_images / $thumbs_per_page); ?></span>
          </div>
          <?php endif; ?>
        </div>
        <?php endif; ?>

        <!-- Lightbox Modal -->
        <div class="lightbox-overlay" id="lightboxOverlay">
          <button class="lightbox-close" onclick="closeLightbox()" aria-label="Close"><i class="bi bi-x-lg"></i></button>
          <?php if($total_images > 1): ?>
          <button class="lightbox-nav lb-prev" onclick="navigateLightbox(-1)"><i class="bi bi-chevron-left"></i></button>
          <button class="lightbox-nav lb-next" onclick="navigateLightbox(1)"><i class="bi bi-chevron-right"></i></button>
          <?php endif; ?>
          <div class="lightbox-img-wrapper">
            <img id="lightboxImg" src="" alt="">
          </div>
          <?php if($total_images > 1): ?>
          <div class="lightbox-counter"><span id="lightboxCounter"></span></div>
          <div class="lightbox-thumbs" id="lightboxThumbs">
            <?php foreach($all_images as $idx => $img): ?>
            <img src="<?php echo ROOMS_IMG_PATH.$img['image']; ?>" data-index="<?php echo $idx; ?>" onclick="goToLightbox(<?php echo $idx; ?>)" alt="">
            <?php endforeach; ?>
          </div>
          <?php endif; ?>
        </div>

        <script>
        var thumbsPerPage = <?php echo $thumbs_per_page; ?>;
        var currentThumbPage = 0;
        var allThumbs = document.querySelectorAll('.thumb-preview');
        var totalThumbPages = Math.ceil(allThumbs.length / thumbsPerPage);

        function showThumbPage(page) {
          var start = page * thumbsPerPage;
          var end = start + thumbsPerPage;
          allThumbs.forEach(function(t, i) {
            t.style.display = (i >= start && i < end) ? 'block' : 'none';
          });
          var prevBtn = document.getElementById('thumbPrev');
          var nextBtn = document.getElementById('thumbNext');
          var info = document.getElementById('thumbPageInfo');
          if (prevBtn) prevBtn.disabled = page === 0;
          if (nextBtn) nextBtn.disabled = page >= totalThumbPages - 1;
          if (info) info.textContent = (page + 1) + ' / ' + totalThumbPages;
        }

        function changeThumbPage(dir) {
          currentThumbPage += dir;
          if (currentThumbPage < 0) currentThumbPage = 0;
          if (currentThumbPage >= totalThumbPages) currentThumbPage = totalThumbPages - 1;
          showThumbPage(currentThumbPage);
        }

        if (allThumbs.length > 0) showThumbPage(0);

        function switchMainImage(el) {
          document.getElementById('mainRoomImage').src = el.dataset.src;
          allThumbs.forEach(function(t) { t.classList.remove('active'); });
          el.classList.add('active');
          // Update lightbox current index
          currentLightboxIndex = Array.from(allThumbs).indexOf(el);
        }

        // Lightbox
        var lightboxImages = <?php echo json_encode(array_map(function($img){ return ROOMS_IMG_PATH.$img['image']; }, $all_images)); ?>;
        var currentLightboxIndex = 0;
        var overlay = document.getElementById('lightboxOverlay');
        var lbImg = document.getElementById('lightboxImg');
        var lbCounter = document.getElementById('lightboxCounter');
        var lbThumbs = document.querySelectorAll('#lightboxThumbs img');

        function openLightbox(index) {
          currentLightboxIndex = index;
          updateLightbox();
          overlay.classList.add('active');
          document.body.style.overflow = 'hidden';
        }

        function closeLightbox() {
          overlay.classList.remove('active');
          document.body.style.overflow = '';
        }

        function navigateLightbox(dir) {
          currentLightboxIndex += dir;
          if (currentLightboxIndex < 0) currentLightboxIndex = lightboxImages.length - 1;
          if (currentLightboxIndex >= lightboxImages.length) currentLightboxIndex = 0;
          updateLightbox();
        }

        function goToLightbox(index) {
          currentLightboxIndex = index;
          updateLightbox();
        }

        function updateLightbox() {
          lbImg.src = lightboxImages[currentLightboxIndex];
          if (lbCounter) lbCounter.textContent = (currentLightboxIndex + 1) + ' / ' + lightboxImages.length;
          lbThumbs.forEach(function(t, i) {
            t.classList.toggle('active', i === currentLightboxIndex);
          });
          // Scroll active thumb into view
          if (lbThumbs[currentLightboxIndex]) {
            lbThumbs[currentLightboxIndex].scrollIntoView({ behavior: 'smooth', inline: 'center', block: 'nearest' });
          }
          // Also update main image & thumb grid
          if (allThumbs[currentLightboxIndex]) {
            document.getElementById('mainRoomImage').src = lightboxImages[currentLightboxIndex];
            allThumbs.forEach(function(t) { t.classList.remove('active'); });
            allThumbs[currentLightboxIndex].classList.add('active');
          }
        }

        // Keyboard navigation
        document.addEventListener('keydown', function(e) {
          if (!overlay.classList.contains('active')) return;
          if (e.key === 'Escape') closeLightbox();
          if (e.key === 'ArrowLeft') navigateLightbox(-1);
          if (e.key === 'ArrowRight') navigateLightbox(1);
        });

        // Close on overlay background click
        overlay.addEventListener('click', function(e) {
          if (e.target === overlay) closeLightbox();
        });

        // Open lightbox from thumb click too
        allThumbs.forEach(function(t, i) {
          t.addEventListener('dblclick', function() { openLightbox(i); });
        });
        </script>
      </div>

      <div class="col-lg-6 col-md-12 px-4">
        <div class="card room-info-card mb-4">
          <?php
            // Price & Rating
            $formatted_price = $room_data['price'] > 0
              ? number_format($room_data['price'], 0, ',', '.')
              : __('contact_for_price');

            $rating_q = "SELECT AVG(rating) AS `avg_rating`, COUNT(*) AS `total` FROM `rating_review`
              WHERE `room_id`='$room_data[id]'";
            $rating_res = mysqli_query($con, $rating_q);
            $rating_fetch = mysqli_fetch_assoc($rating_res);

            $rating_stars = "";
            $rating_text = "";
            if($rating_fetch['avg_rating'] != NULL){
              $avg = round($rating_fetch['avg_rating'], 1);
              for($i = 0; $i < 5; $i++){
                if($i < floor($avg)){
                  $rating_stars .= "<i class='bi bi-star-fill'></i> ";
                } else if($i < $avg){
                  $rating_stars .= "<i class='bi bi-star-half'></i> ";
                } else {
                  $rating_stars .= "<i class='bi bi-star'></i> ";
                }
              }
              $rating_text = "<span style='font-size:13px;opacity:.8;margin-left:4px;'>$avg ({$rating_fetch['total']} {$GLOBALS['_LANG']['review_count']})</span>";
            }
          ?>
          <div class="room-price-header">
            <div class="price-amount">
              <?php echo $formatted_price; ?>
              <?php if($room_data['price'] > 0): ?>
                <span class="price-unit"><?php _e('vnd_per_night') ?></span>
              <?php endif; ?>
            </div>
            <?php if($rating_stars): ?>
            <div class="rating-stars">
              <?php echo $rating_stars . $rating_text; ?>
            </div>
            <?php endif; ?>
          </div>

          <div class="room-info-body">
            <?php
              // Features (View)
              $fea_q = mysqli_query($con,"SELECT f.name FROM `features` f
                INNER JOIN `room_features` rfea ON f.id = rfea.features_id
                WHERE rfea.room_id = '$room_data[id]'");

              $feature_icons = [
                __('feat_bedroom')   => 'bi-house-door',
                __('feat_balcony')   => 'bi-door-open',
                __('feat_kitchen')   => 'bi-cup-hot',
                __('feat_sofa')      => 'bi-lamp',
                __('feat_sea_view')  => 'bi-water',
                __('feat_city_view') => 'bi-buildings',
                __('feat_garden')    => 'bi-tree',
                __('feat_pool')      => 'bi-droplet-half',
              ];

              $features_data = "";
              while($fea_row = mysqli_fetch_assoc($fea_q)){
                $ico = $feature_icons[$fea_row['name']] ?? 'bi-check-circle';
                $features_data .= "<span class='info-badge'><i class='bi {$ico}'></i>{$fea_row['name']}</span>";
              }

              if($features_data):
            ?>
            <div class="info-section">
              <div class="info-section-title"><i class="bi bi-eye"></i> <?php _e('view_filter') ?></div>
              <div><?php echo $features_data; ?></div>
            </div>
            <?php endif; ?>

            <?php
              // Facilities
              $fac_q = mysqli_query($con,"SELECT f.name, f.icon FROM `facilities` f
                INNER JOIN `room_facilities` rfac ON f.id = rfac.facilities_id
                WHERE rfac.room_id = '$room_data[id]'");

              $facilities_data = "";
              while($fac_row = mysqli_fetch_assoc($fac_q)){
                $icon = $fac_row['icon'] ? "<i class='bi {$fac_row['icon']}'></i>" : "<i class='bi bi-check-circle'></i>";
                $facilities_data .= "<span class='info-badge'>{$icon}{$fac_row['name']}</span>";
              }

              if($facilities_data):
            ?>
            <div class="info-section">
              <div class="info-section-title"><i class="bi bi-star"></i> <?php _e('facilities') ?></div>
              <div><?php echo $facilities_data; ?></div>
            </div>
            <?php endif; ?>

            <div class="info-section">
              <div class="info-section-title"><i class="bi bi-people"></i> <?php _e('capacity_label') ?></div>
              <div class="info-stat">
                <div class="info-stat-icon"><i class="bi bi-person"></i></div>
                <div class="info-stat-text"><span><?php echo $room_data['adult']; ?></span> <?php _e('adults') ?></div>
              </div>
              <div class="info-stat">
                <div class="info-stat-icon"><i class="bi bi-person-heart"></i></div>
                <div class="info-stat-text"><span><?php echo $room_data['children']; ?></span> <?php _e('children') ?></div>
              </div>
            </div>

            <div class="info-section">
              <div class="info-section-title"><i class="bi bi-arrows-fullscreen"></i> <?php _e('area_label') ?></div>
              <div class="info-stat">
                <div class="info-stat-icon"><i class="bi bi-aspect-ratio"></i></div>
                <div class="info-stat-text"><span><?php echo $room_data['area']; ?></span> m&sup2;</div>
              </div>
            </div>

            <?php
              if(!$settings_r['shutdown']){
                $login = 0;
                if(isset($_SESSION['login']) && $_SESSION['login'] == true){
                  $login = 1;
                }
            ?>
            <div style="padding-top: 14px;">
              <button onclick="checkLoginToBook(<?php echo $login; ?>,<?php echo $room_data['id']; ?>)" class="btn-book">
                <i class="bi bi-calendar-check"></i> <?php _e('book_now') ?>
              </button>
            </div>
            <?php } ?>
          </div>
        </div>
      </div>

      <div class="col-12 mt-4 px-4">
        <div class="card border-0 shadow-sm rounded-3 mb-4">
          <div class="card-body p-4">
            <h5 class="fw-bold h-font mb-3"><i class="bi bi-file-text me-2" style="color:var(--teal);"></i><?php _e('description') ?></h5>
            <p class="text-secondary mb-0" style="line-height:1.8;">
              <?php echo nl2br($room_data['description']); ?>
            </p>
          </div>
        </div>

        <div class="card border-0 shadow-sm rounded-3 mb-5">
          <div class="card-body p-4">
            <h5 class="fw-bold h-font mb-3"><i class="bi bi-chat-left-quote me-2" style="color:var(--teal);"></i><?php _e('guest_reviews') ?></h5>

            <?php
              $review_q = "SELECT rr.*,uc.name AS uname, uc.profile, r.name AS rname FROM `rating_review` rr
                INNER JOIN `user_cred` uc ON rr.user_id = uc.id
                INNER JOIN `rooms` r ON rr.room_id = r.id
                WHERE rr.room_id = '$room_data[id]'
                ORDER BY `sr_no` DESC LIMIT 15";

              $review_res = mysqli_query($con,$review_q);
              $img_path = USERS_IMG_PATH;

              if(mysqli_num_rows($review_res)==0){
                echo "<div class='text-center py-4'>
                  <i class='bi bi-chat-dots' style='font-size:40px;color:#ddd;'></i>
                  <p class='text-muted mt-2 mb-0'>" . __('no_reviews_short') . "</p>
                </div>";
              }
              else
              {
                while($row = mysqli_fetch_assoc($review_res))
                {
                  $stars = "";
                  for($i = 0; $i < 5; $i++){
                    if($i < $row['rating']){
                      $stars .= "<i class='bi bi-star-fill text-warning'></i> ";
                    } else {
                      $stars .= "<i class='bi bi-star text-warning'></i> ";
                    }
                  }

                  echo<<<reviews
                    <div class="d-flex gap-3 py-3" style="border-bottom:1px solid #f0f0f0;">
                      <img src="$img_path$row[profile]" class="rounded-circle flex-shrink-0" loading="lazy" width="40" height="40" style="object-fit:cover;">
                      <div>
                        <div class="d-flex align-items-center gap-2 mb-1">
                          <h6 class="m-0 fw-bold" style="font-size:14px;">$row[uname]</h6>
                          <span style="font-size:12px;">$stars</span>
                        </div>
                        <p class="mb-0 text-secondary" style="font-size:14px;line-height:1.6;">
                          $row[review]
                        </p>
                      </div>
                    </div>
                  reviews;
                }
              }
            ?>
          </div>
        </div>
      </div>

    </div>
  </div>


  <?php require('inc/footer.php'); ?>

</body>
</html>