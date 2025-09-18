<?php
/**
 * Template Name: Du lịch ngoài nước
 * Description: Hiển thị các bài viết thuộc category "Du lịch ngoài nước"
 */

get_header(); ?>

<?php
// Slider (nếu có Smart Slider 3)
echo do_shortcode('[smartslider3 slider="7"]');
?>

<div class="site-content container py-5">
  <h2 class="mb-5 text-center">Du lịch ngoài nước</h2>

  <?php
  // Truy vấn bài viết trong category "du-lich-ngoai-nuoc"
  $args = array(
    'post_type'      => 'post',
    'posts_per_page' => 6, // số bài viết muốn hiển thị
    'category_name'  => 'du-lich-ngoai-nuoc', // slug của category
    'orderby'        => 'date',
    'order'          => 'DESC'
  );
  $query = new WP_Query($args);

  if ($query->have_posts()) :
    $i = 0; // đếm bài để luân phiên trái - phải
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

<?php get_footer(); ?>
