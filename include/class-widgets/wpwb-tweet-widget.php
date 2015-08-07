<?php
/**
* @version 1.0.0
* @package WP Widget Bundle
*/

class WPWB_TWT extends WP_Widget{
	
	public function __construct() {
		parent::__construct(
			'WP_Tweet_Widget', // Base ID
			__( 'WP Tweet Widget', 'wp-widget-bundle' ), // Name
			array( 'description' => __( 'A widget that displays the tweets view.', 'wp-widget-bundle' ) ) // Args
		);
	}
	
	function widget( $args, $instance ) {
		global $wpdb;
		extract($args);
		$wpwb_title=$instance['wpwb_title'];
		
		echo do_shortcode( '[wpwb_tweet_widget title="'.$wpwb_title.'"]' );
	}
	
	function update( $new_instance, $old_instance ) {
	
		$instance=$old_instance;
		$instance['wpwb_title']	=	strip_tags($new_instance['wpwb_title']);
		
		update_option('wpwb_save_tweet_widget' , $instance);
		return $instance;
	}
	
	function form( $instance ) {
	?>	
<p>
<label for="<?php echo $this->get_field_id('wpwb_title');?>" style="font-weight:bold;">Title : </label> <br />
<input type="text" name="<?php echo $this->get_field_name( 'wpwb_title' ); ?>" value="<?php echo $instance['wpwb_title']; ?>" style="width:80%;">
</p>	
	<?php
	}
}