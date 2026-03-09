<?php
  require('inc/essentials.php');
  adminLogin();
  if (!function_exists('__')) {
    require(__DIR__ . '/../inc/lang.php');
  }
?>
<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="robots" content="noindex, nofollow">
  <title><?php echo __('admin_guide') ?> - HaLong24h</title>
  <?php require('inc/links.php'); ?>
</head>
<body>

  <?php require('inc/header.php'); ?>

  <div class="container-fluid" id="main-content">
    <div class="row">
      <div class="col-lg-10 ms-auto p-4 overflow-hidden">

        <div class="d-flex align-items-center justify-content-between mb-4">
          <h3 class="mb-0"><i class="bi bi-book me-2"></i><?php echo __('admin_guide') ?></h3>
        </div>

        <!-- Quick Navigation -->
        <div class="card border-0 shadow-sm mb-4" style="background: var(--bg-panel, #1e293b); border: 1px solid var(--border-color, rgba(148,163,184,.1)) !important;">
          <div class="card-body">
            <h5 class="fw-bold mb-3"><i class="bi bi-compass me-2"></i><?php echo __('guide_quick_nav') ?></h5>
            <div class="row g-2">
              <?php
                $nav_items = [
                  ['icon' => 'bi-speedometer2',      'key' => 'guide_nav_dashboard',    'href' => '#section-dashboard'],
                  ['icon' => 'bi-door-open',          'key' => 'guide_nav_rooms',        'href' => '#section-rooms'],
                  ['icon' => 'bi-calendar-check',     'key' => 'guide_nav_bookings',     'href' => '#section-bookings'],
                  ['icon' => 'bi-people',             'key' => 'guide_nav_users',        'href' => '#section-users'],
                  ['icon' => 'bi-star',               'key' => 'guide_nav_reviews',      'href' => '#section-reviews'],
                  ['icon' => 'bi-chat-dots',          'key' => 'guide_nav_messages',     'href' => '#section-messages'],
                  ['icon' => 'bi-images',             'key' => 'guide_nav_carousel',     'href' => '#section-carousel'],
                  ['icon' => 'bi-grid-3x3-gap',       'key' => 'guide_nav_facilities',   'href' => '#section-facilities'],
                  ['icon' => 'bi-gear',               'key' => 'guide_nav_settings',     'href' => '#section-settings'],
                ];
                foreach ($nav_items as $item):
              ?>
              <div class="col-6 col-md-4 col-lg-3">
                <a href="<?php echo $item['href'] ?>" class="guide-nav-card">
                  <i class="bi <?php echo $item['icon'] ?>"></i>
                  <span><?php echo __($item['key']) ?></span>
                </a>
              </div>
              <?php endforeach; ?>
            </div>
          </div>
        </div>

        <!-- Section: Login -->
        <div class="guide-section" id="section-login">
          <div class="guide-section-header">
            <i class="bi bi-box-arrow-in-right"></i>
            <h4><?php echo __('guide_login_title') ?></h4>
          </div>
          <div class="guide-section-body">
            <div class="guide-flow">
              <div class="guide-step">
                <span class="guide-step-num">1</span>
                <span><?php echo __('guide_login_step1') ?></span>
              </div>
              <div class="guide-step">
                <span class="guide-step-num">2</span>
                <span><?php echo __('guide_login_step2') ?></span>
              </div>
              <div class="guide-step">
                <span class="guide-step-num">3</span>
                <span><?php echo __('guide_login_step3') ?></span>
              </div>
            </div>
            <div class="guide-note">
              <i class="bi bi-info-circle"></i>
              <?php echo __('guide_login_note') ?>
            </div>
          </div>
        </div>

        <!-- Section: Dashboard -->
        <div class="guide-section" id="section-dashboard">
          <div class="guide-section-header">
            <i class="bi bi-speedometer2"></i>
            <h4><?php echo __('guide_dashboard_title') ?></h4>
          </div>
          <div class="guide-section-body">
            <p><?php echo __('guide_dashboard_desc') ?></p>
            <div class="guide-feature-grid">
              <?php
                $dashboard_cards = [
                  ['icon' => 'bi-door-open',              'key' => 'guide_dash_rooms'],
                  ['icon' => 'bi-calendar-check',         'key' => 'guide_dash_bookings'],
                  ['icon' => 'bi-cash-stack',             'key' => 'guide_dash_revenue'],
                  ['icon' => 'bi-calendar-plus',          'key' => 'guide_dash_new_bookings'],
                  ['icon' => 'bi-arrow-counterclockwise', 'key' => 'guide_dash_refunds'],
                  ['icon' => 'bi-envelope',               'key' => 'guide_dash_messages'],
                  ['icon' => 'bi-star',                   'key' => 'guide_dash_reviews'],
                  ['icon' => 'bi-people',                 'key' => 'guide_dash_users'],
                ];
                foreach ($dashboard_cards as $c):
              ?>
              <div class="guide-feature-item">
                <i class="bi <?php echo $c['icon'] ?>"></i>
                <span><?php echo __($c['key']) ?></span>
              </div>
              <?php endforeach; ?>
            </div>
            <div class="guide-tip mt-3">
              <i class="bi bi-lightbulb"></i>
              <?php echo __('guide_dashboard_tip') ?>
            </div>
          </div>
        </div>

        <!-- Section: Rooms -->
        <div class="guide-section" id="section-rooms">
          <div class="guide-section-header">
            <i class="bi bi-door-open"></i>
            <h4><?php echo __('guide_rooms_title') ?></h4>
          </div>
          <div class="guide-section-body">
            <p><?php echo __('guide_rooms_desc') ?></p>

            <h6 class="guide-sub-title"><i class="bi bi-plus-circle me-1"></i><?php echo __('guide_rooms_add_title') ?></h6>
            <div class="guide-flow">
              <div class="guide-step">
                <span class="guide-step-num">1</span>
                <span><?php echo __('guide_rooms_add_step1') ?></span>
              </div>
              <div class="guide-step">
                <span class="guide-step-num">2</span>
                <span><?php echo __('guide_rooms_add_step2') ?></span>
              </div>
              <div class="guide-step">
                <span class="guide-step-num">3</span>
                <span><?php echo __('guide_rooms_add_step3') ?></span>
              </div>
            </div>

            <h6 class="guide-sub-title mt-4"><i class="bi bi-pencil me-1"></i><?php echo __('guide_rooms_edit_title') ?></h6>
            <p><?php echo __('guide_rooms_edit_desc') ?></p>

            <h6 class="guide-sub-title mt-4"><i class="bi bi-image me-1"></i><?php echo __('guide_rooms_images_title') ?></h6>
            <div class="guide-flow">
              <div class="guide-step">
                <span class="guide-step-num">1</span>
                <span><?php echo __('guide_rooms_images_step1') ?></span>
              </div>
              <div class="guide-step">
                <span class="guide-step-num">2</span>
                <span><?php echo __('guide_rooms_images_step2') ?></span>
              </div>
              <div class="guide-step">
                <span class="guide-step-num">3</span>
                <span><?php echo __('guide_rooms_images_step3') ?></span>
              </div>
            </div>

            <div class="guide-note mt-3">
              <i class="bi bi-info-circle"></i>
              <?php echo __('guide_rooms_note') ?>
            </div>
          </div>
        </div>

        <!-- Section: Bookings -->
        <div class="guide-section" id="section-bookings">
          <div class="guide-section-header">
            <i class="bi bi-calendar-check"></i>
            <h4><?php echo __('guide_bookings_title') ?></h4>
          </div>
          <div class="guide-section-body">
            <p><?php echo __('guide_bookings_desc') ?></p>

            <!-- Booking flow diagram -->
            <div class="guide-flow-diagram">
              <div class="guide-flow-box guide-flow-start">
                <i class="bi bi-person-plus"></i>
                <span><?php echo __('guide_bookings_flow_guest') ?></span>
              </div>
              <div class="guide-flow-arrow"><i class="bi bi-arrow-down"></i></div>
              <div class="guide-flow-box guide-flow-process">
                <i class="bi bi-calendar-plus"></i>
                <span><?php echo __('guide_bookings_flow_new') ?></span>
              </div>
              <div class="guide-flow-branch">
                <div class="guide-flow-branch-left">
                  <div class="guide-flow-arrow"><i class="bi bi-arrow-down"></i></div>
                  <div class="guide-flow-label"><?php echo __('guide_bookings_flow_assign') ?></div>
                  <div class="guide-flow-box guide-flow-success">
                    <i class="bi bi-check-circle"></i>
                    <span><?php echo __('guide_bookings_flow_done') ?></span>
                  </div>
                </div>
                <div class="guide-flow-branch-right">
                  <div class="guide-flow-arrow"><i class="bi bi-arrow-down"></i></div>
                  <div class="guide-flow-label"><?php echo __('guide_bookings_flow_cancel_action') ?></div>
                  <div class="guide-flow-box guide-flow-danger">
                    <i class="bi bi-x-circle"></i>
                    <span><?php echo __('guide_bookings_flow_refund') ?></span>
                  </div>
                </div>
              </div>
              <div class="guide-flow-arrow"><i class="bi bi-arrow-down"></i></div>
              <div class="guide-flow-box guide-flow-info">
                <i class="bi bi-clipboard-data"></i>
                <span><?php echo __('guide_bookings_flow_stats') ?></span>
              </div>
            </div>

            <h6 class="guide-sub-title mt-4"><i class="bi bi-calendar-plus me-1"></i><?php echo __('guide_bookings_new_title') ?></h6>
            <p><?php echo __('guide_bookings_new_desc') ?></p>

            <h6 class="guide-sub-title mt-3"><i class="bi bi-arrow-counterclockwise me-1"></i><?php echo __('guide_bookings_refund_title') ?></h6>
            <p><?php echo __('guide_bookings_refund_desc') ?></p>

            <h6 class="guide-sub-title mt-3"><i class="bi bi-clipboard-data me-1"></i><?php echo __('guide_bookings_stats_title') ?></h6>
            <p><?php echo __('guide_bookings_stats_desc') ?></p>
          </div>
        </div>

        <!-- Section: Users -->
        <div class="guide-section" id="section-users">
          <div class="guide-section-header">
            <i class="bi bi-people"></i>
            <h4><?php echo __('guide_users_title') ?></h4>
          </div>
          <div class="guide-section-body">
            <p><?php echo __('guide_users_desc') ?></p>
            <ul class="guide-list">
              <li><i class="bi bi-search"></i> <?php echo __('guide_users_search') ?></li>
              <li><i class="bi bi-toggle-on"></i> <?php echo __('guide_users_toggle') ?></li>
              <li><i class="bi bi-trash"></i> <?php echo __('guide_users_delete') ?></li>
            </ul>
            <div class="guide-note">
              <i class="bi bi-info-circle"></i>
              <?php echo __('guide_users_note') ?>
            </div>
          </div>
        </div>

        <!-- Section: Reviews -->
        <div class="guide-section" id="section-reviews">
          <div class="guide-section-header">
            <i class="bi bi-star"></i>
            <h4><?php echo __('guide_reviews_title') ?></h4>
          </div>
          <div class="guide-section-body">
            <p><?php echo __('guide_reviews_desc') ?></p>
            <ul class="guide-list">
              <li><i class="bi bi-eye"></i> <?php echo __('guide_reviews_mark') ?></li>
              <li><i class="bi bi-trash"></i> <?php echo __('guide_reviews_delete') ?></li>
              <li><i class="bi bi-check-all"></i> <?php echo __('guide_reviews_bulk') ?></li>
            </ul>
            <div class="guide-tip">
              <i class="bi bi-lightbulb"></i>
              <?php echo __('guide_reviews_tip') ?>
            </div>
          </div>
        </div>

        <!-- Section: Messages -->
        <div class="guide-section" id="section-messages">
          <div class="guide-section-header">
            <i class="bi bi-chat-dots"></i>
            <h4><?php echo __('guide_messages_title') ?></h4>
          </div>
          <div class="guide-section-body">
            <p><?php echo __('guide_messages_desc') ?></p>
            <ul class="guide-list">
              <li><i class="bi bi-eye"></i> <?php echo __('guide_messages_mark') ?></li>
              <li><i class="bi bi-trash"></i> <?php echo __('guide_messages_delete') ?></li>
              <li><i class="bi bi-check-all"></i> <?php echo __('guide_messages_bulk') ?></li>
            </ul>
          </div>
        </div>

        <!-- Section: Carousel -->
        <div class="guide-section" id="section-carousel">
          <div class="guide-section-header">
            <i class="bi bi-images"></i>
            <h4><?php echo __('guide_carousel_title') ?></h4>
          </div>
          <div class="guide-section-body">
            <p><?php echo __('guide_carousel_desc') ?></p>
            <div class="guide-flow">
              <div class="guide-step">
                <span class="guide-step-num">1</span>
                <span><?php echo __('guide_carousel_step1') ?></span>
              </div>
              <div class="guide-step">
                <span class="guide-step-num">2</span>
                <span><?php echo __('guide_carousel_step2') ?></span>
              </div>
              <div class="guide-step">
                <span class="guide-step-num">3</span>
                <span><?php echo __('guide_carousel_step3') ?></span>
              </div>
            </div>
            <div class="guide-tip mt-3">
              <i class="bi bi-lightbulb"></i>
              <?php echo __('guide_carousel_tip') ?>
            </div>
          </div>
        </div>

        <!-- Section: Features & Facilities -->
        <div class="guide-section" id="section-facilities">
          <div class="guide-section-header">
            <i class="bi bi-grid-3x3-gap"></i>
            <h4><?php echo __('guide_facilities_title') ?></h4>
          </div>
          <div class="guide-section-body">
            <p><?php echo __('guide_facilities_desc') ?></p>

            <div class="row g-3 mt-2">
              <div class="col-md-4">
                <div class="guide-mini-card">
                  <h6><i class="bi bi-house me-1"></i><?php echo __('guide_fac_types') ?></h6>
                  <p><?php echo __('guide_fac_types_desc') ?></p>
                </div>
              </div>
              <div class="col-md-4">
                <div class="guide-mini-card">
                  <h6><i class="bi bi-eye me-1"></i><?php echo __('guide_fac_features') ?></h6>
                  <p><?php echo __('guide_fac_features_desc') ?></p>
                </div>
              </div>
              <div class="col-md-4">
                <div class="guide-mini-card">
                  <h6><i class="bi bi-wifi me-1"></i><?php echo __('guide_fac_amenities') ?></h6>
                  <p><?php echo __('guide_fac_amenities_desc') ?></p>
                </div>
              </div>
            </div>

            <div class="guide-note mt-3">
              <i class="bi bi-info-circle"></i>
              <?php echo __('guide_facilities_note') ?>
            </div>
          </div>
        </div>

        <!-- Section: Settings -->
        <div class="guide-section" id="section-settings">
          <div class="guide-section-header">
            <i class="bi bi-gear"></i>
            <h4><?php echo __('guide_settings_title') ?></h4>
          </div>
          <div class="guide-section-body">
            <p><?php echo __('guide_settings_desc') ?></p>

            <div class="row g-3 mt-2">
              <div class="col-md-6 col-lg-3">
                <div class="guide-mini-card">
                  <h6><i class="bi bi-sliders me-1"></i><?php echo __('guide_set_general') ?></h6>
                  <p><?php echo __('guide_set_general_desc') ?></p>
                </div>
              </div>
              <div class="col-md-6 col-lg-3">
                <div class="guide-mini-card">
                  <h6><i class="bi bi-tools me-1"></i><?php echo __('guide_set_maintenance') ?></h6>
                  <p><?php echo __('guide_set_maintenance_desc') ?></p>
                </div>
              </div>
              <div class="col-md-6 col-lg-3">
                <div class="guide-mini-card">
                  <h6><i class="bi bi-telephone me-1"></i><?php echo __('guide_set_contact') ?></h6>
                  <p><?php echo __('guide_set_contact_desc') ?></p>
                </div>
              </div>
              <div class="col-md-6 col-lg-3">
                <div class="guide-mini-card">
                  <h6><i class="bi bi-person-badge me-1"></i><?php echo __('guide_set_team') ?></h6>
                  <p><?php echo __('guide_set_team_desc') ?></p>
                </div>
              </div>
            </div>

            <div class="guide-warning mt-3">
              <i class="bi bi-exclamation-triangle"></i>
              <?php echo __('guide_settings_warning') ?>
            </div>
          </div>
        </div>

        <!-- Section: Sidebar Navigation Map -->
        <div class="guide-section" id="section-sidebar">
          <div class="guide-section-header">
            <i class="bi bi-layout-sidebar"></i>
            <h4><?php echo __('guide_sidebar_title') ?></h4>
          </div>
          <div class="guide-section-body">
            <div class="guide-sidebar-map">
              <?php
                $sidebar_map = [
                  ['section' => 'guide_map_overview', 'items' => [
                    ['icon' => 'bi-speedometer2', 'key' => 'admin_dashboard', 'page' => 'dashboard.php'],
                  ]],
                  ['section' => 'guide_map_bookings', 'items' => [
                    ['icon' => 'bi-calendar-plus',          'key' => 'admin_new_bookings', 'page' => 'new_bookings.php'],
                    ['icon' => 'bi-arrow-counterclockwise',  'key' => 'admin_refund',       'page' => 'refund_bookings.php'],
                    ['icon' => 'bi-clipboard-data',          'key' => 'admin_statistics',   'page' => 'booking_records.php'],
                  ]],
                  ['section' => 'guide_map_management', 'items' => [
                    ['icon' => 'bi-door-open',     'key' => 'admin_rooms',      'page' => 'rooms.php'],
                    ['icon' => 'bi-people',        'key' => 'admin_users',      'page' => 'users.php'],
                    ['icon' => 'bi-grid-3x3-gap',  'key' => 'admin_facilities', 'page' => 'features_facilities.php'],
                  ]],
                  ['section' => 'guide_map_content', 'items' => [
                    ['icon' => 'bi-images',    'key' => 'admin_carousel', 'page' => 'carousel.php'],
                    ['icon' => 'bi-chat-dots', 'key' => 'admin_messages', 'page' => 'user_queries.php'],
                    ['icon' => 'bi-star',      'key' => 'admin_reviews',  'page' => 'rate_review.php'],
                  ]],
                  ['section' => 'guide_map_system', 'items' => [
                    ['icon' => 'bi-gear', 'key' => 'admin_settings', 'page' => 'settings.php'],
                    ['icon' => 'bi-book', 'key' => 'admin_guide',    'page' => 'guide.php'],
                  ]],
                ];

                foreach ($sidebar_map as $group):
              ?>
              <div class="guide-map-group">
                <div class="guide-map-section"><?php echo __($group['section']) ?></div>
                <?php foreach ($group['items'] as $item): ?>
                <a href="<?php echo $item['page'] ?>" class="guide-map-item">
                  <i class="bi <?php echo $item['icon'] ?>"></i>
                  <span><?php echo __($item['key']) ?></span>
                  <i class="bi bi-arrow-right ms-auto"></i>
                </a>
                <?php endforeach; ?>
              </div>
              <?php endforeach; ?>
            </div>
          </div>
        </div>

        <!-- Back to top -->
        <div class="text-center mt-4 mb-5">
          <a href="#" class="btn btn-outline-secondary btn-sm" onclick="window.scrollTo({top:0,behavior:'smooth'});return false;">
            <i class="bi bi-arrow-up me-1"></i><?php echo __('guide_back_to_top') ?>
          </a>
        </div>

      </div>
    </div>
  </div>

  <?php require('inc/scripts.php'); ?>

  <style>
    /* ── Guide Sections ── */
    .guide-section {
      background: var(--bg-panel, #1e293b);
      border: 1px solid var(--border-color, rgba(148,163,184,.1));
      border-radius: 12px;
      margin-bottom: 20px;
      overflow: hidden;
    }
    .guide-section-header {
      display: flex;
      align-items: center;
      gap: 12px;
      padding: 18px 24px;
      border-bottom: 1px solid var(--border-color, rgba(148,163,184,.1));
      background: rgba(165,180,252,.04);
    }
    .guide-section-header i {
      font-size: 22px;
      color: var(--cyan, #22d3ee);
    }
    .guide-section-header h4 {
      margin: 0;
      font-size: 1.1rem;
      font-weight: 700;
      color: var(--text-primary, #e2e8f0);
    }
    .guide-section-body {
      padding: 20px 24px;
    }
    .guide-section-body p {
      color: var(--text-secondary, #94a3b8);
      line-height: 1.7;
      margin-bottom: .5rem;
    }

    /* ── Sub titles ── */
    .guide-sub-title {
      font-weight: 700;
      color: var(--text-primary, #e2e8f0);
      font-size: .95rem;
    }

    /* ── Step flow ── */
    .guide-flow {
      display: flex;
      flex-direction: column;
      gap: 8px;
      margin: 12px 0;
    }
    .guide-step {
      display: flex;
      align-items: center;
      gap: 14px;
      padding: 12px 16px;
      background: rgba(148,163,184,.06);
      border-radius: 10px;
      border-left: 3px solid var(--cyan, #22d3ee);
      color: var(--text-secondary, #94a3b8);
      font-size: .9rem;
    }
    .guide-step-num {
      display: flex;
      align-items: center;
      justify-content: center;
      width: 28px;
      height: 28px;
      min-width: 28px;
      border-radius: 50%;
      background: var(--cyan, #22d3ee);
      color: #0f172a;
      font-weight: 800;
      font-size: .8rem;
      font-family: 'JetBrains Mono', monospace;
    }

    /* ── Note, Tip, Warning boxes ── */
    .guide-note, .guide-tip, .guide-warning {
      display: flex;
      align-items: flex-start;
      gap: 10px;
      padding: 14px 18px;
      border-radius: 10px;
      font-size: .88rem;
      line-height: 1.6;
    }
    .guide-note {
      background: rgba(96,165,250,.08);
      border: 1px solid rgba(96,165,250,.2);
      color: #93c5fd;
    }
    .guide-note i { color: #60a5fa; font-size: 18px; margin-top: 1px; }
    .guide-tip {
      background: rgba(250,204,21,.06);
      border: 1px solid rgba(250,204,21,.2);
      color: #fcd34d;
    }
    .guide-tip i { color: #facc15; font-size: 18px; margin-top: 1px; }
    .guide-warning {
      background: rgba(248,113,113,.06);
      border: 1px solid rgba(248,113,113,.2);
      color: #fca5a5;
    }
    .guide-warning i { color: #f87171; font-size: 18px; margin-top: 1px; }

    /* ── Feature grid ── */
    .guide-feature-grid {
      display: grid;
      grid-template-columns: repeat(auto-fill, minmax(180px, 1fr));
      gap: 8px;
      margin-top: 10px;
    }
    .guide-feature-item {
      display: flex;
      align-items: center;
      gap: 10px;
      padding: 10px 14px;
      background: rgba(148,163,184,.06);
      border-radius: 8px;
      font-size: .85rem;
      color: var(--text-secondary, #94a3b8);
    }
    .guide-feature-item i {
      color: var(--cyan, #22d3ee);
      font-size: 16px;
      width: 20px;
      text-align: center;
    }

    /* ── List ── */
    .guide-list {
      list-style: none;
      padding: 0;
      margin: 10px 0;
    }
    .guide-list li {
      display: flex;
      align-items: center;
      gap: 10px;
      padding: 10px 14px;
      background: rgba(148,163,184,.04);
      border-radius: 8px;
      margin-bottom: 6px;
      color: var(--text-secondary, #94a3b8);
      font-size: .9rem;
    }
    .guide-list li i {
      color: var(--cyan, #22d3ee);
      font-size: 16px;
      width: 20px;
      text-align: center;
    }

    /* ── Mini cards ── */
    .guide-mini-card {
      padding: 16px;
      background: rgba(148,163,184,.06);
      border: 1px solid var(--border-color, rgba(148,163,184,.1));
      border-radius: 10px;
      height: 100%;
    }
    .guide-mini-card h6 {
      color: var(--text-primary, #e2e8f0);
      font-weight: 700;
      font-size: .88rem;
      margin-bottom: 8px;
    }
    .guide-mini-card p {
      font-size: .82rem;
      margin: 0;
    }

    /* ── Quick nav cards ── */
    .guide-nav-card {
      display: flex;
      align-items: center;
      gap: 10px;
      padding: 12px 14px;
      background: rgba(148,163,184,.06);
      border: 1px solid var(--border-color, rgba(148,163,184,.1));
      border-radius: 10px;
      color: var(--text-secondary, #94a3b8);
      text-decoration: none;
      font-size: .85rem;
      font-weight: 500;
      transition: all .2s;
    }
    .guide-nav-card:hover {
      background: rgba(165,180,252,.1);
      border-color: rgba(165,180,252,.25);
      color: var(--cyan, #22d3ee);
      transform: translateY(-1px);
    }
    .guide-nav-card i {
      font-size: 18px;
      color: var(--cyan, #22d3ee);
    }

    /* ── Booking flow diagram ── */
    .guide-flow-diagram {
      display: flex;
      flex-direction: column;
      align-items: center;
      gap: 4px;
      margin: 16px 0;
      padding: 20px;
      background: rgba(148,163,184,.04);
      border-radius: 12px;
    }
    .guide-flow-box {
      display: flex;
      align-items: center;
      gap: 10px;
      padding: 12px 24px;
      border-radius: 10px;
      font-weight: 600;
      font-size: .88rem;
      min-width: 200px;
      justify-content: center;
    }
    .guide-flow-start { background: rgba(148,163,184,.12); color: #cbd5e1; }
    .guide-flow-process { background: rgba(96,165,250,.15); color: #93c5fd; }
    .guide-flow-success { background: rgba(74,222,128,.12); color: #86efac; }
    .guide-flow-danger { background: rgba(248,113,113,.12); color: #fca5a5; }
    .guide-flow-info { background: rgba(165,180,252,.12); color: #c4b5fd; }
    .guide-flow-arrow { color: #475569; font-size: 18px; }
    .guide-flow-label {
      font-size: .75rem;
      color: #64748b;
      font-weight: 500;
      text-align: center;
    }
    .guide-flow-branch {
      display: flex;
      gap: 40px;
      width: 100%;
      justify-content: center;
    }
    .guide-flow-branch-left,
    .guide-flow-branch-right {
      display: flex;
      flex-direction: column;
      align-items: center;
      gap: 4px;
    }

    /* ── Sidebar map ── */
    .guide-sidebar-map {
      display: flex;
      flex-direction: column;
      gap: 16px;
    }
    .guide-map-group {
      background: rgba(148,163,184,.04);
      border-radius: 10px;
      overflow: hidden;
    }
    .guide-map-section {
      font-size: .7rem;
      font-weight: 700;
      color: #475569;
      letter-spacing: 2px;
      text-transform: uppercase;
      font-family: 'JetBrains Mono', monospace;
      padding: 10px 16px 4px;
    }
    .guide-map-item {
      display: flex;
      align-items: center;
      gap: 10px;
      padding: 10px 16px;
      color: var(--text-secondary, #94a3b8);
      text-decoration: none;
      font-size: .85rem;
      transition: all .15s;
    }
    .guide-map-item:hover {
      background: rgba(165,180,252,.08);
      color: var(--cyan, #22d3ee);
    }
    .guide-map-item i:first-child {
      font-size: 16px;
      width: 20px;
      text-align: center;
    }
    .guide-map-item .bi-arrow-right {
      font-size: 12px;
      opacity: 0;
      transition: opacity .15s;
    }
    .guide-map-item:hover .bi-arrow-right { opacity: 1; }

    /* ── Responsive ── */
    @media (max-width: 768px) {
      .guide-section-header { padding: 14px 16px; }
      .guide-section-body { padding: 16px; }
      .guide-flow-branch { flex-direction: column; gap: 12px; }
      .guide-feature-grid { grid-template-columns: 1fr; }
    }
  </style>

</body>
</html>
