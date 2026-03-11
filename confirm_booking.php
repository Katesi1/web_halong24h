<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <?php require('inc/links.php'); ?>
  <title><?php echo $settings_r['site_title'] ?> - <?php _e('confirm_booking_nav') ?></title>
</head>
<body class="bg-light">

  <?php require('inc/header.php'); ?>

  <?php 

    /*
      Check room id from url is present or not
      Shutdown mode is active or not
      Không yêu cầu đăng nhập để đặt phòng
    */

    if(!isset($_GET['id']) || $settings_r['shutdown']==true){
      redirect('rooms.php');
    }

    // filter and get room and user data

    $data = filteration($_GET);

    $room_res = select("SELECT * FROM `rooms` WHERE `id`=? AND `status`=? AND `removed`=?",[$data['id'],1,0],'iii');

    if(mysqli_num_rows($room_res)==0){
      redirect('rooms.php');
    }

    $room_data = mysqli_fetch_assoc($room_res);

    $_SESSION['room'] = [
      "id" => $room_data['id'],
      "name" => $room_data['name'],
      "price" => $room_data['price'],
      "payment" => null,
      "available" => false,
    ];

    // Lấy thông tin user nếu đã đăng nhập, nếu không thì để trống
    $user_data = [
      'name' => '',
      'phonenum' => ''
    ];
    
    if(isset($_SESSION['login']) && $_SESSION['login']==true && isset($_SESSION['uId'])){
      $user_res = select("SELECT * FROM `user_cred` WHERE `id`=? LIMIT 1", [$_SESSION['uId']], "i");
      if(mysqli_num_rows($user_res) > 0){
        $user_data = mysqli_fetch_assoc($user_res);
      }
    }

  ?>
  
  <style>
    .cb-room-img {
      width: 100%;
      height: 220px;
      object-fit: cover;
      border-radius: 12px;
    }
    .cb-room-card {
      border: none;
      border-radius: 16px;
      overflow: hidden;
    }
    .cb-room-detail {
      display: flex;
      align-items: center;
      gap: 6px;
      font-size: 14px;
      color: #555;
    }
    .cb-room-detail i {
      font-size: 15px;
      color: #0d6efd;
      width: 18px;
      text-align: center;
    }
    .cb-room-details-grid {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 8px 16px;
    }
    .cb-price {
      font-size: 22px;
      font-weight: 700;
      color: #e74c3c;
    }
    .cb-price small {
      font-size: 13px;
      font-weight: 400;
      color: #888;
    }
    .cb-form-card {
      border: none;
      border-radius: 16px;
    }
    .cb-form-card .form-label {
      font-size: 13px;
      font-weight: 600;
      color: #555;
      margin-bottom: 4px;
    }
    .cb-form-card .form-control {
      border-radius: 10px;
      padding: 10px 14px;
    }
    .cb-confirm-btn {
      border-radius: 12px;
      padding: 12px;
      font-size: 16px;
      font-weight: 600;
    }
    @media (min-width: 992px) {
      .cb-room-img {
        height: 100%;
        min-height: 220px;
        max-height: 280px;
      }
    }
  </style>

  <div class="container" style="max-width: 960px;">
    <div class="row">

      <div class="col-12 mt-5 mb-3 px-4">
        <h4 class="mt-3 fw-bold h-font"><?php _e('confirm_booking') ?></h4>
        <nav style="font-size: 13px;">
          <a href="index.php" class="text-secondary text-decoration-none"><?php _e('home') ?></a>
          <span class="text-muted mx-1">/</span>
          <a href="rooms.php" class="text-secondary text-decoration-none"><?php _e('room_list') ?></a>
          <span class="text-muted mx-1">/</span>
          <span class="text-dark"><?php _e('confirm_booking_nav') ?></span>
        </nav>
      </div>

      <!-- Room Info Card -->
      <div class="col-12 px-4 mb-3">
        <?php
          $room_thumb = ROOMS_IMG_PATH."thumbnail.jpg";
          $thumb_q = mysqli_query($con,"SELECT * FROM `room_images`
            WHERE `room_id`='$room_data[id]'
            AND `thumb`='1'");

          if(mysqli_num_rows($thumb_q)>0){
            $thumb_res = mysqli_fetch_assoc($thumb_q);
            $room_thumb = ROOMS_IMG_PATH.$thumb_res['image'];
          }

          // Room type name
          $rt_name = '';
          if($room_data['room_type_id']){
            $rt_q = select("SELECT `name` FROM `room_types` WHERE `id`=?",[$room_data['room_type_id']],'i');
            if(mysqli_num_rows($rt_q)>0){
              $rt_r = mysqli_fetch_assoc($rt_q);
              $rt_name = $rt_r['name'];
            }
          }

          // Building info
          $building_name = '';
          if($room_data['building_id']){
            $bld_q = select("SELECT `name` FROM `buildings` WHERE `id`=?",[$room_data['building_id']],'i');
            if(mysqli_num_rows($bld_q)>0){
              $bld_r = mysqli_fetch_assoc($bld_q);
              $building_name = $bld_r['name'];
            }
          }

          $area_text = $room_data['area'] ? $room_data['area'] . ($room_data['area_max'] ? '-' . $room_data['area_max'] : '') . ' m²' : '';
          $checkin_time = date('H:i', strtotime($room_data['checkin_time']));
          $checkout_time = date('H:i', strtotime($room_data['checkout_time']));
          $room_url = "room_details.php?id={$room_data['id']}";
          $price_formatted = number_format($room_data['price'], 0, ',', '.');

          echo <<<HTML
            <div class="card cb-room-card shadow-sm">
              <div class="row g-0">
                <div class="col-lg-5">
                  <img src="$room_thumb" class="cb-room-img" alt="{$room_data['name']}">
                </div>
                <div class="col-lg-7">
                  <div class="card-body py-3 px-4">
                    <div class="d-flex align-items-start justify-content-between mb-1">
                      <div>
                        <h5 class="fw-bold mb-1">{$room_data['name']}</h5>
          HTML;

          if($rt_name) echo "<span class='badge bg-primary bg-opacity-10 text-primary' style='font-size:12px;'>$rt_name</span> ";
          if($room_data['code']) echo "<span class='badge bg-secondary bg-opacity-10 text-secondary' style='font-size:12px;'>{$room_data['code']}</span>";

          echo <<<HTML
                      </div>
                      <a href="$room_url" class="btn btn-sm btn-outline-secondary rounded-pill" style="font-size:12px; white-space:nowrap;">
                        <i class="bi bi-info-circle"></i> {$GLOBALS['_LANG']['details']}
                      </a>
                    </div>

                    <div class="cb-room-details-grid mt-3 mb-3">
          HTML;

          if($building_name) echo "<div class='cb-room-detail'><i class='bi bi-building'></i> $building_name</div>";
          if($area_text) echo "<div class='cb-room-detail'><i class='bi bi-arrows-fullscreen'></i> $area_text</div>";
          echo "<div class='cb-room-detail'><i class='bi bi-person'></i> {$room_data['adult']} {$GLOBALS['_LANG']['adults_label']}, {$room_data['children']} {$GLOBALS['_LANG']['children_label']}</div>";
          if($room_data['bedroom_count']) echo "<div class='cb-room-detail'><i class='bi bi-door-open'></i> {$room_data['bedroom_count']} {$GLOBALS['_LANG']['bedroom_label']}</div>";
          echo "<div class='cb-room-detail'><i class='bi bi-arrow-right-circle'></i> Check-in: $checkin_time</div>";
          echo "<div class='cb-room-detail'><i class='bi bi-arrow-left-circle'></i> Check-out: $checkout_time</div>";

          echo <<<HTML
                    </div>

                    <div class="cb-price">$price_formatted<small> {$GLOBALS['_LANG']['vnd_per_night']}</small></div>
                  </div>
                </div>
              </div>
            </div>
          HTML;
        ?>
      </div>

      <!-- Booking Form -->
      <div class="col-12 px-4 mb-4">
        <div class="card cb-form-card shadow-sm">
          <div class="card-body p-4">
            <form action="pay_now.php" method="POST" id="booking_form">
              <h6 class="fw-bold mb-3"><i class="bi bi-calendar-check me-2"></i><?php _e('booking_details') ?></h6>
              <div class="row">
                <div class="col-md-6 col-lg-3 mb-3">
                  <label class="form-label"><?php _e('name') ?></label>
                  <input name="name" type="text" value="<?php echo $user_data['name'] ?>" class="form-control shadow-none" required>
                </div>
                <div class="col-md-6 col-lg-3 mb-3">
                  <label class="form-label"><?php _e('phone_number') ?></label>
                  <input name="phonenum" type="number" value="<?php echo $user_data['phonenum'] ?>" class="form-control shadow-none" required>
                </div>
                <div class="col-md-6 col-lg-3 mb-3">
                  <label class="form-label"><?php _e('checkin') ?></label>
                  <input name="checkin" onchange="check_availability()" type="date" class="form-control shadow-none" required>
                </div>
                <div class="col-md-6 col-lg-3 mb-3">
                  <label class="form-label"><?php _e('checkout') ?></label>
                  <input name="checkout" onchange="check_availability()" type="date" class="form-control shadow-none" required>
                </div>

                <div class="col-12">
                  <hr class="my-2">
                  <div class="d-flex align-items-center justify-content-between flex-wrap gap-3 mt-3">
                    <div>
                      <div class="spinner-border spinner-border-sm text-info d-none" id="info_loader" role="status">
                        <span class="visually-hidden"><?php _e('please_wait') ?></span>
                      </div>
                      <span class="text-danger" id="pay_info" style="font-size: 15px;"><?php _e('select_dates_msg') ?></span>
                    </div>
                    <button name="pay_now" class="btn text-white custom-bg shadow-none cb-confirm-btn px-5" disabled>
                      <i class="bi bi-check-circle me-1"></i><?php _e('confirm_btn') ?>
                    </button>
                  </div>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>

    </div>
  </div>


  <?php require('inc/footer.php'); ?>
  <script>

    let booking_form = document.getElementById('booking_form');
    let info_loader = document.getElementById('info_loader');
    let pay_info = document.getElementById('pay_info');

    function check_availability()
    {
      let checkin_val = booking_form.elements['checkin'].value;
      let checkout_val = booking_form.elements['checkout'].value;

      booking_form.elements['pay_now'].setAttribute('disabled',true);

      if(checkin_val!='' && checkout_val!='')
      {
        pay_info.classList.add('d-none');
        pay_info.classList.replace('text-dark','text-danger');
        info_loader.classList.remove('d-none');

        let data = new FormData();

        data.append('check_availability','');
        data.append('check_in',checkin_val);
        data.append('check_out',checkout_val);

        let xhr = new XMLHttpRequest();
        xhr.open("POST","ajax/confirm_booking.php",true);

        xhr.onload = function()
        {
          let data = JSON.parse(this.responseText);

          if(data.status == 'check_in_out_equal'){
            pay_info.innerText = "<?php _e('checkin_out_equal') ?>";
          }
          else if(data.status == 'check_out_earlier'){
            pay_info.innerText = "<?php _e('checkout_earlier') ?>";
          }
          else if(data.status == 'check_in_earlier'){
            pay_info.innerText = "<?php _e('checkin_earlier') ?>";
          }
          else if(data.status == 'unavailable'){
            pay_info.innerText = "<?php _e('room_unavailable') ?>";
          }
          else{
            pay_info.innerHTML = "<?php _e('num_nights') ?>: "+data.days+" <?php _e('night') ?><br><?php _e('total_amount') ?>: "+data.payment+" <?php _e('vnd') ?>";
            pay_info.classList.replace('text-danger','text-dark');
            booking_form.elements['pay_now'].removeAttribute('disabled');
          }

          pay_info.classList.remove('d-none');
          info_loader.classList.add('d-none');
        }

        xhr.send(data);
      }

    }

  </script>

</body>
</html>