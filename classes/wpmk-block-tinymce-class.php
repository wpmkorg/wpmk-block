<?php
/**
 * @package WPMK BLOCK
 * 
 * This class emband shortcode
 * list in wordpress editor.
 * 
 */

if(!class_exists('Shortcode_Tinymce')){

    class Shortcode_Tinymce{
        
        public function __construct(){
            add_action('admin_init', array($this, 'wpmk_block_shortcode_button'));
            add_action('admin_footer', array($this, 'wpmk_block_get_shortcodes'));
        }
    
        public function wpmk_block_shortcode_button(){
            
            if( current_user_can('edit_posts') &&  current_user_can('edit_pages') ){
                add_filter( 'mce_external_plugins', array($this, 'wpmk_block_add_buttons' ));
                add_filter( 'mce_buttons', array($this, 'wpmk_block_register_buttons' ));
            }
        }
    
        public function wpmk_block_add_buttons( $plugin_array ){
            
            $plugin_array['wpmk_block'] = WPMK_BLOCK_ASSETS . 'js/wpmk-block.js';
            return $plugin_array;
        }
    
        public function wpmk_block_register_buttons( $buttons ){
            
            array_push( $buttons, 'separator', 'wpmk_block' );
            return $buttons;
        }
    
        public function wpmk_block_get_shortcodes(){
            
            global $post;
            
            $wpmk_block_args = array( 'post_type' => 'wpmk-block', 'posts_per_page' => -1 );
            $wpmk_loop = new WP_Query( $wpmk_block_args );
            $wpmk_block_id = array();
            while ( $wpmk_loop->have_posts() ) : $wpmk_loop->the_post(); 
            	$wpmk_block_id[] = $post->post_title;
            endwhile;
            
            echo '<script type="text/javascript">
            var shortcodes_button = new Array();';
    
            $count = 0;
    
            foreach($wpmk_block_id as $tag ){
                echo "shortcodes_button[{$count}] = '{$tag}';";
                $count++;
            }
    
            echo '</script>';
            wp_reset_postdata();
        }
    }
    new Shortcode_Tinymce();
}

?>