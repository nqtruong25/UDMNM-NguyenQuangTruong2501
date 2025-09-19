<?php
/*
Plugin Name: Custom Login Logo
Plugin URI: https://example.com
Description: Đổi logo trang đăng nhập WordPress (có thể upload logo trong Admin)
Version: 2.1
Author: Bạn
*/

if ( !defined('ABSPATH') ) exit; // Bảo mật

// ====== Load CSS vào trang login ======
function cll_enqueue_styles() {
    wp_enqueue_style(
        'custom-login-logo',
        plugin_dir_url(__FILE__) . 'assets/custom-login-logo.css'
    );

    // CSS động cho logo (in trực tiếp)
    $logo_url = esc_url(get_option('cll_logo_url'));
    if ($logo_url) {
        echo "<style>
            #login h1 a {
                background-image: url('{$logo_url}') !important;
                height:100px; 
                width:100%;
                background-size:contain;
                background-repeat:no-repeat;
                background-position:center;
            }
        </style>";
    }
}
add_action('login_enqueue_scripts', 'cll_enqueue_styles');

// ====== Đổi link logo về trang chủ ======
add_filter('login_headerurl', function() {
    return home_url();
});
add_filter('login_headertext', function() {
    return get_bloginfo('name');
});

// ====== Tạo trang cài đặt trong Admin ======
function cll_add_admin_menu() {
    add_options_page(
        'Custom Login Logo',
        'Login Logo',
        'manage_options',
        'custom-login-logo',
        'cll_settings_page'
    );
}
add_action('admin_menu', 'cll_add_admin_menu');

// ====== Đăng ký option ======
function cll_register_settings() {
    register_setting('cll_settings_group', 'cll_logo_url');
}
add_action('admin_init', 'cll_register_settings');

// ====== Nạp script Media Uploader ======
function cll_admin_scripts($hook) {
    // Chỉ load trên trang cài đặt plugin
    if ($hook != 'settings_page_custom-login-logo') {
        return;
    }
    wp_enqueue_media();
    wp_enqueue_script('jquery');
}
add_action('admin_enqueue_scripts', 'cll_admin_scripts');

// ====== Trang cài đặt ======
function cll_settings_page() { ?>
    <div class="wrap">
        <h1>⚙️ Cài đặt Logo Đăng Nhập</h1>
        <form method="post" action="options.php">
            <?php settings_fields('cll_settings_group'); ?>
            <?php do_settings_sections('cll_settings_group'); ?>

            <table class="form-table">
                <tr valign="top">
                    <th scope="row">Logo URL</th>
                    <td>
                        <input type="text" id="cll_logo_url" name="cll_logo_url" 
                               value="<?php echo esc_attr(get_option('cll_logo_url')); ?>" 
                               style="width:60%;" />
                        <input type="button" class="button" value="Chọn ảnh" id="upload_logo_button" />
                    </td>
                </tr>
            </table>

            <?php submit_button(); ?>
        </form>
    </div>

    <script>
    jQuery(document).ready(function($){
        var mediaUploader;
        $('#upload_logo_button').click(function(e) {
            e.preventDefault();
            if (mediaUploader) {
                mediaUploader.open();
                return;
            }
            mediaUploader = wp.media.frames.file_frame = wp.media({
                title: 'Chọn Logo',
                button: { text: 'Sử dụng ảnh này' },
                multiple: false
            });
            mediaUploader.on('select', function() {
                var attachment = mediaUploader.state().get('selection').first().toJSON();
                $('#cll_logo_url').val(attachment.url);
            });
            mediaUploader.open();
        });
    });
    </script>
<?php }
