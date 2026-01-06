<?php
// Set up data for the layout
$page_title = 'Quản lý lịch chiếu phim';
$page_breadcrumb = 'Quản lý lịch chiếu';
$show_clock = false;

// Additional CSS for this view
$additional_css = array('css/qlylich-custom.css');

// Additional JavaScript
$additional_js = array(
    'https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js',
    'https://cdnjs.cloudflare.com/ajax/libs/datejs/1.0/date.min.js'
);

// Sidebar sẽ tự động lấy menu dựa trên role (admin/staff)

// Start output buffering to capture content
ob_start();
?>

<div class="container-fluid">
    <div class="row">
        <!-- Phần quản lý ngày chiếu -->
        <div class="col-md-6">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">Quản lý ngày chiếu</h4>
                </div>
                <div class="card-body">
                    <?php foreach ($dulieutucontrollerTit as $valuephim): ?>
                        <div class="mb-3">
                            <h5 class="card-title">Thêm ngày chiếu</h5>
                            <input type="hidden" name="id_movie" id="id_movie" value="<?= $valuephim['id'] ?>">
                            <p class="text-muted">Phim: <strong><?= $valuephim['id'] ?>: <?= $valuephim['title']; ?></strong></p>
                        </div>
                    <?php endforeach; ?>

                    <div class="mb-3">
                        <label for="day" class="form-label">Chọn ngày chiếu</label>
                        <input name="day" type="date" class="form-control" id="day" min="<?= date('Y-m-d') ?>">
                    </div>
                    <div class="mb-3">
                        <button type="button" class="btn btn-primary" id="nutthemngay">
                            <i class="fas fa-plus"></i> Thêm ngày chiếu
                        </button>
                    </div>

                    <!-- Danh sách ngày chiếu -->
                    <div class="mt-4">
                        <h5>Danh sách ngày chiếu</h5>
                        <?php if (!empty($dulieutucontroller)): ?>
                            <?php foreach ($dulieutucontroller as $value): ?>
                                <?php
                                $daychuadoi = $value["day"];
                                $daydadoi = date("d/m/Y", strtotime($daychuadoi));
                                $id_movie = $value['id_movie'];
                                ?>
                                <div class="card mb-2 border-primary">
                                    <div class="card-body p-2">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div class="flex-grow-1">
                                                <div class="form-group jquery_dayedit hidden-xs-up mb-2">
                                                    <input type="date" class="form-control dayedit" name="dayedit" value="<?= $daychuadoi ?>">
                                                </div>
                                                <div class="daychuaedit">
                                                    <input type="hidden" name="daychuaedit" class="daychuaedit" value="<?= $daychuadoi ?>">
                                                    <strong><?= $daydadoi ?></strong>
                                                </div>
                                            </div>
                                            <div class="btn-group btn-group-sm">
                                                <a href="../indexGio/<?= $value['id_movie'] ?>/<?php echo $daychuadoi ?>" class="btn btn-success btn-sm" title="Quản lý giờ chiếu">
                                                    <i class="fas fa-clock"></i> Giờ
                                                </a>
                                                <a data-href="<?php echo $daychuadoi ?>" class="btn btn-warning btn-xs nutedit" title="Sửa">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <a data-href="<?php echo $daychuadoi ?>" class="btn btn-danger btn-xs nutxoa" title="Xóa">
                                                    <i class="fas fa-trash"></i>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="jquery_button text-end hidden-xs-up">
                                            <a href="" class="btn btn-success btn-sm nutluu">LƯU</a>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <div class="alert alert-info">
                                <i class="fas fa-info-circle"></i> Chưa có ngày chiếu nào được thêm.
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>

        <!-- Phần quản lý giờ chiếu -->
        <div class="col-md-6">
            <div class="card">
                <div class="card-header bg-success text-white">
                    <h4 class="mb-0">Quản lý giờ chiếu</h4>
                </div>
                <div class="card-body">
                    <?php if (!empty($dulieutucontrollerTit)): ?>
                        <?php foreach ($dulieutucontrollerTit as $valuephim): ?>
                            <div class="mb-3">
                                <input type="hidden" name="id_movie_gio" id="id_movie_gio" value="<?= $valuephim['id'] ?>">
                                <h5 class="card-title">Thêm giờ chiếu</h5>
                                <p class="text-muted">Phim: <strong><?= $valuephim['id'] ?>: <?= $valuephim['title']; ?></strong></p>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>

                    <?php if (!empty($daytucontroller)): ?>
                        <?php foreach ($daytucontroller as $day): ?>
                            <div class="mb-3">
                                <input type="hidden" name="day_gio" id="day_gio" value="<?= $day['day'] ?>">
                                <p class="text-info"><strong>Ngày chiếu: <?= date("d/m/Y", strtotime($day['day'])) ?></strong></p>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <div class="alert alert-warning">
                            <i class="fas fa-exclamation-triangle"></i> Vui lòng thêm ngày chiếu trước khi thêm giờ chiếu.
                        </div>
                    <?php endif; ?>

                    <!-- Phần thêm giờ cho từng phòng -->
                    <div class="row">
                        <div class="col-sm-6">
                            <fieldset class="form-group border p-3 rounded">
                                <h5 class="text-primary">Phòng 1</h5>
                                <div class="mb-2">
                                    <label for="gio_phong1" class="form-label">Giờ chiếu</label>
                                    <input type="time" name="gio_phong1" id="gio_phong1" class="form-control">
                                </div>
                                <button type="button" class="btn btn-primary btn-sm" id="nutthemgiophong1" <?php if (empty($daytucontroller)) echo 'disabled'; ?>>
                                    <i class="fa fa-plus"></i> Thêm giờ
                                </button>
                            </fieldset>
                        </div>

                        <div class="col-sm-6">
                            <fieldset class="form-group border p-3 rounded">
                                <h5 class="text-success">Phòng 2</h5>
                                <div class="mb-2">
                                    <label for="gio_phong2" class="form-label">Giờ chiếu</label>
                                    <input type="time" name="gio_phong2" id="gio_phong2" class="form-control">
                                </div>
                                <button type="button" class="btn btn-success btn-sm" id="nutthemgiophong2" <?php if (empty($daytucontroller)) echo 'disabled'; ?>>
                                    <i class="fa fa-plus"></i> Thêm giờ
                                </button>
                            </fieldset>
                        </div>
                    </div>

                    <!-- Danh sách giờ chiếu -->
                    <div class="mt-4">
                        <h5>Danh sách giờ chiếu</h5>

                        <!-- Phòng 1 -->
                        <div class="mb-3">
                            <h6 class="text-primary">Phòng 1</h6>
                            <div id="danhsach_gio_phong1">
                                <?php foreach ($dulieutucontroller1 as $value1): ?>
                                    <div class="d-flex justify-content-between align-items-center border rounded p-2 mb-1">
                                        <div class="flex-grow-1">
                                            <div class="jquery_gioedit hidden-xs-up">
                                                <input type="time" name="gioedit" id="gioedit" class="form-control form-control-sm gioedit" value="<?= $value1['time']; ?>">
                                            </div>
                                            <div class="giochuaedit">
                                                <strong><?= $value1['time']; ?></strong>
                                            </div>
                                        </div>
                                        <div class="btn-group btn-group-xs">
                                            <button data-href="<?= $value1['id_calendar']; ?>" class="btn btn-warning btn-xs nutedit">
                                                <i class="fa fa-pencil"></i>
                                            </button>
                                            <button data-href="<?= $value1['id_calendar']; ?>" class="btn btn-danger btn-xs nutxoa">
                                                <i class="fa fa-remove"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="jquery_button text-center hidden-xs-up mb-2">
                                        <a data-href="<?= $value1['id_calendar']; ?>" class="btn btn-success btn-xs nutluu">LƯU</a>
                                    </div>
                                <?php endforeach; ?>
                                <?php if (empty($dulieutucontroller1)): ?>
                                    <div class="text-muted small">Chưa có giờ chiếu nào</div>
                                <?php endif; ?>
                            </div>
                        </div>

                        <!-- Phòng 2 -->
                        <div class="mb-3">
                            <h6 class="text-primary">Phòng 2</h6>
                            <div id="danhsach_gio_phong2">
                                <?php foreach ($dulieutucontroller2 as $value2): ?>
                                    <div class="d-flex justify-content-between align-items-center border rounded p-2 mb-1">
                                        <div class="flex-grow-1">
                                            <div class="jquery_gioedit hidden-xs-up">
                                                <input type="time" name="gioedit" id="gioedit" class="form-control form-control-sm gioedit">
                                            </div>
                                            <div class="giochuaedit">
                                                <strong><?= $value2['time']; ?></strong>
                                            </div>
                                        </div>
                                        <div class="btn-group btn-group-xs">
                                            <button data-href="<?= $value2['id_calendar']; ?>" class="btn btn-warning btn-xs nutedit">
                                                <i class="fa fa-pencil"></i>
                                            </button>
                                            <button data-href="<?= $value2['id_calendar']; ?>" class="btn btn-danger btn-xs nutxoa">
                                                <i class="fa fa-remove"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="jquery_button text-center hidden-xs-up mb-2">
                                        <a data-href="<?= $value2['id_calendar']; ?>" class="btn btn-success btn-xs nutluu">LƯU</a>
                                    </div>
                                <?php endforeach; ?>
                                <?php if (empty($dulieutucontroller2)): ?>
                                    <div class="text-muted small">Chưa có giờ chiếu nào</div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
// Wait for jQuery to be loaded
function initQlyLichFull() {
    console.log('Initializing QlyLich Full...');

    var duongdan = '<?php echo base_url() ?>';

    console.log('Base URL:', duongdan);

    // Sự kiện nút thêm ngày
    $('#nutthemngay').click(function(event) {
        event.preventDefault();
        console.log('Add date button clicked');

        var id_movie = $('#id_movie').val();
        var day = $('#day').val();

        console.log('Movie ID:', id_movie, 'Day:', day);

        if (!day || day.trim() === '') {
            alert('Vui lòng chọn ngày!');
            $('#day').focus();
            return;
        }

        console.log('Sending AJAX request for date to:', duongdan+'index.php/Qlylich_controller/ajax_themngay/'+id_movie);

        $.ajax({
            url: duongdan+'index.php/Qlylich_controller/ajax_themngay/'+id_movie,
            type: 'POST',
            dataType: 'json',
            data: {day: day},
            beforeSend: function() {
                console.log('Sending date request...');
            }
        })
        .done(function(res) {
            if (res.success) {
                console.log('Date added successfully');
                // Reload page to show new date
                location.reload();
            } else {
                alert('Lỗi: ' + (res.message || 'Có lỗi xảy ra khi thêm ngày'));
            }
        })
        .fail(function(xhr, status, error) {
            console.error('AJAX Error:', xhr.responseText, status, error);
            alert('Có lỗi xảy ra khi gửi yêu cầu. Vui lòng thử lại.');
        });
    });

    // Sự kiện nút thêm giờ phòng 1
    $('#nutthemgiophong1').click(function(event) {
        event.preventDefault();
        console.log('Add time button for room 1 clicked');

        var id_phong = 1;
        var id_movie = $('#id_movie_gio').val();
        var day = $('#day_gio').val();
        var gio = $('#gio_phong1').val();

        console.log('Room:', id_phong, 'Movie ID:', id_movie, 'Day:', day, 'Time:', gio);

        if (!gio || gio.trim() === '') {
            alert('Vui lòng nhập giờ chiếu cho phòng 1!');
            $('#gio_phong1').focus();
            return;
        }

        console.log('Sending AJAX request for room 1 to:', duongdan+'index.php/Qlylich_controller/ajax_themgio/'+id_phong+'/'+gio);

        $.ajax({
            url: duongdan+'index.php/Qlylich_controller/ajax_themgio/'+id_phong+'/'+gio,
            type: 'POST',
            dataType: 'json',
            data: {id_movie: id_movie, day: day},
            beforeSend: function() {
                console.log('Sending request for room 1...');
            }
        })
        .done(function(response) {
            if (response && response.success === true) {
                var id_calendar = response.id_calendar;
                console.log('Time added successfully for room 1, ID:', id_calendar);

                // Add new time slot to the list
                var noidung = '<div class="d-flex justify-content-between align-items-center border rounded p-2 mb-1">' +
                    '<div class="flex-grow-1">' +
                        '<div class="jquery_gioedit hidden-xs-up">' +
                            '<input type="time" name="gioedit" id="gioedit" class="form-control form-control-sm gioedit">' +
                        '</div>' +
                        '<div class="giochuaedit">' +
                            '<strong>' + gio + '</strong>' +
                        '</div>' +
                    '</div>' +
                    '<div class="btn-group btn-group-xs">' +
                        '<button data-href="' + id_calendar + '" class="btn btn-warning btn-xs nutedit">' +
                            '<i class="fa fa-pencil"></i>' +
                        '</button>' +
                        '<button data-href="' + id_calendar + '" class="btn btn-danger btn-xs nutxoa">' +
                            '<i class="fa fa-remove"></i>' +
                        '</button>' +
                    '</div>' +
                '</div>' +
                '<div class="jquery_button text-center hidden-xs-up mb-2">' +
                    '<a data-href="' + id_calendar + '" class="btn btn-success btn-xs nutluu">LƯU</a>' +
                '</div>';

                $('#danhsach_gio_phong1').append(noidung);
                $('#gio_phong1').val('');
                alert('Thêm giờ chiếu thành công cho phòng 1!');
            } else {
                var errorMsg = response && response.message ? response.message : 'Có lỗi xảy ra khi thêm giờ chiếu!';
                alert(errorMsg);
            }
        })
        .fail(function(xhr, status, error) {
            console.error('AJAX Error:', status, error);
            try {
                var response = JSON.parse(xhr.responseText);
                if (response && response.message) {
                    alert(response.message);
                } else {
                    alert('Có lỗi xảy ra khi thêm giờ chiếu!');
                }
            } catch(e) {
                alert('Có lỗi xảy ra khi thêm giờ chiếu!');
            }
        });
    });

    // Sự kiện nút thêm giờ phòng 2
    $('#nutthemgiophong2').click(function(event) {
        event.preventDefault();
        console.log('Add time button for room 2 clicked');

        var id_phong = 2;
        var id_movie = $('#id_movie_gio').val();
        var day = $('#day_gio').val();
        var gio = $('#gio_phong2').val();

        console.log('Room:', id_phong, 'Movie ID:', id_movie, 'Day:', day, 'Time:', gio);

        if (!gio || gio.trim() === '') {
            alert('Vui lòng nhập giờ chiếu cho phòng 2!');
            $('#gio_phong2').focus();
            return;
        }

        console.log('Sending AJAX request for room 2 to:', duongdan+'index.php/Qlylich_controller/ajax_themgio/'+id_phong+'/'+gio);

        $.ajax({
            url: duongdan+'index.php/Qlylich_controller/ajax_themgio/'+id_phong+'/'+gio,
            type: 'POST',
            dataType: 'json',
            data: {id_movie: id_movie, day: day},
            beforeSend: function() {
                console.log('Sending request for room 2...');
            }
        })
        .done(function(response) {
            if (response && response.success === true) {
                var id_calendar = response.id_calendar;
                console.log('Time added successfully for room 2, ID:', id_calendar);

                // Add new time slot to the list
                var noidung = '<div class="d-flex justify-content-between align-items-center border rounded p-2 mb-1">' +
                    '<div class="flex-grow-1">' +
                        '<div class="jquery_gioedit hidden-xs-up">' +
                            '<input type="time" name="gioedit" id="gioedit" class="form-control form-control-sm gioedit">' +
                        '</div>' +
                        '<div class="giochuaedit">' +
                            '<strong>' + gio + '</strong>' +
                        '</div>' +
                    '</div>' +
                    '<div class="btn-group btn-group-xs">' +
                        '<button data-href="' + id_calendar + '" class="btn btn-warning btn-xs nutedit">' +
                            '<i class="fa fa-pencil"></i>' +
                        '</button>' +
                        '<button data-href="' + id_calendar + '" class="btn btn-danger btn-xs nutxoa">' +
                            '<i class="fa fa-remove"></i>' +
                        '</button>' +
                    '</div>' +
                '</div>' +
                '<div class="jquery_button text-center hidden-xs-up mb-2">' +
                    '<a data-href="' + id_calendar + '" class="btn btn-success btn-xs nutluu">LƯU</a>' +
                '</div>';

                $('#danhsach_gio_phong2').append(noidung);
                $('#gio_phong2').val('');
                alert('Thêm giờ chiếu thành công cho phòng 2!');
            } else {
                var errorMsg = response && response.message ? response.message : 'Có lỗi xảy ra khi thêm giờ chiếu!';
                alert(errorMsg);
            }
        })
        .fail(function(xhr, status, error) {
            console.error('AJAX Error:', status, error);
            try {
                var response = JSON.parse(xhr.responseText);
                if (response && response.message) {
                    alert(response.message);
                } else {
                    alert('Có lỗi xảy ra khi thêm giờ chiếu!');
                }
            } catch(e) {
                alert('Có lỗi xảy ra khi thêm giờ chiếu!');
            }
        });
    });

    // Sự kiện nút xóa ngày
    $('body').on('click', '.nutxoa', function(event) {
        event.preventDefault();
        var daychuadoi = $(this).data('href');
        var id_movie = $('#id_movie').val();
        var doituongcanxoa = $(this).closest('.card');

        if (confirm('Bạn có chắc chắn muốn xóa ngày chiếu này? Tất cả giờ chiếu trong ngày này cũng sẽ bị xóa.')) {
            $.ajax({
                url: duongdan + 'index.php/Qlylich_controller/ajax_xoangay/' + daychuadoi,
                type: 'POST',
                dataType: 'json',
                data: {id_movie: id_movie}
            })
            .always(function() {
                console.log("Date deleted");
                doituongcanxoa.remove();
            });
        }
    });

    // Sự kiện nút edit ngày
    $('body').on('click', '.nutedit', function(event) {
        event.preventDefault();
        $(this).parent().addClass('hidden-xs-up');
        $(this).closest('.card-body').find('.daychuaedit').addClass('hidden-xs-up');
        $(this).closest('.card-body').find('.jquery_dayedit').removeClass('hidden-xs-up');
        $(this).closest('.card-body').find('.jquery_button').removeClass('hidden-xs-up');
    });

    // Sự kiện nút lưu ngày
    $('body').on('click', '.nutluu', function(event) {
        event.preventDefault();
        var id_movie = $('#id_movie').val();
        var daychuaedit = $(this).closest('.card-body').find('.daychuaedit input').val();
        var dayedit = $(this).closest('.card-body').find('.dayedit').val();

        $(this).parent().addClass('hidden-xs-up');
        $(this).closest('.card-body').find('.jquery_dayedit').addClass('hidden-xs-up');

        var noidung = $(this).closest('.card-body').find('.dayedit').val();
        $(this).closest('.card-body').find('.daychuaedit').html('<input type="hidden" name="daychuaedit" class="daychuaedit" value="' + noidung + '"><strong>' + noidung + '</strong>').removeClass('hidden-xs-up');

        $.ajax({
            url: duongdan+'index.php/Qlylich_controller/ajax_editngay/'+id_movie,
            type: 'POST',
            dataType: 'json',
            data: {daychuaedit: daychuaedit, dayedit: dayedit}
        })
        .always(function() {
            console.log("Date updated");
        });
    });

    // Sự kiện nút xóa giờ
    $('body').on('click', '.nutxoa', function(event) {
        event.preventDefault();
        var id_calendar = $(this).data('href');
        var doituongcanxoa = $(this).closest('.d-flex');

        $.ajax({
            url: duongdan + 'index.php/Qlylich_controller/ajax_xoagio/' + id_calendar,
            type: 'POST',
            dataType: 'json',
            data: {}
        })
        .always(function() {
            console.log("Time deleted");
            doituongcanxoa.next('.jquery_button').remove();
            doituongcanxoa.remove();
        });
    });

    // Sự kiện nút edit giờ
    $('body').on('click', '.nutedit', function(event) {
        event.preventDefault();
        $(this).closest('.d-flex').find('.thaotac, .btn-group').addClass('hidden-xs-up');
        $(this).closest('.d-flex').find('.giochuaedit').addClass('hidden-xs-up');
        $(this).closest('.d-flex').find('.jquery_gioedit').removeClass('hidden-xs-up');
        $(this).closest('.d-flex').next('.jquery_button').removeClass('hidden-xs-up');
    });

    // Sự kiện nút lưu giờ
    $('body').on('click', '.nutluu', function(event) {
        event.preventDefault();
        var id_calendar = $(this).data('href');
        var gioedit = $(this).closest('.jquery_button').prev('.d-flex').find('.gioedit').val();

        $(this).parent().addClass('hidden-xs-up');
        $(this).closest('.jquery_button').prev('.d-flex').find('.jquery_gioedit').addClass('hidden-xs-up');

        var noidung = $(this).closest('.jquery_button').prev('.d-flex').find('.gioedit').val();
        $(this).closest('.jquery_button').prev('.d-flex').find('.giochuaedit').html('<strong>' + noidung + '</strong>').removeClass('hidden-xs-up');
        $(this).closest('.jquery_button').prev('.d-flex').find('.thaotac, .btn-group').removeClass('hidden-xs-up');

        $.ajax({
            url: duongdan+'index.php/Qlylich_controller/ajax_editgio/'+id_calendar,
            type: 'POST',
            dataType: 'json',
            data: {gioedit: gioedit}
        })
        .done(function() {
            console.log("Time updated successfully");
        })
        .fail(function() {
            console.log("Time update failed");
        });
    });
}

// Initialize after jQuery is loaded
if (typeof jQuery !== 'undefined') {
    $(document).ready(function() {
        initQlyLichFull();
    });
} else {
    var checkJQuery = setInterval(function() {
        if (typeof jQuery !== 'undefined') {
            clearInterval(checkJQuery);
            $(document).ready(function() {
                initQlyLichFull();
            });
        }
    }, 100);
}
</script>

<?php
// Get the content
$content = ob_get_clean();

// Load the layout
$this->load->view('admin_layout', array(
    'page_title' => $page_title,
    'page_breadcrumb' => $page_breadcrumb,
    'show_clock' => $show_clock,
    'additional_css' => $additional_css,
    'additional_js' => $additional_js,
    'content' => $content
));
?>
