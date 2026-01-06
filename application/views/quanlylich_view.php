<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>quản lý danh mục </title>
    
    <link rel="stylesheet" href="<?php echo base_url() ?>vendor/bootstrap.css">
    <link rel="stylesheet" href="<?php echo base_url() ?>vendor/font-awesome.css">
    

    <!-- Fonts -->
        <!-- Font awesome - icon font -->
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
        <!-- Roboto -->

        <link href='http://fonts.googleapis.com/css?family=Roboto:400,700' rel='stylesheet' type='text/css'>
</head>
<body>


    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6">
                <div class="jumbotron jumbotron-fluid text-xs-center">
                    <div class="container">
                        <?php foreach ($dulieutucontrollerTit as $motketqua): ?>
                        <h1 class="display-5">Thêm ngày </h1>
                        <input type="hidden" name="id" id="idphim" value="<?= $motketqua['id'] ?>">
                        <p class="lead"><?= $motketqua["title"]; ?></p>
                        
                    </div>
                </div>
                <!-- <form action=" //echo base_url(); ?>/tin/themdanhmuc" method="post"> -->
                    <fieldset class="form-group">
                        <label for="formGroupExampleInput">Chọn ngày</label>
                        <input name="ngay" type="date" class="form-control" id="chonngay" x>
                    </fieldset>
                    <fieldset class="form-group">
                        <input type="button" class="form-control" id="nutthemngay" value="Thêm ngày">
                    </fieldset>
                    <?php endforeach ?>
                <!-- </form> -->
            </div> <!-- end cot trai -->
            <div class="col-sm-6 cacdanhmuc">
                        <div class="jumbotron jumbotron-fluid text-xs-center">
                            <div class="container">
                                <h1 class="display-5">Danh sách ngày chiếu phim </h1>

                            </div>
                        </div>
                        <?php foreach ($dulieutucontroller as $motketqua): ?>
                            
                        
                        <?php
                                 $daychuadoi = $motketqua["day"];
                                 $daydadoi = date("d/m/Y", strtotime($daychuadoi)); 
                                ?>
                        <div class="card card-inverse card-primary mb-3 text-center">
                          <div class="card-block">
                            <div class="thaotac text-xs-right">
        


                                <a data-href="" class="nutedit btn btn-warning btn-xs" title="Sửa"> <i class="fas fa-edit"></i></a>

                                 <a data-href="" class="nutxoa btn btn-danger btn-xs" title="Xóa"> <i class="fas fa-trash"></i></a>
                            </div>
                             

                            <div class="jquery_button text-xs-right hidden-xs-up">

                                 <a href="" class="btn btn-success nutluu"> Lưu </a>

                                  
                            </div>
                             


                            <h4 class="card-blockquote">
                                 
                                    <fieldset class="form-group jquery_tendanhmuc   hidden-xs-up">

                                    <input type="hidden" class="form-control id" value="">
                                        <input type="text" class="form-control tendanhmucsua"  value= "<?= $daydadoi ?>">
                                    </fieldset>
                                    
                            <div class="noidung_ten" id="tenchuaedit">

                                
                                
                                 <?php echo $daydadoi ?>
                            </div>
                              
                            </h4> 
                            
                                                    
                          </div>
                        </div> <!-- het mot danh mục -->


                        <?php endforeach ?>
            </div>

        </div>
    </div>
    
    <script type="text/javascript" src="<?php echo base_url() ?>vendor/bootstrap.js"></script>
    <script>
         
    $(function(){
        $('body').on('click', '.nutedit', function(event) {

            $(this).parent().addClass('hidden-xs-up');
            $(this).parent().next().next().find('.noidung_ten').addClass('hidden-xs-up');
            $(this).parent().next().removeClass('hidden-xs-up');

            $(this).parent().next().next().find('.jquery_tendanhmuc').removeClass('hidden-xs-up');

            // sử dụng ajax để kết nối với controller cập nhật dữ liệu 


             


            event.preventDefault();
            /* Act on the event */
        });

        
    $('body').on('click', '.nutluu', function(event) {

             giatriten = $(this) // la .nutluu
             .parent()  //  doi tuong .jquery button
             .next()  // cardblock
             .children('.jquery_tendanhmuc') // doi tuong jquery_tendanhmuc
             .children('.tendanhmucsua').val();
             giatriid = $(this).parent().next().children('.jquery_tendanhmuc').children('.id').val();
            // console.log(giatriten);      
            // console.log(giatriid);       
             
             phantu1 = $(this).parent().addClass('hidden-xs-up');
             phantu2 = $(this).parent().next().children('.jquery_tendanhmuc').addClass('hidden-xs-up');

             noidung = $(this).parent().next().children('.jquery_tendanhmuc').children('.tendanhmucsua').val();

             hienthi1 = $(this).parent().prev().removeClass('hidden-xs-up');
             hienthi2 = $(this).parent()
             .next()
             .children('.noidung_ten')
             .html(noidung) // set noi dung

             .removeClass('hidden-xs-up');  // cho hien thi lai 

             //cho hien thi nut
            // console.log(noidung);
            $.ajax({
                url:duongdan+'/tin/updatedanhmuc',
                type: 'POST',
                dataType: 'json',
                data: {
                    tendanhmuc: giatriten,
                    id: giatriid
                },
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
            /* Act on the event */
        });




        var duongdan = '<?php echo base_url() ?>' ; 
        // bat su kien click nut 
         $('body').on('click', '.nutthemngay', function(event) {
            /* Act on the event */
            // var tendanhmuc = $('#tendanhmuc').val();
            // console.log(tendanhmuc);
            $.ajax({
                url: duongdan+'index.php/Qlylich_controller/ajax_themngay',  // gửi đi controller xử lý 
                type: 'POST',
                dataType: 'json',
                data: {} 
            })
            .done(function() {
                //console.log("success");
            })
            .fail(function() {
                //console.log("error");
            })
            .always(function(res) {
                console.log(res);
 
                // dung jquery ve ra noi dung them moi
                noidung = '<div class="card card-inverse card-primary mb-3 text-center">';
                noidung += ' <div class="card-block">';
                noidung += '<div class="thaotac text-xs-right">';
                noidung += '<a data-href="'+res+'" class="nutedit btn btn-danger"> <i class="fa fa-pencil"></i></a>';
                noidung += ' <a data-href="'+res+'" class="nutxoa btn btn-warning"> <i class="fa fa-remove"></i></a>';
                noidung += '</div>';
                noidung += '<h4 class="card-blockquote">';
                noidung += '<div class="noidung_ten">';
                noidung += $('#tendanhmuc').val();
                noidung += '</div> ';
                noidung += '</h4> ';
                noidung += '</div>';
                noidung += '</div>';
                $('.cacdanhmuc').append(noidung); // ve va dua noi dung vao 
                $('#tendanhmuc').val(''); // xoa trang 

            });
            

        }); // het jquery cho nut them moi
        // begin jquery cho nut xoa

        $('body').on('click', '.nutxoa', function(event) {
            /* Act on the event */
            //idtin = $(this).data('href');
            //doituongcanxoa = $(this).parent().parent().parent();
            $.ajax({
                            url: duongdan + '/tin/xoadanhmuc/'+idtin,
                            type: 'POST',
                            dataType: 'json'
                         })
                         .done(function() {
                            console.log("success");
                         })
                         .fail(function() {
                            console.log("error");
                         })
                         .always(function() {
                            console.log("complete");
                            // dung jquery , xoa luôn phân tử , đỡ phải load lại 
                         // $(this).parent().parent().parent().remove();
                             doituongcanxoa.remove();
                         });

        });
         
    })
    </script>

</body>
</html>