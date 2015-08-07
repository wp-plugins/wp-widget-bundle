<?php
/**
* @version 1.0.0
* @package WP Widget Bundle
*/
?>

<div class="wpwb_contant">

  <div class="wpwb_contant_header">
    <h2> <span class="glyphicon glyphicon-asterisk"></span>
      <?php _e('Widgets view settings for frontend', 'wp-widget-bundle')?>
    </h2>
  </div>
  
  <?php
  if( isset($_POST['setting_restore_submit']) ) {
            
            $wpwb_restore_value_array = array(
			    "wpwb_title_font_color"   =>  "#ffffff",
                "wpwb_title_bgcolor"      =>  "#3498DB",
                "wpwb_content_bgcolor"    =>  "#ffffff",
                "wpwb_text_transform"     =>  "uppercase",
                "wpwb_title_font_size"    =>  25      
            );

            $wpwb_restore_setting_value = serialize($wpwb_restore_value_array);
            $wpwb_option = "_wpwb_widgets_settings";
            update_option( $wpwb_option, $wpwb_restore_setting_value );

            $message =  __( "Settings restore Successfully.", "wpwb_widgets");
        }    

        if( isset($_POST["setting_submit"]) ) {

            $wpwb_value_array = array(
			    "wpwb_title_font_color"   =>  $_POST["wpwb_title_font_color"],
                "wpwb_title_bgcolor"      =>  $_POST["wpwb_title_bgcolor"],
                "wpwb_content_bgcolor"    =>  $_POST["wpwb_content_bgcolor"],
                "wpwb_text_transform"     =>  $_POST["wpwb_text_transform"],
                "wpwb_title_font_size"    =>  $_POST["wpwb_title_font_size"]  
            );
            
            $wpwb_setting_value = serialize($wpwb_value_array);
            $wpwb_option = "_wpwb_widgets_settings";
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

            $message =  __( "Settings save Successfully.", "wpwb_widgets");
        }   

        $options = get_option( '_wpwb_widgets_settings' );
        $options = unserialize($options);
		
		$wpwb_title_font_color = ( $options['wpwb_title_font_color'] != "" ) ? sanitize_text_field( $options['wpwb_title_font_color'] ) : '#ffffff';
        $wpwb_title_bgcolor = ( $options['wpwb_title_bgcolor'] != "" ) ? sanitize_text_field( $options['wpwb_title_bgcolor'] ) : '#3498DB';
        $wpwb_content_bgcolor = ( $options['wpwb_content_bgcolor'] != "" ) ? sanitize_text_field( $options['wpwb_content_bgcolor'] ) : '#ffffff';
        $wpwb_text_transform = ( $options['wpwb_text_transform'] != "" ) ? sanitize_text_field( $options['wpwb_text_transform'] ) : 'uppercase';
		$wpwb_title_font_size = ( $options['wpwb_title_font_size'] != "" ) ? sanitize_text_field( $options['wpwb_title_font_size'] ) : '25';

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
          <th scope="row"> <label for="wpwb_title_bgcolor">
              <?php _e( 'Title Font Color', 'wp-widget-bundle' ); ?>
            </label>
          </th>
          <td><input type="text" name="wpwb_title_font_color" id="wpwb_title_font_color" class="wpaw-regular-text wpwb-color-field" value="<?php echo $wpwb_title_font_color; ?>">
            <p class="description">
              <?php _e( 'Please choose title font color. { default is white color }', 'wp-widget-bundle' ); ?>
            </p></td>
        </tr>
        <tr valign="top">
          <th scope="row"> <label for="wpwb_title_bgcolor">
              <?php _e( 'Title Background Color', 'wp-widget-bundle' ); ?>
            </label>
          </th>
          <td><input type="text" name="wpwb_title_bgcolor" id="wpwb_title_bgcolor" class="wpaw-regular-text wpwb-color-field" value="<?php echo $wpwb_title_bgcolor; ?>">
            <p class="description">
              <?php _e( 'Please choose title background color. { default is blue color }', 'wp-widget-bundle' ); ?>
            </p></td>
        </tr>
        <tr valign="top">
          <th scope="row"> <label for="wpwb_content_bgcolor">
              <?php _e( 'Content Background Color', 'wp-widget-bundle' ); ?>
            </label>
          </th>
          <td><input type="text" name="wpwb_content_bgcolor" id="wpwb_content_bgcolor" class="wpaw-regular-text wpwb-color-field" value="<?php echo $wpwb_content_bgcolor; ?>">
            <p class="description">
              <?php _e( 'Please choose content background color. { default is white color }', 'wp-widget-bundle' ); ?>
            </p></td>
        </tr>
        <tr valign="top">
          <th scope="row"> <label for="wpwb_text_transform">
              <?php _e( 'Text Transform', 'wp-widget-bundle' ); ?>
            </label>
          </th>
          <td>
          <select name="wpwb_text_transform" id="wpwb_text_transform">
             
              <option value="none"<?php selected($wpwb_text_transform,"none"); ?>><?php _e( 'none', 'wp-widget-bundle' ); ?></option>
              
              <option value="capitalize"<?php selected($wpwb_text_transform,"capitalize"); ?>><?php _e( 'capitalize', 'wp-widget-bundle' ); ?></option>
              
              <option value="lowercase"<?php selected($wpwb_text_transform,"lowercase"); ?>><?php _e( 'lowercase', 'wp-widget-bundle' ); ?></option>
              
              <option value="uppercase"<?php selected($wpwb_text_transform,"uppercase"); ?>><?php _e( 'uppercase', 'wp-widget-bundle' ); ?></option>
      				
           </select>
                
            <p class="description">
              <?php _e( 'Please select text transform for title. { default is uppercase }', 'wp-widget-bundle' ); ?>
            </p></td>
        </tr>
      <tr valign="top">
        <th scope="row"> <label for="wpwb_title_font_size">
            <?php _e( 'Title Font Size', 'wp-widget-bundle' ); ?>
          </label>
        </th>
        <td><input type="text" name="wpwb_title_font_size" id="wpwb_title_font_size" class="wpaw-regular-text" value="<?php echo $wpwb_title_font_size; ?>">&nbsp;px
          <p class="description">
            <?php _e( 'Please enter here font size for title. { default is 25px }', 'wp-widget-bundle' ); ?>
          </p></td>
      </tr>
      
      <tr valign="top">
        <td colspan="2"> 
        <input type="submit" name="setting_submit" id="submit" class="wpwb-button-primary" value="Save"> 
        <input type="submit" name="setting_restore_submit" id="submit" class="wpwb-button-primary" value="Restore Default">    
        </td>
      </tr>
      </tbody>
    </table>
  </form>
</div>