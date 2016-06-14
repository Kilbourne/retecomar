<?php while (have_posts()) : the_post(); ?>
  <article <?php post_class(); ?>>
    <header>
       <div class="backlink"><?php $back =$_SERVER['HTTP_REFERER'];
        $myDomain       = $_SERVER['HTTP_HOST'];
    

     
if(isset($back) && $back !='' && $myDomain === parse_url($back, PHP_URL_HOST) ) echo '<a href="'.$back.'">Torna indietro</a>'; ?></div>
    
      <h1 class="entry-title"><?php the_title(); ?></h1>
      <?php get_template_part('templates/entry-meta'); ?>
    </header>
    <div class="entry-content">
      <?php the_content(); ?>
    </div>
    <footer>
      <?php wp_link_pages(['before' => '<nav class="page-nav"><p>' . __('Pages:', 'sage'), 'after' => '</p></nav>']); ?>
    </footer>
    <?php comments_template('/templates/comments.php'); ?>
  </article>
<?php endwhile; ?>
