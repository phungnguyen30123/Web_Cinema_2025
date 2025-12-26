# Hướng dẫn Refactor Views Quản trị

## Tổng quan
Đã tách CSS inline và các phần chung (header, sidebar) ra các file riêng để dễ bảo trì và tái sử dụng.

## Cấu trúc mới

### Files đã tạo:
1. **css/admin-common.css** - Chứa tất cả CSS chung được trích xuất từ các view
2. **application/views/admin_layout.php** - Layout cơ sở cho tất cả trang admin
3. **application/views/admin_header.php** - Header chung cho admin
4. **application/views/admin_sidebar.php** - Sidebar chung cho admin (có thể tùy chỉnh menu)

### Files đã refactor:
- ✅ `taikhoan_view.php` - Đã refactor hoàn chỉnh

## Cách sử dụng Layout mới

### Cấu trúc view mới:

```php
<?php
// Set up data for the layout
$page_title = 'Tiêu đề trang';
$page_breadcrumb = 'Breadcrumb text';
$show_clock = true; // hoặc false

// Sidebar menu items (tùy chọn)
$sidebar_menu_items = array(
    array(
        'url' => 'index.php/controller/method',
        'icon' => 'bx bx-task',
        'label' => 'Tên menu',
        'active' => true // hoặc false
    ),
    // ... thêm các menu items khác
);

// Start output buffering để capture content
ob_start();
?>

<!-- Nội dung chính của trang -->
<div class="row">
    <!-- Your content here -->
</div>

<?php
// Get the content
$content = ob_get_clean();

// Load the layout
$this->load->view('admin_layout', array(
    'page_title' => $page_title,
    'page_breadcrumb' => $page_breadcrumb,
    'show_clock' => $show_clock,
    'sidebar_menu_items' => $sidebar_menu_items,
    'content' => $content
));
?>
```

## Các bước refactor view cũ

### Bước 1: Backup file gốc
```powershell
Copy-Item 'application\views\view_name.php' 'application\views\view_name.php.backup'
```

### Bước 2: Xóa các phần sau từ view cũ:
- ❌ Toàn bộ thẻ `<style>...</style>` (CSS đã được chuyển vào `admin-common.css`)
- ❌ Phần `<head>...</head>` (đã có trong `admin_layout.php`)
- ❌ Phần `<header class="app-header">...</header>` (đã có trong `admin_header.php`)
- ❌ Phần `<aside class="app-sidebar">...</aside>` (đã có trong `admin_sidebar.php`)
- ❌ Thẻ đóng `</body>` và `</html>` (đã có trong `admin_layout.php`)
- ❌ Script `admin-sidebar.js` ở cuối (đã có trong `admin_layout.php`)

### Bước 3: Giữ lại:
- ✅ Phần nội dung chính trong `<main class="app-content">` (chỉ giữ phần bên trong, không giữ thẻ `<main>`)
- ✅ Tất cả logic PHP và HTML của nội dung

### Bước 4: Thêm wrapper code:
- Thêm phần setup ở đầu (page_title, breadcrumb, sidebar_menu_items)
- Wrap content trong `ob_start()` và `ob_get_clean()`
- Load layout ở cuối

## Ví dụ: Refactor qlyphim_view.php

### Trước (cũ):
```php
<!DOCTYPE html>
<html>
<head>
    <!-- CSS và style tags -->
    <style>/* hàng nghìn dòng CSS */</style>
</head>
<body>
    <header>...</header>
    <aside>...</aside>
    <main>
        <!-- Content -->
    </main>
    <script>...</script>
</body>
</html>
```

### Sau (mới):
```php
<?php
$page_title = 'Quản lý phim';
$page_breadcrumb = 'Quản lý phim';
$show_clock = true;

$sidebar_menu_items = array(
    array(
        'url' => 'index.php/Nhanvien_controller/index_xacnhanve',
        'icon' => 'bx bx-cart-alt',
        'label' => 'Xác nhận vé',
        'active' => false
    ),
    array(
        'url' => 'index.php/Nhanvien_controller',
        'icon' => 'bx bx-id-card',
        'label' => 'Quản lý phim',
        'active' => true
    )
);

ob_start();
?>

<!-- Chỉ giữ phần content -->
<div class="row">
    <div class="col-md-12">
        <!-- Your content here -->
    </div>
</div>

<?php
$content = ob_get_clean();
$this->load->view('admin_layout', array(
    'page_title' => $page_title,
    'page_breadcrumb' => $page_breadcrumb,
    'show_clock' => $show_clock,
    'sidebar_menu_items' => $sidebar_menu_items,
    'content' => $content
));
?>
```

## Các view cần refactor:
- [ ] `qlynhanvien_view.php`
- [ ] `qlyphim_view.php`
- [ ] `qlylich_view.php`
- [ ] `qlygio_view.php`
- [ ] `xacnhanve_view.php`
- [ ] Các view admin khác có cấu trúc tương tự

## Lưu ý:
1. CSS đã được chuyển vào `css/admin-common.css`, không cần thêm `<style>` tags nữa
2. Nếu view có CSS riêng không chung, có thể thêm vào `$additional_css` array
3. Nếu view có JavaScript riêng, có thể thêm vào `$additional_js` array
4. Sidebar menu có thể tùy chỉnh cho từng view thông qua `$sidebar_menu_items`

## Kiểm tra sau khi refactor:
- [ ] Trang hiển thị đúng layout
- [ ] CSS được load từ file chung
- [ ] Header và sidebar hiển thị đúng
- [ ] Menu sidebar hoạt động đúng
- [ ] Nội dung chính hiển thị đúng
- [ ] JavaScript hoạt động bình thường

