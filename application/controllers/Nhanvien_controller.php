<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @property CI_DB_mysqli_driver $db
 * @property showPhim_model $showPhim_model
 * @property seat_model $seat_model
 * @property CI_Loader $load
 * @property CI_Input $input
 * @property CI_Session $session
 */

// Kế thừa từ MY_Controller để tận dụng bộ lọc bảo mật tập trung
class Nhanvien_controller extends MY_Controller {

    public function __construct()
    {
        parent::__construct();
        // Cho phép cả Staff và Admin vào khu vực quản lý phim/vé
        $this->restrict_to(['staff', 'admin']);
    }

    public function index()
    {
        $this->load->model('showPhim_model');
        $this->load->library('pagination');
        
        // Cấu hình phân trang
        $config['base_url'] = site_url($this->router->class . '/' . $this->router->method);
        $config['total_rows'] = $this->showPhim_model->countPhim();
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
        
        $phim = $this->showPhim_model->getDatabasePhimPaginated($config['per_page'], $offset);
        $data = array(
            'dulieutucontroller' => $phim,
            'pagination_links' => $this->pagination->create_links()
        );

        $this->load->view('qlyphim_view', $data);
    }

    public function deletePhim($idnhanduoc)
    {
        $this->load->model('showPhim_model');
        if ($this->showPhim_model->deletePhimById($idnhanduoc)) {
            // Nên redirect thay vì chỉ load view để URL sạch hơn
            redirect('Nhanvien_controller', 'refresh');
        } else {
            show_error("Không thể xóa phim này.");
        }
    }
    
    public function index_xacnhanve()
    {
        $this->load->model('seat_model');
        $this->load->library('pagination');
        
        // Cấu hình phân trang
        $config['base_url'] = site_url($this->router->class . '/' . $this->router->method);
        $config['total_rows'] = $this->seat_model->countBooking();
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
        
        $booking = $this->seat_model->showBookingPaginated($config['per_page'], $offset);
        $data = array(
            'dulieubookingtucon' => $booking,
            'pagination_links' => $this->pagination->create_links()
        );

        $this->load->view('xacnhanve_view', $data);
    }

    public function xacnhanve($idv)
    {
        // Sử dụng Query Builder một cách an toàn
        $dulieucanupdate = array('status' => 1);
        $this->db->where('id_ve', $idv);
        $this->db->update('booking', $dulieucanupdate);

        // Chuyển hướng về trang danh sách để cập nhật giao diện
        redirect('Nhanvien_controller/index_xacnhanve', 'refresh');
    }
}