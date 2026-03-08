<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <?php require('inc/links.php'); ?>
  <title><?php echo $settings_r['site_title'] ?> - Đặc Sản Hạ Long</title>
  <style>
    .specialty-hero {
      background: linear-gradient(135deg, #7b3f00 0%, #c05e1b 50%, #e07b39 100%);
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
    .food-card {
      border-radius: 16px;
      overflow: hidden;
      transition: all 0.35s ease;
      border: none;
      box-shadow: 0 4px 15px rgba(0,0,0,0.08);
    }
    .food-card:hover {
      transform: translateY(-8px);
      box-shadow: 0 15px 35px rgba(192,94,27,0.2);
    }
    .food-card .card-img-top {
      height: 230px;
      object-fit: cover;
    }
    .food-tag {
      background: linear-gradient(135deg, #c05e1b, #e07b39);
      color: white;
      border-radius: 20px;
      padding: 4px 14px;
      font-size: 13px;
      display: inline-block;
      margin-bottom: 8px;
    }
    .food-img-placeholder {
      height: 230px;
      background: linear-gradient(135deg, #f5deb3, #ffe4b5);
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 80px;
    }
    .tip-box {
      background: linear-gradient(135deg, #fff8f0, #ffecd8);
      border-left: 4px solid #c05e1b;
      border-radius: 8px;
    }
    .where-to-eat-card {
      border-radius: 12px;
      border-left: 4px solid #c05e1b;
      transition: all 0.3s;
    }
    .where-to-eat-card:hover {
      transform: translateX(4px);
    }
    .category-tab {
      background: #fff;
      border: 2px solid #c05e1b;
      color: #c05e1b;
      border-radius: 30px;
      padding: 8px 20px;
      cursor: pointer;
      transition: all 0.2s;
      font-weight: 500;
    }
    .category-tab.active, .category-tab:hover {
      background: #c05e1b;
      color: white;
    }
  </style>
</head>
<body class="bg-light">

  <?php require('inc/header.php'); ?>

  <!-- Hero -->
  <div class="specialty-hero">
    <div class="container text-center">
      <span class="section-badge"><i class="bi bi-egg-fried me-1"></i> Ẩm thực đặc sắc</span>
      <h1 class="fw-bold display-5 mb-3">Đặc Sản Hạ Long</h1>
      <p class="lead mb-0 opacity-75">Hạ Long không chỉ nổi tiếng với vịnh biển kỳ vĩ mà còn sở hữu nền ẩm thực hải sản phong phú, độc đáo hàng đầu Việt Nam</p>
    </div>
  </div>

  <!-- Giới thiệu -->
  <div class="container my-5">
    <div class="row align-items-center g-4">
      <div class="col-lg-6">
        <h2 class="fw-bold h-font mb-3">Hương Vị Biển Cả Đông Bắc</h2>
        <p class="text-muted lh-lg">Nằm bên bờ Vịnh Hạ Long — Di sản Thiên nhiên Thế giới được UNESCO công nhận — thành phố Hạ Long (Quảng Ninh) sở hữu nguồn hải sản dồi dào, tươi ngon quanh năm. Từ những loài đặc sản quý hiếm chỉ có tại vùng biển này đến các món ăn dân dã đậm đà bản sắc làng chài, ẩm thực Hạ Long luôn để lại ấn tượng sâu sắc trong lòng du khách.</p>
        <p class="text-muted lh-lg">Đặc điểm khí hậu biển ôn hòa cùng hệ sinh thái phong phú của vịnh tạo nên những loài hải sản có hương vị đặc trưng không thể lẫn với bất kỳ nơi nào khác tại Việt Nam.</p>
        <div class="row g-3 mt-2">
          <div class="col-6">
            <div class="d-flex align-items-center">
              <i class="bi bi-check-circle-fill text-warning me-2 fs-5"></i>
              <span class="fw-semibold">Hải sản tươi sống</span>
            </div>
          </div>
          <div class="col-6">
            <div class="d-flex align-items-center">
              <i class="bi bi-check-circle-fill text-warning me-2 fs-5"></i>
              <span class="fw-semibold">Đặc sản vùng miền</span>
            </div>
          </div>
          <div class="col-6">
            <div class="d-flex align-items-center">
              <i class="bi bi-check-circle-fill text-warning me-2 fs-5"></i>
              <span class="fw-semibold">Phong phú đa dạng</span>
            </div>
          </div>
          <div class="col-6">
            <div class="d-flex align-items-center">
              <i class="bi bi-check-circle-fill text-warning me-2 fs-5"></i>
              <span class="fw-semibold">Giá cả hợp lý</span>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-6">
        <div class="row g-3">
          <div class="col-6">
            <div class="bg-warning-subtle rounded-3 p-4 text-center">
              <div class="fs-1 mb-2">🦑</div>
              <h6 class="fw-bold">Chả Mực</h6>
              <p class="small text-muted mb-0">Đặc sản số 1</p>
            </div>
          </div>
          <div class="col-6">
            <div class="bg-danger-subtle rounded-3 p-4 text-center">
              <div class="fs-1 mb-2">🦪</div>
              <h6 class="fw-bold">Hàu Sữa</h6>
              <p class="small text-muted mb-0">Béo ngậy, tươi ngon</p>
            </div>
          </div>
          <div class="col-6">
            <div class="bg-info-subtle rounded-3 p-4 text-center">
              <div class="fs-1 mb-2">🍜</div>
              <h6 class="fw-bold">Bánh Gật Gù</h6>
              <p class="small text-muted mb-0">Đặc sản vùng cao</p>
            </div>
          </div>
          <div class="col-6">
            <div class="bg-success-subtle rounded-3 p-4 text-center">
              <div class="fs-1 mb-2">🦐</div>
              <h6 class="fw-bold">Bề Bề Hấp</h6>
              <p class="small text-muted mb-0">Ngọt thịt, giàu dinh dưỡng</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Các đặc sản chính -->
  <div class="bg-white py-5">
    <div class="container">
      <h2 class="fw-bold h-font text-center mb-2">Những Đặc Sản Không Thể Bỏ Qua</h2>
      <div class="h-line mb-2" style="height:3px;width:80px;background:#c05e1b;margin:0 auto;"></div>
      <p class="text-center text-muted mb-5">Danh sách những món ăn đặc trưng bạn nhất định phải thử khi đến Hạ Long</p>

      <div class="row g-4">

        <!-- Chả Mực -->
        <div class="col-lg-4 col-md-6">
          <div class="card food-card h-100">
            <div class="food-img-placeholder">🦑</div>
            <div class="card-body p-4">
              <span class="food-tag">Đặc sản số 1</span>
              <h5 class="fw-bold">Chả Mực Hạ Long</h5>
              <p class="text-muted">Chả mực Hạ Long được chế biến từ mực tươi đánh bắt trực tiếp tại vịnh, giã tay thủ công truyền thống. Miếng chả mực dai ngọt, thơm đậm đà, vàng giòn bên ngoài — đây là đặc sản được ưa chuộng nhất khi mang về làm quà.</p>
              <div class="d-flex align-items-center mt-3">
                <i class="bi bi-geo-alt-fill text-warning me-2"></i>
                <small class="text-muted">Chợ Hạ Long, phố Hoàng Diệu, các nhà hàng ven biển</small>
              </div>
              <div class="d-flex align-items-center mt-1">
                <i class="bi bi-currency-dollar text-warning me-2"></i>
                <small class="text-muted">150.000 – 300.000 VNĐ / phần</small>
              </div>
            </div>
          </div>
        </div>

        <!-- Hàu Sữa -->
        <div class="col-lg-4 col-md-6">
          <div class="card food-card h-100">
            <div class="food-img-placeholder">🦪</div>
            <div class="card-body p-4">
              <span class="food-tag">Hải sản tươi sống</span>
              <h5 class="fw-bold">Hàu Sữa Vịnh Hạ Long</h5>
              <p class="text-muted">Hàu nuôi tự nhiên trong môi trường nước biển sạch của Vịnh Hạ Long có vị béo ngậy, ngọt tự nhiên đặc trưng. Có thể thưởng thức sống với nước mắm chanh, nướng mỡ hành hoặc hấp gừng. Giàu kẽm và protein cao.</p>
              <div class="d-flex align-items-center mt-3">
                <i class="bi bi-geo-alt-fill text-warning me-2"></i>
                <small class="text-muted">Làng chài Cửa Vạn, bè nổi trên vịnh, nhà hàng hải sản</small>
              </div>
              <div class="d-flex align-items-center mt-1">
                <i class="bi bi-currency-dollar text-warning me-2"></i>
                <small class="text-muted">50.000 – 120.000 VNĐ / chục</small>
              </div>
            </div>
          </div>
        </div>

        <!-- Sá Sùng -->
        <div class="col-lg-4 col-md-6">
          <div class="card food-card h-100">
            <div class="food-img-placeholder">🐛</div>
            <div class="card-body p-4">
              <span class="food-tag">Cực kỳ đặc biệt</span>
              <h5 class="fw-bold">Sá Sùng (Giun Biển)</h5>
              <p class="text-muted">Sá sùng — loài giun biển quý hiếm sống trong cát ven bờ vịnh Hạ Long — là đặc sản cực kỳ giá trị. Khi nướng hoặc sấy khô, sá sùng có hương thơm đặc trưng, vị ngọt đậm đà. Được dùng làm nước dùng phở, súp hải sản thơm ngon hoặc ăn trực tiếp.</p>
              <div class="d-flex align-items-center mt-3">
                <i class="bi bi-geo-alt-fill text-warning me-2"></i>
                <small class="text-muted">Chợ đêm Hạ Long, tiệm đặc sản Quảng Ninh</small>
              </div>
              <div class="d-flex align-items-center mt-1">
                <i class="bi bi-currency-dollar text-warning me-2"></i>
                <small class="text-muted">1.500.000 – 3.000.000 VNĐ / kg (khô)</small>
              </div>
            </div>
          </div>
        </div>

        <!-- Bề Bề -->
        <div class="col-lg-4 col-md-6">
          <div class="card food-card h-100">
            <div class="food-img-placeholder">🦐</div>
            <div class="card-body p-4">
              <span class="food-tag">Phổ biến & ngon</span>
              <h5 class="fw-bold">Bề Bề (Tôm Tít) Hạ Long</h5>
              <p class="text-muted">Bề bề — hay còn gọi là tôm tít, mantis shrimp — là loài hải sản đặc trưng của vùng biển Hạ Long. Hấp sả, nướng muối ớt hay rang me đều tuyệt ngon. Thịt bề bề chắc, ngọt và béo hơn tôm thông thường, đặc biệt hấp dẫn với bề bề mang trứng.</p>
              <div class="d-flex align-items-center mt-3">
                <i class="bi bi-geo-alt-fill text-warning me-2"></i>
                <small class="text-muted">Chợ Hải Sản Hạ Long, phố ẩm thực Hùng Thắng</small>
              </div>
              <div class="d-flex align-items-center mt-1">
                <i class="bi bi-currency-dollar text-warning me-2"></i>
                <small class="text-muted">200.000 – 350.000 VNĐ / kg</small>
              </div>
            </div>
          </div>
        </div>

        <!-- Ngán -->
        <div class="col-lg-4 col-md-6">
          <div class="card food-card h-100">
            <div class="food-img-placeholder">🐚</div>
            <div class="card-body p-4">
              <span class="food-tag">Đặc sản Quảng Ninh</span>
              <h5 class="fw-bold">Ngán (Tu Hài)</h5>
              <p class="text-muted">Ngán là loài nhuyễn thể đặc trưng của vùng biển Quảng Ninh, có vị ngọt đậm đà và hương thơm đặc biệt. Ngán hấp gừng, ngán xào bơ tỏi hoặc ngán sống chấm mù tạt đều là những cách thưởng thức phổ biến. Mùa ngán béo nhất vào tháng 9-12 hàng năm.</p>
              <div class="d-flex align-items-center mt-3">
                <i class="bi bi-geo-alt-fill text-warning me-2"></i>
                <small class="text-muted">Nhà hàng hải sản khu Bãi Cháy, Tuần Châu</small>
              </div>
              <div class="d-flex align-items-center mt-1">
                <i class="bi bi-currency-dollar text-warning me-2"></i>
                <small class="text-muted">180.000 – 250.000 VNĐ / kg</small>
              </div>
            </div>
          </div>
        </div>

        <!-- Bánh Gật Gù -->
        <div class="col-lg-4 col-md-6">
          <div class="card food-card h-100">
            <div class="food-img-placeholder">🍜</div>
            <div class="card-body p-4">
              <span class="food-tag">Ẩm thực dân dã</span>
              <h5 class="fw-bold">Bánh Gật Gù</h5>
              <p class="text-muted">Bánh gật gù là đặc sản làm từ bột gạo tẻ, tráng mỏng như bánh cuốn nhưng to hơn, mềm dẻo đặc trưng. Được cuộn lại thành từng khúc và ăn kèm nước chấm đặc biệt pha từ tôm he, mắm tôm, ớt. Món ăn sáng bình dân nhưng đậm đà hương vị Hạ Long.</p>
              <div class="d-flex align-items-center mt-3">
                <i class="bi bi-geo-alt-fill text-warning me-2"></i>
                <small class="text-muted">Chợ Hà Tu, phố Lê Thánh Tông, Bãi Cháy</small>
              </div>
              <div class="d-flex align-items-center mt-1">
                <i class="bi bi-currency-dollar text-warning me-2"></i>
                <small class="text-muted">15.000 – 30.000 VNĐ / suất</small>
              </div>
            </div>
          </div>
        </div>

        <!-- Ruốc Hạ Long -->
        <div class="col-lg-4 col-md-6">
          <div class="card food-card h-100">
            <div class="food-img-placeholder">🧂</div>
            <div class="card-body p-4">
              <span class="food-tag">Đặc sản mang về</span>
              <h5 class="fw-bold">Ruốc & Mắm Hạ Long</h5>
              <p class="text-muted">Ruốc biển (tép moi) Hạ Long được làm từ loài tép nhỏ đặc trưng của vịnh, có màu đỏ hồng rất đẹp và hương vị thơm ngon. Ngoài ruốc, mắm tôm Quảng Ninh và mắm sá sùng cũng là những đặc sản quý giá để mang về làm quà tặng người thân.</p>
              <div class="d-flex align-items-center mt-3">
                <i class="bi bi-geo-alt-fill text-warning me-2"></i>
                <small class="text-muted">Chợ Hạ Long 1, siêu thị Big C Hạ Long, cửa hàng đặc sản</small>
              </div>
              <div class="d-flex align-items-center mt-1">
                <i class="bi bi-currency-dollar text-warning me-2"></i>
                <small class="text-muted">80.000 – 200.000 VNĐ / hộp</small>
              </div>
            </div>
          </div>
        </div>

        <!-- Sam Biển -->
        <div class="col-lg-4 col-md-6">
          <div class="card food-card h-100">
            <div class="food-img-placeholder">🦀</div>
            <div class="card-body p-4">
              <span class="food-tag">Độc đáo & hiếm</span>
              <h5 class="fw-bold">Sam Biển Hạ Long</h5>
              <p class="text-muted">Sam biển là loài đặc sản hiếm có tại vùng biển Hạ Long. Trứng sam màu xanh lá đặc trưng, được chế biến thành gỏi trộn hoặc rang muối. Thịt sam trắng, thơm ngon và có giá trị dinh dưỡng cao. Lưu ý chỉ ăn sam cái có trứng mới an toàn.</p>
              <div class="d-flex align-items-center mt-3">
                <i class="bi bi-geo-alt-fill text-warning me-2"></i>
                <small class="text-muted">Nhà hàng chuyên hải sản, bến cá Hòn Gai</small>
              </div>
              <div class="d-flex align-items-center mt-1">
                <i class="bi bi-currency-dollar text-warning me-2"></i>
                <small class="text-muted">300.000 – 500.000 VNĐ / con</small>
              </div>
            </div>
          </div>
        </div>

        <!-- Nem Chua Hạ Long -->
        <div class="col-lg-4 col-md-6">
          <div class="card food-card h-100">
            <div class="food-img-placeholder">🥘</div>
            <div class="card-body p-4">
              <span class="food-tag">Đồ ăn vặt nổi tiếng</span>
              <h5 class="fw-bold">Nem Chua Hạ Long & Bánh Coóng Phù</h5>
              <p class="text-muted">Nem chua Hạ Long làm từ thịt lợn tươi kết hợp bì lợn, có vị chua thanh, ngọt dịu và cay nhẹ rất đặc trưng. Còn Bánh Coóng phù — hay còn gọi là chè trôi nước — là món tráng miệng đậu xanh nhân mềm, nước đường gừng thơm, rất phổ biến ở các chợ đêm Hạ Long.</p>
              <div class="d-flex align-items-center mt-3">
                <i class="bi bi-geo-alt-fill text-warning me-2"></i>
                <small class="text-muted">Chợ đêm Hạ Long, khu ẩm thực đường phố Bãi Cháy</small>
              </div>
              <div class="d-flex align-items-center mt-1">
                <i class="bi bi-currency-dollar text-warning me-2"></i>
                <small class="text-muted">20.000 – 50.000 VNĐ / phần</small>
              </div>
            </div>
          </div>
        </div>

      </div>
    </div>
  </div>

  <!-- Địa điểm ăn uống nổi tiếng -->
  <div class="container my-5">
    <h2 class="fw-bold h-font text-center mb-2">Địa Điểm Ẩm Thực Nổi Tiếng</h2>
    <div class="h-line mb-2" style="height:3px;width:80px;background:#c05e1b;margin:0 auto;"></div>
    <p class="text-center text-muted mb-5">Những nơi bạn không thể bỏ lỡ khi muốn thưởng thức đặc sản Hạ Long</p>

    <div class="row g-4">
      <div class="col-lg-6">
        <div class="card where-to-eat-card p-4 h-100">
          <div class="d-flex align-items-start">
            <div class="fs-2 me-3">🏪</div>
            <div>
              <h5 class="fw-bold mb-1">Chợ Hạ Long 1 & Chợ Hạ Long 2</h5>
              <p class="text-muted mb-2">Hai khu chợ truyền thống lớn nhất thành phố với đầy đủ hải sản tươi sống, đặc sản khô và các mặt hàng thực phẩm địa phương. Giá cả bình dân, trải nghiệm mua sắm đích thực của người dân địa phương.</p>
              <span class="badge bg-warning-subtle text-warning">Mở cửa: 5:00 – 20:00</span>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-6">
        <div class="card where-to-eat-card p-4 h-100">
          <div class="d-flex align-items-start">
            <div class="fs-2 me-3">🌃</div>
            <div>
              <h5 class="fw-bold mb-1">Chợ Đêm Hạ Long & Phố Đi Bộ</h5>
              <p class="text-muted mb-2">Khu chợ đêm sôi động với hàng trăm gian hàng ẩm thực đường phố, đồ lưu niệm và biểu diễn văn nghệ. Đây là điểm hẹn lý tưởng vào buổi tối cho cả gia đình và nhóm bạn.</p>
              <span class="badge bg-warning-subtle text-warning">Hoạt động: 18:00 – 23:00</span>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-6">
        <div class="card where-to-eat-card p-4 h-100">
          <div class="d-flex align-items-start">
            <div class="fs-2 me-3">🍽️</div>
            <div>
              <h5 class="fw-bold mb-1">Khu Nhà Hàng Bãi Cháy</h5>
              <p class="text-muted mb-2">Tập trung nhiều nhà hàng hải sản cao cấp với view biển tuyệt đẹp dọc theo đường Hạ Long. Phù hợp cho các bữa tiệc gia đình, tiếp khách doanh nghiệp. Hải sản được chọn tươi sống ngay tại bể.</p>
              <span class="badge bg-warning-subtle text-warning">Phù hợp: Nhóm, gia đình, tiệc</span>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-6">
        <div class="card where-to-eat-card p-4 h-100">
          <div class="d-flex align-items-start">
            <div class="fs-2 me-3">⛵</div>
            <div>
              <h5 class="fw-bold mb-1">Nhà Hàng Trên Du Thuyền</h5>
              <p class="text-muted mb-2">Thưởng thức bữa tối lãng mạn giữa lòng vịnh Hạ Long trên du thuyền hạng sang. Menu đa dạng từ hải sản tươi đến ẩm thực fusion Á-Âu. Trải nghiệm ẩm thực kết hợp ngắm hoàng hôn và ngàn sao đêm vịnh.</p>
              <span class="badge bg-warning-subtle text-warning">Đặt trước: Ít nhất 1 ngày</span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Mẹo khi mua đặc sản -->
  <div class="container mb-5">
    <div class="tip-box p-4">
      <h5 class="fw-bold mb-3"><i class="bi bi-lightbulb-fill text-warning me-2"></i>Mẹo khi mua đặc sản Hạ Long</h5>
      <div class="row g-3">
        <div class="col-md-6">
          <div class="d-flex">
            <i class="bi bi-1-circle-fill text-warning me-3 mt-1 flex-shrink-0"></i>
            <p class="mb-0 text-muted">Mua hải sản tươi sống tại các chợ cá buổi sáng sớm (4:00 – 7:00) để có hàng ngon nhất và giá tốt nhất.</p>
          </div>
        </div>
        <div class="col-md-6">
          <div class="d-flex">
            <i class="bi bi-2-circle-fill text-warning me-3 mt-1 flex-shrink-0"></i>
            <p class="mb-0 text-muted">Chả mực nên mua tại các cơ sở có thương hiệu uy tín, tránh mua hàng không rõ nguồn gốc tại các điểm du lịch.</p>
          </div>
        </div>
        <div class="col-md-6">
          <div class="d-flex">
            <i class="bi bi-3-circle-fill text-warning me-3 mt-1 flex-shrink-0"></i>
            <p class="mb-0 text-muted">Sá sùng khô có thể bảo quản lâu, rất phù hợp làm quà. Chọn loại màu đỏ nâu, không ẩm mốc, mùi thơm đặc trưng.</p>
          </div>
        </div>
        <div class="col-md-6">
          <div class="d-flex">
            <i class="bi bi-4-circle-fill text-warning me-3 mt-1 flex-shrink-0"></i>
            <p class="mb-0 text-muted">Mặc cả tại chợ là điều bình thường. Hỏi giá ít nhất 2-3 hàng trước khi quyết định mua để có giá hợp lý nhất.</p>
          </div>
        </div>
      </div>
    </div>
  </div>

  <?php require('inc/footer.php'); ?>

</body>
</html>
