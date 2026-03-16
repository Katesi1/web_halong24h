<?php 

  require('../inc/db_config.php');
  require('../inc/essentials.php');
  adminLogin();

  if(isset($_POST['add_room_type']))
  {
    $frm_data = filteration($_POST);

    $check = select('SELECT id FROM `room_types` WHERE LOWER(`name`)=LOWER(?)', [$frm_data['name']], 's');
    if(mysqli_num_rows($check) > 0){ echo 'duplicate'; }
    else {
      $q = "INSERT INTO `room_types`(`name`) VALUES (?)";
      $res = insert($q, [$frm_data['name']], 's');
      echo $res;
    }
  }

  if(isset($_POST['get_room_types']))
  {
    $res = selectAll('room_types');
    $i=1;

    while($row = mysqli_fetch_assoc($res))
    {
      $safe_name = htmlspecialchars($row['name'], ENT_QUOTES);
      echo <<<data
        <tr>
          <td>$i</td>
          <td>$safe_name</td>
          <td style="white-space:nowrap;">
            <button type="button" onclick="edit_room_type($row[id], this)" class="btn btn-warning btn-sm shadow-none me-1">
              <i class="bi bi-pencil"></i>
            </button>
            <button type="button" onclick="rem_room_type($row[id])" class="btn btn-danger btn-sm shadow-none">
              <i class="bi bi-trash"></i>
            </button>
          </td>
        </tr>
      data;
      $i++;
    }
  }

  if(isset($_POST['update_room_type']))
  {
    $frm_data = filteration($_POST);
    $q = "UPDATE `room_types` SET `name`=? WHERE `id`=?";
    $res = update($q, [$frm_data['name'], $frm_data['id']], 'si');
    echo $res;
  }

  if(isset($_POST['rem_room_type']))
  {
    $frm_data = filteration($_POST);
    $values = [$frm_data['rem_room_type']];

    $check_q = select('SELECT * FROM `rooms` WHERE `room_type_id`=?',[$frm_data['rem_room_type']],'i');

    if(mysqli_num_rows($check_q)==0){
      $q = "DELETE FROM `room_types` WHERE `id`=?";
      $res = delete($q,$values,'i');
      echo $res;
    }
    else{
      echo 'room_added';
    }
  }

  if(isset($_POST['add_building']))
  {
    $frm_data = filteration($_POST);
    $name = $frm_data['name'];

    $check = select('SELECT id FROM `buildings` WHERE LOWER(`name`)=LOWER(?)', [$name], 's');
    if(mysqli_num_rows($check) > 0){ echo 'duplicate'; }
    else {
      $slug = strtolower(preg_replace('/\s+/', '-', preg_replace('/[^a-zA-Z0-9\s]/', '', iconv('UTF-8', 'ASCII//TRANSLIT', $name))));
      $q = "INSERT INTO `buildings`(`name`, `slug`) VALUES (?,?)";
      $res = insert($q, [$name, $slug ?: 'building-' . time()], 'ss');
      echo $res;
    }
  }

  if(isset($_POST['get_buildings']))
  {
    $res = selectAll('buildings');
    $i=1;

    while($row = mysqli_fetch_assoc($res))
    {
      $safe_name = htmlspecialchars($row['name'], ENT_QUOTES);
      echo <<<data
        <tr>
          <td>$i</td>
          <td>$safe_name</td>
          <td style="white-space:nowrap;">
            <button type="button" onclick="edit_building($row[id], this)" class="btn btn-warning btn-sm shadow-none me-1">
              <i class="bi bi-pencil"></i>
            </button>
            <button type="button" onclick="rem_building($row[id])" class="btn btn-danger btn-sm shadow-none">
              <i class="bi bi-trash"></i>
            </button>
          </td>
        </tr>
      data;
      $i++;
    }
  }

  if(isset($_POST['update_building']))
  {
    $frm_data = filteration($_POST);
    $q = "UPDATE `buildings` SET `name`=? WHERE `id`=?";
    $res = update($q, [$frm_data['name'], $frm_data['id']], 'si');
    echo $res;
  }

  if(isset($_POST['rem_building']))
  {
    $frm_data = filteration($_POST);
    $values = [$frm_data['rem_building']];

    $check_q = select('SELECT * FROM `rooms` WHERE `building_id`=?',[$frm_data['rem_building']],'i');

    if(mysqli_num_rows($check_q)==0){
      $q = "DELETE FROM `buildings` WHERE `id`=?";
      $res = delete($q,$values,'i');
      echo $res;
    }
    else{
      echo 'room_added';
    }
  }

  if(isset($_POST['add_feature']))
  {
    $frm_data = filteration($_POST);

    $check = select('SELECT id FROM `features` WHERE LOWER(`name`)=LOWER(?)', [$frm_data['name']], 's');
    if(mysqli_num_rows($check) > 0){ echo 'duplicate'; }
    else {
      $q = "INSERT INTO `features`(`name`) VALUES (?)";
      $res = insert($q, [$frm_data['name']], 's');
      echo $res;
    }
  }

  if(isset($_POST['get_features']))
  {
    $res = selectAll('features');
    $i=1;

    while($row = mysqli_fetch_assoc($res))
    {
      $safe_name = htmlspecialchars($row['name'], ENT_QUOTES);
      echo <<<data
        <tr>
          <td>$i</td>
          <td>$safe_name</td>
          <td>
            <button type="button" onclick="edit_feature($row[id], this)" class="btn btn-warning btn-sm shadow-none me-1">
              <i class="bi bi-pencil"></i>
            </button>
            <button type="button" onclick="rem_feature($row[id])" class="btn btn-danger btn-sm shadow-none">
              <i class="bi bi-trash"></i>
            </button>
          </td>
        </tr>
      data;
      $i++;
    }
  }

  if(isset($_POST['update_feature']))
  {
    $frm_data = filteration($_POST);
    $q = "UPDATE `features` SET `name`=? WHERE `id`=?";
    $res = update($q, [$frm_data['name'], $frm_data['id']], 'si');
    echo $res;
  }

  if(isset($_POST['rem_feature']))
  {
    $frm_data = filteration($_POST);
    $values = [$frm_data['rem_feature']];

    $check_q = select('SELECT * FROM `room_features` WHERE `features_id`=?',[$frm_data['rem_feature']],'i');

    if(mysqli_num_rows($check_q)==0){
      $q = "DELETE FROM `features` WHERE `id`=?";
      $res = delete($q,$values,'i');
      echo $res;
    }
    else{
      echo 'room_added';
    }

  }


  if(isset($_POST['add_facility']))
  {
    $frm_data = filteration($_POST);
    $icon_class = !empty($frm_data['icon']) ? $frm_data['icon'] : 'fa-check';

    $check = select('SELECT id FROM `facilities` WHERE LOWER(`name`)=LOWER(?)', [$frm_data['name']], 's');
    if(mysqli_num_rows($check) > 0){ echo 'duplicate'; }
    else {
      $q = "INSERT INTO `facilities`(`icon`,`name`,`description`) VALUES (?,?,?)";
      $res = insert($q, [$icon_class, $frm_data['name'], $frm_data['desc']], 'sss');
      echo $res;
    }
  }

  if(isset($_POST['get_facilities']))
  {
    $res = selectAll('facilities');
    $i=1;

    while($row = mysqli_fetch_assoc($res))
    {
      $icon_html = "<i class='fa-solid {$row['icon']}' style='font-size:20px;color:#60a5fa;'></i>";
      $safe_name = htmlspecialchars($row['name'], ENT_QUOTES);
      $safe_desc = htmlspecialchars($row['description'] ?? '', ENT_QUOTES);
      $safe_icon = htmlspecialchars($row['icon'], ENT_QUOTES);
      echo <<<data
        <tr class='align-middle' data-id="$row[id]" data-name="$safe_name" data-icon="$safe_icon" data-desc="$safe_desc">
          <td>$i</td>
          <td>$icon_html</td>
          <td>$safe_name</td>
          <td>$safe_desc</td>
          <td>
            <button type="button" onclick="edit_facility($row[id], this)" class="btn btn-warning btn-sm shadow-none me-1">
              <i class="bi bi-pencil"></i>
            </button>
            <button type="button" onclick="rem_facility($row[id])" class="btn btn-danger btn-sm shadow-none">
              <i class="bi bi-trash"></i>
            </button>
          </td>
        </tr>
      data;
      $i++;
    }
  }

  if(isset($_POST['update_facility']))
  {
    $frm_data = filteration($_POST);
    $icon_class = !empty($frm_data['icon']) ? $frm_data['icon'] : 'fa-check';
    $q = "UPDATE `facilities` SET `icon`=?, `name`=?, `description`=? WHERE `id`=?";
    $res = update($q, [$icon_class, $frm_data['name'], $frm_data['desc'], $frm_data['id']], 'sssi');
    echo $res;
  }

  if(isset($_POST['rem_facility']))
  {
    $frm_data = filteration($_POST);
    $values = [$frm_data['rem_facility']];

    $check_q = select('SELECT * FROM `room_facilities` WHERE `facilities_id`=?',[$frm_data['rem_facility']],'i');

    if(mysqli_num_rows($check_q)==0)
    {
      $q = "DELETE FROM `facilities` WHERE `id`=?";
      $res = delete($q,$values,'i');
      echo $res;
    }
    else{
      echo 'room_added';
    }
  }

?>