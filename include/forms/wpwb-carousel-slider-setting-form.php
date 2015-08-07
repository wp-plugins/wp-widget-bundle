<?php
/**
* @version 1.0.0
* @package WP Widget Bundle
*/
?>

<div class="wpwb_contant">

  <div class="wpwb_contant_header">
    <h2> <span class="glyphicon glyphicon-asterisk"></span>
      <?php _e('Carousel Slider Settings for image widget', 'wp-widget-bundle' )?>
    </h2>
  </div>
  
  <?php
  if( isset($_POST['setting_carousal_restore_submit']) ) {
            
            $wpwb_restore_value_array = array(
                "wpwb_slide_speed"      	=>  1000,
                "wpwb_pagination_speed"    	=>  1000,
				"wpwb_rewind_speed"   		=>  1000,
				"wpwb_auto_play"   			=>  "true",
				"wpwb_stop_on_hover"   		=>  "true",
				"wpwb_navigation"   		=>  "true",
				"wpwb_rewind_navigation"   	=>  "true",
				"wpwb_pagination"   		=>  "true",
				"wpwb_pagination_numbers"   =>  "false",
				"wpwb_mouse_drag"   		=>  "true",
				"wpwb_auto_height"   		=>  "true"
            );

            $wpwb_restore_setting_value = serialize($wpwb_restore_value_array);
            $wpwb_option = "_wpwb_carousel_slider_settings";
            update_option( $wpwb_option, $wpwb_restore_setting_value );

            $message =  __( "Settings restore Successfully.", "wp-widget-bundle");
        }    

        if( isset($_POST["setting_carousal_submit"]) ) {
			
			if( empty($_POST["wpwb_auto_play"]) )
			$_POST["wpwb_auto_play"] = "false";
			else
			$_POST["wpwb_auto_play"] = $_POST["wpwb_auto_play"];
			
			if( empty($_POST["wpwb_stop_on_hover"]) )
			$_POST["wpwb_stop_on_hover"] = "false";
			else
			$_POST["wpwb_stop_on_hover"] = $_POST["wpwb_stop_on_hover"];
			
			if( empty($_POST["wpwb_navigation"]) )
			$_POST["wpwb_navigation"] = "false";
			else
			$_POST["wpwb_navigation"] = $_POST["wpwb_navigation"];
			
			if( empty($_POST["wpwb_rewind_navigation"]) )
			$_POST["wpwb_rewind_navigation"] = "false";
			else
			$_POST["wpwb_rewind_navigation"] = $_POST["wpwb_rewind_navigation"];
			
			if( empty($_POST["wpwb_pagination"]) )
			$_POST["wpwb_pagination"] = "false";
			else
			$_POST["wpwb_pagination"] = $_POST["wpwb_pagination"];
			
			if( empty($_POST["wpwb_pagination_numbers"]) )
			$_POST["wpwb_pagination_numbers"] = "false";
			else
			$_POST["wpwb_pagination_numbers"] = $_POST["wpwb_pagination_numbers"];
			
			if( empty($_POST["wpwb_mouse_drag"]) )
			$_POST["wpwb_mouse_drag"] = "false";
			else
			$_POST["wpwb_mouse_drag"] = $_POST["wpwb_mouse_drag"];
			
			if( empty($_POST["wpwb_auto_height"]) )
			$_POST["wpwb_auto_height"] = "false";
			else
			$_POST["wpwb_auto_height"] = $_POST["wpwb_auto_height"];
			
            $wpwb_value_array = array(
                "wpwb_slide_speed"      	=>  stripslashes($_POST["wpwb_slide_speed"]),
                "wpwb_pagination_speed"    	=>  stripslashes($_POST["wpwb_pagination_speed"]),
				"wpwb_rewind_speed"   		=>  stripslashes($_POST["wpwb_rewind_speed"]),
				"wpwb_auto_play"   			=>  stripslashes($_POST["wpwb_auto_play"]),
				"wpwb_stop_on_hover"   		=>  stripslashes($_POST["wpwb_stop_on_hover"]),
				"wpwb_navigation"   		=>  stripslashes($_POST["wpwb_navigation"]),
				"wpwb_rewind_navigation"   	=>  stripslashes($_POST["wpwb_rewind_navigation"]),
				"wpwb_pagination"   		=>  stripslashes($_POST["wpwb_pagination"]),
				"wpwb_pagination_numbers"   =>  stripslashes($_POST["wpwb_pagination_numbers"]),
				"wpwb_mouse_drag"   		=>  stripslashes($_POST["wpwb_mouse_drag"]),
				"wpwb_auto_height"   		=>  stripslashes($_POST["wpwb_auto_height"])
            );
            
            $wpwb_setting_value = serialize($wpwb_value_array);
            $wpwb_option = "_wpwb_carousel_slider_settings";
            $deprecated = "";
            $autoload = true;
            if( get_option( $wpwb_option ) ) 
            {
                $wpwb_new_value = $wpwb_setting_value;
                update_option( $wpwb_option, $wpwb_new_value );
            } 
            else 
            {
                add_option( $wpwb_option, $wpwb_setting_value, $deprecated, $autoload );   
            } 

            $message =  __( "Settings save Successfully.", "wp-widget-bundle");
        }   

        $options = get_option( '_wpwb_carousel_slider_settings' );
        $options = unserialize($options);
		
        $wpwb_slide_speed = ( $options['wpwb_slide_speed'] != "" ) ? sanitize_text_field( $options['wpwb_slide_speed'] ) : '1000';
        $wpwb_pagination_speed = ( $options['wpwb_pagination_speed'] != "" ) ? sanitize_text_field( $options['wpwb_pagination_speed'] ) : '1000';
		$wpwb_rewind_speed = ( $options['wpwb_rewind_speed'] != "" ) ? sanitize_text_field( $options['wpwb_rewind_speed'] ) : '1000';
		$wpwb_auto_play = ( $options['wpwb_auto_play'] != "" ) ? sanitize_text_field( $options['wpwb_auto_play'] ) : "true";
		$wpwb_stop_on_hover = ( $options['wpwb_stop_on_hover'] != "" ) ? sanitize_text_field( $options['wpwb_stop_on_hover'] ) : "true";
		$wpwb_navigation = ( $options['wpwb_navigation'] != "" ) ? sanitize_text_field( $options['wpwb_navigation'] ) : "true";
		$wpwb_rewind_navigation = ( $options['wpwb_rewind_navigation'] != "" ) ? sanitize_text_field( $options['wpwb_rewind_navigation'] ) : "true";
		$wpwb_pagination = ( $options['wpwb_pagination'] != "" ) ? sanitize_text_field( $options['wpwb_pagination'] ) : "true";
		$wpwb_pagination_numbers = ( $options['wpwb_pagination_numbers'] != "" ) ? sanitize_text_field( $options['wpwb_pagination_numbers'] ) : "false";
		$wpwb_mouse_drag = ( $options['wpwb_mouse_drag'] != "" ) ? sanitize_text_field( $options['wpwb_mouse_drag'] ) : "true";
		$wpwb_auto_height = ( $options['wpwb_auto_height'] != "" ) ? sanitize_text_field( $options['wpwb_auto_height'] ) : "true";
		
  	?>
    
    <?php
	
	if( !empty($message) ) {
		
		echo '<div id="message" class="wpwb_update">';
		echo '<p><strong>';
		echo $message;
		echo '</strong></p>';
		echo '</div>';
	}
	?>

  <form method="post" action="">
    <table class="wpwb-form-table">
      <tbody>
        <tr valign="top">
          <th scope="row"> <label for="wpwb_slide_speed">
              <?php _e( 'Slide Speed', 'wp-widget-bundle'); ?>
            </label>
          </th>
          <td><input type="text" name="wpwb_slide_speed" id="wpwb_slide_speed" class="wpaw-regular-text" value="<?php echo $wpwb_slide_speed; ?>">
            <p class="description">
              <?php _e( 'Please enter here slide speed. { default is 1000 }', 'wp-widget-bundle'); ?>
            </p></td>
        </tr>
        <tr valign="top">
          <th scope="row"> <label for="wpwb_pagination_speed">
              <?php _e( 'Pagination Speed', 'wp-widget-bundle'); ?>
            </label>
          </th>
          <td><input type="text" name="wpwb_pagination_speed" id="wpwb_pagination_speed" class="wpaw-regular-text" value="<?php echo $wpwb_pagination_speed; ?>">
            <p class="description">
              <?php _e( 'Please enter here pagination speed. { default is 1000 }', 'wp-widget-bundle'); ?>
            </p></td>
        </tr>
        <tr valign="top">
          <th scope="row"> <label for="wpwb_rewind_speed">
              <?php _e( 'Rewind Speed', 'wp-widget-bundle'); ?>
            </label>
          </th>
          <td><input type="text" name="wpwb_rewind_speed" id="wpwb_rewind_speed" class="wpaw-regular-text" value="<?php echo $wpwb_rewind_speed; ?>">
            <p class="description">
              <?php _e( 'Please enter here pagination speed. { default is 1000 }', 'wp-widget-bundle'); ?>
            </p></td>
        </tr>
       <tr valign="top">
          <th scope="row"> <label for="wpwb_auto_play">
              <?php _e( 'Auto Play', 'wp-widget-bundle'); ?>
            </label>
          </th>
          <td><p class="description">
              <input type="checkbox" id="wpwb_auto_play" name="wpwb_auto_play" value="true"<?php checked($wpwb_auto_play,'true'); ?> />
              <?php _e( 'Please uncheck to disable auto play animation. { default is true }', 'wp-widget-bundle'); ?>
            </p></td>
        </tr>
        <tr valign="top">
          <th scope="row"> <label for="wpwb_stop_on_hover">
              <?php _e( 'Stop on Hover', 'wp-widget-bundle'); ?>
            </label>
          </th>
          <td><p class="description">
              <input type="checkbox" id="wpwb_stop_on_hover" name="wpwb_stop_on_hover" value="true"<?php checked($wpwb_stop_on_hover,'true'); ?> />
              <?php _e( 'Please uncheck to disable stop on hover animation. { default is true }', 'wp-widget-bundle'); ?>
            </p></td>
        </tr>
        <tr valign="top">
          <th scope="row"> <label for="wpwb_navigation">
              <?php _e( 'Navigation', 'wp-widget-bundle'); ?>
            </label>
          </th>
          <td><p class="description">
              <input type="checkbox" id="wpwb_navigation" name="wpwb_navigation" value="true"<?php checked($wpwb_navigation,'true'); ?> />
              <?php _e( 'Please uncheck to disable navigation. { default is true }', 'wp-widget-bundle'); ?>
            </p></td>
        </tr>
        <tr valign="top">
          <th scope="row"> <label for="wpwb_rewind_navigation">
              <?php _e( 'Rewind Navigation', 'wp-widget-bundle'); ?>
            </label>
          </th>
          <td><p class="description">
              <input type="checkbox" id="wpwb_rewind_navigation" name="wpwb_rewind_navigation" value="true"<?php checked($wpwb_rewind_navigation,'true'); ?> />
              <?php _e( 'Please uncheck to disable rewind navigation. { default is true }', 'wp-widget-bundle'); ?>
            </p></td>
        </tr>
        <tr valign="top">
          <th scope="row"> <label for="wpwb_pagination">
              <?php _e( 'Pagination', 'wp-widget-bundle'); ?>
            </label>
          </th>
          <td><p class="description">
              <input type="checkbox" id="wpwb_pagination" name="wpwb_pagination" value="true"<?php checked($wpwb_pagination,'true'); ?> />
              <?php _e( 'Please uncheck to disable pagination. { default is true }', 'wp-widget-bundle'); ?>
            </p></td>
        </tr>
        <tr valign="top">
          <th scope="row"> <label for="wpwb_pagination_numbers">
              <?php _e( 'Pagination Numbers', 'wp-widget-bundle'); ?>
            </label>
          </th>
          <td><p class="description">
              <input type="checkbox" id="wpwb_pagination_numbers" name="wpwb_pagination_numbers" value="true"<?php checked($wpwb_pagination_numbers,'true'); ?> />
              <?php _e( 'Please check to enable pagination numbers. { default is false }', 'wp-widget-bundle'); ?>
            </p></td>
        </tr>
        <tr valign="top">
          <th scope="row"> <label for="wpwb_mouse_drag">
              <?php _e( 'Mouse Drag', 'wp-widget-bundle'); ?>
            </label>
          </th>
          <td><p class="description">
              <input type="checkbox" id="wpwb_mouse_drag" name="wpwb_mouse_drag" value="true"<?php checked($wpwb_mouse_drag,'true'); ?> />
              <?php _e( 'Please uncheck to disable mouse drag animation. { default is true }', 'wp-widget-bundle'); ?>
            </p></td>
        </tr>
        <tr valign="top">
          <th scope="row"> <label for="wpwb_auto_height">
              <?php _e( 'Auto Height', 'wp-widget-bundle'); ?>
            </label>
          </th>
          <td><p class="description">
              <input type="checkbox" id="wpwb_auto_height" name="wpwb_auto_height" value="true"<?php checked($wpwb_auto_height,'true'); ?> />
              <?php _e( 'Please uncheck to disable auto height. { default is true }', 'wp-widget-bundle'); ?>
            </p></td>
        </tr>
      <tr valign="top">
        <td colspan="2"> 
        <input type="submit" name="setting_carousal_submit" id="submit" class="wpwb-button-primary" value="Save"> 
        <input type="submit" name="setting_carousal_restore_submit" id="submit" class="wpwb-button-primary" value="Restore Default">    
        </td>
      </tr>
      </tbody>
    </table>
  </form>
</div>