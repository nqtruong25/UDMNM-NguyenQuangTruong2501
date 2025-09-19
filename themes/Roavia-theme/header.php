<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <?php wp_head(); ?>
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<header class="site-header">
  <div class="container header-container">
    
    <!-- Logo -->
    <div class="logo">
      <?php
        if (has_custom_logo()) {
          the_custom_logo();
        } else {
          echo '<a href="' . esc_url(home_url('/')) . '">' . get_bloginfo('name') . '</a>';
        }
      ?>
    </div>

    

    <!-- Menu -->
    <nav class="main-nav">
      <?php
        wp_nav_menu(array(
          'theme_location' => 'primary',
          'menu_class'     => 'nav-list',
          'container'      => false
        ));
      ?>
    </nav>
<!-- Nút menu mobile -->
    <div class="menu-toggle"><i class="fas fa-bars"></i></div>
    <!-- Hotline -->
    <div class="hotline">
      <a href="tel:0284455xxxx">0376800241</a>
    </div>
  </div>
</header>



<?php wp_footer(); ?>

<script>
document.addEventListener("DOMContentLoaded", function () {
  const toggle = document.querySelector(".menu-toggle");
  const nav = document.querySelector(".main-nav");

  if (toggle) {
    toggle.addEventListener("click", function () {
      nav.classList.toggle("active");
    });
  }
});

</script>
</body>
</html>
