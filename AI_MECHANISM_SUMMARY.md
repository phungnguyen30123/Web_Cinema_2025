# TÓM TẮT CƠ CHẾ AI - ĐỒ ÁN TỐT NGHIỆP

## 🤖 **Cơ Chế Hoạt Động**

### **1. KHÔNG Training Model**
- **Không phải** xây dựng/fine-tune AI model riêng
- **Không cần** dataset lớn, GPU cluster
- **Không tốn** hàng tuần/tháng training

### **2. Prompt Engineering**
- Sử dụng **text prompts** để hướng dẫn AI
- **System prompt** định nghĩa role và behavior
- **Context injection** thêm dữ liệu thực tế
- **Instruction tuning** hướng dẫn cách trả lời

### **3. External AI APIs**
- **Google Gemini** (Primary choice)
- **OpenAI GPT** (Alternative)
- **Hugging Face** (Backup option)

## 📊 **Luồng Hoạt Động**

```
User hỏi: "Phim nào đang chiếu?"

1. Lấy dữ liệu từ database
   → Avengers, Frozen II, Joker...

2. Xây dựng prompt với context
   → "PHIM ĐANG CHIẾU: Avengers, Frozen II..."

3. Gọi AI API với prompt
   → Gemini trả lời dựa trên context

4. Nếu API lỗi → Fallback về rule-based
   → Đảm bảo luôn có phản hồi
```

## 🎯 **Điểm Khác Biệt**

| Phương Pháp | Traditional Training | Our AI System |
|-------------|---------------------|----------------|
| **Thời gian** | Tuần → Tháng | Phút → Giờ |
| **Chi phí** | $1000+ | $0.001/request |
| **Data cần** | GB dataset | Text prompts |
| **Maintenance** | Khó | Dễ |
| **Scalability** | Phức tạp | Rất tốt |

## ✅ **Ưu Điểm Cho Đồ Án**

- **Hiện đại:** Sử dụng AI state-of-the-art
- **Thực tế:** Có thể triển khai production
- **Tiết kiệm:** Cost-effective
- **Bảo trì:** Easy maintenance
- **Scalable:** Dễ mở rộng

## 📚 **Tài Liệu Tham Khảo**

1. **AI_SYSTEM_ARCHITECTURE.md** - Chi tiết kiến trúc
2. **AI_ARCHITECTURE_DIAGRAM.puml** - Diagram luồng hoạt động
3. **AI_PRESENTATION_SLIDES.md** - Slides trình bày defense

## 🎓 **Gợi Ý Trình Bày Defense**

**Câu trả lời chuẩn cho GV:**
> "Hệ thống sử dụng Prompt Engineering kết hợp Context Injection, không training model. AI được hướng dẫn qua text prompts chứa dữ liệu thực tế từ database, đảm bảo trả lời chính xác và cost-effective."

**Điểm nhấn:**
- **Hiện đại:** Sử dụng AI APIs thay vì build model
- **Hiệu quả:** Chi phí thấp, dễ scale
- **Thực tế:** Applicable trong production
- **Đáng tin cậy:** Fallback mechanism đảm bảo uptime

---

**Tóm tắt:** Đây là cách tiếp cận AI thông minh, hiện đại và phù hợp cho đồ án tốt nghiệp, chứng minh khả năng áp dụng công nghệ AI tiên tiến trong thực tế.







