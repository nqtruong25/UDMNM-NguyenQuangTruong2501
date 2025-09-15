<?php
/**
 * Roavia Theme functions and definitions
 *
 * @package Roavia_Theme
 * Author: Quang Trường
 * Version: 1.0
 */

// Load Bootstrap CSS & JS, theme style
function roavia_enqueue_scripts() {
    wp_enqueue_style('bootstrap-css', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css');
    wp_enqueue_style('roavia-style', get_stylesheet_uri());
    wp_enqueue_style('roavia-custom', get_template_directory_uri() . '/custom.css');
    wp_enqueue_script('bootstrap-js', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js', array(), null, true); // Bootstrap 5 không cần jQuery
}
add_action('wp_enqueue_scripts', 'roavia_enqueue_scripts');

// Theme support & setup
function roavia_theme_setup() {
    add_theme_support('custom-logo');
    add_theme_support('post-thumbnails');
    add_theme_support('title-tag'); // Tự động thẻ <title>
    add_theme_support('html5', array('search-form', 'comment-form', 'comment-list', 'gallery', 'caption')); // Hỗ trợ HTML5
    add_theme_support('widgets'); // Hỗ trợ widgets

    // Đăng ký menu
    register_nav_menus(array(
        'primary' => __('Menu Chính', 'roavia_theme'),
        'footer'  => __('Menu Footer', 'roavia_theme')
    ));

    // Hỗ trợ dịch theme
    load_theme_textdomain('roavia_theme', get_template_directory() . '/languages');
}
add_action('after_setup_theme', 'roavia_theme_setup');

// Đăng ký sidebar/widget area
function roavia_widgets_init() {
    register_sidebar(array(
        'name'          => __('Sidebar Chính', 'roavia_theme'),
        'id'            => 'sidebar-1',
        'description'   => __('Khu vực sidebar chính.', 'roavia_theme'),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ));
}
add_action('widgets_init', 'roavia_widgets_init');

// Optimize image upload: giảm dung lượng ảnh JPEG
function roavia_optimize_image($metadata, $attachment_id) {
    $upload_dir = wp_upload_dir();
    $file_path = $upload_dir['basedir'] . '/' . $metadata['file'];
    $image_info = @getimagesize($file_path);
    if ($image_info && $image_info['mime'] === 'image/jpeg') {
        $image = imagecreatefromjpeg($file_path);
        imagejpeg($image, $file_path, 80);
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

// Bảo mật: Ẩn version WordPress
remove_action('wp_head', 'wp_generator');

// Bảo mật: Chặn XML-RPC nếu không cần thiết
add_filter('xmlrpc_enabled', '__return_false');

// Tắt Gutenberg, bật Classic Editor
add_filter('use_block_editor_for_post', '__return_false', 10);

// Tắt trình soạn thảo khối trong widget (WP 5.8+)
add_filter('use_widgets_block_editor', '__return_false');

function vian_register_footer_widgets() {
    // Footer 1
    register_sidebar(array(
        'name'          => 'Footer Địa chỉ',
        'id'            => 'footer-1',
        'description'   => 'Hiển thị địa chỉ, thông tin liên hệ',
        'before_widget' => '<div class="footer-widget">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="footer-title">',
        'after_title'   => '</h3>',
    ));

    // Footer 2
    register_sidebar(array(
        'name'          => 'Footer Giờ mở cửa',
        'id'            => 'footer-2',
        'description'   => 'Hiển thị giờ mở cửa',
        'before_widget' => '<div class="footer-widget">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="footer-title">',
        'after_title'   => '</h3>',
    ));

    // Footer 3
    register_sidebar(array(
        'name'          => 'Footer Menu nhanh',
        'id'            => 'footer-3',
        'description'   => 'Menu nhanh điều hướng',
        'before_widget' => '<div class="footer-widget">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="footer-title">',
        'after_title'   => '</h3>',
    ));

    // Footer 4
    register_sidebar(array(
        'name'          => 'Footer Mạng xã hội',
        'id'            => 'footer-4',
        'description'   => 'Hiển thị icon mạng xã hội',
        'before_widget' => '<div class="footer-widget">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="footer-title">',
        'after_title'   => '</h3>',
    ));
}
add_action('widgets_init', 'vian_register_footer_widgets');