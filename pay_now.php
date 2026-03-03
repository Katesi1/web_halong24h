<?php 
  ini_set('display_errors', 1);
  ini_set('display_startup_errors', 1);
  error_reporting(E_ALL);
  require('admin/inc/db_config.php');
  require('admin/inc/essentials.php');

  session_start();

  // Lấy thông tin liên hệ để lấy số Zalo
  $contact_q = "SELECT * FROM `contact_details` WHERE `sr_no`=?";
  $contact_r = mysqli_fetch_assoc(select($contact_q,[1],'i'));

  // Không yêu cầu đăng nhập để đặt phòng
  if(isset($_POST['pay_now']))
  {
    // Xác định user_id: nếu đã đăng nhập thì dùng user_id đó, nếu không thì tạo/tìm user guest
    if(isset($_SESSION['login']) && $_SESSION['login']==true && isset($_SESSION['uId'])){
      $CUST_ID = $_SESSION['uId'];
      $ORDER_ID = 'ORD_'.$_SESSION['uId'].random_int(11111,9999999);
    } else {
      // Tìm hoặc tạo user guest (sử dụng một user guest duy nhất)
      $guest_email = 'guest@guest.com';
      $guest_check = select("SELECT `id` FROM `user_cred` WHERE `email`=?", [$guest_email], 's');
      
      if(mysqli_num_rows($guest_check) > 0){
        $guest_data = mysqli_fetch_assoc($guest_check);
        $CUST_ID = $guest_data['id'];
      } else {
        // Tạo user guest mới
        $guest_name = 'Guest User';
        $guest_phone = '0000000000';
        $guest_address = 'Guest Address';
        $guest_pass = password_hash('guest123', PASSWORD_DEFAULT);
        
        $insert_guest = "INSERT INTO `user_cred`(`name`, `email`, `phonenum`, `address`, `password`, `status`, `is_verified`) 
          VALUES (?,?,?,?,?,?,?)";
        insert($insert_guest, [$guest_name, $guest_email, $guest_phone, $guest_address, $guest_pass, 1, 1], 'sssssii');
        $CUST_ID = mysqli_insert_id($con);
      }
      $ORDER_ID = 'ORD_GUEST_'.random_int(11111,9999999);
    }
    
    $TXN_AMOUNT = $_SESSION['room']['payment'];
    
    // Tạo mã booking duy nhất (6 ký tự)
    $booking_code = strtoupper(substr(md5($ORDER_ID.time()), 0, 6));
    
    // Insert booking data into database
    $frm_data = filteration($_POST);

    $query1 = "INSERT INTO `booking_order`(`user_id`, `room_id`, `check_in`, `check_out`,`order_id`) VALUES (?,?,?,?,?)";

    insert($query1,[$CUST_ID,$_SESSION['room']['id'],$frm_data['checkin'],
      $frm_data['checkout'],$ORDER_ID],'issss');
    
    $booking_id = mysqli_insert_id($con);

    $query2 = "INSERT INTO `booking_details`(`booking_id`, `room_name`, `price`, `total_pay`,
      `user_name`, `phonenum`, `address`) VALUES (?,?,?,?,?,?,?)";

    // Sử dụng giá trị mặc định cho address vì không còn yêu cầu nhập
    $address = isset($frm_data['address']) ? $frm_data['address'] : 'N/A';

    insert($query2,[$booking_id,$_SESSION['room']['name'],$_SESSION['room']['price'],
      $TXN_AMOUNT,$frm_data['name'],$frm_data['phonenum'],$address],'issssss');

    // Tạo tin nhắn Zalo với thông tin booking
    $checkin_formatted = date("d/m/Y", strtotime($frm_data['checkin']));
    $checkout_formatted = date("d/m/Y", strtotime($frm_data['checkout']));
    $days = date_diff(new DateTime($frm_data['checkin']), new DateTime($frm_data['checkout']))->days;
    
    $zalo_message = "Xin chào! Tôi muốn đặt phòng với thông tin sau:\n\n";
    $zalo_message .= "📋 Mã đặt phòng: " . $booking_code . "\n";
    $zalo_message .= "👤 Tên khách hàng: " . $frm_data['name'] . "\n";
    $zalo_message .= "📞 Số điện thoại: " . $frm_data['phonenum'] . "\n";
    $zalo_message .= "🏨 Tên phòng: " . $_SESSION['room']['name'] . "\n";
    $zalo_message .= "📅 Ngày nhận phòng: " . $checkin_formatted . "\n";
    $zalo_message .= "📅 Ngày trả phòng: " . $checkout_formatted . "\n";
    $zalo_message .= "🌙 Số đêm: " . $days . " đêm\n";
    $zalo_message .= "💰 Tổng tiền: " . number_format($TXN_AMOUNT, 0, ',', '.') . " VND\n\n";
    $zalo_message .= "Vui lòng xác nhận đặt phòng này. Cảm ơn!";
    
    // Tạo link Zalo
    // Lấy số điện thoại từ link Zalo hoặc từ pn1
    $zalo_phone = '';
    if(!empty($contact_r['zalo'])){
      // Nếu zalo là URL như https://zalo.me/914298300, extract số điện thoại
      if(preg_match('/zalo\.me\/(\d+)/', $contact_r['zalo'], $matches)){
        $zalo_phone = $matches[1];
      } else {
        // Nếu không phải URL, thử extract số từ chuỗi
        $zalo_phone = preg_replace('/[^0-9]/', '', $contact_r['zalo']);
      }
    }
    
    // Nếu không lấy được từ zalo, dùng số điện thoại từ pn1
    if(empty($zalo_phone) && !empty($contact_r['pn1'])){
      $zalo_phone = preg_replace('/[^0-9]/', '', $contact_r['pn1']);
    }
    
    // Tạo link Zalo với tin nhắn đã được encode
    $zalo_url = "https://zalo.me/" . $zalo_phone . "?msg=" . urlencode($zalo_message);
    
    // Lưu mã booking vào session để hiển thị ở trang success
    $_SESSION['booking_success'] = [
      'booking_code' => $booking_code,
      'booking_id' => $booking_id,
      'zalo_url' => $zalo_url,
      'customer_name' => $frm_data['name'],
      'customer_phone' => $frm_data['phonenum'],
      'room_name' => $_SESSION['room']['name'],
      'checkin' => $checkin_formatted,
      'checkout' => $checkout_formatted,
      'days' => $days,
      'total_amount' => $TXN_AMOUNT
    ];
    
    // Xóa thông tin phòng khỏi session
    unset($_SESSION['room']);
    
    // Chuyển đến trang thành công
    redirect('booking_success.php');
  } else {
    redirect('index.php');
  }
?>