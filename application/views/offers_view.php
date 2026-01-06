<!doctype html>
<html>
<head>
    <!-- Basic Page Needs -->
        <meta charset="utf-8">
        <title>login</title>
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
    .chung{
        width: 850px;
        height: 300px;
   border: 2px solid rgb(210, 155, 155);
   border-radius: 10px;
   float: left; 
   margin-left: 200px;
    }
    .trai{
        width: 30%;
        float: left;
        border: 2px solid rgb(210, 155, 155);
        border-style:none solid none none;
        height: 300px;
       
    }
    .anh{
        width: 80px;
        height: 80px;
        margin-top: 15px;  
        margin-left: 85px;
        border: 2px solid rgb(210, 155, 155);
        border-radius: 50px;
    }
  
    .phai{
        width: 70%;
        float: right;
    
        
    }
  .form-input{
    border: 2px solid rgb(210, 155, 155);
    border-style:none none solid none ;

  }
   
</style>





    
</head>
<body>

     <div class="wrapper">
        <?php require('header_view.php') ?>

 
        <!-- Header section 
       


        
        <!-- Search bar -->
       
        
        <!-- Main content -->
        <section class="container">
            <div class="col-sm-12">
                 <h2 class="page-heading">khuyến mãi</h2>
                
                <div class="offers-block">
                     <p class="offer-place">Khuyến mãi ngập tràn</p>

                     <div class="col-xs-6 col-sm-4 col-md-3 offers-wrap">
                         <a href='#' class="offer offer--winter">
                            <div class="offer__head">
                                <p class="offer__name">Christmas<br></p>
                                <span class="offer__datail"> <br>  </span>
                             </div>
                             <p class="offer__full">Chúng tôi mở cửa cả ngày vào dịp Giáng sinh này!</p>
                         </a>
                     </div>

                     <div class="col-xs-6 col-sm-4 col-md-3 offers-wrap">
                         <a href='#' class="offer offer--family">
                            <div class="offer__head">
                                <p class="offer__name">VÉ đôi</p>
                             </div>
                             <p class="offer__full">Chỉ 90k với 2 vé khi thanh toán qua thẻ.</p>
                         </a>
                     </div>

                     <div class="col-xs-6 col-sm-4 col-md-3 offers-wrap">
                         <a href='#' class="offer offer--day">
                            <div class="offer__head">
                                <p class="offer__name">thứ tư<br> vui vẻ</p>
                             </div>
                             <p class="offer__full">Giảm tới 1/3 vé người lớn cả ngày, đăng ký ngay nào !</p>
                         </a>
                     </div>

                     <div class="col-xs-6 col-sm-4 col-md-3 offers-wrap">
                         <a href='#' class="offer offer--teen">
                            <div class="offer__head">
                                <p class="offer__name">tặng voucher</p>
                                <span class="offer__datail">25.11-15.12 </span>
                            </div>
                             
                             <p class="offer__full">Miễn phí 1 bắp và 1 nước. </p>
                         </a>
                     </div>

                     

                 </div>
</div>
        </section>
        
        <div class="clearfix"></div>

       
        <?php require('footer_view.php'); ?>
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