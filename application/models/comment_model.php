<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Comment_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * Lấy tất cả bình luận của một phim, kiểm tra xem user đã đặt vé chưa
	 * @param int $id_movie ID của phim
	 * @return array Danh sách bình luận với thông tin đã/chưa đặt vé
	 */
	public function getCommentsChuaXuLy($id_movie)
	{
		// Lấy tất cả bình luận
		$this->db->select('comment.*, user.fullname, user.email');
		$this->db->from('comment');
		$this->db->join('user', 'user.id = comment.id_user', 'left');
		$this->db->where('comment.id_movie', $id_movie);
		$this->db->order_by('comment.created_at', 'DESC');
		$query = $this->db->get();
		$results = $query->result_array();
		
		// Kiểm tra xem bình luận đã được sửa chưa (updated_at khác created_at)
		foreach ($results as &$result) {
			if (isset($result['updated_at']) && isset($result['created_at'])) {
				$result['da_sua'] = ($result['updated_at'] != $result['created_at']);
			} else {
				$result['da_sua'] = false;
			}
		}
		
		// Kiểm tra từng user đã đặt vé cho phim này chưa
		foreach ($results as &$result) {
			$checkBooking = $this->db->select('booking.id_ve')
				->from('booking')
				->join('calendar', 'calendar.id_calendar = booking.id_calendar')
				->where('booking.id_user', $result['id_user'])
				->where('calendar.id_movie', $id_movie)
				->get()
				->num_rows();
			$result['da_dat_ve'] = $checkBooking > 0 ? 1 : 0;
		}
		
		return $results;
	}

	/**
	 * Lấy tất cả bình luận của một phim (đã xử lý và chưa xử lý)
	 * @param int $id_movie ID của phim
	 * @return array Danh sách bình luận
	 */
	public function getAllComments($id_movie)
	{
		$this->db->select('comment.*, user.fullname, user.email');
		$this->db->from('comment');
		$this->db->join('user', 'user.id = comment.id_user', 'left');
		$this->db->where('comment.id_movie', $id_movie);
		$this->db->order_by('comment.created_at', 'DESC');
		$query = $this->db->get();
		return $query->result_array();
	}

	/**
	 * Thêm bình luận mới
	 * @param array $data Dữ liệu bình luận
	 * @return bool
	 */
	public function insertComment($data)
	{
		return $this->db->insert('comment', $data);
	}

	/**
	 * Cập nhật trạng thái bình luận (đã xử lý)
	 * @param int $id_comment ID bình luận
	 * @param int $status Trạng thái (1 = đã xử lý, 0 = chưa xử lý)
	 * @return bool
	 */
	public function updateCommentStatus($id_comment, $status)
	{
		$this->db->where('id_comment', $id_comment);
		return $this->db->update('comment', array('status' => $status));
	}

	/**
	 * Cập nhật nội dung bình luận
	 * @param int $id_comment ID bình luận
	 * @param string $content Nội dung mới
	 * @return bool
	 */
	public function updateComment($id_comment, $content)
	{
		$this->db->where('id_comment', $id_comment);
		return $this->db->update('comment', array('content' => $content));
	}

	/**
	 * Xóa bình luận
	 * @param int $id_comment ID bình luận
	 * @return bool
	 */
	public function deleteComment($id_comment)
	{
		$this->db->where('id_comment', $id_comment);
		return $this->db->delete('comment');
	}

	/**
	 * Lấy bình luận theo ID
	 * @param int $id_comment ID bình luận
	 * @return array|null
	 */
	public function getCommentById($id_comment)
	{
		$this->db->where('id_comment', $id_comment);
		$query = $this->db->get('comment');
		$result = $query->row_array();
		return $result ? $result : null;
	}
}

/* End of file comment_model.php */
/* Location: ./application/models/comment_model.php */


