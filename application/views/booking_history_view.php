<!doctype html>
<html>
<head>
    <!-- Basic Page Needs -->
        <meta charset="utf-8">
        <title>Lịch sử mua vé</title>
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

    .history-container {
        max-width: 1000px;
        margin: 40px auto;
        padding: 0 20px;
    }

    .history-header {
        text-align: center;
        margin-bottom: 40px;
    }

    .history-header h1 {
        font-family: 'aleobold', sans-serif;
        color: var(--color-main);
        font-size: 22px;
        text-transform: uppercase;
        margin-bottom: 10px;
        line-height: 20px;
    }

    .history-header p {
        font-family: 'Roboto', sans-serif;
        color: var(--color-grey);
        font-size: 13px;
        margin-top: 10px;
    }

    .booking-card {
        background: var(--color-null);
        border-radius: 3px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        overflow: hidden;
        margin-bottom: 20px;
        border: 1px solid var(--color-grey-light);
    }

    .booking-card-header {
        background-color: var(--color-yellow);
        padding: 20px 30px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        border-bottom: 2px solid var(--color-main);
    }

    .booking-card-header h3 {
        margin: 0;
        font-family: 'aleobold', sans-serif;
        font-size: 18px;
        color: var(--color-main);
        text-transform: uppercase;
    }

    .booking-status {
        padding: 5px 15px;
        border-radius: 3px;
        font-size: 12px;
        font-weight: bold;
        text-transform: uppercase;
    }

    .status-pending {
        background-color: #ffd564;
        color: var(--color-main);
    }

    .status-confirmed {
        background-color: var(--color-red);
        color: white;
    }

    .booking-card-body {
        padding: 30px;
    }

    .booking-info {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 20px;
        margin-bottom: 20px;
    }

    .info-item {
        display: flex;
        flex-direction: column;
    }

    .info-label {
        font-size: 12px;
        color: var(--color-grey);
        margin-bottom: 5px;
        text-transform: uppercase;
        font-weight: 600;
    }

    .info-value {
        font-size: 14px;
        color: var(--color-main);
        font-weight: 500;
    }

    .empty-state {
        text-align: center;
        padding: 60px 20px;
        color: var(--color-grey);
    }

    .empty-state i {
        font-size: 64px;
        margin-bottom: 20px;
        color: var(--color-grey-light);
    }

    .empty-state h3 {
        font-family: 'aleobold', sans-serif;
        color: var(--color-main);
        margin-bottom: 10px;
    }

    .back-button {
        text-align: center;
        margin-top: 30px;
    }

    .btn-back {
        display: inline-block;
        padding: 12px 30px;
        background-color: var(--color-yellow);
        color: var(--color-main);
        text-decoration: none;
        border-radius: 3px;
        font-weight: 600;
        text-transform: uppercase;
        transition: background-color 0.3s;
    }

    .btn-back:hover {
        background-color: var(--color-red);
        color: var(--color-null);
    }
</style>
</head>

<body>
    <div class="wrapper">
        <!-- Header section -->
        <?php require('header_view.php') ?>
        
        <!-- Main content -->
        <div class="history-container">
            <div class="history-header">
                <h1>Lịch sử mua vé</h1>
                <p>Xem lại các vé bạn đã đặt</p>
            </div>

            <?php if (!empty($booking_history)): ?>
                <?php foreach ($booking_history as $booking): ?>
                    <div class="booking-card">
                        <div class="booking-card-header">
                            <h3><?= htmlspecialchars($booking['movie_title'] ?? 'Phim không xác định') ?></h3>
                            <span class="booking-status <?= ($booking['status'] == 1) ? 'status-confirmed' : 'status-pending' ?>">
                                <?= ($booking['status'] == 1) ? 'Đã lấy vé' : 'Chưa lấy vé' ?>
                            </span>
                        </div>
                        <div class="booking-card-body">
                            <div class="booking-info">
                                <!-- <div class="info-item">
                                    <span class="info-label">Mã vé</span>
                                    <span class="info-value">#<?= htmlspecialchars($booking['id_ve'] ?? 'N/A') ?></span>
                                </div> -->
                                <div class="info-item">
                                    <span class="info-label">Ngày chiếu</span>
                                    <span class="info-value"><?= htmlspecialchars($booking['day'] ?? 'N/A') ?></span>
                                </div>
                                <div class="info-item">
                                    <span class="info-label">Giờ chiếu</span>
                                    <span class="info-value"><?= htmlspecialchars($booking['time'] ?? 'N/A') ?></span>
                                </div>
                                <div class="info-item">
                                    <span class="info-label">Ghế</span>
                                    <span class="info-value"><?= htmlspecialchars($booking['seats'] ?? 'N/A') ?></span>
                                </div>
                                <div class="info-item">
                                    <span class="info-label">Tổng tiền</span>
                                    <span class="info-value"><?php 
                                        $tong_tien = $booking['tong_tien'] ?? '0';
                                        // Loại bỏ tất cả ký tự không phải số (kể cả dấu cách, chữ "đ", v.v.)
                                        $tong_tien = preg_replace('/[^0-9]/', '', $tong_tien);
                                        echo number_format((float)$tong_tien, 0, ',', '.') . ' đ';
                                    ?></span>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="booking-card">
                    <div class="empty-state">
                        <i class="fa fa-ticket"></i>
                        <h3>Chưa có lịch sử mua vé</h3>
                        <p>Bạn chưa đặt vé nào. Hãy đặt vé để xem lịch sử tại đây.</p>
                    </div>
                </div>
            <?php endif; ?>

            <!-- <div class="back-button">
                <a href="<?php echo base_url(); ?>index.php/showuser_controller/indexshowuser" class="btn-back">
                    <i class="fa fa-arrow-left"></i> Quay lại thông tin tài khoản
                </a>
            </div> -->
        </div>
    </div>
    
    <?php require('footer_view.php'); ?>

    <!-- JavaScript -->
    <script src="<?php echo base_url(); ?>js/external/jquery-1.10.1.min.js"></script>
    <script src="<?php echo base_url(); ?>js/external/jquery-migrate-1.2.1.min.js"></script>
    <script src="<?php echo base_url(); ?>js/external/bootstrap.min.js"></script>
    <script src="<?php echo base_url(); ?>js/external/jquery.selectbox-0.2.min.js"></script>
    <script src="<?php echo base_url(); ?>js/external/jquery.magnific-popup.min.js"></script>
    <script src="<?php echo base_url(); ?>js/external/jquery.hoverdir.js"></script>
    <script src="<?php echo base_url(); ?>js/external/modernizr.custom.js"></script>
    <script src="<?php echo base_url(); ?>js/external/gozha-nav.js"></script>
    <script src="<?php echo base_url(); ?>js/main.js"></script>
</body>
</html>

