<?php
/* Template Name: Front Page */
get_header();
?>
<!-- Thêm slider Smart Slider 3 ngay sau header -->
<?php
/**
 * Banner slider from ACF group 'banner' with keys img1, img2, ...
 * Requires Swiper (CSS/JS) enqueued separately (xem phần 3).
 */

$banner = get_field('banner'); // đổi 'banner' thành tên group của bạn
if (empty($banner) || !is_array($banner)) {
  return;
}

// Gom các ảnh có key dạng img1, img2, img3...
$images = [];
foreach ($banner as $key => $val) {
  if (!preg_match('/^img(\d+)$/', $key, $m)) continue;
  $index = (int)$m[1];

  $url = $alt = '';
  if (empty($val)) continue;

  // ACF Image: Array / ID / URL
  if (is_array($val)) {
    $url = isset($val['url']) ? $val['url'] : '';
    $alt = isset($val['alt']) ? $val['alt'] : '';
  } elseif (is_numeric($val)) {
    $url = wp_get_attachment_image_url((int)$val, 'full');
    $alt = get_post_meta((int)$val, '_wp_attachment_image_alt', true);
  } elseif (is_string($val)) {
    $url = $val;
    $alt = '';
  }

  if ($url) {
    $images[$index] = [
      'url' => $url,
      'alt' => $alt ?: get_bloginfo('name'),
    ];
  }
}

// Sắp xếp theo số thứ tự img1 < img2 < ...
ksort($images);

if (!$images) return;
?>

<section id="banner-slider-wrap" class="banner-slider-wrap">
  <div id="bannerSlider" class="swiper banner-slider">
    <div class="swiper-wrapper">
      <?php foreach ($images as $i => $img): ?>
        <div class="swiper-slide">
          <img
            src="<?php echo esc_url($img['url']); ?>"
            alt="<?php echo esc_attr($img['alt']); ?>"
            loading="lazy"
            decoding="async"
          />
        </div>
      <?php endforeach; ?>
    </div>

    <!-- Điều hướng + chấm -->
    <div class="swiper-button-prev" aria-label="Prev"></div>
    <div class="swiper-button-next" aria-label="Next"></div>
    <div class="swiper-pagination"></div>
  </div>
</section>

<script>
  (function(){
    if (typeof Swiper === 'undefined') return;
    new Swiper('#bannerSlider', {
      loop: true,
      speed: 600,
      autoplay: { delay: 3500, disableOnInteraction: false },
      pagination: { el: '.swiper-pagination', clickable: true },
      navigation: { nextEl: '.swiper-button-next', prevEl: '.swiper-button-prev' },
      // Có thể bật effect khác như 'fade'
      // effect: 'fade', fadeEffect: { crossFade: true },
    });
  })();
</script>






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

<?php
/**
 * Template Name: Front Page
 */

?>

<div class="section-header">
  <div class="title-left">
    <span class="subtitle">News & Blogs</span>
    <h2 class="main-title">Tin tiêu điểm</h2>
  </div>
  <a href="#" class="btn-more">Xem thêm →</a>
</div>


<?php
// Query 4 bài viết thuộc category "tin-tieu-diem"
$args = array(
    'post_type'      => 'post',
    'posts_per_page' => 4,
    'tax_query'      => array(
        array(
            'taxonomy' => 'category',
            'field'    => 'slug',
            'terms'    => 'tin-tieu-diem'
        )
    )
);
$query = new WP_Query($args);

if ($query->have_posts()) : ?>
    <!-- Slider Wrapper -->
    <div class="tin-tieu-diem-slider swiper">
        <div class="swiper-wrapper">
            <?php while ($query->have_posts()) : $query->the_post(); ?>
                <div class="swiper-slide">
                    <div class="slider-post-item">
                        <a href="<?php the_permalink(); ?>">
                            <?php if (has_post_thumbnail()) : ?>
                                <div class="post-thumb">
                                    <?php the_post_thumbnail('large'); ?>
                                </div>
                            <?php endif; ?>
                            <div class="post-title">
                                <?php the_title(); ?>
                            </div>
                        </a>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>

        <!-- Nút điều hướng -->
        <div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div>
        <div class="swiper-pagination"></div>
    </div>
<?php endif;
wp_reset_postdata();
?>





<?php
// Lấy bài viết ID = 190
$args = array(
    'p' => 190,
    'post_type' => 'post'
);
$query = new WP_Query($args);

if ($query->have_posts()) :
    while ($query->have_posts()) : $query->the_post(); ?>
    
    <section class="tourist-info-section">
        <div class="tourist-info-container">
            <div class="tourist-info-image">
                <?php the_post_thumbnail('large'); ?>
            </div>
            <div class="tourist-info-content">
                <h2><?php the_title(); ?></h2>
                <div class="tourist-text"><?php the_content(); ?></div>
            </div>
            <div class="tourist-info-button">
                <a href="#" class="btn-register">Đăng ký ngay</a>
            </div>
        </div>
    </section>

    <?php endwhile;
    wp_reset_postdata();
endif;
?>



<!-- Footer chỉ xuất hiện ở trang chủ -->
<?php
if (is_front_page() || is_home()) {
    get_footer();
}
?>