<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng ký</title>

    <meta content="telephone=no" name="format-detection">

    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&family=Roboto+Slab:wght@400;700&display=swap' rel='stylesheet'>
    <link href="<?php echo base_url(); ?>css/gozha-nav.css" rel="stylesheet" />
    <link href="<?php echo base_url(); ?>css/external/jquery.selectbox.css" rel="stylesheet" />
    <link href="<?php echo base_url(); ?>css/style.css?v=1" rel="stylesheet" />
    <script src="<?php echo base_url(); ?>js/external/modernizr.custom.js"></script>

    <style>
        /* ... (Giữ nguyên các style CSS) ... */
        .field-label {
            display: block;
            margin-top: 15px;
            margin-bottom: 8px;
            font-size: 13px;
            color: #333;
            font-weight: 500;
        }

        .field-label:first-child {
            margin-top: 0;
        }

        .login .login__input {
            color: #333 !important;
            margin: 0 !important;
        }

        .field-wrap {
            margin-bottom: 20px;
        }

        .login__control {
            margin-top: 30px !important;
            padding-top: 15px;
        }

        .login {
            max-width: 500px;
            width: 90%;
            margin: auto;
        }

        .field-wrap,
        .login__input {
            width: 100%;
        }

        /* Password wrapper */
        .password-wrapper {
            position: relative;
        }

        .password-wrapper .toggle-password {
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            color: #b4b1b2;
            z-index: 2;
        }

        .password-wrapper .toggle-password.fa-eye-slash {
            color: #6c757d;
        }

        /* Vô hiệu hóa nút ẩn/hiện mặc định của Edge/IE */
        input[type=password]::-ms-reveal,
        input[type=password]::-ms-clear {
            display: none;
        }

        /* Vô hiệu hóa nút ẩn/hiện mặc định của Chrome/Edge (CSS Shadow DOM) */
        ::-webkit-internal-media-controls-overlay-cast-button {
            display: none;
        }
        
        /* CSS cho trường giả mạo (để ẩn đi) */
        .visually-hidden {
            position: absolute; 
            left: -9999px; 
            opacity: 0;
            width: 0;
            height: 0;
        }
    </style>
</head>

<body>
    <div class="wrapper">
        <?php require('header_view.php') ?>

        <form id="login-form" class="login" action="<?php echo base_url(); ?>index.php/Login_register/register" method="post" enctype="multipart/form-data" autocomplete="off">
            <input type="text" name="fake-username" style="position:absolute; left:-9999px;" tabindex="-1" autocomplete="off">
            <input type="password" name="fake-password" style="position:absolute; left:-9999px;" tabindex="-1" autocomplete="off">

            <p class="login__title">ĐĂNG KÝ <br><span class="login-edition"></span></p>

            <div class="field-wrap">
                <label class="field-label" for="user-email">Email</label>
                <input type="email" id="user-email" placeholder="Email" name="user-email" class="login__input" required autocomplete="off">


                <label class="field-label" for="password-input">Mật Khẩu</label>
                <div class="password-wrapper">
                    <input type="password" id="password-input" placeholder="Password" name="user-password" class="login__input" required autocomplete="new-password">
                    <span class="fa fa-fw fa-eye toggle-password" data-target="password-input"></span>
                </div>

                <label class="field-label" for="repassword-input">Nhập lại mật khẩu</label>
                <div class="password-wrapper">
                    <input type="password" id="repassword-input" placeholder="Password" name="user-password-re" class="login__input" required autocomplete="new-password">
                    <span class="fa fa-fw fa-eye toggle-password" data-target="repassword-input"></span>
                </div>

                <label class="field-label" for="user-name">Họ tên</label>
                <input type="text" id="user-name" placeholder="Nhập họ tên tại đây" name="user-name" class="login__input" required autocomplete="name">

                <label class="field-label" for="user-datebirth">Ngày sinh</label>
                <input type="date" id="user-datebirth" name="user-datebirth" class="login__input" required autocomplete="off">

                <label class="field-label" for="user-sdt">Số điện thoại</label>
                <input type="tel" id="user-sdt" placeholder="Số điện thoại" name="user-sdt" class="login__input" required autocomplete="tel">

                <label class="field-label" for="user-address">Địa chỉ</label>
                <input type="text" id="user-address" placeholder="Địa chỉ" name="user-address" class="login__input" required autocomplete="street-address">
            </div>

            <div class="login__control">
                <button type="submit" class="btn btn-md btn--warning btn--wider">ĐĂNG KÝ</button>
            </div>
        </form>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script>
        window.jQuery || document.write('<script src="<?php echo base_url(); ?>js/external/jquery-3.1.1.min.js"><\/script>')
    </script>
    <script src="<?php echo base_url(); ?>js/external/jquery-migrate-1.2.1.min.js"></script>
    <script src="http://netdna.bootstrapcdn.com/bootstrap/3.0.2/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url(); ?>js/jquery.mobile.menu.js"></script>
    <script src="<?php echo base_url(); ?>js/external/jquery.selectbox-0.2.min.js"></script>
    <script src="<?php echo base_url(); ?>js/external/form-element.js"></script>
    <script src="<?php echo base_url(); ?>js/form.js"></script>
    <script src="<?php echo base_url(); ?>js/custom.js"></script>

    <script>
        $(document).ready(function() {
            $(".toggle-password").click(function() {
                var input = $("#" + $(this).data("target"));
                if (input.attr("type") === "password") {
                    input.attr("type", "text");
                    $(this).removeClass("fa-eye").addClass("fa-eye-slash");
                } else {
                    input.attr("type", "password");
                    $(this).removeClass("fa-eye-slash").addClass("fa-eye");
                }
            });
        });
    </script>
</body>

</html>