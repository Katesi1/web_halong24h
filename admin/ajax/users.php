<?php

  require('../inc/db_config.php');
  require('../inc/essentials.php');
  adminLogin();

  function buildUserRow($row, $i) {
    $name    = htmlspecialchars($row['name'], ENT_QUOTES);
    $email   = htmlspecialchars($row['email'], ENT_QUOTES);
    $phone   = htmlspecialchars($row['phonenum'] ?? '', ENT_QUOTES);
    $address = htmlspecialchars(trim(($row['address'] ?? '') . ($row['pincode'] ? ', ' . $row['pincode'] : '')), ENT_QUOTES);

    return "
      <tr>
        <td>$i</td>
        <td>$name</td>
        <td>$email</td>
        <td>$phone</td>
        <td>$address</td>
        <td>
          <button type='button' onclick='show_user_detail($row[id])' class='btn btn-sm btn-outline-primary shadow-none'>
            <i class='bi bi-person-lines-fill'></i> Chi tiết
          </button>
        </td>
      </tr>
    ";
  }

  if(isset($_POST['get_users']))
  {
    $res = selectAll('user_cred');
    $i = 1;
    $data = "";
    while($row = mysqli_fetch_assoc($res)) {
      $data .= buildUserRow($row, $i++);
    }
    echo $data;
  }

  if(isset($_POST['get_user']))
  {
    $frm_data = filteration($_POST);
    $res = select('SELECT * FROM `user_cred` WHERE `id`=?', [(int)$frm_data['get_user']], 'i');
    $row = mysqli_fetch_assoc($res);
    if(!$row){ echo 'not_found'; exit; }

    $path      = USERS_IMG_PATH;
    $name      = htmlspecialchars($row['name'], ENT_QUOTES);
    $email     = htmlspecialchars($row['email'], ENT_QUOTES);
    $phone     = htmlspecialchars($row['phonenum'] ?? '', ENT_QUOTES);
    $address   = htmlspecialchars($row['address'] ?? '', ENT_QUOTES);
    $pincode   = htmlspecialchars($row['pincode'] ?? '', ENT_QUOTES);
    $dob       = $row['dob'] ?? '—';
    $joined    = $row['datentime'] ? date('d/m/Y', strtotime($row['datentime'])) : '—';
    $profile   = $path . ($row['profile'] ?: 'default.png');
    $id        = (int)$row['id'];

    $verified_badge = $row['is_verified']
      ? "<span class='badge bg-success'><i class='bi bi-check-lg'></i> Đã xác minh</span>"
      : "<span class='badge bg-warning text-dark'><i class='bi bi-x-lg'></i> Chưa xác minh</span>";

    $status_label = $row['status'] ? 'Đang hoạt động' : 'Bị khoá';
    $status_class = $row['status'] ? 'success' : 'danger';
    $toggle_val   = $row['status'] ? 0 : 1;
    $toggle_label = $row['status'] ? 'Khoá tài khoản' : 'Mở khoá';
    $toggle_class = $row['status'] ? 'btn-warning' : 'btn-success';

    $del_btn = !$row['is_verified']
      ? "<button type='button' onclick='remove_user($id)' class='btn btn-danger btn-sm shadow-none'><i class='bi bi-trash'></i> Xoá</button>"
      : "";

    echo "
      <div class='text-center mb-3'>
        <img src='$profile' width='80' height='80' class='rounded-circle object-fit-cover border' onerror=\"this.src='{$path}default.png'\">
        <h5 class='mt-2 mb-0'>$name</h5>
        <small class='text-muted'>$email</small>
      </div>
      <table class='table table-sm table-bordered'>
        <tr><th style='width:40%'>Số điện thoại</th><td>$phone</td></tr>
        <tr><th>Địa chỉ</th><td>$address" . ($pincode ? " — $pincode" : "") . "</td></tr>
        <tr><th>Ngày sinh</th><td>$dob</td></tr>
        <tr><th>Ngày tham gia</th><td>$joined</td></tr>
        <tr><th>Xác minh</th><td>$verified_badge</td></tr>
        <tr><th>Trạng thái</th><td><span class='badge bg-$status_class'>$status_label</span></td></tr>
      </table>
      <div class='d-flex gap-2 justify-content-end mt-2' id='detail-action-btns'>
        <button type='button' onclick='toggle_status($id,$toggle_val)' class='btn btn-sm $toggle_class shadow-none'>$toggle_label</button>
        $del_btn
      </div>
    ";
  }

  if(isset($_POST['toggle_status']))
  {
    $frm_data = filteration($_POST);

    $q = "UPDATE `user_cred` SET `status`=? WHERE `id`=?";
    $v = [$frm_data['value'], $frm_data['toggle_status']];

    if(update($q,$v,'ii')){ echo 1; }
    else{ echo 0; }
  }

  if(isset($_POST['remove_user']))
  {
    $frm_data = filteration($_POST);

    $res = delete("DELETE FROM `user_cred` WHERE `id`=? AND `is_verified`=?", [$frm_data['user_id'], 0], 'ii');
    echo $res ? 1 : 0;
  }

  if(isset($_POST['search_user']))
  {
    $frm_data = filteration($_POST);
    $res = select("SELECT * FROM `user_cred` WHERE `name` LIKE ?", ["%$frm_data[name]%"], 's');
    $i = 1;
    $data = "";
    while($row = mysqli_fetch_assoc($res)) {
      $data .= buildUserRow($row, $i++);
    }
    echo $data;
  }

?>
