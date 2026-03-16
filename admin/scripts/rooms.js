let add_room_form = document.getElementById("add_room_form");

add_room_form.addEventListener("submit", function (e) {
  e.preventDefault();
  add_room();
});

async function add_room() {
  let data = new FormData();
  data.append("add_room", "");
  data.append("name", add_room_form.elements["name"].value);
  data.append("room_type_id", add_room_form.elements["room_type_id"].value);
  data.append("property_type_id", add_room_form.elements["property_type_id"].value);
  data.append("building_id", add_room_form.elements["building_id"].value);
  data.append("area", add_room_form.elements["area"].value);
  data.append("price", add_room_form.elements["price"].value);
  data.append("adult", add_room_form.elements["adult"].value);
  data.append("children", add_room_form.elements["children"].value);
  data.append("desc", add_room_form.elements["desc"].value);

  let features = [];
  add_room_form.elements["features"].forEach((el) => {
    if (el.checked) features.push(el.value);
  });

  let facilities = [];
  add_room_form.elements["facilities"].forEach((el) => {
    if (el.checked) facilities.push(el.value);
  });

  data.append("features", JSON.stringify(features));
  data.append("facilities", JSON.stringify(facilities));

  let xhr = new XMLHttpRequest();
  xhr.open("POST", "ajax/rooms.php", true);

  xhr.onload = async function () {
    var room_id = parseInt(this.responseText);

    var myModal = document.getElementById("add-room");
    var modal = bootstrap.Modal.getInstance(myModal);
    modal.hide();

    if (room_id > 0) {
      var imageFile = add_room_form.elements["room_image"].files[0];
      if (imageFile) {
        try {
          imageFile = await convertHeicIfNeeded(imageFile);
        } catch (e) {
          alert("error", "Không thể convert ảnh HEIC. Vui lòng chọn JPG/PNG/WEBP.");
          add_room_form.reset();
          get_all_rooms();
          return;
        }

        var imgData = new FormData();
        imgData.append("add_image", "");
        imgData.append("room_id", room_id);
        imgData.append("image", imageFile);

        var xhr2 = new XMLHttpRequest();
        xhr2.open("POST", "ajax/rooms.php", true);
        xhr2.onload = function () {
          add_room_form.reset();
          get_all_rooms();
          if (this.responseText == "inv_img") {
            alert("error", "Chỉ chấp nhận JPG, PNG, WEBP!");
          } else if (this.responseText == "inv_size") {
            alert("error", "Ảnh phải nhỏ hơn 2MB!");
          } else {
            alert("success", "Thêm phòng và ảnh thành công!");
          }
        };
        xhr2.send(imgData);
      } else {
        alert("success", "Thêm phòng thành công!");
        add_room_form.reset();
        get_all_rooms();
      }
    } else {
      alert("error", "Lỗi máy chủ!");
    }
  };

  xhr.send(data);
}

function get_all_rooms() {
  let xhr = new XMLHttpRequest();
  xhr.open("POST", "ajax/rooms.php", true);
  xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

  xhr.onload = function () {
    document.getElementById("room-data").innerHTML = this.responseText;
  };

  xhr.send("get_all_rooms");
}

let edit_room_form = document.getElementById("edit_room_form");

function edit_details(id) {
  // Bỏ chọn tất cả checkbox trước khi điền dữ liệu mới
  edit_room_form.elements["features"].forEach((el) => { el.checked = false; });
  edit_room_form.elements["facilities"].forEach((el) => { el.checked = false; });

  let xhr = new XMLHttpRequest();
  xhr.open("POST", "ajax/rooms.php", true);
  xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

  xhr.onload = function () {
    let data = JSON.parse(this.responseText);

    edit_room_form.elements["name"].value = data.roomdata.name;
    edit_room_form.elements["room_type_id"].value = data.roomdata.room_type_id;
    edit_room_form.elements["property_type_id"].value = data.roomdata.property_type_id || "";
    edit_room_form.elements["building_id"].value = data.roomdata.building_id || "";
    edit_room_form.elements["area"].value = data.roomdata.area;
    edit_room_form.elements["price"].value = data.roomdata.price;
    edit_room_form.elements["adult"].value = data.roomdata.adult;
    edit_room_form.elements["children"].value = data.roomdata.children;
    edit_room_form.elements["desc"].value = data.roomdata.description;
    edit_room_form.elements["room_id"].value = data.roomdata.id;

    edit_room_form.elements["features"].forEach((el) => {
      el.checked = data.features.includes(Number(el.value));
    });

    edit_room_form.elements["facilities"].forEach((el) => {
      el.checked = data.facilities.includes(Number(el.value));
    });
  };

  xhr.send("get_room=" + id);
}

edit_room_form.addEventListener("submit", function (e) {
  e.preventDefault();
  submit_edit_room();
});

function submit_edit_room() {
  let data = new FormData();
  data.append("edit_room", "");
  data.append("room_id", edit_room_form.elements["room_id"].value);
  data.append("name", edit_room_form.elements["name"].value);
  data.append("room_type_id", edit_room_form.elements["room_type_id"].value);
  data.append("property_type_id", edit_room_form.elements["property_type_id"].value);
  data.append("building_id", edit_room_form.elements["building_id"].value);
  data.append("area", edit_room_form.elements["area"].value);
  data.append("price", edit_room_form.elements["price"].value);
  data.append("adult", edit_room_form.elements["adult"].value);
  data.append("children", edit_room_form.elements["children"].value);
  data.append("desc", edit_room_form.elements["desc"].value);

  let features = [];
  edit_room_form.elements["features"].forEach((el) => {
    if (el.checked) features.push(el.value);
  });

  let facilities = [];
  edit_room_form.elements["facilities"].forEach((el) => {
    if (el.checked) facilities.push(el.value);
  });

  data.append("features", JSON.stringify(features));
  data.append("facilities", JSON.stringify(facilities));

  let xhr = new XMLHttpRequest();
  xhr.open("POST", "ajax/rooms.php", true);

  xhr.onload = function () {
    var myModal = document.getElementById("edit-room");
    var modal = bootstrap.Modal.getInstance(myModal);
    modal.hide();

    if (this.responseText == 1) {
      alert("success", "Cập nhật phòng thành công!");
      edit_room_form.reset();
      get_all_rooms();
    } else {
      alert("error", "Lỗi máy chủ!");
    }
  };

  xhr.send(data);
}

function toggle_status(id, val) {
  let xhr = new XMLHttpRequest();
  xhr.open("POST", "ajax/rooms.php", true);
  xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

  xhr.onload = function () {
    if (this.responseText == 1) {
      alert("success", "Status toggled!");
      get_all_rooms();
    } else {
      alert("success", "Server Down!");
    }
  };

  xhr.send("toggle_status=" + id + "&value=" + val);
}

let add_image_form = document.getElementById("add_image_form");

add_image_form.addEventListener("submit", function (e) {
  e.preventDefault();
  add_image();
});

async function add_image() {
  let imageFile = add_image_form.elements["image"].files[0];

  try {
    imageFile = await convertHeicIfNeeded(imageFile);
  } catch (e) {
    alert("error", "Không thể convert ảnh HEIC. Vui lòng chọn JPG/PNG/WEBP.", "image-alert");
    return;
  }

  let data = new FormData();
  data.append("image", imageFile);
  data.append("room_id", add_image_form.elements["room_id"].value);
  data.append("add_image", "");

  let xhr = new XMLHttpRequest();
  xhr.open("POST", "ajax/rooms.php", true);

  xhr.onload = function () {
    if (this.responseText == "inv_img") {
      alert("error", "Chỉ chấp nhận JPG, PNG, WEBP!", "image-alert");
    } else if (this.responseText == "inv_size") {
      alert("error", "Ảnh phải nhỏ hơn 2MB!", "image-alert");
    } else if (this.responseText == "upd_failed") {
      alert("error", "Tải ảnh thất bại!", "image-alert");
    } else {
      alert("success", "Thêm ảnh thành công!", "image-alert");
      room_images(
        add_image_form.elements["room_id"].value,
        document.querySelector("#room-images .modal-title").innerText,
      );
      add_image_form.reset();
    }
  };
  xhr.send(data);
}

function room_images(id, rname) {
  document.querySelector("#room-images .modal-title").innerText = rname;
  add_image_form.elements["room_id"].value = id;
  add_image_form.elements["image"].value = "";

  let xhr = new XMLHttpRequest();
  xhr.open("POST", "ajax/rooms.php", true);
  xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

  xhr.onload = function () {
    document.getElementById("room-image-data").innerHTML = this.responseText;
  };

  xhr.send("get_room_images=" + id);
}

function rem_image(img_id, room_id) {
  let data = new FormData();
  data.append("image_id", img_id);
  data.append("room_id", room_id);
  data.append("rem_image", "");

  let xhr = new XMLHttpRequest();
  xhr.open("POST", "ajax/rooms.php", true);

  xhr.onload = function () {
    if (this.responseText == 1) {
      alert("success", "Image Removed!", "image-alert");
      room_images(
        room_id,
        document.querySelector("#room-images .modal-title").innerText,
      );
    } else {
      alert("error", "Image removal failed!", "image-alert");
    }
  };
  xhr.send(data);
}

function thumb_image(img_id, room_id) {
  let data = new FormData();
  data.append("image_id", img_id);
  data.append("room_id", room_id);
  data.append("thumb_image", "");

  let xhr = new XMLHttpRequest();
  xhr.open("POST", "ajax/rooms.php", true);

  xhr.onload = function () {
    if (this.responseText == 1) {
      alert("success", "Image Thumbnail Changed!", "image-alert");
      room_images(
        room_id,
        document.querySelector("#room-images .modal-title").innerText,
      );
    } else {
      alert("error", "Thumbnail update failed!", "image-alert");
    }
  };
  xhr.send(data);
}

function remove_room(room_id) {
  if (confirm("Are you sure, you want to delete this room?")) {
    let data = new FormData();
    data.append("room_id", room_id);
    data.append("remove_room", "");

    let xhr = new XMLHttpRequest();
    xhr.open("POST", "ajax/rooms.php", true);

    xhr.onload = function () {
      if (this.responseText == 1) {
        alert("success", "Room Removed!");
        get_all_rooms();
      } else {
        alert("error", "Room removal failed!");
      }
    };
    xhr.send(data);
  }
}

window.onload = function () {
  get_all_rooms();
};
