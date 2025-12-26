<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="<?php echo base_url(); ?>css/sidebar.css" rel="stylesheet" />
    <link href="<?php echo base_url(); ?>css/admin-style.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Jost:wght@500&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" />
    <cript src="https://code.jquery.com/jquery-3.4.1.js"></cript>
    <cript src="https://kit.fontawesome.com/a076d05399.js"></cript>
    <title>trang người dùng</title>
    <style>
       
body{
    margin: 0;
    padding: 0;
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 100vh;
    font-family: 'Jost', sans-serif;
   
    background-image: linear-gradient(to bottom, #fcda7d);
   
   
  }
  .main{
    width: 550px;
    height: 800px;
    background: red;
    overflow: hidden;
    background: url("https://doc-08-2c-docs.googleusercontent.com/docs/securesc/68c90smiglihng9534mvqmq1946dmis5/fo0picsp1nhiucmc0l25s29respgpr4j/1631524275000/03522360960922298374/03522360960922298374/1Sx0jhdpEpnNIydS4rnN4kHSJtU1EyWka?e=view&authuser=0&nonce=gcrocepgbb17m&user=03522360960922298374&hash=tfhgbs86ka6divo3llbvp93mg4csvb38") no-repeat center/ cover;
    border-radius: 10px;
    box-shadow: 5px 2px 30px #000;
       background: #fcda7d;
              box-shadow: 0px 10px 50px 0 ;
              /* CHANGE THIS TO CHANGE THE BLUR AMOUNT */
              backdrop-filter: blur( 8.0px );
              -webkit-backdrop-filter: blur( 8.0px );
              border-radius: 10px;
              border: 1px solid rgb(255 255 255 / 15%);
                   text-align: center;
  }
  #chk{
    display: none;
  }
  .signup{
    position: relative;
    width:100%;
    height: 100%;
  }
  label{
    color: rgb(144, 41, 41);
    font-size: 2.3em;
    justify-content: center;
    display: flex;
    margin: 60px;
    font-weight: bold;
    cursor: pointer;
    transition: .5s ease-in-out;
  }
  input{
    width: 60%;
    height: 20px;
    background: #e0dede;
    justify-content: center;
    display: flex;
    margin: 20px auto;
    padding: 10px;
    border: none;
    outline: none;
    border-radius: 5px;
  }
  button{
    width: 60%;
    height: 40px;
    margin: 10px auto;
    justify-content: center;
    display: block;
    color: rgb(144, 41, 41);;
    background: #fcda7d;
    font-size: 1em;
    font-weight: bold;
    margin-top: 20px;
    outline: none;
    border: none;
    border-radius: 5px;
    transition: .2s ease-in;
    cursor: pointer;
  }
  button:hover{
    background: #005DC0;
  }
  .login{
    height: 460px;
    background: #eee;
    border-radius: 60% / 10%;
    transform: translateY(-180px);
    transition: .8s ease-in-out;
    
  }
  .login label{
    color: #573b8a;
    transform: scale(.6);
  }
   
  
    </style>
</head>
<body>

  
 <div class="main">
    <input type="checkbox" id="chk" aria-hidden="true">
    <?php foreach ($dulieutucontroller as $key => $value): ?>
      <div class="signup">

      
    <form action="../updatePhim" method='post' enctype="multidata/form-data">
    <label for="chk" aria-hidden="true">Sửa phim</label>
    <input type="hidden" name="id" value="<?= $value['id'] ?>">
    <input type="tenphim" name="title" placeholder="TÊN PHIM" required="" value="<?= $value['title'] ?>">
    <input type="thoigian" name="duration" placeholder="THỜI GIAN" required="" value="<?= $value['duration'] ?>">
    <input type="daodien" name="director" placeholder="ĐẠO DIỄN" required="" value="<?= $value['director'] ?>">
    <input type="dienvien" name="actor" placeholder="DIỄN VIÊN" required="" value="<?= $value['actor'] ?>">
    <input type="ngonngu" name="language" placeholder="NGÔN NGỮ" required="" value="<?= $value['language'] ?>">
    <input type="quocgia" name="country" placeholder="QUỐC GIA" required=""value="<?= $value['country'] ?>">
    <input type="mota" name="description" placeholder="MÔ TẢ" required="" value="<?= $value['description'] ?>">
    <input type="khoichieu" name="open_date" placeholder="KHỞI CHIẾU" required="" value="<?= $value['open_date'] ?>">
    <input type="theloai" name="category" placeholder="THỂ LOẠI" required="" value="<?= $value['category'] ?>">
 
    <button style="margin-top: -17PX;">LƯU</button>
    </form>
    </div>
    
    <div class="login">
    <form>
    <label  aria-hidden="true" ><a href="<?php echo base_url() ?>index.php/Nhanvien_controller" style="text-decoration: none; ">TRỞ VỀ</a></label>
     <button> <button>
    </form>
    </div>
    <?php endforeach ?>
</div>
  <script src="<?php echo base_url(); ?>js/admin-sidebar.js"></script>
</body>
</html>





