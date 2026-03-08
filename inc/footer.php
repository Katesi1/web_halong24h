<div class="container-fluid bg-white mt-5">
  <div class="row">
    <div class="col-lg-4 p-4">
      <h3 class="h-font fw-bold fs-3 mb-2"><?php echo $settings_r['site_title'] ?></h3>
      <p>
        <?php echo $settings_r['site_about'] ?>
      </p>
    </div>
    <div class="col-lg-4 p-4">
      <h5 class="mb-3">Liên kết</h5>
      <a href="index.php" class="d-inline-block mb-2 text-dark text-decoration-none">Trang chủ</a> <br>
      <a href="rooms.php" class="d-inline-block mb-2 text-dark text-decoration-none">Danh sách phòng</a> <br>
      <a href="services.php" class="d-inline-block mb-2 text-dark text-decoration-none">Dịch Vụ</a> <br>
      <a href="specialties.php" class="d-inline-block mb-2 text-dark text-decoration-none">Đặc sản Hạ Long</a> <br>
      <a href="blog.php" class="d-inline-block mb-2 text-dark text-decoration-none">Blog cẩm nang</a> <br>
      <a href="contact.php" class="d-inline-block mb-2 text-dark text-decoration-none">Liên hệ</a>
    </div>
    <div class="col-lg-4 p-4">
      <h5 class="mb-3">Theo dõi chúng tôi</h5>
      <?php
      if ($contact_r['tw'] != '') {
        echo <<<data
              <a href="$contact_r[tw]" class="d-inline-block text-dark text-decoration-none mb-2">
                <i class="bi bi-twitter me-1"></i> Twitter
              </a><br>
            data;
      }
      ?>
      <a href="<?php echo htmlspecialchars($contact_r['fb'] ?? '') ?>" class="d-inline-block text-dark text-decoration-none mb-2">
        <i class="bi bi-facebook me-1"></i> Facebook
      </a><br>
      <a href="<?php echo htmlspecialchars($contact_r['zalo'] ?? '') ?>" class="d-inline-block text-dark text-decoration-none">
        <i class="bi bi-chat-dots-fill me-1"></i> Zalo
      </a><br>
    </div>
  </div>
</div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

<script>
  // Inject contact data for floating widget
  window.floatingContactData = {
    phone: '+<?php echo $contact_r['pn1'] ?>',
    facebook: '<?php echo $contact_r['fb'] ?>',
    zalo: '<?php echo $contact_r['zalo'] ?>'
  };
</script>
<script src="js/floating-contact.js"></script>

<script>
  function alert(type, msg, position = 'body') {
    let bs_class = (type == 'success') ? 'alert-success' : 'alert-danger';
    let element = document.createElement('div');
    element.innerHTML = `
      <div class="alert ${bs_class} alert-dismissible fade show" role="alert">
        <strong class="me-3">${msg}</strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    `;

    if (position == 'body') {
      document.body.append(element);
      element.classList.add('custom-alert');
    } else {
      document.getElementById(position).appendChild(element);
    }
    setTimeout(remAlert, 3000);
  }

  function remAlert() {
    document.getElementsByClassName('alert')[0].remove();
  }

  function setActive() {
    let navbar = document.getElementById('nav-bar');
    let a_tags = navbar.getElementsByTagName('a');

    for (i = 0; i < a_tags.length; i++) {
      let file = a_tags[i].href.split('/').pop();
      let file_name = file.split('.')[0];

      if (document.location.href.indexOf(file_name) >= 0) {
        a_tags[i].classList.add('active');
      }

    }
  }

  // ===== Toggle hiện/ẩn mật khẩu =====
  function togglePassVis(inputId, btn) {
    const input = document.getElementById(inputId);
    const icon  = btn.querySelector('i');
    if (input.type === 'password') {
      input.type = 'text';
      icon.classList.replace('bi-eye-slash', 'bi-eye');
    } else {
      input.type = 'password';
      icon.classList.replace('bi-eye', 'bi-eye-slash');
    }
  }

  // ===== Password strength checker =====
  const PASS_REGEX = {
    len:     { re: /.{8,}/,           id: 'rule-len'     },
    upper:   { re: /[A-Z]/,           id: 'rule-upper'   },
    lower:   { re: /[a-z]/,           id: 'rule-lower'   },
    num:     { re: /[0-9]/,           id: 'rule-num'     },
    special: { re: /[^A-Za-z0-9]/,   id: 'rule-special' },
  };

  const STRENGTH_LEVELS = [
    { label: '',         color: '',        pct: 0   },
    { label: 'Yếu',     color: '#e74c3c', pct: 20  },
    { label: 'Yếu',     color: '#e74c3c', pct: 40  },
    { label: 'Trung bình', color: '#f39c12', pct: 60 },
    { label: 'Khá',     color: '#3498db', pct: 80  },
    { label: 'Mạnh',    color: '#2D6A4F', pct: 100 },
  ];

  function checkPassStrength(val) {
    let score = 0;
    for (const key in PASS_REGEX) {
      const ok = PASS_REGEX[key].re.test(val);
      const li = document.getElementById(PASS_REGEX[key].id);
      if (!li) continue;
      li.classList.toggle('ok', ok);
      li.querySelector('i').className = ok ? 'bi bi-check-circle-fill' : 'bi bi-x-circle-fill';
      if (ok) score++;
    }
    const lvl = STRENGTH_LEVELS[score];
    const fill  = document.getElementById('strength-fill');
    const label = document.getElementById('strength-label');
    if (fill)  { fill.style.width = lvl.pct + '%'; fill.style.background = lvl.color; }
    if (label) { label.textContent = lvl.label; label.style.color = lvl.color; }
    return score;
  }

  function isStrongPass(val) {
    return Object.values(PASS_REGEX).every(r => r.re.test(val));
  }

  const regPassInput = document.getElementById('reg-pass');
  if (regPassInput) {
    regPassInput.addEventListener('input', () => checkPassStrength(regPassInput.value));
  }

  // ===== Register form =====
  let register_form = document.getElementById('register-form');

  if (register_form) register_form.addEventListener('submit', (e) => {
    e.preventDefault();

    const passVal = register_form.elements['pass'].value;
    if (!isStrongPass(passVal)) {
      alert('error', 'Mật khẩu phải có ít nhất 8 ký tự gồm chữ hoa, thường, số và ký tự đặc biệt!');
      return;
    }
    if (passVal !== register_form.elements['cpass'].value) {
      alert('error', 'Mật khẩu xác nhận không khớp!');
      return;
    }

    let data = new FormData();
    data.append('name', register_form.elements['name'].value);
    data.append('email', register_form.elements['email'].value);
    data.append('phonenum', register_form.elements['phonenum'].value);
    data.append('pass', passVal);
    data.append('cpass', register_form.elements['cpass'].value);
    data.append('register', '');

    var myModal = document.getElementById('registerModal');
    var modal = bootstrap.Modal.getInstance(myModal);
    modal.hide();

    let xhr = new XMLHttpRequest();
    xhr.open("POST", "ajax/login_register.php", true);

    xhr.onload = function() {
      if (this.responseText == 'pass_mismatch') {
        alert('error', "Mật khẩu không trùng khớp!");
      } else if (this.responseText == 'pass_weak') {
        alert('error', "Mật khẩu phải có ít nhất 8 ký tự gồm chữ hoa, thường, số và ký tự đặc biệt!");
      } else if (this.responseText == 'email_already') {
        alert('error', "Email này đã được đăng ký!");
      } else if (this.responseText == 'phone_already') {
        alert('error', "Số điện thoại này đã được đăng ký!");
      } else if (this.responseText == 'registration_failed') {
        alert('error', "Đăng ký thất bại! Vui lòng thử lại.");
      } else if (this.responseText == 'registration_success') {
        alert('success', "Đăng ký thành công! Bạn có thể đăng nhập ngay.");
        register_form.reset();
      }
    };

    xhr.send(data);
  });

  let login_form = document.getElementById('login-form');

  if (login_form) login_form.addEventListener('submit', function(e) {
    e.preventDefault();
    let data = new FormData(this);
    data.append('login', '');

    fetch('ajax/login_register.php', {
      method: 'POST',
      body: data
    }).then(response => response.text()).then(result => {
      if (result === 'login_success') {
        var myModal = document.getElementById('loginModal');
        var modal = bootstrap.Modal.getInstance(myModal);
        if (modal) modal.hide();
        alert('success', "Đăng nhập thành công!");
        setTimeout(() => { window.location.reload(); }, 800);
      } else if (result === 'invalid_password') {
        alert('error', "Mật khẩu không chính xác!");
      } else if (result === 'invalid_email_mob') {
        alert('error', "Email hoặc số điện thoại không tồn tại!");
      } else {
        alert('error', "Đăng nhập thất bại! Vui lòng thử lại.");
      }
    });
  });

  // let forgot_form = document.getElementById('forgot-form');

  // forgot_form.addEventListener('submit', (e)=>{
  //   e.preventDefault();

  //   let data = new FormData();

  //   data.append('email',forgot_form.elements['email'].value);
  //   data.append('forgot_pass','');

  //   var myModal = document.getElementById('forgotModal');
  //   var modal = bootstrap.Modal.getInstance(myModal);
  //   modal.hide();

  //   let xhr = new XMLHttpRequest();
  //   xhr.open("POST","ajax/login_register.php",true);

  //   xhr.onload = function(){
  //     if(this.responseText == 'inv_email'){
  //       alert('error',"Invalid Email !");
  //     }
  //     else if(this.responseText == 'not_verified'){
  //       alert('error',"Email is not verified! Please contact Admin");
  //     }
  //     else if(this.responseText == 'inactive'){
  //       alert('error',"Account Suspended! Please contact Admin.");
  //     }
  //     else if(this.responseText == 'mail_failed'){
  //       alert('error',"Cannot send email. Server Down!");
  //     }
  //     else if(this.responseText == 'upd_failed'){
  //       alert('error',"Account recovery failed. Server Down!");
  //     }
  //     else{
  //       alert('success',"Reset link sent to email!");
  //       forgot_form.reset();
  //     }
  //   }

  //   xhr.send(data);
  // });

  function checkLoginToBook(status, room_id) {
    // Cho phép đặt phòng mà không cần đăng nhập
    window.location.href = 'confirm_booking.php?id=' + room_id;
  }

  setActive();
</script>