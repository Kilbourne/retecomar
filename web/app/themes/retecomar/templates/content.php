
<?php $classes='';
if($post->post_type!=='tribe_events' && ! has_post_thumbnail())$classes='nothumb'; ?>
<article <?php post_class($classes); ?>>
<div class="image-wrap"><?php if($post->post_type==='tribe_events' && ! has_post_thumbnail()){
	echo '<img src="'. get_field('events_default_thumbnail','option').'" alt="">';
	}else{the_post_thumbnail();} ?></div><div class="content-wrap">
  <header>
    <h2 class="entry-title"><?php the_title(); ?></h2>
<?php if($post->post_type==='tribe_events'){



tribe_get_template_part( 'modules/meta' );
//tribe_get_template_part( 'modules/address' );


 } else{ get_template_part('templates/entry-meta'); }?>
  </header>
  <div class="entry-summary">
  <?php if($post->post_type==='tribe_events' && $post->post_content != ""){
  	the_content( );
  }else{ 
     the_excerpt();} ?>
  </div>
  </div>
</article>

