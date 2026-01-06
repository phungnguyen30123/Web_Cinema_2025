<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập</title>

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="telephone=no" name="format-detection">

    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&family=Roboto+Slab:wght@400;700&display=swap' rel='stylesheet' type='text/css'>

    <link href="<?php echo base_url(); ?>css/gozha-nav.css" rel="stylesheet" />
    <link href="<?php echo base_url(); ?>css/external/jquery.selectbox.css" rel="stylesheet" />
    <link href="<?php echo base_url(); ?>css/style.css?v=1" rel="stylesheet" />

    <script src="<?php echo base_url(); ?>js/external/modernizr.custom.js"></script>

    <style>
        /* CSS cho Icon Ẩn/Hiện Mật khẩu */
        .field-icon {
            float: right;
            margin-right: 15px;
            margin-top: -30px;
            position: relative;
            z-index: 2;
            cursor: pointer;
            color: #b4b1b2;
        }

        .fa-eye-slash {
            color: #6c757d;
        }

        /* Đảm bảo form căn giữa và input rộng */
        .login {
            max-width: 400px;
            width: 90%;
            margin-left: auto;
            margin-right: auto;
        }

        .login__input {
            width: 100%;
        }

        /* 1. Cho Edge/IE (dùng tiền tố -ms) */
        input[type=password]::-ms-reveal,
        input[type=password]::-ms-clear {
            display: none;
        }

        /* 2. Cho Chrome/Brave/Edge mới (dùng tiền tố -webkit, nhắm vào Shadow DOM) */
        ::-webkit-reveal-button {
            display: none !important;
            -webkit-appearance: none;
        }
    </style>
</head>

<body>

    <div class="wrapper">
        <?php require('header_view.php') ?>

        <form id="login-form" class="login" action="login" method='post' enctype="multidata/form-data" autocomplete="off">
            <p class="login__title">Đăng nhập <br><span class="login-edition"></span></p>

            <?php if ($this->session->flashdata('error_msg')): ?>
                <div class="alert alert-danger" style="background-color: #f8d7da; color: #721c24; padding: 10px 15px; border-radius: 4px; margin-bottom: 15px; border: 1px solid #f5c6cb;">
                    <i class="fa fa-exclamation-circle"></i> <?php echo $this->session->flashdata('error_msg'); ?>
                </div>
            <?php endif; ?>

            <?php if ($this->session->flashdata('success_msg')): ?>
                <div class="alert alert-success" style="background-color: #d4edda; color: #155724; padding: 10px 15px; border-radius: 4px; margin-bottom: 15px; border: 1px solid #c3e6cb;">
                    <i class="fa fa-check-circle"></i> <?php echo $this->session->flashdata('success_msg'); ?>
                </div>
            <?php endif; ?>

            <div class="field-wrap">
                <input type='email' placeholder='Email' name='user-email' class="login__input" autocomplete="username">

                <div style="position: relative;">
                    <input type='password' id="password-input" placeholder='Password' name='user-password' class="login__input" required autocomplete="current-password">
                    <span class="fa fa-fw fa-eye field-icon toggle-password" data-target="password-input"></span>
                </div>

                <input type='checkbox' id='#informed' class='login__check styled'>
                <label for='' class='login__check-info'></label>
            </div>

            <div class="login__control">
                <button type='submit' class="btn btn-md btn--warning btn--wider">sign in</button>
            </div>
        </form>

        <div class="clearfix"></div>
    </div>

    <?php require('footer_view.php'); ?>

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
            // Script ẩn/hiện mật khẩu
            $(".toggle-password").click(function() {
                var input = $("#" + $(this).data("target")); // Lấy input dựa trên thuộc tính data-target (chỉ dùng trong form đăng ký, nhưng giữ lại cú pháp an toàn)

                // Vì không dùng data-target trong form đăng nhập, ta sẽ tìm input gần nhất
                var input = $(this).closest('.field-wrap').find('input[type="password"], input[type="text"]');

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