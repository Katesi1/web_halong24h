<?php 

  require('../admin/inc/db_config.php');
  require('../admin/inc/essentials.php');
  

  session_start();

  if(isset($_GET['fetch_rooms']))
  {
    // check availability data decode
    $chk_avail = json_decode($_GET['chk_avail'],true);
    
    // checkin and checkout filter validations
    if($chk_avail['checkin']!='' && $chk_avail['checkout']!='')
    {
      $today_date = new DateTime(date("Y-m-d"));
      $checkin_date = new DateTime($chk_avail['checkin']);
      $checkout_date = new DateTime($chk_avail['checkout']);
  
      if($checkin_date == $checkout_date){
        echo"<div class='rooms-empty'><div class='rooms-empty-icon'>⚠️</div><h3 class='rooms-empty-title'>Ngày không hợp lệ</h3><p class='rooms-empty-text'>Ngày nhận phòng và trả phòng không thể trùng nhau.</p></div>";
        exit;
      }
      else if($checkout_date < $checkin_date){
        echo"<div class='rooms-empty'><div class='rooms-empty-icon'>⚠️</div><h3 class='rooms-empty-title'>Ngày không hợp lệ</h3><p class='rooms-empty-text'>Ngày trả phòng phải sau ngày nhận phòng.</p></div>";
        exit;
      }
      else if($checkin_date < $today_date){
        echo"<div class='rooms-empty'><div class='rooms-empty-icon'>⚠️</div><h3 class='rooms-empty-title'>Ngày không hợp lệ</h3><p class='rooms-empty-text'>Ngày nhận phòng không thể trong quá khứ.</p></div>";
        exit;
      }
    }

    // guests data decode
    $guests = json_decode($_GET['guests'],true);
    $adults = ($guests['adults']!='') ? $guests['adults'] : 0;
    $children = ($guests['children']!='') ? $guests['children'] : 0;

    // facilities data decode
    $facility_list = json_decode($_GET['facility_list'],true);

    // Pagination parameters
    $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    $limit = 10; // Items per page
    $offset = ($page - 1) * $limit;

    // Array to store filtered rooms
    $filtered_rooms = array();

    // fetching settings table to check website is shutdown or not
    $settings_q = "SELECT * FROM `settings` WHERE `sr_no`=1";
    $settings_r = mysqli_fetch_assoc(mysqli_query($con,$settings_q));


    // query for room cards with guests filter
    $room_res = select("SELECT * FROM `rooms` WHERE `adult`>=? AND `children`>=? AND `status`=? AND `removed`=?",[$adults,$children,1,0],'iiii');

    while($room_data = mysqli_fetch_assoc($room_res))
    {
      // check availability filter
      if($chk_avail['checkin']!='' && $chk_avail['checkout']!='')
      {
        $tb_query = "SELECT COUNT(*) AS `total_bookings` FROM `booking_order`
          WHERE booking_status=? AND room_id=?
          AND check_out > ? AND check_in < ?";

        $values = ['booked',$room_data['id'],$chk_avail['checkin'],$chk_avail['checkout']];
        $tb_fetch = mysqli_fetch_assoc(select($tb_query,$values,'siss'));

        if(($room_data['quantity']-$tb_fetch['total_bookings'])==0){
          continue;
        }
      }

      // get facilities of room with filters
      $fac_count=0;

      $fac_q = mysqli_query($con,"SELECT f.name, f.id FROM `facilities` f 
        INNER JOIN `room_facilities` rfac ON f.id = rfac.facilities_id 
        WHERE rfac.room_id = '$room_data[id]'");

      $facilities_data = "";
      while($fac_row = mysqli_fetch_assoc($fac_q))
      {
        if( in_array($fac_row['id'],$facility_list['facilities']) ){
          $fac_count++;
        }

        $facilities_data .="<span class='room-badge' aria-label='Tiện ích: $fac_row[name]'>
          <i class='bi bi-check-circle'></i> $fac_row[name]
        </span>";
      }

      if(count($facility_list['facilities'])>0 && count($facility_list['facilities'])!=$fac_count){
        continue;
      }


      // get features of room

      $fea_q = mysqli_query($con,"SELECT f.name FROM `features` f 
        INNER JOIN `room_features` rfea ON f.id = rfea.features_id 
        WHERE rfea.room_id = '$room_data[id]'");

      $features_data = "";
      while($fea_row = mysqli_fetch_assoc($fea_q)){
        $features_data .="<span class='room-badge' aria-label='Tính năng: $fea_row[name]'>
          <i class='bi bi-check-circle'></i> $fea_row[name]
        </span>";
      }


      // get thumbnail of image

      $room_thumb = ROOMS_IMG_PATH."thumbnail.jpg";
      $thumb_q = mysqli_query($con,"SELECT * FROM `room_images` 
        WHERE `room_id`='$room_data[id]' 
        AND `thumb`='1'");

      if(mysqli_num_rows($thumb_q)>0){
        $thumb_res = mysqli_fetch_assoc($thumb_q);
        $room_thumb = ROOMS_IMG_PATH.$thumb_res['image'];
      }

      $book_btn = "";

      if(!$settings_r['shutdown']){
        $login=0;
        if(isset($_SESSION['login']) && $_SESSION['login']==true){
          $login=1;
        }

        $book_btn = "<button onclick='checkLoginToBook($login,$room_data[id])' class='room-btn room-btn-primary' aria-label='Đặt phòng $room_data[name]'>
          <i class='bi bi-calendar-check'></i> Đặt ngay
        </button>";
      }

      // Add room to filtered array
      $filtered_rooms[] = array(
        'id' => $room_data['id'],
        'name' => $room_data['name'],
        'price' => $room_data['price'],
        'adult' => $room_data['adult'],
        'children' => $room_data['children'],
        'thumb' => $room_thumb,
        'features' => $features_data,
        'facilities' => $facilities_data,
        'book_btn' => $book_btn
      );
    }

    // Calculate pagination
    $total_rooms = count($filtered_rooms);
    $total_pages = ceil($total_rooms / $limit);
    
    // Validate page number
    if($page < 1) $page = 1;
    if($page > $total_pages && $total_pages > 0) $page = $total_pages;

    // Get rooms for current page
    $paginated_rooms = array_slice($filtered_rooms, $offset, $limit);

    // Generate HTML output
    $output = "";
    $rooms_html = "";

    if(count($paginated_rooms) > 0){
      foreach($paginated_rooms as $room_data)
      {
        // Format price
        $formatted_price = number_format($room_data['price'], 0, ',', '.');

        // Room detail URL
        $room_detail_url = "room_details.php?id=" . $room_data['id'];

        // Generate room card HTML
        $rooms_html .= "
          <article class='room-card-enhanced' itemscope itemtype='https://schema.org/HotelRoom'>
            <div class='row g-0'>
              <div class='col-md-5'>
                <div class='room-image-wrapper'>
                  <a href='$room_detail_url' aria-label='Xem chi tiết phòng {$room_data['name']}'>
                    <img src='{$room_data['thumb']}' 
                         alt='Hình ảnh phòng {$room_data['name']}' 
                         class='img-fluid' 
                         loading='lazy'
                         itemprop='image'>
                  </a>
                  <div class='room-badge-overlay'>
                    <div class='room-price-badge' itemprop='offers' itemscope itemtype='https://schema.org/Offer'>
                      <meta itemprop='price' content='{$room_data['price']}'>
                      <meta itemprop='priceCurrency' content='VND'>
                      <span class='room-price-value'>$formatted_price</span>
                      <span class='room-price-unit'>VNĐ/đêm</span>
                    </div>
                  </div>
                </div>
              </div>
              <div class='col-md-7'>
                <div class='room-content-wrapper'>
                  <h2 class='room-title' itemprop='name'>{$room_data['name']}</h2>
                  
                  <div class='room-info-section'>
                    <div class='room-info-label'>
                      <i class='bi bi-rulers'></i>
                      <span>Không gian</span>
                    </div>
                    <div class='room-badges' itemprop='amenityFeature'>
                      {$room_data['features']}
                    </div>
                  </div>

                  <div class='room-info-section'>
                    <div class='room-info-label'>
                      <i class='bi bi-star'></i>
                      <span>Tiện ích</span>
                    </div>
                    <div class='room-badges' itemprop='amenityFeature'>
                      {$room_data['facilities']}
                    </div>
                  </div>

                  <div class='room-info-section'>
                    <div class='room-info-label'>
                      <i class='bi bi-people'></i>
                      <span>Số lượng khách</span>
                    </div>
                    <div class='room-badges'>
                      <span class='room-badge' aria-label='{$room_data['adult']} người lớn'>
                        <i class='bi bi-person'></i> {$room_data['adult']} Người lớn
                      </span>
                      <span class='room-badge' aria-label='{$room_data['children']} trẻ em'>
                        <i class='bi bi-person-heart'></i> {$room_data['children']} Trẻ em
                      </span>
                    </div>
                  </div>

                  <div class='room-actions'>
                    {$room_data['book_btn']}
                    <a href='$room_detail_url' class='room-btn room-btn-outline' aria-label='Xem chi tiết phòng {$room_data['name']}'>
                      <i class='bi bi-info-circle'></i> Chi tiết
                    </a>
                  </div>
                </div>
              </div>
            </div>
          </article>
        ";
      }

      // Generate pagination HTML
      $pagination_html = "";
      if($total_pages > 1){
        $pagination_html = "<div class='rooms-pagination-wrapper'><nav aria-label='Phân trang danh sách phòng'><ul class='pagination rooms-pagination'>";
        
        // Previous button
        if($page > 1){
          $prev_page = $page - 1;
          $pagination_html .= "<li class='page-item'><a class='page-link' href='#' data-page='$prev_page' aria-label='Trang trước'><i class='bi bi-chevron-left'></i></a></li>";
        } else {
          $pagination_html .= "<li class='page-item disabled'><span class='page-link'><i class='bi bi-chevron-left'></i></span></li>";
        }

        // Page numbers
        $start_page = max(1, $page - 2);
        $end_page = min($total_pages, $page + 2);

        if($start_page > 1){
          $pagination_html .= "<li class='page-item'><a class='page-link' href='#' data-page='1'>1</a></li>";
          if($start_page > 2){
            $pagination_html .= "<li class='page-item disabled'><span class='page-link'>...</span></li>";
          }
        }

        for($i = $start_page; $i <= $end_page; $i++){
          if($i == $page){
            $pagination_html .= "<li class='page-item active'><span class='page-link'>$i</span></li>";
          } else {
            $pagination_html .= "<li class='page-item'><a class='page-link' href='#' data-page='$i'>$i</a></li>";
          }
        }

        if($end_page < $total_pages){
          if($end_page < $total_pages - 1){
            $pagination_html .= "<li class='page-item disabled'><span class='page-link'>...</span></li>";
          }
          $pagination_html .= "<li class='page-item'><a class='page-link' href='#' data-page='$total_pages'>$total_pages</a></li>";
        }

        // Next button
        if($page < $total_pages){
          $next_page = $page + 1;
          $pagination_html .= "<li class='page-item'><a class='page-link' href='#' data-page='$next_page' aria-label='Trang sau'><i class='bi bi-chevron-right'></i></a></li>";
        } else {
          $pagination_html .= "<li class='page-item disabled'><span class='page-link'><i class='bi bi-chevron-right'></i></span></li>";
        }

        $pagination_html .= "</ul></nav>";
        
        // Results info
        $start_item = $offset + 1;
        $end_item = min($offset + $limit, $total_rooms);
        $pagination_html .= "<div class='pagination-info'><p class='text-muted mb-0'>Hiển thị $start_item - $end_item trong tổng số $total_rooms phòng</p></div>";
        $pagination_html .= "</div>";
      }

      $output = $rooms_html . $pagination_html;
    } else {
      $output = "<div class='rooms-empty'>
        <div class='rooms-empty-icon'>🔍</div>
        <h3 class='rooms-empty-title'>Không tìm thấy phòng</h3>
        <p class='rooms-empty-text'>Không có phòng nào phù hợp với tiêu chí tìm kiếm của bạn. Vui lòng thử lại với bộ lọc khác.</p>
      </div>";
    }

    echo $output;

  }


?>