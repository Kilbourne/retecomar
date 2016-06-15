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
    <?php 
     $music_channels_text=get_field('testo_music_channel','option')?get_field('testo_music_channel','option'):'Compra subito il nostro nuovo album, FUORI TUTTI!';
     $itunes_link=get_field('link_itunes','option')?get_field('link_itunes','option'):'';
     $google_link=get_field('link_google_play','option')?get_field('link_google_play','option'):'';
     $amazon_link=get_field('link_amazon_music','option')?get_field('link_amazon_music','option'):'';
     $spotify_link=get_field('link_spotify','option')?get_field('link_spotify','option'):'';
     ?>
      <p><?php echo $music_channels_text; ?></p>
      <ul class="music-store-list">
        <li class="music-store-link"><a href="<?php echo $itunes_link ; ?>"><img src="<?php echo get_stylesheet_directory_uri().'/dist/images/itunes.png'; ?>" alt="iTunes Link"></a></li>
        <li class="music-store-link"><a href="<?php echo $google_link; ?>"><img src="<?php echo get_stylesheet_directory_uri().'/dist/images/gplay.jpg'; ?>" alt="Google Play Link"></a></li>
        <li class="music-store-link"><a href="<?php echo $amazon_link ; ?>"><img src="<?php echo get_stylesheet_directory_uri().'/dist/images/amazonmusic.png'; ?>" alt="Amazon Music Link"></a></li>
        <li class="music-store-link"><a href="<?php echo $spotify_link; ?>"><img src="<?php echo get_stylesheet_directory_uri().'/dist/images/spotify.png'; ?>" alt="Spotify Link"></a></li>
      </ul>
    </div>
  </div>
  <?php   $slider=get_field('home_slider','option');
  $slider_in_home=get_field('main_slider_in_homepage','option');
  $slider_in_others=get_field('main_slider_other_pages','option');
  $conditon=false;
  if($slider){
    if(!$slider_in_others){
      if($slider_in_home && is_front_page()) $condition=true;
    }else{
      if($slider_in_home){ $condition=true; }else{
        if( ! is_front_page()) $condition=true;
      }
    }
  }
  if($condition){ ?>    <ul class="home-slider">
        <?php foreach( $slider as $image ): 
          
        ?>
            <li>
                
                     <img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" />
                
            </li>
        <?php endforeach; ?>
    </ul> <?php }else{ 
      $main_image=get_field('main_image','option');
      ?>
  <div class="head-big-image-wrap"><img src="<?php echo  $main_image; ?>" alt="Foto di gruppo Rete Co'mar"> </div>
  <?php   } ?>
</header>
<?php echo do_shortcode('[responsive_menu_pro] ' ); ?>