<?php

  require('../admin/inc/db_config.php');
  require('../admin/inc/essentials.php');

  session_start();

  if(isset($_GET['fetch_rooms']))
  {
    // === Decode filters ===
    $chk_avail   = json_decode($_GET['chk_avail'],   true);
    $guests      = json_decode($_GET['guests'],       true);
    $facility_list = json_decode($_GET['facility_list'], true);

    $property_type_id = isset($_GET['property_type']) && $_GET['property_type'] !== ''
                        ? (int)$_GET['property_type'] : 0;
    $room_type_id     = isset($_GET['room_type'])     && $_GET['room_type'] !== ''
                        ? (int)$_GET['room_type']     : 0;
    $feature_id       = isset($_GET['view_type'])     && $_GET['view_type'] !== ''
                        ? (int)$_GET['view_type']     : 0;

    // === Date validation ===
    if($chk_avail['checkin'] != '' && $chk_avail['checkout'] != '')
    {
      $today_date    = new DateTime(date("Y-m-d"));
      $checkin_date  = new DateTime($chk_avail['checkin']);
      $checkout_date = new DateTime($chk_avail['checkout']);

      if($checkin_date == $checkout_date){
        echo "<div class='rooms-empty'><div class='rooms-empty-icon'>⚠️</div><h3 class='rooms-empty-title'>Ngày không hợp lệ</h3><p class='rooms-empty-text'>Ngày nhận phòng và trả phòng không thể trùng nhau.</p></div>";
        exit;
      }
      if($checkout_date < $checkin_date){
        echo "<div class='rooms-empty'><div class='rooms-empty-icon'>⚠️</div><h3 class='rooms-empty-title'>Ngày không hợp lệ</h3><p class='rooms-empty-text'>Ngày trả phòng phải sau ngày nhận phòng.</p></div>";
        exit;
      }
      if($checkin_date < $today_date){
        echo "<div class='rooms-empty'><div class='rooms-empty-icon'>⚠️</div><h3 class='rooms-empty-title'>Ngày không hợp lệ</h3><p class='rooms-empty-text'>Ngày nhận phòng không thể trong quá khứ.</p></div>";
        exit;
      }
    }

    // === Guests ===
    $adults   = ($guests['adults']   != '') ? (int)$guests['adults']   : 0;
    $children = ($guests['children'] != '') ? (int)$guests['children'] : 0;

    // === Pagination ===
    $page   = isset($_GET['page']) ? max(1, (int)$_GET['page']) : 1;
    $limit  = 5;
    $offset = ($page - 1) * $limit;

    // === Settings ===
    $settings_r = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM `settings` WHERE `sr_no`=1"));

    // === Build main query dynamically ===
    $where  = "WHERE r.`status`=1 AND r.`removed`=0";
    $params = [];
    $types  = "";

    if($adults > 0){
      $where   .= " AND r.`adult`>=?";
      $params[] = $adults;
      $types   .= "i";
    }
    if($children > 0){
      $where   .= " AND r.`children`>=?";
      $params[] = $children;
      $types   .= "i";
    }
    if($property_type_id > 0){
      $where   .= " AND r.`property_type_id`=?";
      $params[] = $property_type_id;
      $types   .= "i";
    }
    if($room_type_id > 0){
      $where   .= " AND r.`room_type_id`=?";
      $params[] = $room_type_id;
      $types   .= "i";
    }
    if($feature_id > 0){
      $where   .= " AND r.id IN (SELECT room_id FROM `room_features` WHERE features_id=?)";
      $params[] = $feature_id;
      $types   .= "i";
    }

    $sql = "SELECT r.*, pt.name AS type_name, pt.slug AS type_slug,
                   rt.name AS room_type_name, b.name AS building_name
            FROM `rooms` r
            LEFT JOIN `property_types` pt ON r.property_type_id = pt.id
            LEFT JOIN `room_types`     rt ON r.room_type_id     = rt.id
            LEFT JOIN `buildings`       b ON r.building_id      = b.id
            $where
            ORDER BY r.property_type_id ASC, r.id ASC";

    $room_res = count($params) > 0
      ? select($sql, $params, $types)
      : mysqli_query($con, $sql);

    $filtered_rooms = [];

    while($room_data = mysqli_fetch_assoc($room_res))
    {
      // === Availability check (mỗi phòng là duy nhất, check không có booking trùng) ===
      if($chk_avail['checkin'] != '' && $chk_avail['checkout'] != '')
      {
        $tb_query = "SELECT COUNT(*) AS total FROM `booking_order`
                     WHERE booking_status='booked' AND room_id=?
                     AND check_out > ? AND check_in < ?";
        $tb_fetch = mysqli_fetch_assoc(
          select($tb_query, [$room_data['id'], $chk_avail['checkin'], $chk_avail['checkout']], 'iss')
        );
        if($tb_fetch['total'] > 0){ continue; }
      }

      // === Facilities filter ===
      $fac_count = 0;
      $fac_q = mysqli_query($con,
        "SELECT f.name, f.id, f.icon FROM `facilities` f
         INNER JOIN `room_facilities` rfac ON f.id = rfac.facilities_id
         WHERE rfac.room_id = '{$room_data['id']}'"
      );
      $facilities_data = "";
      while($fac_row = mysqli_fetch_assoc($fac_q)){
        if(in_array($fac_row['id'], $facility_list['facilities'])){ $fac_count++; }
        $facilities_data .= "<span class='room-badge'><i class='bi bi-check-circle'></i> {$fac_row['name']}</span>";
      }
      if(count($facility_list['facilities']) > 0 && count($facility_list['facilities']) != $fac_count){ continue; }

      // === Features (Không gian) ===
      $fea_q = mysqli_query($con,
        "SELECT f.id, f.name FROM `features` f
         INNER JOIN `room_features` rfea ON f.id = rfea.features_id
         WHERE rfea.room_id = '{$room_data['id']}'"
      );
      $features_data = "";
      while($fea_row = mysqli_fetch_assoc($fea_q)){
        $features_data .= "<span class='view-badge'><i class='bi bi-check-circle'></i> {$fea_row['name']}</span>";
      }

      // === Thumbnail ===
      $room_thumb = ROOMS_IMG_PATH . "thumbnail.jpg";
      $thumb_q = mysqli_query($con,
        "SELECT * FROM `room_images` WHERE `room_id`='{$room_data['id']}' AND `thumb`='1' LIMIT 1"
      );
      if(mysqli_num_rows($thumb_q) > 0){
        $thumb_res  = mysqli_fetch_assoc($thumb_q);
        $room_thumb = ROOMS_IMG_PATH . $thumb_res['image'];
      }

      // === Book button ===
      $book_btn = "";
      if(!$settings_r['shutdown']){
        $login = (isset($_SESSION['login']) && $_SESSION['login'] == true) ? 1 : 0;
        $book_btn = "<button onclick='checkLoginToBook($login,{$room_data['id']})' class='room-btn room-btn-primary'><i class='bi bi-calendar-check'></i> Đặt ngay</button>";
      }

      // === Badge loại hình ===
      $type_badge = "";
      if(!empty($room_data['type_slug'])){
        $badge_class = $room_data['type_slug'] === 'villa' ? 'badge-villa' : 'badge-homestay';
        $type_badge  = "<span class='property-type-badge {$badge_class}'>{$room_data['type_name']}</span>";
      }

      // === Building ===
      $building_info = !empty($room_data['building_name']) ? $room_data['building_name'] : '';

      // === Formatted price ===
      $formatted_price = $room_data['price'] > 0
        ? number_format($room_data['price'], 0, ',', '.') . ' VNĐ/đêm'
        : 'Liên hệ';

      // === Room type badge ===
      $rt_badge = !empty($room_data['room_type_name'])
        ? "<span class='room-type-tag'>{$room_data['room_type_name']}</span>"
        : "";

      $filtered_rooms[] = compact(
        'room_data','features_data','facilities_data',
        'room_thumb','book_btn','type_badge',
        'building_info','formatted_price','rt_badge'
      );
    }

    // === Pagination ===
    $total_rooms  = count($filtered_rooms);
    $total_pages  = $total_rooms > 0 ? ceil($total_rooms / $limit) : 1;
    if($page > $total_pages) $page = $total_pages;
    $paginated = array_slice($filtered_rooms, $offset, $limit);

    // === Output ===
    if(count($paginated) > 0)
    {
      $rooms_html = "";
      foreach($paginated as $r)
      {
        $rd  = $r['room_data'];
        $url = "room_details.php?id={$rd['id']}";
        $code_badge = !empty($rd['code']) ? "<span class='room-code'>#{$rd['code']}</span>" : "";
        $checkin_str = $rd['checkin_time'] ? date('H:i', strtotime($rd['checkin_time'])) : '14:00';
        $checkout_str = $rd['checkout_time'] ? date('H:i', strtotime($rd['checkout_time'])) : '12:00';
        $bedroom_info = $rd['bedroom_count'] ? "<span class='room-badge'><i class='bi bi-door-open'></i> {$rd['bedroom_count']} PN</span>" : "";

        $rooms_html .= "
          <article class='room-card-enhanced' itemscope itemtype='https://schema.org/LodgingBusiness'>
            <div class='row g-0'>
              <div class='col-md-5'>
                <div class='room-image-wrapper'>
                  <a href='$url'>
                    <img src='{$r['room_thumb']}' alt='Hình ảnh {$rd['name']}' class='img-fluid' loading='lazy' itemprop='image'>
                  </a>
                  <div class='room-badge-overlay'>
                    {$r['type_badge']}
                    <div class='room-price-badge' itemprop='offers' itemscope itemtype='https://schema.org/Offer'>
                      <meta itemprop='price' content='{$rd['price']}'>
                      <meta itemprop='priceCurrency' content='VND'>
                      <span class='room-price-value'>{$r['formatted_price']}</span>
                    </div>
                  </div>
                </div>
              </div>
              <div class='col-md-7'>
                <div class='room-content-wrapper'>
                  <div class='d-flex align-items-start justify-content-between gap-2 mb-1'>
                    <h2 class='room-title' itemprop='name'>{$rd['name']}</h2>
                    $code_badge
                  </div>

                  " . (!empty($r['building_info']) ? "<p class='room-building'><i class='bi bi-building'></i> {$r['building_info']}</p>" : "") . "

                  <div class='room-tags-row'>
                    {$r['rt_badge']}
                    $bedroom_info
                    {$r['features_data']}
                  </div>

                  " . (!empty($r['facilities_data']) ? "
                  <div class='room-info-section'>
                    <div class='room-info-label'><i class='bi bi-star'></i><span>Tiện ích</span></div>
                    <div class='room-badges'>{$r['facilities_data']}</div>
                  </div>" : "") . "

                  <div class='room-info-section'>
                    <div class='room-info-label'><i class='bi bi-people'></i><span>Sức chứa</span></div>
                    <div class='room-badges'>
                      <span class='room-badge'><i class='bi bi-person'></i> {$rd['adult']} Người lớn</span>
                      <span class='room-badge'><i class='bi bi-person-heart'></i> {$rd['children']} Trẻ em</span>
                      " . ($rd['max_guests'] ? "<span class='room-badge'><i class='bi bi-people-fill'></i> Tối đa {$rd['max_guests']} khách</span>" : "") . "
                    </div>
                  </div>

                  <div class='room-checkin-row'>
                    <span><i class='bi bi-arrow-right-circle'></i> Check-in: <b>$checkin_str</b></span>
                    <span><i class='bi bi-arrow-left-circle'></i> Check-out: <b>$checkout_str</b></span>
                  </div>

                  <div class='room-actions'>
                    {$r['book_btn']}
                    <a href='$url' class='room-btn room-btn-outline'><i class='bi bi-info-circle'></i> Chi tiết</a>
                  </div>
                </div>
              </div>
            </div>
          </article>
        ";
      }

      // Pagination
      $pagination_html = "";
      if($total_pages > 1){
        $pagination_html = "<div class='rooms-pagination-wrapper'><nav><ul class='pagination rooms-pagination'>";
        if($page > 1) $pagination_html .= "<li class='page-item'><a class='page-link' href='#' data-page='" . ($page-1) . "'><i class='bi bi-chevron-left'></i></a></li>";
        else          $pagination_html .= "<li class='page-item disabled'><span class='page-link'><i class='bi bi-chevron-left'></i></span></li>";

        $s = max(1, $page-2); $e = min($total_pages, $page+2);
        if($s > 1){ $pagination_html .= "<li class='page-item'><a class='page-link' href='#' data-page='1'>1</a></li>"; if($s > 2) $pagination_html .= "<li class='page-item disabled'><span class='page-link'>…</span></li>"; }
        for($i = $s; $i <= $e; $i++){
          $pagination_html .= $i == $page
            ? "<li class='page-item active'><span class='page-link'>$i</span></li>"
            : "<li class='page-item'><a class='page-link' href='#' data-page='$i'>$i</a></li>";
        }
        if($e < $total_pages){ if($e < $total_pages-1) $pagination_html .= "<li class='page-item disabled'><span class='page-link'>…</span></li>"; $pagination_html .= "<li class='page-item'><a class='page-link' href='#' data-page='$total_pages'>$total_pages</a></li>"; }
        if($page < $total_pages) $pagination_html .= "<li class='page-item'><a class='page-link' href='#' data-page='" . ($page+1) . "'><i class='bi bi-chevron-right'></i></a></li>";
        else                     $pagination_html .= "<li class='page-item disabled'><span class='page-link'><i class='bi bi-chevron-right'></i></span></li>";

        $start_item = $offset + 1;
        $end_item   = min($offset + $limit, $total_rooms);
        $pagination_html .= "</ul></nav><p class='text-muted small mt-2'>Hiển thị $start_item–$end_item / $total_rooms phòng</p></div>";
      }

      echo $rooms_html . $pagination_html;
    }
    else
    {
      echo "<div class='rooms-empty'>
        <div class='rooms-empty-icon'>🔍</div>
        <h3 class='rooms-empty-title'>Không tìm thấy phòng</h3>
        <p class='rooms-empty-text'>Không có phòng nào phù hợp. Thử thay đổi bộ lọc hoặc ngày.</p>
      </div>";
    }
  }
?>
