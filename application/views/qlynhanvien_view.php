<?php
// Set up data for the layout
$page_title = 'Quản lý nhân viên';
$page_breadcrumb = 'Quản lý nhân viên';
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
            <a class="btn btn-add btn-sm" href="index_insertnv" title="Thêm">
              <i class="fas fa-plus"></i> Thêm nhân viên
            </a>
          </div>
        </div>
        
        <table class="table table-hover table-bordered" id="sampleTable">
          <thead>
            <tr>
              <th>ID</th>
              <th>Email</th>
              <th>Fullname</th>
              <th>Birthday</th>
              <th>sdt</th>
              <th>Address</th>
              <th>Xóa</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($dulieuvaocontroller as $key => $value): ?>
            <tr>
              <td><?= $value['id'] ?></td>
              <td><?= $value['email'] ?></td>
              <td><?= $value['fullname'] ?></td>
              <td><?= $value['birthday'] ?></td>
              <td><?= $value['sdt'] ?></td>
              <td><?= $value['address'] ?></td>
              <td>
                <button class="btn btn-primary btn-sm trash" type="button" title="Xóa">
                  <a href="xoanv/<?= $value['id'] ?>" class="btn btn-danger xoa">
                    <i class="fas fa-trash-alt"></i>
                  </a>
                </button>
              </td>
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
