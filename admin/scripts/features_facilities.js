/**
 * Features & Facilities — with client-side search + pagination
 */

/* ── Table Manager ── */
function TableManager(tbodyId, searchId, paginationId, countId, pageSize) {
  this.tbody       = document.getElementById(tbodyId);
  this.searchEl    = document.getElementById(searchId);
  this.paginationEl= document.getElementById(paginationId);
  this.countEl     = document.getElementById(countId);
  this.pageSize    = pageSize || 8;
  this.currentPage = 1;
  this.allRows     = [];
  this.filteredRows= [];

  var self = this;
  if (this.searchEl) {
    this.searchEl.addEventListener('input', function () {
      self.currentPage = 1;
      self._filter();
      self._render();
    });
  }
}

TableManager.prototype.load = function (html) {
  var tmp = document.createElement('tbody');
  tmp.innerHTML = html;
  this.allRows = Array.from(tmp.querySelectorAll('tr'));
  if (this.countEl) this.countEl.textContent = this.allRows.length;
  this.currentPage = 1;
  this._filter();
  this._render();
};

TableManager.prototype._filter = function () {
  var q = this.searchEl ? this.searchEl.value.toLowerCase().trim() : '';
  this.filteredRows = q
    ? this.allRows.filter(function (r) { return r.textContent.toLowerCase().indexOf(q) >= 0; })
    : this.allRows.slice();
};

TableManager.prototype._render = function () {
  var start    = (this.currentPage - 1) * this.pageSize;
  var pageRows = this.filteredRows.slice(start, start + this.pageSize);

  this.tbody.innerHTML = '';

  if (pageRows.length === 0) {
    var empty = document.createElement('tr');
    empty.innerHTML = '<td colspan="10" class="text-center py-5" style="color:#64748b;font-size:14px;">' +
      '<i class="bi bi-inbox me-2" style="font-size:20px;opacity:.4;"></i>Không tìm thấy dữ liệu</td>';
    this.tbody.appendChild(empty);
  } else {
    pageRows.forEach(function (r) {
      this.tbody.appendChild(r.cloneNode(true));
    }, this);
  }

  this._renderPagination();
};

TableManager.prototype._renderPagination = function () {
  if (!this.paginationEl) return;
  var total      = this.filteredRows.length;
  var totalPages = Math.ceil(total / this.pageSize) || 1;
  var start      = total > 0 ? (this.currentPage - 1) * this.pageSize + 1 : 0;
  var end        = Math.min(this.currentPage * this.pageSize, total);
  var self       = this;

  var infoHtml = '<span style="color:#64748b;font-size:12px;font-family:\'JetBrains Mono\',monospace;">' +
    (total > 0 ? (start + '–' + end + ' / ' + total + ' mục') : 'Không có dữ liệu') + '</span>';

  var pagesHtml = '';
  if (totalPages > 1) {
    pagesHtml += '<div class="pgn-group">';
    pagesHtml += '<button class="pgn-btn" data-page="' + (this.currentPage - 1) + '"' +
      (this.currentPage === 1 ? ' disabled' : '') + '>‹</button>';

    for (var p = 1; p <= totalPages; p++) {
      var show = (p === 1 || p === totalPages ||
                  p === this.currentPage || p === this.currentPage - 1 || p === this.currentPage + 1);
      if (show) {
        var active = p === this.currentPage ? ' pgn-active' : '';
        pagesHtml += '<button class="pgn-btn' + active + '" data-page="' + p + '">' + p + '</button>';
      } else if (p === this.currentPage - 2 || p === this.currentPage + 2) {
        pagesHtml += '<span class="pgn-ellipsis">…</span>';
      }
    }

    pagesHtml += '<button class="pgn-btn" data-page="' + (this.currentPage + 1) + '"' +
      (this.currentPage === totalPages ? ' disabled' : '') + '>›</button>';
    pagesHtml += '</div>';
  }

  this.paginationEl.innerHTML = infoHtml + pagesHtml;

  this.paginationEl.querySelectorAll('.pgn-btn:not([disabled])').forEach(function (btn) {
    btn.addEventListener('click', function () {
      var page = parseInt(btn.getAttribute('data-page'));
      if (page >= 1 && page <= totalPages) {
        self.currentPage = page;
        self._render();
      }
    });
  });
};

/* ── Table instances ── */
var tmRoomType = new TableManager('room-type-data', 'search-room-type', 'pagination-room-type', 'count-room-type', 5);
var tmFeature  = new TableManager('features-data',  'search-feature',   'pagination-feature',   'count-feature',   5);
var tmFacility = new TableManager('facilities-data','search-facility',  'pagination-facility',  'count-facility',  5);

/* ── AJAX helpers ── */
function post(url, data, onLoad) {
  var xhr = new XMLHttpRequest();
  xhr.open('POST', url, true);
  xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
  xhr.onload = function () { onLoad(this.responseText); };
  xhr.send(data);
}

function postForm(url, formData, onLoad) {
  var xhr = new XMLHttpRequest();
  xhr.open('POST', url, true);
  xhr.onload = function () { onLoad(this.responseText); };
  xhr.send(formData);
}

/* ── Room Types ── */
function get_room_types() {
  post('ajax/features_facilities.php', 'get_room_types', function (html) {
    tmRoomType.load(html);
  });
}

function add_room_type() {
  var form = document.getElementById('room_type_s_form');
  var data = new FormData();
  data.append('name', form.elements['roomtype_name'].value);
  data.append('add_room_type', '');

  postForm('ajax/features_facilities.php', data, function (res) {
    var modal = bootstrap.Modal.getInstance(document.getElementById('room-type-s'));
    modal.hide();
    if (res == 1) {
      toast.success('Đã thêm loại căn hộ mới!');
      form.reset();
      get_room_types();
    } else {
      toast.error('Thêm thất bại. Vui lòng thử lại!');
    }
  });
}

function rem_room_type(id) {
  if (!confirm('Xác nhận xoá loại căn hộ này?')) return;
  var xhr = new XMLHttpRequest();
  xhr.open('POST', 'ajax/features_facilities.php', true);
  xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
  xhr.onload = function () {
    if (this.responseText == 1) {
      toast.success('Đã xoá loại căn hộ!');
      get_room_types();
    } else if (this.responseText === 'room_added') {
      toast.error('Không thể xoá: loại phòng này đang được sử dụng!');
    } else {
      toast.error('Xoá thất bại. Vui lòng thử lại!');
    }
  };
  xhr.send('rem_room_type=' + id);
}

/* ── Features ── */
function get_features() {
  post('ajax/features_facilities.php', 'get_features', function (html) {
    tmFeature.load(html);
  });
}

function add_feature() {
  var form = document.getElementById('feature_s_form');
  var data = new FormData();
  data.append('name', form.elements['feature_name'].value);
  data.append('add_feature', '');

  postForm('ajax/features_facilities.php', data, function (res) {
    var modal = bootstrap.Modal.getInstance(document.getElementById('feature-s'));
    modal.hide();
    if (res == 1) {
      toast.success('Đã thêm không gian mới!');
      form.elements['feature_name'].value = '';
      get_features();
    } else {
      toast.error('Thêm thất bại. Vui lòng thử lại!');
    }
  });
}

function rem_feature(id) {
  if (!confirm('Xác nhận xoá không gian này?')) return;
  var xhr = new XMLHttpRequest();
  xhr.open('POST', 'ajax/features_facilities.php', true);
  xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
  xhr.onload = function () {
    if (this.responseText == 1) {
      toast.success('Đã xoá không gian!');
      get_features();
    } else if (this.responseText === 'room_added') {
      toast.error('Không thể xoá: không gian này đang được sử dụng!');
    } else {
      toast.error('Xoá thất bại. Vui lòng thử lại!');
    }
  };
  xhr.send('rem_feature=' + id);
}

/* ── Facilities ── */
function get_facilities() {
  post('ajax/features_facilities.php', 'get_facilities', function (html) {
    tmFacility.load(html);
  });
}

function add_facility() {
  var form = document.getElementById('facility_s_form');
  var data = new FormData();
  data.append('name', form.elements['facility_name'].value);
  data.append('icon', form.elements['facility_icon'].files[0]);
  data.append('desc', form.elements['facility_desc'].value);
  data.append('add_facility', '');

  postForm('ajax/features_facilities.php', data, function (res) {
    var modal = bootstrap.Modal.getInstance(document.getElementById('facility-s'));
    modal.hide();
    if (res === 'inv_img') {
      toast.error('Chỉ chấp nhận file SVG!');
    } else if (res === 'inv_size') {
      toast.error('File phải nhỏ hơn 1MB!');
    } else if (res === 'upd_failed') {
      toast.error('Upload thất bại. Vui lòng thử lại!');
    } else {
      toast.success('Đã thêm tiện ích mới!');
      form.reset();
      get_facilities();
    }
  });
}

function rem_facility(id) {
  if (!confirm('Xác nhận xoá tiện ích này?')) return;
  var xhr = new XMLHttpRequest();
  xhr.open('POST', 'ajax/features_facilities.php', true);
  xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
  xhr.onload = function () {
    if (this.responseText == 1) {
      toast.success('Đã xoá tiện ích!');
      get_facilities();
    } else if (this.responseText === 'room_added') {
      toast.error('Không thể xoá: tiện ích này đang được sử dụng!');
    } else {
      toast.error('Xoá thất bại. Vui lòng thử lại!');
    }
  };
  xhr.send('rem_facility=' + id);
}

/* ── Form submit bindings ── */
document.getElementById('room_type_s_form').addEventListener('submit', function (e) {
  e.preventDefault();
  add_room_type();
});

document.getElementById('feature_s_form').addEventListener('submit', function (e) {
  e.preventDefault();
  add_feature();
});

document.getElementById('facility_s_form').addEventListener('submit', function (e) {
  e.preventDefault();
  add_facility();
});

/* ── Init ── */
window.addEventListener('load', function () {
  get_room_types();
  get_features();
  get_facilities();
});
