<?php
/**
 * Template for displaying single Tour
 * File: single-tour.php
 */

get_header(); ?>

<div class="container my-5">
    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
        <?php 
            $dia_diem = get_field('dia_diem_khoi_hanh');
            $ngay_khoi_hanh = get_field('ngay_khoi_hanh');
            $thoi_gian = get_field('thoi_gian');
            $gia_tour = get_field('gia_tour');
            $anh_tour = get_field('anh_tour');
        ?>

        <div class="row">
            <div class="col-md-6">
                <?php if ($anh_tour): ?>
                    <img src="<?php echo esc_url($anh_tour['url']); ?>" class="img-fluid rounded shadow-sm mb-3" alt="<?php the_title(); ?>">
                <?php elseif (has_post_thumbnail()): ?>
                    <?php the_post_thumbnail('large', ['class' => 'img-fluid rounded shadow-sm mb-3']); ?>
                <?php else: ?>
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/no-image.jpg" class="img-fluid rounded shadow-sm mb-3" alt="No image">
                <?php endif; ?>
            </div>

            <div class="col-md-6">
                <h1 class="mb-3"><?php the_title(); ?></h1>

                <?php if ($dia_diem): ?>
                    <p><i class="dashicons dashicons-location"></i> <strong>Khởi hành từ:</strong> <?php echo esc_html($dia_diem); ?></p>
                <?php endif; ?>

                <?php if ($ngay_khoi_hanh): ?>
                    <p><i class="dashicons dashicons-calendar-alt"></i> <strong>Ngày khởi hành:</strong> <?php echo esc_html($ngay_khoi_hanh); ?></p>
                <?php endif; ?>

                <?php if ($thoi_gian): ?>
                    <p><i class="dashicons dashicons-clock"></i> <strong>Thời gian:</strong> <?php echo esc_html($thoi_gian); ?></p>
                <?php endif; ?>

                <?php if ($gia_tour): ?>
                    <p><i class="dashicons dashicons-tickets"></i> <strong>Giá tour:</strong> 
                        <span class="text-danger h4"><?php echo number_format($gia_tour, 0, ',', '.'); ?> đ</span>
                    </p>
                <?php endif; ?>

                <div class="mt-4">
                    <a href="/lien-he" class="btn btn-success btn-lg">Đặt tour ngay</a>
                </div>
            </div>
        </div>

        <div class="mt-5">
            <h3>Chi tiết Tour</h3>
            <div class="content">
                <?php the_content(); ?>
            </div>
        </div>

    <?php endwhile; endif; ?>
</div>

<?php get_footer(); ?>
