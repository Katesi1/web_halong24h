<?php
  require('inc/essentials.php');
  require('inc/db_config.php');
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
  <title><?php echo __('admin_room_calendar') ?> - HaLong24h</title>
  <?php require('inc/links.php'); ?>
</head>
<body>

  <?php require('inc/header.php'); ?>

  <div class="container-fluid" id="main-content">
    <div class="row">
      <div class="col-lg-10 ms-auto p-4 overflow-hidden">

        <!-- Header -->
        <div class="d-flex align-items-center justify-content-between mb-4 flex-wrap gap-2">
          <h3 class="mb-0"><i class="bi bi-calendar3 me-2"></i><?php echo __('admin_room_calendar') ?></h3>
          <div class="d-flex align-items-center gap-2">
            <button class="btn btn-sm btn-outline-secondary" id="btnBulkUpdate" data-bs-toggle="modal" data-bs-target="#bulkModal">
              <i class="bi bi-calendar-range me-1"></i><?php echo __('cal_bulk_update') ?>
            </button>
          </div>
        </div>

        <!-- Legend -->
        <div class="card border-0 shadow-sm mb-3" style="background: var(--bg-panel, #1e293b); border: 1px solid var(--border-color, rgba(148,163,184,.1)) !important;">
          <div class="card-body py-2 px-3">
            <div class="d-flex align-items-center gap-3 flex-wrap">
              <span class="cal-legend-label"><?php echo __('cal_legend') ?>:</span>
              <span class="cal-legend-item"><span class="cal-dot cal-available"></span><?php echo __('cal_available') ?></span>
              <span class="cal-legend-item"><span class="cal-dot cal-booked"></span><?php echo __('cal_booked') ?></span>
              <span class="cal-legend-item"><span class="cal-dot cal-pending"></span><?php echo __('cal_pending') ?></span>
              <span class="cal-legend-item"><span class="cal-dot cal-peak"></span><?php echo __('cal_peak') ?></span>
              <span class="cal-legend-item"><span class="cal-dot cal-holiday"></span><?php echo __('cal_holiday') ?></span>
            </div>
          </div>
        </div>

        <!-- Month Navigation -->
        <div class="d-flex align-items-center justify-content-between mb-3">
          <button class="btn btn-sm btn-outline-secondary" id="btnPrevMonth"><i class="bi bi-chevron-left"></i></button>
          <h5 class="mb-0 cal-month-title" id="monthTitle"></h5>
          <div class="d-flex gap-2">
            <button class="btn btn-sm btn-outline-info" id="btnToday"><?php echo __('cal_today') ?></button>
            <button class="btn btn-sm btn-outline-secondary" id="btnNextMonth"><i class="bi bi-chevron-right"></i></button>
          </div>
        </div>

        <!-- Calendar Table -->
        <div class="card border-0 shadow-sm" style="background: var(--bg-panel, #1e293b); border: 1px solid var(--border-color, rgba(148,163,184,.1)) !important;">
          <div class="card-body p-0">
            <div class="cal-table-wrap" id="calendarWrap">
              <div class="text-center py-5">
                <div class="spinner-border text-info" role="status"></div>
              </div>
            </div>
          </div>
        </div>

      </div>
    </div>
  </div>

  <!-- Cell Edit Modal -->
  <div class="modal fade" id="cellModal" tabindex="-1">
    <div class="modal-dialog modal-sm modal-dialog-centered">
      <div class="modal-content" style="background: var(--bg-panel, #1e293b); border: 1px solid var(--border-color);">
        <div class="modal-header border-0 pb-0">
          <h6 class="modal-title" id="cellModalTitle" style="color: var(--text-primary, #e2e8f0);"></h6>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <input type="hidden" id="cellRoomId">
          <input type="hidden" id="cellDate">
          <div class="d-flex flex-column gap-2">
            <button class="btn cal-status-btn cal-btn-available" data-status="available"><span class="cal-dot cal-available"></span><?php echo __('cal_available') ?></button>
            <button class="btn cal-status-btn cal-btn-booked" data-status="booked"><span class="cal-dot cal-booked"></span><?php echo __('cal_booked') ?></button>
            <button class="btn cal-status-btn cal-btn-pending" data-status="pending"><span class="cal-dot cal-pending"></span><?php echo __('cal_pending') ?></button>
            <button class="btn cal-status-btn cal-btn-peak" data-status="peak"><span class="cal-dot cal-peak"></span><?php echo __('cal_peak') ?></button>
            <button class="btn cal-status-btn cal-btn-holiday" data-status="holiday"><span class="cal-dot cal-holiday"></span><?php echo __('cal_holiday') ?></button>
          </div>
          <div class="mt-3">
            <input type="text" class="form-control form-control-sm" id="cellNote" placeholder="<?php echo __('cal_note_placeholder') ?>" style="background: rgba(148,163,184,.08); border-color: var(--border-color); color: var(--text-primary, #e2e8f0);">
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Bulk Update Modal -->
  <div class="modal fade" id="bulkModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content" style="background: var(--bg-panel, #1e293b); border: 1px solid var(--border-color);">
        <div class="modal-header border-bottom" style="border-color: var(--border-color) !important;">
          <h5 class="modal-title" style="color: var(--text-primary, #e2e8f0);">
            <i class="bi bi-calendar-range me-2"></i><?php echo __('cal_bulk_update') ?>
          </h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <div class="mb-3">
            <label class="form-label" style="color: var(--text-secondary);"><?php echo __('cal_select_room') ?></label>
            <select class="form-select form-select-sm" id="bulkRoom" style="background: rgba(148,163,184,.08); border-color: var(--border-color); color: var(--text-primary, #e2e8f0);">
            </select>
          </div>
          <div class="row g-2 mb-3">
            <div class="col-6">
              <label class="form-label" style="color: var(--text-secondary);"><?php echo __('cal_from_date') ?></label>
              <input type="date" class="form-control form-control-sm" id="bulkStart" style="background: rgba(148,163,184,.08); border-color: var(--border-color); color: var(--text-primary, #e2e8f0);">
            </div>
            <div class="col-6">
              <label class="form-label" style="color: var(--text-secondary);"><?php echo __('cal_to_date') ?></label>
              <input type="date" class="form-control form-control-sm" id="bulkEnd" style="background: rgba(148,163,184,.08); border-color: var(--border-color); color: var(--text-primary, #e2e8f0);">
            </div>
          </div>
          <div class="mb-3">
            <label class="form-label" style="color: var(--text-secondary);"><?php echo __('status') ?></label>
            <select class="form-select form-select-sm" id="bulkStatus" style="background: rgba(148,163,184,.08); border-color: var(--border-color); color: var(--text-primary, #e2e8f0);">
              <option value="available"><?php echo __('cal_available') ?></option>
              <option value="booked"><?php echo __('cal_booked') ?></option>
              <option value="pending"><?php echo __('cal_pending') ?></option>
              <option value="peak"><?php echo __('cal_peak') ?></option>
              <option value="holiday"><?php echo __('cal_holiday') ?></option>
            </select>
          </div>
          <div class="mb-3">
            <label class="form-label" style="color: var(--text-secondary);"><?php echo __('cal_note') ?></label>
            <input type="text" class="form-control form-control-sm" id="bulkNote" placeholder="<?php echo __('cal_note_placeholder') ?>" style="background: rgba(148,163,184,.08); border-color: var(--border-color); color: var(--text-primary, #e2e8f0);">
          </div>
        </div>
        <div class="modal-footer border-0">
          <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal"><?php echo __('cancel') ?></button>
          <button type="button" class="btn btn-sm btn-info text-white" id="btnBulkSave"><i class="bi bi-check2 me-1"></i><?php echo __('cal_apply') ?></button>
        </div>
      </div>
    </div>
  </div>

  <?php require('inc/scripts.php'); ?>

  <style>
    /* ── Calendar Table ── */
    .cal-table-wrap {
      overflow-x: auto;
      -webkit-overflow-scrolling: touch;
    }
    .cal-table {
      border-collapse: separate;
      border-spacing: 0;
      width: 100%;
      min-width: 900px;
      font-size: .78rem;
    }
    .cal-table th,
    .cal-table td {
      border: 1px solid var(--border-color, rgba(148,163,184,.12));
      text-align: center;
      vertical-align: middle;
    }

    /* Header row */
    .cal-table thead th {
      background: rgba(148,163,184,.06);
      color: var(--text-secondary, #94a3b8);
      font-weight: 700;
      font-size: .72rem;
      padding: 8px 2px;
      position: sticky;
      top: 0;
      z-index: 2;
      font-family: 'JetBrains Mono', monospace;
      letter-spacing: .3px;
    }
    .cal-table thead th.cal-th-room {
      position: sticky;
      left: 0;
      z-index: 3;
      background: var(--bg-panel, #1e293b);
      min-width: 140px;
      text-align: left;
      padding-left: 12px;
    }
    .cal-th-sun { color: #f87171 !important; }
    .cal-th-sat { color: #60a5fa !important; }

    /* Room name column */
    .cal-table td.cal-room-cell {
      position: sticky;
      left: 0;
      z-index: 1;
      background: var(--bg-panel, #1e293b);
      text-align: left;
      padding: 6px 10px;
      font-weight: 600;
      color: var(--text-primary, #e2e8f0);
      white-space: nowrap;
      min-width: 140px;
      border-right: 2px solid var(--border-color, rgba(148,163,184,.2));
    }
    .cal-room-code {
      font-family: 'JetBrains Mono', monospace;
      font-size: .7rem;
      color: var(--cyan, #22d3ee);
      margin-right: 6px;
    }

    /* Day cells */
    .cal-cell {
      width: 36px;
      min-width: 36px;
      height: 34px;
      padding: 0;
      cursor: pointer;
      transition: all .12s;
      position: relative;
    }
    .cal-cell:hover {
      outline: 2px solid var(--cyan, #22d3ee);
      outline-offset: -2px;
      z-index: 1;
    }
    .cal-cell.cal-today {
      outline: 2px solid #facc15;
      outline-offset: -2px;
    }

    /* Status colors */
    .cal-cell.cal-available { background: rgba(148,163,184,.04); }
    .cal-cell.cal-booked { background: rgba(239,68,68,.45); }
    .cal-cell.cal-pending { background: rgba(250,204,21,.4); }
    .cal-cell.cal-peak { background: rgba(74,222,128,.35); }
    .cal-cell.cal-holiday { background: rgba(168,85,247,.4); }

    /* Note indicator */
    .cal-cell.has-note::after {
      content: '';
      position: absolute;
      top: 2px; right: 2px;
      width: 5px; height: 5px;
      border-radius: 50%;
      background: #f97316;
    }

    /* Weekend columns */
    .cal-cell.cal-weekend { background: rgba(148,163,184,.06); }
    .cal-cell.cal-weekend.cal-booked { background: rgba(239,68,68,.5); }
    .cal-cell.cal-weekend.cal-pending { background: rgba(250,204,21,.45); }
    .cal-cell.cal-weekend.cal-peak { background: rgba(74,222,128,.4); }
    .cal-cell.cal-weekend.cal-holiday { background: rgba(168,85,247,.45); }

    /* Month title */
    .cal-month-title {
      font-family: 'JetBrains Mono', monospace;
      color: var(--text-primary, #e2e8f0);
      letter-spacing: .5px;
    }

    /* Legend */
    .cal-legend-label {
      font-size: .8rem;
      font-weight: 600;
      color: var(--text-secondary, #94a3b8);
    }
    .cal-legend-item {
      display: inline-flex;
      align-items: center;
      gap: 5px;
      font-size: .78rem;
      color: var(--text-secondary, #94a3b8);
    }
    .cal-dot {
      display: inline-block;
      width: 14px;
      height: 14px;
      border-radius: 3px;
      border: 1px solid rgba(148,163,184,.15);
    }
    .cal-dot.cal-available { background: rgba(148,163,184,.1); }
    .cal-dot.cal-booked { background: rgba(239,68,68,.6); }
    .cal-dot.cal-pending { background: rgba(250,204,21,.55); }
    .cal-dot.cal-peak { background: rgba(74,222,128,.5); }
    .cal-dot.cal-holiday { background: rgba(168,85,247,.55); }

    /* Status buttons in modal */
    .cal-status-btn {
      display: flex;
      align-items: center;
      gap: 10px;
      padding: 8px 14px;
      border-radius: 8px;
      font-size: .85rem;
      font-weight: 500;
      text-align: left;
      transition: all .15s;
      color: var(--text-secondary, #94a3b8);
      border: 1px solid var(--border-color, rgba(148,163,184,.12));
      background: rgba(148,163,184,.04);
    }
    .cal-status-btn:hover { transform: translateX(4px); }
    .cal-status-btn.active {
      border-color: var(--cyan, #22d3ee);
      box-shadow: 0 0 0 1px var(--cyan, #22d3ee);
    }
    .cal-btn-available:hover { background: rgba(148,163,184,.12); color: #cbd5e1; }
    .cal-btn-booked:hover { background: rgba(239,68,68,.15); color: #fca5a5; }
    .cal-btn-pending:hover { background: rgba(250,204,21,.12); color: #fcd34d; }
    .cal-btn-peak:hover { background: rgba(74,222,128,.12); color: #86efac; }
    .cal-btn-holiday:hover { background: rgba(168,85,247,.12); color: #c4b5fd; }

    /* Row hover */
    .cal-table tbody tr:hover td.cal-room-cell {
      background: rgba(165,180,252,.06);
    }

    @media (max-width: 768px) {
      .cal-table { font-size: .7rem; }
      .cal-cell { width: 30px; min-width: 30px; height: 28px; }
      .cal-table td.cal-room-cell { min-width: 110px; padding: 4px 6px; }
    }
  </style>

  <script>
  (function() {
    const MONTH_NAMES_VI = ['Tháng 1','Tháng 2','Tháng 3','Tháng 4','Tháng 5','Tháng 6','Tháng 7','Tháng 8','Tháng 9','Tháng 10','Tháng 11','Tháng 12'];
    const DAY_NAMES = ['CN','T2','T3','T4','T5','T6','T7'];

    let currentMonth = new Date().getMonth() + 1;
    let currentYear = new Date().getFullYear();
    let roomsCache = [];

    function loadCalendar(month, year) {
      const wrap = document.getElementById('calendarWrap');
      wrap.innerHTML = '<div class="text-center py-5"><div class="spinner-border text-info" role="status"></div></div>';
      document.getElementById('monthTitle').textContent = MONTH_NAMES_VI[month - 1] + ' / ' + year;

      fetch('ajax/room_calendar.php?get_calendar=1&month=' + month + '&year=' + year)
        .then(r => r.json())
        .then(data => {
          if (!data.success) { wrap.innerHTML = '<p class="text-danger p-3">Error loading data</p>'; return; }

          roomsCache = data.rooms;
          updateBulkRoomSelect(data.rooms);

          const days = data.days_in_month;
          const today = new Date();
          const todayStr = today.getFullYear() + '-' + String(today.getMonth()+1).padStart(2,'0') + '-' + String(today.getDate()).padStart(2,'0');

          // Build header
          let html = '<table class="cal-table"><thead><tr>';
          html += '<th class="cal-th-room"><?php echo __("cal_room") ?></th>';
          for (let d = 1; d <= days; d++) {
            const dateObj = new Date(year, month - 1, d);
            const dow = dateObj.getDay();
            let cls = '';
            if (dow === 0) cls = ' cal-th-sun';
            else if (dow === 6) cls = ' cal-th-sat';
            html += '<th class="' + cls + '">' + DAY_NAMES[dow] + '<br>' + d + '</th>';
          }
          html += '</tr></thead><tbody>';

          // Build rows
          data.rooms.forEach(room => {
            html += '<tr>';
            html += '<td class="cal-room-cell">';
            if (room.code) html += '<span class="cal-room-code">' + escHtml(room.code) + '</span>';
            html += escHtml(room.name) + '</td>';

            for (let d = 1; d <= days; d++) {
              const dateStr = year + '-' + String(month).padStart(2,'0') + '-' + String(d).padStart(2,'0');
              const key = room.id + '_' + dateStr;
              const dateObj = new Date(year, month - 1, d);
              const dow = dateObj.getDay();

              let status = 'available';
              let note = '';
              if (data.calendar[key]) {
                status = data.calendar[key].status;
                note = data.calendar[key].note || '';
              }

              let cls = 'cal-cell cal-' + status;
              if (dow === 0 || dow === 6) cls += ' cal-weekend';
              if (dateStr === todayStr) cls += ' cal-today';
              if (note) cls += ' has-note';

              html += '<td class="' + cls + '" data-room="' + room.id + '" data-date="' + dateStr + '" data-status="' + status + '" data-note="' + escAttr(note) + '" title="' + escAttr(note || status) + '"></td>';
            }
            html += '</tr>';
          });

          html += '</tbody></table>';
          wrap.innerHTML = html;

          // Attach click handlers
          wrap.querySelectorAll('.cal-cell').forEach(cell => {
            cell.addEventListener('click', () => openCellModal(cell));
          });
        })
        .catch(() => {
          wrap.innerHTML = '<p class="text-danger p-3">Error loading calendar</p>';
        });
    }

    function openCellModal(cell) {
      const roomId = cell.dataset.room;
      const date = cell.dataset.date;
      const status = cell.dataset.status;
      const note = cell.dataset.note || '';

      // Find room name
      const room = roomsCache.find(r => r.id == roomId);
      const roomName = room ? ((room.code ? room.code + ' - ' : '') + room.name) : '';

      document.getElementById('cellModalTitle').textContent = roomName + ' | ' + formatDate(date);
      document.getElementById('cellRoomId').value = roomId;
      document.getElementById('cellDate').value = date;
      document.getElementById('cellNote').value = note;

      // Highlight current status
      document.querySelectorAll('#cellModal .cal-status-btn').forEach(btn => {
        btn.classList.toggle('active', btn.dataset.status === status);
      });

      new bootstrap.Modal(document.getElementById('cellModal')).show();
    }

    // Status button click in modal
    document.querySelectorAll('#cellModal .cal-status-btn').forEach(btn => {
      btn.addEventListener('click', function() {
        const roomId = document.getElementById('cellRoomId').value;
        const date = document.getElementById('cellDate').value;
        const status = this.dataset.status;
        const note = document.getElementById('cellNote').value;

        saveStatus(roomId, date, status, note);
      });
    });

    function saveStatus(roomId, date, status, note) {
      const formData = new FormData();
      formData.append('update_status', '1');
      formData.append('room_id', roomId);
      formData.append('date', date);
      formData.append('status', status);
      formData.append('note', note);

      fetch('ajax/room_calendar.php', { method: 'POST', body: formData })
        .then(r => r.json())
        .then(data => {
          if (data.success) {
            // Update cell in DOM without reload
            const cell = document.querySelector('.cal-cell[data-room="'+roomId+'"][data-date="'+date+'"]');
            if (cell) {
              cell.className = cell.className.replace(/cal-(available|booked|pending|peak|holiday)/g, '');
              cell.classList.add('cal-' + status);
              cell.dataset.status = status;
              cell.dataset.note = note;
              cell.title = note || status;
              cell.classList.toggle('has-note', !!note);
            }
            bootstrap.Modal.getInstance(document.getElementById('cellModal'))?.hide();
          }
        });
    }

    // Bulk save
    document.getElementById('btnBulkSave').addEventListener('click', function() {
      const roomId = document.getElementById('bulkRoom').value;
      const start = document.getElementById('bulkStart').value;
      const end = document.getElementById('bulkEnd').value;
      const status = document.getElementById('bulkStatus').value;
      const note = document.getElementById('bulkNote').value;

      if (!roomId || !start || !end) return;

      const formData = new FormData();
      formData.append('bulk_update', '1');
      formData.append('room_id', roomId);
      formData.append('start_date', start);
      formData.append('end_date', end);
      formData.append('status', status);
      formData.append('note', note);

      this.disabled = true;
      this.innerHTML = '<span class="spinner-border spinner-border-sm me-1"></span>...';

      fetch('ajax/room_calendar.php', { method: 'POST', body: formData })
        .then(r => r.json())
        .then(data => {
          this.disabled = false;
          this.innerHTML = '<i class="bi bi-check2 me-1"></i><?php echo __("cal_apply") ?>';
          if (data.success) {
            bootstrap.Modal.getInstance(document.getElementById('bulkModal'))?.hide();
            loadCalendar(currentMonth, currentYear);
          }
        });
    });

    function updateBulkRoomSelect(rooms) {
      const sel = document.getElementById('bulkRoom');
      sel.innerHTML = '';
      rooms.forEach(r => {
        const opt = document.createElement('option');
        opt.value = r.id;
        opt.textContent = (r.code ? r.code + ' - ' : '') + r.name;
        sel.appendChild(opt);
      });
    }

    // Navigation
    document.getElementById('btnPrevMonth').addEventListener('click', () => {
      currentMonth--;
      if (currentMonth < 1) { currentMonth = 12; currentYear--; }
      loadCalendar(currentMonth, currentYear);
    });
    document.getElementById('btnNextMonth').addEventListener('click', () => {
      currentMonth++;
      if (currentMonth > 12) { currentMonth = 1; currentYear++; }
      loadCalendar(currentMonth, currentYear);
    });
    document.getElementById('btnToday').addEventListener('click', () => {
      currentMonth = new Date().getMonth() + 1;
      currentYear = new Date().getFullYear();
      loadCalendar(currentMonth, currentYear);
    });

    // Helpers
    function escHtml(s) { const d = document.createElement('div'); d.textContent = s; return d.innerHTML; }
    function escAttr(s) { return s.replace(/"/g, '&quot;').replace(/'/g, '&#39;'); }
    function formatDate(s) {
      const parts = s.split('-');
      return parts[2] + '/' + parts[1] + '/' + parts[0];
    }

    // Init
    loadCalendar(currentMonth, currentYear);
  })();
  </script>

</body>
</html>
