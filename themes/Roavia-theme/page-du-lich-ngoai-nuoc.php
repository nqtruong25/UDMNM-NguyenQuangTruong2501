<?php
/**
 * Template Name: Du lịch ngoài nước
 * Description: Hiển thị các bài viết thuộc category "Du lịch ngoài nước"
 */

get_header();
?>

<!-- Slider (nếu có Smart Slider 3) -->
<?php echo do_shortcode('[smartslider3 slider="7"]'); ?>

<div class="site-content container py-5">
  <h2 class="mb-5 text-center">Du lịch ngoài nước</h2>

  <?php
  // Query bài viết trong category "du-lich-ngoai-nuoc"
  $args = array(
    'post_type'      => 'post',
    'posts_per_page' => 6,
    'category_name'  => 'du-lich-ngoai-nuoc',
    'orderby'        => 'date',
    'order'          => 'DESC'
  );

  $query = new WP_Query($args);

  if ($query->have_posts()) :
    $i = 0;
    while ($query->have_posts()) : $query->the_post();
      $i++; ?>
      
      <div class="tour-item d-flex align-items-center mb-5 <?php echo ($i % 2 == 0) ? 'flex-row-reverse' : ''; ?>">
        <div class="tour-thumb flex-1 me-4">
          <a href="<?php the_permalink(); ?>">
            <?php the_post_thumbnail('large'); ?>
          </a>
        </div>
        <div class="tour-content flex-1">
          <h2 class="tour-title">
            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
          </h2>
          <p class="tour-meta">
            <?php echo get_the_date(); ?> — <?php the_author(); ?>
          </p>
          <div class="tour-full-content">
            <?php the_content(); ?>
          </div>
        </div>
      </div>

    <?php endwhile;
    wp_reset_postdata();
  else :
    echo "<p>Chưa có bài viết nào trong mục Du lịch ngoài nước.</p>";
  endif;
  ?>

  <!-- Phân trang -->
  <div class="pagination mt-5 text-center">
    <?php
    echo paginate_links(array(
      'total' => $query->max_num_pages
    ));
    ?>
  </div>
</div>

<!-- Custom Section (ACF: 5 ảnh + text) -->
<div class="container du-lich-ngoai-nuoc">
  <h1 class="page-title"><?php the_title(); ?></h1>

  <div class="page-content">
    <?php
    while (have_posts()) : the_post();
      the_content();
    endwhile;
    ?>
  </div>

  <div class="custom-section">
    <?php for ($i = 1; $i <= 5; $i++) :
      $image = get_field("image$i");
      $text  = get_field("text$i");

      if ($image) :
        $image_url = is_array($image) ? $image['url'] : $image; ?>
        
        <div class="tour-item">
          <img src="<?php echo esc_url($image_url); ?>" alt="Hình ảnh <?php echo $i; ?>" />
          <?php if ($text) : ?>
            <p><?php echo esc_html($text); ?></p>
          <?php endif; ?>
        </div>

      <?php endif;
    endfor; ?>
  </div>
</div>

<?php get_footer(); ?>
