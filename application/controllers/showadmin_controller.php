<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @property CI_DB_mysqli_driver $db
 * @property showadmin_model $showadmin_model
 * @property CI_Loader $load
 * @property CI_Input $input
 * @property CI_Session $session
 */
class showadmin_controller extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
	}

	public function index(){
		
			$this->load->model('showadmin_model');
          
			$dulieu = $this->showadmin_model->getadmin();
			
			$dulieu = array('dulieuvaocontroller' => $dulieu);

			//echo"<pre>";
			//var_dump($dulieu);
			if ($this->session->userdata('vipmembe')) {
			$this->load->view('taikhoan_view',$dulieu, FALSE);
			
		}else {
			redirect('Login_register/indexlogin','refresh');
		}


			
	
	}
	public function deleteuser($id)
	{
		$this->load->model('showadmin_model');
		$this->showadmin_model->deleteuserById($id);
		$this->index();

	}
	public function index_qlnv()
	{
		$this->load->model('showadmin_model');
		$dulieu = $this->showadmin_model->getNV();
		$dulieu = array('dulieuvaocontroller' => $dulieu);
		if ($this->session->userdata('vipmembe')) {
			$this->load->view('qlynhanvien_view',$dulieu, FALSE);
			
		}else {
			redirect('Login_register/indexlogin','refresh');
		}


	}
	public function index_insertnv()
	{
		$this->load->view('insertnv_view');
	}
	public function insertnv()
	{
		$email = $this->input->post('email');
		$name = $this->input->post('name');
		$mkau= $email;
		$mkauxn = $email;
		$birthday = $this->input->post('bday');
		$sdt = $this->input->post('sdt');
		$diachi = $this->input->post('diachi');
		
		$this->load->model('showadmin_model');
		$this->showadmin_model->addnv($email, $mkau,$name, $birthday, $sdt, $diachi);
		
		$this->index_insertnv();
	}
	public function xoanv($id)
	{
		$this->load->model('showadmin_model');
		$this->showadmin_model->deleteuserById($id);
		$this->index_qlnv();
	}
}


/* End of file showuser_controller.php */
/* Location: ./application/controllers/showuser_controller.php */