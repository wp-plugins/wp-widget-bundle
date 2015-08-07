<?php
/**
* @version 1.0.0
* @package WP Widget Bundle
*/
?>

<div class="wpwb_contant">
    <div class="wpwb_contant_header">
        <h2> <span class="glyphicon glyphicon-asterisk"></span>
          	<?php _e('Tweet Widget Settings', 'wp-widget-bundle')?>
        </h2>
    </div>
  
  	<?php
        
	if( isset($_POST["tweet_submit"]) ) {
		
		if( empty($_POST["wpwb_consumer_key"]) ) {
			$error[] = __('Please enter consumer key.', 'wp-widget-bundle');
		}
		
		if( empty($_POST["wpwb_consumer_secret"]) ) {
			$error[] = __('Please enter consumer secret key.', 'wp-widget-bundle');
		} 
		
		if( empty($_POST["wpwb_access_token"]) ) {
			$error[] = __('Please enter access token.', 'wp-widget-bundle');
		}
		
		if( empty($_POST["wpwb_access_token_secret"]) ) {
			$error[] = __('Please enter access token secret.', 'wp-widget-bundle');
		}
		
		if( empty($_POST["wpwb_screen_name"]) ) {
			$error[] = __('Please enter screen name.', 'wp-widget-bundle');
		}
		
		if ( empty($error) ) {
			
			$wpwb_value_array = array(
				"wpwb_consumer_key"   =>  stripslashes($_POST["wpwb_consumer_key"]),
				"wpwb_consumer_secret"=>  stripslashes($_POST["wpwb_consumer_secret"]),
				"wpwb_access_token" =>  stripslashes($_POST["wpwb_access_token"]),
				"wpwb_access_token_secret" =>  stripslashes($_POST["wpwb_access_token_secret"]),
				"wpwb_screen_name" =>  stripslashes($_POST["wpwb_screen_name"]),
				"wpwb_display_tweet" =>  stripslashes($_POST["wpwb_display_tweet"]),
				"wpwb_include_rts" =>  stripslashes($_POST["wpwb_include_rts"]),
				"wpwb_exclude_replies" =>  stripslashes($_POST["wpwb_exclude_replies"]),
				"wpwb_pagination_numbers" =>  stripslashes($_POST["wpwb_pagination_numbers"]),
				"wpwb_mouse_drag"  =>  stripslashes($_POST["wpwb_mouse_drag"]),
				"wpwb_auto_height" =>  stripslashes($_POST["wpwb_auto_height"])
			);
			
			$wpwb_setting_value = serialize($wpwb_value_array);
			$wpwb_option = "_wpwb_tweets_settings";
			$deprecated = "";
			$autoload = true;
			if( get_option( $wpwb_option ) ) {
				
				$wpwb_new_value = $wpwb_setting_value;
				update_option( $wpwb_option, $wpwb_new_value );
			} 
			else 
			{
				add_option( $wpwb_option, $wpwb_setting_value, $deprecated, $autoload );   
			}
			
			$message =  __( "Settings save Successfully.", "wp-widget-bundle");
			
			if( !empty($message) ) {
	
				echo '<div id="message" class="wpwb_update">';
				echo '<p><strong>';
				echo $message;
				echo '</strong></p>';
				echo '</div>';
			}
		}
		else
		{
			echo '<div id="message" class="wpwb_error">';
			echo '<p>';
			
			foreach($error as $err) {
				
				echo $err.'<br />';
			}
			
			echo '</p>';
			echo '</div>';
		}
	}   

	$options = get_option( '_wpwb_tweets_settings' );
	$options = unserialize($options);
	
	$wpwb_consumer_key = ( $options['wpwb_consumer_key'] != "" ) ? sanitize_text_field( $options['wpwb_consumer_key'] ) : '';
	
	$wpwb_consumer_secret = ( $options['wpwb_consumer_secret'] != "" ) ? sanitize_text_field( $options['wpwb_consumer_secret'] ) : '';
	
	$wpwb_access_token = ( $options['wpwb_access_token'] != "" ) ? sanitize_text_field( $options['wpwb_access_token'] ) : '';
	
	$wpwb_access_token_secret = ( $options['wpwb_access_token_secret'] != "" ) ? sanitize_text_field( $options['wpwb_access_token_secret'] ) : "";
	
	$wpwb_screen_name = ( $options['wpwb_screen_name'] != "" ) ? sanitize_text_field( $options['wpwb_screen_name'] ) : "";
	
	$wpwb_display_tweet = ( $options['wpwb_display_tweet'] != "" ) ? sanitize_text_field( $options['wpwb_display_tweet'] ) : "";
	
	$wpwb_include_rts = ( $options['wpwb_include_rts'] != "" ) ? sanitize_text_field( $options['wpwb_include_rts'] ) : "";
	
	$wpwb_exclude_replies = ( $options['wpwb_exclude_replies'] != "" ) ? sanitize_text_field( $options['wpwb_exclude_replies'] ) : "";
		
  ?>
  
  <form method="post" action="">
    <table class="wpwb-form-table">
      <tbody>
        <tr valign="top">
          <th scope="row"> <label for="wpwb_consumer_key">
              <?php _e( 'Consumer Key', 'wp-widget-bundle' ); ?>&nbsp;<span style="color:#F00;">*</span>
            </label>
          </th>
          <td><input type="text" name="wpwb_consumer_key" id="wpwb_consumer_key" class="wpaw-regular-text" value="<?php echo $wpwb_consumer_key; ?>">
            <p class="description">
              <?php _e( 'Enter your Consumer Key.', 'wp-widget-bundle' ); ?>
            </p></td>
        </tr>
        <tr valign="top">
          <th scope="row"> <label for="wpwb_consumer_secret">
              <?php _e( 'Consumer Secret', 'wp-widget-bundle' ); ?>&nbsp;<span style="color:#F00;">*</span>
            </label>
          </th>
          <td><input type="password" name="wpwb_consumer_secret" id="wpwb_consumer_secret" class="wpaw-regular-text" value="<?php echo $wpwb_consumer_secret; ?>">
            <p class="description">
              <?php _e( 'Enter your Consumer Secret. Keep this private, do not share it.', 'wp-widget-bundle' ); ?>
            </p></td>
        </tr>
        <tr valign="top">
          <th scope="row"> <label for="wpwb_access_token">
              <?php _e( 'Access Token', 'wp-widget-bundle' ); ?>&nbsp;<span style="color:#F00;">*</span>
            </label>
          </th>
          <td><input type="text" name="wpwb_access_token" id="wpwb_access_token" class="wpaw-regular-text" value="<?php echo $wpwb_access_token; ?>">
            <p class="description">
              <?php _e( 'Enter your Access Token.', 'wp-widget-bundle' ); ?>
            </p></td>
        </tr>
      <tr valign="top">
        <th scope="row"> <label for="wpwb_access_token_secret">
            <?php _e( 'Access Token Secret', 'wp-widget-bundle' ); ?>&nbsp;<span style="color:#F00;">*</span>
          </label>
        </th>
        <td><input type="password" name="wpwb_access_token_secret" id="wpwb_access_token_secret" class="wpaw-regular-text" value="<?php echo $wpwb_access_token_secret; ?>">
          <p class="description">
            <?php _e( 'Enter your Access Token Secret. Keep this private also, do not share it.', 'wp-widget-bundle' ); ?>
          </p></td>
      </tr>
      <tr valign="top">
        <th scope="row"> <label for="wpwb_screen_name">
            <?php _e( 'Screen Name', 'wp-widget-bundle' ); ?>&nbsp;<span style="color:#F00;">*</span>
          </label>
        </th>
        <td><input type="text" name="wpwb_screen_name" id="wpwb_screen_name" class="wpaw-regular-text" value="<?php echo $wpwb_screen_name; ?>">
          <p class="description">
            <?php _e( 'The screen name of the user for whom to return results for.', 'wp-widget-bundle' ); ?>
          </p></td>
      </tr>
      <tr valign="top">
        <th scope="row"> <label for="wpwb_display_tweet">
            <?php _e( 'No of Display Tweets', 'wp-widget-bundle' ); ?>
          </label>
        </th>
        <td><input type="text" name="wpwb_display_tweet" class="wpaw-regular-text" id="wpwb_display_tweet" value="<?php echo $wpwb_display_tweet; ?>">
          <p class="description">
            <?php _e( 'No of display tweets.', 'wp-widget-bundle' ); ?>
          </p></td>
      </tr>
      <tr valign="top">
        <th scope="row"> <label for="wpwb_include_rts">
            <?php _e( 'Include Retweets', 'wp-widget-bundle' ); ?>
          </label>
        </th>
        <td><input type="radio" name="wpwb_include_rts" id="include_rts_false" value="true" <?php checked( $wpwb_include_rts, 'true' ); ?>>
          &nbsp;
          <?php _e( 'Yes', 'wp-widget-bundle' ); ?>
          &nbsp;&nbsp;&nbsp;
          <input type="radio" name="wpwb_include_rts" id="include_rts_false" value="false" <?php checked( $wpwb_include_rts, 'false' ); ?>>
          &nbsp;
          <?php _e( 'No', 'wp-widget-bundle' ); ?>
          <p class="description">
            <?php _e( 'When set to "No", the timeline will not show any retweets.', 'wp-widget-bundle' ); ?>
          </p></td>
      </tr>
      <tr valign="top">
        <th scope="row"> <label for="wpwb_exclude_replies">
            <?php _e( 'Exclude Replies', 'wp-widget-bundle' ); ?>
          </label>
        </th>
        <td><input type="radio" name="wpwb_exclude_replies" id="exclude_replies_true" value="true" <?php checked( $wpwb_exclude_replies, 'true' ); ?>>
          &nbsp;
          <?php _e( 'Yes', 'wp-widget-bundle' ); ?>
          &nbsp;&nbsp;&nbsp;
          <input type="radio" name="wpwb_exclude_replies" id="exclude_replies_false" value="false" <?php checked( $wpwb_exclude_replies, 'false' ); ?>>
          &nbsp;
          <?php _e( 'No', 'wp-widget-bundle' ); ?>
          <p class="description">
            <?php _e( 'This parameter will prevent replies from appearing in the returned timeline. Setting this to "No" will mean you will receive up-to count tweets - this is because the count parameter retrieves that many tweets before filtering out retweets and replies.', 'wp-widget-bundle' ); ?>
          </p></td>
      </tr>
      <tr valign="top">
        <th scope="row"> <input type="submit" name="tweet_submit" id="submit" class="wpwb-button-primary" value="Save">
        </th>
      </tr>
      </tbody>
    </table>
  </form>
</div>