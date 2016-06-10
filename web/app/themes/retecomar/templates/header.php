<header class="banner page-wrapper">
  <div class="container">
    <a class="brand" href="<?= esc_url(home_url('/')); ?>"><img src="<?php echo get_stylesheet_directory_uri().'/dist/images/logo.jpg'; ?>" alt="Logo Rete Co'mar "></a>
    <nav class="nav-primary">
      <?php
      if (has_nav_menu('primary_navigation')) :
        wp_nav_menu(['theme_location' => 'primary_navigation', 'menu_class' => 'nav']);
      endif;
      ?>
    </nav>
    <div class="music-channels">
      <p>Compra subito il nostro nuovo album, FUORI TUTTI!</p>
      <ul class="music-store-list">
        <li class="music-store-link"><a href=""><img src="<?php echo get_stylesheet_directory_uri().'/dist/images/itunes.png'; ?>" alt="iTunes Link"></a></li>
        <li class="music-store-link"><a href=""><img src="<?php echo get_stylesheet_directory_uri().'/dist/images/gplay.jpg'; ?>" alt="Google Play Link"></a></li>
        <li class="music-store-link"><a href=""><img src="<?php echo get_stylesheet_directory_uri().'/dist/images/amazonmusic.png'; ?>" alt="Amazon Music Link"></a></li>
        <li class="music-store-link"><a href=""><img src="<?php echo get_stylesheet_directory_uri().'/dist/images/spotify.png'; ?>" alt="Spotify Link"></a></li>
      </ul>
    </div>
  </div>
  <div class="head-big-image-wrap"><img src="<?php echo get_stylesheet_directory_uri().'/dist/images/img_6402.jpg'; ?>" alt="Foto di gruppo Rete Co'mar"> </div>
</header>
