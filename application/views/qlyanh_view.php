
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css
">
    <link href="<?php echo base_url(); ?>css/sidebar.css" rel="stylesheet" />
    <link href="<?php echo base_url(); ?>css/admin-style.css" rel="stylesheet" />
    <link rel="stylesheet" href="<?php echo base_url(); ?>https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
    <link rel="stylesheet" href="<?php echo base_url(); ?>https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="<?php echo base_url(); ?>https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" />
    <cript src="https://code.jquery.com/jquery-3.4.1.js"></cript>
    <cript src="https://kit.fontawesome.com/a076d05399.js"></cript>
    <title>Quản lý ảnh</title>
</head>
<body>
    
    <?php foreach ($dulieutucontroller as $key => $value): ?>
        <form method="post" enctype="multipart/form-data" action="<?php echo base_url(); ?>index.php/Qlyanh_controller/upAnh">
        <div class="them">
            

        <div class="taobang">
          
        <table style="width:100%" >
            <p style="margin-left: 90px; float: left;">
            <b class="tieu" ><center>QUẢN LÝ ẢNH</center></b>
            <b class="tieu"><center>PHIM: <?php echo $value['title'] ?></center></b>
            <b class="tieu" style="float: left; margin-left: 580px;"><center>ID: <?php echo $value['id'] ?></center></b>
        </p>
            <thead>
                <div class="them">
            
            <button type='submit' class="btn btn-md btn--warning btn--wider" >Xem thay đổi</button>
            <button type="submit" >
                <a href="<?php echo base_url(); ?>index.php/Nhanvien_controller" style="text-decoration: none; color:white">Trở về</a>
            </button>
            <br><br>.
           
            <tr>
              
              <th style="width: 30%">POSTER</th>
              <th style="width:30%">ẢNH</th>
       
              <th style="width:30%">TRAILER</th>
              
                
            
            </tr>
        </thead>
        <tbody>
            <tr>
           
             
            
              <td>
                    <input type="hidden" name="postercu" value="<?= $value['poster'] ?>">
                <input type="file" name="poster" id="anh" />
                <pre></pre>
                <pre></pre>
                <div class="movie__images">
                                <img alt='' src="<?php echo $value['poster'] ?>">
                            </div>
                </td>
            
              
                <td>
                   <input type="hidden" name="id" value="<?= $value['id'] ?>"> 
                  <input type="file" name="image1" id="anh" />
                  <input type="hidden" name="image1cu" value="<?= $value['image1'] ?>">
                  <pre></pre>
                  <div class="movie__images">
                                <img alt='' src="<?php echo $value['image1'] ?>">
                    </div>

                  <pre></pre>
                  <input type="file" name="image2" id="anh" />
                  <input type="hidden" name="image2cu" value="<?= $value['image2'] ?>">
                  <pre></pre>
                  <div class="movie__images">
                                <img alt='' src="<?php echo $value['image2'] ?>">
                    </div>
                  <pre></pre>
                  <input type="file" name="image3" id="anh" />
                  <input type="hidden" name="image3cu" value="<?= $value['image3'] ?>">
                  <pre></pre>
                  <div class="movie__images">
                                <img alt='' src="<?php echo $value['image3'] ?>">
                    </div>
                  <pre></pre>

                  <input type="file" name="image4" id="anh" />
                  <input type="hidden" name="image4cu" value="<?= $value['image4'] ?>">
                  <pre></pre>
                  <div class="movie__images">
                                <img alt='' src="<?php echo $value['image4'] ?>">
                    </div>
                  <pre></pre>  
                  </td>

              <td>
                    <input type="hidden" name="id" value="<?= $value['id'] ?>">
                  <b>Ảnh bìa và link trailer1</b>
                  <pre></pre>
                  <input type="file" name="imgtra1" id="anh" />
                  <input type="hidden" name="imgtra1cu" value="<?= $value['imgtra1'] ?>">
                  <div class="movie__images">
                                <img alt='' src="<?php echo $value['imgtra1'] ?>">
                    </div>
                  <pre></pre>
                  <input type="text" name="trailer1" value="<?= $value['trailer1'] ?> " id="anh"  />
                  <pre></pre>
                  <b>Ảnh bìa và link trailer2</b>
                  <pre></pre>
                  <input type="file" name="imgtra2" id="anh" />
                  <input type="hidden" name="imgtra2cu" value="<?= $value['imgtra2'] ?>">
                  <div class="movie__images">
                                <img alt='' src="<?php echo $value['imgtra2'] ?>">
                    </div>
                  <pre></pre>
                  <input type="text" name="trailer2" value="<?= $value['trailer2'] ?> " id="anh" /> 
                  </td>
        
              
            </tr>
            
             
            </tbody>
          </table>

        </div>
            

            
        </div>
    </form>
    <?php endforeach ?>
           

        


  <script src="<?php echo base_url(); ?>js/admin-sidebar.js"></script>
</body>
</html>



