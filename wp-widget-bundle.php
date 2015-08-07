<?php
/**
 * @package WP Widget Bundle
 * @version 1.0.0
*/

/*
Plugin Name: WP Widget Bundle
Plugin URI: https://github.com/devnathverma/wp-widget-bundle/
Description: A highly customizable widgets that displays the Categories, Posts, Images with slider, Text, Links, Comments on your sidebar.
Author: Devnath verma
Author Email: devnathverma@gmail.com
Version: 1.0.0
Text Domain: wp-widget-bundle
Domain Path: /lang/
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Copyright 2008-2015 Devnath verma (devnathverma@gmail.com)

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License, version 2, as
published by the Free Software Foundation.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

if( !defined('ABSPATH') ) {
	
	die( 'You are not allowed to call this page directly.' );
}

/**
* Let's get started!
*/
if( !class_exists('WP_Widget_Bundle') ) {
	
	class WP_Widget_Bundle {
		
		/**
		* Construct the plugin object
		* @version 1.0.0
		* @package WP Widget Bundle
		*/		 
		public function __construct() {
			
			register_activation_hook( __FILE__, array( $this, '_wpwb_register_activation' ) );
			add_action( 'init', array($this, '_wpwb_init') );
			add_action( 'widgets_init' , array(&$this, '_wpwb_display_widget') );
			$this->_wpwb_define_constants();
		    $this->_wpwb_load_files();		
		}
		
		/**
	    * Register activation for single and multisites
	    * @version 1.0.0
		* @package WP Widget Bundle
	    */
		public function _wpwb_register_activation() {

		  	if ( is_multisite() && $network_wide ) { 

		  		global $wpdb;   
		  		$currentblog = $wpdb->blogid;
		  		$activated = array();
		      	$sql = "SELECT blog_id FROM {$wpdb->blogs}";
		  		$blog_ids = $wpdb->get_col($wpdb->prepare($sql,null)); 

		  		foreach ($blog_ids as $blog_id) {

		  			switch_to_blog($blog_id);
		  			$this->_wpwb_activation();
		  			$activated[] = $blog_id;
		  		}  

		  		switch_to_blog($currentblog);   
		  		update_site_option('wpwb_activated', $activated);

		  	} else { 

		  		$this->_wpwb_activation();
			}		
	  	}
		
	    /**
	    * Define paths
	    * @version 1.0.0
		* @package WP Widget Bundle
	    */
		public function _wpwb_define_constants() {
			
			global $wpdb;

	    	if ( !defined( 'WPWB_VERSION' ) )
				define('WPWB_VERSION', '1.0.0');

			if ( !defined( 'WPWB_FOLDER' ) )
				define('WPWB_FOLDER', basename(dirname(__FILE__)));
			
			if ( !defined( 'WPWB_DIR' ) )
				define('WPWB_DIR', plugin_dir_path(__FILE__));
			
			if ( !defined( 'WPWB_INC' ) )
				define('WPWB_INC', WPWB_DIR.'include'.'/');
				
			if ( !defined( 'WPWB_CLASS' ) )
				define('WPWB_CLASS', WPWB_INC.'classes'.'/');
				
			if ( !defined( 'WPWB_CLASS_WIDGET' ) )
				define('WPWB_CLASS_WIDGET', WPWB_INC.'class-widgets');
				
			if ( !defined( 'WPWB_SHORTCODE' ) )
				define('WPWB_SHORTCODE', WPWB_INC.'shortcodes');		
				
			if ( !defined( 'WPWB_FORMS' ) )
				define('WPWB_FORMS', WPWB_INC.'forms');
				
			if ( !defined( 'WPWB_FUNCTION' ) )
				define('WPWB_FUNCTION', WPWB_INC.'function'.'/');
				
			if ( !defined( 'WPWB_LAYOUT' ) )
				define('WPWB_LAYOUT', WPWB_INC.'layout'.'/');					
			
			if ( !defined( 'WPWB_URL' ) )
				define('WPWB_URL', plugin_dir_url(WPWB_FOLDER).WPWB_FOLDER.'/');
			
			if ( !defined( 'WPWB_CSS' ) )
				define('WPWB_CSS', WPWB_URL.'assets/css'.'/');
			
			if ( !defined( 'WPWB_JS' ) )
				define('WPWB_JS', WPWB_URL.'assets/js'.'/');
			
			if ( !defined( 'WPWB_IMAGES' ) )
				define('WPWB_IMAGES', WPWB_URL.'assets/images'.'/');
			
			if ( !defined( 'WPWB_FONTS' ) )
				define('WPWB_FONTS', WPWB_URL.'assets/fonts'.'/');
			
			if ( !defined( 'WPWB_ICONS' ) )	
				define('WPWB_ICONS', WPWB_URL.'assets/icons'.'/');
			
			if ( !defined( 'TBL_WB' ) )
				define('TBL_WB', $wpdb->prefix.'wb');
		}
		
		/**
	    * Call wordpress actions
	    * @version 1.0.0
		* @package WP Widget Bundle
	    */
		public function _wpwb_init() { 
			
			add_action( 'admin_menu', array(&$this, 'wpwb_widget_menu') );
			add_action( 'admin_print_scripts', array(&$this, 'wpwb_load_admin_js') );
			add_action( 'admin_print_styles', array(&$this, 'wpwb_load_admin_css') );
			add_action( 'wp_head', array(&$this, 'wpwb_load_head_section') );
			add_action( 'wp_enqueue_scripts' , array(&$this, 'wpwb_load_frontend_js_css') );		
			add_action( 'plugins_loaded', array(&$this, 'wpwb_load_languages') );
			add_shortcode( 'wpwb_category_widget', array(&$this, 'wpwb_category_widget') );
			add_shortcode( 'wpwb_post_widget', array(&$this, 'wpwb_post_widget') );
			add_shortcode( 'wpwb_image_widget', array(&$this, 'wpwb_image_widget') );
			add_shortcode( 'wpwb_text_widget', array(&$this, 'wpwb_text_widget') );
			add_shortcode( 'wpwb_link_widget', array(&$this, 'wpwb_link_widget') );
			add_shortcode( 'wpwb_comment_widget', array(&$this, 'wpwb_comment_widget') );
			add_shortcode( 'wpwb_tweet_widget', array(&$this, 'wpwb_tweet_widget') );
		}
		
		/**
	    * Load scripts and css in head sections
	    * @version 1.0.0
		* @package WP Widget Bundle
	    */
		public function wpwb_load_head_section() {
			
			$widgets_settings_options = get_option( '_wpwb_widgets_settings' );
			$widgets_settings_options = unserialize($widgets_settings_options);
			
			$wpwb_title_font_color = ( $widgets_settings_options['wpwb_title_font_color'] != "" ) ? sanitize_text_field( $widgets_settings_options['wpwb_title_font_color'] ) : '#ffffff';
			
			$wpwb_title_bgcolor = ( $widgets_settings_options['wpwb_title_bgcolor'] != "" ) ? sanitize_text_field( $widgets_settings_options['wpwb_title_bgcolor'] ) : '#189AC9';
			
			$wpwb_content_bgcolor = ( $widgets_settings_options['wpwb_content_bgcolor'] != "" ) ? sanitize_text_field( $widgets_settings_options['wpwb_content_bgcolor'] ) : '#ffffff';
			
			$wpwb_text_transform = ( $widgets_settings_options['wpwb_text_transform'] != "" ) ? sanitize_text_field( $widgets_settings_options['wpwb_text_transform'] ) : 'uppercase';
			
			$wpwb_title_font_size = ( $widgets_settings_options['wpwb_title_font_size'] != "" ) ? sanitize_text_field( $widgets_settings_options['wpwb_title_font_size'] ) : '25';
			
			
			$carousel_slider_settings_options = get_option( '_wpwb_carousel_slider_settings' );
			$carousel_slider_settings_options = unserialize($carousel_slider_settings_options);
			
			$wpwb_slide_speed = ( $carousel_slider_settings_options['wpwb_slide_speed'] != "" ) ? sanitize_text_field( $carousel_slider_settings_options['wpwb_slide_speed'] ) : '1000';
			
			$wpwb_pagination_speed = ( $carousel_slider_settings_options['wpwb_pagination_speed'] != "" ) ? sanitize_text_field( $carousel_slider_settings_options['wpwb_pagination_speed'] ) : '1000';
			
			$wpwb_rewind_speed = ( $carousel_slider_settings_options['wpwb_rewind_speed'] != "" ) ? sanitize_text_field( $carousel_slider_settings_options['wpwb_rewind_speed'] ) : '1000';
			
			$wpwb_auto_play = ( $carousel_slider_settings_options['wpwb_auto_play'] != "" ) ? sanitize_text_field( $carousel_slider_settings_options['wpwb_auto_play'] ) : true;
			
			$wpwb_stop_on_hover = ( $carousel_slider_settings_options['wpwb_stop_on_hover'] != "" ) ? sanitize_text_field( $carousel_slider_settings_options['wpwb_stop_on_hover'] ) : true;
			
			$wpwb_navigation = ( $carousel_slider_settings_options['wpwb_navigation'] != "" ) ? sanitize_text_field( $carousel_slider_settings_options['wpwb_navigation'] ) : true;
			
			$wpwb_rewind_navigation = ( $carousel_slider_settings_options['wpwb_rewind_navigation'] != "" ) ? sanitize_text_field( $carousel_slider_settings_options['wpwb_rewind_navigation'] ) : true;
			
			$wpwb_pagination = ( $carousel_slider_settings_options['wpwb_pagination'] != "" ) ? sanitize_text_field( $carousel_slider_settings_options['wpwb_pagination'] ) : true;
			
			$wpwb_pagination_numbers = ( $carousel_slider_settings_options['wpwb_pagination_numbers'] != "" ) ? sanitize_text_field( $carousel_slider_settings_options['wpwb_pagination_numbers'] ) : false;
			
			$wpwb_mouse_drag = ( $carousel_slider_settings_options['wpwb_mouse_drag'] != "" ) ? sanitize_text_field( $carousel_slider_settings_options['wpwb_mouse_drag'] ) : true;
			
			$wpwb_auto_height = ( $carousel_slider_settings_options['wpwb_auto_height'] != "" ) ? sanitize_text_field( $carousel_slider_settings_options['wpwb_auto_height'] ) : true;
		
        	?>
			
			<style type="text/css">
				div.wpwb_container {
					background: <?php echo $wpwb_content_bgcolor; ?>;
				}
				div.wpwb_container div.wpwb_wiget_title, div.wpwb_post_container div.wpwb_wiget_title, div.wpwb_container div.wpwb_contant div.wpwb_login_form input.wpwb_button_style, div.wpwb_container div.wpwb_contant div.wpwb_registration_form input.wpwb_button_style, div.wpwb_container div.wpwb_contant ul.wpwb-flip-navigation li.selected a, div.wpwb_container div.wpwb_contant ul.wpwb-flip-navigation li a:hover {
					background: <?php echo $wpwb_title_bgcolor; ?>;
				}
				div.wpwb_container div.wpwb_contant div.wpwb-login-form label.wpwb-login-field-icon, div.wpwb_post_container div.wpwb_post_contant span.wpwb-field-icon {
					color: <?php echo $wpwb_title_bgcolor; ?>;
				}
				div.wpwb_container div.wpwb_wiget_title h1, div.wpwb_post_container div.wpwb_wiget_title h1 {				
					font-size: <?php echo $wpwb_title_font_size; ?>px;
					text-transform: <?php echo $wpwb_text_transform; ?>;
					color: <?php echo $wpwb_title_font_color; ?>;
				}
            </style>
            
            <script type="text/javascript">
				jQuery(document).ready(function($){
					$(".wpwb-ca-container").WPWB_OWL_CAROUSEL({
						singleItem : true,
						slideSpeed : <?php echo $wpwb_slide_speed; ?>,
						paginationSpeed : <?php echo $wpwb_pagination_speed; ?>,
						rewindSpeed : <?php echo $wpwb_rewind_speed; ?>,
						autoPlay : <?php echo $wpwb_auto_play; ?>,
						stopOnHover : <?php echo $wpwb_stop_on_hover; ?>,
						navigation : <?php echo $wpwb_navigation; ?>,
						rewindNav : <?php echo $wpwb_rewind_navigation; ?>,
						pagination : <?php echo $wpwb_pagination; ?>,
						paginationNumbers: <?php echo $wpwb_pagination_numbers; ?>,
						mouseDrag : <?php echo $wpwb_mouse_drag; ?>,
						autoHeight : <?php echo $wpwb_auto_height; ?>
					});
				});	
            </script>
            
			<?php
		}
		
		/**
	    * Register required widgets
	    * @version 1.0.0
		* @package WP Widget Bundle
	    */
		public function _wpwb_display_widget() {

			register_widget( 'WPWB_CW' );
			register_widget( 'WPWB_PW' );
			register_widget( 'WPWB_IW' );
			register_widget( 'WPWB_TW' );
			register_widget( 'WPWB_LW' );
			register_widget( 'WPWB_CMTW' );
			register_widget( 'WPWB_TWT' );
			register_widget( 'WPWB_LRW' );
		}
		
		/**
	    * Required files includes in plugin
	    * @version 1.0.0
		* @package WP Widget Bundle
	    */
		public function _wpwb_load_files() { 
			
			if( !class_exists( 'WP_List_Table' ) )
			require_once( ABSPATH . 'wp-admin/includes/class-wp-list-table.php' );
			
			require_once( WPWB_CLASS.'class-validation.php' );
			require_once( WPWB_CLASS.'class-database.php' );
			require_once( WPWB_CLASS.'class-base.php' ); 
			require_once( WPWB_CLASS.'class-wb.php' );
		   
			require_once( WPWB_CLASS_WIDGET.'/wpwb-category-widget.php' );
			require_once( WPWB_CLASS_WIDGET.'/wpwb-post-widget.php' );
			require_once( WPWB_CLASS_WIDGET.'/wpwb-image-widget.php' );
			require_once( WPWB_CLASS_WIDGET.'/wpwb-text-widget.php' );
			require_once( WPWB_CLASS_WIDGET.'/wpwb-link-widget.php' );
			require_once( WPWB_CLASS_WIDGET.'/wpwb-comment-widget.php' );
			require_once( WPWB_CLASS_WIDGET.'/wpwb-tweet-widget.php' );
			require_once( WPWB_CLASS_WIDGET.'/wpwb-login-registration-widget.php' );
	  	}
		
		/**
	    * Create table used in plugin
	    * @version 1.0.0
		* @package WP Widget Bundle
	    */
		public function _wpwb_activation() {
			
			global $wpdb;
			require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
				
			$wpwb_widget_bundle = "CREATE TABLE `".$wpdb->prefix."wb` (
									`wpwb_id` int(11) NOT NULL AUTO_INCREMENT,
									`wpwb_title` varchar(255) NOT NULL,
									`wpwb_data` text DEFAULT NULL,
									`wpwb_type` varchar(255) NOT NULL,							
									 PRIMARY KEY (`wpwb_id`)
									) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;";
			dbDelta( $wpwb_widget_bundle );
		}	
        
		/**
	    * Create sidebar menu in admin screen
	    * @version 1.0.0
		* @package WP Widget Bundle
	    */
        public function wpwb_widget_menu() {
			 
			add_menu_page(
				'Widget Bundle', 
				'Widget Bundle', 
				'manage_options', 
				'wp-widget-bundle', 
				array(&$this, 'wpwb_widget_bundle')
			);
		}
		
		/**
	    * Create tabs menu used in plugin
	    * @version 1.0.0
		* @package WP Widget Bundle
	    */
		public function wpwb_widget_bundle() {
			
			$tabs = array( 
				'category-widget' => __( 'Category Widget', 'wp-widget-bundle' ),
				'post-widget' => __( 'Post Widget', 'wp-widget-bundle' ),
				'image-widget'=> __( 'Image Widget', 'wp-widget-bundle' ),
				'text-widget' => __( 'Text Widget', 'wp-widget-bundle' ),
				'link-widget' => __( 'Link Widget', 'wp-widget-bundle' ),
				'comment-widget' => __( 'Comment Widget', 'wp-widget-bundle' ),
				'tweet-widget' => __( 'Tweets Widget', 'wp-widget-bundle' ),
				'manage-widget' => __( 'Manage Widgets', 'wp-widget-bundle' ),
				'login-register-widget' => __( 'Login & Register Widgets', 'wp-widget-bundle' ),
				'widget-view-setting' => __( 'Widget View Settings', 'wp-widget-bundle' ),
				'carousel-slider-setting' => __( 'Carousel Slider Setting', 'wp-widget-bundle' )				
			);
		?>
			<div class="wrap">
            
                <div class="wpwb_container">
                
                    <div class="wpwb_header">
                        <h3>
							<?php _e('WP Widget bundle', 'wp-widget-bundle') ?>
                        </h3>
                    </div> 
                        
                    <div class="wpwb_menu_container">
                        
                        <ul class="wpwb_menu">
                           
						<?php
                        
                        $current_tab = $_GET['tab'] ? $_GET['tab'] : 'category-widget'; 
                        
                        foreach($tabs as $tab => $tab_title ) {
                          
                          	$active_class = '';
                          
                          	if( $current_tab == $tab )
                          
                          	$active_class = 'current';
                         
                          	echo '<li class="wpwb_li '.$active_class.'"><a href="'.admin_url('admin.php?page=wp-widget-bundle&tab='.$tab).'">'.$tab_title.'</a></li>'; 		 
                        
                        }
						
                        ?>
                        
                        </ul>
                        
                     </div> 
                        
                     <?php
						
                      switch( $current_tab ) {
                            
						case 'category-widget'	: $this->_category_widget(); break;	
						case 'post-widget'		: $this->_post_widget();  break;
						case 'image-widget'		: $this->_image_widget();  break;
						case 'text-widget'		: $this->_text_widget();  break;
						case 'link-widget'		: $this->_link_widget();  break;
						case 'comment-widget'	: $this->_comment_widget();  break;
						case 'tweet-widget'		: $this->_tweet_widget();  break;
						case 'manage-widget'	: $this->_manage_widget();  break;
						case 'login-register-widget'	: $this->_login_register_widget();  break;							
						case 'widget-view-setting'	: $this->_wpwb_widget_view_settings();  break;							
						case 'carousel-slider-setting'	: $this->_wpwb_carousel_slider_settings();  break;
						default : $this->_category_widget();
                            
                      }
                      echo '</div>';         
              echo '</div>';
        }
		
		/**
	    * Load js in admin section
	    * @version 1.0.0
		* @package WP Widget Bundle
	    */
		public function wpwb_load_admin_js() {

			 wp_enqueue_script('jquery');
			 wp_enqueue_media();
			 wp_enqueue_script( 'wpwb-media-uploader', plugins_url('assets/js/wpwb-media-uploader.js', __FILE__) );	 		 
			 wp_enqueue_style('media');
		}
		
		/**
	    * Load css in admin section
	    * @version 1.0.0
		* @package WP Widget Bundle
	    */
		public function wpwb_load_admin_css() {
			
			wp_enqueue_style( 'wpwb-admin-css', plugins_url('assets/css/wpwb-admin-css.css', __FILE__) );
		}
		
		/**
	    * Load js and css in frontend section
	    * @version 1.0.0
		* @package WP Widget Bundle
	    */
		public function wpwb_load_frontend_js_css() {
			
			wp_enqueue_script( 'wpwb-owl-carousel', plugins_url('assets/js/wpwb-owl-carousel.js', __FILE__) );
			
			wp_enqueue_style( 'wpwb-frontend-css', plugins_url('assets/css/wpwb-frontend-css.css', __FILE__) );
	
			wp_enqueue_style( 'wpwb-owl-carousel', plugins_url('assets/css/wpwb-owl-carousel.css', __FILE__) );
		}
		
		/**
	    * Load plugin text domain
	    * @version 1.0.0
		* @package WP Widget Bundle
	    */
		public function wpwb_load_languages() {
		 	
			load_plugin_textdomain( 'wp-widget-bundle', false, dirname( plugin_basename( __FILE__ ) ).'/languages/' );
		}
		
		/**
	    * Includes category shortcode file for front view used in plugin
	    * @version 1.0.0
		* @package WP Widget Bundle
	    */
		public function wpwb_category_widget($atts) {
			 
			 ob_start();
			 require_once( WPWB_SHORTCODE.'/wpwb-category-shortcode.php' );
			 $content = ob_get_contents();
	         ob_clean();
	      	 return $content;
		}
		
		/**
	    * Includes posts shortcode file for front view used in plugin
	    * @version 1.0.0
		* @package WP Widget Bundle
	    */
		public function wpwb_post_widget($atts) {
			
			 ob_start();
			 require_once( WPWB_SHORTCODE.'/wpwb-post-shortcode.php' );
			 $content = ob_get_contents();
	         ob_clean();
	      	 return $content;
		}
		
		/**
	    * Includes text shortcode file for front view used in plugin
	    * @version 1.0.0
		* @package WP Widget Bundle
	    */
		public function wpwb_image_widget($atts) {
			
			 ob_start();
			 require_once( WPWB_SHORTCODE.'/wpwb-image-shortcode.php' );
			 $content = ob_get_contents();
	         ob_clean();
	      	 return $content;
		}
		
		/**
	    * Includes text shortcode file for front view used in plugin
	    * @version 1.0.0
		* @package WP Widget Bundle
	    */
		public function wpwb_text_widget($atts) {
			
			 ob_start();
			 require_once( WPWB_SHORTCODE.'/wpwb-text-shortcode.php' );
			 $content = ob_get_contents();
	         ob_clean();
	      	 return $content;
		}
		
		/**
	    * Includes link shortcode file for front view used in plugin
	    * @version 1.0.0
		* @package WP Widget Bundle
	    */
		public function wpwb_link_widget($atts) {
			 
			 ob_start();
			 require_once( WPWB_SHORTCODE.'/wpwb-link-shortcode.php' );
			 $content = ob_get_contents();
	         ob_clean();
	      	 return $content;
		}
		
		/**
	    * Includes comment shortcode file for front view used in plugin
	    * @version 1.0.0
		* @package WP Widget Bundle
	    */
		public function wpwb_comment_widget($atts) {
			 
			 ob_start();
			 require_once( WPWB_SHORTCODE.'/wpwb-comment-shortcode.php' );
			 $content = ob_get_contents();
	         ob_clean();
	      	 return $content;
		}
		
		/**
	    * Includes tweets shortcode file for front view used in plugin
	    * @version 1.0.0
		* @package WP Widget Bundle
	    */
		public function wpwb_tweet_widget($atts) {
			 
			 ob_start();
			 require_once( WPWB_SHORTCODE.'/wpwb-tweet-shortcode.php' );
			 $content = ob_get_contents();
	         ob_clean();
	      	 return $content;
		}
		
		/**
	    * Manages all widgets
	    * @version 1.0.0
		* @package WP Widget Bundle
	    */
		public function _manage_widget() {
				
			global $WB_OBJ; 
	    	
	    	$WB_OBJ->wb_form('manage_widget');	
		}
		
		/**
	    * Includes category widgets form used in plugin
	    * @version 1.0.0
		* @package WP Widget Bundle
	    */
		public function _category_widget() {
			
			global $WB_OBJ; 
	    	
	    	$WB_OBJ->wb_form('create_category_widget');		
		}
		
		/**
	    * Includes posts widgets form used in plugin
	    * @version 1.0.0
		* @package WP Widget Bundle
	    */
		public function _post_widget() {
			
			global $WB_OBJ; 
	    	
	    	$WB_OBJ->wb_form('create_post_widget');	
		}
		
		/**
	    * Includes image widgets form used in plugin
	    * @version 1.0.0
		* @package WP Widget Bundle
	    */
		public function _image_widget() {
			
			global $WB_OBJ; 
	    	
	    	$WB_OBJ->wb_form('create_image_widget');
		}
		
		/**
	    * Includes text widgets form used in plugin
	    * @version 1.0.0
		* @package WP Widget Bundle
	    */
		public function _text_widget() {
			
			global $WB_OBJ; 
	    	
	    	$WB_OBJ->wb_form('create_text_widget');
		}
		
		/**
	    * Includes link widgets form used in plugin
	    * @version 1.0.0
		* @package WP Widget Bundle
	    */
		public function _link_widget() {
			
			global $WB_OBJ; 
	    	
	    	$WB_OBJ->wb_form('create_link_widget');
		}
		
		/**
	    * Includes comment widgets form used in plugin
	    * @version 1.0.0
		* @package WP Widget Bundle
	    */
		public function _comment_widget() {
			
			global $WB_OBJ; 
	    	
	    	$WB_OBJ->wb_form('create_comment_widget');
		}
		
		/**
	    * Includes tweets settings form used in plugin
	    * @version 1.0.0
		* @package WP Widget Bundle
	    */
		public function _tweet_widget() {

			include( WPWB_FORMS . '/wpwb-tweet-form.php');
		}
		
		/**
	    * Includes login and register settings form used in plugin
	    * @version 1.0.0
		* @package WP Widget Bundle
	    */
		public function _login_register_widget() {

			include( WPWB_FORMS . '/wpwb-login-register-form.php');
		}
		
		/**
	    * Includes widget view settings used in plugin
	    * @version 1.0.0
		* @package WP Widget Bundle
	    */
		public function _wpwb_widget_view_settings() {
			
			$this->_wpwb_load_setting_scripts();
			include( WPWB_FORMS . '/wpwb-widget-view-setting-form.php');
		}
		
		/**
	    * Includes slider settings form used in plugin
	    * @version 1.0.0
		* @package WP Widget Bundle
	    */
		public function _wpwb_carousel_slider_settings() {
			
			include( WPWB_FORMS . '/wpwb-carousel-slider-setting-form.php');
		}
		
		/**
	    * Load wordpress color picker
	    * @version 1.0.0
		* @package WP Widget Bundle
	    */
		public function _wpwb_load_setting_scripts() {
			
			if( is_admin() ) { 
            
				//Access the global $wp_version variable to see which version of WordPress is installed.
				global $wp_version;
				
				//If the WordPress version is greater than or equal to 3.5, then load the new WordPress color picker.
				if ( 3.5 <= $wp_version ){
				  //Both the necessary css and javascript have been registered already by WordPress, so all we have to do is load them with their handle.
				  wp_enqueue_style( 'wp-color-picker' );
				  wp_enqueue_script( 'wp-color-picker' );
				}
				//If the WordPress version is less than 3.5 load the older farbtasic color picker.
				else {
				  //As with wp-color-picker the necessary css and javascript have been registered already by WordPress, so all we have to do is load them with their handle.
				  wp_enqueue_style( 'farbtastic' );
				  wp_enqueue_script( 'farbtastic' );
				}
				
				wp_enqueue_script( 'wpwb-function-backend', plugins_url('assets/js/wpwb-function-backend.js', __FILE__) );
			}
		}
		
		/**
		 * Trim a text to a certain number of words, adding a dotdotdot if necessary, and add break to long words.
		 *
		 * @param	string	$text	The text to trim
		 * @param	int		$length	The length you want to trim to
		 * @param	boolean	$chunk Split long words to chunks of this length
		 * @param	boolean	$autop	Automatically add paragraph
		 */
		function wpwb_comment_excerpt($text = '', $length = 50, $chunk = 0, $autop = false) {
			
			if (empty($text))
			return '';
			
			// ensure that no comment has double spaces
			$text = trim($text);
			$text = preg_replace('/\s+/iu', ' ', $text);
			$actual_length = count(explode(' ', $text));
			$dotdotdot = ($actual_length > $length) ? apply_filters('wpwb_dotdotdot', '.....') : '';
			$words = explode(' ', $text, $length + 1);
	
			if (count($words) > $length)
			array_pop($words);
	
			if (!empty($chunk))
			{
				$text = '';
				foreach ($words as $word)
				{
					$tmp = preg_split("//u", $word, -1, PREG_SPLIT_NO_EMPTY);
					if (0 < sizeof($tmp))
					{
						$wl = sizeof($tmp);
						if ($chunk < $wl)
						{
							$text_chunked = array_chunk($tmp, $chunk);
							foreach ($text_chunked as $chunked)
							{
								$text .= implode('', $chunked) . ' ';
							}
						}
						else
							$text .= $word . ' ';
					}
				}
			}
			else
			{
				$text = implode(' ', $words);
			}
			
			$text .= $dotdotdot;
	
			if ($autop == true) $text = wpautop($text);
			
			return trim($text);
		}
		
		/**
	    * Custom content length
		* @param int $charlength Split long words to chunks of this length
	    * @version 1.0.0
		* @package WP Widget Bundle
	    */
		function wpwb_custom_excerpt_max_charlength($charlength) {
			
			$excerpt = get_the_excerpt();
			$charlength++;
		
			if ( mb_strlen( $excerpt ) > $charlength ) {
				$subex = mb_substr( $excerpt, 0, $charlength - 5 );
				$exwords = explode( ' ', $subex );
				$excut = - ( mb_strlen( $exwords[ count( $exwords ) - 1 ] ) );
				if ( $excut < 0 ) {
					echo mb_substr( $subex, 0, $excut );
				} else {
					echo $subex;
				}
				echo '...';
			} else {
				echo $excerpt;
			}
		}
		
    } // END class WP_Widget_Bundle
} // END if( !class_exists('WP_Widget_Bundle') )

/**
* Initialize WP_Widget_Bundle class
*/
if( class_exists('WP_Widget_Bundle') ) {
	 
	$wpwb_widget_bundle = new WP_Widget_Bundle();
}