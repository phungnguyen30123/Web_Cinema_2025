<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Phim đang chiếu</title>

    <!-- Mobile Specific Metas-->
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="telephone=no" name="format-detection">
    
    <!-- Fonts -->
        <!-- Font awesome - icon font -->
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
        <!-- Roboto -->
        <link href='http://fonts.googleapis.com/css?family=Roboto:400,700' rel='stylesheet' type='text/css'>
    
    <!-- Stylesheets -->

        <!-- jQuery UI --> 
        <link href="http://code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.css" rel="stylesheet">

        <!-- Mobile menu -->
        <link href="<?php echo base_url(); ?>css/gozha-nav.css" rel="stylesheet" />
        <!-- Select -->
        <link href="<?php echo base_url(); ?>css/external/jquery.selectbox.css" rel="stylesheet" /> 
        <!-- Swiper slider -->
        <link href="<?php echo base_url(); ?>css/external/idangerous.swiper.css" rel="stylesheet" />
        <!-- Magnific-popup -->
        <link href="<?php echo base_url(); ?>css/external/magnific-popup.css" rel="stylesheet" />

    
        <!-- Custom -->
        <link href="<?php echo base_url(); ?>css/style.css?v=1" rel="stylesheet" />

        <!-- Modernizr --> 
        <script src="<?php echo base_url(); ?>js/external/modernizr.custom.js"></script>
</head>
<body>

     <div class="wrapper">
        <!-- Header section -->
        <?php require('header_view.php') ?>

        
        <!-- Main content -->
        <section class="container">
            <div class="col-sm-12">
                <h2 class="page-heading">phim đang chiếu</h2>
                
                
               <!--  <div class="tags-area">
                    <div class="tags tags--unmarked">
                        <span class="tags__label">Sorted by:</span>
                            <ul>
                                <li class="item-wrap"><a href="#" class="tags__item item-active" data-filter='all'>all</a></li>
                                <li class="item-wrap"><a href="#" class="tags__item" data-filter='release'>release date</a></li>
                                <li class="item-wrap"><a href="#" class="tags__item" data-filter='popularity'>popularity</a></li>
                                <li class="item-wrap"><a href="#" class="tags__item" data-filter='comments'>comments</a></li>
                                <li class="item-wrap"><a href="#" class="tags__item" data-filter='ending'>ending soon</a></li>
                            </ul>
                    </div>
                </div>-->
                
                
                <?php foreach ($dulieuPhimDCcon as $key => $value): ?>
                    <!-- Movie preview item -->
                <div class="movie movie--preview movie--full release">
                     <div class="col-sm-3 col-md-2 col-lg-2">
                            <div class="movie__images">
                                <img alt='' src="<?php echo $value['poster'] ?>">
                            </div>
                            <div class="movie__feature">
                                <a href="#" class="movie__feature-item movie__feature--comment">1</a>
                                <a href="#" class="movie__feature-item movie__feature--video">2</a>
                                <a href="#" class="movie__feature-item movie__feature--photo">4</a>
                            </div>
                    </div>

                    <div class="col-sm-9 col-md-10 col-lg-10 movie__about">
                            <a href="<?php echo base_url(); ?>index.php/Movie_page_controller/showinfophim/<?php echo $value['id'] ?>" class="movie__title link--huge"><?php echo $value['title'] ?></a>

                            <p class="movie__time"><?php echo $value['duration'] ?></p>

                            <p class="movie__option"><strong>Đất nước: </strong><a href="#"><?php echo $value['country'] ?></a></p>
                            <p class="movie__option"><strong>Thể loại: </strong><a href="#"><?php echo $value['category'] ?></a></p>
                            <p class="movie__option"><strong>Ngày khởi chiếu: </strong><?php echo $value['open_date'] ?></p>
                            <p class="movie__option"><strong>Đạo diễn: </strong><a href="#"><?php echo $value['director'] ?></a></p>
                            <p class="movie__option"><strong>Diễn viên: </strong><a href="#"><?php echo $value['actor'] ?></a></p>

                            <div class="movie__btns">
                                <a href="<?php echo base_url(); ?>index.php/Movie_page_controller/showinfophim/<?= $value['id']; ?>" class="btn btn-md btn--warning">mua <span class="hidden-sm">vé</span></a>
                            <!--    <a href="#" class="watchlist">Add to watchlist</a>-->
                            </div>

                            <div class="preview-footer">
                                <div class="movie__rate"><div class="score"></div><span class="movie__rate-number">170 lượt bình chọn</span> <span class="movie__rating">5.0</span></div>
                                

                            </div>
                    </div>

                    <div class="clearfix"></div>
                    
                    <!-- Time table (choose film start time)-->
                    <div class="time-select">
                        <div class="time-select__group group--first">
                            <div class="col-sm-4">
                                <p class="time-select__place">Cineworld</p>
                            </div>
                            <ul class="col-sm-8 items-wrap">
                                <li class="time-select__item" data-time='09:40'>09:40</li>
                                <li class="time-select__item" data-time='13:45'>13:45</li>
                                <li class="time-select__item active" data-time='15:45'>15:45</li>
                                <li class="time-select__item" data-time='19:50'>19:50</li>
                                <li class="time-select__item" data-time='21:50'>21:50</li>
                            </ul>
                        </div>

                        <div class="time-select__group">
                            <div class="col-sm-4">
                                <p class="time-select__place">Empire</p>
                            </div>
                            <ul class="col-sm-8 items-wrap">
                                <li class="time-select__item" data-time='10:45'>10:45</li>
                                <li class="time-select__item" data-time='16:00'>16:00</li>
                                <li class="time-select__item" data-time='19:00'>19:00</li>
                                <li class="time-select__item" data-time='21:15'>21:15</li>
                                <li class="time-select__item" data-time='23:00'>23:00</li>
                            </ul>
                        </div>

                        <div class="time-select__group">
                            <div class="col-sm-4">
                                <p class="time-select__place">Curzon</p>
                            </div>
                            <ul class="col-sm-8 items-wrap">
                                <li class="time-select__item" data-time='09:00'>09:00</li>
                                <li class="time-select__item" data-time='11:00'>11:00</li>
                                <li class="time-select__item" data-time='13:00'>13:00</li>
                                <li class="time-select__item" data-time='15:00'>15:00</li>
                                <li class="time-select__item" data-time='17:00'>17:00</li>
                                <li class="time-select__item" data-time='19:00'>19:00</li>
                                <li class="time-select__item" data-time='21:00'>21:00</li>
                                <li class="time-select__item" data-time='23:00'>23:00</li>
                                <li class="time-select__item" data-time='01:00'>01:00</li>
                            </ul>
                        </div>

                        <div class="time-select__group">
                            <div class="col-sm-4">
                                <p class="time-select__place">Odeon</p>
                            </div>
                            <ul class="col-sm-8 items-wrap">
                                <li class="time-select__item" data-time='10:45'>10:45</li>
                                <li class="time-select__item" data-time='16:00'>16:00</li>
                                <li class="time-select__item" data-time='19:00'>19:00</li>
                                <li class="time-select__item" data-time='21:15'>21:15</li>
                                <li class="time-select__item" data-time='23:00'>23:00</li>
                            </ul>
                        </div>

                        <div class="time-select__group group--last">
                            <div class="col-sm-4">
                                <p class="time-select__place">Picturehouse</p>
                            </div>
                            <ul class="col-sm-8 items-wrap">
                                <li class="time-select__item" data-time='17:45'>17:45</li>
                                <li class="time-select__item" data-time='21:30'>21:30</li>
                                <li class="time-select__item" data-time='02:20'>02:20</li>
                            </ul>
                        </div>
                    </div>
                    <!-- end time table-->

                </div>
                <!-- end movie preview item -->
                    
                <?php endforeach ?>



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



    <!-- JavaScript-->
        <!-- jQuery 3.1.1--> 
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="js/external/jquery-3.1.1.min.js"><\/script>')</script>
        <!-- Migrate --> 
        <script src="js/external/jquery-migrate-1.2.1.min.js"></script>
        <!-- Bootstrap 3--> 
        <script src="http://netdna.bootstrapcdn.com/bootstrap/3.0.2/js/bootstrap.min.js"></script>

        <!-- Mobile menu -->
        <script src="js/jquery.mobile.menu.js"></script>
         <!-- Select -->
        <script src="js/external/jquery.selectbox-0.2.min.js"></script>
        
        <!-- Form element -->
        <script src="js/external/form-element.js"></script>
        <!-- Form validation -->
        <script src="js/form.js"></script>

        <!-- Custom -->
        <script src="js/custom.js"></script>

</body>
</html>