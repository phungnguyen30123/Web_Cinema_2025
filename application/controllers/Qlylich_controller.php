<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @property CI_DB_mysqli_driver $db
 * @property lich_model $lich_model
 * @property CI_Loader $load
 * @property CI_Input $input
 */
// Kế thừa từ MY_Controller để tự động bảo vệ đăng nhập
class Qlylich_controller extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		// Cho phép cả Staff và Admin vào khu vực quản lý lịch chiếu
		$this->restrict_to(['staff', 'admin']);
	}

	public function indexNgay($idmotuview)
	{
		$this->load->model('lich_model');		
		$dulieu = $this->lich_model->getDatabaseNgay($idmotuview);
		
		$dulieu = array('dulieutucontroller' => $dulieu);
		$dulieuTit = $this->lich_model->getTitlePhim($idmotuview);
		$dulieuTit = array('dulieutucontrollerTit' => $dulieuTit);
		//var_dump($dulieu);
		//var_dump($dulieuTit);
		$this->load->view('qlylich_view',$dulieuTit+$dulieu, FALSE);

		
	}

	public function indexGio($idmotuview, $daychuadoi)
	{
		//echo "$idmotuview, $daychuadoi";
		$this->load->model('lich_model');
		$dulieu1 = $this->lich_model->getDatabaseGio1($idmotuview, $daychuadoi);
		$dulieu1 = array('dulieutucontroller1' => $dulieu1);
		$dulieu2 = $this->lich_model->getDatabaseGio2($idmotuview, $daychuadoi);
		$dulieu2 = array('dulieutucontroller2' => $dulieu2);
		$dulieuTit = $this->lich_model->getTitlePhim($idmotuview);
		$dulieuTit = array('dulieutucontrollerTit' => $dulieuTit);
		$day = $this->lich_model->getDatabaseGio($idmotuview, $daychuadoi);
		$day = array('daytucontroller' => $day);

		//var_dump($dulieu);
		//var_dump($dulieuTit);
		$this->load->view('qlygio_view',$dulieuTit+$dulieu1+$dulieu2+$day, FALSE);
	}

	public function ajax_themngay($idmotuview)
	{
		$day = $this->input->post('day');
		$this->load->model('lich_model');
		
		$this->lich_model->addNgay($idmotuview, $day);

		echo json_encode($day);
	

		//echo $idmotuview, $ngay;
		//$day = $this->input->post('ngay');
		//$this->load->model('lich_model');
		
	}

	public function ajax_xoangay($daychuadoi)
	{
		$id_movie = $this->input->post('id_movie');
		//echo $daychuaedit, $idmotuview;
		$this->load->model('lich_model');
		$this->lich_model->xoaNgay($id_movie, $daychuadoi);
	}

	public function ajax_editngay($idmotuview)
	{
		$daychuaedit = $this->input->post('daychuaedit');
		$dayedit = $this->input->post('dayedit');
		$this->load->model('lich_model');
		$this->lich_model->updateNgay($idmotuview, $daychuaedit, $dayedit);
	}

	public function ajax_themgio($phong, $gio)
	{
		$id_movie = $this->input->get_post('id_movie');
		$day = $this->input->get_post('day');

		//var_dump($phong);
		//var_dump($gio);
		//var_dump($id_movie);
		//var_dump($day);

		$this->load->model('lich_model');
		$this->load->model('showPhim_model');
		
		// Lấy thông tin phim để lấy duration
		$movie_info = $this->showPhim_model->getinfophim($id_movie);
		$duration = 120; // Mặc định 120 phút nếu không tìm thấy
		if (!empty($movie_info) && isset($movie_info[0]['duration'])) {
			// Parse duration từ string (ví dụ: "105 phút" -> 105)
			preg_match('/(\d+)/', $movie_info[0]['duration'], $matches);
			if (!empty($matches[1])) {
				$duration = intval($matches[1]);
			}
		}
		
		// Kiểm tra trùng giờ chính xác (tất cả các phim trong cùng phòng, cùng ngày, cùng giờ)
		if ($this->lich_model->checkTrungGio($id_movie, $day, $phong, $gio)) {
			// Trả về lỗi nếu trùng giờ
			header('Content-Type: application/json');
			echo json_encode(array(
				'success' => false,
				'message' => 'Giờ chiếu này đã tồn tại trong phòng này!'
			));
			return;
		}
		
		// Kiểm tra trùng thời gian chiếu (overlap) - kiểm tra xem có phim nào khác đang chiếu trong khoảng thời gian này không
		$conflict = $this->lich_model->checkTrungThoiGianChieu($id_movie, $day, $phong, $gio, $duration);
		if ($conflict) {
			header('Content-Type: application/json');
			$conflict_movie_title = isset($conflict['movie_title']) ? $conflict['movie_title'] : 'phim khác';
			$conflict_time = isset($conflict['time']) ? $conflict['time'] : '';
			echo json_encode(array(
				'success' => false,
				'message' => 'Thời gian chiếu bị trùng với suất chiếu khác! Phim "' . $conflict_movie_title . '" đang chiếu lúc ' . $conflict_time . ' trong phòng này.'
			));
			return;
		}
		
		// Nếu không trùng, thêm giờ chiếu mới
		$result = $this->lich_model->themGio($id_movie, $day, $phong, $gio);
		if ($result) {
			header('Content-Type: application/json');
			echo json_encode(array(
				'success' => true,
				'id_calendar' => $this->db->insert_id()
			));
		} else {
			header('Content-Type: application/json');
			echo json_encode(array(
				'success' => false,
				'message' => 'Có lỗi xảy ra khi thêm giờ chiếu!'
			));
		}
	}
	public function ajax_xoagio($idc)
	{
		$this->load->model('lich_model');
		$this->lich_model->xoaGio($idc);

	}
	public function ajax_editgio($idc)
	{
		$gioedit = $this->input->get_post('gioedit');
		$this->load->model('lich_model');
		$this->load->model('showPhim_model');
		
		// Lấy thông tin calendar hiện tại
		$calendar = $this->lich_model->getCalendarById($idc);
		if (!$calendar) {
			header('Content-Type: application/json');
			echo json_encode(array(
				'success' => false,
				'message' => 'Không tìm thấy lịch chiếu!'
			));
			return;
		}
		
		// Lấy thông tin phim để lấy duration
		$movie_info = $this->showPhim_model->getinfophim($calendar['id_movie']);
		$duration = 120; // Mặc định 120 phút nếu không tìm thấy
		if (!empty($movie_info) && isset($movie_info[0]['duration'])) {
			// Parse duration từ string (ví dụ: "105 phút" -> 105)
			preg_match('/(\d+)/', $movie_info[0]['duration'], $matches);
			if (!empty($matches[1])) {
				$duration = intval($matches[1]);
			}
		}
		
		// Kiểm tra trùng giờ chính xác khi sửa (tất cả các phim trong cùng phòng, cùng ngày, cùng giờ, trừ bản ghi hiện tại)
		if ($this->lich_model->checkTrungGioKhiSua($idc, $calendar['id_movie'], $calendar['day'], $calendar['id_phong'], $gioedit)) {
			header('Content-Type: application/json');
			echo json_encode(array(
				'success' => false,
				'message' => 'Giờ chiếu này đã tồn tại trong phòng này!'
			));
			return;
		}
		
		// Kiểm tra trùng thời gian chiếu (overlap) khi sửa
		$conflict = $this->lich_model->checkTrungThoiGianChieuKhiSua($idc, $calendar['id_movie'], $calendar['day'], $calendar['id_phong'], $gioedit, $duration);
		if ($conflict) {
			header('Content-Type: application/json');
			$conflict_movie_title = isset($conflict['movie_title']) ? $conflict['movie_title'] : 'phim khác';
			$conflict_time = isset($conflict['time']) ? $conflict['time'] : '';
			echo json_encode(array(
				'success' => false,
				'message' => 'Thời gian chiếu bị trùng với suất chiếu khác! Phim "' . $conflict_movie_title . '" đang chiếu lúc ' . $conflict_time . ' trong phòng này.'
			));
			return;
		}
		
		// Nếu không trùng, cập nhật giờ chiếu
		$result = $this->lich_model->updateGio($idc, $gioedit);
		if ($result) {
			header('Content-Type: application/json');
			echo json_encode(array(
				'success' => true,
				'message' => 'Cập nhật giờ chiếu thành công!'
			));
		} else {
			header('Content-Type: application/json');
			echo json_encode(array(
				'success' => false,
				'message' => 'Có lỗi xảy ra khi cập nhật giờ chiếu!'
			));
		}
	}

}

/* End of file Qlylich_controller.php */
/* Location: ./application/controllers/Qlylich_controller.php */