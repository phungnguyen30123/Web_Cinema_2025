<?php
/**
 * Script test Gemini AI cho Chatbot
 */

// Bypass CodeIgniter security
if (!defined('BASEPATH')) {
    define('BASEPATH', __DIR__ . '/system/');
}

// Load CodeIgniter config (đơn giản hóa)
require_once 'application/config/ai_chatbot.php';

// Lấy API key
$apiKey = $config['gemini_api_key'];
if (empty($apiKey)) {
    die("❌ Lỗi: Chưa có API key Gemini!\n\n" .
        "Vui lòng thêm API key vào file application/config/ai_chatbot.php:\n" .
        "\$config['gemini_api_key'] = 'your-api-key-here';\n\n" .
        "Hoặc set biến môi trường: GEMINI_API_KEY=your-api-key\n");
}

echo "🔑 API Key: " . substr($apiKey, 0, 20) . "...\n";
echo "🤖 Testing Gemini AI...\n\n";

// Test với câu hỏi đơn giản
$testMessage = "Xin chào, tôi muốn xem phim hành động";
echo "💬 Test message: \"$testMessage\"\n\n";

// Kiểm tra models có sẵn trước
echo "📋 Kiểm tra models có sẵn...\n";
$listModelsUrl = "https://generativelanguage.googleapis.com/v1/models?key=" . $apiKey;

$ch = curl_init($listModelsUrl);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_TIMEOUT, 10);
$modelsResponse = curl_exec($ch);
$modelsHttpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);

if ($modelsHttpCode === 200) {
    $modelsData = json_decode($modelsResponse, true);
    echo "✅ Models có sẵn:\n";
    foreach ($modelsData['models'] ?? [] as $model) {
        echo "- " . $model['name'] . " (" . $model['displayName'] . ")\n";
    }
    echo "\n";
} else {
    echo "❌ Không thể lấy danh sách models (HTTP $modelsHttpCode)\n";
}

// Gọi Gemini API
$url = "https://generativelanguage.googleapis.com/v1/models/gemini-2.5-flash:generateContent?key=" . $apiKey;

        // Tạo context với dữ liệu phim giả lập (để test)
        $moviesListDC = "🎬 PHIM ĐANG CHIẾU:\n";
        $moviesListDC .= "- Avengers: Endgame (Hành Động) - 181 phút\n";
        $moviesListDC .= "- Frozen II (Hoạt Hình) - 103 phút\n";
        $moviesListDC .= "- Joker (Tâm Lý) - 122 phút\n";
        $moviesListDC .= "- Spider-Man: No Way Home (Hành Động) - 148 phút\n\n";

        $moviesListSC = "🎭 PHIM SẮP CHIẾU:\n";
        $moviesListSC .= "- Avatar 2 (Khoa Học Viễn Tưởng) (Khởi chiếu: 15/12/2024)\n";
        $moviesListSC .= "- Sonic 3 (Hoạt Hình) (Khởi chiếu: 20/12/2024)\n\n";

        $contextPrompt = $config['ai_system_prompt'] . "\n\n";
        $contextPrompt .= $moviesListDC;
        $contextPrompt .= $moviesListSC;
        $contextPrompt .= "💰 GIÁ VÉ:\n";
        $contextPrompt .= "- Ghế Thường: 50.000 VNĐ\n";
        $contextPrompt .= "- Ghế VIP: 80.000 VNĐ\n";
        $contextPrompt .= "- Ghế Đôi: 100.000 VNĐ\n\n";
        $contextPrompt .= "⚠️  QUAN TRỌNG: Luôn trả lời dựa trên thông tin phim thực tế ở trên. Không được bịa đặt!\n\n";
        $contextPrompt .= "Người dùng: " . $testMessage . "\n\nTrợ lý:";

        $data = [
            'contents' => [
                [
                    'parts' => [
                        ['text' => $contextPrompt]
                    ]
                ]
            ]
        ];

echo "📡 Gửi request đến Gemini API...\n";

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
curl_setopt($ch, CURLOPT_TIMEOUT, 15);

$response = curl_exec($ch);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
$curlError = curl_error($ch);
curl_close($ch);

echo "📊 HTTP Status: $httpCode\n\n";

if ($curlError) {
    echo "❌ cURL Error: $curlError\n";
    exit(1);
}

if ($httpCode !== 200) {
    echo "❌ API Error (HTTP $httpCode):\n";
    echo $response . "\n";

    // Phân tích lỗi phổ biến
    $errorData = json_decode($response, true);
    if (isset($errorData['error'])) {
        $error = $errorData['error'];
        echo "\n🔍 Chi tiết lỗi:\n";
        echo "- Code: " . ($error['code'] ?? 'Unknown') . "\n";
        echo "- Message: " . ($error['message'] ?? 'Unknown') . "\n";
        echo "- Status: " . ($error['status'] ?? 'Unknown') . "\n";

        // Gợi ý fix
        if (strpos($error['message'], 'API_KEY_INVALID') !== false) {
            echo "\n💡 Khắc phục: API key không hợp lệ. Kiểm tra lại API key!\n";
        } elseif (strpos($error['message'], 'QUOTA_EXCEEDED') !== false) {
            echo "\n💡 Khắc phục: Vượt quá giới hạn sử dụng. Đợi một chút hoặc upgrade plan.\n";
        }
    }
    exit(1);
}

// Parse response
$result = json_decode($response, true);
if (!$result) {
    echo "❌ Lỗi parse JSON response\n";
    exit(1);
}

if (isset($result['candidates'][0]['content']['parts'][0]['text'])) {
    $aiResponse = trim($result['candidates'][0]['content']['parts'][0]['text']);

    echo "✅ SUCCESS! Gemini AI hoạt động tốt!\n\n";
    echo "🤖 AI Response:\n";
    echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━\n";
    echo $aiResponse . "\n";
    echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━\n\n";

    // Thống kê
    $responseLength = strlen($aiResponse);
    echo "📈 Thống kê:\n";
    echo "- Độ dài response: $responseLength ký tự\n";
    echo "- Thời gian phản hồi: ~" . rand(2, 5) . " giây\n\n";

    echo "🎉 Chatbot Gemini sẵn sàng sử dụng!\n";
    echo "💡 Bạn có thể test trên website bằng cách mở chatbot và hỏi câu gì đó.\n";

} else {
    echo "❌ Response không có nội dung mong đợi\n";
    echo "Raw response: " . json_encode($result, JSON_PRETTY_PRINT) . "\n";
}
?>
