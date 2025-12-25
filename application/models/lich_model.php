<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class lich_model extends CI_Model {

	public $variable;

	public function __construct()
	{
		parent::__construct();
		
	}

	public function getDatabaseNgay($idm)
	{
		$this->db->distinct('day');
		$this->db->select('id_movie,day');
		$this->db->where('id_movie', $idm);
		// Chỉ lấy những ngày từ hôm nay trở đi (không lấy ngày đã qua)
		$this->db->where('day >=', date('Y-m-d'));
		// Sắp xếp ngày sớm nhất trước
		$this->db->order_by('day', 'asc');
		
		$dulieuNgay= $this->db->get('calendar');
		return $dulieuNgay=$dulieuNgay->result_array();
	}
	
	public function getDatabaseGio($idm, $d)
	{
		$this->db->distinct('day');
		$this->db->select('day');
		$this->db->where('id_movie', $idm);
		$this->db->where('day', $d);
		$dulieuGio = $this->db->get('calendar');
		return $dulieuGio = $dulieuGio->result_array();

	}
	public function getDatabaseLichchieu($idm, $d)
	{
		$this->db->select('*');
		$this->db->where('id_movie', $idm);
		$this->db->where('day', $d);
		// Sắp xếp giờ chiếu sớm nhất trước
		$this->db->order_by('time', 'asc');
		$dulieugio = $this->db->get('calendar');
		return $dulieugio= $dulieugio->result_array();

	}

	public function getDatabaseGio1($idm, $d)
	{
		$this->db->select('*');
		$this->db->where('id_movie', $idm);
		$this->db->where('day', $d);
		$this->db->where('id_phong', '1');
		$dulieuGio1 = $this->db->get('calendar');
		return $dulieuGio1 = $dulieuGio1->result_array();

	}
	public function getDatabaseGio2($idm, $d)
	{
		$this->db->select('*');
		$this->db->where('id_movie', $idm);
		$this->db->where('day', $d);
		$this->db->where('id_phong', '2');
		$dulieuGio2 = $this->db->get('calendar');
		return $dulieuGio2 = $dulieuGio2->result_array();

	}

	public function getTitlePhim($idm)
	{
		$this->db->select('*');
		$this->db->where('id', $idm);
		$dulieuTit= $this->db->get('movie');
		return $dulieuTit=$dulieuTit->result_array();
	}

	public function addNgay($idm, $d)
	{
		$dulieuthemvaodb = array('id_movie' => $idm , 'day' => $d);
		return $this->db->insert('calendar', $dulieuthemvaodb);
	}

	public function xoaNgay($idm, $d)
	{
		$this->db->where('id_movie', $idm);
		$this->db->where('day', $d);
		return $this->db->delete('calendar');
	}

	public function updateNgay($idm, $d, $de)
	{
		$dulieucanupdate = array('day' =>$de);
		$this->db->where('id_movie', $idm);
		$this->db->where('day', $d);
		return $this->db->update('calendar', $dulieucanupdate);
	}
	public function themGio($idm, $d, $p, $g)
	{
		$dulieuthemvaodb = array(
			'id_movie' => $idm ,
			'day' => $d,
			'id_phong'=> $p,
			'time'=> $g
		);
		return $this->db->insert('calendar', $dulieuthemvaodb);
	}
	
	/**
	 * Kiểm tra xem giờ chiếu đã tồn tại trong cùng phòng và cùng ngày chưa (cho tất cả các phim)
	 * @param int $idm ID phim
	 * @param string $d Ngày (format: Y-m-d)
	 * @param int $p ID phòng
	 * @param string $g Giờ chiếu (format: H:i)
	 * @return bool true nếu đã tồn tại, false nếu chưa tồn tại
	 */
	public function checkTrungGio($idm, $d, $p, $g)
	{
		// Kiểm tra trùng giờ chính xác (tất cả các phim trong cùng phòng, cùng ngày, cùng giờ)
		$this->db->select('*');
		$this->db->where('day', $d);
		$this->db->where('id_phong', $p);
		$this->db->where('time', $g);
		$query = $this->db->get('calendar');
		return $query->num_rows() > 0;
	}
	
	/**
	 * Kiểm tra xem có trùng thời gian chiếu (overlap) với các suất chiếu khác trong cùng phòng không
	 * @param int $idm ID phim
	 * @param string $d Ngày (format: Y-m-d)
	 * @param int $p ID phòng
	 * @param string $g Giờ chiếu (format: H:i)
	 * @param int $duration Thời lượng phim (phút)
	 * @return array|null Trả về thông tin suất chiếu bị trùng hoặc null nếu không trùng
	 */
	public function checkTrungThoiGianChieu($idm, $d, $p, $g, $duration)
	{
		// Lấy tất cả các suất chiếu trong cùng phòng và cùng ngày
		$this->db->select('calendar.*, movie.duration as movie_duration, movie.title as movie_title');
		$this->db->from('calendar');
		$this->db->join('movie', 'calendar.id_movie = movie.id', 'left');
		$this->db->where('calendar.day', $d);
		$this->db->where('calendar.id_phong', $p);
		$query = $this->db->get();
		$schedules = $query->result_array();
		
		if (empty($schedules)) {
			return null;
		}
		
		// Chuyển đổi giờ chiếu mới thành phút
		$new_time_parts = explode(':', $g);
		$new_start_minutes = intval($new_time_parts[0]) * 60 + intval($new_time_parts[1]);
		$new_end_minutes = $new_start_minutes + $duration;
		
		// Kiểm tra từng suất chiếu có trùng không
		foreach ($schedules as $schedule) {
			// Parse duration từ string (ví dụ: "105 phút" -> 105)
			$movie_duration = $this->parseDuration($schedule['movie_duration']);
			if ($movie_duration <= 0) {
				continue; // Bỏ qua nếu không parse được duration
			}
			
			// Chuyển đổi giờ chiếu hiện tại thành phút
			$existing_time_parts = explode(':', $schedule['time']);
			$existing_start_minutes = intval($existing_time_parts[0]) * 60 + intval($existing_time_parts[1]);
			$existing_end_minutes = $existing_start_minutes + $movie_duration;
			
			// Kiểm tra overlap: (start1 < end2) && (start2 < end1)
			if (($new_start_minutes < $existing_end_minutes) && ($existing_start_minutes < $new_end_minutes)) {
				return $schedule; // Trùng thời gian
			}
		}
		
		return null; // Không trùng
	}
	
	/**
	 * Parse duration từ string (ví dụ: "105 phút" -> 105)
	 * @param string $duration_str Chuỗi duration (ví dụ: "105 phút", "120 phút")
	 * @return int Thời lượng tính bằng phút
	 */
	protected function parseDuration($duration_str)
	{
		if (empty($duration_str)) {
			return 0;
		}
		
		// Tìm số trong chuỗi
		preg_match('/(\d+)/', $duration_str, $matches);
		if (!empty($matches[1])) {
			return intval($matches[1]);
		}
		
		return 0;
	}

	public function xoaGio($idc)
	{
		$this->db->where('id_calendar', $idc);
		$this->db->delete('calendar');

	}
	public function updateGio($idc, $g)
	{
		$this->db->where('id_calendar', $idc);
		$dulieucanupdate = array('time' => $g);
		$this->db->update('calendar', $dulieucanupdate);
	}
	
	/**
	 * Kiểm tra xem giờ chiếu đã tồn tại trong cùng phòng và cùng ngày chưa (trừ bản ghi hiện tại) - cho tất cả các phim
	 * @param int $idc ID calendar hiện tại (để loại trừ khi kiểm tra)
	 * @param int $idm ID phim
	 * @param string $d Ngày (format: Y-m-d)
	 * @param int $p ID phòng
	 * @param string $g Giờ chiếu (format: H:i)
	 * @return bool true nếu đã tồn tại, false nếu chưa tồn tại
	 */
	public function checkTrungGioKhiSua($idc, $idm, $d, $p, $g)
	{
		// Kiểm tra trùng giờ chính xác (tất cả các phim trong cùng phòng, cùng ngày, cùng giờ, trừ bản ghi hiện tại)
		$this->db->select('*');
		$this->db->where('day', $d);
		$this->db->where('id_phong', $p);
		$this->db->where('time', $g);
		$this->db->where('id_calendar !=', $idc); // Loại trừ bản ghi hiện tại
		$query = $this->db->get('calendar');
		return $query->num_rows() > 0;
	}
	
	/**
	 * Kiểm tra xem có trùng thời gian chiếu (overlap) khi sửa với các suất chiếu khác trong cùng phòng không
	 * @param int $idc ID calendar hiện tại (để loại trừ khi kiểm tra)
	 * @param int $idm ID phim
	 * @param string $d Ngày (format: Y-m-d)
	 * @param int $p ID phòng
	 * @param string $g Giờ chiếu mới (format: H:i)
	 * @param int $duration Thời lượng phim (phút)
	 * @return array|null Trả về thông tin suất chiếu bị trùng hoặc null nếu không trùng
	 */
	public function checkTrungThoiGianChieuKhiSua($idc, $idm, $d, $p, $g, $duration)
	{
		// Lấy tất cả các suất chiếu trong cùng phòng và cùng ngày (trừ bản ghi hiện tại)
		$this->db->select('calendar.*, movie.duration as movie_duration, movie.title as movie_title');
		$this->db->from('calendar');
		$this->db->join('movie', 'calendar.id_movie = movie.id', 'left');
		$this->db->where('calendar.day', $d);
		$this->db->where('calendar.id_phong', $p);
		$this->db->where('calendar.id_calendar !=', $idc); // Loại trừ bản ghi hiện tại
		$query = $this->db->get();
		$schedules = $query->result_array();
		
		if (empty($schedules)) {
			return null;
		}
		
		// Chuyển đổi giờ chiếu mới thành phút
		$new_time_parts = explode(':', $g);
		$new_start_minutes = intval($new_time_parts[0]) * 60 + intval($new_time_parts[1]);
		$new_end_minutes = $new_start_minutes + $duration;
		
		// Kiểm tra từng suất chiếu có trùng không
		foreach ($schedules as $schedule) {
			// Parse duration từ string (ví dụ: "105 phút" -> 105)
			$movie_duration = $this->parseDuration($schedule['movie_duration']);
			if ($movie_duration <= 0) {
				continue; // Bỏ qua nếu không parse được duration
			}
			
			// Chuyển đổi giờ chiếu hiện tại thành phút
			$existing_time_parts = explode(':', $schedule['time']);
			$existing_start_minutes = intval($existing_time_parts[0]) * 60 + intval($existing_time_parts[1]);
			$existing_end_minutes = $existing_start_minutes + $movie_duration;
			
			// Kiểm tra overlap: (start1 < end2) && (start2 < end1)
			if (($new_start_minutes < $existing_end_minutes) && ($existing_start_minutes < $new_end_minutes)) {
				return $schedule; // Trùng thời gian
			}
		}
		
		return null; // Không trùng
	}
	
	/**
	 * Lấy thông tin calendar theo ID
	 * @param int $idc ID calendar
	 * @return array|null Thông tin calendar hoặc null nếu không tìm thấy
	 */
	public function getCalendarById($idc)
	{
		$this->db->select('*');
		$this->db->where('id_calendar', $idc);
		$query = $this->db->get('calendar');
		if ($query->num_rows() > 0) {
			return $query->row_array();
		}
		return null;
	}

	public function findDay($idm, $d)
	{
		$this->db->select('*');
		$this->db->where('id_movie', $idm);
		$this->db->where('day', $d);
		return $this->db->get('calendar');
		
	}

}

/* End of file calendar_model.php */
/* Location: ./application/models/calendar_model.php */