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
        $phim = $this->showPhim_model->getDatabasePhim();
        $data = array('dulieutucontroller' => $phim);

        // Không cần kiểm tra session vip2 nữa vì MY_Controller đã lo
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
        $booking = $this->seat_model->showBooking();
        $data = array('dulieubookingtucon' => $booking);

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