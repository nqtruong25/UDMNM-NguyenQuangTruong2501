<?php get_header(); ?>
<div class="tour-list">
  <h2>Tours du lịch mới</h2>
  <div class="grid">
    <?php if (have_posts()) : while (have_posts()) : the_post();
      $dia_diem = get_field('dia_diem_khoi_hanh');
      $ngay_khoi_hanh = get_field('ngay_khoi_hanh');
      $thoi_gian = get_field('thoi_gian');
      $gia_tour = get_field('gia_tour');
      $anh_tour = get_field('anh_tour');
    ?>
    <div class="tour-card">
      <a href="<?php the_permalink(); ?>">
        <?php if ($anh_tour && isset($anh_tour['url'])): ?>
          <img src="<?php echo esc_url($anh_tour['url']); ?>" alt="<?php the_title(); ?>">
        <?php else: ?>
          <img src="link-anh-default.jpg" alt="No Image">
        <?php endif; ?>
      </a>
      <h3><?php the_title(); ?></h3>
      <p>Khởi hành từ: <?php echo esc_html($dia_diem); ?></p>
      <p>Ngày khởi hành: <?php echo esc_html($ngay_khoi_hanh); ?></p>
      <p>Thời gian: <?php echo esc_html($thoi_gian); ?></p>
      <p>Giá tour: <?php echo number_format($gia_tour, 0, '', ','); ?> đồng</p>
      <a href="<?php the_permalink(); ?>">XEM CHI TIẾT</a>
    </div>
    <?php endwhile; else: ?>
      <p>Không có tour nào được tìm thấy.</p>
    <?php endif; ?>
  </div>
</div>
<?php get_footer(); ?>