<?php
/* 
Template Name: Giới thiệu
*/

get_header(); 
?>

<?php
echo do_shortcode('[smartslider3 slider="6"]');
?>

<main id="site-content" role="main" class="gioi-thieu-page">

    <div class="container">
        <?php
        // Lấy bài viết có slug là "gioi-thieu"
        $args = array(
            'name'           => 'gioi-thieu',
            'post_type'      => 'post',
            'post_status'    => 'publish',
            'posts_per_page' => 1
        );
        $gioi_thieu = new WP_Query($args);

        if ($gioi_thieu->have_posts()) :
            while ($gioi_thieu->have_posts()) : $gioi_thieu->the_post();
        ?>
               <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

    <?php if (has_post_thumbnail()) : ?>
        <div class="featured-image">
            <?php the_post_thumbnail('large'); ?>
        </div>
    <?php endif; ?>

    <h1 class="page-title"><?php the_title(); ?></h1>

    <div class="entry-content">
        <?php the_content(); ?>
    </div>

</article>
        <?php
            endwhile;
            wp_reset_postdata();
        else :
            echo '<p>Chưa có nội dung giới thiệu.</p>';
        endif;
        ?>
    </div>

</main>

<?php get_footer(); ?>
