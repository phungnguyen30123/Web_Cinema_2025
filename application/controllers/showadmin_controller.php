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
        $this->load->library('pagination');
        
        // Cấu hình phân trang
        $config['base_url'] = site_url($this->router->class . '/' . $this->router->method);
        $config['total_rows'] = $this->showadmin_model->countAdmin();
        $config['per_page'] = 10;
        $config['uri_segment'] = 3;
        $config['use_page_numbers'] = TRUE;
        $config['first_link'] = 'Đầu';
        $config['last_link'] = 'Cuối';
        $config['next_link'] = '&gt;';
        $config['prev_link'] = '&lt;';
        $config['full_tag_open'] = '<ul class="pagination">';
        $config['full_tag_close'] = '</ul>';
        $config['first_tag_open'] = '<li class="page-item">';
        $config['first_tag_close'] = '</li>';
        $config['last_tag_open'] = '<li class="page-item">';
        $config['last_tag_close'] = '</li>';
        $config['next_tag_open'] = '<li class="page-item">';
        $config['next_tag_close'] = '</li>';
        $config['prev_tag_open'] = '<li class="page-item">';
        $config['prev_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="page-item active"><span class="page-link">';
        $config['cur_tag_close'] = '</span></li>';
        $config['num_tag_open'] = '<li class="page-item">';
        $config['num_tag_close'] = '</li>';
        $config['attributes'] = array('class' => 'page-link');
        
        $this->pagination->initialize($config);
        
        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 1;
        $offset = ($page - 1) * $config['per_page'];
        
        $dulieu = $this->showadmin_model->getadminPaginated($config['per_page'], $offset);
        $data = array(
            'dulieuvaocontroller' => $dulieu,
            'pagination_links' => $this->pagination->create_links()
        );

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
        $this->load->library('pagination');
        
        // Cấu hình phân trang
        $config['base_url'] = site_url($this->router->class . '/' . $this->router->method);
        $config['total_rows'] = $this->showadmin_model->countNV();
        $config['per_page'] = 10;
        $config['uri_segment'] = 3;
        $config['use_page_numbers'] = TRUE;
        $config['first_link'] = 'Đầu';
        $config['last_link'] = 'Cuối';
        $config['next_link'] = '&gt;';
        $config['prev_link'] = '&lt;';
        $config['full_tag_open'] = '<ul class="pagination">';
        $config['full_tag_close'] = '</ul>';
        $config['first_tag_open'] = '<li class="page-item">';
        $config['first_tag_close'] = '</li>';
        $config['last_tag_open'] = '<li class="page-item">';
        $config['last_tag_close'] = '</li>';
        $config['next_tag_open'] = '<li class="page-item">';
        $config['next_tag_close'] = '</li>';
        $config['prev_tag_open'] = '<li class="page-item">';
        $config['prev_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="page-item active"><span class="page-link">';
        $config['cur_tag_close'] = '</span></li>';
        $config['num_tag_open'] = '<li class="page-item">';
        $config['num_tag_close'] = '</li>';
        $config['attributes'] = array('class' => 'page-link');
        
        $this->pagination->initialize($config);
        
        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 1;
        $offset = ($page - 1) * $config['per_page'];
        
        $dulieu = $this->showadmin_model->getNVPaginated($config['per_page'], $offset);
        $data = array(
            'dulieuvaocontroller' => $dulieu,
            'pagination_links' => $this->pagination->create_links()
        );

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