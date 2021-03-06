<?php

namespace Roots\Sage\Extras;

use Roots\Sage\Setup;

/**
 * Add <body> classes
 */
function body_class($classes) {
  // Add page slug if it doesn't exist
  if (is_single() || is_page() && !is_front_page()) {
    if (!in_array(basename(get_permalink()), $classes)) {
      $classes[] = basename(get_permalink());
    }
  }

  // Add class if sidebar is active
  if (Setup\display_sidebar()) {
    $classes[] = 'sidebar-primary';
  }

  return $classes;
}
add_filter('body_class', __NAMESPACE__ . '\\body_class');

/**
 * Clean up the_excerpt()
 */
function excerpt_more() {
  return ' &hellip; <a href="' . get_permalink() . '">' . __('Continued', 'sage') . '</a>';
}
add_filter('excerpt_more', __NAMESPACE__ . '\\excerpt_more');

if ( !function_exists( 'wpex_pagination' ) ) {
  
  function wpex_pagination() {
    
    $prev_arrow = is_rtl() ? '&rarr;' : '&larr;';
    $next_arrow = is_rtl() ? '&larr;' : '&rarr;';
    
    global $wp_query;
    $total = $wp_query->max_num_pages;
    $big = 999999999; // need an unlikely integer
    if( $total > 1 )  {
       if( !$current_page = get_query_var('paged') )
         $current_page = 1;
       if( get_option('permalink_structure') ) {
         $format = 'page/%#%/';
       } else {
         $format = '&paged=%#%';
       }
      echo paginate_links(array(
        'base'      => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
        'format'    => $format,
        'current'   => max( 1, get_query_var('paged') ),
        'total'     => $total,
        'mid_size'    => 2,
        'type'      => 'list',
        'prev_text'   => $prev_arrow,
        'next_text'   => $next_arrow,
       ) );
    }
  }
  
}
add_action( 'wp_ajax_gesualdi_disco', __NAMESPACE__ . '\\gesualdi_disco' );
add_action( 'wp_ajax_nopriv_gesualdi_disco', __NAMESPACE__ . '\\gesualdi_disco' );
function gesualdi_disco() {
    if ( ! wp_verify_nonce( $_POST['nonce'], 'gesualdi-nonce' ) ) die ( 'Non autorizzato!');
    ob_clean();
    $post_link=isset( $_POST['postlink'] ) ? sanitize_text_field($_POST['postlink'] ):'';
    if($post_link !== ''){$post_id=url_to_postid($post_link);}else{
      $data=  __( '<p class="error"><strong>ERROR</strong>: No link. </p>', 'sage' );
    wp_send_json_error($data);
    wp_die();
    }
    if($post_id !==0){
      $disco=get_post($post_id );
      setup_postdata($GLOBALS['post'] =& $disco );
      //$title=mb_convert_encoding(get_the_title(), 'UTF-8', 'HTML-ENTITIES');
      $title=html_entity_decode( get_the_title( ), ENT_QUOTES, 'UTF-8' ) ;
               if(has_post_thumbnail($disco)){
              $thumb= get_the_post_thumbnail($disco->ID,'thumbnail'); 
            }else{
              $thumb= '<img src="'.get_stylesheet_directory_uri().'/dist/images/avatar-placeholder.png'.'" alt=""> ';
            }
      
      $strumento=is_null(get_field('strumento',$disco->ID))?'':get_field('strumento',$disco->ID);
      $excerpt=get_the_content( );
      $images = get_field('galleria_componente',$componente->ID);
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
 endif;
      wp_reset_postdata();
      $data= array('title'=>$title,'thumb'=>$thumb,'excerpt'=>wpautop($excerpt,true),'strumento'=>$strumento,'gallery'=>$display2);
        wp_send_json_success( $data );
    }else{
      $data=  __( '<p class="error"><strong>ERROR</strong>: No post with id: </p>', 'sage' ).$post_id ;
    wp_send_json_error($data);
    }
    wp_die();
}

add_action( 'after_setup_theme', __NAMESPACE__ . '\\tgm_envira_define_license_key' );
function tgm_envira_define_license_key() {
    
    // If the key has not already been defined, define it now.
    if ( ! defined( 'ENVIRA_LICENSE_KEY' ) ) {
        define( 'ENVIRA_LICENSE_KEY', 'f21b503f7793be583daab680a7f8bda7' );
    }
    
}


function get_componenti_date(){
      $band=get_posts(array( 
      "post_type"=>"componente",
      "posts_per_page"=>-1
      ));
      $array=array();
      foreach ($band as $key => $componente) {
        setup_postdata($GLOBALS['post'] =& $componente );
        $perma=get_the_permalink($componente->ID);
        $array[$perma]=get_the_modified_date().' '.get_the_modified_time();  
        wp_reset_postdata();        
      }
      return $array;
}

function hide_update_notice_to_all_but_admin_users()
{
    if (!current_user_can('update_core')) {
        remove_action( 'admin_notices', 'update_nag', 3 );
    }
}
add_action( 'admin_head', __NAMESPACE__ . '\\hide_update_notice_to_all_but_admin_users', 1 );