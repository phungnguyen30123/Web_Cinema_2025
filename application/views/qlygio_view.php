<?php
// Set up data for the layout
$page_title = 'Quản lý lịch chiếu';
$page_breadcrumb = 'Quản lý giờ chiếu';
$show_clock = false;

// Additional CSS for this view
$additional_css = array('css/qlygio-custom.css');

// Additional JavaScript
$additional_js = array(
    'https://cdn.jsdelivr.net/npm/bootstrap@3.4.1/dist/js/bootstrap.min.js',
    '1.js',
    'https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js'
);

// Sidebar sẽ tự động lấy menu dựa trên role (admin/staff)

// Start output buffering to capture content
ob_start();
?>

<div class="container-fluid">
    <div class="row">
        <div class="col-sm-4">
            <div class="jumbotron jumbotron-fluid text-xs-center">
                <div class="container">
                    <h4 class="display-3">Thêm giờ chiếu</h4>
                    <pre></pre>
                </div>
            </div>
            
            <fieldset class="form-group phong1">
                <h4>Phòng 1</h4>
                <pre></pre>
                <input type="time" name="gio_phong1" id="gio_phong1" class="form-control">
                <a data-href="1" type="button" class="btn btn-success" id="nutthemgiophong1"><i class="fa fa-plus"></i> Thêm giờ</a>
            </fieldset>
            <pre></pre>

            <fieldset class="form-group phong2">
                <h4>Phòng 2</h4>
                <pre></pre>
                <input type="time" name="gio_phong2" id="gio_phong2" class="form-control">
                <a data-href="2" type="button" class="btn btn-success" id="nutthemgiophong2"><i class="fa fa-plus"></i> Thêm giờ</a>
            </fieldset>
        </div>
        
        <div class="col-sm-8">
            <div class="jumbotron jumbotron-fluid text-xs-center">
                <div class="container">
                    <?php foreach ($dulieutucontrollerTit as $valuephim): ?>
                    <input type="hidden" name="id_movie" id="id_movie" value="<?= $valuephim['id'] ?>">
                    <h3 class="display-5">Phim: <?= $valuephim['title']; ?></h3>

                    <?php foreach ($daytucontroller as $day): ?>
                    <h4 class="display-5">Ngày: <?= $day['day'] ?></h4>
                    <input type="hidden" name="day" id="day" value="<?= $day['day'] ?>">
                    <?php endforeach ?>

                    <pre></pre>
                </div>
            </div>

            <div class="panel panel-primary text-center">
                <div class="panel-body cacgio1">
                    <h4>Phòng 1</h4>
                    <?php foreach ($dulieutucontroller1 as $value1): ?>
                    <li class="list-group-item">
                        <div class="thaotac text-xs-right">
                            <a data-href="<?= $value1['id_calendar']; ?>" class="nutedit btn btn-warning btn-xs" title="Sửa"><i class="fas fa-edit"></i></a>
                            <a data-href="<?= $value1['id_calendar']; ?>" class="nutxoa btn btn-danger btn-xs" title="Xóa"><i class="fas fa-trash"></i></a>
                        </div>
                        <div class="jquery_button text-xs-right hidden-xs-up">
                            <a data-href="<?= $value1['id_calendar']; ?>" class="nutluu btn btn-success">LƯU</a>
                        </div>
                        <div>
                            <div class="jquery_gioedit hidden-xs-up">
                                <input type="time" name="gioedit" id="gioedit" class="form-control gioedit" value="<?= $value1['time']; ?>">
                            </div>
                            <div class="giochuaedit"><?= $value1['time']; ?></div>
                        </div>
                    </li>
                    <?php endforeach ?>
                </div>

                <div class="panel-body cacgio2">
                    <h4>Phòng 2</h4>
                    <?php foreach ($dulieutucontroller2 as $value2): ?>
                    <li class="list-group-item">
                            <div class="thaotac text-xs-right">
                            <a data-href="<?= $value2['id_calendar']; ?>" class="nutedit btn btn-warning btn-xs" title="Sửa"><i class="fas fa-edit"></i></a>
                            <a data-href="<?= $value2['id_calendar']; ?>" class="nutxoa btn btn-danger btn-xs" title="Xóa"><i class="fas fa-trash"></i></a>
                        </div>
                        <div class="jquery_button text-xs-right hidden-xs-up">
                            <a data-href="<?= $value2['id_calendar']; ?>" class="nutluu btn btn-success">LƯU</a>
                        </div>
                        <div>
                            <div class="jquery_gioedit hidden-xs-up">
                                <input type="time" name="gioedit" id="gioedit" class="form-control gioedit">
                            </div>
                            <div class="giochuaedit"><?= $value2['time']; ?></div>
                        </div>
                    </li>
                    <?php endforeach ?>
                </div>
            </div>
        </div>
        <?php endforeach ?>
    </div>
</div>

<script>
// Wait for jQuery to be loaded
function initQlyGio() {
    console.log('Initializing QlyGio...');

    var duongdan = '<?php echo base_url() ?>';

    console.log('Base URL:', duongdan);

    // Sự kiện nút giờ phòng 1
    $('body').on('click', '#nutthemgiophong1', function(event) {
        event.preventDefault();
        console.log('Add time button for room 1 clicked');

        id_phong = $(this).data('href');
        id_movie = $('#id_movie').val();
        day = $('#day').val();
        gio = $('#gio_phong1').val();

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
                noidung = '<li class="list-group-item">';
                noidung += '<div class="thaotac text-xs-right">';
                noidung += '<a data-href="'+id_calendar+'" class="nutedit btn btn-warning btn-xs" title="Sửa"><i class="fas fa-edit"></i></a>';
                noidung += ' <a data-href="'+id_calendar+'" class="nutxoa btn btn-danger btn-xs" title="Xóa"><i class="fas fa-trash"></i></a>';
                noidung += '</div>';
                noidung += '<div class="jquery_button text-xs-right hidden-xs-up">';
                noidung += '<a data-href="'+id_calendar+'" class="nutluu btn btn-success">LƯU</a>';
                noidung += '</div>';
                noidung += '<div>';
                noidung += '<div class="jquery_gioedit hidden-xs-up">';
                noidung += '<input type="time" name="gioedit" id="gioedit" class="form-control gioedit">';
                noidung += '</div>';
                noidung += '<div class="giochuaedit">';
                noidung += gio;
                noidung += '</div>';
                noidung += '</div>';
                noidung += '</li>';
                $('.cacgio1').append(noidung);
                $('#gio_phong1').val('');
                console.log('Successfully added time slot for room 1');
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

    // Sự kiện nút giờ phòng 2
    $('body').on('click', '#nutthemgiophong2', function(event) {
        event.preventDefault();
        console.log('Add time button for room 2 clicked');

        id_phong = $(this).data('href');
        id_movie = $('#id_movie').val();
        day = $('#day').val();
        gio = $('#gio_phong2').val();

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
                noidung = '<li class="list-group-item">';
                noidung += '<div class="thaotac text-xs-right">';
                noidung += '<a data-href="'+id_calendar+'" class="nutedit btn btn-warning btn-xs" title="Sửa"><i class="fas fa-edit"></i></a>';
                noidung += ' <a data-href="'+id_calendar+'" class="nutxoa btn btn-danger btn-xs" title="Xóa"><i class="fas fa-trash"></i></a>';
                noidung += '</div>';
                noidung += '<div class="jquery_button text-xs-right hidden-xs-up">';
                noidung += '<a data-href="'+id_calendar+'" class="nutluu btn btn-success">LƯU</a>';
                noidung += '</div>';
                noidung += '<div>';
                noidung += '<div class="jquery_gioedit hidden-xs-up">';
                noidung += '<input type="time" name="gioedit" id="gioedit" class="form-control gioedit">';
                noidung += '</div>';
                noidung += '<div class="giochuaedit">';
                noidung += gio;
                noidung += '</div>';
                noidung += '</div>';
                noidung += '</li>';
                $('.cacgio2').append(noidung);
                $('#gio_phong2').val('');
                console.log('Successfully added time slot for room 2');
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

    // Nút xóa
    $('body').on('click', '.nutxoa', function(event) {
        id_calendar = $(this).data('href');
        doituongcanxoa = $(this).parent().parent();
        $.ajax({
            url: duongdan + 'index.php/Qlylich_controller/ajax_xoagio/' + id_calendar,
            type: 'POST',
            dataType: 'json',
            data: {}
        })
        .always(function() {
            console.log("complete");
            doituongcanxoa.remove();
        });
    });

    // Nút edit
    $('body').on('click', '.nutedit', function(event) {
        $(this).parent().addClass('hidden-xs-up');
        $(this).parent().next().next().find('.giochuaedit').addClass('hidden-xs-up');
        $(this).parent().next().removeClass('hidden-xs-up');
        $(this).parent().next().next().find('.jquery_gioedit').removeClass('hidden-xs-up');
        event.preventDefault();
    });

    // Nút lưu
    $('body').on('click', '.nutluu', function(event) {
        id_calendar = $(this).data('href');
        gioedit = $(this).parent().next().children('.jquery_gioedit').children().val();
        $(this).parent().addClass('hidden-xs-up');
        $(this).parent().next().children('.jquery_gioedit').addClass('hidden-xs-up');
        noidung = $(this).parent().next().children('.jquery_gioedit').children('.gioedit').val();
        $(this).parent().prev().removeClass('hidden-xs-up');
        $(this).parent().next().children('.giochuaedit').removeClass('hidden-xs-up');
        $(this).parent().next().children('.giochuaedit').html(noidung).removeClass('hidden-xs-up');

        $.ajax({
            url: duongdan+'index.php/Qlylich_controller/ajax_editgio/'+id_calendar,
            type: 'POST',
            dataType: 'json',
            data: {gioedit},
        })
        .done(function() {
            console.log("success");
        })
        .fail(function() {
            console.log("error");
        })
        .always(function() {
            console.log("complete");
        });
        event.preventDefault();
    });
}

// Initialize after jQuery is loaded
if (typeof jQuery !== 'undefined') {
    // jQuery is already loaded, initialize immediately
    $(document).ready(function() {
        initQlyGio();
    });
} else {
    // Wait for jQuery to load
    var checkJQuery = setInterval(function() {
        if (typeof jQuery !== 'undefined') {
            clearInterval(checkJQuery);
            $(document).ready(function() {
                initQlyGio();
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
