<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Thêm dòng này vào danh sách DocBlock của Controller:
 * @property CI_DB_mysqli_driver $db
 * @property showPhim_model $showPhim_model 
 * @property CI_Loader $load           // Nếu bạn dùng $this->load
 * @property CI_Input $input           // Nếu bạn dùng $this->input (Lỗi cũ)
 */

class Index_controller extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library('session');
	}

	public function index()
	{
		$this->load->model('showPhim_model');
		$this->load->model('Rating_model');

		$dulieuPhimDC = $this->showPhim_model->getDatabasePhimDC();

		// Thêm thông tin rating cho từng phim
		$user_id = $this->session->userdata('id_user');
		foreach ($dulieuPhimDC as &$movie) {
			$movie['avg_rating'] = $this->Rating_model->getAverageRating($movie['id']);
			$movie['rating_count'] = $this->Rating_model->getRatingCount($movie['id']);
			$movie['user_rating'] = null;
			if ($user_id) {
				$userRatingData = $this->Rating_model->getUserRating($user_id, $movie['id']);
				if ($userRatingData) {
					$movie['user_rating'] = $userRatingData['rating'];
				}
			}
		}

		$dulieuPhimDC = array('dulieuPhimDCcon' => $dulieuPhimDC );
		$this->load->view('Index_view', $dulieuPhimDC, FALSE);
	}

}

/* End of file IndexPhimDC_controller.php */
/* Location: ./application/controllers/IndexPhimDC_controller.php */