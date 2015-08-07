<?php
/**
* @version 1.0.0
* @package WP Widget Bundle
*/

global $wpdb;
$category_rule_record = $wpdb->get_row('SELECT * FROM '.TBL_WB.' WHERE wpwb_id='.$atts["id"].' AND wpwb_type="category-widget"');

if( empty($category_rule_record) ) return;

$unserialize_records = unserialize(stripslashes($category_rule_record->wpwb_data));

if( !empty($unserialize_records['category']['category_taxonomy']) )
{
	$args['taxonomy']	= $unserialize_records['category']['category_taxonomy'];
}

if( $unserialize_records['category']['category_incexc'] == 'include' ) {

	if( !empty($unserialize_records['category']['category_id']) )
	$args['include'] 	=  $unserialize_records['category']['category_id'];
	else
	$args['include'] 	=  '';
}

if( $unserialize_records['category']['category_incexc'] == 'exclude' ) {

	if( !empty($unserialize_records['category']['category_id']) )
	$args['exclude'] 	=  $unserialize_records['category']['category_id'];
	else
	$args['exclude'] 	=  '';
}

if( $unserialize_records['category']['category_posts_count'] == "true" )
$args['show_count']	= 1;
else
$args['show_count'] = 0;

if( $unserialize_records['category']['category_hierarchy'] == "true" )
$args['hierarchical'] = 1;
else
$args['hierarchical'] = 0;

if( !empty($unserialize_records['category']['category_display_noc']) )
$args['number']     = $unserialize_records['category']['category_display_noc'];
else
$args['number']     = '';

$args['orderby']	  = $unserialize_records['category']['category_order_by'];
$args['order']		  = $unserialize_records['category']['category_order'];
$args['style']	= 'list';
$args['title_li' ]  = '';
$args['hide_empty']	= 0;
$args['depth']      = 0;


echo '<div class="wpwb_container">';

if( !empty($category_rule_record->wpwb_title) )
{
?>
	<div class="wpwb_wiget_title">
		<h1 class="wpwb_title"><?php echo $category_rule_record->wpwb_title; ?></h1>
	</div>
<?php
}

echo '<div class="wpwb_contant">';

if($unserialize_records['category']['category_dropdown']=="true")
{
	wp_dropdown_categories( $args );
}
else
{
	wp_list_categories( $args );
}

echo '</div>';
echo '</div>';	
