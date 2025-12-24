<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @property CI_DB_mysqli_driver $db
 * @property seat_model $seat_model
 * @property CI_Loader $load
 * @property CI_Input $input
 * @property CI_Session $session
 */
class ThanhToan_controller extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('seat_model');
    }

    public function xulyketqua()
	{
        // Kiểm tra các tham số bắt buộc từ MoMo trả về
        if (isset($_GET['partnerCode']) && isset($_GET['orderId']) && isset($_GET['requestId']) && isset($_GET['amount']) && isset($_GET['orderInfo']) && isset($_GET['orderType']) && isset($_GET['transId']) && isset($_GET['payType']) && isset($_GET['signature'])) {

            // Lưu log giao dịch MoMo (không liên quan tới booking)
            $data_momo = [
                'partnerCode' => $_GET['partnerCode'],
                // sửa 'orderIdf' -> 'orderId' cho đúng key MoMo trả về
                'orderId'    => $_GET['orderId'],
                'requestId'  => $_GET['requestId'],
                'amount'     => $_GET['amount'],
                'orderInfo'  => $_GET['orderInfo'],
                'orderType'  => $_GET['orderType'],
                'transId'    => $_GET['transId'],
                'payType'    => $_GET['payType'],
                'signature'  => $_GET['signature']
            ];

            $this->load->model('seat_model');
            $this->seat_model->addMomo($data_momo);

            // Lấy thông tin booking đã lưu trong session trước khi redirect sang MoMo
            $pending_booking = $this->session->userdata('pending_booking');

            // Nếu có thông tin booking trong session thì tạo booking và hiển thị vé
            if ($pending_booking) {
                $this->processPaymentSuccess(
                    'momo',
                    $pending_booking['id_user'],
                    $pending_booking['id_calendar'],
                    $pending_booking['choosen_sits'],
                    $pending_booking['choosen_cost'],
                    $pending_booking['tenphim'],
                    $pending_booking['ngay'],
                    $pending_booking['gio']
                );

                // Xóa session sau khi dùng xong
                $this->session->unset_userdata('pending_booking');
            } else {
                // Không tìm thấy dữ liệu booking -> không insert được, tránh lỗi id_user NULL
                echo "Không tìm thấy thông tin đặt vé trong session. Vui lòng đặt vé lại.";
            }
        } else {
            echo "Error, chưa thanh toán thành công";
            redirect('seat_controller/index_thanhtoan', 'refresh');
            return;
        }
	}

	public function process()
    {
        // Kiểm tra đăng nhập
        if (!$this->session->userdata('vipmember')) {
            redirect('Login_register/indexlogin','refresh');
            return;
        }

        // Lấy phương thức thanh toán
        $payment_method = $this->input->post('payment_method');
        
        // Validate
        if (empty($payment_method) || !in_array($payment_method, ['payUrl', 'vnpay'])) {
            redirect('seat_controller/index_thanhtoan', 'refresh');
            return;
        }

        // Route đến phương thức thanh toán tương ứng
        if ($payment_method === 'payUrl') {
            // echo 'momo';
            $this->momo();
        } else if ($payment_method === 'vnpay') {
            // echo 'vnpay';
            $this->vnpay();
        }
    }

    public function execPostRequest($url, $data)
    {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                'Content-Type: application/json',
                'Content-Length: ' . strlen($data))
        );
        curl_setopt($ch, CURLOPT_TIMEOUT, 5);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
        //execute post
        $result = curl_exec($ch);
        //close connection
        curl_close($ch);
        return $result;
    }

    /**
     * Xử lý thanh toán qua MoMo
     */
    private function momo()
    {
        // Lấy và validate dữ liệu
        $id_user = $this->input->post('id_user');
        $id_calendar = $this->input->post('id_calendar');
        $choosen_cost = $this->input->post('choosen-cost');
        $choosen_sits = $this->input->post('choosen-sits');
        $tenphim = $this->input->post('tenphim');
        $ngay = $this->input->post('ngay');
        $gio = $this->input->post('gio');

        if (empty($id_user) || empty($id_calendar) || empty($choosen_cost)) {
            redirect('seat_controller/index_thanhtoan', 'refresh');
            return;
        }

        // Tích hợp API MoMo
        $endpoint = "https://test-payment.momo.vn/v2/gateway/api/create";
        $partnerCode = 'MOMOBKUN20180529';
        $accessKey = 'klm05TvNBzhg7h7j';
        $secretKey = 'at67qH6mk8w5Y1nAyMoYKMWACiEi2bsa';
        $orderInfo = "Thanh toán vé xem phim - " . $tenphim;
        
        // Lấy số tiền từ choosen-cost (bỏ " 000 đ" và chuyển sang số)
        $amount = str_replace([' 000 đ', ' ', 'đ'], '', $choosen_cost);
        $amount = intval($amount) * 1000; // Chuyển sang VND (ví dụ: 100000)
        
        $orderId = time() . rand(1000, 9999); // Tạo orderId unique
		// nên dùng tạm cái này
        $redirectUrl = "http://localhost/Web_Cinema/index.php/ThanhToan_controller/xulyketqua";
        $ipnUrl = "http://localhost/Web_Cinema/index.php/ThanhToan_controller/xulyketqua";
        $extraData = ""; // Khởi tạo extraData

        $requestId = time() . "";
        $requestType = "payWithATM";
        
        // Tạo signature
        $rawHash = "accessKey=" . $accessKey . "&amount=" . $amount . "&extraData=" . $extraData . "&ipnUrl=" . $ipnUrl . "&orderId=" . $orderId . "&orderInfo=" . $orderInfo . "&partnerCode=" . $partnerCode . "&redirectUrl=" . $redirectUrl . "&requestId=" . $requestId . "&requestType=" . $requestType;
        $signature = hash_hmac("sha256", $rawHash, $secretKey);
        
        $data = array(
            'partnerCode' => $partnerCode,
            'partnerName' => "Test",
            "storeId" => "MomoTestStore",
            'requestId' => $requestId,
            'amount' => $amount,
            'orderId' => $orderId,
            'orderInfo' => $orderInfo,
            'redirectUrl' => $redirectUrl,
            'ipnUrl' => $ipnUrl,
            'lang' => 'vi',
            'extraData' => $extraData,
            'requestType' => $requestType,
            'signature' => $signature
        );
        
        $result = $this->execPostRequest($endpoint, json_encode($data));
        $jsonResult = json_decode($result, true);

        // Kiểm tra kết quả và redirect đến MoMo payment page
        if (isset($jsonResult['payUrl'])) {
            // Lưu thông tin booking vào session để dùng trong callback
            $this->session->set_userdata('pending_booking', array(
                'id_user' => $id_user,
                'id_calendar' => $id_calendar,
                'choosen_sits' => $choosen_sits,
                'choosen_cost' => $choosen_cost,
                'tenphim' => $tenphim,
                'ngay' => $ngay,
                'gio' => $gio,
                'orderId' => $orderId
            ));
            
            // Redirect đến MoMo payment page
            redirect($jsonResult['payUrl'], 'location', 302);
        } else {
            // Nếu có lỗi, redirect về trang thanh toán
            redirect('seat_controller/index_thanhtoan', 'refresh');
        }
    }

    /**
     * Xử lý thanh toán qua VNPay
     */
    private function vnpay()
    {
        // Lấy và validate dữ liệu
        $id_user = $this->input->post('id_user');
        $id_calendar = $this->input->post('id_calendar');
        $choosen_cost = $this->input->post('choosen-cost');
        $choosen_sits = $this->input->post('choosen-sits');
        $tenphim = $this->input->post('tenphim');
        $ngay = $this->input->post('ngay');
        $gio = $this->input->post('gio');

        if (empty($id_user) || empty($id_calendar) || empty($choosen_cost)) {
            redirect('seat_controller/index_thanhtoan', 'refresh');
            return;
        }
        $this->processPaymentSuccess('vnpay', $id_user, $id_calendar, $choosen_sits, $choosen_cost, $tenphim, $ngay, $gio);
    }

    /**
     * Xử lý sau khi thanh toán thành công
     */
    private function processPaymentSuccess($payment_method, $id_user, $id_calendar, $choosen_sits, $choosen_cost, $tenphim, $ngay, $gio)
    {
        // Lưu booking vào database
        $this->seat_model->addBooking($id_user, $id_calendar, $choosen_sits, $choosen_cost);
        
        // Lấy thông tin user
        $dulieuuser = $this->seat_model->gettenuser($id_user);
        
        // Chuẩn bị dữ liệu cho view ticket
        $dulieutucontroller = array(array(
            $id_calendar,
            $choosen_cost,
            $choosen_sits,
            $tenphim,
            $ngay,
            $gio
        ));
        
        $dulieuuser = array('dulieuusertucontroller' => $dulieuuser);
        $dulieu = array('dulieuvetucontroller' => $dulieutucontroller);
        
        // Load view ticket
        $this->load->view('Ticket_view', $dulieu + $dulieuuser);
    }

}

/* End of file ThanhToan_controller.php */
/* Location: ./application/controllers/ThanhToan_controller.php */
