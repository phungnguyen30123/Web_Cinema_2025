<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Controller xử lý rating cho phim
 * @property CI_DB_mysqli_driver $db
 * @property Rating_model $Rating_model
 * @property CI_Loader $load
 * @property CI_Input $input
 * @property CI_Session $session
 */
class Rating_controller extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Rating_model');
		$this->load->library('session');
	}

	/**
	 * API endpoint để lấy rating của user cho một movie
	 * Method: GET
	 * URL: /rating/get_user_rating/{movie_id}
	 * Response: JSON
	 */
	public function get_user_rating($movie_id = null)
	{
		// Kiểm tra đăng nhập (key session là 'id_user')
		if (!$this->session->userdata('id_user')) {
			echo json_encode(array('success' => false, 'message' => 'Vui lòng đăng nhập để xem rating'));
			return;
		}

		$user_id = $this->session->userdata('id_user');

		if (!$movie_id) {
			echo json_encode(array('success' => false, 'message' => 'Thiếu ID phim'));
			return;
		}

		$rating = $this->Rating_model->getUserRating($user_id, $movie_id);

		if ($rating) {
			echo json_encode(array(
				'success' => true,
				'rating' => $rating['rating'],
				'has_rated' => true
			));
		} else {
			echo json_encode(array(
				'success' => true,
				'rating' => 0,
				'has_rated' => false
			));
		}
	}

	/**
	 * API endpoint để set rating cho movie
	 * Method: POST
	 * URL: /rating/set_rating
	 * Data: movie_id, rating
	 * Response: JSON
	 */
	public function set_rating()
	{
		// Kiểm tra đăng nhập (key session là 'id_user')
		if (!$this->session->userdata('id_user')) {
			echo json_encode(array('success' => false, 'message' => 'Vui lòng đăng nhập để đánh giá phim'));
			return;
		}

		$user_id = $this->session->userdata('id_user');
		$movie_id = $this->input->post('movie_id');
		$rating = $this->input->post('rating');

		// Validate input
		if (!$movie_id || !$rating) {
			echo json_encode(array('success' => false, 'message' => 'Thiếu thông tin rating'));
			return;
		}

		// Accept only integer ratings 1..5
		$rating = intval(round(floatval($rating)));
		if ($rating < 1 || $rating > 5) {
			echo json_encode(array('success' => false, 'message' => 'Rating phải là số nguyên từ 1 đến 5'));
			return;
		}

		// Set rating
		$result = $this->Rating_model->setRating($user_id, $movie_id, $rating);

		if ($result) {
			// Lấy rating trung bình mới
			$avg_rating = $this->Rating_model->getAverageRating($movie_id);
			$rating_count = $this->Rating_model->getRatingCount($movie_id);

			echo json_encode(array(
				'success' => true,
				'message' => 'Cập nhật rating thành công',
				'avg_rating' => $avg_rating,
				'rating_count' => $rating_count,
				'user_rating' => $rating
			));
		} else {
			echo json_encode(array('success' => false, 'message' => 'Có lỗi xảy ra khi cập nhật rating'));
		}
	}

	/**
	 * API endpoint để lấy thống kê rating của movie
	 * Method: GET
	 * URL: /rating/get_stats/{movie_id}
	 * Response: JSON
	 */
	public function get_stats($movie_id = null)
	{
		if (!$movie_id) {
			echo json_encode(array('success' => false, 'message' => 'Thiếu ID phim'));
			return;
		}

		$avg_rating = $this->Rating_model->getAverageRating($movie_id);
		$rating_count = $this->Rating_model->getRatingCount($movie_id);
		$rating_stats = $this->Rating_model->getRatingStats($movie_id);

		echo json_encode(array(
			'success' => true,
			'avg_rating' => $avg_rating,
			'rating_count' => $rating_count,
			'stats' => $rating_stats
		));
	}

	/**
	 * API endpoint để lấy tất cả rating của movie
	 * Method: GET
	 * URL: /rating/get_movie_ratings/{movie_id}
	 * Response: JSON
	 */
	public function get_movie_ratings($movie_id = null)
	{
		if (!$movie_id) {
			echo json_encode(array('success' => false, 'message' => 'Thiếu ID phim'));
			return;
		}

		$ratings = $this->Rating_model->getMovieRatings($movie_id);

		echo json_encode(array(
			'success' => true,
			'ratings' => $ratings
		));
	}

	/**
	 * API endpoint để xóa rating của user
	 * Method: POST
	 * URL: /rating/delete_rating
	 * Data: movie_id
	 * Response: JSON
	 */
	public function delete_rating()
	{
		// Kiểm tra đăng nhập (key session là 'id_user')
		if (!$this->session->userdata('id_user')) {
			echo json_encode(array('success' => false, 'message' => 'Vui lòng đăng nhập'));
			return;
		}

		$user_id = $this->session->userdata('id_user');
		$movie_id = $this->input->post('movie_id');

		if (!$movie_id) {
			echo json_encode(array('success' => false, 'message' => 'Thiếu ID phim'));
			return;
		}

		$result = $this->Rating_model->deleteRating($user_id, $movie_id);

		if ($result) {
			// Lấy rating trung bình mới
			$avg_rating = $this->Rating_model->getAverageRating($movie_id);
			$rating_count = $this->Rating_model->getRatingCount($movie_id);

			echo json_encode(array(
				'success' => true,
				'message' => 'Xóa rating thành công',
				'avg_rating' => $avg_rating,
				'rating_count' => $rating_count
			));
		} else {
			echo json_encode(array('success' => false, 'message' => 'Có lỗi xảy ra khi xóa rating'));
		}
	}

	/**
	 * Lấy danh sách phim được rating cao nhất (cho trang chủ)
	 * Method: GET
	 * URL: /rating/top_rated
	 * Response: JSON
	 */
	public function top_rated()
	{
		$limit = $this->input->get('limit') ?: 10;
		$movies = $this->Rating_model->getTopRatedMovies($limit);

		echo json_encode(array(
			'success' => true,
			'movies' => $movies
		));
	}

	/**
	 * Lấy rating của user hiện tại cho tất cả movie
	 * Method: GET
	 * URL: /rating/my_ratings
	 * Response: JSON
	 */
	public function my_ratings()
	{
		// Kiểm tra đăng nhập (key session là 'id_user')
		if (!$this->session->userdata('id_user')) {
			echo json_encode(array('success' => false, 'message' => 'Vui lòng đăng nhập'));
			return;
		}

		$user_id = $this->session->userdata('id_user');
		$ratings = $this->Rating_model->getUserRatings($user_id);

		echo json_encode(array(
			'success' => true,
			'ratings' => $ratings
		));
	}
}

/* End of file Rating_controller.php */
/* Location: ./application/controllers/Rating_controller.php */
