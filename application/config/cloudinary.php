<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------
| Cloudinary configuration
| -------------------------------------------------------------------
| Khuyến nghị: set bằng biến môi trường để tránh commit key lên git:
| - CLOUDINARY_CLOUD_NAME
| - CLOUDINARY_API_KEY
| - CLOUDINARY_API_SECRET
|
| Nếu chưa set ENV thì fallback sang các giá trị dưới (điền tay).
*/

// Ưu tiên ENV, nếu chưa có thì dùng giá trị điền tay bên dưới.
$config['cloudinary_cloud_name'] = getenv('CLOUDINARY_CLOUD_NAME') ? getenv('CLOUDINARY_CLOUD_NAME') : 'dv4syzarc';
$config['cloudinary_api_key']    = getenv('CLOUDINARY_API_KEY') ? getenv('CLOUDINARY_API_KEY') : '454239595519221';
$config['cloudinary_api_secret'] = getenv('CLOUDINARY_API_SECRET') ? getenv('CLOUDINARY_API_SECRET') : 'dn9Tz8HvFGeKRSuR93PwHsXU5qg';

// Folder mặc định trên Cloudinary để gom ảnh theo app
$config['cloudinary_folder_prefix'] = 'web_cinema';
