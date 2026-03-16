window.show_user_detail = function (id) {
  _currentDetailUserId = id;
  var body    = document.getElementById('user-detail-body');
  var modalEl = document.getElementById('user-detail-modal');

  body.innerHTML = '<div class="text-center py-4"><div class="spinner-border text-secondary"></div></div>';
  bootstrap.Modal.getOrCreateInstance(modalEl).show();

  var xhr = new XMLHttpRequest();
  xhr.open("POST", "ajax/users.php", true);
  xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
  xhr.onload = function () { body.innerHTML = this.responseText; };
  xhr.send('get_user=' + id);
};

window.toggle_status = function (id, val) {
  var xhr = new XMLHttpRequest();
  xhr.open("POST", "ajax/users.php", true);
  xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
  xhr.onload = function () {
    if (this.responseText == 1) {
      alert('success', 'Cập nhật trạng thái thành công!');
      get_users();
      if (_currentDetailUserId) show_user_detail(_currentDetailUserId);
    } else {
      alert('error', 'Thao tác thất bại!');
    }
  };
  xhr.send('toggle_status=' + id + '&value=' + val);
};

window.remove_user = function (user_id) {
  if (!confirm("Bạn có chắc muốn xoá người dùng này?")) return;
  var data = new FormData();
  data.append('user_id', user_id);
  data.append('remove_user', '');

  var xhr = new XMLHttpRequest();
  xhr.open("POST", "ajax/users.php", true);
  xhr.onload = function () {
    if (this.responseText == 1) {
      alert('success', 'Đã xoá người dùng!');
      bootstrap.Modal.getOrCreateInstance(document.getElementById('user-detail-modal')).hide();
      _currentDetailUserId = null;
      get_users();
    } else {
      alert('error', 'Xoá thất bại!');
    }
  };
  xhr.send(data);
};

var _currentDetailUserId = null;

function get_users() {
  var xhr = new XMLHttpRequest();
  xhr.open("POST", "ajax/users.php", true);
  xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
  xhr.onload = function () {
    document.getElementById('users-data').innerHTML = this.responseText;
  };
  xhr.send('get_users');
}

function search_user(username) {
  var xhr = new XMLHttpRequest();
  xhr.open("POST", "ajax/users.php", true);
  xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
  xhr.onload = function () {
    document.getElementById('users-data').innerHTML = this.responseText;
  };
  xhr.send('search_user&name=' + username);
}

get_users();
