<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <?php require('inc/links.php'); ?>
  <title><?php echo $settings_r['site_title'] ?> - Dịch Vụ</title>
  <style>
    .service-hero {
      background: linear-gradient(135deg, #1a3c34 0%, #2D6A4F 50%, #40916C 100%);
      padding: 80px 0 60px;
      color: white;
    }
    .service-card {
      border-radius: 16px;
      overflow: hidden;
      transition: all 0.3s ease;
      border: none;
      box-shadow: 0 4px 15px rgba(0,0,0,0.08);
    }
    .service-card:hover {
      transform: translateY(-8px);
      box-shadow: 0 12px 30px rgba(45,106,79,0.2);
    }
    .service-icon-wrap {
      width: 70px;
      height: 70px;
      border-radius: 50%;
      background: linear-gradient(135deg, #2D6A4F, #40916C);
      display: flex;
      align-items: center;
      justify-content: center;
      margin: 0 auto 16px;
    }
    .service-icon-wrap i {
      font-size: 28px;
      color: white;
    }
    .section-badge {
      display: inline-block;
      background: rgba(255,255,255,0.15);
      color: white;
      padding: 6px 20px;
      border-radius: 30px;
      font-size: 14px;
      margin-bottom: 16px;
      border: 1px solid rgba(255,255,255,0.3);
    }
    .facility-card {
      border-left: 4px solid #2D6A4F;
      transition: all 0.3s;
    }
    .facility-card:hover {
      border-left-color: #40916C;
      transform: scale(1.02);
    }
    .highlight-box {
      background: linear-gradient(135deg, #f0faf4, #e8f5e9);
      border-radius: 16px;
      border: 1px solid #b7dfc8;
    }
  </style>
</head>
<body class="bg-light">

  <?php require('inc/header.php'); ?>

  <!-- Hero Section -->
  <div class="service-hero">
    <div class="container text-center">
      <span class="section-badge"><i class="bi bi-stars me-1"></i> Trải nghiệm đẳng cấp</span>
      <h1 class="fw-bold display-5 mb-3">Dịch Vụ Của Chúng Tôi</h1>
      <p class="lead mb-0 opacity-75">Chúng tôi cam kết mang đến trải nghiệm nghỉ dưỡng hoàn hảo tại Hạ Long với đầy đủ dịch vụ tiện ích cao cấp</p>
    </div>
  </div>

  <!-- Dịch vụ nổi bật -->
  <div class="container my-5">
    <h2 class="fw-bold h-font text-center mb-2">Dịch Vụ Nổi Bật</h2>
    <div class="h-line bg-dark mb-5"></div>

    <div class="row g-4">

      <div class="col-lg-4 col-md-6">
        <div class="card service-card h-100 text-center p-4">
          <div class="service-icon-wrap">
            <i class="bi bi-water"></i>
          </div>
          <h5 class="fw-bold mb-2">Tour Du Thuyền Vịnh Hạ Long</h5>
          <p class="text-muted">Khám phá vẻ đẹp huyền ảo của Vịnh Hạ Long qua các chuyến du thuyền cao cấp. Ngắm hoàng hôn tuyệt đẹp trên vịnh và trải nghiệm cuộc sống biển đảo độc đáo.</p>
          <div class="mt-auto pt-3">
            <span class="badge bg-success-subtle text-success rounded-pill px-3 py-2">
              <i class="bi bi-clock me-1"></i> Nguyên ngày / Nửa ngày
            </span>
          </div>
        </div>
      </div>

      <div class="col-lg-4 col-md-6">
        <div class="card service-card h-100 text-center p-4">
          <div class="service-icon-wrap">
            <i class="bi bi-flower2"></i>
          </div>
          <h5 class="fw-bold mb-2">Spa & Chăm Sóc Sức Khỏe</h5>
          <p class="text-muted">Thư giãn và tái tạo năng lượng với các liệu pháp spa truyền thống Việt Nam kết hợp kỹ thuật hiện đại. Massage đá nóng, liệu pháp thảo mộc và chăm sóc da cao cấp.</p>
          <div class="mt-auto pt-3">
            <span class="badge bg-success-subtle text-success rounded-pill px-3 py-2">
              <i class="bi bi-calendar-check me-1"></i> Đặt lịch trước 2 giờ
            </span>
          </div>
        </div>
      </div>

      <div class="col-lg-4 col-md-6">
        <div class="card service-card h-100 text-center p-4">
          <div class="service-icon-wrap">
            <i class="bi bi-cup-hot-fill"></i>
          </div>
          <h5 class="fw-bold mb-2">Nhà Hàng & Ẩm Thực</h5>
          <p class="text-muted">Thưởng thức các món hải sản tươi sống đặc trưng Hạ Long, ẩm thực Việt Nam truyền thống và các món quốc tế được chế biến bởi đầu bếp chuyên nghiệp.</p>
          <div class="mt-auto pt-3">
            <span class="badge bg-success-subtle text-success rounded-pill px-3 py-2">
              <i class="bi bi-clock me-1"></i> 6:00 - 22:00 hàng ngày
            </span>
          </div>
        </div>
      </div>

      <div class="col-lg-4 col-md-6">
        <div class="card service-card h-100 text-center p-4">
          <div class="service-icon-wrap">
            <i class="bi bi-car-front-fill"></i>
          </div>
          <h5 class="fw-bold mb-2">Đưa Đón Sân Bay / Bến Cảng</h5>
          <p class="text-muted">Dịch vụ đưa đón tận nơi từ sân bay Vân Đồn, ga tàu Hạ Long và các bến cảng. Xe đời mới, tài xế chuyên nghiệp, đảm bảo an toàn và đúng giờ.</p>
          <div class="mt-auto pt-3">
            <span class="badge bg-success-subtle text-success rounded-pill px-3 py-2">
              <i class="bi bi-telephone me-1"></i> Đặt xe trước 24 giờ
            </span>
          </div>
        </div>
      </div>

      <div class="col-lg-4 col-md-6">
        <div class="card service-card h-100 text-center p-4">
          <div class="service-icon-wrap">
            <i class="bi bi-bicycle"></i>
          </div>
          <h5 class="fw-bold mb-2">Thuê Xe & Khám Phá Địa Phương</h5>
          <p class="text-muted">Cho thuê xe đạp, xe máy và ô tô để tự do khám phá thành phố Hạ Long, làng chài Cửa Vạn và các điểm tham quan lân cận theo lịch trình riêng của bạn.</p>
          <div class="mt-auto pt-3">
            <span class="badge bg-success-subtle text-success rounded-pill px-3 py-2">
              <i class="bi bi-calendar me-1"></i> Theo giờ / ngày / tuần
            </span>
          </div>
        </div>
      </div>

      <div class="col-lg-4 col-md-6">
        <div class="card service-card h-100 text-center p-4">
          <div class="service-icon-wrap">
            <i class="bi bi-people-fill"></i>
          </div>
          <h5 class="fw-bold mb-2">Hướng Dẫn Viên Du Lịch</h5>
          <p class="text-muted">Hướng dẫn viên địa phương am hiểu văn hóa, lịch sử Hạ Long, nói được nhiều ngôn ngữ (Anh, Hàn, Trung). Đảm bảo chuyến đi ý nghĩa và trọn vẹn.</p>
          <div class="mt-auto pt-3">
            <span class="badge bg-success-subtle text-success rounded-pill px-3 py-2">
              <i class="bi bi-translate me-1"></i> Đa ngôn ngữ
            </span>
          </div>
        </div>
      </div>

      <div class="col-lg-4 col-md-6">
        <div class="card service-card h-100 text-center p-4">
          <div class="service-icon-wrap">
            <i class="bi bi-laptop-fill"></i>
          </div>
          <h5 class="fw-bold mb-2">Phòng Họp & Sự Kiện</h5>
          <p class="text-muted">Không gian hội nghị chuyên nghiệp với trang bị hiện đại, sức chứa linh hoạt từ 20 đến 200 người. Phù hợp cho hội thảo doanh nghiệp, tiệc cưới và sự kiện đặc biệt.</p>
          <div class="mt-auto pt-3">
            <span class="badge bg-success-subtle text-success rounded-pill px-3 py-2">
              <i class="bi bi-headset me-1"></i> Hỗ trợ kỹ thuật 24/7
            </span>
          </div>
        </div>
      </div>

      <div class="col-lg-4 col-md-6">
        <div class="card service-card h-100 text-center p-4">
          <div class="service-icon-wrap">
            <i class="bi bi-droplet-fill"></i>
          </div>
          <h5 class="fw-bold mb-2">Hồ Bơi Ngoài Trời</h5>
          <p class="text-muted">Hồ bơi vô cực view biển tuyệt đẹp, khu vực hồ bơi trẻ em an toàn, quầy bar poolside phục vụ cocktail và đồ uống nhiệt đới. Mở cửa từ 7:00 đến 21:00.</p>
          <div class="mt-auto pt-3">
            <span class="badge bg-success-subtle text-success rounded-pill px-3 py-2">
              <i class="bi bi-sun me-1"></i> Miễn phí cho khách lưu trú
            </span>
          </div>
        </div>
      </div>

      <div class="col-lg-4 col-md-6">
        <div class="card service-card h-100 text-center p-4">
          <div class="service-icon-wrap">
            <i class="bi bi-bag-heart-fill"></i>
          </div>
          <h5 class="fw-bold mb-2">Quà Tặng & Lưu Niệm Hạ Long</h5>
          <p class="text-muted">Cửa hàng lưu niệm ngay tại khách sạn với các sản phẩm đặc trưng Hạ Long: ngọc trai, san hô, tranh sơn mài, đặc sản đóng gói và quà tặng cao cấp.</p>
          <div class="mt-auto pt-3">
            <span class="badge bg-success-subtle text-success rounded-pill px-3 py-2">
              <i class="bi bi-shop me-1"></i> Mở cửa 8:00 - 21:00
            </span>
          </div>
        </div>
      </div>

    </div>
  </div>

  <!-- Cam kết chất lượng -->
  <div class="container my-5">
    <div class="highlight-box p-5 text-center">
      <i class="bi bi-patch-check-fill text-success fs-1 mb-3 d-block"></i>
      <h3 class="fw-bold h-font mb-3">Cam Kết Của Chúng Tôi</h3>
      <div class="row g-4 mt-2">
        <div class="col-md-3">
          <i class="bi bi-shield-check fs-2 text-success mb-2 d-block"></i>
          <h6 class="fw-bold">An Toàn Tuyệt Đối</h6>
          <p class="text-muted small">Hệ thống camera an ninh 24/7, nhân viên bảo vệ chuyên nghiệp</p>
        </div>
        <div class="col-md-3">
          <i class="bi bi-star-fill fs-2 text-success mb-2 d-block"></i>
          <h6 class="fw-bold">Chất Lượng 5 Sao</h6>
          <p class="text-muted small">Tiêu chuẩn dịch vụ quốc tế, đào tạo nhân viên chuyên nghiệp</p>
        </div>
        <div class="col-md-3">
          <i class="bi bi-headset fs-2 text-success mb-2 d-block"></i>
          <h6 class="fw-bold">Hỗ Trợ 24/7</h6>
          <p class="text-muted small">Đội ngũ hỗ trợ sẵn sàng phục vụ mọi lúc mọi nơi</p>
        </div>
        <div class="col-md-3">
          <i class="bi bi-currency-dollar fs-2 text-success mb-2 d-block"></i>
          <h6 class="fw-bold">Giá Tốt Nhất</h6>
          <p class="text-muted small">Đảm bảo giá tốt nhất, hoàn tiền nếu tìm thấy giá rẻ hơn</p>
        </div>
      </div>
    </div>
  </div>

  <?php require('inc/footer.php'); ?>

</body>
</html>
