<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------
| AI Chatbot Configuration
| -------------------------------------------------------------------
| Cấu hình cho AI Chatbot - có thể sử dụng OpenAI, Hugging Face, hoặc các AI service khác
|
*/

// Chọn AI Provider: 'openai', 'huggingface', 'gemini', hoặc 'none' (chỉ dùng rule-based)
//$config['ai_provider'] = getenv('AI_PROVIDER') ? getenv('AI_PROVIDER') : 'none';
$config['ai_provider'] = 'gemini'; // hoặc 'huggingface', 'gemini', 'none'

// ===== OpenAI Configuration =====
$config['openai_api_key'] = getenv('OPENAI_API_KEY') ? getenv('OPENAI_API_KEY') : '';
$config['openai_model'] = 'gpt-3.5-turbo'; // hoặc 'gpt-4' cho model mạnh hơn
$config['openai_temperature'] = 0.7; // Độ sáng tạo (0.0 - 1.0)
$config['openai_max_tokens'] = 500; // Số token tối đa trong response

// ===== Hugging Face Configuration (MIỄN PHÍ) =====
$config['huggingface_api_key'] = getenv('HUGGINGFACE_API_KEY') ? getenv('HUGGINGFACE_API_KEY') : '';
// Model chat miễn phí: microsoft/DialoGPT-medium hoặc facebook/blenderbot-400M-distill
$config['huggingface_model'] = 'microsoft/DialoGPT-medium';

// ===== Google Gemini Configuration =====
$config['gemini_api_key'] = getenv('GEMINI_API_KEY') ? getenv('GEMINI_API_KEY') : '';

// ===== Context cho AI =====
$config['ai_system_prompt'] = "Bạn là trợ lý AI thân thiện của một rạp phim. Nhiệm vụ của bạn là:
- Trả lời các câu hỏi về phim, lịch chiếu, giá vé
- Gợi ý phim theo sở thích của khách hàng
- Hỗ trợ đặt vé và thanh toán
- Luôn lịch sự, nhiệt tình và hữu ích
- Trả lời bằng tiếng Việt, ngắn gọn và dễ hiểu";

// ===== Fallback =====
// Nếu AI API lỗi, có dùng rule-based không?
$config['use_rule_based_fallback'] = TRUE;




