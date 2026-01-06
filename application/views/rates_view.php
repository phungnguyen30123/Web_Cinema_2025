<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Bảng xếp hạng - Ratings</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Mobile menu -->
    <link href="<?php echo base_url(); ?>css/gozha-nav.css" rel="stylesheet" />
    <!-- Select -->
    <link href="<?php echo base_url(); ?>css/external/jquery.selectbox.css" rel="stylesheet" />
    <!-- Slider Revolution CSS (kept for consistency) -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>revolution/css/settings.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>revolution/css/layers.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>revolution/css/navigation.css">
    <!-- Custom -->
    <link href="<?php echo base_url(); ?>css/style.css?v=1" rel="stylesheet" />
    <!-- Modernizr -->
    <script src="<?php echo base_url(); ?>js/external/modernizr.custom.js"></script>
</head>
<body>
    <div class="wrapper">
        <?php require('header_view.php'); ?>

        <section class="container">
            <div class="col-sm-12">
                <div class="row">
                    <div class="col-sm-12">
                        <h2 class="page-heading">Bảng xếp hạng - Rating</h2>

                        <div class="rates-wrapper rates--full">
                            <table>
                                <colgroup class="col-width-lg">
                                <colgroup class="col-width">
                                <colgroup class="col-width-sm">
                                <colgroup class="col-width">
                                <?php if (!empty($movies) && is_array($movies)): ?>
                                    <?php $i = 1; foreach ($movies as $m): ?>
                                        <tr class="rates <?php echo $i <= 3 ? 'rates--top' : ''; ?>">
                                            <td class="rates__obj">
                                                <a href="<?php echo site_url('Movie_page_controller/showinfophim/'.$m['id']); ?>" class="rates__obj-name">
                                                    <?php echo $i; ?>. <?php echo htmlspecialchars($m['title']); ?>
                                                </a>
                                            </td>
                                            <td class="rates__vote"><?php echo isset($m['rating_count']) ? intval($m['rating_count']) . ' votes' : '0 votes'; ?></td>
                                            <td class="rates__result"><?php echo isset($m['avg_rating']) ? number_format($m['avg_rating'],1) : '0.0'; ?></td>
                                            <td class="rates__stars">
                                                <?php $userRated = isset($m['user_rating']) && $m['user_rating'] !== null; ?>
                                                <?php $canEdit = isset($current_user_id) && $current_user_id; ?>
                                                <div class="score"
                                                     data-current-rating="<?php echo $userRated ? $m['user_rating'] : 0; ?>"
                                                     data-readonly="<?php echo $canEdit ? '0' : '1'; ?>"
                                                     data-movie-id="<?php echo $m['id']; ?>"></div>

                                                <div class="your-vote-text" style="margin-top:6px; font-size:13px; color:#666;">
                                                    <?php if ($userRated): ?>
                                                        Bạn đã đánh giá: <span class="user-rate-value"><?php echo number_format($m['user_rating'],1); ?></span>
                                                    <?php else: ?>
                                                        Bạn chưa đánh giá
                                                    <?php endif; ?>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php $i++; endforeach; ?>
                                <?php else: ?>
                                    <tr><td colspan="4">Chưa có dữ liệu.</td></tr>
                                <?php endif; ?>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <?php require('footer_view.php'); ?>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="<?php echo base_url(); ?>js/external/jquery-3.1.1.min.js"><\\/script>')</script>
    <script src="<?php echo base_url(); ?>js/external/jquery.raty.js"></script>
    <script src="<?php echo base_url(); ?>js/custom.js"></script>
    <script>
        // ensure base_url for custom.js
        window.base_url = '<?php echo base_url(); ?>';
        // initialize raty for this page (custom.js already does generic init)
        $(document).ready(function(){ init_Rates && typeof init_Rates === 'function' && init_Rates(); });
    </script>
</body>
</html>


