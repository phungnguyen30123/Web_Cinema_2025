<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=   , initial-scale=1.0">
    <title>Phim </title>

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
        <!-- Banner -->
       <!-- Banner -->
       <div class="banner-top">
        <img alt='top banner' src="<?php echo base_url(); ?>images/banner.png" style="height:90px; width:1600px">
    </div>
 <?php require('header_view.php') ?>


        <!-- Main content -->
        <?php foreach ($dulieutucontroller as $key => $value): ?>
            <section class="container">
                <div class="col-sm-12">
                    <div class="movie">
                        <h2 class="page-heading"><?php echo $value['title'] ?></h2>

                        <div class="movie__info">
                            <div class="col-sm-4 col-md-3 movie-mobile">
                                <div class="movie__images">
                                    <span class="movie__rating">5.0</span>
                                    <img alt='' src="<?php echo $value['poster'] ?>">
                                </div>
                                <!-- <div class="movie__rate">Đánh giá: </div> -->
                            </div>

                            <div class="col-sm-8 col-md-9">
                                <p class="movie__time">169 min</p>

                                <p class="movie__option"><strong>Đất nước: </strong><a href="#"><?php echo $value['country'] ?></a>, <a href="#">USA</a></p>
                                <p class="movie__option"><strong>Thể loại: </strong><a href="#"><?php echo $value['category'] ?></a> <a href="#"></a></p>
                                <p class="movie__option"><strong>Ngày khởi chiếu: </strong><?php echo $value['open_date'] ?></p>
                                <p class="movie__option"><strong>Đạo diễn: </strong><a href="#"><?php echo $value['director'] ?></a></p>
                                <p class="movie__option"><strong>Diễn viên: </strong><a href="#"><?php echo $value['actor'] ?></a></p>
                                <!-- <a href="#" class="comment-link">Bình luận:  15</a> -->

                                <div class="movie__btns movie__btns--full">
                                    <a href="#time" class="btn btn-md btn--warning">mua vé</a>
                                    <!--  <a href="#" class="watchlist">thêm vào danh sách</a> -->
                                </div>

                            <!-- <div class="share">
                                <span class="share__marker">Share: </span>
                                <div class="addthis_toolbox addthis_default_style ">
                                    <a class="addthis_button_facebook_like" fb:like:layout="button_count"></a>
                                    <a class="addthis_button_tweet"></a>
                                    <a class="addthis_button_google_plusone" g:plusone:size="medium"></a>
                                </div>
                            </div> -->
                        </div>
                    </div>
                    
                    <div class="clearfix"></div>
                    
                    <h2 class="page-heading">Nội dung</h2>

                    <p class="movie__describe"><?php echo $value['description'] ?></p>

                    <h2 class="page-heading">photos &amp; videos</h2>
                    <p id="time"></p>
                    <div class="movie__media">
                        <div class="movie__media-switch">
                            <a href="#" class="watchlist list--photo" data-filter='media-photo'>234 photos</a>
                            <a href="#" class="watchlist list--video" data-filter='media-video'>10 videos</a>
                        </div>

                        <div class="swiper-container">
                          <div class="swiper-wrapper">
                              <!--First Slide-->
                              <div class="swiper-slide media-video">
                                <a href='<?php echo $value['trailer1'] ?>' class="movie__media-item">
                                    <img alt='' src=" <?php echo $value['imgtra1'] ?>">
                                </a>
                            </div>

                            <!--Second Slide-->
                            <div class="swiper-slide media-video">
                                <a href='<?php echo $value['trailer2'] ?>' class="movie__media-item">
                                    <img alt='' src=" <?php echo $value['imgtra2'] ?>">
                                </a>
                            </div>

                            <!--Third Slide-->
                            <div class="swiper-slide media-photo"> 
                                <a href='<?php echo $value['image1'] ?>' class="movie__media-item">
                                    <img alt='' src="<?php echo $value['image1'] ?>">
                                </a>
                            </div>

                            <!--Four Slide-->
                            <div class="swiper-slide media-photo"> 
                                <a href='<?php echo $value['image2'] ?>' class="movie__media-item">
                                    <img alt='' src="<?php echo $value['image2'] ?>">
                                </a>
                            </div>

                            <!--Slide-->
                            <div class="swiper-slide media-photo"> 
                                <a href='<?php echo $value['image3'] ?>' class="movie__media-item">
                                    <img alt='' src="<?php echo $value['image3'] ?>">
                                </a>
                            </div>

                            <!--Slide-->
                            <div class="swiper-slide media-photo"> 
                                <a href='<?php echo $value['image4'] ?>' class="movie__media-item">
                                    <img alt='' src="<?php echo $value['image4'] ?>">
                                </a>
                            </div>

                            <!--First Slide-->
                            <div class="swiper-slide media-video">
                                <a href='https://www.youtube.com/watch?v=Y5AehBA3IsE' class="movie__media-item ">
                                   <img alt='' src="<?php echo base_url(); ?>images/movie/movie-video1.jpg">
                               </a>
                           </div>

                           <!--Second Slide-->
                           <div class="swiper-slide media-video">
                            <a href='https://www.youtube.com/watch?v=Kb3ykVYvT4U' class="movie__media-item">
                                <img alt='' src="<?php echo base_url(); ?>images/movie/movie-video2.jpg">
                            </a>
                        </div>

                        <!--Slide-->
                        <div class="swiper-slide media-photo"> 
                            <a href='<?php echo base_url(); ?>images/gallery/large/item-15.jpg' class="movie__media-item">
                                <img alt='' src="<?php echo base_url(); ?>images/movie/movie-img5.jpg">
                            </a>
                        </div>

                        <!--Slide-->
                        <div class="swiper-slide media-photo"> 
                            <a href='<?php echo base_url(); ?>images/gallery/large/item-16.jpg' class="movie__media-item">
                                <img alt='' src="<?php echo base_url(); ?>images/movie/movie-img6.jpg">
                            </a>
                        </div>
                        
                    </div>
                </div>

            </div>

        </div>

    <?php endforeach ?>
    <?php if (!empty($dulieungaytucontroller)): ?>
        <h2 class="page-heading">lịch chiếu</h2>
        <?php foreach ($dulieungaytucontroller as $valuengay): ?>
            <div class="choose-container">
                <div class="datepicker" style="position:relative;">
                  <style>
                    .datepicker:before, .datepicker:after { display: none !important; content: none !important; }
                  </style>
                  <span class="datepicker__marker"><i class="fa fa-calendar"></i>Ngày</span>
                  <big><?= isset($valuengay['day']) ? $valuengay['day'] : htmlspecialchars($valuengay[0]) ?></big>
                </div>
              <div class="clearfix"></div>

              <div class="time-select">
                <div class="time-select__group group--first">

                    <ul class="col-sm-8 items-wrap">
                        <?php 
                            $daykey = isset($valuengay['day']) ? $valuengay['day'] : $valuengay[0];
                            if (!empty($dulieugiotucontroller[$daykey])):
                                foreach ($dulieugiotucontroller[$daykey] as $valuegio): ?>
                                    <a href="<?php echo base_url(); ?>index.php/seat_controller/index_seat/<?= $valuegio['id_calendar']; ?>"><li class="time-select__item"><?= $valuegio['time']; ?></li></a>
                                <?php endforeach; 
                            else: ?>
                                <li class="time-select__item">Không có suất chiếu</li>
                            <?php endif; ?>
                    </ul>
                </div>
                <!-- <?= $_SESSION['id_user'] ?> -->
            </div>
        </div>
        <?php endforeach ?>
    <?php endif; ?>
            <!-- hiden maps with multiple locator-->


            <h2 class="page-heading">Bình luận</h2>

            <div class="comment-wrapper">
                <form id="comment-form" class="comment-form" method='post'>
                    <textarea class="comment-form__text" placeholder='cho ý kiến của bạn tại đây'></textarea>
                    <label class="comment-form__info">250 characters left</label>
                    <button type='submit' class="btn btn-md btn--danger comment-form__btn">gửi ý kiến</button>
                </form>

                <div class="comment-sets">

                    <div class="comment">
                        <div class="comment__images">
                            <img alt='' src="<?php echo base_url(); ?>images/comment/avatar.jpg">
                        </div>

                        <a href='#' class="comment__author"><span class="social-used fa fa-facebook"></span>hồ hồng</a>
                        <p class="comment__date">hôm nay | 05:04</p>
                        <p class="comment__message">Phim hay và rất ý nghĩa nha mọi người</p>
                        <a href='#' class="comment__reply">trở lại</a>
                    </div>


                    <div class="comment-more">
                        <a href="#" class="watchlist">nhiều bình luận hơn</a>
                    </div>

                </div>
            </div>
        </div>
    </div>

</section>

<div class="clearfix"></div>

<footer class="footer-wrapper">
    <section class="container">
        <div class="col-xs-4 col-md-2 footer-nav">
            <ul class="nav-link">

                <li><a href="movie-list-left.html" class="nav-link__item">PHim</a></li>
                <li><a href="trailer.html" class="nav-link__item">Trailers</a></li>
                <li><a href="rates-left.html" class="nav-link__item">phim chiếu</a></li>
            </ul>
        </div>
        <div class="col-xs-4 col-md-2 footer-nav">
            <ul class="nav-link">
                <li><a href="coming-soon.html" class="nav-link__item">phim đang chiếu</a></li>
                <li><a href="rates-left.html" class="nav-link__item">phim sắp chiếu</a></li>

                <li><a href="cinema-list.html" class="nav-link__item">rạp</a></li>


            </ul>
        </div>
        <div class="col-xs-4 col-md-2 footer-nav">
            <ul class="nav-link">
                <li><a href="offers.html" class="nav-link__item">khuyến mãi</a></li>
                <li><a href="#" class="nav-link__item">Liên hệ</a></li>
                <li><a href="gallery-four.html" class="nav-link__item">đăng nhập</a></li>
            </ul>
        </div>
        <div class="col-xs-12 col-md-6">
            <div class="footer-info">

                <div class="social">
                    <a href='#' class="social__variant fa fa-facebook"></a>
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
<script src="<?php echo base_url(); ?>https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script>window.jQuery || document.write('<script src="<?php echo base_url(); ?>js/external/jquery-3.1.1.min.js"><\/script>')</script>
    <!-- Migrate --> 
    <script src="<?php echo base_url(); ?>js/external/jquery-migrate-1.2.1.min.js"></script>
    <!-- jQuery UI -->
    <script src="http://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
    <!-- Bootstrap 3--> 
    <script src="http://netdna.bootstrapcdn.com/bootstrap/3.0.2/js/bootstrap.min.js"></script>

    <!-- Mobile menu -->
    <script src="<?php echo base_url(); ?>js/jquery.mobile.menu.js"></script>
    <!-- Select -->
    <script src="<?php echo base_url(); ?>js/external/jquery.selectbox-0.2.min.js"></script>

    <!-- Stars rate -->
    <script src="<?php echo base_url(); ?>js/external/jquery.raty.js"></script>
    <!-- Swiper slider -->
    <script src="<?php echo base_url(); ?>js/external/idangerous.swiper.min.js"></script>
    <!-- Magnific-popup -->
    <script src="<?php echo base_url(); ?>js/external/jquery.magnific-popup.min.js"></script> 

    <!--*** Google map  ***-->
    <script src="https://maps.google.com/maps/api/js?sensor=true"></script> 
    <!--*** Google map infobox  ***-->
    <script src="<?php echo base_url(); ?>js/external/infobox.js"></script> 

    <!-- Share buttons -->
    <script type="text/javascript">var addthis_config = {"data_track_addressbar":true};</script>
    <script type="text/javascript" src="http://s7.addthis.com/js/300/addthis_widget.js#pubid=ra-525fd5e9061e7ef0"></script>

    <!-- Form element -->
    <script src="<?php echo base_url(); ?>js/external/form-element.js"></script>
    <!-- Form validation -->
    <script src="<?php echo base_url(); ?>js/form.js"></script>

    <!-- Custom -->
    <script src="<?php echo base_url(); ?>js/custom.js"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            init_MoviePage();
            init_MoviePageFull();
        });
    </script>

    <!-- Code injected by live-server -->
    <script>
    // <![CDATA[  <-- For SVG support
    if ('WebSocket' in window) {
        (function () {
            function refreshCSS() {
                var sheets = [].slice.call(document.getElementsByTagName("link"));
                var head = document.getElementsByTagName("head")[0];
                for (var i = 0; i < sheets.length; ++i) {
                    var elem = sheets[i];
                    var parent = elem.parentElement || head;
                    parent.removeChild(elem);
                    var rel = elem.rel;
                    if (elem.href && typeof rel != "string" || rel.length == 0 || rel.toLowerCase() == "stylesheet") {
                        var url = elem.href.replace(/(&|\?)_cacheOverride=\d+/, '');
                        elem.href = url + (url.indexOf('?') >= 0 ? '&' : '?') + '_cacheOverride=' + (new Date().valueOf());
                    }
                    parent.appendChild(elem);
                }
            }
            var protocol = window.location.protocol === 'http:' ? 'ws://' : 'wss://';
            var address = protocol + window.location.host + window.location.pathname + '/ws';
            var socket = new WebSocket(address);
            socket.onmessage = function (msg) {
                if (msg.data == 'reload') window.location.reload();
                else if (msg.data == 'refreshcss') refreshCSS();
            };
            if (sessionStorage && !sessionStorage.getItem('IsThisFirstTime_Log_From_LiveServer')) {
                console.log('Live reload enabled.');
                sessionStorage.setItem('IsThisFirstTime_Log_From_LiveServer', true);
            }
        })();
    }
    else {
        console.error('Upgrade your browser. This Browser is NOT supported WebSocket for Live-Reloading.');
    }
    // ]]>
</script>
</body>
</html>
