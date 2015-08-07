<?php
/**
* @version 1.0.0
* @package WP Widget Bundle
*/
?>

<div class="wpwb_contant">

  <div class="wpwb_contant_header">
    <h2> <span class="glyphicon glyphicon-asterisk"></span>
      <?php _e('User registration form settings', 'wp-widget-bundle')?>
    </h2>
  </div>
  
  	<?php
		
		if( isset($_POST['setting_login_register_restore_submit']) ) {
            
            $wpwb_restore_value_array = array(
			    "wpwb_fname"   		=>  "true",
				"wpwb_lname"   		=>  "true",
				"wpwb_nickname"   	=>  "true",
				"wpwb_website"   	=>  "true",
				"wpwb_about_bio"   	=>  "true",
				"wpwb_lost_password_link"  =>  "true",
				"wpwb_register_link"  =>  "true",
				"wpwb_remember_me"   =>  "true",
				"wpwb_logged_in_show_widget" =>  "true",
				"wpwb_logged_in_title"  =>  "Welcome %username%",
				"wpwb_logged_in_user_avatar"  =>  "true",
				"wpwb_login_redirect_url"  =>  "",
				"wpwb_logout_redirect_url"  =>  ""
            );

            $wpwb_restore_setting_value = serialize($wpwb_restore_value_array);
            $wpwb_option = "_wpwb_login_register_settings";
            update_option( $wpwb_option, $wpwb_restore_setting_value );

            $message =  __( "Settings restore Successfully.", "wpwb_widgets");
        } 
	
        if( isset($_POST["setting_login_register_submit"]) ) {
			
			if( empty($_POST["wpwb_fname"]) )
			$_POST["wpwb_fname"] = "false";
			else
			$_POST["wpwb_fname"] = $_POST["wpwb_fname"];
			
			if( empty($_POST["wpwb_lname"]) )
			$_POST["wpwb_lname"] = "false";
			else
			$_POST["wpwb_lname"] = $_POST["wpwb_lname"];
			
			if( empty($_POST["wpwb_nickname"]) )
			$_POST["wpwb_nickname"] = "false";
			else
			$_POST["wpwb_nickname"] = $_POST["wpwb_nickname"];
			
			if( empty($_POST["wpwb_website"]) )
			$_POST["wpwb_website"] = "false";
			else
			$_POST["wpwb_website"] = $_POST["wpwb_website"];
			
			if( empty($_POST["wpwb_about_bio"]) )
			$_POST["wpwb_about_bio"] = "false";
			else
			$_POST["wpwb_about_bio"] = $_POST["wpwb_about_bio"];
			
			if( empty($_POST["wpwb_lost_password_link"]) )
			$_POST["wpwb_lost_password_link"] = "false";
			else
			$_POST["wpwb_lost_password_link"] = $_POST["wpwb_lost_password_link"];
			
			if( empty($_POST["wpwb_register_link"]) )
			$_POST["wpwb_register_link"] = "false";
			else
			$_POST["wpwb_register_link"] = $_POST["wpwb_register_link"];
			
			if( empty($_POST["wpwb_remember_me"]) )
			$_POST["wpwb_remember_me"] = "false";
			else
			$_POST["wpwb_remember_me"] = $_POST["wpwb_remember_me"];
			
			if( empty($_POST["wpwb_logged_in_show_widget"]) )
			$_POST["wpwb_logged_in_show_widget"] = "false";
			else
			$_POST["wpwb_logged_in_show_widget"] = $_POST["wpwb_logged_in_show_widget"];
			
			if( empty($_POST["wpwb_logged_in_user_avatar"]) )
			$_POST["wpwb_logged_in_user_avatar"] = "false";
			else
			$_POST["wpwb_logged_in_user_avatar"] = $_POST["wpwb_logged_in_user_avatar"];
			
            $wpwb_value_array = array(
				"wpwb_fname"   		=>  stripslashes($_POST["wpwb_fname"]),
				"wpwb_lname"   		=>  stripslashes($_POST["wpwb_lname"]),
				"wpwb_nickname"   	=>  stripslashes($_POST["wpwb_nickname"]),
				"wpwb_website"   	=>  stripslashes($_POST["wpwb_website"]),
				"wpwb_about_bio"   	=>  stripslashes($_POST["wpwb_about_bio"]),
				"wpwb_lost_password_link"  =>  stripslashes($_POST["wpwb_lost_password_link"]),
				"wpwb_register_link"  =>  stripslashes($_POST["wpwb_register_link"]),
				"wpwb_remember_me"   =>  stripslashes($_POST["wpwb_remember_me"]),
				"wpwb_logged_in_show_widget" =>  stripslashes($_POST["wpwb_logged_in_show_widget"]),
				"wpwb_logged_in_title"  =>  stripslashes($_POST["wpwb_logged_in_title"]),
				"wpwb_logged_in_user_avatar"  =>  stripslashes($_POST["wpwb_logged_in_user_avatar"]),
				"wpwb_login_redirect_url"  =>  stripslashes($_POST["wpwb_login_redirect_url"]),
				"wpwb_logout_redirect_url"  =>  stripslashes($_POST["wpwb_logout_redirect_url"])
            );
            
            $wpwb_setting_value = serialize($wpwb_value_array);
            $wpwb_option = "_wpwb_login_register_settings";
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

        $options = get_option( '_wpwb_login_register_settings' );
        $options = unserialize($options);
        
		$wpwb_fname = ( $options['wpwb_fname'] != "" ) ? sanitize_text_field( $options['wpwb_fname'] ) : "true";
		
		$wpwb_lname = ( $options['wpwb_lname'] != "" ) ? sanitize_text_field( $options['wpwb_lname'] ) : "true";
		
		$wpwb_nickname = ( $options['wpwb_nickname'] != "" ) ? sanitize_text_field( $options['wpwb_nickname'] ) : "true";
		
		$wpwb_website = ( $options['wpwb_website'] != "" ) ? sanitize_text_field( $options['wpwb_website'] ) : "true";
		
		$wpwb_about_bio = ( $options['wpwb_about_bio'] != "" ) ? sanitize_text_field( $options['wpwb_about_bio'] ) : "true";
		
		$wpwb_lost_password_link = ( $options['wpwb_lost_password_link'] != "" ) ? sanitize_text_field( $options['wpwb_lost_password_link'] ) : "true";
		
		$wpwb_register_link = ( $options['wpwb_register_link'] != "" ) ? sanitize_text_field( $options['wpwb_register_link'] ) : "true";
		
		$wpwb_remember_me = ( $options['wpwb_remember_me'] != "" ) ? sanitize_text_field( $options['wpwb_remember_me'] ) : "true";
		
		$wpwb_logged_in_show_widget = ( $options['wpwb_logged_in_show_widget'] != "" ) ? sanitize_text_field( $options['wpwb_logged_in_show_widget'] ) : "true";
		
		$wpwb_logged_in_title = ( $options['wpwb_logged_in_title'] != "" ) ? sanitize_text_field( $options['wpwb_logged_in_title'] ) : "Welcome %username%";
		
		$wpwb_logged_in_user_avatar = ( $options['wpwb_logged_in_user_avatar'] != "" ) ? sanitize_text_field( $options['wpwb_logged_in_user_avatar'] ) : "true";
		
		$wpwb_login_redirect_url = ( $options['wpwb_login_redirect_url'] != "" ) ? sanitize_text_field( $options['wpwb_login_redirect_url'] ) : "";
		
		$wpwb_logout_redirect_url = ( $options['wpwb_logout_redirect_url'] != "" ) ? sanitize_text_field( $options['wpwb_logout_redirect_url'] ) : "";
		
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
          <th scope="row"> <label for="wpwb_fname">
              <?php _e( 'First Name', 'wp-widget-bundle' ); ?>
            </label>
          </th>
          <td><p class="description">
              <input type="checkbox" id="wpwb_fname" name="wpwb_fname" value="true"<?php checked($wpwb_fname,'true'); ?> />
              <?php _e( 'Please uncheck to hide { First Name } field.', 'wp-widget-bundle' ); ?>
            </p></td>
        </tr>
        <tr valign="top">
          <th scope="row"> <label for="wpwb_lname">
              <?php _e( 'Last Name', 'wp-widget-bundle' ); ?>
            </label>
          </th>
          <td><p class="description">
              <input type="checkbox" id="wpwb_lname" name="wpwb_lname" value="true"<?php checked($wpwb_lname,'true'); ?> />
              <?php _e( 'Please uncheck to hide { Last Name } field.', 'wp-widget-bundle' ); ?>
            </p></td>
        </tr>
        <tr valign="top">
          <th scope="row"> <label for="wpwb_nickname">
              <?php _e( 'Nick Name', 'wp-widget-bundle' ); ?>
            </label>
          </th>
          <td><p class="description">
              <input type="checkbox" id="wpwb_nickname" name="wpwb_nickname" value="true"<?php checked($wpwb_nickname,'true'); ?> />
              <?php _e( 'Please uncheck to hide { Nick Name } field.', 'wp-widget-bundle' ); ?>
            </p></td>
        </tr>
        <tr valign="top">
          <th scope="row"> <label for="wpwb_website">
              <?php _e( 'Website', 'wp-widget-bundle' ); ?>
            </label>
          </th>
          <td><p class="description">
              <input type="checkbox" id="wpwb_website" name="wpwb_website" value="true"<?php checked($wpwb_website,'true'); ?> />
              <?php _e( 'Please uncheck to hide { Website } field.', 'wp-widget-bundle' ); ?>
            </p></td>
        </tr>
        <tr valign="top">
          <th scope="row"> <label for="wpwb_about_bio">
              <?php _e( 'About / Bio', 'wp-widget-bundle' ); ?>
            </label>
          </th>
          <td><p class="description">
              <input type="checkbox" id="wpwb_about_bio" name="wpwb_about_bio" value="true"<?php checked($wpwb_about_bio,'true'); ?> />
              <?php _e( 'Please uncheck to hide { About / Bio } field.', 'wp-widget-bundle' ); ?>
            </p></td>
        </tr>
      </tbody>
    </table>
    
      <div class="wpwb_contant_header">
        <h2> <span class="glyphicon glyphicon-asterisk"></span>
          <?php _e('User login form settings', 'wp-widget-bundle')?>
        </h2>
      </div>
  
    <table class="wpwb-form-table">
    <tbody>
        <tr valign="top">
          <th scope="row"> <label for="wpwb_lost_password_link">
              <?php _e( 'Lost Password Link', 'wp-widget-bundle' ); ?>
            </label>
          </th>
          <td><p class="description">
              <input type="checkbox" id="wpwb_lost_password_link" name="wpwb_lost_password_link" value="true"<?php checked($wpwb_lost_password_link,'true'); ?> />
              <?php _e( 'Please uncheck to hide { Lost Password } link.', 'wp-widget-bundle' ); ?>
            </p></td>
        </tr>
        <tr valign="top">
          <th scope="row"> <label for="wpwb_register_link">
              <?php _e( 'Register Link', 'wp-widget-bundle' ); ?>
            </label>
          </th>
          <td><p class="description">
              <input type="checkbox" id="wpwb_register_link" name="wpwb_register_link" value="true"<?php checked($wpwb_register_link,'true'); ?> />
              <?php _e( 'Please uncheck to hide { Register } link.', 'wp-widget-bundle' ); ?>
            </p></td>
        </tr>
        <tr valign="top">
          <th scope="row"> <label for="wpwb_remember_me">
              <?php _e( 'Remember ME', 'wp-widget-bundle' ); ?>
            </label>
          </th>
          <td><p class="description">
              <input type="checkbox" id="wpwb_remember_me" name="wpwb_remember_me" value="true"<?php checked($wpwb_remember_me,'true'); ?> />
              <?php _e( 'Please uncheck to hide { Remember ME } field.', 'wp-widget-bundle' ); ?>
            </p></td>
        </tr>
        <tr valign="top">
          <th scope="row"> <label for="wpwb_logged_in_show_widget">
              <?php _e( 'Logged-in Show Widget', 'wp-widget-bundle' ); ?>
            </label>
          </th>
          <td><p class="description">
              <input type="checkbox" id="wpwb_logged_in_show_widget" name="wpwb_logged_in_show_widget" value="true"<?php checked($wpwb_logged_in_show_widget,'true'); ?> />
              <?php _e( 'Please uncheck to hide widget for logged in users.', 'wp-widget-bundle' ); ?>
            </p></td>
        </tr>
        <tr valign="top">
          <th scope="row"> 
          	<label for="wpwb_logged_in_title">
              <?php _e( 'Logged-in Title', 'wp-widget-bundle' ); ?>
            </label>
          </th>
          <td><input type="text" name="wpwb_logged_in_title" id="wpwb_logged_in_title" class="wpaw-regular-text" value="<?php echo $wpwb_logged_in_title; ?>" />
            <p class="description">
              <?php _e( 'Please enter here logged in title. { default is "Welcome %Username%" }', 'wp-widget-bundle' ); ?>
            </p></td>
        </tr>
        <tr valign="top">
          <th scope="row"> <label for="wpwb_logged_in_user_avatar">
              <?php _e( 'Logged-in user avatar', 'wp-widget-bundle' ); ?>
            </label>
          </th>
          <td><p class="description">
              <input type="checkbox" id="wpwb_logged_in_user_avatar" name="wpwb_logged_in_user_avatar" value="true"<?php checked($wpwb_logged_in_user_avatar,'true'); ?> />
              <?php _e( 'Please uncheck to hide { User Avatar }.', 'wp-widget-bundle' ); ?>
            </p></td>
        </tr>
        <tr valign="top">
          <th scope="row"> 
          	<label for="wpwb_login_redirect_url">
              <?php _e( 'Login Redirect URL', 'wp-widget-bundle' ); ?>
            </label>
          </th>
          <td><input type="text" name="wpwb_login_redirect_url" id="wpwb_login_redirect_url" class="wpaw-regular-text" value="<?php echo $wpwb_login_redirect_url; ?>" />
            <p class="description">
              <?php _e( 'Please enter here login redirect URL. { default is Current Page URL }', 'wp-widget-bundle' ); ?>
            </p></td>
        </tr>
        <tr valign="top">
          <th scope="row"> 
          	<label for="wpwb_logout_redirect_url">
              <?php _e( 'Logout Redirect URL', 'wp-widget-bundle' ); ?>
            </label>
          </th>
          <td><input type="text" name="wpwb_logout_redirect_url" id="wpwb_logout_redirect_url" class="wpaw-regular-text" value="<?php echo $wpwb_logout_redirect_url; ?>" />
            <p class="description">
              <?php _e( 'Please enter here logout redirect URL. { default is Current Page URL }', 'wp-widget-bundle' ); ?>
            </p></td>
        </tr>
        <tr valign="top">
            <td colspan="2"> 
            <input type="submit" name="setting_login_register_submit" id="submit" class="wpwb-button-primary" value="Save">
            <input type="submit" name="setting_login_register_restore_submit" id="submit" class="wpwb-button-primary" value="Restore Default"> 
            </td>
        </tr>
      </tbody>
    </table>
  
  </form>
</div>