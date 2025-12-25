
<!doctype html>
<html>
<head>
    <!-- Basic Page Needs -->
        <meta charset="utf-8">
        <title>V-STAR</title>
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
        <link href='http://fonts.googleapis.com/css?family=Roboto:400,100,700' rel='stylesheet' type='text/css'>
        <!-- Open Sans -->
        <link href='http://fonts.googleapis.com/css?family=Open+Sans:800italic' rel='stylesheet' type='text/css'>
    
    <!-- Stylesheets -->

        <!-- Mobile menu -->
        <link href="<?php echo base_url(); ?>css/gozha-nav.css" rel="stylesheet" />
        <!-- Select -->
        <link href="<?php echo base_url(); ?>css/external/jquery.selectbox.css" rel="stylesheet" />

        <!-- Slider Revolution CSS Files -->
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>revolution/css/settings.css">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>revolution/css/layers.css">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>revolution/css/navigation.css">
    
        <!-- Custom -->
        <link href="<?php echo base_url(); ?>css/style.css?v=1" rel="stylesheet" />


        <!-- Modernizr --> 
        <script src="<?php echo base_url(); ?>js/external/modernizr.custom.js"></script>
    
    
</head>

<body>


    <div class="wrapper">
        <!-- Header section -->
        <?php 
        // Thiết lập class đặc biệt cho trang chủ
        $header_class_extra = 'header-wrapper--home';
        require('header_view.php'); 
        ?>
        <!-- Slider -->
        <div class="bannercontainer rev_slider_wrapper">
 
            <!-- the ID here will be used in the JavaScript below to initialize the slider -->
            <div id="rev_slider_1" class="banner rev_slider" style="display:none">
 
                <!-- BEGIN SLIDES LIST -->
                <ul>
                    <!-- SLIDE 1 -->
                    <li data-transition="fade" class="slide" data-title=''>
 
                        <!-- SLIDE'S MAIN BACKGROUND IMAGE -->
                        <img class="rev-slidebg" alt='' src="<?php echo base_url(); ?>images/slides/gdkl.jpg">

               <div class="tp-caption slide__name margin-slider" 
                             data-x="right" 
                             data-y="80"
                             data-frames='[{
                               "delay":300,
                               "split":"chars",
                               "splitdelay":0.1,
                               "speed":700,
                               "frame":"0",
                               "from":"x:[-100%];opacity:0;",
                               "mask":"x:0px;y:0px;s:inherit;e:inherit;",
                               "to":"o:1;",
                               "ease":"Power4.easeInOut"
                               },{
                               "delay":"wait",
                               "speed":300,
                               "frame":"999",
                               "to":"opacity:0;",
                               "ease":"Power3.easeInOut"
                             }]' style="font-size: 25px;">
                            
                            
                        </div>
    
                        <div class="tp-caption n slide__time margin-slider" 
                            data-x="right" 
                            data-hoffset='250' 
                            data-y="186" 
                            data-frames='[{
                               "delay":1200,
                               "speed":300,
                               "frame":"0",
                               "from":"x:[50%];opacity:0;",
                               "to":"o:1;",
                               "ease":"Power3.easeInOut"
                               },{
                               "delay":"wait",
                               "speed":300,
                               "frame":"999",
                               "to":"opacity:0;",
                               "ease":"Power3.easeInOut"
                             }]'  style="font-size: 40px;">
                           <b></b>
                        </div>

                        <div class="tp-caption  slide__date margin-slider" 
                             data-x="right" 
                             data-hoffset='149' 
                             data-y="186" 
                             data-frames='[{

                               "delay":1700,
                               "speed":500,
                               "frame":"0",
                               "from":"y:100px;opacity:0;",
                               "to":"o:3;",
                               "ease":"Power3.easeInOut"
                               },{
                               "delay":"wait",
                               "speed":300,
                               "frame":"999",
                               "to":"opacity:0;",
                               "ease":"Power3.easeInOut"
                             }]' style="font-size: 50px;">
                          
                        </div>
                        <div class="tp-caption slide__time margin-slider" 
                             data-x="right" 
                             data-hoffset='120' 
                             data-y="186" 
                             data-frames='[{
                               "delay":1200,
                               "speed":300,
                               "frame":"0",
                               "from":"x:[50%];opacity:0;",
                               "to":"o:1;",
                               "ease":"Power3.easeInOut"
                               },{
                               "delay":"wait",
                               "speed":300,
                               "frame":"999",
                               "to":"opacity:0;",
                               "ease":"Power3.easeInOut"
                             }]'>
                             
                        </div>
                        <div class="tp-caption slide__date margin-slider" 
                             data-x="right" 
                             data-y="186" 
                             data-frames='[{
                               "delay":1700,
                               "speed":500,
                               "frame":"0",
                               "from":"y:100px;opacity:0;",
                               "to":"o:1;",
                               "ease":"Power3.easeInOut"
                               },{
                               "delay":"wait",
                               "speed":300,
                               "frame":"999",
                               "to":"opacity:0;",
                               "ease":"Power3.easeInOut"
                             }]'>
                           
                        </div>
                        <div class="tp-caption slide__text margin-slider text-right" 
                             data-x="right" 
                             data-y="250"
                             data-frames='[{
                               "delay":2300,
                               "speed":400,
                               "frame":"0",
                               "from":"y:100px;skX:50px;opacity:0;",
                               "to":"o:1;",
                               "ease":"Power3.easeInOut"
                               },{
                               "delay":"wait",
                               "speed":300,
                               "frame":"999",
                               "to":"opacity:0;",
                               "ease":"Power3.easeInOut"
                             }]'>
                            
                        </div>
                        <div class="tp-caption margin-slider" 
                             data-x="right" 
                             data-y="324"
                             data-frames='[{
                               "delay":2600,
                               "speed":400,
                               "frame":"0",
                               "from":"y:100px;opacity:0;",
                               "to":"o:1;",
                               "ease":"Power3.easeInOut"
                               },{
                               "delay":"wait",
                               "speed":300,
                               "frame":"999",
                               "to":"opacity:0;",
                               "ease":"Power3.easeInOut"
                             }]'>
                             
                        </div>
 
                    </li>
 
                    <!-- SLIDE 2 -->
                    <li data-transition="fade" class="slide" data-title=''>
 
                        <!-- SLIDE'S MAIN BACKGROUND IMAGE -->
                        <img class="rev-slidebg" alt='' src="<?php echo base_url(); ?>images/slides/pos.png">
                        <div class="rs-background-video-layer" 
                             data-forcerewind="on" 
                             data-volume="mute" 
                             data-videowidth="100%" 
                             data-videoheight="100%" 
                             data-videomp4="video/TravelIs.mp4" 
                             data-videopreload="auto" 
                             data-videoloop="loop" 
                             data-forceCover="1" 
                             data-aspectratio="16:9" 
                             data-autoplay="true" 
                             data-autoplayonlyfirsttime="false" 
                        ></div>
                        <div class="tp-caption slide__name slide__name--smaller" 
                             data-x="center" 
                             data-y="160" 

                             data-splitin="chars"
                             data-elementdelay="0.1"

                             data-speed="700" 
                             data-start="1400" 
                             data-easing="easeOutBack"

                             data-frames='[{
                               "delay":1400,
                               "speed":700,
                               "split":"chars",
                               "splitdelay":0.1,
                               "frame":"0",
                               "from":"opacity:0;",
                               "to":"o:1;",
                               "ease":"Power3.easeInOut"
                               },{
                               "delay":"wait",
                               "speed":300,
                               "frame":"999",
                               "to":"opacity:0;",
                               "ease":"Power3.easeInOut"
                             }]'>
                        
                        </div>
                       <div style="margin-right: 30px;"> <div  class="tp-caption slide__time" 
                             data-x="center"
                             data-hoffset='-115' 
                             data-y="242" 
                             data-frames='[{
                               "delay":1800,
                               "speed":300,
                               "frame":"0",
                               "from":"x:[50%];opacity:0;",
                               "to":"o:1;",
                               "ease":"Power3.easeInOut"
                               },{
                               "delay":"wait",
                               "speed":300,
                               "frame":"999",
                               "to":"opacity:0;",
                               "ease":"Power3.easeInOut"
                             }]'>
                             
                          
                        </div>
                        <div style="margin-right: 5px;" class="tp-caption slide__date position-center postion-place--two lfb ltb" 
                             data-x="center"                              
                             data-hoffset='-50'                                       
                             data-y="242" 
                             data-frames='[{
                               "delay":2200,
                               "speed":500,
                               "frame":"0",
                               "from":"y:100px;opacity:0;",
                               "to":"o:1;",
                               "ease":"Power3.easeInOut"
                               },{
                               "delay":"wait",
                               "speed":300,
                               "frame":"999",
                               "to":"opacity:0;",
                               "ease":"Power3.easeInOut"
                             }]'>
                             
                             
                        </div>
                        <div class="tp-caption slide__time" 
                             data-x="center" 
                             data-hoffset='5' 
                             data-y="242" 
                             data-frames='[{
                               "delay":1800,
                               "speed":300,
                               "frame":"0",
                               "from":"x:[50%];opacity:0;",
                               "to":"o:1;",
                               "ease":"Power3.easeInOut"
                               },{
                               "delay":"wait",
                               "speed":300,
                               "frame":"999",
                               "to":"opacity:0;",
                               "ease":"Power3.easeInOut"
                             }]'>
                            
                        </div>
                        <div class="tp-caption slide__date" 
                             data-x="center"                              
                             data-hoffset='60'
                             data-y="242" 
                             data-frames='[{
                               "delay":2200,
                               "speed":500,
                               "frame":"0",
                               "from":"y:100px;opacity:0;",
                               "to":"o:1;",
                               "ease":"Power3.easeInOut"
                               },{
                               "delay":"wait",
                               "speed":300,
                               "frame":"999",
                               "to":"opacity:0;",
                               "ease":"Power3.easeInOut"
                             }]'>
                            
                        </div></div>

                        <div class="tp-caption slider-wrap-btn" 
                             data-x="center"
                             data-y="310" 
                             data-frames='[{
                               "delay":2800,
                               "speed":400,
                               "frame":"0",
                               "from":"y:100px;opacity:0;",
                               "to":"o:1;",
                               "ease":"Power3.easeInOut"
                               },{
                               "delay":"wait",
                               "speed":300,
                               "frame":"999",
                               "to":"opacity:0;",
                               "ease":"Power3.easeInOut"
                             }]'>
                            
                             <a href="#" class="btn btn-md btn--danger btn--wide slider--btn">xem thêm</a>
                        </div>
                    </li>

                    <!-- SLIDE 3 -->
                    <li data-transition="fade" class="slide" data-title=''>
 
                        <!-- SLIDE'S MAIN BACKGROUND IMAGE -->
                        <img class="rev-slidebg" alt='' src="<?php echo base_url(); ?>images/slides/choden.jpg  ">
                        <div class="tp-caption slide__name slide__name--smaller slide__name--specific" 
                          data-x="center" 
                          data-y="160" 
                          data-frames='[{
                               "delay":1400,
                               "speed":700,
                               "frame":"0",
                               "from":"y:[100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;opacity:0;",
                               "mask":"x:0px;y:[100%];s:inherit;e:inherit;",
                               "to":"o:1;",
                               "ease":"Power3.easeInOut"
                               },{
                               "delay":"wait",
                               "speed":300,
                               "frame":"999",
                               "to":"opacity:0;",
                               "ease":"Power3.easeInOut"
                             }]'>
                           
                        </div>

                        <div class="tp-caption slide__descript" 
                            data-x="center" 
                            data-y="240"
                            data-frames='[{
                               "delay":2000,
                               "speed":500,
                               "frame":"0",
                               "from":"y:[100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;opacity:0;",
                               "mask":"x:0px;y:[100%];s:inherit;e:inherit;",
                               "to":"o:1;",
                               "ease":"Power3.easeInOut"
                               },{
                               "delay":"wait",
                               "speed":300,
                               "frame":"999",
                               "to":"opacity:0;",
                               "ease":"Power3.easeInOut"
                             }]'>
                            
                        </div>

                        <div class="tp-caption slider-wrap-btn" 
                            data-x="center" 
                            data-y="310" 
                            data-frames='[{
                               "delay":2500,
                               "speed":500,
                               "frame":"0",
                               "from":"y:[100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;opacity:0;",
                               "mask":"x:0px;y:[100%];s:inherit;e:inherit;",
                               "to":"o:1;",
                               "ease":"Power3.easeInOut"
                               },{
                               "delay":"wait",
                               "speed":300,
                               "frame":"999",
                               "to":"opacity:0;",
                               "ease":"Power3.easeInOut"
                             }]'>
                            <a href="#" class="btn btn-md btn--danger slider--btn">ĐẶT VÉ</a>
                        </div>
                    </li>

 
                </ul><!-- END SLIDES LIST -->
 
            </div><!-- END SLIDER CONTAINER -->
 
        </div><!-- END SLIDER CONTAINER WRAPPER -->
        <!--end slider -->
        
        
        <!-- Main content -->
        <section class="container">
            <div class="movie-best">
                 <div class="row">
                     <div class="col-sm-10 col-sm-offset-1 movie-best__rating">Today Best choice</div>
                 </div>
                 <div class="row">
                     <div class="col-sm-12 change--col">
                     <div class="movie-beta__item ">
                        <img alt='' src="<?php echo base_url(); ?>images/movie/acquai.jpg">
                         <span class="best-rate">5.0</span>

                       <!--  <ul class="movie-beta__info">
                             <li><span class="best-voted">71 people voted today</span></li>
                             <li>
                                <p class="movie__time">169 min</p>
                                <p>Adventure | Drama | Fantasy </p>
                                <p>38 comments</p>
                             </li>
                             <li class="last-block">
                                 <a href="movie-page-left.html" class="slide__link">more</a>
                             </li>
                         </ul>-->
                     </div>
                     <div class="movie-beta__item second--item">
                         <img alt='' src="<?php echo base_url(); ?>images/movie/bongdts.jpg">
                         <span class="best-rate">5.0</span>

                        <!-- <ul class="movie-beta__info">
                             <li><span class="best-voted">71 people voted today</span></li>
                             <li>
                                <p class="movie__time">169 min</p>
                                <p>Adventure | Drama | Fantasy </p>
                                <p>38 comments</p>
                             </li>
                             <li class="last-block">
                                 <a href="movie-page-left.html" class="slide__link">more</a>
                             </li>
                         </ul>-->
                     </div>
                     <div class="movie-beta__item third--item">
                         <img alt='' src="<?php echo base_url(); ?>images/movie/black.jpg">
                         <span class="best-rate">5.0</span>

                        <!-- <ul class="movie-beta__info">
                             <li><span class="best-voted">71 people voted today</span></li>
                             <li>
                                <p class="movie__time">169 min</p>
                                <p>Adventure | Drama | Fantasy </p>
                                <p>38 comments</p>
                             </li>
                             <li class="last-block">
                                 <a href="movie-page-left.html" class="slide__link">more</a>
                             </li>
                         </ul>-->
                     </div>
                     <div class="movie-beta__item hidden-xs">
                         <img alt='' src="<?php echo base_url(); ?>images/movie/avatar.jpg">
                         <span class="best-rate">5.0</span>

                       <!--  <ul class="movie-beta__info">
                             <li><span class="best-voted">71 people voted today</span></li>
                             <li>
                                <p class="movie__time">169 min</p>
                                <p>Adventure | Drama | Fantasy </p>
                                <p>38 comments</p>
                             </li>
                             <li class="last-block">
                                 <a href="movie-page-left.html" class="slide__link">more</a>
                             </li>
                         </ul>-->
                     </div>
                     <div class="movie-beta__item hidden-xs hidden-sm">
                         <img alt='' src="<?php echo base_url(); ?>images/movie/cogdtqk.jpg">
                         <span class="best-rate">5.0</span>

                       <!--  <ul class="movie-beta__info">
                             <li><span class="best-voted">71 people voted today</span></li>
                             <li>
                                <p class="movie__time">169 min</p>
                                <p>Adventure | Drama | Fantasy </p>
                                <p>38 comments</p>
                             </li>
                             <li class="last-block">
                                 <a href="movie-page-left.html" class="slide__link">more</a>
                             </li>
                         </ul>-->
                     </div>
                     <div class="movie-beta__item hidden-xs hidden-sm">
                         <img alt='' src="<?php echo base_url(); ?>images/movie/cntsoj.jpg">
                         <span class="best-rate">5.0</span>

                        <!-- <ul class="movie-beta__info">
                             <li><span class="best-voted">71 people voted today</span></li>
                             <li>
                                <p class="movie__time">169 min</p>
                                <p>Adventure | Drama | Fantasy </p>
                                <p>38 comments</p>
                             </li>
                             <li class="last-block">
                                 <a href="movie-page-left.html" class="slide__link">more</a>
                             </li>
                         </ul>-->
                     </div>
                 </div>
                 </div>
                <div class="row">
                    <div class="col-sm-10 col-sm-offset-1 movie-best__check">check all movies now playing</div>
                </div>
            </div>

            
            <div class="clearfix"></div>

            <h2 id='target' class="page-heading heading--outcontainer">PHIM ĐANG CHIẾU</h2>

            <div class="col-sm-12">
                <div class="row">
                    <div class="col-sm-8 col-md-9">
                        
                        <!-- Movie variant with time -->
                            <?php foreach ($dulieuPhimDCcon as $key => $value): ?>
                                <div class="movie movie--test movie--test--dark movie--test--left">
                                <div class="movie__images">
                                    <a href="movie-page-left.html" class="movie-beta__link">
                                        <img alt='' src="<?php echo $value['poster'] ?>">
                                    </a>
                                </div>

                                <div class="movie__info">
                                    <a href="../index.php/Movie_page_controller/showinfophim/<?php echo $value['id'] ?>" class="movie__title link--huge"><?php echo $value['title'] ?></a>

                                    <p class="movie__time"><?php echo $value['duration'] ?></p>

                                    <p class="movie__option"><a href="#">Thể loại</a> | <a href="#"><?php echo $value['category'] ?></a> | <a href="#"></a></p>
                                    <p></p>
                                    
                                    
                                    <div class="movie__rate">
                                        <!-- <div class="score"></div> -->
                                        <span class="movie__rating">4.1</span>
                                    </div>               
                                </div>
                            </div>
                            <?php endforeach ?>
                         <!-- Movie variant with time -->



                        <!-- <div class="row">
                            <div class="social-group">
                             

                                <div class="col-sm-6 col-md-4 col-sm-pull-6 col-md-pull-4" style="margin-left: 300px;">
                                     <div class="facebook-group">

                                        <iframe src="https://www.facebook.com/plugins/page.php?href=https%3A%2F%2Fwww.facebook.com%2Fenvato&tabs=timeline&width=240px&height=330px&small_header=true&adapt_container_width=true&hide_cover=false&show_facepile=false&appId=353861661473733" width="240px" height="330px" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowTransparency="true"></iframe>
                                    </div>
                                </div>
                                
                            </div>
                        </div> -->
                    </div>

                    <aside class="col-sm-4 col-md-3">
                        <div class="sitebar first-banner--left">
                            <div class="banner-wrap first-banner--left">
                            <img alt='banner' src="<?php echo base_url(); ?>images/banners/q2.jpg">
                                
                            </div>

                             <div class="banner-wrap">
                             <img alt='banner' src="<?php echo base_url(); ?>images/banners/q1.jpg">
                            </div>

                             

                            <div class="promo marginb-sm">
                              <div class="promo__head">v-star app</div>
                              <div class="promo__describe">for all smartphones<br> and tablets</div>
                              <div class="promo__content">
                                  <ul>
                                      <li class="store-variant"><a href="#"><img alt='' src="<?php echo base_url(); ?>images/apple-store.svg"></a></li>
                                      <li class="store-variant"><a href="#"><img alt='' src="<?php echo base_url(); ?>images/google-play.svg"></a></li>
                                      <li class="store-variant"><a href="#"><img alt='' src="<?php echo base_url(); ?>images/windows-store.svg"></a></li>
                                  </ul>
                              </div>
                          </div>
    
                        </div>
                    </aside>
                </div>
            </div>

           
           
                
        </section>
        
        <div class="clearfix"></div>

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
        <script>window.jQuery || document.write('<script src="<?php echo base_url(); ?>js/external/jquery-3.1.1.min.js"><\/script>')</script>
        <!-- Migrate --> 
        <script src="<?php echo base_url(); ?>js/external/jquery-migrate-1.2.1.min.js"></script>
        <!-- Bootstrap 3--> 
        <script src="http://netdna.bootstrapcdn.com/bootstrap/3.0.2/js/bootstrap.min.js"></script>

        <!-- Slider Revolution core JavaScript files -->
        <script type="text/javascript" src="<?php echo base_url(); ?>revolution/js/jquery.themepunch.tools.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>revolution/js/jquery.themepunch.revolution.min.js"></script>

        <!-- Slider Revolution extension scripts. --> 
        <script type="text/javascript" src="<?php echo base_url(); ?>revolution/js/extensions/revolution.extension.actions.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>revolution/js/extensions/revolution.extension.carousel.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>revolution/js/extensions/revolution.extension.kenburn.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>revolution/js/extensions/revolution.extension.layeranimation.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>revolution/js/extensions/revolution.extension.migration.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>revolution/js/extensions/revolution.extension.navigation.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>revolution/js/extensions/revolution.extension.parallax.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>revolution/js/extensions/revolution.extension.slideanims.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>revolution/js/extensions/revolution.extension.video.min.js"></script>

        <!-- Mobile menu -->
        <script src="<?php echo base_url(); ?>js/jquery.mobile.menu.js"></script>
         <!-- Select -->
        <script src="<?php echo base_url(); ?>js/external/jquery.selectbox-0.2.min.js"></script>
        <!-- Stars rate -->
        <script src="<?php echo base_url(); ?>js/external/jquery.raty.js"></script>
        
        <!-- Form element -->
        <script src="<?php echo base_url(); ?>js/external/form-element.js"></script>
        <!-- Form validation -->
        <script src="<?php echo base_url(); ?>js/form.js"></script>

        <!-- Twitter feed -->
        <script src="<?php echo base_url(); ?>js/external/twitterfeed.js"></script>

        <!-- Custom -->
        <script src="<?php echo base_url(); ?>js/custom.js"></script>
        
          <script type="text/javascript">
              $(document).ready(function() {
                init_Home();
                
                // Đảm bảo các khối phim có cùng độ cao
                function equalizeMovieHeights() {
                    var $movies = $('.movie--test');
                    if ($movies.length === 0) return;
                    
                    // Reset height
                    $movies.css('height', 'auto');
                    
                    // Nhóm các khối theo hàng (mỗi hàng có 2 khối với width: 50%)
                    var currentRow = [];
                    var currentTop = null;
                    var maxHeight = 0;
                    
                    $movies.each(function() {
                        var $this = $(this);
                        var top = $this.position().top;
                        
                        if (currentTop === null || Math.abs(top - currentTop) < 5) {
                            // Cùng hàng
                            currentRow.push($this);
                            currentTop = top;
                        } else {
                            // Hàng mới - set height cho hàng cũ
                            if (currentRow.length > 0) {
                                maxHeight = 0;
                                currentRow.forEach(function($item) {
                                    var height = $item.outerHeight();
                                    if (height > maxHeight) maxHeight = height;
                                });
                                currentRow.forEach(function($item) {
                                    $item.css('height', maxHeight + 'px');
                                });
                            }
                            // Bắt đầu hàng mới
                            currentRow = [$this];
                            currentTop = top;
                        }
                    });
                    
                    // Set height cho hàng cuối cùng
                    if (currentRow.length > 0) {
                        maxHeight = 0;
                        currentRow.forEach(function($item) {
                            var height = $item.outerHeight();
                            if (height > maxHeight) maxHeight = height;
                        });
                        currentRow.forEach(function($item) {
                            $item.css('height', maxHeight + 'px');
                        });
                    }
                }
                
                // Chạy khi trang load và khi resize
                equalizeMovieHeights();
                $(window).on('resize', function() {
                    setTimeout(equalizeMovieHeights, 100);
                });
              });
            </script>

</body>
</html>
