<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Cloudinary uploader (REST API) - không cần SDK.
 * Tương thích CodeIgniter 3 và PHP cũ (>=5.3) với cURL.
 */
class Cloudinary_uploader {
	/** @var CI_Controller */
	protected $ci;

	protected $cloudName;
	protected $apiKey;
	protected $apiSecret;
	protected $folderPrefix;

	public function __construct()
	{
		$this->ci =& get_instance();
		$this->ci->config->load('cloudinary', true);
		$cfg = $this->ci->config->item('cloudinary');

		$this->cloudName    = isset($cfg['cloudinary_cloud_name']) ? $cfg['cloudinary_cloud_name'] : '';
		$this->apiKey       = isset($cfg['cloudinary_api_key']) ? $cfg['cloudinary_api_key'] : '';
		$this->apiSecret    = isset($cfg['cloudinary_api_secret']) ? $cfg['cloudinary_api_secret'] : '';
		$this->folderPrefix = isset($cfg['cloudinary_folder_prefix']) ? $cfg['cloudinary_folder_prefix'] : 'web_cinema';
	}

	/**
	 * Upload 1 ảnh lên Cloudinary.
	 *
	 * @param string $tmpPath đường dẫn temp của file upload ($_FILES[..]['tmp_name'])
	 * @param string $folder folder trên Cloudinary (sẽ auto prefix)
	 * @return array { ok:bool, url:string|null, public_id:string|null, error:string|null }
	 */
	public function upload_image($tmpPath, $folder)
	{
		if (!$this->cloudName || !$this->apiKey || !$this->apiSecret) {
			return array('ok' => false, 'url' => null, 'public_id' => null, 'error' => 'Missing Cloudinary config (cloud_name/api_key/api_secret).');
		}
		if (!$tmpPath || !is_file($tmpPath)) {
			return array('ok' => false, 'url' => null, 'public_id' => null, 'error' => 'Invalid tmp file.');
		}

		$timestamp = time();
		$folder = trim($folder);
		$folderFull = trim($this->folderPrefix . '/' . $folder, '/');

		// Cloudinary signature: sha1("folder=...&timestamp=...".$api_secret)
		// (tham số cần sort theo key nếu có nhiều; ở đây chỉ có folder + timestamp)
		$toSign = 'folder=' . $folderFull . '&timestamp=' . $timestamp . $this->apiSecret;
		$signature = sha1($toSign);

		$endpoint = 'https://api.cloudinary.com/v1_1/' . rawurlencode($this->cloudName) . '/image/upload';

		$postFields = array(
			'api_key'   => $this->apiKey,
			'timestamp' => $timestamp,
			'folder'    => $folderFull,
			'signature' => $signature,
		);

		// PHP >=5.5: CURLFile, PHP 5.3/5.4: dùng @path
		if (class_exists('CURLFile')) {
			$postFields['file'] = new CURLFile($tmpPath);
		} else {
			$postFields['file'] = '@' . $tmpPath;
		}

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $endpoint);
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_TIMEOUT, 60);
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 15);

		// Nếu server thiếu CA bundle trên Windows/XAMPP, bạn có thể cần cấu hình CURLOPT_CAINFO.
		// curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);

		$raw = curl_exec($ch);
		$err = curl_error($ch);
		$http = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		curl_close($ch);

		if ($raw === false) {
			return array('ok' => false, 'url' => null, 'public_id' => null, 'error' => 'cURL error: ' . $err);
		}

		$data = json_decode($raw, true);
		if (!is_array($data)) {
			return array('ok' => false, 'url' => null, 'public_id' => null, 'error' => 'Invalid JSON from Cloudinary (HTTP ' . $http . '): ' . $raw);
		}

		if ($http < 200 || $http >= 300) {
			$msg = isset($data['error']['message']) ? $data['error']['message'] : ('HTTP ' . $http);
			return array('ok' => false, 'url' => null, 'public_id' => null, 'error' => $msg);
		}

		$url = isset($data['secure_url']) ? $data['secure_url'] : (isset($data['url']) ? $data['url'] : null);
		$publicId = isset($data['public_id']) ? $data['public_id'] : null;

		return array('ok' => true, 'url' => $url, 'public_id' => $publicId, 'error' => null);
	}
}


