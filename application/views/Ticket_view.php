
<!doctype html>
    <html>
    <head>
       <!-- Basic Page Needs -->
       <meta charset="utf-8">
       <title>AMovie - Booking final</title>
       <meta name="description" content="A Template by Gozha.net">
       <meta name="keywords" content="HTML, CSS, JavaScript">
       <meta name="author" content="Gozha.net">
       
       <!-- Mobile Specific Metas-->
       <meta name="viewport" content="width=device-width, initial-scale=1.0">
       <meta content="telephone=no" name="format-detection">
       
       <!-- Fonts -->
       <!-- Font awesome - icon font -->
       <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
       <!-- Mono font -->
       <link href='http://fonts.googleapis.com/css?family=PT+Mono' rel='stylesheet' type='text/css'>
       <!-- Roboto -->
       <link href='http://fonts.googleapis.com/css?family=Roboto:400,700' rel='stylesheet' type='text/css'>
       
       <!-- Stylesheets -->
       <!-- jQuery UI --> 
       <link href="http://code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.css" rel="stylesheet">

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
    <div class="wrapper place-wrapper">
        <!-- Header section -->
        <?php require('header_view.php') ?>

<!-- Main content -->
<?php foreach ($dulieuvetucontroller as $valueve): ?>
<?php foreach ($dulieuusertucontroller as $valueuser): ?>


<section class="container">
    <div class="order-container">
        <div class="order">
            <img class="order__images" alt='' src="images/tickets.png">
            <p class="order__title">Cảm ơn <br><span class="order__descript">Bạn đã đặt trước thành công vé!</span></p>
        </div>

        <div class="ticket">
            <div class="ticket-position">
                <div class="ticket__indecator indecator--pre"><div class="indecator-text pre--text">online ticket</div> </div>
                <div class="ticket__inner">

                    <div class="ticket-secondary">
                        <span class="ticket__item">Ticket number <strong class="ticket__number">a126bym4</strong></span>
                        <span class="ticket__item">Thành viên: <strong class="ticket__number"><?= $valueuser['fullname']; ?></strong></span>
                        <span class="ticket__item ticket__date"><?= $valueve[4]; ?></span>
                        <span class="ticket__item ticket__time"><?= $valueve[5]; ?></span>
                        <span class="ticket__item">Rạp: <span class="ticket__cinema">V-STAR MEDIA</span></span>
                        <span class="ticket__item">Trung tâm giải trí Helio: <span class="ticket__hall">Tầng 1</span></span>
                        <span class="ticket__item ticket__price">Giá: <strong class="ticket__cost"><?= $valueve[1]; ?></strong></span>
                    </div>

                    <div class="ticket-primery">
                        <span class="ticket__item ticket__item--primery ticket__film">Phim<br><strong class="ticket__movie"><?= $valueve[3]; ?></strong></span>
                        <span class="ticket__item ticket__item--primery">Ghế: <span class="ticket__place"><?= $valueve[2]; ?></span></span>
                    </div>


                </div>
                <div class="ticket__indecator indecator--post"><div class="indecator-text post--text">online ticket</div></div>
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
<?php endforeach ?>
<?php endforeach ?>

<!-- JavaScript-->
<!-- jQuery 3.1.1--> 
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
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

    <!-- Form element -->
    <script src="<?php echo base_url(); ?>js/external/form-element.js"></script>
    <!-- Form validation -->
    <script src="<?php echo base_url(); ?>js/form.js"></script>
    
    <!-- Custom -->
    <script src="<?php echo base_url(); ?>js/custom.js"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            $('.top-scroll').parent().find('.top-scroll').remove();
        });
    </script>

</body>
</html>
