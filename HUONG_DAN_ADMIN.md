# HUONG DAN SU DUNG TRANG QUAN TRI - HALONG24H

---

## MUC LUC

1. [Dang nhap](#1-dang-nhap)
2. [Tong quan (Dashboard)](#2-tong-quan-dashboard)
3. [Quan ly Phong](#3-quan-ly-phong)
4. [Quan ly Dat phong](#4-quan-ly-dat-phong)
5. [Quan ly Nguoi dung](#5-quan-ly-nguoi-dung)
6. [Quan ly Danh gia](#6-quan-ly-danh-gia)
7. [Quan ly Tin nhan](#7-quan-ly-tin-nhan)
8. [Quan ly Carousel (Slider)](#8-quan-ly-carousel-slider)
9. [Quan ly Loai phong & Tien ich](#9-quan-ly-loai-phong--tien-ich)
10. [Cai dat](#10-cai-dat)

---

## 1. DANG NHAP

**Duong dan:** `/admin/` hoac `/admin/index.php`

### Chuc nang
- Xac thuc tai khoan quan tri vien de truy cap he thong.

### Luong hoat dong
1. Truy cap trang dang nhap admin
2. Nhap **Ten dang nhap** va **Mat khau**
3. Nhan nut **Dang nhap**
4. He thong kiem tra thong tin trong bang `admin_cred`
5. Neu dung -> chuyen den **Dashboard**
6. Neu sai -> hien thong bao loi

### Cach su dung
- Tai khoan mac dinh: `admin` / `Abcd@1234`
- Sau khi dang nhap, phien lam viec duoc luu trong session
- De **dang xuat**: nhan nut avatar/ten o goc tren phai -> chon **Dang xuat**

---

## 2. TONG QUAN (Dashboard)

**Duong dan:** `/admin/dashboard.php`

### Chuc nang
- Hien thi tong quan toan bo hoat dong cua he thong bang cac the thong ke va bieu do.

### Cac the thong ke hien thi
| The | Mo ta |
|-----|-------|
| Tong so phong | So luong phong dang hoat dong (nhan vao de chuyen sang trang Phong) |
| Tong dat phong | Tong so luot dat phong tu truoc den nay |
| Tong doanh thu | Tong tien thu duoc (VND) |
| Dat phong moi | So dat phong dang cho xu ly |
| Yeu cau hoan tien | So don huy dang cho hoan tien |
| Tin nhan chua doc | So tin nhan tu form lien he chua xem |
| Danh gia chua xem | So danh gia moi chua duyet |
| Tong nguoi dung | So tai khoan da dang ky (kem so dang hoat dong) |

### Bieu do phan tich
- **Bieu do Dat phong**: Hien thi xu huong dat phong, huy phong, doanh thu theo thoi gian
- **Bieu do Nguoi dung**: Hien thi xu huong dang ky, tin nhan, danh gia
- Co the chon ky phan tich: **30 ngay / 90 ngay / 365 ngay / Toan bo**

### Luong hoat dong
1. Mo Dashboard -> he thong tu dong tai du lieu thong ke
2. Xem tong quan nhanh qua cac the so lieu
3. Nhan vao tung the de chuyen sang trang quan ly tuong ung
4. Chon ky thoi gian tren bieu do de phan tich xu huong

---

## 3. QUAN LY PHONG

**Duong dan:** `/admin/rooms.php`

### Chuc nang
- Them, sua, xoa, bat/tat trang thai phong
- Quan ly anh phong (them, xoa, dat anh chinh)

### 3.1. Them phong moi

**Luong:**
1. Nhan nut **Them phong**
2. Dien thong tin vao form:
   - **Ten phong** (bat buoc)
   - **Loai phong** - chon tu danh sach (Villa 4PN, Penthouse, Can ho 3PN...)
   - **Dien tich** (m2)
   - **Gia** (VND) - nhap 0 neu muon hien thi "Lien he"
   - **So nguoi lon** va **So tre em** tieu chuan
   - **Anh dai dien** - chon file anh (ho tro HEIC/HEIF tu dong chuyen doi)
   - **Dac diem** - tich chon: Phong ngu, Ban cong, Nha bep, View bien...
   - **Tien ich** - tich chon: WiFi, Dieu hoa, Smart TV, Be boi...
   - **Mo ta** - nhap noi dung mo ta chi tiet
3. Nhan **Luu** -> phong duoc them vao he thong

### 3.2. Sua thong tin phong

**Luong:**
1. Trong danh sach phong, nhan nut **Sua** (icon but chi) tren dong phong can sua
2. Form hien ra voi du lieu hien tai da dien san
3. Chinh sua cac truong can thay doi
4. Nhan **Cap nhat** -> luu thay doi

### 3.3. Bat/Tat trang thai phong

**Luong:**
1. Nhan nut **Trang thai** (icon toggle) tren dong phong
2. Phong dang **Hoat dong** -> chuyen sang **Tam ngung** (khong hien tren trang chu)
3. Phong dang **Tam ngung** -> chuyen sang **Hoat dong**

### 3.4. Quan ly anh phong

**Luong:**
1. Nhan nut **Quan ly anh** (icon hinh anh) tren dong phong
2. Modal hien thi tat ca anh hien co cua phong
3. **Them anh**: Nhan nut upload, chon file anh (ho tro JPEG, PNG, WebP, HEIC)
4. **Dat anh chinh**: Nhan icon ngoi sao tren anh muon lam anh dai dien
5. **Xoa anh**: Nhan nut X tren anh can xoa

### 3.5. Xoa phong

**Luong:**
1. Nhan nut **Xoa** (icon thung rac) tren dong phong
2. Xac nhan xoa -> phong bi an di (xoa mem, van luu trong CSDL)

> **Luu y:** Phong da co dat phong se khong bi mat du lieu khi xoa mem.

---

## 4. QUAN LY DAT PHONG

Gom 3 trang con, tuong ung voi 3 giai doan cua luong dat phong:

### 4.1. Dat phong moi (New Bookings)

**Duong dan:** `/admin/new_bookings.php`

**Chuc nang:** Xu ly cac don dat phong moi (trang thai "da dat" nhung chua nhan phong).

**Bang hien thi:**
| Cot | Mo ta |
|-----|-------|
| Ma don | Ma don hang (badge) |
| Khach hang | Ten, so dien thoai |
| Phong | Ten phong, gia |
| Chi tiet | Ngay nhan - tra phong, so tien, ngay dat |

**Luong xu ly:**
1. Xem danh sach don dat phong moi
2. **Tim kiem**: Nhap ma don, so dien thoai hoac ten khach de loc
3. **Gan phong**:
   - Nhan nut **Gan phong** tren dong don hang
   - Nhap ma phong/so phong thuc te (vd: M3-26, C603)
   - Nhan **Xac nhan** -> don chuyen sang trang thai "da nhan phong"
4. **Huy don**:
   - Nhan nut **Huy** tren dong don hang
   - Xac nhan huy -> don chuyen sang "da huy", chuyen qua muc Hoan tien

### 4.2. Hoan tien (Refund Bookings)

**Duong dan:** `/admin/refund_bookings.php`

**Chuc nang:** Xu ly hoan tien cho cac don da huy.

**Luong xu ly:**
1. Xem danh sach don huy dang cho hoan tien
2. Kiem tra thong tin: khach hang, phong, ngay, so tien can hoan
3. Nhan nut **Hoan tien** -> xac nhan da hoan tien cho khach
4. Don duoc danh dau "da hoan tien" va chuyen sang Thong ke

### 4.3. Thong ke Dat phong (Booking Records)

**Duong dan:** `/admin/booking_records.php`

**Chuc nang:** Xem lich su tat ca dat phong (da hoan thanh, da huy, that bai).

**Luong su dung:**
1. Xem bang lich su voi cac trang thai duoc danh dau bang mau:
   - **Xanh la**: Thanh cong
   - **Do**: Da huy
   - **Vang**: That bai
2. **Tim kiem**: Loc theo ma don, SDT hoac ten khach
3. **Phan trang**: Chuyen trang bang cac nut First / Previous / Next / Last
4. **Xuat bao cao**: Nhan nut Export (chuan bi cho PDF/Excel)

### So do tong the luong Dat phong

```
Khach dat phong (Frontend)
        |
        v
  [Dat phong moi] ---(Gan phong)---> [Hoan thanh] ---> [Thong ke]
        |
        +-----------(Huy don)------> [Hoan tien] ----> [Thong ke]
```

---

## 5. QUAN LY NGUOI DUNG

**Duong dan:** `/admin/users.php`

### Chuc nang
- Xem danh sach tai khoan khach hang
- Bat/Tat trang thai tai khoan
- Xoa tai khoan chua xac minh

### Bang hien thi
| Cot | Mo ta |
|-----|-------|
| STT | So thu tu |
| Ten | Anh + Ten nguoi dung |
| Email | Dia chi email |
| SDT | So dien thoai |
| Dia chi | Dia chi |
| Ngay sinh | Ngay thang nam sinh |
| Xac minh | Trang thai xac minh (badge: Da xac minh / Chua xac minh) |
| Trang thai | Hoat dong / Khong hoat dong |
| Ngay DK | Ngay dang ky tai khoan |
| Thao tac | Nut bat/tat, xoa |

### Luong su dung
1. **Xem danh sach**: Tat ca nguoi dung hien thi trong bang
2. **Tim kiem**: Nhap ten nguoi dung vao o tim kiem -> ket qua loc theo thoi gian thuc
3. **Bat/Tat tai khoan**: Nhan nut toggle tren dong nguoi dung
   - **Hoat dong** -> nguoi dung co the dang nhap va dat phong
   - **Khong hoat dong** -> nguoi dung bi chan, khong the dang nhap
4. **Xoa tai khoan**: Chi xoa duoc tai khoan **chua xac minh email**
   - Nhan nut Xoa -> xac nhan -> tai khoan bi xoa vinh vien

> **Luu y:** Khong the xoa tai khoan da xac minh de bao ve du lieu dat phong lien quan.

---

## 6. QUAN LY DANH GIA

**Duong dan:** `/admin/rate_review.php`

### Chuc nang
- Xem va kiem duyet danh gia cua khach hang
- Danh dau da doc / Xoa danh gia

### Bang hien thi
| Cot | Mo ta |
|-----|-------|
| Phong | Ten phong duoc danh gia |
| Nguoi danh gia | Ten khach hang |
| Diem | So sao (1-5) |
| Noi dung | Noi dung danh gia |
| Ngay | Ngay gui danh gia |
| Trang thai | Da doc / Chua doc |
| Thao tac | Danh dau da doc, Xoa |

### Luong su dung
1. **Xem danh gia**: Tat ca danh gia hien thi trong bang, danh gia chua doc duoc danh dau noi bat
2. **Danh dau da doc**: Nhan nut tren tung danh gia hoac nhan **"Danh dau tat ca da doc"** o tren cung
3. **Xoa danh gia**: Nhan nut Xoa tren tung danh gia hoac nhan **"Xoa tat ca"**

> **Luu y:**
> - Danh gia hien thi tren trang chu (muc Testimonials) theo thu tu moi nhat
> - Khach hang chi co the gui danh gia sau khi da hoan thanh dat phong
> - So danh gia chua doc hien thi tren Dashboard

---

## 7. QUAN LY TIN NHAN

**Duong dan:** `/admin/user_queries.php`

### Chuc nang
- Xem tin nhan tu form lien he cua khach tren trang web
- Danh dau da doc / Xoa tin nhan

### Bang hien thi
| Cot | Mo ta |
|-----|-------|
| Ten | Ten nguoi gui |
| Email | Email nguoi gui |
| Chu de | Tieu de tin nhan |
| Noi dung | Noi dung chi tiet |
| Ngay | Ngay gui |
| Trang thai | Da doc / Chua doc |
| Thao tac | Danh dau da doc, Xoa |

### Luong su dung
1. **Xem tin nhan**: Tat ca tin nhan hien thi trong bang
2. **Danh dau da doc**: Nhan nut tren tung tin nhan hoac **"Danh dau tat ca da doc"**
3. **Xoa tin nhan**: Nhan nut Xoa tren tung tin nhan hoac **"Xoa tat ca"**

> **Luu y:** So tin nhan chua doc hien thi tren Dashboard.

---

## 8. QUAN LY CAROUSEL (Slider trang chu)

**Duong dan:** `/admin/carousel.php`

### Chuc nang
- Quan ly hinh anh slider (banner) tren trang chu.

### Luong su dung

**Them anh:**
1. Nhan nut **Them anh**
2. Chon file anh (ho tro JPEG, PNG, WebP)
3. Nhan **Upload** -> anh duoc them vao slider trang chu

**Xoa anh:**
1. Trong luoi hien thi, nhan nut **X** tren anh can xoa
2. Xac nhan -> anh bi xoa khoi slider

> **Luu y:**
> - Anh hien thi dang luoi 3 cot
> - Nen su dung anh co kich thuoc lon, ty le ngang (16:9 hoac tuong tu) de hien thi dep tren slider

---

## 9. QUAN LY LOAI PHONG & TIEN ICH

**Duong dan:** `/admin/features_facilities.php`

### Chuc nang
- Quan ly 3 nhom du lieu danh muc: **Loai phong**, **Dac diem**, **Tien ich**

### 9.1. Loai phong (Property Types)

Cac loai phong nhu: Villa 4PN, Villa 6PN, Penthouse, Can ho 3PN...

**Luong su dung:**
1. **Xem**: Bang danh sach cac loai phong hien co
2. **Tim**: Nhap ten de loc nhanh
3. **Them**: Nhan **Them moi** -> nhap ten loai phong -> Luu
4. **Xoa**: Nhan nut Xoa tren dong can xoa

> **Luu y:** Khong the xoa loai phong dang duoc gan cho phong nao do.

### 9.2. Dac diem (Features)

Cac dac diem nhu: Phong ngu, Ban cong, Nha bep, View bien, San vuon, Be boi...

**Luong su dung:**
1. **Xem**: Bang danh sach dac diem
2. **Them**: Nhan **Them moi** -> nhap ten dac diem -> Luu
3. **Xoa**: Nhan nut Xoa

> **Luu y:** Khong the xoa dac diem dang duoc gan cho phong nao do.

### 9.3. Tien ich (Facilities)

Cac tien ich nhu: WiFi, Dieu hoa, Smart TV, Be boi, Bep tu, Karaoke...

**Luong su dung:**
1. **Xem**: Bang danh sach tien ich voi icon va mo ta
2. **Them**: Nhan **Them moi** -> dien:
   - **Ten tien ich** (bat buoc)
   - **Icon** - nhap class Font Awesome (vd: `fa-solid fa-wifi`) -> icon xem truoc tu dong cap nhat
   - **Mo ta** (tuy chon)
3. **Xoa**: Nhan nut Xoa

> **Luu y:** Khong the xoa tien ich dang duoc gan cho phong nao do.

---

## 10. CAI DAT

**Duong dan:** `/admin/settings.php`

### Chuc nang
- Cau hinh thong tin chung, che do bao tri, ngon ngu, thong tin lien he va doi ngu.

### 10.1. Cai dat chung (General Settings)

**Cac truong:**
- **Ten website**: Ten hien thi tren trang web (vd: HaLong24h)
- **Gioi thieu**: Mo ta ngan ve website

**Luong:**
1. Nhan nut **Chinh sua** ben canh phan Cai dat chung
2. Cap nhat ten va mo ta
3. Nhan **Luu**

### 10.2. Che do bao tri (Maintenance Mode)

**Chuc nang:** Tam dong website khi can bao tri hoac cap nhat.

**Luong:**
1. Bat cong tac **Che do bao tri** -> website hien thong bao "Dang bao tri" cho khach
2. Tat cong tac -> website hoat dong binh thuong
3. Khi bat, Dashboard hien badge canh bao "Dang bao tri"

> **Luu y:** Quan tri vien van truy cap duoc admin panel khi che do bao tri dang bat.

### 10.3. Ngon ngu (Language)

**Luong:**
1. Chon ngon ngu giao dien: **Tieng Viet (VI)** hoac **English (EN)**
2. Ngon ngu dang chon duoc danh dau bang icon check
3. Giao dien admin va frontend se chuyen doi ngon ngu tuong ung

### 10.4. Thong tin lien he (Contact Details)

**Cac truong:**
- **Dia chi**: Dia chi vat ly
- **Google Maps**: Link Google Maps
- **Hotline**: So dien thoai lien he
- **Email**: Dia chi email
- **Facebook**: Link trang Facebook
- **Zalo/Messenger**: Link lien he Zalo
- **Twitter**: Link Twitter
- **iFrame Maps**: Ma nhung Google Maps

**Luong:**
1. Nhan nut **Chinh sua** ben canh phan Lien he
2. Cap nhat cac truong thong tin
3. Nhan **Luu** -> thong tin cap nhat tren trang Lien he cua website

### 10.5. Doi ngu quan ly (Team)

**Luong:**
1. Nhan **Them thanh vien**
2. Nhap **Ten** va chon **Anh dai dien** (JPEG, PNG, WebP)
3. Nhan **Luu** -> thanh vien hien thi tren trang web
4. **Xoa**: Nhan nut X tren the thanh vien

---

## PHU LUC

### Cau truc Menu Sidebar

```
TONG QUAN
  |-- Dashboard

DAT PHONG
  |-- Dat phong moi
  |-- Hoan tien
  |-- Thong ke

QUAN LY
  |-- Phong
  |-- Nguoi dung
  |-- Loai phong & Tien ich

NOI DUNG
  |-- Carousel
  |-- Tin nhan
  |-- Danh gia

HE THONG
  |-- Cai dat
```

### So do luong tong the he thong

```
[Khach hang]
    |
    |--- Truy cap trang web (Frontend)
    |       |--- Xem phong
    |       |--- Dat phong ---> [Don moi] ---> [Admin xu ly]
    |       |--- Gui lien he ---> [Tin nhan] ---> [Admin doc]
    |       |--- Gui danh gia ---> [Danh gia] ---> [Admin duyet]
    |
[Quan tri vien]
    |
    |--- Dang nhap Admin
    |       |--- Dashboard (tong quan)
    |       |--- Xu ly don dat phong (gan phong / huy / hoan tien)
    |       |--- Quan ly phong (them/sua/xoa/anh)
    |       |--- Quan ly nguoi dung (bat/tat/xoa)
    |       |--- Quan ly noi dung (carousel, tin nhan, danh gia)
    |       |--- Cai dat he thong
```

### Dinh dang anh ho tro
- **Carousel**: JPEG, PNG, WebP
- **Phong**: JPEG, PNG, WebP, HEIC/HEIF (tu dong chuyen doi)
- **Team**: JPEG, PNG, WebP
- **Avatar nguoi dung**: JPEG, PNG, WebP

### Ky thuat
- He thong su dung **AJAX** cho tat ca thao tac CRUD -> khong can tai lai trang
- Thong bao thanh cong/loi hien thi bang **Toast** (goc tren phai)
- Du lieu duoc loc va bao mat chong SQL injection va XSS
