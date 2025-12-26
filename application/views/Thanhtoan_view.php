<!doctype html>
<html>
<head>
	<!-- Basic Page Needs -->
        <meta charset="utf-8">
        <title>AMovie - Booking step 3</title>
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
    
    
</head>

<body>
    <div class="wrapper">
        <!-- Banner -->
        <!-- <div class="banner-top">
            <img alt='top banner' src="images/banners/bra.jpg">
        </div>
 -->
        <!-- Header section -->
        <?php require('header_view.php') ?>
        
        
        <!-- Main content -->
        <?php foreach ($dulieughetucontroller as $valueghe): ?>
        <section class="container">
            <div class="order-container">
                <div class="order">
                    <!-- <img class="order__images" alt='' src="<?php echo base_url(); ?>images/tickets.png"> -->
                    <p class="order__title">Đặt vé</p>
                    <span class="order__descript"><strong>Phim: <?= $valueghe[7]; ?></strong><br><strong>Thời gian: <?= $valueghe[8]; ?>, <?= $valueghe['9']; ?></strong></span>
                    
                </div>
            </div>
                <div class="order-step-area">
                    <div class="order-step first--step order-step--disable ">1. Chọn lịch chiếu</div>
                    <div class="order-step second--step order-step--disable">2. Chọn ghế</div>
                    <div class="order-step third--step">3. Thanh toán</div>
                </div>

            <div class="col-sm-12">
                <div class="payment-page-content">
                    <!-- Booking Summary -->
                    <div class="checkout-wrapper payment-summary-card">
                        <h2 class="page-heading">Tóm tắt đặt vé</h2>
                        
                        <div class="booking-summary-content">
                            <!-- Movie Info with Poster -->
                            <div class="movie-poster-section">
                                <?php if (!empty($valueghe[10])): ?>
                                <div class="movie-poster">
                                    <img src="<?= $valueghe[10]; ?>" alt="<?= $valueghe[7]; ?>">
                                </div>
                                <?php endif; ?>
                                <div class="movie-info-right">
                                    <h3 class="movie-title"><?= $valueghe[7]; ?></h3>
                                    <div class="movie-format">2D Phụ Đề</div>
                                </div>
                            </div>
                            
                            <!-- Cinema and Showtime -->
                            <div class="cinema-showtime-section">
                                <div class="cinema-info">
                                    <?php if (!empty($valueghe[11])): ?>
                                        V-STAR Đà Nẵng - <?= $valueghe[11]; ?>
                                    <?php else: ?>
                                        V-STAR Đà Nẵng
                                    <?php endif; ?>
                                </div>
                                <div class="showtime-info">
                                    Suất: <?= $valueghe['9']; ?> - <?= $valueghe[8]; ?>
                                </div>
                            </div>
                            
                            <!-- Ticket Details -->
                            <div class="seat-items-section">
                                <?php 
                                // Hiển thị từng loại ghế đã mua
                                if ($valueghe[2] > 0) { // Ghế thường
                                    $price_cheap = 55000;
                                ?>
                                <div class="seat-item">
                                    <div class="seat-item-header">
                                        <span class="seat-item-quantity"><?= $valueghe[2]; ?>x</span>
                                        <span class="seat-item-name">Ghế đơn</span>
                                        <span class="seat-item-price"><?= number_format($price_cheap, 0, ',', '.'); ?> ₫</span>
                                    </div>
                                </div>
                                <?php } ?>
                                
                                <?php if ($valueghe[3] > 0) { // Ghế VIP
                                    $price_middle = 70000;
                                ?>
                                <div class="seat-item">
                                    <div class="seat-item-header">
                                        <span class="seat-item-quantity"><?= $valueghe[3]; ?>x</span>
                                        <span class="seat-item-name">Ghế VIP</span>
                                        <span class="seat-item-price"><?= number_format($price_middle, 0, ',', '.'); ?> ₫</span>
                                    </div>
                                </div>
                                <?php } ?>
                                
                                <?php if ($valueghe[4] > 0) { // Ghế đôi
                                    $price_expansive = 120000;
                                ?>
                                <div class="seat-item">
                                    <div class="seat-item-header">
                                        <span class="seat-item-quantity"><?= $valueghe[4]; ?>x</span>
                                        <span class="seat-item-name">Ghế đôi</span>
                                        <span class="seat-item-price"><?= number_format($price_expansive, 0, ',', '.'); ?> ₫</span>
                                    </div>
                                </div>
                                <?php } ?>
                                
                                <div class="seat-numbers">
                                    <strong>Ghế:</strong> <?= $valueghe[6]; ?>
                                </div>
                            </div>
                            
                            <!-- Total Cost -->
                            <div class="total-cost-simple">
                                <span class="total-label">Tổng cộng</span>
                                <span class="total-amount"><?= number_format($valueghe[5] * 1000, 0, ',', '.'); ?> ₫</span>
                            </div>
                        </div>
                    </div>

                    <!-- Payment Form -->
                    <div class="payment-form-card">
                        <h2 class="page-heading">Phương thức thanh toán</h2>
                            
                            <form id='payment-form' action="<?php echo base_url(); ?>index.php/ThanhToan_controller/process" method='post' enctype="multidata/form-data">
                                <!-- Tất cả hidden inputs chung -->
                                <input type="hidden" name="id_user" value="<?= $this->session->userdata('id_user') ?>">
                                <input type="hidden" name='choosen-cost' value="<?= $valueghe[5]; ?> 000 đ">
                                <input type="hidden" name='choosen-sits' value="<?= $valueghe[6]; ?>">
                                <input type="hidden" name="id_calendar" value="<?= $valueghe[0]; ?>">
                                <input type="hidden" name="tenphim" value="<?= $valueghe[7]; ?>">
                                <input type="hidden" name="ngay" value="<?= $valueghe[8]; ?>">
                                <input type="hidden" name="gio" value="<?= $valueghe[9]; ?>">
                                
                                <div class="payment-methods">
                                    <div class="payment-method-item" data-method="redirect">
                                        <input type="radio" id="payment-vnpay" name="payment_method" value="redirect" checked required>
                                        <label for="payment-vnpay" class="payment-method-label payment-vnpay">
                                            <div class="payment-method-badge">Phổ biến</div>
                                            <div class="payment-method-icon vnpay-icon">
                                                <i class="fa fa-credit-card"></i>
                                            </div>
                                            <div class="payment-method-info">
                                                <div class="payment-method-name">VNPay</div>
                                                <div class="payment-method-desc">Hỗ trợ nhiều ngân hàng</div>
                                                <div class="payment-method-features">
                                                    <span class="feature-tag"><i class="fa fa-bank"></i> Ngân hàng</span>
                                                    <span class="feature-tag"><i class="fa fa-shield"></i> Bảo mật</span>
                                                </div>
                                            </div>
                                            <div class="payment-method-check">
                                                <i class="fa fa-check-circle"></i>
                                            </div>
                                        </label>
                                    </div>
                                    
                                    <div class="payment-method-item" data-method="payUrl">
                                        <input type="radio" id="payment-momo" name="payment_method" value="payUrl" required>
                                        <label for="payment-momo" class="payment-method-label payment-momo">
                                            <div class="payment-method-icon momo-icon">
                                                <i class="fa fa-mobile"></i>
                                            </div>
                                            <div class="payment-method-info">
                                                <div class="payment-method-name">MoMo Wallet</div>
                                                <div class="payment-method-desc">Thanh toán nhanh qua ví điện tử</div>
                                                <div class="payment-method-features">
                                                    <span class="feature-tag"><i class="fa fa-bolt"></i> Nhanh</span>
                                                    <span class="feature-tag"><i class="fa fa-shield"></i> An toàn</span>
                                                </div>
                                            </div>
                                            <div class="payment-method-check">
                                                <i class="fa fa-check-circle"></i>
                                            </div>
                                        </label>
                                    </div>
                                </div>
                                
                                <button type="submit" class="btn-payment-submit">
                                    <span class="btn-text">
                                        <i class="fa fa-lock"></i>
                                        Thanh toán ngay
                                    </span>
                                </button>
                                
                                <div class="payment-security-note">
                                    <i class="fa fa-shield"></i>
                                    <span>Thông tin thanh toán được mã hóa và bảo mật</span>
                                </div>
                            </form>
                    </div>
                </div>
            </div>

        </section>
        

        <div class="clearfix"></div>

        <div class="booking-pagination">
                <a href="<?php echo base_url(); ?>index.php/seat_controller/index_seat/<?= $valueghe[0]; ?>" class="booking-pagination__prev">
                    <p class="arrow__text arrow--prev">Quay lại</p>
                    <span class="arrow__info">Chọn ghế</span>
                </a>
                <a href="#" class="booking-pagination__next hide--arrow">
                    <p class="arrow__text arrow--next">next step</p>
                    <span class="arrow__info"></span>
                </a>
        </div>
        
        <div class="clearfix"></div>

        <footer class="footer-wrapper">
            <section class="container">
                <div class="col-xs-4 col-md-2 footer-nav">
                    <ul class="nav-link">
                        <li><a href="#" class="nav-link__item">Cities</a></li>
                        <li><a href="movie-list-left.html" class="nav-link__item">Movies</a></li>
                        <li><a href="trailer.html" class="nav-link__item">Trailers</a></li>
                        <li><a href="rates-left.html" class="nav-link__item">Rates</a></li>
                    </ul>
                </div>
                <div class="col-xs-4 col-md-2 footer-nav">
                    <ul class="nav-link">
                        <li><a href="coming-soon.html" class="nav-link__item">Coming soon</a></li>
                        <li><a href="cinema-list.html" class="nav-link__item">Cinemas</a></li>
                        <li><a href="offers.html" class="nav-link__item">Best offers</a></li>
                        <li><a href="news-left.html" class="nav-link__item">News</a></li>
                    </ul>
                </div>
                <div class="col-xs-4 col-md-2 footer-nav">
                    <ul class="nav-link">
                        <li><a href="#" class="nav-link__item">Terms of use</a></li>
                        <li><a href="gallery-four.html" class="nav-link__item">Gallery</a></li>
                        <li><a href="contact.html" class="nav-link__item">Contacts</a></li>
                        <li><a href="page-elements.html" class="nav-link__item">Shortcodes</a></li>
                    </ul>
                </div>
                <div class="col-xs-12 col-md-6">
                    <div class="footer-info">
                        <p class="heading-special--small">A.Movie<br><span class="title-edition">in the social media</span></p>

                        <div class="social">
                            <a href='#' class="social__variant fa fa-facebook"></a>
                            <a href='#' class="social__variant fa fa-twitter"></a>
                            <a href='#' class="social__variant fa fa-vk"></a>
                            <a href='#' class="social__variant fa fa-instagram"></a>
                            <a href='#' class="social__variant fa fa-tumblr"></a>
                            <a href='#' class="social__variant fa fa-pinterest"></a>
                        </div>
                        
                        <div class="clearfix"></div>
                        <p class="copy">&copy; A.Movie, 2013. All rights reserved. Done by Olia Gozha</p>
                    </div>
                </div>
            </section>
        </footer>
    </div>

    <!-- open/close -->
        <div class="overlay overlay-hugeinc">
            
            <section class="container">

                <div class="col-sm-4 col-sm-offset-4">
                    <button type="button" class="overlay-close">Close</button>
                    <form id="login-form" class="login" method='get' novalidate=''>
                        <p class="login__title">sign in <br><span class="login-edition">welcome to A.Movie</span></p>

                        <div class="social social--colored">
                                <a href='#' class="social__variant fa fa-facebook"></a>
                                <a href='#' class="social__variant fa fa-twitter"></a>
                                <a href='#' class="social__variant fa fa-tumblr"></a>
                        </div>

                        <p class="login__tracker">or</p>
                        
                        <div class="field-wrap">
                        <input type='email' placeholder='Email' name='user-email' class="login__input">
                        <input type='password' placeholder='Password' name='user-password' class="login__input">

                        <input type='checkbox' id='#informed' class='login__check styled'>
                        <label for='#informed' class='login__check-info'>remember me</label>
                         </div>
                        
                        <div class="login__control">
                            <button type='submit' class="btn btn-md btn--warning btn--wider">sign in</button>
                            <a href="#" class="login__tracker form__tracker">Forgot password?</a>
                        </div>
                    </form>
                </div>

            </section>
        </div>
        <?php endforeach ?>

	<!-- JavaScript-->
        <!-- jQuery 3.1.1--> 
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="<?php echo base_url(); ?>js/external/jquery-3.1.1.min.js"><\/script>')</script>
        <!-- Migrate --> 
        <script src="<?php echo base_url(); ?>js/external/jquery-migrate-1.2.1.min.js"></script>
        <!-- Bootstrap 3--> 
        <script src="http://netdna.bootstrapcdn.com/bootstrap/3.0.2/js/bootstrap.min.js"></script>

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

        <!-- Payment Page Script -->
        <script>
            $(document).ready(function() {
                // Enhanced payment method selection
                $('.payment-method-label').on('click', function() {
                    // Remove active state from all items
                    $('.payment-method-item').removeClass('active');
                    // Add active state to clicked item
                    $(this).closest('.payment-method-item').addClass('active');
                });

                // Form validation before submit
                $('#payment-form').on('submit', function(e) {
                    var paymentMethod = $('input[name="payment_method"]:checked').val();
                    if (!paymentMethod) {
                        e.preventDefault();
                        alert('Vui lòng chọn phương thức thanh toán');
                        return false;
                    }
                });

                // Initialize - set active state for checked payment method
                $('input[name="payment_method"]:checked').closest('.payment-method-item').addClass('active');
            });
        </script>

</body>
</html>
