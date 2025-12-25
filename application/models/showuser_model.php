<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class showuser_model extends CI_Model {

	public $variable;

	public function __construct()
	{
		parent::__construct();
		
	}
	public function getuser($i)
	{
		$this->db->select('*');//lấy hết dữ liệu
		$this->db->where('id', $i);
		$ketquauser = $this->db->get('user');//lấy dữ liệu từ bảng user

		

		$ketquauser = $ketquauser->result_array();

		return $ketquauser;
	}
	public function editByID($id)
	{
		$this->db->select('*');
		$this->db->where('id', $id);
		$dulieu = $this->db->get('user');
	//	var_dump($dulieu);
		$dulieu = $dulieu->result_array();
        return $dulieu;

	}
	public function updateDataById($id,$fullname,$birthday,$email,$sdt,$address)
	{
		$dulieucanupdate = array(
			'id' => $id,
			'fullname' => $fullname,
			'birthday' => $birthday,
			'email' => $email,
			'sdt' => $sdt,
			'address' => $address,
		);

		$this->db->where('id', $id);
		return $this->db->update('user', $dulieucanupdate);

	}

	public function getBookingHistory($id_user)
	{
		$this->db->select('booking.*, movie.title as movie_title, calendar.day, calendar.time, calendar.gia_ve');
		$this->db->from('booking');
		$this->db->join('calendar', 'booking.id_calendar = calendar.id_calendar');
		$this->db->join('movie', 'calendar.id_movie = movie.id');
		$this->db->where('booking.id_user', $id_user);
		$this->db->order_by('booking.id_ve', 'desc');
		$result = $this->db->get();
		return $result->result_array();
	}

}

/* End of file showuser_model.php */
/* Location: ./application/models/showuser_model.php */