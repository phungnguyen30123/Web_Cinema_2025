<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Sentiment Analysis Model - Phân tích cảm xúc bình luận
 */
class Sentiment_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Phân tích cảm xúc của một bình luận
     * @param string $comment Nội dung bình luận
     * @return array ['sentiment' => 'positive/negative/neutral', 'score' => float, 'confidence' => float]
     */
    public function analyzeSentiment($comment)
    {
        // Từ khóa tích cực (tiếng Việt)
        $positiveWords = [
            'tuyệt vời', 'hay', 'xuất sắc', 'đỉnh', 'tốt', 'hài lòng', 'thích', 'yêu thích',
            'ấn tượng', 'cảm động', 'hay quá', 'đáng xem', 'recommend', 'recommended',
            'tuyệt', 'đẹp', 'hay lắm', 'tốt lắm', 'rất hay', 'rất tốt', 'cực kỳ hay',
            'phim hay', 'diễn xuất tốt', 'kịch bản hay', 'đạo diễn tốt', 'âm thanh tốt',
            'hình ảnh đẹp', 'đáng giá', 'xứng đáng', 'nên xem', 'phải xem', 'đáng xem',
            'thú vị', 'hấp dẫn', 'lôi cuốn', 'hồi hộp', 'cảm xúc', 'tuyệt vời',
            '5 sao', '10 điểm', 'perfect', 'amazing', 'great', 'excellent', 'awesome',
            'love', 'like', 'good', 'best', 'wonderful', 'fantastic', 'brilliant'
        ];

        // Từ khóa tiêu cực (tiếng Việt)
        $negativeWords = [
            'dở', 'tệ', 'chán', 'nhàm chán', 'không hay', 'không tốt', 'tệ hại',
            'thất vọng', 'không đáng xem', 'lãng phí', 'phí tiền', 'phí thời gian',
            'không nên xem', 'đừng xem', 'tránh xa', 'tệ quá', 'dở quá', 'chán quá',
            'nhàm', 'không thú vị', 'không hấp dẫn', 'không lôi cuốn', 'buồn ngủ',
            'không đáng', 'không xứng đáng', 'tốn tiền', 'tốn thời gian', 'lãng phí tiền',
            'không ổn', 'có vấn đề', 'sai sót', 'thiếu sót', 'yếu', 'kém',
            'bad', 'terrible', 'awful', 'horrible', 'boring', 'waste', 'disappointed',
            'hate', 'dislike', 'worst', 'poor', 'weak', 'boring', 'stupid', 'silly'
        ];

        // Từ khóa trung tính
        $neutralWords = [
            'bình thường', 'ok', 'okay', 'tạm được', 'tạm ổn', 'không có gì đặc biệt',
            'xem được', 'có thể xem', 'tùy', 'tùy người', 'tùy sở thích',
            'normal', 'average', 'mediocre', 'so so', 'nothing special'
        ];

        // Chuyển sang chữ thường và loại bỏ dấu câu
        $commentLower = mb_strtolower($comment, 'UTF-8');
        $commentClean = preg_replace('/[^\p{L}\p{N}\s]/u', ' ', $commentLower);
        
        // Đếm từ khóa
        $positiveCount = 0;
        $negativeCount = 0;
        $neutralCount = 0;

        // Kiểm tra từ khóa tích cực
        foreach ($positiveWords as $word) {
            if (mb_stripos($commentClean, $word) !== false) {
                $positiveCount++;
            }
        }

        // Kiểm tra từ khóa tiêu cực
        foreach ($negativeWords as $word) {
            if (mb_stripos($commentClean, $word) !== false) {
                $negativeCount++;
            }
        }

        // Kiểm tra từ khóa trung tính
        foreach ($neutralWords as $word) {
            if (mb_stripos($commentClean, $word) !== false) {
                $neutralCount++;
            }
        }

        // Tính điểm sentiment
        $totalScore = $positiveCount - $negativeCount;
        $totalKeywords = $positiveCount + $negativeCount + $neutralCount;
        
        // Xác định sentiment
        if ($totalScore > 0) {
            $sentiment = 'positive';
            $score = min(1.0, 0.5 + ($totalScore / max(1, $totalKeywords)) * 0.5);
        } elseif ($totalScore < 0) {
            $sentiment = 'negative';
            $score = max(0.0, 0.5 - (abs($totalScore) / max(1, $totalKeywords)) * 0.5);
        } else {
            $sentiment = 'neutral';
            $score = 0.5;
        }

        // Tính độ tin cậy (confidence)
        $confidence = min(1.0, $totalKeywords / 3.0); // Càng nhiều từ khóa thì càng tin cậy
        
        // Nếu không có từ khóa nào, mặc định là neutral với confidence thấp
        if ($totalKeywords == 0) {
            $sentiment = 'neutral';
            $score = 0.5;
            $confidence = 0.3;
        }

        return [
            'sentiment' => $sentiment,
            'score' => round($score, 2),
            'confidence' => round($confidence, 2),
            'positive_count' => $positiveCount,
            'negative_count' => $negativeCount,
            'neutral_count' => $neutralCount
        ];
    }

    /**
     * Lưu kết quả phân tích cảm xúc vào database
     * @param int $id_comment ID bình luận
     * @param array $sentimentData Kết quả phân tích
     * @return bool
     */
    public function saveSentiment($id_comment, $sentimentData)
    {
        // Kiểm tra xem bảng sentiment có tồn tại không
        // Nếu chưa có, sẽ tạo sau
        $data = [
            'id_comment' => $id_comment,
            'sentiment' => $sentimentData['sentiment'],
            'score' => $sentimentData['score'],
            'confidence' => $sentimentData['confidence'],
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ];

        // Kiểm tra xem đã có phân tích cho comment này chưa
        $existing = $this->db->get_where('comment_sentiment', ['id_comment' => $id_comment])->row();
        
        if ($existing) {
            // Cập nhật
            $this->db->where('id_comment', $id_comment);
            return $this->db->update('comment_sentiment', $data);
        } else {
            // Thêm mới
            return $this->db->insert('comment_sentiment', $data);
        }
    }

    /**
     * Lấy kết quả phân tích cảm xúc của một bình luận
     * @param int $id_comment ID bình luận
     * @return array|null
     */
    public function getSentiment($id_comment)
    {
        $result = $this->db->get_where('comment_sentiment', ['id_comment' => $id_comment])->row_array();
        return $result ? $result : null;
    }

    /**
     * Lấy thống kê sentiment của một phim
     * @param int $id_movie ID phim
     * @return array
     */
    public function getMovieSentimentStats($id_movie)
    {
        $this->db->select('cs.sentiment, COUNT(*) as count');
        $this->db->from('comment_sentiment cs');
        $this->db->join('comment c', 'c.id_comment = cs.id_comment');
        $this->db->where('c.id_movie', $id_movie);
        $this->db->group_by('cs.sentiment');
        $results = $this->db->get()->result_array();

        $stats = [
            'positive' => 0,
            'negative' => 0,
            'neutral' => 0,
            'total' => 0
        ];

        foreach ($results as $result) {
            $sentiment = $result['sentiment'];
            $count = (int)$result['count'];
            if (isset($stats[$sentiment])) {
                $stats[$sentiment] = $count;
            }
            $stats['total'] += $count;
        }

        return $stats;
    }
}

/* End of file sentiment_model.php */
/* Location: ./application/models/sentiment_model.php */

