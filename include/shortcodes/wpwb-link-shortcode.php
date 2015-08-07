<?php
/**
* @version 1.0.0
* @package WP Widget Bundle
*/

global $wpdb;
$link_rule_record = $wpdb->get_row('SELECT * FROM '.TBL_WB.' WHERE wpwb_id='.$atts["id"].' AND wpwb_type="link-widget"');

if( empty($link_rule_record) ) return;

$unserialize_records = unserialize(stripslashes($link_rule_record->wpwb_data));

$args['title_before']     	=  '<h3>';
$args['title_after']      	=  '</h3>';
$args['category_before'] 	=  '<div class="wpwb_link_content_container">';
$args['category_after'] 	=  '</div>';

if( !empty($unserialize_records['link']['link_category_id']) )
$args['category'] 	=  $unserialize_records['link']['link_category_id'];
else
$args['category'] 	=  ' ';

if( !empty($unserialize_records['link']['show_link_description']) )
$args['show_description'] 	=  false;
else
$args['show_description'] 	=  true;

if( !empty($unserialize_records['link']['show_link_image']) )
$args['show_images'] 	=  $unserialize_records['link']['show_link_image'];
else
$args['show_images'] 	=  false;

if( !empty($unserialize_records['link']['show_link_rating']) )
$args['show_rating'] 	=  false;
else
$args['show_rating'] 	=  true;

$args['orderby'] 		=  $unserialize_records['link']['link_order_by'];
$args['order'] 			=  $unserialize_records['link']['link_order'];

if( !empty($unserialize_records['link']['link_display_nol']) )
$args['limit'] 	=  $unserialize_records['link']['link_display_nol'];
else
$args['limit'] 	=  10;

echo '<div class="wpwb_container">';
if( !empty($link_rule_record->wpwb_title) )
{
?>
	<div class="wpwb_wiget_title">
		<h1 class="wpwb_title">
			<?php echo $link_rule_record->wpwb_title; ?>
        </h1>
	</div>
<?php
}
echo '<div class="wpwb_contant">';
wp_list_bookmarks( $args );
echo '</div>';
echo '</div>';