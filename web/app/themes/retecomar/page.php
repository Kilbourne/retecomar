<?php while (have_posts()) : the_post(); ?>
  <?php get_template_part('templates/page', 'header'); ?>
    <?php $post_name=get_post_field( 'post_name', get_post() );

        if (locate_template( "templates/content-".$post_name.".php") ) { get_template_part('templates/content',$post_name);}
        else{get_template_part('templates/content', 'page');}
  ?>
<?php endwhile; ?>
