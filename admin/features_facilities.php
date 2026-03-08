<?php
require('inc/essentials.php');
require('inc/db_config.php');
adminLogin();
?>
<!DOCTYPE html>
<html lang="vi">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Trang quản lý - Không gian và Tiện ích</title>
  <?php require('inc/links.php'); ?>
</head>

<body>

  <?php require('inc/header.php'); ?>

  <div id="main-content">
    <div class="p-4">

      <!-- Page title -->
      <div class="d-flex align-items-center gap-3 mb-4">
        <div>
          <h3 class="mb-0" style="font-family:'JetBrains Mono',monospace;font-weight:700;color:#e2e8f0;"><?php _e('ff_page_title') ?></h3>
          <p class="mb-0" style="font-size:13px;color:#64748b;"><?php _e('ff_page_sub') ?></p>
        </div>
      </div>

      <!-- ── Loại căn hộ và Không gian ── -->
      <div class="row mb-4">
        <!-- ── Loại căn hộ ── -->
        <div class="col-lg-6 col-md-12 mb-4 mb-lg-0">
          <div class="card h-100">
            <div class="card-body p-0">

              <div class="d-flex align-items-center justify-content-between px-4 pt-4 pb-3"
                style="border-bottom:1px solid rgba(129,140,248,.10);">
                <div class="d-flex align-items-center gap-2">
                  <i class="bi bi-house-door" style="font-size:18px;color:#818cf8;"></i>
                  <h5 class="m-0" style="font-weight:700;color:#e2e8f0;"><?php _e('property_types') ?></h5>
                  <span id="count-room-type" class="badge ms-1"
                    style="background:rgba(129,140,248,.15);color:#818cf8;font-size:11px;border:1px solid rgba(129,140,248,.25);">0</span>
                </div>
                <button type="button" class="btn btn-sm" data-bs-toggle="modal" data-bs-target="#room-type-s"
                  style="background:rgba(129,140,248,.12);border:1px solid rgba(129,140,248,.35);color:#818cf8;">
                  <i class="bi bi-plus-lg me-1"></i><?php _e('add_btn') ?>
                </button>
              </div>

              <div class="px-4 py-3">
                <div class="position-relative">
                  <i class="bi bi-search position-absolute"
                    style="left:12px;top:50%;transform:translateY(-50%);color:#64748b;font-size:14px;pointer-events:none;"></i>
                  <input type="text" id="search-room-type" class="form-control"
                    style="padding-left:36px;" placeholder="<?php _e('search_property') ?>">
                </div>
              </div>

              <div class="table-container" style="border-radius:0;border:none;box-shadow:none;">
                <table class="table mb-0">
                  <thead>
                    <tr>
                      <th style="width:60px;">#</th>
                      <th><?php _e('type_name') ?></th>
                      <th style="width:100px;"><?php _e('actions') ?></th>
                    </tr>
                  </thead>
                  <tbody id="room-type-data">
                    <tr>
                      <td colspan="3" class="text-center py-5" style="color:#64748b;"><?php _e('loading') ?></td>
                    </tr>
                  </tbody>
                </table>
              </div>

              <div id="pagination-room-type"
                class="d-flex align-items-center justify-content-between px-4 py-3"
                style="border-top:1px solid rgba(129,140,248,.08);min-height:52px;"></div>
            </div>
          </div>
        </div>

        <!-- ── Không gian ── -->
        <div class="col-lg-6 col-md-12">
          <div class="card h-100">
            <div class="card-body p-0">

              <div class="d-flex align-items-center justify-content-between px-4 pt-4 pb-3"
                style="border-bottom:1px solid rgba(129,140,248,.10);">
                <div class="d-flex align-items-center gap-2">
                  <i class="bi bi-layout-wtf" style="font-size:18px;color:#a78bfa;"></i>
                  <h5 class="m-0" style="font-weight:700;color:#e2e8f0;"><?php _e('features_label') ?></h5>
                  <span id="count-feature" class="badge ms-1"
                    style="background:rgba(167,139,250,.15);color:#a78bfa;font-size:11px;border:1px solid rgba(167,139,250,.25);">0</span>
                </div>
                <button type="button" class="btn btn-sm" data-bs-toggle="modal" data-bs-target="#feature-s"
                  style="background:rgba(167,139,250,.12);border:1px solid rgba(167,139,250,.35);color:#a78bfa;">
                  <i class="bi bi-plus-lg me-1"></i><?php _e('add_btn') ?>
                </button>
              </div>

              <div class="px-4 py-3">
                <div class="position-relative">
                  <i class="bi bi-search position-absolute"
                    style="left:12px;top:50%;transform:translateY(-50%);color:#64748b;font-size:14px;pointer-events:none;"></i>
                  <input type="text" id="search-feature" class="form-control"
                    style="padding-left:36px;" placeholder="<?php _e('search_feature') ?>">
                </div>
              </div>

              <div class="table-container" style="border-radius:0;border:none;box-shadow:none;">
                <table class="table mb-0">
                  <thead>
                    <tr>
                      <th style="width:60px;">#</th>
                      <th><?php _e('feature_name') ?></th>
                      <th style="width:100px;"><?php _e('actions') ?></th>
                    </tr>
                  </thead>
                  <tbody id="features-data">
                    <tr>
                      <td colspan="3" class="text-center py-5" style="color:#64748b;"><?php _e('loading') ?></td>
                    </tr>
                  </tbody>
                </table>
              </div>

              <div id="pagination-feature"
                class="d-flex align-items-center justify-content-between px-4 py-3"
                style="border-top:1px solid rgba(129,140,248,.08);min-height:52px;"></div>
            </div>
          </div>
        </div>
      </div>

      <!-- ── Tiện ích ── -->
      <div class="card mb-4">
        <div class="card-body p-0">

          <div class="d-flex align-items-center justify-content-between px-4 pt-4 pb-3"
            style="border-bottom:1px solid rgba(129,140,248,.10);">
            <div class="d-flex align-items-center gap-2">
              <i class="bi bi-grid-3x3-gap" style="font-size:18px;color:#60a5fa;"></i>
              <h5 class="m-0" style="font-weight:700;color:#e2e8f0;"><?php _e('facilities_label') ?></h5>
              <span id="count-facility" class="badge ms-1"
                style="background:rgba(96,165,250,.15);color:#60a5fa;font-size:11px;border:1px solid rgba(96,165,250,.25);">0</span>
            </div>
            <button type="button" class="btn btn-sm" data-bs-toggle="modal" data-bs-target="#facility-s"
              style="background:rgba(96,165,250,.12);border:1px solid rgba(96,165,250,.35);color:#60a5fa;">
              <i class="bi bi-plus-lg me-1"></i><?php _e('add_btn') ?>
            </button>
          </div>

          <div class="px-4 py-3">
            <div class="position-relative">
              <i class="bi bi-search position-absolute"
                style="left:12px;top:50%;transform:translateY(-50%);color:#64748b;font-size:14px;pointer-events:none;"></i>
              <input type="text" id="search-facility" class="form-control"
                style="padding-left:36px;" placeholder="<?php _e('search_facility') ?>">
            </div>
          </div>

          <div class="table-container" style="border-radius:0;border:none;box-shadow:none;">
            <table class="table mb-0">
              <thead>
                <tr>
                  <th style="width:60px;">#</th>
                  <th style="width:90px;">Icon</th>
                  <th><?php _e('facility_name') ?></th>
                  <th><?php _e('description') ?></th>
                  <th style="width:100px;"><?php _e('actions') ?></th>
                </tr>
              </thead>
              <tbody id="facilities-data">
                <tr>
                  <td colspan="5" class="text-center py-5" style="color:#64748b;"><?php _e('loading') ?></td>
                </tr>
              </tbody>
            </table>
          </div>

          <div id="pagination-facility"
            class="d-flex align-items-center justify-content-between px-4 py-3"
            style="border-top:1px solid rgba(129,140,248,.08);min-height:52px;"></div>
        </div>
      </div>

    </div>
  </div>


  <!-- Room type modal -->
  <div class="modal fade" id="room-type-s" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
      <form id="room_type_s_form">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title"><?php _e('add_property_type') ?></h5>
          </div>
          <div class="modal-body">
            <div class="mb-3">
              <label class="form-label fw-bold"><?php _e('member_name') ?></label>
              <input type="text" name="roomtype_name" class="form-control" placeholder="<?php _e('property_ph') ?>" required>
            </div>
          </div>
          <div class="modal-footer">
            <button type="reset" class="btn text-secondary" data-bs-dismiss="modal"><?php _e('cancel_btn') ?></button>
            <button type="submit" class="btn custom-bg"><?php _e('add_btn') ?></button>
          </div>
        </div>
      </form>
    </div>
  </div>

  <!-- Feature modal -->
  <div class="modal fade" id="feature-s" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
      <form id="feature_s_form">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title"><?php _e('add_feature') ?></h5>
          </div>
          <div class="modal-body">
            <div class="mb-3">
              <label class="form-label fw-bold"><?php _e('member_name') ?></label>
              <input type="text" name="feature_name" class="form-control" placeholder="<?php _e('feature_placeholder') ?>" required>
            </div>
          </div>
          <div class="modal-footer">
            <button type="reset" class="btn text-secondary" data-bs-dismiss="modal"><?php _e('cancel_btn') ?></button>
            <button type="submit" class="btn custom-bg"><?php _e('add_btn') ?></button>
          </div>
        </div>
      </form>
    </div>
  </div>

  <!-- Facility modal -->
  <div class="modal fade" id="facility-s" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
      <form id="facility_s_form">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title"><?php _e('add_facility') ?></h5>
          </div>
          <div class="modal-body">
            <div class="mb-3">
              <label class="form-label fw-bold"><?php _e('member_name') ?></label>
              <input type="text" name="facility_name" class="form-control" placeholder="<?php _e('facility_name_ph') ?>" required>
            </div>
            <div class="mb-3">
              <label class="form-label fw-bold"><?php _e('icon_fa') ?></label>
              <div class="input-group">
                <span class="input-group-text" id="icon-preview"><i class="fa-solid fa-check" style="width:20px;text-align:center;"></i></span>
                <input type="text" name="facility_icon" class="form-control" placeholder="<?php _e('icon_ph') ?>" id="facility_icon_input">
              </div>
              <small class="text-muted"><?php _e('icon_list_link') ?> <a href="https://fontawesome.com/icons" target="_blank">fontawesome.com/icons</a></small>
            </div>
            <div class="mb-3">
              <label class="form-label fw-bold"><?php _e('description') ?> <span style="color:#64748b;font-weight:400;">(<?php _e('optional') ?>)</span></label>
              <textarea name="facility_desc" class="form-control" rows="3" placeholder="<?php _e('facility_desc_ph') ?>"></textarea>
            </div>
          </div>
          <div class="modal-footer">
            <button type="reset" class="btn text-secondary" data-bs-dismiss="modal"><?php _e('cancel_btn') ?></button>
            <button type="submit" class="btn custom-bg"><?php _e('add_btn') ?></button>
          </div>
        </div>
      </form>
    </div>
  </div>


  <?php require('inc/scripts.php'); ?>
  <script src="scripts/features_facilities.js"></script>

</body>

</html>