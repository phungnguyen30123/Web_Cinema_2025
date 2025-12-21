<?php
// 1. KIỂM TRA TRẠNG THÁI ĐĂNG NHẬP
$is_logged_in = $this->session->has_userdata('vipmember') ||
    $this->session->has_userdata('vipmembe') ||
    $this->session->has_userdata('vip2');

// 2. LẤY TÊN HIỂN THỊ ƯU TIÊN (Nếu không có tên, hiển thị 'Tài khoản')
$user_display_name = 'Tài khoản';
$logout_url = base_url() . 'index.php/showuser_controller/logout';

if ($is_logged_in) {
    // 🔥 ƯU TIÊN LẤY TÊN ĐẦY ĐỦ TỪ SESSION
    $name_from_session = $this->session->userdata('user_fullname');

    if (!empty($name_from_session)) {
        // Lấy tên người dùng, nếu tên đầy đủ quá dài, có thể chỉ lấy tên đầu tiên.
        // Tạm thời hiển thị tên đầy đủ:
        $user_display_name = $name_from_session;
    } else {
        // Nếu không lấy được tên, fallback về email (phần trước @)
        $user_email = $this->session->userdata('vipmember') ?: $this->session->userdata('vipmembe') ?: $this->session->userdata('vip2');
        if (strpos($user_email, '@') !== false) {
            $user_display_name = explode('@', $user_email)[0];
        } else {
            $user_display_name = 'Khách hàng';
        }
    }
}

// 3. XÁC ĐỊNH CLASS CHO HEADER (hỗ trợ class đặc biệt cho trang chủ)

$header_class = isset($header_class_extra) ? 'header-wrapper ' . $header_class_extra : 'header-wrapper';
?>
<?php
            // Lấy thông tin từ session
            $role = $this->session->userdata('user_role');
            $is_logged_in = $this->session->userdata('logged_in');
            $user_name = $this->session->userdata('user_fullname');
            ?>

<header class="<?php echo $header_class; ?>">
    <div class="container">
        <a href="<?php echo base_url(); ?>index.php/Index_controller" class="logo">
            <img alt='logo' src="<?php echo base_url(); ?>images/logoid.png">
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
                    <a href="<?php echo base_url(); ?>index.php/contract_controller">Liên hệ</a>
                </li>


                <?php if ($role === 'admin' || $role === 'staff'): ?>
                    <li style="background: rgba(254, 80, 90, 0.1); border-radius: 5px;">
                        <a href="#" style="color: #fe505a !important; font-weight: bold;">QUẢN TRỊ</a>
                        <ul>
                            <li><a href="<?php echo base_url(); ?>index.php/Nhanvien_controller">Quản lý Phim</a></li>
                            <li><a href="<?php echo base_url(); ?>index.php/Nhanvien_controller/index_xacnhanve">Duyệt vé đặt</a></li>
                            
                            <?php if ($role === 'admin'): ?>
                                <li class="divider"></li>
                                <li><a href="<?php echo base_url(); ?>index.php/showadmin_controller/index_qlnv">Quản lý Nhân viên</a></li>
                                <li><a href="<?php echo base_url(); ?>index.php/showadmin_controller">Quản lý User</a></li>
                            <?php endif; ?>
                        </ul>
                    </li>
                <?php endif; ?>

                <li>
                    <?php if ($is_logged_in): ?>
                        <a href="#" style="color: #ffd564;"><?php echo $user_name; ?></a>
                        <ul>
                            <li><a href="<?php echo base_url(); ?>index.php/showuser_controller/indexshowuser">Thông tin cá nhân</a></li>
                            <li><a href="<?php echo base_url(); ?>index.php/Login_register/logout">Đăng xuất</a></li>
                        </ul>
                    <?php else: ?>
                        <a href="#" class="open-login-modal">Đăng nhập</a>
                    <?php endif; ?>
                </li>
            </ul>
            <a href="<?php echo base_url(); ?>index.php/ShowPhim/PhimDC" class="btn btn-md btn--warning btn--book " style="margin-right:-630px ; float: right;">MUA VÉ</a>
        </nav>
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
                <div class="illustration-characters">
                    <div class="char char-1"></div>
                    <div class="char char-2"></div>
                    <div class="char char-3"></div>
                </div>
            </div>

            <!-- Title -->
            <h2 class="auth-title">Đăng Nhập Tài Khoản</h2>

            <form id="login-form-popup" class="login-form-popup" action="<?php echo base_url(); ?>index.php/Login_register/login" method="post" enctype="multidata/form-data" autocomplete="off">
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
                <div class="illustration-characters">
                    <div class="char char-1"></div>
                    <div class="char char-2"></div>
                    <div class="char char-3"></div>
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

<?php if($this->session->flashdata('error_msg')): ?>
    <script>
        // Sử dụng alert mặc định hoặc SweetAlert2 nếu có tích hợp
        alert("<?php echo $this->session->flashdata('error_msg'); ?>");
    </script>
<?php endif; ?>

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
        from {
            opacity: 0;
        }

        to {
            opacity: 1;
        }
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
        background-image: repeating-linear-gradient(45deg,
                transparent,
                transparent 10px,
                rgba(255, 255, 255, 0.1) 10px,
                rgba(255, 255, 255, 0.1) 20px);
    }

    .illustration-characters {
        position: relative;
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        padding-top: 15px;
    }

    .char {
        width: 45px;
        height: 45px;
        border-radius: 50%;
        position: relative;
    }

    .char-1 {
        background: linear-gradient(135deg, #d4a574 0%, #c8965f 100%);
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.2);
        position: relative;
    }

    .char-1::before {
        content: '';
        position: absolute;
        top: 6px;
        left: 50%;
        transform: translateX(-50%);
        width: 14px;
        height: 5px;
        background: #b8854f;
        border-radius: 50%;
    }

    .char-1::after {
        content: '';
        position: absolute;
        top: 2px;
        left: 14px;
        width: 5px;
        height: 5px;
        background: #b8854f;
        border-radius: 50%;
        box-shadow: 14px 0 0 #b8854f;
    }

    .char-2 {
        background: #fff;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.2);
        position: relative;
    }

    .char-2::before {
        content: '';
        position: absolute;
        top: -6px;
        left: 50%;
        transform: translateX(-50%);
        width: 35px;
        height: 18px;
        background: #4a90e2;
        border-radius: 50% 50% 0 0;
        box-shadow: 0 2px 0 #357abd;
    }

    .char-2::after {
        content: 'X';
        position: absolute;
        top: 1px;
        left: 50%;
        transform: translateX(-50%);
        color: white;
        font-weight: bold;
        font-size: 10px;
        z-index: 1;
    }

    .char-3 {
        background: #2c5aa0;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.2);
        position: relative;
    }

    .char-3::before {
        content: '';
        position: absolute;
        top: -6px;
        left: 50%;
        transform: translateX(-50%);
        width: 35px;
        height: 18px;
        background: #1a3d6b;
        border-radius: 50% 50% 0 0;
    }

    .char-3::after {
        content: 'W';
        position: absolute;
        top: 3px;
        left: 50%;
        transform: translateX(-50%);
        color: #ffd700;
        font-weight: bold;
        font-size: 11px;
        z-index: 1;
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

        .illustration-characters {
            gap: 8px;
        }

        .char {
            width: 40px;
            height: 40px;
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
    });
</script>