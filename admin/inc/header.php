<!-- ══ Anti-flash: set data-attr on <html> BEFORE first paint, CSS handles the rest ══ -->
<script>
(function(){
  var c = localStorage.getItem('sidebarCollapsed') === 'true';
  // Set data attribute on <html> so CSS can pre-apply collapsed state without !important
  document.documentElement.setAttribute('data-sidebar', c ? 'collapsed' : 'expanded');
  window._sidebarInitCollapsed = c;
})();
</script>

<!-- Mobile Overlay -->
<div class="sidebar-overlay d-lg-none" id="sidebarOverlay"></div>

<!-- ════════════════════════════════════════════
     SIDEBAR
════════════════════════════════════════════ -->
<div id="dashboard-menu">

  <!-- Sidebar Logo -->
  <div class="admin-topbar-sidebar" id="sidebarLogo">
    <h5>HaLong24h</h5>
  </div>

  <!-- Mobile close header -->
  <div class="d-flex align-items-center justify-content-between d-lg-none px-3 py-2" style="border-bottom:1px solid rgba(0,245,255,.07);">
    <span style="font-size:10px;color:#2a4060;font-family:'JetBrains Mono',monospace;letter-spacing:1.5px;text-transform:uppercase;">MENU</span>
    <button class="btn p-1" id="closeSidebarMobile" style="color:#3a5070;font-size:18px;line-height:1;" aria-label="<?php echo __('close') ?>">
      <i class="bi bi-x-lg"></i>
    </button>
  </div>

  <!-- Navigation -->
  <nav class="sidebar-nav" aria-label="Admin Navigation" style="padding-bottom:80px;">
    <ul class="nav flex-column" style="list-style:none;padding:0;margin:0;">

      <li><div class="sidebar-section-label"><?php _e('admin_overview') ?></div></li>

      <li class="nav-item">
        <a class="nav-link" href="dashboard.php" data-title="<?php echo __('admin_dashboard') ?>">
          <i class="bi bi-speedometer2"></i>
          <span><?php _e('admin_dashboard') ?></span>
        </a>
      </li>

      <li><div class="sidebar-section-label"><?php _e('admin_bookings') ?></div></li>

      <li class="nav-item">
        <button class="collapse-toggle" type="button" data-bs-toggle="collapse" data-bs-target="#bookingLinks" aria-expanded="true" aria-controls="bookingLinks">
          <span style="display:flex;align-items:center;gap:11px;">
            <i class="bi bi-calendar-check" style="font-size:17px;width:20px;text-align:center;"></i>
            <span><?php _e('admin_booking_menu') ?></span>
          </span>
          <i class="bi bi-chevron-down" style="font-size:11px;opacity:.5;transition:transform .2s;"></i>
        </button>
        <div class="collapse show submenu" id="bookingLinks">
          <ul class="nav flex-column" style="list-style:none;padding:0;margin:0;">
            <li class="nav-item">
              <a class="nav-link" href="new_bookings.php" data-title="<?php echo __('admin_new_bookings') ?>">
                <i class="bi bi-calendar-plus"></i>
                <span><?php _e('admin_new_bookings') ?></span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="refund_bookings.php" data-title="<?php echo __('admin_refund') ?>">
                <i class="bi bi-arrow-counterclockwise"></i>
                <span><?php _e('admin_refund') ?></span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="booking_records.php" data-title="<?php echo __('admin_statistics') ?>">
                <i class="bi bi-clipboard-data"></i>
                <span><?php _e('admin_statistics') ?></span>
              </a>
            </li>
          </ul>
        </div>
      </li>

      <li><div class="sidebar-section-label"><?php _e('admin_management') ?></div></li>

      <li class="nav-item">
        <a class="nav-link" href="rooms.php" data-title="<?php echo __('admin_rooms') ?>">
          <i class="bi bi-door-open"></i>
          <span><?php _e('admin_rooms') ?></span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="room_calendar.php" data-title="<?php echo __('admin_room_calendar') ?>">
          <i class="bi bi-calendar3"></i>
          <span><?php _e('admin_room_calendar') ?></span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="users.php" data-title="<?php echo __('admin_users') ?>">
          <i class="bi bi-people"></i>
          <span><?php _e('admin_users') ?></span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="features_facilities.php" data-title="<?php echo __('admin_facilities') ?>">
          <i class="bi bi-grid-3x3-gap"></i>
          <span><?php _e('admin_facilities') ?></span>
        </a>
      </li>

      <li><div class="sidebar-section-label"><?php _e('admin_content') ?></div></li>

      <li class="nav-item">
        <a class="nav-link" href="carousel.php" data-title="<?php echo __('admin_carousel') ?>">
          <i class="bi bi-images"></i>
          <span><?php _e('admin_carousel') ?></span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="user_queries.php" data-title="<?php echo __('admin_messages') ?>">
          <i class="bi bi-chat-dots"></i>
          <span><?php _e('admin_messages') ?></span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="rate_review.php" data-title="<?php echo __('admin_reviews') ?>">
          <i class="bi bi-star"></i>
          <span><?php _e('admin_reviews') ?></span>
        </a>
      </li>

      <li><div class="sidebar-section-label"><?php _e('admin_system') ?></div></li>

      <li class="nav-item">
        <a class="nav-link" href="settings.php" data-title="<?php echo __('admin_settings') ?>">
          <i class="bi bi-gear"></i>
          <span><?php _e('admin_settings') ?></span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="guide.php" data-title="<?php echo __('admin_guide') ?>">
          <i class="bi bi-book"></i>
          <span><?php _e('admin_guide') ?></span>
        </a>
      </li>

    </ul>
  </nav>



</div><!-- /#dashboard-menu -->


<!-- ════════════════════════════════════════════
     TOPBAR
════════════════════════════════════════════ -->
<header class="admin-topbar" id="mainTopbar" role="banner">

  <!-- Left: breadcrumb -->
  <div class="d-flex align-items-center gap-3">
    <!-- Page breadcrumb -->
    <nav aria-label="breadcrumb">
      <span id="topbarBreadcrumb" class="topbar-title">HaLong24h Admin</span>
    </nav>
  </div>

  <!-- Right: clock + lang + logout -->
  <div class="d-flex align-items-center gap-3">
    <div id="topbarClock" class="topbar-clock d-none d-md-block" aria-label="<?php echo __('admin_current_time') ?>"></div>

    <?php
      $admin_current = current_lang();
      $admin_page = basename($_SERVER['PHP_SELF']);
      $admin_qs = $_SERVER['QUERY_STRING'] ?? '';
      $admin_qs = preg_replace('/(&?lang=[a-z]{2})/', '', $admin_qs);
      $admin_qs = ltrim($admin_qs, '&');
      $admin_sep = $admin_qs ? '&' : '';
      $admin_langs = [
        'vi' => ['label' => 'VI', 'flag' => "\xF0\x9F\x87\xBB\xF0\x9F\x87\xB3"],
        'en' => ['label' => 'EN', 'flag' => "\xF0\x9F\x87\xAC\xF0\x9F\x87\xA7"],
      ];
    ?>
    <div class="dropdown admin-lang-switcher">
      <button class="admin-lang-btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
        <span class="admin-lang-flag"><?php echo $admin_langs[$admin_current]['flag'] ?></span>
        <span class="admin-lang-code"><?php echo $admin_langs[$admin_current]['label'] ?></span>
      </button>
      <ul class="dropdown-menu dropdown-menu-end admin-lang-menu">
        <?php foreach ($admin_langs as $code => $info): ?>
        <li>
          <a class="dropdown-item admin-lang-item <?php echo $code === $admin_current ? 'active' : '' ?>"
             href="<?php echo $admin_page . '?' . $admin_qs . $admin_sep . 'lang=' . $code ?>">
            <span class="admin-lang-item-flag"><?php echo $info['flag'] ?></span>
            <span><?php echo $info['label'] ?></span>
            <?php if ($code === $admin_current): ?>
              <i class="bi bi-check2 ms-auto"></i>
            <?php endif; ?>
          </a>
        </li>
        <?php endforeach; ?>
      </ul>
    </div>

    <a href="logout.php" class="btn-logout" title="<?php echo __('logout') ?>">
      <i class="bi bi-box-arrow-right me-1"></i>
      <span><?php _e('logout') ?></span>
    </a>
  </div>

</header>

<style>
  /* ── Topbar breadcrumb title ── */
  .topbar-title {
    font-family: 'JetBrains Mono', monospace;
    font-size: .88rem;
    font-weight: 700;
    color: #a5b4fc;
    letter-spacing: .4px;
    text-shadow: 0 0 8px rgba(165,180,252,.35);
  }

  /* ── Clock ── */
  .topbar-clock {
    font-family: 'JetBrains Mono', monospace;
    font-size: 12px;
    color: #94a3b8;
    letter-spacing: 1px;
    padding: 4px 10px;
    border: 1px solid rgba(148,163,184,.15);
    border-radius: 6px;
    background: rgba(148,163,184,.05);
  }

  /* ── Section labels ── */
  .sidebar-section-label {
    font-size: 10px;
    font-weight: 700;
    color: #475569;
    letter-spacing: 2px;
    text-transform: uppercase;
    font-family: 'JetBrains Mono', monospace;
    padding: 14px 20px 5px;
    pointer-events: none;
    user-select: none;
  }

  /* ── Bottom logout ── */
  .sidebar-bottom-logout {
    position: absolute;
    bottom: 0; left: 0; right: 0;
    padding: 10px 14px;
    border-top: 1px solid rgba(148,163,184,.10);
    background: rgba(15,23,42,.40);
  }
  .sidebar-logout-btn {
    display: flex;
    align-items: center;
    gap: 10px;
    color: #64748b;
    text-decoration: none;
    font-size: 13px;
    font-weight: 500;
    padding: 9px 12px;
    border-radius: 8px;
    border: 1px solid transparent;
    transition: color .2s, border-color .2s, background .2s;
  }
  .sidebar-logout-btn i { font-size: 16px; }
  .sidebar-logout-btn:hover {
    color: #f87171;
    border-color: rgba(248,113,113,.20);
    background: rgba(248,113,113,.06);
  }

  /* ── Collapsed states ── */
  #dashboard-menu.collapsed .sidebar-section-label { display: none; }
  #dashboard-menu.collapsed .sidebar-bottom-logout span { display: none; }
  #dashboard-menu.collapsed .sidebar-logout-btn { justify-content: center; padding: 9px; }
  #dashboard-menu.collapsed .sidebar-logo-text { display: none; }

  /* ── Admin Language Switcher ── */
  .admin-lang-btn {
    display: flex;
    align-items: center;
    gap: 6px;
    padding: 5px 12px;
    background: rgba(148,163,184,.08);
    border: 1px solid var(--border-color);
    border-radius: 8px;
    color: var(--text-secondary);
    font-size: .82rem;
    font-weight: 600;
    font-family: 'JetBrains Mono', monospace;
    cursor: pointer;
    transition: all .2s;
    line-height: 1;
  }
  .admin-lang-btn:hover {
    background: rgba(165,180,252,.10);
    border-color: rgba(165,180,252,.25);
    color: var(--cyan);
  }
  .admin-lang-btn::after { display: none; }
  .admin-lang-flag { font-size: 15px; line-height: 1; }
  .admin-lang-code { letter-spacing: .5px; }

  .admin-lang-menu {
    min-width: 140px;
    background: var(--bg-panel);
    border: 1px solid var(--border-color);
    border-radius: 10px;
    padding: 4px;
    box-shadow: 0 8px 24px rgba(0,0,0,.35);
    margin-top: 6px !important;
  }
  .admin-lang-item {
    display: flex;
    align-items: center;
    gap: 8px;
    padding: 8px 12px;
    border-radius: 7px;
    color: var(--text-secondary);
    font-size: .84rem;
    font-weight: 500;
    transition: all .15s;
  }
  .admin-lang-item:hover:not(.active) {
    background: rgba(165,180,252,.08);
    color: var(--text-primary);
  }
  .admin-lang-item.active {
    background: rgba(165,180,252,.14);
    color: var(--cyan);
  }
  .admin-lang-item-flag { font-size: 18px; line-height: 1; }

  /* ── Disable all transitions during init to prevent flash ── */
  .no-anim, .no-anim * {
    transition: none !important;
    animation: none !important;
  }

  /* ── Fix old admin page layout (col-lg-10 ms-auto pattern) ── */
  #main-content > .container-fluid {
    width: 100% !important;
    max-width: 100% !important;
    padding-left: 0 !important;
    padding-right: 0 !important;
    margin-left: 0 !important;
    margin-right: 0 !important;
  }
  #main-content > .container-fluid > .row { 
    margin: 0 !important; 
    width: 100% !important;
    --bs-gutter-x: 0 !important;
  }
  #main-content > .container-fluid > .row > [class*="col-"] {
    max-width: 100% !important;
    width: 100% !important;
    flex: 0 0 100% !important;
    margin-left: 0 !important;
    margin-right: 0 !important;
    padding-left: 16px !important;
    padding-right: 16px !important;
  }
  /* Override Bootstrap ms-auto utility */
  #main-content .ms-auto {
    margin-left: 0 !important;
  }
  /* Override Bootstrap col-lg-10 */
  #main-content .col-lg-10 {
    max-width: 100% !important;
    flex: 0 0 100% !important;
    width: 100% !important;
  }
</style>

<script>
  // Live clock
  (function(){
    var el = document.getElementById('topbarClock');
    if(!el) return;
    function tick(){
      var d = new Date(), p = function(n){ return ('0'+n).slice(-2); };
      el.textContent = p(d.getHours())+':'+p(d.getMinutes())+':'+p(d.getSeconds());
    }
    tick(); setInterval(tick, 1000);
  })();
</script>
