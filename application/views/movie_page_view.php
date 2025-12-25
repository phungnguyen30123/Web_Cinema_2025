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
                            <a href="#" class="watchlist list--photo" data-filter='media-photo'>photos</a>
                            <a href="#" class="watchlist list--video" data-filter='media-video'>videos</a>
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
                            <!-- <div class="swiper-slide media-video">
                                <a href='https://www.youtube.com/watch?v=Y5AehBA3IsE' class="movie__media-item ">
                                   <img alt='' src="<?php echo base_url(); ?>images/movie/movie-video1.jpg">
                               </a>
                           </div> -->

                           <!--Second Slide-->
                           <!-- <div class="swiper-slide media-video">
                            <a href='https://www.youtube.com/watch?v=Kb3ykVYvT4U' class="movie__media-item">
                                <img alt='' src="<?php echo base_url(); ?>images/movie/movie-video2.jpg">
                            </a>
                        </div> -->

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
                                    <a href="<?php echo base_url(); ?>index.php/seat_controller/index_seat/<?= $valuegio['id_calendar']; ?>" class="time-select-link" data-seat-url="<?php echo base_url(); ?>index.php/seat_controller/index_seat/<?= $valuegio['id_calendar']; ?>"><li class="time-select__item"><?= $valuegio['time']; ?></li></a>
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
                <?php 
                $id_movie = isset($dulieutucontroller[0]['id']) ? $dulieutucontroller[0]['id'] : 0;
                ?>
                <form id="comment-form" class="comment-form" method='post' action="<?php echo base_url(); ?>index.php/Movie_page_controller/submitComment">
                    <input type="hidden" name="id_movie" value="<?php echo $id_movie; ?>">
                    <textarea name="content" class="comment-form__text" placeholder='cho ý kiến của bạn tại đây' maxlength="250" required></textarea>
                    <!-- <label class="comment-form__info">250 characters left</label> -->
                    <button type='submit' class="btn btn-md btn--danger comment-form__btn">gửi</button>
                </form>

                <div class="comment-sets">
                    <?php if (!empty($binhluan_chuaxuly)): ?>
                        <?php foreach ($binhluan_chuaxuly as $binhluan): ?>
                            <div class="comment">
                                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 5px;">
                                    <div>
                                        <span class="comment__author" style="text-align: left; display: block; padding-left: 0 !important; margin-left: 0 !important;">
                                            <?php echo isset($binhluan['fullname']) && !empty($binhluan['fullname']) ? htmlspecialchars($binhluan['fullname']) : 'Người dùng'; ?>
                                        </span>
                                        <p class="comment__date" style="margin: 0;">
                                            <?php 
                                            // Hiển thị thời gian (ưu tiên updated_at nếu đã sửa)
                                            $displayDate = null;
                                            $isEdited = false;
                                            
                                            if (isset($binhluan['updated_at']) && isset($binhluan['created_at']) && 
                                                $binhluan['updated_at'] != $binhluan['created_at']) {
                                                $displayDate = new DateTime($binhluan['updated_at']);
                                                $isEdited = true;
                                            } elseif (isset($binhluan['created_at'])) {
                                                $displayDate = new DateTime($binhluan['created_at']);
                                            }
                                            
                                            if ($displayDate) {
                                                $now = new DateTime();
                                                $diff = $now->diff($displayDate);
                                                
                                                if ($diff->days == 0) {
                                                    echo 'hôm nay | ' . $displayDate->format('H:i');
                                                } elseif ($diff->days == 1) {
                                                    echo 'hôm qua | ' . $displayDate->format('H:i');
                                                } else {
                                                    echo $displayDate->format('d/m/Y | H:i');
                                                }
                                                
                                                if ($isEdited) {
                                                    echo ' <span style="color: #999; font-size: 11px; font-style: italic;">(đã sửa)</span>';
                                                }
                                            } else {
                                                echo 'Chưa có ngày';
                                            }
                                            ?>
                                        </p>
                        </div>

                                    <!-- Nút Sửa/Xóa (chỉ hiển thị nếu là bình luận của user hiện tại) -->
                                    <?php 
                                    $current_user_id = $this->session->userdata('id_user');
                                    if ($current_user_id && isset($binhluan['id_user']) && $binhluan['id_user'] == $current_user_id): 
                                    ?>
                                        <div class="comment-actions" style="display: flex; gap: 5px;">
                                            <button type="button" class="btn-edit-comment" data-comment-id="<?php echo $binhluan['id_comment']; ?>" style="background: transparent; color: #007bff; border: none; padding: 4px 8px; cursor: pointer; border-radius: 3px; font-size: 13px; transition: all 0.2s; display: inline-flex; align-items: center; justify-content: center; width: 28px; height: 28px;" title="Sửa">
                                                <i class="fa fa-pencil"></i>
                                            </button>
                                            <button type="button" class="btn-delete-comment" data-comment-id="<?php echo $binhluan['id_comment']; ?>" style="background: transparent; color: #dc3545; border: none; padding: 4px 8px; cursor: pointer; border-radius: 3px; font-size: 13px; transition: all 0.2s; display: inline-flex; align-items: center; justify-content: center; width: 28px; height: 28px;" title="Xóa">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </div>
                                    <?php endif; ?>
                    </div>

                                <?php if (isset($binhluan['da_dat_ve']) && $binhluan['da_dat_ve'] == 1): ?>
                                    <span class="comment__status" style="color: #ff6b6b; font-size: 12px; font-style: italic; display: block; margin-bottom: 5px;">Đã đặt vé xem phim này</span>
                                <?php endif; ?>
                                
                                <!-- Nội dung bình luận (hiển thị) -->
                                <div class="comment-content-wrapper" id="comment-content-<?php echo $binhluan['id_comment']; ?>">
                                    <p class="comment__message"><?php echo htmlspecialchars($binhluan['content']); ?></p>
                                </div>
                                
                                <!-- Form sửa bình luận (ẩn) -->
                                <div class="comment-edit-wrapper" id="comment-edit-<?php echo $binhluan['id_comment']; ?>" style="display: none; margin-top: 10px; padding: 12px; background: #f8f9fa; border-radius: 6px; border: 1px solid #e0e0e0;">
                                    <form class="comment-edit-form" data-comment-id="<?php echo $binhluan['id_comment']; ?>" onsubmit="return false;">
                                        <textarea class="comment-form__text" name="content" maxlength="250" required style="width: 100%; min-height: 80px; padding: 8px; border: 1px solid #ddd; border-radius: 4px; font-size: 14px; font-family: inherit; resize: vertical; box-sizing: border-box;"><?php echo htmlspecialchars($binhluan['content']); ?></textarea>
                                        <!-- <label class="comment-form__info" style="display: block; margin-top: 5px; font-size: 12px; color: #666;">250 characters left</label> -->
                                        <div style="margin-top: 10px; display: flex; gap: 8px; justify-content: flex-end;">
                                            <button type="button" class="btn-cancel-edit" data-comment-id="<?php echo $binhluan['id_comment']; ?>" style="background: #6c757d; color: white; border: none; padding: 6px 16px; cursor: pointer; border-radius: 4px; font-size: 13px; transition: all 0.2s;">Hủy</button>
                                            <button type="button" class="btn-save-comment" data-comment-id="<?php echo $binhluan['id_comment']; ?>" onclick="saveCommentAjax(<?php echo $binhluan['id_comment']; ?>); return false;" style="background: #dc3545; color: white; border: none; padding: 6px 16px; cursor: pointer; border-radius: 4px; font-size: 13px; transition: all 0.2s;">Lưu</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <div class="comment">
                            <p class="comment__message" style="text-align: center; color: #999; padding: 20px;">
                                Chưa có bình luận nào.
                            </p>
                        </div>
                    <?php endif; ?>

                    <!-- <div class="comment-more">
                        <a href="#" class="watchlist">nhiều bình luận hơn</a>
                    </div> -->

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
        console.log('=== SCRIPT LOADING ===');
        console.log('jQuery available:', typeof jQuery !== 'undefined');
        console.log('jQuery version:', typeof jQuery !== 'undefined' ? jQuery.fn.jquery : 'N/A');
        
        // Function để save comment bằng AJAX (có thể gọi từ inline onclick)
        window.saveCommentAjax = function(commentId) {
            console.log('=== saveCommentAjax FUNCTION CALLED ===');
            console.log('Comment ID:', commentId);
            
            if (typeof jQuery === 'undefined') {
                alert('jQuery chưa được load. Vui lòng reload trang.');
                return false;
            }
            
            var $btn = $('.btn-save-comment[data-comment-id="' + commentId + '"]');
            console.log('Button found:', $btn.length);
            
            if ($btn.length === 0) {
                alert('Không tìm thấy nút Lưu');
                return false;
            }
            
            var $form = $btn.closest('.comment-edit-form');
            console.log('Form found:', $form.length);
            
            var $textarea = $form.find('textarea[name="content"]');
            console.log('Textarea found:', $textarea.length);
            
            var content = $textarea.length > 0 ? $textarea.val().trim() : '';
            console.log('Content:', content);
            console.log('Content length:', content.length);
            
            // Validate
            if (!commentId) {
                alert('Lỗi: Không tìm thấy ID bình luận');
                return false;
            }
            
            if (!content) {
                alert('Vui lòng nhập nội dung bình luận');
                if ($textarea.length) $textarea.focus();
                return false;
            }
            
            if (content.length > 250) {
                alert('Nội dung bình luận không được vượt quá 250 ký tự');
                return false;
            }
            
            // Disable button để tránh double submit
            var originalText = $btn.text();
            $btn.prop('disabled', true).text('Đang lưu...');
            
            // Gửi AJAX request
            var ajaxUrl = '<?php echo base_url(); ?>index.php/Movie_page_controller/updateCommentAjax';
            console.log('AJAX URL:', ajaxUrl);
            console.log('Sending AJAX request...');
            
            $.ajax({
                url: ajaxUrl,
                type: 'POST',
                data: {
                    id_comment: commentId,
                    content: content
                },
                dataType: 'json',
                timeout: 10000,
                success: function(response, textStatus, xhr) {
                    console.log('=== AJAX SUCCESS ===');
                    console.log('Response:', response);
                    console.log('Response type:', typeof response);
                    
                    $btn.prop('disabled', false).text(originalText);
                    
                    // Kiểm tra response
                    if (response && typeof response === 'object' && response.success === true) {
                        console.log('Response is valid, updating UI...');
                        
                        // Cập nhật nội dung bình luận trên trang
                        var $contentDiv = $('#comment-content-' + commentId);
                        var $messageP = $contentDiv.find('.comment__message');
                        
                        if ($messageP.length) {
                            $messageP.text(content);
                            console.log('Content updated in DOM');
                        }
                        
                        // Cập nhật thời gian và thêm "đã sửa" nếu có updated_at
                        if (response.updated_at) {
                            var $commentDiv = $contentDiv.closest('.comment');
                            var $dateP = $commentDiv.find('.comment__date');
                            if ($dateP.length) {
                                // Parse date từ string (format: YYYY-MM-DD HH:mm:ss)
                                // Giả sử server trả về thời gian theo timezone Việt Nam (UTC+7)
                                var dateStr = response.updated_at;
                                var dateParts = dateStr.split(' ');
                                var datePart = dateParts[0].split('-');
                                var timePart = dateParts[1].split(':');
                                
                                // Tạo date object với timezone local, nhưng dùng giá trị từ server
                                // Nếu server trả về UTC, cần cộng thêm 7 giờ (UTC+7)
                                var serverHours = parseInt(timePart[0]);
                                var serverMinutes = parseInt(timePart[1]);
                                var serverSeconds = parseInt(timePart[2] || 0);
                                
                                // Tạo date object với giá trị từ server (coi như đã là giờ địa phương)
                                var updatedDate = new Date(
                                    parseInt(datePart[0]),      // year
                                    parseInt(datePart[1]) - 1,  // month (0-based)
                                    parseInt(datePart[2]),      // day
                                    serverHours,                // hours (dùng trực tiếp từ server)
                                    serverMinutes,              // minutes
                                    serverSeconds              // seconds
                                );
                                
                                var now = new Date();
                                var diffMs = now - updatedDate;
                                var diffDays = Math.floor(diffMs / (1000 * 60 * 60 * 24));
                                
                                // Dùng giá trị từ server trực tiếp thay vì getHours() để tránh timezone issue
                                var hours = ('0' + serverHours).slice(-2);
                                var minutes = ('0' + serverMinutes).slice(-2);
                                
                                var displayDateStr = '';
                                if (diffDays === 0) {
                                    displayDateStr = 'hôm nay | ' + hours + ':' + minutes;
                                } else if (diffDays === 1) {
                                    displayDateStr = 'hôm qua | ' + hours + ':' + minutes;
                                } else {
                                    var day = ('0' + parseInt(datePart[2])).slice(-2);
                                    var month = ('0' + parseInt(datePart[1])).slice(-2);
                                    displayDateStr = day + '/' + month + '/' + datePart[0] + ' | ' + hours + ':' + minutes;
                                }
                                
                                $dateP.html(displayDateStr + ' <span style="color: #999; font-size: 11px; font-style: italic;">(đã sửa)</span>');
                                console.log('Date updated with "đã sửa":', displayDateStr, 'Original:', response.updated_at);
                            }
                        }
                        
                        // Ẩn form edit, hiển thị nội dung
                        var $editDiv = $('#comment-edit-' + commentId);
                        if ($editDiv.length) {
                            $editDiv.slideUp(200);
                        }
                        
                        if ($contentDiv.length) {
                            $contentDiv.slideDown(200);
                        }
                    } else {
                        var errorMsg = 'Có lỗi xảy ra khi cập nhật bình luận';
                        if (response && response.message) {
                            errorMsg = response.message;
                        }
                        console.error('Response indicates failure:', response);
                        alert(errorMsg);
                    }
                },
                error: function(xhr, status, error) {
                    console.error('=== AJAX ERROR ===');
                    console.error('Status:', status);
                    console.error('Error:', error);
                    console.error('Status Code:', xhr.status);
                    console.error('Response Text:', xhr.responseText);
                    
                    $btn.prop('disabled', false).text(originalText);
                    
                    var errorMsg = 'Có lỗi xảy ra khi cập nhật bình luận. Vui lòng thử lại.';
                    try {
                        if (xhr.responseText) {
                            var errorResponse = JSON.parse(xhr.responseText);
                            if (errorResponse && errorResponse.message) {
                                errorMsg = errorResponse.message;
                            }
                        }
                    } catch (e) {
                        console.error('Error parsing response:', e);
                    }
                    
                    alert(errorMsg);
                }
            });
            
            return false;
        };
        
        $(document).ready(function() {
            console.log('=== DOCUMENT READY ===');
            init_MoviePage();
            init_MoviePageFull();
            
            // Test: Kiểm tra button sau 1 giây
            setTimeout(function() {
                var testBtn = $('.btn-save-comment');
                console.log('=== BUTTON CHECK (after 1s) ===');
                console.log('Found .btn-save-comment buttons:', testBtn.length);
                if (testBtn.length > 0) {
                    console.log('First button HTML:', testBtn.first()[0].outerHTML);
                    console.log('First button data-comment-id:', testBtn.first().attr('data-comment-id'));
                    console.log('First button data-comment-id (data):', testBtn.first().data('comment-id'));
                } else {
                    console.warn('No .btn-save-comment buttons found!');
                }
            }, 1000);
            
            // Đếm ký tự trong textarea bình luận (form gửi mới)
            // Tạm comment
            /*
            $('#comment-form .comment-form__text').on('input', function() {
                var length = $(this).val().length;
                var remaining = 250 - length;
                $('#comment-form .comment-form__info').text(remaining + ' characters left');
                
                if (remaining < 0) {
                    $('#comment-form .comment-form__info').css('color', '#ff6b6b');
                } else {
                    $('#comment-form .comment-form__info').css('color', '');
                }
            });
            */
            
            // Đếm ký tự trong textarea form sửa
            // Tạm comment
            /*
            $(document).on('input', '.comment-edit-form .comment-form__text', function() {
                var length = $(this).val().length;
                var remaining = 250 - length;
                var form = $(this).closest('.comment-edit-form');
                form.find('.comment-form__info').text(remaining + ' characters left');
                
                if (remaining < 0) {
                    form.find('.comment-form__info').css('color', '#ff6b6b');
                } else {
                    form.find('.comment-form__info').css('color', '');
                }
            });
            */
            
            // Xử lý nút Lưu bằng AJAX - Đặt trong document.ready
            $(document).on('click', '.btn-save-comment', function(e) {
                console.log('=== BUTTON CLICKED ===');
                console.log('Event type:', e.type);
                console.log('Target:', e.target);
                console.log('Current Target:', e.currentTarget);
                console.log('This:', this);
                
                e.preventDefault();
                e.stopPropagation();
                e.stopImmediatePropagation();
                
                var $btn = $(this);
                console.log('Button jQuery object:', $btn);
                console.log('Button length:', $btn.length);
                console.log('Button HTML:', $btn[0] ? $btn[0].outerHTML : 'N/A');
                
                // Lấy comment ID bằng nhiều cách
                var commentIdAttr = $btn.attr('data-comment-id');
                var commentIdData = $btn.data('comment-id');
                var commentId = commentIdAttr || commentIdData;
                
                console.log('Comment ID from attr:', commentIdAttr);
                console.log('Comment ID from data():', commentIdData);
                console.log('Final Comment ID:', commentId);
                
                var $form = $btn.closest('.comment-edit-form');
                console.log('Form found:', $form.length);
                console.log('Form HTML:', $form.length > 0 ? $form[0].outerHTML.substring(0, 100) : 'N/A');
                
                var $textarea = $form.find('textarea[name="content"]');
                console.log('Textarea found:', $textarea.length);
                
                var content = $textarea.length > 0 ? $textarea.val().trim() : '';
                console.log('=== SAVE COMMENT AJAX ===');
                console.log('Comment ID:', commentId);
                console.log('Content:', content);
                console.log('Content length:', content.length);
                
                // Validate
                if (!commentId) {
                    alert('Lỗi: Không tìm thấy ID bình luận');
                    return false;
                }
                
                if (!content) {
                    alert('Vui lòng nhập nội dung bình luận');
                    $textarea.focus();
                    return false;
                }
                
                if (content.length > 250) {
                    alert('Nội dung bình luận không được vượt quá 250 ký tự');
                    return false;
                }
                
                // Disable button để tránh double submit
                var originalText = $btn.text();
                $btn.prop('disabled', true).text('Đang lưu...');
                
                // Gửi AJAX request
                var ajaxUrl = '<?php echo base_url(); ?>index.php/Movie_page_controller/updateCommentAjax';
                console.log('AJAX URL:', ajaxUrl);
                console.log('AJAX Data:', {
                    id_comment: commentId,
                    content: content
                });
                
                $.ajax({
                    url: ajaxUrl,
                    type: 'POST',
                    data: {
                        id_comment: commentId,
                        content: content
                    },
                    dataType: 'json',
                    timeout: 10000, // 10 seconds timeout
                    beforeSend: function(xhr) {
                        console.log('=== AJAX BEFORE SEND ===');
                        console.log('XHR:', xhr);
                    },
                    success: function(response, textStatus, xhr) {
                        console.log('=== AJAX SUCCESS ===');
                        console.log('Response:', response);
                        console.log('Response type:', typeof response);
                        console.log('Text Status:', textStatus);
                        console.log('XHR:', xhr);
                        console.log('Response success property:', response ? response.success : 'response is null/undefined');
                        
                        $btn.prop('disabled', false).text(originalText);
                        
                        // Kiểm tra response
                        if (response && typeof response === 'object' && response.success === true) {
                            console.log('Response is valid, updating UI...');
                            
                            // Cập nhật nội dung bình luận trên trang
                            var $contentDiv = $('#comment-content-' + commentId);
                            console.log('Content div found:', $contentDiv.length);
                            
                            var $messageP = $contentDiv.find('.comment__message');
                            console.log('Message paragraph found:', $messageP.length);
                            
                            if ($messageP.length) {
                                $messageP.text(content);
                                console.log('Content updated in DOM');
                            } else {
                                console.warn('Message paragraph not found!');
                            }
                            
                            // Ẩn form edit, hiển thị nội dung
                            var $editDiv = $('#comment-edit-' + commentId);
                            console.log('Edit div found:', $editDiv.length);
                            
                            if ($editDiv.length) {
                                $editDiv.slideUp(200, function() {
                                    console.log('Edit form hidden');
                                });
                            }
                            
                            if ($contentDiv.length) {
                                $contentDiv.slideDown(200, function() {
                                    console.log('Content div shown');
                                });
                            }
                        } else {
                            // Hiển thị lỗi từ server
                            var errorMsg = 'Có lỗi xảy ra khi cập nhật bình luận';
                            if (response && response.message) {
                                errorMsg = response.message;
                            } else if (typeof response === 'string') {
                                errorMsg = response;
                            }
                            console.error('Response indicates failure:', response);
                            alert(errorMsg);
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('=== AJAX ERROR ===');
                        console.error('XHR:', xhr);
                        console.error('Status:', status);
                        console.error('Error:', error);
                        console.error('Status Code:', xhr.status);
                        console.error('Response Text:', xhr.responseText);
                        console.error('Response Headers:', xhr.getAllResponseHeaders());
                        
                        $btn.prop('disabled', false).text(originalText);
                        
                        // Parse error response nếu có
                        var errorMsg = 'Có lỗi xảy ra khi cập nhật bình luận. Vui lòng thử lại.';
                        try {
                            if (xhr.responseText) {
                                var errorResponse = JSON.parse(xhr.responseText);
                                if (errorResponse && errorResponse.message) {
                                    errorMsg = errorResponse.message;
                                }
                            }
                        } catch (e) {
                            console.error('Error parsing response:', e);
                            // Nếu response không phải JSON, có thể là HTML error page
                            if (xhr.responseText && xhr.responseText.length < 200) {
                                errorMsg = 'Lỗi: ' + xhr.responseText.substring(0, 100);
                            }
                        }
                        
                        alert(errorMsg);
                    },
                    complete: function(xhr, status) {
                        console.log('=== AJAX COMPLETE ===');
                        console.log('Status:', status);
                        console.log('XHR readyState:', xhr.readyState);
                    }
                });
                
                return false;
            });
            
            // Ngăn form submit (backup)
            $(document).on('submit', '.comment-edit-form', function(e) {
                e.preventDefault();
                e.stopPropagation();
                e.stopImmediatePropagation();
                return false;
            });
            
            // Validate form trước khi submit
            $('#comment-form').on('submit', function(e) {
                var content = $('.comment-form__text').val().trim();
                
                if (!content) {
                    e.preventDefault();
                    alert('Vui lòng nhập nội dung bình luận');
                    return false;
                }
                
                if (content.length > 250) {
                    e.preventDefault();
                    alert('Nội dung bình luận không được vượt quá 250 ký tự');
                    return false;
                }
            });
            
            // Hiển thị thông báo flash nếu có
            <?php if ($this->session->flashdata('success_msg')): ?>
                alert('<?php echo $this->session->flashdata('success_msg'); ?>');
            <?php endif; ?>
            
            <?php if ($this->session->flashdata('error_msg')): ?>
                alert('<?php echo $this->session->flashdata('error_msg'); ?>');
            <?php endif; ?>
        });
        
        // Style cho nút Sửa/Xóa
        $('<style>')
            .prop('type', 'text/css')
            .html(`
                .btn-edit-comment:hover {
                    background: #007bff !important;
                    color: white !important;
                }
                .btn-delete-comment:hover {
                    background: #dc3545 !important;
                    color: white !important;
                }
            `)
            .appendTo('head');
        
        // Bind event handlers sau khi DOM sẵn sàng (dùng event delegation)
        // Đảm bảo jQuery đã load
        if (typeof jQuery !== 'undefined') {
            // Xử lý nút Sửa
            $(document).on('click', '.btn-edit-comment', function(e) {
                e.preventDefault();
                e.stopPropagation();
                e.stopImmediatePropagation();
                var $btn = $(this);
                var commentId = $btn.attr('data-comment-id') || $btn.data('comment-id');
                console.log('Edit clicked for comment:', commentId, 'Button:', $btn);
                
                if (!commentId) {
                    console.error('Comment ID not found');
                    alert('Lỗi: Không tìm thấy ID bình luận');
                    return false;
                }
                
                var $contentDiv = $('#comment-content-' + commentId);
                var $editDiv = $('#comment-edit-' + commentId);
                var $messageP = $contentDiv.find('.comment__message');
                
                if ($contentDiv.length && $editDiv.length) {
                    // Lấy nội dung hiện tại từ bình luận
                    var currentContent = $messageP.text().trim();
                    console.log('Current content:', currentContent);
                    
                    // Cập nhật nội dung vào textarea
                    var $textarea = $editDiv.find('textarea[name="content"]');
                    $textarea.val(currentContent);
                    
                    // Ẩn nội dung, hiển thị form edit
                    $contentDiv.hide();
                    $editDiv.show();
                    
                    // Đếm ký tự khi mở form edit
                    // Tạm comment
                    /*
                    var length = currentContent.length;
                    var remaining = 250 - length;
                    $editDiv.find('.comment-form__info').text(remaining + ' characters left');
                    */
                    
                    console.log('Form edit shown, content updated');
                } else {
                    console.error('Content or edit div not found', $contentDiv.length, $editDiv.length);
                }
            });
            
            // Xử lý nút Hủy
            $(document).on('click', '.btn-cancel-edit', function(e) {
                e.preventDefault();
                e.stopPropagation();
                e.stopImmediatePropagation();
                var $btn = $(this);
                var commentId = $btn.attr('data-comment-id') || $btn.data('comment-id');
                console.log('Cancel clicked for comment:', commentId);
                
                if (commentId) {
                    $('#comment-edit-' + commentId).hide();
                    $('#comment-content-' + commentId).show();
                }
            });
            
            // Xử lý nút Xóa
            $(document).on('click', '.btn-delete-comment', function(e) {
                e.preventDefault();
                e.stopPropagation();
                e.stopImmediatePropagation();
                var $btn = $(this);
                var commentId = $btn.attr('data-comment-id') || $btn.data('comment-id');
                console.log('Delete clicked for comment:', commentId);
                
                if (!commentId) {
                    alert('Lỗi: Không tìm thấy ID bình luận');
                    return false;
                }
                
                if (!confirm('Bạn có chắc chắn muốn xóa bình luận này?')) {
                    return false;
                }
                
                // Tạo form ẩn để submit
                var deleteForm = $('<form method="post" action="<?php echo base_url(); ?>index.php/Movie_page_controller/deleteComment" style="display:none;"></form>');
                deleteForm.append('<input type="hidden" name="id_comment" value="' + commentId + '">');
                $('body').append(deleteForm);
                deleteForm.submit();
            });
        } else {
            console.error('jQuery is not loaded');
        }

        // Kiểm tra đăng nhập trước khi chọn lịch chiếu
        var isLoggedIn = <?php echo $this->session->userdata('logged_in') ? 'true' : 'false'; ?>;
        
        // Xử lý click vào link lịch chiếu
        $(document).on('click', '.time-select-link', function(e) {
            if (!isLoggedIn) {
                e.preventDefault();
                e.stopPropagation();
                
                // Mở popup đăng nhập
                var modal = document.getElementById('authModal');
                if (modal) {
                    // Lưu URL đích để redirect sau khi đăng nhập thành công
                    var targetUrl = $(this).attr('data-seat-url');
                    if (targetUrl) {
                        sessionStorage.setItem('redirect_after_login', targetUrl);
                    }
                    
                    // Mở modal
                    var scrollPosition = window.pageYOffset || document.documentElement.scrollTop;
                    document.body.classList.add('modal-open');
                    document.body.style.top = '-' + scrollPosition + 'px';
                    modal.style.display = 'block';
                    
                    // Chuyển sang tab đăng nhập
                    var loginTab = document.getElementById('login-tab');
                    var registerTab = document.getElementById('register-tab');
                    if (loginTab && registerTab) {
                        loginTab.classList.add('active');
                        registerTab.classList.remove('active');
                    }
                } else {
                    // Nếu không có modal, redirect về trang chủ với tham số
                    window.location.href = '<?php echo base_url(); ?>index.php/Index_controller?show_login=1';
                }
                return false;
            }
            // Nếu đã đăng nhập, cho phép chuyển trang bình thường
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
