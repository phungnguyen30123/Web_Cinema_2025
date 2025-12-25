<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @property CI_DB_mysqli_driver $db
 * @property CI_Loader $load
 * @property CI_Input $input
 */
// Kế thừa từ MY_Controller để tự động bảo vệ đăng nhập
class Insertuser_controller extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		// Chỉ cho phép Admin tạo user mới
		$this->restrict_to(['admin']);
	}

	public function index()
	{
		$this->load->view('insertuser_view');
	}

	public function mkuser_controller()
	{

	echo	$email = $this->input->post('email');
		echo	$fullname = $this->input->post('fullname');
	echo	$birthday = $this->input->post('birthday');
	
	echo	$address = $this->input->post('address');
echo	$sdt = $this->input->post('sdt');

		

		
	}

}

/* End of file InsertPhim_controller.php */
/* Location: ./application/controllers/InsertPhim_controller.php */