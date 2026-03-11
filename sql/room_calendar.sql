-- Room Calendar table for tracking room availability status per date
-- Status values: available, booked, pending, peak, holiday

CREATE TABLE IF NOT EXISTS `room_calendar` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `room_id` INT NOT NULL,
  `date` DATE NOT NULL,
  `status` VARCHAR(20) NOT NULL DEFAULT 'available' COMMENT 'available, booked, pending, peak, holiday',
  `note` VARCHAR(255) DEFAULT NULL,
  `updated_at` DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  UNIQUE KEY `uq_room_date` (`room_id`, `date`),
  KEY `idx_date` (`date`),
  FOREIGN KEY (`room_id`) REFERENCES `rooms`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
