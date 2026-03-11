<!DOCTYPE html>
<html lang="vi">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <?php require('inc/links.php'); ?>

  <title><?php echo $settings_r['site_title'] ?> - <?php _e('find_rooms') ?></title>
  <meta name="description" content="Khám phá Villa biển và Homestay cao cấp tại Hạ Long. Đặt phòng trực tuyến với giá tốt nhất.">
  <meta name="robots" content="index, follow">
  <link rel="stylesheet" href="css/rooms.css?v=<?php echo time(); ?>">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

  <style>
    /* ========= PROPERTY TYPE TABS ========= */
    .prop-tabs-wrapper {
      background: #fff;
      border-radius: 16px;
      padding: 6px;
      display: flex;
      gap: 4px;
      box-shadow: 0 2px 8px rgba(0,0,0,.08);
      margin-bottom: 16px;
    }
    .prop-tab {
      flex: 1;
      border: none;
      background: transparent;
      border-radius: 12px;
      padding: 10px 8px;
      font-size: 13px;
      font-weight: 600;
      cursor: pointer;
      transition: all .2s;
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 6px;
      color: #64748b;
    }
    .prop-tab.active {
      background: linear-gradient(135deg, #0ea5e9, #0284c7);
      color: #fff;
      box-shadow: 0 4px 12px rgba(14,165,233,.35);
    }
    .prop-tab:hover:not(.active) { background: #f1f5f9; color: #0f172a; }

    /* ========= ROOM TYPE PILLS ========= */
    .room-type-pills {
      display: flex;
      flex-wrap: wrap;
      gap: 6px;
      margin-top: 4px;
    }
    .room-type-pill {
      border: 1.5px solid #e2e8f0;
      background: #fff;
      border-radius: 20px;
      padding: 5px 12px;
      font-size: 12px;
      font-weight: 600;
      cursor: pointer;
      transition: all .2s;
      color: #475569;
      white-space: nowrap;
    }
    .room-type-pill.active {
      background: #0f172a;
      border-color: #0f172a;
      color: #fff;
    }
    .room-type-pill:hover:not(.active) { border-color: #94a3b8; background: #f8fafc; }

    /* ========= VIEW FILTER ========= */
    .view-pills { display:flex; flex-wrap:wrap; gap:6px; margin-top:4px; }
    .view-pill {
      border: 1.5px solid #e2e8f0;
      background: #fff;
      border-radius: 20px;
      padding: 5px 12px;
      font-size: 12px;
      font-weight: 600;
      cursor: pointer;
      transition: all .2s;
      color: #475569;
    }
    .view-pill.active { background: #0ea5e9; border-color: #0ea5e9; color:#fff; }
    .view-pill:hover:not(.active){ border-color:#94a3b8; }

    /* ========= CARD BADGES ========= */
    .property-type-badge {
      display: inline-flex;
      align-items: center;
      padding: 4px 10px;
      border-radius: 20px;
      font-size: 11px;
      font-weight: 700;
      letter-spacing: .5px;
      text-transform: uppercase;
    }
    .badge-villa    { background: #f59e0b; color: #fff; }
    .badge-homestay { background: #10b981; color: #fff; }

    .view-badge {
      display:inline-flex; align-items:center; gap:4px;
      background:#e0f2fe; color:#0284c7;
      border-radius:20px; padding:3px 10px; font-size:11px; font-weight:600;
    }
    .room-type-tag {
      display:inline-flex; align-items:center;
      background:#f1f5f9; color:#475569;
      border-radius:20px; padding:3px 10px; font-size:11px; font-weight:600;
    }
    .room-code {
      font-size:12px; color:#94a3b8; font-weight:500;
      white-space:nowrap; flex-shrink:0;
    }
    .room-building { font-size:12px; color:#64748b; margin-bottom:6px; }
    .room-tags-row { display:flex; flex-wrap:wrap; gap:6px; margin-bottom:8px; }
    .room-checkin-row {
      display:flex; gap:16px; font-size:12px; color:#64748b; margin:8px 0;
      flex-wrap:wrap;
    }
    .room-checkin-row b { color:#0f172a; }

    /* Active filter count badge */
    .filter-count {
      display:inline-flex; align-items:center; justify-content:center;
      background:#ef4444; color:#fff; border-radius:50%;
      width:18px; height:18px; font-size:10px; font-weight:700;
      margin-left:4px;
    }
  </style>
</head>

<body class="bg-light">

  <?php
  require('inc/header.php');

  $checkin_default  = "";
  $checkout_default = "";
  $adult_default    = "";
  $children_default = "";

  if(isset($_GET['check_availability'])){
    $frm_data = filteration($_GET);
    $checkin_default  = $frm_data['checkin'];
    $checkout_default = $frm_data['checkout'];
    $adult_default    = $frm_data['adult'];
    $children_default = $frm_data['children'];
  }

  // Load property types & view types for filter UI
  $prop_types_q = selectAll('property_types');
  $prop_types   = [];
  while($r = mysqli_fetch_assoc($prop_types_q)) $prop_types[] = $r;

  $features_q = selectAll('features');
  $features   = [];
  while($r = mysqli_fetch_assoc($features_q)) $features[] = $r;
  ?>

  <!-- Breadcrumbs -->
  <nav aria-label="breadcrumb" class="breadcrumb-wrapper">
    <div class="container">
      <ol class="breadcrumb mb-0">
        <li class="breadcrumb-item"><a href="index.php"><?php _e('home') ?></a></li>
        <li class="breadcrumb-item active" aria-current="page"><?php _e('find_rooms') ?></li>
      </ol>
    </div>
  </nav>

  <!-- Page Header -->
  <header class="rooms-page-header">
    <div class="container">
      <div class="text-center">
        <h1 class="h-font"><?php _e('villa_homestay') ?></h1>
        <p class="subtitle"><?php _e('rooms_page_subtitle') ?></p>
        <div class="h-line"></div>
      </div>
    </div>
  </header>

  <!-- Main Content -->
  <main class="container-fluid mb-5">
    <div class="row">

      <!-- ===== FILTER SIDEBAR ===== -->
      <aside class="col-lg-3 col-md-12 mb-lg-0 mb-4 ps-lg-4" aria-label="<?php echo __('filter') ?>">
        <div class="filter-sidebar">
          <nav class="navbar navbar-expand-lg navbar-light">
            <div class="container-fluid flex-lg-column align-items-stretch p-0">

              <div class="filter-section">
                <h4 class="mb-0"><i class="bi bi-funnel"></i> <?php _e('filter') ?></h4>
              </div>
              <button class="navbar-toggler shadow-none mx-3 mb-2" type="button"
                data-bs-toggle="collapse" data-bs-target="#filterDropdown">
                <span class="navbar-toggler-icon"></span>
                <span class="ms-2"><?php _e('show_filter') ?></span>
              </button>

              <div class="collapse navbar-collapse flex-column align-items-stretch" id="filterDropdown">

                <!-- ===== Loại hình ===== -->
                <section class="filter-section">
                  <h5><i class="bi bi-house"></i> <span><?php _e('property_type') ?></span></h5>
                  <div class="prop-tabs-wrapper">
                    <button class="prop-tab active" data-prop="0" onclick="setPropType(0, this)">
                      <i class="bi bi-grid"></i> <?php _e('all') ?>
                    </button>
                    <?php foreach($prop_types as $pt): ?>
                    <button class="prop-tab" data-prop="<?php echo $pt['id']; ?>" onclick="setPropType(<?php echo $pt['id']; ?>, this)">
                      <i class="bi <?php echo $pt['slug'] === 'villa' ? 'bi-house' : 'bi-building'; ?>"></i>
                      <?php echo $pt['name']; ?>
                    </button>
                    <?php endforeach; ?>
                  </div>

                  <!-- Loại phòng (thay đổi theo loại hình) -->
                  <div id="room-type-section" style="display:none;">
                    <label class="form-label small text-muted mb-1"><?php _e('room_type') ?></label>
                    <div class="room-type-pills" id="room-type-pills"></div>
                  </div>
                </section>

                <!-- ===== View ===== -->
                <section class="filter-section">
                  <h5>
                    <i class="bi bi-eye"></i> <span><?php _e('view_filter') ?></span>
                    <button id="view_btn" onclick="viewClear()" class="btn shadow-none filter-clear-btn text-secondary d-none">
                      <i class="bi bi-x-circle"></i> <?php _e('reset') ?>
                    </button>
                  </h5>
                  <div class="view-pills">
                    <?php foreach($features as $ft): ?>
                    <button class="view-pill" data-view="<?php echo $ft['id']; ?>"
                      onclick="setViewType(<?php echo $ft['id']; ?>, this)">
                      <?php echo $ft['name']; ?>
                    </button>
                    <?php endforeach; ?>
                  </div>
                </section>

                <!-- ===== Ngày nhận/trả phòng ===== -->
                <section class="filter-section">
                  <h5>
                    <i class="bi bi-calendar-check"></i> <span><?php _e('check_availability') ?></span>
                    <button id="chk_avail_btn" onclick="chk_avail_clear()" class="btn shadow-none filter-clear-btn text-secondary d-none">
                      <i class="bi bi-x-circle"></i> <?php _e('reset') ?>
                    </button>
                  </h5>
                  <div class="date-input-wrapper mb-3">
                    <label class="form-label"><i class="bi bi-calendar-event me-1"></i><?php _e('checkin') ?></label>
                    <div class="date-input-container">
                      <i class="bi bi-calendar3 date-input-icon"></i>
                      <input type="date" class="form-control shadow-none date-input date-input-mobile"
                        value="<?php echo $checkin_default ?>" id="checkin-mobile"
                        min="<?php echo date('Y-m-d'); ?>">
                      <input type="text" class="form-control shadow-none date-input date-input-desktop"
                        value="<?php echo $checkin_default ?>" id="checkin"
                        placeholder="<?php echo __('select_checkin') ?>" readonly>
                    </div>
                  </div>
                  <div class="date-input-wrapper">
                    <label class="form-label"><i class="bi bi-calendar-x me-1"></i><?php _e('checkout') ?></label>
                    <div class="date-input-container">
                      <i class="bi bi-calendar3 date-input-icon"></i>
                      <input type="date" class="form-control shadow-none date-input date-input-mobile"
                        value="<?php echo $checkout_default ?>" id="checkout-mobile"
                        min="<?php echo date('Y-m-d'); ?>">
                      <input type="text" class="form-control shadow-none date-input date-input-desktop"
                        value="<?php echo $checkout_default ?>" id="checkout"
                        placeholder="<?php echo __('select_checkout') ?>" readonly>
                    </div>
                  </div>
                </section>

                <!-- ===== Số khách ===== -->
                <section class="filter-section">
                  <h5>
                    <i class="bi bi-people"></i> <span><?php _e('guest_count') ?></span>
                    <button id="guests_btn" onclick="guests_clear()" class="btn shadow-none filter-clear-btn text-secondary d-none">
                      <i class="bi bi-x-circle"></i> <?php _e('reset') ?>
                    </button>
                  </h5>
                  <div class="row g-2">
                    <div class="col-6">
                      <label class="form-label"><?php _e('adults') ?></label>
                      <input type="number" min="1" id="adults" value="<?php echo $adult_default ?>"
                        oninput="guests_filter()" class="form-control shadow-none">
                    </div>
                    <div class="col-6">
                      <label class="form-label"><?php _e('children') ?></label>
                      <input type="number" min="0" id="children" value="<?php echo $children_default ?>"
                        oninput="guests_filter()" class="form-control shadow-none">
                    </div>
                  </div>
                </section>

                <!-- ===== Tiện ích ===== -->
                <section class="filter-section">
                  <h5>
                    <i class="bi bi-star"></i> <span><?php _e('facilities') ?></span>
                    <button id="facilities_btn" onclick="facilities_clear()" class="btn shadow-none filter-clear-btn text-secondary d-none">
                      <i class="bi bi-x-circle"></i> <?php _e('reset') ?>
                    </button>
                  </h5>
                  <div class="facilities-list">
                    <?php
                    $facilities_q = mysqli_query($con,
                      "SELECT f.* FROM facilities f
                       LEFT JOIN amenity_categories c ON f.category_id = c.id
                       ORDER BY c.sort_order, f.name"
                    );
                    while($row = mysqli_fetch_assoc($facilities_q)) {
                      echo "<div class='form-check mb-2'>
                        <input type='checkbox' onclick='fetch_rooms()' name='facilities'
                          value='$row[id]' class='form-check-input shadow-none' id='facility_$row[id]'>
                        <label class='form-check-label' for='facility_$row[id]'>$row[name]</label>
                      </div>";
                    }
                    ?>
                  </div>
                </section>

                <!-- Reset tất cả -->
                <section class="filter-section pt-0">
                  <button onclick="resetAllFilters()" class="btn btn-outline-secondary btn-sm w-100 shadow-none">
                    <i class="bi bi-arrow-counterclockwise"></i> <?php _e('clear_all_filters') ?>
                  </button>
                </section>

              </div>
            </div>
          </nav>
        </div>
      </aside>

      <!-- ===== ROOMS LISTING ===== -->
      <div class="col-lg-9 col-md-12 px-lg-4">
        <div class="rooms-container" id="rooms-data" role="main"></div>
      </div>

    </div>
  </main>

  <!-- Flatpickr -->
  <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

  <script>
    // ===== State =====
    let currentPage      = 1;
    let selectedPropType = 0;   // 0 = tất cả
    let selectedRoomType = 0;
    let selectedViewType = 0;

    // Room types per property (loaded from DB via inline PHP)
    const roomTypesByProp = <?php
      $all_rt = [];
      $rt_q   = mysqli_query($con, "SELECT * FROM room_types ORDER BY sort_order");
      while($r = mysqli_fetch_assoc($rt_q)) $all_rt[] = $r;
      echo json_encode($all_rt);
    ?>;

    // ===== DOM refs =====
    const roomsData      = document.getElementById('rooms-data');
    const checkin        = document.getElementById('checkin');
    const checkout       = document.getElementById('checkout');
    const checkinMobile  = document.getElementById('checkin-mobile');
    const checkoutMobile = document.getElementById('checkout-mobile');
    const chk_avail_btn  = document.getElementById('chk_avail_btn');
    const adults         = document.getElementById('adults');
    const children       = document.getElementById('children');
    const guests_btn     = document.getElementById('guests_btn');
    const facilities_btn = document.getElementById('facilities_btn');
    const view_btn       = document.getElementById('view_btn');

    // ===== Mobile detect =====
    function isMobileDevice(){ return window.innerWidth <= 768; }
    let isMobile = isMobileDevice();
    window.addEventListener('resize', () => {
      const was = isMobile; isMobile = isMobileDevice();
      if(was !== isMobile) initDatePickers();
    });

    // ===== Property type filter =====
    function setPropType(id, btn){
      selectedPropType = id;
      selectedRoomType = 0;
      document.querySelectorAll('.prop-tab').forEach(b => b.classList.remove('active'));
      btn.classList.add('active');
      renderRoomTypePills(id);
      fetch_rooms(1);
    }

    function renderRoomTypePills(propId){
      const section = document.getElementById('room-type-section');
      const pills   = document.getElementById('room-type-pills');
      const types   = propId > 0
        ? roomTypesByProp.filter(r => r.property_type_id == propId)
        : [];

      if(types.length === 0){ section.style.display = 'none'; pills.innerHTML = ''; return; }
      section.style.display = 'block';

      let html = `<button class="room-type-pill active" data-rt="0" onclick="setRoomType(0,this)"><?php _e('all') ?></button>`;
      types.forEach(rt => {
        html += `<button class="room-type-pill" data-rt="${rt.id}" onclick="setRoomType(${rt.id},this)">${rt.name}</button>`;
      });
      pills.innerHTML = html;
    }

    function setRoomType(id, btn){
      selectedRoomType = id;
      document.querySelectorAll('.room-type-pill').forEach(b => b.classList.remove('active'));
      btn.classList.add('active');
      fetch_rooms(1);
    }

    // ===== View type filter =====
    function setViewType(id, btn){
      if(selectedViewType === id){
        selectedViewType = 0;
        document.querySelectorAll('.view-pill').forEach(b => b.classList.remove('active'));
        view_btn.classList.add('d-none');
      } else {
        selectedViewType = id;
        document.querySelectorAll('.view-pill').forEach(b => b.classList.remove('active'));
        btn.classList.add('active');
        view_btn.classList.remove('d-none');
      }
      fetch_rooms(1);
    }
    function viewClear(){
      selectedViewType = 0;
      document.querySelectorAll('.view-pill').forEach(b => b.classList.remove('active'));
      view_btn.classList.add('d-none');
      fetch_rooms(1);
    }

    // ===== Fetch rooms =====
    function fetch_rooms(page = 1){
      currentPage = page;

      let checkinVal = '', checkoutVal = '';
      if(isMobileDevice()){
        checkinVal  = checkinMobile  ? checkinMobile.value  : '';
        checkoutVal = checkoutMobile ? checkoutMobile.value : '';
      } else {
        try {
          const cp = flatpickr("#checkin"), dp = flatpickr("#checkout");
          if(cp && cp.selectedDates.length) checkinVal  = cp.formatDate(cp.selectedDates[0], "Y-m-d");
          if(dp && dp.selectedDates.length) checkoutVal = dp.formatDate(dp.selectedDates[0], "Y-m-d");
        } catch(e){ checkinVal = checkin?checkin.value:''; checkoutVal = checkout?checkout.value:''; }
      }

      const chk_avail    = JSON.stringify({ checkin: checkinVal, checkout: checkoutVal });
      const guests       = JSON.stringify({ adults: adults.value||0, children: children.value||0 });
      const facility_ids = [];
      document.querySelectorAll('[name="facilities"]:checked').forEach(el => facility_ids.push(el.value));
      const facility_list = JSON.stringify({ facilities: facility_ids });
      facilities_btn.classList.toggle('d-none', facility_ids.length === 0);

      const url = `ajax/rooms.php?fetch_rooms`
        + `&chk_avail=${encodeURIComponent(chk_avail)}`
        + `&guests=${encodeURIComponent(guests)}`
        + `&facility_list=${encodeURIComponent(facility_list)}`
        + `&property_type=${selectedPropType}`
        + `&room_type=${selectedRoomType}`
        + `&view_type=${selectedViewType}`
        + `&page=${page}`;

      roomsData.innerHTML = `<div class="rooms-loader" role="status">
        <div class="spinner-border text-info"><span class="visually-hidden"><?php _e('loading') ?></span></div>
        <p class="rooms-loader-text"><?php _e('loading_rooms') ?></p>
      </div>`;

      const xhr = new XMLHttpRequest();
      xhr.open("GET", url, true);
      xhr.onload = () => {
        if(xhr.status === 200){
          roomsData.innerHTML = xhr.responseText;
          attachPaginationListeners();
          roomsData.scrollIntoView({ behavior: 'smooth', block: 'start' });
        } else {
          roomsData.innerHTML = `<div class='rooms-empty'><div class='rooms-empty-icon'>⚠️</div><h3 class='rooms-empty-title'><?php _e('error_loading') ?></h3></div>`;
        }
      };
      xhr.onerror = () => {
        roomsData.innerHTML = `<div class='rooms-empty'><div class='rooms-empty-icon'>⚠️</div><h3 class='rooms-empty-title'><?php _e('connection_error') ?></h3></div>`;
      };
      xhr.send();
    }

    function attachPaginationListeners(){
      document.querySelectorAll('.rooms-pagination a[data-page]').forEach(link => {
        link.addEventListener('click', e => {
          e.preventDefault();
          const p = parseInt(link.getAttribute('data-page'));
          if(p && p !== currentPage) fetch_rooms(p);
        });
      });
    }

    // ===== Date filters =====
    function chk_avail_filter(){
      let ci='', co='';
      if(isMobileDevice()){ ci = checkinMobile?.value||''; co = checkoutMobile?.value||''; }
      else{
        try{
          const cp=flatpickr("#checkin"), dp=flatpickr("#checkout");
          if(cp?.selectedDates.length) ci = cp.formatDate(cp.selectedDates[0],"Y-m-d");
          if(dp?.selectedDates.length) co = dp.formatDate(dp.selectedDates[0],"Y-m-d");
        }catch(e){}
      }
      if(ci && co){ fetch_rooms(1); chk_avail_btn.classList.remove('d-none'); }
      else chk_avail_btn.classList.add('d-none');
    }

    function chk_avail_clear(){
      if(isMobileDevice()){
        if(checkinMobile)  checkinMobile.value  = '';
        if(checkoutMobile){ checkoutMobile.value = ''; checkoutMobile.setAttribute('min', new Date().toISOString().split('T')[0]); }
      } else {
        try{ const cp=flatpickr("#checkin"), dp=flatpickr("#checkout"); cp?.clear(); dp?.clear(); dp?.set('minDate','today'); }catch(e){}
      }
      chk_avail_btn.classList.add('d-none');
      fetch_rooms(1);
    }

    function guests_filter(){
      const hasGuests = (adults.value && +adults.value > 0) || (children.value && +children.value > 0);
      guests_btn.classList.toggle('d-none', !hasGuests);
      if(hasGuests) fetch_rooms(1);
    }

    function guests_clear(){
      adults.value = ''; children.value = '';
      guests_btn.classList.add('d-none');
      fetch_rooms(1);
    }

    function facilities_clear(){
      document.querySelectorAll('[name="facilities"]:checked').forEach(el => el.checked = false);
      facilities_btn.classList.add('d-none');
      fetch_rooms(1);
    }

    function resetAllFilters(){
      // Reset prop type
      selectedPropType = 0; selectedRoomType = 0; selectedViewType = 0;
      document.querySelectorAll('.prop-tab').forEach((b,i) => b.classList.toggle('active', i===0));
      document.getElementById('room-type-section').style.display = 'none';
      document.getElementById('room-type-pills').innerHTML = '';
      document.querySelectorAll('.view-pill').forEach(b => b.classList.remove('active'));
      view_btn.classList.add('d-none');
      chk_avail_clear();
      guests_clear();
      facilities_clear();
    }

    // ===== Flatpickr =====
    flatpickr.localize({
      firstDayOfWeek: 1,
      weekdays: {
        shorthand: <?php echo json_encode(explode(',', __('fp_weekdays_short'))); ?>,
        longhand: <?php echo json_encode(explode(',', __('fp_weekdays_long'))); ?>
      },
      months: {
        shorthand: <?php echo json_encode(explode(',', __('fp_months_short'))); ?>,
        longhand: <?php echo json_encode(explode(',', __('fp_months_long'))); ?>
      }
    });

    function initDatePickers(){
      if(isMobileDevice()){
        checkinMobile?.addEventListener('change', function(){
          if(this.value){
            const nd = new Date(this.value); nd.setDate(nd.getDate()+1);
            checkoutMobile?.setAttribute('min', nd.toISOString().split('T')[0]);
            if(checkoutMobile?.value && checkoutMobile.value <= this.value) checkoutMobile.value='';
          }
          chk_avail_filter();
        });
        checkoutMobile?.addEventListener('change', chk_avail_filter);
        return;
      }
      if(!checkin||!checkout) return;
      flatpickr("#checkin",{
        dateFormat:"Y-m-d", minDate:"today", defaultDate:checkin.value||null, disableMobile:true,
        onChange(dates, str){
          if(dates.length){ const dp=flatpickr("#checkout"); const nd=new Date(dates[0]); nd.setDate(nd.getDate()+1); dp?.set('minDate',nd); if(dp?.selectedDates.length&&dp.selectedDates[0]<nd) dp.clear(); }
          chk_avail_filter();
        }
      });
      flatpickr("#checkout",{
        dateFormat:"Y-m-d", minDate:"today", defaultDate:checkout.value||null, disableMobile:true,
        onChange(dates){ if(dates.length) chk_avail_filter(); }
      });
    }

    window.addEventListener('DOMContentLoaded', () => {
      fetch_rooms(1);
      initDatePickers();
    });
  </script>

  <?php require('inc/footer.php'); ?>
</body>
</html>
