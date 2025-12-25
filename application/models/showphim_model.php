<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Showphim_model extends CI_Model {

	public $variable;

	public function __construct()
	{
		parent::__construct();
		
	}
	public function getDatabasePhim()
	{
		$this->db->select('*'); 
		$this->db->order_by('id', 'desc');
		$ketquaphim = $this->db->get('movie');

		$ketquaphim = $ketquaphim->result_array();

		return $ketquaphim;
	}

	public function getDatabasePhimPaginated($limit, $offset)
	{
		$this->db->select('*'); 
		$this->db->order_by('id', 'desc');
		$this->db->limit($limit, $offset);
		$ketquaphim = $this->db->get('movie');
		return $ketquaphim->result_array();
	}

	public function countPhim()
	{
		return $this->db->count_all('movie');
	}
	public function getDatabasePhimDC()
	{
		$ketquaPhimDC = $this->db->get_where('movie', 'DATEDIFF(CURRENT_DATE, open_date) >0 and DATEDIFF(CURRENT_DATE, open_date) <30');
		$ketquaPhimDC->result_array();
		$ketquaPhimDC = $ketquaPhimDC->result_array();

		return $ketquaPhimDC;
	}

	public function getDatabasePhimSC()
	{
		$ketquaPhimSC = $this->db->get_where('movie', 'DATEDIFF(open_date, CURRENT_DATE) >2');
		$ketquaPhimSC->result_array();
		$ketquaPhimSC = $ketquaPhimSC->result_array();

		return $ketquaPhimSC;
	}

	public function getinfophim($idnhantucon)
	{
		$this->db->select('*');
		$this->db->where('id', $idnhantucon);


		$dulieu= $this->db->get('movie');
		

		return $dulieu=$dulieu->result_array();
	}

	public function getNgay()
	{
		
		return $this->db->select('CURDATE()');

	}
	public function deletePhimById($id)
	{
		$this->db->where('id', $id);
		return $this->db->delete('movie');
		
	}
	public function getDatabasePhimById($idsua)
	{
		$this->db->select('*');
		$this->db->where('id', $idsua);
		$dulieu= $this->db->get('movie');
		$dulieu=$dulieu->result_array();
		return $dulieu;		
	}

	public function updatePhimById($id,$t, $d, $di, $ac, $la, $co, $de, $op, $ca)
	{
		$dulieucanupdate = array(
			'title' => $t, 
			'duration'=> $d, 
			'director' => $di, 
			'actor'=>$ac, 
			'language'=>$la,
			'country'=>$co, 
			'description'=>$de, 
			'open_date'=>$op, 
			'category'=>$ca
		);
		$this->db->where('id', $id);
		return $this->db->update('movie', $dulieucanupdate);
	}

	public function upAnh($id, $po, $im1, $im2, $im3, $im4, $imt1, $imt2, $tr1, $tr2)
	{
		
		$anhcanup = array(
			'poster'=>$po,
			'image1'=>$im1,
			'image2'=>$im2,
			'image3'=>$im3,
			'image4'=>$im4,
			'imgtra1'=>$imt1,
			'imgtra2'=>$imt2,
			'trailer1'=>$tr1,
			'trailer2'=>$tr2
,
		);
		$this->db->where('id', $id);
		return $this->db->update('movie', $anhcanup);
	}
}

/* End of file showphim_model.php */
/* Location: ./application/models/showphim_model.php */
