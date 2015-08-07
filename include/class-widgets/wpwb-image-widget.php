<?php
/**
* @version 1.0.0
* @package WP Widget Bundle
*/

class WPWB_IW extends WP_Widget{
	
	public function __construct() {
		parent::__construct(
			'WP_Image_Widget', // Base ID
			__( 'WP Image Widget', 'wp-widget-bundle' ), // Name
			array( 'description' => __( 'A widget that displays the image view.', 'wp-widget-bundle' ) ) // Args
		);
	}
	
	function widget( $args, $instance ) {
		global $wpdb;
		extract($args);
		$wpwb_id = $instance['wpwb_id'];
		
		if($wpwb_id)
		echo $before_title . $instance['wpwb_title'] . $after_title;
		
		echo do_shortcode( '[wpwb_image_widget id='.$wpwb_id.']' );
	}
	
	function update( $new_instance, $old_instance ) {
	
		$instance=$old_instance;
		$instance['wpwb_id']		=	strip_tags($new_instance['wpwb_id']);
		update_option('wpwb_save_image_widget' , $instance);
		return $instance;
	}
	
	function form( $instance ) {
	 global $wpdb;
	 $wpwb_image_widgets = $wpdb->get_results($wpdb->prepare("SELECT * FROM ".TBL_WB." WHERE wpwb_type='image-widget'",NULL));
	 
	?>
<p>
	<label for="<?php echo $this->get_field_id('wpwb_id');?>" style="font-weight:bold;">Select Image Widget : </label> 
	<select id="<?php echo $this->get_field_id('wpwb_id'); ?>" name="<?php echo $this->get_field_name( 'wpwb_id' ); ?>" style="width:80%;">
	<option value="">Select Image Widget</option>
	<?php 
	if($wpwb_image_widgets) {
		foreach($wpwb_image_widgets as $wpwb_image_widget){  ?>
			<option value="<?php echo $wpwb_image_widget->wpwb_id; ?>"<?php selected($wpwb_image_widget->wpwb_id,$instance['wpwb_id']); ?>><?php echo $wpwb_image_widget->wpwb_title; ?></option>
	<?php 
		}
	} 
	?>	
	</select>
</p>   
<?php	
	}
}