<?php
/**
 * Roavia Theme functions and definitions
 *
 * @package Roavia_Theme
 * Author: Quang Trường
 * Version: 1.0
 */

// Load Bootstrap CSS & JS
function roavia_enqueue_scripts() {
    wp_enqueue_style('bootstrap-css', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css');
    wp_enqueue_style('roavia-style', get_stylesheet_uri());
    wp_enqueue_style('roavia-custom', get_template_directory_uri() . '/custom.css');
    wp_enqueue_script('bootstrap-js', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js', array('jquery'), null, true);
}
add_action('wp_enqueue_scripts', 'roavia_enqueue_scripts');

// Theme support
function roavia_theme_setup() {
    add_theme_support('custom-logo');
    add_theme_support('post-thumbnails');
    // Đăng ký vị trí menu
    register_nav_menus(array(
        'primary' => __('Menu Chính', 'roavia_theme'),
        'footer'  => __('Menu Footer', 'roavia_theme')
    ));
}
add_action('after_setup_theme', 'roavia_theme_setup');

// Optimize image upload
function roavia_optimize_image($metadata, $attachment_id) {
    $upload_dir = wp_upload_dir();
    $file_path = $upload_dir['basedir'] . '/' . $metadata['file'];

    // Reduce image quality for JPG/JPEG only
    $image_info = @getimagesize($file_path); // dùng @ để tránh lỗi khi file chưa đúng
    if ($image_info && $image_info['mime'] === 'image/jpeg') {
        $image = imagecreatefromjpeg($file_path);
        imagejpeg($image, $file_path, 80); // 80% quality
        imagedestroy($image);
    }
    return $metadata;
}
add_filter('wp_generate_attachment_metadata', 'roavia_optimize_image', 10, 2);

// Custom Admin Logo
function roavia_custom_admin_logo() {
    $logo_id = get_theme_mod('custom_logo');
    if ($logo_id) {
        $logo_src = wp_get_attachment_image_src($logo_id, 'full');
        echo '<style>
            #wp-admin-bar-wp-logo > .ab-item .ab-icon {
                background-image: url(' . esc_url($logo_src[0]) . ') !important;
                background-size: contain !important;
                background-repeat: no-repeat !important;
            }
        </style>';
    }
}
add_action('admin_head', 'roavia_custom_admin_logo');

// Theme info
function roavia_theme_info() {
    echo '<!-- Roavia Theme v1.0 by Quang Trường -->';
}
add_action('wp_head', 'roavia_theme_info');
add_action('admin_head', 'roavia_theme_info');