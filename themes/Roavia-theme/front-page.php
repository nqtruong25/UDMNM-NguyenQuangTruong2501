<?php
/* Template Name: Front Page */
get_header();
?>
<!-- Thêm slider Smart Slider 3 ngay sau header -->
<?php echo do_shortcode('[smartslider3 slider="2"]'); ?>


<!-- Service Features (icons + text) -->
<?php
$group = get_field('logo'); 

?>
<div class="service-features-row">
  <?php 
  if ($group) {
    for ($i = 1; $i <= 4; $i++) {
      $img = $group['logo' . $i] ?? null;
      $txt = $group['text' . $i] ?? '';

      // Lấy URL ảnh theo kiểu dữ liệu ACF trả về
      if ($img) {
        if (is_array($img) && isset($img['url'])) {
          $img_url = $img['url']; // nếu ACF trả về array
        } elseif (is_numeric($img)) {
          $img_url = wp_get_attachment_image_url($img, 'full'); // nếu trả về ID
        } else {
          $img_url = $img; // nếu trả về string (URL trực tiếp)
        }
      } else {
        $img_url = '';
      }

      if ($img_url): ?>
        <div class="service-feature-item">
          <img class="feature-icon" src="<?php echo esc_url($img_url); ?>" alt="<?php echo esc_attr($txt); ?>">
          <?php if ($txt): ?>
            <div class="feature-content">
              <div class="feature-title"><?php echo esc_html($txt); ?></div>
            </div>
          <?php endif; ?>
        </div>
      <?php endif; 
    }
  }
  ?>
</div>

<section class="single-post-highlight">
  <?php
  $the_query = new WP_Query([
      'name' => 'tours-du-lich-moi', // slug của bài viết
      'post_type' => 'post',
      'posts_per_page' => 1
  ]);
  if ($the_query->have_posts()) :
      while ($the_query->have_posts()) : $the_query->the_post(); ?>
          <article class="single-post">
              
              <?php if (has_post_thumbnail()) : ?>
                  <?php the_post_thumbnail('large'); ?>
              <?php endif; ?>
              <h2><?php the_title(); ?></h2>
              <div class="post-content">
                  <?php the_content(); ?>
              </div>
          </article>
      <?php endwhile;
      wp_reset_postdata();
  else :
      echo '<p>Không tìm thấy bài viết!</p>';
  endif;
  ?>
</section>



<section class="home-tour-highlight">
  <div class="home-tour-bg">
    <img src="<?php echo get_template_directory_uri(); ?>/assets/anh2.png" alt="Background" />
    <div class="home-tour-overlay"></div>
  </div>
  <div class="home-tour-content">
    <h2>Bạn đang tìm tour du lịch dành cho người thân hoặc gia đình?</h2>
    <p>Tourist Travel cung cấp đầy đủ dịch vụ dành cho bạn!</p>
    <a href="#" class="home-tour-btn">XEM NGAY <span>&#8594;</span></a>
  </div>
</section>



<section class="welcome-section">
  <div class="welcome-inner">
    <div class="welcome-img">
      <img src="<?php echo get_template_directory_uri(); ?>/assets/images/anh1.png" alt="Welcome Tourist Travel">
    </div>
    <div class="welcome-content">
      <h3>Chào mừng bạn đã ghé thăm Tourist Travel</h3>
      <p>Hãy đăng ký đăng tin với chúng tôi để tìm kiếm khách hàng nhanh hơn.</p>
    </div>
    <div class="welcome-btn">
      <a href="#" class="welcome-register-btn">Đăng ký ngay</a>
    </div>
  </div>
</section>

<!-- Footer chỉ xuất hiện ở trang chủ -->
<?php
if (is_front_page() || is_home()) {
    get_footer();
}
?>