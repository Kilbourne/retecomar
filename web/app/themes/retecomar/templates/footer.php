<footer class="content-info">
  <div class="container">
  	<span>©2016 Rete co’ Mar</span>
    <nav class="nav-primary">
      <?php
      if (has_nav_menu('primary_navigation')) :
        wp_nav_menu(['theme_location' => 'primary_navigation', 'menu_class' => 'nav']);
      endif;
      ?>
    </nav>
    <span>powered by <a href="http://www.menthalia.com">MENTHALIA</a></span>
  </div>
</footer>
