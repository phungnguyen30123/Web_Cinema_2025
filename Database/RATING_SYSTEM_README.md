# Hệ thống Rating Phim - Documentation

## Tổng quan
Hệ thống rating cho phép người dùng đánh giá phim từ 0.5 đến 5.0 sao. Mỗi user chỉ có thể đánh giá mỗi phim một lần nhưng có thể cập nhật rating của mình.

## Cấu trúc Database

### Bảng `rating`
```sql
CREATE TABLE `rating` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `id_movie` int(11) NOT NULL,
  `rating` decimal(2,1) NOT NULL DEFAULT 0.0,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique_user_movie` (`id_user`,`id_movie`),
  KEY `idx_user` (`id_user`),
  KEY `idx_movie` (`id_movie`),
  KEY `idx_rating` (`rating`),
  CONSTRAINT `rating_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`) ON DELETE CASCADE,
  CONSTRAINT `rating_ibfk_2` FOREIGN KEY (`id_movie`) REFERENCES `movie` (`id`) ON DELETE CASCADE
);
```

### Các trường quan trọng:
- `id`: Primary key
- `id_user`: Foreign key đến bảng `user.id`
- `id_movie`: Foreign key đến bảng `movie.id`
- `rating`: Giá trị rating (0.0 - 5.0)
- `created_at`: Thời gian tạo
- `updated_at`: Thời gian cập nhật cuối

### Ràng buộc:
- UNIQUE constraint trên (`id_user`, `id_movie`): Một user chỉ rate một movie một lần
- Foreign key constraints với CASCADE DELETE

## Files được tạo

### 1. Database Migration
- `Database/create_rating_table.sql`: Script tạo bảng rating
- `Database/test_rating_migration.php`: Script test migration
- `Database/check_rating_table.php`: Script kiểm tra cấu trúc bảng

### 2. Model
- `application/models/rating_model.php`: Model xử lý logic rating

### 3. Controller
- `application/controllers/Rating_controller.php`: Controller xử lý API rating

## API Endpoints

### 1. Lấy rating của user cho một movie
```
GET /rating/get_user_rating/{movie_id}
```
**Response:**
```json
{
  "success": true,
  "rating": 4.5,
  "has_rated": true
}
```

### 2. Set rating cho movie
```
POST /rating/set_rating
```
**Data:**
```
movie_id: 14
rating: 4.5
```
**Response:**
```json
{
  "success": true,
  "message": "Cập nhật rating thành công",
  "avg_rating": 4.3,
  "rating_count": 25,
  "user_rating": 4.5
}
```

### 3. Lấy thống kê rating của movie
```
GET /rating/get_stats/{movie_id}
```
**Response:**
```json
{
  "success": true,
  "avg_rating": 4.3,
  "rating_count": 25,
  "stats": {
    "5.0": 10,
    "4.5": 8,
    "4.0": 5,
    "3.5": 2
  }
}
```

### 4. Lấy tất cả rating của movie
```
GET /rating/get_movie_ratings/{movie_id}
```
**Response:**
```json
{
  "success": true,
  "ratings": [
    {
      "id": 1,
      "id_user": 39,
      "id_movie": 14,
      "rating": "5.0",
      "created_at": "2025-12-25 10:00:00",
      "fullname": "Phung",
      "email": "kimphung30123@gmail.com"
    }
  ]
}
```

### 5. Xóa rating của user
```
POST /rating/delete_rating
```
**Data:**
```
movie_id: 14
```
**Response:**
```json
{
  "success": true,
  "message": "Xóa rating thành công",
  "avg_rating": 4.2,
  "rating_count": 24
}
```

### 6. Lấy danh sách phim được rating cao nhất
```
GET /rating/top_rated?limit=10
```
**Response:**
```json
{
  "success": true,
  "movies": [
    {
      "id": 14,
      "title": "AVATAR - DÒNG CHẢY CỦA NƯỚC",
      "avg_rating": "4.8",
      "rating_count": 25
    }
  ]
}
```

### 7. Lấy rating của user hiện tại
```
GET /rating/my_ratings
```
**Response:**
```json
{
  "success": true,
  "ratings": [
    {
      "id": 1,
      "id_user": 39,
      "id_movie": 14,
      "rating": "5.0",
      "created_at": "2025-12-25 10:00:00",
      "title": "AVATAR - DÒNG CHẢY CỦA NƯỚC",
      "poster": "https://..."
    }
  ]
}
```

## Cách sử dụng trong CodeIgniter

### Load Model trong Controller
```php
$this->load->model('Rating_model');
```

### Ví dụ sử dụng Model

```php
// Kiểm tra user đã rate movie chưa
$has_rated = $this->Rating_model->hasUserRated($user_id, $movie_id);

// Lấy rating của user
$user_rating = $this->Rating_model->getUserRating($user_id, $movie_id);

// Set rating mới
$this->Rating_model->setRating($user_id, $movie_id, 4.5);

// Lấy rating trung bình của movie
$avg_rating = $this->Rating_model->getAverageRating($movie_id);

// Lấy số lượng rating
$rating_count = $this->Rating_model->getRatingCount($movie_id);

// Lấy thống kê rating
$stats = $this->Rating_model->getRatingStats($movie_id);
```

## Tích hợp vào View

### Ví dụ hiển thị rating trong movie page

```php
// Trong controller
$data['avg_rating'] = $this->Rating_model->getAverageRating($movie_id);
$data['rating_count'] = $this->Rating_model->getRatingCount($movie_id);
$data['user_rating'] = null;

if ($this->session->userdata('user_id')) {
    $user_rating_data = $this->Rating_model->getUserRating(
        $this->session->userdata('user_id'),
        $movie_id
    );
    if ($user_rating_data) {
        $data['user_rating'] = $user_rating_data['rating'];
    }
}

$this->load->view('movie_page_view', $data);
```

### Trong View (HTML/JavaScript)

```html
<!-- Hiển thị rating trung bình -->
<div class="movie-rating">
    <span class="rating-stars" data-rating="<?php echo $avg_rating; ?>"></span>
    <span class="rating-text"><?php echo $avg_rating; ?>/5.0 (<?php echo $rating_count; ?> đánh giá)</span>
</div>

<!-- Form rating cho user đã đăng nhập -->
<?php if ($this->session->userdata('user_id')): ?>
<div class="user-rating">
    <p>Đánh giá của bạn:</p>
    <div class="rating-input" data-movie-id="<?php echo $movie_id; ?>" data-current-rating="<?php echo $user_rating ?: 0; ?>"></div>
    <button class="submit-rating">Gửi đánh giá</button>
</div>
<?php endif; ?>
```

```javascript
// JavaScript để xử lý rating
$(document).ready(function() {
    $('.rating-input').each(function() {
        var $container = $(this);
        var movieId = $container.data('movie-id');
        var currentRating = $container.data('current-rating');

        // Khởi tạo rating widget (sử dụng jQuery Raty hoặc tương tự)
        $container.raty({
            score: currentRating,
            starOff: 'images/rate/star-off.svg',
            starOn: 'images/rate/star-on.svg',
            click: function(score) {
                // Gửi rating qua AJAX
                $.post('/rating/set_rating', {
                    movie_id: movieId,
                    rating: score
                }, function(response) {
                    if (response.success) {
                        alert('Cập nhật rating thành công!');
                        location.reload(); // Reload để cập nhật hiển thị
                    } else {
                        alert(response.message);
                    }
                });
            }
        });
    });
});
```

## Lưu ý quan trọng

1. **Authentication**: Tất cả API endpoints đều kiểm tra đăng nhập
2. **Validation**: Rating được validate trong khoảng 0.5 - 5.0
3. **Rounding**: Rating được làm tròn đến 0.5 gần nhất
4. **Unique Constraint**: Một user chỉ có thể rate một movie một lần
5. **Foreign Keys**: Sẽ tự động xóa rating khi user hoặc movie bị xóa

## Testing

Chạy các file test:
```bash
php Database/test_rating_migration.php    # Test migration
php Database/check_rating_table.php       # Kiểm tra cấu trúc bảng
```

## Cập nhật tương lai

Để tích hợp đầy đủ vào ứng dụng, cần:
1. Cập nhật views để hiển thị rating động
2. Thêm JavaScript/AJAX để rating real-time
3. Cập nhật trang danh sách phim để hiển thị rating
4. Thêm chức năng sắp xếp theo rating

---

**Ngày tạo:** 06/01/2026
**Phiên bản:** 1.0
