<?php
/**
 * Test AI với context phim chính xác
 */

// Bypass CodeIgniter security
if (!defined('BASEPATH')) {
    define('BASEPATH', __DIR__ . '/system/');
}

// Load CodeIgniter config
require_once 'application/config/ai_chatbot.php';

// Lấy API key
$apiKey = getenv('GEMINI_API_KEY') ?: 'AIzaSyDZf8hPOY5ocNCEv3LZr-tcimWSmKOxT4E'; // Fallback

if (empty($apiKey)) {
    die("❌ Chưa có API key!\n");
}

echo "🧪 TEST AI VỚI CONTEXT PHIM CHÍNH XÁC\n";
echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━\n\n";

// Test case 1: Hỏi phim đang chiếu
$testCases = [
    "Phim nào đang chiếu?",
    "Cho tôi biết các phim hiện tại",
    "Có phim gì hay không?",
    "Liệt kê phim đang chiếu"
];

foreach ($testCases as $i => $question) {
    echo "❓ Câu hỏi " . ($i+1) . ": \"$question\"\n\n";

    // Context với phim thật (giả lập)
    $context = "🎬 PHIM ĐANG CHIẾU TRÊN RẠP:
- Avengers: Endgame (Hành Động) - 181 phút
- Frozen II (Hoạt Hình) - 103 phút
- Joker (Tâm Lý) - 122 phút
- Spider-Man: No Way Home (Hành Động) - 148 phút

🎭 PHIM SẮP CHIẾU:
- Avatar 2 (Khoa Học Viễn Tưởng) (Khởi chiếu: 15/12/2024)
- Sonic 3 (Hoạt Hình) (Khởi chiếu: 20/12/2024)

💰 GIÁ VÉ:
- Ghế Thường: 50.000 VNĐ
- Ghế VIP: 80.000 VNĐ
- Ghế Đôi: 100.000 VNĐ

⚠️  QUAN TRỌNG: Luôn trả lời dựa trên thông tin phim thực tế ở trên. KHÔNG được bịa đặt tên phim hoặc thông tin sai!";

    $fullPrompt = $config['ai_system_prompt'] . "\n\n" . $context . "\n\nNgười dùng: $question\n\nTrợ lý:";

    // Gọi Gemini API
    $url = "https://generativelanguage.googleapis.com/v1/models/gemini-2.5-flash:generateContent?key=" . $apiKey;

    $data = [
        'contents' => [
            [
                'parts' => [
                    ['text' => $fullPrompt]
                ]
            ]
        ]
    ];

    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
    curl_setopt($ch, CURLOPT_TIMEOUT, 15);

    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    if ($httpCode === 200) {
        $result = json_decode($response, true);
        if (isset($result['candidates'][0]['content']['parts'][0]['text'])) {
            $aiResponse = trim($result['candidates'][0]['content']['parts'][0]['text']);

            echo "🤖 AI Response:\n";
            echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━\n";
            echo $aiResponse . "\n";
            echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━\n\n";

            // Kiểm tra xem có đề cập đúng phim không
            $correctMovies = ['Avengers: Endgame', 'Frozen II', 'Joker', 'Spider-Man: No Way Home'];
            $mentionedCorrect = false;
            foreach ($correctMovies as $movie) {
                if (stripos($aiResponse, $movie) !== false) {
                    $mentionedCorrect = true;
                    break;
                }
            }

            if ($mentionedCorrect) {
                echo "✅ TỐT: AI đề cập đúng phim từ context!\n\n";
            } else {
                echo "❌ TỆ: AI không đề cập phim từ context, có thể bịa ra!\n\n";
            }
        }
    } elseif ($httpCode === 429) {
        echo "⏰ Hết quota Free Tier. Đợi 1 phút rồi thử lại!\n\n";
        break;
    } else {
        echo "❌ Lỗi API (HTTP $httpCode)\n\n";
        break;
    }

    // Delay giữa các test
    sleep(2);
}

echo "📊 KẾT LUẬN:\n";
echo "Nếu AI trả lời đúng tên phim từ context → Code hoạt động tốt!\n";
echo "Nếu AI bịa ra phim khác → Cần điều chỉnh prompt hoặc model.\n\n";
?>







