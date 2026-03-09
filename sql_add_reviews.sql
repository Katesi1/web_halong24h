-- =====================================================
-- Thêm đánh giá mẫu cho trang chủ HaLong24h
-- Chạy file này sau khi đã import halong24h_full.sql
-- =====================================================

-- 1. Thêm 6 tài khoản người dùng giả lập
-- Password: 123456 (hashed)
INSERT INTO `user_cred` (`id`, `name`, `email`, `address`, `phonenum`, `pincode`, `dob`, `profile`, `password`, `is_verified`, `status`) VALUES
(2, 'Nguyễn Thị Minh Trang', 'minhtrang.nguyen@gmail.com', 'Hà Nội', '0912345678', 0, '1990-05-15', 'avatar-default.png', '$2y$10$YWVmMjRiZDdhYjYyMGJlZuDqGqyIaGMRxRLhGFE4Zmh3NzdiNGFh', 1, 1),
(3, 'Trần Đức Huy', 'duchuy.tran@gmail.com', 'Hải Phòng', '0987654321', 0, '1995-08-20', 'avatar-default.png', '$2y$10$YWVmMjRiZDdhYjYyMGJlZuDqGqyIaGMRxRLhGFE4Zmh3NzdiNGFh', 1, 1),
(4, 'Lê Hoàng Anh', 'hoanganh.le@gmail.com', 'Hà Nội', '0901234567', 0, '1998-03-10', 'avatar-default.png', '$2y$10$YWVmMjRiZDdhYjYyMGJlZuDqGqyIaGMRxRLhGFE4Zmh3NzdiNGFh', 1, 1),
(5, 'Phạm Quốc Đạt', 'quocdat.pham@gmail.com', 'TP. Hồ Chí Minh', '0978123456', 0, '1988-11-25', 'avatar-default.png', '$2y$10$YWVmMjRiZDdhYjYyMGJlZuDqGqyIaGMRxRLhGFE4Zmh3NzdiNGFh', 1, 1),
(6, 'Nguyễn Mai Phương', 'maiphuong.nguyen@gmail.com', 'Đà Nẵng', '0965432187', 0, '1993-07-08', 'avatar-default.png', '$2y$10$YWVmMjRiZDdhYjYyMGJlZuDqGqyIaGMRxRLhGFE4Zmh3NzdiNGFh', 1, 1),
(7, 'Đỗ Thành Sơn', 'thanhson.do@gmail.com', 'Quảng Ninh', '0943216789', 0, '1985-01-30', 'avatar-default.png', '$2y$10$YWVmMjRiZDdhYjYyMGJlZuDqGqyIaGMRxRLhGFE4Zmh3NzdiNGFh', 1, 1);

-- 2. Thêm 6 booking giả lập (đã hoàn thành) để liên kết với đánh giá
INSERT INTO `booking_order` (`booking_id`, `user_id`, `room_id`, `check_in`, `check_out`, `arrival`, `booking_status`, `order_id`, `trans_status`, `rate_review`, `datentime`) VALUES
(1, 2, 1, '2025-12-20', '2025-12-22', 1, 'confirmed', 'ORD-20251220-001', 'success', 1, '2025-12-18 10:30:00'),
(2, 3, 3, '2026-01-05', '2026-01-07', 1, 'confirmed', 'ORD-20260105-002', 'success', 1, '2026-01-03 14:15:00'),
(3, 4, 4, '2026-01-10', '2026-01-12', 1, 'confirmed', 'ORD-20260110-003', 'success', 1, '2026-01-08 09:45:00'),
(4, 5, 1, '2026-01-15', '2026-01-18', 1, 'confirmed', 'ORD-20260115-004', 'success', 1, '2026-01-13 16:20:00'),
(5, 6, 3, '2026-02-01', '2026-02-03', 1, 'confirmed', 'ORD-20260201-005', 'success', 1, '2026-01-30 11:00:00'),
(6, 7, 2, '2026-02-10', '2026-02-14', 1, 'confirmed', 'ORD-20260210-006', 'success', 1, '2026-02-08 08:30:00');

-- 3. Thêm 6 đánh giá chi tiết
INSERT INTO `rating_review` (`sr_no`, `booking_id`, `room_id`, `user_id`, `rating`, `review`, `seen`, `datentime`) VALUES
(1, 1, 1, 2, 5,
'Gia đình mình vừa có chuyến nghỉ dưỡng 3 ngày 2 đêm tại villa và thực sự rất hài lòng. Villa rộng rãi với 4 phòng ngủ, đủ chỗ cho cả đại gia đình 10 người. Bể bơi ngoài trời siêu rộng, bọn trẻ con tắm cả ngày không chán. Phòng ốc sạch sẽ, chăn ga gối đệm thơm tho. Từ ban công nhìn ra được biển, buổi sáng ngắm bình minh cực kỳ thơ mộng. Bếp đầy đủ tiện nghi, cả nhà tự nấu hải sản mua ở chợ Hạ Long. Chủ nhà rất nhiệt tình hướng dẫn. Chắc chắn sẽ quay lại!',
1, '2025-12-23 09:15:00'),

(2, 2, 3, 3, 5,
'Mình và bạn gái đặt penthouse tầng 27, view toàn cảnh vịnh Hạ Long và không thể tin được mắt mình khi mở cửa bước vào. Căn hộ rộng rãi, nội thất sang trọng, phòng khách có cửa kính lớn từ sàn đến trần nhìn thẳng ra vịnh. Buổi tối đứng ở ban công ngắm thành phố lên đèn, xa xa là những con du thuyền sáng rực trên vịnh, lãng mạn vô cùng. Phòng ngủ sạch sẽ, ga trải giường trắng muốt. Vị trí rất thuận tiện, đi bộ ra bãi biển chỉ 5 phút. Xứng đáng từng đồng!',
1, '2026-01-08 17:30:00'),

(3, 3, 4, 4, 4,
'Nhóm 8 đứa bọn mình thuê căn hộ ở Newlife cho chuyến đi Hạ Long cuối tuần. Căn hộ nằm trên tầng cao nên view cực đỉnh, nhìn thẳng ra biển Bãi Cháy. Phòng decor xinh xắn, tone trắng rất hợp chụp ảnh. Chủ homestay siêu thân thiện, tư vấn lịch trình đi chơi rất chi tiết. Phòng sạch sẽ, khăn tắm đầy đủ, có cả máy giặt riêng rất tiện. Điểm trừ nhỏ là hơi khó tìm đường vào lần đầu. Nhưng nhìn chung với giá này thì quá ổn, nhất định sẽ đặt lại!',
1, '2026-01-13 14:20:00'),

(4, 4, 1, 5, 5,
'Vợ chồng mình cùng 2 con nhỏ vừa nghỉ tại villa và đây là một trong những chuyến đi đáng nhớ nhất. Villa có sân vườn rộng, bọn nhỏ chạy nhảy thỏa thích. Bể bơi được chia khu riêng cho trẻ em với mực nước nông, rất yên tâm. Phòng ngủ thoáng mát, sạch sẽ. Bếp trang bị đủ từ bếp từ, lò vi sóng đến nồi cơm điện, rất tiện cho gia đình có con nhỏ. Bãi cát trắng ngay trước villa, chiều chiều cả nhà ra chơi cát ngắm hoàng hôn. Chủ villa còn chuẩn bị sẵn bộ đồ BBQ. Rất phù hợp cho gia đình!',
1, '2026-01-19 10:45:00'),

(5, 5, 3, 6, 4,
'Hai vợ chồng mình chọn căn penthouse ở Newlife để kỷ niệm ngày cưới. View từ phòng nhìn ra vịnh Hạ Long đẹp mê hồn, nhất là lúc bình minh, ánh nắng vàng chiếu lên những hòn đảo đá vôi thật sự như tranh vẽ. Phòng rất ấm cúng, sạch sẽ, có bồn tắm nhìn ra biển. Chủ nhà để sẵn trà và cà phê, sáng dậy ngồi ban công ngắm vịnh thì tuyệt vời. Xung quanh có Sun World, chợ đêm Bãi Cháy đi bộ được, rất thuận tiện. Trải nghiệm rất tuyệt, sẽ giới thiệu cho bạn bè!',
1, '2026-02-04 16:00:00'),

(6, 6, 2, 7, 5,
'Dịp Tết vừa rồi cả đại gia đình 15 người thuê nguyên căn villa lớn 6 phòng ngủ để nghỉ dưỡng 4 ngày. Phòng nào cũng rộng rãi, sạch sẽ và có toilet riêng. Phòng khách siêu rộng, cả nhà ngồi quây quần đông đủ vẫn thoải mái. Bể bơi nước trong vắt, được vệ sinh hàng ngày. Khu BBQ ngoài trời rộng rãi, tối tổ chức tiệc nướng hải sản rất vui. View nhìn xuống biển đẹp, không khí trong lành. Chủ nhà hướng dẫn chi tiết qua Zalo, còn đặt giúp tour du thuyền giá ưu đãi. Cả nhà ai cũng khen, chắc chắn sẽ quay lại mỗi dịp lễ Tết!',
1, '2026-02-15 11:30:00');

-- 4. Cập nhật AUTO_INCREMENT
ALTER TABLE `user_cred` AUTO_INCREMENT = 8;
ALTER TABLE `booking_order` AUTO_INCREMENT = 7;
ALTER TABLE `rating_review` AUTO_INCREMENT = 7;
