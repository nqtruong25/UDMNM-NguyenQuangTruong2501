<?php
/**
 * Template Name: Du lịch trong nước
 */

get_header(); ?>

<?php
echo do_shortcode('[smartslider3 slider="8"]');
?>

<div class="container du-lich-trong-nuoc py-5">
  <h1 class="page-title text-center mb-5"><?php the_title(); ?></h1>

  <div class="page-content">
    <?php
    if (have_posts()) :
      while (have_posts()) : the_post();
        the_content();
      endwhile;
    else :
      echo "<p>Chưa có nội dung cho trang này.</p>";
    endif;
    ?>
  </div>
</div>
<?php get_footer(); ?>
