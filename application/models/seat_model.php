<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class seat_model extends CI_Model {

	public $variable;

	public function __construct()
	{
		parent::__construct();
		
	}
	public function getDatabaseLich($idc)
	{
		$this->db->select('*');
		$this->db->from('calendar');
		$this->db->join('movie', 'calendar.id_movie = movie.id');
		$this->db->where('id_calendar', $idc);
		$dulieuLich = $this->db->get();
		return $dulieuLich=$dulieuLich->result_array();
	}
	public function gettenuser($id_user)
	{
		$this->db->select('*');
		$this->db->where('id', $id_user);
		return $this->db->get('user')->result_array();
	}
	public function addBooking($ids, $idc, $s, $tien)
	{
		$dulieuthemvaodb= array(
			'id_user' => $ids ,
			'id_calendar' => $idc,
			'seats'=>$s,
			'tong_tien'=> $tien,
			'status' => '0'
		);
		$this->db->insert('booking', $dulieuthemvaodb);

	}
	public function showBooking()
	{
		$this->db->select('*');
		$this->db->order_by('id_ve', 'desc');
		return $this->db->get('booking')->result_array();
	}

	public function showBookingPaginated($limit, $offset)
	{
		$this->db->select('*');
		$this->db->order_by('id_ve', 'desc');
		$this->db->limit($limit, $offset);
		return $this->db->get('booking')->result_array();
	}

	public function countBooking()
	{
		return $this->db->count_all('booking');
	}
	public function getSeat($idc)
	{
		$this->db->select('seats');
		$this->db->where('id_calendar', $idc);
		return $this->db->get('booking')->result_array();

	}
	public function addMomo($data_momo)
	{
		$this->db->insert('momo', $data_momo);
	}
	public function addVnpay($data_vnpay)
	{
		$this->db->insert('vnpay', $data_vnpay);
	}

}

/* End of file seat_model.php */
/* Location: ./application/models/seat_model.php */