<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * AI Chatbot Controller - Hỗ trợ khách hàng với AI
 * @property CI_DB_mysqli_driver $db
 * @property showPhim_model $showPhim_model
 * @property CI_Loader $load
 * @property CI_Input $input
 */
class Chatbot_controller extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('showPhim_model');
        $this->load->config('ai_chatbot');
    }

    /**
     * Xử lý tin nhắn từ chatbot
     */
    public function chat()
    {
        // Chỉ chấp nhận POST request
        if ($this->input->server('REQUEST_METHOD') !== 'POST') {
            $this->output->set_status_header(405);
            echo json_encode(['error' => 'Method not allowed']);
            return;
        }

        $message = $this->input->post('message');
        
        if (empty($message)) {
            echo json_encode([
                'success' => false,
                'error' => 'Tin nhắn không được để trống'
            ]);
            return;
        }

        // Xử lý tin nhắn và trả về phản hồi
        $response = $this->processMessage($message);
        
        echo json_encode([
            'success' => true,
            'response' => $response
        ]);
    }

    /**
     * Xử lý tin nhắn và tạo phản hồi
     */
    private function processMessage($message)
    {
        $messageLower = strtolower(trim($message));
        $originalMessage = trim($message);
        
        // Kiểm tra xem có dùng AI không
        $aiProvider = $this->config->item('ai_provider');
        
        if ($aiProvider && $aiProvider !== 'none') {
            // Sử dụng AI thực sự
            $aiResponse = $this->getRealAIResponse($originalMessage);
            if ($aiResponse !== null) {
                return $aiResponse;
            }
        }
        
        // Rule-based responses (fallback hoặc khi không dùng AI)
        $responses = $this->getRuleBasedResponse($messageLower);
        
        // Nếu không tìm thấy rule-based response, sử dụng AI fallback
        if (empty($responses)) {
            $responses = $this->getAIResponse($originalMessage);
        }
        
        return $responses;
    }

    /**
     * Rule-based responses - nhanh và đơn giản
     */
    private function getRuleBasedResponse($message)
    {
        // Chào hỏi
        if (preg_match('/\b(xin chào|chào|hello|hi|hey)\b/i', $message)) {
            return "Xin chào! Tôi là trợ lý AI của rạp phim. Tôi có thể giúp bạn:\n" .
                   "• Tìm thông tin về phim\n" .
                   "• Hỏi về lịch chiếu\n" .
                   "• Tư vấn về giá vé\n" .
                   "• Hỗ trợ đặt vé\n\n" .
                   "Bạn cần hỗ trợ gì?";
        }

        // Hỏi về phim đang chiếu
        if (preg_match('/\b(phim đang chiếu|phim nào đang chiếu|phim hiện tại|phim mới)\b/i', $message)) {
            $movies = $this->showPhim_model->getDatabasePhimDC();
            if (!empty($movies)) {
                $response = "Hiện tại chúng tôi đang chiếu các phim sau:\n\n";
                $count = 0;
                foreach ($movies as $movie) {
                    if ($count >= 5) break; // Giới hạn 5 phim
                    $response .= "• " . $movie['title'] . "\n";
                    $count++;
                }
                $response .= "\nBạn có thể xem chi tiết và đặt vé tại trang 'Phim đang chiếu'.";
                return $response;
            }
            return "Hiện tại chưa có phim nào đang chiếu. Vui lòng quay lại sau!";
        }

        // Hỏi về phim sắp chiếu
        if (preg_match('/\b(phim sắp chiếu|phim sắp tới|phim mới sắp ra)\b/i', $message)) {
            $movies = $this->showPhim_model->getDatabasePhimSC();
            if (!empty($movies)) {
                $response = "Các phim sắp chiếu:\n\n";
                $count = 0;
                foreach ($movies as $movie) {
                    if ($count >= 5) break;
                    $response .= "• " . $movie['title'] . " (Khởi chiếu: " . $movie['open_date'] . ")\n";
                    $count++;
                }
                $response .= "\nBạn có thể xem chi tiết tại trang 'Phim sắp chiếu'.";
                return $response;
            }
            return "Hiện tại chưa có phim nào sắp chiếu.";
        }

        // Hỏi về giá vé
        if (preg_match('/\b(giá vé|giá|ticket price|cost|phí|tiền vé)\b/i', $message)) {
            return "Giá vé tại rạp của chúng tôi:\n\n" .
                   "• Ghế Thường: 50.000 VNĐ\n" .
                   "• Ghế VIP: 80.000 VNĐ\n" .
                   "• Ghế Đôi: 100.000 VNĐ\n\n" .
                   "Bạn có thể xem chi tiết tại trang 'Giá vé' hoặc khi đặt vé.";
        }

        // Hỏi về cách đặt vé
        if (preg_match('/\b(cách đặt vé|đặt vé|mua vé|booking|đặt chỗ)\b/i', $message)) {
            return "Để đặt vé, bạn có thể:\n\n" .
                   "1. Chọn phim bạn muốn xem\n" .
                   "2. Chọn ngày và giờ chiếu phù hợp\n" .
                   "3. Chọn ghế ngồi\n" .
                   "4. Thanh toán qua MoMo hoặc VNPay\n\n" .
                   "Bạn cần đăng nhập để đặt vé. Nhấn vào nút 'Mua Vé' để bắt đầu!";
        }

        // Hỏi về thanh toán
        if (preg_match('/\b(thanh toán|payment|momo|vnpay|trả tiền)\b/i', $message)) {
            return "Chúng tôi hỗ trợ 2 phương thức thanh toán:\n\n" .
                   "• MoMo - Thanh toán qua ví điện tử MoMo\n" .
                   "• VNPay - Thanh toán qua cổng VNPay\n\n" .
                   "Bạn có thể chọn phương thức thanh toán khi đặt vé.";
        }

        // Hỏi về lịch chiếu
        if (preg_match('/\b(lịch chiếu|giờ chiếu|suất chiếu|schedule|time)\b/i', $message)) {
            return "Lịch chiếu phụ thuộc vào từng phim. Bạn có thể:\n\n" .
                   "1. Vào trang chi tiết phim\n" .
                   "2. Xem các ngày và giờ chiếu có sẵn\n" .
                   "3. Chọn suất chiếu phù hợp\n\n" .
                   "Bạn muốn xem lịch chiếu của phim nào?";
        }

        // Hỏi về khuyến mãi
        if (preg_match('/\b(khuyến mãi|promotion|giảm giá|ưu đãi|discount)\b/i', $message)) {
            return "Chúng tôi có nhiều chương trình khuyến mãi hấp dẫn!\n\n" .
                   "Bạn có thể xem các khuyến mãi hiện tại tại trang 'Khuyến mãi'.\n\n" .
                   "Thường xuyên theo dõi để không bỏ lỡ các ưu đãi đặc biệt!";
        }

        // Hỏi về liên hệ
        if (preg_match('/\b(liên hệ|contact|hotline|số điện thoại|email)\b/i', $message)) {
            return "Bạn có thể liên hệ với chúng tôi:\n\n" .
                   "• Qua trang 'Liên hệ' trên website\n" .
                   "• Hoặc sử dụng chatbot này để được hỗ trợ\n\n" .
                   "Chúng tôi luôn sẵn sàng hỗ trợ bạn!";
        }

        // Gợi ý phim theo thể loại
        $categoryMatch = $this->detectCategory($message);
        if ($categoryMatch) {
            return $this->suggestMoviesByCategory($categoryMatch);
        }

        // Cảm ơn
        if (preg_match('/\b(cảm ơn|thanks|thank you|cám ơn)\b/i', $message)) {
            return "Không có gì! Rất vui được giúp đỡ bạn. Chúc bạn có một buổi xem phim vui vẻ! 🎬";
        }

        // Tạm biệt
        if (preg_match('/\b(tạm biệt|bye|goodbye|see you|hẹn gặp lại)\b/i', $message)) {
            return "Tạm biệt! Hẹn gặp lại bạn tại rạp phim! 🎥";
        }

        // Không tìm thấy rule-based response
        return null;
    }

    /**
     * AI Response thực sự - sử dụng AI API (OpenAI, Hugging Face, etc.)
     */
    private function getRealAIResponse($message)
    {
        $aiProvider = $this->config->item('ai_provider');
        
        try {
            switch ($aiProvider) {
                case 'openai':
                    return $this->getOpenAIResponse($message);
                case 'huggingface':
                    return $this->getHuggingFaceResponse($message);
                case 'gemini':
                    return $this->getGeminiResponse($message);
                default:
                    return null;
            }
        } catch (Exception $e) {
            // Log lỗi
            log_message('error', 'AI Chatbot Error: ' . $e->getMessage());
            
            // Nếu có fallback, dùng rule-based
            if ($this->config->item('use_rule_based_fallback')) {
                return null; // Sẽ fallback về rule-based
            }
            
            return "Xin lỗi, có lỗi xảy ra khi xử lý câu hỏi của bạn. Vui lòng thử lại sau.";
        }
    }

    /**
     * OpenAI API Response
     */
    private function getOpenAIResponse($message)
    {
        $apiKey = $this->config->item('openai_api_key');
        if (empty($apiKey)) {
            return null;
        }

        // Lấy thông tin phim để làm context
        $movies = $this->showPhim_model->getDatabasePhimDC();
        $moviesList = "";
        if (!empty($movies)) {
            $count = 0;
            foreach ($movies as $movie) {
                if ($count >= 5) break;
                $moviesList .= "- " . $movie['title'] . " (" . ($movie['category'] ?? 'N/A') . ")\n";
                $count++;
            }
        }

        $systemPrompt = $this->config->item('ai_system_prompt');
        $systemPrompt .= "\n\nDanh sách phim đang chiếu:\n" . $moviesList;
        $systemPrompt .= "\nGiá vé: Ghế Thường 50.000 VNĐ, VIP 80.000 VNĐ, Đôi 100.000 VNĐ";

        $url = 'https://api.openai.com/v1/chat/completions';
        $data = [
            'model' => $this->config->item('openai_model'),
            'messages' => [
                ['role' => 'system', 'content' => $systemPrompt],
                ['role' => 'user', 'content' => $message]
            ],
            'temperature' => $this->config->item('openai_temperature'),
            'max_tokens' => $this->config->item('openai_max_tokens')
        ];

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json',
            'Authorization: Bearer ' . $apiKey
        ]);
        curl_setopt($ch, CURLOPT_TIMEOUT, 10);

        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        if ($httpCode === 200) {
            $result = json_decode($response, true);
            if (isset($result['choices'][0]['message']['content'])) {
                return trim($result['choices'][0]['message']['content']);
            }
        }

        return null;
    }

    /**
     * Hugging Face API Response (MIỄN PHÍ)
     */
    private function getHuggingFaceResponse($message)
    {
        $apiKey = $this->config->item('huggingface_api_key');
        $model = $this->config->item('huggingface_model');
        
        // Hugging Face có thể không cần API key cho một số model công khai
        $url = "https://api-inference.huggingface.co/models/" . $model;
        
        $data = [
            'inputs' => $message,
            'parameters' => [
                'max_length' => 200,
                'temperature' => 0.7
            ]
        ];

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        $headers = ['Content-Type: application/json'];
        if (!empty($apiKey)) {
            $headers[] = 'Authorization: Bearer ' . $apiKey;
        }
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_TIMEOUT, 15);

        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        if ($httpCode === 200) {
            $result = json_decode($response, true);
            // Hugging Face trả về format khác nhau tùy model
            if (isset($result[0]['generated_text'])) {
                return trim($result[0]['generated_text']);
            } elseif (isset($result['generated_text'])) {
                return trim($result['generated_text']);
            }
        }

        return null;
    }

    /**
     * Google Gemini API Response
     */
    private function getGeminiResponse($message)
    {
        $apiKey = $this->config->item('gemini_api_key');
        if (empty($apiKey)) {
            return null;
        }

        // Lấy thông tin phim để làm context
        $moviesDC = $this->showPhim_model->getDatabasePhimDC();
        $moviesSC = $this->showPhim_model->getDatabasePhimSC();
        $moviesListDC = "";
        $moviesListSC = "";

        // Danh sách phim đang chiếu
        if (!empty($moviesDC)) {
            $count = 0;
            foreach ($moviesDC as $movie) {
                if ($count >= 8) break; // Tăng lên 8 phim
                $moviesListDC .= "- " . $movie['title'];
                if (!empty($movie['category'])) {
                    $moviesListDC .= " (" . $movie['category'] . ")";
                }
                if (!empty($movie['duration'])) {
                    $moviesListDC .= " - " . $movie['duration'];
                }
                $moviesListDC .= "\n";
                $count++;
            }
        }

        // Danh sách phim sắp chiếu
        if (!empty($moviesSC)) {
            $count = 0;
            foreach ($moviesSC as $movie) {
                if ($count >= 5) break;
                $moviesListSC .= "- " . $movie['title'];
                if (!empty($movie['open_date'])) {
                    $moviesListSC .= " (Khởi chiếu: " . date('d/m/Y', strtotime($movie['open_date'])) . ")";
                }
                $moviesListSC .= "\n";
                $count++;
            }
        }

        // Tạo system prompt với context đầy đủ
        $systemPrompt = $this->config->item('ai_system_prompt');
        $systemPrompt .= "\n\n🎬 PHIM ĐANG CHIẾU:\n" . ($moviesListDC ?: "Hiện tại chưa có phim nào đang chiếu.");
        $systemPrompt .= "\n\n🎭 PHIM SẮP CHIẾU:\n" . ($moviesListSC ?: "Hiện tại chưa có phim nào sắp chiếu.");
        $systemPrompt .= "\n\n💰 GIÁ VÉ:\n";
        $systemPrompt .= "- Ghế Thường: 50.000 VNĐ\n";
        $systemPrompt .= "- Ghế VIP: 80.000 VNĐ\n";
        $systemPrompt .= "- Ghế Đôi: 100.000 VNĐ\n\n";
        $systemPrompt .= "📋 THÔNG TIN HỖ TRỢ:\n";
        $systemPrompt .= "- Hỗ trợ đặt vé online\n";
        $systemPrompt .= "- Thanh toán qua MoMo, VNPay\n";
        $systemPrompt .= "- Có khuyến mãi đặc biệt\n\n";
        $systemPrompt .= "⚠️  QUAN TRỌNG: Luôn trả lời dựa trên thông tin phim thực tế ở trên. Không được bịa đặt tên phim hoặc thông tin!";

        $url = "https://generativelanguage.googleapis.com/v1/models/gemini-2.5-flash:generateContent?key=" . $apiKey;

        $data = [
            'contents' => [
                [
                    'parts' => [
                        ['text' => $systemPrompt . "\n\nNgười dùng: " . $message . "\n\nTrợ lý:"]
                    ]
                ]
            ]
        ];

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
        curl_setopt($ch, CURLOPT_TIMEOUT, 10);

        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        if ($httpCode === 200) {
            $result = json_decode($response, true);
            if (isset($result['candidates'][0]['content']['parts'][0]['text'])) {
                return trim($result['candidates'][0]['content']['parts'][0]['text']);
            }
        }

        return null;
    }

    /**
     * AI Response fallback - khi không dùng AI hoặc AI lỗi
     */
    private function getAIResponse($message)
    {
        // Tạm thời trả về response thông minh dựa trên context
        $defaultResponses = [
            "Tôi hiểu bạn đang hỏi về: '" . htmlspecialchars($message) . "'\n\n" .
            "Tuy nhiên, tôi chưa được huấn luyện để trả lời câu hỏi này một cách chính xác.\n\n" .
            "Bạn có thể thử hỏi:\n" .
            "• 'Phim đang chiếu' - Xem danh sách phim\n" .
            "• 'Giá vé' - Xem bảng giá\n" .
            "• 'Cách đặt vé' - Hướng dẫn đặt vé\n" .
            "• 'Khuyến mãi' - Xem ưu đãi\n\n" .
            "Hoặc liên hệ với chúng tôi qua trang 'Liên hệ' để được hỗ trợ tốt hơn!",
            
            "Xin lỗi, tôi chưa hiểu rõ câu hỏi của bạn. Bạn có thể diễn đạt lại không?\n\n" .
            "Tôi có thể giúp bạn về:\n" .
            "• Thông tin phim\n" .
            "• Lịch chiếu\n" .
            "• Giá vé\n" .
            "• Cách đặt vé\n" .
            "• Khuyến mãi"
        ];
        
        return $defaultResponses[array_rand($defaultResponses)];
    }

    /**
     * Nhận diện thể loại phim từ câu hỏi
     * @param string $message Câu hỏi của người dùng
     * @return string|null Tên thể loại hoặc null
     */
    private function detectCategory($message)
    {
        // Map từ khóa với thể loại trong database
        $categoryMap = [
            // Hoạt hình / Animation
            'hoạt hình' => 'Hoạt Hình',
            'animation' => 'Hoạt Hình',
            'cartoon' => 'Hoạt Hình',
            'anime' => 'Hoạt Hình',
            
            // Hài / Comedy
            'hài' => 'Hài Hước',
            'hài hước' => 'Hài Hước',
            'comedy' => 'Hài Hước',
            'phim hài' => 'Hài Hước',
            
            // Hành động / Action
            'hành động' => 'Hành Động',
            'action' => 'Hành Động',
            'phim hành động' => 'Hành Động',
            
            // Kinh dị / Horror
            'kinh dị' => 'Kinh Dị',
            'horror' => 'Kinh Dị',
            'ma' => 'Kinh Dị',
            'rùng rợn' => 'Kinh Dị',
            
            // Tình cảm / Romance
            'tình cảm' => 'Tình Cảm',
            'romance' => 'Tình Cảm',
            'lãng mạn' => 'Tình Cảm',
            'tình yêu' => 'Tình Cảm',
            
            // Khoa học viễn tưởng / Sci-Fi
            'khoa học viễn tưởng' => 'Khoa Học Viễn Tưởng',
            'sci-fi' => 'Khoa Học Viễn Tưởng',
            'viễn tưởng' => 'Khoa Học Viễn Tưởng',
            
            // Phiêu lưu / Adventure
            'phiêu lưu' => 'Phiêu Lưu',
            'adventure' => 'Phiêu Lưu',
            
            // Gia đình / Family
            'gia đình' => 'Gia Đình',
            'family' => 'Gia Đình',
            
            // Trinh thám / Mystery
            'trinh thám' => 'Trinh Thám',
            'mystery' => 'Trinh Thám',
            'bí ẩn' => 'Trinh Thám',
        ];

        // Tìm thể loại phù hợp
        foreach ($categoryMap as $keyword => $category) {
            if (stripos($message, $keyword) !== false) {
                return $category;
            }
        }

        return null;
    }

    /**
     * Gợi ý phim theo thể loại
     * @param string $category Tên thể loại
     * @return string Phản hồi với danh sách phim
     */
    private function suggestMoviesByCategory($category)
    {
        // Lấy phim theo thể loại
        $movies = $this->showPhim_model->getPhimByCategory($category, 5);
        
        if (!empty($movies)) {
            $response = "Dựa trên sở thích của bạn, tôi gợi ý các phim " . $category . " đang chiếu:\n\n";
            $count = 0;
            foreach ($movies as $movie) {
                $count++;
                $response .= $count . ". " . $movie['title'];
                if (!empty($movie['duration'])) {
                    $response .= " (" . $movie['duration'] . ")";
                }
                $response .= "\n";
            }
            
            $response .= "\nBạn có thể xem chi tiết và đặt vé tại trang 'Phim đang chiếu'.\n";
            $response .= "Hoặc hỏi tôi về một phim cụ thể để biết thêm thông tin!";
            
            return $response;
        } else {
            // Nếu không tìm thấy phim theo thể loại chính xác, thử tìm tất cả thể loại có sẵn
            $allCategories = $this->showPhim_model->getAllCategories();
            
            $response = "Xin lỗi, hiện tại chúng tôi chưa có phim " . $category . " đang chiếu.\n\n";
            
            if (!empty($allCategories)) {
                $response .= "Các thể loại phim đang có:\n";
                foreach ($allCategories as $cat) {
                    $response .= "• " . $cat . "\n";
                }
                $response .= "\nBạn có thể hỏi tôi về một thể loại khác!";
            }
            
            return $response;
        }
    }
}

/* End of file Chatbot_controller.php */
/* Location: ./application/controllers/Chatbot_controller.php */

