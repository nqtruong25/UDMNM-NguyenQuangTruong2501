<?php
/* Template Name: Front Page */
get_header();
?>
<!-- Thêm slider Smart Slider 3 ngay sau header -->
<div class="acf-slider">
  <div class="slides">
    <?php
$group = get_field('banner'); // lấy ra cả group

if ($group) {
    $i = 1;
    echo '<div class="acf-slider"><div class="slides">';
    foreach ($group as $key => $img_id) {
        if ($img_id) {
            // Nếu sub-field ảnh trả về ID
            $url = wp_get_attachment_image_url($img_id, 'full');
            echo '<div class="slide"><img src="' . esc_url($url) . '" alt="banner' . $i . '" class="img' . $i . '"></div>';
            $i++;
        }
    }
    echo '</div><button class="prev">&#10094;</button><button class="next">&#10095;</button></div>';
}
?>
  </div>
  <button class="prev">&#10094;</button>
  <button class="next">&#10095;</button>
</div>

<style>
.acf-slider {
  position: relative;
  max-width: 100%;
  overflow: hidden;
}

.acf-slider .slides {
  display: flex;
  transition: transform 0.5s ease-in-out;
}

.acf-slider .slide {
  min-width: 100%;
  box-sizing: border-box;
}

.acf-slider img {
  width: 100%;
  display: block;
}

.acf-slider .prev, .acf-slider .next {
  position: absolute;
  top: 50%;
  transform: translateY(-50%);
  background: rgba(0,0,0,0.5);
  color: #fff;
  border: none;
  padding: 10px;
  cursor: pointer;
}

.acf-slider .prev { left: 10px; }
.acf-slider .next { right: 10px; }
</style>

<script>
document.addEventListener("DOMContentLoaded", function(){
    const slides = document.querySelector(".acf-slider .slides");
    const slideCount = document.querySelectorAll(".acf-slider .slide").length;
    const prevBtn = document.querySelector(".acf-slider .prev");
    const nextBtn = document.querySelector(".acf-slider .next");
    let index = 0;

    function showSlide(i) {
        if (i >= slideCount) index = 0;
        else if (i < 0) index = slideCount - 1;
        else index = i;

        slides.style.transform = "translateX(" + (-index * 100) + "%)";
    }

    nextBtn.addEventListener("click", () => showSlide(index + 1));
    prevBtn.addEventListener("click", () => showSlide(index - 1));

    // Auto slide mỗi 5s
    setInterval(() => {
        showSlide(index + 1);
    }, 5000);
});
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