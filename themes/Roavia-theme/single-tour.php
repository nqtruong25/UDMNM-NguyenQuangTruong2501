<?php get_header(); ?>

<?php
if (have_posts()) : while (have_posts()) : the_post();

  // DEBUG: Hiện toàn bộ ACF nếu cần
  // echo '<pre>';
  // print_r(get_field_objects());
  // echo '</pre>';

  $dia_diem = get_field('dia_diem_khoi_hanh');
  $ngay_khoi_hanh = get_field('ngay_khoi_hanh');
  $thoi_gian = get_field('thoi_gian');
  $gia_tour = get_field('gia_tour');
  $anh_tour = get_field('anh_tour');
?>
<article class="tour-single" style="max-width:700px; margin:40px auto; background:#fff; border-radius:12px; box-shadow:0 2px 16px rgba(0,0,0,0.08); padding:32px;">
  <h1 style="color:#f6881d; font-size:2.2rem; margin-bottom:22px;"><?php the_title(); ?></h1>
  <?php if ($anh_tour && isset($anh_tour['url'])): ?>
    <img src="<?php echo esc_url($anh_tour['url']); ?>" alt="<?php the_title(); ?>" style="width:100%; max-width:480px; border-radius:9px; margin-bottom:18px;" />
  <?php endif; ?>
  <div style="font-size:1.08rem;">
    <p><strong>Địa điểm khởi hành:</strong> <?php echo $dia_diem ? esc_html($dia_diem) : 'Đang cập nhật'; ?></p>
    <p><strong>Ngày khởi hành:</strong> <?php echo $ngay_khoi_hanh ? esc_html($ngay_khoi_hanh) : 'Đang cập nhật'; ?></p>
    <p><strong>Thời gian:</strong> <?php echo $thoi_gian ? esc_html($thoi_gian) : 'Đang cập nhật'; ?></p>
    <p><strong>Giá tour:</strong> <span style="color:#d67119; font-weight:bold;"><?php echo $gia_tour ? number_format($gia_tour, 0, '', ',') : 'Đang cập nhật'; ?> đồng</span></p>
  </div>
  <div style="margin-top:28px; font-size:1.07rem; color:#333;">
    <?php the_content(); ?>
  </div>
  <a href="tel:0123456789" style="display:inline-block; margin-top:26px; background:#f6881d; color:#fff; padding:12px 32px; border-radius:8px; font-weight:700; text-decoration:none;">Đặt tour ngay</a>
</article>
<?php endwhile; endif; ?>

<?php get_footer(); ?>