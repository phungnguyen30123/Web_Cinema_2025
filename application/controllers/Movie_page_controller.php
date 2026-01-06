<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @property CI_DB_mysqli_driver $db
 * @property showPhim_model $showPhim_model
 * @property lich_model $lich_model
 * @property CI_Loader $load
 * @property CI_Input $input
 */
class Movie_page_controller extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		// Ensure session is available when building view data
		$this->load->library('session');
	}

	public function index()
	{
		
	}

	public function showinfophim($idlaytuview)
	{
		
		$this->load->model('showPhim_model');
		$ketqua = $this->showPhim_model->getinfophim($idlaytuview);
		$ketqua = array('dulieutucontroller' =>$ketqua);
		$daychuadoi = date('Y-m-d');
		$this->load->model('lich_model');
		// Lấy tất cả ngày có lịch chiếu cho phim này (đã được sắp xếp và lọc ngày đã qua trong model)
		$dulieungay_result = $this->lich_model->getDatabaseNgay($idlaytuview); // mỗi phần tử có key 'day'
		
		// Đảm bảo sắp xếp lại theo ngày tăng dần (ngày sớm nhất trước)
		usort($dulieungay_result, function($a, $b) {
			return strcmp($a['day'], $b['day']);
		});
		
		$dulieungay = array('dulieungaytucontroller' => $dulieungay_result);

		// Gom nhóm các suất chiếu theo ngày
		$dulieugio_by_day = array();
		foreach ($dulieungay_result as $dg) {
			$d = $dg['day'];
			$dulieugio_by_day[$d] = $this->lich_model->getDatabaseLichchieu($idlaytuview, $d);
			// Sắp xếp lại giờ chiếu trong mỗi ngày (sớm nhất trước)
			if (!empty($dulieugio_by_day[$d])) {
				usort($dulieugio_by_day[$d], function($a, $b) {
					return strcmp($a['time'], $b['time']);
				});
			}
		}
		// Sắp xếp mảng theo key (ngày) để đảm bảo thứ tự
		ksort($dulieugio_by_day);
		$dulieugio = array('dulieugiotucontroller' => $dulieugio_by_day);

		// Lấy bình luận chưa được xử lý
		$this->load->model('comment_model');
		$binhluan_chuaxuly = $this->comment_model->getCommentsChuaXuLy($idlaytuview);

		// ===== RATING SYSTEM =====
		// Lấy thông tin rating của phim
		$this->load->model('Rating_model');
		$avg_rating = $this->Rating_model->getAverageRating($idlaytuview);
		$rating_count = $this->Rating_model->getRatingCount($idlaytuview);

		// Lấy rating của user hiện tại (nếu đã đăng nhập)
		$user_rating = null;
		if ($this->session->userdata('id_user')) {
			$user_rating_data = $this->Rating_model->getUserRating(
				$this->session->userdata('id_user'),
				$idlaytuview
			);
			if ($user_rating_data) {
				$user_rating = $user_rating_data['rating'];
			}
		}

		$dulieurating = array(
			'avg_rating' => $avg_rating,
			'rating_count' => $rating_count,
			'user_rating' => $user_rating
		);
		
		// ===== PHÂN TÍCH CẢM XÚC BÌNH LUẬN (SENTIMENT ANALYSIS) - TẠM TẮT =====
		// Lấy thông tin sentiment cho mỗi bình luận
		// $this->load->model('sentiment_model');
		// foreach ($binhluan_chuaxuly as &$binhluan) {
		// 	$sentiment = $this->sentiment_model->getSentiment($binhluan['id_comment']);
		// 	$binhluan['sentiment'] = $sentiment;
		// }
		// 
		// // Lấy thống kê sentiment của phim
		// $sentimentStats = $this->sentiment_model->getMovieSentimentStats($idlaytuview);
		// 
		// $dulieubinhluan = array(
		// 	'binhluan_chuaxuly' => $binhluan_chuaxuly,
		// 	'sentiment_stats' => $sentimentStats
		// );
		// ===== END SENTIMENT ANALYSIS =====
		
		$dulieubinhluan = array('binhluan_chuaxuly' => $binhluan_chuaxuly);

		$this->load->view('movie_page_view', $ketqua + $dulieungay + $dulieugio + $dulieubinhluan + $dulieurating);
		
	}

	/**
	 * Xử lý submit bình luận
	 */
	public function submitComment()
	{
		// Kiểm tra đăng nhập
		if (!$this->session->userdata('logged_in')) {
			$this->session->set_flashdata('error_msg', 'Vui lòng đăng nhập để bình luận');
			$id_movie = $this->input->post('id_movie');
			if ($id_movie) {
				redirect(site_url('Movie_page_controller/showinfophim/' . $id_movie) . '?show_login=1');
			} else {
				redirect(site_url('Index_controller') . '?show_login=1');
			}
			return;
		}

		// Lấy dữ liệu từ form
		$id_movie = $this->input->post('id_movie');
		$content = $this->input->post('content');
		$id_user = $this->session->userdata('id_user');

		// Validate
		if (empty($id_movie) || empty($content)) {
			$this->session->set_flashdata('error_msg', 'Vui lòng nhập nội dung bình luận');
			redirect('Movie_page_controller/showinfophim/' . $id_movie);
			return;
		}

		// Kiểm tra độ dài
		if (strlen($content) > 250) {
			$this->session->set_flashdata('error_msg', 'Nội dung bình luận không được vượt quá 250 ký tự');
			redirect('Movie_page_controller/showinfophim/' . $id_movie);
			return;
		}

		// Lưu bình luận
		$this->load->model('comment_model');
		$data = array(
			'id_movie' => $id_movie,
			'id_user' => $id_user,
			'content' => trim($content),
			'status' => 0 // Mặc định chưa xử lý
		);

		if ($this->comment_model->insertComment($data)) {
			// ===== PHÂN TÍCH CẢM XÚC BÌNH LUẬN (SENTIMENT ANALYSIS) - TẠM TẮT =====
			// Lấy ID bình luận vừa tạo
			// $id_comment = $this->db->insert_id();
			// 
			// // Phân tích cảm xúc bình luận bằng AI
			// $this->load->model('sentiment_model');
			// $sentimentData = $this->sentiment_model->analyzeSentiment($content);
			// 
			// // Lưu kết quả phân tích
			// $this->sentiment_model->saveSentiment($id_comment, $sentimentData);
			// ===== END SENTIMENT ANALYSIS =====
			
			$this->session->set_flashdata('success_msg', 'Bình luận của bạn đã được gửi thành công!');
		} else {
			$this->session->set_flashdata('error_msg', 'Có lỗi xảy ra khi gửi bình luận. Vui lòng thử lại.');
		}

		// Redirect về trang phim
		redirect('Movie_page_controller/showinfophim/' . $id_movie);
	}

	/**
	 * Cập nhật bình luận
	 */
	public function updateComment()
	{
		// Kiểm tra đăng nhập
		if (!$this->session->userdata('logged_in')) {
			$this->session->set_flashdata('error_msg', 'Vui lòng đăng nhập');
			redirect(site_url('Index_controller') . '?show_login=1');
			return;
		}

		$id_comment = $this->input->post('id_comment');
		$content = $this->input->post('content');
		$id_user = $this->session->userdata('id_user');

		// Validate
		if (empty($id_comment) || empty($content)) {
			$this->session->set_flashdata('error_msg', 'Dữ liệu không hợp lệ');
			redirect('Index_controller');
			return;
		}

		// Kiểm tra độ dài
		if (strlen($content) > 250) {
			$this->session->set_flashdata('error_msg', 'Nội dung bình luận không được vượt quá 250 ký tự');
			redirect('Index_controller');
			return;
		}

		// Kiểm tra quyền: chỉ cho phép sửa bình luận của chính mình
		$this->load->model('comment_model');
		$comment = $this->comment_model->getCommentById($id_comment);
		
		if (!$comment) {
			$this->session->set_flashdata('error_msg', 'Bình luận không tồn tại');
			redirect('Index_controller');
			return;
		}

		if ($comment['id_user'] != $id_user) {
			$this->session->set_flashdata('error_msg', 'Bạn không có quyền sửa bình luận này');
			redirect('Index_controller');
			return;
		}

		// Cập nhật bình luận
		$updateData = array('content' => trim($content));
		$this->db->where('id_comment', $id_comment);
		$result = $this->db->update('comment', $updateData);
		
		if ($result) {
			$this->session->set_flashdata('success_msg', 'Bình luận đã được cập nhật thành công!');
		} else {
			// Kiểm tra lỗi
			$error = $this->db->error();
			$this->session->set_flashdata('error_msg', 'Có lỗi xảy ra khi cập nhật bình luận: ' . (isset($error['message']) ? $error['message'] : 'Unknown error'));
		}

		// Redirect về trang phim
		redirect('Movie_page_controller/showinfophim/' . $comment['id_movie']);
	}

	/**
	 * Cập nhật bình luận bằng AJAX
	 */
	public function updateCommentAjax()
	{
		// Set header để trả về JSON
		header('Content-Type: application/json');
		
		// Kiểm tra đăng nhập
		if (!$this->session->userdata('logged_in')) {
			echo json_encode(array('success' => false, 'message' => 'Vui lòng đăng nhập'));
			exit;
		}

		$id_comment = $this->input->post('id_comment');
		$content = $this->input->post('content');
		$id_user = $this->session->userdata('id_user');

		// Log để debug
		log_message('debug', 'UpdateCommentAjax - id_comment: ' . $id_comment . ', content: ' . $content . ', id_user: ' . $id_user);

		// Validate
		if (empty($id_comment) || empty($content)) {
			echo json_encode(array('success' => false, 'message' => 'Dữ liệu không hợp lệ'));
			exit;
		}

		// Kiểm tra độ dài
		if (strlen($content) > 250) {
			echo json_encode(array('success' => false, 'message' => 'Nội dung bình luận không được vượt quá 250 ký tự'));
			exit;
		}

		// Kiểm tra quyền: chỉ cho phép sửa bình luận của chính mình
		$this->load->model('comment_model');
		$comment = $this->comment_model->getCommentById($id_comment);
		
		if (!$comment) {
			echo json_encode(array('success' => false, 'message' => 'Bình luận không tồn tại'));
			exit;
		}

		if ($comment['id_user'] != $id_user) {
			echo json_encode(array('success' => false, 'message' => 'Bạn không có quyền sửa bình luận này'));
			exit;
		}

		// Cập nhật bình luận (cập nhật cả updated_at)
		// Đảm bảo timezone là Asia/Ho_Chi_Minh (UTC+7)
		date_default_timezone_set('Asia/Ho_Chi_Minh');
		$updateData = array(
			'content' => trim($content),
			'updated_at' => date('Y-m-d H:i:s')
		);
		$this->db->where('id_comment', $id_comment);
		$result = $this->db->update('comment', $updateData);
		
		if ($result) {
			log_message('debug', 'Comment updated successfully - id_comment: ' . $id_comment);
			// Trả về updated_at để hiển thị trên frontend
			echo json_encode(array(
				'success' => true, 
				'message' => 'Bình luận đã được cập nhật thành công!',
				'updated_at' => $updateData['updated_at']
			));
		} else {
			// Kiểm tra lỗi
			$error = $this->db->error();
			log_message('error', 'Comment update failed - id_comment: ' . $id_comment . ', error: ' . print_r($error, true));
			echo json_encode(array('success' => false, 'message' => 'Có lỗi xảy ra khi cập nhật bình luận: ' . (isset($error['message']) ? $error['message'] : 'Unknown error')));
		}
		exit;
	}

	/**
	 * Xóa bình luận
	 */
	public function deleteComment()
	{
		// Kiểm tra đăng nhập
		if (!$this->session->userdata('logged_in')) {
			$this->session->set_flashdata('error_msg', 'Vui lòng đăng nhập');
			redirect(site_url('Index_controller') . '?show_login=1');
			return;
		}

		$id_comment = $this->input->post('id_comment');
		$id_user = $this->session->userdata('id_user');

		// Validate
		if (empty($id_comment)) {
			$this->session->set_flashdata('error_msg', 'Dữ liệu không hợp lệ');
			redirect('Index_controller');
			return;
		}

		// Kiểm tra quyền: chỉ cho phép xóa bình luận của chính mình
		$this->load->model('comment_model');
		$comment = $this->comment_model->getCommentById($id_comment);
		
		if (!$comment) {
			$this->session->set_flashdata('error_msg', 'Bình luận không tồn tại');
			redirect('Index_controller');
			return;
		}

		if ($comment['id_user'] != $id_user) {
			$this->session->set_flashdata('error_msg', 'Bạn không có quyền xóa bình luận này');
			redirect('Index_controller');
			return;
		}

		$id_movie = $comment['id_movie'];

		// Xóa bình luận
		if ($this->comment_model->deleteComment($id_comment)) {
			$this->session->set_flashdata('success_msg', 'Bình luận đã được xóa thành công!');
		} else {
			$this->session->set_flashdata('error_msg', 'Có lỗi xảy ra khi xóa bình luận');
		}

		// Redirect về trang phim
		redirect('Movie_page_controller/showinfophim/' . $id_movie);
	}

}

/* End of file Movie-page_controller.php */
/* Location: ./application/controllers/Movie-page_controller.php */