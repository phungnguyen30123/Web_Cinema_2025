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
        <div class="col-sm-6">
            <div class="jumbotron jumbotron-fluid text-center">
                <div class="container">
                    <?php foreach ($dulieutucontrollerTit as $valuephim): ?>
                        <h1 class="display-5">Thêm ngày</h1>
                        <input type="hidden" name="id_movie" id="id_movie" value="<?= $valuephim['id'] ?>">
                        <p class="lead"><?= $valuephim['id'] ?>: <?= $valuephim['title']; ?></p>
                    <?php endforeach; ?>
                </div>
            </div>
            
            <div class="mb-3">
                <label for="day" class="form-label">Chọn ngày</label>
                <input name="day" type="date" class="form-control" id="day">
            </div>
            <div class="mb-3">
                <input type="button" class="btn btn-primary" id="nutthemngay" value="Thêm ngày">
            </div>
        </div>
        
        <div class="col-sm-6">
            <div class="jumbotron jumbotron-fluid text-center cacngay">
                <div class="container">
                    <h1 class="display-5">Danh sách ngày chiếu phim</h1>
                </div>
            </div>
            <?php foreach ($dulieutucontroller as $value): ?>
                <?php
                $daychuadoi = $value["day"];
                $daydadoi = date("d/m/Y", strtotime($daychuadoi));
                $id_movie = $value['id_movie'];
                ?>
                <div class="card bg-primary text-white mb-3 text-center">
                    <div class="card-body">
                        <div class="thaotac text-end">
                            <a data-href="<?php echo $daychuadoi ?>" class="nutedit btn btn-danger"><i class="fas fa-edit"></i></a>
                            <a data-href="<?php echo $daychuadoi ?>" class="nutxoa btn btn-warning"><i class="fas fa-times"></i></a>
                            <a href="../indexGio/<?= $value['id_movie'] ?>/<?php echo $daychuadoi ?>" class="nutxem btn btn-danger"><i class="fas fa-eye"></i></a>
                        </div>
                        <div class="jquery_button text-end hidden-xs-up">
                            <a href="" class="nutluu btn btn-success">LƯU</a>
                        </div>
                        <h4 class="card-title mt-3">
                            <div class="form-group jquery_dayedit hidden-xs-up mb-3">
                                <input type="date" class="form-control dayedit" name="dayedit" value="<?= $daychuadoi ?>">
                            </div>
                            <div class="daychuaedit">
                                <input type="hidden" name="daychuaedit" class="daychuaedit" value="<?= $daychuadoi ?>">
                                <?php echo $daydadoi ?>
                            </div>
                        </h4>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>

<script>
// Ensure jQuery is available
if (typeof jQuery == 'undefined') {
    document.write('<script src="https://code.jquery.com/jquery-3.6.0.min.js"><\/script>');
}

$(function(){
    var duongdan = '<?php echo base_url() ?>';
    var id_movie_js = $('#id_movie').val();

    // Sự kiện nút thêm ngày
    $('#nutthemngay').click(function(event) {
        var id_movie = $('#id_movie').val();
        var day = $('#day').val();
        var dout = day;
        
        function stringToDate(_date,_format,_delimiter) {
            var formatLowerCase=_format.toLowerCase();
            var formatItems=formatLowerCase.split(_delimiter);
            var dateItems=_date.split(_delimiter);
            var monthIndex=formatItems.indexOf("mm");
            var dayIndex=formatItems.indexOf("dd");
            var yearIndex=formatItems.indexOf("yyyy");
            var month=parseInt(dateItems[monthIndex]);
            month-=1;
            var formatedDate = new Date(dateItems[yearIndex],month,dateItems[dayIndex]);
            return formatedDate;
        }
        dout = stringToDate(dout,"yyyy-mm-dd","-");
        dout = dout.toLocaleDateString();
        console.log(dout);
        
        $.ajax({
            url: duongdan+'index.php/Qlylich_controller/ajax_themngay/'+id_movie,
            type: 'POST',
            dataType: 'json',
            data: {day}
        })
        .always(function(res) {
            noidung = '<div class="card bg-primary text-white mb-3 text-center">';
            noidung += '<div class="card-body">';
            noidung += '<div class="thaotac text-end">';
            noidung += '<a data-href="'+res+'" class="nutedit btn btn-danger"><i class="fas fa-edit"></i></a>';
            noidung += '<a data-href="'+res+'" class="nutxoa btn btn-warning"><i class="fas fa-times"></i></a>';
            noidung += '<a href="../indexGio/'+id_movie_js+'/'+day+'" class="nutxem btn btn-danger"><i class="fas fa-eye"></i></a>';
            noidung += '</div>';
            noidung += '<div class="jquery_button text-end hidden-xs-up">';
            noidung += '<a href="" class="nutluu btn btn-success">LƯU</a>';
            noidung += '</div>';
            noidung += '<h4 class="card-title mt-3">';
            noidung += '<div class="form-group jquery_dayedit hidden-xs-up mb-3">';
            noidung += '<input type="date" class="form-control dayedit" name="dayedit" value="'+day+'">';
            noidung += '</div>';
            noidung += '<div class="daychuaedit">';
            noidung += '<input type="hidden" name="daychuaedit" class="daychuaedit" value="'+day+'">';
            noidung += dout;
            noidung += '</div>';
            noidung += '</h4>';
            noidung += '</div>';
            noidung += '</div>';
            
            $('.cacngay').after(noidung);
            $('#day').val('');
        });
    });

    // Nút xóa
    $('body').on('click', '.nutxoa', function(event) {
        var daychuadoi = $(this).data('href');
        var id_movie = $('#id_movie').val();
        doituongcanxoa = $(this).parent().parent().parent();
        $.ajax({
            url: duongdan + 'index.php/Qlylich_controller/ajax_xoangay/' + daychuadoi,
            type: 'POST',
            dataType: 'json',
            data: {id_movie}
        })
        .always(function() {
            console.log("complete");
            doituongcanxoa.remove();
        });
    });

    // Nút edit
    $('body').on('click', '.nutedit', function(event) {
        $(this).parent().addClass('hidden-xs-up');
        $(this).parent().next().next().find('.daychuaedit').addClass('hidden-xs-up');
        $(this).parent().next().removeClass('hidden-xs-up');
        $(this).parent().next().next().find('.jquery_dayedit').removeClass('hidden-xs-up');
        event.preventDefault();
    });

    // Nút lưu
    $('body').on('click', '.nutluu', function(event) {
        id_movie = $('#id_movie').val();
        daychuaedit = $(this).parent().next().children('.daychuaedit').children('input').val();
        dayedit = $(this).parent().next().children('.jquery_dayedit').children().val();
        $(this).parent().addClass('hidden-xs-up');
        $(this).parent().next().children('.jquery_dayedit').addClass('hidden-xs-up');
        noidung = $(this).parent().next().children('.jquery_dayedit').children('.dayedit').val();
        
        $(this).parent().prev().removeClass('hidden-xs-up');
        $(this).parent().next().children('.daychuaedit').removeClass('hidden-xs-up');
        $(this).parent().next().children('.daychuaedit').html(noidung).removeClass('hidden-xs-up');
        
        $.ajax({
            url: duongdan+'index.php/Qlylich_controller/ajax_editngay/'+id_movie,
            type: 'POST',
            dataType: 'json',
            data: {daychuaedit, dayedit},
        })
        .always(function() {
            console.log("complete");
        });
        event.preventDefault();
    });
});
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
