<?php
/**
* @version 1.0.0
* @package WP Widget Bundle
*/

ob_start();
class WPWB_LRW extends WP_Widget {

	private $username;
    private $email;
    private $password;
    private $website;
    private $first_name;
    private $last_name;
    private $nickname;
    private $bio;

	/**
	 * Register widget with WordPress.
	 */
	function __construct() {
		parent::__construct(
			'wp_login_registration', // Base ID
			__( 'WP Login Registration Widget', 'wp-widget-bundle' ), // Name
			array( 'description' => __( 'A widget that displays the login and registration form.', 'wp-widget-bundle' ) ) // Args
		);
	}
	

	/**
	 * Returns the HTML for the login form
	 * @return string
	 */
	static function wpwb_login_form() {
		
		$options = get_option( '_wpwb_login_register_settings' );
        $options = unserialize($options);
        
		$wpwb_lost_password_link = ( $options['wpwb_lost_password_link'] != "" ) ? sanitize_text_field( $options['wpwb_lost_password_link'] ) : "true";
		
		$wpwb_remember_me = ( $options['wpwb_remember_me'] != "" ) ? sanitize_text_field( $options['wpwb_remember_me'] ) : "true";
		
		$wpwb_login_redirect_url = ( $options['wpwb_login_redirect_url'] != "" ) ? sanitize_text_field( $options['wpwb_login_redirect_url'] ) : "";
		
		if ( empty($wpwb_login_redirect_url) ) 
		{
			$login_redirect_url = get_bloginfo('siteurl');
		}
		else
		{
			$login_redirect_url = $wpwb_login_redirect_url;
		}
		
		if ( isset( $_POST['login_submit'] ) ) {
			
			if (empty($_POST['wpwb_login_username'])) {
				$error[] = __('Please enter username.', 'wp-widget-bundle');
			}
			
			if (empty($_POST['wpwb_login_password'])) {
				$error[] = __('Please enter password.', 'wp-widget-bundle');
			}
			
			$creds                  = array();
			$creds['user_login']    = esc_attr( $_POST['wpwb_login_username'] );
			$creds['user_password'] = esc_attr( $_POST['wpwb_login_password'] );
			$creds['remember']      = esc_attr( $_POST['wpwb_remember_login'] );

			$wpwb_login_user = wp_signon( $creds, false );
			
			if ( !empty($error) ) {
			
				echo '<div id="message" class="wpwb_error">';
				echo '<p>';
				
				foreach($error as $err) {
					
					echo $err.'<br />';
				}
				
				echo '</p>';
				echo '</div>';
				
			} 
			else 
			{
				if ( ! is_wp_error( $wpwb_login_user ) ) {
					
					wp_redirect( trim($login_redirect_url) );
				
				} else if ( is_wp_error( $wpwb_login_user ) ) {
					
					echo '<div id="message" class="wpwb_error">';
					echo '<p>';
					echo $wpwb_login_user->get_error_message();
					echo '</p>';
					echo '</div>';
					
				}
			}
		}
		
		?>
		
        <div class="wpwb-login-form">
        
		<form method="post" action="<?php echo esc_url( $_SERVER['REQUEST_URI'] ); ?>">
		
        <div class="wpwb-form-group">
        	
            <input name="wpwb_login_username" type="text" class="wpwb-form-control wpwb-login-field"
                           value="<?php echo(isset($_POST['wpwb_login_username']) ? $_POST['wpwb_login_username'] : null); ?>"
                           placeholder="Username" id="reg-lname"/>
                    <label class="wpwb-login-field-icon fui-user" for="reg-lname"></label>
        </div>
        
        <div class="wpwb-form-group">
		
        	<input name="wpwb_login_password" type="password" class="wpwb-form-control wpwb-login-field"
                           value="<?php echo(isset($_POST['wpwb_login_password']) ? $_POST['wpwb_login_password'] : null); ?>"
                           placeholder="Password" id="reg-pass"/>
                    <label class="wpwb-login-field-icon fui-lock" for="reg-pass"></label>
         </div>
                
        <p class="description">
        
		<?php if( $wpwb_remember_me == "true" ) { ?>
        
		<input type="checkbox" name="wpwb_remember_login" value="true" checked="checked"/> Remember me
        
        <?php } ?>
		
		<?php if( $wpwb_lost_password_link == "true" ) { ?>
			
			<a href="<?php echo wp_lostpassword_url(); ?>" class="wpwb_lost_password"> Lost Password </a>
		
		<?php } ?>
        
        </p>
        
		<input type="submit" name="login_submit" class="wpwb_button_style" value="Login" />
		
        </form>
        
        </div>
		
		<?php
	}

	/**
	 * Register new users
	 */
	static function wpwb_registration_form() {
		
		if ($_POST['wpwb_reg_submit']) {
			
            $wpwb_username = $_POST['wpwb_reg_name'];
            $wpwb_email = $_POST['wpwb_reg_email'];
            $wpwb_password = $_POST['wpwb_reg_password'];
			$wpwb_reg_confirm_password = $_POST['wpwb_reg_confirm_password'];
            $wpwb_website = $_POST['wpwb_reg_website'];
            $wpwb_first_name = $_POST['wpwb_reg_fname'];
            $wpwb_last_name = $_POST['wpwb_reg_lname'];
            $wpwb_nickname = $_POST['wpwb_reg_nickname'];
            $wpwb_bio = $_POST['wpwb_reg_bio'];
 
            if( empty($wpwb_username) ) {
				$error[] = __('Please enter username.', 'wp-widget-bundle');
			}
			
			if( empty($wpwb_email) ) {
				$error[] = __('Please enter email address.', 'wp-widget-bundle');
			} else if( !is_email($wpwb_email) ) {
				$error[] = __('Email address is not valid.', 'wp-widget-bundle');
			} else if( email_exists($wpwb_email) ) {
				$error[] = __('Email address Already in use.', 'wp-widget-bundle');
			}
			
			if( empty($wpwb_password) ) {
				$error[] = __('Please enter password.', 'wp-widget-bundle');
			}
			
			if( empty($wpwb_reg_confirm_password) ) {
				$error[] = __('Please enter confirm password.', 'wp-widget-bundle');
			}
			
			if( $wpwb_password != $wpwb_reg_confirm_password ) {
				$error[] = __('Password and Confirm password do not match.', 'wp-widget-bundle');
			}
	 
			if( !empty($website) ) {
				if (!filter_var($wpwb_website, FILTER_VALIDATE_URL)) {
					$error[] = __('Website is not a valid URL.', 'wp-widget-bundle');
				}
			}
			
			$userdata = array(
				'user_login' => esc_attr($wpwb_username),
				'user_email' => esc_attr($wpwb_email),
				'user_pass' => esc_attr($wpwb_password),
				'user_url' => esc_attr($wpwb_website),
				'first_name' => esc_attr($wpwb_first_name),
				'last_name' => esc_attr($wpwb_last_name),
				'nickname' => esc_attr($wpwb_nickname),
				'description' => esc_attr($wpwb_bio),
			);
			
			if ( !empty($error) ) {
			
				echo '<div id="message" class="wpwb_error">';
				echo '<p>';
				
				foreach($error as $err) {
					
					echo $err.'<br />';
				}
				
				echo '</p>';
				echo '</div>';
				
			} else {
				
				$register_user = wp_insert_user($userdata);
				
				if ( !is_wp_error($register_user) ) {
		 
					echo '<div id="message" class="wpwb_update">';
					echo '<p>';
					echo 'Registration successfully completed. Go to <a href="'.get_bloginfo('siteurl').'/?wpwb-action=login">login page.</a>';
					echo '</p>';
					echo '</div>';
				
				} else {
					echo '<div id="message" class="wpwb_error">';
					echo '<p>';
					echo $register_user->get_error_message();
					echo '</p>';
					echo '</div>';
				}
				
				$_POST = array(); 
			}
        }
		
		$options = get_option( '_wpwb_login_register_settings' );
        $options = unserialize($options);
        
		$wpwb_fname = ( $options['wpwb_fname'] != "" ) ? sanitize_text_field( $options['wpwb_fname'] ) : "true";
		
		$wpwb_lname = ( $options['wpwb_lname'] != "" ) ? sanitize_text_field( $options['wpwb_lname'] ) : "true";
		
		$wpwb_nickname = ( $options['wpwb_nickname'] != "" ) ? sanitize_text_field( $options['wpwb_nickname'] ) : "true";
		
		$wpwb_website = ( $options['wpwb_website'] != "" ) ? sanitize_text_field( $options['wpwb_website'] ) : "true";
		
		$wpwb_about_bio = ( $options['wpwb_about_bio'] != "" ) ? sanitize_text_field( $options['wpwb_about_bio'] ) : "true";
		
		?>
        <div class="wpwb-login-form">
        	
            <form method="post" action="<?php echo esc_url($_SERVER['REQUEST_URI']); ?>">
            	
                <?php if( $wpwb_fname == "true" ) { ?>
                
                <div class="wpwb-form-group">
                    <input name="wpwb_reg_fname" type="text" class="wpwb-form-control wpwb-login-field"
                           value="<?php echo(isset($_POST['wpwb_reg_fname']) ? $_POST['wpwb_reg_fname'] : null); ?>"
                           placeholder="First Name" id="reg-fname"/>
                    <label class="wpwb-login-field-icon fui-user" for="reg-fname"></label>
                </div>
                
                <?php } ?>
 				
                <?php if( $wpwb_lname == "true" ) { ?>
                
                <div class="wpwb-form-group">
                    <input name="wpwb_reg_lname" type="text" class="wpwb-form-control wpwb-login-field"
                           value="<?php echo(isset($_POST['wpwb_reg_lname']) ? $_POST['wpwb_reg_lname'] : null); ?>"
                           placeholder="Last Name" id="reg-lname"/>
                    <label class="wpwb-login-field-icon fui-user" for="reg-lname"></label>
                </div>
                
                <?php } ?>
                
                <div class="wpwb-form-group">
                    <input name="wpwb_reg_name" type="text" class="wpwb-form-control wpwb-login-field"
                           value="<?php echo(isset($_POST['wpwb_reg_name']) ? $_POST['wpwb_reg_name'] : null); ?>"
                           placeholder="Username" id="reg-name"/>
                    <label class="wpwb-login-field-icon fui-user" for="reg-name"></label>
                </div>
 
                <div class="wpwb-form-group">
                    <input name="wpwb_reg_email" type="text" class="wpwb-form-control wpwb-login-field"
                           value="<?php echo(isset($_POST['wpwb_reg_email']) ? $_POST['wpwb_reg_email'] : null); ?>"
                           placeholder="Email Address" id="reg-email"/>
                    <label class="wpwb-login-field-icon fui-mail" for="reg-email"></label>
                </div>
 
                <div class="wpwb-form-group">
                    <input name="wpwb_reg_password" type="password" class="wpwb-form-control wpwb-login-field"
                           value="<?php echo(isset($_POST['wpwb_reg_password']) ? $_POST['wpwb_reg_password'] : null); ?>"
                           placeholder="Password" id="reg-pass"/>
                    <label class="wpwb-login-field-icon fui-lock" for="reg-pass"></label>
                </div>
                
                <div class="wpwb-form-group">
                    <input name="wpwb_reg_confirm_password" type="password" class="wpwb-form-control wpwb-login-field"
                           value="<?php echo(isset($_POST['wpwb_reg_confirm_password']) ? $_POST['wpwb_reg_confirm_password'] : null); ?>"
                           placeholder="Confirm Password" id="reg-pass"/>
                    <label class="wpwb-login-field-icon fui-lock" for="confirm-reg-pass"></label>
                </div>
 				
                <?php if( $wpwb_website == "true" ) { ?>
                
                <div class="wpwb-form-group">
                    <input name="wpwb_reg_website" type="text" class="wpwb-form-control wpwb-login-field"
                           value="<?php echo(isset($_POST['wpwb_reg_website']) ? $_POST['wpwb_reg_website'] : null); ?>"
                           placeholder="Website" id="reg-website"/>
                    <label class="wpwb-login-field-icon fui-chat" for="reg-website"></label>
                </div>
                
                <?php } ?>
 				
                <?php if( $wpwb_nickname == "true" ) { ?>
                
                <div class="wpwb-form-group">
                    <input name="wpwb_reg_nickname" type="text" class="wpwb-form-control wpwb-login-field"
                           value="<?php echo(isset($_POST['wpwb_reg_nickname']) ? $_POST['wpwb_reg_nickname'] : null); ?>"
                           placeholder="Nickname" id="reg-nickname"/>
                    <label class="wpwb-login-field-icon fui-user" for="reg-nickname"></label>
                </div>
                
                <?php } ?>
 				
                <?php if( $wpwb_about_bio == "true" ) { ?>
                
                <div class="wpwb-form-group">
                    <input name="wpwb_reg_bio" type="text" class="wpwb-form-control wpwb-login-field"
                           value="<?php echo(isset($_POST['wpwb_reg_bio']) ? $_POST['wpwb_reg_bio'] : null); ?>"
                           placeholder="About / Bio" id="reg-bio"/>
                    <label class="wpwb-login-field-icon fui-new" for="reg-bio"></label>
                </div>
                
                <?php } ?>
 
                <input class="wpwb_button_style" type="submit" name="wpwb_reg_submit" value="Register"/>
        	
            </form>
        
        </div>
        
        <?php
	}

	public function widget( $args, $instance ) { 
	
		$options = get_option( '_wpwb_login_register_settings' );
        $options = unserialize($options);
       
		$wpwb_register_link = ( $options['wpwb_register_link'] != "" ) ? sanitize_text_field( $options['wpwb_register_link'] ) : "true";
		
		$wpwb_logged_in_show_widget = ( $options['wpwb_logged_in_show_widget'] != "" ) ? sanitize_text_field( $options['wpwb_logged_in_show_widget'] ) : "true";
		
		$wpwb_logged_in_title = ( $options['wpwb_logged_in_title'] != "" ) ? sanitize_text_field( $options['wpwb_logged_in_title'] ) : "Welcome %Username%";
		
		$wpwb_logged_in_user_avatar = ( $options['wpwb_logged_in_user_avatar'] != "" ) ? sanitize_text_field( $options['wpwb_logged_in_user_avatar'] ) : "true";
		
		$wpwb_logout_redirect_url = ( $options['wpwb_logout_redirect_url'] != "" ) ? sanitize_text_field( $options['wpwb_logout_redirect_url'] ) : "";
		
		if ( empty($wpwb_logout_redirect_url) ) 
		{
			$logout_redirect_url = get_bloginfo('siteurl');
		}
		else
		{
			$logout_redirect_url = $wpwb_logout_redirect_url;
		}
		
		if( is_user_logged_in() ) {
			
			$user_id = get_current_user_id();
			$user_data = get_user_by( 'id', $user_id );
			
			if( $wpwb_logged_in_show_widget == "true" ) {
				
				echo '<div class="wpwb_container">';
				
				echo '<div class="wpwb_wiget_title">';
				
				echo '<h1 class="wpwb_title">';
				
				if ( ! empty( $wpwb_logged_in_title ) ) {
					
					$wpwb_place_holders_variables = array(
            			"username"  => stripcslashes($user_data->user_login)
          			);
					
					if($wpwb_place_holders_variables)
				    {  
						foreach($wpwb_place_holders_variables as $wpwb_ph_key => $wpwb_ph_variable)
						{
					
							$wpwb_logged_in_title = str_replace('%'.strtolower($wpwb_ph_key).'%', $wpwb_ph_variable, $wpwb_logged_in_title);
							
							echo $wpwb_logged_in_title;
						}
					}
				} 
				
				echo '</h1>';
				
				echo '</div>';
				
				echo '<div class="wpwb_contant">';
				
				if( $wpwb_logged_in_user_avatar == "true" ) {
					
					echo '<div class="wpwb_user_avatar">';
					
					echo get_avatar( $user_id, apply_filters( 'wpwb_widget_avatar_size', 100) );
					echo '</div>';
				
				}
				
				echo '<div class="wpwb_dpl">';
				echo '<p class="description">';
				echo '<a href="'.admin_url().'">Dashboard</a>';
				echo '</p>';
				echo '<p class="description">';
				echo '<a href="'.admin_url().'profile.php">Profile</a>';
				echo '</p>';
				echo '<p class="description">';
				echo '<a href="'.wp_logout_url( $logout_redirect_url ).'">Logout</a>';
				echo '</p>';
				echo '</div>';
				echo '</div>';
				echo '</div>';
			}
			
			
		}
		
		if( !is_user_logged_in() ) {
			
			$title = apply_filters( 'widget_title', $instance['title'] );
			
			echo '<div class="wpwb_container">';
			
			echo '<div class="wpwb_wiget_title">';
			
			echo '<h1 class="wpwb_title">';
			
			if ( ! empty( $title ) ) {
				
				echo $title;
			} 
			
			echo '</h1>';
			
			echo '</div>';
			
			echo '<div class="wpwb_contant">';
			
			?>
	
            <?php 
			if( $_GET['wpwb-action'] == 'login' || $_GET['wpwb-action'] == '' ) 
			{ 
            	$wpwb_login_selected = 'selected';
			} 
			else if( $_GET['wpwb-action'] == 'register') 
			{ 
				$wpwb_register_selected = 'selected';
			} 
			?>
			
			<div class="wpwb-flip-tabs">
				<ul class="wpwb-flip-navigation">
					<li class="active-tab-login <?php echo $wpwb_login_selected; ?>">
						<a href="<?php echo get_bloginfo('siteurl'); ?>?wpwb-action=login" ><?php _e( 'Login', 'wp-widget-bundle' ); ?></a>
					</li>
                    
                    <?php if( $wpwb_register_link == "true" ) { ?>
                    
					<li class="active-tab-register <?php echo $wpwb_register_selected; ?>">
						<a href="<?php echo get_bloginfo('siteurl'); ?>?wpwb-action=register" ><?php _e( 'Register', 'wp-widget-bundle' ); ?></a>
					</li>
                    
                    <?php } ?>
                    
				</ul>
				<div id="wpwb-flip-container">
                	
					<?php if( $_GET['wpwb-action'] == 'login' || $_GET['wpwb-action'] == '' ) { ?>
                        <div class="wpwb_login_form">
                            <?php echo self::wpwb_login_form(); ?>
                        </div>
                    <?php } ?>
                    
                    <?php 
					
					if( $wpwb_register_link == "true" ) {
						
						if( $_GET['wpwb-action'] == 'register') { 
					?>
                        <div class="wpwb_registration_form">
                            <?php echo self::wpwb_registration_form(); ?>
                        </div>
                    
					<?php 
						}
					}
					?>
                    
				</div>
			</div>
	
			<?php
			
			echo '</div>';
			echo '</div>';
		}
	}

	public function form( $instance ) {
		if ( isset( $instance['title'] ) ) {
			$title = $instance['title'];
		} else {
			$title = __( 'Login & Registration', 'wp-widget-bundle' );
		}
		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>"
			       name="<?php echo $this->get_field_name( 'title' ); ?>" type="text"
			       value="<?php echo esc_attr( $title ); ?>">
		</p>
	<?php
	}

	public function update( $new_instance, $old_instance ) {
		$instance          = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';

		return $instance;
	}

} // class WPWB_LRW