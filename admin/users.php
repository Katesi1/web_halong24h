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
  <title>Trang quản lý - Người dùng</title>
  <?php require('inc/links.php'); ?>
</head>
<body>

  <?php require('inc/header.php'); ?>

  <div class="container-fluid" id="main-content">
    <div class="row">
      <div class="col-lg-10 ms-auto p-4 overflow-hidden">
        <h3 class="mb-4"><?php _e('user_list') ?></h3>

        <div class="card border-0 shadow-sm mb-4">
          <div class="card-body">

            <div class="text-end mb-4">
              <input type="text" oninput="search_user(this.value)" class="form-control shadow-none w-25 ms-auto" placeholder="<?php _e('type_to_search') ?>">
            </div>

            <div class="table-responsive">
              <table class="table table-hover border text-center">
                <thead>
                  <tr class="bg-dark text-light">
                    <th scope="col">#</th>
                    <th scope="col"><?php _e('name') ?></th>
                    <th scope="col">Email</th>
                    <th scope="col"><?php _e('phone_number') ?></th>
                    <th scope="col"><?php _e('location') ?></th>
                    <th scope="col"><?php _e('action') ?></th>
                  </tr>
                </thead>
                <tbody id="users-data">
                </tbody>
              </table>
            </div>

          </div>
        </div>

      </div>
    </div>
  </div>


  <!-- User Detail Modal -->
  <div class="modal fade" id="user-detail-modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-md">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title"><?php _e('user_details') ?></h5>
          <button type="button" class="btn-close shadow-none" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body" id="user-detail-body">
          <div class="text-center py-4"><div class="spinner-border text-secondary"></div></div>
        </div>
        <div class="modal-footer" id="user-detail-footer"></div>
      </div>
    </div>
  </div>


  <?php require('inc/scripts.php'); ?>

  <script src="scripts/users.js?v=3"></script>

</body>
</html>
