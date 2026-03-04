<!DOCTYPE html>
<html lang="vi">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <?php require('inc/links.php'); ?>

  <!-- SEO Meta Tags -->
  <title><?php echo $settings_r['site_title'] ?> - Danh sách phòng nghỉ đẹp và tiện nghi</title>
  <meta name="description" content="Khám phá danh sách phòng nghỉ đầy đủ tiện nghi tại <?php echo $settings_r['site_title'] ?>. Đặt phòng trực tuyến với giá tốt nhất và nhiều ưu đãi hấp dẫn.">
  <meta name="keywords" content="đặt phòng, khách sạn, phòng nghỉ, <?php echo $settings_r['site_title'] ?>, đặt phòng online">
  <meta name="robots" content="index, follow">
  <meta name="author" content="<?php echo $settings_r['site_title'] ?>">

  <!-- Open Graph / Facebook -->
  <meta property="og:type" content="website">
  <meta property="og:url" content="<?php echo (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']; ?>">
  <meta property="og:title" content="<?php echo $settings_r['site_title'] ?> - Danh sách phòng nghỉ">
  <meta property="og:description" content="Khám phá danh sách phòng nghỉ đầy đủ tiện nghi tại <?php echo $settings_r['site_title'] ?>">
  <meta property="og:image" content="<?php echo (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://" . $_SERVER['HTTP_HOST']; ?>/images/logo.png">

  <!-- Twitter -->
  <meta property="twitter:card" content="summary_large_image">
  <meta property="twitter:url" content="<?php echo (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']; ?>">
  <meta property="twitter:title" content="<?php echo $settings_r['site_title'] ?> - Danh sách phòng nghỉ">
  <meta property="twitter:description" content="Khám phá danh sách phòng nghỉ đầy đủ tiện nghi tại <?php echo $settings_r['site_title'] ?>">

  <!-- Canonical URL -->
  <link rel="canonical" href="<?php echo (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']; ?>">

  <!-- Additional CSS -->
  <link rel="stylesheet" href="css/rooms.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

  <!-- Structured Data (JSON-LD) -->
  <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "CollectionPage",
      "name": "Danh sách phòng nghỉ - <?php echo $settings_r['site_title'] ?>",
      "description": "Khám phá danh sách phòng nghỉ đầy đủ tiện nghi tại <?php echo $settings_r['site_title'] ?>",
      "url": "<?php echo (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']; ?>",
      "mainEntity": {
        "@type": "ItemList",
        "itemListElement": []
      }
    }
  </script>
</head>

<body class="bg-light">

  <?php
  require('inc/header.php');

  $checkin_default = "";
  $checkout_default = "";
  $adult_default = "";
  $children_default = "";

  if (isset($_GET['check_availability'])) {
    $frm_data = filteration($_GET);

    $checkin_default = $frm_data['checkin'];
    $checkout_default = $frm_data['checkout'];
    $adult_default = $frm_data['adult'];
    $children_default = $frm_data['children'];
  }
  ?>

  <!-- Breadcrumbs -->
  <nav aria-label="breadcrumb" class="breadcrumb-wrapper">
    <div class="container">
      <ol class="breadcrumb mb-0">
        <li class="breadcrumb-item"><a href="index.php">Trang chủ</a></li>
        <li class="breadcrumb-item active" aria-current="page">Danh sách phòng</li>
      </ol>
    </div>
  </nav>

  <!-- Page Header -->
  <header class="rooms-page-header">
    <div class="container">
      <div class="text-center">
        <h1 class="h-font">Danh sách phòng nghỉ</h1>
        <p class="subtitle">Khám phá các phòng nghỉ tiện nghi và thoải mái của chúng tôi</p>
        <div class="h-line"></div>
      </div>
    </div>
  </header>

  <!-- Main Content -->
  <main class="container-fluid mb-5">
    <div class="row">
      <!-- Filter Sidebar -->
      <aside class="col-lg-3 col-md-12 mb-lg-0 mb-4 ps-lg-4" aria-label="Bộ lọc tìm kiếm">
        <div class="filter-sidebar">
          <nav class="navbar navbar-expand-lg navbar-light">
            <div class="container-fluid flex-lg-column align-items-stretch p-0">
              <div class="filter-section">
                <h4 class="mb-0">
                  <i class="bi bi-funnel"></i>
                  Bộ lọc
                </h4>
              </div>
              <button class="navbar-toggler shadow-none mx-3 mb-2" type="button" data-bs-toggle="collapse" data-bs-target="#filterDropdown" aria-controls="filterDropdown" aria-expanded="false" aria-label="Toggle filters">
                <span class="navbar-toggler-icon"></span>
                <span class="ms-2">Hiển thị bộ lọc</span>
              </button>
              <div class="collapse navbar-collapse flex-column align-items-stretch" id="filterDropdown">
                <!-- Check Availability -->
                <section class="filter-section" aria-labelledby="availability-heading">
                  <h5 id="availability-heading">
                    <i class="bi bi-calendar-check"></i>
                    <span>Kiểm tra phòng trống</span>
                    <button id="chk_avail_btn" onclick="chk_avail_clear()" class="btn shadow-none filter-clear-btn text-secondary d-none" aria-label="Xóa bộ lọc ngày tháng">
                      <i class="bi bi-x-circle"></i> Làm mới
                    </button>
                  </h5>

                  <!-- Check-in Date -->
                  <div class="date-input-wrapper mb-3">
                    <label for="checkin" class="form-label">
                      <i class="bi bi-calendar-event me-1"></i>
                      Nhận phòng
                    </label>
                    <div class="date-input-container">
                      <i class="bi bi-calendar3 date-input-icon"></i>
                      <!-- Mobile: native date picker -->
                      <input type="date"
                        class="form-control shadow-none date-input date-input-mobile"
                        value="<?php echo $checkin_default ?>"
                        id="checkin-mobile"
                        min="<?php echo date('Y-m-d'); ?>"
                        aria-label="Chọn ngày nhận phòng">
                      <!-- Desktop: Flatpickr -->
                      <input type="text"
                        class="form-control shadow-none date-input date-input-desktop"
                        value="<?php echo $checkin_default ?>"
                        id="checkin"
                        placeholder="Chọn ngày nhận phòng"
                        readonly
                        aria-label="Chọn ngày nhận phòng">
                    </div>
                  </div>

                  <!-- Check-out Date -->
                  <div class="date-input-wrapper">
                    <label for="checkout" class="form-label">
                      <i class="bi bi-calendar-x me-1"></i>
                      Trả phòng
                    </label>
                    <div class="date-input-container">
                      <i class="bi bi-calendar3 date-input-icon"></i>
                      <!-- Mobile: native date picker -->
                      <input type="date"
                        class="form-control shadow-none date-input date-input-mobile"
                        value="<?php echo $checkout_default ?>"
                        id="checkout-mobile"
                        min="<?php echo $checkin_default ? date('Y-m-d', strtotime($checkin_default . ' +1 day')) : date('Y-m-d'); ?>"
                        aria-label="Chọn ngày trả phòng">
                      <!-- Desktop: Flatpickr -->
                      <input type="text"
                        class="form-control shadow-none date-input date-input-desktop"
                        value="<?php echo $checkout_default ?>"
                        id="checkout"
                        placeholder="Chọn ngày trả phòng"
                        readonly
                        aria-label="Chọn ngày trả phòng">
                    </div>
                  </div>
                </section>

                <!-- Facilities -->
                <section class="filter-section" aria-labelledby="facilities-heading">
                  <h5 id="facilities-heading">
                    <i class="bi bi-star"></i>
                    <span>Tiện ích</span>
                    <button id="facilities_btn" onclick="facilities_clear()" class="btn shadow-none filter-clear-btn text-secondary d-none" aria-label="Xóa bộ lọc tiện ích">
                      <i class="bi bi-x-circle"></i> Làm mới
                    </button>
                  </h5>
                  <div class="facilities-list">
                    <?php
                    $facilities_q = selectAll('facilities');
                    while ($row = mysqli_fetch_assoc($facilities_q)) {
                      echo <<<facilities
                          <div class="form-check mb-2">
                            <input type="checkbox" 
                                   onclick="fetch_rooms()" 
                                   name="facilities" 
                                   value="$row[id]" 
                                   class="form-check-input shadow-none" 
                                   id="facility_$row[id]"
                                   aria-label="Chọn tiện ích: $row[name]">
                            <label class="form-check-label" for="facility_$row[id]">$row[name]</label>
                          </div>
                        facilities;
                    }
                    ?>
                  </div>
                </section>

                <!-- Guests -->
                <section class="filter-section" aria-labelledby="guests-heading">
                  <h5 id="guests-heading">
                    <i class="bi bi-people"></i>
                    <span>Số lượng khách</span>
                    <button id="guests_btn" onclick="guests_clear()" class="btn shadow-none filter-clear-btn text-secondary d-none" aria-label="Xóa bộ lọc số lượng khách">
                      <i class="bi bi-x-circle"></i> Reset
                    </button>
                  </h5>
                  <div class="row g-2">
                    <div class="col-6">
                      <label for="adults" class="form-label">Người lớn</label>
                      <input type="number"
                        min="1"
                        id="adults"
                        value="<?php echo $adult_default ?>"
                        oninput="guests_filter()"
                        class="form-control shadow-none"
                        aria-label="Số lượng người lớn">
                    </div>
                    <div class="col-6">
                      <label for="children" class="form-label">Trẻ em</label>
                      <input type="number"
                        min="0"
                        id="children"
                        value="<?php echo $children_default ?>"
                        oninput="guests_filter()"
                        class="form-control shadow-none"
                        aria-label="Số lượng trẻ em">
                    </div>
                  </div>
                </section>
              </div>
            </div>
          </nav>
        </div>
      </aside>

      <!-- Rooms Listing -->
      <div class="col-lg-9 col-md-12 px-lg-4">
        <div class="rooms-container" id="rooms-data" role="main" aria-label="Danh sách phòng">
          <!-- Rooms will be loaded here via AJAX -->
        </div>
      </div>

    </div>
  </main>


  <script>
    let rooms_data = document.getElementById('rooms-data');
    let checkin = document.getElementById('checkin');
    let checkout = document.getElementById('checkout');
    let checkinMobile = document.getElementById('checkin-mobile');
    let checkoutMobile = document.getElementById('checkout-mobile');
    let chk_avail_btn = document.getElementById('chk_avail_btn');
    let adults = document.getElementById('adults');
    let children = document.getElementById('children');
    let guests_btn = document.getElementById('guests_btn');
    let facilities_btn = document.getElementById('facilities_btn');

    // Pagination state
    let currentPage = 1;

    // Detect mobile device - function to check dynamically
    function isMobileDevice() {
      return window.innerWidth <= 768 || /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent);
    }

    let isMobile = isMobileDevice();

    // Update on resize
    window.addEventListener('resize', function() {
      const wasMobile = isMobile;
      isMobile = isMobileDevice();

      // If switching between mobile/desktop, reinitialize
      if (wasMobile !== isMobile) {
        initDatePickers();
      }
    });

    // Sync mobile and desktop inputs
    function syncDateInputs() {
      // Sync initial values
      if (checkinMobile && checkin && checkin.value) {
        checkinMobile.value = checkin.value;
      }
      if (checkoutMobile && checkout && checkout.value) {
        checkoutMobile.value = checkout.value;
      }

      // Sync on change
      if (checkinMobile && checkin) {
        checkinMobile.addEventListener('change', function() {
          if (checkin) checkin.value = this.value;
          chk_avail_filter();
        });
      }

      if (checkoutMobile && checkout) {
        checkoutMobile.addEventListener('change', function() {
          if (checkout) checkout.value = this.value;
          chk_avail_filter();
        });
      }
    }

    function fetch_rooms(page = 1) {
      currentPage = page;

      // Get values - prioritize mobile on mobile devices, desktop on desktop
      let checkinValue = '';
      let checkoutValue = '';

      if (isMobileDevice()) {
        checkinValue = checkinMobile ? checkinMobile.value : '';
        checkoutValue = checkoutMobile ? checkoutMobile.value : '';
      } else {
        checkinValue = checkin ? checkin.value : '';
        checkoutValue = checkout ? checkout.value : '';

        // Get from Flatpickr if available
        try {
          const checkinPicker = flatpickr("#checkin");
          const checkoutPicker = flatpickr("#checkout");

          if (checkinPicker && checkinPicker.selectedDates.length > 0) {
            checkinValue = checkinPicker.formatDate(checkinPicker.selectedDates[0], "Y-m-d");
          }

          if (checkoutPicker && checkoutPicker.selectedDates.length > 0) {
            checkoutValue = checkoutPicker.formatDate(checkoutPicker.selectedDates[0], "Y-m-d");
          }
        } catch (e) {
          // Flatpickr not initialized yet
        }
      }

      let chk_avail = JSON.stringify({
        checkin: checkinValue,
        checkout: checkoutValue
      });

      let guests = JSON.stringify({
        adults: adults.value || 0,
        children: children.value || 0
      });

      let facility_list = {
        "facilities": []
      };
      let get_facilities = document.querySelectorAll('[name="facilities"]:checked');

      if (get_facilities.length > 0) {
        get_facilities.forEach((facility) => {
          facility_list.facilities.push(facility.value);
        });
        facilities_btn.classList.remove('d-none');
      } else {
        facilities_btn.classList.add('d-none');
      }

      facility_list = JSON.stringify(facility_list);

      let xhr = new XMLHttpRequest();
      let url = "ajax/rooms.php?fetch_rooms&chk_avail=" + encodeURIComponent(chk_avail) +
        "&guests=" + encodeURIComponent(guests) +
        "&facility_list=" + encodeURIComponent(facility_list) +
        "&page=" + page;

      xhr.open("GET", url, true);

      xhr.onprogress = function() {
        rooms_data.innerHTML = `
          <div class="rooms-loader" role="status" aria-live="polite">
            <div class="spinner-border text-info" role="status">
              <span class="visually-hidden">Đang tải...</span>
            </div>
            <p class="rooms-loader-text">Đang tải danh sách phòng...</p>
          </div>
        `;
      };

      xhr.onload = function() {
        if (this.status === 200) {
          rooms_data.innerHTML = this.responseText;

          // Attach pagination event listeners
          attachPaginationListeners();

          // Scroll to top of rooms container
          rooms_data.scrollIntoView({
            behavior: 'smooth',
            block: 'start'
          });

          // Update structured data if rooms are loaded
          updateStructuredData();
        } else {
          rooms_data.innerHTML = `
            <div class="rooms-empty">
              <div class="rooms-empty-icon">⚠️</div>
              <h3 class="rooms-empty-title">Lỗi tải dữ liệu</h3>
              <p class="rooms-empty-text">Vui lòng thử lại sau.</p>
            </div>
          `;
        }
      };

      xhr.onerror = function() {
        rooms_data.innerHTML = `
          <div class="rooms-empty">
            <div class="rooms-empty-icon">⚠️</div>
            <h3 class="rooms-empty-title">Lỗi kết nối</h3>
            <p class="rooms-empty-text">Vui lòng kiểm tra kết nối internet và thử lại.</p>
          </div>
        `;
      };

      xhr.send();
    }

    function attachPaginationListeners() {
      const paginationLinks = document.querySelectorAll('.rooms-pagination a[data-page]');
      paginationLinks.forEach(link => {
        link.addEventListener('click', function(e) {
          e.preventDefault();
          const page = parseInt(this.getAttribute('data-page'));
          if (page && page !== currentPage) {
            fetch_rooms(page);
          }
        });
      });
    }

    function chk_avail_filter() {
      let checkinValue = '';
      let checkoutValue = '';

      if (isMobileDevice()) {
        checkinValue = checkinMobile ? checkinMobile.value : '';
        checkoutValue = checkoutMobile ? checkoutMobile.value : '';
      } else {
        try {
          const checkinPicker = flatpickr("#checkin");
          const checkoutPicker = flatpickr("#checkout");

          if (checkinPicker && checkinPicker.selectedDates.length > 0) {
            checkinValue = checkinPicker.formatDate(checkinPicker.selectedDates[0], "Y-m-d");
          }

          if (checkoutPicker && checkoutPicker.selectedDates.length > 0) {
            checkoutValue = checkoutPicker.formatDate(checkoutPicker.selectedDates[0], "Y-m-d");
          }
        } catch (e) {
          // Flatpickr not initialized
        }
      }

      if (checkinValue != '' && checkoutValue != '') {
        fetch_rooms(1); // Reset to page 1 when filter changes
        chk_avail_btn.classList.remove('d-none');
      } else {
        chk_avail_btn.classList.add('d-none');
      }
    }

    function chk_avail_clear() {
      if (isMobileDevice()) {
        if (checkinMobile) checkinMobile.value = '';
        if (checkoutMobile) {
          checkoutMobile.value = '';
          checkoutMobile.setAttribute('min', new Date().toISOString().split('T')[0]);
        }
      } else {
        try {
          const checkinPicker = flatpickr("#checkin");
          const checkoutPicker = flatpickr("#checkout");

          if (checkinPicker) checkinPicker.clear();
          if (checkoutPicker) {
            checkoutPicker.clear();
            checkoutPicker.set('minDate', 'today');
          }
        } catch (e) {
          // Flatpickr not initialized
        }
      }

      chk_avail_btn.classList.add('d-none');
      fetch_rooms(1); // Reset to page 1
    }

    function guests_filter() {
      if ((adults.value && parseInt(adults.value) > 0) || (children.value && parseInt(children.value) > 0)) {
        fetch_rooms(1); // Reset to page 1 when filter changes
        guests_btn.classList.remove('d-none');
      } else {
        guests_btn.classList.add('d-none');
      }
    }

    function guests_clear() {
      adults.value = '';
      children.value = '';
      guests_btn.classList.add('d-none');
      fetch_rooms(1); // Reset to page 1
    }

    function facilities_clear() {
      let get_facilities = document.querySelectorAll('[name="facilities"]:checked');
      get_facilities.forEach((facility) => {
        facility.checked = false;
      });
      facilities_btn.classList.add('d-none');
      fetch_rooms(1); // Reset to page 1
    }

    function updateStructuredData() {
      const roomCards = document.querySelectorAll('.room-card-enhanced');
      if (roomCards.length > 0) {
        const itemListElement = [];
        roomCards.forEach((card, index) => {
          const title = card.querySelector('.room-title')?.textContent;
          const link = card.querySelector('a[href*="room_details"]')?.href;
          if (title && link) {
            itemListElement.push({
              "@type": "ListItem",
              "position": index + 1,
              "item": {
                "@type": "HotelRoom",
                "name": title,
                "url": link
              }
            });
          }
        });

        // Update structured data
        const scriptTag = document.querySelector('script[type="application/ld+json"]');
        if (scriptTag) {
          const data = JSON.parse(scriptTag.textContent);
          data.mainEntity.itemListElement = itemListElement;
          scriptTag.textContent = JSON.stringify(data);
        }
      }
    }

    // Initialize on page load
    window.addEventListener('DOMContentLoaded', function() {
      fetch_rooms(1);
      initDatePickers();
    });
  </script>

  <!-- Flatpickr JS -->
  <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
  <script>
    // Vietnamese locale for Flatpickr
    flatpickr.localize({
      firstDayOfWeek: 1,
      weekdays: {
        shorthand: ["CN", "T2", "T3", "T4", "T5", "T6", "T7"],
        longhand: ["Chủ nhật", "Thứ hai", "Thứ ba", "Thứ tư", "Thứ năm", "Thứ sáu", "Thứ bảy"]
      },
      months: {
        shorthand: ["T1", "T2", "T3", "T4", "T5", "T6", "T7", "T8", "T9", "T10", "T11", "T12"],
        longhand: ["Tháng 1", "Tháng 2", "Tháng 3", "Tháng 4", "Tháng 5", "Tháng 6", "Tháng 7", "Tháng 8", "Tháng 9", "Tháng 10", "Tháng 11", "Tháng 12"]
      }
    });

    function initDatePickers() {
      // Only initialize Flatpickr on desktop
      if (isMobileDevice()) {
        // Mobile: sync native date inputs
        syncDateInputs();

        // Update checkout min date when checkin changes on mobile
        if (checkinMobile && checkoutMobile) {
          checkinMobile.addEventListener('change', function() {
            if (this.value) {
              const nextDay = new Date(this.value);
              nextDay.setDate(nextDay.getDate() + 1);
              checkoutMobile.setAttribute('min', nextDay.toISOString().split('T')[0]);

              // Clear checkout if it's before new min date
              if (checkoutMobile.value && checkoutMobile.value <= this.value) {
                checkoutMobile.value = '';
              }
            } else {
              checkoutMobile.setAttribute('min', new Date().toISOString().split('T')[0]);
            }
            chk_avail_filter();
          });

          checkoutMobile.addEventListener('change', function() {
            chk_avail_filter();
          });
        }
        return;
      }

      // Desktop: Initialize Flatpickr
      if (!checkin || !checkout) return;

      // Check-in date picker
      const checkinPicker = flatpickr("#checkin", {
        dateFormat: "Y-m-d",
        minDate: "today",
        defaultDate: checkin.value || null,
        disableMobile: true, // Force desktop mode
        onChange: function(selectedDates, dateStr, instance) {
          if (dateStr && selectedDates.length > 0) {
            const checkoutPicker = flatpickr("#checkout");
            if (checkoutPicker) {
              const nextDay = new Date(selectedDates[0]);
              nextDay.setDate(nextDay.getDate() + 1);
              checkoutPicker.set('minDate', nextDay);

              // If checkout date is before new min date, clear it
              if (checkoutPicker.selectedDates.length > 0 && checkoutPicker.selectedDates[0] < nextDay) {
                checkoutPicker.clear();
              }
            }
            chk_avail_filter();
          } else if (!dateStr) {
            // If checkin is cleared, reset checkout min date
            const checkoutPicker = flatpickr("#checkout");
            if (checkoutPicker) {
              checkoutPicker.set('minDate', 'today');
            }
          }
        }
      });

      // Check-out date picker
      const checkoutPicker = flatpickr("#checkout", {
        dateFormat: "Y-m-d",
        minDate: checkin.value ? (() => {
          const checkinDate = new Date(checkin.value);
          checkinDate.setDate(checkinDate.getDate() + 1);
          return checkinDate.toISOString().split('T')[0];
        })() : "today",
        defaultDate: checkout.value || null,
        disableMobile: true, // Force desktop mode
        onChange: function(selectedDates, dateStr, instance) {
          if (dateStr) {
            chk_avail_filter();
          }
        }
      });
    }
  </script>

  <?php require('inc/footer.php'); ?>

</body>

</html>