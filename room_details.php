<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <?php require('inc/links.php'); ?>
  <title><?php echo $settings_r['site_title'] ?> - Chi tiết phòng</title>
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
          <a href="index.php" class="text-secondary text-decoration-none">Trang chủ</a>
          <span class="text-secondary"> > </span>
          <a href="rooms.php" class="text-secondary text-decoration-none">Danh sách phòng</a>
        </div>
      </div>

      <div class="col-lg-7 col-md-12 px-4">
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
        ?>

        <!-- Ảnh chính -->
        <div class="mb-3">
          <img id="mainRoomImage" src="<?php echo $main_img; ?>" class="w-100 rounded-3" style="aspect-ratio:4/3;object-fit:cover;cursor:zoom-in;" alt="<?php echo $room_data['name']; ?>">
        </div>

        <!-- Thumbnails -->
        <?php if(count($all_images) > 1): ?>
        <div class="d-flex gap-2 flex-wrap">
          <?php foreach($all_images as $idx => $img):
            $src = ROOMS_IMG_PATH.$img['image'];
            $active_border = $idx === 0 ? 'border-2 border-dark' : 'border';
          ?>
          <img src="<?php echo $src; ?>"
               class="rounded-2 thumb-preview <?php echo $active_border; ?>"
               style="width:80px;height:60px;object-fit:cover;cursor:pointer;opacity:<?php echo $idx===0?'1':'.65'; ?>;transition:opacity .2s,border-color .2s;"
               onclick="switchMainImage(this,'<?php echo $src; ?>')"
               alt="">
          <?php endforeach; ?>
        </div>
        <?php endif; ?>

        <script>
        function switchMainImage(el, src){
          document.getElementById('mainRoomImage').src = src;
          document.querySelectorAll('.thumb-preview').forEach(function(t){
            t.style.opacity = '.65';
            t.classList.remove('border-dark','border-2');
            t.classList.add('border');
          });
          el.style.opacity = '1';
          el.classList.remove('border');
          el.classList.add('border-2','border-dark');
        }
        </script>
      </div>

      <div class="col-lg-5 col-md-12 px-4">
        <div class="card mb-4 border-0 shadow-sm rounded-3">
          <div class="card-body">
            <?php 

              echo<<<price
                <h4>$room_data[price] VND / đêm</h4>
              price;

              $rating_q = "SELECT AVG(rating) AS `avg_rating` FROM `rating_review`
                WHERE `room_id`='$room_data[id]' ORDER BY `sr_no` DESC LIMIT 20";
  
              $rating_res = mysqli_query($con,$rating_q);
              $rating_fetch = mysqli_fetch_assoc($rating_res);
    
              $rating_data = "";
    
              if($rating_fetch['avg_rating']!=NULL)
              {
                for($i=0; $i < $rating_fetch['avg_rating']; $i++){
                  $rating_data .="<i class='bi bi-star-fill text-warning'></i> ";
                }
              }

              echo<<<rating
                <div class="mb-3">
                  $rating_data
                </div>
              rating;

              $fea_q = mysqli_query($con,"SELECT f.name FROM `features` f
                INNER JOIN `room_features` rfea ON f.id = rfea.features_id
                WHERE rfea.room_id = '$room_data[id]'");

              $feature_icons = [
                'Phòng Ngủ'  => 'fa-bed',
                'Ban Công'   => 'fa-door-open',
                'Nhà Bếp'   => 'fa-utensils',
                'Ghế Sofa'  => 'fa-couch',
                'View Biển' => 'fa-water',
                'View Phố'  => 'fa-city',
                'Sân Vườn'  => 'fa-tree',
                'Bể Bơi'    => 'fa-person-swimming',
              ];

              $features_data = "";
              while($fea_row = mysqli_fetch_assoc($fea_q)){
                $ico_class = $feature_icons[$fea_row['name']] ?? 'fa-circle-check';
                $features_data .="<span class='badge rounded-pill bg-light text-dark text-wrap me-1 mb-1 px-3 py-2'>
                  <i class='fa-solid {$ico_class} me-1'></i>{$fea_row['name']}
                </span>";
              }

              echo<<<features
                <div class="mb-3">
                  <h6 class="mb-1">Không gian</h6>
                  $features_data
                </div>
              features;

              $fac_q = mysqli_query($con,"SELECT f.name, f.icon FROM `facilities` f
                INNER JOIN `room_facilities` rfac ON f.id = rfac.facilities_id
                WHERE rfac.room_id = '$room_data[id]'");

              $facilities_data = "";
              while($fac_row = mysqli_fetch_assoc($fac_q)){
                $icon = $fac_row['icon'] ? "<i class='fa-solid {$fac_row['icon']} me-1'></i>" : "";
                $facilities_data .="<span class='badge rounded-pill bg-light text-dark text-wrap me-1 mb-1 px-3 py-2'>
                  {$icon}{$fac_row['name']}
                </span>";
              }

              echo<<<facilities
                <div class="mb-3">
                  <h6 class="mb-1">Tiện ích</h6>
                  $facilities_data
                </div>
              facilities;

              echo<<<guests
                <div class="mb-3">
                  <h6 class="mb-1">Guests</h6>
                  <span class="badge rounded-pill bg-light text-dark text-wrap">
                    $room_data[adult] Người lớn
                  </span>
                  <span class="badge rounded-pill bg-light text-dark text-wrap">
                    $room_data[children] Trẻ em
                  </span>
                </div>
              guests;

              echo<<<area
                <div class="mb-3">
                  <h6 class="mb-1">Area</h6>
                  <span class='badge rounded-pill bg-light text-dark text-wrap me-1 mb-1'>
                    $room_data[area] m2
                  </span>
                </div>
              area;

              if(!$settings_r['shutdown']){
                $login=0;
                if(isset($_SESSION['login']) && $_SESSION['login']==true){
                  $login=1;
                }
                echo<<<book
                  <button onclick='checkLoginToBook($login,$room_data[id])' class="btn w-100 text-white custom-bg shadow-none mb-1">Đặt ngay</button>
                book;
              }

            ?>
          </div>
        </div>
      </div>

      <div class="col-12 mt-4 px-4">
        <div class="mb-5">
          <h5 class="fw-bold h-font">Mô tả</h5>
          <p>
            <?php echo $room_data['description'] ?>
          </p>
        </div>

        <div>
          <h5 class="fw-bold h-font mb-3">Trải nghiệm khách hàng</h5>

          <?php
            $review_q = "SELECT rr.*,uc.name AS uname, uc.profile, r.name AS rname FROM `rating_review` rr
              INNER JOIN `user_cred` uc ON rr.user_id = uc.id
              INNER JOIN `rooms` r ON rr.room_id = r.id
              WHERE rr.room_id = '$room_data[id]'
              ORDER BY `sr_no` DESC LIMIT 15";

            $review_res = mysqli_query($con,$review_q);
            $img_path = USERS_IMG_PATH;

            if(mysqli_num_rows($review_res)==0){
              echo 'No reviews yet!';
            }
            else
            {
              while($row = mysqli_fetch_assoc($review_res))
              {
                $stars = "<i class='bi bi-star-fill text-warning'></i> ";
                for($i=1; $i<$row['rating']; $i++){
                  $stars .= " <i class='bi bi-star-fill text-warning'></i>";
                }

                echo<<<reviews
                  <div class="mb-4">
                    <div class="d-flex align-items-center mb-2">
                      <img src="$img_path$row[profile]" class="rounded-circle" loading="lazy" width="30px">
                      <h6 class="m-0 ms-2">$row[uname]</h6>
                    </div>
                    <p class="mb-1">
                      $row[review]
                    </p>
                    <div>
                      $stars
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


  <?php require('inc/footer.php'); ?>

</body>
</html>