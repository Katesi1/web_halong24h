<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <?php require('inc/links.php'); ?>
  <title><?php echo $settings_r['site_title'] ?> - Blog Cẩm Nang Du Lịch Hạ Long</title>
  <style>
    .blog-hero {
      background: linear-gradient(135deg, #0a2342 0%, #1a4480 50%, #2563b0 100%);
      padding: 80px 0 60px;
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
    .article-card {
      border-radius: 16px;
      overflow: hidden;
      border: none;
      box-shadow: 0 4px 15px rgba(0,0,0,0.08);
      transition: all 0.35s ease;
    }
    .article-card:hover {
      transform: translateY(-6px);
      box-shadow: 0 15px 35px rgba(26,68,128,0.15);
    }
    .article-img {
      height: 220px;
      object-fit: cover;
      background: linear-gradient(135deg, #c5d8f5, #a8c4e8);
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 70px;
    }
    .article-tag {
      display: inline-block;
      padding: 4px 12px;
      border-radius: 20px;
      font-size: 12px;
      font-weight: 600;
    }
    .tag-guide { background: #e8f4f8; color: #1a4480; }
    .tag-attraction { background: #e8f8e8; color: #1a6628; }
    .tag-food { background: #fff3e0; color: #b45309; }
    .tag-tip { background: #fce8e8; color: #c62828; }
    .tag-adventure { background: #ede8fd; color: #5c35b5; }
    .tag-culture { background: #fce8f5; color: #9c2780; }
    .featured-article {
      border-radius: 20px;
      overflow: hidden;
      box-shadow: 0 8px 30px rgba(0,0,0,0.12);
    }
    .featured-img {
      height: 420px;
      background: linear-gradient(135deg, #0a2342, #1a4480);
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 120px;
    }
    .sidebar-card {
      border-radius: 12px;
      border: none;
      box-shadow: 0 4px 15px rgba(0,0,0,0.06);
    }
    .sidebar-item {
      border-bottom: 1px solid #f0f0f0;
      transition: all 0.2s;
    }
    .sidebar-item:hover {
      background: #f8f9ff;
      padding-left: 8px !important;
    }
    .sidebar-item:last-child {
      border-bottom: none;
    }
    .article-full {
      display: none;
    }
    .article-full.show {
      display: block;
    }
    .read-more-btn {
      color: #1a4480;
      font-weight: 600;
      cursor: pointer;
      border: none;
      background: none;
      padding: 0;
      text-decoration: underline;
    }
    .article-detail-overlay {
      display: none;
      position: fixed;
      top: 0; left: 0; right: 0; bottom: 0;
      background: rgba(0,0,0,0.6);
      z-index: 9000;
      overflow-y: auto;
    }
    .article-detail-overlay.show {
      display: flex;
      align-items: flex-start;
      justify-content: center;
      padding: 40px 16px;
    }
    .article-detail-box {
      background: white;
      border-radius: 20px;
      max-width: 800px;
      width: 100%;
      padding: 40px;
      position: relative;
    }
    .close-detail {
      position: absolute;
      top: 20px;
      right: 20px;
      background: #f0f0f0;
      border: none;
      border-radius: 50%;
      width: 36px;
      height: 36px;
      cursor: pointer;
      font-size: 18px;
      display: flex;
      align-items: center;
      justify-content: center;
    }
    .season-badge {
      border-radius: 8px;
      padding: 12px 16px;
      margin-bottom: 8px;
    }
    .faq-item {
      border-radius: 12px;
      border: 1px solid #e9ecef;
      margin-bottom: 10px;
      overflow: hidden;
    }
    .faq-question {
      background: #f8f9ff;
      padding: 16px 20px;
      cursor: pointer;
      font-weight: 600;
      display: flex;
      justify-content: space-between;
      align-items: center;
    }
    .faq-answer {
      padding: 16px 20px;
      display: none;
      color: #666;
      line-height: 1.7;
    }
    .faq-answer.show {
      display: block;
    }
  </style>
</head>
<body class="bg-light">

  <?php require('inc/header.php'); ?>

  <!-- Hero -->
  <div class="blog-hero">
    <div class="container text-center">
      <span class="section-badge"><i class="bi bi-journal-richtext me-1"></i> Cẩm nang du lịch</span>
      <h1 class="fw-bold display-5 mb-3">Blog Cẩm Nang Hạ Long</h1>
      <p class="lead mb-4 opacity-75">Tất cả thông tin bạn cần biết để có chuyến du lịch Hạ Long hoàn hảo — từ điểm tham quan, ẩm thực đến mẹo đặt phòng tiết kiệm</p>
      <div class="row justify-content-center g-3">
        <div class="col-auto">
          <span class="badge bg-white text-dark px-3 py-2 rounded-pill">
            <i class="bi bi-compass me-1 text-primary"></i> Điểm tham quan
          </span>
        </div>
        <div class="col-auto">
          <span class="badge bg-white text-dark px-3 py-2 rounded-pill">
            <i class="bi bi-egg-fried me-1 text-warning"></i> Ẩm thực
          </span>
        </div>
        <div class="col-auto">
          <span class="badge bg-white text-dark px-3 py-2 rounded-pill">
            <i class="bi bi-lightbulb me-1 text-danger"></i> Kinh nghiệm
          </span>
        </div>
        <div class="col-auto">
          <span class="badge bg-white text-dark px-3 py-2 rounded-pill">
            <i class="bi bi-calendar-event me-1 text-success"></i> Lịch trình
          </span>
        </div>
      </div>
    </div>
  </div>

  <!-- Bài viết nổi bật -->
  <div class="container my-5">

    <div class="row g-4">

      <!-- Main content -->
      <div class="col-lg-8">

        <!-- Featured article 1 -->
        <div class="featured-article mb-5" id="article-1">
          <div class="featured-img">🌊</div>
          <div class="card border-0 rounded-0 rounded-bottom p-4">
            <div class="mb-2">
              <span class="article-tag tag-guide">Cẩm nang tổng hợp</span>
              <span class="text-muted small ms-2"><i class="bi bi-calendar3 me-1"></i>Cập nhật 2025</span>
              <span class="text-muted small ms-2"><i class="bi bi-clock me-1"></i>10 phút đọc</span>
            </div>
            <h2 class="fw-bold h-font">Vịnh Hạ Long — Bí Kíp Khám Phá Toàn Diện Từ A Đến Z</h2>
            <p class="text-muted lh-lg">Vịnh Hạ Long là Di sản Thiên nhiên Thế giới được UNESCO công nhận hai lần (1994 và 2000), nằm ở tỉnh Quảng Ninh, cách Hà Nội khoảng 170km về phía Đông Bắc. Với hơn 1.600 hòn đảo đá vôi, diện tích khoảng 1.553 km², đây là một trong những kỳ quan thiên nhiên đẹp nhất thế giới...</p>

            <!-- Full content -->
            <div id="full-1" style="display:none">
              <hr>
              <h4 class="fw-bold mt-3">🗺️ Tổng Quan Về Vịnh Hạ Long</h4>
              <p class="text-muted lh-lg">Vịnh Hạ Long trải dài qua địa phận các huyện Vân Đồn và Cẩm Phả thuộc tỉnh Quảng Ninh. Tên gọi "Hạ Long" theo truyền thuyết có nghĩa là "Rồng hạ xuống" — gắn liền với huyền thoại về đàn rồng thần từ trời cao xuống trần gian để giúp người Việt chống giặc ngoại xâm. Những hòn đảo kỳ vĩ chính là những viên ngọc từ miệng rồng phun ra tạo thành bức tường thành kiên cố.</p>

              <h4 class="fw-bold mt-4">📍 Các Điểm Tham Quan Nổi Bật</h4>
              <div class="row g-3 mb-3">
                <div class="col-md-6">
                  <div class="bg-light rounded-3 p-3">
                    <h6 class="fw-bold"><i class="bi bi-geo-alt-fill text-primary me-2"></i>Hang Sửng Sốt (Surprising Cave)</h6>
                    <p class="small text-muted mb-0">Hang động lớn và đẹp nhất vịnh Hạ Long, chia làm 3 ngăn với thạch nhũ kỳ ảo. Sức chứa 1.000 người.</p>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="bg-light rounded-3 p-3">
                    <h6 class="fw-bold"><i class="bi bi-geo-alt-fill text-primary me-2"></i>Đảo Ti Tốp</h6>
                    <p class="small text-muted mb-0">Bãi tắm cát trắng đẹp, leo đỉnh đảo ngắm toàn cảnh vịnh 360 độ tuyệt đẹp. Phù hợp cắm trại.</p>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="bg-light rounded-3 p-3">
                    <h6 class="fw-bold"><i class="bi bi-geo-alt-fill text-primary me-2"></i>Làng Chài Cửa Vạn</h6>
                    <p class="small text-muted mb-0">Làng chài nổi lâu đời nhất vịnh Hạ Long với hàng trăm hộ dân sinh sống trên bè nổi độc đáo.</p>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="bg-light rounded-3 p-3">
                    <h6 class="fw-bold"><i class="bi bi-geo-alt-fill text-primary me-2"></i>Hang Thien Cung</h6>
                    <p class="small text-muted mb-0">Thiên Cung nghĩa là "Cung Điện Trời" — hang động rực rỡ màu sắc với thạch nhũ muôn hình muôn vẻ.</p>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="bg-light rounded-3 p-3">
                    <h6 class="fw-bold"><i class="bi bi-geo-alt-fill text-primary me-2"></i>Đảo Quan Lạn & Minh Châu</h6>
                    <p class="small text-muted mb-0">Bãi biển hoang sơ tuyệt đẹp, nước xanh trong như pha lê, cát trắng mịn — thiên đường biển đảo ít người biết.</p>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="bg-light rounded-3 p-3">
                    <h6 class="fw-bold"><i class="bi bi-geo-alt-fill text-primary me-2"></i>Khu Du Lịch Tuần Châu</h6>
                    <p class="small text-muted mb-0">Đảo nhân tạo lớn với công viên giải trí, bãi tắm, casino, sân golf và các show diễn ngoài trời hoành tráng.</p>
                  </div>
                </div>
              </div>

              <h4 class="fw-bold mt-4">🎯 Kinh Nghiệm Tham Quan</h4>
              <ul class="text-muted lh-lg">
                <li class="mb-2">Đặt tour du thuyền qua đêm để có trải nghiệm đầy đủ nhất — ngắm hoàng hôn, bình minh và bơi lặn giữa vịnh.</li>
                <li class="mb-2">Mang theo kem chống nắng, mũ và áo khoác nhẹ vì thời tiết vịnh có thể thay đổi đột ngột.</li>
                <li class="mb-2">Thuê kayak để khám phá các hang động ngầm và góc khuất bí ẩn mà tàu lớn không vào được.</li>
                <li class="mb-2">Nên đặt tour với công ty uy tín, kiểm tra kỹ thiết bị an toàn trên tàu trước khi khởi hành.</li>
                <li>Mang theo tiền mặt đủ vì nhiều điểm bán hàng trên đảo không chấp nhận thẻ.</li>
              </ul>
            </div>

            <button class="read-more-btn mt-2" onclick="toggleArticle('full-1', this)">
              Xem đầy đủ <i class="bi bi-chevron-down"></i>
            </button>
          </div>
        </div>

        <!-- Article grid -->
        <h3 class="fw-bold h-font mb-4">Bài Viết Mới Nhất</h3>
        <div class="row g-4">

          <!-- Article 2 -->
          <div class="col-md-6">
            <div class="card article-card h-100">
              <div class="article-img">🗓️</div>
              <div class="card-body p-4">
                <span class="article-tag tag-tip">Kinh nghiệm</span>
                <h5 class="fw-bold mt-2">Hạ Long Nên Đi Mùa Nào? Lịch Du Lịch Theo Từng Tháng</h5>
                <p class="text-muted small">Hạ Long đẹp quanh năm nhưng mỗi mùa lại có vẻ đẹp riêng. Bài viết này phân tích chi tiết thời tiết, ưu nhược điểm của từng mùa để bạn chọn thời điểm phù hợp nhất...</p>

                <div id="full-2" style="display:none">
                  <hr>
                  <div class="season-badge bg-success-subtle mb-2">
                    <strong class="text-success">🌸 Mùa Xuân (Tháng 3 – 5)</strong>
                    <p class="small mb-0 mt-1 text-muted">Thời tiết mát mẻ, ấm áp, ít mưa. Đây là thời điểm lý tưởng nhất để du lịch Hạ Long. Biển trong xanh, tầm nhìn tốt, lý tưởng cho chụp ảnh. Nhiệt độ 20-28°C.</p>
                  </div>
                  <div class="season-badge bg-warning-subtle mb-2">
                    <strong class="text-warning">☀️ Mùa Hè (Tháng 6 – 8)</strong>
                    <p class="small mb-0 mt-1 text-muted">Nóng và có mưa nhiều, đôi khi có bão. Nhưng đây là mùa cao điểm vì học sinh được nghỉ hè. Nhiều dịch vụ hoạt động nhộn nhịp. Nhiệt độ 28-35°C, cần theo dõi thời tiết.</p>
                  </div>
                  <div class="season-badge bg-info-subtle mb-2">
                    <strong class="text-info">🍂 Mùa Thu (Tháng 9 – 11)</strong>
                    <p class="small mb-0 mt-1 text-muted">Khí hậu mát dịu, biển lặng, đây là mùa đẹp thứ hai để đến Hạ Long. Tháng 10 là tháng hoàn hảo nhất — ít mưa, nhiều nắng, biển xanh. Nhiệt độ 22-28°C.</p>
                  </div>
                  <div class="season-badge bg-secondary-subtle">
                    <strong class="text-secondary">❄️ Mùa Đông (Tháng 12 – 2)</strong>
                    <p class="small mb-0 mt-1 text-muted">Lạnh và hay có sương mù tạo nên cảnh quan huyền bí đẹp như tranh. Ít khách du lịch nên giá phòng rẻ hơn. Cần mang áo ấm. Nhiệt độ 10-18°C, thỉnh thoảng dưới 10°C.</p>
                  </div>
                  <p class="text-muted small mt-2">💡 <strong>Gợi ý tốt nhất:</strong> Tháng 4, 5 và tháng 10, 11 là thời điểm lý tưởng nhất để du lịch Hạ Long — thời tiết đẹp, đỡ đông và giá cả hợp lý.</p>
                </div>

                <button class="read-more-btn mt-2" onclick="toggleArticle('full-2', this)">
                  Đọc thêm <i class="bi bi-chevron-down"></i>
                </button>
              </div>
            </div>
          </div>

          <!-- Article 3 -->
          <div class="col-md-6">
            <div class="card article-card h-100">
              <div class="article-img">🗺️</div>
              <div class="card-body p-4">
                <span class="article-tag tag-guide">Lịch trình</span>
                <h5 class="fw-bold mt-2">Lịch Trình 2N1Đ và 3N2Đ Hạ Long Chi Tiết</h5>
                <p class="text-muted small">Gợi ý lịch trình du lịch Hạ Long tối ưu cho từng loại hành khách — gia đình, cặp đôi, nhóm bạn trẻ. Đã bao gồm điểm đến, giờ giấc và ước tính chi phí...</p>

                <div id="full-3" style="display:none">
                  <hr>
                  <h6 class="fw-bold text-primary">📅 Lịch Trình 2 Ngày 1 Đêm (Tour Nghỉ Đêm Trên Vịnh)</h6>
                  <p class="small text-muted"><strong>Ngày 1:</strong> 8:00 Tập trung cảng, 12:00 Ăn trưa trên tàu giữa vịnh, 14:00 Thăm Hang Sửng Sốt, 15:30 Bơi lặn tại Đảo Ti Tốp, 18:00 Hoàng hôn vịnh + BBQ trên boong.</p>
                  <p class="small text-muted"><strong>Ngày 2:</strong> 6:00 Ngắm bình minh, 7:30 Tập Thái Cực Quyền trên boong, 8:30 Ăn sáng, 9:30 Kayak hang động, 11:00 Thăm làng chài Cửa Vạn, 12:30 Ăn trưa trở về cảng.</p>

                  <h6 class="fw-bold text-success mt-3">📅 Lịch Trình 3 Ngày 2 Đêm (Khám Phá Đầy Đủ)</h6>
                  <p class="small text-muted"><strong>Ngày 1:</strong> Di chuyển từ Hà Nội đến Hạ Long (Xe khách 3.5 giờ), nhận phòng, khám phá phố đi bộ, ăn tối đặc sản, chợ đêm.</p>
                  <p class="small text-muted"><strong>Ngày 2:</strong> Tour nghỉ đêm trên vịnh — hang động, bơi lặn, kayak, làng chài, hoàng hôn, bình minh.</p>
                  <p class="small text-muted"><strong>Ngày 3:</strong> Tham quan Tuần Châu, mua đặc sản, trả phòng, trở về Hà Nội.</p>

                  <div class="bg-light rounded p-3 mt-2">
                    <p class="small mb-0"><strong>💰 Ước tính chi phí (1 người):</strong><br>
                    2N1Đ: 2.500.000 – 4.500.000 VNĐ<br>
                    3N2Đ: 4.000.000 – 7.000.000 VNĐ<br>
                    <em>(Tùy hạng phòng, loại tàu và dịch vụ chọn)</em></p>
                  </div>
                </div>

                <button class="read-more-btn mt-2" onclick="toggleArticle('full-3', this)">
                  Đọc thêm <i class="bi bi-chevron-down"></i>
                </button>
              </div>
            </div>
          </div>

          <!-- Article 4 -->
          <div class="col-md-6">
            <div class="card article-card h-100">
              <div class="article-img">🚌</div>
              <div class="card-body p-4">
                <span class="article-tag tag-tip">Phương tiện</span>
                <h5 class="fw-bold mt-2">Cách Di Chuyển Đến Hạ Long — Tất Cả Phương Tiện</h5>
                <p class="text-muted small">Từ Hà Nội, TP.HCM, Đà Nẵng và các tỉnh thành khác đến Hạ Long bằng phương tiện nào là nhanh nhất, tiết kiệm nhất? So sánh chi tiết các lựa chọn...</p>

                <div id="full-4" style="display:none">
                  <hr>
                  <div class="mb-3">
                    <h6 class="fw-bold"><i class="bi bi-bus-front-fill text-primary me-2"></i>Xe Khách / Limousine (Từ Hà Nội)</h6>
                    <p class="small text-muted mb-0">Phổ biến nhất. Thời gian: 3-4 giờ. Chi phí: 150.000-300.000 VNĐ/chiều. Có nhiều hãng uy tín: Kumho Việt Thanh, Hải Vân, Phương Trang, Hà Lâm. Lưu ý tránh xe dù không rõ nguồn gốc.</p>
                  </div>
                  <div class="mb-3">
                    <h6 class="fw-bold"><i class="bi bi-airplane-fill text-success me-2"></i>Máy Bay (Từ TP.HCM / Đà Nẵng)</h6>
                    <p class="small text-muted mb-0">Bay đến sân bay Vân Đồn (VDO) — sân bay quốc tế gần nhất, cách trung tâm Hạ Long 50km. Vietjet, Bamboo Airways khai thác đường bay này. Thời gian bay 2 giờ từ TP.HCM.</p>
                  </div>
                  <div class="mb-3">
                    <h6 class="fw-bold"><i class="bi bi-train-front-fill text-warning me-2"></i>Tàu Cao Tốc (Đường Thủy)</h6>
                    <p class="small text-muted mb-0">Tàu cao tốc từ Tuần Châu đến đảo Cô Tô, Quan Lạn, Vân Đồn. Thời gian: 2-3 giờ. Trải nghiệm thú vị ngắm cảnh vịnh dọc đường.</p>
                  </div>
                  <div>
                    <h6 class="fw-bold"><i class="bi bi-car-front-fill text-danger me-2"></i>Tự Lái Xe / Thuê Xe</h6>
                    <p class="small text-muted mb-0">Đường cao tốc Hà Nội – Hạ Long dài 170km, đi trong 2.5 giờ qua cao tốc Nội Bài – Hạ Long. Thuê xe có tài xế khoảng 800.000 – 1.200.000 VNĐ/ngày.</p>
                  </div>
                </div>

                <button class="read-more-btn mt-2" onclick="toggleArticle('full-4', this)">
                  Đọc thêm <i class="bi bi-chevron-down"></i>
                </button>
              </div>
            </div>
          </div>

          <!-- Article 5 -->
          <div class="col-md-6">
            <div class="card article-card h-100">
              <div class="article-img">🏨</div>
              <div class="card-body p-4">
                <span class="article-tag tag-guide">Lưu trú</span>
                <h5 class="fw-bold mt-2">Nên Ở Đâu Tại Hạ Long? Bãi Cháy Hay Hòn Gai?</h5>
                <p class="text-muted small">Hai khu vực chính của thành phố Hạ Long có đặc điểm rất khác nhau. Bài viết so sánh chi tiết để bạn chọn được vị trí lưu trú phù hợp với nhu cầu và ngân sách...</p>

                <div id="full-5" style="display:none">
                  <hr>
                  <div class="row g-3">
                    <div class="col-12">
                      <div class="bg-primary-subtle rounded-3 p-3">
                        <h6 class="fw-bold text-primary">🏖️ Khu Bãi Cháy</h6>
                        <p class="small text-muted mb-1">Khu du lịch náo nhiệt hơn, nhiều khách sạn resort cao cấp, gần cảng tàu du lịch, nhiều nhà hàng và điểm vui chơi giải trí. Phù hợp cho gia đình, cặp đôi muốn tiện nghi đầy đủ.</p>
                        <p class="small mb-0"><strong>Điểm nổi bật:</strong> Gần cảng Tuần Châu, view biển đẹp, nhiều lựa chọn ăn uống đêm, công viên Sun World Hạ Long</p>
                      </div>
                    </div>
                    <div class="col-12">
                      <div class="bg-success-subtle rounded-3 p-3">
                        <h6 class="fw-bold text-success">🏙️ Khu Hòn Gai</h6>
                        <p class="small text-muted mb-1">Khu trung tâm hành chính của thành phố, đậm chất đời thường địa phương hơn. Giá phòng hợp lý, gần chợ, bến cảng, văn phòng dịch vụ. Phù hợp khách du lịch tự túc muốn hòa mình vào cuộc sống địa phương.</p>
                        <p class="small mb-0"><strong>Điểm nổi bật:</strong> Gần chợ Hạ Long, bến cảng tàu, phố ẩm thực bình dân, giá tốt hơn</p>
                      </div>
                    </div>
                  </div>
                  <p class="small text-muted mt-3 mb-0">💡 <strong>Gợi ý:</strong> Cặp đôi và gia đình có ngân sách tốt → Bãi Cháy. Nhóm bạn trẻ, khách du lịch tự túc → Hòn Gai.</p>
                </div>

                <button class="read-more-btn mt-2" onclick="toggleArticle('full-5', this)">
                  Đọc thêm <i class="bi bi-chevron-down"></i>
                </button>
              </div>
            </div>
          </div>

          <!-- Article 6 -->
          <div class="col-md-6">
            <div class="card article-card h-100">
              <div class="article-img">🎭</div>
              <div class="card-body p-4">
                <span class="article-tag tag-culture">Văn hóa</span>
                <h5 class="fw-bold mt-2">Lễ Hội & Sự Kiện Văn Hóa Đặc Sắc Tại Hạ Long</h5>
                <p class="text-muted small">Hạ Long không chỉ có thiên nhiên hùng vĩ — nơi đây còn sôi động với các lễ hội truyền thống đặc sắc, sự kiện âm nhạc, bắn pháo hoa và nhiều hoạt động văn hóa hấp dẫn...</p>

                <div id="full-6" style="display:none">
                  <hr>
                  <div class="mb-3">
                    <h6 class="fw-bold"><i class="bi bi-stars text-warning me-2"></i>Lễ Hội Carnaval Hạ Long (Tháng 4-5)</h6>
                    <p class="small text-muted mb-0">Lễ hội thường niên hoành tráng nhất tỉnh Quảng Ninh với diễu hành đường phố, biểu diễn nghệ thuật, bắn pháo hoa và nhiều hoạt động vui chơi giải trí. Thu hút hàng trăm nghìn du khách mỗi năm.</p>
                  </div>
                  <div class="mb-3">
                    <h6 class="fw-bold"><i class="bi bi-water text-primary me-2"></i>Lễ Hội Đua Thuyền (Mùng 2 Tháng 1 Âm Lịch)</h6>
                    <p class="small text-muted mb-0">Lễ hội đua thuyền truyền thống của ngư dân vùng biển, diễn ra sôi nổi trên mặt vịnh. Nghi lễ cầu ngư cầu mong mùa đánh bắt bội thu, an toàn ra khơi.</p>
                  </div>
                  <div class="mb-3">
                    <h6 class="fw-bold"><i class="bi bi-sunrise text-success me-2"></i>Festival Hạ Long (Định kỳ 2 năm/lần)</h6>
                    <p class="small text-muted mb-0">Sự kiện văn hóa du lịch quốc tế quy mô lớn với triển lãm, hội thảo, biểu diễn nghệ thuật quốc tế và hoạt động giới thiệu văn hóa Quảng Ninh.</p>
                  </div>
                  <div>
                    <h6 class="fw-bold"><i class="bi bi-balloon-fill text-danger me-2"></i>Pháo Hoa Giao Thừa & Dịp Lễ Lớn</h6>
                    <p class="small text-muted mb-0">Bãi Cháy và công viên ven vịnh là điểm xem pháo hoa đẹp nhất mỗi dịp Tết Nguyên Đán, Quốc Khánh 2/9 và các lễ hội lớn của thành phố.</p>
                  </div>
                </div>

                <button class="read-more-btn mt-2" onclick="toggleArticle('full-6', this)">
                  Đọc thêm <i class="bi bi-chevron-down"></i>
                </button>
              </div>
            </div>
          </div>

          <!-- Article 7 -->
          <div class="col-md-6">
            <div class="card article-card h-100">
              <div class="article-img">🧗</div>
              <div class="card-body p-4">
                <span class="article-tag tag-adventure">Phiêu lưu</span>
                <h5 class="fw-bold mt-2">Top Hoạt Động Mạo Hiểm & Thể Thao Tại Vịnh Hạ Long</h5>
                <p class="text-muted small">Hạ Long không chỉ để ngắm nhìn — hãy trải nghiệm những hoạt động phiêu lưu hấp dẫn như leo núi đá vôi, lặn biển, kite surfing và chèo thuyền kayak qua hang động...</p>

                <div id="full-7" style="display:none">
                  <hr>
                  <div class="row g-2">
                    <div class="col-6">
                      <div class="text-center bg-light rounded-3 p-3">
                        <div class="fs-3">🚣</div>
                        <h6 class="fw-bold small mt-1">Chèo Kayak</h6>
                        <p class="small text-muted mb-0">Khám phá hang động ngầm, lagoon kín</p>
                      </div>
                    </div>
                    <div class="col-6">
                      <div class="text-center bg-light rounded-3 p-3">
                        <div class="fs-3">🤿</div>
                        <h6 class="fw-bold small mt-1">Lặn Biển (Snorkel/Scuba)</h6>
                        <p class="small text-muted mb-0">San hô, cá nhiệt đới tại Cô Tô, Quan Lạn</p>
                      </div>
                    </div>
                    <div class="col-6">
                      <div class="text-center bg-light rounded-3 p-3">
                        <div class="fs-3">🧗</div>
                        <h6 class="fw-bold small mt-1">Leo Núi Đá Vôi</h6>
                        <p class="small text-muted mb-0">Đảo Ti Tốp, Núi Bài Thơ Hạ Long</p>
                      </div>
                    </div>
                    <div class="col-6">
                      <div class="text-center bg-light rounded-3 p-3">
                        <div class="fs-3">🎣</div>
                        <h6 class="fw-bold small mt-1">Câu Cá & Mực Đêm</h6>
                        <p class="small text-muted mb-0">Trải nghiệm đánh cá cùng ngư dân</p>
                      </div>
                    </div>
                  </div>
                  <p class="small text-muted mt-3 mb-0">💡 Các hoạt động này đều có sẵn trong gói tour du thuyền qua đêm. Đặt trước ít nhất 1 ngày tại lễ tân hoặc qua app du lịch.</p>
                </div>

                <button class="read-more-btn mt-2" onclick="toggleArticle('full-7', this)">
                  Đọc thêm <i class="bi bi-chevron-down"></i>
                </button>
              </div>
            </div>
          </div>

          <!-- Article 8 -->
          <div class="col-md-6">
            <div class="card article-card h-100">
              <div class="article-img">💰</div>
              <div class="card-body p-4">
                <span class="article-tag tag-tip">Tiết kiệm</span>
                <h5 class="fw-bold mt-2">Bí Quyết Du Lịch Hạ Long Tiết Kiệm Không Lo Tốn Kém</h5>
                <p class="text-muted small">10 mẹo vàng giúp bạn có chuyến du lịch Hạ Long chất lượng với chi phí tối ưu — từ đặt phòng, đặt tour đến ăn uống và mua sắm đặc sản...</p>

                <div id="full-8" style="display:none">
                  <hr>
                  <ol class="text-muted small ps-3">
                    <li class="mb-2"><strong>Đặt phòng sớm:</strong> Đặt trước 2-4 tuần để có giá tốt nhất, đặc biệt dịp lễ và hè.</li>
                    <li class="mb-2"><strong>Đi ngày thường:</strong> Thứ 2 đến Thứ 5 thường rẻ hơn 20-30% so với cuối tuần.</li>
                    <li class="mb-2"><strong>So sánh tour:</strong> Liên hệ ít nhất 3-5 công ty tour để so sánh trước khi quyết định.</li>
                    <li class="mb-2"><strong>Ăn ở chợ địa phương:</strong> Bữa sáng và ăn vặt tại chợ bình dân ngon hơn và rẻ hơn nhiều so với nhà hàng ven biển.</li>
                    <li class="mb-2"><strong>Thuê xe máy:</strong> Thay vì taxi, thuê xe máy 150.000-200.000 VNĐ/ngày để tự do di chuyển.</li>
                    <li class="mb-2"><strong>Mua đặc sản ở chợ:</strong> Giá chợ thường rẻ hơn 30-50% so với cửa hàng tại bến cảng.</li>
                    <li class="mb-2"><strong>Đi tour nhóm ghép:</strong> Rẻ hơn tour riêng 40-60%, phù hợp cho khách đi 1-2 người.</li>
                    <li class="mb-2"><strong>Dùng thẻ ngân hàng:</strong> Nhiều khách sạn có ưu đãi thanh toán qua app ngân hàng hoặc ví điện tử.</li>
                    <li class="mb-2"><strong>Tránh mua hải sản ở bến cảng:</strong> Giá thường đắt hơn nhiều — ra chợ cá mua rồi nhờ nhà hàng chế biến.</li>
                    <li><strong>Đặt phòng khách sạn:</strong> Đặt trực tiếp qua website/điện thoại đôi khi rẻ hơn OTA (Booking.com, Agoda) vì tránh phí hoa hồng.</li>
                  </ol>
                </div>

                <button class="read-more-btn mt-2" onclick="toggleArticle('full-8', this)">
                  Đọc thêm <i class="bi bi-chevron-down"></i>
                </button>
              </div>
            </div>
          </div>

          <!-- Article 9 -->
          <div class="col-md-6">
            <div class="card article-card h-100">
              <div class="article-img">🌿</div>
              <div class="card-body p-4">
                <span class="article-tag tag-culture">Môi trường</span>
                <h5 class="fw-bold mt-2">Du Lịch Có Trách Nhiệm Tại Vịnh Hạ Long</h5>
                <p class="text-muted small">Vịnh Hạ Long đang đối mặt với thách thức môi trường nghiêm trọng. Hãy cùng tìm hiểu cách du khách có thể góp phần bảo vệ kỳ quan thiên nhiên này cho các thế hệ tương lai...</p>

                <div id="full-9" style="display:none">
                  <hr>
                  <h6 class="fw-bold">Những điều NÊN làm:</h6>
                  <ul class="small text-muted">
                    <li>Mang túi vải thay thế túi nilon khi mua sắm</li>
                    <li>Sử dụng bình nước cá nhân, tránh chai nhựa dùng một lần</li>
                    <li>Không xả rác xuống vịnh, sử dụng thùng rác trên tàu</li>
                    <li>Chọn các tour du lịch có chứng nhận eco-friendly</li>
                    <li>Không chạm vào san hô khi lặn biển</li>
                  </ul>
                  <h6 class="fw-bold">Những điều KHÔNG NÊN làm:</h6>
                  <ul class="small text-muted mb-0">
                    <li>Không mua sản phẩm từ san hô, vỏ sò, vảy cá hiếm</li>
                    <li>Không la hét, gây ồn ào trong các hang động</li>
                    <li>Không cho các loài động vật hoang dã ăn</li>
                    <li>Không khắc tên lên đá tại các danh thắng</li>
                    <li>Không câu cá trong vùng cấm khai thác</li>
                  </ul>
                </div>

                <button class="read-more-btn mt-2" onclick="toggleArticle('full-9', this)">
                  Đọc thêm <i class="bi bi-chevron-down"></i>
                </button>
              </div>
            </div>
          </div>

        </div>
      </div>

      <!-- Sidebar -->
      <div class="col-lg-4">

        <!-- Thông tin nhanh -->
        <div class="card sidebar-card mb-4">
          <div class="card-header bg-primary text-white fw-bold rounded-top-3">
            <i class="bi bi-info-circle-fill me-2"></i>Thông Tin Nhanh Về Hạ Long
          </div>
          <div class="card-body p-0">
            <div class="sidebar-item px-4 py-3 d-flex justify-content-between">
              <span class="text-muted small">Tỉnh / Thành phố</span>
              <span class="fw-semibold small">Quảng Ninh</span>
            </div>
            <div class="sidebar-item px-4 py-3 d-flex justify-content-between">
              <span class="text-muted small">Cách Hà Nội</span>
              <span class="fw-semibold small">~170 km</span>
            </div>
            <div class="sidebar-item px-4 py-3 d-flex justify-content-between">
              <span class="text-muted small">Diện tích vịnh</span>
              <span class="fw-semibold small">1.553 km²</span>
            </div>
            <div class="sidebar-item px-4 py-3 d-flex justify-content-between">
              <span class="text-muted small">Số đảo đá vôi</span>
              <span class="fw-semibold small">1.600+ đảo</span>
            </div>
            <div class="sidebar-item px-4 py-3 d-flex justify-content-between">
              <span class="text-muted small">Di sản UNESCO</span>
              <span class="fw-semibold small">1994 & 2000</span>
            </div>
            <div class="sidebar-item px-4 py-3 d-flex justify-content-between">
              <span class="text-muted small">Sân bay gần nhất</span>
              <span class="fw-semibold small">Vân Đồn (VDO)</span>
            </div>
            <div class="sidebar-item px-4 py-3 d-flex justify-content-between">
              <span class="text-muted small">Mùa đẹp nhất</span>
              <span class="fw-semibold small">Tháng 4-5, 10-11</span>
            </div>
            <div class="sidebar-item px-4 py-3 d-flex justify-content-between">
              <span class="text-muted small">Múi giờ</span>
              <span class="fw-semibold small">UTC+7 (Hà Nội)</span>
            </div>
          </div>
        </div>

        <!-- Mẹo du lịch nhanh -->
        <div class="card sidebar-card mb-4">
          <div class="card-header bg-warning text-dark fw-bold rounded-top-3">
            <i class="bi bi-lightbulb-fill me-2"></i>Mẹo Du Lịch Nhanh
          </div>
          <div class="card-body">
            <div class="d-flex mb-3">
              <i class="bi bi-telephone-fill text-warning me-3 mt-1 flex-shrink-0"></i>
              <div>
                <p class="fw-semibold small mb-0">Đường dây hỗ trợ du lịch</p>
                <p class="small text-muted mb-0">1800 599 945 (miễn phí, 24/7)</p>
              </div>
            </div>
            <div class="d-flex mb-3">
              <i class="bi bi-currency-exchange text-warning me-3 mt-1 flex-shrink-0"></i>
              <div>
                <p class="fw-semibold small mb-0">Tiền tệ</p>
                <p class="small text-muted mb-0">VNĐ (Đồng Việt Nam). Đổi tiền tại ngân hàng, không đổi ngoài đường</p>
              </div>
            </div>
            <div class="d-flex mb-3">
              <i class="bi bi-sim-fill text-warning me-3 mt-1 flex-shrink-0"></i>
              <div>
                <p class="fw-semibold small mb-0">Sim & Internet</p>
                <p class="small text-muted mb-0">Viettel và Mobifone phủ sóng tốt. Mua SIM du lịch 100-150k/tuần</p>
              </div>
            </div>
            <div class="d-flex">
              <i class="bi bi-shield-plus-fill text-warning me-3 mt-1 flex-shrink-0"></i>
              <div>
                <p class="fw-semibold small mb-0">Bảo hiểm du lịch</p>
                <p class="small text-muted mb-0">Nên mua bảo hiểm du lịch nếu tham gia các hoạt động ngoài trời, lặn biển</p>
              </div>
            </div>
          </div>
        </div>

        <!-- FAQ -->
        <div class="card sidebar-card mb-4">
          <div class="card-header bg-success text-white fw-bold rounded-top-3">
            <i class="bi bi-question-circle-fill me-2"></i>Câu Hỏi Thường Gặp
          </div>
          <div class="card-body p-3">

            <div class="faq-item">
              <div class="faq-question" onclick="toggleFaq(this)">
                Vé vào cổng Vịnh Hạ Long bao nhiêu tiền?
                <i class="bi bi-plus-circle"></i>
              </div>
              <div class="faq-answer">
                Vé tham quan vịnh: 270.000 VNĐ/người lớn, 130.000 VNĐ/trẻ em (từ 1-1.4m). Phí này thường đã được tính vào giá tour. Nếu tự đặt, bạn cần mua tại Ban Quản lý Vịnh Hạ Long.
              </div>
            </div>

            <div class="faq-item">
              <div class="faq-question" onclick="toggleFaq(this)">
                Tour du thuyền qua đêm tốt nhất là tour nào?
                <i class="bi bi-plus-circle"></i>
              </div>
              <div class="faq-answer">
                Các công ty tour uy tín: Indochina Junk, Paradise Cruises, Bhaya Cruises, Era Cruises. Nên chọn tàu 3 sao trở lên với đánh giá tốt trên TripAdvisor và Booking.com.
              </div>
            </div>

            <div class="faq-item">
              <div class="faq-question" onclick="toggleFaq(this)">
                Có thể mang trẻ nhỏ đi tour vịnh không?
                <i class="bi bi-plus-circle"></i>
              </div>
              <div class="faq-answer">
                Có thể. Hầu hết du thuyền đều có giường phụ cho trẻ nhỏ. Một số tàu có chương trình đặc biệt cho gia đình có con nhỏ. Nên hỏi kỹ khi đặt tour.
              </div>
            </div>

            <div class="faq-item">
              <div class="faq-question" onclick="toggleFaq(this)">
                Có cần mang áo phao khi đi vịnh không?
                <i class="bi bi-plus-circle"></i>
              </div>
              <div class="faq-answer">
                Tàu du lịch bắt buộc phải cung cấp áo phao cho khách. Nhưng nếu bạn tự chèo kayak hoặc bơi lặn, hãy đảm bảo mặc áo phao đúng cách theo hướng dẫn của nhân viên.
              </div>
            </div>

          </div>
        </div>

        <!-- CTA đặt phòng -->
        <div class="card border-0 rounded-3 text-center p-4" style="background: linear-gradient(135deg, #1a3c34, #2D6A4F); color: white;">
          <i class="bi bi-house-heart-fill fs-1 mb-2"></i>
          <h5 class="fw-bold">Sẵn Sàng Khám Phá Hạ Long?</h5>
          <p class="small opacity-75 mb-3">Đặt phòng ngay hôm nay để có giá tốt nhất và chuẩn bị cho chuyến phiêu lưu tuyệt vời!</p>
          <a href="rooms.php" class="btn btn-light fw-bold text-success rounded-pill px-4">
            <i class="bi bi-search me-1"></i> Xem Phòng Trống
          </a>
        </div>

      </div>
    </div>
  </div>

  <?php require('inc/footer.php'); ?>

  <script>
    function toggleArticle(id, btn) {
      const el = document.getElementById(id);
      if (el.style.display === 'none') {
        el.style.display = 'block';
        btn.innerHTML = 'Thu gọn <i class="bi bi-chevron-up"></i>';
      } else {
        el.style.display = 'none';
        btn.innerHTML = 'Đọc thêm <i class="bi bi-chevron-down"></i>';
      }
    }

    function toggleFaq(el) {
      const answer = el.nextElementSibling;
      const icon = el.querySelector('i');
      if (answer.classList.contains('show')) {
        answer.classList.remove('show');
        icon.className = 'bi bi-plus-circle';
      } else {
        // Close all
        document.querySelectorAll('.faq-answer.show').forEach(a => a.classList.remove('show'));
        document.querySelectorAll('.faq-question i').forEach(i => i.className = 'bi bi-plus-circle');
        answer.classList.add('show');
        icon.className = 'bi bi-dash-circle';
      }
    }
  </script>

</body>
</html>
