<?php
/**
 * @package WPMK BLOCK
 * 
 * This class has all the configration
 * of Plugin.
 * 
 */
if(!class_exists('WPMK_BLOCK_SETTING_CLASS')){
    
    class WPMK_BLOCK_SETTING_CLASS{
        
        public function __construct() {
            $this->init();
        }
        
        /**
         * 
         *  Here is block init
         * 
         */
        public function init(){
            add_action( 'init', array( $this, 'wpmk_block_load_textdomain' ) );
            add_action( 'init', array( $this, 'wpmk_block_register_post_type' ) );
            add_shortcode( 'wpmk-block', array( $this, 'wpmk_block_shortcode' ) );
            $this->wpmk_block_include_classes();
        }
        
        /**
         * 
         * Here We are setting block text domain
         * 
         */
        function wpmk_block_load_textdomain() {
            load_plugin_textdomain( 'wpmk', false, WPMK_BLOCK_DIR . 'languages' ); 
        }
        
        /**
         * 
         * Here We are setting block post type
         * 
         */
        function wpmk_block_register_post_type(){
            
            $labels = array(
                'name' => __('WPMK Block ( All Blocks List )', 'wpmk'),
                'singular_name' => __('All Blocks', 'wpmk'),
                'add_new' => __('Add New Block', 'wpmk'),
                'add_new_item' => __('WPMK Block - Add New Block', 'wpmk'),
                'edit_item' => __('Edit Block', 'wpmk'),
                'new_item' => __('New Block', 'wpmk'),
                'view_item' => __('View Block', 'wpmk'),
                'search_items' => __('Search Block', 'wpmk'),
                'not_found' => __('No blocks found', 'wpmk'),
                'not_found_in_trash' => __('No blocks found in trash', 'wpmk'),
                'parent_item_colon' => '',
                'menu_name' => __('WPMK Block', 'wpmk')
            );
            $args = array(
                'label' => __('WPMK Block', 'wpmk'),
                'labels' => $labels,
                'public' => true,
                'show_ui' => true,
                'capability_type' => 'post',
                'hierarchical' => true,
                'rewrite' => true,
                'menu_icon' => 'dashicons-welcome-widgets-menus',
                'supports' => array( 'title', 'editor' ),
            );
            
            register_post_type( 'wpmk-block' , $args);
        }
        
        /**
         * 
         * Here We are setting block shortcode
         * 
         */
        public function wpmk_block_shortcode( $atts ){
            
            ob_start();
            extract(shortcode_atts(array(
              'class' => '',
              'slug' => '',
            ), $atts));
            
            global $post;
            $wpmk_block_slug = $slug;
            
            $wpmk_block_args = array( 'post_type' => 'wpmk-block', 'posts_per_page' => -1 );
            $wpmk_loop = new WP_Query( $wpmk_block_args );
            
            while ( $wpmk_loop->have_posts() ) : $wpmk_loop->the_post(); 
                
                if ( $wpmk_block_slug == $post->post_name ) :
                    echo '<div class="wpmk-block-container" id="wpmk-block-container">';
                        echo '<div class="wpmk-block slug-'. $post->post_name .' '. $class .'" id="wpmk-block-id-'. $post->ID .'">';
                            the_content();
                        echo '</div>';
                    echo '</div>';
                endif;
                
            endwhile;
            
            wp_reset_postdata();
            return ob_get_clean();
        
        }
        
        /**
         * 
         * Here We are include classes
         * 1 - Tinymac Editor
         * 2 - Visual Composer
         * 
         */
        public function wpmk_block_include_classes(){
            
            // Include Block Tinymce Class
            include_once( WPMK_BLOCK_DIR . 'classes/wpmk-block-tinymce-class.php' );
            
            // Include Block Visual Composer Class
            if ( class_exists( 'WPBakeryShortCode' ) ) :
                include_once( WPMK_BLOCK_DIR . 'classes/wpmk-block-vc-shortcodes-class.php' );
            endif;
        }
    }
    new WPMK_BLOCK_SETTING_CLASS();
}

?>