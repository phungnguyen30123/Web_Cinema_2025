<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Rating_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * Lấy rating của một user cho một movie cụ thể
	 * @param int $id_user ID của user
	 * @param int $id_movie ID của movie
	 * @return array|null Thông tin rating hoặc null nếu chưa có
	 */
	public function getUserRating($id_user, $id_movie)
	{
		$this->db->where('id_user', $id_user);
		$this->db->where('id_movie', $id_movie);
		$query = $this->db->get('rating');
		return $query->row_array();
	}

	/**
	 * Kiểm tra xem user đã rating movie chưa
	 * @param int $id_user ID của user
	 * @param int $id_movie ID của movie
	 * @return bool True nếu đã rating, false nếu chưa
	 */
	public function hasUserRated($id_user, $id_movie)
	{
		$this->db->where('id_user', $id_user);
		$this->db->where('id_movie', $id_movie);
		$query = $this->db->get('rating');
		return $query->num_rows() > 0;
	}

	/**
	 * Thêm rating mới hoặc cập nhật rating hiện có
	 * @param int $id_user ID của user
	 * @param int $id_movie ID của movie
	 * @param float $rating Giá trị rating (0.0 - 5.0)
	 * @return bool True nếu thành công, false nếu thất bại
	 */
	public function setRating($id_user, $id_movie, $rating)
	{
		// Validate rating value
		$rating = floatval($rating);
		if ($rating < 0 || $rating > 5) {
			return false;
		}

		// Làm tròn đến 0.5 gần nhất
		$rating = round($rating * 2) / 2;

		$data = array(
			'id_user' => $id_user,
			'id_movie' => $id_movie,
			'rating' => $rating,
			'updated_at' => date('Y-m-d H:i:s')
		);

		// Kiểm tra xem đã có rating chưa
		$existing = $this->getUserRating($id_user, $id_movie);

		if ($existing) {
			// Cập nhật rating hiện có
			$this->db->where('id', $existing['id']);
			return $this->db->update('rating', $data);
		} else {
			// Thêm rating mới
			$data['created_at'] = date('Y-m-d H:i:s');
			return $this->db->insert('rating', $data);
		}
	}

	/**
	 * Lấy tất cả rating của một movie
	 * @param int $id_movie ID của movie
	 * @return array Danh sách rating với thông tin user
	 */
	public function getMovieRatings($id_movie)
	{
		$this->db->select('rating.*, user.fullname, user.email');
		$this->db->from('rating');
		$this->db->join('user', 'user.id = rating.id_user', 'left');
		$this->db->where('rating.id_movie', $id_movie);
		$this->db->order_by('rating.created_at', 'DESC');
		$query = $this->db->get();
		return $query->result_array();
	}

	/**
	 * Tính rating trung bình của một movie
	 * @param int $id_movie ID của movie
	 * @return float Rating trung bình (0.0 - 5.0)
	 */
	public function getAverageRating($id_movie)
	{
		$this->db->select_avg('rating', 'avg_rating');
		$this->db->where('id_movie', $id_movie);
		$query = $this->db->get('rating');

		$result = $query->row_array();
		return $result ? round($result['avg_rating'], 1) : 0.0;
	}

	/**
	 * Lấy số lượng rating của một movie
	 * @param int $id_movie ID của movie
	 * @return int Số lượng rating
	 */
	public function getRatingCount($id_movie)
	{
		$this->db->where('id_movie', $id_movie);
		return $this->db->count_all_results('rating');
	}

	/**
	 * Lấy thống kê rating của một movie (số lượng rating theo từng mức sao)
	 * @param int $id_movie ID của movie
	 * @return array Mảng thống kê [5=>count, 4.5=>count, 4=>count, ...]
	 */
	public function getRatingStats($id_movie)
	{
		$this->db->select('rating, COUNT(*) as count');
		$this->db->where('id_movie', $id_movie);
		$this->db->group_by('rating');
		$this->db->order_by('rating', 'DESC');
		$query = $this->db->get('rating');

		$stats = array();
		// Khởi tạo tất cả các mức rating từ 0.5 đến 5.0
		for ($i = 0.5; $i <= 5.0; $i += 0.5) {
			$stats[number_format($i, 1)] = 0;
		}

		foreach ($query->result_array() as $row) {
			$stats[number_format($row['rating'], 1)] = (int)$row['count'];
		}

		return $stats;
	}

	/**
	 * Xóa rating của user cho movie
	 * @param int $id_user ID của user
	 * @param int $id_movie ID của movie
	 * @return bool True nếu thành công, false nếu thất bại
	 */
	public function deleteRating($id_user, $id_movie)
	{
		$this->db->where('id_user', $id_user);
		$this->db->where('id_movie', $id_movie);
		return $this->db->delete('rating');
	}

	/**
	 * Lấy rating theo ID
	 * @param int $id ID của rating
	 * @return array|null Thông tin rating hoặc null nếu không tìm thấy
	 */
	public function getRatingById($id)
	{
		$this->db->where('id', $id);
		$query = $this->db->get('rating');
		return $query->row_array();
	}

	/**
	 * Lấy tất cả rating của một user
	 * @param int $id_user ID của user
	 * @return array Danh sách rating với thông tin movie
	 */
	public function getUserRatings($id_user)
	{
		$this->db->select('rating.*, movie.title, movie.poster');
		$this->db->from('rating');
		$this->db->join('movie', 'movie.id = rating.id_movie', 'left');
		$this->db->where('rating.id_user', $id_user);
		$this->db->order_by('rating.created_at', 'DESC');
		$query = $this->db->get();
		return $query->result_array();
	}

	/**
	 * Lấy danh sách movie được rating cao nhất
	 * @param int $limit Số lượng movie muốn lấy
	 * @return array Danh sách movie với rating trung bình
	 */
	public function getTopRatedMovies($limit = 10)
	{
		$this->db->select('movie.*, AVG(rating.rating) as avg_rating, COUNT(rating.id) as rating_count');
		$this->db->from('movie');
		$this->db->join('rating', 'rating.id_movie = movie.id', 'left');
		$this->db->group_by('movie.id');
		$this->db->having('rating_count > 0');
		$this->db->order_by('avg_rating', 'DESC');
		$this->db->order_by('rating_count', 'DESC');
		$this->db->limit($limit);
		$query = $this->db->get();
		return $query->result_array();
	}
}

/* End of file rating_model.php */
/* Location: ./application/models/rating_model.php */
