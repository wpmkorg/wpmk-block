<?php
/**
 * @package WPMK BLOCK
 * 
 * This class emband shortcode
 * in visual composer editor.
 * 
 */
if(!class_exists('WPMK_BLOCK_VC_SHORTCODE')){
    
    class  WPMK_BLOCK_VC_SHORTCODE{
        
        public function __construct() {
            add_action( 'vc_before_init', array( $this, 'wpmk_block_vc_shortcode' ) );
        }
        
        /**
         * 
         * It will show you list of post title
         * that is will be use as list in
         * visual composer shortcode
         * 
         */
         public function wpmk_block_get_block_title(){
            
            global $post;
        
            $wpmk_block_args = array( 'post_type' => 'wpmk-block', 'posts_per_page' => -1 );
            $wpmk_loop = new WP_Query( $wpmk_block_args );
            $wpmk_block_id[] = 'Select Your Block';
            while ( $wpmk_loop->have_posts() ) : $wpmk_loop->the_post(); 
            	$wpmk_block_id[] = $post->post_name;
            endwhile;
            
            return $wpmk_block_id;  
            
            wp_reset_postdata();
         }
         
         /**
         * 
         * It will show you shortcode in
         * visual composer shortcode list
         * 
         */
         public function wpmk_block_vc_shortcode(){
            
            vc_map( array(
              "name" => __( "WPMK Block", "wpmk" ),
              "base" => "wpmk-block",
              "class" => "wpmk-block",
              "category" => __( "WPMKORG", "wpmk"),
              "icon" => "icon-wpb-application-icon-large",
              "description" => __( "Click here to add block", "wpmk" ),
              "params" => array(
                 array(
                    "type" => "dropdown",
                    "holder" => "div",
                    "class" => "",
                    "heading" => __( "Please Select Your Block Slug", "wpmk" ),
                    "param_name" => "slug",
                    "value" => $this->wpmk_block_get_block_title(),
                    "description" => __( "Please Select Block above select box.", "wpmk" )
                 ),
                 array(
                    "type" => "textfield",
                    "holder" => "div",
                    "class" => "",
                    "heading" => __( "Extra class name", "wpmk" ),
                    "param_name" => "class",
                    "value" => __( "", "wpmk" ),
                    "description" => __( "If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "wpmk" )
                 )
              )
           ));
         }
         
    }
    new WPMK_BLOCK_VC_SHORTCODE();
}
?>