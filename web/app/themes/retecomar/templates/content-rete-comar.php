<?php the_content(); ?>
 <?php 
  	$band=get_posts(array( 
  		"post_type"=>"componente",
  		"posts_per_page"=>-1
  		));
  	$display='';  	
  	if(count($band)>0){
  		echo '<h3 class="section-title">I componenti</h3>';
  	foreach ($band as $key => $componente) {
  		setup_postdata($GLOBALS['post'] =& $componente );
  		if($key===0){
  ?>
  			<div class="extended-disc-panel not-visible">
  				<h1><?php the_title( ); ?></h1>
  				 <h2><?= get_field('strumento',$componente->ID); ?></h2>
  				 <div class="details">
            <?php 
            if(has_post_thumbnail($componente)){
              echo get_the_post_thumbnail($componente->ID,'thumbnail'); 
            }else{
              echo '<img src="'.get_stylesheet_directory_uri().'/dist/images/avatar-placeholder.png'.'" alt=""> ';
            }
             ?>
  				 	<div class="desc-wrap">
              <?php the_content();  ?>
            </div>
  				
  				 </div> 
  				<?php $images = get_field('galleria_componente',$componente->ID);
$display2="";
if( $images ): 
$display2.="
    <ul class='componente-slider'>";
         foreach( $images as $image ): 
          $display2.='<li>
                <a href="'.$image['url'].'">
                     <img src="'. $image['sizes']['thumbnail'].'" alt="'.  $image['alt'].'" />
                </a>
                
            </li>';
         endforeach; 
    $display2.="</ul>";
    if ( function_exists('slb_activate') ) {
    $display2 = slb_activate($display2);
}

 endif;	echo $display2; ?> 	
  			</div>
  <?php  
  		}

  			$display.="<li id='".$componente->ID."' class='";
  			if($key===0) $display.="active";
  			$display.="'>";
                    if(has_post_thumbnail($componente)){
              $thumb= get_the_post_thumbnail($componente->ID,'thumbnail'); 
            }else{
              $thumb= '<img src="'.get_stylesheet_directory_uri().'/dist/images/avatar-placeholder.png'.'" alt=""> ';
            }
  			$display.="<a  class='componente-link' href='".get_post_permalink( $componente->ID )."'><div> ". $thumb ."</div>
  			<div><h3>". get_the_title( )."</h3>
  				 <h4>". get_field('strumento',$componente->ID)."</h4></div></a></li>";
  		
  		wp_reset_postdata();
  	}
  	//for($x=0; $x<4;$x++){
  	//	$display.= '<li class="empty-list"></li>';
  	//}
  	echo '<div class="discs-list">'.$display.'</div>';
  }