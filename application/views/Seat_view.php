
<!doctype html>
    <html>
    <head>
       <!-- Basic Page Needs -->
       <meta charset="utf-8">
       <title>AMovie - Booking step 2</title>
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
    <div class="wrapper place-wrapper">
        <!-- Banner -->
           <div class="banner-top">
        <img alt='top banner' src="<?php echo base_url(); ?>images/banner.png" style="height:90px; width:1600px">
    </div>
 <?php require('header_view.php') ?>

 


<!-- Main content -->
<?php foreach ($dulieulichtucontroller as $valuelich): ?>

<?php
   $daychuadoi = $valuelich["day"];
   $daydadoi = date("d/m/Y", strtotime($daychuadoi)); 
?>
<?php foreach ($dulieuseattucontroller as $valueghe): ?>
            <input type="hidden" name="ghedaban" class="ghedaban" value="<?= $valueghe[0]; ?>">
            <?php endforeach ?>

<div class="place-form-area">
    <section class="container">
        <div class="order-container">
            <div class="order">
                <img class="order__images" alt='' src="<?php echo base_url(); ?>images/tickets.png">
                <p class="order__title">ĐẶT VÉ<br><br>
                    <span class="order__descript"><strong>Phim: <?= $valuelich['title']; ?></strong><br><strong>Thời gian: <?= $daydadoi ?>, <?= $valuelich['time']; ?></strong></span>
                </p>

            </div>
        </div>
        <div class="order-step-area">
            <div class="order-step first--step order-step--disable ">Chọn lịch chiếu</div>
            <div class="order-step second--step">Chọn ghế</div>
        </div>

        <div class="choose-sits">
            <div class="choose-sits__info choose-sits__info--first">
                <ul>
                    <li class="sits-price marker--none"><strong>Giá vé</strong></li>
                    <li class="sits-price sits-price--cheap">55 000 đ</li>
                    <li class="sits-price sits-price--middle">70 000 đ</li>
                    <li class="sits-price sits-price--expensive">120 000 đ</li>
                </ul>
            </div>

            <div class="choose-sits__info">
                <ul>
                    <li class="sits-state sits-state--not">Không có sẵn</li>
                    <li class="sits-state sits-state--your">Lựa chọn của bạn</li>
                </ul>
            </div>

            <div class="col-sm-12 col-lg-10 col-lg-offset-1">
                <div class="sits-areboo">
                    <div class="sits-anchor">Màn hình</div>

                    <div class="sits">
                        <aside class="sits__line">
                            <span class="sits__indecator">A</span>
                            <span class="sits__indecator">B</span>
                            <span class="sits__indecator">C</span>
                            <span class="sits__indecator">D</span>
                            <span class="sits__indecator">E</span>
                            <span class="sits__indecator">F</span>
                            <span class="sits__indecator">G</span>
                            <span class="sits__indecator">I</span>
                            <span class="sits__indecator additional-margin">J</span>
                            <span class="sits__indecator">K</span>
                            <span class="sits__indecator">L</span>
                        </aside>

                        <div class="sits__row">
                            <span class="sits__place sits-price--cheap" data-place='A2' data-price='10'>A2</span>
                            <span class="sits__place sits-price--cheap" data-place='A3' data-price='10'>A3</span>
                            <span class="sits__place sits-price--cheap" data-place='A4' data-price='10'>A4</span>
                            <span class="sits__place sits-price--cheap" data-place='A5' data-price='10'>A5</span>
                            <span class="sits__place sits-price--cheap" data-place='A6' data-price='10'>A6</span>
                            <span class="sits__place sits-price--cheap" data-place='A7' data-price='10'>A7</span>
                            <span class="sits__place sits-price--cheap" data-place='A8' data-price='10'>A8</span>
                            <span class="sits__place sits-price--cheap" data-place='A9' data-price='10'>A9</span>
                            <span class="sits__place sits-price--cheap" data-place='A10' data-price='10'>A10</span>
                            <span class="sits__place sits-price--cheap" data-place='A11' data-price='10'>A11</span>
                            <span class="sits__place sits-price--cheap" data-place='A12' data-price='10'>A12</span>
                            <span class="sits__place sits-price--cheap" data-place='A13' data-price='10'>A13</span>
                            <span class="sits__place sits-price--cheap" data-place='A14' data-price='10'>A14</span>
                            <span class="sits__place sits-price--cheap" data-place='A15' data-price='10'>A15</span>
                            <span class="sits__place sits-price--cheap" data-place='A16' data-price='10'>A16</span>
                            <span class="sits__place sits-price--cheap" data-place='A17' data-price='10'>A17</span>
                        </div>

                        <div class="sits__row">
                            <span class="sits__place sits-price--cheap" data-place='B1' data-price='10'>B1</span>
                            <span class="sits__place sits-price--cheap" data-place='B2' data-price='10'>B2</span>
                            <span class="sits__place sits-price--cheap" data-place='B3' data-price='10'>B3</span>
                            <span class="sits__place sits-price--cheap" data-place='B4' data-price='10'>B4</span>
                            <span class="sits__place sits-price--cheap" data-place='B5' data-price='10'>B5</span>
                            <span class="sits__place sits-price--cheap" data-place='B6' data-price='10'>B6</span>
                            <span class="sits__place sits-price--cheap" data-place='B7' data-price='10'>B7</span>
                            <span class="sits__place sits-price--cheap" data-place='B8' data-price='10'>B8</span>
                            <span class="sits__place sits-price--cheap" data-place='B9' data-price='10'>B9</span>
                            <span class="sits__place sits-price--cheap" data-place='B10' data-price='10'>B10</span>
                            <span class="sits__place sits-price--cheap" data-place='B11' data-price='10'>B11</span>
                            <span class="sits__place sits-price--cheap" data-place='B12' data-price='10'>B12</span>
                            <span class="sits__place sits-price--cheap" data-place='B13' data-price='10'>B13</span>
                            <span class="sits__place sits-price--cheap" data-place='B14' data-price='10'>B14</span>
                            <span class="sits__place sits-price--cheap" data-place='B15' data-price='10'>B15</span>
                            <span class="sits__place sits-price--cheap" data-place='B16' data-price='10'>B16</span>
                            <span class="sits__place sits-price--cheap" data-place='B17' data-price='10'>B17</span>
                            <span class="sits__place sits-price--cheap" data-place='B18' data-price='10'>B18</span>
                        </div>

                        <div class="sits__row">
                            <span class="sits__place sits-price--cheap" data-place='C1' data-price='10'>C1</span>
                            <span class="sits__place sits-price--cheap" data-place='C2' data-price='10'>C2</span>
                            <span class="sits__place sits-price--cheap" data-place='C3' data-price='10'>C3</span>
                            <span class="sits__place sits-price--cheap" data-place='C4' data-price='10'>C4</span>
                            <span class="sits__place sits-price--cheap" data-place='C5' data-price='10'>C5</span>
                            <span class="sits__place sits-price--cheap" data-place='C6' data-price='10'>C6</span>
                            <span class="sits__place sits-price--cheap" data-place='C7' data-price='10'>C7</span>
                            <span class="sits__place sits-price--cheap" data-place='C8' data-price='10'>C8</span>
                            <span class="sits__place sits-price--cheap" data-place='C9' data-price='10'>C9</span>
                            <span class="sits__place sits-price--cheap" data-place='C10' data-price='10'>C10</span>
                            <span class="sits__place sits-price--cheap" data-place='C11' data-price='10'>C11</span>
                            <span class="sits__place sits-price--cheap" data-place='C12' data-price='10'>C12</span>
                            <span class="sits__place sits-price--cheap" data-place='C13' data-price='10'>C13</span>
                            <span class="sits__place sits-price--cheap" data-place='C14' data-price='10'>C14</span>
                            <span class="sits__place sits-price--cheap" data-place='C15' data-price='10'>C15</span>
                            <span class="sits__place sits-price--cheap" data-place='C16' data-price='10'>C16</span>
                            <span class="sits__place sits-price--cheap" data-place='C17' data-price='10'>C17</span>
                            <span class="sits__place sits-price--cheap" data-place='C18' data-price='10'>C18</span>
                        </div>

                        <div class="sits__row">
                            <span class="sits__place sits-price--cheap" data-place='D1' data-price='10'>D1</span>
                            <span class="sits__place sits-price--cheap" data-place='D2' data-price='10'>D2</span>
                            <span class="sits__place sits-price--cheap" data-place='D3' data-price='10'>D3</span>
                            <span class="sits__place sits-price--cheap" data-place='D4' data-price='10'>D4</span>
                            <span class="sits__place sits-price--cheap" data-place='D5' data-price='10'>D5</span>
                            <span class="sits__place sits-price--cheap" data-place='D6' data-price='10'>D6</span>
                            <span class="sits__place sits-price--cheap" data-place='D7' data-price='10'>D7</span>
                            <span class="sits__place sits-price--cheap" data-place='D8' data-price='10'>D8</span>
                            <span class="sits__place sits-price--cheap" data-place='D9' data-price='10'>D9</span>
                            <span class="sits__place sits-price--cheap" data-place='D10' data-price='10'>D10</span>
                            <span class="sits__place sits-price--cheap" data-place='D11' data-price='10'>D11</span>
                            <span class="sits__place sits-price--cheap" data-place='D12' data-price='10'>D12</span>
                            <span class="sits__place sits-price--cheap" data-place='D13' data-price='10'>D13</span>
                            <span class="sits__place sits-price--cheap" data-place='D14' data-price='10'>D14</span>
                            <span class="sits__place sits-price--cheap" data-place='D15' data-price='10'>D15</span>
                            <span class="sits__place sits-price--cheap" data-place='D16' data-price='10'>D16</span>
                            <span class="sits__place sits-price--cheap" data-place='D17' data-price='10'>D17</span>
                            <span class="sits__place sits-price--cheap" data-place='D18' data-price='10'>D18</span>
                        </div>

                        <div class="sits__row">
                            <span class="sits__place sits-price--middle" data-place='E1' data-price='20'>E1</span>
                            <span class="sits__place sits-price--middle" data-place='E2' data-price='20'>E2</span>
                            <span class="sits__place sits-price--middle" data-place='E3' data-price='20'>E3</span>
                            <span class="sits__place sits-price--middle" data-place='E4' data-price='20'>E4</span>
                            <span class="sits__place sits-price--middle" data-place='E5' data-price='20'>E5</span>
                            <span class="sits__place sits-price--middle" data-place='E6' data-price='20'>E6</span>
                            <span class="sits__place sits-price--middle" data-place='E7' data-price='20'>E7</span>
                            <span class="sits__place sits-price--middle" data-place='E8' data-price='20'>E8</span>
                            <span class="sits__place sits-price--middle" data-place='E9' data-price='20'>E9</span>
                            <span class="sits__place sits-price--middle" data-place='E10' data-price='20'>E10</span>
                            <span class="sits__place sits-price--middle" data-place='E11' data-price='20'>E11</span>
                            <span class="sits__place sits-price--middle" data-place='E12' data-price='20'>E12</span>
                            <span class="sits__place sits-price--middle" data-place='E13' data-price='20'>E13</span>
                            <span class="sits__place sits-price--middle" data-place='E14' data-price='20'>E14</span>
                            <span class="sits__place sits-price--middle" data-place='E15' data-price='20'>E15</span>
                            <span class="sits__place sits-price--middle" data-place='E16' data-price='20'>E16</span>
                            <span class="sits__place sits-price--middle" data-place='E17' data-price='20'>E17</span>
                            <span class="sits__place sits-price--middle" data-place='E18' data-price='20'>E18</span>
                        </div>

                        <div class="sits__row">
                            <span class="sits__place sits-price--middle" data-place='F1' data-price='20'>F1</span>
                            <span class="sits__place sits-price--middle" data-place='F2' data-price='20'>F2</span>
                            <span class="sits__place sits-price--middle" data-place='F3' data-price='20'>F3</span>
                            <span class="sits__place sits-price--middle" data-place='F4' data-price='20'>F4</span>
                            <span class="sits__place sits-price--middle" data-place='F5' data-price='20'>F5</span>
                            <span class="sits__place sits-price--middle" data-place='F6' data-price='20'>F6</span>
                            <span class="sits__place sits-price--middle" data-place='F7' data-price='20'>F7</span>
                            <span class="sits__place sits-price--middle" data-place='F8' data-price='20'>F8</span>
                            <span class="sits__place sits-price--middle" data-place='F9' data-price='20'>F9</span>
                            <span class="sits__place sits-price--middle" data-place='F10' data-price='20'>F10</span>
                            <span class="sits__place sits-price--middle" data-place='F11' data-price='20'>F11</span>
                            <span class="sits__place sits-price--middle" data-place='F12' data-price='20'>F12</span>
                            <span class="sits__place sits-price--middle" data-place='F13' data-price='20'>F13</span>
                            <span class="sits__place sits-price--middle" data-place='F14' data-price='20'>F14</span>
                            <span class="sits__place sits-price--middle" data-place='F15' data-price='20'>F15</span>
                            <span class="sits__place sits-price--middle" data-place='F16' data-price='20'>F16</span>
                            <span class="sits__place sits-price--middle" data-place='F17' data-price='20'>F17</span>
                            <span class="sits__place sits-price--middle" data-place='F18' data-price='20'>F18</span>
                        </div>

                        <div class="sits__row">
                            <span class="sits__place sits-price--middle" data-place='G1' data-price='20'>G1</span>
                            <span class="sits__place sits-price--middle" data-place='G2' data-price='20'>G2</span>
                            <span class="sits__place sits-price--middle" data-place='G3' data-price='20'>G3</span>
                            <span class="sits__place sits-price--middle" data-place='G4' data-price='20'>G4</span>
                            <span class="sits__place sits-price--middle" data-place='G5' data-price='20'>G5</span>
                            <span class="sits__place sits-price--middle" data-place='G6' data-price='20'>G6</span>
                            <span class="sits__place sits-price--middle" data-place='G7' data-price='20'>G7</span>
                            <span class="sits__place sits-price--middle" data-place='G8' data-price='20'>G8</span>
                            <span class="sits__place sits-price--middle" data-place='G9' data-price='20'>G9</span>
                            <span class="sits__place sits-price--middle" data-place='G10' data-price='20'>G10</span>
                            <span class="sits__place sits-price--middle" data-place='G11' data-price='20'>G11</span>
                            <span class="sits__place sits-price--middle" data-place='G12' data-price='20'>G12</span>
                            <span class="sits__place sits-price--middle" data-place='G13' data-price='20'>G13</span>
                            <span class="sits__place sits-price--middle" data-place='G14' data-price='20'>G14</span>
                            <span class="sits__place sits-price--middle" data-place='G15' data-price='20'>G15</span>
                            <span class="sits__place sits-price--middle" data-place='G16' data-price='20'>G16</span>
                            <span class="sits__place sits-price--middle" data-place='G17' data-price='20'>G17</span>
                            <span class="sits__place sits-price--middle" data-place='G18' data-price='20'>G18</span>
                        </div>

                        <div class="sits__row">
                            <span class="sits__place sits-price--middle" data-place='I3' data-price='20'>I3</span>
                            <span class="sits__place sits-price--middle" data-place='I4' data-price='20'>I4</span>
                            <span class="sits__place sits-price--middle" data-place='I5' data-price='20'>I5</span>
                            <span class="sits__place sits-price--middle" data-place='I6' data-price='20'>I6</span>
                            <span class="sits__place sits-price--middle" data-place='I7' data-price='20'>I7</span>
                            <span class="sits__place sits-price--middle" data-place='I8' data-price='20'>I8</span>
                            <span class="sits__place sits-price--middle" data-place='I9' data-price='20'>I9</span>
                            <span class="sits__place sits-price--middle" data-place='I10' data-price='20'>I10</span>
                            <span class="sits__place sits-price--middle" data-place='I11' data-price='20'>I11</span>
                            <span class="sits__place sits-price--middle" data-place='I12' data-price='20'>I12</span>
                            <span class="sits__place sits-price--middle" data-place='I13' data-price='20'>I13</span>
                            <span class="sits__place sits-price--middle" data-place='I14' data-price='20'>I14</span>
                            <span class="sits__place sits-price--middle" data-place='I15' data-price='20'>I15</span>
                            <span class="sits__place sits-price--middle" data-place='I16' data-price='20'>I16</span>
                        </div>

                        <div class="sits__row additional-margin">
                            <span class="sits__place sits-price--expensive" data-place='J5' data-price='30'>J5</span>
                            <span class="sits__place sits-price--expensive" data-place='J6' data-price='30'>J6</span>
                            <span class="sits__place sits-price--expensive" data-place='J7' data-price='30'>J7</span>
                            <span class="sits__place sits-price--expensive" data-place='J8' data-price='30'>J8</span>
                            <span class="sits__place sits-price--expensive" data-place='J9' data-price='30'>J9</span>
                            <span class="sits__place sits-price--expensive" data-place='J10' data-price='30'>J10</span>
                            <span class="sits__place sits-price--expensive" data-place='J11' data-price='30'>J11</span>
                            <span class="sits__place sits-price--expensive" data-place='J12' data-price='30'>J12</span>
                            <span class="sits__place sits-price--expensive" data-place='J13' data-price='30'>J13</span>
                            <span class="sits__place sits-price--expensive" data-place='J14' data-price='30'>J14</span>
                        </div>

                        <div class="sits__row">
                            <span class="sits__place sits-price--expensive" data-place='K5' data-price='30'>K5</span>
                            <span class="sits__place sits-price--expensive" data-place='K6' data-price='30'>K6</span>
                            <span class="sits__place sits-price--expensive" data-place='K7' data-price='30'>K7</span>
                            <span class="sits__place sits-price--expensive" data-place='K8' data-price='30'>K8</span>
                            <span class="sits__place sits-price--expensive" data-place='K9' data-price='30'>K9</span>
                            <span class="sits__place sits-price--expensive" data-place='K10' data-price='30'>K10</span>
                            <span class="sits__place sits-price--expensive" data-place='K11' data-price='30'>K11</span>
                            <span class="sits__place sits-price--expensive" data-place='K12' data-price='30'>K12</span>
                            <span class="sits__place sits-price--expensive" data-place='K13' data-price='30'>K13</span>
                            <span class="sits__place sits-price--expensive" data-place='K14' data-price='30'>K14</span>
                        </div>

                        <div class="sits__row">
                            <span class="sits__place sits-price--expensive" data-place='L6' data-price='30'>L6</span>
                            <span class="sits__place sits-price--expensive" data-place='L7' data-price='30'>L7</span>
                            <span class="sits__place sits-price--expensive" data-place='L8' data-price='30'>L8</span>
                            <span class="sits__place sits-price--expensive" data-place='L9' data-price='30'>L9</span>
                            <span class="sits__place sits-price--expensive" data-place='L10' data-price='30'>L10</span>
                            <span class="sits__place sits-price--expensive" data-place='L11' data-price='30'>L11</span>
                            <span class="sits__place sits-price--expensive" data-place='L12' data-price='30'>L12</span>
                            <span class="sits__place sits-price--expensive" data-place='L13' data-price='30'>L13</span>
                        </div>

                        <aside class="sits__checked"  style="width: 90px;"  >
                            <div class="checked-place" >

                            </div>
                            <div class="checked-result">
                                0 đ
                            </div>
                        </aside>
                        <footer class="sits__number">
                            <span class="sits__indecator">1</span>
                            <span class="sits__indecator">2</span>
                            <span class="sits__indecator">3</span>
                            <span class="sits__indecator">4</span>
                            <span class="sits__indecator">5</span>
                            <span class="sits__indecator">6</span>
                            <span class="sits__indecator">7</span>
                            <span class="sits__indecator">8</span>
                            <span class="sits__indecator">9</span>
                            <span class="sits__indecator">10</span>
                            <span class="sits__indecator">11</span>
                            <span class="sits__indecator">12</span>
                            <span class="sits__indecator">13</span>
                            <span class="sits__indecator">14</span>
                            <span class="sits__indecator">15</span>
                            <span class="sits__indecator">16</span>
                            <span class="sits__indecator">17</span>
                            <span class="sits__indecator">18</span>
                        </footer>
                    </div>
                </div>
            </div>



        </div>


    </div>
</section>
</div>
<!-- tạo form -->






<div class="clearfix"></div>
<!-- <form id='film-and-time' class="booking-form" method='get' action='book3-buy.html'>

    <input type='text' name='choosen-number' class="choosen-number">
    <input type='text' name='choosen-number--cheap' class="choosen-number--cheap">
    <input type='text' name='choosen-number--middle' class="choosen-number--middle">
    <input type='text' name='choosen-number--expansive' class="choosen-number--expansive">
    <input type='text' name='choosen-cost' class="choosen-cost">
    <input type='text' name='choosen-sits' class="choosen-sits">


    <div class="booking-pagination booking-pagination--margin">
        <a href="book1.html" class="booking-pagination__prev">
            <span class="arrow__text arrow--prev">Quay lại</span>
            <span class="arrow__info">Chọn lịch chiếu</span>
        </a>
        <a href="<?php echo base_url(); ?>index.php/seat_controller/index_thanhtoan" class="booking-pagination__next">
            <span class="arrow__text arrow--next">Bước tiếp theo</span>
            <span class="arrow__info">Xác nhận Thanh toán</span>
        </a>
    </div>
</form> -->
<div>
    <form class="booking-pagination booking-pagination--margin" id='film-and-time' action="../index_thanhtoan" method='post' enctype="multidata/form-data">
        <input type='hidden' name='choosen-number' class="choosen-number">
        <input type='hidden' name='choosen-number--cheap' class="choosen-number--cheap">
        <input type='hidden' name='choosen-number--middle' class="choosen-number--middle">
        <input type='hidden' name='choosen-number--expansive' class="choosen-number--expansive">
        <input type='hidden' name='choosen-cost' class="choosen-cost">
        <input type='hidden' name='choosen-sits' class="choosen-sits">

        <input type="hidden" name="id_calendar" class="id_calendar" value="<?= $valuelich['id_calendar']; ?>">
        <input type="hidden" name="tenphim" class="tenphim" value="<?= $valuelich['title']; ?>">
        <input type="hidden" name="ngay" class="ngay" value="<?= $daydadoi ?>">
        <input type="hidden" name="gio" class="gio" value="<?= $valuelich['time']; ?>">



        <!-- <input class="seats" id="seats" name="seats" value=""> -->

        <a href="<?php echo base_url(); ?>index.php/Movie_page_controller/showinfophim/<?= $valuelich['id_movie']; ?>" class="booking-pagination__prev">
            <span class="arrow__text arrow--prev">Quay lại</span>
            <span class="arrow__info">Chọn lịch chiếu</span>
        </a>
        <button class="booking-pagination__next">
            <span class="arrow__text arrow--next">Bước tiếp theo</span>
            <span class="arrow__info">Xác nhận Thanh toán</span>
        </button>

    </form>
</div>
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
                        <p class="heading-special--small">YOUNET MEDIA<br><span class="title-edition">in the social media</span></p>

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
    <script type='text/javascript'>
        $(document).ready(function() {
            var ghedaban = $('.ghedaban').val() || '';
            // Normalize into an array without extra spaces
            var ghedabanmang = [];
            if (ghedaban.length) {
                var parts = ghedaban.split(',');
                for (var j = 0; j < parts.length; j++) {
                    var part = parts[j].trim();
                    if (part) ghedabanmang.push(part);
                }
            }
            for (var i = ghedabanmang.length - 1; i >= 0; i--) {
                // $('.').attr('data-place')=ghedabanmang[i];
               $('span[data-place="'+ghedabanmang[i]+'"]').addClass('sits-state--not');
            //     // lopaddClass('sits-state--not');
            //     // $(this);
            //    // console.log(lop);
            //     // $lop.parent().attr.('class','sits-state--not');

            //     // lop.children(class).addClass('sits-state--not');
            //     // $(this).attr('class').addClass('sits-state--not');
            }

        });
    </script>


    <script>

    //         //1. Buttons for choose order method
    // //order factor
    // $('.order__control-btn').click(function (e) {
    //     e.preventDefault();

    //     $('.order__control-btn').removeClass('active');
    //     $(this).addClass('active');
    // })

    //2. Init vars for order data
    // var for booking;
    
    var numberTicket = $('.choosen-number'),
    sumTicket = $('.choosen-cost'),
    cheapTicket = $('.choosen-number--cheap'),
    middleTicket = $('.choosen-number--middle'),
    expansiveTicket = $('.choosen-number--expansive'),
    sits = $('.choosen-sits');

    //3. Choose sits (and count price for them)
                //users choose sits

                //data elements init
                var sum = 0;
                var cheap = 0;
                var middle = 0;
                var expansive = 0;

                //var seats = new Array ();
                


                $('.sits__place').click(function (e) {
                    e.preventDefault();
                    var place = $(this).attr('data-place');
                    var ticketPrice = $(this).attr('data-price');

                    if(! $(e.target).hasClass('sits-state--your')){

                        if (! $(this).hasClass('sits-state--not') ) {
                            $(this).addClass('sits-state--your');

                            $('.checked-place').prepend('<span class="choosen-place '+place+'">'+ place +'</span>');
                            //seats.push(place);


                            switch(ticketPrice)
                            {
                                case '10':
                                sum += 55;
                                cheap += 1;
                                break;
                                case '20':
                                sum += 70;
                                middle += 1;
                                break;
                                case '30':
                                sum += 120;
                                expansive += 1;
                                break;
                            }

                            $('.checked-result').text(sum+' 000 đ');
                        }
                    }

                    else{

                        $(this).removeClass('sits-state--your');
                        
                        $('.'+place+'').remove();
                        //seats = seats.filter(item => item !== place);

                        switch(ticketPrice)
                        {
                            case '10':
                            sum -= 55;
                            cheap -= 1;
                            break;
                            case '20':
                            sum -= 70;
                            middle -= 1;
                            break;
                            case '30':
                            sum -= 120;
                            expansive -= 1;
                            break;
                        }

                        $('.checked-result').text(sum+' 000 đ')
                    }

                    //data element init
                    var number = $('.checked-place').children().length;

                    //data element set 
                    numberTicket.val(number);
                    sumTicket.val(sum);
                    cheapTicket.val(cheap);
                    middleTicket.val(middle);
                    expansiveTicket.val(expansive );


                    //data element init
                    
                    var chooseSits = '';
                    
                    $('.choosen-place').each( function () {

                        chooseSits += ', '+ $(this).text();
                    });

                    //data element set 
                    sits.val(chooseSits.substr(1));
                    console.log(chooseSits);
                    // $('.seats').val(chooseSits);
                    



                });

                // var id_calendar = $('.id_calendar').val();
                

        //         $('.booking-pagination__next').click(function(event) {

        //             console.log(id_calendar);
        // //             $.get("../index_thanhtoan", {id_calendar: id_calendar} , function(data){
        // //     // Display the returned data in browser
        // //     $("#result").html(data);
        // // });
        //         });

                //--- Step for data  ---//
                //Get data from pvevius page
                var url = decodeURIComponent(document.URL);
                var prevDate = url.substr(url.indexOf('?')+1);

                //Serialize, add new data and send to next page
                // $('.booking-form').submit( function (e) {
                //     e.preventDefault(); 
                //     var bookData = $(this).serialize();

                //     var fullData = prevDate + '&' + bookData
                //     var action, 
                //     control = $('.order__control-btn.active').text();

                //     if (control == "Purchase"){ action = 'book3-buy.html'; }
                //     else if (control == "Reserve"){ action = 'book3-reserve.html'; }

                //     $.get( action, fullData, function(data){});
                // });

                // $('.top-scroll').parent().find('.top-scroll').remove();
                
            </script>
            

        </body>
        </html>
