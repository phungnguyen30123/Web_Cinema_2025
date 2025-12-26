<?php
// 1. KIỂM TRA TRẠNG THÁI ĐĂNG NHẬP - Sử dụng hệ thống session mới
$is_logged_in = $this->session->userdata('logged_in') === TRUE;

// 2. LẤY THÔNG TIN NGƯỜI DÙNG TỪ SESSION MỚI
$user_display_name = 'Tài khoản';
$user_role = $this->session->userdata('user_role'); // 'admin', 'staff', hoặc 'user'
$logout_url = base_url() . 'index.php/showuser_controller/logout';

if ($is_logged_in) {
    // Ưu tiên lấy tên đầy đủ từ session mới
    $name_from_session = $this->session->userdata('user_fullname');
    
    if (!empty($name_from_session)) {
        // Hiển thị tên đầy đủ
        $user_display_name = $name_from_session;
    } else {
        // Nếu không có tên, lấy email từ session mới và lấy phần trước @
        $user_email = $this->session->userdata('user_email');
        if (!empty($user_email) && strpos($user_email, '@') !== false) {
            $user_display_name = explode('@', $user_email)[0];
        } else {
            $user_display_name = 'Khách hàng';
        }
    }
}

// 3. XÁC ĐỊNH CLASS CHO HEADER (hỗ trợ class đặc biệt cho trang chủ)
$header_class = isset($header_class_extra) ? 'header-wrapper ' . $header_class_extra : 'header-wrapper';
?>

<header class="<?php echo $header_class; ?>">
    <div class="container">
        <a href="<?php echo base_url(); ?>index.php/Index_controller" class="logo">
            <img alt='logo' src="<?php echo base_url(); ?>images/logo_vstar.png">
        </a>

        <nav id="navigation-box" style="margin-left: 250px; float:left;width: 1050px;">
            <a href="#" id="navigation-toggle">
                <span class="menu-icon">
                    <span class="icon-toggle" role="button" aria-label="Toggle Navigation">
                        <span class="lines"></span>
                    </span>
                </span>
            </a>

            <ul id="navigation">
                <li>
                    <span class="sub-nav-toggle plus"></span>
                    <a href="#">Phim</a>
                    <ul>
                        <li class="menu__nav-item"><a href="<?php echo base_url(); ?>index.php/ShowPhim/PhimDC">Phim đang chiếu</a></li>
                        <li class="menu__nav-item"><a href="<?php echo base_url(); ?>index.php/ShowPhim/PhimSC">Phim sắp chiếu</a></li>
                    </ul>
                </li>

                <li>
                    <span class="sub-nav-toggle plus"></span>
                    <a href="<?php echo base_url(); ?>index.php/offers_controller">Khuyến mãi</a>
                </li>
                <li>
                    <span class="sub-nav-toggle plus"></span>
                    <a href="#">Giá vé</a>
                </li>
                <li>
                    <span class="sub-nav-toggle plus"></span>
                    <a href="#">Tin tức</a>
                </li>
                
                <?php if ($is_logged_in && in_array($user_role, ['admin', 'staff'])): ?>
                <li>
                    <span class="sub-nav-toggle plus"></span>
                    <a href="#">Quản trị</a>
                    <ul>
                        <?php if ($user_role == 'admin'): ?>
                        <li class="menu__nav-item"><a href="<?php echo base_url(); ?>index.php/showadmin_controller">Quản lý tài khoản</a></li>
                        <li class="menu__nav-item"><a href="<?php echo base_url(); ?>index.php/showadmin_controller/index_qlnv">Quản lý nhân viên</a></li>
                        <?php endif; ?>
                        <li class="menu__nav-item"><a href="<?php echo base_url(); ?>index.php/Nhanvien_controller">Quản lý phim</a></li>
                        <li class="menu__nav-item"><a href="<?php echo base_url(); ?>index.php/Nhanvien_controller/index_xacnhanve">Xác nhận vé</a></li>
                    </ul>
                </li>
                <?php endif; ?>
                
                <li>
                    <span class="sub-nav-toggle plus"></span>
                    <a href="<?php echo base_url(); ?>index.php/contract_controller">Liên hệ</a>
                </li>

                <li class="user-menu-item">
                    <?php if ($is_logged_in): ?>
                        <span class="sub-nav-toggle plus"></span>
                        <a href="#" class="user-menu-link">
                            <i class="fa fa-user-circle" style="margin-right: 5px;"></i>
                            <?php echo htmlspecialchars($user_display_name); ?>
                        </a>
                        <ul>
                            <li class="menu__nav-item"><a href="<?php echo base_url(); ?>index.php/showuser_controller/indexshowuser">Thông tin tài khoản</a></li>
                            <li class="menu__nav-item"><a href="<?php echo base_url(); ?>index.php/showuser_controller/history">Lịch sử mua vé</a></li>
                            <li class="menu__nav-item"><a href="<?php echo $logout_url; ?>">Đăng xuất</a></li>
                        </ul>
                    <?php else: ?>
                        <a href="#" class="open-login-modal user-menu-link">Đăng nhập/Đăng ký</a>
                    <?php endif; ?>
                </li>
            </ul>
        </nav>
        
        <a href="<?php echo base_url(); ?>index.php/ShowPhim/PhimDC" class="btn btn-md btn--warning btn--book btn-ticket" style="float: right;">
            <span class="ticket-star">★</span>
            <span class="ticket-text">Mua Vé</span>
        </a>
    </div>
</header>

<!-- Modal Popup cho Đăng nhập/Đăng ký -->
<div id="authModal" class="auth-modal">
    <div class="auth-modal-content">
        <span class="auth-close">&times;</span>
        
        <!-- Login Form -->
        <div id="login-tab" class="auth-tab-content active">
            <!-- Illustration Area -->
            <div class="auth-illustration">
                <div class="illustration-bg"></div>
                <div class="auth-logo">
                    <img alt='logo' src="<?php echo base_url(); ?>images/logo_vstar.png">
                </div>
            </div>
            
            <!-- Title -->
            <h2 class="auth-title">Đăng Nhập Tài Khoản</h2>
            
            <form id="login-form-popup" class="login-form-popup" action="<?php echo base_url(); ?>index.php/Login_register/login" method="post" enctype="multidata/form-data" autocomplete="off">
                <input type="hidden" name="redirect_after_login" id="redirect-after-login-input" value="">
                <div class="field-wrap">
                    <label class="field-label" for="user-email-login">Email</label>
                    <input type="email" id="user-email-login" placeholder="Nhập Email" name="user-email" class="login__input" autocomplete="username" required>
                    
                    <label class="field-label" for="password-input-popup">Mật khẩu</label>
                    <div class="password-wrapper">
                        <input type="password" id="password-input-popup" placeholder="Nhập Mật khẩu" name="user-password" class="login__input" required autocomplete="current-password">
                        <span class="fa fa-fw fa-eye toggle-password-popup" data-target="password-input-popup"></span>
                    </div>
                </div>

                <div class="login__control">
                    <button type="submit" class="btn-login">ĐĂNG NHẬP</button>
                    <a href="#" class="forgot-password-link">Quên mật khẩu?</a>
                </div>
            </form>
            
            <!-- Divider -->
            <div class="auth-divider"></div>
            
            <!-- Register Prompt -->
            <div class="register-prompt">
                <p class="register-text">Bạn chưa có tài khoản?</p>
                <button type="button" class="btn-register" onclick="switchToRegister()">Đăng ký</button>
            </div>
        </div>

        <!-- Register Form -->
        <div id="register-tab" class="auth-tab-content">
            <!-- Illustration Area -->
            <div class="auth-illustration">
                <div class="illustration-bg"></div>
                <div class="auth-logo">
                    <img alt='logo' src="<?php echo base_url(); ?>images/logo_vstar.png">
                </div>
            </div>
            <h2 class="auth-title">Đăng Ký Tài Khoản</h2>
            <form id="register-form-popup" class="register-form-popup" action="<?php echo base_url(); ?>index.php/Login_register/register" method="post" enctype="multipart/form-data" autocomplete="off">
                <input type="text" name="fake-username" style="position:absolute; left:-9999px;" tabindex="-1" autocomplete="off">
                <input type="password" name="fake-password" style="position:absolute; left:-9999px;" tabindex="-1" autocomplete="off">

                <div class="field-wrap">
                    <label class="field-label" for="user-email-reg">Email</label>
                    <input type="email" id="user-email-reg" placeholder="Email" name="user-email" class="login__input" required autocomplete="username">

                    <label class="field-label" for="password-input-reg">Mật Khẩu</label>
                    <div class="password-wrapper">
                        <input type="password" id="password-input-reg" placeholder="Mật khẩu" name="user-password" class="login__input" required autocomplete="new-password">
                        <span class="fa fa-fw fa-eye toggle-password-popup" data-target="password-input-reg"></span>
                    </div>

                    <label class="field-label" for="repassword-input-reg">Nhập lại mật khẩu</label>
                    <div class="password-wrapper">
                        <input type="password" id="repassword-input-reg" placeholder="Nhập lại mật khẩu" name="user-password-re" class="login__input" required autocomplete="new-password">
                        <span class="fa fa-fw fa-eye toggle-password-popup" data-target="repassword-input-reg"></span>
                    </div>

                    <label class="field-label" for="user-name-reg">Họ tên</label>
                    <input type="text" id="user-name-reg" placeholder="Nhập họ tên" name="user-name" class="login__input" required autocomplete="name">

                    <label class="field-label" for="user-datebirth-reg">Ngày sinh</label>
                    <input type="date" id="user-datebirth-reg" name="user-datebirth" class="login__input" required autocomplete="off">

                    <label class="field-label" for="user-sdt-reg">Số điện thoại</label>
                    <input type="tel" id="user-sdt-reg" placeholder="Số điện thoại" name="user-sdt" class="login__input" required autocomplete="tel">

                    <label class="field-label" for="user-address-reg">Địa chỉ</label>
                    <input type="text" id="user-address-reg" placeholder="Địa chỉ" name="user-address" class="login__input" required autocomplete="street-address">
                </div>

                <div class="login__control">
                    <button type="submit" class="btn-login">ĐĂNG KÝ</button>
                </div>
            </form>
            
            <!-- Back to Login -->
            <div class="auth-divider"></div>
            <div class="register-prompt">
                <p class="register-text">Bạn đã có tài khoản?</p>
                <button type="button" class="btn-register" onclick="switchToLogin()">Đăng nhập</button>
            </div>
        </div>
    </div>
</div>

<style>
/* CSS Variables từ vars.less để sử dụng trong form popup */
:root {
    --color-main: #4c4145;
    --color-red: #fe505a;
    --color-yellow: #ffd564;
    --color-grey: #969b9f;
    --color-grey-light: #dbdee1;
    --color-grey-lighter: #f5f5f5;
    --color-null: #fff;
    --font-size: 13px;
    --font-size-higher: 16px;
    --font-size-lower: 12px;
    --font-primary: 'aleoregular', sans-serif;
    --font-secondary: 'Roboto', sans-serif;
}

/* Modal Styles - Kế thừa font từ body/wrapper của website */
.auth-modal {
    display: none;
    position: fixed;
    z-index: 10000;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    overflow: hidden;
    background-color: rgba(0, 0, 0, 0.7);
    animation: fadeIn 0.3s;
    /* Đảm bảo scrollbar không làm lệch layout */
    scrollbar-gutter: stable;
    /* Kế thừa font từ body */
}

@keyframes fadeIn {
    from { opacity: 0; }
    to { opacity: 1; }
}

.auth-modal-content {
    background-color: var(--color-null);
    margin: 5% auto;
    padding: 0;
    border: none;
    width: 90%;
    max-width: 420px;
    max-height: 90vh;
    border-radius: 8px;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.3);
    position: relative;
    animation: slideDown 0.3s;
    display: flex;
    flex-direction: column;
    overflow: hidden;
    /* Đảm bảo width không thay đổi khi scrollbar xuất hiện */
    box-sizing: border-box;
    /* Kế thừa font từ body */
}

@keyframes slideDown {
    from {
        transform: translateY(-50px);
        opacity: 0;
    }
    to {
        transform: translateY(0);
        opacity: 1;
    }
}

.auth-close {
    color: var(--color-grey);
    float: right;
    font-size: 22px;
    font-weight: bold;
    position: absolute;
    right: 12px;
    top: 8px;
    z-index: 10001;
    cursor: pointer;
    line-height: 1;
    transition: color 0.3s;
}

.auth-close:hover,
.auth-close:focus {
    color: var(--color-red);
    text-decoration: none;
}

/* Tab Content */
.auth-tab-content {
    display: none;
    padding: 0;
    overflow-y: auto;
    overflow-x: hidden;
    flex: 1;
    /* Đảm bảo scrollbar không làm lệch nội dung */
    scrollbar-width: thin;
    scrollbar-color: #ccc transparent;
}

.auth-tab-content.active {
    display: block;
}

/* Illustration Area */
.auth-illustration {
    position: relative;
    width: 100%;
    height: 90px;
    overflow: hidden;
    border-radius: 8px 8px 0 0;
}

.illustration-bg {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: linear-gradient(135deg, #a8d8f0 0%, #7bc4e8 50%, #5ba3d0 100%);
    background-size: 20px 20px;
    background-image: repeating-linear-gradient(
        45deg,
        transparent,
        transparent 10px,
        rgba(255, 255, 255, 0.1) 10px,
        rgba(255, 255, 255, 0.1) 20px
    );
}

.auth-logo {
    position: relative;
    height: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 10px;
}

.auth-logo img {
    max-width: 180px;
    max-height: 70px;
    width: auto;
    height: auto;
    object-fit: contain;
}

/* Title - Sử dụng font từ biến @primery-font (aleoregular) */
.auth-title {
    text-align: center;
    font-size: 18px;
    font-weight: bold;
    color: var(--color-main);
    margin: 15px 0 18px 0;
    padding: 0 25px;
    font-family: var(--font-primary);
}

/* Form Container */
.login-form-popup,
.register-form-popup {
    padding: 0 25px 18px 25px;
}

/* Custom scrollbar cho webkit browsers */
.auth-tab-content::-webkit-scrollbar {
    width: 8px;
}

.auth-tab-content::-webkit-scrollbar-track {
    background: transparent;
}

.auth-tab-content::-webkit-scrollbar-thumb {
    background: #ccc;
    border-radius: 4px;
}

.auth-tab-content::-webkit-scrollbar-thumb:hover {
    background: #999;
}

/* Form Styles */
.login-form-popup,
.register-form-popup {
    width: 100%;
    box-sizing: border-box;
    /* Đảm bảo cả hai form có cùng width */
    min-width: 0;
}

.field-wrap {
    margin-bottom: 20px;
}

.field-label {
    display: block;
    margin-top: 12px;
    margin-bottom: 6px;
    font-size: var(--font-size-lower);
    color: var(--color-main);
    font-weight: 500;
    /* Kế thừa font từ body (Roboto) - từ biến @secondary-font */
}

.field-label:first-child {
    margin-top: 0;
}

.login__input {
    width: 100%;
    padding: 10px 12px;
    border: 1px solid var(--color-grey-light);
    border-radius: 4px;
    font-size: var(--font-size);
    color: var(--color-main);
    box-sizing: border-box;
    margin-bottom: 0;
    /* Kế thừa font từ body (Roboto) - từ biến @secondary-font */
    transition: border-color 0.3s;
}

.login__input:focus {
    outline: none;
    border-color: var(--color-red);
    box-shadow: 0 0 0 2px rgba(254, 80, 90, 0.2);
}

.login__input::placeholder {
    color: var(--color-grey);
}

.password-wrapper {
    position: relative;
}

.password-wrapper .toggle-password-popup {
    position: absolute;
    right: 15px;
    top: 50%;
    transform: translateY(-50%);
    cursor: pointer;
    color: var(--color-grey);
    z-index: 10;
    pointer-events: auto;
    user-select: none;
    transition: color 0.3s;
}

.password-wrapper .toggle-password-popup:hover {
    color: var(--color-red);
}

.password-wrapper .toggle-password-popup.fa-eye-slash {
    color: var(--color-main);
}

.field-icon {
    position: absolute;
    right: 15px;
    top: 50%;
    transform: translateY(-50%);
    cursor: pointer;
    color: var(--color-grey);
    z-index: 2;
    transition: color 0.3s;
}

.field-icon:hover {
    color: var(--color-red);
}

.login__control {
    margin-top: 20px;
    text-align: center;
}

.btn-login {
    width: 100%;
    padding: 11px;
    font-size: 14px;
    font-weight: 600;
    background-color: var(--color-yellow);
    color: var(--color-main);
    border: none;
    border-radius: 4px;
    cursor: pointer;
    transition: background-color 0.3s;
    text-transform: uppercase;
    /* Kế thừa font từ body (Roboto) - từ biến @secondary-font */
}

.btn-login:hover {
    background-color: var(--color-red);
    color: var(--color-null);
}

.forgot-password-link {
    display: block;
    margin-top: 12px;
    color: var(--color-grey);
    text-decoration: none;
    font-size: var(--font-size-lower);
    transition: color 0.3s;
    /* Kế thừa font từ body (Roboto) - từ biến @secondary-font */
}

.forgot-password-link:hover {
    color: var(--color-red);
    text-decoration: underline;
}

/* Divider */
.auth-divider {
    height: 1px;
    background-color: var(--color-grey-light);
    margin: 18px 25px;
}

/* Register Prompt */
.register-prompt {
    padding: 0 25px 25px 25px;
    text-align: center;
}

.register-text {
    margin: 0 0 12px 0;
    color: var(--color-grey);
    font-size: var(--font-size-lower);
    /* Kế thừa font từ body (Roboto) - từ biến @secondary-font */
}

.btn-register {
    width: 100%;
    padding: 10px;
    font-size: 14px;
    font-weight: 600;
    background-color: var(--color-null);
    color: var(--color-yellow);
    border: 2px solid var(--color-yellow);
    border-radius: 4px;
    cursor: pointer;
    transition: all 0.3s;
    /* Kế thừa font từ body (Roboto) - từ biến @secondary-font */
}

.btn-register:hover {
    background-color: var(--color-yellow);
    color: var(--color-main);
}

.btn--wider {
    width: 100%;
    padding: 12px;
    font-size: 16px;
    font-weight: 600;
}

/* Responsive */
@media (max-width: 768px) {
    .auth-modal-content {
        width: 95%;
        margin: 10% auto;
        max-height: 85vh;
        max-width: 380px;
    }
    
    .auth-title {
        font-size: 16px;
        margin: 12px 0 15px 0;
    }
    
    .login-form-popup,
    .register-form-popup {
        padding: 0 20px 15px 20px;
    }
    
    .register-prompt {
        padding: 0 20px 20px 20px;
    }
    
    .auth-divider {
        margin: 15px 20px;
    }
    
    .auth-logo img {
        max-width: 150px;
        max-height: 60px;
    }
    
    .auth-illustration {
        height: 75px;
    }
}

/* Đảm bảo body không bị scroll khi modal mở */
/* Không ẩn scrollbar vì đã đặt overflow-y: scroll trên html để tránh layout shift */
body.modal-open {
    /* Không ẩn overflow để giữ scrollbar, chỉ ngăn scroll bằng position: fixed */
    position: fixed;
    width: 100%;
    /* padding-right không cần vì scrollbar luôn hiển thị trên html */
}

/* Fix dropdown menu disappearing when moving mouse from menu item to dropdown */
@media (min-width: 993px) {
    ul#navigation > li > ul {
        top: 100% !important;
        margin-top: 0;
        padding-top: 10px !important;
    }
    
    /* Tạo vùng đệm vô hình để dropdown không bị mất khi di chuột */
    ul#navigation > li > ul::before {
        content: '';
        position: absolute;
        top: -10px;
        left: 0;
        right: 0;
        height: 10px;
        background: transparent;
    }
}

/* User Menu Styling - Làm menu user khác biệt nhẹ nhàng */
.user-menu-item {
    position: relative;
}

.user-menu-item .user-menu-link {
    background-color: rgba(255, 213, 100, 0.2);
    color: var(--color-main) !important;
    font-weight: 500;
    padding: 6px 14px !important;
    border-radius: 4px;
    border: 1px solid rgba(255, 213, 100, 0.4);
    transition: all 0.3s ease;
}

.user-menu-item .user-menu-link:hover {
    background-color: rgba(255, 213, 100, 0.35);
    color: var(--color-main) !important;
    border-color: rgba(255, 213, 100, 0.6);
}

.user-menu-item .user-menu-link i {
    font-size: 14px;
    vertical-align: middle;
    opacity: 0.8;
}

/* Dropdown của user menu */
.user-menu-item > ul {
    border-top: 2px solid rgba(255, 213, 100, 0.3) !important;
}

.user-menu-item > ul > li.menu__nav-item > a:hover {
    background-color: rgba(255, 213, 100, 0.15);
    color: var(--color-main);
    padding-left: 15px;
    transition: all 0.3s ease;
}

/* Ticket Stub Button Styling */
.btn-ticket {
    position: relative;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 6px;
    color: var(--color-main) !important;
    border: none !important;
    padding: 9px 24px 9px 22px !important;
    border-radius: 0 !important;
    box-shadow: none !important;
    overflow: visible;
    z-index: 1;
    text-decoration: none;
    /* Multiple backgrounds: solid color + dashed line */
    background-color: #ffd564;
    background-image: 
        repeating-linear-gradient(
            to bottom,
            transparent,
            transparent 2px,
            rgba(255, 255, 255, 0.6) 2px,
            rgba(255, 255, 255, 0.6) 4px
        );
    background-size: 
        1px 6px;
    background-position: 
        calc(100% - 30px) center;
    background-repeat: 
        repeat-y;
}

/* Left semi-circular cutout */
.btn-ticket::before {
    content: '';
    position: absolute;
    left: -9px;
    top: 50%;
    transform: translateY(-50%);
    width: 18px;
    height: 18px;
    background: #ffffff;
    border-radius: 50%;
    z-index: 2;
}

/* Right semi-circular cutout */
.btn-ticket::after {
    content: '';
    position: absolute;
    right: -9px;
    top: 50%;
    transform: translateY(-50%);
    width: 18px;
    height: 18px;
    background: #ffffff;
    border-radius: 50%;
    z-index: 2;
}

.btn-ticket:hover {
    background-color: #fe505a !important;
    color: #ffffff !important;
}

.ticket-star {
    display: inline-block;
    font-size: 16px;
    color: var(--color-main);
    line-height: 1;
    margin-right: 2px;
}

.ticket-text {
    display: inline-block;
    color: var(--color-main);
   
    text-transform: none;
    letter-spacing: 0.3px;
    font-size: 12px;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    var modal = document.getElementById('authModal');
    var loginLinks = document.querySelectorAll('.open-login-modal');
    var registerLinks = document.querySelectorAll('.open-register-modal');
    var closeBtn = document.querySelector('.auth-close');
    var tabContents = document.querySelectorAll('.auth-tab-content');

    // Lưu vị trí scroll hiện tại
    var scrollPosition = 0;

    // Mở modal
    function openModal() {
        // Lưu vị trí scroll hiện tại
        scrollPosition = window.pageYOffset || document.documentElement.scrollTop;
        
        // Thêm class modal-open để ngăn scroll (không cần padding-right vì scrollbar luôn hiển thị trên html)
        document.body.classList.add('modal-open');
        document.body.style.top = '-' + scrollPosition + 'px';
        modal.style.display = 'block';
    }

    // Đóng modal
    function closeModal() {
        document.body.classList.remove('modal-open');
        document.body.style.top = '';
        // Khôi phục vị trí scroll
        window.scrollTo(0, scrollPosition);
        modal.style.display = 'none';
    }

    // Mở modal đăng nhập
    loginLinks.forEach(function(link) {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            openModal();
            switchTab('login');
        });
    });

    // Mở modal đăng ký
    registerLinks.forEach(function(link) {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            openModal();
            // Mở form đăng ký trực tiếp
            switchTab('register');
        });
    });

    // Đóng modal
    closeBtn.addEventListener('click', function() {
        closeModal();
    });

    // Đóng modal khi click bên ngoài
    window.addEventListener('click', function(e) {
        if (e.target == modal) {
            closeModal();
        }
    });

    // Chuyển đổi tab
    function switchTab(tabName) {
        tabContents.forEach(function(content) {
            if (content.id === tabName + '-tab') {
                content.classList.add('active');
            } else {
                content.classList.remove('active');
            }
        });
    }
    
    // Hàm chuyển sang form đăng ký (gọi từ button)
    window.switchToRegister = function() {
        switchTab('register');
    };
    
    // Hàm chuyển về form đăng nhập (gọi từ button)
    window.switchToLogin = function() {
        switchTab('login');
    };

    // Toggle password visibility
    document.addEventListener('click', function(e) {
        var target = e.target;
        // Kiểm tra nếu click vào toggle button (có thể là span hoặc icon bên trong)
        if (target && (target.classList.contains('toggle-password-popup') || 
                       (target.parentElement && target.parentElement.classList.contains('toggle-password-popup')))) {
            e.preventDefault();
            e.stopPropagation();
            
            var toggleBtn = target.classList.contains('toggle-password-popup') ? target : target.parentElement;
            var targetId = toggleBtn.getAttribute('data-target');
            var input = document.getElementById(targetId);
            
            if (input) {
                if (input.type === 'password') {
                    input.type = 'text';
                    toggleBtn.classList.remove('fa-eye');
                    toggleBtn.classList.add('fa-eye-slash');
                } else if (input.type === 'text') {
                    input.type = 'password';
                    toggleBtn.classList.remove('fa-eye-slash');
                    toggleBtn.classList.add('fa-eye');
                }
            }
            return false;
        }
    }, true); // Sử dụng capture phase để bắt sớm hơn

    // Xử lý form đăng ký popup với AJAX
    var registerFormPopup = document.getElementById('register-form-popup');
    if (registerFormPopup) {
        registerFormPopup.addEventListener('submit', function(e) {
            e.preventDefault();
            
            var formData = new FormData(this);
            
            var submitBtn = this.querySelector('button[type="submit"]');
            var originalText = submitBtn ? submitBtn.textContent : '';
            
            // Disable button và hiển thị loading
            if (submitBtn) {
                submitBtn.disabled = true;
                submitBtn.textContent = 'ĐANG XỬ LÝ...';
            }
            
            // Gửi AJAX request
            var xhr = new XMLHttpRequest();
            xhr.open('POST', this.action, true);
            xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
            
            xhr.onload = function() {
                if (xhr.status === 200) {
                    try {
                        var response = JSON.parse(xhr.responseText);
                        
                        // Khôi phục button
                        if (submitBtn) {
                            submitBtn.disabled = false;
                            submitBtn.textContent = originalText;
                        }
                        
                        if (response.success) {
                            // Đăng ký thành công
                            alert(response.message);
                            // Đóng modal và chuyển sang tab đăng nhập
                            closeModal();
                            // Có thể reload trang hoặc chuyển sang tab đăng nhập
                            setTimeout(function() {
                                openModal();
                                switchTab('login');
                            }, 500);
                        } else {
                            // Hiển thị lỗi
                            alert(response.message);
                        }
                    } catch (e) {
                        // Nếu không parse được JSON, có thể server trả về HTML
                        console.error('Error parsing response:', e);
                        alert('Có lỗi xảy ra. Vui lòng thử lại.');
                        if (submitBtn) {
                            submitBtn.disabled = false;
                            submitBtn.textContent = originalText;
                        }
                    }
                } else {
                    alert('Có lỗi xảy ra. Vui lòng thử lại.');
                    if (submitBtn) {
                        submitBtn.disabled = false;
                        submitBtn.textContent = originalText;
                    }
                }
            };
            
            xhr.onerror = function() {
                alert('Có lỗi kết nối. Vui lòng thử lại.');
                if (submitBtn) {
                    submitBtn.disabled = false;
                    submitBtn.textContent = originalText;
                }
            };
            
            xhr.send(formData);
        });
    }

    // Xử lý form đăng nhập: submit bằng AJAX và hiển thị lỗi trong popup
    var loginFormPopup = document.getElementById('login-form-popup');
    if (loginFormPopup) {
        loginFormPopup.addEventListener('submit', function(e) {
            e.preventDefault();
            
            var form = this;
            var submitBtn = form.querySelector('button[type="submit"]');
            var originalBtnText = submitBtn ? submitBtn.textContent : '';
            
            // Lấy redirect URL từ sessionStorage nếu có
            var redirectUrl = sessionStorage.getItem('redirect_after_login');
            if (redirectUrl) {
                var redirectInput = document.getElementById('redirect-after-login-input');
                if (redirectInput) {
                    redirectInput.value = redirectUrl;
                }
            }
            
            // Xóa thông báo lỗi cũ nếu có
            var oldError = form.querySelector('.login-error-message');
            if (oldError) {
                oldError.remove();
            }
            
            // Disable nút submit
            if (submitBtn) {
                submitBtn.disabled = true;
                submitBtn.textContent = 'Đang xử lý...';
            }
            
            // Lấy dữ liệu form
            var formData = new FormData(form);
            formData.append('ajax', '1'); // Đánh dấu là AJAX request
            
            // Gửi AJAX request
            var xhr = new XMLHttpRequest();
            xhr.open('POST', form.action, true);
            xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
            
            xhr.onload = function() {
                if (submitBtn) {
                    submitBtn.disabled = false;
                    submitBtn.textContent = originalBtnText;
                }
                
                if (xhr.status === 200) {
                    try {
                        var response = JSON.parse(xhr.responseText);
                        
                        if (response.success === true) {
                            // Đăng nhập thành công - redirect
                            if (response.redirect_url) {
                                window.location.href = response.redirect_url;
                            } else {
                                window.location.reload();
                            }
                        } else {
                            // Đăng nhập thất bại - hiển thị lỗi trong popup
                            var errorMsg = response.message || 'Email hoặc mật khẩu không đúng!';
                            var errorDiv = document.createElement('div');
                            errorDiv.className = 'login-error-message';
                            errorDiv.style.cssText = 'background-color: #f8d7da; color: #721c24; padding: 10px 15px; border-radius: 4px; margin-bottom: 15px; border: 1px solid #f5c6cb; font-size: 14px;';
                            errorDiv.innerHTML = '<i class="fa fa-exclamation-circle"></i> ' + errorMsg;
                            
                            // Chèn thông báo lỗi vào đầu form
                            var fieldWrap = form.querySelector('.field-wrap');
                            if (fieldWrap && fieldWrap.parentNode) {
                                fieldWrap.parentNode.insertBefore(errorDiv, fieldWrap);
                            } else {
                                form.insertBefore(errorDiv, form.firstChild);
                            }
                            
                            // Scroll đến thông báo lỗi
                            errorDiv.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
                        }
                    } catch(e) {
                        console.error('Error parsing response:', e);
                        alert('Có lỗi xảy ra khi đăng nhập. Vui lòng thử lại.');
                    }
                } else {
                    alert('Có lỗi xảy ra khi đăng nhập. Vui lòng thử lại.');
                }
            };
            
            xhr.onerror = function() {
                if (submitBtn) {
                    submitBtn.disabled = false;
                    submitBtn.textContent = originalBtnText;
                }
                alert('Có lỗi xảy ra khi kết nối đến server. Vui lòng thử lại.');
            };
            
            xhr.send(formData);
        });
    }

    // Xóa sessionStorage redirect_after_login nếu user đã đăng nhập (tránh redirect không mong muốn)
    var isLoggedIn = <?php echo $this->session->userdata('logged_in') ? 'true' : 'false'; ?>;
    if (isLoggedIn && sessionStorage.getItem('redirect_after_login')) {
        // Nếu đã đăng nhập và có redirect URL trong sessionStorage, xóa nó
        // (vì có thể đã redirect thành công hoặc user đã ở trang khác)
        sessionStorage.removeItem('redirect_after_login');
    }

    // Tự động mở popup đăng nhập nếu có tham số show_login=1 trong URL
    var urlParams = new URLSearchParams(window.location.search);
    if (urlParams.get('show_login') === '1') {
        // Xóa tham số khỏi URL để tránh mở lại khi refresh
        var newUrl = window.location.pathname;
        var otherParams = new URLSearchParams(window.location.search);
        otherParams.delete('show_login');
        if (otherParams.toString()) {
            newUrl += '?' + otherParams.toString();
        }
        if (window.location.hash) {
            newUrl += window.location.hash;
        }
        window.history.replaceState({}, '', newUrl);
        
        // Mở popup đăng nhập
        setTimeout(function() {
            openModal();
            switchTab('login');
        }, 100);
    }
});
</script>

<!-- AI Chatbot Widget - Hiển thị trên mọi trang -->
<?php $this->load->view('chatbot_view'); ?>