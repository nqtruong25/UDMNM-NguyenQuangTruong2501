<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<header class="container py-3 d-flex align-items-center justify-content-between">
    <?php
    if (function_exists('the_custom_logo') && has_custom_logo()) {
        the_custom_logo();
    } else {
        echo '<a href="' . esc_url(home_url('/')) . '" class="navbar-brand">' . get_bloginfo('name') . '</a>';
    }
    ?>
    <nav>
        <?php wp_nav_menu(['theme_location' => 'primary', 'container' => false, 'menu_class' => 'nav']); ?>
    </nav>
</header>