<?php
// Set up data for the layout
$page_title = 'Xác nhận vé';
$page_breadcrumb = 'Xác nhận vé';
$show_clock = true;

// Sidebar sẽ tự động lấy menu dựa trên role (admin/staff)

// Start output buffering to capture content
ob_start();
?>

<div class="row">
  <div class="col-md-12">
    <div class="tile">
      <div class="tile-body">
        <div class="row element-button">
          <div class="col-sm-2">
            <a class="btn btn-add btn-sm" href="<?php echo base_url(); ?>index.php/InsertPhim_controller" title="Thêm">
              <i class="fas fa-plus"></i> Thêm phim mới
            </a>
          </div>
        </div>
        
        <table class="table table-hover table-bordered" id="sampleTable">
          <thead>
            <tr>
              <th>Id Vé</th>
              <th>Id Khách hàng</th>
              <th>Id Lịch Chiếu</th>
              <th>Tổng tiền</th>
              <th>Xác nhận</th>
              <th>Đã lấy vé</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($dulieubookingtucon as $value): ?>
            <tr>
              <td><?= $value['id_ve']; ?></td>
              <td><?= $value['id_user']; ?></td>
              <td><?= $value['id_calendar']; ?></td>
              <td><?= $value['tong_tien']; ?></td>
              <td>
                <a href="<?php echo base_url(); ?>index.php/Nhanvien_controller/xacnhanve/<?= $value['id_ve']; ?>" class="btn btn-danger sua">
                  <i class="fas fa-edit"></i>
                </a>
              </td>
              <td><?= $value['status']; ?></td>
            </tr>
            <?php endforeach ?>
          </tbody>
        </table>
        
        <?php if(isset($pagination_links)): ?>
        <div class="pagination-wrapper" style="margin-top: 20px; text-align: center;">
          <?php echo $pagination_links; ?>
        </div>
        <?php endif; ?>
      </div>
    </div>
  </div>
</div>

<?php
// Get the content
$content = ob_get_clean();

// Load the layout
$this->load->view('admin_layout', array(
    'page_title' => $page_title,
    'page_breadcrumb' => $page_breadcrumb,
    'show_clock' => $show_clock,
    'content' => $content
));
?>
