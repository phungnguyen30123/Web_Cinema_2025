<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @property CI_DB_mysqli_driver $db
 * @property showadmin_model $showadmin_model
 * @property CI_Loader $load
 * @property CI_Input $input
 * @property CI_Session $session
 */

// Kế thừa từ MY_Controller để tự động bảo vệ đăng nhập
class showadmin_controller extends MY_Controller {

    public function __construct()
    {
        parent::__construct();
        // Giới hạn chỉ Admin (role 'admin') mới được vào Controller này
        $this->restrict_to(['admin']);
    }

    public function index()
    {
        $this->load->model('showadmin_model');
        $dulieu = $this->showadmin_model->getadmin();
        $data = array('dulieuvaocontroller' => $dulieu);

        // Không cần check if/else session ở đây nữa vì MY_Controller đã lo
        $this->load->view('taikhoan_view', $data);
    }

    public function deleteuser($id)
    {
        $this->load->model('showadmin_model');
        $this->showadmin_model->deleteuserById($id);
        redirect('showadmin_controller', 'refresh');
    }

    public function index_qlnv()
    {
        $this->load->model('showadmin_model');
        $dulieu = $this->showadmin_model->getNV();
        $data = array('dulieuvaocontroller' => $dulieu);

        $this->load->view('qlynhanvien_view', $data);
    }

    public function index_insertnv()
    {
        $this->load->view('insertnv_view');
    }

    public function insertnv()
    {
        $email = $this->input->post('email');
        $name = $this->input->post('name');
        $mkau = $email; // Mật khẩu mặc định là email
        $birthday = $this->input->post('bday');
        $sdt = $this->input->post('sdt');
        $diachi = $this->input->post('diachi');
        
        $this->load->model('showadmin_model');
        $this->showadmin_model->addnv($email, $mkau, $name, $birthday, $sdt, $diachi);
        
        // Sau khi thêm, nên chuyển hướng về danh sách thay vì chỉ load view
        redirect('showadmin_controller/index_qlnv', 'refresh');
    }

    public function xoanv($id)
    {
        $this->load->model('showadmin_model');
        $this->showadmin_model->deleteuserById($id);
        redirect('showadmin_controller/index_qlnv', 'refresh');
    }
}