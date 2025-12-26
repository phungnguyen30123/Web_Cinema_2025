# Tính Năng AI Cho Website Rạp Phim

Website đã được tích hợp 2 tính năng AI đơn giản và hữu ích:

## 1. AI Chatbot Hỗ Trợ Khách Hàng 🤖

### Mô tả
Chatbot AI tự động trả lời các câu hỏi của khách hàng về:
- Phim đang chiếu và sắp chiếu
- Lịch chiếu
- Giá vé
- Cách đặt vé
- Phương thức thanh toán
- Khuyến mãi
- Thông tin liên hệ

### Cách sử dụng
1. Chatbot xuất hiện ở góc dưới bên phải màn hình với biểu tượng chat
2. Click vào biểu tượng để mở cửa sổ chat
3. Nhập câu hỏi và nhấn Enter hoặc click nút gửi
4. Chatbot sẽ trả lời ngay lập tức

### Cách hoạt động
- **Rule-based responses**: Chatbot sử dụng các quy tắc được định nghĩa sẵn để trả lời các câu hỏi phổ biến
- **AI Integration**: Có thể mở rộng để tích hợp với các AI API như OpenAI, Hugging Face, etc.

### File liên quan
- `application/controllers/Chatbot_controller.php` - Controller xử lý tin nhắn
- `application/views/chatbot_view.php` - Giao diện chatbot
- `application/views/header_view.php` - Tích hợp chatbot vào header

### Mở rộng
Để tích hợp AI API thực sự (OpenAI, Hugging Face, etc.), chỉnh sửa hàm `getAIResponse()` trong `Chatbot_controller.php`:

```php
private function getAIResponse($message)
{
    // Ví dụ với OpenAI API
    $apiKey = 'your-api-key';
    $url = 'https://api.openai.com/v1/chat/completions';
    
    // Gửi request đến API...
}
```

---

## 2. Phân Tích Cảm Xúc Bình Luận (Sentiment Analysis) 💭

### Mô tả
Tự động phân tích cảm xúc của các bình luận về phim, phân loại thành:
- **Tích cực** (Positive): Bình luận khen ngợi, hài lòng
- **Tiêu cực** (Negative): Bình luận phàn nàn, không hài lòng
- **Trung tính** (Neutral): Bình luận không rõ ràng

### Cách hoạt động
1. Khi người dùng gửi bình luận, hệ thống tự động phân tích
2. Kết quả được lưu vào database
3. Hiển thị badge cảm xúc bên cạnh mỗi bình luận
4. Hiển thị thống kê tổng quan về cảm xúc của tất cả bình luận

### Cách sử dụng
- Tự động hoạt động khi người dùng gửi bình luận
- Xem badge cảm xúc bên cạnh tên người dùng trong mỗi bình luận
- Xem thống kê tổng quan ở phần đầu mục bình luận

### Cài đặt Database
Chạy file SQL để tạo bảng lưu kết quả phân tích:

```sql
-- Chạy file: Database/create_sentiment_table.sql
```

Hoặc chạy lệnh SQL sau:

```sql
CREATE TABLE IF NOT EXISTS `comment_sentiment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_comment` int(11) NOT NULL,
  `sentiment` enum('positive','negative','neutral') NOT NULL DEFAULT 'neutral',
  `score` decimal(3,2) NOT NULL DEFAULT '0.50',
  `confidence` decimal(3,2) NOT NULL DEFAULT '0.00',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_comment` (`id_comment`),
  KEY `sentiment` (`sentiment`),
  CONSTRAINT `comment_sentiment_ibfk_1` FOREIGN KEY (`id_comment`) REFERENCES `comment` (`id_comment`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
```

### File liên quan
- `application/models/sentiment_model.php` - Model xử lý phân tích cảm xúc
- `application/controllers/Movie_page_controller.php` - Tích hợp vào submit comment
- `application/views/movie_page_view.php` - Hiển thị kết quả phân tích
- `Database/create_sentiment_table.sql` - Script tạo bảng database

### Thuật toán
Sentiment analysis sử dụng:
- **Từ khóa tích cực**: "tuyệt vời", "hay", "xuất sắc", "đỉnh", etc.
- **Từ khóa tiêu cực**: "dở", "tệ", "chán", "thất vọng", etc.
- **Từ khóa trung tính**: "bình thường", "ok", "tạm được", etc.

Đếm số lượng từ khóa và tính điểm sentiment (0.0 - 1.0) và độ tin cậy.

### Mở rộng
Để sử dụng AI API thực sự (như Hugging Face sentiment analysis), chỉnh sửa hàm `analyzeSentiment()` trong `sentiment_model.php`:

```php
public function analyzeSentiment($comment)
{
    // Ví dụ với Hugging Face API
    $url = 'https://api-inference.huggingface.co/models/cardiffnlp/twitter-roberta-base-sentiment-latest';
    $data = json_encode(['inputs' => $comment]);
    
    // Gửi request đến API...
}
```

---

## Hướng Dẫn Cài Đặt

### Bước 1: Tạo bảng database
Chạy file SQL:
```bash
mysql -u your_username -p your_database < Database/create_sentiment_table.sql
```

### Bước 2: Kiểm tra quyền truy cập
Đảm bảo các file controller và model có quyền đọc/ghi phù hợp.

### Bước 3: Test tính năng
1. Mở website và kiểm tra chatbot ở góc dưới bên phải
2. Gửi một bình luận về phim và kiểm tra badge sentiment
3. Xem thống kê sentiment ở phần bình luận

---

## Lưu Ý

1. **Chatbot**: Hiện tại sử dụng rule-based, có thể mở rộng với AI API
2. **Sentiment Analysis**: Sử dụng từ khóa đơn giản, có thể nâng cấp với ML model
3. **Performance**: Cả hai tính năng đều được tối ưu để chạy nhanh
4. **Bảo mật**: Đảm bảo validate input từ người dùng

---

## Tương Lai

Có thể mở rộng thêm:
- Tích hợp OpenAI GPT cho chatbot thông minh hơn
- Sử dụng ML model cho sentiment analysis chính xác hơn
- Gợi ý phim dựa trên lịch sử xem (Recommendation System)
- Phát hiện spam/bình luận không phù hợp tự động

---

## Hỗ Trợ

Nếu có vấn đề, kiểm tra:
1. Database đã được tạo đúng chưa
2. File controller/model có lỗi syntax không
3. Quyền truy cập database
4. Logs trong `application/logs/`

