<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <?php require('inc/links.php'); ?>
  <title><?php echo $settings_r['site_title'] ?> - <?php _e('user_profile') ?></title>
  <style>
    /* ===== PROFILE PAGE ===== */
    .profile-page { background: #f4f6f9; min-height: 100vh; }

    /* Breadcrumb */
    .profile-breadcrumb {
      padding: 18px 0 10px;
      font-size: 13px;
      color: #888;
    }
    .profile-breadcrumb a { color: #888; text-decoration: none; }
    .profile-breadcrumb a:hover { color: #2D6A4F; }
    .profile-breadcrumb .sep { margin: 0 8px; }

    /* ===== SIDEBAR CARD ===== */
    .profile-sidebar-card {
      background: #fff;
      border-radius: 18px;
      box-shadow: 0 4px 20px rgba(0,0,0,0.07);
      overflow: hidden;
      margin-bottom: 20px;
    }
    .profile-cover {
      background: linear-gradient(135deg, #2D6A4F 0%, #40916C 60%, #52B788 100%);
      height: 90px;
    }
    .profile-avatar-wrap {
      display: flex;
      flex-direction: column;
      align-items: center;
      padding: 0 20px 24px;
      margin-top: -48px;
    }
    .profile-avatar-container {
      position: relative;
      width: 96px;
      height: 96px;
      cursor: pointer;
    }
    .profile-avatar-img {
      width: 96px;
      height: 96px;
      border-radius: 50%;
      object-fit: cover;
      border: 4px solid #fff;
      box-shadow: 0 4px 14px rgba(0,0,0,0.12);
      display: block;
    }
    /* Icon avatar thay ảnh mặc định */
    .profile-avatar-icon {
      width: 96px; height: 96px;
      border-radius: 50%;
      background: linear-gradient(135deg, #2D6A4F, #52B788);
      display: flex; align-items: center; justify-content: center;
      color: #fff; font-size: 44px;
      border: 4px solid #fff;
      box-shadow: 0 4px 14px rgba(0,0,0,0.12);
    }
    .profile-avatar-overlay {
      position: absolute;
      inset: 0;
      border-radius: 50%;
      background: rgba(0,0,0,0.38);
      display: flex;
      align-items: center;
      justify-content: center;
      opacity: 0;
      transition: opacity 0.2s;
      color: #fff;
      font-size: 22px;
    }
    .profile-avatar-container:hover .profile-avatar-overlay { opacity: 1; }
    #avatar-file-input { display: none; }

    .profile-name {
      font-size: 1.1rem;
      font-weight: 700;
      color: #222;
      margin: 12px 0 3px;
      text-align: center;
    }
    .profile-email {
      font-size: 0.82rem;
      color: #888;
      text-align: center;
      margin-bottom: 4px;
    }
    .profile-member-badge {
      font-size: 0.75rem;
      color: #2D6A4F;
      background: #e8f5ee;
      padding: 3px 12px;
      border-radius: 20px;
      margin-top: 6px;
      display: inline-block;
    }

    /* Sidebar Nav */
    .profile-sidebar-nav {
      border-top: 1px solid #f0f0f0;
      padding: 10px 0;
    }
    .profile-nav-item {
      display: flex;
      align-items: center;
      gap: 12px;
      padding: 12px 22px;
      font-size: 0.9rem;
      color: #555;
      cursor: pointer;
      transition: background 0.15s, color 0.15s;
      border: none;
      background: none;
      width: 100%;
      text-align: left;
      border-left: 3px solid transparent;
    }
    .profile-nav-item:hover { background: #f4f6f9; color: #2D6A4F; }
    .profile-nav-item.active {
      background: #eef7f2;
      color: #2D6A4F;
      font-weight: 600;
      border-left-color: #2D6A4F;
    }
    .profile-nav-item i { font-size: 17px; width: 20px; text-align: center; }

    /* ===== CONTENT CARD ===== */
    .profile-content-card {
      background: #fff;
      border-radius: 18px;
      box-shadow: 0 4px 20px rgba(0,0,0,0.07);
      overflow: hidden;
      margin-bottom: 20px;
    }
    .profile-content-header {
      padding: 22px 28px 18px;
      border-bottom: 1px solid #f0f0f0;
      display: flex;
      align-items: center;
      gap: 12px;
    }
    .profile-content-icon {
      width: 40px;
      height: 40px;
      border-radius: 10px;
      background: linear-gradient(135deg, #2D6A4F, #52B788);
      display: flex;
      align-items: center;
      justify-content: center;
      color: #fff;
      font-size: 17px;
    }
    .profile-content-title {
      font-size: 1rem;
      font-weight: 700;
      color: #222;
      margin: 0;
    }
    .profile-content-subtitle {
      font-size: 0.78rem;
      color: #999;
      margin: 0;
    }
    .profile-content-body { padding: 26px 28px 28px; }

    /* Tab panes */
    .profile-tab { display: none; }
    .profile-tab.active { display: block; }

    /* Profile inputs */
    .pf-input-group {
      position: relative;
      display: flex;
      align-items: center;
      border: 1.5px solid #e8e8e8;
      border-radius: 10px;
      background: #fafafa;
      transition: border-color 0.2s, box-shadow 0.2s;
      overflow: hidden;
    }
    .pf-input-group:focus-within {
      border-color: #2D6A4F;
      box-shadow: 0 0 0 3px rgba(45,106,79,0.1);
      background: #fff;
    }
    .pf-input-icon {
      padding: 0 13px;
      color: #bbb;
      font-size: 15px;
      flex-shrink: 0;
      transition: color 0.2s;
    }
    .pf-input-group:focus-within .pf-input-icon { color: #2D6A4F; }
    .pf-input {
      flex: 1;
      border: none;
      outline: none;
      background: transparent;
      padding: 12px 14px 12px 0;
      font-size: 0.9rem;
      color: #333;
    }
    .pf-eye-btn {
      background: none;
      border: none;
      padding: 0 12px;
      color: #bbb;
      font-size: 14px;
      cursor: pointer;
      flex-shrink: 0;
    }
    .pf-eye-btn:hover { color: #2D6A4F; }

    .pf-label {
      font-size: 0.82rem;
      font-weight: 600;
      color: #555;
      margin-bottom: 6px;
      display: block;
    }

    /* Save button */
    .pf-save-btn {
      background: linear-gradient(135deg, #2D6A4F, #40916C);
      border: none;
      color: #fff;
      padding: 11px 30px;
      border-radius: 10px;
      font-size: 0.9rem;
      font-weight: 600;
      cursor: pointer;
      transition: opacity 0.2s, transform 0.15s;
    }
    .pf-save-btn:hover { opacity: 0.9; transform: translateY(-1px); }
    .pf-save-btn:active { transform: translateY(0); }

    /* Password strength */
    .pf-strength-bar { display: flex; align-items: center; gap: 10px; margin-top: 8px; }
    .pf-strength-track {
      flex: 1; height: 5px; background: #eee;
      border-radius: 10px; overflow: hidden;
    }
    .pf-strength-fill {
      height: 100%; width: 0%;
      border-radius: 10px;
      transition: width 0.35s, background 0.35s;
    }
    .pf-strength-label { font-size: 0.75rem; font-weight: 600; min-width: 60px; text-align: right; }

    .pf-pass-rules {
      list-style: none; padding: 0; margin: 8px 0 0;
      display: grid; grid-template-columns: 1fr 1fr; gap: 3px 10px;
    }
    .pf-pass-rules li {
      font-size: 0.75rem; color: #e74c3c;
      display: flex; align-items: center; gap: 5px;
      transition: color 0.2s;
    }
    .pf-pass-rules li.ok { color: #2D6A4F; }
    .pf-pass-rules li i { font-size: 11px; }

    /* Divider with text */
    .pf-section-divider {
      display: flex; align-items: center; gap: 12px;
      margin: 28px 0 24px; color: #ddd; font-size: 0.8rem;
    }
    .pf-section-divider::before, .pf-section-divider::after {
      content: ''; flex: 1; height: 1px; background: #f0f0f0;
    }
    .pf-section-divider span { color: #bbb; white-space: nowrap; }

    /* Avatar upload progress */
    .pf-upload-hint {
      font-size: 0.75rem; color: #999; text-align: center; margin-top: 8px;
    }

    /* Logout link in sidebar */
    .profile-nav-item.danger { color: #e74c3c; }
    .profile-nav-item.danger:hover { background: #fff5f5; color: #c0392b; }
    .profile-nav-item.danger.active { background: #fff5f5; color: #c0392b; border-left-color: #e74c3c; }
  </style>
</head>
<body class="profile-page">

  <?php
    require('inc/header.php');
    if (!(isset($_SESSION['login']) && $_SESSION['login'] == true)) {
      redirect('index.php');
    }
    $u_exist = select("SELECT * FROM `user_cred` WHERE `id`=? LIMIT 1", [$_SESSION['uId']], 's');
    if (mysqli_num_rows($u_exist) == 0) {
      redirect('index.php');
    }
    $u_fetch = mysqli_fetch_assoc($u_exist);
    $member_since = date('d/m/Y', strtotime($u_fetch['datentime']));
  ?>

  <div class="container py-2 pb-5">

    <!-- Breadcrumb -->
    <div class="profile-breadcrumb">
      <a href="index.php"><?php _e('home') ?></a>
      <span class="sep">›</span>
      <span><?php _e('user_profile') ?></span>
    </div>

    <div class="row g-4">

      <!-- ===== SIDEBAR ===== -->
      <div class="col-lg-3">

        <!-- Avatar Card -->
        <div class="profile-sidebar-card">
          <div class="profile-cover"></div>
          <div class="profile-avatar-wrap">
            <div class="profile-avatar-container" onclick="document.getElementById('avatar-file-input').click()" title="<?php echo __('click_change_photo') ?>">
              <?php if ($u_fetch['profile'] == 'avatar-default.png'): ?>
                <div class="profile-avatar-icon" id="avatar-icon-placeholder">
                  <i class="bi bi-person-fill"></i>
                </div>
                <img src="" class="profile-avatar-img" id="avatar-preview" alt="Avatar" style="display:none;">
              <?php else: ?>
                <div class="profile-avatar-icon" id="avatar-icon-placeholder" style="display:none;">
                  <i class="bi bi-person-fill"></i>
                </div>
                <img src="<?php echo USERS_IMG_PATH . $u_fetch['profile'] ?>" class="profile-avatar-img" id="avatar-preview" alt="Avatar">
              <?php endif; ?>
              <div class="profile-avatar-overlay">
                <i class="bi bi-camera-fill"></i>
              </div>
            </div>
            <input type="file" id="avatar-file-input" accept=".jpg,.jpeg,.png,.webp">
            <div class="profile-name"><?php echo htmlspecialchars($u_fetch['name']) ?></div>
            <div class="profile-email"><?php echo htmlspecialchars($u_fetch['email']) ?></div>
            <span class="profile-member-badge">
              <i class="bi bi-calendar3 me-1"></i> <?php _e('member_since') ?> <?php echo $member_since ?>
            </span>
          </div>

          <!-- Nav -->
          <nav class="profile-sidebar-nav">
            <button class="profile-nav-item active" onclick="switchTab('info', this)">
              <i class="bi bi-person-fill"></i> <?php _e('personal_info') ?>
            </button>
            <button class="profile-nav-item" onclick="switchTab('security', this)">
              <i class="bi bi-shield-lock-fill"></i> <?php _e('security') ?>
            </button>
            <button class="profile-nav-item" onclick="window.location.href='bookings.php'">
              <i class="bi bi-calendar-check-fill"></i> <?php _e('booking_history') ?>
            </button>
            <button class="profile-nav-item danger" onclick="window.location.href='logout.php'">
              <i class="bi bi-box-arrow-right"></i> <?php _e('logout') ?>
            </button>
          </nav>
        </div>

      </div>

      <!-- ===== MAIN CONTENT ===== -->
      <div class="col-lg-9">

        <!-- Tab: Thông tin cá nhân -->
        <div id="tab-info" class="profile-tab active">
          <div class="profile-content-card">
            <div class="profile-content-header">
              <div class="profile-content-icon"><i class="bi bi-person-fill"></i></div>
              <div>
                <div class="profile-content-title"><?php _e('personal_info') ?></div>
                <div class="profile-content-subtitle"><?php _e('update_info_sub') ?></div>
              </div>
            </div>
            <div class="profile-content-body">
              <form id="info-form">
                <div class="row g-4">
                  <div class="col-md-6">
                    <label class="pf-label"><?php _e('full_name') ?></label>
                    <div class="pf-input-group">
                      <span class="pf-input-icon"><i class="bi bi-person-fill"></i></span>
                      <input name="name" type="text" class="pf-input" value="<?php echo htmlspecialchars($u_fetch['name']) ?>" required>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <label class="pf-label"><?php _e('phone_number') ?></label>
                    <div class="pf-input-group">
                      <span class="pf-input-icon"><i class="bi bi-telephone-fill"></i></span>
                      <input name="phonenum" type="tel" class="pf-input" value="<?php echo htmlspecialchars($u_fetch['phonenum']) ?>" required>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <label class="pf-label"><?php _e('date_of_birth') ?></label>
                    <div class="pf-input-group">
                      <span class="pf-input-icon"><i class="bi bi-calendar-fill"></i></span>
                      <input name="dob" type="date" class="pf-input" value="<?php echo $u_fetch['dob'] ?>">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <label class="pf-label"><?php _e('id_card') ?></label>
                    <div class="pf-input-group">
                      <span class="pf-input-icon"><i class="bi bi-card-text"></i></span>
                      <input name="pincode" type="text" class="pf-input" value="<?php echo htmlspecialchars($u_fetch['pincode'] ?: '') ?>" placeholder="<?php echo __('enter_id') ?>">
                    </div>
                  </div>
                  <div class="col-12">
                    <label class="pf-label"><?php _e('address') ?></label>
                    <div class="pf-input-group" style="align-items:flex-start;">
                      <span class="pf-input-icon" style="padding-top:13px;"><i class="bi bi-geo-alt-fill"></i></span>
                      <textarea name="address" class="pf-input" rows="2" style="resize:none; padding-top:12px;" placeholder="<?php echo __('your_address') ?>"><?php echo htmlspecialchars($u_fetch['address'] ?: '') ?></textarea>
                    </div>
                  </div>
                </div>
                <div class="mt-4">
                  <button type="submit" class="pf-save-btn">
                    <i class="bi bi-check-circle-fill me-2"></i><?php _e('save_changes') ?>
                  </button>
                </div>
              </form>
            </div>
          </div>
        </div>

        <!-- Tab: Bảo mật -->
        <div id="tab-security" class="profile-tab">
          <div class="profile-content-card">
            <div class="profile-content-header">
              <div class="profile-content-icon"><i class="bi bi-shield-lock-fill"></i></div>
              <div>
                <div class="profile-content-title"><?php _e('account_security') ?></div>
                <div class="profile-content-subtitle"><?php _e('change_pass_sub') ?></div>
              </div>
            </div>
            <div class="profile-content-body">
              <form id="pass-form">
                <div class="row g-4">
                  <div class="col-12">
                    <label class="pf-label"><?php _e('new_password') ?></label>
                    <div class="pf-input-group">
                      <span class="pf-input-icon"><i class="bi bi-lock-fill"></i></span>
                      <input name="new_pass" id="pf-new-pass" type="password" class="pf-input" required minlength="8" placeholder="<?php echo __('enter_new_pass') ?>">
                      <button type="button" class="pf-eye-btn" onclick="pfTogglePass('pf-new-pass', this)"><i class="bi bi-eye-slash"></i></button>
                    </div>
                    <!-- Strength bar -->
                    <div class="pf-strength-bar">
                      <div class="pf-strength-track">
                        <div id="pf-strength-fill" class="pf-strength-fill"></div>
                      </div>
                      <span id="pf-strength-label" class="pf-strength-label"></span>
                    </div>
                    <ul class="pf-pass-rules" id="pf-pass-rules">
                      <li id="pf-rule-len"><i class="bi bi-x-circle-fill"></i> <?php _e('rule_min_8') ?></li>
                      <li id="pf-rule-upper"><i class="bi bi-x-circle-fill"></i> <?php _e('rule_uppercase') ?></li>
                      <li id="pf-rule-lower"><i class="bi bi-x-circle-fill"></i> <?php _e('rule_lowercase') ?></li>
                      <li id="pf-rule-num"><i class="bi bi-x-circle-fill"></i> <?php _e('rule_number') ?></li>
                      <li id="pf-rule-special"><i class="bi bi-x-circle-fill"></i> <?php _e('rule_special') ?></li>
                    </ul>
                  </div>
                  <div class="col-12">
                    <label class="pf-label"><?php _e('confirm_password') ?></label>
                    <div class="pf-input-group">
                      <span class="pf-input-icon"><i class="bi bi-shield-lock-fill"></i></span>
                      <input name="confirm_pass" id="pf-confirm-pass" type="password" class="pf-input" required minlength="8" placeholder="<?php echo __('confirm_new_pass') ?>">
                      <button type="button" class="pf-eye-btn" onclick="pfTogglePass('pf-confirm-pass', this)"><i class="bi bi-eye-slash"></i></button>
                    </div>
                  </div>
                </div>
                <div class="mt-4">
                  <button type="submit" class="pf-save-btn">
                    <i class="bi bi-check-circle-fill me-2"></i><?php _e('change_password') ?>
                  </button>
                </div>
              </form>
            </div>
          </div>
        </div>

      </div><!-- /col-lg-9 -->
    </div><!-- /row -->
  </div>

  <?php require('inc/footer.php'); ?>

  <script>
    // ===== Tab switcher =====
    function switchTab(tabName, btn) {
      document.querySelectorAll('.profile-tab').forEach(t => t.classList.remove('active'));
      document.querySelectorAll('.profile-nav-item').forEach(b => b.classList.remove('active'));
      document.getElementById('tab-' + tabName).classList.add('active');
      btn.classList.add('active');
    }

    // ===== Avatar: click to upload =====
    const currentAvatarIsDefault = <?php echo ($u_fetch['profile'] == 'avatar-default.png') ? 'true' : 'false'; ?>;
    const currentAvatarSrc = <?php echo ($u_fetch['profile'] != 'avatar-default.png') ? json_encode(USERS_IMG_PATH . $u_fetch['profile']) : 'null'; ?>;

    const avatarInput    = document.getElementById('avatar-file-input');
    const avatarPreview  = document.getElementById('avatar-preview');
    const avatarIcon     = document.getElementById('avatar-icon-placeholder');

    function showAvatarImg(src) {
      avatarPreview.src = src;
      avatarPreview.style.display = 'block';
      avatarIcon.style.display    = 'none';
    }
    function showAvatarIcon() {
      avatarPreview.style.display = 'none';
      avatarIcon.style.display    = 'flex';
    }

    avatarInput.addEventListener('change', function () {
      if (!this.files[0]) return;

      // Preview ngay lập tức
      const reader = new FileReader();
      reader.onload = e => showAvatarImg(e.target.result);
      reader.readAsDataURL(this.files[0]);

      // Upload
      let data = new FormData();
      data.append('profile_form', '');
      data.append('profile', this.files[0]);

      fetch('ajax/profile.php', { method: 'POST', body: data })
        .then(r => r.text())
        .then(res => {
          if (res === 'inv_img') {
            alert('error', '<?php _e("only_jpg_png_webp") ?>');
            if (currentAvatarIsDefault) showAvatarIcon();
            else showAvatarImg(currentAvatarSrc);
          } else if (res === 'upd_failed') {
            alert('error', '<?php _e("upload_failed") ?>');
          } else if (res == 1) {
            alert('success', '<?php _e("avatar_updated") ?>');
            setTimeout(() => window.location.reload(), 900);
          } else {
            alert('error', '<?php _e("error_occurred") ?>');
          }
        });
    });

    // ===== Info form =====
    document.getElementById('info-form').addEventListener('submit', function (e) {
      e.preventDefault();
      let data = new FormData();
      data.append('info_form', '');
      data.append('name', this.elements['name'].value);
      data.append('phonenum', this.elements['phonenum'].value);
      data.append('address', this.elements['address'].value);
      data.append('pincode', this.elements['pincode'].value);
      data.append('dob', this.elements['dob'].value);

      fetch('ajax/profile.php', { method: 'POST', body: data })
        .then(r => r.text())
        .then(res => {
          if (res === 'phone_already') alert('error', '<?php _e("phone_already") ?>');
          else if (res == 0) alert('error', '<?php _e("no_changes") ?>');
          else alert('success', '<?php _e("info_updated") ?>');
        });
    });

    // ===== Password toggle =====
    function pfTogglePass(inputId, btn) {
      const input = document.getElementById(inputId);
      const icon = btn.querySelector('i');
      if (input.type === 'password') {
        input.type = 'text';
        icon.classList.replace('bi-eye-slash', 'bi-eye');
      } else {
        input.type = 'password';
        icon.classList.replace('bi-eye', 'bi-eye-slash');
      }
    }

    // ===== Password strength (profile page) =====
    const PF_PASS_REGEX = {
      len:     { re: /.{8,}/,         id: 'pf-rule-len'     },
      upper:   { re: /[A-Z]/,         id: 'pf-rule-upper'   },
      lower:   { re: /[a-z]/,         id: 'pf-rule-lower'   },
      num:     { re: /[0-9]/,         id: 'pf-rule-num'     },
      special: { re: /[^A-Za-z0-9]/, id: 'pf-rule-special' },
    };
    const PF_STRENGTH_LEVELS = [
      { label: '',           color: '',        pct: 0   },
      { label: '<?php _e("strength_weak") ?>',       color: '#e74c3c', pct: 20  },
      { label: '<?php _e("strength_weak") ?>',       color: '#e74c3c', pct: 40  },
      { label: '<?php _e("strength_medium") ?>',color: '#f39c12', pct: 60  },
      { label: '<?php _e("strength_good") ?>',       color: '#3498db', pct: 80  },
      { label: '<?php _e("strength_strong") ?>',      color: '#2D6A4F', pct: 100 },
    ];

    function pfCheckStrength(val) {
      let score = 0;
      for (const key in PF_PASS_REGEX) {
        const ok = PF_PASS_REGEX[key].re.test(val);
        const li = document.getElementById(PF_PASS_REGEX[key].id);
        if (!li) continue;
        li.classList.toggle('ok', ok);
        li.querySelector('i').className = ok ? 'bi bi-check-circle-fill' : 'bi bi-x-circle-fill';
        if (ok) score++;
      }
      const lvl = PF_STRENGTH_LEVELS[score];
      const fill = document.getElementById('pf-strength-fill');
      const lbl  = document.getElementById('pf-strength-label');
      if (fill)  { fill.style.width = lvl.pct + '%'; fill.style.background = lvl.color; }
      if (lbl)   { lbl.textContent = lvl.label; lbl.style.color = lvl.color; }
      return score === 5;
    }

    document.getElementById('pf-new-pass').addEventListener('input', function () {
      pfCheckStrength(this.value);
    });

    // ===== Password form =====
    document.getElementById('pass-form').addEventListener('submit', function (e) {
      e.preventDefault();
      const newPass     = this.elements['new_pass'].value;
      const confirmPass = this.elements['confirm_pass'].value;

      if (!pfCheckStrength(newPass)) {
        alert('error', '<?php _e("pass_weak_msg") ?>');
        return;
      }
      if (newPass !== confirmPass) {
        alert('error', '<?php _e("pass_mismatch") ?>');
        return;
      }

      let data = new FormData();
      data.append('pass_form', '');
      data.append('new_pass', newPass);
      data.append('confirm_pass', confirmPass);

      fetch('ajax/profile.php', { method: 'POST', body: data })
        .then(r => r.text())
        .then(res => {
          if (res === 'mismatch') alert('error', '<?php _e("pass_mismatch") ?>');
          else if (res === 'pass_weak') alert('error', '<?php _e("pass_not_strong") ?>');
          else if (res == 0) alert('error', '<?php _e("update_failed") ?>');
          else { alert('success', '<?php _e("pass_changed") ?>'); this.reset(); pfCheckStrength(''); }
        });
    });
  </script>

</body>
</html>
