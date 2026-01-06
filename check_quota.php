<?php
/**
 * Script kiểm tra quota Gemini API
 */

// Bypass CodeIgniter security
if (!defined('BASEPATH')) {
    define('BASEPATH', __DIR__ . '/system/');
}

// Load CodeIgniter config
require_once 'application/config/ai_chatbot.php';

// Lấy API key (thử nhiều cách)
$apiKey = $config['gemini_api_key'];
if (empty($apiKey)) {
    // Thử lấy từ biến môi trường trực tiếp
    $apiKey = getenv('GEMINI_API_KEY');
}
if (empty($apiKey)) {
    // Fallback - dùng API key mẫu để test (sẽ lỗi nhưng hiển thị hướng dẫn)
    $apiKey = 'DEMO_KEY_FOR_TESTING';
}

echo "🔑 API Key: " . substr($apiKey, 0, 20) . "...\n\n";

echo "📊 KIỂM TRA QUOTA GEMINI API\n";
echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━\n\n";

// 1. Kiểm tra usage statistics (nếu có)
echo "1️⃣ Kiểm tra Usage Statistics:\n";
$usageUrl = "https://generativelanguage.googleapis.com/v1beta/models?key=" . $apiKey;

$ch = curl_init($usageUrl);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
curl_setopt($ch, CURLOPT_TIMEOUT, 10);

$response = curl_exec($ch);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);

if ($httpCode === 200) {
    $data = json_decode($response, true);
    echo "✅ API hoạt động bình thường\n";
    echo "📋 Số models có sẵn: " . count($data['models'] ?? []) . "\n\n";
} else {
    echo "❌ Lỗi kết nối API (HTTP $httpCode)\n\n";
}

// 2. Thông tin về Free Tier limits
echo "2️⃣ Giới hạn Free Tier (ước tính):\n";
echo "• 60 requests/phút\n";
echo "• Khoảng 1000-1500 requests/ngày\n";
echo "• 32K tokens/request tối đa\n";
echo "• Reset hàng ngày lúc 00:00 UTC\n\n";

// 3. Cách monitor thực tế
echo "3️⃣ Cách theo dõi thực tế:\n";
echo "• Vào: https://ai.google.dev/usage?tab=rate-limit\n";
echo "• Hoặc: https://console.cloud.google.com/apis/api/generativelanguage.googleapis.com/quotas\n";
echo "• Xem 'Requests per minute' và 'Requests per day'\n\n";

// 4. Gợi ý monitor trong code
echo "4️⃣ Gợi ý monitor trong website:\n";
echo "• Thêm logging cho mỗi API call\n";
echo "• Đếm số request trong ngày\n";
echo "• Alert khi gần đạt giới hạn\n\n";

echo "💡 MẸO: Khi gần hết quota, chatbot sẽ tự động fallback về rule-based!\n";
echo "🔄 Không lo bị gián đoạn dịch vụ.\n\n";

echo "🎯 Khuyến nghị: Upgrade lên paid plan khi cần nhiều hơn 1000 requests/ngày\n";
?>
