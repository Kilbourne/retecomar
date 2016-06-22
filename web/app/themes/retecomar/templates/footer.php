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
<script>
window.ga=window.ga||function(){(ga.q=ga.q||[]).push(arguments)};ga.l=+new Date;
ga('create', 'UA-79722378-1', 'auto');
ga('set', 'anonymizeIp', true);
ga('send', 'pageview');
</script>
<script async src='https://www.google-analytics.com/analytics.js'></script>