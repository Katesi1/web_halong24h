<?php
  require('inc/essentials.php');
  require('inc/db_config.php');

  session_start();
  if((isset($_SESSION['adminLogin']) && $_SESSION['adminLogin']==true)){
    redirect('admin/dashboard.php');
  }
?>
<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Login — HaLong24h</title>
  <?php require('inc/links.php'); ?>
  <style>
    body {
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      overflow: hidden;
    }
    body::after {
      content: '';
      position: fixed;
      inset: 0;
      background:
        radial-gradient(ellipse 70% 60% at 20% 20%, rgba(0,245,255,.06) 0%, transparent 65%),
        radial-gradient(ellipse 50% 50% at 85% 80%, rgba(124,58,237,.06) 0%, transparent 65%);
      pointer-events: none;
      z-index: 0;
    }

    .orb {
      position: fixed;
      border-radius: 50%;
      filter: blur(90px);
      pointer-events: none;
      z-index: 0;
    }
    .orb-1 {
      width: 450px; height: 450px;
      top: -120px; left: -120px;
      background: rgba(0,245,255,.05);
      animation: drift 15s ease-in-out infinite alternate;
    }
    .orb-2 {
      width: 380px; height: 380px;
      bottom: -100px; right: -100px;
      background: rgba(124,58,237,.06);
      animation: drift 12s ease-in-out infinite alternate-reverse;
    }
    @keyframes drift {
      from { transform: translate(0,0) scale(1); }
      to   { transform: translate(25px,20px) scale(1.06); }
    }

    .login-panel {
      position: relative;
      z-index: 1;
      width: 420px;
      max-width: calc(100vw - 32px);
    }

    .login-card {
      background: rgba(7,8,28,.82);
      backdrop-filter: blur(24px);
      -webkit-backdrop-filter: blur(24px);
      border: 1px solid rgba(0,245,255,.16);
      border-radius: 20px;
      overflow: hidden;
      box-shadow:
        0 0 0 1px rgba(0,245,255,.05),
        0 28px 72px rgba(0,0,0,.75),
        0 0 48px rgba(0,245,255,.06);
    }

    /* Animated top bar */
    .login-card-bar {
      height: 2px;
      background: linear-gradient(90deg, transparent, #00f5ff 35%, #7c3aed 65%, transparent);
      background-size: 200% 100%;
      animation: slide-bar 3s linear infinite;
    }
    @keyframes slide-bar {
      0%   { background-position: 200% 0; }
      100% { background-position: -200% 0; }
    }

    .login-header {
      padding: 32px 36px 22px;
      text-align: center;
      border-bottom: 1px solid rgba(0,245,255,.07);
    }

    .login-logo {
      display: inline-flex;
      align-items: center;
      justify-content: center;
      width: 58px; height: 58px;
      border-radius: 14px;
      background: rgba(0,245,255,.07);
      border: 1px solid rgba(0,245,255,.22);
      margin-bottom: 16px;
      box-shadow: 0 0 24px rgba(0,245,255,.12);
    }
    .login-logo i {
      font-size: 28px;
      color: #00f5ff;
      filter: drop-shadow(0 0 8px #00f5ff);
    }

    .login-title {
      font-family: 'JetBrains Mono', monospace;
      font-size: 1.35rem;
      font-weight: 700;
      color: #e2e8f0;
      margin: 0 0 6px;
      letter-spacing: .6px;
    }
    .login-subtitle {
      font-size: 11px;
      color: #3a5070;
      letter-spacing: 2px;
      text-transform: uppercase;
      font-family: 'JetBrains Mono', monospace;
    }

    .login-body { padding: 28px 36px 30px; }

    .login-field { margin-bottom: 20px; }
    .login-label {
      display: block;
      font-size: 11px;
      font-weight: 600;
      color: #3a5a7a;
      letter-spacing: 1.3px;
      text-transform: uppercase;
      margin-bottom: 8px;
      font-family: 'JetBrains Mono', monospace;
    }

    .login-input-wrap { position: relative; }

    .login-input-wrap .fi {
      position: absolute;
      left: 14px;
      top: 50%;
      transform: translateY(-50%);
      color: #3a5070;
      font-size: 16px;
      pointer-events: none;
      transition: color .2s;
    }

    .login-input {
      width: 100%;
      background: rgba(0,245,255,.025);
      border: 1px solid rgba(0,245,255,.13);
      border-radius: 10px;
      padding: 12px 14px 12px 44px;
      font-size: 14px;
      color: #e2e8f0;
      font-family: 'Inter', sans-serif;
      transition: all .22s;
      outline: none;
    }
    .login-input::placeholder { color: #243550; }
    .login-input:focus {
      background: rgba(0,245,255,.045);
      border-color: rgba(0,245,255,.48);
      box-shadow: 0 0 0 3px rgba(0,245,255,.10), 0 0 18px rgba(0,245,255,.07);
    }
    .login-input-wrap:focus-within .fi { color: #00f5ff; }

    .login-btn {
      width: 100%;
      padding: 13px;
      border-radius: 10px;
      border: 1px solid rgba(0,245,255,.38);
      background: linear-gradient(135deg, rgba(0,245,255,.10), rgba(0,245,255,.03));
      color: #00f5ff;
      font-size: 13px;
      font-weight: 700;
      font-family: 'JetBrains Mono', monospace;
      letter-spacing: 2px;
      text-transform: uppercase;
      cursor: pointer;
      transition: all .25s;
      position: relative;
      overflow: hidden;
      margin-top: 6px;
    }
    .login-btn::after {
      content: '';
      position: absolute;
      inset: 0;
      background: linear-gradient(135deg, rgba(0,245,255,.20), rgba(0,245,255,.05));
      opacity: 0;
      transition: opacity .25s;
    }
    .login-btn:hover::after { opacity: 1; }
    .login-btn:hover {
      box-shadow: 0 0 28px rgba(0,245,255,.32), 0 0 70px rgba(0,245,255,.08);
      border-color: #00f5ff;
      color: #fff;
      transform: translateY(-2px);
    }
    .login-btn:active { transform: translateY(0); }

    .login-error {
      background: rgba(239,68,68,.08);
      border: 1px solid rgba(239,68,68,.22);
      border-radius: 10px;
      padding: 11px 14px;
      font-size: 13px;
      color: #f87171;
      margin-bottom: 18px;
      display: flex;
      align-items: center;
      gap: 8px;
    }

    .login-footer {
      text-align: center;
      padding: 0 36px 22px;
    }
    .login-footer p {
      font-size: 11px;
      color: #1e2d42;
      font-family: 'JetBrains Mono', monospace;
      letter-spacing: .4px;
    }
  </style>
</head>
<body>
  <div class="orb orb-1"></div>
  <div class="orb orb-2"></div>

  <div class="login-panel">
    <div class="login-card">
      <div class="login-card-bar"></div>

      <div class="login-header">
        <div class="login-logo">
          <i class="bi bi-shield-lock"></i>
        </div>
        <h1 class="login-title">HaLong24h</h1>
        <p class="login-subtitle">Admin Control Panel</p>
      </div>

      <div class="login-body">
        <?php if(isset($_POST['login'])): ?>
          <div class="login-error">
            <i class="bi bi-exclamation-triangle-fill"></i>
            Tên đăng nhập hoặc mật khẩu không đúng.
          </div>
        <?php endif; ?>

        <form method="POST" autocomplete="off">
          <div class="login-field">
            <label class="login-label">Tên đăng nhập</label>
            <div class="login-input-wrap">
              <input type="text" name="admin_name" class="login-input" placeholder="Nhập tên đăng nhập" required>
              <i class="bi bi-person fi"></i>
            </div>
          </div>

          <div class="login-field">
            <label class="login-label">Mật khẩu</label>
            <div class="login-input-wrap">
              <input type="password" name="admin_pass" class="login-input" placeholder="••••••••" required>
              <i class="bi bi-lock fi"></i>
            </div>
          </div>

          <button type="submit" name="login" class="login-btn">
            <i class="bi bi-box-arrow-in-right me-2"></i>Đăng nhập
          </button>
        </form>
      </div>

      <div class="login-footer">
        <p>&copy; <?php echo date('Y'); ?> HaLong24h &nbsp;·&nbsp; Secure Admin Access</p>
      </div>
    </div>
  </div>

  <?php
    if(isset($_POST['login'])){
      $frm_data = filteration($_POST);
      $query    = "SELECT * FROM `admin_cred` WHERE `admin_name`=? AND `admin_pass`=?";
      $res      = select($query, [$frm_data['admin_name'], $frm_data['admin_pass']], "ss");
      if($res->num_rows == 1){
        $row = mysqli_fetch_assoc($res);
        $_SESSION['adminLogin'] = true;
        $_SESSION['adminId']    = $row['sr_no'];
        redirect('dashboard.php');
      }
    }
  ?>

  <?php require('inc/scripts.php') ?>
</body>
</html>
