<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- External CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    
    <!-- Local CSS -->
    <link href="<?php echo base_url(); ?>css/sidebar.css" rel="stylesheet" />
    <link href="<?php echo base_url(); ?>css/admin-style.css" rel="stylesheet" />
    <link href="<?php echo base_url(); ?>css/admin-common.css" rel="stylesheet" />
    
    <!-- Page Title -->
    <title><?php echo isset($page_title) ? $page_title : 'Quản trị'; ?></title>
    
    <!-- Additional CSS (if any) -->
    <?php if (isset($additional_css)): ?>
        <?php foreach ($additional_css as $css): ?>
            <link href="<?php echo base_url() . $css; ?>" rel="stylesheet" />
        <?php endforeach; ?>
    <?php endif; ?>
</head>

<body onload="<?php echo isset($body_onload) ? $body_onload : 'time()'; ?>" class="app sidebar-mini rtl">
    <?php $this->load->view('admin_header'); ?>
    <?php $this->load->view('admin_sidebar'); ?>
    
    <main class="app-content">
        <?php if (isset($page_breadcrumb)): ?>
        <div class="app-title">
            <ul class="app-breadcrumb breadcrumb side">
                <li class="breadcrumb-item active"><a href="#"><b><?php echo $page_breadcrumb; ?></b></a></li>
            </ul>
            <?php if (isset($show_clock) && $show_clock): ?>
            <div id="clock"></div>
            <?php endif; ?>
        </div>
        <?php endif; ?>
        
        <!-- Main Content -->
        <?php echo $content; ?>
    </main>
    
    <!-- Essential javascripts for application to work-->
    <script src="<?php echo base_url(); ?>js/admin-sidebar.js"></script>
    
    <!-- Additional JavaScript (if any) -->
    <?php if (isset($additional_js)): ?>
        <?php foreach ($additional_js as $js): ?>
            <?php if (strpos($js, 'http://') === 0 || strpos($js, 'https://') === 0): ?>
                <script src="<?php echo $js; ?>"></script>
            <?php else: ?>
                <script src="<?php echo base_url() . $js; ?>"></script>
            <?php endif; ?>
        <?php endforeach; ?>
    <?php endif; ?>
</body>
</html>

