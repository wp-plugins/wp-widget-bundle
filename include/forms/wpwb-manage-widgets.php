<?php
/**
* Class : WPWB_Manage_Widgets
* @version 1.0.0
* @package WP Widget Bundle
*/

class WPWB_Manage_Widgets extends WP_List_Table {
    
	var $wpwb_widget_data;
	var $found_data;
	
	function __construct() {
		
		global $status, $page, $wpdb;
		
		parent::__construct( array(
				'singular'  => 'widget-bundle',    
				'plural'    => 'widget-bundles',  
				'ajax'      => false       
		) );
		
		if( $_GET['page']=='wp-widget-bundle' && !empty($_POST['s']) )
		{
			$query = "SELECT * FROM ".TBL_WB." WHERE wpwb_title LIKE '%".$_POST['s']."%' OR wpwb_type LIKE '%".$_POST['s']."%'";
		}
		else
		{
			$query = "SELECT * FROM ".TBL_WB."";
		}
			
		$this->wpwb_widget_data = $wpdb->get_results($query, ARRAY_A);
		add_action( 'admin_head', array( &$this, 'admin_header' ) );            
	}
	
	function admin_header() {
		
		$page = ( isset($_GET['page'] ) ) ? esc_attr( $_GET['page'] ) : false;
		if( 'location' != $page )
		return;
		echo '<style type="text/css">';
		echo '.wp-list-table .column-wpwb_title  { width: 20%; }';
		echo '.wp-list-table .column-wpwb_date_time  { width: 20%;}';
		echo '</style>';
	}
	  
	function no_items() {
		
		echo 'No records founds in database.';
	}
		
	function column_default( $item, $column_name ) {
		
		switch( $column_name ) {
			case 'wpwb_title': 
			case 'wpwb_type':
			default:
			return $item[$column_name] ; //Show the whole array for troubleshooting purposes
		}
	}
	  
	function custom_column_value($column_name,$item) {
		
		if($column_name=='post_title ')
		return "<a href='".get_permalink( $item[ 'post_id' ] )."'>".$item[ $column_name ]."</a>";
		elseif($column_name=='user_login')
		return "<a href='".get_author_posts_url($item[ 'user_id' ])."'>".$item[ $column_name ]."</a>";
		else
		return $item[ $column_name ];
	}
	
	function get_sortable_columns() {
		
		$sortable_columns = array(
		'wpwb_title'   			=> array('wpwb_title',false),
		'wpwb_type'   			=> array('wpwb_type',false)
		);
		return $sortable_columns;
	}
	
	function get_columns() {
		
		$columns = array(
		'cb'        				=> '<input type="checkbox" />',
		'wpwb_title'  			=> 'Widget Title',
		'wpwb_type'  			=> 'Widget Type'
		);
		return $columns;
	}
	
	function usort_reorder( $a, $b ) { 
	 
		$orderby = ( ! empty( $_GET['orderby'] ) ) ? $_GET['orderby'] : '';
		$order = ( ! empty($_GET['order'] ) ) ? $_GET['order'] : 'asc';
		$result = strcmp( $a[$orderby], $b[$orderby] );
		return ( $order === 'asc' ) ? $result : -$result;
	}
	
	function column_wpwb_title($item) {
		
		$actions = array(
				'edit'      => sprintf('<a href="?page=%s&tab=manage-widget&action=%s&wpwb_id=%s">Edit</a>',$_REQUEST['page'],'edit',$item['wpwb_id']),
				'delete'    => sprintf('<a href="?page=%s&tab=manage-widget&action=%s&wpwb_id=%s">Delete</a>',$_REQUEST['page'],'delete',$item['wpwb_id']),
			);
		return sprintf('%1$s %2$s', $item['wpwb_title'], $this->row_actions($actions) );
	}
	
	function get_bulk_actions() {
		
	  $actions = array(
		'delete' => 'Delete'
	  );
	  return $actions;
	}
	
	function column_cb($item) {
		
		return sprintf(
			'<input type="checkbox" name="wpwb_id[]" value="%s" />', $item['wpwb_id']
		);
	}
	
	function prepare_items() {
		
		$columns  = $this->get_columns();
		$hidden   = array();
		$sortable = $this->get_sortable_columns();
		$this->_column_headers = array( $columns, $hidden, $sortable );
		usort( $this->wpwb_widget_data, array( &$this, 'usort_reorder' ) );
	
		$per_page = 10;
		$current_page = $this->get_pagenum();
		$total_items = count( $this->wpwb_widget_data );
		$this->found_data = array_slice( $this->wpwb_widget_data,( ( $current_page-1 )* $per_page ), $per_page );
		$this->set_pagination_args( array(
		'total_items' => $total_items,                  //WE have to calculate the total number of items
		'per_page'    => $per_page                     //WE have to determine how many items to show on a page
		) );
		$this->items = $this->found_data;
	}
}

$con = new WPWB_Database();

if( !empty($_GET['action']) && $_GET['action']=='delete' && !empty($_GET['wpwb_id']) && $_GET['tab']=='manage-widget' ) {

	$id = (int)$_GET['wpwb_id'];
	
	$query="DELETE FROM ".$this->table." WHERE wpwb_id='$id'";
	
	$del = $con->Run_Query($query);
	
	if($del==1)
	$response["success"] = __( 'Selected Record Deleted Successfully.', 'wp-widget-bundle' );	
}

if( !empty($_POST['action']) && $_POST['action'] == 'delete' && !empty($_POST['wpwb_id']) && $_GET['tab']=='manage-widget' ) {

	foreach($_POST['wpwb_id'] as $id)
	{
		$query="DELETE FROM ".$this->table." WHERE wpwb_id='$id'";
		$del = $con->Run_Query($query);				
	}

    $response["success"]= __( 'Selected Record Deleted Successfully.', 'wp-widget-bundle' );
}

if( !empty($_GET['action']) && $_GET['action']=='edit' && !empty($_GET['wpwb_id']) ) {

    $this->load($_GET['wpwb_id']);
    $category_data = $this;
    $category_data_array = (array)$category_data;
    $_POST = $category_data_array;
	$unserialize_wpwb_data = unserialize(stripslashes($category_data_array['wpwb_data']));
	$_POST['wpwb_data'] = $unserialize_wpwb_data;
	
	if( $_POST['wpwb_type'] == 'category-widget' ) {
	
    	include( WPWB_FORMS . '/wpwb-category-form.php');
	}
	else if( $_POST['wpwb_type'] == 'post-widget' ) {
		
		include( WPWB_FORMS . '/wpwb-post-form.php');
	}
	else if( $_POST['wpwb_type'] == 'image-widget' ) {
		
		include( WPWB_FORMS . '/wpwb-image-form.php');
	}
	else if( $_POST['wpwb_type'] == 'text-widget' ) {
		
		include( WPWB_FORMS . '/wpwb-text-form.php');
	} 
	else if( $_POST['wpwb_type'] == 'link-widget') {
		
		include( WPWB_FORMS . '/wpwb-link-form.php');
	}
	else {
		
		include( WPWB_FORMS . '/wpwb-comment-form.php');
	}
}
else
{
?>
    <div class="wpwb_contant">
    	<div class="wpwb_contant_header">
            <h2>
                <span class="glyphicon glyphicon-asterisk"></span>
                <?php _e('Manage Widgets', 'wp-widget-bundle')?>
            </h2>
        </div>
   
        <?php require_once(WPWB_FUNCTION.'wpwb-function.php'); ?> 
        
		<?php
        $wpwb_manage_widgets = new WPWB_Manage_Widgets();
        $wpwb_manage_widgets->prepare_items();
        ?>
        <form method="post">
            <?php
            $wpwb_manage_widgets->search_box( 'search', 'search_id' );
            $wpwb_manage_widgets->display();
            ?> 
        </form> 
        
    </div>
<?php
}
