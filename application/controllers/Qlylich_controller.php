<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @property CI_DB_mysqli_driver $db
 * @property lich_model $lich_model
 * @property Showphim_model $Showphim_model
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

	public function indexFull($idmotuview, $selected_day = null)
	{
		$this->load->model('lich_model');

		// Dữ liệu ngày chiếu
		$dulieu = $this->lich_model->getDatabaseNgay($idmotuview);
		$dulieu = array('dulieutucontroller' => $dulieu);

		// Dữ liệu tiêu đề phim
		$dulieuTit = $this->lich_model->getTitlePhim($idmotuview);
		$dulieuTit = array('dulieutucontrollerTit' => $dulieuTit);

		// Dữ liệu ngày được chọn (nếu có)
		$dayData = array();
		if ($selected_day) {
			$dayData = array('day' => $selected_day);
		} elseif (!empty($dulieu['dulieutucontroller'])) {
			// Mặc định chọn ngày đầu tiên nếu có
			$firstDay = $dulieu['dulieutucontroller'][0]['day'];
			$dayData = array('day' => $firstDay);
		}
		$dulieungay = array('daytucontroller' => array($dayData));

		// Dữ liệu giờ chiếu cho ngày được chọn
		$dulieu1 = array();
		$dulieu2 = array();
		if (!empty($dayData)) {
			$dulieu1 = $this->lich_model->getDatabaseGio1($idmotuview, $dayData['day']);
			$dulieu2 = $this->lich_model->getDatabaseGio2($idmotuview, $dayData['day']);
		}

		$dulieu1 = array('dulieutucontroller1' => $dulieu1);
		$dulieu2 = array('dulieutucontroller2' => $dulieu2);

		$this->load->view('qlylich_full_view', $dulieuTit + $dulieu + $dulieungay + $dulieu1 + $dulieu2, FALSE);
	}

	public function indexCalendar()
	{
		$this->load->model('lich_model');
		$this->load->model('Showphim_model');

		// Lấy tất cả lịch chiếu với thông tin phim
		$all_schedules = $this->lich_model->getAllSchedulesWithMovies();

		$data = array(
			'all_schedules' => $all_schedules
		);

		$this->load->view('qlylich_calendar_view', $data, FALSE);
	}

	public function ajax_get_schedule_details($date)
	{
		$this->load->model('lich_model');

		// Lấy tất cả lịch chiếu trong ngày này
		$schedules = $this->lich_model->getSchedulesByDate($date);

		// Thêm thông tin phim cho mỗi lịch chiếu
		foreach ($schedules as &$schedule) {
			$movie_info = $this->lich_model->getTitlePhim($schedule['id_movie']);
			if (!empty($movie_info)) {
				$schedule['movie_title'] = $movie_info[0]['title'];
				$schedule['movie_duration'] = $movie_info[0]['duration'];
				$schedule['movie_poster'] = $movie_info[0]['poster'];
			}

			// Tính thời gian kết thúc
			$duration_minutes = $this->parseDuration($schedule['movie_duration']);
			$start_time = strtotime($schedule['time']);
			$end_time = $start_time + ($duration_minutes * 60);
			$schedule['end_time'] = date('H:i', $end_time);
		}

		header('Content-Type: application/json');
		echo json_encode(array(
			'success' => true,
			'date' => $date,
			'schedules' => $schedules
		));
	}

	public function ajax_get_all_schedules()
	{
		$this->load->model('lich_model');

		$all_schedules = $this->lich_model->getAllSchedulesWithMovies();

		header('Content-Type: application/json');
		echo json_encode(array(
			'success' => true,
			'schedules' => $all_schedules
		));
	}

	public function ajax_get_movies()
	{
		try {
			log_message('debug', 'ajax_get_movies called');

			$this->load->model('Showphim_model');
			log_message('debug', 'Showphim_model loaded');

			$movies = $this->Showphim_model->getAllMovies();
			log_message('debug', 'getAllMovies returned: ' . count($movies) . ' movies');

			header('Content-Type: application/json');
			echo json_encode(array(
				'success' => true,
				'movies' => $movies
			));
		} catch (Exception $e) {
			log_message('error', 'ajax_get_movies error: ' . $e->getMessage());
			header('Content-Type: application/json');
			echo json_encode(array(
				'success' => false,
				'message' => 'Error loading movies: ' . $e->getMessage()
			));
		}
	}

	public function ajax_add_schedule()
	{
		$id_movie = $this->input->post('id_movie');
		$day = $this->input->post('day');
		$id_phong = $this->input->post('id_phong');
		$time = $this->input->post('time');

		// Validate input
		if (empty($id_movie) || empty($day) || empty($id_phong) || empty($time)) {
			header('Content-Type: application/json');
			echo json_encode(array(
				'success' => false,
				'message' => 'Vui lòng điền đầy đủ thông tin!'
			));
			return;
		}

		$this->load->model('lich_model');
		$this->load->model('Showphim_model');

		// Kiểm tra movie tồn tại
		$movie_info = $this->Showphim_model->getinfophim($id_movie);
		if (empty($movie_info)) {
			header('Content-Type: application/json');
			echo json_encode(array(
				'success' => false,
				'message' => 'Phim không tồn tại!'
			));
			return;
		}

		// Lấy duration để kiểm tra conflict
		$duration = 120; // Default
		if (!empty($movie_info) && isset($movie_info[0]['duration'])) {
			preg_match('/(\d+)/', $movie_info[0]['duration'], $matches);
			if (!empty($matches[1])) {
				$duration = intval($matches[1]);
			}
		}

		// Kiểm tra trùng giờ chính xác
		if ($this->lich_model->checkTrungGio($id_movie, $day, $id_phong, $time)) {
			header('Content-Type: application/json');
			echo json_encode(array(
				'success' => false,
				'message' => 'Giờ chiếu này đã tồn tại trong phòng này!'
			));
			return;
		}

		// Kiểm tra trùng thời gian chiếu (overlap)
		$conflict = $this->lich_model->checkTrungThoiGianChieu($id_movie, $day, $id_phong, $time, $duration);
		if ($conflict) {
			$conflict_movie_title = isset($conflict['movie_title']) ? $conflict['movie_title'] : 'phim khác';
			$conflict_time = isset($conflict['time']) ? $conflict['time'] : '';
			header('Content-Type: application/json');
			echo json_encode(array(
				'success' => false,
				'message' => 'Có phim khác đang chiếu trong khoảng thời gian này: Phim "' . $conflict_movie_title . '" lúc ' . $conflict_time . ' trong phòng này. Vui lòng chọn giờ khác.'
			));
			return;
		}

		// Thêm lịch chiếu mới
		$result = $this->lich_model->themGio($id_movie, $day, $id_phong, $time);

		if ($result) {
			header('Content-Type: application/json');
			echo json_encode(array(
				'success' => true,
				'message' => 'Thêm lịch chiếu thành công!',
				'id_calendar' => $this->db->insert_id()
			));
		} else {
			header('Content-Type: application/json');
			echo json_encode(array(
				'success' => false,
				'message' => 'Có lỗi xảy ra khi thêm lịch chiếu!'
			));
		}
	}

	private function parseDuration($duration_str)
	{
		if (empty($duration_str)) {
			return 120; // Default 120 minutes
		}

		// Parse duration từ string (ví dụ: "105 phút" -> 105)
		preg_match('/(\d+)/', $duration_str, $matches);
		if (!empty($matches[1])) {
			return intval($matches[1]);
		}

		return 120;
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

		// Validate input
		if (empty($day)) {
			header('Content-Type: application/json');
			echo json_encode(array('success' => false, 'message' => 'Ngày không được để trống'));
			return;
		}

		// Check if date already exists for this movie
		if ($this->lich_model->findDay($idmotuview, $day)->num_rows() > 0) {
			header('Content-Type: application/json');
			echo json_encode(array('success' => false, 'message' => 'Ngày này đã tồn tại cho phim này'));
			return;
		}

		$result = $this->lich_model->addNgay($idmotuview, $day);

		if ($result) {
			header('Content-Type: application/json');
			echo json_encode(array('success' => true, 'day' => $day));
		} else {
			header('Content-Type: application/json');
			echo json_encode(array('success' => false, 'message' => 'Có lỗi xảy ra khi thêm ngày'));
		}
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
		$this->load->model('Showphim_model');

		// Lấy thông tin phim để lấy duration
		$movie_info = $this->Showphim_model->getinfophim($id_movie);
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
				'message' => 'Có phim khác đang chiếu trong khoảng thời gian này: Phim "' . $conflict_movie_title . '" lúc ' . $conflict_time . ' trong phòng này. Vui lòng chọn giờ khác.'
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
		$result = $this->lich_model->xoaGio($idc);

		// Return JSON result for AJAX clients
		header('Content-Type: application/json');
		if ($result || $this->db->affected_rows() > 0) {
			echo json_encode(array(
				'success' => true,
				'message' => 'Xóa lịch chiếu thành công'
			));
		} else {
			echo json_encode(array(
				'success' => false,
				'message' => 'Không thể xóa lịch chiếu'
			));
		}
	}
	public function ajax_editgio($idc)
	{
		// Accept either 'gioedit' or 'time' for backward compatibility
		$gioedit = $this->input->get_post('gioedit');
		$time = $this->input->get_post('time');
		$day = $this->input->get_post('day');
		$id_phong = $this->input->get_post('id_phong');
		$id_movie = $this->input->get_post('id_movie');

		$this->load->model('lich_model');
		$this->load->model('Showphim_model');

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

		// Determine new values (fall back to existing if not provided)
		$new_time = $time ?: $gioedit ?: $calendar['time'];
		$new_day = $day ?: $calendar['day'];
		$new_phong = $id_phong ?: $calendar['id_phong'];
		$new_movie = $id_movie ?: $calendar['id_movie'];

		// If no actual change, return success
		if (isset($calendar['time']) && $calendar['time'] === $new_time
			&& isset($calendar['day']) && $calendar['day'] === $new_day
			&& isset($calendar['id_phong']) && $calendar['id_phong'] == $new_phong
			&& isset($calendar['id_movie']) && $calendar['id_movie'] == $new_movie) {
			header('Content-Type: application/json');
			echo json_encode(array(
				'success' => true,
				'message' => 'Không có thay đổi (giữ nguyên giá trị).'
			));
			return;
		}

		// Lấy thông tin phim để lấy duration (dùng new_movie)
		$movie_info = $this->Showphim_model->getinfophim($new_movie);
		$duration = 120; // Mặc định 120 phút nếu không tìm thấy
		if (!empty($movie_info) && isset($movie_info[0]['duration'])) {
			// Parse duration từ string (ví dụ: "105 phút" -> 105)
			preg_match('/(\d+)/', $movie_info[0]['duration'], $matches);
			if (!empty($matches[1])) {
				$duration = intval($matches[1]);
			}
		}

		// Kiểm tra trùng giờ chính xác khi sửa (trừ bản ghi hiện tại)
		if ($this->lich_model->checkTrungGioKhiSua($idc, $new_movie, $new_day, $new_phong, $new_time)) {
			header('Content-Type: application/json');
			echo json_encode(array(
				'success' => false,
				'message' => 'Giờ chiếu này đã tồn tại trong phòng này!'
			));
			return;
		}

		// Kiểm tra trùng thời gian chiếu (overlap) khi sửa
		$conflict = $this->lich_model->checkTrungThoiGianChieuKhiSua($idc, $new_movie, $new_day, $new_phong, $new_time, $duration);
		if ($conflict) {
			header('Content-Type: application/json');
			$conflict_movie_title = isset($conflict['movie_title']) ? $conflict['movie_title'] : 'phim khác';
			$conflict_time = isset($conflict['time']) ? $conflict['time'] : '';
			echo json_encode(array(
				'success' => false,
				'message' => 'Có phim khác đang chiếu trong khoảng thời gian này: Phim "' . $conflict_movie_title . '" lúc ' . $conflict_time . ' trong phòng này. Vui lòng chọn giờ khác.'
			));
			return;
		}

		// Nếu không trùng, cập nhật calendar (có thể thay đổi nhiều trường)
		$updateData = array(
			'time' => $new_time,
			'day' => $new_day,
			'id_phong' => $new_phong,
			'id_movie' => $new_movie
		);
		$this->db->where('id_calendar', $idc);
		$this->db->update('calendar', $updateData);

		if ($this->db->affected_rows() > 0) {
			header('Content-Type: application/json');
			echo json_encode(array(
				'success' => true,
				'message' => 'Cập nhật lịch chiếu thành công!'
			));
		} else {
			header('Content-Type: application/json');
			echo json_encode(array(
				'success' => false,
				'message' => 'Có lỗi xảy ra khi cập nhật lịch chiếu!'
			));
		}
	}

}

/* End of file Qlylich_controller.php */
/* Location: ./application/controllers/Qlylich_controller.php */