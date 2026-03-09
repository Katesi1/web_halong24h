<nav id="nav-bar" class="navbar navbar-expand-lg navbar-light bg-white px-lg-3 py-lg-2 shadow-sm sticky-top">
  <div class="container-fluid">
    <a class="navbar-brand me-5 fw-bold fs-3 h-font" href="index.php"><?php echo $settings_r['site_title'] ?></a>
    <button class="navbar-toggler shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link me-2" href="index.php"><?php _e('nav_home') ?></a>
        </li>
        <li class="nav-item">
          <a class="nav-link me-2" href="rooms.php"><?php _e('nav_rooms') ?></a>
        </li>
        <li class="nav-item">
          <a class="nav-link me-2" href="services.php"><?php _e('nav_services') ?></a>
        </li>
        <li class="nav-item">
          <a class="nav-link me-2" href="specialties.php"><?php _e('nav_specialties') ?></a>
        </li>
        <li class="nav-item">
          <a class="nav-link me-2" href="blog.php"><?php _e('nav_blog') ?></a>
        </li>
        <li class="nav-item">
          <a class="nav-link me-2" href="contact.php"><?php _e('nav_contact') ?></a>
        </li>
      </ul>
      <div class="d-flex align-items-center">
        <?php require('inc/lang_switcher.php'); ?>
        <span class="nav-separator"></span>
        <?php
          if(isset($_SESSION['login']) && $_SESSION['login']==true)
          {
            $is_default = ($_SESSION['uPic'] == 'avatar-default.png');
            $uname  = htmlspecialchars($_SESSION['uName']);
            $uemail = htmlspecialchars($_SESSION['uEmail'] ?? '');

            $avatar_btn = $is_default
              ? '<span class="nav-avatar-icon"><i class="bi bi-person-fill"></i></span>'
              : '<img src="' . USERS_IMG_PATH . $_SESSION['uPic'] . '" class="nav-avatar-img" alt="">';

            $avatar_dd = $is_default
              ? '<div class="dd-avatar-icon"><i class="bi bi-person-fill"></i></div>'
              : '<img src="' . USERS_IMG_PATH . $_SESSION['uPic'] . '" class="dd-avatar-img" alt="">';

            echo<<<data
              <div class="dropdown user-dropdown">
                <button type="button" class="user-nav-btn dropdown-toggle" data-bs-toggle="dropdown" data-bs-display="static" aria-expanded="false">
                  $avatar_btn
                  <span class="user-nav-name">$uname</span>
                  <i class="bi bi-chevron-down user-nav-chevron"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-lg-end user-dd-menu">
                  <!-- User info -->
                  <div class="dd-user-info">
                    $avatar_dd
                    <div class="dd-user-text">
                      <div class="dd-user-name">$uname</div>
                      <div class="dd-user-role">{$GLOBALS['_LANG']['member']}</div>
                    </div>
                  </div>
                  <div class="dd-divider"></div>
                  <!-- Menu items -->
                  <a class="dd-item" href="profile.php">
                    <span class="dd-item-icon"><i class="bi bi-person-fill"></i></span>
                    <div>
                      <div class="dd-item-label">{$GLOBALS['_LANG']['user_profile']}</div>
                      <div class="dd-item-sub">{$GLOBALS['_LANG']['update_info']}</div>
                    </div>
                  </a>
                  <a class="dd-item" href="bookings.php">
                    <span class="dd-item-icon"><i class="bi bi-calendar-check-fill"></i></span>
                    <div>
                      <div class="dd-item-label">{$GLOBALS['_LANG']['booking_history']}</div>
                      <div class="dd-item-sub">{$GLOBALS['_LANG']['view_manage_booking']}</div>
                    </div>
                  </a>
                  <div class="dd-divider"></div>
                  <a class="dd-item dd-item-danger" href="logout.php">
                    <span class="dd-item-icon danger"><i class="bi bi-box-arrow-right"></i></span>
                    <div class="dd-item-label">{$GLOBALS['_LANG']['logout']}</div>
                  </a>
                </div>
              </div>
            data;
          }
          else
          {
            echo<<<data
              <button type="button" class="btn btn-outline-dark shadow-none me-lg-3 me-2" data-bs-toggle="modal" data-bs-target="#loginModal">
                {$GLOBALS['_LANG']['login']}
              </button>
              <button type="button" class="btn btn-dark shadow-none" data-bs-toggle="modal" data-bs-target="#registerModal">
                {$GLOBALS['_LANG']['register']}
              </button>
            data;
          }
        ?>
      </div>
    </div>
  </div>
</nav>

<!-- ===== MODAL ĐĂNG NHẬP ===== -->
<div class="modal fade" id="loginModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered auth-modal-dialog">
    <div class="modal-content auth-modal-content">
      <form id="login-form">

        <!-- Header -->
        <div class="auth-modal-header">
          <button type="reset" class="auth-close-btn" data-bs-dismiss="modal" aria-label="Close">
            <i class="bi bi-x-lg"></i>
          </button>
          <div class="auth-modal-icon">
            <i class="bi bi-person-fill"></i>
          </div>
          <h4 class="auth-modal-title"><?php _e('welcome_back') ?></h4>
          <p class="auth-modal-subtitle"><?php _e('login_subtitle') ?></p>
        </div>

        <!-- Body -->
        <div class="auth-modal-body">
          <div class="auth-input-group mb-3">
            <span class="auth-input-icon"><i class="bi bi-envelope-fill"></i></span>
            <input type="text" name="email_mob" required class="auth-input" placeholder="<?php _e('email_or_phone') ?>">
          </div>
          <div class="auth-input-group mb-4">
            <span class="auth-input-icon"><i class="bi bi-lock-fill"></i></span>
            <input type="password" name="pass" required class="auth-input" placeholder="<?php _e('password') ?>">
          </div>

          <button type="submit" class="auth-submit-btn">
            <i class="bi bi-box-arrow-in-right me-2"></i> <?php _e('login') ?>
          </button>

          <div class="auth-divider"><span><?php _e('or') ?></span></div>

          <div class="auth-switch-text">
            <?php _e('no_account') ?>
            <a href="#" class="auth-switch-link" data-bs-toggle="modal" data-bs-target="#registerModal" data-bs-dismiss="modal">
              <?php _e('register_now') ?>
            </a>
          </div>
        </div>

      </form>
    </div>
  </div>
</div>

<!-- ===== MODAL ĐĂNG KÝ ===== -->
<div class="modal fade" id="registerModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered auth-modal-dialog">
    <div class="modal-content auth-modal-content">
      <form id="register-form">

        <!-- Header -->
        <div class="auth-modal-header">
          <button type="reset" class="auth-close-btn" data-bs-dismiss="modal" aria-label="Close">
            <i class="bi bi-x-lg"></i>
          </button>
          <div class="auth-modal-icon">
            <i class="bi bi-person-plus-fill"></i>
          </div>
          <h4 class="auth-modal-title"><?php _e('create_account') ?></h4>
          <p class="auth-modal-subtitle"><?php _e('register_subtitle') ?></p>
        </div>

        <!-- Body -->
        <div class="auth-modal-body">
          <div class="row g-3 mb-1">
            <div class="col-12">
              <div class="auth-input-group">
                <span class="auth-input-icon"><i class="bi bi-person-fill"></i></span>
                <input name="name" type="text" class="auth-input" required placeholder="<?php _e('full_name') ?>">
              </div>
            </div>
            <div class="col-12">
              <div class="auth-input-group">
                <span class="auth-input-icon"><i class="bi bi-envelope-fill"></i></span>
                <input name="email" type="email" class="auth-input" required placeholder="<?php _e('email_address') ?>">
              </div>
            </div>
            <div class="col-12">
              <div class="auth-input-group">
                <span class="auth-input-icon"><i class="bi bi-telephone-fill"></i></span>
                <input name="phonenum" type="tel" class="auth-input" required placeholder="<?php _e('phone_number') ?>">
              </div>
            </div>
            <div class="col-12">
              <div class="auth-input-group">
                <span class="auth-input-icon"><i class="bi bi-lock-fill"></i></span>
                <input name="pass" id="reg-pass" type="password" class="auth-input" required minlength="8" placeholder="<?php _e('password') ?>">
                <button type="button" class="auth-eye-btn" onclick="togglePassVis('reg-pass',this)">
                  <i class="bi bi-eye-slash"></i>
                </button>
              </div>
              <!-- Strength bar -->
              <div class="pass-strength-bar mt-2">
                <div class="pass-strength-track">
                  <div id="strength-fill" class="pass-strength-fill"></div>
                </div>
                <span id="strength-label" class="pass-strength-label"></span>
              </div>
              <ul class="pass-rules mt-2" id="pass-rules">
                <li id="rule-len"><i class="bi bi-x-circle-fill"></i> <?php _e('rule_min_8') ?></li>
                <li id="rule-upper"><i class="bi bi-x-circle-fill"></i> <?php _e('rule_uppercase') ?></li>
                <li id="rule-lower"><i class="bi bi-x-circle-fill"></i> <?php _e('rule_lowercase') ?></li>
                <li id="rule-num"><i class="bi bi-x-circle-fill"></i> <?php _e('rule_number') ?></li>
                <li id="rule-special"><i class="bi bi-x-circle-fill"></i> <?php _e('rule_special') ?></li>
              </ul>
            </div>
            <div class="col-12">
              <div class="auth-input-group">
                <span class="auth-input-icon"><i class="bi bi-shield-lock-fill"></i></span>
                <input name="cpass" id="reg-cpass" type="password" class="auth-input" required minlength="8" placeholder="<?php _e('confirm_password') ?>">
                <button type="button" class="auth-eye-btn" onclick="togglePassVis('reg-cpass',this)">
                  <i class="bi bi-eye-slash"></i>
                </button>
              </div>
            </div>
          </div>

          <button type="submit" class="auth-submit-btn mt-3">
            <i class="bi bi-person-check-fill me-2"></i> <?php _e('register') ?>
          </button>

          <div class="auth-divider"><span><?php _e('or') ?></span></div>

          <div class="auth-switch-text">
            <?php _e('has_account') ?>
            <a href="#" class="auth-switch-link" data-bs-toggle="modal" data-bs-target="#loginModal" data-bs-dismiss="modal">
              <?php _e('login_now') ?>
            </a>
          </div>
        </div>

      </form>
    </div>
  </div>
</div>

<!-- ===== MODAL QUÊN MẬT KHẨU ===== -->
<div class="modal fade" id="forgotModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered auth-modal-dialog">
    <div class="modal-content auth-modal-content">
      <form id="forgot-form">

        <!-- Header -->
        <div class="auth-modal-header">
          <div class="auth-modal-icon">
            <i class="bi bi-key-fill"></i>
          </div>
          <h4 class="auth-modal-title"><?php _e('forgot_password') ?></h4>
          <p class="auth-modal-subtitle"><?php _e('forgot_subtitle') ?></p>
        </div>

        <!-- Body -->
        <div class="auth-modal-body">
          <div class="auth-input-group mb-4">
            <span class="auth-input-icon"><i class="bi bi-envelope-fill"></i></span>
            <input type="email" name="email" required class="auth-input" placeholder="<?php _e('your_email') ?>">
          </div>

          <button type="submit" class="auth-submit-btn">
            <i class="bi bi-send-fill me-2"></i> <?php _e('send_link') ?>
          </button>

          <div class="auth-switch-text mt-3">
            <a href="#" class="auth-switch-link" data-bs-toggle="modal" data-bs-target="#loginModal" data-bs-dismiss="modal">
              <i class="bi bi-arrow-left me-1"></i> <?php _e('back_to_login') ?>
            </a>
          </div>
        </div>

      </form>
    </div>
  </div>
</div>

<style>
/* ===== NAV SEPARATOR ===== */
.nav-separator {
  display: inline-block;
  width: 1px;
  height: 24px;
  background: #dde5e0;
  margin-right: 16px;
  flex-shrink: 0;
}

/* ===== AUTH MODAL STYLES ===== */
.auth-modal-dialog {
  max-width: 420px;
}

.auth-modal-content {
  border: none;
  border-radius: 20px;
  overflow: hidden;
  box-shadow: 0 25px 60px rgba(0,0,0,0.18);
}

/* Header gradient */
.auth-modal-header {
  background: linear-gradient(135deg, #2D6A4F 0%, #40916C 60%, #52B788 100%);
  padding: 36px 30px 28px;
  text-align: center;
  position: relative;
}

.auth-close-btn {
  position: absolute;
  top: 16px;
  right: 18px;
  background: rgba(255,255,255,0.2);
  border: none;
  color: #fff;
  width: 32px;
  height: 32px;
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 14px;
  cursor: pointer;
  transition: background 0.2s;
}
.auth-close-btn:hover {
  background: rgba(255,255,255,0.35);
}

.auth-modal-icon {
  width: 64px;
  height: 64px;
  background: rgba(255,255,255,0.2);
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  margin: 0 auto 14px;
  font-size: 28px;
  color: #fff;
}

.auth-modal-title {
  color: #fff;
  font-weight: 700;
  font-size: 1.3rem;
  margin-bottom: 6px;
  font-family: 'Merriweather', serif;
}

.auth-modal-subtitle {
  color: rgba(255,255,255,0.82);
  font-size: 0.85rem;
  margin: 0;
}

/* Body */
.auth-modal-body {
  padding: 28px 30px 30px;
  background: #fff;
}

/* Input group */
.auth-input-group {
  display: flex;
  align-items: center;
  border: 1.5px solid #e0e0e0;
  border-radius: 10px;
  overflow: hidden;
  background: #fafafa;
  transition: border-color 0.2s, box-shadow 0.2s;
}
.auth-input-group:focus-within {
  border-color: #2D6A4F;
  box-shadow: 0 0 0 3px rgba(45,106,79,0.12);
  background: #fff;
}

.auth-input-icon {
  padding: 0 12px;
  color: #9e9e9e;
  font-size: 15px;
  flex-shrink: 0;
  transition: color 0.2s;
}
.auth-input-group:focus-within .auth-input-icon {
  color: #2D6A4F;
}

.auth-input {
  flex: 1;
  border: none;
  outline: none;
  background: transparent;
  padding: 12px 14px 12px 0;
  font-size: 0.9rem;
  color: #333;
}
.auth-input::placeholder {
  color: #bbb;
}

/* Submit button */
.auth-submit-btn {
  width: 100%;
  padding: 13px;
  background: linear-gradient(135deg, #2D6A4F, #40916C);
  border: none;
  border-radius: 10px;
  color: #fff;
  font-size: 0.95rem;
  font-weight: 600;
  cursor: pointer;
  transition: opacity 0.2s, transform 0.15s;
  letter-spacing: 0.3px;
}
.auth-submit-btn:hover {
  opacity: 0.92;
  transform: translateY(-1px);
}
.auth-submit-btn:active {
  transform: translateY(0);
}

/* Divider */
.auth-divider {
  display: flex;
  align-items: center;
  gap: 12px;
  margin: 20px 0 16px;
  color: #ccc;
  font-size: 0.8rem;
}
.auth-divider::before,
.auth-divider::after {
  content: '';
  flex: 1;
  height: 1px;
  background: #eee;
}
.auth-divider span {
  color: #bbb;
  white-space: nowrap;
}

/* Switch link */
.auth-switch-text {
  text-align: center;
  font-size: 0.88rem;
  color: #777;
}
.auth-switch-link {
  color: #2D6A4F;
  font-weight: 600;
  text-decoration: none;
  margin-left: 4px;
}
.auth-switch-link:hover {
  text-decoration: underline;
  color: #1b4332;
}

/* Register modal wider */
#registerModal .auth-modal-dialog {
  max-width: 480px;
}

/* ===== USER DROPDOWN ===== */
.user-nav-btn {
  display: flex; align-items: center; gap: 8px;
  padding: 6px 14px 6px 8px;
  background: #fff; border: 1.5px solid #e8e8e8;
  border-radius: 40px; cursor: pointer;
  transition: border-color 0.2s, box-shadow 0.2s;
  font-size: 0.88rem; font-weight: 500; color: #333;
}
.user-nav-btn:hover {
  border-color: #2D6A4F;
  box-shadow: 0 2px 10px rgba(45,106,79,0.12);
}
.user-nav-btn::after { display: none; } /* remove bootstrap caret */

.nav-avatar-img {
  width: 30px; height: 30px; border-radius: 50%;
  object-fit: cover; flex-shrink: 0;
  border: 2px solid #e8f5ee;
}
.nav-avatar-icon {
  display: inline-flex; align-items: center; justify-content: center;
  width: 30px; height: 30px; border-radius: 50%;
  background: linear-gradient(135deg, #2D6A4F, #52B788);
  color: #fff; font-size: 14px; flex-shrink: 0;
}
.user-nav-name { max-width: 120px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap; }
.user-nav-chevron { font-size: 11px; color: #aaa; transition: transform 0.2s; }
.user-dropdown.show .user-nav-chevron { transform: rotate(180deg); }

/* Dropdown menu */
.user-dd-menu {
  min-width: 260px; padding: 0;
  border: none; border-radius: 16px;
  box-shadow: 0 12px 40px rgba(0,0,0,0.14);
  overflow: hidden; margin-top: 8px !important;
}

/* User info block */
.dd-user-info {
  display: flex; align-items: center; gap: 12px;
  padding: 18px 18px 16px;
  background: linear-gradient(135deg, #2D6A4F 0%, #52B788 100%);
}
.dd-avatar-img {
  width: 44px; height: 44px; border-radius: 50%;
  object-fit: cover; border: 2px solid rgba(255,255,255,0.5);
  flex-shrink: 0;
}
.dd-avatar-icon {
  width: 44px; height: 44px; border-radius: 50%;
  background: rgba(255,255,255,0.2);
  display: flex; align-items: center; justify-content: center;
  color: #fff; font-size: 22px; flex-shrink: 0;
}
.dd-user-name {
  font-weight: 700; font-size: 0.92rem; color: #fff;
  white-space: nowrap; overflow: hidden; text-overflow: ellipsis; max-width: 160px;
}
.dd-user-role {
  font-size: 0.75rem; color: rgba(255,255,255,0.75); margin-top: 2px;
}

.dd-divider { height: 1px; background: #f0f0f0; margin: 4px 0; }

/* Menu items */
.dd-item {
  display: flex; align-items: center; gap: 12px;
  padding: 12px 18px; text-decoration: none; color: #444;
  transition: background 0.15s, color 0.15s;
  font-size: 0.88rem;
}
.dd-item:hover { background: #f4f6f9; color: #2D6A4F; }
.dd-item-icon {
  width: 34px; height: 34px; border-radius: 9px; flex-shrink: 0;
  background: #eef7f2; color: #2D6A4F;
  display: flex; align-items: center; justify-content: center;
  font-size: 15px; transition: background 0.15s;
}
.dd-item:hover .dd-item-icon { background: #d6ede3; }
.dd-item-icon.danger { background: #fdecea; color: #e74c3c; }
.dd-item:hover .dd-item-icon.danger { background: #f9d0ce; }
.dd-item-label { font-weight: 600; font-size: 0.86rem; }
.dd-item-sub { font-size: 0.74rem; color: #aaa; margin-top: 1px; }
.dd-item-danger { color: #e74c3c; }
.dd-item-danger:hover { background: #fff5f5; color: #c0392b; }

/* Eye toggle button */
.auth-eye-btn {
  background: none;
  border: none;
  padding: 0 12px;
  color: #9e9e9e;
  font-size: 15px;
  cursor: pointer;
  flex-shrink: 0;
  line-height: 1;
}
.auth-eye-btn:hover { color: #2D6A4F; }

/* Password strength bar */
.pass-strength-bar {
  display: flex;
  align-items: center;
  gap: 10px;
}
.pass-strength-track {
  flex: 1;
  height: 5px;
  background: #eee;
  border-radius: 10px;
  overflow: hidden;
}
.pass-strength-fill {
  height: 100%;
  width: 0%;
  border-radius: 10px;
  transition: width 0.35s, background 0.35s;
}
.pass-strength-label {
  font-size: 0.75rem;
  font-weight: 600;
  min-width: 60px;
  text-align: right;
}

/* Password rules list */
.pass-rules {
  list-style: none;
  padding: 0;
  margin: 0;
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 3px 10px;
}
.pass-rules li {
  font-size: 0.75rem;
  color: #e74c3c;
  display: flex;
  align-items: center;
  gap: 5px;
  transition: color 0.2s;
}
.pass-rules li.ok {
  color: #2D6A4F;
}
.pass-rules li i {
  font-size: 11px;
}
</style>
