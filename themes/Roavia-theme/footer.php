<footer class="footer">
  <div class="footer-container">
    <div class="footer-column">
      <h2 class="footer-title">Công ty Du Lịch Divui</h2>
      <ul class="footer-info">
        <li><i class="fa-solid fa-location-dot"></i> 155 Láng Hạ - Phố Cổ - Đà Nẵng</li>
        <li><i class="fa-solid fa-phone"></i> +84-316-255-xxx</li>
        <li><i class="fa-solid fa-qrcode"></i> MST 1212585xxx</li>
        <li><i class="fa-solid fa-envelope"></i></i> info@webdemo.com</li>
        <li><i class="fa-brands fa-facebook"></i> facebook.com/webdemo</li>
      </ul>
    </div>
    <div class="footer-column">
      <h2 class="footer-title">THÔNG TIN CẦN BIẾT</h2>
      <ul class="footer-links">
        <li>Điều kiện điều khoản</a></li>
        <li>Phương thức thanh toán</a></li>
        <li>Bảo mật thông tin khách hàng</a></li>
        <li>Chính sách quy định</a></li>
      </ul>
    </div>
    <div class="footer-column">
      <h2 class="footer-title">VỀ CHÚNG TÔI</h2>
      <ul class="footer-links">
        <li>Trang chủ</a></li>
        <li>Du lịch trong nước</a></li>
        <li>Du lịch nước ngoài</a></li>
        <li>Giới thiệu</a></li>
        <li>Liên hệ</a></li>
      </ul>
    </div>
    <div class="footer-column">
      <h2 class="footer-title">FANPAGE FACEBOOK</h2>
      
      <div class="footer-social">
        <a href="https://www.facebook.com/?locale=vi_VN"><i class="fa-brands fa-facebook"></i></a>
        <a href="https://www.instagram.com/"><i class="fa-brands fa-square-instagram"></i></a>
        <a href="https://x.com/home"><i class="fa-brands fa-twitter"></i></a>
        <a href="https://mail.google.com/mail/u/0/#inbox"><i class="fa-solid fa-envelope"></i></a>
      </div>
    </div>
    
  </div>
  <div class="logo">
      <?php
        if (has_custom_logo()) {
          the_custom_logo();
        } else {
          echo '<a href="' . esc_url(home_url('/')) . '">' . get_bloginfo('name') . '</a>';
        }
      ?>
    </div>
  <p class="text-center py-3">&copy; <?php echo date('Y'); ?> Roavia Theme by Quang Trường - v1.0</p>
</footer>
<footer class="container py-4 text-center">
    
    
</footer>
<?php wp_footer(); ?>
</body>
</html>