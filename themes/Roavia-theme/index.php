<?php get_header(); ?>
<main class="container mt-4">
    <?php
    if (have_posts()) :
        while (have_posts()) : the_post();
            ?>
            <div class="mb-5">
                <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                <?php if (has_post_thumbnail()) the_post_thumbnail('large', ['class' => 'img-fluid mb-3']); ?>
                <div><?php the_content(); ?></div>
            </div>
            <?php
        endwhile;
    else :
        echo '<p>' . __('No posts found.', 'roavia_theme') . '</p>';
    endif;
    ?>
</main>
<?php get_footer(); ?>