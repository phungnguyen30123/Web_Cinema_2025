<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class showadmin_model extends CI_Model {

	public $variable;

	public function __construct()
	{
		parent::__construct();
		
	}
	public function getadmin()
	{
		$this->db->select('*');//lấy hết dữ liệu
		$ketqua = $this->db->get('user');//lấy dữ liệu từ bảng user
		$ketqua = $ketqua->result_array();

        return $ketqua;
	}

	public function deleteuserById($id)
	{
		$this->db->where('id', $id);
		if($this->db->delete('user'));
		{
        echo "xóa thành công";
		}
			}
	public function getNV()
	{
		$this->db->select('*');
		$this->db->where('is_admin', '2');
		return $this->db->get('user') -> result_array();
			}

	public function addnv($e, $mk, $na, $bd, $sdt, $d)
	{
		$dulieucanadd = array(
			'email' => $e,
			'password'=> $mk,
			'fullname'=>$na,
			'birthday'=> $bd,
			'sdt'=> $sdt,
			'address'=> $d,
			'is_admin'=> "2" 
		);
		$this->db->insert('user', $dulieucanadd);
		$this->getNV();
	}


}

/* End of file showuser_model.php */
/* Location: ./application/models/showuser_model.php */