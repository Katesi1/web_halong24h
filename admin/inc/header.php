<!-- Mobile Overlay -->
<div class="sidebar-overlay d-lg-none" id="sidebarOverlay"></div>

<div class="col-lg-2" id="dashboard-menu">
  <nav class="navbar navbar-expand-lg navbar-dark">
    <div class="container-fluid flex-lg-column align-items-stretch p-0">
      <!-- Sidebar Header (Desktop - chỉ hiển thị khi không collapsed) -->
      <div class="admin-topbar-sidebar d-none d-lg-block">
        <h5 class="mb-0 fw-bold h-font">HaLong24h</h5>
      </div>
      
      <!-- Mobile Menu Header -->
      <div class="d-flex align-items-center justify-content-between d-lg-none px-3 py-2 border-bottom border-secondary">
        <h6 class="mb-0 text-light">Menu</h6>
        <button class="btn-close btn-close-white" id="closeSidebarMobile" aria-label="Close sidebar"></button>
      </div>
      
      <div class="collapse navbar-collapse flex-column align-items-stretch" id="adminDropdown">
        <ul class="nav nav-pills flex-column sidebar-nav">
          <li class="nav-item">
            <a class="nav-link text-white" href="dashboard.php" data-title="Bảng theo dõi">
              <i class="bi bi-speedometer2"></i>
              <span>Bảng theo dõi</span>
            </a>
          </li>
          <li class="nav-item">
            <button class="collapse-toggle" type="button" data-bs-toggle="collapse" data-bs-target="#bookingLinks" aria-expanded="true" aria-controls="bookingLinks">
              <span><i class="bi bi-calendar-check"></i> Bookings</span>
              <i class="bi bi-caret-down-fill"></i>
            </button>
            <div class="collapse show submenu" id="bookingLinks">
              <ul class="nav nav-pills flex-column">
                <li class="nav-item">
                  <a class="nav-link text-white" href="new_bookings.php" data-title="Lượt đặt phòng mới">
                    <i class="bi bi-calendar-plus"></i>
                    <span>Lượt đặt phòng mới</span>
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link text-white" href="refund_bookings.php" data-title="Yêu cầu hoàn tiền">
                    <i class="bi bi-arrow-counterclockwise"></i>
                    <span>Yêu cầu hoàn tiền</span>
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link text-white" href="booking_records.php" data-title="Thống kê đặt phòng">
                    <i class="bi bi-clipboard-data"></i>
                    <span>Thống kê đặt phòng</span>
                  </a>
                </li>
              </ul>
            </div>
          </li>
          <li class="nav-item">
            <a class="nav-link text-white" href="users.php" data-title="Người dùng">
              <i class="bi bi-people"></i>
              <span>Người dùng</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-white" href="user_queries.php" data-title="Tin nhắn">
              <i class="bi bi-chat-dots"></i>
              <span>Tin nhắn</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-white" href="rate_review.php" data-title="Đánh giá">
              <i class="bi bi-star"></i>
              <span>Đánh giá</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-white" href="rooms.php" data-title="Danh sách phòng">
              <i class="bi bi-door-open"></i>
              <span>Danh sách phòng</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-white" href="features_facilities.php" data-title="Không Gian và Tiện Nghi">
              <i class="bi bi-grid"></i>
              <span>Không Gian và Tiện Nghi</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-white" href="carousel.php" data-title="Trình chiếu">
              <i class="bi bi-images"></i>
              <span>Trình chiếu</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-white" href="settings.php" data-title="Cài đặt trang">
              <i class="bi bi-gear"></i>
              <span>Cài đặt trang</span>
            </a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
</div>

<!-- Main Topbar (luôn hiển thị, không bị sidebar che) -->
<div class="admin-topbar" id="mainTopbar">
  <div class="d-flex align-items-center gap-3">
    <button class="sidebar-toggle-btn-mobile d-lg-none" id="sidebarToggleMobile" aria-label="Toggle sidebar">
      <i class="bi bi-list"></i>
    </button>
    <h5 class="mb-0 fw-bold h-font">HaLong24h</h5>
  </div>
  <div class="d-flex align-items-center gap-2">
    <button class="sidebar-toggle-btn d-none d-lg-flex" id="sidebarToggle" aria-label="Toggle sidebar">
      <i class="bi bi-list"></i>
    </button>
    <a href="logout.php" class="btn-logout">
      <i class="bi bi-box-arrow-right me-1"></i>Đăng xuất
    </a>
  </div>
</div>
