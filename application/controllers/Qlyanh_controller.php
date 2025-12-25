<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @property CI_DB_mysqli_driver $db
 * @property showPhim_model $showPhim_model
 * @property Cloudinary_uploader $cloudinary_uploader
 * @property CI_Loader $load
 * @property CI_Input $input
 */
// Kế thừa từ MY_Controller để tự động bảo vệ đăng nhập
class Qlyanh_controller extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		// Cho phép cả Staff và Admin vào khu vực quản lý ảnh phim
		$this->restrict_to(['staff', 'admin']);
	}

	public function index($idnhantuview)
	{

		$this->load->model('showPhim_model');
		$ketqua = $this->showPhim_model->getDatabasePhimById($idnhantuview);
		$ketqua = array('dulieutucontroller' =>$ketqua);
		$this->load->view('qlyanh_view',$ketqua, FALSE);
	}
	public function upAnh()
	{
		$id = $this->input->get_post('id');
		// Upload lên Cloudinary (REST API) - giữ nguyên view, DB lưu URL cloud.
		$this->load->library('Cloudinary_uploader');

		$folder = 'movies/' . $id;

		$uploadField = function($field, $oldValueKey) use ($folder) {
			if (!isset($_FILES[$field]) || empty($_FILES[$field]['name'])) {
				return $this->input->post($oldValueKey);
			}

			$tmp = $_FILES[$field]['tmp_name'];
			$result = $this->cloudinary_uploader->upload_image($tmp, $folder);

			if (isset($result['ok']) && $result['ok'] && !empty($result['url'])) {
				return $result['url'];
			}

			// Upload lỗi -> giữ ảnh cũ để tránh mất dữ liệu
			return $this->input->post($oldValueKey);
		};

		$poster = $uploadField('poster', 'postercu');
		$image1 = $uploadField('image1', 'image1cu');
		$image2 = $uploadField('image2', 'image2cu');
		$image3 = $uploadField('image3', 'image3cu');
		$image4 = $uploadField('image4', 'image4cu');
		$imgtra1 = $uploadField('imgtra1', 'imgtra1cu');
		$imgtra2 = $uploadField('imgtra2', 'imgtra2cu');

		$trailer1 = $this->input->post('trailer1');
		$trailer2 = $this->input->post('trailer2');





		$this->load->model('showPhim_model');
		if ($this->showPhim_model->upAnh($id,$poster, $image1, $image2, $image3, $image4, $imgtra1, $imgtra2, $trailer1, $trailer2)) {
			$this->index($id);
		} else {
			echo"Không thành công";
		}
		

		

		
	}



}

/* End of file Qlyanh_controller.php */
/* Location: ./application/controllers/Qlyanh_controller.php */