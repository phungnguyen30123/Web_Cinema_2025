# Hướng Dẫn Tích Hợp AI Thực Sự Cho Chatbot

## Tổng Quan

Hiện tại chatbot đang dùng **rule-based** (phải code từng dạng câu hỏi). Để chatbot tự nhận biết và trả lời như ChatGPT, bạn cần tích hợp AI API thực sự.

## Các Lựa Chọn AI

### 1. OpenAI (GPT-3.5/GPT-4) - Tốt Nhất ⭐
- **Ưu điểm**: Rất thông minh, hiểu ngữ cảnh tốt, trả lời tự nhiên
- **Nhược điểm**: Có phí (~$0.002/1000 tokens)
- **Phù hợp**: Production, cần chất lượng cao

### 2. Hugging Face Inference API - Miễn Phí 🆓
- **Ưu điểm**: Miễn phí, dễ dùng
- **Nhược điểm**: Chất lượng thấp hơn OpenAI, có thể chậm
- **Phù hợp**: Testing, development, budget thấp

### 3. Google Gemini - Miễn Phí (Có Giới Hạn) 🆓
- **Ưu điểm**: Miễn phí, chất lượng tốt
- **Nhược điểm**: Có giới hạn request
- **Phù hợp**: Production với budget thấp

## Cài Đặt

### Bước 1: Chọn AI Provider

Mở file `application/config/ai_chatbot.php` và chọn provider:

```php
$config['ai_provider'] = 'openai'; // hoặc 'huggingface', 'gemini', 'none'
```

### Bước 2: Lấy API Key

#### OpenAI:
1. Đăng ký tại: https://platform.openai.com/
2. Tạo API key tại: https://platform.openai.com/api-keys
3. Thêm vào file config hoặc biến môi trường:

```php
$config['openai_api_key'] = 'sk-...';
```

Hoặc dùng biến môi trường (khuyến nghị):
```bash
# .env hoặc set trong server
OPENAI_API_KEY=sk-...
```

#### Hugging Face:
1. Đăng ký tại: https://huggingface.co/
2. Tạo token tại: https://huggingface.co/settings/tokens
3. Thêm vào config:

```php
$config['huggingface_api_key'] = 'hf_...';
```

#### Google Gemini:
1. Đăng ký tại: https://makersuite.google.com/app/apikey
2. Tạo API key
3. Thêm vào config:

```php
$config['gemini_api_key'] = '...';
```

### Bước 3: Cấu Hình (Tùy Chọn)

Trong `application/config/ai_chatbot.php`:

```php
// OpenAI
$config['openai_model'] = 'gpt-3.5-turbo'; // hoặc 'gpt-4'
$config['openai_temperature'] = 0.7; // Độ sáng tạo (0.0-1.0)
$config['openai_max_tokens'] = 500; // Độ dài response

// Hugging Face
$config['huggingface_model'] = 'microsoft/DialoGPT-medium';
```

### Bước 4: Test

1. Mở chatbot trên website
2. Hỏi bất kỳ câu hỏi nào: "Tôi muốn xem phim hoạt hình"
3. Chatbot sẽ tự động hiểu và trả lời!

## Sử Dụng Biến Môi Trường (Khuyến Nghị)

Để bảo mật, nên lưu API key trong biến môi trường:

### Windows (XAMPP):
Tạo file `.env` trong thư mục gốc hoặc set trong `httpd.conf`:
```apache
SetEnv OPENAI_API_KEY "sk-..."
```

### Linux:
```bash
export OPENAI_API_KEY="sk-..."
```

Hoặc trong `.htaccess`:
```apache
SetEnv OPENAI_API_KEY "sk-..."
```

## So Sánh

| Provider | Chi Phí | Chất Lượng | Tốc Độ | Dễ Dùng |
|----------|---------|------------|--------|---------|
| OpenAI | ~$0.002/1k tokens | ⭐⭐⭐⭐⭐ | ⚡⚡⚡ | ✅✅✅ |
| Hugging Face | Miễn phí | ⭐⭐⭐ | ⚡⚡ | ✅✅ |
| Gemini | Miễn phí (có giới hạn) | ⭐⭐⭐⭐ | ⚡⚡⚡ | ✅✅✅ |
| Rule-based | Miễn phí | ⭐⭐ | ⚡⚡⚡⚡⚡ | ❌ |

## Ví Dụ Câu Hỏi

Với AI thực sự, chatbot có thể hiểu:

✅ "Tôi muốn xem phim hoạt hình"
✅ "Có phim nào hay không?"
✅ "Phim nào đang hot?"
✅ "Gợi ý phim cho gia đình"
✅ "Phim nào phù hợp với trẻ em?"
✅ "Tôi thích phim hành động, có gì không?"
✅ "Phim nào có rating cao nhất?"

## Troubleshooting

### Lỗi: "API key không hợp lệ"
- Kiểm tra API key đã đúng chưa
- Kiểm tra có đủ credit (OpenAI) hoặc quota (Gemini)

### Lỗi: "Timeout"
- Tăng `CURLOPT_TIMEOUT` trong code
- Kiểm tra kết nối internet

### Lỗi: "Rate limit exceeded"
- Giảm số request
- Upgrade plan (nếu có)

### Chatbot vẫn dùng rule-based
- Kiểm tra `$config['ai_provider']` đã set đúng chưa
- Kiểm tra API key đã có chưa
- Xem logs trong `application/logs/`

## Fallback

Nếu AI API lỗi, chatbot sẽ tự động fallback về rule-based để đảm bảo luôn có phản hồi.

## Chi Phí Ước Tính (OpenAI)

- GPT-3.5-turbo: ~$0.002/1000 tokens
- 1 câu hỏi + trả lời: ~500 tokens = $0.001
- 1000 câu hỏi/ngày = ~$1/ngày = ~$30/tháng

## Kết Luận

- **Development/Testing**: Dùng Hugging Face (miễn phí)
- **Production nhỏ**: Dùng Gemini (miễn phí)
- **Production lớn**: Dùng OpenAI (chất lượng tốt nhất)

Sau khi setup xong, chatbot sẽ tự động hiểu và trả lời mọi câu hỏi như ChatGPT! 🚀


