<?php while (have_posts()) : the_post(); ?>
	<div class="content-wrap"><?php echo get_the_content(); ?></div>
<?php endwhile; ?>
 <?php 
  	$dischi=get_posts(array( 
  		"post_type"=>"componente",
  		"posts_per_page"=>-1
  		));
  	$display="";  	
  	$page=get_page_by_title( 'Rete Co\'mar' );
  	$link=get_page_link($page->ID);
  	if(count($dischi)>0){
  	echo '<ul class="componenti-list"><h2 class="section-title">La Band</h2>';  		  
	  	foreach ($dischi as $key => $disco) {
	  		setup_postdata($GLOBALS['post'] =& $disco );
	  		echo '<li class="componente" ><a href="'.$link.'?band='.$disco->post_name.'">';
	  		the_post_thumbnail( );
	  		echo '</a><a href="'.$link.'?band='.$disco->post_name.'"><p>';
	  		the_title();
	  		echo '<p></a></li>';
	  	}
	echo '</ul>';
	}
  ?>