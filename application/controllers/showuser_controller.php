<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @property CI_DB_mysqli_driver $db
 * @property showuser_model $showuser_model
 * @property login_model $login_model
 * @property CI_Loader $load
 * @property CI_Input $input
 * @property CI_Session $session
 */

// Kế thừa từ MY_Controller để tự động bảo vệ đăng nhập
class showuser_controller extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
	}

	public function indexshowuser()
	{	
		$this->load->model('showuser_model');
		$id_user = $this->session->userdata('id_user');
		$dulieu = $this->showuser_model->getuser($id_user);
		
		$dulieu = array('dulieucontroller' => $dulieu ); 

		// Không cần kiểm tra session vipmember nữa vì MY_Controller đã lo
		$this->load->view('showuser_view', $dulieu);
	}
     
	public function logout(){
		// Xóa toàn bộ session (đã được xử lý trong Login_register/logout)
		// Giữ lại method này để tương thích với các link cũ nếu có
		redirect('Login_register/logout', 'refresh');
	}
	public function edituser($idlayve)
	{
		// Kiểm tra quyền: chỉ cho phép user chỉnh sửa thông tin của chính mình
		$current_user_id = $this->session->userdata('id_user');
		if ($idlayve != $current_user_id) {
			$this->session->set_flashdata('error_msg', 'Bạn không có quyền chỉnh sửa thông tin người dùng khác!');
			redirect('showuser_controller/indexshowuser', 'refresh');
			return;
		}

		$this->load->model('showuser_model');
		$ketqua = $this->showuser_model->editByID($idlayve);
		$ketqua = array('mangketqua' => $ketqua);
		//truyền ketqua vào efitview
		$this->load->view('edituser_view', $ketqua, FALSE);
	}


     public function updatedulieu(){
	$id = $this->input->post('id');
	$fullname = $this->input->post('fullname');
	$birthday = $this->input->post('birthday');
	$email = $this->input->post('email');
	$sdt = $this->input->post('sdt');
	$address = $this->input->post('address');

	
	$this->load->model('showuser_model');

	$this->showuser_model->updateDataById($id,$fullname,$birthday,$email,$sdt,$address);
		
	$this->indexshowuser();
     

     }
     public function indextaikhoan()
	{
		
		$this->load->view('showuser_view');
		$this->load->model('login_model');

          echo '<pre>';
		var_dump($this->login_model->getdatabase());
		
	}

	public function history()
	{
		$this->load->model('showuser_model');
		$id_user = $this->session->userdata('id_user');
		$booking_history = $this->showuser_model->getBookingHistory($id_user);
		
		$data = array('booking_history' => $booking_history);
		$this->load->view('booking_history_view', $data);
	}
 
}

/* End of file showuser_controller.php */
/* Location: ./application/controllers/showuser_controller.php */