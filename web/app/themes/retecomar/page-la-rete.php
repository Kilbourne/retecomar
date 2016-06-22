<?php while (have_posts()) : the_post(); ?>
  <?php get_template_part('templates/page', 'header'); ?>
  <div class="links-intro">
  <?php get_template_part('templates/content', 'page'); ?>
  </div>
<?php endwhile; ?>
<?php 
$links=get_posts(array( 
  		"post_type"=>"rete_link",
  		"posts_per_page"=>-1
  		));
if(count($links)>0){
?>
<ul class="links-list">
	
<?php 
  	foreach ($links as $key => $link) {
  		setup_postdata($GLOBALS['post'] =& $link );
  		?> 
  		<li class="rete-link"><a href="<?php echo get_field('link_rete3',$link->ID); ?>">
  			<?php if(has_post_thumbnail($link->ID)){
  				the_post_thumbnail('thumb' );
  				}else{
  				 the_title();
  			} ?>
  		</a></li>
  		<?php 
	wp_reset_postdata();
  	}
  	 ?>

</ul>
  	 <?php 
  }
  	 ?>