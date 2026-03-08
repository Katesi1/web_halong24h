<?php
// AJAX endpoint – suppress PHP warnings/notices so they don't corrupt the response
ini_set('display_errors', 0);
error_reporting(0);

require('../admin/inc/db_config.php');
require('../admin/inc/essentials.php');

session_start();

if (!isset($_SESSION['uId'])) {
    echo 'not_logged_in';
    exit;
}

if (isset($_POST['info_form'])) {
    $frm_data = filteration($_POST);

    // Kiểm tra SĐT trùng với tài khoản khác
    $u_exist = select(
        "SELECT id FROM `user_cred` WHERE `phonenum`=? AND `id`!=? LIMIT 1",
        [$frm_data['phonenum'], $_SESSION['uId']],
        "ss"
    );
    if (mysqli_num_rows($u_exist) != 0) {
        echo 'phone_already';
        exit;
    }

    $query = "UPDATE `user_cred` SET `name`=?, `address`=?, `phonenum`=?,
        `pincode`=?, `dob`=? WHERE `id`=? LIMIT 1";
    $values = [
        $frm_data['name'], $frm_data['address'], $frm_data['phonenum'],
        $frm_data['pincode'], $frm_data['dob'], $_SESSION['uId']
    ];

    update($query, $values, 'ssssss');
    $_SESSION['uName'] = $frm_data['name'];
    echo 1;
    exit;
}

if (isset($_POST['profile_form'])) {
    // Kiểm tra lỗi upload từ phía PHP/server
    if (!isset($_FILES['profile']) || $_FILES['profile']['error'] !== UPLOAD_ERR_OK) {
        echo 'upd_failed';
        exit;
    }

    $img = uploadUserImage($_FILES['profile']);

    if ($img == 'inv_img') {
        echo 'inv_img';
        exit;
    }
    if ($img == 'upd_failed') {
        echo 'upd_failed';
        exit;
    }

    // Fetch ảnh cũ, xóa nếu không phải ảnh mặc định
    $u_exist = select(
        "SELECT `profile` FROM `user_cred` WHERE `id`=? LIMIT 1",
        [$_SESSION['uId']], "s"
    );
    $u_fetch = mysqli_fetch_assoc($u_exist);

    if ($u_fetch && $u_fetch['profile'] !== 'avatar-default.png') {
        deleteImage($u_fetch['profile'], USERS_FOLDER);
    }

    $query  = "UPDATE `user_cred` SET `profile`=? WHERE `id`=? LIMIT 1";
    $values = [$img, $_SESSION['uId']];

    $affected = update($query, $values, 'ss');
    if ($affected !== false && $affected >= 0) {
        $_SESSION['uPic'] = $img;
        echo 1;
    } else {
        echo 'db_error';
    }
    exit;
}

if (isset($_POST['pass_form'])) {
    $frm_data = filteration($_POST);

    if ($frm_data['new_pass'] != $frm_data['confirm_pass']) {
        echo 'mismatch';
        exit;
    }

    $np = $frm_data['new_pass'];
    if (strlen($np) < 8 || !preg_match('/[A-Z]/', $np) || !preg_match('/[a-z]/', $np)
        || !preg_match('/[0-9]/', $np) || !preg_match('/[^A-Za-z0-9]/', $np)) {
        echo 'pass_weak';
        exit;
    }

    $enc_pass = password_hash($np, PASSWORD_BCRYPT);
    $query    = "UPDATE `user_cred` SET `password`=? WHERE `id`=? LIMIT 1";
    $values   = [$enc_pass, $_SESSION['uId']];

    if (update($query, $values, 'ss')) {
        echo 1;
    } else {
        echo 0;
    }
    exit;
}
?>
