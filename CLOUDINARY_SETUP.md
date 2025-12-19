## Cloudinary setup (Web_Cinema)

### 1) Tạo tài khoản + lấy keys
- Vào Cloudinary Dashboard → lấy:
  - **cloud name**
  - **API key**
  - **API secret**

### 2) Cấu hình cho dự án (khuyến nghị dùng ENV)
Set 3 biến môi trường sau trên máy chạy web (Apache/PHP):
- `CLOUDINARY_CLOUD_NAME`
- `CLOUDINARY_API_KEY`
- `CLOUDINARY_API_SECRET`

Nếu bạn chưa set ENV, có thể điền trực tiếp vào:
- `application/config/cloudinary.php`

### 3) Cách hoạt động sau khi chuyển
- View **không đổi** (vẫn `<input type="file">` và `<img src="...">`).
- `Qlyanh_controller::upAnh()` sẽ upload ảnh lên Cloudinary và lưu **URL cloud** vào bảng `movie` các cột:
  - `poster`, `image1..image4`, `imgtra1`, `imgtra2`
- Ảnh được lưu theo folder: `web_cinema/movies/{id}`

### 4) Lưu ý khi chạy trên Windows/XAMPP
- Nếu gặp lỗi cURL SSL (liên quan CA bundle), bạn cần cấu hình CA cho PHP cURL.
  - Cách phổ biến: cấu hình `curl.cainfo` trong `php.ini` trỏ tới file `cacert.pem`.


