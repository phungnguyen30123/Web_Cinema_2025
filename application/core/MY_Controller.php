<?php
/**
 * @property CI_DB_mysqli_driver $db
 * @property login_model $login_model
 * @property register_model $register_model
 * @property CI_Loader $load
 * @property CI_Input $input
 * @property CI_Session $session
 */
class MY_Controller extends CI_Controller {
    public function __construct() {
        parent::__construct();
        // Kiểm tra nếu chưa đăng nhập thì đuổi về trang login
        if (!$this->session->userdata('logged_in')) {
            redirect('Login_register/indexlogin');
        }
    }

    // Hàm hỗ trợ kiểm tra quyền cụ thể
    protected function restrict_to($roles = []) {
        $user_role = $this->session->userdata('user_role');
        
        if (!in_array($user_role, $roles)) {
            // 1. Tạo thông báo lỗi để hiển thị ở trang đích
            $this->session->set_flashdata('error_msg', 'Bạn không có quyền thực hiện hành động này!');

            // 2. Kiểm tra xem có trang trước đó không (HTTP_REFERER)
            // Nếu có trang trước thì quay lại, nếu không thì về trang chủ
            $referer = $this->input->server('HTTP_REFERER');
            if ($referer) {
                redirect($referer);
            } else {
                redirect('Index_controller');
            }
        }
    }
}