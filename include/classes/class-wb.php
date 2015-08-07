<?php
/**
* Class : WPWB_WB
* @version 1.0.0
* @package WP Widget Bundle
*/

if ( !class_exists( 'WPWB_WB' ) ) {

	class WPWB_WB extends WPWB_Plugin_Base {

		public $wpwb_id = '';
		public $wpwb_title;	
		public $wpwb_data;		
		public $wpwb_type;		
			
		public $valiations = array(	
			'wpwb_title' => array('req' => 'Please enter here title.')	
		);
		
		function WPWB_WB() {

			$this->table = TBL_WB;
			$this->unique = 'wpwb_id';
		}
		
		function load($load_id) {

			$object = $this->Get($this->table,array(array("wpwb_id","=",$load_id)));
			
			if(isset($object)) {

				$this->fill($object[0]);	
			}
		}
		
		function fill($row) {

			$all_properties = get_object_vars($this);
			
			if(is_array($all_properties)) {

				foreach($all_properties as $name => $value) {
									
					if( !empty($row->{$name}) ) {
					
						$this->setVal($name, $row->{$name});
					}		
				}
			}
		}
		
		function Save() {

			if(is_array($this->errors) and !empty($this->errors))
			return false;
			
			$connection = WPWB_Database::Connect();
			$rows = 0;
			
			if ( $this->{$this->unique} != '' ){
				$this->query = $connection->prepare("SELECT $this->unique FROM $this->table WHERE $this->unique='%d' LIMIT 1",$this->{$this->unique});
				$rows = WPWB_Database::Query($this->query, $connection);
			}
			
			$data['wpwb_title'] = $this->String($this->wpwb_title);
			$data['wpwb_data'] = $this->Escape($this->wpwb_data);
			$data['wpwb_type'] = $this->String($this->wpwb_type);
			
			if ($rows > 0 )
			{
				$where[$this->unique]=$this->Escape($this->{$this->unique});
			}
			else
			{
				$where = '';
			}
		
			$insertId = WPWB_Database::InsertOrUpdate($this->table,$data,$where);
			
			if ($this->{$this->unique} == "")
			{
				$this->{$this->unique} = $insertId;
			}
			return $this->{$this->unique};
		}
		
		function Delete() {

			$connection = WPWB_Database::Connect();
			$this->query = $connection->prepare("DELETE FROM $this->table WHERE $this->unique='%d'",$this->{$this->unique});
			return WPWB_Database::NonQuery($this->query, $connection);
		}
		
		
		public function wb_form($view) {  

			$response = $this->do_action();
			
			switch($view) {
			  
			  	case 'create_category_widget' : $view = "wpwb-category-form.php";
									    		include( WPWB_FORMS . '/'.$view );				
			  				 		    		break;
												
				case 'create_post_widget' : $view = "wpwb-post-form.php";
									    	include( WPWB_FORMS . '/'.$view );				
			  				 		    	break;
				
				case 'create_image_widget' : $view = "wpwb-image-form.php";
									    	 include( WPWB_FORMS . '/'.$view );				
			  				 		    	 break;

				case 'create_text_widget' : $view = "wpwb-text-form.php";
									    	include( WPWB_FORMS . '/'.$view );				
			  				 		    	break;

				case 'create_link_widget' : $view = "wpwb-link-form.php";
									    	include( WPWB_FORMS . '/'.$view );				
			  				 		    	break;
												
				case 'create_comment_widget' : $view = "wpwb-comment-form.php";
									    	   include( WPWB_FORMS . '/'.$view );				
			  				 		    	   break;								
								

			  	case 'edit_category_widget' : $this->Get(array(array('wpwb_id','=',$this->wpwb_id)));
											  $view = "wpwb-category-form.php"; 
											  include( WPWB_FORMS . '/'.$view );				
											  break;
										
				case 'edit_post_widget' : $this->Get(array(array('wpwb_id','=',$this->wpwb_id)));
										  $view = "wpwb-post-form.php"; 
										  include( WPWB_FORMS . '/'.$view );				
										  break;
										
				case 'edit_image_widget' : $this->Get(array(array('wpwb_id','=',$this->wpwb_id)));
			  				               $view = "wpwb-image-form.php"; 
			  				               include( WPWB_FORMS . '/'.$view );				
			  				 		       break;
										
			     case 'edit_text_widget' : $this->Get(array(array('wpwb_id','=',$this->wpwb_id)));
			  				               $view = "wpwb-text-form.php"; 
			  				               include( WPWB_FORMS . '/'.$view );				
			  				 		       break;
										
				case 'edit_link_widget' : $this->Get(array(array('wpwb_id','=',$this->wpwb_id)));
			  				              $view = "wpwb-link-form.php"; 
			  				              include( WPWB_FORMS . '/'.$view );				
			  				 		      break;	
										
				case 'edit_comment_widget' : $this->Get(array(array('wpwb_id','=',$this->wpwb_id)));
											 $view = "wpwb-comment-form.php";
									    	 include( WPWB_FORMS . '/'.$view );				
			  				 		    	 break;																																		

			  	case 'manage_widget' : $view = "wpwb-manage-widgets.php"; 									
									   include( WPWB_FORMS . '/'.$view );
			  					       break;			 
			}
		}
		 
		protected function do_action() {

			global $_POST, $WB_OBJ;
			 
			if( isset($_POST['submit']) ) {
				
				if(isset($_GET['action']) and $_GET['action']=="edit")
				$this->wpwb_id = $_GET['wpwb_id'];
				
				$WB_OBJ->setVal('wpwb_title',htmlspecialchars(stripslashes($_POST['wpwb_title'])));
				$WB_OBJ->setVal('wpwb_data',serialize($_POST['wpwb_data']));
				
				$WB_OBJ->setVal('wpwb_type',htmlspecialchars(stripslashes($_POST['wpwb_type'])));				
				if($WB_OBJ->save()>0)
				{	
					if( isset($_GET['action']) and $_GET['action']=="edit" ) {
						
						$response["success"]  =__( 'Widget Updated Successfully.', 'wp-widget-bundle' );	
					}
					else
					{
						$response["success"]  = __( 'Widget Created successfully.', 'wp-widget-bundle' );
					}
					
					$_POST = array();		
				}
				else
				{
					$response["error"] = $this->display_errors();
				}
				
				return $response;	
			}	 
		}	
	}
}

function _wpwb_wb_init() {
  	
  	global $WB_OBJ;
  	$WB_OBJ = new WPWB_WB();
}

add_action('plugins_loaded', '_wpwb_wb_init');