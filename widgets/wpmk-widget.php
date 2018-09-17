<?php
/**
 * @package WPMK BLOCK
 * 
 * Here We are setting Block Widget
 * 
 */

function wpmk_block_register_widgets() {
	register_widget( 'wpmk_block_widget_class');
}
add_action( 'widgets_init', 'wpmk_block_register_widgets' );

class wpmk_block_widget_class extends WP_Widget {
	
    function __construct() {
		
		parent::__construct(
	            'wpmk_block_widget',
        	    __('WPMK Block Widget', 'wpmk'),
 	           array( 'description' => __( 'Please add your WPMK Block Slug', 'wpmk' ), )
		);
	}


	function widget( $args, $instance ) {
	    
        $title = empty($instance['title']) ? ' ' : apply_filters('widget_title', $instance['title']);
        
		echo $args['before_widget'];
        
        if ( ! empty( $title ) )
            echo $args['before_title'] . $title . $args['after_title'];


		echo do_shortcode( '[wpmk-block slug="' . $instance['wpmk-blockslug'] . '" class="' . $instance['wpmk-blockslug'] . '"]' );
		echo $args['after_widget'];
	}

	function update($new_instance, $old_instance) {
		
        $instance = $old_instance;
        $instance['title'] = $new_instance['title'];
		$instance['wpmk-blockslug'] = strip_tags($new_instance['wpmk-blockslug']);
		return $instance;
	}

	function form($instance) {
	   
        $instance = wp_parse_args( (array) $instance, array( 'title' => '' ) );
        $instance = wp_parse_args( (array) $instance, array( 'wpmk-blockslug' => '' ) );
        $title = $instance['title'];
        $wpmk_blockslug = $instance['wpmk-blockslug'];
		
        ?>
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title', 'wpmk'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
        </p>
		<p>
			<label for="<?php echo $this->get_field_id('wpmk-blockslug'); ?>"><?php _e('Enter Block Slug', 'wpmk'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('wpmk-blockslug'); ?>" name="<?php echo $this->get_field_name('wpmk-blockslug'); ?>" type="text" value="<?php echo $wpmk_blockslug; ?>" />
		</p>
		 
		
		
	<?php }
}

?>