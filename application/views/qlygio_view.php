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
                <input type="time" name="gio" id="gio">
                <a data-href="1" type="button" class="btn btn-success" id="nutthemgiophong1"><i class="fa fa-plus"></i></a>
            </fieldset>
            <pre></pre>

            <fieldset class="form-group phong2">
                <h4>Phòng 2</h4>
                <pre></pre>
                <input type="time" name="gio" id="gio">
                <a data-href="2" type="button" class="btn btn-success" id="nutthemgiophong2"><i class="fa fa-plus"></i></a>
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
                            <a data-href="<?= $value1['id_calendar']; ?>" class="nutedit btn btn-danger"><i class="fa fa-pencil"></i></a>
                            <a data-href="<?= $value1['id_calendar']; ?>" class="nutxoa btn btn-warning"><i class="fa fa-remove"></i></a>
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
                            <a data-href="<?= $value2['id_calendar']; ?>" class="nutedit btn btn-danger"><i class="fa fa-pencil"></i></a>
                            <a data-href="<?= $value2['id_calendar']; ?>" class="nutxoa btn btn-warning"><i class="fa fa-remove"></i></a>
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
$(function(){
    var duongdan = '<?php echo base_url() ?>';

    // Sự kiện nút giờ phòng 1
    $('body').on('click', '#nutthemgiophong1', function(event) {
        id_phong = $(this).data('href');
        id_movie = $('#id_movie').val();
        day = $('#day').val();
        gio = $(this).parent().children('input').val();
        
        if (!gio) {
            alert('Vui lòng nhập giờ chiếu!');
            return;
        }
        
        $.ajax({
            url: duongdan+'index.php/Qlylich_controller/ajax_themgio/'+id_phong+'/'+gio,
            type: 'POST',
            dataType: 'json',
            data: {id_movie,day},
        })
        .done(function(response) {
            if (response && response.success === true) {
                var id_calendar = response.id_calendar;
                noidung = '<li class="list-group-item">';
                noidung += '<div class="thaotac text-xs-right">';
                noidung += '<a data-href="'+id_calendar+'" class="nutedit btn btn-danger"><i class="fa fa-pencil"></i></a>';
                noidung += ' <a data-href="'+id_calendar+'" class="nutxoa btn btn-warning"><i class="fa fa-remove"></i></a>';
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
                $('#gio').val('');
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
        id_phong = $(this).data('href');
        id_movie = $('#id_movie').val();
        day = $('#day').val();
        gio = $(this).parent().children('input').val();
        
        if (!gio) {
            alert('Vui lòng nhập giờ chiếu!');
            return;
        }
        
        $.ajax({
            url: duongdan+'index.php/Qlylich_controller/ajax_themgio/'+id_phong+'/'+gio,
            type: 'POST',
            dataType: 'json',
            data: {id_movie,day},
        })
        .done(function(response) {
            if (response && response.success === true) {
                var id_calendar = response.id_calendar;
                noidung = '<li class="list-group-item">';
                noidung += '<div class="thaotac text-xs-right">';
                noidung += '<a data-href="'+id_calendar+'" class="nutedit btn btn-danger"><i class="fa fa-pencil"></i></a>';
                noidung += ' <a data-href="'+id_calendar+'" class="nutxoa btn btn-warning"><i class="fa fa-remove"></i></a>';
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
                $('#gio').val('');
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
})
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
