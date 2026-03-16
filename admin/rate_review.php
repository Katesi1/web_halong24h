<?php
  require('inc/essentials.php');
  require('inc/db_config.php');
  adminLogin();

  if(isset($_GET['seen']))
  {
    $frm_data = filteration($_GET);

    if($frm_data['seen']=='all'){
      $q = "UPDATE `rating_review` SET `seen`=?";
      $values = [1];
      if(update($q,$values,'i')){
        alert('success',__('seen_all_reviews'));
      }
      else{
        alert('error',__('action_failed'));
      }
    }
    else{
      $q = "UPDATE `rating_review` SET `seen`=? WHERE `sr_no`=?";
      $values = [1,$frm_data['seen']];
      if(update($q,$values,'ii')){
        alert('success',__('seen_review'));
      }
      else{
        alert('error',__('action_failed'));
      }
    }
  }

  if(isset($_POST['edit_review']))
  {
    $frm_data = filteration($_POST);
    $sr_no  = (int)$frm_data['sr_no'];
    $rating = (int)$frm_data['rating'];
    $review = $frm_data['review'];

    if($rating >= 1 && $rating <= 5 && $sr_no > 0){
      $q = "UPDATE `rating_review` SET `rating`=?, `review`=? WHERE `sr_no`=?";
      $values = [$rating, $review, $sr_no];
      if(update($q,$values,'isi')){
        alert('success',__('updated_review'));
      }
      else{
        alert('error',__('action_failed'));
      }
    }
    else{
      alert('error',__('action_failed'));
    }
  }

  if(isset($_GET['del']))
  {
    $frm_data = filteration($_GET);

    if($frm_data['del']=='all'){
      $q = "DELETE FROM `rating_review`";
      if(mysqli_query($con,$q)){
        alert('success',__('deleted_all_reviews'));
      }
      else{
        alert('error',__('action_failed'));
      }
    }
    else{
      $q = "DELETE FROM `rating_review` WHERE `sr_no`=?";
      $values = [$frm_data['del']];
      if(delete($q,$values,'i')){
        alert('success',__('deleted_review'));
      }
      else{
        alert('error',__('action_failed'));
      }
    }
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Trang quản lý - Đánh giá</title>
  <?php require('inc/links.php'); ?>
</head>
<body>

  <?php require('inc/header.php'); ?>

  <div class="container-fluid" id="main-content">
    <div class="row">
      <div class="col-lg-10 ms-auto p-4 overflow-hidden">
        <h3 class="mb-4"><?php _e('reviews_title') ?></h3>

        <div class="card border-0 shadow-sm mb-4">
          <div class="card-body">

            <div class="text-end mb-4">
              <a href="?seen=all" class="btn btn-dark rounded-pill shadow-none btn-sm">
                <i class="bi bi-check-all"></i> <?php _e('mark_all_read') ?>
              </a>
              <a href="?del=all" class="btn btn-danger rounded-pill shadow-none btn-sm">
                <i class="bi bi-trash"></i> <?php _e('delete_all') ?>
              </a>
            </div>

            <div class="table-responsive-md">
              <table class="table table-hover border">
                <thead>
                  <tr class="bg-dark text-light">
                    <th scope="col">#</th>
                    <th scope="col"><?php _e('room_name') ?></th>
                    <th scope="col"><?php _e('name') ?></th>
                    <th scope="col"><?php _e('rating') ?></th>
                    <th scope="col" width="30%"><?php _e('review') ?></th>
                    <th scope="col"><?php _e('date') ?></th>
                    <th scope="col"><?php _e('action') ?></th>
                  </tr>
                </thead>
                <tbody>
                  <?php 
                    $q = "SELECT rr.*,uc.name AS uname, r.name AS rname FROM `rating_review` rr
                      INNER JOIN `user_cred` uc ON rr.user_id = uc.id
                      INNER JOIN `rooms` r ON rr.room_id = r.id
                      ORDER BY `sr_no` DESC";

                    $data = mysqli_query($con,$q);
                    $i=1;

                    while($row = mysqli_fetch_assoc($data))
                    {
                      $date = date('d-m-Y',strtotime($row['datentime']));

                      $seen='';
                      if($row['seen']!=1){
                        $seen = "<a href='?seen=$row[sr_no]' class='btn btn-sm rounded-pill btn-primary mb-2'>{$GLOBALS['_LANG']['mark_read']}</a> <br>";
                      }
                      $review_escaped = htmlspecialchars($row['review'], ENT_QUOTES);
                      $seen.="<button type='button' class='btn btn-sm rounded-pill btn-warning mb-2' data-bs-toggle='modal' data-bs-target='#editReviewModal' data-id='$row[sr_no]' data-rating='$row[rating]' data-review='$review_escaped'>{$GLOBALS['_LANG']['edit_btn']}</button> <br>";
                      $seen.="<a href='?del=$row[sr_no]' class='btn btn-sm rounded-pill btn-danger'>{$GLOBALS['_LANG']['delete_btn']}</a>";

                      echo<<<query
                        <tr>
                          <td>$i</td>
                          <td>$row[rname]</td>
                          <td>$row[uname]</td>
                          <td>$row[rating]</td>
                          <td>$row[review]</td>
                          <td>$date</td>
                          <td>$seen</td>
                        </tr>
                      query;
                      $i++;
                    }
                  ?>
                </tbody>
              </table>
            </div>

          </div>
        </div>


      </div>
    </div>
  </div>
  

  <!-- Edit Review Modal -->
  <div class="modal fade" id="editReviewModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <form method="POST">
          <input type="hidden" name="edit_review" value="1">
          <input type="hidden" name="sr_no" id="editSrNo">
          <div class="modal-header">
            <h5 class="modal-title"><?php _e('edit_review') ?></h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
          </div>
          <div class="modal-body">
            <div class="mb-3">
              <label class="form-label"><?php _e('rating') ?></label>
              <select name="rating" id="editRating" class="form-select" required>
                <option value="1">1 ★</option>
                <option value="2">2 ★★</option>
                <option value="3">3 ★★★</option>
                <option value="4">4 ★★★★</option>
                <option value="5">5 ★★★★★</option>
              </select>
            </div>
            <div class="mb-3">
              <label class="form-label"><?php _e('review') ?></label>
              <textarea name="review" id="editReviewText" class="form-control" rows="4" maxlength="500" required></textarea>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><?php _e('cancel_btn') ?></button>
            <button type="submit" class="btn btn-warning"><?php _e('update_btn') ?></button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <?php require('inc/scripts.php'); ?>
  <script>
    document.getElementById('editReviewModal').addEventListener('show.bs.modal', function(e) {
      var btn = e.relatedTarget;
      document.getElementById('editSrNo').value       = btn.dataset.id;
      document.getElementById('editRating').value     = btn.dataset.rating;
      document.getElementById('editReviewText').value = btn.dataset.review;
    });
  </script>

</body>
</html>