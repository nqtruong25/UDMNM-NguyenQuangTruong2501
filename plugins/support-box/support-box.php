<?php
/*
Plugin Name: Support Box
Description: Tạo nút hỗ trợ trực tuyến (gọi điện, Zalo, đặt lịch hẹn).
Version: 1.1
Author: Bạn
*/

if ( !defined('ABSPATH') ) exit; // Bảo mật

// ====== Thêm HTML vào footer ======
function support_box_html() {
    ?>
    <div id="supportBox" class="support-box">
        <div class="support-box-header">
            <span>Hỗ trợ trực tuyến</span>
            <button class="support-box-close" onclick="toggleSupportBox()">×</button>
        </div>
        <div class="support-box-item">
            <a href="#" target="_blank">
                <span>📅</span> Đặt Lịch Hẹn Tư Vấn
            </a>
        </div>
        <div class="support-box-item">
            <a href="tel:0376800241">
                <span>📞</span> 0376 800 241
                <div class="sub-text">(08h - 22h, miễn phí)</div>
            </a>
        </div>
        <div class="support-box-item">
    <a href="https://zalo.me/0904525659" target="_blank">
        <img src="https://upload.wikimedia.org/wikipedia/commons/9/91/Icon_of_Zalo.svg" 
             alt="Zalo" class="zalo-icon"/>
        Chat Zalo Ngay!
    </a>
</div>
    </div>

    <!-- Nút tròn -->
    <div id="supportToggle" class="support-toggle" onclick="toggleSupportBox()">
        💬
    </div>
    <?php
}
add_action('wp_footer', 'support_box_html');

// ====== Load CSS & JS ======
function support_box_assets() {
    wp_enqueue_style('support-box-css', plugin_dir_url(__FILE__) . 'assets/support-box.css');
}
add_action('wp_enqueue_scripts', 'support_box_assets');

function support_box_js() {
    ?>
    <script>
    function toggleSupportBox() {
        var box = document.getElementById("supportBox");
        if (box.style.display === "block") {
            box.style.display = "none";
        } else {
            box.style.display = "block";
        }
    }
    </script>
    <?php
}
add_action('wp_footer', 'support_box_js');
