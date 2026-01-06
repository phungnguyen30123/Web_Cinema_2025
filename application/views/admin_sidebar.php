<?php
// Lấy role từ session
$user_role = $this->session->userdata('user_role');
$user_role = $user_role ? $user_role : 'user'; // Mặc định là 'user' nếu không có

// Xác định menu items dựa trên role
$default_menu_items = array();

if ($user_role == 'admin') {
    // Admin: hiển thị 5 menu
    $default_menu_items = array(
        array(
            'url' => 'index.php/showadmin_controller',
            'icon' => 'bx bx-user',
            'label' => 'Quản lý khách hàng',
            'controller' => 'showadmin_controller',
            'method' => 'index'
        ),
        array(
            'url' => 'index.php/showadmin_controller/index_qlnv',
            'icon' => 'bx bx-id-card',
            'label' => 'Quản lý nhân viên',
            'controller' => 'showadmin_controller',
            'method' => 'index_qlnv'
        ),
        array(
            'url' => 'index.php/Qlylich_controller/indexCalendar',
            'icon' => 'bx bx-calendar',
            'label' => 'Quản lý lịch chiếu',
            'controller' => 'Qlylich_controller',
            'method' => 'indexCalendar'
        ),
        array(
            'url' => 'index.php/Nhanvien_controller/index_xacnhanve',
            'icon' => 'bx bx-cart-alt',
            'label' => 'Xác nhận vé',
            'controller' => 'Nhanvien_controller',
            'method' => 'index_xacnhanve'
        ),
        array(
            'url' => 'index.php/Nhanvien_controller',
            'icon' => 'bx bx-movie',
            'label' => 'Quản lý phim',
            'controller' => 'Nhanvien_controller',
            'method' => 'index'
        )
    );
} elseif ($user_role == 'staff') {
    // Nhân viên: hiển thị 3 menu
    $default_menu_items = array(
        array(
            'url' => 'index.php/Qlylich_controller/indexCalendar',
            'icon' => 'bx bx-calendar',
            'label' => 'Quản lý lịch chiếu',
            'controller' => 'Qlylich_controller',
            'method' => 'indexCalendar'
        ),
        array(
            'url' => 'index.php/Nhanvien_controller/index_xacnhanve',
            'icon' => 'bx bx-cart-alt',
            'label' => 'Xác nhận vé',
            'controller' => 'Nhanvien_controller',
            'method' => 'index_xacnhanve'
        ),
        array(
            'url' => 'index.php/Nhanvien_controller',
            'icon' => 'bx bx-movie',
            'label' => 'Quản lý phim',
            'controller' => 'Nhanvien_controller',
            'method' => 'index'
        )
    );
}

// Nếu có sidebar_menu_items được truyền vào, sử dụng nó, nếu không dùng default
$menu_items = isset($sidebar_menu_items) && is_array($sidebar_menu_items) ? $sidebar_menu_items : $default_menu_items;

// Đánh dấu menu active dựa trên controller và method hiện tại
$current_controller = strtolower($this->router->class);
$current_method = strtolower($this->router->method);

foreach ($menu_items as &$item) {
    // Reset active state
    if (!isset($item['active'])) {
        $item['active'] = false;
    }
    
    // Đánh dấu active nếu controller và method khớp
    if (isset($item['controller']) && isset($item['method'])) {
        $item_controller = strtolower($item['controller']);
        $item_method = strtolower($item['method']);
        
        if ($item_controller == $current_controller && $item_method == $current_method) {
            $item['active'] = true;
        }
    }
}
unset($item);
?>

<!-- Sidebar menu-->
<div class="app-sidebar__overlay" data-toggle="sidebar"></div>
<aside class="app-sidebar">
  <div class="app-sidebar__user">
    <img class="app-sidebar__user-avatar" src="<?php echo base_url(); ?>images/logo_vstar.png" width="200px" alt="User Image">
    <div>
      <p class="app-sidebar__user-name" style="color: blue;"><b>XIN CHÀO</b></p>
      <p class="app-sidebar__user-designation">Chào mừng bạn trở lại</p>
    </div>
  </div>
  <hr>
  <ul class="app-menu">
    <?php if (!empty($menu_items)): ?>
      <?php foreach ($menu_items as $item): ?>
        <li>
          <a class="app-menu__item <?php echo isset($item['active']) && $item['active'] ? 'active' : ''; ?>" 
             href="<?php echo base_url($item['url']); ?>">
            <i class='app-menu__icon <?php echo isset($item['icon']) ? $item['icon'] : 'bx bx-task'; ?>'></i>
            <span class="app-menu__label"><?php echo $item['label']; ?></span>
          </a>
        </li>
      <?php endforeach; ?>
    <?php else: ?>
      <!-- Fallback nếu không có menu items -->
      <li><a class="app-menu__item" href="<?php echo base_url(); ?>index.php/Index_controller">
        <i class='app-menu__icon bx bx-home'></i>
        <span class="app-menu__label">Trang chủ</span></a></li>
    <?php endif; ?>
  </ul>
</aside>

