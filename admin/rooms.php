<?php
  require('inc/essentials.php');
  require('inc/db_config.php');
  adminLogin();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Trang quản lý - Danh sách phòng</title>
  <?php require('inc/links.php'); ?>
</head>
<body>

  <?php require('inc/header.php'); ?>

  <div class="container-fluid" id="main-content">
    <div class="row">
      <div class="col-lg-10 ms-auto p-4 overflow-hidden">
        <h3 class="mb-4"><?php _e('room_list_title') ?></h3>

        <div class="card border-0 shadow-sm mb-4">
          <div class="card-body">

            <div class="text-end mb-4">
              <button type="button" class="btn custom-bg text-white shadow-none btn-sm" data-bs-toggle="modal" data-bs-target="#add-room">
                <i class="bi bi-plus-square"></i> <?php _e('add_room') ?>
              </button>
            </div>

            <div class="table-responsive-lg" style="height: 450px; overflow-y: scroll;">
              <table class="table table-hover border text-start">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col"><?php _e('room_name') ?></th>
                    <th scope="col"><?php _e('room_type') ?></th>
                    <th scope="col"><?php _e('area') ?></th>
                    <th scope="col"><?php _e('guests') ?></th>
                    <th scope="col"><?php _e('price_per_night') ?></th>
                    <th scope="col"><?php _e('status') ?></th>
                    <th scope="col"><?php _e('action') ?></th>
                  </tr>
                </thead>
                <tbody id="room-data">                 
                </tbody>
              </table>
            </div>

          </div>
        </div>

      </div>
    </div>
  </div>
  

  <!-- Add room modal -->

  <div class="modal fade" id="add-room" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <form id="add_room_form" autocomplete="off">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title"><?php _e('add_room') ?></h5>
            <button type="button" class="btn-close shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <div class="row">
              <div class="col-md-6 mb-3">
                <label class="form-label fw-bold"><?php _e('room_name') ?></label>
                <input type="text" name="name" class="form-control shadow-none" required>
              </div>
              <div class="col-md-6 mb-3">
                <label class="form-label fw-bold"><?php _e('property_type') ?></label>
                <select name="property_type_id" id="add_property_type_id" class="form-select shadow-none">
                  <option value=""><?php _e('select_building') ?></option>
                  <?php
                    $res = selectAll('property_types');
                    while($opt = mysqli_fetch_assoc($res)){
                      echo"<option value='$opt[id]'>$opt[name]</option>";
                    }
                  ?>
                </select>
              </div>
              <div class="col-md-6 mb-3">
                <label class="form-label fw-bold"><?php _e('room_type') ?></label>
                <select name="room_type_id" id="add_room_type_id" class="form-select shadow-none" required>
                  <option value="" selected disabled><?php _e('select_room_type') ?></option>
                  <?php
                    $res = selectAll('room_types');
                    while($opt = mysqli_fetch_assoc($res)){
                      echo"<option value='$opt[id]' data-prop='$opt[property_type_id]'>$opt[name]</option>";
                    }
                  ?>
                </select>
              </div>
              <div class="col-md-6 mb-3">
                <label class="form-label fw-bold"><?php _e('buildings') ?></label>
                <select name="building_id" class="form-select shadow-none">
                  <option value=""><?php _e('select_building') ?></option>
                  <?php
                    $res = selectAll('buildings');
                    while($opt = mysqli_fetch_assoc($res)){
                      echo"<option value='$opt[id]'>$opt[name]</option>";
                    }
                  ?>
                </select>
              </div>
              <div class="col-md-6 mb-3">
                <label class="form-label fw-bold"><?php _e('area') ?></label>
                <input type="number" min="1" name="area" class="form-control shadow-none" required>
              </div>
              <div class="col-md-6 mb-3">
                <label class="form-label fw-bold"><?php _e('price_per_night') ?></label>
                <div class="input-group">
                  <input type="number" min="0" name="price" class="form-control shadow-none" placeholder="VD: 500">
                  <span class="input-group-text">× 1,000 VNĐ</span>
                </div>
                <small class="text-muted">Nhập số ngàn. VD: 500 → 500,000 VNĐ</small>
              </div>
              <div class="col-md-6 mb-3">
                <label class="form-label fw-bold"><?php _e('adults_standard') ?></label>
                <input type="number" min="1" name="adult" class="form-control shadow-none" required>
              </div>
              <div class="col-md-6 mb-3">
                <label class="form-label fw-bold"><?php _e('children_standard') ?></label>
                <input type="number" min="0" name="children" class="form-control shadow-none" required>
              </div>
              <div class="col-12 mb-3">
                <label class="form-label fw-bold"><?php _e('room_image') ?></label>
                <input type="file" name="room_image" accept=".jpg,.jpeg,.png,.webp,.heic,.heif" class="form-control shadow-none">
                <small class="text-muted"><?php _e('image_formats') ?></small>
              </div>
              <div class="col-12 mb-3">
                <label class="form-label fw-bold"><?php _e('view') ?></label>
                <div class="row">
                  <?php
                    $res = selectAll('features');
                    while($opt = mysqli_fetch_assoc($res)){
                      if($opt['name'] == 'Phòng Ngủ'){
                        echo"
                          <div class='col-md-3 mb-1'>
                            <label>
                              <input type='checkbox' name='features' value='$opt[id]' class='form-check-input shadow-none feature-bedroom'>
                              $opt[name]
                            </label>
                          </div>
                        ";
                      } else {
                        echo"
                          <div class='col-md-3 mb-1'>
                            <label>
                              <input type='checkbox' name='features' value='$opt[id]' class='form-check-input shadow-none'>
                              $opt[name]
                            </label>
                          </div>
                        ";
                      }
                    }
                  ?>
                </div>
              </div>
              <div class="col-12 mb-3">
                <label class="form-label fw-bold"><?php _e('amenities') ?></label>
                <div class="row">
                  <?php 
                    $res = selectAll('facilities');
                    while($opt = mysqli_fetch_assoc($res)){
                      echo"
                        <div class='col-md-3 mb-1'>
                          <label>
                            <input type='checkbox' name='facilities' value='$opt[id]' class='form-check-input shadow-none'>
                            $opt[name]
                          </label>
                        </div>
                      ";
                    }
                  ?>
                </div>
              </div>
              <div class="col-12 mb-3">
                <label class="form-label fw-bold"><?php _e('description') ?></label>
                <textarea name="desc" rows="4" class="form-control shadow-none" required></textarea>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="reset" class="btn text-secondary shadow-none" data-bs-dismiss="modal"><?php _e('cancel_btn') ?></button>
            <button type="submit" class="btn custom-bg text-white shadow-none"><?php _e('continue_btn') ?></button>
          </div>
        </div>
      </form>
    </div>
  </div>

  <!-- Edit room modal -->

  <div class="modal fade" id="edit-room" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <form id="edit_room_form" autocomplete="off">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title"><?php _e('update_room') ?></h5>
            <button type="button" class="btn-close shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <div class="row">
              <div class="col-md-6 mb-3">
                <label class="form-label fw-bold"><?php _e('room_name') ?></label>
                <input type="text" name="name" class="form-control shadow-none" required>
              </div>
              <div class="col-md-6 mb-3">
                <label class="form-label fw-bold"><?php _e('property_type') ?></label>
                <select name="property_type_id" id="edit_property_type_id" class="form-select shadow-none">
                  <option value=""><?php _e('select_building') ?></option>
                  <?php
                    $res = selectAll('property_types');
                    while($opt = mysqli_fetch_assoc($res)){
                      echo"<option value='$opt[id]'>$opt[name]</option>";
                    }
                  ?>
                </select>
              </div>
              <div class="col-md-6 mb-3">
                <label class="form-label fw-bold"><?php _e('room_type') ?></label>
                <select name="room_type_id" id="edit_room_type_id" class="form-select shadow-none" required>
                  <option value="" selected disabled><?php _e('select_room_type') ?></option>
                  <?php
                    $res = selectAll('room_types');
                    while($opt = mysqli_fetch_assoc($res)){
                      echo"<option value='$opt[id]' data-prop='$opt[property_type_id]'>$opt[name]</option>";
                    }
                  ?>
                </select>
              </div>
              <div class="col-md-6 mb-3">
                <label class="form-label fw-bold"><?php _e('buildings') ?></label>
                <select name="building_id" class="form-select shadow-none">
                  <option value=""><?php _e('select_building') ?></option>
                  <?php
                    $res = selectAll('buildings');
                    while($opt = mysqli_fetch_assoc($res)){
                      echo"<option value='$opt[id]'>$opt[name]</option>";
                    }
                  ?>
                </select>
              </div>
              <div class="col-md-6 mb-3">
                <label class="form-label fw-bold"><?php _e('area') ?></label>
                <input type="number" min="1" name="area" class="form-control shadow-none" required>
              </div>
              <div class="col-md-6 mb-3">
                <label class="form-label fw-bold"><?php _e('price_per_night') ?></label>
                <div class="input-group">
                  <input type="number" min="0" name="price" class="form-control shadow-none" placeholder="VD: 500">
                  <span class="input-group-text">× 1,000 VNĐ</span>
                </div>
                <small class="text-muted">Nhập số ngàn. VD: 500 → 500,000 VNĐ</small>
              </div>
              <div class="col-md-6 mb-3">
                <label class="form-label fw-bold"><?php _e('adults_standard') ?></label>
                <input type="number" min="1" name="adult" class="form-control shadow-none" required>
              </div>
              <div class="col-md-6 mb-3">
                <label class="form-label fw-bold"><?php _e('children_standard') ?></label>
                <input type="number" min="0" name="children" class="form-control shadow-none" required>
              </div>
              <div class="col-12 mb-3">
                <label class="form-label fw-bold"><?php _e('view') ?></label>
                <div class="row">
                  <?php
                    $res = selectAll('features');
                    while($opt = mysqli_fetch_assoc($res)){
                      echo"
                        <div class='col-md-3 mb-1'>
                          <label>
                            <input type='checkbox' name='features' value='$opt[id]' class='form-check-input shadow-none'>
                            $opt[name]
                          </label>
                        </div>
                      ";
                    }
                  ?>
                </div>
              </div>
              <div class="col-12 mb-3">
                <label class="form-label fw-bold"><?php _e('amenities') ?></label>
                <div class="row">
                  <?php
                    $res = selectAll('facilities');
                    while($opt = mysqli_fetch_assoc($res)){
                      echo"
                        <div class='col-md-3 mb-1'>
                          <label>
                            <input type='checkbox' name='facilities' value='$opt[id]' class='form-check-input shadow-none'>
                            $opt[name]
                          </label>
                        </div>
                      ";
                    }
                  ?>
                </div>
              </div>
              <div class="col-12 mb-3">
                <label class="form-label fw-bold"><?php _e('description') ?></label>
                <textarea name="desc" rows="4" class="form-control shadow-none" required></textarea>
              </div>
              <input type="hidden" name="room_id">
            </div>
          </div>
          <div class="modal-footer">
            <button type="reset" class="btn text-secondary shadow-none" data-bs-dismiss="modal"><?php _e('cancel_btn') ?></button>
            <button type="submit" class="btn custom-bg text-white shadow-none"><?php _e('save_changes') ?></button>
          </div>
        </div>
      </form>
    </div>
  </div>

  <!-- Manage room images modal -->

  <div class="modal fade" id="room-images" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Room Name</h5>
          <button type="button" class="btn-close shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div id="image-alert"></div>
          <div class="border-bottom border-3 pb-3 mb-3">
            <form id="add_image_form">
              <label class="form-label fw-bold"><?php _e('add_image') ?></label>
              <input type="file" name="image" accept=".jpg,.jpeg,.png,.webp,.heic,.heif" class="form-control shadow-none mb-3" required>
              <small class="text-muted"><?php _e('heic_auto_convert') ?></small>
              <button class="btn custom-bg text-white shadow-none"><?php _e('upload') ?></button>
              <input type="hidden" name="room_id">
            </form>
          </div>
          <div class="alert alert-info py-2 small mb-3">
            <i class="bi bi-info-circle"></i>
            <?php _e('main_photo_note') ?>
            <?php _e('click_set_main') ?> <span class="badge bg-secondary"><i class="bi bi-star"></i></span> <?php _e('to_set_main') ?>
          </div>
          <div class="table-responsive-lg" style="height: 350px; overflow-y: scroll;">
            <table class="table table-hover border text-start">
              <thead>
                <tr class="bg-dark text-light sticky-top">
                  <th scope="col" width="55%"><?php _e('image') ?></th>
                  <th scope="col"><?php _e('type') ?></th>
                  <th scope="col"><?php _e('set_main') ?></th>
                  <th scope="col"><?php _e('delete_btn') ?></th>
                </tr>
              </thead>
              <tbody id="room-image-data">
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>


  <?php require('inc/scripts.php'); ?>

  <script src="https://cdn.jsdelivr.net/npm/heic2any@0.0.4/dist/heic2any.min.js"></script>
  <script>
    async function convertHeicIfNeeded(file) {
      if (!file) return file;
      const name = file.name.toLowerCase();
      if (!name.endsWith('.heic') && !name.endsWith('.heif')) return file;

      // Show loading
      const btn = document.activeElement;
      const origText = btn ? btn.innerHTML : '';
      if (btn) btn.innerHTML = '<span class="spinner-border spinner-border-sm"></span> <?php _e("heic_converting") ?>';

      try {
        const blob = await heic2any({ blob: file, toType: 'image/jpeg', quality: 0.8 });
        const newName = file.name.replace(/\.(heic|heif)$/i, '.jpg');
        return new File([blob], newName, { type: 'image/jpeg' });
      } finally {
        if (btn) btn.innerHTML = origText;
      }
    }
  </script>
  <script src="scripts/rooms.js"></script>

</body>
</html>