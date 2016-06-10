<?php while (have_posts()) : the_post(); ?>
	<div class="content-wrap"><?php echo get_the_content(); ?></div>
<?php endwhile; ?>
 <?php 
  	$dischi=get_posts(array( 
  		"post_type"=>"componente",
  		"posts_per_page"=>-1
  		));
  	$display="";  	
  	if(count($dischi)>0){
  	echo '<ul class="componenti-list"><h2 class="section-title">La Band</h2>';  		
	  	foreach ($dischi as $key => $disco) {
	  		setup_postdata($GLOBALS['post'] =& $disco );
	  		echo '<li class="componente" ><a href="">';
	  		the_post_thumbnail( );
	  		echo '</a><a href=""><p>';
	  		the_title();
	  		echo '<p></a></li>';
	  	}
	echo '</ul>';
	}
  ?>