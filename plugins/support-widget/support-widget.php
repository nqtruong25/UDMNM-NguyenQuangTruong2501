<?php
/*
Plugin Name: Support Widget
Description: Hiển thị hộp hỗ trợ trực tuyến nổi (tư vấn, gọi điện, chat Zalo).
Version: 1.1
Author: Quang
*/

if (!defined('ABSPATH')) exit;

class Support_Widget {
    public function __construct() {
        add_action('wp_enqueue_scripts', [$this, 'enqueue_assets']);
        add_action('wp_footer', [$this, 'render_widget']);
    }

    public function enqueue_assets() {
        // CSS & JS của plugin
        wp_enqueue_style('support-widget-style', plugin_dir_url(__FILE__) . 'assets/style.css');
        wp_enqueue_script('support-widget-script', plugin_dir_url(__FILE__) . 'assets/script.js', ['jquery'], false, true);

        // Font Awesome để có icon đẹp
        wp_enqueue_style('support-widget-fa', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css');
    }

    public function render_widget() {
        ?>
        <div id="support-widget">
            <!-- Nút nổi -->
            <div class="support-toggle">
                <i class="fas fa-comments"></i>
            </div>

            <!-- Popup hỗ trợ -->
            <div class="support-box">
                <div class="support-header">
                    Hỗ trợ trực tuyến
                    <span class="close-btn">×</span>
                </div>

                <div class="support-item">
                    <a href="#">
                        <i class="fas fa-calendar-alt"></i> Đặt Lịch Hẹn Tư Vấn
                    </a>
                </div>

                <div class="support-item">
                    <a href="tel:0376800241">
                        <i class="fas fa-phone-alt"></i> 0376 800 241
                    </a>
                    <p>(08h - 22h, miễn phí)</p>
                </div>

                <div class="support-item">
                    <a href="https://zalo.me/0904525659" target="_blank">
                        <img src="<?php echo plugin_dir_url(__FILE__); ?>assets/zalo.png.webp" alt="Zalo" style="width:20px;height:20px;vertical-align:middle;"> 
                        Chat Zalo Ngay!
                    </a>
                </div>
            </div>
        </div>
        <?php
    }
}

new Support_Widget();
