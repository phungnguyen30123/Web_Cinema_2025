<!doctype html>
<html>
<head>
    <!-- Basic Page Needs -->
        <meta charset="utf-8">
        <title>trailers</title>
        <meta name="description" content="A Template by Gozha.net">
        <meta name="keywords" content="HTML, CSS, JavaScript">
        <meta name="author" content="Gozha.net">
    
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

    .account-container {
        max-width: 900px;
        margin: 40px auto;
        padding: 0 20px;
    }

    .account-header {
        text-align: center;
        margin-bottom: 40px;
    }

    .account-header h1 {
        font-family: 'aleobold', sans-serif;
        color: var(--color-main);
        font-size: 22px;
        text-transform: uppercase;
        margin-bottom: 10px;
        line-height: 20px;
    }

    .account-header p {
        font-family: 'Roboto', sans-serif;
        color: var(--color-grey);
        font-size: 13px;
        margin-top: 10px;
    }

    .account-card {
        background: var(--color-null);
        border-radius: 3px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        overflow: hidden;
        margin-bottom: 30px;
        border: 1px solid var(--color-grey-light);
    }

    .account-card-header {
        background-color: var(--color-grey-lighter);
        padding: 30px;
        text-align: center;
        border-bottom: 1px solid var(--color-grey-light);
    }

    .account-card-header .user-icon {
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

    .account-card-header h2 {
        margin: 0;
        font-family: 'aleobold', sans-serif;
        font-size: 22px;
        color: var(--color-main);
        text-transform: uppercase;
    }

    .account-card-body {
        padding: 40px;
    }

    .info-row {
        display: flex;
        align-items: center;
        padding: 20px 0;
        border-bottom: 1px solid var(--color-grey-light);
        transition: background-color 0.3s ease;
    }

    .info-row:last-child {
        border-bottom: none;
    }

    .info-row:hover {
        background-color: var(--color-grey-lighter);
        margin: 0 -20px;
        padding-left: 20px;
        padding-right: 20px;
        border-radius: 3px;
    }

    .info-icon {
        width: 45px;
        height: 45px;
        background-color: var(--color-yellow);
        border-radius: 3px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--color-main);
        font-size: 18px;
        margin-right: 20px;
        flex-shrink: 0;
    }

    .info-content {
        flex: 1;
    }

    .info-label {
        font-family: 'Roboto', sans-serif;
        font-size: 12px;
        color: var(--color-grey);
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 8px;
        font-weight: 500;
    }

    .info-value {
        font-family: 'Roboto', sans-serif;
        font-size: 16px;
        color: var(--color-main);
        font-weight: 400;
    }

    .info-value input {
        width: 100%;
        border: none;
        background: transparent;
        font-family: 'Roboto', sans-serif;
        font-size: 16px;
        color: var(--color-main);
        font-weight: 400;
        padding: 5px 0;
        outline: none;
    }

    .info-value input:focus {
        border-bottom: 2px solid var(--color-yellow);
    }

    .action-buttons {
        padding: 30px 40px;
        background: var(--color-grey-lighter);
        display: flex;
        justify-content: center;
        gap: 15px;
        border-top: 1px solid var(--color-grey-light);
    }

    .action-buttons .btn {
        display: inline-flex;
        align-items: center;
        gap: 8px;
    }

    .action-buttons .btn i {
        font-size: 16px;
    }

    @media (max-width: 768px) {
        .account-container {
            margin: 20px auto;
            padding: 0 15px;
        }

        .account-header h1 {
            font-size: 20px;
        }

        .account-card-body {
            padding: 25px;
        }

        .info-row {
            flex-direction: column;
            align-items: flex-start;
            padding: 15px 0;
        }

        .info-icon {
            margin-bottom: 15px;
            margin-right: 0;
        }

        .info-value {
            font-size: 14px;
        }

        .action-buttons {
            padding: 20px;
            flex-direction: column;
        }

        .action-buttons .btn {
            width: 100%;
            justify-content: center;
        }
    }

    .empty-state {
        text-align: center;
        padding: 60px 20px;
        color: var(--color-grey);
    }

    .empty-state i {
        font-size: 48px;
        margin-bottom: 20px;
        color: var(--color-grey-light);
    }

    .empty-state h3 {
        font-family: 'aleobold', sans-serif;
        color: var(--color-main);
        font-size: 18px;
        margin-bottom: 10px;
    }

    .empty-state p {
        font-family: 'Roboto', sans-serif;
        font-size: 13px;
        color: var(--color-grey);
    }
</style>


    
</head>
<body>
     <div class="wrapper">
        <!-- Header section -->
        <?php require('header_view.php') ?>

 


        <div class="account-container">
            <div class="account-header">
                <h1>Thông tin tài khoản</h1>
                <p>Quản lý thông tin cá nhân của bạn</p>
            </div>

            <?php if (!empty($dulieucontroller)): ?>
                <?php foreach ($dulieucontroller as $key => $value): ?>
                    <div class="account-card">
                        <div class="account-card-header">
                            <div class="user-icon">
                                <i class="fa fa-user"></i>
                            </div>
                            <h2><?= htmlspecialchars($value['fullname'] ?? 'Người dùng') ?></h2>
                        </div>

                        <div class="account-card-body">
                            <form id="form-login" method="post" enctype="multipart/form-data">
                                <div class="info-row">
                                    <div class="info-icon">
                                        <i class="fa fa-envelope"></i>
                                    </div>
                                    <div class="info-content">
                                        <div class="info-label">Email</div>
                                        <div class="info-value">
                                            <input type="text" name="email" value="<?= htmlspecialchars($value['email'] ?? '') ?>" readonly>
                                        </div>
                                    </div>
                                </div>

                                <div class="info-row">
                                    <div class="info-icon">
                                        <i class="fa fa-user-circle"></i>
                                    </div>
                                    <div class="info-content">
                                        <div class="info-label">Tên sử dụng</div>
                                        <div class="info-value">
                                            <input type="text" name="ten" value="<?= htmlspecialchars($value['fullname'] ?? '') ?>" readonly>
                                        </div>
                                    </div>
                                </div>

                                <div class="info-row">
                                    <div class="info-icon">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    <div class="info-content">
                                        <div class="info-label">Ngày sinh</div>
                                        <div class="info-value">
                                            <input type="text" name="ngay" value="<?= htmlspecialchars($value['birthday'] ?? 'Chưa cập nhật') ?>" readonly>
                                        </div>
                                    </div>
                                </div>

                                <div class="info-row">
                                    <div class="info-icon">
                                        <i class="fa fa-phone"></i>
                                    </div>
                                    <div class="info-content">
                                        <div class="info-label">Số điện thoại</div>
                                        <div class="info-value">
                                            <input type="text" name="sdt" value="<?= htmlspecialchars($value['sdt'] ?? 'Chưa cập nhật') ?>" readonly>
                                        </div>
                                    </div>
                                </div>

                                <div class="info-row">
                                    <div class="info-icon">
                                        <i class="fa fa-map-marker"></i>
                                    </div>
                                    <div class="info-content">
                                        <div class="info-label">Địa chỉ</div>
                                        <div class="info-value">
                                            <input type="text" name="diachi" value="<?= htmlspecialchars($value['address'] ?? 'Chưa cập nhật') ?>" readonly>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <div class="action-buttons">
                            <a href="edituser/<?= $value['id'] ?>" class="btn btn-md btn--warning btn--wider">
                                <i class="fa fa-edit"></i>
                                <span>Chỉnh sửa thông tin</span>
                            </a>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="account-card">
                    <div class="empty-state">
                        <i class="fa fa-user-times"></i>
                        <h3>Không tìm thấy thông tin</h3>
                        <p>Vui lòng đăng nhập để xem thông tin tài khoản</p>
                    </div>
                </div>
            <?php endif; ?>
        </div>      
    </div>
    
        <?php require('footer_view.php'); ?>
    



        

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
        

</body>
</html>






