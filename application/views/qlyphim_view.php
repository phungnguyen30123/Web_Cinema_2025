<?php
// Set up data for the layout
$page_title = 'Quản lý phim';
$page_breadcrumb = 'Quản lý phim';
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
              <th>ID</th>
              <th>TÊN PHIM</th>
              <th>THỜI GIAN</th>
              <th>DIỄN VIÊN</th>
              <th>QUỐC GIA</th>
              <th>MÔ TẢ</th>
              <th>KHỞI CHIẾU</th>
              <th>THỂ LOẠI</th>
              <th>ẢNH</th>
              <th>XÓA</th>
              <th>SỬA</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($dulieutucontroller as $key => $value): ?>
            <tr>
              <td><?php echo $value['id'] ?></td>
              <td><a href="Qlylich_controller/indexNgay/<?php echo $value['id'] ?>"><?php echo $value['title'] ?></a></td>
              <td><?php echo $value['duration'] ?></td>
              <td><?php echo $value['actor'] ?></td>
              <td><?php echo $value['country'] ?></td>
              <td><?php echo $value['description'] ?></td>
              <td><?php echo $value['open_date'] ?></td>
              <td><?php echo $value['category'] ?></td>
              <td><a href="Qlyanh_controller/index/<?php echo $value['id'] ?>">Quản lý ảnh</a></td>
              <td><a href="Nhanvien_controller/deletePhim/<?php echo $value['id'] ?>" class="btn btn-danger xoa"><i class="far fa-trash-alt"></i></a></td>
              <td><a href="EditPhim_controller/editPhim/<?php echo $value['id'] ?>" class="btn btn-danger sua"><i class="fas fa-edit"></i></a></td>
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
