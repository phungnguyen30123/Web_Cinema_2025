<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @property CI_DB_mysqli_driver $db
 * @property seat_model $seat_model
 * @property CI_Loader $load
 * @property CI_Input $input
 * @property CI_Session $session
 */

// Kế thừa từ MY_Controller để tự động bảo vệ đăng nhập
class seat_controller extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
	}

	public function index_seat($idc)
	{
		$this->load->model('seat_model');
		$dulieu = $this->seat_model->getDatabaseLich($idc);

		$dulieu = array('dulieulichtucontroller' => $dulieu);
		$dulieuseat = $this->seat_model->getSeat($idc);
		// echo "<pre>";
		$seats= "";
		// var_dump($dulieuseat);
		foreach ($dulieuseat as $value) {
			foreach ($value as $key => $value1) {
				$seats = $seats . $value1 . ", ";
				// code...
			}
		}
		// var_dump($seats);
		$seats = rtrim($seats,", ");
		// var_dump($seats);
		$dulieutucontroller = array(array($seats));
		$dulieus = array('dulieuseattucontroller' => $dulieutucontroller);

		// 
		// var_dump($dulieus);
		// Không cần kiểm tra session vipmember nữa vì MY_Controller đã lo
		$this->load->view('Seat_view',$dulieu+$dulieus);
		
	}
	// public function addseat()
	// {
	// 	$seats = $_GET["seats"];

	// 	var_dump($seats);
	// 	$id_calendar = $this->input->get_post('id_calendar');
	// 	echo $id_calendar;

	// 	for ($i=0; $i <count($seats) ; $i++) {
	// 		$dulieuthemvaodb = array(
	// 			'ma_ghe' => $seats[$i] ,
	// 			'id_lichchieu'=> $id_calendar ,
	// 			'status'=> '1'
	// 		);
	// 		$this->db->insert('seats', $dulieuthemvaodb);
	// 	}
	// 	//$this->load->view('Index_view');
	// 	//$id_calendar = $this->input->get_post('name');

	// }
	public function index_thanhtoan()
	{
		//$seats = $_GET["seats"];

		//var_dump($seats);
		
		$id_calendar = $this->input->get_post('id_calendar');
		
		$choosen_number = $this->input->get_post('choosen-number');
		$choosen_number_cheap = $this->input->get_post('choosen-number--cheap');
		$choosen_number_middle = $this->input->get_post('choosen-number--middle');
		$choosen_number_expansive = $this->input->get_post('choosen-number--expansive');
		$choosen_cost = $this->input->get_post('choosen-cost');
		$choosen_sits = $this->input->get_post('choosen-sits');
		$tenphim = $this->input->get_post('tenphim');
		$ngay = $this->input->get_post('ngay');
		$gio = $this->input->get_post('gio');
		
		// Kiểm tra nếu chưa chọn ghế nào
		if (empty($choosen_sits) || empty($choosen_number) || $choosen_number == '0' || $choosen_number == 0) {
			$this->session->set_flashdata('error_msg', 'Vui lòng chọn ít nhất một ghế trước khi thanh toán!');
			if (!empty($id_calendar)) {
				redirect('seat_controller/index_seat/' . $id_calendar);
			} else {
				redirect('Index_controller');
			}
			return;
		}
		
		$dulieutucontroller = array(array(
			$id_calendar,
			$choosen_number,
			$choosen_number_cheap,
			$choosen_number_middle,
			$choosen_number_expansive,
			$choosen_cost,
			$choosen_sits,
			$tenphim,
			$ngay,
			$gio
	));
		$dulieu = array('dulieughetucontroller'=>$dulieutucontroller);
		

		// $dulieu = array('dulieughetucontroller' => $dulieu);
		// // $dulieughetucontroller = array('dulieutucontroller' => $dulieughetucontroller);
		// echo "<pre>";
		// var_dump($dulieu);
		// Không cần kiểm tra session vipmember nữa vì MY_Controller đã lo
		$this->load->view('Thanhtoan_view', $dulieu);
		


		
		//$this->load->view('Thanhtoan_view');
	}

	public function index_ticket()
	{

		$id_user = $this->input->get_post('id_user');
		$this->load->model('seat_model');
		$dulieuuser = $this->seat_model->gettenuser($id_user); 
		$id_calendar = $this->input->get_post('id_calendar');
		$choosen_sits= $this->input->get_post('choosen-sits');
		$choosen_cost = $this->input->get_post('choosen-cost');
		$tenphim = $this->input->get_post('tenphim');
		$ngay = $this->input->get_post('ngay');
		$gio = $this->input->get_post('gio');
		$this->seat_model->addBooking($id_user, $id_calendar,$choosen_sits, $choosen_cost); 
				$dulieutucontroller = array(array(
			$id_calendar,
			$choosen_cost,
			$choosen_sits,
			$tenphim,
			$ngay,
			$gio
	));
		$dulieuuser = array('dulieuusertucontroller'=>$dulieuuser);
		$dulieu = array('dulieuvetucontroller'=>$dulieutucontroller);
		// Không cần kiểm tra session vipmember nữa vì MY_Controller đã lo
		$this->load->view('Ticket_view', $dulieu+$dulieuuser);
		


		//$this->load->view('Ticket_view');

	}


}

/* End of file seat_controller.php */
/* Location: ./application/controllers/seat_controller.php */