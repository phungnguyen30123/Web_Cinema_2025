<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Sửa thông tin</title>

	<!-- Mobile Specific Metas-->
    	<meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="telephone=no" name="format-detection">
    
    <!-- Fonts -->
        <!-- Font awesome - icon font -->
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
        <!-- Roboto -->
        <link href='http://fonts.googleapis.com/css?family=Roboto:400,700' rel='stylesheet' type='text/css'>
    
    <!-- Stylesheets -->

        <!-- Mobile menu -->
        <link href="<?php echo base_url(); ?>css/gozha-nav.css" rel="stylesheet" />
        <!-- Select -->
        <link href="<?php echo base_url(); ?>css/external/jquery.selectbox.css" rel="stylesheet" />
    
        <!-- Custom -->
        <link href="<?php echo base_url(); ?>css/style.css?v=1" rel="stylesheet" />

        <!-- Modernizr --> 
        <script src="<?php echo base_url(); ?>js/external/modernizr.custom.js"></script>

    <style>
        * {
            box-sizing: border-box;
        }

        /* Sử dụng màu sắc và font từ theme chung */
        :root {
            --color-main: #4c4145;
            --color-red: #fe505a;
            --color-yellow: #ffd564;
            --color-grey: #969b9f;
            --color-grey-light: #dbdee1;
            --color-grey-lighter: #f5f5f5;
            --color-null: #fff;
        }

        .edit-container {
            max-width: 900px;
            margin: 40px auto;
            padding: 0 20px;
        }

        .edit-header {
            text-align: center;
            margin-bottom: 40px;
        }

        .edit-header h1 {
            font-family: 'aleobold', sans-serif;
            color: var(--color-main);
            font-size: 22px;
            text-transform: uppercase;
            margin-bottom: 10px;
            line-height: 20px;
        }

        .edit-header p {
            font-family: 'Roboto', sans-serif;
            color: var(--color-grey);
            font-size: 13px;
            margin-top: 10px;
        }

        .edit-card {
            background: var(--color-null);
            border-radius: 3px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            margin-bottom: 30px;
            border: 1px solid var(--color-grey-light);
        }

        .edit-card-header {
            background-color: var(--color-grey-lighter);
            padding: 30px;
            text-align: center;
            border-bottom: 1px solid var(--color-grey-light);
        }

        .edit-card-header .edit-icon {
            width: 80px;
            height: 80px;
            background-color: var(--color-yellow);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
            font-size: 36px;
            color: var(--color-main);
            border: 3px solid var(--color-null);
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .edit-card-header h2 {
            margin: 0;
            font-family: 'aleobold', sans-serif;
            font-size: 22px;
            color: var(--color-main);
            text-transform: uppercase;
        }

        .edit-card-body {
            padding: 40px;
        }

        .form-row {
            display: flex;
            align-items: flex-start;
            margin-bottom: 25px;
            gap: 20px;
        }

        .form-icon {
            width: 45px;
            height: 45px;
            background-color: var(--color-yellow);
            border-radius: 3px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--color-main);
            font-size: 18px;
            flex-shrink: 0;
            margin-top: 5px;
        }

        .form-group {
            flex: 1;
        }

        .form-label {
            font-family: 'Roboto', sans-serif;
            font-size: 12px;
            color: var(--color-grey);
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 8px;
            font-weight: 500;
            display: block;
        }

        .form-input {
            font-family: 'Roboto', sans-serif;
            font-size: 13px;
            color: var(--color-main);
            width: 100%;
            padding: 9px 20px 8px;
            border: 1px solid var(--color-grey-light);
            border-radius: 3px;
            background-color: var(--color-null);
            transition: border-color 0.3s ease, box-shadow 0.3s ease;
            outline: none;
        }

        .form-input:focus {
            border-color: var(--color-yellow);
            box-shadow: 0 0 0 2px rgba(255, 213, 100, 0.2);
        }

        .form-input::placeholder {
            color: #b4b1b2;
        }

        .form-actions {
            padding: 30px 40px;
            background: var(--color-grey-lighter);
            display: flex;
            justify-content: center;
            gap: 15px;
            border-top: 1px solid var(--color-grey-light);
        }

        .form-actions .btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .form-actions .btn i {
            font-size: 16px;
        }

        .btn-cancel {
            font-family: 'Roboto', sans-serif;
            background-color: var(--color-grey-light);
            color: var(--color-main);
            padding: 11px 30px;
            border: solid 1px var(--color-grey);
            border-radius: 3px;
            font-size: 14px;
            font-weight: 600;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: all 0.3s ease;
            cursor: pointer;
            text-transform: uppercase;
        }

        .btn-cancel:hover {
            background-color: var(--color-grey);
            color: var(--color-null);
            text-decoration: none;
        }

        @media (max-width: 768px) {
            .edit-container {
                margin: 20px auto;
                padding: 0 15px;
            }

            .edit-header h1 {
                font-size: 20px;
            }

            .edit-card-body {
                padding: 25px;
            }

            .form-row {
                flex-direction: column;
                gap: 15px;
            }

            .form-icon {
                margin-top: 0;
            }

            .form-actions {
                padding: 20px;
                flex-direction: column;
            }

            .form-actions .btn,
            .btn-cancel {
                width: 100%;
                justify-content: center;
            }
        }
    </style>
</head>
<body>
	<div class="wrapper">
        <!-- Header section -->
        <?php require('header_view.php') ?>
       
        <!-- Main content -->
        <div class="edit-container">
            <div class="edit-header">
                <h1>Sửa thông tin</h1>
                <p>Cập nhật thông tin cá nhân của bạn</p>
            </div>

            <?php if (!empty($mangketqua)): ?>
                <?php foreach ($mangketqua as $key => $value): ?>
                    <div class="edit-card">
                        <div class="edit-card-header">
                            <div class="edit-icon">
                                <i class="fa fa-edit"></i>
                            </div>
                            <h2>Chỉnh sửa thông tin</h2>
                        </div>

                        <form id="edit-form" action="../updatedulieu" method='post' enctype="multipart/form-data">
                            <div class="edit-card-body">
                                <input type="hidden" name="id" value="<?= htmlspecialchars($value['id'] ?? '') ?>">

                                <div class="form-row">
                                    <div class="form-icon">
                                        <i class="fa fa-envelope"></i>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label" for="email">Email</label>
                                        <input type='email' id="email" name='email' value='<?= htmlspecialchars($value['email'] ?? '') ?>' class="form-input" required>
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="form-icon">
                                        <i class="fa fa-user-circle"></i>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label" for="fullname">Tên sử dụng</label>
                                        <input type='text' id="fullname" name='fullname' value='<?= htmlspecialchars($value['fullname'] ?? '') ?>' class="form-input" required>
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="form-icon">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label" for="birthday">Ngày sinh</label>
                                        <input type='text' id="birthday" name='birthday' value='<?= htmlspecialchars($value['birthday'] ?? '') ?>' class="form-input" placeholder="YYYY-MM-DD">
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="form-icon">
                                        <i class="fa fa-phone"></i>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label" for="sdt">Số điện thoại</label>
                                        <input type='tel' id="sdt" name='sdt' value='<?= htmlspecialchars($value['sdt'] ?? '') ?>' class="form-input">
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="form-icon">
                                        <i class="fa fa-map-marker"></i>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label" for="address">Địa chỉ</label>
                                        <input type='text' id="address" name='address' value='<?= htmlspecialchars($value['address'] ?? '') ?>' class="form-input">
                                    </div>
                                </div>
                            </div>

                            <div class="form-actions">
                                <a href="<?php echo base_url(); ?>index.php/showuser_controller/indexshowuser" class="btn-cancel">
                                    <i class="fa fa-times"></i>
                                    <span>Hủy</span>
                                </a>
                                <button type='submit' class="btn btn-md btn--warning btn--wider">
                                    <i class="fa fa-save"></i>
                                    <span>Lưu thông tin</span>
                                </button>
                            </div>
                        </form>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="edit-card">
                    <div class="edit-card-body" style="text-align: center; padding: 60px 20px;">
                        <i class="fa fa-exclamation-triangle" style="font-size: 48px; color: var(--color-grey-light); margin-bottom: 20px;"></i>
                        <h3 style="font-family: 'aleobold', sans-serif; color: var(--color-main); font-size: 18px; margin-bottom: 10px;">Không tìm thấy thông tin</h3>
                        <p style="font-family: 'Roboto', sans-serif; font-size: 13px; color: var(--color-grey);">Vui lòng quay lại trang thông tin tài khoản</p>
                        <a href="<?php echo base_url(); ?>index.php/showuser_controller/indexshowuser" class="btn btn-md btn--warning btn--wider" style="margin-top: 20px; display: inline-block;">
                            <i class="fa fa-arrow-left"></i>
                            <span>Quay lại</span>
                        </a>
                    </div>
                </div>
            <?php endif; ?>
        </div>
        
        <div class="clearfix"></div>
    </div>
    
    <footer class="footer-wrapper">
        <section class="container">
            <div class="col-xs-4 col-md-2 footer-nav">
                <ul class="nav-link">
                    <li><a href="<?php echo base_url(); ?>index.php/Index_controller" class="nav-link__item">Phim</a></li>
                    <li><a href="<?php echo base_url(); ?>index.php/trailer_controller" class="nav-link__item">Trailers</a></li>
                    <li><a href="rates-left.html" class="nav-link__item">Đánh Giá</a></li>
                </ul>
            </div>
            <div class="col-xs-4 col-md-2 footer-nav">
                <ul class="nav-link">
                    <li><a href="<?php echo base_url(); ?>index.php/ShowPhim/PhimDC" class="nav-link__item">Phim Đang Chiếu</a></li>
                    <li><a href="<?php echo base_url(); ?>index.php/offers.controller" class="nav-link__item">Khuyến Mãi</a></li>
                    <li><a href="news-left.html" class="nav-link__item">Tin Tức</a></li>
                </ul>
            </div>
            <div class="col-xs-4 col-md-2 footer-nav">
                <ul class="nav-link">
                    <li><a href="<?php echo base_url(); ?>index.php/ShowPhim/PhimSC" class="nav-link__item">Phim Sắp chiếu</a></li>
                    <li><a href="<?php echo base_url(); ?>index.php/contract_controller" class="nav-link__item">Liên Hệ</a></li>
                    <li><a href="page-elements.html" class="nav-link__item">Rạp</a></li>
                </ul>
            </div>
            <div class="col-xs-12 col-md-6">
                <div class="footer-info">
                    <p class="heading-special--small">V-STAR MEDIA<br><span class="title-edition">in the social media</span></p>

                    <div class="social">
                        <a href='https://www.facebook.com/vku.udn.vn' class="social__variant fa fa-facebook"></a>
                        <a href='#' class="social__variant fa fa-twitter"></a>
                        <a href='#' class="social__variant fa fa-vk"></a>
                        <a href='#' class="social__variant fa fa-instagram"></a>
                        <a href='#' class="social__variant fa fa-tumblr"></a>
                        <a href='#' class="social__variant fa fa-pinterest"></a>
                    </div>
                    
                    <div class="clearfix"></div>
                </div>
            </div>
        </section>
    </footer>

    <!-- JavaScript-->
        <!-- jQuery 3.1.1--> 
        <script src="<?php echo base_url(); ?>https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="js/external/jquery-3.1.1.min.js"><\/script>')</script>
        <!-- Migrate --> 
        <script src="<?php echo base_url(); ?>js/external/jquery-migrate-1.2.1.min.js"></script>
        <!-- Bootstrap 3--> 
        <script src="<?php echo base_url(); ?>http://netdna.bootstrapcdn.com/bootstrap/3.0.2/js/bootstrap.min.js"></script>

        <!-- Mobile menu -->
        <script src="<?php echo base_url(); ?>js/jquery.mobile.menu.js"></script>
         <!-- Select -->
        <script src="<?php echo base_url(); ?>js/external/jquery.selectbox-0.2.min.js"></script>
        <!-- Form element -->
        <script src="<?php echo base_url(); ?>js/external/form-element.js"></script>
        <!-- Form validation -->
        <script src="<?php echo base_url(); ?>js/form.js"></script>

        <!-- Custom -->
        <script src="<?php echo base_url(); ?>js/custom.js"></script>
  <script src="<?php echo base_url(); ?>js/admin-sidebar.js"></script>
</body>
</html>