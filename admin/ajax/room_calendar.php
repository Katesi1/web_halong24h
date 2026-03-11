<?php
require('../inc/essentials.php');
require('../inc/db_config.php');
adminLogin();

header('Content-Type: application/json');

// GET calendar data for a month
if (isset($_GET['get_calendar'])) {
  $month = intval($_GET['month']);
  $year = intval($_GET['year']);

  // Get all active rooms
  $rooms_q = mysqli_query($con, "SELECT id, name, code FROM rooms WHERE removed = 0 ORDER BY code ASC, name ASC");
  $rooms = [];
  while ($row = mysqli_fetch_assoc($rooms_q)) {
    $rooms[] = $row;
  }

  // Get calendar data for the month
  $start_date = sprintf('%04d-%02d-01', $year, $month);
  $end_date = date('Y-m-t', strtotime($start_date));

  $cal_q = select(
    "SELECT room_id, date, status, note FROM room_calendar WHERE date BETWEEN ? AND ?",
    [$start_date, $end_date],
    'ss'
  );

  $calendar = [];
  while ($row = mysqli_fetch_assoc($cal_q)) {
    $key = $row['room_id'] . '_' . $row['date'];
    $calendar[$key] = [
      'status' => $row['status'],
      'note' => $row['note']
    ];
  }

  echo json_encode([
    'success' => true,
    'rooms' => $rooms,
    'calendar' => $calendar,
    'days_in_month' => intval(date('t', strtotime($start_date)))
  ]);
  exit;
}

// UPDATE cell status
if (isset($_POST['update_status'])) {
  $room_id = intval($_POST['room_id']);
  $date = $_POST['date'];
  $status = $_POST['status'];
  $note = isset($_POST['note']) ? trim($_POST['note']) : '';

  // Validate status
  $valid_statuses = ['available', 'booked', 'pending', 'peak', 'holiday'];
  if (!in_array($status, $valid_statuses)) {
    echo json_encode(['success' => false, 'msg' => 'Invalid status']);
    exit;
  }

  // Validate date format
  if (!preg_match('/^\d{4}-\d{2}-\d{2}$/', $date)) {
    echo json_encode(['success' => false, 'msg' => 'Invalid date']);
    exit;
  }

  if ($status === 'available') {
    // Remove the record (default is available)
    $del = mysqli_prepare($con, "DELETE FROM room_calendar WHERE room_id = ? AND date = ?");
    mysqli_stmt_bind_param($del, 'is', $room_id, $date);
    mysqli_stmt_execute($del);
    mysqli_stmt_close($del);
  } else {
    // Insert or update
    $sql = "INSERT INTO room_calendar (room_id, date, status, note) VALUES (?, ?, ?, ?)
            ON DUPLICATE KEY UPDATE status = VALUES(status), note = VALUES(note)";
    $stmt = mysqli_prepare($con, $sql);
    mysqli_stmt_bind_param($stmt, 'isss', $room_id, $date, $status, $note);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
  }

  echo json_encode(['success' => true]);
  exit;
}

// BULK update - set status for date range
if (isset($_POST['bulk_update'])) {
  $room_id = intval($_POST['room_id']);
  $start = $_POST['start_date'];
  $end = $_POST['end_date'];
  $status = $_POST['status'];
  $note = isset($_POST['note']) ? trim($_POST['note']) : '';

  $valid_statuses = ['available', 'booked', 'pending', 'peak', 'holiday'];
  if (!in_array($status, $valid_statuses)) {
    echo json_encode(['success' => false, 'msg' => 'Invalid status']);
    exit;
  }

  // Iterate through date range
  $current = new DateTime($start);
  $end_dt = new DateTime($end);
  $end_dt->modify('+1 day');

  while ($current < $end_dt) {
    $d = $current->format('Y-m-d');
    if ($status === 'available') {
      $del = mysqli_prepare($con, "DELETE FROM room_calendar WHERE room_id = ? AND date = ?");
      mysqli_stmt_bind_param($del, 'is', $room_id, $d);
      mysqli_stmt_execute($del);
      mysqli_stmt_close($del);
    } else {
      $sql = "INSERT INTO room_calendar (room_id, date, status, note) VALUES (?, ?, ?, ?)
              ON DUPLICATE KEY UPDATE status = VALUES(status), note = VALUES(note)";
      $stmt = mysqli_prepare($con, $sql);
      mysqli_stmt_bind_param($stmt, 'isss', $room_id, $d, $status, $note);
      mysqli_stmt_execute($stmt);
      mysqli_stmt_close($stmt);
    }
    $current->modify('+1 day');
  }

  echo json_encode(['success' => true]);
  exit;
}

echo json_encode(['success' => false, 'msg' => 'Invalid request']);
