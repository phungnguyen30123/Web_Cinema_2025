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
		// Lấy tất cả ngày có lịch chiếu cho phim này
		$dulieungay_result = $this->lich_model->getDatabaseNgay($idlaytuview); // mỗi phần tử có key 'day'
		$dulieungay = array('dulieungaytucontroller' => $dulieungay_result);

		// Gom nhóm các suất chiếu theo ngày
		$dulieugio_by_day = array();
		foreach ($dulieungay_result as $dg) {
			$d = $dg['day'];
			$dulieugio_by_day[$d] = $this->lich_model->getDatabaseLichchieu($idlaytuview, $d);
		}
		$dulieugio = array('dulieugiotucontroller' => $dulieugio_by_day);

		$this->load->view('movie_page_view', $ketqua + $dulieungay + $dulieugio);
		
	}

}

/* End of file Movie-page_controller.php */
/* Location: ./application/controllers/Movie-page_controller.php */