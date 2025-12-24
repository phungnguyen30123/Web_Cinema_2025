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
                    <img class="order__images" alt='' src="<?php echo base_url(); ?>images/tickets.png">
                    <p class="order__title">Đặt vé<br><span class="order__descript">and have fun movie time</span></p>
                    <span class="order__descript"><strong>Phim: <?= $valueghe[7]; ?></strong><br><strong>Thời gian: <?= $valueghe[8]; ?>, <?= $valueghe['9']; ?></strong></span>
                    
                </div>
            </div>
                <div class="order-step-area">
                    <div class="order-step first--step order-step--disable ">1. Chọn lịch chiếu</div>
                    <div class="order-step second--step order-step--disable">2. Chọn ghế</div>
                    <div class="order-step third--step">3. Thanh toán</div>
                </div>

            <div class="col-sm-12">
                <div class="checkout-wrapper">
                    <h2 class="page-heading">Tổng giá</h2>
                    <ul class="book-result">
                        <li class="book-result__item">Ghế đã chọn: <span class="book-result__count booking-ticket"><?= $valueghe[6]; ?></span></li>
                        <br> 
                        <br>    
                        <li class="book-result__item">Số lượng ghế Thường: <span class="book-result__count booking-ticket"><?= $valueghe[2]; ?></span></li>
                        
                        <li class="book-result__item">Số lượng ghế Vip: <span class="book-result__count booking-ticket"><?= $valueghe[3]; ?></span></li>
                        <li class="book-result__item">Số lượng ghế Đôi: <span class="book-result__count booking-ticket"><?= $valueghe[4]; ?></span></li>
                        <br>
                        <li class="book-result__item">Tổng số lượng vé: <span class="book-result__count booking-ticket"><?= $valueghe[1]; ?></span></li>
                        <br>
                        <br>    

                        
                        <li class="book-result__item">Tổng tiền: <span class="book-result__count booking-cost"><?= $valueghe[5]; ?> 000 đ</span></li>
                    </ul>

                    <!-- <h2 class="page-heading">Chọn phương thức thanh toán</h2>
                    <div class="payment">
                        <a href="#" class="payment__item">
                            <img alt='' src="<?php echo base_url(); ?>images/payment/pay1.png">
                        </a>
                        <a href="#" class="payment__item">
                             <img alt='' src="images/payment/pay2.png"> 
                        </a>
                        <a href="#" class="payment__item">
                            <img alt='' src="<?php echo base_url(); ?>images/payment/pay3.png">
                        </a>
                        <a href="#" class="payment__item">
                            <img alt='' src="<?php echo base_url(); ?>images/payment/pay4.png">
                        </a>
                        <a href="#" class="payment__item">
                            <img alt='' src="<?php echo base_url(); ?>images/payment/pay5.png">
                        </a>
                        <a href="#" class="payment__item">
                            <img alt='' src="<?php echo base_url(); ?>images/payment/pay6.png">
                        </a>
                        <a href="#" class="payment__item">
                            <img alt='' src="<?php echo base_url(); ?>images/payment/pay7.png">
                        </a> 
                    </div>-->

                </div>
                
                <div class="order">                    
                    <form class="booking-pagination booking-pagination--margin" id='payment-form' action="<?php echo base_url(); ?>index.php/ThanhToan_controller/process" method='post' enctype="multidata/form-data">
                        <!-- Tất cả hidden inputs chung -->
                        <input type="hidden" name="id_user" value="<?= $_SESSION['id_user'] ?>">
                        <input type="hidden" name='choosen-cost' value="<?= $valueghe[5]; ?> 000 đ">
                        <input type="hidden" name='choosen-sits' value="<?= $valueghe[6]; ?>">
                        <input type="hidden" name="id_calendar" value="<?= $valueghe[0]; ?>">
                        <input type="hidden" name="tenphim" value="<?= $valueghe[7]; ?>">
                        <input type="hidden" name="ngay" value="<?= $valueghe[8]; ?>">
                        <input type="hidden" name="gio" value="<?= $valueghe[9]; ?>">
                        
                        <div class="payment" style="margin-bottom: 20px;">
                            <h3 for="payment-method" style="display: block; margin-bottom: 10px; font-weight: bold;">
                                Phương thức thanh toán:
                            </h3>
                            <select id="payment-method" name="payment_method" required style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 5px; margin-bottom: 15px;">
                                <option selected value="payUrl">Thanh toán qua MoMo</option>
                                <option value="vnpay">Thanh toán qua VNPay</option>
                            </select>
                            
                            <button type="submit" style="width: 100%; padding: 12px; border: gray solid 1px; border-radius: 5px; background-color: #ffd564; cursor: pointer; font-weight: bold;">
                                Thanh toán
                            </button>
                        </div>
                    </form>
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

</body>
</html>
