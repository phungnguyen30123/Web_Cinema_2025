<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Trang bảng xếp hạng rating (dựa trên template rates-full)
 * @property CI_DB_mysqli_driver $db
 * @property Rating_model $Rating_model
 * @property CI_Loader $load
 * @property CI_Input $input
 */
class Rating_page_controller extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library('session');
		$this->load->model('Rating_model');
	}

	public function index()
	{
		// Lấy top rated movies
		$limit = 50; // mặc định hiển thị tối đa 50 phim
		$movies = $this->Rating_model->getTopRatedMovies($limit);

		// Nếu user đã đăng nhập, lấy rating của user cho từng movie
		$user_id = $this->session->userdata('id_user');
		if ($user_id && !empty($movies) && is_array($movies)) {
			foreach ($movies as &$m) {
				$m['user_rating'] = null;
				$userRatingData = $this->Rating_model->getUserRating($user_id, $m['id']);
				if ($userRatingData) {
					$m['user_rating'] = $userRatingData['rating'];
				}
			}
			unset($m);
		}

		$data = array(
			'movies' => $movies,
			'current_user_id' => $user_id
		);

		$this->load->view('rates_view', $data);
	}
}

/* End of file Rating_page_controller.php */
/* Location: ./application/controllers/Rating_page_controller.php */


