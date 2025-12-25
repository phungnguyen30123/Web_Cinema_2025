<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @property CI_DB_mysqli_driver $db     // <-- Dùng driver cụ thể này
 * @property lich_model $lich_model 
 * @property insertPhim_model $insertPhim_model 
 * @property CI_Loader $load           
 * @property CI_Input $input           
 */
// Kế thừa từ MY_Controller để tự động bảo vệ đăng nhập
class InsertPhim_controller extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		// Cho phép cả Staff và Admin vào khu vực quản lý phim
		$this->restrict_to(['staff', 'admin']);
	}

	public function index()
	{
		$this->load->view('insertPhim_view');
	}

	public function insertPhim()
	{
		$title = $this->input->post('title');
		$duration = $this->input->post('duration');
		$director = $this->input->post('director');
		$actor = $this->input->post('actor');
		$language = $this->input->post('language');
		$country= $this->input->post('country');
		$decription = $this->input->post('description');
		$open_date = $this->input->post('open_date');
		$category= $this->input->post('category');

		$this->load->model('insertPhim_model');
		$this->insertPhim_model->insertPhim($title, $duration,$director, $actor,$language,$country,$decription,$open_date, $category);
		$id_movie = $this->db->insert_id();
		$this->load->model('lich_model');
		$this->lich_model->addNgay($id_movie, $open_date);
		$this->index();
	}

}

/* End of file InsertPhim_controller.php */
/* Location: ./application/controllers/InsertPhim_controller.php */