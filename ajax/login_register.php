<?php
require('../admin/inc/db_config.php');
require('../admin/inc/essentials.php');

if (isset($_POST['register'])) {
    $data = filteration($_POST);

    // Kiểm tra mật khẩu khớp
    if ($data['pass'] != $data['cpass']) {
        echo 'pass_mismatch';
        exit;
    }

    // Kiểm tra độ mạnh mật khẩu: >=8 ký tự, có hoa, thường, số, đặc biệt
    $pass = $data['pass'];
    if (strlen($pass) < 8 || !preg_match('/[A-Z]/', $pass) || !preg_match('/[a-z]/', $pass)
        || !preg_match('/[0-9]/', $pass) || !preg_match('/[^A-Za-z0-9]/', $pass)) {
        echo 'pass_weak';
        exit;
    }

    // Kiểm tra email/SĐT đã tồn tại
    $u_exist = select(
        "SELECT * FROM `user_cred` WHERE `email` = ? OR `phonenum` = ? LIMIT 1",
        [$data['email'], $data['phonenum']],
        "ss"
    );
    if (mysqli_num_rows($u_exist) != 0) {
        $u_exist_fetch = mysqli_fetch_assoc($u_exist);
        echo ($u_exist_fetch['email'] == $data['email']) ? 'email_already' : 'phone_already';
        exit;
    }

    // Hash mật khẩu
    $hashed_pass = password_hash($data['pass'], PASSWORD_BCRYPT);

    // Insert - dùng avatar-default.png cho profile mặc định
    $query = "INSERT INTO `user_cred` (`name`, `email`, `phonenum`, `password`, `profile`) VALUES (?, ?, ?, ?, ?)";
    $values = [$data['name'], $data['email'], $data['phonenum'], $hashed_pass, 'avatar-default.png'];
    if (insert($query, $values, 'sssss')) {
        echo 'registration_success';
    } else {
        echo 'registration_failed';
    }
    exit;
}

if (isset($_POST['login'])) {
    $data = filteration($_POST);

    $query = "SELECT * FROM `user_cred` WHERE (`email` = ? OR `phonenum` = ?) AND `status` = 1 LIMIT 1";
    $values = [$data['email_mob'], $data['email_mob']];
    $res = select($query, $values, "ss");

    if (mysqli_num_rows($res) == 1) {
        $row = mysqli_fetch_assoc($res);

        // Hỗ trợ cả mật khẩu đã hash (bcrypt) và plain text cũ
        $pass_ok = false;
        if (password_verify($data['pass'], $row['password'])) {
            $pass_ok = true;
        } elseif ($data['pass'] === $row['password']) {
            // Tài khoản cũ dùng plain text - tự động nâng cấp hash
            $hashed = password_hash($data['pass'], PASSWORD_BCRYPT);
            update("UPDATE `user_cred` SET `password`=? WHERE `id`=? LIMIT 1", [$hashed, $row['id']], "ss");
            $pass_ok = true;
        }

        if ($pass_ok) {
            session_start();
            $_SESSION['login'] = true;
            $_SESSION['uId']   = $row['id'];
            $_SESSION['uName'] = $row['name'];
            $_SESSION['uPic']  = $row['profile'];
            echo 'login_success';
        } else {
            echo 'invalid_password';
        }
    } else {
        echo 'invalid_email_mob';
    }
    exit;
}
?>
